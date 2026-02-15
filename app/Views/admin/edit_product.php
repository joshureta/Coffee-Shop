<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - Coffee Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: #f5f1eb;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .coffee-sidebar {
            min-height: 100vh;
            background: linear-gradient(135deg, #3e2723 0%, #5d4037 100%);
            width: 280px;
            position: fixed;
            left: 0;
            top: 0;
            box-shadow: 4px 0 20px rgba(0,0,0,0.3);
            z-index: 1000;
            border-right: 1px solid #4e342e;
        }
        
        .sidebar-brand {
            padding: 30px 25px;
            border-bottom: 1px solid #4e342e;
            text-align: center;
            background: rgba(0,0,0,0.2);
        }
        
        .sidebar-brand h3 {
            color: #d7ccc8;
            margin: 0;
            font-weight: 600;
            font-size: 1.6rem;
            letter-spacing: 0.5px;
        }
        
        .sidebar-brand p {
            color: #bcaaa4;
            margin: 8px 0 0 0;
            font-size: 0.9rem;
            opacity: 0.8;
        }
        
        .sidebar-nav {
            padding: 25px 0;
        }
        
        .nav-item {
            margin: 8px 20px;
        }
        
        .nav-link {
            color: #d7ccc8;
            padding: 14px 20px;
            border-radius: 10px;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            border-left: 4px solid transparent;
            font-weight: 500;
        }
        
        .nav-link:hover {
            background: rgba(121, 85, 72, 0.3);
            color: #efebe9;
            border-left: 4px solid #8d6e63;
            transform: translateX(5px);
        }
        
        .nav-link.active {
            background: rgba(121, 85, 72, 0.4);
            color: #efebe9;
            border-left: 4px solid #a1887f;
        }
        
        .nav-link i {
            width: 25px;
            font-size: 1.1rem;
            margin-right: 12px;
            opacity: 0.9;
        }
        
        .main-content {
            margin-left: 280px;
            padding: 35px;
            min-height: 100vh;
        }
        
        .content-header {
            background: linear-gradient(135deg, #5d4037, #795548);
            color: #efebe9;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 6px 20px rgba(93, 64, 55, 0.4);
            border: 1px solid #6d4c41;
        }
        
        .content-header h1 {
            margin: 0;
            font-weight: 600;
            font-size: 2.2rem;
        }
        
        .content-header p {
            margin: 8px 0 0 0;
            opacity: 0.9;
            font-size: 1.1rem;
        }
        
        .btn-back {
            background: linear-gradient(135deg, #8d6e63, #795548);
            border: none;
            color: white;
            padding: 12px 25px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(141, 110, 99, 0.3);
        }
        
        .btn-back:hover {
            background: linear-gradient(135deg, #7a5c52, #6d4c41);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(141, 110, 99, 0.4);
        }
        
        .btn-save {
            background: linear-gradient(135deg, #388e3c, #2e7d32);
            border: none;
            color: white;
            padding: 12px 25px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(56, 142, 60, 0.3);
        }
        
        .btn-save:hover {
            background: linear-gradient(135deg, #2e7d32, #1b5e20);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(56, 142, 60, 0.4);
        }
        
        .btn-cancel {
            background: linear-gradient(135deg, #757575, #616161);
            border: none;
            color: white;
            padding: 12px 25px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-cancel:hover {
            background: linear-gradient(135deg, #616161, #424242);
            color: white;
            transform: translateY(-2px);
        }
        
        .form-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
            overflow: hidden;
            border: 1px solid #e0e0e0;
        }
        
        .form-header {
            background: linear-gradient(135deg, #4e342e, #6d4c41);
            color: #efebe9;
            padding: 25px;
            border-bottom: 1px solid #5d4037;
        }
        
        .form-header h3 {
            margin: 0;
            font-weight: 600;
        }
        
        .form-body {
            padding: 30px;
        }
        
        .form-label {
            color: #5d4037;
            font-weight: 600;
            margin-bottom: 8px;
        }
        
        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #fafafa;
        }
        
        .form-control:focus {
            border-color: #8d6e63;
            box-shadow: 0 0 0 0.2rem rgba(141, 110, 99, 0.25);
            background: white;
        }
        
        .form-textarea {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #fafafa;
            resize: vertical;
            min-height: 120px;
        }
        
        .form-textarea:focus {
            border-color: #8d6e63;
            box-shadow: 0 0 0 0.2rem rgba(141, 110, 99, 0.25);
            background: white;
        }
        
        .form-check-input {
            width: 20px;
            height: 20px;
            border: 2px solid #8d6e63;
            border-radius: 4px;
        }
        
        .form-check-input:checked {
            background-color: #5d4037;
            border-color: #5d4037;
        }
        
        .form-check-label {
            color: #5d4037;
            font-weight: 500;
            margin-left: 8px;
        }
        
        .current-image {
            border-radius: 10px;
            border: 3px solid #e0e0e0;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        
        .current-image:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        }
        
        .image-preview-container {
            text-align: center;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 10px;
            border: 2px dashed #8d6e63;
        }
        
        .alert {
            border: none;
            border-radius: 12px;
            padding: 18px 22px;
            margin-bottom: 25px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border-left: 5px solid;
        }
        
        .alert-danger {
            background: linear-gradient(135deg, #ffebee, #ffcdd2);
            color: #c62828;
            border-left-color: #f44336;
        }
        
        @media (max-width: 992px) {
            .coffee-sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            
            .main-content {
                margin-left: 0;
                padding: 25px;
            }
            
            .sidebar-nav {
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
                padding: 20px;
            }
            
            .nav-item {
                margin: 5px 10px;
            }
            
            .nav-link {
                border-left: none;
                border-bottom: 3px solid transparent;
                padding: 12px 15px;
            }
            
            .nav-link:hover,
            .nav-link.active {
                border-left: none;
                border-bottom: 3px solid #8d6e63;
                transform: translateY(-2px);
            }
        }
        
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #8d6e63, #6d4c41);
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #7a5c52, #5d4037);
        }
    </style>
</head>
<body>
    <!-- Sidebar Navigation -->
    <div class="coffee-sidebar">
        <div class="sidebar-brand">
            <h3><i class="fas fa-coffee"></i>Brew Haven</h3>
            <p>Administration Panel</p>
        </div>
        <div class="sidebar-nav">
            <div class="nav-item">
                <a class="nav-link" href="/admin/users">
                    <i class="fas fa-users"></i>
                    User Management
                </a>
            </div>
            <div class="nav-item">
                <!-- Active link for current page -->
                <a class="nav-link active" href="/admin/products">
                    <i class="fas fa-coffee"></i>
                    Product Management
                </a>
            </div>
            <div class="nav-item">
                <a class="nav-link" href="/logout">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="main-content">
        <!-- Page Header -->
        <div class="content-header">
            <div class="row align-items-center">
                <div class="col">
                    <h1><i class="fas fa-edit"></i> Edit Product</h1>
                    <p>Update product information and settings</p>
                </div>
                <div class="col-auto">
                    <!-- Back button to return to products list -->
                    <a href="/admin/products" class="btn btn-back">
                        <i class="fas fa-arrow-left me-2"></i>Back to Products
                    </a>
                </div>
            </div>
        </div>

        <!-- Flash Messages for user feedback -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- Edit Product Form -->
        <div class="form-container">
            <div class="form-header">
                <!-- Display current product name being edited -->
                <h3><i class="fas fa-coffee me-2"></i>Editing: <?= esc($product['name']) ?></h3>
            </div>
            <div class="form-body">
                <!-- Form for updating product data with file upload capability -->
                <form action="/admin/products/update/<?= $product['id'] ?>" method="post" enctype="multipart/form-data">
                    <!-- CSRF protection token -->
                    <?= csrf_field() ?>

                    <div class="row">
                        <div class="col-md-6">
                            <!-- Product Name Input -->
                            <div class="mb-4">
                                <label for="name" class="form-label">Product Name</label>
                                <input type="text" class="form-control" id="name" name="name" value="<?= esc($product['name']) ?>" required>
                            </div>

                            <!-- Price Input -->
                            <div class="mb-4">
                                <label for="price" class="form-label">Price ($)</label>
                                <input type="number" step="0.01" class="form-control" id="price" name="price" value="<?= $product['price'] ?>" required>
                                <div class="form-text">Enter the price in USD</div>
                            </div>

                            <!-- Stock Quantity Input -->
                            <div class="mb-4">
                                <label for="stock" class="form-label">Stock Quantity</label>
                                <input type="number" class="form-control" id="stock" name="stock" value="<?= $product['stock'] ?>" required>
                                <div class="form-text">Current available quantity</div>
                            </div>

                            <!-- Category Input -->
                            <div class="mb-4">
                                <label for="category" class="form-label">Category</label>
                                <input type="text" class="form-control" id="category" name="category" value="<?= esc($product['category']) ?>" required>
                                <div class="form-text">e.g., Coffee, Tea, Bakery</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <!-- Description Textarea -->
                            <div class="mb-4">
                                <label for="description" class="form-label">Description</label>
                                <div class="form-text">Describe the product features and benefits</div>
                                <textarea class="form-textarea" id="description" name="description" rows="4" required><?= esc($product['description']) ?></textarea>
                            </div>

                            <!-- Product Image Upload -->
                            <div class="mb-4">
                                <label for="image" class="form-label">Product Image</label>
                                <?php if ($product['image']): ?>
                                    <!-- Display current image if available -->
                                    <div class="image-preview-container mb-3">
                                        <p class="text-muted mb-2"><strong>Current Image:</strong></p>
                                        <img src="<?= base_url('uploads/products/' . $product['image']) ?>" alt="<?= esc($product['name']) ?>" class="current-image" style="max-width:200px;max-height:200px;">
                                    </div>
                                <?php else: ?>
                                    <!-- Placeholder when no image exists -->
                                    <div class="image-preview-container mb-3">
                                        <i class="fas fa-coffee fa-3x text-muted mb-2"></i>
                                        <p class="text-muted mb-0">No image currently set</p>
                                    </div>
                                <?php endif; ?>
                                <!-- File input for new image -->
                                <input type="file" class="form-control" id="image" name="image" accept="image/*">
                                <div class="form-text">Upload new image (JPG, PNG, max 2MB). Leave empty to keep current image.</div>
                            </div>

                            <!-- Featured Product Checkbox -->
                            <div class="mb-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured" value="1" <?= $product['is_featured'] ? 'checked' : '' ?>>
                                    <label class="form-check-label" for="is_featured"><strong>Featured Product</strong></label>
                                </div>
                                <div class="form-text">Featured products will be highlighted on the main page</div>
                            </div>
                        </div>
                    </div>

                    <!-- Form Action Buttons -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex justify-content-end gap-3">
                                <!-- Cancel button returns to products list -->
                                <a href="/admin/products" class="btn btn-cancel"><i class="fas fa-times me-2"></i>Cancel</a>
                                <!-- Submit button to save changes -->
                                <button type="submit" class="btn btn-save"><i class="fas fa-save me-2"></i>Update Product</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript for interactive components -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Image preview functionality for file upload
        const imageInput = document.getElementById('image');
        const currentImage = document.querySelector('.current-image');

        if(imageInput){
            imageInput.addEventListener('change', function(e){
                const file = e.target.files[0];
                if(file){
                    const reader = new FileReader();
                    reader.onload = function(e){
                        if(currentImage){
                            // Update existing image preview
                            currentImage.src = e.target.result;
                        } else {
                            // Create new image preview if none exists
                            const previewContainer = document.querySelector('.image-preview-container');
                            if(previewContainer){
                                previewContainer.innerHTML = `<p class="text-muted mb-2"><strong>New Image Preview:</strong></p>
                                    <img src="${e.target.result}" alt="Preview" class="current-image" style="max-width:200px;max-height:200px;">`;
                            }
                        }
                    };
                    reader.readAsDataURL(file);
                }
            });
        }

        // Auto-hide flash messages after 5 seconds
        setTimeout(function(){
            document.querySelectorAll('.alert').forEach(function(alert){
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        },5000);
    </script>
</body>
</html>