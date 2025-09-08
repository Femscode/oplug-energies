@extends('frontend.master')
@section('header')
<link rel="stylesheet" href="{{ url('homepage/css/cart.css') }}" />
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

<div class="solar-cart">
    <div class="solar-cart-left">
        <div class="solar-cart-product">
            <div class="solar-cart-product-img"></div>
            <div class="solar-cart-product-info">
                <div class="solar-cart-product-title"><p class="solar-cart-product-title-text">FUTURE-H ALL IN ONE SOLUTION</p></div>
                <div class="solar-cart-product-price">₦1,824,000</div>
                <div class="solar-cart-product-quantity">
                    <div class="solar-cart-quantity-decrement"><div class="solar-cart-quantity-icon"><img src="{{ url('homepage/images/home/minus.svg') }}" alt="minus"/></div></div>
                    <div class="solar-cart-quantity-input">
                        <div class="solar-cart-quantity-value"><div class="solar-cart-quantity-text">1</div></div>
                    </div>
                    <div class="solar-cart-quantity-increment"><div class="solar-cart-quantity-icon"><img src="{{ url('homepage/images/home/plus.svg') }}" alt="plus"/></div></div>
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
        <div class="solar-cart-product">
            <div class="solar-cart-product-img-prod"></div>
            <div class="solar-cart-product-info">
                <div class="solar-cart-product-title"><p class="solar-cart-product-title-text">JA Solar 575W Bifacial N-Type Solar Panel</p></div>
                <div class="solar-cart-product-price">₦103,000</div>
                <div class="solar-cart-product-quantity">
                    <div class="solar-cart-quantity-decrement"><div class="solar-cart-quantity-icon"></div></div>
                    <div class="solar-cart-quantity-input">
                        <div class="solar-cart-quantity-value"><div class="solar-cart-quantity-text">1</div></div>
                    </div>
                    <div class="solar-cart-quantity-increment"><div class="solar-cart-quantity-icon"></div></div>
                </div>
                <div class="solar-cart-product-benefits">
                    <div class="solar-cart-benefit"><div class="solar-cart-benefit-text">FREE SHIPPING</div></div>
                    <div class="solar-cart-benefit-alt"><div class="solar-cart-benefit-text-alt">50% INSTALLATION</div></div>
                </div>
                <div class="solar-cart-product-status">
                    <div class="solar-cart-status-icon"></div>
                    <div class="solar-cart-status-text">In stock</div>
                </div>
            </div>
        </div>
        <div class="solar-cart-product">
            <div class="solar-cart-product-img-2"></div>
            <div class="solar-cart-product-info">
                <div class="solar-cart-product-title"><div class="solar-cart-product-title-text">Growatt Inverter SPF 3000</div></div>
                <div class="solar-cart-product-price">₦373,000</div>
                <div class="solar-cart-product-quantity">
                    <div class="solar-cart-quantity-decrement"><div class="solar-cart-quantity-icon"></div></div>
                    <div class="solar-cart-quantity-input">
                        <div class="solar-cart-quantity-value"><div class="solar-cart-quantity-text">1</div></div>
                    </div>
                    <div class="solar-cart-quantity-increment"><div class="solar-cart-quantity-icon"></div></div>
                </div>
                <div class="solar-cart-product-benefits">
                    <div class="solar-cart-benefit"><div class="solar-cart-benefit-text">FREE SHIPPING</div></div>
                    <div class="solar-cart-benefit-alt"><div class="solar-cart-benefit-text-alt">50% INSTALLATION</div></div>
                </div>
                <div class="solar-cart-product-status">
                    <div class="solar-cart-status-icon"></div>
                    <div class="solar-cart-status-text">In stock</div>
                </div>
            </div>
        </div>
    </div>
    <div class="solar-cart-right">
        <div class="solar-cart-summary">
            <div class="solar-cart-summary-header">
                <div class="solar-cart-summary-title">Order Summary</div>
                <div class="solar-cart-summary-items">
                    <div class="solar-cart-summary-item">
                        <div class="solar-cart-summary-label">Sub Total:</div>
                        <div class="solar-cart-summary-value">₦2,300,000</div>
                    </div>
                    <div class="solar-cart-summary-item">
                        <div class="solar-cart-summary-label">Discount:</div>
                        <div class="solar-cart-summary-value">-₦100,000</div>
                    </div>
                    <div class="solar-cart-summary-item">
                        <div class="solar-cart-summary-label">Tax estimate:</div>
                        <div class="solar-cart-summary-value">₦172,500</div>
                    </div>
                </div>
            </div>
            <div class="solar-cart-summary-total">
                <div class="solar-cart-total-label">ORDER TOTAL:</div>
                <div class="solar-cart-total-value">₦2,372,500</div>
            </div>
            <div class="solar-cart-checkout-button"><div class="solar-cart-checkout-text">CHECKOUT</div></div>
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
            <!-- <div class="solar-cart-promo-solis-shop"><div class="solar-cart-promo-solis-shop-text">SHOP NOW</div></div> -->
        </div>
    </div>
</div>


@endsection

@section('script')

@endsection