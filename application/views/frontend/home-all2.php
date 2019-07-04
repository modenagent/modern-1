<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Listing Pitch - Personalized Listing Presentations</title>

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

<!-- Custom CSS -->
<link href="<?php echo base_url(); ?>assets/css/lp-style.css" rel="stylesheet">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="home-all">
<a id="home"></a>

<!-- code commited -->
<!-- Navigation -->
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-top-main"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      <a class="navbar-brand" href="#home"><img src="<?php echo base_url(); ?>assets/images/logo4.png" alt="Listing Pitch"></a> </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-top-main" >
      <ul class="nav navbar-nav navbar-right">
        <li> <a href="#home">Home</a> </li>
        <li> <a href="#features">Features</a> </li>
        <li> <a href="#screenshots">Screenshots</a> </li>
        <li> <a href="#product-info">Details</a> </li>
        <li> <a href="#pricing">Pricing</a> </li>
        <li> <a href="#listings">Coverage</a> </li>
        <li> <a href="#footer">Contact</a> </li>
        <li> <a href="<?php echo base_url().'index.php?/frontend/login'; ?>" class="btn btn-lp external">Login</a> </li>
      </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container --> 
</nav>
<section id="myCarousel" class="carousel slide"> 
  <!-- Indicators -->
  <ol class="carousel-indicators">
    <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
    <li data-target="#myCarousel" data-slide-to="1"></li>
    <li data-target="#myCarousel" data-slide-to="2"></li>
  </ol>
  
  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <div class="fill" style="background:url(<?php echo base_url(); ?>assets/images/darkbgnew.jpg) no-repeat 0 0;"></div>
      <div class="container">
        <div class="row">
          <div class="col-md-5">
            <h2>Personalize Your <span>Listing Pitch.</span></h2>
            <p>Personalized Listing Pitch report to help you make the perfect impression on your listing appoinments.</p>
            <div class="btn-wrap"> <a class="btn" href="<?php echo base_url(); ?>index.php?/frontend/register">Create Account</a><span>or</span><a class="btn" href="<?php echo base_url().'index.php?/frontend/login'; ?>">Login Now</a> </div>
          </div>
	 <div class="col-md-7">
				<div id="main-slider" class="flexslider">
					<ul class="slides">
						<li class="flex-active-slide" style="width: 100%; padding-top:40px; float: left; margin-right: -100%; position: relative; display: list-item;"><img src="<?php echo base_url(); ?>assets/images/LPMockup.png" alt=""></li>
					</ul>
				</div>
			</div>
        </div>
      </div>
    </div> 
  </div>
  
  </section>
<section class="content" id="features">
  <div class="container">
    <h1 class="page-header"> What is a Listing Pitch? </h1>
    <p>A Listing Pitch is a carefully crafted   report that helps Real Estate Agents make the right impression on their listing appointments. Each Listing Pitch includes the following:</p>
    <div class="features-list">
      <div class="col-md-3 text-center">
        <div class="features-icon"><img src="<?php echo base_url(); ?>assets/images/ico10.png" alt=""></div>
        <div class="feature-desc">
          <h3 class="text-uppercase">Neighborhood Sales Analysis</h3>
          <p>Our neighborhood sales analysis helps you inform and educate your clients about current and future sales trends. </p>
        </div>
      </div>
      <div class="col-md-3 text-center">
        <div class="features-icon"><img src="<?php echo base_url(); ?>assets/images/ico9.png" alt=""></div>
        <div class="feature-desc">
          <h3 class="text-uppercase">Recently Sold Sales Comparables</h3>
          <p>Directly compare your clients home to other homes that have been sold, are actively listed, or have pending offers.</p>
        </div>
      </div>
      <div class="col-md-3 text-center">
        <div class="features-icon"><img src="<?php echo base_url(); ?>assets/images/ico13.png" alt=""></div>
        <div class="feature-desc">
          <h3 class="text-uppercase">Estimated Market Sales Price</h3>
          <p>Utilize our current value assessment to determine what the fair market value of your client's home might be.</p>
        </div>
      </div>
      <div class="col-md-3 text-center">
        <div class="features-icon"><img src="<?php echo base_url(); ?>assets/images/ico15.png" alt=""></div>
        <div class="feature-desc">
          <h3 class="text-uppercase">Realtor Marketing Action Plan</h3>
          <p>Impress your client by showing them the action plan that you have in place to get their home sold for top dollar.</p>
        </div>
      </div>
    </div>
  </div>
