@extends('admin.master')

@section('header')
<link rel="stylesheet" href="{{ url('homepage/css/admin-categories.css') }}">
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
<div class="admin-page">
    <div class="admin-page-header">
        <h1 class="admin-page-title">Categories Management</h1>
        <div class="admin-page-actions">
            <a href="{{ route('admin.categories.create') }}" class="admin-btn admin-btn-primary">
                <i class="fas fa-plus"></i> Add New Category
            </a>
        </div>
    </div>

    <div class="admin-table-container">
        <div class="admin-table">
            <div class="admin-table-header">
                <div class="admin-table-cell">Image</div>
                <div class="admin-table-cell">Name</div>
                <div class="admin-table-cell">Slug</div>
                <div class="admin-table-cell">Description</div>
                <div class="admin-table-cell">Products</div>
                <div class="admin-table-cell">Status</div>
                <div class="admin-table-cell">Actions</div>
            </div>

            @forelse($categories as $category)
            <div class="admin-table-row">
                <div class="admin-table-cell image-cell">
                    @if($category->image)
                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="admin-table-image">
                    @else
                    <div class="admin-no-image">
                        <i class="fas fa-image"></i>
                    </div>
                    @endif
                </div>
                <div class="admin-table-cell">{{ $category->name }}</div>
                <div class="admin-table-cell">{{ $category->slug }}</div>
                <div class="admin-table-cell">{{ Str::limit($category->description, 50) }}</div>
                <div class="admin-table-cell">{{ $category->products()->count() }}</div>
                <div class="admin-table-cell">
                    @if($category->is_active)
                    <span class="admin-badge admin-badge-success">Active</span>
                    @else
                    <span class="admin-badge admin-badge-secondary">Inactive</span>
                    @endif
                </div>
                <div class="admin-table-cell actions-cell">
                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="admin-btn admin-btn-sm admin-btn-outline">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <button data-category-id="{{ $category->id }}" class="admin-btn admin-btn-sm admin-btn-danger delete-category-btn">
                        <i class="fas fa-trash"></i> Delete
                    </button>
                </div>
            </div>
            @empty
            <div class="admin-table-row">
                <div class="admin-table-cell empty-message">
                    <i class="fas fa-folder-open"></i>
                    <p>No categories found</p>
                </div>
            </div>
            @endforelse
        </div>
    </div>

    @if($categories->hasPages())
    <div class="admin-pagination">
        {{ $categories->links() }}
    </div>
    @endif
</div>
@endsection



@section('script')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Show validation errors with SweetAlert
    const successMessage = '{{ session("success") }}';
    if (successMessage) {
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: successMessage,
            timer: 3000,
            showConfirmButton: false
        });
    }
    
    const errorMessage = '{{ session("error") }}';
    if (errorMessage) {
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: errorMessage,
            confirmButtonText: 'OK'
        });
    }
    
    // Handle delete category buttons
    document.querySelectorAll('.delete-category-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            const categoryId = this.getAttribute('data-category-id');
            deleteCategory(categoryId);
        });
    });
});

function deleteCategory(categoryId) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'This action cannot be undone!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // Create and submit form
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '/admin/categories/' + categoryId;
            
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            
            const methodField = document.createElement('input');
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