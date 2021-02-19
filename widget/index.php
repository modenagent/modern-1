<?php
require_once '../CI.php';
$ci = get_instance();
$user_id = 82;
?>
<!DOCTYPE html>
<html>
	<head>
		<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.9.1.min.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places&key=AIzaSyDQQthVgLzHIRTyLS1WGP2spIshpD28n8M"></script>
		<script type="text/javascript">
	        var base_url = 'http://dev.modernagent.io/';
	        var user_id = '<?php echo $user_id; ?>';
	    </script>
		<script type="text/javascript" src="cma.js"></script>
	</head>
	<body>
		<div id="cma-widget-container" style="margin: 0 auto;max-width: 95%;"></div>
	</body>
</html>