</section>



<section class="" id="screenshots">
  <div class="container">
    <h1 class="page-header">Fresh Themes &amp; Colors</h1>
    <p>We have created various themes for you to choose from. Whether you are part of a larger franchise or work independently we have the right color scheme that fits you.</p>
    <div class="row screenshot-list">
      <div id="owl-example" class="owl-carousel">
        <div class="item"> 
			<img src="assets/images/works/1.jpg" alt=""> 
			<a href="assets/images/works/1.jpg" class="prettyPhoto">
				<span class="overlay"></span>
			</a> 
		</div>
        <div class="item"> <img src="<?php echo base_url(); ?>assets/images/works/2.jpg" alt=""> <a href="<?php echo base_url(); ?>assets/images/works/2.jpg" class="prettyPhoto"><span class="overlay"></span></a> </div>
        <div class="item"> <img src="<?php echo base_url(); ?>assets/images/works/3.jpg" alt=""> <a href="<?php echo base_url(); ?>assets/images/works/3.jpg" class="prettyPhoto"><span class="overlay"></span></a> </div>
        <div class="item"> <img src="<?php echo base_url(); ?>assets/images/works/4.jpg" alt=""> <a href="<?php echo base_url(); ?>assets/images/works/4.jpg" class="prettyPhoto"><span class="overlay"></span></a> </div>
        <div class="item"> <img src="<?php echo base_url(); ?>assets/images/works/5.jpg" alt=""> <a href="<?php echo base_url(); ?>assets/images/works/5.jpg" class="prettyPhoto"><span class="overlay"></span></a> </div>
        <div class="item"> <img src="<?php echo base_url(); ?>assets/images/works/6.jpg" alt=""> <a href="<?php echo base_url(); ?>assets/images/works/6.jpg" class="prettyPhoto"><span class="overlay"></span></a> </div>
        <div class="item"> <img src="<?php echo base_url(); ?>assets/images/works/7.jpg" alt=""> <a href="<?php echo base_url(); ?>assets/images/works/7.jpg" class="prettyPhoto"><span class="overlay"></span></a> </div>
        <div class="item"> <img src="<?php echo base_url(); ?>assets/images/works/8.jpg" alt=""> <a href="<?php echo base_url(); ?>assets/images/works/8.jpg" class="prettyPhoto"><span class="overlay"></span></a> </div>
      </div>
    </div>
  </div>
</section>

