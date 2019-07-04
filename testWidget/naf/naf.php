<?php
    if ( isset($_GET['skin']) ) $skin=(int)$_GET['skin'];else $skin=1;
    include('easy-protect.php');
    $options = array(
        'skin'     => $skin,
        #'md5'      => true,
        #'block'   => array('127.0.0.1','95.222.76.152'),
        'attempts' => 3,
        'timeout'  => 60,
        #'bypass'  => array('127.0.0.1','95.222.76.152'),
    );
    session_set_cookie_params(0);session_start();
    protect(array('admin','demo'), $options);
    // WITH MD5 LOOK EXAMPLE test2.php
    #protect('admin', $options); // only ONE password
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Template / Home</title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="telephone=no" name="format-detection">
    <meta name="HandheldFriendly" content="true">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <!--[if lt IE 9 ]>
	<!-- CSS Files -->
	<link rel="stylesheet" type="text/css" href="assets2/css/reset.css"/>
	<link rel="stylesheet" type="text/css" href="assets2/css/style.css"/>
	<link rel="stylesheet" type="text/css" href="assets2/css/flexslider.css"/>
	<link rel="stylesheet" type="text/css" href="assets2/css/ico.css"/>
<!-- ==cma==  -->
<script type="text/javascript" src="cma.js"></script>
<!-- ==cma==  -->
</head>

<body class="top">

<!-- Stats section -->
<section id="stats-info">
		<div class="twelve columns no-padding">			
		<div id="cma-widget-container" style="margin: 0 auto;max-width: 95%;"></div>
		</div>
</section >			
<!-- Stats section -->
                      			                      
</body>
</html>

        