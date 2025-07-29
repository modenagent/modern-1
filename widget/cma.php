<?php
$samlbasedir= dirname(dirname(__FILE__));
include $samlbasedir.'/'.'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable($samlbasedir);
      
$dotenv->load();
ob_start();
$root_dir = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR ;
$root_dir = str_replace('\\', '/', $root_dir);
define('FCPATH', $root_dir);
define("CI_REQUEST", "external");
include('index_ci.php');
ob_end_clean();
$CI =& get_instance();
$domain_url = 'https://'.$_ENV['APP_DOMAIN'].'/';
// echo base_url();die;
// echo $_SERVER['HTTP_REFERER'];die;
?>
<!DOCTYPE html>
<html>

<head>
    <title>Modern Agent - CMA Generation</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modern Agent - Real Estate Presentations</title>

        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        <!-- <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.ico" type="image/x-icon" /> -->
</head>
<div id="cma-widget-container">
	
</div>
<script type="text/javascript">
</script>

<script src="<?php echo $domain_url.'assets/js/jquery.js' ?>"></script>
<script src="<?php echo $domain_url.('assets/js/bootstrap.min.js') ?>"></script>

<link rel="stylesheet" type="text/css" href="<?php echo $domain_url.'assets/css/iconmoon/style.css' ?>">     
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.css">
<link rel="stylesheet" type="text/css" href="<?php echo $domain_url; ?>assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo $domain_url; ?>assets/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo $domain_url."assets/css/smart_wizard.css"?>" />
<link rel="stylesheet" type="text/css" href="<?php echo $domain_url."assets/css/cma.css"?>" />
<link rel="stylesheet" type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css">
<script src="<?php echo $domain_url; ?>assets/js/mobile.js"></script>
<script src="<?php echo $domain_url; ?>assets/js/scroll.js"></script>
<script src="<?php echo $domain_url; ?>assets/js/main.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places&key=<?=getGoogleMapKey();?>"></script>


<!-- Bootstrap Core JavaScript --> 

<script type="text/javascript" src="<?php echo $domain_url; ?>assets/js/data-tables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo $domain_url; ?>assets/js/jquery.localscroll-1.2.7-min.js"></script> 
<script type="text/javascript" src="<?php echo $domain_url; ?>assets/js/jquery.scrollTo.js"></script> 
<script type="text/javascript" src="<?php echo $domain_url; ?>assets/js/jquery.easing.1.3.js"></script> 
<script type="text/javascript" src="<?php echo $domain_url; ?>assets/js/jquery.flexslider.js"></script> 
<script type="text/javascript" src="<?php echo $domain_url; ?>assets/js/carousel.js"></script> 
<script type="text/javascript" src="<?php echo $domain_url; ?>assets/js/jquery.prettyphoto.js"></script>
<script type="text/javascript" src="<?php echo $domain_url; ?>assets/js/jquery.validate.min.js"></script> 
<script type="text/javascript" src="<?php echo $domain_url; ?>assets/js/additional-methods.min.js"></script>
<script type="text/javascript" src="<?php echo $domain_url; ?>assets/js/jquery.nav.js"></script> 
<script type="text/javascript" src="<?php echo $domain_url; ?>assets/js/jquery.smartWizard-2.0.min.js"></script> 
<script type="text/javascript" src="<?php echo $domain_url; ?>assets/js/jquery.smartTab.js"></script> 
<script type="text/javascript" src="<?php echo $domain_url; ?>assets/js/icheck.min.js"></script>
<script type="text/javascript" src="<?php echo $domain_url; ?>assets/js/custom.js"></script> 
<script src="<?php echo $domain_url; ?>assets/js/jquery.multi-select.js"></script>

<script src="<?php echo $domain_url; ?>assets/js/jquery-ui.1.11.2.min.js" type="text/javascript"></script>

<script type="text/javascript">
	var app_check_url = "<?=$domain_url?>widgetcma";
	$(document).ready(function(){
		loadWidget();
	});
	function loadWidget()
	{
	    var custom_css = "";

	    jQuery.ajax({
	        url: app_check_url,
	        type: "GET",
	        xhrFields: { 
	            withCredentials: true 
	        },
	        success: function (response) {
	            try {
	                // Try to parse as JSON first (for error responses)
	                var jsonResponse = JSON.parse(response);
	                if (jsonResponse.status === 'error') {
	                    jQuery('#cma-widget-container').html(jsonResponse.html);
	                } else {
	                    jQuery('#cma-widget-container').html(custom_css + response);
	                }
	            } catch (e) {
	                // If not JSON, treat as HTML (normal widget content)
	                jQuery('#cma-widget-container').html(custom_css + response);
	            }
	        },
	        error: function(xhr, ajaxOptions, thrownError){
	            console.error('Widget loading failed:', thrownError);
	            var errorMessage = '<div style="padding: 20px; text-align: center; color: #e74c3c; font-family: Arial, sans-serif;">' +
	                              '<h3>Widget Loading Error</h3>' +
	                              '<p>Unable to load the CMA widget. Please try again later.</p>' +
	                              '<p><small>Error: ' + (thrownError || 'Network error') + '</small></p>' +
	                              '</div>';
	            jQuery('#cma-widget-container').html(errorMessage);
	        },
	    });
	}
</script>
<!-- <script type="text/javascript" src="cma.js"></script> -->