<section class="content" id="product-info">
  <div class="container">
    <h1 class="page-header">Every Listing Pitch Includes</h1>
    <p>We have created various themes for you to choose from. Whether you are part of a larger franchise or work independently we have the right color scheme that fits you.</p>
    <div class="clearfix detail-list">
      <div class="row">
          
        <div class="clearfix">
          <div class="col-md-6 col-sm-6">
            <h4 class="info">Automatically Calculates E.S.P.</h4>
            <p>Dont have time to create a C.M.A.? We got your back. Our algorithm uses a couple of simple factors to help generate a Estimated Market Value of your prospective sellers property.</p>
          </div>
          <div class="col-md-6 col-sm-6"> <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/insight/branding5.jpg" alt=""> </div>
        </div>
        <div class="clearfix">
          <div class="col-md-6 col-sm-6"> <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/insight/branding6.jpg" alt=""> </div>
          <div class="col-md-6 col-sm-6">
            <h4 class="info">Comparables From Recent Sales</h4>
            <p>Each Listing Pitch Report incorporates recently sold comparable properties intended to help you analyze the recent sales in the neighborhood.</p>
          </div>
        </div>
        <div class="clearfix">
          <div class="col-md-6 col-sm-6">
            <h4 class="info">Neighborhood Sales Analysis</h4>
            <p>Want to inform your prospective seller about sale trends in their neighborhood? Our neighborhood sales analysis does just that. We analyze all recent sale information and chart it to make it easy to understand.</p>
          </div>
          <div class="col-md-6 col-sm-6"> <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/insight/branding3.jpg" alt=""> </div>
        </div>
     <div class="clearfix">
          <div class="col-md-6 col-sm-6"> <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/insight/branding2.jpg" alt=""> </div>
          <div class="col-md-6 col-sm-6">
            <h4 class="info">9 Point Marketing Plan</h4>
            <p>We collaborated with many Real Estate professionals to create a 9-point property marketing plan to show prospective sellers that you have what it takes to get thier property sold.</p>
          </div>
        </div>
      <div class="clearfix">
          <div class="col-md-6 col-sm-6">
            <h4 class="info">Personalized With Your Info</h4>
            <p>You can personalize your Listing Pitch report with your picture, contact info, company logo, and bio. Got a partner? You can add him/her too. We have various theme to fit your branding style.</p>
          </div>
          <div class="col-md-6 col-sm-6"> <img class="img-responsive" src="<?php echo base_url(); ?>assets/images/insight/branding4.jpg" alt=""> </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section id="newsletter">
  <div class="container">
    <div class="row">
      <div class="col-md-12 newsletter-inner">
        <div class="col-md-7">
          <h4>Subscribe to receive news and updates directly to your inbox</h4>
          <p>We dont share your email. Promise.</p>
        </div>
        <div class="col-md-5">
          <input type="email" placeholder="Email address here">
          <input type="button" value="Subscribe mail">
        </div>
      </div>
    </div>
  </div>
</section>
<section class="content" id="pricing">
  <div class="container">
    <h1 class="page-header">Simple Plans &amp; Even More Simple Pricing</h1>
    <p>Scroll over to view the details of your plan.</p>
