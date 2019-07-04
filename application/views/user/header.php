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

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places&key=AIzaSyDQQthVgLzHIRTyLS1WGP2spIshpD28n8M"></script>
<!-- jQuery --> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
<script src="https://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>


<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="home">


<a id="top"></a>
<div class="loaders" style="width:50% !important; margin-left:25% !important;"><img src="<?php echo base_url(); ?>assets/images/gears.gif"></div>

<!-- Navigation -->
<nav class="navbar navbar-default" role="navigation" id="user-header">
  <div class="container">
    <div class="col-md-12"> 
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        <!-- <a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/images/logo.png" alt="Modern Agent"></a> --> 

        <a href="#"><img id="header_logo" class="center-logo" src="<?php echo base_url(); ?>assets/images-2/logo.png" class="img-responsive" ></a>
    
      </div>
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav navbar-right">
          <li class="<?php if($current=='dashboard'){echo 'current';} ?>"><a href="<?php echo site_url('user/dashboard'); ?>" class="external">Create New</a></li>
          <li class="<?php if($current=='recentlp'){echo 'current';} ?>"> <a href="<?php echo site_url('user/recentlp'); ?>" class="external">Recent</a> </li>
          <li class="<?php if($current=='billing'){echo 'current';} ?>"> <a href="<?php echo site_url('user/billing'); ?>" class="external">Billing History</a> </li>
          <li class="<?php if($current=='leads'){echo 'current';} ?>"> <a href="<?php echo site_url('user/leads'); ?>" class="external">My Leads</a> </li>
        <!--  <li class="<?php if($current=='flyers'){echo 'current';} ?>"> <a href="<?php echo site_url('user/flyers'); ?>" class="external">Flyers</a> </li> -->
        <li class="<?php if($current=='myaccount'){echo 'current';} ?>"> <a href="<?php echo site_url('user/myaccount'); ?>" class="external">My Account</a> </li>
          <!-- // <li class="<?php if($current=='howto'){echo 'current';} ?>"> <a href="<?php echo site_url('user/howto'); ?>" class="external">How To</a> </li> -->
          <li class="logout-button"> <a id="btn-logout" href="javascript:void(0);" class="btn btn-lp external">Log Out</a> </li>
        </ul>
      </div>
      <!-- /.navbar-collapse --> 
    </div>
  </div>
  <!-- /.container --> 
</nav>