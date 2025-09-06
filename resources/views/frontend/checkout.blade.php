@extends('frontend.master')
@section('header')
<link rel="stylesheet" href="{{ url('homepage/css/checkout.css') }}" />
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

<div class="solar-checkout">
    <h1 class="solar-checkout-title">CHECKOUT</h1>
    <div class="solar-checkout-content">
        <div class="solar-checkout-billing">
            <h2 class="solar-checkout-billing-header">Billing Details</h2>
            <form id="checkout-form" class="solar-checkout-billing-form">
                <div class="solar-checkout-form-row">
                    <div class="solar-checkout-form-group">
                        <label class="solar-checkout-label" for="first-name">
                            <span class="solar-checkout-label-text">First Name</span>
                            <span class="solar-checkout-required">*</span>
                        </label>
                        <input type="text" id="first-name" name="first_name" class="solar-checkout-input" required>
                    </div>
                    <div class="solar-checkout-form-group">
                        <label class="solar-checkout-label" for="last-name">
                            <span class="solar-checkout-label-text">Last Name</span>
                            <span class="solar-checkout-required">*</span>
                        </label>
                        <input type="text" id="last-name" name="last_name" class="solar-checkout-input" required>
                    </div>
                </div>
                <div class="solar-checkout-form-group">
                    <label class="solar-checkout-label" for="company-name">
                        <span class="solar-checkout-label-text">Company Name</span>
                        <span class="solar-checkout-optional">(Optional)</span>
                    </label>
                    <input type="text" id="company-name" name="company_name" class="solar-checkout-input">
                </div>
                <div class="solar-checkout-form-address">
                    <div class="solar-checkout-form-group">
                        <label class="solar-checkout-label" for="street-address">
                            <span class="solar-checkout-label-text">Street Address</span>
                            <span class="solar-checkout-required">*</span>
                        </label>
                        <input type="text" id="street-address" name="street_address" class="solar-checkout-input" placeholder="House number and street name" required>
                    </div>
                    <div class="solar-checkout-form-group">
                        <label class="solar-checkout-label" for="apartment">
                            <span class="solar-checkout-label-text">Apartment, suite, unit, etc.</span>
                            <span class="solar-checkout-optional">(Optional)</span>
                        </label>
                        <input type="text" id="apartment" name="apartment" class="solar-checkout-input" placeholder="Apartment, suite, unit, etc.">
                    </div>
                </div>
                <div class="solar-checkout-form-group">
                    <label class="solar-checkout-label" for="city">
                        <span class="solar-checkout-label-text">Town / City</span>
                        <span class="solar-checkout-required">*</span>
                    </label>
                    <input type="text" id="city" name="city" class="solar-checkout-input" required>
                </div>
                <div class="solar-checkout-form-group">
                    <label class="solar-checkout-label" for="state">
                        <span class="solar-checkout-label-text">State / County</span>
                        <span class="solar-checkout-required">*</span>
                    </label>
                    <select id="state" name="state" class="solar-checkout-select" required>
                        <option value="">Select a state</option>
                        <option value="Lagos">Lagos</option>
                        <option value="Abuja">Abuja</option>
                        <option value="Ogun">Ogun</option>
                        <option value="Oyo">Oyo</option>
                    </select>
                </div>
                <div class="solar-checkout-form-group">
                    <label class="solar-checkout-label" for="zip-code">
                        <span class="solar-checkout-label-text">Zip Code</span>
                        <span class="solar-checkout-required">*</span>
                    </label>
                    <input type="text" id="zip-code" name="zip_code" class="solar-checkout-input" required>
                </div>
                <div class="solar-checkout-form-group">
                    <label class="solar-checkout-label" for="phone">
                        <span class="solar-checkout-label-text">Phone Number</span>
                        <span class="solar-checkout-required">*</span>
                    </label>
                    <input type="tel" id="phone" name="phone" class="solar-checkout-input" required>
                </div>
                <div class="solar-checkout-form-group">
                    <label class="solar-checkout-label" for="email">
                        <span class="solar-checkout-label-text">Email Address</span>
                        <span class="solar-checkout-required">*</span>
                    </label>
                    <input type="email" id="email" name="email" class="solar-checkout-input" required>
                </div>
                <div class="solar-checkout-account">
                    <input type="checkbox" id="create-account" name="create_account" class="solar-checkout-checkbox">
                    <label for="create-account" class="solar-checkout-account-label">Create an account?</label>
                </div>
                <div class="solar-checkout-additional">
                    <h3 class="solar-checkout-additional-header">Additional Information</h3>
                    <div class="solar-checkout-form-group">
                        <label class="solar-checkout-label" for="order-notes">
                            <span class="solar-checkout-label-text">Order Notes</span>
                            <span class="solar-checkout-optional">(Optional)</span>
                        </label>
                        <textarea id="order-notes" name="order_notes" class="solar-checkout-textarea" placeholder="Note about your order, e.g. special note for delivery"></textarea>
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
                        <div class="solar-checkout-product">
                            <div class="solar-checkout-product-img"></div>
                            <div class="solar-checkout-product-info">
                                <p class="solar-checkout-product-name">FUTURE-H ALL IN ONE SOLUTION</p>
                                <div class="solar-checkout-product-quantity">x 3</div>
                            </div>
                            <div class="solar-checkout-product-subtotal">₦1,824,000</div>
                        </div>
                        <div class="solar-checkout-product">
                            <div class="solar-checkout-product-img-prod"></div>
                            <div class="solar-checkout-product-info">
                                <p class="solar-checkout-product-name">JA Solar 575W Bifacial N-Type Solar Panel</p>
                                <div class="solar-checkout-product-quantity">x 1</div>
                            </div>
                            <div class="solar-checkout-product-subtotal">₦250,000</div>
                        </div>
                        <div class="solar-checkout-product">
                            <div class="solar-checkout-product-img-2"></div>
                            <div class="solar-checkout-product-info">
                                <p class="solar-checkout-product-name">Growatt Inverter SPF 3000</p>
                                <div class="solar-checkout-product-quantity">x 1</div>
                            </div>
                            <div class="solar-checkout-product-subtotal">₦298,000</div>
                        </div>
                    </div>
                    <div class="solar-checkout-order-shipping">
                        <div class="solar-checkout-shipping-text">Lagos Standard Shipping</div>
                        <div class="solar-checkout-shipping-cost">₦25,500</div>
                    </div>
                </div>
                <div class="solar-checkout-order-total">
                    <div class="solar-checkout-total-label">Order Total</div>
                    <div class="solar-checkout-total-amount">₦2,398,000</div>
                </div>
            </div>
            <div class="solar-checkout-payment">
                <div class="solar-checkout-payment-options">
                    <div class="solar-checkout-payment-option">
                        <input type="radio" id="debit-card" name="payment_method" value="debit_card" class="solar-checkout-radio" checked>
                        <label for="debit-card" class="solar-checkout-payment-label">Pay with Debit Card</label>
                    </div>
                    <div class="solar-checkout-payment-option">
                        <input type="radio" id="cash-on-delivery" name="payment_method" value="cash_on_delivery" class="solar-checkout-radio">
                        <label for="cash-on-delivery" class="solar-checkout-payment-label">Cash on Delivery</label>
                    </div>
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
        e.preventDefault();
        const formData = new FormData(form);
        const data = Object.fromEntries(formData);
        console.log('Form submitted:', data);
        alert('Order placed successfully! (Demo submission)');
        // Add actual form submission logic here (e.g., API call)
    });

    const radios = document.querySelectorAll('.solar-checkout-radio');
    radios.forEach(radio => {
        radio.addEventListener('change', () => {
            radios.forEach(r => {
                const wrapper = r.closest('.solar-checkout-payment-option').querySelector('.solar-checkout-radio-wrapper');
                wrapper.classList.toggle('solar-checkout-radio-selected', r.checked);
            });
        });
    });
});
</script>
@endsection