<div class="row">
      <div class="col-md-4">
        <div class="pricing-inner">
          <div class="pricing-inner-white">
            <div class="plan_ico"><img src="<?php echo base_url(); ?>assets/images/ico4a.png" alt="" data-pin-nopin="true"></div>
            <div class="plan_price"><span>$3</span></div>
            <div class="plan_title">ENGLISH</div>
            <div class="plan_title">PDF FORMAT</div>
            <div class="pricing-inner-sub">
              <ul class="pricing_list">
                <li>Estimated Market Value</li>
                <li>Recent Comparables</li>
                <li>Area Sales Analysis</li>
                <li>9 Point Marketing Plan</li>
                <li>Agent Picture</li>
                <li>Agent Contact Info</li>
                <li>Partner Info (Optional)</li>
              </ul>
              <div class="plan_more1"><a href="javascript:;">Create Report Now</a></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="pricing-inner">
          <div class="pricing-inner-white">
            <div class="plan_ico"><img src="<?php echo base_url(); ?>assets/images/ico4a.png" alt="" data-pin-nopin="true"></div>
            <div class="plan_price"><span>$3</span></div>
            <div class="plan_title">SPANISH</div>
            <div class="plan_title">**COMING SOON**</div>
            <div class="pricing-inner-sub">
              <ul class="pricing_list">
                  <li>Estimated Market Value</li>
                <li>Recent Comparables</li>
                <li>Area Sales Analysis</li>
                <li>9 Point Marketing Plan</li>
                <li>Agent Picture</li>
                <li>Agent Contact Info</li>
                <li>Partner Info (Optional)</li>
              </ul>
              <div class="plan_more1"><a href="javascript:;">Create Report Now</a></div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="pricing-inner">
          <div class="pricing-inner-white">
            <div class="plan_ico"><img src="<?php echo base_url(); ?>assets/images/ico6.png" alt=""></div>
            <div class="plan_price"><span>Call Us</span></div>
            <div class="plan_title">Broker Account</div>
            <div class="plan_title">**Coming Soon**</div>
            <div class="pricing-inner-sub">
              <ul class="pricing_list">
                <li>Manage Agents</li>
                <li>View All Reports</li>
                <li>Custom Template</li>
                <li>Recent Comparables</li>
                <li>Area Sales Anaylsis</li>
                <li>Estimated Property Value</li>
                <li>Marketing Action Plan</li>
              </ul>
              <div class="plan_more1"><a href="javascript:;">Create Report Now</a></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="content" id="listings">
  <div class="container text-center">
    <h1 class="page-header">Our Real Estate Data Coverage</h1>
    <p>We are constantly collecting real estate data. Our coverage and availability is growing every day. Roll over your state to see if we have data in your county.</p>
    <div class="clearfix">
     
        <div class="blog-wrap"> 

          <div id="container">
            <div class="loading">
              <i class="icon-spinner icon-spin icon-large"></i>
              Loading data ...
            </div>
          </div>

        </div>
        </div>
   <p class="clearfix">&nbsp;</p>
      
      <div class="clearfix table-responsive">
          <table class="table" style="margin-bottom:0;" >
            <thead>
              <tr>
                <!-- <th class="col-sm-2 text-center">FIPS</th> -->
                <th class="col-sm-4  text-center">COUNTY</th>
                <th class="col-sm-3 text-center">STATE</th>
                <th class="col-sm-3 text-center">Data Available</th>
                <!--<th>Deed</th>
                <th>Sam</th> -->
              </tr>
            </thead>
            </table>
            <div  class="table-scroll " style="overflow-y:scroll;max-height:200px;margin-top:-1px;" > 
              <table >
                
                <tbody id="listingTable">
                  <tr>
                    <td colspan="6">
                      <!-- <div class="loading"> -->
                        <!-- <i class="icon-spinner icon-spin icon-large"></i> -->
                        Select area to load listings..
                      <!-- </div> -->
                    </td>
                  </tr>
                </tbody>
              </table>
              
            </div>
      </div>
  
  </div>
</section>
<section id="testimonials">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="flexslider">
          <ul class="slides">
            <li data-thumb="<?php echo base_url(); ?>assets/images/quote/1.png">
              <p>The estimated C.M.V. report really helps me gauge when determining what property in question can actually sell for in today’s market.</p>
              <div class="sign">- Jose Sanchez /<span> Realtor</span></div>
            </li>
            <li data-thumb="<?php echo base_url(); ?>assets/images/quote/2.png">
              <p>All of the agents within our office use this. As soon as our agents book an appointment we create a Listing Pitch and begin to prepare.</p>
              <div class="sign">- Edgar Salcedo /<span> Real Estate Broker</span></div>
            </li>
            <li data-thumb="<?php echo base_url(); ?>assets/images/quote/4.png">
              <p>The 9 point marketing plan really makes it easy to explain to prospective sellers about what it’s going to take to get their home sold.</p>
              <div class="sign">- Brena Pena /<span> Realtor</span></div>
            </li>
            <li data-thumb="<?php echo base_url(); ?>assets/images/quote/3.png">
              <p>Today’s sellers are more informed than ever. Using Listing Pitch helps me show that I am informed about current pricing & marketing trends.</p>
              <div class="sign">- Jesse Gonzalez /<span> Realtor</span></div>
            </li>
            <li data-thumb="<?php echo base_url(); ?>assets/images/quote/5.png">
              <p>Listing pitch helps me make the perfect impression with my prospective clients. I highly recommend using this on your next listing appointment.</p>
              <div class="sign">- Lisa Johnson /<span> Realtor</span></div>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
