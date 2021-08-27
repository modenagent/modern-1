 &nbsp; | &nbsp; <div class="dropdown more-page-drop">
<a class="dropdown-toggle " style=""   data-toggle="dropdown" title="configure More page" >More Pages</a>
 <span class="caret"></span></button>
  <ul class="dropdown-menu">
  	<?php if(count($featured_homes)) : ?>
    <?php endif; ?>
  	<li><a href="#" data-toggle="modal" data-target="#conf-cover-main" title="configure Main Cover Page">Main Cover Page </a></li>
    <li><a href="#" data-toggle="modal" data-target="#conf-cover-letter" title="configure Cover Letter">Cover Letter </a></li>
    <li><a href="#"  data-toggle="modal" data-target="#update-featured" title="Featured Homes" >Featured Homes</a></li>
    <!-- <li><a href="#" data-toggle="modal" data-target="#conf-portfolio-text" title="configure Portfolio"> Portfolio Text </a></li> -->
    <li><a href="#" data-toggle="modal" data-target="#conf-resume-text" title="configure Resume"> Resume </a></li>
    <li><a href="#" data-toggle="modal" data-target="#conf-social-media" title="configure Social Media Text"> Social Media </a></li>
    <li><a href="#" data-toggle="modal" data-target="#conf-social-ad" title="configure Social AD Report"> Social AD Report </a></li>
  </ul>
</div>
<style type="text/css">
	#cma-widget-container .more-page-drop {
		padding: 9px 10px;
    	border: 1px solid #fff;
	    font: 11px Montserrat;
	    text-transform: uppercase;
	    float: right;
	    margin-top: -10px;
	}
	#cma-widget-container #step-3 #butcomp > a {
		cursor: pointer;
		font-size: 11px;
        padding: 10px 9px;

	}
	#cma-widget-container #step-3 #butcomp a:hover,#cma-widget-container #step-3 #butcomp .dropdown:hover {
	    background-color: #fff;
	    font-weight: 500;
	    color: #cc9964;
	    cursor: pointer;
	}
	#cma-widget-container #step-3 #butcomp .dropdown:hover > a{
		color: #cc9964;
	}
	#butcomp .dropdown-menu
	{
		background: rgba(1,1,1,0.7);
	    color: #111;
	    border: 1px solid #fff;
	    left: -30px;

	}
	#cma-widget-container .search-result .btn-sm {
		    color: #bfaf87;
	}
</style>