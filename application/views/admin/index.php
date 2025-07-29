<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Generate CSRF token for forms
$csrf_token = hash('sha256', uniqid() . time());
// Store in session for validation (you'd implement this in your controller)
// $this->session->set_userdata('csrf_token', $csrf_token);

// Template data
$template_data = array(
    'title' => isset($title) ? $title : 'Admin Login',
    'csrf_token' => $csrf_token,
    'hide_header' => true,
    'hide_sidebar' => true,
    'hide_footer' => true,
    'body_class' => 'admin-login-page',
    'additional_css' => array(),
    'additional_js' => array(
        'assets/js/jquery.validate.min.js',
        'assets/js/jquery-toastr/toastr.min.js',
        'assets/js/jquery-toastr/ui-toastr-notifications.js',
        'assets/js/extra.js'
    )
);
?>
                       <form method="post" autocomplete="off" action="<?php echo site_url('admin/login'); ?>" class="omb_loginForm" id="adminlogin-form">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <input type="text" placeholder="Username" class="form-control" name="aname" id="aname">
                                </div>
                                <label id="error_aname" for="aname" class="error"></label>

// Capture the login page content
ob_start();
?>

<div class="admin-container">
    <div class="container">
        <main class="login-box" role="main">
            <!-- Login Header -->
            <header class="login-header text-center">
                <img src="<?php echo base_url('assets/admin/images/logo.png'); ?>" 
                     alt="Modern Agent Logo" 
                     class="login-logo">
                <h1 class="login-title">Admin Dashboard</h1>
            </header>

            <!-- Login Form -->
            <section class="login-form-section">
                <form method="post" 
                      autocomplete="off" 
                      action="<?php echo site_url('admin/adminlogin'); ?>" 
                      class="login-form" 
                      id="adminlogin-form"
                      data-validate="true"
                      novalidate>
                    
                    <!-- CSRF Token -->
                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token, ENT_QUOTES, 'UTF-8'); ?>">
                    
                    <div class="form-group">
                        <label for="aname" class="form-label sr-only">Username</label>
                        <div class="input-group">
                            <span class="input-group-addon" aria-hidden="true">
                                <i class="fa fa-user"></i>
                            </span>
                            <input type="text" 
                                   placeholder="Username" 
                                   class="form-input" 
                                   name="aname" 
                                   id="aname"
                                   required
                                   autocomplete="username"
                                   aria-describedby="aname-error">
                        </div>
                        <div id="aname-error" class="error-message" aria-live="polite"></div>
                    </div>

                    <div class="form-group">
                        <label for="apass" class="form-label sr-only">Password</label>
                        <div class="input-group">
                            <span class="input-group-addon" aria-hidden="true">
                                <i class="fa fa-lock"></i>
                            </span>
                            <input type="password" 
                                   placeholder="Password" 
                                   class="form-input" 
                                   name="apass" 
                                   id="apass"
                                   required
                                   autocomplete="current-password"
                                   aria-describedby="apass-error">
                        </div>
                        <div id="apass-error" class="error-message" aria-live="polite"></div>
                    </div>

                    <div class="form-options">
                        <div class="checkbox-container">
                            <label class="checkbox-label">
                                <input type="checkbox" name="rememberme" id="rememberme">
                                <span class="checkmark"></span>
                                Remember Me
                            </label>
                        </div>
                        <div class="forgot-password">
                            <a href="#" 
                               class="forgot-link" 
                               data-modal-target="forgot-password-modal"
                               aria-label="Open forgot password form">
                                Forgot password?
                            </a>
                        </div>
                    </div>

                    <div class="form-submit">
                        <button type="submit" 
                                class="btn btn-primary btn-block admin-signin-btn"
                                id="signin-btn">
                            <span class="btn-text">Sign In</span>
                            <span class="btn-loading" style="display: none;">
                                <i class="fa fa-spinner fa-spin"></i> Signing in...
                            </span>
                        </button>
                    </div>
                </form>
            </section>
        </main>
    </div>
