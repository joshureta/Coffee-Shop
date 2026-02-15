<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History - Brew Haven Coffee Shop</title>
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

        .orders-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
            padding: 30px;
            margin-bottom: 30px;
            border: 1px solid #e0e0e0;
        }

        .order-card {
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 20px;
            transition: all 0.3s ease;
            background: white;
        }

        .order-card:hover {
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }

        .order-header {
            border-bottom: 2px solid #f5f1eb;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }

        .order-item {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #f5f1eb;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .order-item-image {
            width: 70px;
            height: 70px;
            border-radius: 8px;
            object-fit: cover;
            margin-right: 15px;
            border: 2px solid #e0e0e0;
        }

        .order-item-image-placeholder {
            width: 70px;
            height: 70px;
            border-radius: 8px;
            background: linear-gradient(135deg, #f5f1eb, #e8d5cd);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #8d6e63;
            font-size: 1.2rem;
            margin-right: 15px;
            border: 2px solid #e0e0e0;
        }

        .status-badge {
            padding: 6px 15px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.8rem;
        }

        .status-pending { background: #fff3cd; color: #856404; }
        .status-confirmed { background: #d1ecf1; color: #0c5460; }
        .status-preparing { background: #d1ecf1; color: #0c5460; }
        .status-ready { background: #d4edda; color: #155724; }
        .status-completed { background: #d4edda; color: #155724; }
        .status-cancelled { background: #f8d7da; color: #721c24; }

        .empty-orders {
            text-align: center;
            padding: 60px 20px;
            color: #5d4037;
        }

        .empty-orders i {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.7;
        }

        .btn-coffee {
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
        .btn-coffee i {
             font-size: 0.9em;
        }

        .btn-coffee:hover {
            background: linear-gradient(135deg, #4e342e, #3e2723);
            color: white;
            transform: translateY(-2px);
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

        @media (max-width: 1008px) {
            .welcome-header {
                padding: 40px 0;
            }
            
            .welcome-content h2 {
                font-size: 2rem;
            }
            
            .orders-container {
                padding: 20px;
            }
            
            .order-card {
                padding: 20px;
            }
            
            .order-header .row {
                flex-direction: column;
                text-align: center;
            }
            
            .order-header .col-md-6 {
                margin-bottom: 10px;
            }
            
            .order-item {
                flex-direction: column;
                text-align: center;
            }
            
            .order-item-image {
                margin-right: 0;
                margin-bottom: 10px;
            }
            
            .order-details .row {
                flex-direction: column;
            }
            
            .order-details .col-md-6 {
                margin-bottom: 15px;
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
                        <!-- Active orders link -->
                        <li><a class="dropdown-item active" href="/orders">
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
                        <!-- Active orders link -->
                        <li><a class="dropdown-item active" href="/orders">
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
                <h2>Order History <i class="fas fa-history"></i></h2>
                <p class="mb-0">Track your coffee orders and their status</p>
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

        <!-- Empty Orders State -->
        <?php if (empty($orders)): ?>
            <div class="empty-orders">
                <i class="fas fa-clipboard-list"></i>
                <h3>No orders yet</h3>
                <p class="mb-4">Start your coffee journey by placing your first order!</p>
                <!-- Browse menu button -->
                <a href="/dashboard" class="btn btn-coffee">
                    <i class="fas fa-coffee me-2"></i>Browse Menu
                </a>
            </div>
        <?php else: ?>
            <!-- Orders Container -->
            <div class="orders-container">
                <!-- Decorative floating coffee beans -->
                <div class="floating-bean" style="top: 10%; left: 5%; animation-delay: 0s;"></div>
                <div class="floating-bean" style="bottom: 10%; right: 5%; animation-delay: 3s;"></div>
                
                <!-- Loop through each order -->
                <?php foreach ($orders as $order): ?>
                    <div class="order-card">
                        <!-- Order header with basic info -->
                        <div class="order-header">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <!-- Order number and date -->
                                    <h5 class="text-coffee mb-2">
                                        <i class="fas fa-receipt me-2"></i>Order #<?= $order['order_number'] ?>
                                    </h5>
                                    <small class="text-muted">
                                        <i class="fas fa-calendar me-1"></i>
                                        <?= date('F j, Y g:i A', strtotime($order['created_at'])) ?>
                                    </small>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <!-- Order status badge -->
                                    <span class="status-badge status-<?= $order['status'] ?>">
                                        <?= ucfirst($order['status']) ?>
                                    </span>
                                    <!-- Order total amount -->
                                    <div class="mt-2">
                                        <strong class="text-coffee">$<?= number_format($order['total_amount'], 2) ?></strong>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Order details section -->
                        <div class="order-details">
                            <!-- Payment and shipping info -->
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <small class="text-muted">
                                        <strong>Payment Method:</strong><br>
                                        <?= ucwords(str_replace('_', ' ', $order['payment_method'])) ?>
                                    </small>
                                </div>
                                <div class="col-md-6">
                                    <small class="text-muted">
                                        <strong>Shipping Address:</strong><br>
                                        <?= $order['shipping_address'] ?>
                                    </small>
                                </div>
                            </div>

                            <!-- Order items section -->
                            <h6 class="text-coffee mb-3">Order Items:</h6>
                            <?php
                            // Fetch order items from database
                            $db = \Config\Database::connect();
                            $orderItems = $db->table('order_items')
                                ->select('order_items.*, products.name, products.description, products.image')
                                ->join('products', 'products.id = order_items.product_id')
                                ->where('order_id', $order['id'])
                                ->get()
                                ->getResultArray();
                            ?>
                            
                            <?php if (!empty($orderItems)): ?>
                                <!-- Loop through each order item -->
                                <?php foreach ($orderItems as $item): ?>
                                    <div class="order-item">
                                        <!-- Product image or placeholder -->
                                        <?php if (!empty($item['image'])): ?>
                                            <img src="/uploads/products/<?= $item['image'] ?>" 
                                                 alt="<?= $item['name'] ?>" 
                                                 class="order-item-image"
                                                 onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                            <div class="order-item-image-placeholder" style="display: none;">
                                                <i class="fas fa-mug-hot"></i>
                                            </div>
                                        <?php else: ?>
                                            <div class="order-item-image-placeholder">
                                                <i class="fas fa-mug-hot"></i>
                                            </div>
                                        <?php endif; ?>
                                        <!-- Item details -->
                                        <div class="flex-grow-1">
                                            <!-- Product name -->
                                            <h6 class="mb-1"><?= $item['name'] ?></h6>
                                            <!-- Product description -->
                                            <?php if (!empty($item['description'])): ?>
                                                <p class="mb-1 text-muted small"><?= $item['description'] ?></p>
                                            <?php endif; ?>
                                            <!-- Customization badges -->
                                            <div class="d-flex flex-wrap gap-1">
                                                <span class="custom-badge">Qty: <?= $item['quantity'] ?></span>
                                                <span class="custom-badge"><?= ucfirst($item['size']) ?></span>
                                                <span class="custom-badge"><?= ucfirst(str_replace('_', ' ', $item['milk_type'])) ?></span>
                                                <span class="custom-badge"><?= ucfirst($item['sweetness']) ?></span>
                                            </div>
                                            <!-- Special instructions -->
                                            <?php if (!empty($item['special_instructions'])): ?>
                                                <small class="text-muted"><strong>Notes:</strong> <?= $item['special_instructions'] ?></small>
                                            <?php endif; ?>
                                        </div>
                                        <!-- Item pricing -->
                                        <div class="text-end">
                                            <strong class="text-coffee">$<?= number_format($item['price'] * $item['quantity'], 2) ?></strong>
                                            <br>
                                            <small class="text-muted">$<?= number_format($item['price'], 2) ?> each</small>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <!-- No items available state -->
                                <div class="text-center py-3">
                                    <i class="fas fa-exclamation-circle text-muted mb-2"></i>
                                    <p class="text-muted mb-0">Order items not available</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
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