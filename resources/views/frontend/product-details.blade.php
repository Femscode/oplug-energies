@extends('frontend.master')
@section('header')
<link rel="stylesheet" href="{{ url('homepage/css/product-details.css') }}" />
@endsection

@section('content')
<div class="solar-breadcrumb">
    <button class="solar-breadcrumb-button"><div class="solar-breadcrumb-item">Home</div></button>
    <div class="solar-breadcrumb-divider">/</div>
    <div class="solar-breadcrumb-wrapper"><div class="solar-breadcrumb-item">Shop</div></div>
    <div class="solar-breadcrumb-divider">/</div>
    <div class="solar-breadcrumb-wrapper"><div class="solar-breadcrumb-item">All-in-one Solutions</div></div>
    <div class="solar-breadcrumb-divider">/</div>
    <div class="solar-breadcrumb-wrapper"><p class="solar-breadcrumb-current">Future-h All In One Solution</p></div>
</div>

<div class="solar-product-details">
    <div class="solar-product-details-deal">
        <div class="solar-product-details-product">
            <div class="solar-product-details-swiper-wrapper">
                <div class="solar-product-details-thumb"></div>
                <div class="solar-product-details-thumb-prod"></div>
                <div class="solar-product-details-thumb-prod"></div>
            </div>
            <div class="solar-product-details-main-img">
                <div class="solar-product-details-discount-card">
                    <div class="solar-product-details-save">SAVE</div>
                    <div class="solar-product-details-save-amount">₦150,000</div>
                </div>
            </div>
        </div>
        <div class="solar-product-details-info">
            <div class="solar-product-details-title-section">
                <p class="solar-product-details-title">GROWATT FUTURE-H ALL IN ONE SOLUTION</p>
                <div class="solar-product-details-category">All-In-One Solutions</div>
            </div>
            <div class="solar-product-details-details">
                <div class="solar-product-details-price">
                    <div class="solar-product-details-current-price">₦1,824,000</div>
                    <div class="solar-product-details-old-price">₦2,045,214</div>
                </div>
                <div class="solar-product-details-specs">
                    <div class="solar-product-details-spec-item">
                        <p class="solar-product-details-spec-text">SIM 6000ES PLUS-H + BATTERY + BASE 6KW + 5.5 kKWH</p>
                    </div>
                </div>
                <div class="solar-product-details-specs">
                    <div class="solar-product-details-spec-item">
                        <p class="solar-product-details-spec-text">Integrated inverter and lithium battery system, Compact size &amp; easy installation, Flexible expansion capacity up to 18kW/33kWh, Maximum PV</p>
                    </div>
                </div>
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
                <div class="solar-product-details-total-amount">₦1,824,000</div>
            </div>
            <div class="solar-product-details-status">
                <div class="solar-product-details-status-icon"><img src='{{ url("homepage/images/svgs/active.svg") }}' alt="active"/></div>
                <div class="solar-product-details-status-text">In stock</div>
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
            <div class="solar-product-details-cart-button"><div class="solar-product-details-cart-text">ADD TO CART</div></div>
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
            <p>
                Integrated inverter and lithium battery system<br />
                Compact size and easy installation<br />
                Flexible expansion capacity up to 18kW/33kWh<br />
                Maximum PV input voltage up to 500VDC<br />
                Excellent safety of LiFePO4 battery<br />
                Grid and Generator dual AC input with integrated transfer switch
            </p>
        </div>
        <div class="solar-product-description-text" id="additional-content" style="display: none;">
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
@endsection