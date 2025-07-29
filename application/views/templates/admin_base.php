<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="<?php echo isset($meta_description) ? htmlspecialchars($meta_description, ENT_QUOTES, 'UTF-8') : 'Modern Agent Admin Panel'; ?>">
    <meta name="robots" content="noindex, nofollow">
    
    <!-- Security Headers -->
    <meta name="referrer" content="strict-origin-when-cross-origin">
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <meta http-equiv="X-Frame-Options" content="DENY">
    <meta http-equiv="X-XSS-Protection" content="1; mode=block">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval' https://maxcdn.bootstrapcdn.com; style-src 'self' 'unsafe-inline' https://maxcdn.bootstrapcdn.com https://fonts.googleapis.com; font-src 'self' https://maxcdn.bootstrapcdn.com https://fonts.gstatic.com; img-src 'self' data: https:;">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo isset($csrf_token) ? htmlspecialchars($csrf_token, ENT_QUOTES, 'UTF-8') : ''; ?>">
    
    <title><?php echo isset($title) ? htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . ' - Admin Panel' : 'Admin Panel'; ?> | Modern Agent</title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/img/favicon.ico'); ?>" type="image/x-icon">
    
    <!-- Preload critical resources -->
    <link rel="preload" href="<?php echo base_url('assets/css/optimized-styles.css'); ?>" as="style">
    <link rel="preload" href="<?php echo base_url('assets/js/security.js'); ?>" as="script">
    
    <!-- CSS Files -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/optimized-styles.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/admin-style.css'); ?>">
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.dataTables.min.css'); ?>">
    
    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/js/jquery-ui/jquery-ui-1.10.1.custom.min.css'); ?>">
    
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/jquery-toastr/toastr.min.css'); ?>">
    
    <!-- Font Awesome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <?php if (isset($additional_css) && is_array($additional_css)): ?>
        <?php foreach ($additional_css as $css_file): ?>
            <link rel="stylesheet" href="<?php echo base_url($css_file); ?>">
        <?php endforeach; ?>
    <?php endif; ?>
    
    <!-- Core JavaScript (in head for admin functionality) -->
    <script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
    <script>
        // Global configuration
        var BASE_URL = '<?php echo base_url(); ?>';
        var CSRF_TOKEN = '<?php echo isset($csrf_token) ? htmlspecialchars($csrf_token, ENT_QUOTES, 'UTF-8') : ''; ?>';
    </script>