</div>

<!-- Forgot Password Modal -->
<div class="modal" id="forgot-password-modal" aria-hidden="true" role="dialog" aria-labelledby="forgot-password-title">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <header class="modal-header">
                <h2 class="modal-title" id="forgot-password-title">Reset Password</h2>
                <button type="button" 
                        class="close" 
                        data-modal-close
                        aria-label="Close modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </header>
            
            <form method="post" 
                  action="<?php echo site_url('admin/forget_password'); ?>" 
                  class="forgot-password-form" 
                  id="forgot-form"
                  data-validate="true"
                  novalidate>
                
                <!-- CSRF Token -->
                <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token, ENT_QUOTES, 'UTF-8'); ?>">
                
                <div class="modal-body">
                    <p>Enter your email address and we'll send you a link to reset your password.</p>
                    
                    <div class="form-group">
                        <label for="useremail" class="form-label">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-addon" aria-hidden="true">
                                <i class="fa fa-envelope"></i>
                            </span>
                            <input type="email" 
                                   placeholder="Enter your email address" 
                                   name="useremail" 
                                   class="form-input" 
                                   id="useremail"
                                   required
                                   autocomplete="email"
                                   aria-describedby="useremail-error">
                        </div>
                        <div id="useremail-error" class="error-message" aria-live="polite"></div>
                    </div>
                </div>
                
                <footer class="modal-footer">
                    <button type="button" 
                            class="btn btn-secondary" 
                            data-modal-close>
                        Cancel
                    </button>
                    <button type="submit" 
                            class="btn btn-primary" 
                            id="forgot-submit">
                        <span class="btn-text">Send Reset Link</span>
                        <span class="btn-loading" style="display: none;">
                            <i class="fa fa-spinner fa-spin"></i> Sending...
                        </span>
                    </button>
                </footer>
            </form>
        </div>
    </div>
</div>

<?php
$template_data['content'] = ob_get_clean();