<section id="services">

  <div class="container">
    <div class="row">
      <div class="col-md-6 services-content">
        <div class="services-ico"> <img src="<?php echo base_url(); ?>assets/images/icon-card.png" alt=""> </div>
        <div class="services-info">
          <h4>No Monthly Fees</h4>
          <p>There are no monthly fees or subscription fees. Only pay when you create a Listing Pitch report.</p>
        </div>
      </div>
      <div class="col-md-6 services-content">
        <div class="services-ico"> <img src="<?php echo base_url(); ?>assets/images/icon-statistic2.png" alt="" data-pin-nopin="true"> </div>
        <div class="services-info">
          <h4>Create Report Instantly</h4>
          <p>Our automated system helps you create a report instantly and effortlessly</p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 services-content">
        <div class="services-ico"> <img src="<?php echo base_url(); ?>assets/images/icon-map.png" alt="" data-pin-nopin="true"> </div>
        <div class="services-info">
          <h4>Integrated with Goolge Maps</h4>
          <p>Your Listing Pitch report is fully integrated with google maps to provide aerial views of the PIQ.</p>
        </div>
      </div>
      <div class="col-md-6 services-content">
        <div class="services-ico"> <img src="<?php echo base_url(); ?>assets/images/icon-graph.png" alt="" data-pin-nopin="true"> </div>
        <div class="services-info">
          <h4>Accurate Data</h4>
          <p>We use the  most recent sales data to help you provide an accurate sales assessment of your clients property.</p>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="container">
  <div class="row wrap">
    <div class="twelve columns">
      <h3>Personalize Your Listing Pitch Today.</h3>
      <a href="<?php echo base_url(); ?>index.php?/frontend/register" class="btn3">Sign Up For Free Today!</a>
      <p>Your credit card will not be charged.</p>
    </div>
  </div>
</div>
<section id="social">
  <div class="container">
    <div class="col-md-12">
      <div class="col-md-7"> <i class="icon-twitter icon-3x"></i>
        <div id="tweets" style="display:none;">
          <ul class="tweetList">
          </ul>
        </div>
        <a class="tweet-ie" href="YOUR_TWITTER_URL_HERE" style="display:none;">Check our tweets here →</a> </div>
      <div class="col-md-5">
        <div class="social text-right"> <a href="javascript:;"><i class="icon-twitter"></i></a> <a href="javascript:;"><i class="icon-facebook"></i></a> <a href="javascript:;"><i class="icon-google-plus"></i></a> <a href="javascript:;"><i class="icon-linkedin"></i></a> <a href="javascript:;"><i class="icon-instagram"></i></a> </div>
      </div>
    </div>
  </div>
</section>
<footer id="footer">
  <div class="container">
    <div class="col-md-12"> 
      <!-- Contact info -->
      <div class="col-md-5">
        <h6>Contact details</h6>
        <ul class="contact-info">   
		  <li><span><i class="icon-phone"></i></span> +1 800 000-0000</li>
          <li><span><i class="icon-envelope"></i></span> support@mylistingpitch.com</li>
          <li><a href="http://www.mylistingpitch.com"><span><i class="icon-link"></i></span> www.mylistingpitch.com</a></li>
        </ul>
      </div>
      
      <!-- Contact form -->
      <div class="col-md-7">
        <h6>Shoot us a message!</h6>
        <div id="contactstatus" class="alert alert-succcess"></div>
        <form id="contactForm" action="" method="post" class="positioned">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <input name="senderName" id="senderName" type="text" placeholder="Name" required>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input type="email" name="senderEmail" id="senderEmail" placeholder="Email address" required>
              </div>
            </div>
          </div>
          <div class="form-group">
                <textarea rows="4" name="message" id="message" placeholder="Message"></textarea>
              </div>
          <div class="row">
       
            <div class="col-md-5">
              <div class="form-group">
                <img id="cimg" src="assets/captcha/image<?php echo $this->session->userdata('timestamp'); ?>.png">
                <a href="javascript:;" onClick="changeCaptcha()">Refresh</a>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <input type="text" class="form-field" placeholder="Enter Image Text" name="captcha">
                <input type="text" id="cflag" class="hidden" name="flag" value="<?php echo $this->session->userdata('timestamp'); ?>">
              </div>
            </div>
                  <div class="col-md-3">
              <div class="form-group">
                <input type="submit"  class="btn btn-detault"  value="Send">
              </div>
            </div>

          </div>
        
        </form>
      </div>
    </div>
    <div class="col-md-12 footer-copy">
      <div class="col-md-8">
        <p>&copy; 2016. Listing Pitch. All rights reserved.</p>
      </div>
      <div class="col-md-4 text-right"> <a class="backtotop" href="#home">Back to top <i class="icon-caret-up"></i></a> </div>
    </div>
  </div>
