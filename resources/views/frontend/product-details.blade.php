@extends('frontend.master')
@section('header')
<link rel="stylesheet" href="{{ url('homepage/css/product-details.css') }}" />
<script src="{{ url('homepage/js/image-gallery.js') }}"></script>
@endsection

@section('content')
<div class="solar-breadcrumb">
    <button class="solar-breadcrumb-button"><div class="solar-breadcrumb-item">Home</div></button>
    <div class="solar-breadcrumb-divider">/</div>
    <div class="solar-breadcrumb-wrapper">
        <a href='/shop'><div class="solar-breadcrumb-item">Shop</div></a>
    </div>
    <div class="solar-breadcrumb-divider">/</div>
   
    <div class="solar-breadcrumb-wrapper">
        <a href='/shop/all-in-one-solutions/{{ $product->id }}'><p class="solar-breadcrumb-current">{{ $product->name }}</p></a>
    </div>
</div>

<div class="solar-product-details">
    <div class="solar-product-details-deal">
        <div class="solar-product-details-product">
            @if($product && $product->image)
                @php
                    $images = json_decode($product->image, true);
                    $images = is_array($images) ? $images : [$product->image];
                @endphp
                @if(count($images) > 1)
                <div class="solar-product-details-swiper-wrapper">
                    @foreach($images as $index => $image)
                        <div class="solar-product-details-thumb thumbnail-image" 
                             data-image="{{ asset('uploads/products/' . $image) }}"
                             style="background-image: url(&quot;{{ asset('uploads/products/' . $image) }}&quot;); background-size: cover; background-position: center; cursor: pointer; border: 2px solid {{ $index === 0 ? '#007bff' : 'transparent' }}; transition: all 0.2s ease;"
                             onclick="switchMainImage('{{ asset('uploads/products/' . $image) }}', this)"></div>
                    @endforeach
                </div>
                @endif
                <div class="solar-product-details-main-img">
                    <div class="main-product-image" id="mainProductImage" 
                         style="width: 100%; height: 100%; background-image: url(&quot;{{ asset('uploads/products/' . $images[0]) }}&quot;); background-size: cover; background-position: center; transition: all 0.3s ease;"></div>
                    @if($product->discount_price && $product->discount_price < $product->price)
                    <div class="solar-product-details-discount-card">
                        <div class="solar-product-details-save">SAVE</div>
                        <div class="solar-product-details-save-amount">₦{{ number_format($product->price - $product->discount_price) }}</div>
                    </div>
                    @endif
                </div>
            @else
                <div class="solar-product-details-swiper-wrapper">
                    <div class="solar-product-details-thumb"></div>
                </div>
                <div class="solar-product-details-main-img">
                    <div class="main-product-image" id="mainProductImage" 
                         style="width: 100%; height: 100%; background-image: url(&quot;{{ asset('homepage/images/default-product.png') }}&quot;); background-size: cover; background-position: center;"></div>
                </div>
            @endif
        </div>
        <div class="solar-product-details-info">
            <div class="solar-product-details-title-section">
                <p class="solar-product-details-title">{{ $product->name ?? 'Product Name' }}</p>
                <div class="solar-product-details-category">{{ $product->category->name ?? 'Product Category' }}</div>
            </div>
            <div class="solar-product-details-details">
                <div class="solar-product-details-price">
                    @if($product && $product->discount_price && $product->discount_price < $product->price)
                        <div class="solar-product-details-current-price">₦{{ number_format($product->discount_price) }}</div>
                        <div class="solar-product-details-old-price">₦{{ number_format($product->price) }}</div>
                    @else
                        <div class="solar-product-details-current-price">₦{{ number_format($product->price ?? 0) }}</div>
                    @endif
                </div>
                @if($product && $product->short_description)
                <div class="solar-product-details-specs">
                    <div class="solar-product-details-spec-item">
                        <p class="solar-product-details-spec-text">{{ $product->short_description }}</p>
                    </div>
                </div>
                @endif
                @if($product && $product->description)
                <div class="solar-product-details-specs">
                    <div class="solar-product-details-spec-item">
                        <p class="solar-product-details-spec-text">{{ Str::limit($product->description, 150) }}</p>
                    </div>
                </div>
                @endif
                <div class="solar-product-details-benefits">
                    <div class="solar-product-details-benefit"><div class="solar-product-details-benefit-text">FREE SHIPPING</div></div>
                    <div class="solar-product-details-benefit-alt"><div class="solar-product-details-benefit-text-alt">50% INSTALLATION</div></div>
                </div>
            </div>
            <div class="solar-product-details-contact">
                <div class="solar-product-details-contact-label">Quick Order 24/7</div>
                <div class="solar-product-details-contact-number">+(234) 9076351112</div>
            </div>
        </div>
    </div>
    <div class="solar-product-details-checkout">
        <div class="solar-product-details-checkout-info">
            <div class="solar-product-details-price-total">
                <div class="solar-product-details-total-label">TOTAL PRICE:</div>
                @if($product && $product->discount_price && $product->discount_price < $product->price)
                    <div class="solar-product-details-total-amount">₦{{ number_format($product->discount_price) }}</div>
                @else
                    <div class="solar-product-details-total-amount">₦{{ number_format($product->price ?? 0) }}</div>
                @endif
            </div>
            <div class="solar-product-details-status">
                @if($product && $product->stock_quantity > 0)
                    <div class="solar-product-details-status-icon"><img src='{{ url("homepage/images/svgs/active.svg") }}' alt="active"/></div>
                    <div class="solar-product-details-status-text">In stock</div>
                @else
                    <div class="solar-product-details-status-icon"><img src='{{ url("homepage/images/svgs/cancel.svg") }}' alt="cancel"/></div>
                    <div class="solar-product-details-status-text">Out of Stock</div>
                @endif
            </div>
        </div>
        <div class="solar-product-details-actions">
            <div class="solar-product-details-quantity">
                <div class="solar-product-details-quantity-decrement"><img src="{{ url('homepage/images/home/minus.svg') }}"/></div>
                <div class="solar-product-details-quantity-input">
                    <div class="solar-product-details-quantity-value">1</div>
                </div>
                <div class="solar-product-details-quantity-increment"><img src="{{ url('homepage/images/home/plus.svg') }}"/></div>
            </div>
            <div class="solar-product-details-checkout-button"><div class="solar-product-details-checkout-text">PROCEED TO CHECKOUT</div></div>
            <div class="solar-product-details-cart-button add-to-cart-btn" data-product-id="{{ $product->id }}" style="cursor: pointer;"><div class="solar-product-details-cart-text">ADD TO CART</div></div>
        </div>
        <div class="solar-product-details-payment">
            <div class="solar-product-details-payment-label">Guaranteed Safe Checkout</div>
            <div class="solar-product-details-payment-methods">
                <img class="solar-product-details-payment-img" src="{{ url('homepage/images/home/visa.png') }}" alt="Payment Method" />
                <img class="solar-product-details-mastercard" src="{{ url('homepage/images/home/mastercard.png') }}" alt="Mastercard" />
            </div>
        </div>
    </div>
