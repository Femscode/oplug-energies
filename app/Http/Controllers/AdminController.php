<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        return view('admin.orders');
    }
    public function products() {
        $products = Product::with('category')->paginate(10);
        return view('admin.products', compact('products'));
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
            'quantity' => 'required|integer|min:0',
            'is_active' => 'boolean'
        ]);
        
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'product_category_id' => $request->product_category_id,
            'quantity' => $request->quantity,
            'is_active' => $request->has('is_active')
        ]);
        
        return redirect()->route('admin.products')->with('success', 'Product updated successfully!');
    }
    
    public function deleteProduct($id) {
        $product = Product::findOrFail($id);
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean'
        ]);
        
        $productData = [
            'name' => $request->name,
            'slug'=> Str::slug($request->name),
            'description' => $request->description,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'quantity' => $request->quantity,
            'product_category_id' => $request->product_category_id,
            'is_active' => $request->has('is_active')
        ];
        
        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/products'), $imageName);
            $productData['image'] = 'uploads/products/' . $imageName;
        }
        
        Product::create($productData);
        
        return redirect()->route('admin.products')->with('success', 'Product created successfully!');
    }
    public function settings() {
        return view('admin.settings');
    }
    public function changePassword() {
        return view('admin.change-password');
    }
}
