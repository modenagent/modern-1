<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Modern Agent - Personalized Real Estate Presentations</title>
  <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
  <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
  <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/frontend/images/favicon.ico" type="image/x-icon" />

  <!-- Custom Fonts -->
  <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">

  <!-- Bootstrap Core CSS -->
  <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css"> -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_site/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/flexslider.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/carousel.css"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/carousel.theme.css"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/prettyphoto.css"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_site/css/smart_wizard.css?v=0.1"/>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/smart_tab_vertical.css"/>
  <!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/jquery.dataTables.min.css"> -->
  <!-- Custom CSS -->

  <link href="<?php echo base_url(); ?>assets/new_site/css/lp-style.css?v=0.6" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url("assets/new_site/css/multi-select.css?V=0.1"); ?>">
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
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_site/css/responsive.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_site/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/new_site/css/custom.css?v=0.12">
  <!-- toastr css -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-toastr/toastr.min.css" />
</head>

<body class="home">


  <a id="top"></a>
  <div class="loaders" style="width:50% !important; margin-left:25% !important;"><img src="<?php echo base_url(); ?>assets/images/gears.gif"></div>

  <header class="overlapping">
    <nav class="navbar navbar-expand-lg" >
      <div class="container">
        <a class="navbar-brand" href="<?php echo site_url(); ?>"><img id="" src="<?php echo base_url(); ?>assets/new_site/img/logo.png" class="" /></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <button class="menu-toggler d-block d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
              &times;
          </button>
          <ul class="navbar-nav ms-auto">
            <li class="nav-item <?php if ($current == 'dashboard') {echo 'current';}?>"><a href="<?php echo site_url('user/dashboard'); ?>" class="active nav-link">Create New</a></li>
            <li class="nav-item <?php if ($current == 'recentlp') {echo 'current';}?>"> <a href="<?php echo site_url('user/recentlp'); ?>" class="nav-link">Recent</a> </li>

            <li class="nav-item <?php if ($current == 'leads') {echo 'current';}?>"> <a href="<?php echo site_url('user/leads'); ?>" class="nav-link">My Leads</a> </li>
         <!--   <li class="nav-item <?php if ($current == 'guests') {echo 'current';}?>"> <a href="<?php echo site_url('user/guests'); ?>" class="nav-link">My Guests</a> </li>-->

            <li class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" >Account <!-- <span class="caret"></span> --></a>
              <ul class="dropdown-menu">
                <li class="<?php if ($current == 'billing') {echo 'current';}?>"> <a href="<?php echo site_url('user/billing'); ?>" class="nav-link">Billing History</a> </li>

                <li class="<?php if ($current == 'myaccount') {echo 'current';}?>"> <a href="<?php echo site_url('user/myaccount'); ?>" class="nav-link">My Account</a> </li>
                <?php
$is_enterprise_user = is_enterprise_user();
if ($is_enterprise_user) {?>
                  <li class="<?php if ($current == 'customize') {echo 'current';}?>"> <a href="<?php echo site_url('user/customize'); ?>" class="nav-link">Report Customization</a> </li>
                  <?php }?>
                <li class="<?php if ($current == 'adjust_parameter') {echo 'current';}?>"> <a href="<?php echo site_url('user/adjust_params'); ?>" class="nav-link">Comps Settings</a> </li>
              </ul>
            </li>
            <li class="nav-item "> <a id="btn-logout" href="javascript:void(0);" class="nav-link logout-link btn-user-logout-click">Log Out</a> </li>
          </ul>
      </div>
    </div>
    <!-- <style type="text/css">
      .nav .account-menu.open>a, .nav .account-menu.open>a:focus, .nav .account-menu.open>a:hover {
        background: none;
      }
      .account-menu .dropdown-menu {
        background: none;
        top: 20px;
      }
      .account-menu .dropdown-menu>li>a {
        padding: 3px 0px;
      }
      .account-menu .dropdown-menu>li>a:focus, .account-menu .dropdown-menu>li>a:hover {
        color: #fff;
        background: none;
      }
      .account-menu.dropdown:hover  .dropdown-menu {
        display: block;
      }
    </style> -->
    </nav>
  </header>