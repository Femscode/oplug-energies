@extends('admin.master')
@section('header')
<link rel="stylesheet" href="{{ url('homepage/css/admin-master.css') }}" />
<link rel="stylesheet" href="{{ url('homepage/css/settings.css') }}" />
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


<div class="solar-account">
    <!-- Sidebar -->
    <div class="solar-account-sidebar">
        <button class="solar-account-sidebar-toggle">☰ Menu</button>
        <div class="solar-account-user">
            <div class="solar-account-user-name">Admin Dashboard</div>
            <div class="solar-account-user-email">bkjones@gmail.com</div>
        </div>
        <div class="solar-account-tabs">
            <div class="solar-account-tab solar-account-tab-active" data-tab="account-info">
                <div class="solar-account-tab-text">Dashboard</div>
                <div class="solar-account-tab-icon">→</div>
            </div>
            <div class="solar-account-tab" data-tab="my-order">
                <div class="solar-account-tab-text">Orders</div>
                <div class="solar-account-tab-icon">→</div>
            </div>
            <div class="solar-account-tab" data-tab="products">
                <div class="solar-account-tab-text">Products</div>
                <div class="solar-account-tab-icon">→</div>
            </div>
            <div class="solar-account-tab" data-tab="settings">
                <div class="solar-account-tab-text">Settings</div>
                <div class="solar-account-tab-icon">→</div>
            </div>
            <div class="solar-account-tab" data-tab="change-password">
                <div class="solar-account-tab-text">Change Password</div>
                <div class="solar-account-tab-icon">→</div>
            </div>
        </div>
    </div>

    <!-- Change Password Form -->

        <div class="dashboard">
            <form class="settings-form">
                <h1>Settings</h1>
                <section class="profile-picture">
                    <h2>Profile Picture</h2>
                    <div class="form-group">
                        <div class="upload-area" id="upload-area">
                            <input type="file" id="image-upload" accept="image/*" hidden>
                            <button type="button" id="upload-button">Upload Image</button>
                            <p>Or drag and drop an image</p>
                            <div id="file-preview" class="file-preview"></div>
                        </div>
                    </div>
                </section>
                <section class="personal-info">
                    <h2>Personal Information</h2>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="first-name">First Name <span class="required">*</span></label>
                            <input type="text" id="first-name" value="Mark" required>
                        </div>
                        <div class="form-group">
                            <label for="last-name">Last Name <span class="required">*</span></label>
                            <input type="text" id="last-name" value="Cole" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address <span class="required">*</span></label>
                        <input type="email" id="email" value="info@oplugenergy.com" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number (Optional)</label>
                        <input type="tel" id="phone" value="+2341234567890">
                    </div>
                    <div class="form-group">
                        <label for="address">Default Address <span class="required">*</span></label>
                        <input type="text" id="address" value="81, Mobolaji Bank Anthony Way, Ikeja, Lagos, Nigeria" required>
                    </div>
                </section>
             
                <button type="submit" class="save-button">Save</button>
            </form>
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
        </div>
   
</div>




@endsection

@section('script')

@endsection