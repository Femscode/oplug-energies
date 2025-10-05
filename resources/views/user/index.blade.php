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
     <br>
    
     <section class="orders-section">
    <h2>Recent Orders</h2>
    
    @if($recentOrders->count() > 0)
        <div class="table-wrapper">
            <div class="table orders-table">
                <div class="table-header">
                    <div>Order #</div>
                    <div>Date</div>
                    <div>Status</div>
                    <div>Total</div>
                    <div>Actions</div>
                </div>
                @foreach($recentOrders as $order)
                <div class="table-row">
                    <div>
                        <strong>#{{ $order->order_number ?? $order->id }}</strong>
                        <div class="order-items-preview">
                            @if($order->orderItems && $order->orderItems->count() > 0)
                                <small>{{ $order->orderItems->count() }} item(s)</small>
                            @endif
                        </div>
                    </div>
                    <div>{{ $order->created_at->format('M d, Y') }}</div>
                    <div>
                        <span class="badge {{ strtolower($order->status) === 'completed' || strtolower($order->status) === 'delivered' ? 'paid' : 'pending' }}">
                            {{ ucfirst($order->status) }}
                        </span>
                    </div>
                    <div>
                        <strong>₦{{ number_format($order->total_amount, 2) }}</strong>
                    </div>
                    <div class="order-actions">
                        <a href="{{ route('user.orders.show', $order) }}" class="btn btn-sm btn-primary">View</a>
                        <!-- @if(in_array($order->status, ['pending', 'processing']))
                            <form method="POST" action="{{ route('user.orders.cancel', $order) }}" style="display: inline; margin-left: 0.5rem;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to cancel this order?')">Cancel</button>
                            </form>
                        @endif
                        @if(in_array($order->status, ['delivered', 'completed']))
                            <form method="POST" action="{{ route('user.orders.reorder', $order) }}" style="display: inline; margin-left: 0.5rem;">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-secondary">Reorder</button>
                            </form>
                        @endif -->
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        
        <!-- Pagination -->
      
    @else
        <div class="no-orders">
            <p>You haven't placed any orders yet.</p>
            <a href="{{ route('home') }}" class="btn btn-primary">Start Shopping</a>
        </div>
    @endif
</section>
</div>
@endsection