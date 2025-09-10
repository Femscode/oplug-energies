@extends('admin.master')
@section('header')

@endsection

@section('breadcrumb')
<div class="solar-breadcrumb">
    <button class="solar-breadcrumb-button">
        <div class="solar-breadcrumb-item">Home</div>
    </button>
    <div class="solar-breadcrumb-divider">/</div>
    <div class="solar-breadcrumb-wrapper">
        <div class="solar-breadcrumb-item">Shop</div>
    </div>
    <div class="solar-breadcrumb-divider">/</div>
    <div class="solar-breadcrumb-wrapper">
        <div class="solar-breadcrumb-item">All-in-one Solutions</div>
    </div>
    <div class="solar-breadcrumb-divider">/</div>
    <div class="solar-breadcrumb-wrapper">
        <p class="solar-breadcrumb-current">Future-h All In One Solution</p>
    </div>
</div>
@endsection


@section('content')
<div class="dashboard">
    <header class="dashboard-header">
        <h1>Dashboard</h1>
        <div class="dashboard-stats">
            <div class="stat-card">
                <h3>Total Orders</h3>
                <p>{{ $totalOrders }}</p>
            </div>
            <div class="stat-card">
                <h3>Total Products</h3>
                <p>{{ $totalProducts }}</p>
            </div>
            <div class="stat-card">
                <h3>Total Users</h3>
                <p>{{ $totalUsers }}</p>
            </div>
            <div class="stat-card">
                <h3>Total Revenue</h3>
                <p>₦{{ number_format($totalRevenue, 2) }}</p>
            </div>
        </div>
    </header>
    <section class="transactions">
        <h2>Recent Orders</h2>
        <div class="table-wrapper">
            <div class="table">
                <div class="table-header">
                    <span>Customer</span>
                    <span>Order Number</span>
                    <span>Date</span>
                    <span>Amount</span>
                    <span>Status</span>
                </div>
                @forelse($recentOrders as $order)
                <div class="table-row">
                    <span>{{ $order->user->name }}</span>
                    <span>{{ $order->order_number }}</span>
                    <span>{{ $order->created_at->format('d.m.Y') }}</span>
                    <span>₦{{ number_format($order->total_amount, 2) }}</span>
                    <span class="badge {{ $order->status === 'completed' ? 'paid' : 'pending' }}">{{ ucfirst($order->status) }}</span>
                </div>
                @empty
                <div class="table-row">
                    <span colspan="5" style="text-align: center;">No orders found</span>
                </div>
                @endforelse
            </div>
        </div>
    </section>
    <section class="products">
        <h2>Top Products by Orders</h2>
        <div class="table-wrapper">
            <div class="table">
                <div class="table-header">
                    <span>Name</span>
                    <span>Price</span>
                    <span>Category</span>
                    <span>Orders Count</span>
                </div>
                @forelse($topProducts as $product)
                <div class="table-row">
                    <span>{{ $product->name }}</span>
                    <span>₦{{ number_format($product->price, 2) }}</span>
                    <span>{{ $product->category->name ?? 'N/A' }}</span>
                    <span>{{ $product->order_items_count }}</span>
                </div>
                @empty
                <div class="table-row">
                    <span colspan="4" style="text-align: center;">No products found</span>
                </div>
                @endforelse
            </div>
        </div>
    </section>
</div>
@endsection

@section('script')

@endsection