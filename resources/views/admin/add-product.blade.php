@extends('admin.master')
@section('header')
<link rel="stylesheet" href="{{ url('homepage/css/admin-master.css') }}" />
<link rel="stylesheet" href="{{ url('homepage/css/add-product.css') }}" />
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
        <div class="solar-breadcrumb-item">All-in-one Solutions</div>
    </div>
    <div class="solar-breadcrumb-divider">/</div>
    <div class="solar-breadcrumb-wrapper">
        <p class="solar-breadcrumb-current">Future-h All In One Solution</p>
    </div>
</div>

<div class="dashboard">
  <form class="product-form">
    <section class="information">
      <h2>Information</h2>
      <div class="form-group">
        <label for="product-name">Product Name</label>
        <input type="text" id="product-name" placeholder="Enter product name" required>
      </div>
      <div class="form-group">
        <label for="product-description">Product Description</label>
        <textarea id="product-description" placeholder="Enter product description" rows="4" required></textarea>
      </div>
      <div class="form-group">
        <label>Images</label>
        <div class="upload-area" id="upload-area">
          <input type="file" id="image-upload" accept="image/*" multiple hidden>
          <button type="button" id="upload-button">Add File</button>
          <p>Or drag and drop files</p>
          <div id="file-preview" class="file-preview"></div>
        </div>
      </div>
      <div class="form-group">
        <h3>Price</h3>
        <div class="price-fields">
          <div class="form-group">
            <label for="product-price">Product Price</label>
            <input type="number" id="product-price" placeholder="Enter price" min="0" step="0.01" required>
          </div>
          <div class="form-group">
            <label for="discount-price">Discount Price</label>
            <input type="number" id="discount-price" placeholder="Enter discount price" min="0" step="0.01">
          </div>
        </div>
        <div class="toggle-group">
          <label for="add-tax">Add tax for this product</label>
          <input type="checkbox" id="add-tax" class="toggle">
        </div>
      </div>
    </section>
    <section class="categories">
      <h2>Categories</h2>
      <div class="category-list">
        <label><input type="checkbox" name="category" value="inverters"> Inverters</label>
        <label><input type="checkbox" name="category" value="solar-panels"> Solar Panels</label>
        <label><input type="checkbox" name="category" value="lithium-batteries"> Lithium Batteries</label>
        <label><input type="checkbox" name="category" value="accessories"> Accessories</label>
        <label><input type="checkbox" name="category" value="all-in-one-solutions"> All-in-one Solutions</label>
        <label><input type="checkbox" name="category" value="home-appliances"> Home Appliances</label>
      </div>
      <button type="button" class="create-new">Create New</button>
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
    <button type="submit" class="submit-button">Submit</button>
  </form>

</div>
@endsection

@section('script')
  <script>
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
  </script>
@endsection