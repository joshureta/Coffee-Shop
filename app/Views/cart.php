<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - Brew Haven Coffee Shop</title>
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

        .cart-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
            padding: 30px;
            margin-bottom: 30px;
            border: 1px solid #e0e0e0;
        }

        .cart-item {
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
            background: white;
        }

        .cart-item:hover {
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }

        .cart-item-image {
            width: 100px;
            height: 100px;
            border-radius: 8px;
            object-fit: cover;
            border: 2px solid #e0e0e0;
        }

        .cart-item-image-placeholder {
            width: 100px;
            height: 100px;
            border-radius: 8px;
            background: linear-gradient(135deg, #f5f1eb, #e8d5cd);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #8d6e63;
            font-size: 1.5rem;
            border: 2px solid #e0e0e0;
        }

        .empty-cart {
            text-align: center;
            padding: 60px 20px;
            color: #5d4037;
        }

        .empty-cart i {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.7;
        }

        .btn-coffee {
            background: linear-gradient(135deg, #5d4037, #4e342e);
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-coffee:hover {
            background: linear-gradient(135deg, #4e342e, #3e2723);
            color: white;
            transform: translateY(-2px);
        }

        /* Smaller Browse Menu button */
        .btn-coffee-sm {
            background: linear-gradient(135deg, #5d4037, #4e342e);
            border: none;
            color: white;
            padding: 0px 16px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            padding-top: 5px;
        }
        .btn-coffee-sm i {
             font-size: 0.9em;
        }

        .btn-coffee-sm:hover {
            background: linear-gradient(135deg, #4e342e, #3e2723);
            color: white;
            transform: translateY(-2px);
        }

        .quantity-control {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .quantity-btn {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #5d4037;
            background: white;
            color: #5d4037;
            transition: all 0.3s ease;
        }

        .quantity-btn:hover {
            background: #5d4037;
            color: white;
        }

        .quantity-display {
            margin: 0 15px;
            font-weight: 600;
            font-size: 1.1rem;
            min-width: 30px;
            text-align: center;
        }

        .custom-badge {
            background: linear-gradient(135deg, #8d6e63, #795548);
            color: white;
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
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

        .order-summary {
            background: linear-gradient(135deg, #f8f4f0, #f0e6e1);
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            border: 1px solid #e0d6d0;
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

        .modal-content {
            border-radius: 15px;
            border: none;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        }

        .modal-header {
            background: linear-gradient(135deg, #5d4037, #4e342e);
            color: white;
            border-radius: 15px 15px 0 0;
            padding: 20px 25px;
        }

        .btn-close {
            filter: invert(1);
        }

        @media (max-width: 768px) {
            .welcome-header {
                padding: 40px 0;
            }
            
            .welcome-content h2 {
                font-size: 2rem;
            }
            
            .cart-container {
                padding: 20px;
            }
            
            .cart-item {
                padding: 20px;
            }
            
            .cart-item .row {
                flex-direction: column;
                text-align: center;
            }
            
            .cart-item .col-md-2,
            .cart-item .col-md-4,
            .cart-item .col-md-2 {
                margin-bottom: 15px;
            }
            
            .cart-item-image {
                width: 120px;
                height: 120px;
                margin: 0 auto 15px;
            }
            
            .quantity-control {
                justify-content: center;
                margin: 15px 0;
            }
            
            .order-summary {
                margin-top: 20px;
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
                    <a class="nav-link active" href="/cart">
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
                        <li><a class="dropdown-item active" href="/cart">
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

    <!-- Page Header Section -->
    <div class="welcome-header">
        <div class="container">
            <div class="welcome-content">
                <h2>Shopping Cart <i class="fas fa-shopping-cart"></i></h2>
                <p class="mb-0">Review and manage your coffee selections</p>
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

        <!-- Cart Container -->
        <div class="cart-container">
            <!-- Decorative floating coffee beans -->
            <div class="floating-bean" style="top: 10%; left: 5%; animation-delay: 0s;"></div>
            <div class="floating-bean" style="bottom: 10%; right: 5%; animation-delay: 3s;"></div>
            
            <!-- Empty Cart State -->
            <?php if (empty($cartItems)): ?>
                <div class="empty-cart">
                    <i class="fas fa-shopping-cart"></i>
                    <h3>Your cart is empty</h3>
                    <p class="mb-4">Start your coffee journey by adding some delicious drinks!</p>
                    <!-- Browse menu button -->
                    <a href="/dashboard" class="btn btn-coffee-sm">
                        <i class="fas fa-coffee me-2 "></i>Browse Menu
                    </a>
                </div>
            <?php else: ?>
                <!-- Cart Items List -->
                <?php foreach ($cartItems as $item): ?>
                    <div class="cart-item">
                        <div class="row align-items-center">
                            <!-- Product Image -->
                            <div class="col-md-2">
                                <?php if (!empty($item['image'])): ?>
                                    <img src="/uploads/products/<?= $item['image'] ?>" 
                                         alt="<?= $item['name'] ?>" 
                                         class="cart-item-image"
                                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    <div class="cart-item-image-placeholder" style="display: none;">
                                        <i class="fas fa-mug-hot"></i>
                                    </div>
                                <?php else: ?>
                                    <div class="cart-item-image-placeholder">
                                        <i class="fas fa-mug-hot"></i>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <!-- Product Details -->
                            <div class="col-md-4">
                                <h5 class="text-coffee"><?= $item['name'] ?></h5>
                                <p class="text-muted mb-2"><?= $item['description'] ?></p>
                                <!-- Customization badges -->
                                <div class="d-flex flex-wrap gap-1">
                                    <span class="custom-badge"><?= ucfirst($item['size']) ?></span>
                                    <span class="custom-badge"><?= ucfirst(str_replace('_', ' ', $item['milk_type'])) ?></span>
                                    <span class="custom-badge"><?= ucfirst($item['sweetness']) ?></span>
                                </div>
                            </div>
                            <!-- Unit Price -->
                            <div class="col-md-2 text-center">
                                <span class="fw-bold text-coffee fs-5">$<?= number_format($item['price'], 2) ?></span>
                            </div>
                            <!-- Quantity Controls -->
                            <div class="col-md-2">
                                <form action="/update-cart" method="post" class="quantity-control">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="item_id" value="<?= $item['id'] ?>">
                                    <!-- Decrease quantity button -->
                                    <button type="submit" name="quantity" value="<?= $item['quantity'] - 1 ?>" 
                                            class="quantity-btn" <?= $item['quantity'] <= 1 ? 'disabled' : '' ?>>
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <!-- Current quantity display -->
                                    <span class="quantity-display"><?= $item['quantity'] ?></span>
                                    <!-- Increase quantity button -->
                                    <button type="submit" name="quantity" value="<?= $item['quantity'] + 1 ?>" 
                                            class="quantity-btn">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </form>
                            </div>
                            <!-- Item Total and Remove Button -->
                            <div class="col-md-2 text-center">
                                <span class="fw-bold text-coffee fs-5">$<?= number_format($item['price'] * $item['quantity'], 2) ?></span>
                                <a href="/remove-from-cart/<?= $item['id'] ?>" class="btn btn-sm btn-danger ms-2" 
                                   onclick="return confirm('Remove this item?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

                <!-- Order Summary Section -->
                <div class="row mt-4">
                    <div class="col-md-8"></div>
                    <div class="col-md-4">
                        <div class="order-summary">
                            <h5 class="text-coffee mb-3">Order Summary</h5>
                            <!-- Total amount display -->
                            <div class="d-flex justify-content-between mb-3">
                                <strong>Total:</strong>
                                <strong class="fs-4 text-coffee">$<?= number_format($cartTotal, 2) ?></strong>
                            </div>
                            <!-- Checkout button triggering modal -->
                            <button class="btn btn-coffee w-100" data-bs-toggle="modal" data-bs-target="#checkoutModal">
                                <i class="fas fa-credit-card me-2"></i>Proceed to Checkout
                            </button>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Checkout Modal -->
    <div class="modal fade" id="checkoutModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Checkout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <!-- Checkout form -->
                <form action="/process-checkout" method="post" id="checkoutForm">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <!-- Shipping address input -->
                        <div class="mb-3">
                            <label class="form-label">Shipping Address *</label>
                            <textarea class="form-control" name="shipping_address" rows="3" required></textarea>
                        </div>
                        <!-- Phone number input -->
                        <div class="mb-3">
                            <label class="form-label">Phone Number *</label>
                            <input type="tel" class="form-control" name="phone" required>
                        </div>
                        <!-- Payment method selection -->
                        <div class="mb-3">
                            <label class="form-label">Payment Method *</label>
                            <select class="form-control" name="payment_method" required>
                                <option value="cash">Cash on Delivery</option>
                                <option value="card">Credit/Debit Card</option>
                                <option value="paypal">PayPal</option>
                            </select>
                        </div>
                        <!-- Order total display -->
                        <div class="border-top pt-3">
                            <h6 class="text-coffee">Order Total: $<?= number_format($cartTotal, 2) ?></h6>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-coffee">Place Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Form submission handler for checkout
            const form = document.getElementById('checkoutForm');
            if (form) {
                form.addEventListener('submit', function() {
                    const submitBtn = this.querySelector('button[type="submit"]');
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Processing...';
                    submitBtn.disabled = true;
                });
            }
            
            // Auto-hide alerts after 5 seconds
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