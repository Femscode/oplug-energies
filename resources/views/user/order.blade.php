@extends('frontend.master')
@section('header')
<link rel="stylesheet" href="{{ url('homepage/css/user-order.css') }}" />
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


<div class="account-orders-section">
  <div class="div-tabs-side">
    <div class="frame">
      <div class="heading-mark-cole">Bukola Jones</div>
      <div class="list-item-link-swoo">bkjones@gmail.com</div>
    </div>
    <div class="div">
      <div class="tablist-button">
        <div class="text-wrapper">Account info</div>
        <div class="symbol"></div>
      </div>
      <div class="tablist-button-2">
        <div class="text-wrapper-2">My Order</div>
        <div class="symbol-2"></div>
      </div>
      <div class="tablist-button">
        <div class="text-wrapper-3">Change password</div>
        <div class="symbol"></div>
      </div>
    </div>
  </div>

  <div class="frame-2">
    <div class="heading-account">Orders</div>
    <div class="left-cart">
      <div class="frame-3">
        <div class="div-product-card">
          <div class="png"></div>
          <div class="div-info">
            <div class="heading-link-xioma"><p class="p">FUTURE-H ALL IN ONE SOLUTION</p></div>
            <div class="heading">₦1,824,000</div>
            <div class="div-add-more">
              <div class="span-qt-minus"><div class="symbol-3"></div></div>
              <div class="input">
                <div class="div-wrapper"><div class="text-wrapper-4">1</div></div>
              </div>
              <div class="span-qt-plus"><div class="symbol-3"></div></div>
            </div>
            <div class="frame-4">
              <div class="symbol-4"></div>
              <div class="in-stock">In stock</div>
            </div>
          </div>
        </div>

        <div class="div-product-card">
          <div class="prod-png"></div>
          <div class="div-info">
            <div class="heading-link-xioma">
              <p class="heading-link-xioma-2">JA Solar 575W Bifacial N-Type Solar Panel</p>
            </div>
            <div class="heading">₦103,000</div>
            <div class="div-add-more">
              <div class="span-qt-minus"><div class="symbol-3"></div></div>
              <div class="input">
                <div class="div-wrapper"><div class="text-wrapper-4">1</div></div>
              </div>
              <div class="span-qt-plus"><div class="symbol-3"></div></div>
            </div>
            <div class="frame-4">
              <div class="symbol-4"></div>
              <div class="in-stock">In stock</div>
            </div>
          </div>
        </div>

        <div class="div-product-card">
          <div class="png-2"></div>
          <div class="div-info">
            <div class="heading-link-xioma"><div class="heading-link-xioma-3">Growatt Inverter SPF 3000</div></div>
            <div class="heading">₦373,000</div>
            <div class="div-add-more">
              <div class="span-qt-minus"><div class="symbol-3"></div></div>
              <div class="input">
                <div class="div-wrapper"><div class="text-wrapper-4">1</div></div>
              </div>
              <div class="span-qt-plus"><div class="symbol-3"></div></div>
            </div>
            <div class="frame-4">
              <div class="symbol-4"></div>
              <div class="in-stock">In stock</div>
            </div>
          </div>
        </div>
      </div>

      <div class="div-cart-card">
        <div class="div">
          <div class="strong-order-summary">Order Summary</div>
          <div class="frame-5">
            <div class="div-card-item">
              <div class="text-wrapper-5">Sub Total:</div>
              <div class="strong">₦2,300,000</div>
            </div>
            <div class="div-card-item">
              <div class="text-wrapper-6">Discount:</div>
              <div class="strong">-₦100,000</div>
            </div>
            <div class="div-card-item">
              <div class="text-wrapper-7">Tax estimate:</div>
              <div class="strong">₦172,500</div>
            </div>
          </div>
        </div>
        <div class="frame-6">
          <div class="strong-order-total">ORDER TOTAL:</div>
          <div class="strong-2">₦2,372,500</div>
        </div>
        <div class="link"><div class="checkout">CHECKOUT</div></div>
      </div>
    </div>
  </div>
</div>



@endsection

@section('script')

@endsection