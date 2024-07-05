<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title><?php echo $title; ?></title>
        <!-- favicon -->
        <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/favicon.ico" type="image/x-icon" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
        <link href="<?php echo base_url(); ?>assets/js/jquery-ui/jquery-ui-1.10.1.custom.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/bootstrap-reset.css" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet">
        <!-- data table -->
        <link href="<?php echo base_url(); ?>assets/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css">
        <!-- toastr css -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/jquery-toastr/toastr.min.css">
        <!-- Custom styles for this template -->
        <link href="<?php echo base_url(); ?>assets/admin/admin-style.css" rel="stylesheet">
        <!-- admin css ends -->
        <!-- Combobox -->
        <link href="<?php echo base_url(); ?>assets/css/bootstrap-combobox.css" rel="stylesheet"/>
        <!-- Editer -->
        <link href="<?php echo base_url(); ?>assets/css/summernote.css" rel="stylesheet"/>
        <link href="<?php echo base_url(); ?>assets/css/datepicker.css" rel="stylesheet"/>
        <!-- js  -->
        <script src="<?php echo base_url(); ?>assets/editor/js/prism.js"></script>
        <script src="<?php echo base_url(); ?>assets/editor/js/fabric.js"></script>
        <script src="<?php echo base_url(); ?>assets/editor/js/master.js"></script>

        <script type="text/javascript">
           var BASE_URL= '<?php echo base_url(); ?>';
           // var CanvasJson = <?php echo $flyerhtml; ?>;
        </script>
        <script src="<?php echo base_url('assets/js/jquery.js'); ?>"></script>
        <script src="<?php echo base_url('assets/js/customjs/common.js'); ?>"></script>
    </head>
    <body ng-app="kitchensink"  ng-controller="CanvasControls">
        <header class="header fixed-top clearfix">
            <div class="top-navbar">
                <div class="top-navbar-inner">
                <!--logo start-->
                    <div class="logo-brand">
                        <a class="logo" href="<?php echo site_url('admin/dashboard/'); ?>">
                            <img src="<?php echo base_url('assets/images-2/logo.png'); ?>"></a>
                        </a>
                    </div>
                    <!--logo end-->
                    <div class="top-nav-content clearfix">
                        <!--search & user info start-->
                        <div class="btn-collapse-sidebar-left navbar-toggle collapsed" id="menu-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"> <i class="fa fa-bars icon-dinamic"></i>
                        </div>
                        <div class="navbar-collapse pull-right" id="main-fixed-nav">
                            <ul class="nav-user navbar-right">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                        <img class="user-top img-circle" src="<?php echo base_url('assets/admin/images/chat-avatar2.jpg'); ?>" alt="">
                                        <span class="username"> Hi <?php echo $this->session->userdata('name') . ','; //$user_name      ?> </span>
                                        <b class="caret"></b>
                                    </a>
                                    <ul class="dropdown-menu extended logout">
                                        <li><a href="#change_password" role="button"  data-toggle="modal"><i class="fa fa-cog"></i> Change Password</a></li>
                                        <?php if ($this->role_lib->is_sales_rep()): ?>
                                        <li><a href="#ref_code_modal" role="button"  data-toggle="modal"><i class="fa fa-share"></i> Referral Code</a></li>
                                        <?php endif;?>
                                        <li><a href="<?php echo base_url('admin/logout'); ?>"><i class="fa fa-key"></i> Log Out</a></li>
                                    </ul>
                                </li>
                                <!-- user login dropdown end -->
                            </ul>
                        </div>
                        <!--search & user info end-->
                    </div>
                </div>
            </div>
        </header>
        <aside>
            <?php