</div>
<div class="solar-product-description">
    <div class="solar-product-description-tabs">
        <div class="solar-product-description-tab" data-tab="description">DESCRIPTION</div>
        <div class="solar-product-description-tab" data-tab="additional">ADDITIONAL FILES</div>
    </div>
    <div class="solar-product-description-content">
        <div class="solar-product-description-text" id="description-content">
            @if($product && $product->description)
                <p>{!! nl2br(e($product->description)) !!}</p>
            @else
                <p>
                    Integrated inverter and lithium battery system<br />
                    Compact size and easy installation<br />
                    Flexible expansion capacity up to 18kW/33kWh<br />
                    Maximum PV input voltage up to 500VDC<br />
                    Excellent safety of LiFePO4 battery<br />
                    Grid and Generator dual AC input with integrated transfer switch
                </p>
            @endif
        </div>
        <div class="solar-product-description-text" id="additional-content" style="display: none;">
            @if($product && $product->specifications)
                <p><strong>Specifications:</strong><br />{!! nl2br(e($product->specifications)) !!}</p>
            @else
                <p>
                    <strong>Specifications:</strong><br />
                    Rated power: 6000VA/6000W<br />
                    Surge power: 12000VA<br />
                    3 units maximum (single or three phase)<br />
                    Maximum PV array power: 8000W<br />
                    MPPT range: 120VDC ~ 450VDC<br />
                    Rated Capacity: 5.5kWh<br />
                    Operating Voltage: 40 ~ 58.4V<br />
                    Max Charging Current: 100A<br />
                    Warranty: 5 Years
                </p>
            @endif
        </div>
        <div class="solar-product-description-image" style="background-image: url('{{ url("homepage/images/home/product-details.png") }}'); background-size:cover"></div>
    </div>
</div>
@endsection

@section('script')
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Tab toggle functionality
    const tabs = document.querySelectorAll('.solar-product-description-tab');
    const descriptionContent = document.getElementById('description-content');
    const additionalContent = document.getElementById('additional-content');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            // Remove active class from all tabs
            tabs.forEach(t => t.classList.remove('solar-product-description-tab-active'));
            // Add active class to clicked tab
            tab.classList.add('solar-product-description-tab-active');

            // Toggle content visibility with fade effect
            if (tab.dataset.tab === 'description') {
                descriptionContent.style.opacity = '0';
                additionalContent.style.display = 'none';
                setTimeout(() => {
                    descriptionContent.style.display = 'block';
                    descriptionContent.style.opacity = '1';
                }, 200);
            } else {
                additionalContent.style.opacity = '0';
                descriptionContent.style.display = 'none';
                setTimeout(() => {
                    additionalContent.style.display = 'block';
                    additionalContent.style.opacity = '1';
                }, 200);
            }
        });
    });

    // Quantity increment/decrement functionality
    const decrementBtn = document.querySelector('.solar-product-details-quantity-decrement');
    const incrementBtn = document.querySelector('.solar-product-details-quantity-increment');
    const quantityValue = document.querySelector('.solar-product-details-quantity-value');

    if (decrementBtn && incrementBtn && quantityValue) {
        decrementBtn.addEventListener('click', () => {
            let value = parseInt(quantityValue.textContent);
            if (value > 1) {
                quantityValue.textContent = value - 1;
            }
        });

        incrementBtn.addEventListener('click', () => {
            let value = parseInt(quantityValue.textContent);
            quantityValue.textContent = value + 1;
        });
    }
});
</script>

<!-- Cart functionality -->
<script src="{{ asset('js/cart.js') }}"></script>
@endsection