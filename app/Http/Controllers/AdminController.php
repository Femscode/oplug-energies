<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminController extends Controller
{
      public function index() {
      
        // Get recent orders with user information
        $recentOrders = Order::with('user')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        // Get top products by units sold (simulated with order items count)
        // $topProducts = Product::withCount('orderItems')
        $topProducts = Product::withCount('orderItems')
            ->orderBy('order_items_count', 'desc')
            ->limit(5)
            ->get();
        
        // Get dashboard statistics
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalUsers = User::where('role', '!=', 'admin')->count();
        $totalRevenue = Order::where('status', 'completed')->sum('total_amount');
        // $totalRevenue = Order::sum('total_amount');
        
        return view('admin.index', compact(
             'recentOrders', 
             'topProducts', 
             'totalOrders', 
             'totalProducts', 
             'totalUsers', 
             'totalRevenue'
         ));
     }
     
     public function orders() {
        $orders = Order::with(['user', 'orderItems.product'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('admin.orders', compact('orders'));
    }
    
    public function orderDetails(Order $order) {
        $order->load(['user', 'orderItems.product']);
        return view('admin.order-details', compact('order'));
    }
    
    public function exportOrders()
    {
        $orders = Order::with(['orderItems.product'])
            ->orderBy('created_at', 'desc')
            ->get();

        $csvData = [];
        $csvData[] = ['Order Number', 'Customer Name', 'Email', 'Phone', 'Date', 'Status', 'Total Amount', 'Items Count', 'Products'];

        foreach ($orders as $order) {
            $products = $order->orderItems->map(function($item) {
                return $item->product->name . ' (Qty: ' . $item->quantity . ')';
            })->implode('; ');

            $csvData[] = [
                $order->order_number ?? 'ORD-' . $order->id,
                $order->name,
                $order->email,
                $order->phone ?? 'N/A',
                $order->created_at->format('Y-m-d H:i:s'),
                ucfirst($order->status),
                '₦' . number_format($order->total_amount, 2),
                $order->orderItems->count(),
                $products
            ];
        }

        $filename = 'orders_export_' . date('Y-m-d_H-i-s') . '.csv';
        
        $handle = fopen('php://output', 'w');
        
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');
        
        // Add BOM for proper UTF-8 encoding in Excel
        fwrite($handle, "\xEF\xBB\xBF");
        
        foreach ($csvData as $row) {
            fputcsv($handle, $row);
        }
        
        fclose($handle);
        exit;
    }
    public function products(\Illuminate\Http\Request $request) {
        $query = Product::with('category');

        // Optional filter by category ID
        if ($request->filled('category')) {
            $query->where('product_category_id', $request->input('category'));
        }
        // Return full collection; DataTables will handle client-side pagination/sorting
        $products = $query->get();
        return view('admin.products', compact('products'));
    }

    public function users() {
        $users = User::paginate(10);
        return view('admin.users', compact('users'));
    }

    public function make_admin($id) {

        $user = User::findOrFail($id);
        if($user->role == 'admin') {
            $user->role = 'user';
        } else {
            $user->role = 'admin';

        }
        $user->save();
        
        return redirect()->back()->with('success', 'User role updated successfully!');
    }
    
    public function exportUsers()
    {
        $users = User::orderBy('created_at', 'desc')->get();

        $csvData = [];
        $csvData[] = ['ID', 'Name', 'Email', 'Phone', 'Role', 'Registration Date'];

        foreach ($users as $user) {
            $csvData[] = [
                $user->id,
                $user->name,
                $user->email,
                $user->phone ?? 'N/A',
                ucfirst($user->role),
                $user->created_at->format('Y-m-d H:i:s')
            ];
        }

        $filename = 'users_export_' . date('Y-m-d_H-i-s') . '.csv';
        
        $handle = fopen('php://output', 'w');
        
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');
        
        // Add BOM for proper UTF-8 encoding in Excel
        fwrite($handle, "\xEF\xBB\xBF");
        
        foreach ($csvData as $row) {
            fputcsv($handle, $row);
        }
        
        fclose($handle);
        exit;
    }
    
    public function editProduct($id) {
        $product = Product::findOrFail($id);
        $categories = \App\Models\ProductCategory::all();
        return view('admin.edit-product', compact('product', 'categories'));
    }
    
    public function updateProduct(Request $request, $id) {
        $product = Product::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'product_category_id' => 'required|exists:product_categories,id',
            'stock_quantity' => 'required|integer|min:0',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'removed_images' => 'nullable|array',
            'tags' => 'nullable|string',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:500',
            'is_active' => 'boolean'
        ]);
        
        // Get current images
        $currentImages = $product->image ? json_decode($product->image, true) : [];
        
        // If new images are being uploaded, delete all existing images first
        if ($request->hasFile('images')) {
            // Delete all existing images from filesystem
            if (!empty($currentImages)) {
                foreach ($currentImages as $existingImage) {
                    if (file_exists(public_path('uploads/products/' . $existingImage))) {
                        unlink(public_path('uploads/products/' . $existingImage));
                    }
                }
            }
            
            // Reset current images array and upload new ones
            $currentImages = [];
            foreach ($request->file('images') as $index => $image) {
                $imageName = time() . '_' . $index . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/products'), $imageName);
                $currentImages[] = $imageName;
            }
        } else {
            // Handle individual image removal if no new images are uploaded
            if ($request->has('removed_images')) {
                foreach ($request->removed_images as $removedImage) {
                    // Remove from filesystem
                    if (file_exists(public_path('uploads/products/' . $removedImage))) {
                        unlink(public_path('uploads/products/' . $removedImage));
                    }
                    // Remove from current images array
                    $currentImages = array_filter($currentImages, function($img) use ($removedImage) {
                        return $img !== $removedImage;
                    });
                }
            }
        }
        
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => !empty($currentImages) ? json_encode(array_values($currentImages)) : null,
            'product_category_id' => $request->product_category_id,
            'stock_quantity' => $request->stock_quantity,
            'tags' => $request->tags ? array_map('trim', explode(',', $request->tags)) : null,
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
            'is_active' => $request->has('is_active')
        ]);
        
        return redirect()->route('admin.products')->with('success', 'Product updated successfully!');
    }
    
    public function deleteProduct($id) {
        $product = Product::findOrFail($id);
        
        // Delete associated images from filesystem
        if ($product->image) {
            $images = json_decode($product->image, true);
            if (is_array($images)) {
                foreach ($images as $image) {
                    $imagePath = public_path('uploads/products/' . $image);
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }
            }
        }
        
        $product->delete();
        
        return redirect()->route('admin.products')->with('success', 'Product deleted successfully!');
    }
    public function add_product() {
        $categories = \App\Models\ProductCategory::where('is_active', true)->get();
        return view('admin.add-product', compact('categories'));
    }
    
    public function storeProduct(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0.01',
            'discount_price' => 'nullable|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'product_category_id' => 'required|exists:product_categories,id',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'nullable|string',
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string|max:500',
            'is_active' => 'boolean'
        ]);
        
        $productData = [
            'name' => $request->name,
            'slug'=> Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'stock_quantity' => $request->quantity,
            'product_category_id' => $request->product_category_id,
            'tags' => $request->tags ? array_map('trim', explode(',', $request->tags)) : null,
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
            'is_active' => $request->has('is_active')
        ];
        
        // Handle multiple image uploads
        $imageNames = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $imageName = time() . '_' . $index . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/products'), $imageName);
                $imageNames[] = $imageName;
            }
            $productData['image'] = json_encode($imageNames);
        }
        
        Product::create($productData);
        
        return redirect()->route('admin.products')->with('success', 'Product created successfully!');
    }
    public function settings()
    {
        return view('admin.settings');
    }

    public function updateSettings(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
        ]);

        $user = Auth::user();
        $user->update([
            'name' => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('admin.settings')->with('success', 'Profile updated successfully!');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $user = Auth::user();

        // Check if current password is correct
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('success', 'Password updated successfully!');
    }

    public function changePassword() {
        return view('admin.change-password');
    }
}
