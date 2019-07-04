<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		@font-face {
		    font-family: 'Montserrat';
		    src: url('<?php echo base_url('assets/flyers/pdf-to-html/fonts/Montserrat-Light.eot'); ?>');
		    src: url('<?php echo base_url('assets/flyers/pdf-to-html/fonts/Montserrat-Light.eot?#iefix'); ?>') format('embedded-opentype'),
		        url('<?php echo base_url('assets/flyers/pdf-to-html/fonts/Montserrat-Light.woff2'); ?>') format('woff2'),
		        url('<?php echo base_url('assets/flyers/pdf-to-html/fonts/Montserrat-Light.woff'); ?>') format('woff'),
		        url('<?php echo base_url('assets/flyers/pdf-to-html/fonts/Montserrat-Light.ttf'); ?>') format('truetype'),
		        url('<?php echo base_url('assets/flyers/pdf-to-html/fonts/Montserrat-Light.svg#Montserrat-Light'); ?>') format('svg');
		    font-weight: 100;
		    font-style: normal;
		}
		@font-face {
		    font-family: 'Archivo';
		    src: url('<?php echo base_url('assets/flyers/pdf-to-html/fonts/ArchivoBlack-Regular.eot'); ?>');
		    src: url('<?php echo base_url('assets/flyers/pdf-to-html/fonts/ArchivoBlack-Regular.eot?#iefix'); ?>') format('embedded-opentype'),
		        url('<?php echo base_url('assets/flyers/pdf-to-html/fonts/ArchivoBlack-Regular.woff2'); ?>') format('woff2'),
		        url('<?php echo base_url('assets/flyers/pdf-to-html/fonts/ArchivoBlack-Regular.woff'); ?>') format('woff'),
		        url('<?php echo base_url('assets/flyers/pdf-to-html/fonts/ArchivoBlack-Regular.ttf'); ?>') format('truetype'),
		        url('<?php echo base_url('assets/flyers/pdf-to-html/fonts/ArchivoBlack-Regular.svg#ArchivoBlack-Regular'); ?>') format('svg');
		    font-weight: 900;
		    font-style: normal;
		}
		@font-face {
		    font-family: 'Assistant';
		    src: url('<?php echo base_url('assets/flyers/pdf-to-html/fonts/Assistant-Light.eot'); ?>');
		    src: url('<?php echo base_url('assets/flyers/pdf-to-html/fonts/Assistant-Light.eot?#iefix'); ?>') format('embedded-opentype'),
		        url('<?php echo base_url('assets/flyers/pdf-to-html/fonts/Assistant-Light.woff2'); ?>') format('woff2'),
		        url('<?php echo base_url('assets/flyers/pdf-to-html/fonts/Assistant-Light.woff'); ?>') format('woff'),
		        url('<?php echo base_url('assets/flyers/pdf-to-html/fonts/Assistant-Light.ttf'); ?>') format('truetype'),
		        url('<?php echo base_url('assets/flyers/pdf-to-html/fonts/Assistant-Light.svg#Assistant-Light'); ?>') format('svg');
		    font-weight: 300;
		    font-style: normal;
		}
		@font-face {
		    font-family: 'Roboto-regular';
		    src: url('<?php echo base_url('assets/flyers/pdf-to-html/fonts/Roboto-Regular.eot'); ?>');
		    src: url('<?php echo base_url('assets/flyers/pdf-to-html/fonts/Roboto-Regular.eot?#iefix'); ?>') format('embedded-opentype'),
		        url('<?php echo base_url('assets/flyers/pdf-to-html/fonts/Roboto-Regular.woff2'); ?>') format('woff2'),
		        url('<?php echo base_url('assets/flyers/pdf-to-html/fonts/Roboto-Regular.woff'); ?>') format('woff'),
		        url('<?php echo base_url('assets/flyers/pdf-to-html/fonts/Roboto-Regular.ttf'); ?>') format('truetype'),
		        url('<?php echo base_url('assets/flyers/pdf-to-html/fonts/Roboto-Regular.svg#Roboto-Regular'); ?>') format('svg');
		    font-weight: normal;
		    font-style: normal;
		}

		/*fonts close*/

		*{ padding: 0; margin:0; outline: none; }
		body{ background-color: #525659;  font-family: sans-serif;}
		p{ font-family: 'Roboto-regular'; line-height: 1; font-size: 3rem; font-weight: 100;}
		/*global css*/
		.card_front{ background-image: url(<?php echo base_url('assets/flyers/pdf-to-html/imgs/TooSmallFront.jpg'); ?>); background-size: contain; }
		.card{ width: 1800px; height: 1230px; background-color: #ccc; margin:0 auto;  box-sizing: border-box; box-shadow: 0 10px 30px 0 #222; }
		.card_left{  width: 55%; height: 100%; float: left; background-color: #fff; box-sizing: border-box; padding: 3% 2%;}
		.card_right{  width: 45%; height: 100%; float: left; background-color: <?php echo $theme; ?>; box-sizing: border-box; text-align: right; }
		.card_profile{ overflow: hidden; }
		.card_img{float: left;width: 25%;margin-right: 2%;}
		.card_img img{ width: 100%; }
		.card_details{ float: left;  padding-right:0%; color:#1C3555;}
		.card_details h1{ font-size: 3rem; font-weight: bolder;  font-family: 'Archivo';}
		.card_details p{  line-height: 1.3;  font-family: 'Montserrat';font-size: 2.5rem;}
		.card_para{ width: 100%; padding: 3% 0; }
		.card_para h2{ font-weight: 700; font-size: 3.38rem; color:#31384F; margin-bottom: 15px; font-family: 'Roboto-regular';}
		.card_para p{  color: #979EA7;  text-align:justify; letter-spacing: -3px;}
		.card_link{ margin-top: 3%; }
		.card_link p{  letter-spacing: 0px; font-family: 'Assistant'; font-size: 4rem; text-align: center; }
		.card_link p>a{ text-decoration: none; color: #979EA7;}
		.card_link span{ color:<?php echo $theme; ?>; display: block; font-size: 5rem; text-align: center; padding: 3% 0; font-family: 'Montserrat'; }
		/*card left side close*/

		.card_right{ padding: 3% 6% 0 3%; }
		.card_square:before {content: ""; position: absolute; border: 11px dashed #fff; top: -8px; bottom: -8px; left: -8px; right: -8px; } 
		.card_square{ overflow: hidden; position: relative; text-align: center; padding: 10px; margin-bottom: 20px; width: 45%; height: 335px; float: right; display: block; }
		.card_line{ width: 100%; height: 2px; background-color: #fff; overflow: hidden; position: relative; top: 160px; }
		.card_line2{ margin-top: 130px; }
		.card_line3{ margin-top: 130px; }
	</style>	
</head>
<body>
<div class="card card_front">
	
</div>
<div class="card">
	<div class="card_left">
		<div class="card_profile">
			<div class="card_img">
				<img style="max-height: 400px;max-width:280px;" src="<?php echo base_url($profile_image); ?>">
			</div>
			<div class="card_details">
				<h1><?php echo $fullname; ?></h1>
				<p>Realtor | Lic# <?php echo $license_no; ?></p>
				<p><?php echo $phone; ?></p>
				<p><?php echo $email; ?></p>
				<p><?php echo $company_name; ?></p>
			</div>
		</div>
		<div class="card_para">
			<h2>IT MAYBE TIME FOR AN UPGRADE.</h2>
			<p>How have you been contemplating upgrading to a
				home that gives you more space now is the time to
				act. Many home owners like yourselves are taking
				advantage of built up equity and low interest rates
				to upgrade to a more suitable home. Let me help
				you find your new home.</p>
			<div class="card_link">
				<p>Find our what your home is worth:</p>
				<p>go to: <a href="www.modernagent.io/cma">www.modernagent.io/cma</a></p>
				<span><?php echo $ref_code; ?></span>
			</div>		
		</div>		
	</div>
	<div class="card_right">
		<div class="card_square">
			
		</div>
		<div class="card_line"></div>
		<div class="card_line card_line2"></div>
		<div class="card_line card_line3"></div>
	</div>
</div>
</body>
</html>