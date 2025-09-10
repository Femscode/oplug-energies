@extends('admin.master')
@section('header')
<link rel="stylesheet" href="{{ url('homepage/css/admin-master.css') }}" />
<link rel="stylesheet" href="{{ url('homepage/css/add-product.css') }}" />
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
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
        <div class="solar-breadcrumb-item">Products</div>
    </div>
    <div class="solar-breadcrumb-divider">/</div>
    <div class="solar-breadcrumb-wrapper">
        <p class="solar-breadcrumb-current">Edit Product</p>
    </div>
</div>

<div class="admin-tabs">
    <a href="{{ route('admin.products') }}" class="solar-account-tab">
        <div class="solar-account-tab-text">Products</div>
        <div class="solar-account-tab-icon">→</div>
    </a>
    <a href="{{ route('admin.categories.index') }}" class="solar-account-tab">
        <div class="solar-account-tab-text">Categories</div>
        <div class="solar-account-tab-icon">→</div>
    </a>
</div>

<div class="dashboard">
  <form class="product-form" method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <section class="information">
      <h2>Information</h2>
      <div class="form-group">
        <label for="product-name">Product Name</label>
        <input type="text" id="product-name" name="name" placeholder="Enter product name" value="{{ old('name', $product->name) }}" required>
        @error('name')
          <span class="error-text" style="color: red; font-size: 12px;">{{ $message }}</span>
        @enderror
      </div>
      <div class="form-group">
        <label for="product-description">Product Description</label>
        <textarea id="product-description" name="description" placeholder="Enter product description" rows="4" required>{{ old('description', $product->description) }}</textarea>
        @error('description')
          <span class="error-text" style="color: red; font-size: 12px;">{{ $message }}</span>
        @enderror
      </div>
      <div class="form-group">
        <label>Product Image</label>
        @if($product->image)
          <div class="current-image" style="margin-bottom: 10px;">
            <img src="{{ asset($product->image) }}" alt="Current product image" style="max-width: 200px; height: auto; border-radius: 5px;">
            <p style="font-size: 12px; color: #666;">Current image</p>
          </div>
        @endif
        <div class="upload-area" id="upload-area">
          <input type="file" id="image-upload" name="image" accept="image/*" hidden>
          <button type="button" id="upload-button">{{ $product->image ? 'Change Image' : 'Add File' }}</button>
          <p>Or drag and drop files</p>
          <div id="file-preview" class="file-preview"></div>
        </div>
        @error('image')
          <span class="error-text" style="color: red; font-size: 12px;">{{ $message }}</span>
        @enderror
      </div>
      <div class="form-group">
        <h3>Price & Inventory</h3>
        <div class="price-fields">
          <div class="form-group">
            <label for="product-price">Product Price (₦)</label>
            <input type="number" id="product-price" name="price" placeholder="Enter price" min="0" step="0.01" value="{{ old('price', $product->price) }}" required>
            @error('price')
              <span class="error-text" style="color: red; font-size: 12px;">{{ $message }}</span>
            @enderror
          </div>
          <div class="form-group">
            <label for="discount-price">Discount Price (₦)</label>
            <input type="number" id="discount-price" name="discount_price" placeholder="Enter discount price" min="0" step="0.01" value="{{ old('discount_price', $product->discount_price) }}">
            @error('discount_price')
              <span class="error-text" style="color: red; font-size: 12px;">{{ $message }}</span>
            @enderror
          </div>
          <div class="form-group">
            <label for="quantity">Quantity in Stock</label>
            <input type="number" id="quantity" name="quantity" placeholder="Enter quantity" min="0" value="{{ old('quantity', $product->quantity) }}" required>
            @error('quantity')
              <span class="error-text" style="color: red; font-size: 12px;">{{ $message }}</span>
            @enderror
          </div>
        </div>
        <div class="toggle-group">
          <label for="is-active">Product is Active</label>
          <input type="checkbox" id="is-active" name="is_active" class="toggle" {{ old('is_active', $product->is_active) ? 'checked' : '' }} value="1">
        </div>
      </div>
    </section>
    <section class="categories">
      <h2>Category</h2>
      <div class="form-group">
        <label for="product-category">Select Category</label>
        <select id="product-category" name="product_category_id" required>
          <option value="">Choose a category</option>
          @if(isset($categories))
            @foreach($categories as $category)
              <option value="{{ $category->id }}" {{ old('product_category_id', $product->product_category_id) == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
              </option>
            @endforeach
          @endif
        </select>
        @error('product_category_id')
          <span class="error-text" style="color: red; font-size: 12px;">{{ $message }}</span>
        @enderror
      </div>
      <a href="{{ route('admin.categories.create') }}" class="create-new" style="display: inline-block; padding: 8px 16px; background: #007bff; color: white; text-decoration: none; border-radius: 4px;">Create New Category</a>
    </section>
    <section class="tags">
      <h2>Tags</h2>
      <div class="form-group">
        <label for="tag-input">Add Tags</label>
        <input type="text" id="tag-input" placeholder="Enter tag name">
      </div>
      <div class="tag-list">
        <span class="tag">Free Installation <button type="button" class="remove-tag">×</button></span>
        <span class="tag">Free Gift <button type="button" class="remove-tag">×</button></span>
        <span class="tag">New <button type="button" class="remove-tag">×</button></span>
        <span class="tag">Hot Sale <button type="button" class="remove-tag">×</button></span>
      </div>
    </section>
    <section class="seo-settings">
      <h2>SEO Settings</h2>
      <div class="form-group">
        <label for="seo-title">Title</label>
        <input type="text" id="seo-title" placeholder="Enter SEO title">
      </div>
      <div class="form-group">
        <label for="seo-description">Description</label>
        <textarea id="seo-description" placeholder="Enter SEO description" rows="4"></textarea>
      </div>
    </section>
    <div class="form-actions" style="display: flex; gap: 15px; margin-top: 20px;">
      <button type="submit" class="submit-button">Update Product</button>
      <a href="{{ route('admin.products') }}" class="btn btn-secondary" style="background: #6c757d; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; display: inline-block;">Cancel</a>
    </div>
  </form>

</div>
@endsection

@section('script')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Show validation errors with SweetAlert
      @if($errors->any())
        var errorMessages = [];
        @foreach($errors->all() as $error)
          errorMessages.push('{!! addslashes($error) !!}');
        @endforeach
        
        Swal.fire({
          icon: 'error',
          title: 'Validation Error!',
          html: errorMessages.join('<br>'),
          confirmButtonText: 'OK'
        });
      @endif
      
      // Show success message
      @if(session('success'))
        Swal.fire({
          icon: 'success',
          title: 'Success!',
          text: '{!! addslashes(session('success')) !!}',
          timer: 3000,
          showConfirmButton: false
        });
      @endif
      
      // Show error message
      @if(session('error'))
        Swal.fire({
          icon: 'error',
          title: 'Error!',
          text: '{!! addslashes(session('error')) !!}',
          confirmButtonText: 'OK'
        });
      @endif
    });
    
    const uploadArea = document.getElementById('upload-area');
    const fileInput = document.getElementById('image-upload');
    const uploadButton = document.getElementById('upload-button');
    const filePreview = document.getElementById('file-preview');

    uploadButton.addEventListener('click', () => fileInput.click());

    uploadArea.addEventListener('dragover', (e) => {
      e.preventDefault();
      uploadArea.classList.add('dragover');
    });

    uploadArea.addEventListener('dragleave', () => {
      uploadArea.classList.remove('dragover');
    });

    uploadArea.addEventListener('drop', (e) => {
      e.preventDefault();
      uploadArea.classList.remove('dragover');
      const files = e.dataTransfer.files;
      handleFiles(files);
    });

    fileInput.addEventListener('change', () => {
      handleFiles(fileInput.files);
    });

    function handleFiles(files) {
      filePreview.innerHTML = '';
      for (const file of files) {
        if (file.type.startsWith('image/')) {
          const fileName = document.createElement('p');
          fileName.textContent = file.name;
          filePreview.appendChild(fileName);
        }
      }
    }
    
    // Form validation before submission
    document.querySelector('.product-form').addEventListener('submit', function(e) {
      const name = document.getElementById('product-name').value.trim();
      const description = document.getElementById('product-description').value.trim();
      const price = document.getElementById('product-price').value;
      const quantity = document.getElementById('quantity').value;
      const category = document.getElementById('product-category').value;
      
      if (!name || !description || !price || !quantity || !category) {
        e.preventDefault();
        Swal.fire({
          icon: 'warning',
          title: 'Missing Information!',
          text: 'Please fill in all required fields.',
          confirmButtonText: 'OK'
        });
        return false;
      }
      
      if (parseFloat(price) <= 0) {
        e.preventDefault();
        Swal.fire({
          icon: 'warning',
          title: 'Invalid Price!',
          text: 'Product price must be greater than 0.',
          confirmButtonText: 'OK'
        });
        return false;
      }
      
      if (parseInt(quantity) < 0) {
        e.preventDefault();
        Swal.fire({
          icon: 'warning',
          title: 'Invalid Quantity!',
          text: 'Quantity cannot be negative.',
          confirmButtonText: 'OK'
        });
        return false;
      }
    });
  </script>
@endsection