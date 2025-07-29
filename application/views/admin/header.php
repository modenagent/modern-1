<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Generate CSRF token for any forms on the page
$csrf_token = hash('sha256', uniqid() . time());

// Get user information with proper escaping
$user_name = htmlspecialchars($this->session->userdata('name') ?? 'User', ENT_QUOTES, 'UTF-8');
$user_avatar = base_url('assets/admin/images/chat-avatar2.jpg');

// Page title for navigation highlighting
$page_title = isset($title) ? $title : '';
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="<?php echo htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8'); ?> - Modern Agent Admin Panel">
    <meta name="robots" content="noindex, nofollow">
    
    <!-- Security Headers -->
    <meta name="referrer" content="strict-origin-when-cross-origin">
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <meta http-equiv="X-Frame-Options" content="DENY">
    <meta http-equiv="X-XSS-Protection" content="1; mode=block">
    <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval' https://maxcdn.bootstrapcdn.com; style-src 'self' 'unsafe-inline' https://maxcdn.bootstrapcdn.com https://fonts.googleapis.com; font-src 'self' https://maxcdn.bootstrapcdn.com https://fonts.gstatic.com; img-src 'self' data: https:;">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo htmlspecialchars($csrf_token, ENT_QUOTES, 'UTF-8'); ?>">
    
    <title><?php echo htmlspecialchars($page_title, ENT_QUOTES, 'UTF-8'); ?> - Admin Panel | Modern Agent</title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/img/favicon.ico'); ?>" type="image/x-icon">
    
    <!-- Preload critical resources -->
    <link rel="preload" href="<?php echo base_url('assets/css/optimized-styles.css'); ?>" as="style">
    <link rel="preload" href="<?php echo base_url('assets/js/security.js'); ?>" as="script">
    
    <!-- CSS Files - Consolidated and optimized loading -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/optimized-styles.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/admin/admin-style.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-reset.css'); ?>">
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.dataTables.min.css'); ?>">
    
    <!-- jQuery UI CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/js/jquery-ui/jquery-ui-1.10.1.custom.min.css'); ?>">
    
    <!-- Toastr CSS -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/jquery-toastr/toastr.min.css'); ?>">
    
    <!-- Additional components -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-combobox.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/summernote.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/datepicker.css'); ?>">
    
    <!-- Font Awesome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- JavaScript - Core files loaded early for admin functionality -->
    <script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/customjs/common.js'); ?>"></script>
    
    <!-- Editor Scripts -->
    <script src="<?php echo base_url('assets/editor/js/prism.js'); ?>"></script>
    <script src="<?php echo base_url('assets/editor/js/fabric.js'); ?>"></script>
    <script src="<?php echo base_url('assets/editor/js/master.js'); ?>"></script>

    <!-- Global Configuration -->
    <script>
        // Global configuration variables
        var BASE_URL = '<?php echo base_url(); ?>';
        var CSRF_TOKEN = '<?php echo htmlspecialchars($csrf_token, ENT_QUOTES, 'UTF-8'); ?>';
        
        // Canvas JSON configuration (if needed for editor)
        <?php if (isset($flyerhtml)): ?>
        var CanvasJson = <?php echo $flyerhtml; ?>;
        <?php endif; ?>
    </script>
