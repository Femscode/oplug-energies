@extends('admin.master')
@section('header')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
@endsection

<link rel="stylesheet" href="{{ url('css/admin-products.css') }}">
@if(session('success'))
<meta name="success-message" content="{{ session('success') }}">
@endif
@if(session('error'))
<meta name="error-message" content="{{ session('error') }}">
@endif

@section('breadcrumb')
<div class="solar-breadcrumb">
    <button class="solar-breadcrumb-button">
        <div class="solar-breadcrumb-item">Home</div>
    </button>
   
    <div class="solar-breadcrumb-divider">/</div>
    <div class="solar-breadcrumb-wrapper">
        <p class="solar-breadcrumb-current">Products</p>
    </div>
</div>
@endsection

@section('content')

    <div class="dashboard">
        <header class="dashboard-header">
            <h1>All Products</h1>
            <a href="{{ route('admin.add-product') }}" class="btn btn-primary" style="background: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block; margin-bottom: 20px;">Add New Product</a>
        </header>
        <!-- <section class="transactions"> -->
            <div class="admin-table-container">
                <table id="admin-products-table" class="admin-table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                           
                            <th>Price (Qty)</th>
                          
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr>
                            <td class="image-cell">
                                @if($product->image)
                                    @php
                                        $images = json_decode($product->image, true);
                                        $firstImage = is_array($images) ? $images[0] : $product->image;
                                    @endphp
                                    <img src="https://www.oplugenergies.com/oplug_files/public/uploads/products/{{ $firstImage }}" alt="{{ $product->name }}" class="admin-table-image">
                                @else
                                <div class="admin-no-image">
                                    <i class="fas fa-box"></i>
                                </div>
                                @endif
                            </td>
                            <td>{{ $product->name }} <br>{{ $product->category->name ?? 'N/A' }}</td>
                            <td>₦{{ number_format($product->price, 2) }}<br> <span class="admin-badge {{ $product->is_active ? 'admin-badge-success' : 'admin-badge-secondary' }}">
                                    {{ $product->is_active ? 'Active' : 'Inactive' }} ({{ $product->stock_quantity ?? 0 }})
                                </span></td>
                            
                           
                            <td class="actions-cell">
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="admin-btn admin-btn-sm admin-btn-outline">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <button data-product-id="{{ $product->id }}" class="admin-btn admin-btn-sm admin-btn-danger delete-product-btn">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="empty-message">
                                <i class="fas fa-box-open"></i>
                                <p>No products found</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination removed; DataTables handles client-side pagination -->
        <!-- </section> -->
      
    </div>
@endsection

@section('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Load DataTables
        // Ensure jQuery and DataTables are available
        const loadScript = (src) => new Promise((resolve, reject) => {
            const s = document.createElement('script');
            s.src = src;
            s.onload = resolve;
            s.onerror = reject;
            document.head.appendChild(s);
        });

        const initDataTable = () => {
            if (window.jQuery && jQuery.fn.dataTable) {
                const tableEl = jQuery('#admin-products-table');
                if (tableEl.length) {
                    tableEl.DataTable({
                        order: [[1, 'asc']], // Sort by Name column
                        columnDefs: [
                            { targets: [0, 3], orderable: false } // Image and Actions not sortable
                        ],
                        pageLength: 10
                    });
                    // Hide Laravel pagination below the table (optional)
                    const nextEl = document.querySelector('.admin-table-container')?.nextElementSibling;
                    if (nextEl) nextEl.style.display = 'none';
                }
            }
        };

        // Load jQuery then DataTables, then init
        (async () => {
            try {
                if (!window.jQuery) {
                    await loadScript('https://code.jquery.com/jquery-3.6.0.min.js');
                }
                await loadScript('https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js');
                initDataTable();
            } catch (e) {
                console.error('Failed to load DataTables:', e);
            }
        })();

        // Show success/error messages
        var successMessage = document.querySelector('meta[name="success-message"]');
        var errorMessage = document.querySelector('meta[name="error-message"]');
        
        if (successMessage) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: successMessage.getAttribute('content'),
                timer: 3000,
                showConfirmButton: false
            });
        }
        
        if (errorMessage) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: errorMessage.getAttribute('content'),
                timer: 3000,
                showConfirmButton: false
            });
        }

        // Add event listeners to delete buttons
        var deleteButtons = document.querySelectorAll('.delete-product-btn');
        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var productId = this.getAttribute('data-product-id');
                deleteProduct(productId);
            });
        });
        
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
                csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                
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