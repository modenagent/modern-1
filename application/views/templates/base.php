<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="<?php echo isset($meta_description) ? htmlspecialchars($meta_description, ENT_QUOTES, 'UTF-8') : 'Modern Agent - Real Estate Platform'; ?>">
    <meta name="keywords" content="<?php echo isset($meta_keywords) ? htmlspecialchars($meta_keywords, ENT_QUOTES, 'UTF-8') : 'real estate, property, agent'; ?>">
    <meta name="author" content="Modern Agent">
    
    <!-- Security Headers -->
    <meta name="referrer" content="strict-origin-when-cross-origin">
    <meta http-equiv="X-Content-Type-Options" content="nosniff">
    <meta http-equiv="X-Frame-Options" content="DENY">
    <meta http-equiv="X-XSS-Protection" content="1; mode=block">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo isset($csrf_token) ? htmlspecialchars($csrf_token, ENT_QUOTES, 'UTF-8') : ''; ?>">
    
    <title><?php echo isset($title) ? htmlspecialchars($title, ENT_QUOTES, 'UTF-8') . ' - Modern Agent' : 'Modern Agent'; ?></title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo base_url('assets/img/favicon.ico'); ?>" type="image/x-icon">
    
    <!-- Preload critical resources -->
    <link rel="preload" href="<?php echo base_url('assets/css/optimized-styles.css'); ?>" as="style">
    <link rel="preload" href="<?php echo base_url('assets/js/security.js'); ?>" as="script">
    
    <!-- CSS Files -->
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/optimized-styles.css'); ?>">
    <?php if (isset($additional_css) && is_array($additional_css)): ?>
        <?php foreach ($additional_css as $css_file): ?>
            <link rel="stylesheet" href="<?php echo base_url($css_file); ?>">
        <?php endforeach; ?>
    <?php endif; ?>
    
    <!-- Font Awesome -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <?php if (isset($additional_head_content)): ?>
        <?php echo $additional_head_content; ?>
    <?php endif; ?>
</head>
<body class="<?php echo isset($body_class) ? htmlspecialchars($body_class, ENT_QUOTES, 'UTF-8') : ''; ?>">
    <!-- Skip to main content for accessibility -->
    <a href="#main-content" class="sr-only sr-only-focusable">Skip to main content</a>
    
    <!-- Alert Container for notifications -->
    <div class="alert-container" id="alert-container"></div>
    
    <main id="main-content" class="main-content" role="main">
        <?php echo isset($content) ? $content : ''; ?>
    </main>
    
    <!-- Core JavaScript -->
    <script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/bootstrap.min.js'); ?>"></script>
    <script src="<?php echo base_url('assets/js/security.js'); ?>"></script>
    
    <?php if (isset($additional_js) && is_array($additional_js)): ?>
        <?php foreach ($additional_js as $js_file): ?>
            <script src="<?php echo base_url($js_file); ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
    
    <!-- Inline JavaScript for page-specific functionality -->
    <?php if (isset($inline_js)): ?>
        <script>
            <?php echo $inline_js; ?>
        </script>
    <?php endif; ?>
    
    <!-- Initialize security features -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set base URL for AJAX requests
            window.BASE_URL = '<?php echo base_url(); ?>';
            
            // Initialize tooltips if Bootstrap is available
            if (typeof $ !== 'undefined' && $.fn.tooltip) {
                $('[data-toggle="tooltip"]').tooltip();
            }
            
            // Initialize popovers if Bootstrap is available
            if (typeof $ !== 'undefined' && $.fn.popover) {
                $('[data-toggle="popover"]').popover();
            }
        });
    </script>
</body>
</html>