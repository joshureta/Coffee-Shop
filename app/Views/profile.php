<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - Brew Haven Coffee Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #f5f1eb 0%, #e8d5cd 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
        }

        .navbar-coffee {
            background: linear-gradient(135deg, #3e2723 0%, #5d4037 100%) !important;
            box-shadow: 0 4px 20px rgba(0,0,0,0.3);
            padding: 15px 0;
        }

        .navbar-brand {
            font-size: 1.8rem;
            font-weight: 700;
            color: #efebe9 !important;
            letter-spacing: 1px;
        }

        .navbar-brand i {
            color: #d7ccc8;
            margin-right: 10px;
        }

        .nav-link {
            color: #d7ccc8 !important;
            font-weight: 500;
            padding: 10px 20px !important;
            border-radius: 8px;
            transition: all 0.3s ease;
            margin: 0 5px;
        }

        .nav-link:hover, .nav-link.active {
            background: rgba(121, 85, 72, 0.3);
            color: #efebe9 !important;
            transform: translateY(-2px);
        }

        .profile-dropdown {
            position: relative;
        }

        .profile-dropdown-toggle {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 15px;
            border-radius: 25px;
            background: rgba(121, 85, 72, 0.2);
            border: 1px solid rgba(215, 204, 200, 0.3);
            transition: all 0.3s ease;
            text-decoration: none;
            color: #efebe9 !important;
        }

        .profile-dropdown-toggle:hover {
            background: rgba(121, 85, 72, 0.4);
            transform: translateY(-2px);
        }

        .profile-pic-small {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #d7ccc8;
        }

        .profile-icon-small {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: rgba(215, 204, 200, 0.3);
            border: 2px solid #d7ccc8;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #d7ccc8;
        }

        .profile-icon-large {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            border: 3px solid white;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.8rem;
            margin-bottom: 15px;
            margin-left: 65px;
        }

        .profile-icon-main {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: linear-gradient(135deg, #f8f4f0, #f0e6e1);
            border: 5px solid #5d4037;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #5d4037;
            font-size: 4rem;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            margin-bottom: 20px;
            margin-left: 370px;
        }

        .username-text {
            font-weight: 600;
            font-size: 0.9rem;
        }

        .dropdown-menu {
            background: white;
            border: none;
            border-radius: 15px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
            padding: 0;
            min-width: 250px;
            margin-top: 15px;
            overflow: hidden;
        }

        .dropdown-header {
            padding: 20px;
            background: linear-gradient(135deg, #5d4037, #4e342e);
            color: white;
            text-align: center;
        }

        .dropdown-header .profile-pic-large {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid white;
            margin-bottom: 15px;
        }

        .user-name {
            font-weight: 700;
            font-size: 1.2rem;
            margin-bottom: 5px;
        }

        .user-email {
            opacity: 0.9;
            font-size: 0.9rem;
        }

        .dropdown-item {
            padding: 15px 20px;
            color: #5d4037;
            font-weight: 500;
            transition: all 0.3s ease;
            border-bottom: 1px solid #f0f0f0;
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .dropdown-item:last-child {
            border-bottom: none;
        }

        .dropdown-item:hover {
            background: linear-gradient(135deg, #f8f4f0, #f0e6e1);
            color: #5d4037;
            padding-left: 25px;
        }

        .dropdown-item i {
            width: 25px;
            margin-right: 12px;
            color: #8d6e63;
            font-size: 1.1rem;
        }

        .dropdown-divider {
            margin: 0;
            border-color: #e0e0e0;
        }

        .welcome-header {
            background: linear-gradient(rgba(93, 64, 55, 0.8), rgba(62, 39, 35, 0.9)), 
                        url('https://images.unsplash.com/photo-1447933601403-0c6688de566e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2000&q=80');
            background-size: cover;
            background-position: center;
            color: #efebe9;
            padding: 60px 0;
            margin-bottom: 40px;
            border-radius: 0 0 30px 30px;
            box-shadow: 0 10px 30px rgba(93, 64, 55, 0.4);
            position: relative;
            overflow: hidden;
        }

        .welcome-content {
            position: relative;
            z-index: 2;
            text-align: center;
        }

        .welcome-content h2 {
            font-weight: 700;
            margin-bottom: 15px;
            font-size: 2.5rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
        }

        .profile-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
            padding: 40px;
            margin-bottom: 30px;
            border: 1px solid #e0e0e0;
        }

        .profile-picture-section {
            text-align: center;
            padding: 30px;
            background: linear-gradient(135deg, #f8f4f0, #f0e6e1);
            border-radius: 15px;
            margin-bottom: 30px;
        }

        .profile-picture {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            object-fit: cover;
            border: 5px solid #5d4037;
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
            margin-bottom: 20px;
        }

        .form-section {
            background: linear-gradient(135deg, #f8f4f0, #f0e6e1);
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 25px;
            border: 1px solid #e0d6d0;
        }

        .btn-coffee {
            background: linear-gradient(135deg, #5d4037, #4e342e);
            border: none;
            color: white;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-coffee:hover {
            background: linear-gradient(135deg, #4e342e, #3e2723);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(93, 64, 55, 0.4);
        }

        .btn-outline-coffee {
            border: 2px solid #5d4037;
            color: #5d4037;
            background: transparent;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-outline-coffee:hover {
            background: #5d4037;
            color: white;
            transform: translateY(-2px);
        }

        .text-coffee {
            color: #5d4037;
        }

        .alert {
            border: none;
            border-radius: 12px;
            padding: 18px 22px;
            margin-bottom: 25px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border-left: 5px solid;
        }

        .alert-success {
            background: linear-gradient(135deg, #e8f5e8, #dcedc8);
            color: #2e7d32;
            border-left-color: #4caf50;
        }

        .alert-danger {
            background: linear-gradient(135deg, #ffebee, #ffcdd2);
            color: #c62828;
            border-left-color: #f44336;
        }

        .form-control {
            border: 2px solid #e0d6d0;
            border-radius: 8px;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #5d4037;
            box-shadow: 0 0 0 0.2rem rgba(93, 64, 55, 0.25);
        }

        .form-label {
            font-weight: 600;
            color: #5d4037;
            margin-bottom: 8px;
        }

        .floating-bean {
            position: absolute;
            width: 20px;
            height: 12px;
            background: #8d6e63;
            border-radius: 50%;
            opacity: 0.1;
            animation: float 8s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-10px) rotate(180deg); }
        }

        .navbar-right-items {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        /* Desktop Navigation */
        .desktop-nav {
            display: flex;
        }

        /* Mobile Navigation in Dropdown */
        .mobile-nav-items {
            display: none;
        }

        @media (max-width: 1006px) {
            .welcome-header {
                padding: 40px 0;
            }
            
            .welcome-content h2 {
                font-size: 2rem;
            }
            
            .profile-container {
                padding: 20px;
            }
            
            .profile-picture-section {
                padding: 20px;
            }
            
            .profile-icon-main {
                width: 150px;
                height: 150px;
                font-size: 3rem;
                margin-left: 0;
            }
            
            .profile-picture {
                width: 150px;
                height: 150px;
            }
            
            .form-section {
                padding: 20px;
            }
            
            .desktop-nav {
                display: none;
            }
            
            .mobile-nav-items {
                display: block;
            }
            
            .username-text {
                display: none;
            }
            
            .navbar-right-items {
                gap: 5px;
            }
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-coffee">
        <div class="container">
            <!-- Brand/Logo -->
            <a class="navbar-brand" href="/dashboard">
                <i class="fas fa-coffee"></i> Brew Haven
            </a>
            
            <!-- Desktop Navigation Menu -->
            <div class="desktop-nav navbar-right-items">
                <div class="navbar-nav mx-auto">
                    <!-- Home link -->
                    <a class="nav-link" href="/dashboard">
                        <i class="fas fa-home me-1"></i>Home
                    </a>
                    <!-- Cart link with item count badge -->
                    <a class="nav-link" href="/cart">
                        <i class="fas fa-shopping-cart me-1"></i>Cart
                        <?php if ($cart_count > 0): ?>
                            <span class="badge bg-danger"><?= $cart_count ?></span>
                        <?php endif; ?>
                    </a>
                </div>
                
                <!-- User Profile Dropdown (Desktop) -->
                <div class="dropdown profile-dropdown">
                    <a class="profile-dropdown-toggle dropdown-toggle" href="#" role="button" 
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <!-- Profile picture or placeholder icon -->
                        <?php if (session()->get('profile_picture')): ?>
                            <img src="/uploads/profile_pics/<?= session()->get('profile_picture') ?>" 
                                 class="profile-pic-small" 
                                 onerror="this.src='https://via.placeholder.com/32'"
                                 alt="Profile">
                        <?php else: ?>
                            <div class="profile-icon-small">
                                <i class="fas fa-user"></i>
                            </div>
                        <?php endif; ?>
                        <span class="username-text"><?= session()->get('username') ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <!-- User info section in dropdown -->
                        <li class="dropdown-header">
                            <?php if (session()->get('profile_picture')): ?>
                                <img src="/uploads/profile_pics/<?= session()->get('profile_picture') ?>" 
                                     class="profile-pic-large" 
                                     onerror="this.src='https://via.placeholder.com/70'"
                                     alt="Profile">
                            <?php else: ?>
                                <div class="profile-icon-large">
                                    <i class="fas fa-user"></i>
                                </div>
                            <?php endif; ?>
                            <div class="user-name"><?= session()->get('username') ?></div>
                            <div class="user-email"><?= session()->get('email') ?></div>
                        </li>
                        
                        <!-- Navigation links in dropdown -->
                        <li><a class="dropdown-item" href="/profile">
                            <i class="fas fa-user"></i>My Profile
                        </a></li>                
                        <li><a class="dropdown-item" href="/orders">
                            <i class="fas fa-history"></i>Orders
                        </a></li>
                        
                        <li><hr class="dropdown-divider"></li>
                        
                        <!-- Logout link -->
                        <li><a class="dropdown-item" href="/logout">
                            <i class="fas fa-sign-out-alt"></i>Logout
                        </a></li>
                    </ul>
                </div>
            </div>

            <!-- Mobile Navigation -->
            <div class="mobile-nav-items">
                <div class="dropdown profile-dropdown">
                    <a class="profile-dropdown-toggle dropdown-toggle" href="#" role="button" 
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <!-- Mobile profile picture/icon -->
                        <?php if (session()->get('profile_picture')): ?>
                            <img src="/uploads/profile_pics/<?= session()->get('profile_picture') ?>" 
                                 class="profile-pic-small" 
                                 onerror="this.src='https://via.placeholder.com/32'"
                                 alt="Profile">
                        <?php else: ?>
                            <div class="profile-icon-small">
                                <i class="fas fa-user"></i>
                            </div>
                        <?php endif; ?>
                        <span class="username-text"><?= session()->get('username') ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <!-- Mobile user info section -->
                        <li class="dropdown-header">
                            <?php if (session()->get('profile_picture')): ?>
                                <img src="/uploads/profile_pics/<?= session()->get('profile_picture') ?>" 
                                     class="profile-pic-large" 
                                     onerror="this.src='https://via.placeholder.com/70'"
                                     alt="Profile">
                            <?php else: ?>
                                <div class="profile-icon-large">
                                    <i class="fas fa-user"></i>
                                </div>
                            <?php endif; ?>
                            <div class="user-name"><?= session()->get('username') ?></div>
                            <div class="user-email"><?= session()->get('email') ?></div>
                        </li>
                        
                        <!-- Mobile navigation links -->
                        <li><a class="dropdown-item" href="/dashboard">
                            <i class="fas fa-home"></i>Home
                        </a></li>
                        <li><a class="dropdown-item" href="/cart">
                            <i class="fas fa-shopping-cart"></i>Cart
                            <?php if ($cart_count > 0): ?>
                                <span class="badge bg-danger float-end"><?= $cart_count ?></span>
                            <?php endif; ?>
                        </a></li>
                        
                        <li><hr class="dropdown-divider"></li>
                        
                        <!-- Profile and order links -->
                        <li><a class="dropdown-item active" href="/profile">
                            <i class="fas fa-user"></i>My Profile
                        </a></li>                
                        <li><a class="dropdown-item" href="/orders">
                            <i class="fas fa-history"></i>Orders
                        </a></li>
                        
                        <li><hr class="dropdown-divider"></li>
                        
                        <!-- Logout link -->
                        <li><a class="dropdown-item" href="/logout">
                            <i class="fas fa-sign-out-alt"></i>Logout
                        </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Page Header Section -->
    <div class="welcome-header">
        <div class="container">
            <div class="welcome-content">
                <h2>Edit Profile <i class="fas fa-user-edit"></i></h2>
                <p class="mb-0">Manage your account information and profile picture</p>
            </div>
        </div>
    </div>

    <div class="container">
        <!-- Success Message Display -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle me-2"></i>
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <!-- Error Message Display -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle me-2"></i>
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- Profile Management Container -->
        <div class="profile-container">
            <!-- Decorative floating coffee beans -->
            <div class="floating-bean" style="top: 10%; left: 5%; animation-delay: 0s;"></div>
            <div class="floating-bean" style="bottom: 10%; right: 5%; animation-delay: 3s;"></div>
            
            <!-- Current Profile Picture Section -->
            <div class="profile-picture-section">
                <h4 class="text-coffee mb-4">Current Profile Picture</h4>
                <!-- Display current profile picture or placeholder -->
                <?php if (!empty($user['profile_picture'])): ?>
                    <img src="/uploads/profile_pics/<?= $user['profile_picture'] ?>" 
                         class="profile-picture"
                         onerror="this.src='https://via.placeholder.com/200'"
                         alt="Profile Picture">
                <?php else: ?>
                    <div class="profile-icon-main">
                        <i class="fas fa-user"></i>
                    </div>
                <?php endif; ?>
                
                <!-- Remove profile picture button (only shows if picture exists) -->
                <?php if (!empty($user['profile_picture'])): ?>
                    <div class="mt-3">
                        <form action="/profile/deleteProfilePicture" method="post" class="d-inline">
                            <?= csrf_field() ?>
                            <button type="submit" class="btn btn-outline-coffee" 
                                    onclick="return confirm('Are you sure you want to remove your profile picture?')">
                                <i class="fas fa-trash me-2"></i>Remove Picture
                            </button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Update Profile Picture Form -->
            <div class="form-section">
                <h4 class="text-coffee mb-4">
                    <i class="fas fa-camera me-2"></i>Upload New Profile Picture
                </h4>
                <form action="/profile/update" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label">Select Image File</label>
                        <!-- File input for profile picture -->
                        <input type="file" name="profile_picture" class="form-control" 
                               accept="image/jpg,image/jpeg,image/png,image/gif,image/webp" required>
                        <div class="form-text">
                            <i class="fas fa-info-circle me-1"></i>
                            Select an image file (JPG, PNG, GIF, WEBP) - Max 2MB. Image will be automatically resized to 200x200 pixels.
                        </div>
                    </div>
                    <!-- Upload button -->
                    <button type="submit" class="btn btn-coffee">
                        <i class="fas fa-upload me-2"></i>Upload Picture
                    </button>
                </form>
            </div>

            <!-- Update Username Form -->
            <div class="form-section">
                <h4 class="text-coffee mb-4">
                    <i class="fas fa-user me-2"></i>Update Username
                </h4>
                <form action="/profile/updateUsername" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <!-- Username input with current value -->
                        <input type="text" name="username" class="form-control" 
                               value="<?= esc($user['username']) ?>" required>
                        <div class="form-text">
                            <i class="fas fa-info-circle me-1"></i>
                            Username must be 3-30 characters long and unique.
                        </div>
                    </div>
                    <!-- Update username button -->
                    <button type="submit" class="btn btn-coffee">
                        <i class="fas fa-save me-2"></i>Update Username
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-hide alerts after 5 seconds
            setTimeout(function() {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(function(alert) {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);

            // File input validation for profile picture upload
            const fileInput = document.querySelector('input[type="file"]');
            if (fileInput) {
                fileInput.addEventListener('change', function() {
                    const file = this.files[0];
                    if (file) {
                        const fileSize = file.size / 1024 / 1024; // Convert to MB
                        const validTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/gif', 'image/webp'];
                        
                        // Validate file type
                        if (!validTypes.includes(file.type)) {
                            alert('Please select a valid image file (JPG, PNG, GIF, WEBP).');
                            this.value = '';
                        } else if (fileSize > 2) {
                            // Validate file size
                            alert('File size must be less than 2MB.');
                            this.value = '';
                        }
                    }
                });
            }
        });
    </script>
</body>
</html>