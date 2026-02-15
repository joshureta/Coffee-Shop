<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - Coffee Shop</title>
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
        
        .action-buttons {
            display: flex;
            gap: 15px;
            margin-bottom: 25px;
        }
        
        .btn-add-user {
            background: linear-gradient(135deg, #388e3c, #2e7d32);
            border: none;
            color: white;
            padding: 12px 25px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(56, 142, 60, 0.3);
        }
        
        .btn-add-user:hover {
            background: linear-gradient(135deg, #2e7d32, #1b5e20);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(56, 142, 60, 0.4);
        }
        
        .modal-content {
            border-radius: 15px;
            border: none;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            margin-top: 100px;
        }
        
        .modal-header {
            background: linear-gradient(135deg, #5d4037, #795548);
            color: #efebe9;
            border-radius: 15px 15px 0 0;
            border: none;
            padding: 20px 25px;
        }
        
        .modal-title {
            font-weight: 600;
        }
        
        .modal-body {
            padding: 25px;
        }
        
        .modal-footer {
            border-top: 1px solid #e0e0e0;
            padding: 20px 25px;
            border-radius: 0 0 15px 15px;
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
        
        .form-select {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #fafafa;
        }
        
        .form-select:focus {
            border-color: #8d6e63;
            box-shadow: 0 0 0 0.2rem rgba(141, 110, 99, 0.25);
            background: white;
        }
        
        .table-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
            overflow: hidden;
            border: 1px solid #e0e0e0;
        }
        
        .table thead {
            background: linear-gradient(135deg, #4e342e, #6d4c41);
        }
        
        .table thead th {
            color: #efebe9;
            border: none;
            padding: 18px 15px;
            font-weight: 600;
            font-size: 0.95rem;
            letter-spacing: 0.3px;
        }
        
        .table tbody tr {
            transition: all 0.3s ease;
            border-bottom: 1px solid #f5f5f5;
        }
        
        .table tbody tr:hover {
            background-color: rgba(121, 85, 72, 0.05);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }
        
        .table tbody td {
            padding: 16px 15px;
            vertical-align: middle;
            border-color: #f5f5f5;
            color: #5d4037;
        }
        
        .btn-edit {
            background: linear-gradient(135deg, #8d6e63, #6d4c41);
            border: none;
            color: white;
            padding: 8px 18px;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        
        .btn-edit:hover {
            background: linear-gradient(135deg, #7a5c52, #5d4037);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(141, 110, 99, 0.4);
        }
        
        .btn-delete {
            background: linear-gradient(135deg, #bf360c, #8d2c0c);
            border: none;
            color: white;
            padding: 8px 18px;
            border-radius: 8px;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        
        .btn-delete:hover {
            background: linear-gradient(135deg, #a5320b, #732208);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(191, 54, 12, 0.4);
        }
        
        .btn-save {
            background: linear-gradient(135deg, #5d4037, #4e342e);
            border: none;
            color: white;
            padding: 10px 25px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-save:hover {
            background: linear-gradient(135deg, #4e342e, #3e2723);
            color: white;
            transform: translateY(-2px);
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
        
        /* FIXED ROLE BADGES */
        .role-badge {
            padding: 7px 14px;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 600;
            letter-spacing: 0.3px;
            display: inline-block;
            text-align: center;
            min-width: 90px;
            white-space: nowrap;
        }
        
        .role-admin {
            background: linear-gradient(135deg, #5d4037, #4e342e);
            color: #efebe9;
            box-shadow: 0 2px 8px rgba(93, 64, 55, 0.3);
        }
        
        .role-customer {
            background: linear-gradient(135deg, #8d6e63, #795548);
            color: #efebe9;
            box-shadow: 0 2px 8px rgba(141, 110, 99, 0.3);
        }
        
        .user-avatar {
            width: 35px;
            height: 35px;
            background: linear-gradient(135deg, #8d6e63, #a1887f);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            margin-right: 10px;
            box-shadow: 0 2px 6px rgba(0,0,0,0.2);
        }
        
        .stats-card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            border-left: 5px solid;
            margin-bottom: 20px;
        }
        
        .stats-card.total-users {
            border-left-color: #5d4037;
        }
        
        .stats-card.admin-users {
            border-left-color: #8d6e63;
        }
        
        .stats-card.customer-users {
            border-left-color: #a1887f;
        }

        /* Search and Pagination Styles */
        .search-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 25px;
            border: 1px solid #e0e0e0;
        }

        .pagination-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            padding: 20px;
            border: 1px solid #e0e0e0;
            margin-top: 20px;
        }

        /* Improved Custom Pagination */
        .custom-pagination {
            display: flex;
            gap: 6px;
            align-items: center;
            flex-wrap: wrap;
            justify-content: center;
        }

        .custom-pagination .page-btn {
            background: white;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 8px 15px;
            color: #5d4037;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 0.9rem;
            min-width: 40px;
            justify-content: center;
        }

        .custom-pagination .page-btn:hover {
            background: linear-gradient(135deg, #8d6e63, #795548);
            border-color: #8d6e63;
            color: white;
            transform: translateY(-2px);
            text-decoration: none;
            box-shadow: 0 4px 12px rgba(141, 110, 99, 0.3);
        }

        .custom-pagination .page-btn.active {
            background: linear-gradient(135deg, #5d4037, #4e342e);
            border-color: #5d4037;
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(93, 64, 55, 0.4);
        }

        .custom-pagination .page-btn.disabled {
            background: #f5f5f5;
            border-color: #e0e0e0;
            color: #9e9e9e;
            cursor: not-allowed;
            opacity: 0.6;
        }

        .custom-pagination .page-btn.disabled:hover {
            background: #f5f5f5;
            border-color: #e0e0e0;
            color: #9e9e9e;
            transform: none;
            box-shadow: none;
        }

        /* Pagination info text */
        .pagination-info {
            color: #5d4037;
            font-weight: 500;
            font-size: 0.9rem;
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

            /* Mobile pagination */
            .custom-pagination {
                gap: 4px;
            }
            
            .custom-pagination .page-btn {
                padding: 6px 12px;
                font-size: 0.85rem;
                min-width: 36px;
            }

            .pagination-container .d-flex {
                flex-direction: column;
                gap: 15px;
            }

            .pagination-container .d-flex > div {
                text-align: center;
                width: 100%;
            }
        }

        @media (max-width: 576px) {
            .custom-pagination .page-btn {
                padding: 6px 10px;
                font-size: 0.8rem;
                min-width: 32px;
            }

            .custom-pagination .page-btn:not(.active):not(.disabled) span {
                display: none;
            }

            .custom-pagination .page-btn:not(.active):not(.disabled) i {
                margin: 0;
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
                <!-- Active link for current user management page -->
                <a class="nav-link active" href="/admin/users">
                    <i class="fas fa-users"></i>
                    User Management
                </a>
            </div>
             <div class="nav-item">
                <!-- Link to product management section -->
                <a class="nav-link" href="/admin/products">
                    <i class="fas fa-coffee"></i>
                    Product Management
                </a>
            </div>
            <div class="nav-item">
                <!-- Logout link -->
                <a class="nav-link" href="/logout">
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content Area -->
    <div class="main-content">
        <!-- Page Header with Add User Button -->
        <div class="content-header">
            <div class="row align-items-center">
                <div class="col">
                    <h1><i class="fas fa-users"></i> User Management</h1>
                    <p>Manage all registered users and their access permissions</p>
                </div>
                <div class="col-auto">
                    <!-- Button to trigger add user modal -->
                    <button type="button" class="btn btn-add-user" data-bs-toggle="modal" data-bs-target="#addUserModal">
                        <i class="fas fa-user-plus me-2"></i>Add New User
                    </button>
                </div>
            </div>
        </div>

        <!-- Search Form for Filtering Users -->
        <div class="search-container">
            <form action="/admin/users" method="get" class="row align-items-center">
                <div class="col-md-8">
                    <div class="input-group">
                        <!-- Search input field -->
                        <input type="text" class="form-control" name="search" 
                               placeholder="Search users by name, email, or role..." 
                               value="<?= esc($search ?? '') ?>">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="fas fa-search"></i> Search
                        </button>
                        <!-- Clear search button (only shows when search is active) -->
                        <?php if (isset($search) && $search): ?>
                        <a href="/admin/users" class="btn btn-outline-danger">
                            <i class="fas fa-times"></i> Clear
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-4 text-end">
                    <!-- Search result count -->
                    <small class="text-muted">
                        <?php if (isset($pager)): ?>
                            Showing <?= count($users) ?> of <?= $pager->getTotal() ?> users
                        <?php endif; ?>
                    </small>
                </div>
            </form>
        </div>

        <!-- User Statistics Cards -->
        <div class="row">
            <div class="col-md-4">
                <div class="stats-card total-users">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="fas fa-users fa-2x" style="color: #5d4037;"></i>
                        </div>
                        <div>
                            <!-- Total users count -->
                            <h3 class="mb-0" style="color: #5d4037;"><?= $stats['total'] ?? 0 ?></h3>
                            <p class="mb-0 text-muted">Total Users</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card admin-users">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="fas fa-crown fa-2x" style="color: #8d6e63;"></i>
                        </div>
                        <div>
                            <!-- Admin users count -->
                            <h3 class="mb-0" style="color: #8d6e63;"><?= $stats['admin'] ?? 0 ?></h3>
                            <p class="mb-0 text-muted">Admin Users</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="stats-card customer-users">
                    <div class="d-flex align-items-center">
                        <div class="me-3">
                            <i class="fas fa-user fa-2x" style="color: #a1887f;"></i>
                        </div>
                        <div>
                            <!-- Customer users count -->
                            <h3 class="mb-0" style="color: #a1887f;"><?= $stats['customer'] ?? 0 ?></h3>
                            <p class="mb-0 text-muted">Customers</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Success Message Display -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <!-- Error Message Display -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- Users Table -->
        <div class="table-container">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th><i class="fas fa-user"></i> Username</th>
                            <th><i class="fas fa-envelope"></i> Email</th>
                            <th><i class="fas fa-shield-alt"></i> Role</th>
                            <th><i class="fas fa-calendar-plus"></i> Created At</th>
                            <th><i class="fas fa-cogs"></i> Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($users)): ?>
                            <?php foreach ($users as $user): ?>
                            <tr>
                                <!-- User ID -->
                                <td><strong>#<?= $user['id'] ?></strong></td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <!-- User avatar with first letter of username -->
                                        <div class="user-avatar">
                                            <?= strtoupper(substr($user['username'], 0, 1)) ?>
                                        </div>
                                        <?= esc($user['username']) ?>
                                    </div>
                                </td>
                                <!-- User email -->
                                <td><?= esc($user['email']) ?></td>
                                <td>
                                    <!-- Role badge with different styling for admin/customer -->
                                    <span class="role-badge <?= $user['role'] === 'admin' ? 'role-admin' : 'role-customer' ?>">
                                        <i class="fas fa-<?= $user['role'] === 'admin' ? 'crown' : 'user' ?> me-1"></i>
                                        <?= ucfirst($user['role'] ?? 'customer') ?>
                                    </span>
                                </td>
                                <td>
                                    <!-- Account creation date -->
                                    <small class="text-muted">
                                        <i class="fas fa-clock me-1"></i>
                                        <?= date('M j, Y g:i A', strtotime($user['created_at'])) ?>
                                    </small>
                                </td>
                                <td>
                                    <!-- Action buttons for edit and delete -->
                                    <div class="btn-group">
                                        <a href="/admin/users/edit/<?= $user['id'] ?>" class="btn btn-edit me-2">
                                            <i class="fas fa-edit me-1"></i> Edit
                                        </a>
                                        <a href="/admin/users/delete/<?= $user['id'] ?>" class="btn btn-delete" onclick="return confirm('Are you sure you want to delete this user?')">
                                            <i class="fas fa-trash me-1"></i> Delete
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <!-- Empty state when no users found -->
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">No users found</h5>
                                    <?php if (isset($search) && $search): ?>
                                        <p class="text-muted">Try adjusting your search terms</p>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination Controls -->
        <?php if (isset($pager) && $pager->getPageCount() > 1): ?>
        <div class="pagination-container">
            <div class="d-flex justify-content-between align-items-center">
                <!-- Pagination information text -->
                <div class="pagination-info">
                    Page <?= $pager->getCurrentPage() ?> of <?= $pager->getPageCount() ?>
                    | Showing <?= (($pager->getCurrentPage() - 1) * $pager->getPerPage()) + 1 ?> 
                    to <?= min($pager->getCurrentPage() * $pager->getPerPage(), $pager->getTotal()) ?> 
                    of <?= $pager->getTotal() ?> users
                </div>
                <nav aria-label="User pagination">
                    <div class="custom-pagination">
                        <?php 
                        $currentPage = $pager->getCurrentPage();
                        $pageCount = $pager->getPageCount();
                        
                        // Previous page button
                        if ($currentPage > 1): ?>
                            <a href="<?= $pager->getPreviousPageUri() ?>" class="page-btn">
                                <i class="fas fa-chevron-left"></i> <span>Previous</span>
                            </a>
                        <?php else: ?>
                            <span class="page-btn disabled">
                                <i class="fas fa-chevron-left"></i> <span>Previous</span>
                            </span>
                        <?php endif; ?>

                        <?php 
                        // Generate page number buttons
                        $startPage = max(1, $currentPage - 2);
                        $endPage = min($pageCount, $currentPage + 2);
                        
                        for ($i = $startPage; $i <= $endPage; $i++): 
                        ?>
                            <a href="<?= $pager->getPageURI($i) ?>" class="page-btn <?= $i === $currentPage ? 'active' : '' ?>">
                                <?= $i ?>
                            </a>
                        <?php endfor; ?>

                        <?php 
                        // Next page button
                        if ($currentPage < $pageCount): ?>
                            <a href="<?= $pager->getNextPageUri() ?>" class="page-btn">
                                <span>Next</span> <i class="fas fa-chevron-right"></i>
                            </a>
                        <?php else: ?>
                            <span class="page-btn disabled">
                                <span>Next</span> <i class="fas fa-chevron-right"></i>
                            </span>
                        <?php endif; ?>
                    </div>
                </nav>
            </div>
        </div>
        <?php endif; ?>
    </div>

    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addUserModalLabel">
                        <i class="fas fa-user-plus me-2"></i>Add New User
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- Form for creating new user -->
                <form action="/admin/users/create" method="post">
                    <?= csrf_field() ?>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="new_username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="new_username" name="username" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="new_email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="new_email" name="email" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="new_password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="new_password" name="password" required minlength="8">
                                <div class="form-text">Password must be at least 8 characters long.</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="new_role" class="form-label">Role</label>
                                <select class="form-select" id="new_role" name="role" required>
                                    <option value="customer">Customer</option>
                                    <option value="admin">Administrator</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-save">
                            <i class="fas fa-save me-2"></i>Create User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-hide flash messages after 5 seconds
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