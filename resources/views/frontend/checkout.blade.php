@extends('frontend.master')
@section('header')
<link rel="stylesheet" href="{{ url('homepage/css/checkout.css') }}" />
@endsection

@section('content')
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
        <div class="solar-breadcrumb-item">Cart</div>
    </div>
    <div class="solar-breadcrumb-divider">/</div>
    <div class="solar-breadcrumb-wrapper">
        <p class="solar-breadcrumb-current">Checkout</p>
    </div>
</div>

<div class="solar-checkout">
    <h1 class="solar-checkout-title">CHECKOUT</h1>
    <div class="solar-checkout-content">
        <div class="solar-checkout-billing">
            <h2 class="solar-checkout-billing-header">Billing Details</h2>
            
            @if(session('success'))
                <div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 1rem; border-radius: 0.25rem; margin-bottom: 1rem;">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="alert alert-danger" style="background-color: #f8d7da; color: #721c24; padding: 1rem; border-radius: 0.25rem; margin-bottom: 1rem;">
                    {{ session('error') }}
                </div>
            @endif
            
            @if($errors->any())
                <div class="alert alert-danger" style="background-color: #f8d7da; color: #721c24; padding: 1rem; border-radius: 0.25rem; margin-bottom: 1rem;">
                    <ul style="margin: 0; padding-left: 1.5rem;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form id="checkout-form" class="solar-checkout-billing-form" action="{{ route('order.place') }}" method="POST">
                @csrf
                <div class="solar-checkout-form-group">
                    <label class="solar-checkout-label" for="full-name">
                        <span class="solar-checkout-label-text">Full Name</span>
                        <span class="solar-checkout-required">*</span>
                    </label>
                    <input type="text" id="full-name" name="full_name" class="solar-checkout-input" value="{{ old('full_name', Auth::user() ? Auth::user()->name : '') }}" required>
                </div>
                <div class="solar-checkout-form-group">
                    <label class="solar-checkout-label" for="full-address">
                        <span class="solar-checkout-label-text">Full Address</span>
                        <span class="solar-checkout-required">*</span>
                    </label>
                    <textarea id="full-address" name="full_address" class="solar-checkout-textarea" rows="3" required>{{ old('full_address', Auth::user()->address ?? '') }}</textarea>
                </div>
                <div class="solar-checkout-form-group">
                    <label class="solar-checkout-label" for="phone">
                        <span class="solar-checkout-label-text">Phone Number</span>
                        <span class="solar-checkout-required">*</span>
                    </label>
                    <input type="tel" id="phone" name="phone" class="solar-checkout-input" value="{{ old('phone', Auth::user()->phone ?? '') }}" required>
                </div>
                <div class="solar-checkout-form-group">
                    <label class="solar-checkout-label" for="email">
                        <span class="solar-checkout-label-text">Email Address</span>
                        <span class="solar-checkout-required">*</span>
                    </label>
                    <input type="email" id="email" name="email" class="solar-checkout-input" value="{{ old('email', Auth::user()->email ?? '') }}" required>
                </div>
                @guest
                <div class="solar-checkout-account">
                    <input type="checkbox" id="create-account" name="create_account" class="solar-checkout-checkbox" {{ old('create_account') ? 'checked' : '' }}>
                    <label for="create-account" class="solar-checkout-account-label">Create an account?</label>
                </div>
                <div id="password-fields" style="display: none;">
                    <div class="solar-checkout-form-group">
                        <label class="solar-checkout-label" for="password">
                            <span class="solar-checkout-label-text">Password</span>
                            <span class="solar-checkout-required">*</span>
                        </label>
                        <input type="password" id="password" name="password" class="solar-checkout-input">
                    </div>
                    <div class="solar-checkout-form-group">
                        <label class="solar-checkout-label" for="password-confirmation">
                            <span class="solar-checkout-label-text">Confirm Password</span>
                            <span class="solar-checkout-required">*</span>
                        </label>
                        <input type="password" id="password-confirmation" name="password_confirmation" class="solar-checkout-input">
                    </div>
                </div>
                @endguest
                <div class="solar-checkout-additional">
                    <h3 class="solar-checkout-additional-header">Additional Information</h3>
                    <div class="solar-checkout-form-group">
                        <label class="solar-checkout-label" for="order-notes">
                            <span class="solar-checkout-label-text">Order Notes</span>
                            <span class="solar-checkout-optional">(Optional)</span>
                        </label>
                        <textarea id="order-notes" name="order_notes" class="solar-checkout-textarea" placeholder="Note about your order, e.g. special note for delivery">{{ old('order_notes') }}</textarea>
                    </div>
                </div>
            </form>
        </div>
        <div class="solar-checkout-order">
            <h2 class="solar-checkout-order-header">Your Order</h2>
            <div class="solar-checkout-order-details">
                <div class="solar-checkout-order-card">
                    <div class="solar-checkout-order-heading">
                        <div class="solar-checkout-order-product">PRODUCT</div>
                        <div class="solar-checkout-order-subtotal">SUBTOTAL</div>
                    </div>
                    <div class="solar-checkout-order-items">
                        @if($cartItems->count() > 0)
                            @foreach($cartItems as $item)
                            <div class="solar-checkout-product">
                                @php
                            $images = $item->product->image ? json_decode($item->product->image, true) : [];
                            $firstImage = !empty($images) ? $images[0] : null;
                            $imageUrl = $firstImage ? url('uploads/products/' . $firstImage) : url('homepage/images/home/solar1.png');
                        @endphp
                        <div class="solar-checkout-product-img" style="background-image: url('{{ $imageUrl }}'); background-size: cover; background-position: center;"></div>
                                <div class="solar-checkout-product-info">
                                    <p class="solar-checkout-product-name">{{ strtoupper($item->product->name) }}</p>
                                    <div class="solar-checkout-product-quantity">x {{ $item->quantity }}</div>
                                </div>
                                <div class="solar-checkout-product-subtotal">₦{{ number_format($item->product->price * $item->quantity, 0) }}</div>
                            </div>
                            @endforeach
                        @else
                            <div class="empty-checkout" style="text-align: center; padding: 20px;">
                                <p>No items in cart</p>
                                <a href="{{ route('shop') }}">Continue Shopping</a>
                            </div>
                        @endif
                    </div>
                    <!-- <div class="solar-checkout-order-shipping">
                        <div class="solar-checkout-shipping-text">Standard Shipping</div>
                        <div class="solar-checkout-shipping-cost">₦{{ number_format($shippingCost, 0) }}</div>
                    </div> -->
                </div>
                <div class="solar-checkout-order-total">
                    <div class="solar-checkout-total-label">Order Total</div>
                    <div class="solar-checkout-total-amount">₦{{ number_format($subtotal, 0) }}</div>
                </div>
            </div>
            <div class="solar-checkout-payment">
                <div class="solar-checkout-payment-options">
                    <!-- <div class="solar-checkout-payment-option">
                        <input type="radio" id="debit-card" name="payment_method" value="debit_card" class="solar-checkout-radio" form="checkout-form" checked>
                        <label for="debit-card" class="solar-checkout-payment-label">Pay with Debit Card</label>
                    </div>
                    <div class="solar-checkout-payment-option">
                        <input type="radio" id="cash-on-delivery" name="payment_method" value="cash_on_delivery" class="solar-checkout-radio" form="checkout-form">
                        <label for="cash-on-delivery" class="solar-checkout-payment-label">Cash on Delivery</label>
                    </div> -->
                    <!-- <div class="solar-checkout-payment-option"> -->
                        <input checked type="hidden" id="whatsapp" name="payment_method" value="whatsapp" class="solar-checkout-radio" form="checkout-form">
                        <!-- <label for="whatsapp" class="solar-checkout-payment-label">Order via WhatsApp</label> -->
                    <!-- </div> -->
                </div>
                <button type="submit" form="checkout-form" class="solar-checkout-place-order">
                    <span class="solar-checkout-place-order-text">PLACE ORDER</span>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.getElementById('checkout-form');
        form.addEventListener('submit', (e) => {
            // Allow normal form submission to Laravel backend
            // Remove preventDefault to enable actual form submission
        });

        const radios = document.querySelectorAll('.solar-checkout-radio');
        radios.forEach(radio => {
            radio.addEventListener('change', () => {
                radios.forEach(r => {
                    const wrapper = r.closest('.solar-checkout-payment-option');
                    if (wrapper) {
                        wrapper.classList.toggle('selected', r.checked);
                    }
                });
            });
        });

        // Handle create account checkbox
        const createAccountCheckbox = document.getElementById('create-account');
        const passwordFields = document.getElementById('password-fields');
        
        if (createAccountCheckbox && passwordFields) {
            createAccountCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    passwordFields.style.display = 'block';
                    document.getElementById('password').required = true;
                    document.getElementById('password-confirmation').required = true;
                } else {
                    passwordFields.style.display = 'none';
                    document.getElementById('password').required = false;
                    document.getElementById('password-confirmation').required = false;
                }
            });
        }
    });
</script>
@endsection