</head>
<body class="admin-body <?php echo isset($body_class) ? htmlspecialchars($body_class, ENT_QUOTES, 'UTF-8') : ''; ?>">
    <!-- Skip to main content for accessibility -->
    <a href="#main-content" class="sr-only sr-only-focusable">Skip to main content</a>
    
    <!-- Alert Container for notifications -->
    <div class="alert-container" id="alert-container"></div>
    
    <?php if (!isset($hide_header) || !$hide_header): ?>
    <!-- Admin Header -->
    <header class="admin-header" role="banner">
        <div class="container-fluid">
            <nav class="admin-nav" role="navigation" aria-label="Main navigation">
                <div class="admin-logo">
                    <a href="<?php echo site_url('admin/dashboard/'); ?>" aria-label="Go to Admin Dashboard">
                        <img src="<?php echo base_url('assets/images-2/logo.png'); ?>" alt="Modern Agent Logo" class="logo-img">
                    </a>
                </div>
                
                <div class="admin-nav-controls">
                    <!-- Mobile menu toggle -->
                    <button class="btn-collapse-sidebar-left navbar-toggle" 
                            id="menu-toggle" 
                            data-toggle="collapse" 
                            data-target=".navbar-ex1-collapse"
                            aria-label="Toggle navigation menu"
                            aria-expanded="false">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </button>
                    
                    <!-- User menu -->
                    <div class="admin-user-menu">
                        <?php if (isset($user_name)): ?>
                            <span class="admin-user-name">Welcome, <?php echo htmlspecialchars($user_name, ENT_QUOTES, 'UTF-8'); ?></span>
                        <?php endif; ?>
                        
                        <div class="admin-user-actions">
                            <a href="<?php echo site_url('admin/profile'); ?>" class="btn btn-sm btn-secondary" aria-label="View Profile">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span class="sr-only">Profile</span>
                            </a>
                            <a href="<?php echo site_url('admin/logout'); ?>" class="btn btn-sm btn-danger" aria-label="Logout">
                                <i class="fa fa-sign-out" aria-hidden="true"></i>
                                <span class="sr-only">Logout</span>
                            </a>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <?php endif; ?>
    
    <?php if (!isset($hide_sidebar) || !$hide_sidebar): ?>
    <!-- Admin Sidebar Navigation -->
    <aside class="admin-sidebar" role="complementary" aria-label="Admin navigation">
        <nav class="sidebar-nav">
            <ul class="nav nav-sidebar">
                <li class="nav-item">
                    <a href="<?php echo site_url('admin/dashboard'); ?>" class="nav-link">
                        <i class="fa fa-dashboard" aria-hidden="true"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo site_url('admin/deals'); ?>" class="nav-link">
                        <i class="fa fa-handshake-o" aria-hidden="true"></i> Manage Deals
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo site_url('admin/manage_user'); ?>" class="nav-link">
                        <i class="fa fa-users" aria-hidden="true"></i> Manage Users
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo site_url('admin/manage_orders'); ?>" class="nav-link">
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i> Manage Orders
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo site_url('admin/store_types'); ?>" class="nav-link">
                        <i class="fa fa-building" aria-hidden="true"></i> Store Types
                    </a>
                </li>
            </ul>
        </nav>
    </aside>
    <?php endif; ?>
    
    <!-- Main Content Area -->
    <main id="main-content" class="admin-content <?php echo (!isset($hide_sidebar) || !$hide_sidebar) ? 'with-sidebar' : 'full-width'; ?>" role="main">
        <?php if (isset($breadcrumbs) && is_array($breadcrumbs)): ?>
        <!-- Breadcrumb Navigation -->
        <nav aria-label="Breadcrumb" class="breadcrumb-nav">
            <ol class="breadcrumb">
                <?php foreach ($breadcrumbs as $index => $crumb): ?>
                    <?php if ($index === count($breadcrumbs) - 1): ?>
                        <li class="breadcrumb-item active" aria-current="page">
                            <?php echo htmlspecialchars($crumb['title'], ENT_QUOTES, 'UTF-8'); ?>
                        </li>
                    <?php else: ?>
                        <li class="breadcrumb-item">
                            <a href="<?php echo htmlspecialchars($crumb['url'], ENT_QUOTES, 'UTF-8'); ?>">
                                <?php echo htmlspecialchars($crumb['title'], ENT_QUOTES, 'UTF-8'); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ol>
        </nav>
        <?php endif; ?>
        
        <!-- Page Content -->
        <div class="admin-page-content">
            <?php echo isset($content) ? $content : ''; ?>
        </div>
    </main>
    
    <!-- Footer -->
    <?php if (!isset($hide_footer) || !$hide_footer): ?>
    <footer class="admin-footer" role="contentinfo">
        <div class="container-fluid">
            <div class="admin-footer-content">
                <span>&copy; <?php echo date('Y'); ?> Modern Agent. All rights reserved.</span>
            </div>
        </div>
    </footer>
    <?php endif; ?>
    
    <!-- JavaScript Files -->
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/security.js'); ?>"></script>
    
    <!-- jQuery UI -->
    <script src="<?php echo base_url('assets/js/jquery-ui/jquery-ui-1.10.1.custom.min.js'); ?>"></script>
    
    <!-- DataTables -->
    <script src="<?php echo base_url('assets/js/jquery.dataTables.min.js'); ?>"></script>
    
    <!-- Toastr -->
    <script src="<?php echo base_url('assets/js/jquery-toastr/toastr.min.js'); ?>"></script>
    
    <!-- Common Admin JS -->
    <script src="<?php echo base_url('assets/js/customjs/common.js'); ?>"></script>
    
    <?php if (isset($additional_js) && is_array($additional_js)): ?>
        <?php foreach ($additional_js as $js_file): ?>
            <script src="<?php echo base_url($js_file); ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
    
    <!-- Admin-specific initialization -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize DataTables with common settings
            if ($.fn.DataTable) {
                $('.data-table').DataTable({
                    responsive: true,
                    pageLength: 25,
                    language: {
                        search: "Search:",
                        lengthMenu: "Show _MENU_ entries",
                        info: "Showing _START_ to _END_ of _TOTAL_ entries",
                        paginate: {
                            first: "First",
                            last: "Last",
                            next: "Next",
                            previous: "Previous"
                        }
                    }
                });
            }
            
            // Initialize tooltips
            $('[data-toggle="tooltip"]').tooltip();
            
            // Initialize confirmation dialogs
            $('.confirm-action').on('click', function(e) {
                const message = $(this).data('confirm-message') || 'Are you sure you want to perform this action?';
                if (!confirm(message)) {
                    e.preventDefault();
                    return false;
                }
            });
            
            // Auto-hide alerts after 5 seconds
            $('.alert').each(function() {
                const alert = $(this);
                setTimeout(function() {
                    alert.fadeOut();
                }, 5000);
            });
        });
    </script>
    
    <!-- Inline JavaScript for page-specific functionality -->
    <?php if (isset($inline_js)): ?>
        <script>
            <?php echo $inline_js; ?>
        </script>
    <?php endif; ?>
</body>
</html>