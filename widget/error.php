<!DOCTYPE html>
<html>
<head>
	<title>Error Page</title>
	<style type="text/css">
		body {
			color: #FFFFFF;
    		background-color: rgba(1,1,1,0.3);
		}
	</style>
</head>
<body>
<?php
if(isset($_GET['error_no'])) {
	$error_no = $_GET['error_no'];
	switch ($error_no) {
		case '1':
			echo 'Block third-party cookies is enable on your browser. Please disable it and relaod this page.';
			break;
		case '2':
			if(!empty($_GET['url'])) {

				$url = $_GET['url'];
				echo 'Your browser not support iframe. Please click here '.'<a target="_blank" href="'.$url.'">'.$url.'</a>'.' to open link in new window';
			}
			else {
				echo 'Your browser not support iframe.';
			}
			break;
		
		default:
			echo 'Invalid request';
			break;
	}
}
else {
	echo 'Invalid request';
}
?>

</body>
</html>