@extends('frontend.master')
@section('header')
<link rel="stylesheet" href="{{ url('homepage/css/user-change-password.css') }}" />
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


<div class="account-section">
  <!-- Sidebar -->
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
      <div class="tablist-button">
        <div class="text-wrapper-2">My Order</div>
        <div class="symbol"></div>
      </div>
      <div class="tablist-button-2">
        <div class="text-wrapper-3">Change password</div>
        <div class="symbol-2"></div>
      </div>
    </div>
  </div>

  <!-- Change Password Form -->
  <div class="customer-addy">
    <div class="top">
      <div class="div-wrapper">
        <div class="text-wrapper-4">Change Password</div>
      </div>
    </div>

    <form class="password-form">
      <div class="frame-2">
        <label for="current-password" class="label-email-address">Current Password</label>
        <input type="password" id="current-password" name="current-password" class="input" placeholder="Enter current password" required>
      </div>

      <div class="frame-2">
        <label for="new-password" class="label-email-address">New Password</label>
        <input type="password" id="new-password" name="new-password" class="input" placeholder="Enter new password" required>
      </div>

      <div class="frame-2">
        <label for="confirm-password" class="label-email-address">Confirm Password</label>
        <input type="password" id="confirm-password" name="confirm-password" class="input" placeholder="Re-enter new password" required>
      </div>

      <button type="submit" class="request">
        <div class="request-quote">Save Password</div>
      </button>
    </form>
  </div>
</div>




@endsection

@section('script')

@endsection