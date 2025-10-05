<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;

class DashboardController extends Controller
{
   
    public function index() {
        $user = Auth::user();
        
        // Get user statistics
        $totalOrders = $user->orders()->count();
        $pendingOrders = $user->orders()->where('status', 'pending')->count();
        $completedOrders = $user->orders()->where('status', 'completed')->count();
        // $totalSpent = $user->orders()->where('status', 'completed')->sum('total_amount');
        $totalSpent = $user->orders()->sum('total_amount');
        
        // Get recent orders
        $recentOrders = $user->orders()
                           ->with(['orderItems.product'])
                           ->latest()
                           ->limit(5)
                           ->get();
        
        return view('user.index', compact(
            'user',
            'totalOrders',
            'pendingOrders', 
            'completedOrders',
            'totalSpent',
            'recentOrders'
        ));
    }
    
    public function order() {
        return view('user.order');
    }
    
    public function changePassword() {
        return view('user.change-password');
    }
}