</head>
<body ng-app="kitchensink" ng-controller="CanvasControls" class="admin-body">
    <!-- Skip to main content for accessibility -->
    <a href="#main-content" class="sr-only sr-only-focusable">Skip to main content</a>
    
    <!-- Alert Container for notifications -->
    <div class="alert-container" id="alert-container"></div>
    
    <!-- Admin Header -->
    <header class="header fixed-top clearfix" role="banner">
        <div class="top-navbar">
            <div class="top-navbar-inner">
                <!-- Logo Section -->
                <div class="logo-brand">
                    <a class="logo" href="<?php echo site_url('admin/dashboard/'); ?>" aria-label="Go to Admin Dashboard">
                        <img src="<?php echo base_url('assets/images-2/logo.png'); ?>" alt="Modern Agent Logo" class="logo-img">
                    </a>
                </div>
                
                <!-- Top Navigation Content -->
                <div class="top-nav-content clearfix">
                    <!-- Mobile Menu Toggle -->
                    <button class="btn-collapse-sidebar-left navbar-toggle collapsed" 
                            id="menu-toggle" 
                            data-toggle="collapse" 
                            data-target=".navbar-ex1-collapse"
                            aria-label="Toggle navigation menu"
                            aria-expanded="false">
                        <i class="fa fa-bars icon-dinamic" aria-hidden="true"></i>
                    </button>
                    
                    <!-- User Navigation -->
                    <nav class="navbar-collapse pull-right" id="main-fixed-nav" role="navigation" aria-label="User navigation">
                        <ul class="nav-user navbar-right">
                            <li class="dropdown">
                                <a href="#" 
                                   class="dropdown-toggle" 
                                   data-toggle="dropdown"
                                   aria-haspopup="true"
                                   aria-expanded="false"
                                   aria-label="User menu">
                                    <img class="user-top img-circle" 
                                         src="<?php echo htmlspecialchars($user_avatar, ENT_QUOTES, 'UTF-8'); ?>" 
                                         alt="User avatar"
                                         loading="lazy">
                                    <span class="username">Hi <?php echo $user_name; ?>,</span>
                                    <span class="caret" aria-hidden="true"></span>
                                </a>
                                <ul class="dropdown-menu extended logout" role="menu">
                                    <li role="menuitem">
                                        <a href="#change_password" 
                                           role="button"  
                                           data-modal-target="change_password"
                                           aria-label="Change password">
                                            <i class="fa fa-cog" aria-hidden="true"></i> Change Password
                                        </a>
                                    </li>
                                    <?php if ($this->role_lib->is_sales_rep()): ?>
                                    <li role="menuitem">
                                        <a href="#ref_code_modal" 
                                           role="button"  
                                           data-modal-target="ref_code_modal"
                                           aria-label="View referral code">
                                            <i class="fa fa-share" aria-hidden="true"></i> Referral Code
                                        </a>
                                    </li>
                                    <?php endif; ?>
                                    <li role="menuitem">
                                        <a href="<?php echo site_url('admin/logout'); ?>" aria-label="Log out">
                                            <i class="fa fa-sign-out" aria-hidden="true"></i> Log Out
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <!-- Admin Sidebar -->
    <aside class="sidebar-left" role="complementary" aria-label="Admin navigation">
        <nav class="list-group sidebar-menu collapse navbar-collapse" role="navigation">
            <ul class="nav nav-sidebar">
                <li class="list-group-item <?php echo ($page_title == 'Dashboard') ? 'active' : ''; ?>">
                    <a href="<?php echo site_url('admin/dashboard'); ?>" 
                       class="nav-link"
                       <?php echo ($page_title == 'Dashboard') ? 'aria-current="page"' : ''; ?>>
                        <i class="fa fa-dashboard icon-sidebar" aria-hidden="true"></i>
                        <i class="fa fa-angle-right chevron-icon-sidebar" aria-hidden="true"></i>
                        <span class="text">Dashboard</span>
                    </a>
                </li>

                <?php if ($this->role_lib->has_access('manage_companies')): ?>
                <li class="list-group-item <?php echo ($page_title == 'Manage Companies') ? 'active' : ''; ?>">
                    <a href="<?php echo site_url('admin/manage_companies'); ?>" 
                       class="nav-link"
                       <?php echo ($page_title == 'Manage Companies') ? 'aria-current="page"' : ''; ?>>
                        <i class="fa fa-building-o icon-sidebar" aria-hidden="true"></i>
                        <i class="fa fa-angle-right chevron-icon-sidebar" aria-hidden="true"></i>
                        <span class="text">Companies</span>
                    </a>
                </li>
                <?php endif; ?>

                <?php if ($this->role_lib->has_access('manage_sales_reps')): ?>
                <li class="list-group-item <?php echo ($page_title == 'Manage Sales Representatives') ? 'active' : ''; ?>">
                    <a href="<?php echo site_url('admin/manage_sales_reps'); ?>" 
                       class="nav-link"
                       <?php echo ($page_title == 'Manage Sales Representatives') ? 'aria-current="page"' : ''; ?>>
                        <i class="fa fa-users icon-sidebar" aria-hidden="true"></i>
                        <i class="fa fa-angle-right chevron-icon-sidebar" aria-hidden="true"></i>
                        <span class="text">Sales Representatives</span>
                    </a>
                </li>
                <?php endif; ?>

                <?php if ($this->role_lib->has_access('view_all_user')): ?>
                <li class="list-group-item <?php echo ($page_title == 'Manage Users') ? 'active' : ''; ?>">
                    <a href="<?php echo site_url('admin/manage_user'); ?>" 
                       class="nav-link"
                       <?php echo ($page_title == 'Manage Users') ? 'aria-current="page"' : ''; ?>>
                        <i class="fa fa-users icon-sidebar" aria-hidden="true"></i>
                        <i class="fa fa-angle-right chevron-icon-sidebar" aria-hidden="true"></i>
                        <span class="text">Users</span>
                    </a>
                </li>
                <?php endif; ?>

                <?php if ($this->role_lib->has_access('view_all_admin_user')): ?>
                <li class="list-group-item <?php echo ($page_title == 'Manage Admin Users') ? 'active' : ''; ?>">
                    <a href="<?php echo site_url('admin/manage_admin_user'); ?>" 
                       class="nav-link"
                       <?php echo ($page_title == 'Manage Admin Users') ? 'aria-current="page"' : ''; ?>>
                        <i class="fa fa-users icon-sidebar" aria-hidden="true"></i>
                        <i class="fa fa-angle-right chevron-icon-sidebar" aria-hidden="true"></i>
                        <span class="text">Admin Users</span>
                    </a>
                </li>
                <?php endif; ?>

                <?php if ($this->role_lib->is_sales_rep()): ?>
                <li class="list-group-item <?php echo ($page_title == 'Manage Leads') ? 'active' : ''; ?>">
                    <a href="<?php echo site_url('admin/manage_leads'); ?>" 
                       class="nav-link"
                       <?php echo ($page_title == 'Manage Leads') ? 'aria-current="page"' : ''; ?>>
                        <i class="fa fa-anchor icon-sidebar" aria-hidden="true"></i>
                        <i class="fa fa-angle-right chevron-icon-sidebar" aria-hidden="true"></i>
                        <span class="text">Leads</span>
                    </a>
                </li>
                <?php endif; ?>

                <?php if ($this->role_lib->is_admin()): ?>
                <li class="list-group-item <?php echo ($page_title == 'Manage Coupons') ? 'active' : ''; ?>">
                    <a href="<?php echo site_url('admin/manage_coupon'); ?>" 
                       class="nav-link"
                       <?php echo ($page_title == 'Manage Coupons') ? 'aria-current="page"' : ''; ?>>
                        <i class="fa fa-tag icon-sidebar" aria-hidden="true"></i>
                        <i class="fa fa-angle-right chevron-icon-sidebar" aria-hidden="true"></i>
                        <span class="text">Coupons</span>
                    </a>
                </li>
                <?php endif; ?>

                <?php if (!$this->role_lib->is_manager_l1()): ?>
                <li class="list-group-item <?php echo ($page_title == 'Order History') ? 'active' : ''; ?>">
                    <a href="<?php echo site_url('admin/order_history'); ?>" 
                       class="nav-link"
                       <?php echo ($page_title == 'Order History') ? 'aria-current="page"' : ''; ?>>
                        <i class="fa fa-archive icon-sidebar" aria-hidden="true"></i>
                        <i class="fa fa-angle-right chevron-icon-sidebar" aria-hidden="true"></i>
                        <span class="text">Order History</span>
                    </a>
                </li>
                <?php endif; ?>

                <?php if ($this->role_lib->is_admin()): ?>
                <li class="list-group-item <?php echo ($page_title == 'Manage Transaction') ? 'active' : ''; ?>">
                    <a href="<?php echo site_url('admin/transaction'); ?>" 
                       class="nav-link"
                       <?php echo ($page_title == 'Manage Transaction') ? 'aria-current="page"' : ''; ?>>
                        <i class="fa fa-exchange icon-sidebar" aria-hidden="true"></i>
                        <i class="fa fa-angle-right chevron-icon-sidebar" aria-hidden="true"></i>
                        <span class="text">Recent Orders</span>
                    </a>
                </li>
                <?php endif; ?>

                <?php if ($this->role_lib->is_admin()): ?>
                <li class="list-group-item <?php echo ($page_title == 'Manage Packages') ? 'active' : ''; ?>">
                    <a href="<?php echo site_url('admin/packages'); ?>" 
                       class="nav-link"
                       <?php echo ($page_title == 'Manage Packages') ? 'aria-current="page"' : ''; ?>>
                        <i class="fa fa-usd icon-sidebar" aria-hidden="true"></i>
                        <i class="fa fa-angle-right chevron-icon-sidebar" aria-hidden="true"></i>
                        <span class="text">Packages</span>
                    </a>
                </li>
                <?php endif; ?>
            </ul>
        </nav>
    </aside>

    <!-- Main Content Area -->
    <main id="main-content" class="page-content" role="main">
        <div class="wrapper">
            <div class="row-padding">