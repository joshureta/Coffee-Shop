<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Brew Haven Coffee Shop</title>
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

        .register-container {
            max-width: 1200px;
            margin: 20px auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(93, 64, 55, 0.15);
            overflow: hidden;
            min-height: 650px;
        }

        .register-image {
            background: linear-gradient(135deg, #3e2723 0%, #5d4037 100%);
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            height: 100%;
        }

        .register-image::before {
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

        .register-form {
            padding: 50px 40px 30px 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            height: 100%;
        }

        .form-header {
            text-align: center;
            margin-bottom: 35px;
        }

        .form-header h2 {
            color: #5d4037;
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 8px;
        }

        .form-header p {
            color: #795548;
            font-size: 1rem;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            color: #5d4037;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 0.95rem;
        }

        .form-control {
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 0.95rem;
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
            font-size: 0.9rem;
        }

        .input-with-icon {
            padding-left: 40px;
        }

        .btn-register {
            background: linear-gradient(135deg, #388e3c, #2e7d32);
            border: none;
            color: white;
            padding: 12px 30px;
            border-radius: 10px;
            font-weight: 600;
            font-size: 1rem;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(56, 142, 60, 0.3);
            width: 100%;
            margin-top: 10px;
            margin-bottom: 5px;
        }

        .btn-register:hover {
            background: linear-gradient(135deg, #2e7d32, #1b5e20);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(56, 142, 60, 0.4);
        }

        .login-link {
            text-align: center;
            margin-top: 15px;
        }

        .login-link a {
            color: #8d6e63;
            text-decoration: none;
            font-weight: 600;
            transition: color 0.3s ease;
            font-size: 0.9rem;
        }

        .login-link a:hover {
            color: #5d4037;
            text-decoration: underline;
        }

        /* Alert Styling */
        .alert {
            border: none;
            border-radius: 10px;
            padding: 12px 15px;
            margin-bottom: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            border-left: 4px solid;
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
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #8d6e63;
            cursor: pointer;
            z-index: 3;
            font-size: 0.9rem;
        }

        /* Password Strength Indicator */
        .password-strength {
            height: 3px;
            border-radius: 2px;
            margin-top: 5px;
            transition: all 0.3s ease;
        }

        .strength-weak { background: #f44336; width: 25%; }
        .strength-medium { background: #ff9800; width: 50%; }
        .strength-strong { background: #4caf50; width: 100%; }

        /* Responsive Design */
        @media (max-width: 992px) {
            .register-container {
                max-width: 450px;
                margin: 20px auto;
                min-height: auto;
            }
            
            .register-image {
                display: none;
            }
            
            .register-form {
                padding: 40px 30px 25px 30px;
            }
        }

        @media (max-width: 576px) {
            .register-form {
                padding: 30px 20px 20px 20px;
            }
            
            .form-header h2 {
                font-size: 1.7rem;
            }
        }

        /* Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .register-form > * {
            animation: fadeIn 0.6s ease-out;
        }

        .form-group:nth-child(1) { animation-delay: 0.1s; }
        .form-group:nth-child(2) { animation-delay: 0.2s; }
        .form-group:nth-child(3) { animation-delay: 0.3s; }
        .btn-register { animation-delay: 0.4s; }
        .login-link { animation-delay: 0.5s; }

        /* Decorative Elements */
        .coffee-bean {
            position: absolute;
            width: 25px;
            height: 15px;
            background: #8d6e63;
            border-radius: 50%;
            opacity: 0.3;
            animation: float 6s ease-in-out infinite;
        }

        .coffee-bean:nth-child(1) {
            top: 15%;
            left: 10%;
            animation-delay: 0s;
        }

        .coffee-bean:nth-child(2) {
            top: 65%;
            right: 15%;
            animation-delay: 2s;
        }

        .coffee-bean:nth-child(3) {
            bottom: 25%;
            left: 20%;
            animation-delay: 4s;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(180deg); }
        }

        /* Form Validation Styling */
        .is-invalid {
            border-color: #f44336 !important;
        }

        .invalid-feedback {
            display: block;
            color: #f44336;
            font-size: 0.8rem;
            margin-top: 5px;
        }

        html, body {
            height: 100%;
        }
        
        .container-fluid {
            height: 100%;
            padding: 0;
        }
        
        .row.justify-content-center {
            height: 100%;
            align-items: center;
        }

        .form-text {
            font-size: 0.8rem;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xxl-10 col-12">
                <div class="register-container">
                    <div class="row g-0" style="height: 100%;">
                        <!-- Left Side - Brand/Image Section (Hidden on mobile) -->
                        <div class="col-lg-6 d-none d-lg-block">
                            <div class="register-image">
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
                                    
                                    <!-- Feature list for registration benefits -->
                                    <ul class="feature-list list-unstyled">
                                        <li>
                                            <i class="fas fa-check-circle"></i>
                                            Join Our Coffee Community
                                        </li>
                                        <li>
                                            <i class="fas fa-check-circle"></i>
                                            Exclusive Member Benefits
                                        </li>
                                        <li>
                                            <i class="fas fa-check-circle"></i>
                                            Personalized Coffee Experience
                                        </li>
                                        <li>
                                            <i class="fas fa-check-circle"></i>
                                            Early Access to New Blends
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Right Side - Registration Form -->
                        <div class="col-lg-6 col-12">
                            <div class="register-form">
                                <!-- Form header -->
                                <div class="form-header">
                                    <h2>Join Brew Haven</h2>
                                    <p>Create your account and start your coffee journey</p>
                                </div>

                                <!-- Validation errors display -->
                                <?php if (session()->getFlashdata('errors')): ?>
                                    <div class="alert alert-danger">
                                        <i class="fas fa-exclamation-circle me-2"></i>
                                        Please fix the following errors:
                                        <ul class="mb-0 mt-2">
                                            <!-- Loop through each validation error -->
                                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                                <li><?= $error ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>

                                <!-- General error message display -->
                                <?php if (session()->getFlashdata('error')): ?>
                                    <div class="alert alert-danger">
                                        <i class="fas fa-exclamation-circle me-2"></i>
                                        <?= session()->getFlashdata('error') ?>
                                    </div>
                                <?php endif; ?>

                                <!-- Registration form -->
                                <form action="/register" method="post" id="registerForm">
                                    <!-- Username input field -->
                                    <div class="form-group">
                                        <label for="username" class="form-label">Username</label>
                                        <div class="input-group">
                                            <i class="fas fa-user input-icon"></i>
                                            <input type="text" class="form-control input-with-icon" id="username" name="username" 
                                                   placeholder="Choose a username" value="<?= old('username') ?>" required>
                                        </div>
                                        <!-- Username validation error display -->
                                        <div class="invalid-feedback" id="usernameError"></div>
                                    </div>
                                    
                                    <!-- Email input field -->
                                    <div class="form-group">
                                        <label for="email" class="form-label">Email Address</label>
                                        <div class="input-group">
                                            <i class="fas fa-envelope input-icon"></i>
                                            <input type="email" class="form-control input-with-icon" id="email" name="email" 
                                                   placeholder="Enter your email" value="<?= old('email') ?>" required>
                                        </div>
                                        <!-- Email validation error display -->
                                        <div class="invalid-feedback" id="emailError"></div>
                                    </div>
                                    
                                    <!-- Password input field -->
                                    <div class="form-group">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group">
                                            <i class="fas fa-lock input-icon"></i>
                                            <input type="password" class="form-control input-with-icon" id="password" name="password" 
                                                   placeholder="Create a password" required minlength="8">
                                            <!-- Password visibility toggle -->
                                            <button type="button" class="password-toggle" id="togglePassword">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </div>
                                        <!-- Password strength indicator -->
                                        <div class="password-strength" id="passwordStrength"></div>
                                        <!-- Password validation error display -->
                                        <div class="invalid-feedback" id="passwordError"></div>
                                        <small class="form-text text-muted">Password must be at least 8 characters long</small>
                                    </div>
                                    
                                    <!-- Submit button -->
                                    <button type="submit" class="btn btn-register">
                                        <i class="fas fa-user-plus me-2"></i>Create Account
                                    </button>
                                </form>
                                
                                <!-- Login link for existing users -->
                                <div class="login-link">
                                    <p>Already have an account? <a href="/login">Sign in here</a></p>
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
            
            // Toggle password visibility and icon
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

        // Password strength indicator
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthBar = document.getElementById('passwordStrength');
            
            // Reset strength bar classes
            strengthBar.className = 'password-strength';
            
            // Skip strength calculation if password is empty
            if (password.length === 0) return;
            
            let strength = 0;
            
            // Length-based strength
            if (password.length >= 8) strength++;
            if (password.length >= 12) strength++;
            
            // Character variety checks
            if (/[a-z]/.test(password)) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^a-zA-Z0-9]/.test(password)) strength++;
            
            // Apply strength classes based on score
            if (strength <= 2) {
                strengthBar.classList.add('strength-weak');
            } else if (strength <= 4) {
                strengthBar.classList.add('strength-medium');
            } else {
                strengthBar.classList.add('strength-strong');
            }
        });

        // Form validation on submit
        document.getElementById('registerForm').addEventListener('submit', function(e) {
            let isValid = true;
            
            // Username validation (minimum length)
            const username = document.getElementById('username');
            const usernameError = document.getElementById('usernameError');
            if (username.value.length < 3) {
                username.classList.add('is-invalid');
                usernameError.textContent = 'Username must be at least 3 characters long';
                isValid = false;
            } else {
                username.classList.remove('is-invalid');
                usernameError.textContent = '';
            }
            
            // Email validation (format)
            const email = document.getElementById('email');
            const emailError = document.getElementById('emailError');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email.value)) {
                email.classList.add('is-invalid');
                emailError.textContent = 'Please enter a valid email address';
                isValid = false;
            } else {
                email.classList.remove('is-invalid');
                emailError.textContent = '';
            }
            
            // Password validation (minimum length)
            const password = document.getElementById('password');
            const passwordError = document.getElementById('passwordError');
            if (password.value.length < 8) {
                password.classList.add('is-invalid');
                passwordError.textContent = 'Password must be at least 8 characters long';
                isValid = false;
            } else {
                password.classList.remove('is-invalid');
                passwordError.textContent = '';
            }
            
            // Prevent form submission if validation fails
            if (!isValid) {
                e.preventDefault();
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