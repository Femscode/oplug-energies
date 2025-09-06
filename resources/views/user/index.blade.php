@extends('frontend.master')
@section('header')
<link rel="stylesheet" href="{{ url('homepage/css/user-dashboard.css') }}" />
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

<div class="solar-account">
    <div class="solar-account-sidebar">
        <button class="solar-account-sidebar-toggle">☰ Menu</button>
        <div class="solar-account-user">
            <div class="solar-account-user-name">Bukola Jones</div>
            <div class="solar-account-user-email">bkjones@gmail.com</div>
        </div>
        <div class="solar-account-tabs">
            <div class="solar-account-tab solar-account-tab-active" data-tab="account-info">
                <div class="solar-account-tab-text">Account Info</div>
                <div class="solar-account-tab-icon"></div>
            </div>
            <div class="solar-account-tab" data-tab="my-order">
                <div class="solar-account-tab-text">My Order</div>
                <div class="solar-account-tab-icon"></div>
            </div>
            <div class="solar-account-tab" data-tab="change-password">
                <div class="solar-account-tab-text">Change Password</div>
                <div class="solar-account-tab-icon"></div>
            </div>
        </div>
    </div>
    <div class="solar-account-details">
        <div class="solar-account-details-content" id="account-info">
            <h2 class="solar-account-details-header">Account Info</h2>
            <form id="account-form" class="solar-account-details-form">
                <div class="solar-account-form-row">
                    <div class="solar-account-form-group">
                        <label class="solar-account-label" for="first-name">
                            <span class="solar-account-label-text">First Name</span>
                            <span class="solar-account-required">*</span>
                        </label>
                        <input type="text" id="first-name" name="first_name" class="solar-account-input" value="Mark" required>
                    </div>
                    <div class="solar-account-form-group">
                        <label class="solar-account-label" for="last-name">
                            <span class="solar-account-label-text">Last Name</span>
                            <span class="solar-account-required">*</span>
                        </label>
                        <input type="text" id="last-name" name="last_name" class="solar-account-input" value="Cole" required>
                    </div>
                </div>
                <div class="solar-account-form-group">
                    <label class="solar-account-label" for="email">
                        <span class="solar-account-label-text">Email Address</span>
                        <span class="solar-account-required">*</span>
                    </label>
                    <input type="email" id="email" name="email" class="solar-account-input" value="bkjones@gmail.com" required>
                </div>
                <div class="solar-account-form-group">
                    <label class="solar-account-label" for="phone">
                        <span class="solar-account-label-text">Phone Number</span>
                        <span class="solar-account-optional">(Optional)</span>
                    </label>
                    <input type="tel" id="phone" name="phone" class="solar-account-input" value="+234 1234567890">
                </div>
                <div class="solar-account-form-group">
                    <label class="solar-account-label" for="address">
                        <span class="solar-account-label-text">Default Address</span>
                        <span class="solar-account-required">*</span>
                    </label>
                    <textarea id="address" name="address" class="solar-account-input solar-account-textarea" required>81, Mobolaji Bank Anthony Way, Ikeja, Lagos, Nigeria</textarea>
                </div>
                <button type="submit" class="solar-account-save-button">
                    <span class="solar-account-save-text">SAVE</span>
                </button>
            </form>
        </div>
        <div class="solar-account-details-content" id="my-order" style="display: none;">
            <h2 class="solar-account-details-header">My Orders</h2>
            <div class="solar-account-orders">
                <p>No orders found.</p>
                <!-- Placeholder for order list; can be populated dynamically -->
            </div>
        </div>
        <div class="solar-account-details-content" id="change-password" style="display: none;">
            <h2 class="solar-account-details-header">Change Password</h2>
            <form id="password-form" class="solar-account-details-form">
                <div class="solar-account-form-group">
                    <label class="solar-account-label" for="current-password">
                        <span class="solar-account-label-text">Current Password</span>
                        <span class="solar-account-required">*</span>
                    </label>
                    <input type="password" id="current-password" name="current_password" class="solar-account-input" required>
                </div>
                <div class="solar-account-form-group">
                    <label class="solar-account-label" for="new-password">
                        <span class="solar-account-label-text">New Password</span>
                        <span class="solar-account-required">*</span>
                    </label>
                    <input type="password" id="new-password" name="new_password" class="solar-account-input" required>
                </div>
                <div class="solar-account-form-group">
                    <label class="solar-account-label" for="confirm-password">
                        <span class="solar-account-label-text">Confirm New Password</span>
                        <span class="solar-account-required">*</span>
                    </label>
                    <input type="password" id="confirm-password" name="confirm_password" class="solar-account-input" required>
                </div>
                <button type="submit" class="solar-account-save-button">
                    <span class="solar-account-save-text">SAVE</span>
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
document.addEventListener('DOMContentLoaded', () => {
    // Tab switching functionality
    const tabs = document.querySelectorAll('.solar-account-tab');
    const contents = document.querySelectorAll('.solar-account-details-content');
    const sidebar = document.querySelector('.solar-account-sidebar');
    const toggleButton = document.querySelector('.solar-account-sidebar-toggle');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => t.classList.remove('solar-account-tab-active'));
            tab.classList.add('solar-account-tab-active');
            
            contents.forEach(content => {
                content.style.opacity = '0';
                content.style.display = 'none';
            });

            const targetContent = document.getElementById(tab.dataset.tab);
            setTimeout(() => {
                targetContent.style.display = 'block';
                targetContent.style.opacity = '1';
            }, 200);

            // Collapse sidebar on mobile after tab selection
            if (window.innerWidth <= 767) {
                sidebar.classList.remove('solar-account-sidebar-open');
            }
        });
    });

    // Sidebar toggle for mobile
    toggleButton.addEventListener('click', () => {
        sidebar.classList.toggle('solar-account-sidebar-open');
    });

    // Form submission handling
    const accountForm = document.getElementById('account-form');
    const passwordForm = document.getElementById('password-form');

    accountForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const formData = new FormData(accountForm);
        const data = Object.fromEntries(formData);
        console.log('Account Info Submitted:', data);
        alert('Account information saved! (Demo submission)');
    });

    passwordForm.addEventListener('submit', (e) => {
        e.preventDefault();
        const formData = new FormData(passwordForm);
        const data = Object.fromEntries(formData);
        if (data.new_password !== data.confirm_password) {
            alert('New password and confirmation do not match!');
            return;
        }
        console.log('Password Change Submitted:', data);
        alert('Password changed successfully! (Demo submission)');
    });
});
</script>
@endsection