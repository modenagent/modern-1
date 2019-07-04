<!doctype html>
<html>
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Boxed - Coming Soon</title> <!-- Add your title -->
    <link rel="shortcut icon" href="images/favicon.ico" /> <!-- Add your own favicon to the images folder -->
    
    <!-- STYLES -->
    
    <!-- Bootstrap 3.1.1 -->
    <link rel="stylesheet" type="text/css" href="maint/bootstrap/css/bootstrap.min.css" />
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="maint/font-awesome/css/font-awesome.min.css" />
    <!-- Ketchup-->
    <link rel="stylesheet" type="text/css" href="maint/styles/jquery.ketchup.css" />
    <!-- STYLES.CSS -->
    <link rel="stylesheet" type="text/css" href="maint/styles/styles.css" />
    
    <!--[if lt IE 9]>
        <script type="text/javascript" src="maint/scripts/respond.min.js"></script>
        <script type="text/javascript" src="maint/scripts/html5shiv.js"></script>
    <![endif]-->
    
</head>
<body>
    
    <!-- MAIN -->
    <section class="main">
    	<div class="container">
			<span class="logo"><img src="maint/images/logo.png" alt="Boxed"></span>
			<h1 class="main-heading">We Will Be Back Soon!</h1>
			<h1 class="sub-heading">It won't be long. We will be here in...</h1>
    	</div>
    </section> <!-- end main -->
    
    <!-- COUNTDOWN SECTION -->
    <section class="countdown-section clearfix">
    	<div id="countdown" class="countdown">
			<div class="time col-sm-3">
				<span class="days">00</span>
				<p class="timeRefDays">days</p>
			</div> <!-- end time -->
			<div class="time col-sm-3">
				<span class="hours">00</span>
				<p class="timeRefHours">hours</p>
			</div> <!-- end time -->
			<div class="time col-sm-3">
				<span class="minutes">00</span>
				<p class="timeRefMinutes">minutes</p>
			</div> <!-- end time -->
			<div class="time col-sm-3">
				<span class="seconds">00</span>
				<p class="timeRefSeconds">seconds</p>
			</div> <!-- end time -->
		</div> <!-- end countdown -->
    </section> <!-- end countdown-section -->
    
    <!-- EMAIL SIGNUP SECTION -->
    <section class="email-signup">
    	<div class="container">
    		<h1 class="heading">Get Updates</h1>
    		<p class="lead">Submit your email and we will notify you when we launch.</p>
    		<form action="maint/scripts/newsletter.php" method="post" id="newsletter-form">
				<input type="email" name="newsletter-email" id="newsletter-email" class="form-control" placeholder="Enter Your Email" data-validate="validate(required, email)" />
				<input type="submit" id="newsletter-submit" class="btn" value="Notify Me" />
                <div class="alert alert-success" id="newsletter-success"></div>
                <div class="alert alert-danger" id="newsletter-error"></div>
            </form> <!-- end newsletter-form -->
    	</div> <!-- end container -->
    </section> <!-- end email-signup -->
    
    <!-- FOOTER SECTION -->
    <section class="footer">
    	<div class="container">
    		<p class="lead copyright">Copyright &copy; 2017, All Rights Reserved</p>
    		<ul class="list-inline">
    			<li><a href="#" class="social-icon tool-tip" title="Twitter"><i class="fa fa-twitter"></i></a></li>
    			<li><a href="#" class="social-icon tool-tip" title="Facebook"><i class="fa fa-facebook"></i></a></li>
    			<li><a href="#" class="social-icon tool-tip" title="Google+"><i class="fa fa-google-plus"></i></a></li>
    		</ul>
    	</div> <!-- end container -->
    </section> <!-- end footer -->
    
    <!-- SCRIPTS -->
    
    <!-- jQuery 1.10.2 -->
    <script type="text/javascript" src="maint/scripts/jquery-1.10.2.min.js"></script>
    <!-- Bootstrap 3.1.1 -->
    <script type="text/javascript" src="maint/bootstrap/js/bootstrap.min.js"></script>
    <!-- Ketchup -->
    <script type="text/javascript" src="maint/scripts/jquery.ketchup.all.min.js"></script>
    <!-- Countdown -->
    <script type="text/javascript" src="maint/scripts/cd.js"></script>
    <!-- Retina -->
    <script type="text/javascript" src="maint/scripts/retina.js"></script>
    <!-- Backstretch Slideshow -->
    <script type="text/javascript" src="maint/scripts/jquery.backstretch.min.js"></script>
    <!-- SCRIPTS.JS -->
    <script type="text/javascript" src="maint/scripts/scripts.js"></script>

</body>
</html>