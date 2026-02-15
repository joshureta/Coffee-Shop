<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Brew Haven Coffee Shop</title>
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
            background-attachment: fixed;
            color: #efebe9;
            padding: 80px 0;
            margin-bottom: 40px;
            border-radius: 0 0 30px 30px;
            box-shadow: 0 10px 30px rgba(93, 64, 55, 0.4);
            position: relative;
            overflow: hidden;
        }

        .welcome-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M0,0 L100,0 L100,100 Z" fill="rgba(255,255,255,0.1)"/></svg>');
            background-size: cover;
            opacity: 0.3;
        }

        .welcome-content {
            position: relative;
            z-index: 2;
            text-align: center;
        }

        .welcome-content h2 {
            font-weight: 700;
            margin-bottom: 15px;
            font-size: 3rem;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            letter-spacing: 1px;
        }

        .welcome-content p {
            font-size: 1.3rem;
            margin-bottom: 20px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
            opacity: 0.95;
        }

        .user-badge {
            background: linear-gradient(135deg, rgba(255,255,255,0.2), rgba(255,255,255,0.1));
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.3);
            padding: 12px 25px;
            border-radius: 25px;
            font-weight: 600;
            display: inline-block;
            margin-top: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
        }

        .user-badge:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(0,0,0,0.3);
            background: linear-gradient(135deg, rgba(255,255,255,0.25), rgba(255,255,255,0.15));
        }

        @keyframes floatHeader {
            0%, 100% { transform: translateY(0px) rotate(0deg) scale(1); }
            33% { transform: translateY(-15px) rotate(120deg) scale(1.1); }
            66% { transform: translateY(10px) rotate(240deg) scale(0.9); }
        }

        .floating-bean-header {
            position: absolute;
            width: 25px;
            height: 15px;
            background: rgba(255,255,255,0.3);
            border-radius: 50%;
            animation: floatHeader 8s ease-in-out infinite;
            z-index: 1;
        }

        .stats-container {
            margin-bottom: 40px;
        }

        .stats-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
            border-left: 5px solid;
            transition: all 0.3s ease;
            height: 100%;
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.15);
        }

        .stats-card.orders {
            border-left-color: #8d6e63;
        }

        .stats-card.favorites {
            border-left-color: #795548;
        }

        .stats-card.rewards {
            border-left-color: #5d4037;
        }

        .stats-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
            opacity: 0.9;
        }

        .stats-number {
            font-size: 2.2rem;
            font-weight: 700;
            color: #5d4037;
            margin-bottom: 5px;
        }

        .stats-label {
            color: #795548;
            font-weight: 600;
            font-size: 1rem;
        }

        .menu-header {
            color: #5d4037;
            font-weight: 700;
            margin-bottom: 30px;
            text-align: center;
            font-size: 2.2rem;
        }

        .coffee-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
            padding: 25px;
            border: 1px solid #e0e0e0;
            transition: all 0.3s ease;
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .coffee-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.15);
        }

        .coffee-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(135deg, #8d6e63, #5d4037);
        }

        .coffee-image {
            width: 100%;
            height: 180px;
            background: linear-gradient(135deg, #f5f1eb, #e8d5cd);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            overflow: hidden;
            position: relative;
        }

        .coffee-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .coffee-card:hover .coffee-image img {
            transform: scale(1.05);
        }

        .coffee-icon {
            font-size: 3.5rem;
            color: #8d6e63;
            opacity: 0.8;
        }

        .coffee-name {
            color: #5d4037;
            font-weight: 700;
            font-size: 1.3rem;
            margin-bottom: 10px;
        }

        .coffee-description {
            color: #666;
            font-size: 0.95rem;
            margin-bottom: 15px;
            line-height: 1.5;
        }

        .coffee-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: #5d4037;
            margin-bottom: 20px;
        }

        .btn-order {
            background: linear-gradient(135deg, #5d4037, #4e342e);
            border: none;
            color: white;
            padding: 12px 25px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(93, 64, 55, 0.3);
            width: 100%;
        }

        .btn-order:hover {
            background: linear-gradient(135deg, #4e342e, #3e2723);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(93, 64, 55, 0.4);
        }

        .quick-actions {
            margin: 40px 0;
        }

        .action-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            height: 100%;
            border: 1px solid #e0e0e0;
        }

        .action-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.15);
        }

        .action-icon {
            font-size: 2.5rem;
            color: #8d6e63;
            margin-bottom: 15px;
        }

        .action-title {
            color: #5d4037;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .action-description {
            color: #666;
            font-size: 0.9rem;
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

        .modal-coffee .modal-content {
            border-radius: 25px;
            border: none;
            box-shadow: 0 15px 40px rgba(0,0,0,0.3);
        }

        .modal-coffee .modal-header {
            background: linear-gradient(135deg, #5d4037, #4e342e);
            color: white;
            border-radius: 20px 20px 0 0;
            border: none;
            padding: 25px;
        }

        .modal-coffee .modal-body {
            padding: 30px;
        }

        .modal-coffee .modal-footer {
            border: none;
            padding: 25px;
            border-radius: 0 0 20px 20px;
        }

        .btn-modal-primary {
            background: linear-gradient(135deg, #5d4037, #4e342e);
            border: none;
            color: white;
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-modal-primary:hover {
            background: linear-gradient(135deg, #4e342e, #3e2723);
            color: white;
            transform: translateY(-2px);
        }

        .btn-modal-secondary {
            background: linear-gradient(135deg, #8d6e63, #795548);
            border: none;
            color: white;
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-modal-secondary:hover {
            background: linear-gradient(135deg, #795548, #6d4c41);
            color: white;
            transform: translateY(-2px);
        }

        .order-details {
            background: #fafafa;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            gap: 15px;
            margin: 20px 0;
        }

        .quantity-btn {
            background: #8d6e63;
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .quantity-btn:hover {
            background: #5d4037;
            transform: scale(1.1);
        }

        .quantity-display {
            font-size: 1.3rem;
            font-weight: 700;
            color: #5d4037;
            min-width: 50px;
            text-align: center;
        }

        .special-offer {
            background: linear-gradient(135deg, #ff9800, #f57c00);
            color: white;
            padding: 15px;
            border-radius: 12px;
            margin: 20px 0;
            text-align: center;
            font-weight: 600;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-10px) rotate(180deg); }
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

        .stock-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: linear-gradient(135deg, #4caf50, #45a049);
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.7rem;
            font-weight: 600;
            z-index: 2;
        }

        .featured-badge {
            position: absolute;
            top: 45px;
            left: 15px;
            background: linear-gradient(135deg, #ff9800, #f57c00);
            color: white;
            padding: 5px 10px;
            border-radius: 15px;
            font-size: 0.7rem;
            font-weight: 600;
            z-index: 2;
        }

        .out-of-stock {
            opacity: 0.7;
        }

        .out-of-stock .coffee-image {
            filter: grayscale(0.5);
        }

        .checkout-section {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin: 30px 0;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        }

        .checkout-btn {
            background: linear-gradient(135deg, #28a745, #20c997);
            border: none;
            color: white;
            padding: 15px 30px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
            width: 100%;
        }

        .checkout-btn:hover {
            background: linear-gradient(135deg, #20c997, #1e9e6e);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(40, 167, 69, 0.4);
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

        @media (max-width: 1008px) {
            .welcome-header {
                padding: 60px 0;
            }
            
            .welcome-content h2 {
                font-size: 2.2rem;
            }
            
            .welcome-content p {
                font-size: 1.1rem;
            }
            
            .stats-card {
                margin-bottom: 20px;
            }
            
            .coffee-card {
                margin-bottom: 25px;
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
            
            .profile-icon-large {
                margin-left: 0;
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
        </div>
    </nav>

    <!-- Welcome Header with Decorative Elements -->
    <div class="welcome-header">
        <!-- Animated floating coffee beans -->
        <div class="floating-bean-header" style="top: 20%; left: 10%; animation-delay: 0s;"></div>
        <div class="floating-bean-header" style="top: 60%; right: 15%; animation-delay: 2s;"></div>
        <div class="floating-bean-header" style="top: 80%; left: 20%; animation-delay: 4s;"></div>
        <div class="floating-bean-header" style="top: 30%; right: 25%; animation-delay: 6s;"></div>
        
        <div class="container">
            <div class="welcome-content">
                <!-- Personalized welcome message -->
                <h2>Welcome back, <?= session()->get('username') ?>! <i class="fas fa-mug-hot"></i></h2>
                <p class="mb-0">Ready for your next coffee adventure?</p>
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

        <!-- Quick Checkout Section (Shows only when cart has items) -->
        <?php if ($cart_count > 0): ?>
        <div class="checkout-section">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <!-- Cart summary -->
                    <h4 style="color: #5d4037;">
                        <i class="fas fa-shopping-cart me-2"></i>
                        You have <?= $cart_count ?> item(s) in your cart
                    </h4>
                    <p class="text-muted mb-0">Ready to complete your order?</p>
                </div>
                <div class="col-md-4 text-end">
                    <!-- Checkout button -->
                    <a href="/cart" class="btn checkout-btn">
                        <i class="fas fa-credit-card me-2"></i>
                        Proceed to Checkout
                    </a>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- Statistics Section -->
        <div class="stats-container">
            <div class="row">
                <!-- Available Products Stat -->
                <div class="col-md-4 mb-4">
                    <div class="stats-card orders">
                        <i class="fas fa-shopping-bag stats-icon"></i>
                        <div class="stats-number"><?= count($products) ?></div>
                        <div class="stats-label">Available Products</div>
                    </div>
                </div>
                <!-- Featured Items Stat -->
                <div class="col-md-4 mb-4">
                    <div class="stats-card favorites">
                        <i class="fas fa-heart stats-icon"></i>
                        <div class="stats-number"><?= count($featured_products) ?></div>
                        <div class="stats-label">Featured Items</div>
                    </div>
                </div>
                <!-- Cart Items Stat -->
                <div class="col-md-4 mb-4">
                    <div class="stats-card rewards">
                        <i class="fas fa-star stats-icon"></i>
                        <div class="stats-number"><?= $cart_count ?></div>
                        <div class="stats-label">Items in Cart</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions Section -->
        <div class="quick-actions">
            <div class="row">
                <!-- View Cart Action -->
                <div class="col-md-3 mb-4">
                    <a href="/cart" class="text-decoration-none">
                        <div class="action-card">
                            <i class="fas fa-shopping-cart action-icon"></i>
                            <div class="action-title">View Cart</div>
                            <div class="action-description">Manage your shopping cart</div>
                        </div>
                    </a>
                </div>
                <!-- Order History Action -->
                <div class="col-md-3 mb-4">
                    <a href="/orders" class="text-decoration-none">
                        <div class="action-card">
                            <i class="fas fa-history action-icon"></i>
                            <div class="action-title">Order History</div>
                            <div class="action-description">View your previous orders</div>
                        </div>
                    </a>
                </div>
                <!-- Find Stores Action -->
                <div class="col-md-3 mb-4">
                    <div class="action-card">
                        <i class="fas fa-map-marker-alt action-icon"></i>
                        <div class="action-title">Find Stores</div>
                        <div class="action-description">Locate nearby Brew Haven cafes</div>
                    </div>
                </div>
                <!-- Rewards Action -->
                <div class="col-md-3 mb-4">
                    <div class="action-card">
                        <i class="fas fa-gift action-icon"></i>
                        <div class="action-title">Rewards</div>
                        <div class="action-description">Redeem your reward points</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Featured Products Section -->
        <?php if (!empty($featured_products)): ?>
        <h2 class="menu-header">Featured Products</h2>
        <div class="row">
            <?php foreach ($featured_products as $product): ?>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="coffee-card">
                    <!-- Decorative floating coffee beans -->
                    <div class="floating-bean" style="top: 10%; left: 10%; animation-delay: 0s;"></div>
                    <div class="floating-bean" style="top: 80%; right: 15%; animation-delay: 2s;"></div>
                    
                    <!-- Featured product badge -->
                    <?php if (isset($product['is_featured']) && $product['is_featured']): ?>
                        <span class="featured-badge">Featured</span>
                    <?php endif; ?>
                    
                    <!-- Stock information badge -->
                    <?php if (isset($product['stock'])): ?>
                        <span class="stock-badge">Stock: <?= $product['stock'] ?></span>
                    <?php endif; ?>
                    
                    <!-- Product image or placeholder -->
                    <div class="coffee-image">
                        <?php if (!empty($product['image'])): ?>
                            <img src="/uploads/products/<?= $product['image'] ?>" 
                                 alt="<?= $product['name'] ?>"
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <i class="fas fa-mug-hot coffee-icon" style="display: none;"></i>
                        <?php else: ?>
                            <i class="fas fa-mug-hot coffee-icon"></i>
                        <?php endif; ?>
                    </div>
                    <!-- Product details -->
                    <h4 class="coffee-name"><?= $product['name'] ?></h4>
                    <p class="coffee-description"><?= $product['description'] ?></p>
                    <div class="coffee-price">$<?= number_format($product['price'], 2) ?></div>
                    
                    <?php 
                    // Check if product is out of stock
                    $isOutOfStock = isset($product['stock']) && $product['stock'] <= 0;
                    $isDisabled = $isOutOfStock;
                    ?>
                    
                    <!-- Order button with dynamic state -->
                    <button class="btn btn-order" data-bs-toggle="modal" data-bs-target="#orderModal" 
                            data-product-id="<?= $product['id'] ?>" 
                            data-product-name="<?= $product['name'] ?>" 
                            data-product-price="<?= $product['price'] ?>"
                            <?= $isDisabled ? 'disabled' : '' ?>>
                        <i class="fas fa-shopping-cart me-2"></i>
                        <?= $isOutOfStock ? 'Out of Stock' : 'Order Now' ?>
                    </button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- All Products Section -->
        <h2 class="menu-header">Our Coffee Menu</h2>
        <div class="row">
            <?php foreach ($products as $product): ?>
            <?php 
            // Determine product status
            $isOutOfStock = isset($product['stock']) && $product['stock'] <= 0;
            $isFeatured = isset($product['is_featured']) && $product['is_featured'];
            ?>
            
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="coffee-card <?= $isOutOfStock ? 'out-of-stock' : '' ?>">
                    <!-- Decorative floating coffee beans -->
                    <div class="floating-bean" style="top: 10%; left: 10%; animation-delay: 0s;"></div>
                    <div class="floating-bean" style="top: 80%; right: 15%; animation-delay: 2s;"></div>
                    
                    <!-- Featured badge -->
                    <?php if ($isFeatured): ?>
                        <span class="featured-badge">Featured</span>
                    <?php endif; ?>
                    
                    <!-- Stock badge -->
                    <?php if (isset($product['stock'])): ?>
                        <span class="stock-badge">Stock: <?= $product['stock'] ?></span>
                    <?php endif; ?>
                    
                    <!-- Product image or placeholder -->
                    <div class="coffee-image">
                        <?php if (!empty($product['image'])): ?>
                            <img src="/uploads/products/<?= $product['image'] ?>" 
                                 alt="<?= $product['name'] ?>"
                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <i class="fas fa-mug-hot coffee-icon" style="display: none;"></i>
                        <?php else: ?>
                            <i class="fas fa-mug-hot coffee-icon"></i>
                        <?php endif; ?>
                    </div>
                    <!-- Product details -->
                    <h4 class="coffee-name"><?= $product['name'] ?></h4>
                    <p class="coffee-description"><?= $product['description'] ?></p>
                    <div class="coffee-price">$<?= number_format($product['price'], 2) ?></div>
                    <!-- Order button with dynamic state -->
                    <button class="btn btn-order" data-bs-toggle="modal" data-bs-target="#orderModal" 
                            data-product-id="<?= $product['id'] ?>" 
                            data-product-name="<?= $product['name'] ?>" 
                            data-product-price="<?= $product['price'] ?>"
                            <?= $isOutOfStock ? 'disabled' : '' ?>>
                        <i class="fas fa-shopping-cart me-2"></i>
                        <?= $isOutOfStock ? 'Out of Stock' : 'Order Now' ?>
                    </button>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- Order Customization Modal -->
    <div class="modal fade modal-coffee" id="orderModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="fas fa-shopping-cart me-2"></i>Place Your Order
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <!-- Order form -->
                <form action="/add-to-cart" method="post">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="order-details">
                            <!-- Dynamic product name -->
                            <h4 id="modalProductName" class="text-center mb-3" style="color: #5d4037;"></h4>
                            <div class="text-center mb-3">
                                <!-- Dynamic product price -->
                                <span id="modalProductPrice" class="coffee-price"></span>
                            </div>
                        </div>

                        <!-- Hidden inputs for product data -->
                        <input type="hidden" name="product_id" id="modalProductId">
                        <input type="hidden" name="total_price" id="modalTotalPrice">

                        <!-- Customization options -->
                        <div class="mb-4">
                            <label class="form-label fw-bold" style="color: #5d4037;">Customize Your Drink</label>
                            
                            <!-- Size selection -->
                            <div class="mb-3">
                                <label class="form-label">Size</label>
                                <select class="form-select" name="size" id="sizeSelect">
                                    <option value="small">Small (12oz) +$0.00</option>
                                    <option value="medium" selected>Medium (16oz) +$0.50</option>
                                    <option value="large">Large (20oz) +$1.00</option>
                                </select>
                            </div>

                            <!-- Milk options -->
                            <div class="mb-3">
                                <label class="form-label">Milk Options</label>
                                <select class="form-select" name="milk_type" id="milkSelect">
                                    <option value="whole">Whole Milk</option>
                                    <option value="skim">Skim Milk</option>
                                    <option value="almond">Almond Milk +$0.75</option>
                                    <option value="oat">Oat Milk +$0.75</option>
                                    <option value="soy">Soy Milk +$0.75</option>
                                </select>
                            </div>

                            <!-- Sweetness level -->
                            <div class="mb-3">
                                <label class="form-label">Sweetness Level</label>
                                <select class="form-select" name="sweetness" id="sweetnessSelect">
                                    <option value="none">No Sugar</option>
                                    <option value="light" selected>Light Sugar</option>
                                    <option value="regular">Regular</option>
                                    <option value="extra">Extra Sweet</option>
                                </select>
                            </div>

                            <!-- Special instructions -->
                            <div class="mb-3">
                                <label class="form-label">Special Instructions</label>
                                <textarea class="form-control" name="special_instructions" id="specialInstructions" rows="2" placeholder="Any special requests?"></textarea>
                            </div>
                        </div>

                        <!-- Quantity controls -->
                        <div class="quantity-control justify-content-center">
                            <label class="form-label fw-bold me-3" style="color: #5d4037;">Quantity:</label>
                            <button type="button" class="quantity-btn" id="decreaseQuantity">-</button>
                            <span class="quantity-display" id="quantityDisplay">1</span>
                            <button type="button" class="quantity-btn" id="increaseQuantity">+</button>
                            <input type="hidden" name="quantity" id="quantityInput" value="1">
                        </div>

                        <!-- Dynamic total price display -->
                        <div class="text-center mt-4">
                            <h5 style="color: #5d4037;">Total: $<span id="totalPrice">0.00</span></h5>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-modal-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-modal-primary">
                            <i class="fas fa-cart-plus me-2"></i>Add to Cart
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const orderModal = document.getElementById('orderModal');
        let currentProductPrice = 0;
        let quantity = 1;

        // Modal show event handler
        orderModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const productId = button.getAttribute('data-product-id');
            const productName = button.getAttribute('data-product-name');
            const productPrice = parseFloat(button.getAttribute('data-product-price'));
            
            currentProductPrice = productPrice;
            quantity = 1;
            
            // Set modal content
            document.getElementById('modalProductId').value = productId;
            document.getElementById('modalProductName').textContent = productName;
            document.getElementById('modalProductPrice').textContent = `$${productPrice.toFixed(2)}`;
            document.getElementById('quantityDisplay').textContent = quantity;
            document.getElementById('quantityInput').value = quantity;
            
            calculateTotal();
        });

        // Increase quantity button handler
        document.getElementById('increaseQuantity').addEventListener('click', function() {
            quantity++;
            document.getElementById('quantityDisplay').textContent = quantity;
            document.getElementById('quantityInput').value = quantity;
            calculateTotal();
        });

        // Decrease quantity button handler
        document.getElementById('decreaseQuantity').addEventListener('click', function() {
            if (quantity > 1) {
                quantity--;
                document.getElementById('quantityDisplay').textContent = quantity;
                document.getElementById('quantityInput').value = quantity;
                calculateTotal();
            }
        });

        // Calculate total price based on selections
        function calculateTotal() {
            let total = currentProductPrice * quantity;
            
            // Size pricing
            const sizeSelect = document.getElementById('sizeSelect');
            if (sizeSelect.value === 'medium') total += 0.50 * quantity;
            if (sizeSelect.value === 'large') total += 1.00 * quantity;
            
            // Milk pricing
            const milkSelect = document.getElementById('milkSelect');
            if (milkSelect.value !== 'whole' && milkSelect.value !== 'skim') {
                total += 0.75 * quantity;
            }
            
            // Update display and hidden field
            document.getElementById('totalPrice').textContent = total.toFixed(2);
            document.getElementById('modalTotalPrice').value = total.toFixed(2);
        }

        // Event listeners for option changes
        document.getElementById('sizeSelect').addEventListener('change', calculateTotal);
        document.getElementById('milkSelect').addEventListener('change', calculateTotal);

        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(function(alert) {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);
        });
    </script>
</body>
</html>