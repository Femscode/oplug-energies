@extends('user.master')

@section('breadcrumb')
<div class="breadcrumb">
    <div class="container">
        <nav>
            <a href="{{ route('home') }}">Home</a> > 
            <span>Dashboard</span>
        </nav>
    </div>
</div>
@endsection

@section('content')
<div class="dashboard">
    <header class="dashboard-header" style="display:block">
        <h1>Dashboard</h1>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="dashboard-stats">
            <div class="stat-card">
                <h3>Total Orders</h3>
                <p>{{ $totalOrders }}</p>
            </div>
            <div class="stat-card">
                <h3>Pending Orders</h3>
                <p>{{ $pendingOrders }}</p>
            </div>
            <div class="stat-card">
                <h3>Completed Orders</h3>
                <p>{{ $completedOrders }}</p>
            </div>
            <div class="stat-card">
                <h3>Total Spent</h3>
                <p>₦{{ number_format($totalSpent, 2) }}</p>
            </div>
        </div>
    </header>
    
    <!-- Recent Orders -->
    <section class="recent-orders">
        <h2>Recent Orders</h2>
        
        @if($recentOrders->count() > 0)
            <div class="table-wrapper">
                <div class="table">
                    <div class="table-header">
                        <div>Order ID</div>
                        <div>Date</div>
                        <div>Status</div>
                        <div>Total</div>
                    </div>
                    @foreach($recentOrders as $order)
                    <div class="table-row">
                        <div>#{{ $order->id }}</div>
                        <div>{{ $order->created_at->format('M d, Y') }}</div>
                        <div>
                            <span class="badge {{ strtolower($order->status) === 'completed' ? 'paid' : 'pending' }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </div>
                        <div>₦{{ number_format($order->total_amount, 2) }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        @else
            <p>No orders found.</p>
        @endif
    </section>
</div>
@endsection