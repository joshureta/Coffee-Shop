<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User - Coffee Shop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* Your existing CSS remains exactly the same */
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
        
        .edit-form-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0,0,0,0.1);
            padding: 35px;
            border: 1px solid #e0e0e0;
        }
        
        .form-label {
            color: #5d4037;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 1rem;
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
        
        .btn-update {
            background: linear-gradient(135deg, #5d4037, #4e342e);
            border: none;
            color: white;
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(93, 64, 55, 0.3);
        }
        
        .btn-update:hover {
            background: linear-gradient(135deg, #4e342e, #3e2723);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(93, 64, 55, 0.4);
        }
        
        .btn-cancel {
            background: linear-gradient(135deg, #8d6e63, #795548);
            border: none;
            color: white;
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(141, 110, 99, 0.3);
        }
        
        .btn-cancel:hover {
            background: linear-gradient(135deg, #795548, #6d4c41);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(141, 110, 99, 0.4);
        }
        
        .user-info-card {
            background: linear-gradient(135deg, #faf3f0, #f5ebe9);
            border: 1px solid #e8d5cd;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 25px;
        }
        
        .user-avatar-large {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #8d6e63, #a1887f);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            font-weight: bold;
            margin-right: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
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
        
        .input-group-text {
            background: linear-gradient(135deg, #8d6e63, #795548);
            border: 2px solid #8d6e63;
            color: white;
            font-weight: 600;
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
                <!-- Link to user management page -->
                <a class="nav-link" href="/admin/users">
                    <i class="fas fa-users"></i>
                    User Management
                </a>
            </div>
            <div class="nav-item">
                <!-- Active link for current edit user page -->
                <a class="nav-link active" href="#">
                    <i class="fas fa-user-cog"></i>
                    Edit User
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
        <!-- Page Header -->
        <div class="content-header">
            <h1><i class="fas fa-user-edit"></i> Edit User</h1>
            <p>Update user information and permissions</p>
        </div>

        <!-- Success Flash Message -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <!-- Error Flash Message -->
        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger">
                <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <!-- User Profile Information Card -->
        <div class="user-info-card">
            <div class="d-flex align-items-center">
                <!-- User avatar with first letter of username -->
                <div class="user-avatar-large">
                    <?= strtoupper(substr($user['username'], 0, 1)) ?>
                </div>
                <div>
                    <!-- Username display -->
                    <h4 class="mb-1" style="color: #5d4037;"><?= esc($user['username']) ?></h4>
                    <!-- Email display -->
                    <p class="mb-1 text-muted"><?= esc($user['email']) ?></p>
                    <!-- Role badge with different icons for admin/customer -->
                    <span class="badge" style="background: linear-gradient(135deg, #5d4037, #4e342e); color: white; padding: 6px 12px; border-radius: 15px;">
                        <i class="fas fa-<?= $user['role'] === 'admin' ? 'crown' : 'user' ?> me-1"></i>
                        <?= ucfirst($user['role']) ?>
                    </span>
                </div>
            </div>
        </div>

        <!-- User Edit Form -->
        <div class="edit-form-container">
            <!-- Form to update user details -->
            <form action="/admin/users/update/<?= $user['id'] ?>" method="post">
                <!-- CSRF protection token -->
                <?= csrf_field() ?>
                <div class="row">
                    <!-- Username Input Field -->
                    <div class="col-md-6 mb-4">
                        <label for="username" class="form-label">
                            <i class="fas fa-user me-2"></i>Username
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-user"></i>
                            </span>
                            <input type="text" class="form-control" id="username" name="username" value="<?= esc($user['username']) ?>" required>
                        </div>
                    </div>
                    <!-- Email Input Field -->
                    <div class="col-md-6 mb-4">
                        <label for="email" class="form-label">
                            <i class="fas fa-envelope me-2"></i>Email Address
                        </label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input type="email" class="form-control" id="email" name="email" value="<?= esc($user['email']) ?>" required>
                        </div>
                    </div>
                </div>
                
                <!-- Role Selection Dropdown -->
                <div class="mb-4">
                    <label for="role" class="form-label">
                        <i class="fas fa-shield-alt me-2"></i>User Role
                    </label>
                    <div class="input-group">
                        <span class="input-group-text">
                            <i class="fas fa-user-tag"></i>
                        </span>
                        <!-- Role selection with current role pre-selected -->
                        <select class="form-select" id="role" name="role" required>
                            <option value="customer" <?= $user['role'] == 'customer' ? 'selected' : '' ?>>Customer</option>
                            <option value="admin" <?= $user['role'] == 'admin' ? 'selected' : '' ?>>Administrator</option>
                        </select>
                    </div>
                    <!-- Help text explaining role differences -->
                    <div class="form-text">
                        <i class="fas fa-info-circle me-1"></i>
                        Administrators have full access to manage users and system settings.
                    </div>
                </div>

                <!-- Form Action Buttons -->
                <div class="d-flex gap-3">
                    <!-- Submit button to save changes -->
                    <button type="submit" class="btn btn-update">
                        <i class="fas fa-save me-2"></i>Update User
                    </button>
                    <!-- Cancel button to return to users list -->
                    <a href="/admin/users" class="btn btn-cancel">
                        <i class="fas fa-arrow-left me-2"></i>Back to Users
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JavaScript for interactive components -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>