<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    public function placeOrder(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'full_address' => 'required|string',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'payment_method' => 'required|in:debit_card,cash_on_delivery',
            'create_account' => 'sometimes',
            // 'password' => 'required_if:create_account,1|min:5|confirmed',
            'order_notes' => 'nullable|string'
        ]);
        // dd($request->create_account);
        if ($validator->fails()) {
            // dd($validator->errors());
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = Auth::user();
        
        // Handle new user account creation
        if (!$user && $request->create_account == "on" && $request->password) {
            // Check if user already exists
            $existingUser = User::where('email', $request->email)->first();
            if ($existingUser) {
                return redirect()->back()
                    ->withErrors(['email' => 'An account with this email already exists.'])
                    ->withInput();
            }

            // Create new user
            $user = User::create([
                'name' => $request->full_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->full_address,
                'password' => Hash::make($request->password),
                'role' => 'user'
            ]);

            // Log in the new user
            Auth::login($user);
        }

        // Get cart items
        if ($user) {
            $cartItems = Cart::where('user_id', $user->id)->with('product')->get();
        } else {
            $sessionId = Session::getId();
            $cartItems = Cart::where('session_id', $sessionId)->with('product')->get();
        }

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        // Calculate totals
        $subtotal = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
        $tax = $subtotal * 0.075; // 7.5% tax
        $shippingCost = 5000; // Fixed shipping cost
        $total = $subtotal + $tax + $shippingCost;

        // Create order
        $order = Order::create([
            'user_id' => $user ? $user->id : null,
            'order_number' => 'ORD-' . strtoupper(Str::random(8)),
            'name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'shipping_address' => $request->full_address,
            'subtotal' => $subtotal,
            'tax_amount' => $tax,
            'shipping_cost' => $shippingCost,
            'total_amount' => $total,
            'payment_method' => $request->payment_method,
            'payment_status' => 'pending',
            'order_status' => 'pending',
            'order_notes' => $request->order_notes,
            'session_id' => $user ? null : Session::getId()
        ]);

        // Create order items
        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->price,
                'total' => $cartItem->product->price * $cartItem->quantity
            ]);
        }

        // Handle payment method
        if ($request->payment_method === 'cash_on_delivery') {
            // For COD, mark as confirmed and clear cart
            $order->update([
                'payment_status' => 'pending',
                'order_status' => 'confirmed'
            ]);
            
            // Clear cart
            $cartItems->each->delete();
            
            return redirect()->route('order.success', $order->id)
                ->with('success', 'Order placed successfully! You will pay on delivery.');
        } else {
            // Redirect to payment gateway
            return redirect()->route('payment.process', $order->order_number);
        }
    }

    public function orderSuccess($orderId)
    {
        $order = Order::with('orderItems.product')->where('order_number',$orderId)->first();
        
        // Ensure user can only view their own orders
        if (Auth::check() && $order->user_id !== Auth::id()) {
            abort(403);
        } elseif (!Auth::check() && $order->session_id !== Session::getId()) {
            abort(403);
        }

        return view('frontend.order-success', compact('order'));
    }
}