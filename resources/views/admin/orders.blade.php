@extends('admin.master')
@section('header')
<link rel="stylesheet" href="{{ url('homepage/css/admin-master.css') }}" />
<link rel="stylesheet" href="{{ url('homepage/css/admin-dashboard.css') }}" />
@endsection

@section('breadcrump')
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
        <div class="solar-breadcrumb-item">All-in-one Solutions</div>
    </div>
    <div class="solar-breadcrumb-divider">/</div>
    <div class="solar-breadcrumb-wrapper">
        <p class="solar-breadcrumb-current">Future-h All In One Solution</p>
    </div>
</div>
@endsection

@section('content')
    <div class="dashboard">
        <header class="dashboard-header">
            <h1>Orders</h1>
        </header>
        <section class="transactions">
            <h2>Recent Orders</h2>
            <div class="table-wrapper">
                <div class="table">
                    <div class="table-header">
                        <span>Name</span>
                        <span>Date</span>
                        <span>Amount</span>
                        <span>Status</span>
                    </div>
                    <div class="table-row">
                        <span>Shola S.</span>
                        <span>22.05.2025</span>
                        <span>₦144,000</span>
                        <span class="badge paid">Paid</span>
                    </div>
                    <div class="table-row">
                        <span>Rakesh S.</span>
                        <span>22.05.2025</span>
                        <span>₦125,044,000</span>
                        <span class="badge paid">Paid</span>
                    </div>
                    <div class="table-row">
                        <span>Ibrahim S.</span>
                        <span>22.05.2025</span>
                        <span>₦44,000</span>
                        <span class="badge pending">Pending</span>
                    </div>
                    <div class="table-row">
                        <span>Tobi S.</span>
                        <span>22.05.2025</span>
                        <span>₦15,044,000</span>
                        <span class="badge paid">Paid</span>
                    </div>
                    <div class="table-row">
                        <span>Rakesh S.</span>
                        <span>22.05.2025</span>
                        <span>₦5,044,000</span>
                        <span class="badge pending">Pending</span>
                    </div>
                </div>
            </div>
        </section>
      
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