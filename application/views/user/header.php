<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Modern Agent - Personalized Real Estate Presentations</title>
<meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
<link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.ico" type="image/x-icon" />

<!-- Custom Fonts -->
<link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">

<!-- Bootstrap Core CSS -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/flexslider.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/carousel.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/carousel.theme.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/prettyphoto.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/smart_wizard.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/smart_tab_vertical.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.dataTables.min.css">
<!-- Custom CSS -->

<link href="<?php echo base_url(); ?>assets/css/lp-style.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/multi-select.css"); ?>">
<link href="https://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.min.css" rel="stylesheet" type="text/css" />

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places&key=<?=getGoogleMapKey()?>"></script>
<!-- jQuery --> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/mobile.js"></script>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
<link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/css/header_user.css"); ?>">
</head>

<body class="home">


<a id="top"></a>
<div class="loaders" style="width:50% !important; margin-left:25% !important;"><img src="<?php echo base_url(); ?>assets/images/gears.gif"></div>

<header class="overlapping">
  <div class="navbar-wrapper" > 
    <!-- mobile menu button content -->         
    <a href="<?php echo site_url(); ?>"><img id="header_logo" src="<?php echo base_url(); ?>assets/images-2/logo.png" class="img-responsive" ></a>
    <nav class="nav">
      <div class="menu pull-right">
          <ul>
          <li class="<?php if($current=='dashboard'){echo 'current';} ?>"><a href="<?php echo site_url('user/dashboard'); ?>" class="external m">Create New</a></li>
          <li class="<?php if($current=='recentlp'){echo 'current';} ?>"> <a href="<?php echo site_url('user/recentlp'); ?>" class="external m">Recent</a> </li>
          <li class="<?php if($current=='billing'){echo 'current';} ?>"> <a href="<?php echo site_url('user/billing'); ?>" class="external m">Billing History</a> </li>
          <li class="<?php if($current=='leads'){echo 'current';} ?>"> <a href="<?php echo site_url('user/leads'); ?>" class="external m">My Leads</a> </li>
          <li class="<?php if($current=='guests'){echo 'current';} ?>"> <a href="<?php echo site_url('user/guests'); ?>" class="external m">My Guests</a> </li>
          <li class="<?php if($current=='myaccount'){echo 'current';} ?>"> <a href="<?php echo site_url('user/myaccount'); ?>" class="external m">My Account</a> </li>
          <?php 
          $is_enterprise_user = is_enterprise_user();
          if ($is_enterprise_user) {
          ?>
          <li class="<?php if($current=='customize'){echo 'current';} ?>"> <a href="<?php echo site_url('user/customize'); ?>" class="external m">Report Customization</a> </li>
          <?php
          }
          ?>
          <li class=""> <a id="btn-logout" href="javascript:void(0);" class="external m btn-user-logout-click">Log Out</a> </li>
          </ul>
      </div>
    </nav>
    <div class="mobile-nav">              
        <a class="mobile-nav-trigger" href="#"></a>
        <ul>
        <li class="<?php if($current=='dashboard'){echo 'current';} ?>"><a href="<?php echo site_url('user/dashboard'); ?>" class="external m">Create New</a></li>
        <li class="<?php if($current=='recentlp'){echo 'current';} ?>"> <a href="<?php echo site_url('user/recentlp'); ?>" class="external m">Recent</a> </li>
        <li class="<?php if($current=='billing'){echo 'current';} ?>"> <a href="<?php echo site_url('user/billing'); ?>" class="external m">Billing History</a> </li>
        <li class="<?php if($current=='leads'){echo 'current';} ?>"> <a href="<?php echo site_url('user/leads'); ?>" class="external m">My Leads</a> </li>
        <li class="<?php if($current=='myaccount'){echo 'current';} ?>"> <a href="<?php echo site_url('user/myaccount'); ?>" class="external m">My Account</a> </li>
        <?php 
        $is_enterprise_user = is_enterprise_user();
        if ($is_enterprise_user) {
        ?>
        <li class="<?php if($current=='customize'){echo 'current';} ?>"> <a href="<?php echo site_url('user/customize'); ?>" class="external m">Report Customization</a> </li>
        <?php
        }
        ?>
        <li class=""> <a id="btn-logout-m" href="javascript:void(0);" class="external m btn-user-logout-click">Log Out</a> </li>
        </ul>
    </div>          
  </div>
</header>