switch ($title) {
    case 'Dashboard':
        $active = "active";
        break;
    case 'Manage Products':
        $active2 = "active";
        break;
    case 'Manage Users':
        $active3 = "active";
        break;
    case 'Manage Category':
        $active4 = "active";
        break;
    case 'Manage Orders':
        $active5 = "active";
        break;
    case 'Manage Coupons':
        $active6 = "active";
        break;
    case 'Manage Transaction':
        $active7 = "active";
        break;
    case 'Order History':
        $active8 = "active";
        break;
    case 'Manage Content':
        $active9 = "active";
        break;
    case 'Manage Leads':
        $active10 = "active";
        break;
    case 'Manage Packages':
        $active11 = "active";
        break;
    case 'Manage Admin Users':
        $active12 = "active";
        break;
}
?>
            <div class="sidebar-left">
                <div class="list-group sidebar-menu collapse navbar-collapse">
                    <ul>
                        <li class="list-group-item <?php echo $active; ?>">
                            <a class="" href="<?php echo site_url('admin/dashboard'); ?>">
                                <i class="fa fa-dashboard icon-sidebar"></i>
                                <i class="fa fa-angle-right chevron-icon-sidebar"></i>
                                <span class="isw-grid"></span><span class="text">Dashboard</span>
                            </a>
                        </li>
                        <?php /*
<li class="list-group-item <?php echo $active2; ?>">
<a class="" href="<?php echo base_url(); ?>index.php?/admin/manage_product">
<i class="fa fa-eye icon-sidebar"></i>
<i class="fa fa-angle-right chevron-icon-sidebar"></i>
<span class="isw-folder"></span><span class="text">Manage Products</span>
</a>

</li>
 */?>
                        <?php if ($this->role_lib->has_access('manage_companies')): ?>
                        <li class="list-group-item <?php echo ($title == 'Manage Companies') ? 'active' : ''; ?>">
                            <a class="" href="<?php echo site_url('admin/manage_companies'); ?>">
                            <i class="fa fa-building-o icon-sidebar"></i>
                            <i class="fa fa-angle-right chevron-icon-sidebar"></i>
                                <span class="isw-mail"></span><span class="text">Companies</span>
                            </a>
                        </li>
                        <?php endif;?>
                        <?php if ($this->role_lib->has_access('manage_sales_reps')): ?>
                        <li class="list-group-item <?php echo ($title == 'Manage Sales Representatives') ? 'active' : ''; ?>">
                            <a class="" href="<?php echo site_url('admin/manage_sales_reps'); ?>">
                            <i class="fa fa-users icon-sidebar"></i>
                            <i class="fa fa-angle-right chevron-icon-sidebar"></i>
                                <span class="isw-mail"></span><span class="text">Sales Representatives</span>
                            </a>
                        </li>
                        <?php endif;?>
                        <?php if ($this->role_lib->has_access('view_all_user')): ?>
                        <li class="list-group-item <?php echo $active3; ?>">
                            <a class="" href="<?php echo site_url('admin/manage_user'); ?>">
                            <i class="fa fa-users icon-sidebar"></i>
                            <i class="fa fa-angle-right chevron-icon-sidebar"></i>
                                <span class="isw-mail"></span><span class="text">Users</span>
                            </a>
                        </li>
                        <?php endif;?>
                        <?php if ($this->role_lib->has_access('view_all_admin_user')): ?>
                        <li class="list-group-item <?php echo $active12; ?>">
                            <a class="" href="<?php echo site_url('admin/manage_admin_user'); ?>">
                            <i class="fa fa-users icon-sidebar"></i>
                            <i class="fa fa-angle-right chevron-icon-sidebar"></i>
                                <span class="isw-mail"></span><span class="text">Admin Users</span>
                            </a>
                        </li>
                        <?php endif;?>
                        <?php if ($this->role_lib->is_sales_rep()): ?>
                        <li class="list-group-item <?php echo $active10; ?>">
                            <a class="" href="<?php echo site_url('admin/manage_leads'); ?>">
                                <i class="fa fa-anchor icon-sidebar"></i>
                                <i class="fa fa-angle-right chevron-icon-sidebar"></i>
                                <span class="isw-chat"></span><span class="text">Leads</span>
                            </a>
                        </li>
                        <?php endif;?>
                        <?php /*
<li class="list-group-item <?php echo $active4; ?>">
<a class="" href="<?php echo base_url(); ?>index.php?/admin/manage_category">
<i class="fa fa-cogs icon-sidebar"></i>
<i class="fa fa-angle-right chevron-icon-sidebar"></i>
<span class="isw-chat"></span><span class="text">Manage Category</span>
</a>
</li>
 */?>
						 <?php if ($this->role_lib->is_admin()): ?>
                        <li class="list-group-item <?php echo $active6; ?>">
                            <a class="" href="<?php echo site_url('admin/manage_coupon'); ?>">
                                <i class="fa fa-anchor icon-sidebar"></i>
                                <i class="fa fa-angle-right chevron-icon-sidebar"></i>
                                <span class="isw-chat"></span><span class="text">Coupons</span>
                            </a>
                        </li>
                        <?php endif;?>
                         <?php if (!$this->role_lib->is_manager_l1()): ?>
                        <li class="list-group-item <?php echo $active5; ?>">
                            <a class="" href="<?php echo site_url('admin/order_history'); ?>">
                                <i class="fa fa-archive icon-sidebar"></i>
                                <i class="fa fa-angle-right chevron-icon-sidebar"></i>
                                <span class="isw-chat"></span><span class="text">Order History</span>
                            </a>
                        </li>
                        <?php endif;?>

                        <?php if ($this->role_lib->is_admin()): ?>
                        <li class="list-group-item <?php echo $active7; ?>">
                            <a class="" href="<?php echo site_url('admin/transaction'); ?>">
                                <i class="fa fa-exchange icon-sidebar"></i>
                                <i class="fa fa-angle-right chevron-icon-sidebar"></i>
                                <span class="isw-chat"></span><span class="text">Recent Orders</span>
                            </a>
                        </li>
                        <?php endif;?>

                        <?php if ($this->role_lib->is_admin()): ?>
                        <li class="list-group-item <?php echo $active11; ?>">
                            <a class="" href="<?php echo site_url('admin/packages'); ?>">
                                <i class="fa fa-usd icon-sidebar"></i>
                                <i class="fa fa-angle-right chevron-icon-sidebar"></i>
                                <span class="isw-chat"></span><span class="text">Packages</span>
                            </a>
                        </li>
                        <?php endif;?>

                        <?php /*
<!--  <li class="list-group-item <?php echo $active8; ?>">
<a href="<?php echo base_url(); ?>index.php?/admin/order_history">
<i class="fa fa-history icon-sidebar"></i>
<i class="fa fa-angle-right chevron-icon-sidebar"></i>
<span class="isw-chat"></span><span class="text">Order History</span>
</a>
</li>  -->

<!-- <li class="list-group-item <?php echo $active9; ?>">
<a class="" href="<?php echo base_url(); ?>index.php?/admin/manage_contents">
<i class="fa fa-edit icon-sidebar"></i>
<i class="fa fa-angle-right chevron-icon-sidebar"></i>
<span class="isw-chat"></span><span class="text">Manage Site Contents</span>
</a>
</li> -->
 */?>

                    </ul>
                </div>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <!--sidebar end-->

        <section id="main-content" class="page-content">
            <div class="wrapper">
            <div class="row-padding">