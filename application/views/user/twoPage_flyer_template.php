<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
        <link href="https://fonts.googleapis.com/css?family=Montserrat:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"> 
	<style>            
		*, ::after, ::before {
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
		}
		*, ::after, ::before {
			box-sizing: border-box;
		}
		html, body {
			height: 100%;
			margin:0;
			padding:0;
			font-family:'Montserrat', sans-serif;
		}
		.cf:before, .cf:after {content:"";display:table;}
		.cf:after {clear:both;}
		.cf {zoom:1;}
		.container{
			width:1275px;
			margin:0 auto;
		}
		.padding-left-right{
			padding:0 25px;
		}
		.pdf-large-image{
			width:42%;
			float:right;
		}
		.pdf-header-left-large-text{
			font-family: 'Montserrat', sans-serif;
			font-size: 80px;
			color: #000;
			text-transform: uppercase;
			font-weight: 300;
			width:58%;
			float:left;
			line-height: 107px;
		    padding-top: 50px;
    		background: #fff;
    		padding-left: 25px;
			padding-right: 25px;
			padding-bottom: 44px;
		}
		
		.right-4-images-area{
			width:550px;
			float:right;
		}
		.four-image-left{
			width:251px;
			float:left;
		}
		.four-image-right{
			width:251px;
			float:right;
		}
		.four-image{
			width:251px;
			height:212px;
			float:right;
			margin-bottom:31px;
		}
		
		.left-small-text-area{
			width:545px;
			float:left;
		}
		
		.text-divider-top{
			width:226px;
			height:15px;
			background:<?php echo $theme; ?>;
		}
		.the-four-text{
			color:#000;
			font-size:31px;
			text-transform:uppercase;
			font-weight: 150;
			margin: 47px 0 32px 0;
		}
		.temaut-text{
		    color: #000;
		    font-size: 26px;
		    line-height: 36px;
		    font-weight: 150;
		    text-transform: none;
		}
		
		.get-a-free-text{
		    font-size: 30px;
		    line-height: 48px;
		    font-weight: 150;
		    margin: 30px 0;
		    text-align: center;
		}
		.user_code{
			color:<?php echo $theme; ?>;
			font-size: 32px;
		}
		.footer-area{
			background-color: <?php echo $theme; ?>;
			padding:40px 0;
		}
		.left-owner-image{
			width:200px;
			height:200px;
			float:left;
		}
		.owner-text{
			width: 425px;
			float: left;
			font-size: 24px;
			font-weight: 300;
			line-height: 36px;
			margin: 7px 0 0 20px;
		}
		.footer-logo-area{
			width:300px;
			float:right;
		}
		.footer-logo{
			text-align:center;
			margin-top: 30px;
		}
		.footer-logo-text{
			text-align:center;
			color: #fff;
			font-size: 28px;
			font-weight: 300;
			margin-top: 5px;
		}
        imgh{
            width:50%;
        }
        img{
            width:inherit;
        }
        .firstTextHeadingFront{
			color:<?php echo $theme; ?>;
		    font-size: 70px;
		    margin-bottom: 0px;
		    margin-top: 90px;
		}
		.secondTextHeadingFront{
			color:#fff;
			font-size: 55px;
			margin-top: 0px;
		}
		.rightBoxFlyerBack{
			color: #fff;
		    padding: 50px;
    		background: transparent;
		}
		.post_ticket {
		    padding: 80px;
		    text-align: right;
		    border: 2px dashed;
		    width: 100px;
		    margin-bottom: 40px;
		    float: right;
		}
		.line {
		    float: none;
		    padding: 35px;
		    border-bottom: 2px solid;
		    clear: both;
		}
		.foldingArea{
			height: 10px;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="frontPage">
			<div style="background: url('<?php echo base_url('assets/flyers/page1_horizontal.jpg'); ?>');background-size: cover;position: relative;height: 825px;background-position: 0 0;"">
				<div style="text-align: right;padding-right: 100px;padding-top: 22px;">
					<h1 class="firstTextHeadingFront">HOME TOO SMALL?</h1>
					<h1 class="secondTextHeadingFront">IT MIGHT BE TIME<br/>FOR AND UPGRADE</h1>
				</div>
			</div>
		</div>
		<div class="foldingArea">
			
		</div>
		<div class="backPage" style="background:<?php echo $theme; ?>;">
			<div class="pdf-header-left-large-text">
				<div>
					<div class="left-owner-image">
						<img style="height: 200px;max-height: 200px;max-width:200px;" src="<?php echo base_url($profile_image); ?>">
					</div><!-- .left-owner-image -->
					<div class="owner-text">
						<strong><?php echo $fullname; ?></strong><br>
						Realtor | Lic# <?php echo $license_no; ?><br>
						<?php echo $phone; ?><br>
						<?php echo $email; ?><br>
						<?php echo $company_name; ?>
					</div><!-- .left-owner-image -->
					<div style="clear: both;"></div>
				</div>
				<div class="">
					<div class="" style="font-size: 32px;font-weight: 600;line-height: normal;margin: 15px 0;">
						IT MAY BE TIME FOR AN UPGRADE.
					</div>
					<div class="temaut-text">
						How have you been contemplating upgrading to a home that gives you more space now is the time to act. Many home owners like yourselves are taking advantage of built up equity and low interest rates to upgrade to a more suitable home. Let me help you find your new home.
					</div>
					<div class="get-a-free-text">
						Find out what your home is worth:<br>
						go to: www.modernagent.io/cma<br>
						<h2 class="user_code"><?php echo $ref_code; ?></h2>
					</div><!-- .get-a-free-text -->
				</div><!-- .left-small-text-area -->				
			</div><!-- .pdf-header-left-large-text -->
			<div class="pdf-large-image rightBoxFlyerBack">
				<div class="post_ticket"></div>
				<div class="line"></div>
				<div class="line"></div>
				<div class="line"></div>
			</div><!-- .pdf-large-image -->
			<div class="cf"></div>
		</div><!-- .padding-left-right -->
	</div><!-- .container -->
</body>
</html>