</footer>

<!-- jQuery --> 

<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.js"></script>


  
<!-- Bootstrap Core JavaScript --> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script> 
<style type="text/css">
  #container {
    height: 500px; 
    min-width: 300px; 
    max-width: 100%; 
    margin: 0 auto; 
  }
  .loading {
    margin-top: 10em;
    text-align: center;
    color: gray;
  }
</style>
<script src="<?php echo base_url(); ?>assets/highmaps/js/highcharts.js"></script>
<script src="<?php echo base_url(); ?>assets/highmaps/js/modules/map.js"></script>
<script src="<?php echo base_url(); ?>assets/highmaps/js/modules/data.js"></script>

<script src="https://code.highcharts.com/mapdata/countries/us/us-all.js"></script>
<script src="https://code.highcharts.com/mapdata/custom/world.js"></script>

<script type="text/javascript">
  var propertyData= [];
  function changeCaptcha(){
    $.ajax({
        url:'<?php echo base_url(); ?>index.php?/frontend/change_captcha?&',
        method:'GET',
        success:function(resp){
          var obj = JSON.parse(resp);
          if(obj.status=="success"){
            $('#cimg').attr('src','assets/captcha/image'+obj.timestamp+'.png');
            $('#cflag').attr('value',obj.timestamp);
          }
        }
    });
  }

  $(function () {
    
    $.get('<?php echo base_url(); ?>assets/highmaps/usproperties.csv', function(data) {
        // Split the lines
        var lines = data.split('\n');
        var tmpCountries = [];
        var dataSet=[];
        var counter = 0;
        $.each(lines, function(lineNo, line) {
          if (lineNo != 0) {
            var items = line.split(',');

            propertyData.push({
              FIPS:items[0],
              COUNTY:items[1],
              STATE:items[2],
              Assmt:items[3],
              Deed:items[4],
              Sam:items[5]
            });

			if(items[2] != undefined){
				if ($.inArray(items[2], tmpCountries) === -1) {
					counter=0;
					tmpCountries.push(items[2]);
					dataSet.push({code:items[2], value:(++counter)});
				}else{ 
	
				  var hasIndex = tmpCountries.indexOf(items[2]);
				  dataSet[hasIndex].value=(++counter);
				}
			}
          }
        });

        $('#listingTable').html('').prepend('<tr><td colspan="6"><div class="loading"><i class="icon-spinner icon-spin icon-large"></i>Loading ...</div></td></tr>');
                      var listingHtml = '';
                      for(var k in propertyData){
                        // FIPS,COUNTY,STATE,Assmt,Deed,Sam

                        listingHtml+='<tr>'
                                      +'<td class="col-sm-4 text-center">'+propertyData[k].COUNTY+'</td>'
                                      +'<td class="col-sm-3 text-center">'+propertyData[k].STATE+'</td>'
                                      +'<td class="col-sm-3 text-center">'+propertyData[k].Assmt+'</td>'
                                    +'</tr>';

                      }
                        $('#listingTable').html(listingHtml);

        // Instanciate the map
        $('#container').highcharts('Map', {
            chart : {
                borderWidth : 0,
                zoomType:'10'
            },
            title : {
                text : ''
            },
            legend: {
                enabled:false,
                layout: 'horizontal',
                borderWidth: 0,
                backgroundColor: 'rgba(255,255,255,0.85)',
                floating: true,
                verticalAlign: 'top',
                y: 25
            },
            mapNavigation: {
                enabled: false,
                enableButtons: false
            },
            colorAxis: {
                min: 1,
                type: 'logarithmic',
                minColor: '#EEEEFF',
                maxColor: '#000022',
                stops: [
                    [0, '#EFEFFF'],
                    [0.67, '#4444FF'],
                    [1, '#000022']
                ]
            },
            credits:true,
            series : [{
                animation: {
                    duration: 1000
                },
                data : dataSet,
                mapData: Highcharts.maps['countries/us/us-all'],
                joinBy: ['postal-code', 'code'],
                dataLabels: {
                    enabled: true,
                    color: 'white',
                    format: '{point.code}'
                },
                name: '',
                tooltip: {
                    pointFormat: ' {point.value} Counties Available'
                },
                point: {
                  events: {
                    mouseOver: function(){
                      var element = this;
                      var tmpFilterData = $.grep(propertyData, function(obj, key){return obj.STATE==element.code;});
                      $('#listingTable').html('').prepend('<tr><td colspan="6"><div class="loading"><i class="icon-spinner icon-spin icon-large"></i>Loading ...</div></td></tr>');
                      var listingHtml = '';
                      for(var k in tmpFilterData){
                        // FIPS,COUNTY,STATE,Assmt,Deed,Sam

                        listingHtml+='<tr>'
                                      +'<td class="col-sm-4 text-center">'+tmpFilterData[k].COUNTY+'</td>'
                                      +'<td class="col-sm-3 text-center">'+tmpFilterData[k].STATE+'</td>'
                                      +'<td class="col-sm-3 text-center">'+tmpFilterData[k].Assmt+'</td>'
                                    +'</tr>';

                      }
                        $('#listingTable').html(listingHtml);
                    }
                  }
                }
            }]
        });
    });

    $('#contactForm').submit(function(){

      $.ajax({
        url:'<?php echo base_url(); ?>index.php?/frontend/contactreq?&',
        method:'POST',
        data: $('#contactForm').serialize(),
        success:function(resp){
          var obj = JSON.parse(resp);
          if(obj.status=="success"){
            document.getElementById('contactForm').reset();
            $('#contactstatus').removeClass("alert-danger").addClass("alert-success").html(obj.msg).show();
            changeCaptcha();
          }else{
            $('#contactstatus').removeClass("alert-success").addClass("alert-danger").html(obj.msg).show();
          }
          setTimeout(function(){
            $('#contactstatus').fadeOut(3500);
          },3000);
        }
      });
      return false;s

    });
      
});
</script>


<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.localscroll-1.2.7-min.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.scrollTo.js"></script> 
<script type="text/javascript" src='<?php echo base_url(); ?>assets/js/jquery.easing.1.3.js'></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.flexslider.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/carousel.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.prettyphoto.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.nav.js"></script> 
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/custom.js"></script> 


<script>
      $(function() {
      
	  $('.flexslider').flexslider({
        animation: "slide",
        controlNav: "thumbnails",
        directionNav: true
      });
      $("a[class^='prettyPhoto']").prettyPhoto({theme:'pp_default'});
      $("#owl-example").owlCarousel();
      $('.nav li').localScroll();
      $('.nav').onePageNav({filter: ':not(.external)'});
    });
    </script>
</body>
</html>