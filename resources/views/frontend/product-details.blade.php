@extends('frontend.master')
@section('header')
<link rel="stylesheet" href="{{ url('homepage/css/product-details.css') }}" />
<script src="{{ url('homepage/js/image-gallery.js') }}"></script>
@endsection

@section('content')
<div class="solar-breadcrumb">
    <button class="solar-breadcrumb-button">
        <div class="solar-breadcrumb-item">Home</div>
    </button>
    <div class="solar-breadcrumb-divider">/</div>
    <div class="solar-breadcrumb-wrapper">
        <a href='/shop'>
            <div class="solar-breadcrumb-item">Shop</div>
        </a>
    </div>
    <div class="solar-breadcrumb-divider">/</div>

    <div class="solar-breadcrumb-wrapper">
        <a href='/shop/all-in-one-solutions/{{ $product->id }}'>
            <p class="solar-breadcrumb-current">{{ $product->name }}</p>
        </a>
    </div>
</div>

<div class="solar-product-details">
    <div class="opd-product-details">
        <!-- Your existing PHP Blade code with updated class names below -->
        <div class="opd-product-wrapper">

            <!-- Image Gallery + Main Image -->
            <div class="opd-gallery">
                @if($product && $product->image)
                @php
                $images = json_decode($product->image, true);
                $images = is_array($images) ? $images : [$product->image];
                $firstImage = $images[0] ?? (is_string($product->image) ? $product->image : null);
                @endphp

                @if(count($images) > 1)
                <div class="opd-thumbnails">
                    @foreach($images as $index => $image)
                    <div class="opd-thumb {{ $index === 0 ? 'active' : '' }}"
                        data-image="https://www.oplugenergies.com/oplug_files/public/uploads/products/{{ $image }}"
                        onclick="switchMainImage('https://www.oplugenergies.com/oplug_files/public/uploads/products/{{ $image }}', this)">
                        <img src="https://www.oplugenergies.com/oplug_files/public/uploads/products/{{ $image }}"
                            alt="Thumbnail">
                    </div>
                    @endforeach
                </div>
                @endif

                <div class="opd-main-image-wrapper">
                    <div class="opd-main-image" id="mainProductImage"
                        style="background-image: url('{{ $firstImage ? 'https://www.oplugenergies.com/oplug_files/public/uploads/products/' . $firstImage : asset('homepage/images/default-product.png') }}')">

                        @if($product?->discount_price && $product->discount_price < $product->price)
                            <div class="opd-discount-badge">
                                <span>SAVE</span>
                                <strong>₦{{ number_format($product->price - $product->discount_price) }}</strong>
                            </div>
                            @endif
                    </div>
                </div>
                @else
                <div class="opd-main-image-wrapper">
                    <div class="opd-main-image" style="background-image: url('{{ asset('homepage/images/default-product.png') }}')"></div>
                </div>
                @endif
            </div>

            <!-- Product Info -->
            <div class="opd-info">
                <div class="opd-title-section">
                    <h1 class="opd-title">{{ $product->name ?? 'Product Name' }}</h1>
                    <p class="opd-category">{{ $product?->category?->name ?? 'Product Category' }}</p>
                </div>

                <div class="opd-price">
                    @if($product?->discount_price && $product->discount_price < $product->price)
                        <span class="opd-current-price">₦{{ number_format($product->discount_price) }}</span>
                        <span class="opd-old-price">₦{{ number_format($product->price) }}</span>
                        @else
                        <span class="opd-current-price">₦{{ number_format($product->price ?? 0) }}</span>
                        @endif
                </div>

                @if($product?->short_description)
                <p class="opd-short-desc">{{ $product->short_description }}</p>
                @endif

                @if($product?->description)
                <p class="opd-description">{{ Str::limit($product->description, 200) }}</p>
                @endif

                <div class="opd-benefits">
                    <div class="opd-benefit"><strong>FREE SHIPPING</strong></div>
                    <div class="opd-benefit opd-benefit-alt"><strong>50% INSTALLATION</strong></div>
                </div>

                <div class="opd-contact">
                    <div class="opd-contact-label">Quick Order 24/7</div>
                    <a href="tel:+2349076351112" class="opd-contact-number">+(234) 9076351112</a>
                </div>
            </div>
        </div>

        <!-- Sticky Checkout Bar (Mobile) / Sidebar (Desktop) -->
        <div class="opd-checkout-sidebar">
            <div class="opd-checkout-summary">
                <div class="opd-total">
                    <span>TOTAL PRICE:</span>
                    <strong class="opd-total-amount">
                        @if($product?->discount_price && $product->discount_price < $product->price)
                            ₦{{ number_format($product->discount_price) }}
                            @else
                            ₦{{ number_format($product->price ?? 0) }}
                            @endif
                    </strong>
                </div>

                <div class="opd-stock">
                    @if($product?->stock_quantity > 0)
                    <span class="opd-in-stock">✔ In stock</span>
                    @else
                    <span class="opd-out-of-stock">✘ Out of stock</span>
                    @endif
                </div>
            </div>

            <div class="opd-actions">
                <div class="opd-quantity">
                    <button class="opd-qty-btn decrement">-</button>
                    <span class="opd-qty-value">1</span>
                    <button class="opd-qty-btn increment">+</button>
                </div>

                <a href='/cart' style="text-align:center" class="opd-btn opd-btn-checkout">PROCEED TO CHECKOUT</a>
                <button class="opd-btn opd-btn-cart add-to-cart-btn" data-product-id="{{ $product->id }}">
                    ADD TO CART
                </button>
            </div>

            <div class="opd-payment">
                <p class="opd-payment-label">Guaranteed Safe Checkout</p>
                <div class="opd-payment-logos">
                    <img src="{{ url('homepage/images/home/visa.png') }}" alt="Visa">
                    <img src="{{ url('homepage/images/home/mastercard.png') }}" alt="Mastercard">
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
</div>

 <!-- Simple JS for thumbnail switching & quantity -->
    <script>
        function switchMainImage(src, el) {
            document.querySelector('.opd-main-image').style.backgroundImage = `url('${src}')`;
            document.querySelectorAll('.opd-thumb').forEach(t => t.classList.remove('active'));
            el.classList.add('active');
        }

        // Quantity controls
        document.querySelectorAll('.opd-qty-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                let value = parseInt(document.querySelector('.opd-qty-value').textContent);
                if (btn.classList.contains('increment')) value++;
                else if (value > 1) value--;
                document.querySelector('.opd-qty-value').textContent = value;
            });
        });
    </script>
    <style>
        /* Reset & Base */
        .opd-product-details * {
            box-sizing: border-box;
        }

        .opd-product-details img {
            max-width: 100%;
            display: block;
        }

        /* Main container */
        .opd-product-details {
            max-width: 1280px;
            margin: 0 auto;
            padding: 1rem;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        /* Flex wrapper - switches layout at desktop */
        .opd-product-wrapper {
            display: flex;
            flex-direction: column;
            gap: 2rem;
        }

        @media (min-width: 992px) {
            .opd-product-wrapper {
                flex-direction: row;
            }

            .opd-gallery {
                flex: 1;
            }

            .opd-info {
                flex: 1;
            }
        }

        /* Gallery */
        .opd-gallery {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .opd-thumbnails {
            display: flex;
            gap: 0.75rem;
            overflow-x: auto;
            padding: 0.5rem 0;
        }

        .opd-thumb {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            overflow: hidden;
            cursor: pointer;
            border: 3px solid transparent;
            flex-shrink: 0;
            transition: all 0.3s ease;
        }

        .opd-thumb.active,
        .opd-thumb:hover {
            border-color: #003087;
        }

        .opd-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .opd-main-image-wrapper {
            position: relative;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .opd-main-image {
            height: 400px;
            background-size: cover;
            background-position: center;
            background-color: #f5f5f5;
        }

        .opd-discount-badge {
            position: absolute;
            top: 1rem;
            left: 1rem;
            background: #ff1744;
            color: white;
            padding: 0.5rem 0.75rem;
            border-radius: 8px;
            font-weight: bold;
            text-align: center;
            font-size: 0.9rem;
            box-shadow: 0 4px 15px rgba(255, 23, 68, 0.4);
        }

        .opd-discount-badge span {
            display: block;
            font-size: 0.75rem;
        }

        /* Info Section */
        .opd-title {
            font-size: 1.8rem;
            margin: 0;
            line-height: 1.2;
            font-weight: 700;
        }

        .opd-category {
            color: #666;
            margin: 0.5rem 0;
            font-size: 0.95rem;
        }

        .opd-price {
            margin: 1rem 0;
        }

        .opd-current-price {
            font-size: 2.2rem;
            font-weight: 800;
            color: #003087;
        }

        .opd-old-price {
            text-decoration: line-through;
            color: #999;
            margin-left: 1rem;
            font-size: 1.3rem;
        }

        .opd-short-desc {
            font-weight: 600;
            margin: 1.5rem 0;
        }

        .opd-description {
            color: #444;
            line-height: 1.6;
        }

        .opd-benefits {
            display: flex;
            gap: 1rem;
            margin: 1.5rem 0;
            flex-wrap: wrap;
        }

        .opd-benefit {
            background: #e8f5e9;
            color: #003087;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            font-weight: bold;
        }

        .opd-benefit-alt {
            background: #fff3e0;
            color: #ff8f00;
        }

        .opd-contact {
            margin-top: 2rem;
            text-align: center;
            padding: 1rem;
            background: #f9f9f9;
            border-radius: 12px;
        }

        .opd-contact-label {
            font-size: 0.9rem;
            color: #666;
        }

        .opd-contact-number {
            font-size: 1.5rem;
            font-weight: bold;
            color: #003087;
            text-decoration: none;
        }

        /* Checkout Sidebar - Sticky on mobile */
        .opd-checkout-sidebar {
            background: #fff;
            border: 1px solid #eee;
            border-radius: 16px;
            padding: 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin-top: 2rem;
        }

        @media (min-width: 992px) {
            .opd-checkout-sidebar {
                position: sticky;
                top: 1.5rem;
                height: fit-content;
                margin-top: 0;
                flex: 0 0 360px;
            }
        }

        .opd-total {
            font-size: 1.4rem;
            font-weight: bold;
            margin-bottom: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .opd-total-amount {
            color: #003087;
        }

        .opd-stock {
            margin-bottom: 1.5rem;
        }

        .opd-in-stock {
            color: #003087;
            font-weight: bold;
        }

        .opd-out-of-stock {
            color: #f44336;
            font-weight: bold;
        }

        .opd-actions {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .opd-quantity {
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid #ddd;
            border-radius: 12px;
            width: fit-content;
            margin: 0 auto;
        }

        .opd-qty-btn {
            width: 48px;
            height: 48px;
            background: transparent;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
        }

        .opd-qty-value {
            width: 60px;
            text-align: center;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .opd-btn {
            padding: 1rem;
            border: none;
            border-radius: 12px;
            font-weight: bold;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s;
        }

        .opd-btn-checkout {
            background: #003087;
            color: white;
        }

        .opd-btn-checkout:hover {
            background: #00b140;
        }

        .opd-btn-cart {
            background: #333;
            color: white;
        }

        .opd-btn-cart:hover {
            background: #111;
        }

        .opd-payment {
            text-align: center;
            margin-top: 1.5rem;
            padding-top: 1.5rem;
            border-top: 1px solid #eee;
        }

        .opd-payment-label {
            font-size: 0.85rem;
            color: #666;
            margin-bottom: 0.5rem;
        }

        .opd-payment-logos img {
            height: 30px;
            margin: 0 0.5rem;
        }

        /* Mobile adjustments */
        @media (max-width: 768px) {
            .opd-main-image {
                height: 300px;
            }

            .opd-title {
                font-size: 1.5rem;
            }

            .opd-current-price {
                font-size: 1.8rem;
            }
        }
    </style>
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