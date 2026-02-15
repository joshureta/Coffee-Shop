<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Brew Haven Coffee Shop</title>
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
            display: flex;
            align-items: center;
        }

        .login-container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(93, 64, 55, 0.15);
            overflow: hidden;
            min-height: 400px;
        }

        .login-image {
            background: linear-gradient(135deg, #3e2723 0%, #5d4037 100%);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 110px;
        }

        .login-image::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M0,0 L100,0 L100,100 Z" fill="rgba(255,255,255,0.1)"/></svg>');
            background-size: cover;
        }

        .coffee-illustration {
            position: relative;
            z-index: 2;
            text-align: center;
            color: white;
        }

        .coffee-icon {
            font-size: 4rem;
            margin-bottom: 20px;
            opacity: 0.9;
        }

        .brand-logo {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 10px;
            letter-spacing: 1px;
        }

        .brand-tagline {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 30px;
        }

        .feature-list {
            text-align: left;
            max-width: 300px;
            margin: 0 auto;
        }

        .feature-list li {
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            font-size: 0.95rem;
        }

        .feature-list i {
            margin-right: 10px;
            color: #d7ccc8;
        }

        .login-form {
            padding: 60px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
        }

        .form-header {
            text-align: center;
            margin-bottom: 40px;
        }

        .form-header h2 {
            color: #5d4037;
            font-weight: 700;
            font-size: 2.2rem;
            margin-bottom: 10px;
        }

        .form-header p {
            color: #795548;
            font-size: 1.1rem;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            color: #5d4037;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 1rem;
        }

        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            padding: 14px 18px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #fafafa;
        }

        .form-control:focus {
            border-color: #8d6e63;
            box-shadow: 0 0 0 0.2rem rgba(141, 110, 99, 0.25);
            background: white;
        }

        .input-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #8d6e63;
            z-index: 3;
        }

        .input-with-icon {
            padding-left: 45px;
        }

        .btn-login {
            background: linear-gradient(135deg, #5d4037, #4e342e);
            border: none;
            color: white;
            padding: 14px 30px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(93, 64, 55, 0.3);
            width: 100%;
            margin-top: 10px;
        }

        .btn-login:hover {
            background: linear-gradient(135deg, #4e342e, #3e2723);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(93, 64, 55, 0.4);
        }

        .register-link {
            text-align: center;
            margin-top: 25px;
        }

        .register-link a {
            color: #8d6e63;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .register-link a:hover {
            color: #5d4037;
            text-decoration: underline;
        }

        /* Alert Styling */
        .alert {
            border: none;
            border-radius: 12px;
            padding: 15px 20px;
            margin-bottom: 25px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border-left: 5px solid;
        }

        .alert-danger {
            background: linear-gradient(135deg, #ffebee, #ffcdd2);
            color: #c62828;
            border-left-color: #f44336;
        }

        .alert-success {
            background: linear-gradient(135deg, #e8f5e8, #dcedc8);
            color: #2e7d32;
            border-left-color: #4caf50;
        }

        /* Password Toggle */
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #8d6e63;
            cursor: pointer;
            z-index: 3;
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .login-container {
                max-width: 500px;
            }
            
            .login-image {
                display: none;
            }
            
            .login-form {
                padding: 40px 30px;
            }
        }

        @media (max-width: 576px) {
            .login-form {
                padding: 30px 20px;
            }
            
            .form-header h2 {
                font-size: 1.8rem;
            }
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-form > * {
            animation: fadeIn 0.6s ease-out;
        }

        .form-group:nth-child(1) { animation-delay: 0.1s; }
        .form-group:nth-child(2) { animation-delay: 0.2s; }
        .btn-login { animation-delay: 0.3s; }
        .register-link { animation-delay: 0.4s; }

        /* Decorative Elements */
        .coffee-bean {
            position: absolute;
            width: 30px;
            height: 20px;
            background: #8d6e63;
            border-radius: 50%;
            opacity: 0.3;
            animation: float 6s ease-in-out infinite;
        }

        .coffee-bean:nth-child(1) {
            top: 20%;
            left: 15%;
            animation-delay: 0s;
        }

        .coffee-bean:nth-child(2) {
            top: 60%;
            right: 20%;
            animation-delay: 2s;
        }

        .coffee-bean:nth-child(3) {
            bottom: 30%;
            left: 25%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xxl-10 col-12">
                <div class="login-container">
                    <div class="row g-0">
                        <!-- Left Side - Brand/Image Section (Hidden on mobile) -->
                        <div class="col-lg-6 d-none d-lg-block">
                            <div class="login-image">
                                <!-- Decorative coffee beans -->
                                <div class="coffee-bean"></div>
                                <div class="coffee-bean"></div>
                                <div class="coffee-bean"></div>
                                
                                <!-- Brand illustration section -->
                                <div class="coffee-illustration">
                                    <!-- Main coffee icon -->
                                    <div class="coffee-icon">
                                        <i class="fas fa-coffee"></i>
                                    </div>
                                    <!-- Brand name -->
                                    <div class="brand-logo">BREW HAVEN</div>
                                    <!-- Brand tagline -->
                                    <div class="brand-tagline">Where Every Cup Tells a Story</div>
                                    
                                    <!-- Feature list -->
                                    <ul class="feature-list list-unstyled">
                                        <li>
                                            <i class="fas fa-check-circle"></i>
                                            Premium Arabica & Robusta Beans
                                        </li>
                                        <li>
                                            <i class="fas fa-check-circle"></i>
                                            Artisanal Brewing Methods
                                        </li>
                                        <li>
                                            <i class="fas fa-check-circle"></i>
                                            Cozy & Inviting Atmosphere
                                        </li>
                                        <li>
                                            <i class="fas fa-check-circle"></i>
                                            Sustainable & Ethical Sourcing
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Right Side - Login Form -->
                        <div class="col-lg-6 col-12">
                            <div class="login-form">
                                <!-- Form header -->
                                <div class="form-header">
                                    <h2>Welcome Back</h2>
                                    <p>Sign in to your Brew Haven account</p>
                                </div>

                                <!-- Error message display -->
                                <?php if (session()->getFlashdata('error')): ?>
                                    <div class="alert alert-danger">
                                        <i class="fas fa-exclamation-circle me-2"></i>
                                        <?= session()->getFlashdata('error') ?>
                                    </div>
                                <?php endif; ?>

                                <!-- Success message display -->
                                <?php if (session()->getFlashdata('success')): ?>
                                    <div class="alert alert-success">
                                        <i class="fas fa-check-circle me-2"></i>
                                        <?= session()->getFlashdata('success') ?>
                                    </div>
                                <?php endif; ?>

                                <!-- Login form -->
                                <form action="/login" method="post">
                                    <!-- Email input field -->
                                    <div class="form-group">
                                        <label for="email" class="form-label">Email Address</label>
                                        <div class="input-group">
                                            <i class="fas fa-envelope input-icon"></i>
                                            <input type="email" class="form-control input-with-icon" id="email" name="email" placeholder="Enter your email" required>
                                        </div>
                                    </div>
                                    
                                    <!-- Password input field with toggle -->
                                    <div class="form-group">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group">
                                            <i class="fas fa-lock input-icon"></i>
                                            <input type="password" class="form-control input-with-icon" id="password" name="password" placeholder="Enter your password" required>
                                            <!-- Password visibility toggle -->
                                            <button type="button" class="password-toggle" id="togglePassword">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <!-- Submit button -->
                                    <button type="submit" class="btn btn-login">
                                        <i class="fas fa-sign-in-alt me-2"></i>Sign In
                                    </button>
                                </form>
                                
                                <!-- Registration link -->
                                <div class="register-link">
                                    <p>Don't have an account? <a href="/register">Create one here</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Password visibility toggle functionality
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');
            
            // Toggle password visibility
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });

        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(function(alert) {
                    alert.style.opacity = '0';
                    alert.style.transition = 'opacity 0.5s ease';
                    setTimeout(function() {
                        alert.remove();
                    }, 500);
                });
            }, 5000);
        });

        // Input focus effects for icons
        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(input => {
            // Change icon color on focus
            input.addEventListener('focus', function() {
                this.parentElement.querySelector('.input-icon').style.color = '#5d4037';
            });
            
            // Reset icon color on blur
            input.addEventListener('blur', function() {
                this.parentElement.querySelector('.input-icon').style.color = '#8d6e63';
            });
        });
    </script>
</body>
</html>