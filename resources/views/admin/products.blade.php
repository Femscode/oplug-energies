@extends('admin.master')
@section('header')
@endsection

@section('breadcrumb')
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
            <h1>All Products</h1>
            <a href="{{ route('admin.add-product') }}" class="btn btn-primary" style="background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block; margin-bottom: 20px;">Add New Product</a>
        </header>
        <section class="transactions">
            <div class="table-wrapper">
                <div class="table">
                    <div class="table-header">
                        <span>Name</span>
                        <span>Category</span>
                        <span>Price</span>
                        <span>Quantity</span>
                        <span>Status</span>
                        <span>Actions</span>
                    </div>
                    @forelse($products as $product)
                    <div class="table-row">
                        <span>{{ $product->name }}</span>
                        <span>{{ $product->category->name ?? 'N/A' }}</span>
                        <span>₦{{ number_format($product->price, 2) }}</span>
                        <span>{{ $product->quantity ?? 0 }}</span>
                        <span class="badge {{ $product->is_active ? 'paid' : 'pending' }}">{{ $product->is_active ? 'Active' : 'Inactive' }}</span>
                        <span>
                            <a href="{{ route('admin.products.edit', $product->id) }}" style="color: #007bff; margin-right: 10px;">Edit</a>
                            <a href="#" onclick="deleteProduct({{ $product->id }})" style="color: #dc3545;">Delete</a>
                        </span>
                    </div>
                    @empty
                    <div class="table-row">
                        <span colspan="6" style="text-align: center;">No products found</span>
                    </div>
                    @endforelse
                </div>
            </div>
            
            <!-- Pagination -->
            <div style="margin-top: 20px;">
                {{ $products->links() }}
            </div>
        </section>
      
    </div>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Show success/error messages
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{!! addslashes(session('success')) !!}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif
        
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{!! addslashes(session('error')) !!}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif
        
        // Tab switching functionality
        var tabs = document.querySelectorAll('.solar-account-tab');
        var contents = document.querySelectorAll('.solar-account-details-content');
        var sidebar = document.querySelector('.solar-account-sidebar');
        var toggleButton = document.querySelector('.solar-account-sidebar-toggle');

        tabs.forEach(function(tab) {
            tab.addEventListener('click', function() {
                tabs.forEach(function(t) { t.classList.remove('solar-account-tab-active'); });
                tab.classList.add('solar-account-tab-active');

                contents.forEach(function(content) {
                    content.style.opacity = '0';
                    content.style.display = 'none';
                });

                var targetContent = document.getElementById(tab.dataset.tab);
                if (targetContent) {
                    setTimeout(function() {
                        targetContent.style.display = 'block';
                        targetContent.style.opacity = '1';
                    }, 200);
                }

                // Collapse sidebar on mobile after tab selection
                if (window.innerWidth <= 767) {
                    sidebar.classList.remove('solar-account-sidebar-open');
                }
            });
        });

        // Sidebar toggle for mobile
        if (toggleButton) {
            toggleButton.addEventListener('click', function() {
                sidebar.classList.toggle('solar-account-sidebar-open');
            });
        }

        // Form submission handling
        var accountForm = document.getElementById('account-form');
        var passwordForm = document.getElementById('password-form');

        if (accountForm) {
            accountForm.addEventListener('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(accountForm);
                var data = Object.fromEntries(formData);
                console.log('Account Info Submitted:', data);
                alert('Account information saved! (Demo submission)');
            });
        }

        if (passwordForm) {
            passwordForm.addEventListener('submit', function(e) {
                e.preventDefault();
                var formData = new FormData(passwordForm);
                var data = Object.fromEntries(formData);
                if (data.new_password !== data.confirm_password) {
                    alert('New password and confirmation do not match!');
                    return;
                }
                console.log('Password Change Submitted:', data);
                alert('Password changed successfully! (Demo submission)');
            });
        }
    });

    // Delete product function
    function deleteProduct(productId) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then(function(result) {
            if (result.isConfirmed) {
                // Create a form and submit it
                var form = document.createElement('form');
                form.method = 'POST';
                form.action = '/admin/products/' + productId;
                
                var csrfToken = document.createElement('input');
                csrfToken.type = 'hidden';
                csrfToken.name = '_token';
                csrfToken.value = '{{ csrf_token() }}';
                
                var methodField = document.createElement('input');
                methodField.type = 'hidden';
                methodField.name = '_method';
                methodField.value = 'DELETE';
                
                form.appendChild(csrfToken);
                form.appendChild(methodField);
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>
@endsection