<!DOCTYPE html>
<html>

<head>
    <title>Modern Agent - Real Estate Presentations</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <script src="<?php echo base_url('assets/js/jquery.js') ?>"></script>
      <script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>"></script>

      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript" charset="utf-8" async defer></script>
     
     <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/iconmoon/style.css') ?>">     
     
    <!-- <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css"> -->

    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.css">
    
    <!-- <script src="assets/js/bootstrap.min.js"></script> -->
    <!-- <script src="<?php echo base_url(); ?>assets/js/slick.min.js"></script> -->
     
     <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.js"></script>  
     <script src="<?php echo base_url(); ?>assets/js/mobile.js"></script>
     <script src="<?php echo base_url(); ?>assets/js/scroll.js"></script>
    

    <script src="<?php echo base_url(); ?>assets/js/main.js"></script>

    <meta charset="utf-8">
        <title>Modern Agent - Real Estate Presentations</title>

        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.ico" type="image/x-icon" />

        <link href="<?php echo base_url('assets/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet" type="text/css">


        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/flexslider.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/carousel.css"/>
        <link rel="stylesheet" href="<?php echo base_url('assets/css/owl.carousel.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/owl.theme.default.min.css'); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/prettyphoto.css"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-toastr/toastr.min.css">



        <link href="<?php echo base_url(); ?>assets/image_popup/image-popup.css" rel="stylesheet">

        <link href="<?php echo base_url(); ?>assets/css/login/login.css" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css">
        <link href="<?php echo base_url(); ?>assets/css/lp-style.css" rel="stylesheet">

</head>

<body>


<header class="overlapping">
<div class="navbar-wrapper" > 
             <!-- mobile menu button content -->
             
             
    <a href="<?php echo site_url(); ?>"><img id="header_logo" src="<?php echo base_url(); ?>assets/images-2/logo.png" class="img-responsive" ></a>

    <nav class="nav">
        <div class="menu pull-right">
            <?php 
                $currentURL = current_url(); 
                $reports_link = '#feature';
                $tools_link = '#detail';
                $widget_link = '#widgets';
                $api_link = '#api';
                $leads_link = '#leads';
                $pricing_link = '#pricing-list';
                if (strpos($currentURL, 'login') !== false || strpos($currentURL, 'register') !== false) {
                    $reports_link = base_url().'#feature';
                    $tools_link = base_url().'#detail';
                    $widget_link = base_url().'#widgets';
                    $api_link = base_url().'#api';
                    $leads_link = base_url().'#leads';
                    $pricing_link = base_url().'#pricing-list';
                }
            ?>
            <ul>
                <li><a class="m" href="<?php echo site_url(); ?>">Home</a></li>
                <li><a class="m playscroll" href="<?php echo $reports_link; ?>">Reports</a></li>
                <li><a class="m playscroll" href="<?php echo $tools_link; ?>">Tools</a></li>
				<li><a class="m playscroll" href="<?php echo $widget_link; ?>">Widgets</a></li>
                <li><a class="m playscroll" href="<?php echo $api_link; ?>">API</a></li>
                <li><a class="m playscroll" href="<?php echo $leads_link; ?>">Lead Gen</a></li>
                <li><a class="m playscroll" href="<?php echo $pricing_link; ?>">Pricing</a></li>
                <li><a class="m playscroll" href="<?php echo site_url('frontend/login'); ?>">Log In <span></span></a></li>
            </ul>
        </div>
    </nav>

          <div class="mobile-nav">              
            <a class="mobile-nav-trigger" href="#"></a>
            <ul>
                <li><a class="m playscroll" href="<?php echo $reports_link; ?>">Reports</a></li>
                <li><a class="m playscroll" href="<?php echo $tools_link; ?>">Tools</a></li>
				<li><a class="m playscroll" href="<?php echo $widget_link; ?>">Widgets</a></li>
                <li><a class="m playscroll" href="<?php echo $api_link; ?>">API</a></li>
                <li><a class="m playscroll" href="<?php echo $leads_link; ?>">Lead Gen</a></li>
                <li><a class="m playscroll" href="<?php echo $pricing_link; ?>">Pricing</a></li>
                <li><a class="m playscroll" href="<?php echo site_url('frontend/login'); ?>">Log In <span></span></a></li>
            </ul>
        </div>
        

            
              </div>
</header>