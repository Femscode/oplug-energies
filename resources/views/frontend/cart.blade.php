@extends('frontend.master')
@section('header')
<link rel="stylesheet" href="{{ url('homepage/css/cart.css') }}" />
@endsection

@section('content')
<div class="solar-breadcrumb">
    <a href="/" class="solar-breadcrumb-button"><div class="solar-breadcrumb-item">Home</div></a>
    <div class="solar-breadcrumb-divider">/</div>
    <div class="solar-breadcrumb-wrapper">
        <a href='/shop'><div class="solar-breadcrumb-item">Shop</div></a>
    </div>
    <div class="solar-breadcrumb-divider">/</div>
    <div class="solar-breadcrumb-wrapper"><div class="solar-breadcrumb-item">Cart</div></div>
</div>

<div class="solar-cart">
    <div class="solar-cart-left">
        @if($cartItems->count() > 0)
            @foreach($cartItems as $item)
            <div class="solar-cart-product" data-product-id="{{ $item->product->id }}">
                @php
                    $images = $item->product->image ? json_decode($item->product->image, true) : [];
                    $firstImage = !empty($images) ? $images[0] : null;
                    $imageUrl = $firstImage ? url('uploads/products/' . $firstImage) : url('homepage/images/home/solar1.png');
                @endphp
                <div class="solar-cart-product-img" style="background-image: url('{{ $imageUrl }}'); background-size: cover; background-position: center;"></div>
                <div class="solar-cart-product-info">
                    <div class="solar-cart-product-title"><p class="solar-cart-product-title-text">{{ strtoupper($item->product->name) }}</p></div>
                    <div class="solar-cart-product-price">₦{{ number_format($item->product->price, 0) }}</div>
                    <div class="solar-cart-product-quantity">
                        <div class="solar-cart-quantity-decrement" onclick="updateCartQuantity({{ $item->product->id }}, {{ $item->quantity - 1 }})"><div class="solar-cart-quantity-icon"><img src="{{ url('homepage/images/home/minus.svg') }}" alt="minus"/></div></div>
                        <div class="solar-cart-quantity-input">
                            <div class="solar-cart-quantity-value"><div class="solar-cart-quantity-text">{{ $item->quantity }}</div></div>
                        </div>
                        <div class="solar-cart-quantity-increment" onclick="updateCartQuantity({{ $item->product->id }}, {{ $item->quantity + 1 }})"><div class="solar-cart-quantity-icon"><img src="{{ url('homepage/images/home/plus.svg') }}" alt="plus"/></div></div>
                    </div>
                    <div class="solar-cart-product-benefits">
                        <div class="solar-cart-benefit"><div class="solar-cart-benefit-text">FREE SHIPPING</div></div>
                        <div class="solar-cart-benefit-alt"><div class="solar-cart-benefit-text-alt">50% INSTALLATION</div></div>
                    </div>
                    <div class="solar-cart-product-status">
                        <div class="solar-cart-status-icon"><img src="{{ url('homepage/images/svgs/active.svg') }}" alt="active"/></div>
                        <div class="solar-cart-status-text">In stock</div>
                    </div>
                </div>
            </div>
            @endforeach
        @else
            <div class="empty-cart" style="text-align: center; padding: 50px;">
                <p style="font-size: 18px; margin-bottom: 20px;">Your cart is empty</p>
                <a href="{{ route('shop') }}" class="continue-shopping" style="background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Continue Shopping</a>
            </div>
        @endif
    </div>
    <div class="solar-cart-right">
        <div class="solar-cart-summary">
            <div class="solar-cart-summary-header">
                <div class="solar-cart-summary-title">Order Summary</div>
                <div class="solar-cart-summary-items">
                    <div class="solar-cart-summary-item">
                        <div class="solar-cart-summary-label">Sub Total:</div>
                        <div class="solar-cart-summary-value">₦{{ number_format($subtotal, 0) }}</div>
                    </div>
                    <div class="solar-cart-summary-item">
                        <div class="solar-cart-summary-label">Discount:</div>
                        <div class="solar-cart-summary-value">-₦0</div>
                    </div>
                    <div class="solar-cart-summary-item">
                        <div class="solar-cart-summary-label">Tax estimate:</div>
                        <div class="solar-cart-summary-value">₦{{ number_format($tax, 0) }}</div>
                    </div>
                </div>
            </div>
            <div class="solar-cart-summary-total">
                <div class="solar-cart-total-label">ORDER TOTAL:</div>
                <div class="solar-cart-total-value">₦{{ number_format($total, 0) }}</div>
            </div>
            <a href="{{ route('checkout') }}" class="solar-cart-checkout-button"><div class="solar-cart-checkout-text">CHECKOUT</div></a>
        </div>
        <div class="solar-cart-promo-jinko" style="background-image:url('homepage/images/home/solar5.png');background-size:cover">
            <div class="solar-cart-promo-content">
                <div class="solar-cart-promo-brand">JINKO SOLAR</div>
                <div class="solar-cart-promo-text">
                    <div class="solar-cart-promo-title">Low Light Champion</div>
                    <div class="solar-cart-promo-subtitle">Tiger Neo Iii</div>
                </div>
                <div class="solar-cart-promo-shop"><div class="solar-cart-promo-shop-text">SHOP NOW</div></div>
            </div>
        </div>
        <div class="solar-cart-promo-solis" style="background-image:url('homepage/images/home/solar6.png');background-size:cover">
            <p class="solar-cart-promo-solis-title">
                <span class="solar-cart-promo-solis-brand">SOLIS</span>
                <span class="solar-cart-promo-solis-text"> RELIABLE INVERTERS NOW AVAILABLE</span>
            </p>
            <div class="solar-cart-promo-solis-price">
                <div class="solar-cart-promo-solis-from">FROM AS LOW AS</div>
                <div class="solar-cart-promo-solis-amount">₦150,000</div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
function updateCartQuantity(productId, newQuantity) {
    if (newQuantity < 1) {
        if (confirm('Remove this item from cart?')) {
            removeFromCart(productId);
        }
        return;
    }
    
    fetch('/cart/update', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: newQuantity
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert(data.message || 'Error updating cart');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error updating cart');
    });
}

function removeFromCart(productId) {
    fetch('/cart/remove', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            product_id: productId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert(data.message || 'Error removing item');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error removing item');
    });
}
</script>
@endsection