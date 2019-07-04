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
			padding:0 75px;
		}
		.pdf-large-image{
			width:550px;
			height:550px;
			float:right;
		}
		.pdf-header-left-large-text{
			font-family: 'Montserrat', sans-serif;
			font-size: 80px;
			color: #000;
			text-transform: uppercase;
			font-weight: 300;
			width:545px;
			float:left;
			line-height: 107px;
			margin-top: 45px;
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
			color:#000;
			font-size:26px;
		}
		
		.get-a-free-text{
			color: #000;
			font-size: 34px;
                        text-transform: uppercase;
                        font-weight: 700;
                        margin: 78px 0 77px;
                        text-align: center;
		}
		
		.footer-area{
			background-color: <?php echo $theme; ?>;
			padding:40px 0;
		}
		.left-owner-image{
			width:198px;
			height:249px;
			float:left;
		}
		.owner-text{
			width: 425px;
			float: left;
			color: #fff;
			font-size: 24px;
			font-weight: 300;
			line-height: 47px;
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
	</style>
</head>
<body>

	<div class="container">
		<div class="padding-left-right">
		
			<div class="pdf-large-image">
				<img src="<?php echo base_url("assets/images/flyer/header-large-image.png"); ?>">
			</div><!-- .pdf-large-image -->
			
			<div class="pdf-header-left-large-text">
				How Much is Your Home Worth?
			</div><!-- .pdf-header-left-large-text -->
			
			<div class="cf"></div>
			
			<div class="left-small-text-area">
				<div class="text-divider-top"></div>
				<div class="the-four-text">
					THE 4 FACTORS THAT DETERMINE HOME VALUES ARE
				</div>
				<div class="temaut-text">
					Tem aut ut amet etur? Beritatur si officidi re perovid icates molupti comnima gnatia ditem dolest, te dolestrumqui odit derro et, inctem et aut molore ipid quam rerion conserchil et maio et omnimil inimodi ostiat del iducit, iderum eicia cone sin re aperfer ehendipsam quibus nobis re est aliam, nisqui am fuga. Obit, officimusam con poremolore, occatem fugitatur?
				</div>
			</div><!-- .left-small-text-area -->
			
			<div class="right-4-images-area">
				<div class="four-image-left">
					<div class="four-image"><img src="<?php echo base_url("assets/images/flyer/four-image-1.png"); ?>"></div>
					<div class="four-image"><img src="<?php echo base_url("assets/images/flyer/four-image-3.png"); ?>"></div>
				</div><!-- .four-image-left -->
				<div class="four-image-right">
					<div class="four-image"><img src="<?php echo base_url("assets/images/flyer/four-image-2.png"); ?>"></div>
					<div class="four-image"><img src="<?php echo base_url("assets/images/flyer/four-image-4.png"); ?>"></div>
				</div><!-- .four-image-left -->
			</div><!-- .right-4-images-area -->
			
		</div><!-- .padding-left-right -->
	</div><!-- .container -->
	
	<div class="cf"></div>
	
	<div class="get-a-free-text">
		GET A FREE MARKET ANALYSIS VIA TEXT<br>
		WWW.MODERNAGENT.IO/CMA<br>
		CODE: <?php echo $ref_code; ?>
	</div><!-- .get-a-free-text -->
	
	<div class="footer-area cf">
		<div class="container">
			<div class="padding-left-right">
				
				<div class="left-owner-image">
					<img style="height:240px; max-height:240px;max-width:200px;" src="<?php echo base_url($profile_image); ?>">
				</div><!-- .left-owner-image -->
				
				<div class="owner-text">
					<?php echo $fullname; ?><br>
					CaBRE# <?php echo $license_no; ?><br>
					<?php echo $phone; ?><br>
					<?php echo $email; ?><br>
					<?php echo $company_name; ?>
				</div><!-- .left-owner-image -->
                                <div class="footer-logo-area">
                                    <div class="footer-logo"><img style="width:300px;max-height:200px;max-width:300px;" src="<?php echo base_url($company_logo); ?>"></div><!-- .footer-logo -->
                                        <div class="footer-logo-text">
                                                <?php echo $company_name; ?>
                                        </div><!-- .footer-logo-text -->
                                </div><!-- .footer-logo-area -->
				
			</div><!-- .padding-left-right -->
			
			
			
		</div><!-- .container -->
	</div><!-- .get-a-free-text -->
	
</body>
</html>