// Additional inline JavaScript for the page
$template_data['inline_js'] = '
// Admin login functionality
(function() {
    "use strict";
    
    const AdminLogin = {
        init: function() {
            this.bindEvents();
            this.setupValidation();
        },
        
        bindEvents: function() {
            // Login form submission
            document.getElementById("adminlogin-form").addEventListener("submit", this.handleLoginSubmit.bind(this));
            
            // Forgot password form submission  
            document.getElementById("forgot-form").addEventListener("submit", this.handleForgotSubmit.bind(this));
            
            // Real-time validation
            document.getElementById("aname").addEventListener("blur", this.validateUsername);
            document.getElementById("apass").addEventListener("blur", this.validatePassword);
            document.getElementById("useremail").addEventListener("blur", this.validateEmail);
        },
        
        setupValidation: function() {
            // Enhanced form validation beyond the basic security.js validation
            const loginForm = document.getElementById("adminlogin-form");
            const forgotForm = document.getElementById("forgot-form");
            
            if (loginForm) {
                loginForm.setAttribute("novalidate", "true");
            }
            if (forgotForm) {
                forgotForm.setAttribute("novalidate", "true");
            }
        },
        
        validateUsername: function() {
            const username = document.getElementById("aname");
            const value = username.value.trim();
            
            if (!value) {
                ModernAgentSecurity.markFieldInvalid(username, "Please enter username.");
                return false;
            } else if (value.length < 3) {
                ModernAgentSecurity.markFieldInvalid(username, "Username must be at least 3 characters.");
                return false;
            } else {
                ModernAgentSecurity.markFieldValid(username);
                return true;
            }
        },
        
        validatePassword: function() {
            const password = document.getElementById("apass");
            const value = password.value;
            
            if (!value) {
                ModernAgentSecurity.markFieldInvalid(password, "Please enter password.");
                return false;
            } else if (value.length < 6) {
                ModernAgentSecurity.markFieldInvalid(password, "Password must be at least 6 characters.");
                return false;
            } else {
                ModernAgentSecurity.markFieldValid(password);
                return true;
            }
        },
        
        validateEmail: function() {
            const email = document.getElementById("useremail");
            const value = email.value.trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            if (!value) {
                ModernAgentSecurity.markFieldInvalid(email, "Please enter email address.");
                return false;
            } else if (!emailRegex.test(value)) {
                ModernAgentSecurity.markFieldInvalid(email, "Please enter a valid email address.");
                return false;
            } else {
                ModernAgentSecurity.markFieldValid(email);
                return true;
            }
        },
        
        handleLoginSubmit: function(event) {
            event.preventDefault();
            
            const form = event.target;
            const submitBtn = document.getElementById("signin-btn");
            const btnText = submitBtn.querySelector(".btn-text");
            const btnLoading = submitBtn.querySelector(".btn-loading");
            
            // Validate form
            const isUsernameValid = this.validateUsername();
            const isPasswordValid = this.validatePassword();
            
            if (!isUsernameValid || !isPasswordValid) {
                return false;
            }
            
            // Show loading state
            this.setLoadingState(submitBtn, btnText, btnLoading, true);
            
            // Prepare form data
            const formData = new FormData(form);
            
            // Send AJAX request
            fetch(form.action, {
                method: "POST",
                body: formData,
                headers: {
                    "X-Requested-With": "XMLHttpRequest"
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "admin_success") {
                    ModernAgentSecurity.showAlert("Login successful! Redirecting...", "success");
                    setTimeout(() => {
                        window.location.href = "' . site_url('admin/dashboard') . '";
                    }, 1000);
                } else {
                    ModernAgentSecurity.showAlert(data.msg || "Login failed. Please try again.", "danger");
                    this.setLoadingState(submitBtn, btnText, btnLoading, false);
                }
            })
            .catch(error => {
                console.error("Login error:", error);
                ModernAgentSecurity.showAlert("An error occurred. Please try again.", "danger");
                this.setLoadingState(submitBtn, btnText, btnLoading, false);
            });
            
            return false;
        },
        
        handleForgotSubmit: function(event) {
            event.preventDefault();
            
            const form = event.target;
            const submitBtn = document.getElementById("forgot-submit");
            const btnText = submitBtn.querySelector(".btn-text");
            const btnLoading = submitBtn.querySelector(".btn-loading");
            
            // Validate email
            if (!this.validateEmail()) {
                return false;
            }
            
            // Show loading state
            this.setLoadingState(submitBtn, btnText, btnLoading, true);
            
            // Prepare form data
            const formData = new FormData(form);
            
            // Send AJAX request
            fetch(form.action, {
                method: "POST",
                body: formData,
                headers: {
                    "X-Requested-With": "XMLHttpRequest"
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    ModernAgentSecurity.showAlert(data.msg || "Password reset link sent successfully!", "success");
                    form.reset();
                    ModernAgentModal.closeAllModals();
                } else {
                    ModernAgentSecurity.showAlert(data.msg || "Failed to send reset link. Please try again.", "danger");
                }
                this.setLoadingState(submitBtn, btnText, btnLoading, false);
            })
            .catch(error => {
                console.error("Forgot password error:", error);
                ModernAgentSecurity.showAlert("An error occurred. Please try again.", "danger");
                this.setLoadingState(submitBtn, btnText, btnLoading, false);
            });
            
            return false;
        },
        
        setLoadingState: function(button, textElement, loadingElement, isLoading) {
            if (isLoading) {
                button.disabled = true;
                textElement.style.display = "none";
                loadingElement.style.display = "inline";
            } else {
                button.disabled = false;
                textElement.style.display = "inline";
                loadingElement.style.display = "none";
            }
        }
    };
    
    // Initialize when DOM is ready
    document.addEventListener("DOMContentLoaded", function() {
        AdminLogin.init();
    });
})();
';

// Load the admin base template
$this->load->view('templates/admin_base', $template_data);
?>