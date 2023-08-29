  <?php 
    $availableCompareAble = sizeof($areaSalesAnalysis['comparable']);
                            $sQFootage=0;
                            $avgNoOfBeds = 0;
                            $avgNoOfBaths = 0;
                            $minRange = $areaSalesAnalysis['comparable'][0]['PriceRate'];
                            $maxRange = $areaSalesAnalysis['comparable'][0]['PriceRate'];
                            foreach ($areaSalesAnalysis['comparable'] as $key => $cpmrebl) {
                              if($key>8){
                                break;
                              }

                              if($minRange> $cpmrebl['PriceRate']){
                                $maxRange= $cpmrebl['PriceRate'];
                              }

                              if($maxRange< $cpmrebl['PriceRate']){
                                $maxRange= $cpmrebl['PriceRate'];
                              }
                            }
                            


    $no_of_pages =0 ;
    
    $no_of_pages =intval($availableCompareAble/3) ;
    if(($no_of_pages*3)<$availableCompareAble){
      $no_of_pages++;
    }
    if($no_of_pages>3){
      $no_of_pages=3;
    }else{

    }  
    $no_of_pages+=5;



  ?>
      <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LISTING PROPOSAL</title>
<style type="text/css" >

body{ margin:0; padding:0;}
h1, h2, h3, h4, h5, h6, h7{ margin:0; padding:0;}

.cf:before, .cf:after {content:"";display:table;}
.cf:after {clear:both;}
.cf {zoom:1;}

  
/* Old Styling */

 .grey-bg{background-color:#f5f7f8; color:#000;}
 .red-title{color:<?php echo $theme ?>;}
 .red-t-border{border-top:2px solid <?php echo $theme ?>;}
 .red-b-border{border-top:2px solid <?php echo $theme ?>;}
 .grey-t-border, .grey-t-border td{border-top:1px solid #d9dbe0;color:#818285;text-transform: uppercase;}
    
     
	  
/* page-1 */
.page-1{}
	/* pg-1-header */
	.page-1 .pg-1-header{ padding:62px 50px 30px 50px;}
	.page-1 .pg-1-header h2{ font-size:42px; font-family:museosansrounded-300-7h; color:<?php echo $theme ?>;}
	.page-1 .pg-1-header h1{ font-size:70px; font-family: museosansrounded-900-7g; color: #c0cace; letter-spacing:-0.6px; line-height:52px;}
	
	/* pg-1-map */
	.page-1 .pg-1-map{ text-align:center; margin:0 0 50px 0;}
	
	/* pg-1-clients */
	.page-1 .pg-1-clients{ margin:0 50px 10px 50px;width:100%;}
	.page-1 .pg-1-clients .client-name{ letter-spacing:0.7px; font-size:21px; font-family:museosansrounded-900-7g; color:#636466; padding:0 7px;}
	.page-1 .pg-1-clients .client-detail{ font-family:museosansrounded-300-7h; color:#636466; font-size:18px; padding:0 7px;}
	
	/* pg-1-footer */
	.pg-1-footer{ background:<?php echo $theme ?>; padding:25px 50px; clear:both; margin:0;}
    .pg-1-footer .fwrape{ font-size:21px; font-family:museosansrounded-300-7h; color:#fff;}
	
	/* page-2 */
.page-2{}
	/* pg-2-header */
	.page-2 .pg-2-header{ padding:70px 50px 90px 50px;}
	.page-2 .pg-2-header h1{ font-size:45px; font-family:museosansrounded-900-7g; color:<?php echo $theme ?>;}
	.page-2 .pg-2-header h2{ font-size:22px; font-family:museosansrounded-300-7h; color:#818285;}
	
	/* pg-2-content */
	.page-2 .pg-2-content{ padding:10px 30px 90px 30px;font-family:museosansrounded-300-7h; font-size:18px; color:#818285;line-height:44px; }
	
	/* page-3 */
.page-3{}
	/* pg-3-header */
	.page-3 .pg-3-header{ padding:70px 50px 0 50px;}
	.page-3 .pg-3-header h1{ font-size:45px; font-family:museosansrounded-900-7g; color:<?php echo $theme ?>;}
	.page-3 .pg-3-header h2{ font-size:22px; font-family:museosansrounded-300-7h; color:#818285;}
	.page-3 .pg-3-header h3{ font-size:47px; font-family:noterapersonaluseonly-6i; color:#231f20; line-height:130px;}
	
	/* pg-3-content */
	.page-3 .pg-3-content{ padding:0 50px 90px 50px;}
	.page-3 .pg-3-content .page-3-detail{ font-family:museosansrounded-300-7h; font-size:18px; color:#818285; padding:0;}
   
	
	
	
	
	/* page-4 */
.page-4{}
	/* pg-4-header */
	.page-4 .pg-4-header{ padding:50px 50px 0 50px;}
	.page-4 .pg-4-header h1{ font-size:45px; font-family:museosansrounded-900-7g; color:<?php echo $theme ?>;}
	.page-4 .pg-4-header h2{ font-size:22px; font-family:museosansrounded-300-7h; color:#818285;}
	
	/* pg-4-content */
	.page-4 .pg-4-content{ padding:30px 70px 90px 70px;}
	.page-4 .pg-4-content h4{ font-size:22px; font-family:museosansrounded-900-7g; color:#818285; line-height:40px;}
	.page-4 .pg-4-content .page-4-table-main{ margin:0 0 30px 0; }
	.page-4 .pg-4-content .page-4-table-main .tbl-text{ font-family:museosansrounded-300-7h; font-size:14px; color:#818285; line-height:20px; padding:5px 0px 5px 5px;}
	
	
	/* page-5 */
.page-5{}
	/* pg-5-header */
	.page-5 .pg-5-header{ padding:70px 50px 0 50px;}
	.page-5 .pg-5-header h1{ font-size:45px; font-family:museosansrounded-900-7g; color:<?php echo $theme ?>;}
	.page-5 .pg-5-header h2{ font-size:22px; font-family:museosansrounded-300-7h; color:#818285;}
	
	/* pg-5-content */
	.page-5 .pg-5-content{ padding:50px 50px 50px 50px;}
        .page-5 .pg-5-content h4{ font-size:22px; font-family:museosansrounded-900-7g; color:#818285; line-height:40px;}
        .page-5 .pg-5-content table td{ font-family:museosansrounded-300-7h;color:#818285;}
	.page-5 .pg-5-content .page-5-map{ margin:0 0 45px 0; text-align:center;}
	.page-5 .pg-5-content .page-5-map-detail{ font-family:museosansrounded-300-7h; font-size:18px; color:#818285; line-height:23px;}
	.page-5 .pg-5-content .page-5-map-detail h3{ font-family:museosansrounded-900-7g; font-size:22px; color:#76777b;; line-height:23px; padding-top:30px; padding-bottom:20px;}
        .page-5 .pg-5-content .page-5-table-main .tbl-text{ font-family:museosansrounded-300-7h; font-size:14px; color:#818285; line-height:20px; padding:5px 0px 5px 5px;}
        .page-5 .pg-5-content .inner-table td.table-title{ font-family: museosansrounded-900-7g; font-size:16px; padding:14px 0 8px 0; color:#818285;}
        .page-5 .pg-5-content table td.red-title{font-family: museosansrounded-900-7g;color:<?php echo $theme ?>;}
        .page-5 .pg-5-content table td.red-t-border{font-family: museosansrounded-900-7g; color:#818285;}
        .page-5 .pg-5-content .inner-table td{ font-family:museosansrounded-300-7h; font-size:14px; color:#818285; line-height:20px; padding:5px 0px 5px 5px;}
	.page-5 .pg-5-content .full-img {padding-left:25px;}
	
	
		/* page-5A */
.page-5A{}
	/* pg-5A-header */
	.page-5A .pg-5A-header{ padding:70px 50px 0 50px;}
	.page-5A .pg-5A-header h1{ font-size:45px; font-family:museosansrounded-900-7g; color:<?php echo $theme ?>;}
	.page-5A .pg-5A-header h2{ font-size:22px; font-family:museosansrounded-300-7h; color:#818285;}
	
	/* pg-5A-content */
	.page-5A .pg-5A-content{ padding:50px 50px 50px 50px;}
	.page-5A .pg-5A-content .full-img {padding-left:15px;}
	
	

	
	
	.page-6{}
	/* pg-6-header */
	.page-6 .pg-6-header{ padding:70px 50px 0 50px;}
        .page-6 .pg-6-content table td{ font-family:museosansrounded-300-7h;color:#818285;}
	.page-6 .pg-6-header h1{ font-size:45px; font-family:museosansrounded-900-7g; color:<?php echo $theme ?>;}
	.page-6 .pg-6-header h2{ font-size:22px; font-family:museosansrounded-300-7h; color:#818285;}
	
	/* pg-6-content */
	.page-6 .pg-6-content{ padding:50px 50px 50px 50px;}
	
	
	    /* page-9a */
.page-9{}
	/* pg-9-header */
	.page-9 .pg-9-header{ padding:70px 50px 0 50px;}
	.page-9 .pg-9-header h1{ font-size:45px; font-family:museosansrounded-900-7g; color:<?php echo $theme ?>;}
	.page-9 .pg-9-header h2{ font-size:22px; font-family:museosansrounded-300-7h; color:#818285;}
	
	/* pg-9-content */
	.page-9 .pg-9-content{ padding:50px 50px 50px 50px;}
	
	/* page-9 */
.page-9{}
	/* pg-9-header */
	.page-9a .pg-9a-header{ padding:70px 50px 0 50px;}
	.page-9a .pg-9a-header h1{ font-size:45px; font-family:museosansrounded-900-7g; color:<?php echo $theme ?>;}
	.page-9a .pg-9a-header h2{ font-size:22px; font-family:museosansrounded-300-7h; color:#818285;}
	
	/* pg-9-content */
	.page-9a .pg-9a-content{ padding:40px 50px;}
	.page-9a .pg-9a-content .pg9a-blk{ width:50%; float:left;}
	.page-9a .pg-9a-content .pg9a-detail-area{ margin:0 30px 20px 0;}
	.page-9a .pg-9a-content .pg9a-detail-area .pg9-desc{ font-family: museosansrounded-300-7h; font-size:16px; color:#231f20;}
	.page-9a .pg-9a-content .pg9a-pit-image{ text-align:center;}
	.page-9a .pg-9a-content .pg9a-fixprice{ font-family: museosansrounded-900-7g; font-size:16px; color:#fff; border-bottom:#fff 2px solid; line-height:54px; text-align:center; background:#a6cd3a;}
	.grph-prx img{ width:100%; height:auto; float:left;}
	
		    /* page-10 */
.page-10{}
	/* pg-10-header */
	.page-10 .pg-10-header{ padding:70px 50px 0 50px;}
	.page-10 .pg-10-header h1{ font-size:45px; font-family:museosansrounded-900-7g; color:<?php echo $theme ?>;}
	.page-10 .pg-10-header h2{ font-size:22px; font-family:museosansrounded-300-7h; color:#818285;}
	
	/* pg-10-content */
	.page-10 .pg-10-content{ padding:50px 50px 50px 50px;}
	
	.page-11{}
	/* pg-11-header */
	.page-11 .pg-11-header{ padding:70px 50px 0 50px;}
	.page-11 .pg-11-header h1{ font-size:45px; font-family:museosansrounded-900-7g; color:<?php echo $theme ?>;}
	.page-11 .pg-11-header h2{ font-size:22px; font-family:museosansrounded-300-7h; color:#818285;}
	
	/* pg-11-content */
	.page-11 .pg-11-content{ padding:50px 50px 50px 50px;}
	.page-11 .pg-11-content p{ font-size:16px; font-family:museosansrounded-300-7h; color: #76777b;}
	.page-11 .pg-11-content table h4{ font-size:18px; font-family:museosansrounded-300-7h; color:<?php echo $theme ?>;}
	
	
	.page-12{}
	/* pg-12-header */
	.page-12 .pg-12-header{ padding:70px 50px 0 50px;}
	.page-12 .pg-12-header h1{ font-size:45px; font-family:museosansrounded-900-7g; color:<?php echo $theme ?>;}
	.page-12 .pg-12-header h2{ font-size:22px; font-family:museosansrounded-300-7h; color:#818285;}
	
	/* pg-12-content */
	.page-12 .pg-12-content{ padding:50px 50px 50px 50px;}
	.page-12 .pg-12-content p{ font-size:16px; font-family:museosansrounded-300-7h; color: #76777b;}
	.page-12 table tr h4{ font-size:18px; font-family:museosansrounded-900-7g; color:<?php echo $theme ?>;}
	.page-12 table tr p{ font-size:16px; font-family:museosansrounded-900-7g; color:#76777b;}
	
	
	.page-13{}
	/* pg-13-header */
	.page-13 .pg-13-header{ padding:70px 50px 0 50px;}
	.page-13 .pg-13-header h1{ font-size:45px; font-family:museosansrounded-900-7g; color:<?php echo $theme ?>;}
	.page-13 .pg-13-header h2{ font-size:22px; font-family:museosansrounded-300-7h; color:#818285;}
	
	/* pg-13-content */
	.page-13 .pg-13-content{ padding:50px 50px 50px 50px;}
	.page-13 .pg-13-content p { font-size:16px; font-family:museosansrounded-300-7h; color: #76777b;}
    .page-13 .pg-13-content table { font-size:16px; font-family:museosansrounded-300-7h; color: #76777b;}
	.page-13 .pg-13-content table p{ font-size:17px; font-family:museosansrounded-300-7h; color: #76777b;}
	.page-13 .pg-13-content table td{ font-size:13px; font-family:museosansrounded-300-7h; color: #76777b;}
	
	
	.page-14{}
	/* pg-14-header */
	.page-14 .pg-14-header{ padding:70px 50px 0 50px;}
	.page-14 .pg-14-header h1{ font-size:45px; font-family:museosansrounded-900-7g; color:<?php echo $theme ?>;}
	.page-14 .pg-14-header h2{ font-size:22px; font-family:museosansrounded-300-7h; color:#818285;}
	
	/* pg-14-content */
	.page-14 .pg-14-content{ padding:50px 50px 50px 50px;}
	.page-14 .pg-14-content p{ font-size:12px; font-family:museosansrounded-900-7g; color: #76777b;}
	
	
	.page-15{}
	/* pg-15-header */
	.page-15 .pg-15-header{ padding:70px 50px 0 50px;}
	.page-15 .pg-15-header h1{ font-size:45px; font-family:museosansrounded-900-7g; color:<?php echo $theme ?>;}
	.page-15 .pg-15-header h2{ font-size:22px; font-family:museosansrounded-300-7h; color:#818285;}
	
	/* pg-15-content */
	.page-15 .pg-15-content{ padding:50px 50px 50px 50px;}
	.page-15 .pg-15-content p{ font-size:16px; font-family:museosansrounded-300-7h; color: #76777b;}
	.page-15 .pg-15-content .tg  {border-collapse:collapse;border-spacing:0;margin:0px auto;}
    .page-15 .pg-15-content .tg td{font-family:museosansrounded-300-7h;padding:10px 40px; border-style:none; overflow:hidden;word-break:normal; color:#76777b; font-size:15px; text-align:center;}
    .page-15 .pg-15-content .tg th{font-family:museosansrounded-300-7h;font-size:15px; padding:12px 0px 12px 0px; border-style:none; overflow:hidden;  text-align:center; word-break:normal; background:<?php echo $theme ?>; color:#fff;}
    .page-15 .pg-15-content .tg .tg-yw4l{vertical-align:middle;}
	.page-15 .pg-15-content .tg .tg-yw42{vertical-align:middle; background:#76777b; padding: 12px 0px 12px 0px; font-size:15px;}
	.page-15 .pg-15-content h3{ font-size:19px; font-family:museosansrounded-900-7g; color: #76777b;}
	
	
	
	.page-16{}
	/* pg-16-header */
	.page-16 .pg-16-header{ padding:70px 50px 0 50px;}
	.page-16 .pg-16-header h1{ font-size:45px; font-family:museosansrounded-900-7g; color:<?php echo $theme ?>;}
	.page-16 .pg-16-header h2{ font-size:22px; font-family:museosansrounded-300-7h; color:#818285;}
	
	/* pg-16-content */
		.page-16 .pg-16-content{ padding:50px 50px 50px 50px;}
	
	
	.page-17{}
	/* pg-17-header */
	.page-17 .pg-17-header{ padding:70px 50px 0 50px;}
	.page-17 .pg-17-header h1{ font-size:45px; font-family:museosansrounded-900-7g; color:<?php echo $theme ?>;}
	.page-17 .pg-17-header h2{ font-size:22px; font-family:museosansrounded-300-7h; color:#818285;}
	
	/* pg-17-content */
	.page-17 .pg-17-content{ padding:50px 50px 50px 50px;}
	.page-17 .pg-17-content p{ font-size:12px; font-family:museosansrounded-900-7g; color: #76777b;}
	
	
	.page-18{}
	/* pg-18-header */
	.page-18 .pg-18-header{ padding:70px 50px 0 50px;}
	.page-18 .pg-18-header h1{ font-size:45px; font-family:museosansrounded-900-7g; color:<?php echo $theme ?>;}
	.page-18 .pg-18-header h2{ font-size:22px; font-family:museosansrounded-300-7h; color:#818285;}
	
	/* pg-18-content */
	.page-18 .pg-18-content{ padding:50px 50px 50px 50px;}
	.page-18 .pg-18-content h2{ font-size:23px; font-family:museosansrounded-300-7h; color:<?php echo $theme ?>;margin:0px; margin-top:25px;}
	.page-18 .pg-18-content h3{ font-size:18px; font-family:museosansrounded-300-7h; color:<?php echo $theme ?>; margin-bottom:40px;}
	.page-18 .pg-18-content p{ font-size:16px; font-family:museosansrounded-300-7h; color: #76777b; margin: 0px;}
	.pg9a-detail-area{font-family: museosansrounded-300-7h; font-size:16px; color: #76777b;}
        .pg9a-title{font-family: museosansrounded-900-7g; font-size:18px;}
	
      </style>
    </head>
    <body>
        <htmlpagefooter name="MyFooter1" style="margin:0;">
    
      <div class="pg-1-footer cf" style="margin:0;">
          <table class="fwrape" width="100%">
            <tr>
                <td width="80%" align="left">
                  <?php echo $property->PropertyProfile->SiteAddress.', '.$property->PropertyProfile->SiteCity.', '.$property->PropertyProfile->SiteState ; ?>
                </td>
                <td width="20%" align="right">
                  Page {PAGENO}
                </td>
            </tr>
          </table>
      </div>      
    

       </htmlpagefooter>



<article>      
                   <!-- Page 1 -->
				   <div class="page-1">
				   <div class="pg-1-header">
                  <h2>LISTING PROPOSAL</h2>
				  <h1><?php echo $property->PropertyProfile->SiteAddress ; ?></h1>
				  <h2><?php echo $property->PropertyProfile->SiteCity; ?>, <?php echo $property->PropertyProfile->SiteState ; ?> <?php echo $property->PropertyProfile->SiteZip; ?></h2>
				  </div><!-- .pg-1-header -->
                 <div class="pg-1-map"><img width="750px;" src="assets/images/lpcov.png" alt="" style="background-color:<?php echo $theme ?>;" /></div><!-- .pg-1-map -->
                 
                  
                    <table class="pg-1-clients cf">
            <tr>
                <td>
			<table width="350" border="0" align="left" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="64px" rowspan="2" align="center" valign="top"><?php if($user['profile_image'] != '' && $user['profile_image'] != 'no'):?><img src="<?php echo base_url().$user['profile_image']; ?>" style="max-width:64px; height:120px;" alt="" /><?php endif; ?></td>
                    <td width="245" class="client-name"><?php echo $user['fullname']; ?></td>
                </tr>
                <tr>
                    <td width="245" align="left" valign="top" class="client-detail"><?php echo $user['title']; ?><br />CaBRE#<?php echo $user['licenceno']; ?><br />Direct: <?php echo $user['phone']; ?><br /><?php echo $user['email']; ?><br /><?php echo $user['website']; ?></td>
                </tr>
                <?php if($partner): ?>
                <tr>
                    <td colspan="2" align="left" valign="top"><?php if($user['company_logo'] != ''):?><img src="<?php echo base_url().$user['company_logo']; ?>" style="max-height:75px;max-width:185px;padding-top: 5px;"  alt="Logo Image"/><?php endif; ?></td>
                </tr>
                <?php endif; ?>
                </table>
                </td>
                <td <?php echo (!$partner)?'valign="bottom"':''; ?>>
            <table width="350" border="0" align="right" cellpadding="0" cellspacing="0">
            <?php if($partner): ?>
            <tr>
            <td width="245" align="right" valign="top" class="client-name"><?php echo $partner['fullname']; ?></td>
            <td rowspan="2" align="right" width="64px" valign="top"><img src="<?php echo base_url().$partner['profile_image']; ?>"   style="max-width:64px; max-height:115px; height:115px;" alt=""/></td>
            </tr>
            <tr>
            <td width="245" align="right" valign="top" class="client-detail"><?php echo $partner['title']; ?><br />CaBRE#<?php echo $partner['licenceno']; ?><br />Direct: <?php echo $partner['phone']; ?><br /><?php echo $partner['email']; ?><br /><?php echo $partner['website']; ?></td>
            </tr>
            <tr>
            <td colspan="2" align="right" valign="top"><?php if($partner['company_image']): ?><img src="<?php echo base_url().$partner['company_image']; ?>" style="max-height:75px;max-width:185px;padding-top: 5px;"  alt="Logo Image"/><?php endif; ?></td>
            </tr>
            <?php else: ?>
                <tr>
                    <td colspan="2" align="right" valign="top"><?php if($user['company_logo'] != ''):?><img src="<?php echo base_url().$user['company_logo']; ?>" style="max-height:75px;max-width:185px;padding-bottom: 10px;"  alt="Logo Image"/><?php endif; ?></td>
                </tr>
            <?php endif; ?>
            </table>
            
        </td></tr>
            
        </table>
      </div><!-- .pg-1-clients -->
    <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
    </div><!-- .page-1 -->
</article>
            
                  <!-- Page 2 -->
<article>
	<div class="page-2">
		<div class="pg-2-header">
        	<h1>CONTENTS</h1>
            <h2>What is in your listing proposal</h2>
        </div><!-- .pg-2-header -->
        <div class="pg-2-content cf">
        	<table class="pg-2-content cf" width="500" border="0" align="right" cellpadding="0" cellspacing="0">
                <tr>
                  <td align="right" valign="middle" class="table-text">aerial snapshot</td>
                    <td width="28px" rowspan="14" ></td>
                    <td width="1px" rowspan="14" bgcolor="#818285"></td>
                    <td width="70" align="center" valign="top" class="table-text">3</td>
                </tr>
                <tr>
                  <td align="right" valign="middle"><div class="table-text">property information</div></td>
                    <td width="70" align="center" valign="top"><div class="table-text">4</div></td>
                </tr>
                <tr>
                  <td align="right" valign="middle"><div class="table-text">area sales analysis</div></td>
                    <td width="70" align="center" valign="top"><div class="table-text">5</div></td>
                </tr>
                <tr>
                  <td align="right" valign="middle"><div class="table-text">sales comparables</div></td>
                    <td width="70" align="center" valign="top"><div class="table-text">6-8</div></td>
                </tr>
                <tr>
                  <td align="right" valign="middle"><div class="table-text">estimated sales price</div></td>
                    <td width="70" align="center" valign="top"><div class="table-text">9</div></td>
                </tr>
                <tr>
                  <td align="right" valign="middle"><div class="table-text">selling roadmap</div></td>
                    <td width="70" align="center" valign="top"><div class="table-text">10</div></td>
                </tr>
                <tr>
                  <td align="right" valign="middle"><div class="table-text">how buyers find homes</div></td>
                    <td width="70" align="center" valign="top"><div class="table-text">11</div></td>
                </tr>
                <tr>
                  <td align="right" valign="middle"><div class="table-text">pricing correctly</div></td>
                    <td width="70" align="center" valign="top"><div class="table-text">12</div></td>
                </tr>
                <tr>
                  <td align="right" valign="middle"><div class="table-text">average days on market</div></td>
                    <td width="70" align="center" valign="top"><div class="table-text">13</div></td>
                </tr>
                <tr>
                  <td align="right" valign="middle"><div class="table-text">marketing your property</div></td>
                    <td width="70" align="center" valign="top"><div class="table-text">14-16</div></td>
                </tr>
                <tr>
                  <td align="right" valign="middle"><div class="table-text">analyze & optimize</div></td>
                    <td width="70" align="center" valign="top"><div class="table-text">17</div></td>
                </tr>
                <tr>
                  <td align="right" valign="middle"><div class="table-text">negotiation offers</div></td>
                    <td width="70" align="center" valign="top"><div class="table-text">18</div></td>
                </tr>
                <tr>
                  <td align="right" valign="middle"><div class="table-text">transaction process</div></td>
                    <td width="70" align="center" valign="top"><div class="table-text">19</div></td>
                </tr>
				 <tr>
                  <td align="right" valign="middle"><div class="table-text">our promise</div></td>
                    <td width="70" align="center" valign="top"><div class="table-text">20</div></td>
                </tr>
                </table>

      </div><!-- .pg-2-content -->
	<sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
    </div><!-- .page-2 -->
</article>
                  <!-- page 2 end -->
 
 <article>
                  <!-- page 3 -->
                  <div class="page-5">
                    <div class="pg-5-header">
						<h1>AERIAL VIEW</h1>
						<h2>Area we will be analyzing</h2>
					</div><!-- .pg-5-header -->
                    
					<div class="pg-5-content cf">
                      <div class="full-img">
                      <img src="https://maps.googleapis.com/maps/api/staticmap?zoom=15&size=663x519&maptype=roadmap&center=<?php echo $property->PropertyProfile->PropertyCharacteristics->Latitude.','.$property->PropertyProfile->PropertyCharacteristics->Longitude; ?>&markers=color:f15d3e%7Clabel:S%7C<?php echo $property->PropertyProfile->PropertyCharacteristics->Latitude.','.$property->PropertyProfile->PropertyCharacteristics->Longitude; ?>" alt="" style="width:6.9in; height:5.4in;" /></div>
                      
					  <div class="page-5-map-detail">
					  <h3>Why a 2-Mile Radius</h3>
                 
                      A 2-Mile radius gives the ideal range to accurately research properties that either have been recently sold and are similar to yours in regards to the number of bedrooms, bathrooms, living area (sqft), and property lot size.
					  </div>
                    </div>
                    <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
                  </div>
                  <!-- page 3 end -->
</article>
              
<article style="">
	<div class="page-4">
		<div class="pg-4-header">
        	<h1>PROSPECTIVE PROPERTY</h1>
            <h2>Overview of your property.</h2>
        </div><!-- .pg-4-header -->
        <div class="pg-4-content cf">
        	<h4>OWNER, ADDRESS & LEGAL DESCRIPTION</h4>
            <div class="page-4-table-main cf">
				<table class="" width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                    <td class="tbl-text">Primary Owner: <?php echo $primary_owner; ?></td>
                    </tr>
                    <tr>
                    <td bgcolor="#d1d2d4" class="tbl-text">Secondary Owner: <?php echo $secondary_owner; ?></td>
                    </tr>
                    <tr>
                    <td class="tbl-text">Site Address: <?php echo $property->PropertyProfile->SiteAddress.', '. $property->PropertyProfile->SiteCity.', '. $property->PropertyProfile->SiteState.' '.$property->PropertyProfile->SiteZip; ?></td>
                    </tr>
                    <tr>
                    <td bgcolor="#d1d2d4" class="tbl-text">Mailing Address: <?php echo $property->PropertyProfile->MailAddress.', '. $property->PropertyProfile->MailCity.', '. $property->PropertyProfile->MailState.' '.$property->PropertyProfile->MailZip; ?></td>
                    </tr>
                    <tr>
                    <td>
                   	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="50%" class="tbl-text">APN : <?php echo $property->PropertyProfile->APN; ?></td>
                            <td width="50%" class="tbl-text">County Name: <?php echo $property->SubjectValueInfo->CountyName; ?></td>
                          </tr>
                          <tr>
                            <td width="50%" bgcolor="#d1d2d4" class="tbl-text">Census Tract: <?php echo $property->PropertyProfile->CensusTract; ?></td>
                            <td width="50%" bgcolor="#d1d2d4" class="tbl-text">Housing Tract #: <?php echo $property->PropertyProfile->HousingTract; ?></td>
                          </tr>
                          <tr>
                            <td width="50%" class="tbl-text">Lot Number: <?php echo $property->PropertyProfile->LotNumber; ?></td>
                            <td width="50%" class="tbl-text">Page Grid:<?php echo $property->PropertyProfile->TBMGrid; ?></td>
                          </tr>
						</table>

                    </td>
                    </tr>
                    <tr>
                    <td bgcolor="#d1d2d4" class="tbl-text">Brief Legal Description:<br>
                            <p><?php echo $property->PropertyProfile->LegalDescriptionInfo->LegalBriefDescription; ?></p></td>
                    </tr>
				</table>
            </div><!-- .page-4-table-main -->
        	<h4></h4>
            <div class="page-4-table-main cf">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                    <td>
                   	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="33%" class="tbl-text">Bedrooms: <?php echo $property->PropertyProfile->PropertyCharacteristics->Bedrooms; ?></td>
                            <td width="33%" class="tbl-text">Year Built: <?php echo $property->PropertyProfile->PropertyCharacteristics->YearBuilt; ?></td>
                            <td width="33%" class="tbl-text">Square Feet: <?php echo $property->PropertyProfile->PropertyCharacteristics->BuildingArea; ?></td>
                          </tr>
                          <tr bgcolor="#d1d2d4">
                            <td width="33%" class="tbl-text">Bathrooms: <?php echo $property->PropertyProfile->PropertyCharacteristics->Baths; ?></td>
                            <td width="33%" class="tbl-text">Garage: <?php echo $property->PropertyProfile->PropertyCharacteristics->GarageNumCars; ?></td>
                            <td width="33%" class="tbl-text">Lot Size: <?php echo $property->PropertyProfile->PropertyCharacteristics->LotSize; ?></td>
                          </tr>
                          <tr>
                            <td width="33%" class="tbl-text">Partial Bath: 0</td>
                            <td width="33%" class="tbl-text">Fireplace: <?php echo $property->PropertyProfile->PropertyCharacteristics->Fireplace; ?></td>
                            <td width="33%" class="tbl-text"># of Units: <?php echo $property->PropertyProfile->PropertyCharacteristics->NumUnits; ?></td>
                          </tr>
                          <tr bgcolor="#d1d2d4">
                            <td width="33%" class="tbl-text">Total Rooms: <?php echo sizeof($property->PropertyProfile->PropertyCharacteristics->TotalRooms); ?></td>
                            <td width="33%" class="tbl-text">Pool/Spa: <?php echo $property->PropertyProfile->PropertyCharacteristics->Pool; ?></td>
                            <td width="33%" class="tbl-text">Zoning: <?php echo trim($property->PropertyProfile->PropertyCharacteristics->Zoning); ?></td>
                          </tr>
						</table>
                    </td>
                    </tr>
                    <tr>
                    <td class="tbl-text">Property Type: <?php echo $property->PropertyProfile->PropertyCharacteristics->UseCode; ?></td>
                    </tr>
                    <tr>
                    <td bgcolor="#d1d2d4" class="tbl-text">Use Code: <?php echo $property->PropertyProfile->PropertyCharacteristics->UseCode; ?></td>
                    </tr>
				</table>
            </div><!-- .page-4-table-main -->
        	<h4>ASSESSED VALUE & TAX DETAILS</h4>
            <div class="page-4-table-main cf">
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="50%" class="tbl-text"><div class="tbl-text">Assessed Value: $<?php echo $property->PropertyProfile->AssessmentTaxInfo->AssessedValue; ?></td>
                    <td width="50%" class="tbl-text"><div class="tbl-text">Tax Amount: $<?php echo $property->PropertyProfile->AssessmentTaxInfo->TaxAmount; ?></td>
                  </tr>
                  <tr>
                    <td width="50%" bgcolor="#d1d2d4" class="tbl-text">Land Value: $<?php echo $property->PropertyProfile->AssessmentTaxInfo->LandValue; ?></td>
                    <td width="50%" bgcolor="#d1d2d4" class="tbl-text">Tax Status: <?php echo $property->PropertyProfile->AssessmentTaxInfo->TaxStatus; ?></td>
                  </tr>
                  <tr>
                    <td width="50%" class="tbl-text">Improvement Value: $<?php echo $property->PropertyProfile->AssessmentTaxInfo->ImprovementValue; ?></td>
                    <td width="50%" class="tbl-text">Tax Rate Area: <?php echo $property->PropertyProfile->AssessmentTaxInfo->TaxRateArea; ?>%</td>
                  </tr>
                  <tr>
                    <td width="50%" bgcolor="#d1d2d4" class="tbl-text">% Improvement: <?php echo $property->PropertyProfile->AssessmentTaxInfo->PercentImproved; ?>%</td>
                    <td width="50%" bgcolor="#d1d2d4" class="tbl-text">Tax Year: <?php echo $property->PropertyProfile->AssessmentTaxInfo->TaxYear; ?></td>
                  </tr>
                </table>
            </div><!-- .page-4-table-main -->
		</div><!-- .pg-4-content -->
<!--	<sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />-->
    </div><!-- .page-4 -->
</article>
<article>
                   <!-- page 5A -->
					<div class="page-5">
						<div style="margin-top:70px;" class="pg-5-header">
						<h1>AREA SALES ANALYSIS</h1>
						<h2>Sales in the past 12 months</h2>
						</div><!-- .pg-5A-header -->
                    <div class="pg-5-content cf">
                      <div class="full-img"><img src="https://chart.googleapis.com/chart?cht=bvs&chd=t:<?php echo $areaSalesAnalysis['chart']['series']; ?>&chs=700x400&chl=<?php echo $areaSalesAnalysis['chart']['date']; ?>&chbh=40,30,45&chco=<?php echo $areaSalesAnalysis['chart']['color']; ?>&chds=a&chxt=y" alt="" style="margin:auto; width:100%; height:3.31in;" /></div>
                      
                      <h4 style="text-align:center;">MONTHLY SALES OVERVIEW</h4>
                      <table width="100%" border="0" cellspacing="0" cellpadding="6">
                        <tr>
                          <td width="20%"></td>
                          <td width="20%" class="red-title">PIQ</b></td>
                          <td width="20%" class="red-title">LOW</td>
                          <td width="20%" class="red-title">MEDIAN</td>
                          <td width="20%" class="red-title">HIGH</td>
                        </tr>
                        


                        <tr class="grey-t-border">
                            <td width="20%" >DISTANCE</td>
                            <td width="20%" ><?php echo 0; ?></td>
                            <td width="20%" ><?php echo $areaSalesAnalysis['areaMinRadius']; ?></td>
                            <td width="20%" ><?php echo $areaSalesAnalysis['areaMedianRadius']; ?></td>
                            <td width="20%" ><?php echo $areaSalesAnalysis['areaMaxRadius']; ?></td>
                        </tr>
                        <tr class="grey-t-border">
                            <td width="20%">LIVING AREA:</td>
                            <td width="20%"><?php echo $areaSalesAnalysis['areaLivingArea']; ?></td>
                            <td width="20%"><?php echo $areaSalesAnalysis['areaLivingAreaLow']; ?></td>
                            <td width="20%"><?php echo $areaSalesAnalysis['areaLivingAreaMedian']; ?></td>
                            <td width="20%"><?php echo $areaSalesAnalysis['areaLivingAreaHigh']; ?></td>
                        </tr>
                        <tr class="grey-t-border">
                            <td width="20%" >PRICE PER SqFT:</td>
                            <td width="20%" >$<?php echo $areaSalesAnalysis['areaPriceFoot']; ?></td>
                            <td width="20%" >$<?php echo $areaSalesAnalysis['areaPriceFootLow']; ?></td>
                            <td width="20%" >$<?php echo $areaSalesAnalysis['areaPriceFootMedian']; ?></td>
                            <td width="20%" >$<?php echo $areaSalesAnalysis['areaPriceFootHigh']; ?></td>
                        </tr>
                        <tr class="grey-t-border">
                            <td width="20%">YEAR BUILT:</td>
                            <td width="20%"><?php echo $areaSalesAnalysis['areaYear']; ?></td>
                            <td width="20%"><?php echo $areaSalesAnalysis['areaYearLow']; ?></td>
                            <td width="20%"><?php echo $areaSalesAnalysis['areaYearMedian']; ?></td>
                            <td width="20%"><?php echo $areaSalesAnalysis['areaYearHigh']; ?></td>
                        </tr>
                        <tr class="grey-t-border">
                            <td width="20%" >LOT SIZE:</td>
                            <td width="20%" ><?php echo $areaSalesAnalysis['areaLotSize']; ?></td>
                            <td width="20%" ><?php echo $areaSalesAnalysis['areaLotSizeLow']; ?></td>
                            <td width="20%" ><?php echo $areaSalesAnalysis['areaLotSizeMedian']; ?></td>
                            <td width="20%" ><?php echo $areaSalesAnalysis['areaLotSizeHigh']; ?></td>
                        </tr>
                        <tr class="grey-t-border">
                            <td width="20%">BEDROOMS:</td>
                            <td width="20%"><?php echo $areaSalesAnalysis['areaBedrooms']; ?></td>
                            <td width="20%"><?php echo $areaSalesAnalysis['areaBedroomsLow']; ?></td>
                            <td width="20%"><?php echo $areaSalesAnalysis['areaBedroomsMedian']; ?></td>
                            <td width="20%"><?php echo $areaSalesAnalysis['areaBedroomsHigh']; ?></td>
                        </tr>
                        <tr class="grey-t-border">
                            <td width="20%" >BATHS:</td>
                            <td width="20%" ><?php echo $areaSalesAnalysis['areaBaths']; ?></td>
                            <td width="20%" ><?php echo $areaSalesAnalysis['areaBathsLow']; ?></td>
                            <td width="20%" ><?php echo $areaSalesAnalysis['areaBathsMedian']; ?></td>
                            <td width="20%" ><?php echo $areaSalesAnalysis['areaBathsHigh']; ?></td>
                        </tr>
                        <tr class="grey-t-border">
                            <td width="20%">STORIES:</td>
                            <td width="20%"><?php echo $areaSalesAnalysis['stories']; ?></td>
                            <td width="20%"><?php echo $areaSalesAnalysis['stories']; ?></td>
                            <td width="20%"><?php echo $areaSalesAnalysis['stories']; ?></td>
                            <td width="20%"><?php echo $areaSalesAnalysis['stories']; ?></td>
                        </tr>
                        <tr class="grey-t-border">
                            <td width="20%" >POOL:</td>
                            <td width="20%"><?php echo $areaSalesAnalysis['propertyPool']; ?></td>
                            <td width="20%"><?php echo $areaSalesAnalysis['propertyPoolLow']; ?></td>
                            <td width="20%"><?php echo $areaSalesAnalysis['propertyPoolMedian']; ?></td>
                            <td width="20%"><?php echo $areaSalesAnalysis['propertyPoolHign']; ?></td>
                        </tr>
                        <tr>
                          <td class="red-t-border">SALES PRICE:</td>
                          <td class="red-t-border"><?php echo ($areaSalesAnalysis['propertySalePrice']  != '')?"$".$areaSalesAnalysis['propertySalePrice']:''; ?></td>
                          <td class="red-t-border">$<?php echo trim($areaSalesAnalysis['propertySalePriceLow']); ?></td>
                          <td class="red-t-border">$<?php echo trim($areaSalesAnalysis['propertySalePriceMedian']); ?></td>
                          <td class="red-t-border">$<?php echo trim($areaSalesAnalysis['propertySalePriceLowHigh']); ?></td>
                        </tr>

                      </table>
                    </div>
                    <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
                  </div>
                  <!-- page 5A end -->
</article>
				 
                    
                  <!-- page 6 -->
                 <!--  <div class="sales-comparables">
                      <h1>SALES COMPARABLES</h1>
                      <div class="sub-head">Properties that have recently sold.</div>
                      <div class="inner-content">
                        <table width="100%" border="0" cellspacing="0" cellpadding="8"> -->
                          <?php
                            if(sizeof($areaSalesAnalysis['comparable'])>0)
                            {
                                                      $avaiProperty = 0;
                              foreach ($areaSalesAnalysis['comparable'] as $key => $item) {
                                if($key>8){
                                  break;
                              }
							$sQFootage+=$item['BuildingArea'];
							$avgNoOfBeds+=$item['Beds'];
							$avgNoOfBaths +=$item['Baths'];
                            ?>

                            <?php
                              if(($key%3)==0 && $key>0){

                                       echo  '</table>
                                                                    </div>
                                                                    <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
                                                                    </div>

                                                                    ';
                              }
                              if(($key%3)==0){

                                echo '<div class="page-5"> <div class="pg-5-header">
                                                          <h1>SALES COMPARABLES</h1>
                                                          <h2>Properties that have recently sold.</h2>
                                                          </div>
                                                          <div class="pg-5-content cf">
                                                            <table width="100%" border="0" cellspacing="0" cellpadding="8" class="page-5-table-main">
                                                      ';
                              }
                            ?>
                              
                              <tr>
                                <td width="30%">
                                
                                    <table width="100%" border="0" cellspacing="2" cellpadding="2" style="font-size:14px;">
                      
                                  <tr>
                                      <td colspan="2">
                                        <img src="https://maps.googleapis.com/maps/api/staticmap?zoom=14&size=180x100&maptype=roadmap&markers=color:f15d3e%7Clabel:S%7C<?php echo $item['Latitude'].','.$item['Longitude']; ?>" 
                                        style="width:2.23in; height:1.3in;"   alt=""/>

                                      </td>
                                  </tr>
                                  <tr>
                                      <td style="-webkit-print-color-adjust: exact; background:<?php echo $theme ?> -webkit-print-color-adjust: exact; color:#fff; font-size:12px;  height:0.30in; " bgcolor="<?php echo $theme ?>"> &nbsp;&nbsp;Sale Price:</td>
                                      <td bordercolor="<?php echo $theme ?>" style="border:1px solid <?php echo $theme ?>; font-size:14px; font-family:museosansrounded-900-7g; color: <?php echo $theme ?>; text-align:center;"><?php echo $item['Price']; ?></td>
                                    
                                  </tr>
                                </table>

                                </td>
                                <td width="70%" >
                                  
                                <table class="inner-table" width="100%" border="0" cellspacing="2" cellpadding="5" style=" font-size:18px; text-align:center;" >
                                      <tr>
                                          <td align="left" colspan="4" class="table-title"><?php echo $item['Address']; ?></td>
                                      </tr>
                                       <tr>
                                          
                                          <td bgcolor="#f8f8f8">Sold Date</td>
                                          <td bgcolor="#f8f8f8">Dist.</td>
                                          <td bgcolor="#f8f8f8">Sqft.</td>
                                          <td bgcolor="#f8f8f8">$/Sqft</td>
                                        </tr>
                                        <tr>
                                          
                                          <td><?php echo $item['Date']; ?></td>
                                          <td><?php echo $item['Distance']; ?></td>
                                          <td><?php echo $item['SquareFeet']; ?></td>
                                          <td>$<?php echo $item['PricePerSQFT']; ?></td>
                                          
                                        </tr>
                                        <tr>
                                          
                                          <td bgcolor="#f8f8f8">Bed/Bath</td>
                                          <td bgcolor="#f8f8f8">Year Blt</td>
                                          <td bgcolor="#f8f8f8">Lot Area</td>
                                          <td bgcolor="#f8f8f8">Pool</td>
                                        </tr>
                                        <tr>
                                         
                                          <td><?php echo $item['Beds']; ?>/<?php echo $item['Baths']; ?></td>
                                          <td><?php echo $item['Year']; ?></td>
                                          <td><?php echo $item['LotSize']; ?></td>
                                          <td><?php echo $item['Pool']; ?></td>
                                        </tr>
                                        
                                    
                                  </table>
                                </td>
                              </tr>

                              
                              <tr>
                                            <td  width="100%" colspan="2">
                                              <table  width="100%" border="0" cellspacing="2" cellpadding="5" >
                                                <tr>
                                                  <td width="3%"></td>
                                                  <td class="red-b-border" style="line-height: 0.5;" width="94%"  ></td>                                              
                                                  <td width="3%"></td>
                                                </tr>
                                              </table>
                                            </td>

                              </tr>
                                        
                             
                            <?php

                                $avaiProperty++;
                              }
                              $sQFootage = $sQFootage/$avaiProperty;

                              $avgNoOfBeds = $avgNoOfBeds/$avaiProperty;
                              $avgNoOfBaths = $avgNoOfBaths/$avaiProperty;
                              ?>


                        </table>
                      </div>
                      <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
                      <?php 

                      }
                          ?>

                  </div>
                  <!-- page 6 end -->
                      
                  <!-- page 7  Reated Data Removed page 7-->
                  <!-- page 7 end -->
                        
                  <!-- page 8 -->
                  <!-- page 8 end -->
<article>                          
                  <!-- page 9 -->
                  <div class="page-9">
							<div class="pg-9-header">
							<h1>RANGE OF SALES</h1>
							<h2>Based on recent comparable sales.</h2>
							</div><!-- .pg-9-header -->
                            <div class="pg-9-content cf">
                              <div class="full-img"><img src="https://maps.googleapis.com/maps/api/staticmap?zoom=15&size=663x420&maptype=satelite&center=<?php echo $property->PropertyProfile->PropertyCharacteristics->Latitude.','.$property->PropertyProfile->PropertyCharacteristics->Longitude; ?>&markers=color:f15d3e%7Clabel:S%7C<?php echo $property->PropertyProfile->PropertyCharacteristics->Latitude.','.$property->PropertyProfile->PropertyCharacteristics->Longitude; ?>" alt="" style="width:100%; height:3.5in;" /></div><br><br>
                             
                              <div style='background: url("<?php echo base_url(); ?>pdf/images/factor.png") 50% 0 no-repeat;'>
                              <img src="<?php echo base_url(); ?>pdf/images/factor.png" width="100%" alt=""/>
                              <table width="100%" cellspacing="0" cellpadding="8" border="0" style="margin-top:-100px;">
                                <tbody>
                                  <tr>
                                    <td align="center" width="33%"><h3 style="font-size:48px; font-family:museosansrounded-300-7h; color:#fff;"><?php echo round($avaiProperty); ?></h3></td>
                                    <td align="center" width="33%"><h3 style="font-size:48px; font-family:museosansrounded-300-7h; color:#fff;"><?php echo round($sQFootage); ?></h3></td>
                                    <td align="center" width="33%"><h3 style="font-size:48px; font-family:museosansrounded-300-7h; color:#fff;"><?php echo round($avgNoOfBeds); ?></h3></td>
                                    <td align="center" width="33%"><h3 style="font-size:48px; font-family:museosansrounded-300-7h; color:#fff;"><?php echo round($avgNoOfBaths); ?></h3></td>
                                  </tr>
                                </tbody>
                              </table>
                              <br><br>
                                <br>
                                <div lass="line-draw" style="
     width:100%; display:block; width:100% ; height:128.3px; margin-top:-30px; z-index:300;">

  <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
     width="956px" height="128.3px" viewBox="0 0 956 128.3" enable-background="new 0 0 956 128.3" xml:space="preserve">
  <line fill="none" stroke="#D1D3D4" stroke-width="57" stroke-linecap="round" stroke-miterlimit="10" x1="31.3" y1="41.5" x2="920" y2="41.5"/>
  <rect x="318.4" y="12" fill="#A7A9AC" width="331.7" height="59"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="44.1" y1="17.9" x2="44.1" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="57.9" y1="17.9" x2="57.9" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="71.6" y1="17.9" x2="71.6" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="85.4" y1="17.9" x2="85.4" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="99.2" y1="17.9" x2="99.2" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="112.9" y1="17.9" x2="112.9" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="126.7" y1="17.9" x2="126.7" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="140.5" y1="17.9" x2="140.5" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="168" y1="17.9" x2="168" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="181.7" y1="17.9" x2="181.7" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="195.5" y1="17.9" x2="195.5" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="209.3" y1="17.9" x2="209.3" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="223" y1="17.9" x2="223" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="236.8" y1="17.9" x2="236.8" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="250.6" y1="17.9" x2="250.6" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="264.3" y1="17.9" x2="264.3" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="278.1" y1="17.9" x2="278.1" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="291.8" y1="17.9" x2="291.8" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="305.6" y1="17.9" x2="305.6" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="333.1" y1="17.9" x2="333.1" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="346.9" y1="17.9" x2="346.9" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="360.7" y1="17.9" x2="360.7" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="374.4" y1="12" x2="374.4" y2="71"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="388.2" y1="17.9" x2="388.2" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="402" y1="17.9" x2="402" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="415.7" y1="17.9" x2="415.7" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="429.5" y1="17.9" x2="429.5" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="443.2" y1="17.9" x2="443.2" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="457" y1="17.9" x2="457" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="470.8" y1="17.9" x2="470.8" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="498.3" y1="17.9" x2="498.3" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="512.1" y1="17.9" x2="512.1" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="525.8" y1="17.9" x2="525.8" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="539.6" y1="17.9" x2="539.6" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="553.3" y1="17.9" x2="553.3" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="567.1" y1="17.9" x2="567.1" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="580.9" y1="17.9" x2="580.9" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="594.6" y1="17.9" x2="594.6" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="608.4" y1="17.9" x2="608.4" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="622.2" y1="17.9" x2="622.2" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="635.9" y1="17.9" x2="635.9" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="663.5" y1="17.9" x2="663.5" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="677.2" y1="17.9" x2="677.2" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="691" y1="17.9" x2="691" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="704.7" y1="17.9" x2="704.7" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="718.5" y1="17.9" x2="718.5" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="732.3" y1="17.9" x2="732.3" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="746" y1="17.9" x2="746" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="759.8" y1="17.9" x2="759.8" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="773.6" y1="17.9" x2="773.6" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="787.3" y1="17.9" x2="787.3" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="801.1" y1="17.9" x2="801.1" y2="65.1"/>
  <g>
    <line fill="none" stroke="<?php echo $theme ?>" stroke-width="4" stroke-miterlimit="10" x1="154.2" y1="2.2" x2="154.2" y2="80.8"/>
    <line fill="none" stroke="<?php echo $theme ?>" stroke-width="4" stroke-miterlimit="10" x1="319.4" y1="2.2" x2="319.4" y2="80.8"/>
    <line fill="none" stroke="<?php echo $theme ?>" stroke-width="4" stroke-miterlimit="10" x1="484.5" y1="2.2" x2="484.5" y2="80.8"/>
    <line fill="none" stroke="<?php echo $theme ?>" stroke-width="4" stroke-miterlimit="10" x1="649.7" y1="2.2" x2="649.7" y2="80.8"/>
    <line fill="none" stroke="<?php echo $theme ?>" stroke-width="4" stroke-miterlimit="10" x1="814.9" y1="2.2" x2="814.9" y2="80.8"/>
  </g>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="828.6" y1="17.9" x2="828.6" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="842.4" y1="17.9" x2="842.4" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="856.1" y1="17.9" x2="856.1" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="869.9" y1="17.9" x2="869.9" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="883.7" y1="17.9" x2="883.7" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="897.4" y1="17.9" x2="897.4" y2="65.1"/>
  <line fill="none" stroke="#BCBEC0" stroke-width="4" stroke-miterlimit="10" x1="911.2" y1="17.9" x2="911.2" y2="65.1"/>
  <polyline fill="none" stroke="#A7A9AC" stroke-width="4" stroke-miterlimit="10" points="313.5,122.1 297.2,105.6 314.1,89.1 "/>
  <polyline fill="none" stroke="#A7A9AC" stroke-width="4" stroke-miterlimit="10" points="653.2,89.1 669.6,105.6 652.6,122.1 "/>
  <g>
    <path fill="#A7A9AC" d="M693.7,90.7c8.5,0,15.1,6.9,15.1,15.1c0,8.5-6.9,15.1-15.1,15.1c-8.5,0-15.1-6.9-15.1-15.1
      C678.6,97.6,685.3,90.7,693.7,90.7 M693.7,87.9c-9.8,0-17.9,8.1-17.9,17.9c0,9.8,8.1,17.9,17.9,17.9s17.9-8.1,17.9-17.9
      C711.6,96,703.6,87.9,693.7,87.9L693.7,87.9z"/>
    <polygon fill="#A7A9AC" points="701.2,103.1 695.9,103.1 695.9,97.6 690.4,97.6 690.4,103.1 684.9,103.1 684.9,108.4 690.4,108.4 
      690.4,113.9 695.9,113.9 695.9,108.4 701.2,108.4   "/>
  </g>
  <g>
    <path fill="#A7A9AC" d="M272.2,90.3c8.5,0,15.1,6.9,15.1,15.1c0,8.5-6.9,15.1-15.1,15.1c-8.5,0-15.1-6.9-15.1-15.1
      C257.1,97.2,263.7,90.3,272.2,90.3 M272.2,87.5c-9.8,0-17.9,8.1-17.9,17.9c0,9.8,8.1,17.9,17.9,17.9c9.8,0,17.9-8.1,17.9-17.9
      C290.1,95.6,282,87.5,272.2,87.5L272.2,87.5z"/>
    <rect x="263.9" y="102.7" fill="#A7A9AC" width="16.3" height="5.5"/>
  </g>
  <g>
    <line fill="none" stroke="#D1D3D4" stroke-width="3" stroke-miterlimit="10" x1="320.5" y1="87.6" x2="357" y2="122.6"/>
  </g>
  <g>
    <line fill="none" stroke="#D1D3D4" stroke-width="3" stroke-miterlimit="10" x1="331.2" y1="87.6" x2="367.7" y2="122.6"/>
  </g>
  <g>
    <line fill="none" stroke="#D1D3D4" stroke-width="3" stroke-miterlimit="10" x1="342.5" y1="87.6" x2="379" y2="122.6"/>
  </g>
  <g>
    <line fill="none" stroke="#D1D3D4" stroke-width="3" stroke-miterlimit="10" x1="320.5" y1="109.5" x2="334.2" y2="122.6"/>
  </g>
  <g>
    <line fill="none" stroke="#D1D3D4" stroke-width="3" stroke-miterlimit="10" x1="320.6" y1="118.6" x2="325.8" y2="123.6"/>
  </g>
  <g>
    <line fill="none" stroke="#D1D3D4" stroke-width="3" stroke-miterlimit="10" x1="320.5" y1="98.7" x2="345.5" y2="122.6"/>
  </g>
  <g>
    <line fill="none" stroke="#D1D3D4" stroke-width="3" stroke-miterlimit="10" x1="353" y1="87.6" x2="389.5" y2="122.6"/>
  </g>
  <g>
    <line fill="none" stroke="#D1D3D4" stroke-width="3" stroke-miterlimit="10" x1="363.7" y1="87.6" x2="400.2" y2="122.6"/>
  </g>
  <g>
    <line fill="none" stroke="#D1D3D4" stroke-width="3" stroke-miterlimit="10" x1="375" y1="87.6" x2="411.5" y2="122.6"/>
  </g>
  <g>
    <line fill="none" stroke="#D1D3D4" stroke-width="3" stroke-miterlimit="10" x1="386" y1="87.6" x2="422.5" y2="122.6"/>
  </g>
  <g>
    <line fill="none" stroke="#D1D3D4" stroke-width="3" stroke-miterlimit="10" x1="396.7" y1="87.6" x2="433.2" y2="122.6"/>
  </g>
  <g>
    <line fill="none" stroke="#D1D3D4" stroke-width="3" stroke-miterlimit="10" x1="408" y1="87.6" x2="444.5" y2="122.6"/>
  </g>
  <g>
    <line fill="none" stroke="#D1D3D4" stroke-width="3" stroke-miterlimit="10" x1="417.5" y1="87.6" x2="454" y2="122.6"/>
  </g>
  <g>
    <line fill="none" stroke="#D1D3D4" stroke-width="3" stroke-miterlimit="10" x1="428.2" y1="87.6" x2="464.7" y2="122.6"/>
  </g>
  <g>
    <line fill="none" stroke="#D1D3D4" stroke-width="3" stroke-miterlimit="10" x1="439.5" y1="87.6" x2="476" y2="122.6"/>
  </g>
  <g>
    <line fill="none" stroke="#D1D3D4" stroke-width="3" stroke-miterlimit="10" x1="449.5" y1="87.6" x2="486" y2="122.6"/>
  </g>
  <g>
    <line fill="none" stroke="#D1D3D4" stroke-width="3" stroke-miterlimit="10" x1="460.2" y1="87.6" x2="496.7" y2="122.6"/>
  </g>
  <g>
    <line fill="none" stroke="#D1D3D4" stroke-width="3" stroke-miterlimit="10" x1="471.5" y1="87.6" x2="508" y2="122.6"/>
  </g>
  <g>
    <line fill="none" stroke="#D1D3D4" stroke-width="3" stroke-miterlimit="10" x1="483" y1="87.6" x2="519.5" y2="122.6"/>
  </g>
  <g>
    <line fill="none" stroke="#D1D3D4" stroke-width="3" stroke-miterlimit="10" x1="493.7" y1="87.6" x2="530.2" y2="122.6"/>
  </g>
  <g>
    <line fill="none" stroke="#D1D3D4" stroke-width="3" stroke-miterlimit="10" x1="505" y1="87.6" x2="541.5" y2="122.6"/>
  </g>
  <g>
    <line fill="none" stroke="#D1D3D4" stroke-width="3" stroke-miterlimit="10" x1="516" y1="87.6" x2="552.5" y2="122.6"/>
  </g>
  <g>
    <line fill="none" stroke="#D1D3D4" stroke-width="3" stroke-miterlimit="10" x1="526.7" y1="87.6" x2="563.2" y2="122.6"/>
  </g>
  <g>
    <line fill="none" stroke="#D1D3D4" stroke-width="3" stroke-miterlimit="10" x1="538" y1="87.6" x2="574.5" y2="122.6"/>
  </g>
  <g>
    <line fill="none" stroke="#D1D3D4" stroke-width="3" stroke-miterlimit="10" x1="547.5" y1="87.6" x2="584" y2="122.6"/>
  </g>
  <g>
    <line fill="none" stroke="#D1D3D4" stroke-width="3" stroke-miterlimit="10" x1="558.2" y1="87.6" x2="594.7" y2="122.6"/>
  </g>
  <g>
    <line fill="none" stroke="#D1D3D4" stroke-width="3" stroke-miterlimit="10" x1="569.5" y1="87.6" x2="606" y2="122.6"/>
  </g>
  <g>
    <line fill="none" stroke="#D1D3D4" stroke-width="3" stroke-miterlimit="10" x1="580.5" y1="87.6" x2="617" y2="122.6"/>
  </g>
  <g>
    <line fill="none" stroke="#D1D3D4" stroke-width="3" stroke-miterlimit="10" x1="591.2" y1="87.6" x2="627.7" y2="122.6"/>
  </g>
  <g>
    <line fill="none" stroke="#D1D3D4" stroke-width="3" stroke-miterlimit="10" x1="602.5" y1="87.6" x2="639" y2="122.6"/>
  </g>
  <g>
    <line fill="none" stroke="#D1D3D4" stroke-width="3" stroke-miterlimit="10" x1="615" y1="87.6" x2="638" y2="109.7"/>
  </g>
  <g>
    <line fill="none" stroke="#D1D3D4" stroke-width="3" stroke-miterlimit="10" x1="627" y1="87.6" x2="638.5" y2="98.7"/>
  </g>
  </svg>

                              
          </div>
  </div>
  <div style="margin-top:-80px; position:relative; ">
                              <table width="100%" cellspacing="0" cellpadding="8" border="0">
                                <tbody>
                                  <tr>
                                    <td align="left" width="50%"><h3 style="font-size:35px;font-family:museosansrounded-900-7g; color:<?php echo $theme ?>;">
                                      $<?php 
                                      
                                        echo round($areaSalesAnalysis['priceMinRange']).'K'; ?></h3>
                                    </td>
                                    <td align="right" width="50%">
                                      <h3 style="font-size:35px;font-family:museosansrounded-900-7g; color:<?php echo $theme ?>;">
                                        $<?php 
                                         
                                          echo round($areaSalesAnalysis['priceMaxRange']).'K'; 
                                        ?>
                                      </h3>
                                    </td>
                                  </tr>
                                </tbody>
                              </table><br>
							   <p style="font-size:16px; font-family:museosansrounded-300-7h; color: #76777b; margin-top:5px;">Above are the avergage property details for homes that are close in proximity to yours AND have been sold within the last 12-months.</p>
							  <p style="font-size:16px; font-family:museosansrounded-300-7h; color: #76777b;"> The range represents the low AND the high sales price for the properties that were sold in the last 12-months. Only the properties that closely match yours were used. The factors that were analzyed were Square Footage, No. Of Beds, No. of Baths, & Lot Size.</p>
                              </div>

                            </div>
                            <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
                  </div>
                  <!-- page 9 end -->
</article>
<article>
                  <!-- page 10 -->
                        <div class="page-10">
						  <div class="pg-10-header">
							<h1>WHAT IS NEXT</h1>
							<h2>Presentation Road Map</h2>
							</div><!-- .pg-10-header -->
                          <div class="pg-10-content cf">
                            <div class="full-img" style="margin-top:-50px; position:relative; display:block;">


                           <!--  <img src="<?php echo base_url(); ?>pdf/images/wht-next.png" alt="" style="width:100%; " /> -->

                           <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
     width="763.9px" height="838.8px" viewBox="0 0 763.9 838.8" enable-background="new 0 0 763.9 838.8" xml:space="preserve">
  <g>
    <rect x="-2" y="82.5" opacity="0.1" fill="#67C9D0" enable-background="new    " width="323.8" height="112.8"/>
    <rect x="443.2" y="364.5" opacity="0.1" fill="#F79421" enable-background="new    " width="323.8" height="112.8"/>
    <g>
      <g>
        <path fill="#FBB03C" d="M382.5,364.5h101.8c31.2,0,56.4,25.3,56.4,56.4c0,31.1-25.3,56.4-56.4,56.4H382.5V458.5h101.8
          c20.7,0,37.601-16.799,37.601-37.6c0-20.7-16.801-37.6-37.601-37.6H382.5V364.5z"/>
      </g>
      <path opacity="0.5" fill="#010101" enable-background="new    " d="M484.3,477.3c31.2,0,56.4-25.301,56.4-56.4
        c0-31.1-25.3-56.4-56.4-56.4H382.5v9.4h101.8c26,0,47,21,47,47c0,25.9-21,47-47,47H382.5v9.4H484.3z"/>
    </g>
    <rect x="354.5" y="394.8" opacity="0.2" fill="#F79421" enable-background="new    " width="2.9" height="52.1"/>
    <g>
      <g>
        <polygon fill="#F79421" points="384.4,421.9 384.4,436.3 389.8,436.3 389.8,419 385.8,423.099       "/>
      </g>
      <g>
        <polygon fill="#F79421" points="393.6,415.4 393.6,436.3 399,436.3 399,420.599       "/>
      </g>
      <g>
        <polygon fill="#F79421" points="402.5,424.201 402.5,436.3 407.9,436.3 407.9,420.5 403.4,425       "/>
      </g>
      <g>
        <polygon fill="#F79421" points="415.5,412.6 411.7,416.5 411.7,436.3 417.1,436.3 417.1,416.1 415.5,416.1       "/>
      </g>
      <g>
        <polygon fill="#F79421" points="410.9,405.3 410.9,407.1 414,407.1 403.7,417.4 393.6,407.2 382.9,418 385.3,420.5 393.6,412.1 
          403.7,422.3 416.7,409.5 416.7,413.9 418.4,413.9 418.4,405.3       "/>
      </g>
    </g>
    <rect x="-2" y="270.5" opacity="0.1" fill="#8DC641" enable-background="new    " width="323.8" height="112.8"/>
    <g>
      <g>
        <path fill="#8DC641" d="M382.5,383.3H280.7c-31.2,0-56.4-25.3-56.4-56.4s25.3-56.4,56.4-56.4h101.8v18.8H280.7
          c-20.7,0-37.6,16.8-37.6,37.6c0,20.8,16.8,37.6,37.6,37.6h101.8V383.3z"/>
      </g>
      <path opacity="0.5" fill="#010101" enable-background="new    " d="M233.7,326.9c0,26,21,47,47,47h101.8v-9.4H280.7
        c-20.7,0-37.6-16.8-37.6-37.6c0-20.8,16.8-37.6,37.6-37.6h101.8v-9.4H280.7C254.7,279.9,233.7,301,233.7,326.9z"/>
    </g>
    <rect x="404.2" y="300.8" opacity="0.2" fill="#8DC641" enable-background="new    " width="2.899" height="52.1"/>
    <g>
      <path fill="#8DC641" d="M385.6,312.4H343.4v25.8H385.6V312.4z M383.8,336.2h-38.6v-21.9h38.6V336.2z"/>
      <polygon fill="#8DC641" points="388.2,342 386.1,339.6 342.9,339.6 340.9,342 340.9,342 340.9,343.2 388.2,343.2     "/>
      <g>
        <circle fill="#8DC641" cx="361" cy="333.4" r="1.9"/>
        <circle fill="#8DC641" cx="369.2" cy="333.4" r="1.9"/>
        <path fill="#8DC641" d="M374,321.2c-2.4,0-11.6,0-11.6,0s-0.601,0.1-0.601,0.9c0,0.8,0.601,1,0.601,1h10.3l-0.601,2
          c-2.899,0-10.199,0-10.199,0s-0.601,0.1-0.601,0.9s0.601,0.9,0.601,0.9h9.699l0,0l-0.5,1.9h-10.6l-0.6-5.7l-0.301-1.9
          c0,0-0.3-1.8-0.399-2.4c-0.101-0.8-1.3-1.1-1.3-1.1l-3-1.6c-0.301-0.3-0.601-0.6-1.301-0.6h-0.1c-0.6,0-1.3,0.5-1.3,1.1
          s0.5,1.1,1.3,1.1h0.4c0.3,0,0.6-0.1,0.8-0.3l2,1.6c0,0,0.6,0.5,0.6,1.1c0,0.5,1.3,9.7,1.3,9.7s0,1.3,1.301,1.3
          c1.1,0,10.699,0,11.699,0s1.101-1,1.101-1l2.3-6.8C375,323.1,375.7,321.2,374,321.2z"/>
      </g>
    </g>
    <rect x="443.2" y="176.5" opacity="0.1" fill="#F15C27" enable-background="new    " width="323.8" height="112.8"/>
    <g>
      <g>
        <path fill="#F15C27" d="M382.5,176.5h101.8c31.2,0,56.4,25.3,56.4,56.4s-25.3,56.4-56.4,56.4H382.5v-18.8h101.8
          c20.7,0,37.601-16.8,37.601-37.6c0-20.8-16.801-37.6-37.601-37.6H382.5V176.5z"/>
      </g>
      <path opacity="0.5" fill="#010101" enable-background="new    " d="M484.3,289.3c31.2,0,56.4-25.3,56.4-56.4s-25.3-56.4-56.4-56.4
        H382.5v9.4h101.8c26,0,47,21,47,47c0,25.9-21,47-47,47H382.5v9.4H484.3z"/>
    </g>
    <rect x="354.5" y="206.8" opacity="0.2" fill="#F15C27" enable-background="new    " width="2.9" height="52.1"/>
    <g>
      <circle fill="#F15C27" cx="394.3" cy="246.6" r="3.4"/>
      <path fill="#F15C27" d="M393.6,238.1l-0.5-3.9h15.2c-0.1-0.5-0.3-1-0.3-1.6c0-0.1,0-0.3,0-0.4h-15.3l-0.5-4h16h2.1
        c0.9-0.8,2.101-1.1,3.4-1.1c2.3,0,4.3,1.4,5.2,3.3l0.8-2.4c0,0,1.3-3.3-1.9-3.3c-4.3,0-6.5,0-6.5,0h-3H392c0,0-0.4-3.1-0.6-4.4
        c-0.301-1.3-2.301-2-2.301-2l-5.399-3c-0.4-0.4-1.101-1.3-2.101-1.3H381c-1.3,0-2.1,0.9-2.1,1.9c0,1.1,1,1.9,2.1,1.9h0.6
        c0.5,0,1-0.1,1.4-0.5l3.6,2.9c0,0,1.101,0.8,1.101,1.8c0.1,1,2.399,17.7,2.399,17.7s0.101,2.3,2.101,2.3c1,0,5.899,0,10.7,0v-1
        c0-0.1,0-1.5,0.899-2.9h-10.1l0,0H393.6z"/>
      <path fill="#F15C27" d="M417.4,237.3h-2.9c0.3,0.3,0,1-0.3,1.5c-0.4-0.1-0.9-0.1-1.3,0c-0.301-0.5-0.5-1.3-0.301-1.5H410
        c-5.3,0.1-5,4-5,4v9l0,0c0,0,0,0,0,0.1c0,0.9,0.8,1.5,1.5,1.5c0.9,0,1.5-0.8,1.5-1.5c0,0,0,0,0-0.1l0,0v-8.2h1v9.2l9.3,0.1v-9.3h1
        v8.4l0,0l0,0c0,0.9,0.601,1.5,1.5,1.5c0.9,0,1.5-0.8,1.5-1.5l0,0v-9C422.1,237.2,417.4,237.3,417.4,237.3z M413.8,247.6l-1-1.3
        l0.5-6.7c0.3,0,0.601,0,1,0v0.1l0.3,3.3l0.301,3.4L413.8,247.6z"/>
      <path fill="#F15C27" d="M417.6,232.9c0.101,0,0.301-0.1,0.301-0.3v-1.3c0-0.1-0.101-0.3-0.301-0.3c-0.1,0-0.1,0-0.1,0.1
        c-0.5-1.5-1.9-2.5-3.5-2.5c-2,0-3.6,1.6-3.6,3.6s1.6,3.6,3.6,3.6c1.6,0,3-1,3.5-2.5c-1.1,1.3-3.1,1.6-3.3,1.6l-0.101-0.5
        c0,0,2.5-0.5,3.301-2v0.1C417.4,232.9,417.4,232.9,417.6,232.9z"/>
    </g>
    <rect x="407.6" y="112.9" opacity="0.2" fill="#67C9D0" enable-background="new    " width="2.9" height="52.1"/>
    <g>
      <g>
        <path fill="#67C9D0" d="M382.5,195.3H280.7c-31.2,0-56.4-25.3-56.4-56.4c0-31.2,25.3-56.4,56.4-56.4h101.8v18.8H280.7
          c-20.7,0-37.6,16.8-37.6,37.6c0,20.8,16.8,37.6,37.6,37.6h101.8V195.3z"/>
      </g>
      <path opacity="0.5" fill="#010101" enable-background="new    " d="M233.7,138.9c0,26,21,47,47,47h101.8v-9.4H280.7
        c-20.7,0-37.6-16.8-37.6-37.6c0-20.8,16.8-37.6,37.6-37.6h101.8v-9.4H280.7C254.7,91.9,233.7,113,233.7,138.9z"/>
    </g>
    <g>
      <g>
        <path fill="#67C9D0" d="M386.8,137.2v-0.6c0-6.2-5.3-11.1-11.8-11.1h-21.4c-6.5,0-11.8,4.9-11.8,11.1v1.8
          c-0.399,1.1-0.5,2.3-0.5,3.4c0,6,4.9,10.8,10.8,10.8c6,0,10.801-4.9,10.801-10.8c0-3.9-2.101-7.4-5.2-9.3c4-0.8,8.5-0.9,13.399,0
          c-3.1,1.9-5.3,5.3-5.3,9.3c0,6,4.9,10.8,10.8,10.8c5.9,0,10.801-4.9,10.801-10.8C387.8,139.9,387.4,138.4,386.8,137.2z
           M352.2,148.7c-4,0-7.2-3.3-7.2-7.2c0-4,3.3-7.2,7.2-7.2c4,0,7.2,3.3,7.2,7.2C359.4,145.6,356.1,148.7,352.2,148.7z M377,148.7
          c-4,0-7.2-3.3-7.2-7.2c0-4,3.3-7.2,7.2-7.2c4,0,7.2,3.3,7.2,7.2C384.1,145.6,380.9,148.7,377,148.7z"/>
      </g>
      <g>
        <path fill="#67C9D0" d="M348.4,138.2c-1,1-1.601,2-1.4,2.3c0.3,0.3,1.3-0.3,2.4-1.3c1-1,1.6-2,1.399-2.3
          C350.6,136.5,349.6,137.2,348.4,138.2z"/>
      </g>
      <g>
        <path fill="#67C9D0" d="M378.9,136.8c-0.301,0.3,0.3,1.4,1.3,2.4s2,1.8,2.3,1.5c0.3-0.3-0.3-1.3-1.3-2.4
          C380.1,137.2,379.1,136.4,378.9,136.8z"/>
      </g>
      <g>
        <path fill="#67C9D0" d="M383.8,127.9c-4.399-7.7-8.7-3.6-8.7-3.6C380.7,124.1,383.8,127.9,383.8,127.9z"/>
      </g>
      <g>
        <path fill="#67C9D0" d="M352.7,124.1c0,0-4.3-4-8.7,3.6C344,127.7,346.9,124,352.7,124.1z"/>
      </g>
    </g>
    <circle fill="#67C9D0" cx="382.5" cy="52.7" r="48.6"/>
    <path opacity="0.5" fill="#010101" enable-background="new    " d="M382.5,4.1c-26.9,0-48.6,21.7-48.6,48.6
      c0,26.9,21.699,48.6,48.6,48.6s48.6-21.7,48.6-48.6C431.1,25.8,409.4,4.1,382.5,4.1z M382.5,91.9c-21.6,0-39.2-17.6-39.2-39.2
      c0-21.6,17.601-39.2,39.2-39.2s39.2,17.6,39.2,39.2C421.7,74.3,404.1,91.9,382.5,91.9z"/>
    <g>
      <path fill="#FFFFFF" d="M363.8,58c0,1.5-0.399,2.9-1.3,4c-0.5,0.8-1.3,1.3-2.3,1.6c-0.5,0.1-1.101,0.3-1.9,0.3
        c-1.3,0-2.399-0.4-3.3-1c-0.8-0.5-1.3-1.3-1.8-2.1c-0.4-0.9-0.601-2-0.8-3.1l3.3-0.3c0.1,1.3,0.5,2.3,1,2.9
        c0.399,0.5,0.899,0.6,1.399,0.6c0.801,0,1.4-0.4,1.801-1.1c0.3-0.4,0.399-0.9,0.399-1.5c0-0.9-0.399-1.9-1.3-2.8
        c-0.6-0.6-1.6-1.6-3-2.9c-1.1-1.1-1.9-2-2.4-2.9c-0.5-1-0.8-2-0.8-3.1c0-2,0.601-3.5,2-4.6c0.9-0.6,1.9-1,3.101-1
        c1.3,0,2.3,0.3,3.1,0.8c0.6,0.4,1.3,1,1.6,1.8c0.4,0.8,0.601,1.6,0.801,2.6l-3.301,0.6c-0.1-0.9-0.399-1.6-0.8-2.1
        c-0.3-0.4-0.8-0.5-1.399-0.5c-0.601,0-1.101,0.3-1.4,0.9c-0.3,0.4-0.4,1-0.4,1.6c0,1,0.4,2,1.301,3.1c0.399,0.4,0.899,0.9,1.5,1.4
        c0.8,0.6,1.3,1.1,1.5,1.4c0.899,0.9,1.5,1.6,1.899,2.5c0.3,0.4,0.4,0.8,0.5,1C363.7,56.7,363.8,57.4,363.8,58z"/>
      <path fill="#FFFFFF" d="M369.1,44.7h-3.6v-3.4h10.6v3.4h-3.6v19h-3.4V44.7z"/>
      <path fill="#FFFFFF" d="M379.4,58.5l-0.9,5.2H375l3.8-22.4h4.601l3.8,22.4h-3.5l-0.8-5.2H379.4z M381.1,46.4l-1.3,8.8h2.5
        L381.1,46.4z"/>
      <path fill="#FFFFFF" d="M394.7,41.3c1.899,0,3.3,0.5,4.1,1.5c0.8,0.9,1.101,2.1,1.101,3.8v3.3c0,1.6-0.601,2.9-1.801,4l2.5,9.8
        H397l-2-8.4c-0.1,0-0.3,0-0.3,0h-1.9v8.4h-3.3V41.3H394.7z M396.7,46.7c0-1.3-0.601-1.9-1.9-1.9h-2V52h2c0.5,0,1-0.3,1.4-0.6
        c0.399-0.4,0.5-0.9,0.5-1.4V46.7z"/>
      <path fill="#FFFFFF" d="M405.5,44.7H402v-3.4h10.5v3.4H409v19h-3.4L405.5,44.7L405.5,44.7z"/>
    </g>
    <rect x="-2" y="646.599" opacity="0.1" fill="#1072BA" enable-background="new    " width="323.8" height="112.801"/>
    <g>
      <g>
        <path fill="#1072BA" d="M382.5,759.4H280.7c-31.2,0-56.4-25.301-56.4-56.4c0-31.199,25.3-56.4,56.4-56.4h101.8V665.4H280.7
          c-20.7,0-37.6,16.801-37.6,37.6c0,20.701,16.8,37.6,37.6,37.6h101.8V759.4z"/>
      </g>
      <path opacity="0.5" fill="#010101" enable-background="new    " d="M233.7,703c0,26,21,47,47,47h101.8v-9.4H280.7
        c-20.7,0-37.6-16.799-37.6-37.6c0-20.699,16.8-37.6,37.6-37.6h101.8V656H280.7C254.7,656,233.7,677.099,233.7,703z"/>
    </g>
    <rect x="404.2" y="680" opacity="0.2" fill="#1072BA" enable-background="new    " width="2.899" height="52.1"/>
    <circle fill="#1072BA" cx="382.5" cy="789.2" r="48.601"/>
    <path opacity="0.5" fill="#010101" enable-background="new    " d="M382.5,740.599c-26.9,0-48.6,21.701-48.6,48.602
      c0,26.898,21.699,48.6,48.6,48.6s48.6-21.701,48.6-48.6C431.1,762.3,409.4,740.599,382.5,740.599z M382.5,828.4
      c-21.6,0-39.2-17.6-39.2-39.199C343.3,767.599,360.9,750,382.5,750s39.2,17.6,39.2,39.201C421.7,810.9,404.1,828.4,382.5,828.4z"/>
    <g>
      <path fill="#FFFFFF" d="M355.6,800.4H352.2V778h9.5v3.4h-6.2v6h4.5v3.4h-4.5L355.6,800.4L355.6,800.4z"/>
      <path fill="#FFFFFF" d="M366.8,800.4H363.4V778h3.399V800.4z"/>
      <path fill="#FFFFFF" d="M373,778l4.5,15.1V778h3.4v22.4H377.3l-4.6-14.301V800.4h-3.4V778H373z"/>
      <path fill="#FFFFFF" d="M386.6,800.4H383.2V778h3.399V800.4z"/>
      <path fill="#FFFFFF" d="M399.8,794.8c0,1.5-0.399,2.9-1.3,4c-0.5,0.799-1.3,1.299-2.3,1.6c-0.5,0.1-1.101,0.301-1.9,0.301
        c-1.3,0-2.399-0.4-3.3-1c-0.8-0.5-1.3-1.301-1.8-2.102c-0.4-0.898-0.601-2-0.8-3.1l3.3-0.299c0.1,1.299,0.5,2.299,1,2.898
        c0.399,0.5,0.899,0.602,1.399,0.602c0.801,0,1.4-0.4,1.801-1.102c0.3-0.398,0.399-0.898,0.399-1.5c0-0.898-0.399-1.898-1.3-2.799
        c-0.6-0.6-1.6-1.6-3-2.9c-1.1-1.1-1.9-2-2.4-2.9c-0.5-1-0.8-2-0.8-3.1c0-2,0.601-3.5,2-4.6c0.9-0.6,1.9-1,3.101-1
        c1.199,0,2.3,0.299,3.1,0.799c0.6,0.4,1.3,1,1.6,1.801c0.4,0.801,0.601,1.6,0.801,2.6l-3.301,0.6c-0.1-0.898-0.399-1.6-0.8-2.1
        c-0.3-0.4-0.8-0.5-1.399-0.5c-0.601,0-1.101,0.301-1.4,0.9c-0.3,0.4-0.4,1-0.4,1.6c0,1,0.4,2,1.301,3.1
        c0.399,0.4,0.899,0.9,1.5,1.4c0.8,0.6,1.3,1.1,1.5,1.4c0.899,0.9,1.5,1.6,1.899,2.5c0.3,0.4,0.4,0.801,0.5,1
        C399.7,793.4,399.8,794.201,399.8,794.8z"/>
      <path fill="#FFFFFF" d="M405.5,790.9v9.4h-3.4v-22.4h3.4v9.4h4v-9.4h3.4v22.4h-3.4v-9.4H405.5z"/>
    </g>
    <g>
      <rect x="-2" y="458.599" opacity="0.1" fill="#3BBB9A" enable-background="new    " width="323.8" height="112.801"/>
      <g>
        <g>
          <path fill="#3BBB9A" d="M382.5,571.4H280.7c-31.2,0-56.4-25.301-56.4-56.4c0-31.199,25.3-56.4,56.4-56.4h101.8V477.4H280.7
            c-20.7,0-37.6,16.801-37.6,37.6c0,20.701,16.8,37.6,37.6,37.6h101.8V571.4z"/>
        </g>
        <path opacity="0.5" fill="#010101" enable-background="new    " d="M233.7,515c0,26,21,47,47,47h101.8v-9.4H280.7
          c-20.7,0-37.6-16.799-37.6-37.6c0-20.699,16.8-37.6,37.6-37.6h101.8V468H280.7C254.7,468,233.7,489,233.7,515z"/>
      </g>
      <rect x="404.2" y="488.9" opacity="0.2" fill="#8DC641" enable-background="new    " width="2.899" height="52.1"/>
      <g>
        <path fill="#3BBB9A" d="M385.6,500.599H343.4V526.4H385.6V500.599z M383.8,524.3h-38.6v-21.9h38.6V524.3z"/>
        <polygon fill="#3BBB9A" points="388.2,530 386.1,527.599 342.9,527.599 340.9,530 340.9,530 340.9,531.3 388.2,531.3       "/>
        <g>
          <circle fill="#3BBB9A" cx="361" cy="521.5" r="1.9"/>
          <circle fill="#3BBB9A" cx="369.2" cy="521.5" r="1.9"/>
          <path fill="#3BBB9A" d="M374,509.3c-2.4,0-11.6,0-11.6,0s-0.601,0.1-0.601,0.9c0,0.799,0.601,1,0.601,1h10.3l-0.601,2
            c-2.899,0-10.199,0-10.199,0s-0.601,0.1-0.601,0.898c0,0.801,0.601,0.9,0.601,0.9h9.699l0,0l-0.5,1.9h-10.6l-0.8-5.5l-0.3-1.9
            c0,0-0.301-1.799-0.4-2.4c-0.1-0.799-1.3-1.1-1.3-1.1l-3-1.6c-0.3-0.301-0.601-0.6-1.3-0.6l0,0c-0.601,0-1.301,0.5-1.301,1.1
            s0.5,1.1,1.301,1.1h0.399c0.3,0,0.601-0.1,0.8-0.299l2,1.6c0,0,0.601,0.5,0.601,1.1c0,0.5,1.3,9.699,1.3,9.699
            s0,1.301,1.3,1.301c1.101,0,10.7,0,11.7,0s1.1-1,1.1-1l2.301-6.801C375,511.099,375.7,509.3,374,509.3z"/>
        </g>
      </g>
    </g>
    <g>
      <rect x="443.2" y="552.4" opacity="0.1" fill="#BCBEC0" enable-background="new    " width="323.8" height="112.801"/>
      <g>
        <g>
          <path fill="#BCBEC0" d="M382.5,552.4h101.8c31.2,0,56.4,25.301,56.4,56.4c0,31.199-25.3,56.4-56.4,56.4H382.5V646.4h101.8
            c20.7,0,37.601-16.801,37.601-37.6c0-20.701-16.801-37.6-37.601-37.6H382.5V552.4z"/>
        </g>
        <path opacity="0.5" fill="#010101" enable-background="new    " d="M484.3,665.3c31.2,0,56.4-25.301,56.4-56.4
          c0-31.199-25.3-56.4-56.4-56.4H382.5v9.4h101.8c26,0,47,21,47,47c0,25.9-21,47-47,47H382.5v9.4H484.3z"/>
      </g>
      <g>
        <g>
          <polygon fill="#1072BA" points="373.2,696.3 373.2,698.099 376.3,698.099 366,708.4 355.9,698.201 345.2,709 347.6,711.5 
            355.9,703.201 366,713.4 379,700.5 379,704.9 380.7,704.9 380.7,696.3         "/>
        </g>
      </g>
    </g>
    <g>
      <path fill="#67C9D0" d="M290.9,135.3c0,13.3-3.9,19-13.1,19c-9.2,0-13.1-5.7-13.1-19c0-13.3,3.9-18.8,13.1-18.8
        C287,116.5,290.9,122,290.9,135.3z M289.3,135.3c0-12.2-3.4-17.5-11.4-17.5s-11.4,5.3-11.4,17.5c0,12.2,3.4,17.5,11.4,17.5
        S289.3,147.5,289.3,135.3z"/>
      <path fill="#67C9D0" d="M297.9,124.6c-0.1,0.1-0.4,0.1-0.5,0.1c-0.4,0-0.8-0.4-0.8-0.8c0-0.3,0.1-0.5,0.4-0.6l9.3-6.4
        c0.3-0.1,0.4-0.3,0.601-0.3c0.5,0,0.8,0.4,0.8,0.8V153c0,0.4-0.4,0.8-0.9,0.8s-0.8-0.4-0.8-0.8v-34.2L297.9,124.6z"/>
    </g>
    <g>
      <path fill="#F15C27" d="M480.6,232c0,13.3-3.899,19-13.1,19s-13.1-5.7-13.1-19s3.899-18.8,13.1-18.8S480.6,218.7,480.6,232z
         M479,232c0-12.2-3.4-17.5-11.4-17.5S456.2,219.8,456.2,232s3.399,17.5,11.399,17.5S479,244.2,479,232z"/>
      <path fill="#F15C27" d="M498.4,213.2c7.199,0,11.199,4.1,11.199,10.4c0,12.9-21.399,15.5-21.399,25.3h21.2
        c0.399,0,0.8,0.4,0.8,0.8c0,0.4-0.4,0.8-0.8,0.8h-22.2c-0.4,0-0.8-0.4-0.8-0.8c0-12.4,21.399-13.3,21.399-26
        c0-5-3.1-8.9-9.399-8.9c-5.5,0-8,2.6-9.2,6c-0.101,0.3-0.4,0.4-0.8,0.4c-0.4,0-0.801-0.4-0.801-0.8c0,0,0-0.1,0-0.4
        C489.1,215.8,492.7,213.2,498.4,213.2z"/>
    </g>
    <g>
      <path fill="#8DC641" d="M287.1,328.8c0,13.3-3.9,19-13.1,19s-13.1-5.7-13.1-19c0-13.3,3.9-18.8,13.1-18.8
        C283.2,309.9,287.1,315.5,287.1,328.8z M285.5,328.8c0-12.2-3.4-17.5-11.4-17.5s-11.4,5.3-11.4,17.5c0,12.2,3.4,17.5,11.4,17.5
        S285.5,341,285.5,328.8z"/>
      <path fill="#8DC641" d="M304.8,325.5c8.5,0,11.101,5.3,11.101,11.1c0,6.9-4.101,11.2-12.101,11.2c-5.9,0-9.5-2.3-11.3-5.9
        c-0.1-0.3-0.1-0.4-0.1-0.5c0-0.4,0.4-0.8,0.8-0.8c0.3,0,0.5,0.1,0.8,0.4c1.8,3.5,5,5.2,10.1,5.2c6.9,0,10.4-3.5,10.4-9.5
        c0-5.8-2.4-9.5-9.7-9.5h-3.9c-0.4,0-0.8-0.4-0.8-0.8c0-0.3,0.1-0.4,0.3-0.6l11.8-13.6h-16.8c-0.4,0-0.8-0.4-0.8-0.8
        s0.4-0.8,0.8-0.8h18.5c0.399,0,0.8,0.4,0.8,0.8c0,0.1,0,0.3-0.101,0.5l-12.1,13.6H304.8L304.8,325.5z"/>
    </g>
    <g>
      <path fill="#F79421" d="M480.6,421.8c0,13.299-3.899,19-13.1,19s-13.1-5.701-13.1-19c0-13.3,3.899-19,13.1-19
        S480.6,408.4,480.6,421.8z M479,421.8c0-12.201-3.4-17.5-11.4-17.5s-11.399,5.3-11.399,17.5c0,12.199,3.399,17.5,11.399,17.5
        C475.6,439.201,479,434,479,421.8z"/>
      <path fill="#F79421" d="M509.5,429.599c0.4,0,0.8,0.4,0.8,0.801s-0.399,0.801-0.8,0.801h-4.4v8.5c0,0.398-0.399,0.799-0.8,0.799
        c-0.5,0-0.899-0.4-0.899-0.799v-8.602h-17.7c-0.4,0-0.8-0.398-0.8-0.799c0-0.1,0-0.4,0.1-0.5l18.5-26.3c0.3-0.4,0.4-0.5,0.8-0.5
        c0.5,0,0.9,0.4,0.9,0.9v25.5h4.3V429.599z M503.5,429.599V406.5l-16.3,23.099H503.5z"/>
    </g>
    <g>
      <path fill="#3BBB9A" d="M287.1,514.8c0,13.299-3.9,19-13.1,19s-13.1-5.701-13.1-19c0-13.301,3.9-19,13.1-19
        C283.2,495.9,287.1,501.4,287.1,514.8z M285.5,514.8c0-12.201-3.4-17.5-11.4-17.5s-11.4,5.299-11.4,17.5
        c0,12.199,3.4,17.5,11.4,17.5S285.5,526.9,285.5,514.8z"/>
      <path fill="#3BBB9A" d="M316.9,521.5c0,8.4-5,12.201-12.2,12.201c-5.9,0-10.2-2.4-12.3-7.301c0-0.1,0-0.301,0-0.301
        c0-0.398,0.4-0.799,0.8-0.799c0.3,0,0.5,0.1,0.8,0.4c1.9,4.299,5.7,6.398,10.9,6.398c6.2,0,10.4-3,10.4-10.699
        c0-7.4-4.3-10.6-10.4-10.6c-4.5,0-7.3,1.4-10.1,4.4c-0.1,0.1-0.4,0.398-0.6,0.398c-0.4,0-0.8-0.398-0.8-0.799c0,0,0-0.1,0-0.4
        l3.4-17.301c0-0.398,0.4-0.6,0.8-0.6h17.3c0.399,0,0.8,0.4,0.8,0.801s-0.4,0.799-0.8,0.799H298.2l-3.1,15.201c1.8-2,5-3.9,9.8-3.9
        C311.9,509.5,316.9,513.4,316.9,521.5z"/>
    </g>
    <g>
      <path fill="#BCBEC0" d="M480.6,610.201c0,13.299-3.899,19-13.1,19s-13.1-5.701-13.1-19c0-13.301,3.899-19,13.1-19
        C476.7,591.3,480.6,596.9,480.6,610.201z M479,610.201c0-12.201-3.4-17.5-11.4-17.5S456.2,598,456.2,610.201
        c0,12.199,3.399,17.5,11.399,17.5S479,622.4,479,610.201z"/>
      <path fill="#BCBEC0" d="M511.3,617.4c0,8.4-5.2,11.801-12.3,11.801c-9.7,0-12.4-7.5-12.4-18.102
        c0-14.1,4.801-19.898,13.301-19.898c4.1,0,7.199,1.5,8.5,2.799c0.1,0.1,0.3,0.4,0.3,0.6c0,0.4-0.4,0.801-0.8,0.801
        c-0.101,0-0.4,0-0.5-0.301c-2-1.6-4.301-2.398-7.5-2.398c-8.301,0-11.601,6.5-11.601,16.6v3.1c1.601-3.9,5-7,10.8-7
        C506.1,605.599,511.3,609.4,511.3,617.4z M509.5,617.4c0-7.4-4.4-10.301-10.6-10.301c-5.5,0-8.7,3.102-10.4,8.201
        c0.4,7.9,3.9,12.299,10.4,12.299C505.1,627.701,509.5,625.201,509.5,617.4z"/>
    </g>
    <g>
      <path fill="#1072BA" d="M288.5,703.701c0,13.299-3.9,19-13.1,19c-9.2,0-13.1-5.701-13.1-19c0-13.301,3.9-18.801,13.1-18.801
        C284.6,684.8,288.5,690.4,288.5,703.701z M286.9,703.701c0-12.201-3.4-17.5-11.4-17.5s-11.4,5.299-11.4,17.5
        c0,12.199,3.4,17.5,11.4,17.5S286.9,715.9,286.9,703.701z"/>
      <path fill="#1072BA" d="M314.1,687H293.7c-0.4,0-0.8-0.4-0.8-0.799c0-0.4,0.4-0.801,0.8-0.801H315.1c0.4,0,0.801,0.4,0.801,0.801
        c0,12.699-16,15.5-16,35.398c0,0.4-0.4,0.801-0.8,0.801s-0.9-0.4-0.9-0.801C298.3,701.599,314.1,697.8,314.1,687z"/>
    </g>
    <rect x="354.5" y="583.201" opacity="0.2" fill="#BCBEC0" enable-background="new    " width="2.9" height="52.1"/>
    <g>
      <path fill="#BCBEC0" d="M402.2,593.3c-9.9,0-18,8-18,18c0,9.9,8,18,18,18c9.899,0,18-8,18-18S412.2,593.3,402.2,593.3z
         M402.2,624.099c-7,0-12.8-5.799-12.8-12.799s5.8-12.801,12.8-12.801S415,604.3,415,611.3S409.3,624.099,402.2,624.099z"/>
      <path fill="#BCBEC0" d="M403.7,609c-2.101-0.799-2.9-1.299-2.9-2c0-0.6,0.5-1.4,2.101-1.4c1.8,0,2.899,0.5,3.5,0.9l0.8-2.799
        c-0.9-0.4-1.9-0.801-3.5-0.801v-2.1h-2.4v2.299c-2.6,0.5-4.1,2.102-4.1,4.301c0,2.4,1.8,3.5,4.399,4.4
        c1.801,0.6,2.601,1.1,2.601,2.1s-1,1.5-2.4,1.5c-1.6,0-3-0.5-4-1l-0.8,2.9c0.9,0.5,2.5,1,4.1,1v2.299h2.4v-2.5
        c2.8-0.5,4.3-2.299,4.3-4.398C407.8,611.3,406.6,610,403.7,609z"/>
    </g>
    <g>
      <path fill="#67C9D0" d="M51.4,121.2h3.5v5.8h5.3v-5.8h3.5v14.3h-3.5v-5.7h-5.3v5.7h-3.5V121.2z"/>
      <path fill="#67C9D0" d="M72.8,121c4.4,0,7.5,3.3,7.5,7.3c0,4.3-3.1,7.5-7.5,7.5c-4.4,0-7.5-3.3-7.5-7.5
        C65.2,124.2,68.4,121,72.8,121z M72.8,132.6c2.1,0,3.9-1.9,3.9-4.3c0-2.4-1.8-4.1-3.9-4.1c-2.1,0-3.9,1.8-3.9,4.1
        C68.9,130.6,70.6,132.6,72.8,132.6z"/>
      <path fill="#67C9D0" d="M80.6,121.2h3.6l1.8,9c0.1,0.9,0.1,1.5,0.1,1.5l0,0c0,0,0-0.6,0.3-1.5l2.3-9h2.8l2.1,9
        c0.3,0.9,0.3,1.5,0.3,1.5l0,0c0,0,0-0.6,0.1-1.5l2-9h3.8l-3.6,14.3h-3.9l-1.8-7.3c-0.3-0.9-0.3-1.6-0.3-1.6l0,0c0,0,0,0.8-0.3,1.6
        l-1.8,7.3h-4L80.6,121.2z"/>
      <path fill="#67C9D0" d="M104.8,121.2h5.3c2.9,0,4.9,1.3,4.9,3.8c0,1.3-0.6,2.4-1.6,3l0,0c1.6,0.5,2.3,2,2.3,3.3
        c0,3.1-2.6,4.3-5.5,4.3h-5.3v-14.4H104.8z M110.2,126.7c0.9,0,1.3-0.6,1.3-1.4c0-0.6-0.4-1.3-1.4-1.3h-1.8v2.5h1.9V126.7z
         M110.5,132.6c1,0,1.5-0.8,1.5-1.5c0-0.8-0.5-1.5-1.5-1.5h-2.1v3H110.5z"/>
      <path fill="#67C9D0" d="M117.1,121.2h3.5v9c0,1.5,1,2.3,2.5,2.3s2.5-0.8,2.5-2.3v-9h3.5v9c0,3.3-2.4,5.5-6,5.5s-6-2.3-6-5.5V121.2
        z"/>
      <path fill="#67C9D0" d="M134.5,129.7l-4.8-8.5h4l1.6,3.5c0.5,1,0.9,2,0.9,2l0,0c0,0,0.4-1.1,0.9-2l1.6-3.5h4l-4.8,8.5v5.9h-3.4
        V129.7L134.5,129.7z"/>
      <path fill="#67C9D0" d="M143.5,121.2h9v3H147v2.6h4.4v3H147v2.8h5.8v3h-9.3V121.2z"/>
      <path fill="#67C9D0" d="M154.6,121.2h5c1.5,0,2.1,0.1,2.8,0.4c1.6,0.6,2.6,2.1,2.6,4.1c0,1.5-0.8,3.1-2.1,3.9l0,0
        c0,0,0.3,0.3,0.5,0.9l2.8,5h-3.9l-2.5-4.9h-1.6v4.9h-3.5v-14.3H154.6L154.6,121.2z M159.6,127.7c1.1,0,1.9-0.6,1.9-1.8
        c0-1.2-0.4-1.8-2.1-1.8h-1.1v3.5h1.3V127.7L159.6,127.7z"/>
      <path fill="#67C9D0" d="M168.3,131.1c0,0,1.6,1.5,3.4,1.5c0.8,0,1.5-0.3,1.5-1.1c0-1.8-6.5-1.6-6.5-6c0-2.6,2.3-4.4,5-4.4
        c3.1,0,4.6,1.6,4.6,1.6l-1.5,2.9c0,0-1.5-1.3-3.1-1.3c-0.8,0-1.5,0.4-1.5,1.1c0,1.8,6.5,1.5,6.5,6c0,2.4-1.9,4.5-5,4.5
        c-3.4,0-5.3-2-5.3-2L168.3,131.1z"/>
      <path fill="#67C9D0" d="M61,145.1h8.8v3h-5.3v3h4.4v3h-4.4v5.3H61V145.1z"/>
      <path fill="#67C9D0" d="M71.1,145.1h3.5v14.3h-3.5V145.1z"/>
      <path fill="#67C9D0" d="M77.3,145.1h3.5l4,6.7c0.5,1,1.3,2.5,1.3,2.5l0,0c0,0-0.1-1.5-0.1-2.5v-6.7h3.5v14.3H86l-4-6.7
        c-0.5-1-1.3-2.5-1.3-2.5l0,0c0,0,0.1,1.5,0.1,2.5v6.7h-3.5V145.1z"/>
      <path fill="#67C9D0" d="M92,145.1h5.2c4.5,0,7.4,2.6,7.4,7.2c0,4.5-2.9,7.2-7.4,7.2H92V145.1z M97,156.5c2.4,0,3.9-1.5,3.9-4.1
        c0-2.8-1.5-4.1-3.9-4.1h-1.5v8.3H97V156.5z"/>
      <path fill="#67C9D0" d="M110,145.1h3.5v5.8h5.3v-5.8h3.5v14.3h-3.5v-5.7h-5.3v5.7H110V145.1z"/>
      <path fill="#67C9D0" d="M131.3,144.8c4.4,0,7.5,3.3,7.5,7.3c0,4.3-3.1,7.5-7.5,7.5c-4.4,0-7.5-3.3-7.5-7.5
        C123.8,148.1,127,144.8,131.3,144.8z M131.3,156.5c2.1,0,3.9-1.9,3.9-4.3c0-2.4-1.8-4.1-3.9-4.1c-2.1,0-3.9,1.8-3.9,4.1
        C127.4,154.6,129.2,156.5,131.3,156.5z"/>
      <path fill="#67C9D0" d="M141.2,145.1h3.8l2.1,6c0.4,0.9,0.8,2.4,0.8,2.4l0,0c0,0,0.4-1.5,0.8-2.4l2.1-6h3.8l1.1,14.3h-3.5
        l-0.5-6.5c-0.1-1.1,0-2.4,0-2.4l0,0c0,0-0.5,1.5-0.8,2.4l-1.5,4.1h-3l-1.5-4.1c-0.4-0.9-0.8-2.4-0.8-2.4l0,0c0,0,0.1,1.4,0,2.4
        l-0.5,6.5H140L141.2,145.1z"/>
      <path fill="#67C9D0" d="M157.8,145.1h9v3h-5.5v2.6h4.4v3h-4.4v2.8h5.8v3h-9.3V145.1z"/>
    </g>
    <g>
      <path fill="#F15C27" d="M555,224.4h6c2.8,0,4.6,2,4.6,4.9c0,2.9-1.899,5-4.6,5h-2.5v4.4H555V224.4z M560.3,231.3
        c1.3,0,1.9-0.9,1.9-2c0-1.1-0.601-1.9-1.8-1.9H558.6v3.9H560.3z"/>
      <path fill="#F15C27" d="M567,224.4h5c1.5,0,2.1,0.1,2.8,0.4c1.601,0.6,2.601,2.1,2.601,4.1c0,1.5-0.801,3.1-2.101,3.9l0,0
        c0,0,0.3,0.3,0.5,0.9l2.8,5h-3.8l-2.5-4.9h-1.6v4.9h-3.5v-14.3H567L567,224.4z M572.1,230.8c1.101,0,1.9-0.6,1.9-1.8
        c0-1.1-0.4-1.8-2.1-1.8H570.8v3.5L572.1,230.8L572.1,230.8L572.1,230.8z"/>
      <path fill="#F15C27" d="M579.9,224.4h3.5v14.3h-3.5V224.4z"/>
      <path fill="#F15C27" d="M592.6,224.1c3.5,0,5.4,2,5.4,2l-1.6,2.6c0,0-1.601-1.5-3.601-1.5c-2.8,0-4,2-4,4.1c0,2.1,1.4,4.3,4,4.3
        c2.101,0,3.8-1.8,3.8-1.8l1.801,2.5c0,0-2,2.4-5.801,2.4c-4.5,0-7.5-3.1-7.5-7.4C585.1,227.3,588.2,224.1,592.6,224.1z"/>
      <path fill="#F15C27" d="M599.6,224.4h3.5v14.3h-3.5V224.4z"/>
      <path fill="#F15C27" d="M605.8,224.4h3.5l4,6.7c0.5,1,1.3,2.5,1.3,2.5l0,0c0,0-0.1-1.5-0.1-2.5v-6.7h3.5v14.3h-3.5l-4-6.7
        c-0.5-1-1.3-2.5-1.3-2.5l0,0c0,0,0.1,1.5,0.1,2.5v6.7h-3.5V224.4z"/>
      <path fill="#F15C27" d="M627,224.1c3.6,0,5.5,1.9,5.5,1.9l-1.6,2.6c0,0-1.5-1.4-3.5-1.4c-3,0-4.301,1.9-4.301,4
        c0,2.8,1.9,4.4,4.101,4.4c1.6,0,2.899-1,2.899-1v-1.1h-2v-3h5.2v8.2H630.4v-0.4c0-0.3,0-0.6,0-0.6l0,0c0,0-1.4,1.3-3.801,1.3
        c-3.6,0-7-2.8-7-7.4C619.5,227.3,622.8,224.1,627,224.1z"/>
      <path fill="#F15C27" d="M645.5,224.1c3.5,0,5.4,2,5.4,2l-1.601,2.6c0,0-1.6-1.5-3.6-1.5c-2.8,0-4,2-4,4.1c0,2.1,1.399,4.3,4,4.3
        c2.1,0,3.8-1.8,3.8-1.8l1.8,2.5c0,0-2,2.4-5.8,2.4c-4.5,0-7.5-3.1-7.5-7.4C638,227.3,641.2,224.1,645.5,224.1z"/>
      <path fill="#F15C27" d="M659.1,224.1c4.4,0,7.5,3.3,7.5,7.3c0,4.3-3.1,7.5-7.5,7.5c-4.399,0-7.5-3.3-7.5-7.5
        C651.5,227.3,654.8,224.1,659.1,224.1z M659.1,235.7c2.101,0,3.9-1.9,3.9-4.3s-1.8-4.1-3.9-4.1c-2.1,0-3.899,1.8-3.899,4.1
        C655.2,233.9,656.9,235.7,659.1,235.7z"/>
      <path fill="#F15C27" d="M668.2,224.4h5c1.5,0,2.1,0.1,2.8,0.4c1.6,0.6,2.6,2.1,2.6,4.1c0,1.5-0.8,3.1-2.1,3.9l0,0
        c0,0,0.3,0.3,0.5,0.9l2.8,5H675.9l-2.5-4.9H671.8v4.9h-3.5L668.2,224.4L668.2,224.4z M673.3,230.8c1.101,0,1.9-0.6,1.9-1.8
        c0-1.1-0.4-1.8-2.101-1.8H672v3.5L673.3,230.8L673.3,230.8z"/>
      <path fill="#F15C27" d="M681.1,224.4h5c1.5,0,2.101,0.1,2.801,0.4c1.6,0.6,2.6,2.1,2.6,4.1c0,1.5-0.8,3.1-2.1,3.9l0,0
        c0,0,0.3,0.3,0.5,0.9l2.8,5h-3.9l-2.5-4.9h-1.6v4.9h-3.5v-14.3H681.1L681.1,224.4z M686.2,230.8c1.1,0,1.899-0.6,1.899-1.8
        c0-1.1-0.399-1.8-2.1-1.8h-1.1v3.5L686.2,230.8L686.2,230.8L686.2,230.8z"/>
      <path fill="#F15C27" d="M694,224.4h9v3h-5.5v2.6h4.4v3h-4.4v2.8h5.8v3H694V224.4L694,224.4z"/>
      <path fill="#F15C27" d="M711.6,224.1c3.5,0,5.4,2,5.4,2l-1.6,2.6c0,0-1.601-1.5-3.601-1.5c-2.8,0-4,2-4,4.1c0,2.1,1.4,4.3,4,4.3
        c2.101,0,3.8-1.8,3.8-1.8l1.801,2.5c0,0-2,2.4-5.801,2.4c-4.5,0-7.5-3.1-7.5-7.4C704,227.3,707.3,224.1,711.6,224.1z"/>
      <path fill="#F15C27" d="M721.5,227.4h-4.4v-3h12.2v3H724.9v11.3h-3.5L721.5,227.4L721.5,227.4z"/>
      <path fill="#F15C27" d="M730.3,224.4h3.5v11.3h5.9v3h-9.4V224.4z"/>
      <path fill="#F15C27" d="M742.7,232.8l-4.8-8.5h4l1.6,3.5c0.5,1,0.9,2,0.9,2l0,0c0,0,0.399-1.1,0.899-2l1.601-3.5h4l-4.801,8.5v5.9
        h-3.5v-5.9H742.7z"/>
    </g>
    <g>
      <path fill="#8DC641" d="M55,322.6h-4.5l-0.9,3H46l4.9-14.3h3.6l4.9,14.3h-3.6L55,322.6z M52.8,314.6c0,0-0.4,1.5-0.6,2.5l-0.9,2.8
        h2.9l-0.8-2.8C53.2,316.1,52.8,314.6,52.8,314.6L52.8,314.6z"/>
      <path fill="#8DC641" d="M57.9,311.3h3.8l2.5,8.2c0.3,0.9,0.5,2.3,0.5,2.3l0,0c0,0,0.3-1.4,0.5-2.3l2.5-8.2h3.8l-5,14.3h-3.6
        L57.9,311.3z"/>
      <path fill="#8DC641" d="M72.5,311.3h9v3H76v2.6h4.4v3H76v2.8h5.8v3h-9.3V311.3z"/>
      <path fill="#8DC641" d="M83.6,311.3h5c1.5,0,2.1,0.1,2.8,0.4c1.6,0.6,2.6,2.1,2.6,4.1c0,1.5-0.8,3.1-2.1,3.9l0,0
        c0,0,0.3,0.3,0.5,0.9l2.8,5h-3.9l-2.5-4.9h-1.6v4.9h-3.6V311.3z M88.6,317.7c1.1,0,1.9-0.6,1.9-1.8c0-1.1-0.4-1.8-2.1-1.8h-1.1
        v3.5h1.3V317.7z"/>
      <path fill="#8DC641" d="M103.8,322.6h-4.5l-0.9,3h-3.6l4.9-14.3h3.6l4.9,14.3h-3.6L103.8,322.6z M101.5,314.6c0,0-0.4,1.5-0.6,2.5
        l-0.9,2.8h2.9l-0.8-2.8C101.9,316.1,101.5,314.6,101.5,314.6L101.5,314.6z"/>
      <path fill="#8DC641" d="M115.5,311.1c3.6,0,5.5,1.9,5.5,1.9l-1.6,2.6c0,0-1.5-1.4-3.5-1.4c-3,0-4.3,1.9-4.3,4
        c0,2.8,1.9,4.4,4.1,4.4c1.6,0,2.9-1,2.9-1v-1.1h-2v-3h5.2v8.2h-2.9v-0.4c0-0.3,0-0.6,0-0.6l0,0c0,0-1.4,1.3-3.8,1.3
        c-3.6,0-7-2.8-7-7.4C107.9,314.2,111.2,311.1,115.5,311.1z"/>
      <path fill="#8DC641" d="M123.7,311.3h9v3h-5.5v2.6h4.4v3h-4.4v2.8h5.8v3h-9.3V311.3L123.7,311.3z"/>
      <path fill="#8DC641" d="M138.5,311.3h5.2c4.5,0,7.4,2.6,7.4,7.2c0,4.5-2.9,7.2-7.4,7.2h-5.2V311.3z M143.4,322.6
        c2.4,0,3.9-1.5,3.9-4.1c0-2.8-1.5-4.1-3.9-4.1h-1.5v8.3h1.5V322.6z"/>
      <path fill="#8DC641" d="M159.7,322.6h-4.5l-0.9,3h-3.6l4.9-14.3h3.6l4.9,14.3h-3.6L159.7,322.6z M157.6,314.6c0,0-0.4,1.5-0.6,2.5
        l-0.9,2.8h2.9l-0.8-2.8C157.8,316.1,157.6,314.6,157.6,314.6L157.6,314.6z"/>
      <path fill="#8DC641" d="M167.1,319.7l-4.8-8.5h4l1.6,3.5c0.5,1,0.9,2,0.9,2l0,0c0,0,0.4-1.1,0.9-2l1.6-3.5h4l-4.8,8.5v5.9H167
        v-5.9H167.1z"/>
      <path fill="#8DC641" d="M176.9,321.1c0,0,1.6,1.5,3.4,1.5c0.8,0,1.5-0.3,1.5-1.1c0-1.8-6.5-1.6-6.5-6c0-2.6,2.3-4.4,5-4.4
        c3.1,0,4.6,1.6,4.6,1.6l-1.5,2.9c0,0-1.5-1.3-3.1-1.3c-0.8,0-1.5,0.4-1.5,1.1c0,1.8,6.5,1.5,6.5,6c0,2.4-1.9,4.5-5,4.5
        c-3.4,0-5.3-2-5.3-2L176.9,321.1z"/>
      <path fill="#8DC641" d="M67.6,334.9c4.4,0,7.5,3.3,7.5,7.3c0,4.3-3.1,7.5-7.5,7.5s-7.5-3.3-7.5-7.5
        C60.1,338.1,63.2,334.9,67.6,334.9z M67.6,346.5c2.1,0,3.9-1.9,3.9-4.3c0-2.4-1.8-4.1-3.9-4.1s-3.9,1.8-3.9,4.1
        C63.7,344.7,65.5,346.5,67.6,346.5z"/>
      <path fill="#8DC641" d="M76.7,335.2h3.5l4,6.7c0.5,1,1.3,2.5,1.3,2.5l0,0c0,0-0.1-1.5-0.1-2.5v-6.7h3.5v14.3h-3.6l-4-6.7
        c-0.5-1-1.3-2.5-1.3-2.5l0,0c0,0,0.1,1.5,0.1,2.5v6.7h-3.4V335.2z"/>
      <path fill="#8DC641" d="M96,335.2h3.8l2.1,6c0.4,0.9,0.8,2.4,0.8,2.4l0,0c0,0,0.4-1.5,0.8-2.4l2.1-6h3.8l1.1,14.3H107l-0.5-6.5
        c-0.1-1.1,0-2.4,0-2.4l0,0c0,0-0.5,1.5-0.8,2.4l-1.5,4.1h-3l-1.5-4.1c-0.4-0.9-0.8-2.4-0.8-2.4l0,0c0,0,0.1,1.4,0,2.4l-0.5,6.5
        h-3.6L96,335.2z"/>
      <path fill="#8DC641" d="M119.8,346.5h-4.5l-0.9,3h-3.6l4.9-14.3h3.6l4.9,14.3h-3.7L119.8,346.5z M117.5,338.5c0,0-0.4,1.5-0.6,2.5
        l-0.9,2.8h2.9l-0.8-2.8C117.9,340,117.6,338.5,117.5,338.5L117.5,338.5z"/>
      <path fill="#8DC641" d="M125,335.2h5c1.5,0,2.1,0.1,2.8,0.4c1.6,0.6,2.6,2.1,2.6,4.1c0,1.5-0.8,3.1-2.1,3.9l0,0
        c0,0,0.3,0.3,0.5,0.9l2.8,5h-3.9l-2.5-4.9h-1.6v4.9h-3.5v-14.3H125z M130.2,341.6c1.1,0,1.9-0.6,1.9-1.8c0-1.1-0.4-1.8-2.1-1.8
        h-1.1v3.5h1.3V341.6L130.2,341.6z"/>
      <path fill="#8DC641" d="M138,335.2h3.5v5.5h1.5l3-5.5h3.8l-3.9,6.9l0,0l4.1,7.4h-3.9l-3-5.8h-1.5v5.8h-3.5v-14.3H138z"/>
      <path fill="#8DC641" d="M151,335.2h9v3h-5.5v2.6h4.4v3h-4.4v2.8h5.8v3H151V335.2z"/>
      <path fill="#8DC641" d="M164.9,338.2h-4.4v-3h12.2v3h-4.4v11.3h-3.5v-11.3H164.9z"/>
    </g>
    <g>
      <path fill="#F79421" d="M570.7,413.5h3.8l2.1,6c0.4,0.9,0.801,2.4,0.801,2.4l0,0c0,0,0.399-1.5,0.8-2.4l2.1-6h3.8l1.101,14.3h-3.5
        l-0.5-6.5c-0.101-1.1,0-2.4,0-2.4l0,0c0,0-0.5,1.5-0.8,2.4l-1.5,4.1h-3l-1.5-4.1c-0.4-0.9-0.801-2.4-0.801-2.4l0,0
        c0,0,0.101,1.4,0,2.4l-0.5,6.5h-3.5L570.7,413.5z"/>
      <path fill="#F79421" d="M594.5,424.9H590l-0.9,3h-3.6l4.9-14.3h3.6l4.9,14.3H595.3L594.5,424.9z M592.2,416.7
        c0,0-0.4,1.5-0.601,2.5L590.7,422h2.899l-0.8-2.799C592.6,418.4,592.2,416.7,592.2,416.7L592.2,416.7z"/>
      <path fill="#F79421" d="M599.8,413.5h5c1.5,0,2.101,0.1,2.8,0.4c1.601,0.6,2.601,2.1,2.601,4.1c0,1.5-0.8,3.099-2.101,3.9l0,0
        c0,0,0.301,0.301,0.5,0.9l2.801,5h-3.9l-2.5-4.9h-1.6v4.9h-3.5v-14.3H599.8z M604.8,420c1.101,0,1.9-0.6,1.9-1.799
        c0-1.2-0.4-1.8-2.101-1.8h-1.1v3.5L604.8,420L604.8,420z"/>
      <path fill="#F79421" d="M612.7,413.5h3.5v5.5h1.5l3-5.5h3.8l-3.9,6.9l0,0l4.101,7.4h-3.9l-3-5.801h-1.6v5.801h-3.5V413.5
        L612.7,413.5z"/>
      <path fill="#F79421" d="M625.8,413.5h9v3h-5.5v2.599h4.4v3h-4.4v2.801h5.8v3h-9.3V413.5L625.8,413.5z"/>
      <path fill="#F79421" d="M639.6,416.5H635.2v-3h12.2v3H643v11.3h-3.5L639.6,416.5L639.6,416.5z"/>
      <path fill="#F79421" d="M648.4,413.5h3.5v14.3h-3.5V413.5z"/>
      <path fill="#F79421" d="M654.5,413.5h3.5l4,6.701c0.5,1,1.3,2.5,1.3,2.5l0,0c0,0-0.1-1.5-0.1-2.5V413.5h3.5v14.3h-3.5l-4-6.701
        c-0.5-1-1.3-2.5-1.3-2.5l0,0c0,0,0.1,1.5,0.1,2.5v6.701h-3.5V413.5z"/>
      <path fill="#F79421" d="M675.8,413.2c3.601,0,5.5,1.899,5.5,1.899l-1.6,2.601c0,0-1.5-1.4-3.5-1.4c-3,0-4.3,1.9-4.3,4
        c0,2.799,1.899,4.4,4.1,4.4c1.6,0,2.9-1,2.9-1v-1.102h-2v-3h5.199v8.201H679.2v-0.4c0-0.301,0-0.6,0-0.6l0,0
        c0,0-1.4,1.299-3.8,1.299c-3.601,0-7-2.799-7-7.398C668.2,416.5,671.4,413.2,675.8,413.2z"/>
      <path fill="#F79421" d="M687.7,413.5h6c2.8,0,4.6,2,4.6,4.9c0,2.9-1.899,5-4.6,5h-2.5v4.4h-3.5V413.5z M693,420.4
        c1.3,0,1.9-0.9,1.9-2c0-1.101-0.601-1.9-1.801-1.9h-1.8v3.9H693z"/>
      <path fill="#F79421" d="M699.7,413.5h3.5v11.3h5.899v3H699.7V413.5z"/>
      <path fill="#F79421" d="M718,424.9h-4.5l-0.9,3H709l4.9-14.3h3.6l4.9,14.3H718.8L718,424.9z M715.7,416.7c0,0-0.4,1.5-0.601,2.5
        L714.2,422h2.899l-0.8-2.799C716,418.4,715.7,416.7,715.7,416.7L715.7,416.7z"/>
      <path fill="#F79421" d="M723.3,413.5h3.5l4,6.701c0.5,1,1.3,2.5,1.3,2.5l0,0c0,0-0.1-1.5-0.1-2.5V413.5h3.5v14.3h-3.6l-4-6.701
        c-0.5-1-1.301-2.5-1.301-2.5l0,0c0,0,0.101,1.5,0.101,2.5v6.701h-3.5L723.3,413.5L723.3,413.5z"/>
    </g>
    <g>
      <path fill="#3BBB9A" d="M22.4,507h-4.5l-0.9,3h-3.6l4.9-14.299h3.6L26.8,510h-3.6L22.4,507z M20.1,498.9c0,0-0.4,1.5-0.6,2.5
        l-0.9,2.801h2.9l-0.8-2.801C20.5,500.4,20.1,498.9,20.1,498.9L20.1,498.9z"/>
      <path fill="#3BBB9A" d="M27.7,495.701h3.5l4,6.699c0.5,1,1.3,2.5,1.3,2.5l0,0c0,0-0.1-1.5-0.1-2.5v-6.699h3.5V510h-3.5l-4-6.699
        c-0.5-1-1.3-2.5-1.3-2.5l0,0c0,0,0.1,1.5,0.1,2.5V510h-3.5V495.701z"/>
      <path fill="#3BBB9A" d="M49.5,507H45l-0.9,3h-3.6l4.9-14.299H49L53.9,510h-3.6L49.5,507z M47.3,498.9c0,0-0.4,1.5-0.6,2.5
        l-0.9,2.801h2.9l-0.8-2.801C47.6,500.4,47.4,498.9,47.3,498.9L47.3,498.9z"/>
      <path fill="#3BBB9A" d="M54.8,495.701h3.5V507h5.9v3h-9.4V495.701z"/>
      <path fill="#3BBB9A" d="M67.4,504.099l-4.8-8.5h4l1.6,3.5c0.5,1,0.9,2,0.9,2l0,0c0,0,0.4-1.1,0.9-2l1.6-3.5h4l-4.8,8.5v5.9h-3.5
        v-5.9H67.4z"/>
      <path fill="#3BBB9A" d="M75.5,507.8l5.5-7.9c0.6-0.9,1.1-1.301,1.1-1.301l0,0c0,0-0.5,0-1.1,0h-5.3v-3h10.8v2.102l-5.5,7.898
        c-0.6,0.9-1.1,1.301-1.1,1.301l0,0c0,0,0.5,0,1.1,0h5.7v3H75.5V507.8z"/>
      <path fill="#3BBB9A" d="M88.5,495.701h9v3H92v2.6h4.4v3H92v2.799h5.8v3h-9.3V495.701z"/>
      <path fill="#3BBB9A" d="M104.7,502.4L104.7,502.4c0,0-1.6-0.801-1.6-3.1c0-2.801,2.4-3.9,4.8-3.9c1,0,2,0.301,2,0.301l-0.8,2.799
        c0,0-0.4-0.1-0.8-0.1c-0.9,0-1.6,0.5-1.6,1.5c0,0.801,0.5,1.4,1.5,1.4h1.8V499.5h3.5v1.801h1.8v3h-1.8v1.4c0,2.5-2,4.6-5.5,4.6
        c-3.3,0-5.4-2-5.4-4.4C102.3,504.3,103.3,502.9,104.7,502.4z M107.7,507.099c1.4,0,2-0.799,2-1.6v-1.1h-2c-0.9,0-1.8,0.4-1.8,1.4
        C105.9,506.5,106.7,507.099,107.7,507.099z"/>
      <path fill="#3BBB9A" d="M126.9,495.4c4.4,0,7.5,3.301,7.5,7.301c0,4.299-3.1,7.5-7.5,7.5s-7.5-3.301-7.5-7.5
        C119.4,498.5,122.5,495.4,126.9,495.4z M126.9,507.099c2.1,0,3.9-1.898,3.9-4.299s-1.8-4.1-3.9-4.1s-3.9,1.799-3.9,4.1
        C123,505.201,124.8,507.099,126.9,507.099z"/>
      <path fill="#3BBB9A" d="M136,495.701h6c2.8,0,4.6,2,4.6,4.898c0,2.9-1.9,5-4.6,5h-2.5v4.4H136V495.701z M141.2,502.599
        c1.3,0,1.9-0.898,1.9-2c0-1.1-0.6-1.898-1.8-1.898h-1.8v3.898H141.2z"/>
      <path fill="#3BBB9A" d="M150.7,498.701h-4.4v-3h12.2v3h-4.4V510h-3.6v-11.299H150.7z"/>
      <path fill="#3BBB9A" d="M159.6,495.701h3.5V510h-3.5V495.701z"/>
      <path fill="#3BBB9A" d="M166.4,495.701h3.8l2.1,6c0.4,0.898,0.8,2.398,0.8,2.398l0,0c0,0,0.4-1.5,0.8-2.398l2.1-6h3.8L180.9,510
        h-3.5l-0.5-6.5c-0.1-1.1,0-2.4,0-2.4l0,0c0,0-0.5,1.5-0.8,2.4l-1.5,4.1h-3l-1.5-4.1c-0.4-0.9-0.8-2.4-0.8-2.4l0,0
        c0,0,0.1,1.4,0,2.4l-0.5,6.5h-3.5L166.4,495.701z"/>
      <path fill="#3BBB9A" d="M183,495.701h3.5V510H183V495.701z"/>
      <path fill="#3BBB9A" d="M188.2,507.8l5.5-7.9c0.6-0.9,1.1-1.301,1.1-1.301l0,0c0,0-0.5,0-1.1,0h-5.2v-3h10.8v2.102l-5.5,7.898
        c-0.6,0.9-1.1,1.301-1.1,1.301l0,0c0,0,0.5,0,1.1,0h5.7v3h-11.2L188.2,507.8L188.2,507.8z"/>
      <path fill="#3BBB9A" d="M201.2,495.701h9v3h-5.5v2.6h4.4v3h-4.4v2.799h5.8v3h-9.3V495.701L201.2,495.701z"/>
      <path fill="#3BBB9A" d="M56.8,529.5c0,0,1.6,1.5,3.4,1.5c0.8,0,1.5-0.299,1.5-1.1c0-1.801-6.5-1.6-6.5-6c0-2.6,2.3-4.4,5-4.4
        c3.1,0,4.6,1.6,4.6,1.6l-1.5,2.9c0,0-1.5-1.299-3.1-1.299c-0.8,0-1.5,0.398-1.5,1.1c0,1.799,6.5,1.5,6.5,6c0,2.4-1.9,4.5-5,4.5
        c-3.4,0-5.3-2-5.3-2L56.8,529.5z"/>
      <path fill="#3BBB9A" d="M74.1,530.8h-4.5l-0.9,3h-3.6L70,519.5h3.6l4.9,14.4h-3.6L74.1,530.8z M71.9,522.8c0,0-0.4,1.5-0.6,2.5
        l-0.9,2.799h2.9l-0.8-2.799C72.3,524.3,71.9,522.8,71.9,522.8L71.9,522.8z"/>
      <path fill="#3BBB9A" d="M79.4,519.5h3.5V530.8h5.9v3h-9.4V519.5z"/>
      <path fill="#3BBB9A" d="M90,519.5h9v3h-5.5v2.6h4.4v3h-4.4v2.801h5.8v3H90V519.5z"/>
      <path fill="#3BBB9A" d="M101.7,529.5c0,0,1.6,1.5,3.4,1.5c0.8,0,1.5-0.299,1.5-1.1c0-1.801-6.5-1.6-6.5-6c0-2.6,2.3-4.4,5-4.4
        c3.1,0,4.6,1.6,4.6,1.6l-1.5,2.9c0,0-1.5-1.299-3.1-1.299c-0.8,0-1.5,0.398-1.5,1.1c0,1.799,6.5,1.5,6.5,6c0,2.4-1.9,4.5-5,4.5
        c-3.4,0-5.3-2-5.3-2L101.7,529.5z"/>
      <path fill="#3BBB9A" d="M115.6,519.5h6c2.8,0,4.6,2,4.6,4.9s-1.9,5-4.6,5h-2.5v4.4h-3.5V519.5z M120.9,526.4c1.3,0,1.9-0.9,1.9-2
        s-0.6-1.9-1.8-1.9h-1.8v3.9H120.9z"/>
      <path fill="#3BBB9A" d="M127.5,519.5h5c1.5,0,2.1,0.1,2.8,0.4c1.6,0.6,2.6,2.1,2.6,4.1c0,1.5-0.8,3.1-2.1,3.9l0,0
        c0,0,0.3,0.301,0.5,0.9l2.8,5h-3.9l-2.5-4.9h-1.6v4.9h-3.6V519.5z M132.6,526.099c1.1,0,1.9-0.6,1.9-1.799
        c0-1.1-0.4-1.801-2.1-1.801h-1.1v3.5L132.6,526.099L132.6,526.099z"/>
      <path fill="#3BBB9A" d="M140.5,519.5h3.5V533.8h-3.5V519.5z"/>
      <path fill="#3BBB9A" d="M153.1,519.3c3.5,0,5.4,2,5.4,2l-1.6,2.6c0,0-1.6-1.5-3.6-1.5c-2.8,0-4,2-4,4.1s1.4,4.301,4,4.301
        c2.1,0,3.8-1.801,3.8-1.801l1.8,2.5c0,0-2,2.4-5.8,2.4c-4.5,0-7.5-3.1-7.5-7.4C145.5,522.4,148.8,519.3,153.1,519.3z"/>
      <path fill="#3BBB9A" d="M160.2,519.5h9v3h-5.5v2.6h4.4v3h-4.4v2.801h5.8v3h-9.3V519.5L160.2,519.5z"/>
    </g>
    <g>
      <path fill="#BCBEC0" d="M551.5,603.201h3.5l4,6.699c0.5,1,1.3,2.5,1.3,2.5l0,0c0,0-0.1-1.5-0.1-2.5v-6.699h3.5V617.5h-3.5
        l-4-6.699c-0.5-1-1.3-2.5-1.3-2.5l0,0c0,0,0.1,1.5,0.1,2.5v6.699h-3.5V603.201z"/>
      <path fill="#BCBEC0" d="M566.2,603.201h9v3h-5.5v2.6h4.399v3H569.7v2.799h5.8v3h-9.3V603.201z"/>
      <path fill="#BCBEC0" d="M583.8,603c3.601,0,5.5,1.9,5.5,1.9l-1.6,2.6c0,0-1.5-1.4-3.5-1.4c-3,0-4.3,1.9-4.3,4
        c0,2.801,1.899,4.4,4.1,4.4c1.6,0,2.9-1,2.9-1v-1.1h-2v-3h5.199v8.199H587.2v-0.398c0-0.301,0-0.602,0-0.602l0,0
        c0,0-1.4,1.301-3.8,1.301c-3.601,0-7-2.801-7-7.4C576.3,606.099,579.5,603,583.8,603z"/>
      <path fill="#BCBEC0" d="M598.5,603c4.4,0,7.5,3.301,7.5,7.301c0,4.299-3.1,7.5-7.5,7.5s-7.5-3.301-7.5-7.5
        C591,606.099,594.1,603,598.5,603z M598.5,614.5c2.1,0,3.9-1.9,3.9-4.299c0-2.4-1.801-4.102-3.9-4.102s-3.9,1.801-3.9,4.102
        C594.6,612.8,596.4,614.5,598.5,614.5z"/>
      <path fill="#BCBEC0" d="M610.3,606.201H605.9v-3H618.1v3H613.7V617.5h-3.5L610.3,606.201L610.3,606.201z"/>
      <path fill="#BCBEC0" d="M619.2,603.201h3.5V617.5h-3.5V603.201z"/>
      <path fill="#BCBEC0" d="M632.4,614.5h-4.5l-0.9,3h-3.6l4.899-14.299h3.601L636.8,617.5h-3.6L632.4,614.5z M630.3,606.5
        c0,0-0.399,1.5-0.6,2.5l-0.9,2.801h2.9L630.9,609C630.5,608,630.3,606.5,630.3,606.5L630.3,606.5z"/>
      <path fill="#BCBEC0" d="M639.8,606.201H635.4v-3H647.6v3H643.2V617.5h-3.5L639.8,606.201L639.8,606.201z"/>
      <path fill="#BCBEC0" d="M648.6,603.201h3.5V617.5h-3.5V603.201z"/>
      <path fill="#BCBEC0" d="M654.7,603.201h3.5l4,6.699c0.5,1,1.3,2.5,1.3,2.5l0,0c0,0-0.1-1.5-0.1-2.5v-6.699h3.5V617.5h-3.5
        l-4-6.699c-0.5-1-1.301-2.5-1.301-2.5l0,0c0,0,0.101,1.5,0.101,2.5v6.699h-3.5V603.201z"/>
      <path fill="#BCBEC0" d="M676,603c3.6,0,5.5,1.9,5.5,1.9l-1.6,2.6c0,0-1.5-1.4-3.5-1.4c-3,0-4.301,1.9-4.301,4
        c0,2.801,1.9,4.4,4.101,4.4c1.6,0,2.899-1,2.899-1v-1.1h-2v-3h5.2v8.199H679.4v-0.398c0-0.301,0-0.602,0-0.602l0,0
        c0,0-1.4,1.301-3.801,1.301c-3.6,0-7-2.801-7-7.4C668.5,606.099,671.6,603,676,603z"/>
      <path fill="#BCBEC0" d="M694.5,603c4.4,0,7.5,3.301,7.5,7.301c0,4.299-3.1,7.5-7.5,7.5s-7.5-3.301-7.5-7.5
        C687,606.099,690.1,603,694.5,603z M694.5,614.5c2.1,0,3.9-1.9,3.9-4.299c0-2.4-1.801-4.102-3.9-4.102s-3.9,1.801-3.9,4.102
        C690.6,612.8,692.2,614.5,694.5,614.5z"/>
      <path fill="#BCBEC0" d="M703.5,603.201h8.8v3H707v3h4.4v3H707v5.299h-3.5V603.201z"/>
      <path fill="#BCBEC0" d="M713.7,603.201h8.8v3h-5.3v3h4.399v3H717.2v5.299h-3.5V603.201z"/>
      <path fill="#BCBEC0" d="M724,603.201h9v3h-5.5v2.6h4.4v3h-4.4v2.799h5.8v3H724V603.201L724,603.201z"/>
      <path fill="#BCBEC0" d="M735.1,603.201h5c1.5,0,2.101,0.1,2.801,0.398c1.6,0.602,2.6,2.102,2.6,4.102c0,1.5-0.8,3.1-2.1,3.898l0,0
        c0,0,0.3,0.301,0.5,0.9l2.8,5h-3.9l-2.5-4.9h-1.6v4.9h-3.5v-14.299H735.1L735.1,603.201z M740.1,609.701
        c1.101,0,1.9-0.602,1.9-1.801c0-1.1-0.4-1.801-2.1-1.801H738.8v3.5L740.1,609.701L740.1,609.701z"/>
      <path fill="#BCBEC0" d="M748.8,613c0,0,1.601,1.5,3.4,1.5c0.8,0,1.5-0.299,1.5-1.1c0-1.801-6.5-1.6-6.5-6c0-2.6,2.3-4.4,5-4.4
        c3.1,0,4.6,1.6,4.6,1.6l-1.5,2.9c0,0-1.5-1.299-3.1-1.299c-0.8,0-1.5,0.398-1.5,1.1c0,1.799,6.5,1.5,6.5,6c0,2.4-1.9,4.5-5,4.5
        c-3.4,0-5.3-2-5.3-2L748.8,613z"/>
    </g>
    <g>
      <path fill="#1072BA" d="M41.7,688.201h-4.4v-3h12.2v3h-4.4V699.5h-3.5v-11.299H41.7z"/>
      <path fill="#1072BA" d="M50.5,685.099h5c1.5,0,2.1,0.102,2.8,0.4c1.6,0.6,2.6,2.1,2.6,4.1c0,1.5-0.8,3.102-2.1,3.9l0,0
        c0,0,0.3,0.301,0.5,0.9l2.8,5h-3.8l-2.5-4.9h-1.6v4.9h-3.5v-14.301H50.5L50.5,685.099z M55.5,691.701c1.1,0,1.9-0.602,1.9-1.801
        c0-1.1-0.4-1.801-2.1-1.801h-1.1v3.5L55.5,691.701L55.5,691.701z"/>
      <path fill="#1072BA" d="M70.8,696.599h-4.5l-0.9,3h-3.6l4.9-14.299h3.6l4.9,14.299h-3.7L70.8,696.599z M68.5,688.4
        c0,0-0.4,1.5-0.6,2.5l-0.9,2.801h2.9l-0.8-2.801C68.9,690,68.5,688.4,68.5,688.4L68.5,688.4z"/>
      <path fill="#1072BA" d="M76,685.099h3.5l4,6.701c0.5,1,1.3,2.5,1.3,2.5l0,0c0,0-0.1-1.5-0.1-2.5v-6.701h3.5V699.4h-3.5l-4-6.699
        c-0.5-1-1.3-2.5-1.3-2.5l0,0c0,0,0.1,1.5,0.1,2.5v6.699H76V685.099z"/>
      <path fill="#1072BA" d="M91.5,695.099c0,0,1.6,1.5,3.4,1.5c0.8,0,1.5-0.299,1.5-1.1c0-1.799-6.5-1.6-6.5-6c0-2.6,2.3-4.4,5-4.4
        c3.1,0,4.6,1.602,4.6,1.602l-1.5,2.898c0,0-1.5-1.299-3.1-1.299c-0.8,0-1.5,0.4-1.5,1.1c0,1.801,6.5,1.5,6.5,6
        c0,2.4-1.9,4.5-5,4.5c-3.4,0-5.3-2-5.3-2L91.5,695.099z"/>
      <path fill="#1072BA" d="M108.8,696.599h-4.5l-0.9,3h-3.6l4.9-14.299h3.6l4.9,14.299h-3.6L108.8,696.599z M106.6,688.4
        c0,0-0.4,1.5-0.6,2.5l-0.9,2.801h2.9l-0.8-2.801C106.9,690,106.6,688.4,106.6,688.4L106.6,688.4z"/>
      <path fill="#1072BA" d="M120.6,684.9c3.5,0,5.4,2,5.4,2l-1.6,2.6c0,0-1.6-1.5-3.6-1.5c-2.8,0-4,2-4,4.1c0,2.102,1.4,4.301,4,4.301
        c2.1,0,3.8-1.801,3.8-1.801l1.8,2.5c0,0-2,2.4-5.8,2.4c-4.5,0-7.5-3.1-7.5-7.4C113.1,688.201,116.2,684.9,120.6,684.9z"/>
      <path fill="#1072BA" d="M130.4,688.201H126v-3h12.2v3h-4.4V699.5h-3.5v-11.299H130.4z"/>
      <path fill="#1072BA" d="M139.2,685.099h3.5V699.4h-3.5V685.099z"/>
      <path fill="#1072BA" d="M151.9,684.9c4.4,0,7.5,3.301,7.5,7.301c0,4.299-3.1,7.5-7.5,7.5s-7.5-3.301-7.5-7.5
        C144.4,688.201,147.5,684.9,151.9,684.9z M151.9,696.599c2.1,0,3.9-1.898,3.9-4.299s-1.8-4.1-3.9-4.1S148,690,148,692.3
        C148,694.701,149.8,696.599,151.9,696.599z"/>
      <path fill="#1072BA" d="M161,685.099h3.5l4,6.701c0.5,1,1.3,2.5,1.3,2.5l0,0c0,0-0.1-1.5-0.1-2.5v-6.701h3.5V699.4h-3.5l-4-6.699
        c-0.5-1-1.3-2.5-1.3-2.5l0,0c0,0,0.1,1.5,0.1,2.5v6.699H161V685.099z"/>
      <path fill="#1072BA" d="M54.8,709h5c1.5,0,2.1,0.1,2.8,0.4c1.6,0.6,2.6,2.1,2.6,4.1c0,1.5-0.8,3.1-2.1,3.9l0,0
        c0,0,0.3,0.301,0.5,0.9l2.8,5h-3.9l-2.5-4.9h-1.6v4.9h-3.5V709H54.8z M59.9,715.5c1.1,0,1.9-0.6,1.9-1.799
        c0-1.102-0.4-1.801-2.1-1.801h-1.4v3.5L59.9,715.5L59.9,715.5z"/>
      <path fill="#1072BA" d="M74.3,708.8c4.4,0,7.5,3.299,7.5,7.299c0,4.301-3.1,7.5-7.5,7.5c-4.4,0-7.5-3.299-7.5-7.5
        C66.7,712,69.9,708.8,74.3,708.8z M74.3,720.4c2.1,0,3.9-1.9,3.9-4.301c0-2.398-1.8-4.1-3.9-4.1c-2.1,0-3.9,1.801-3.9,4.1
        C70.4,718.599,72.1,720.4,74.3,720.4z"/>
      <path fill="#1072BA" d="M90.5,720.4H86l-0.9,3h-3.7l4.9-14.301h3.6l4.9,14.301h-3.6L90.5,720.4z M88.2,712.3c0,0-0.4,1.5-0.6,2.5
        l-0.9,2.799h2.9l-0.8-2.799C88.6,713.9,88.2,712.3,88.2,712.3L88.2,712.3z"/>
      <path fill="#1072BA" d="M95.8,709h5.2c4.5,0,7.4,2.6,7.4,7.201c0,4.5-2.9,7.199-7.4,7.199h-5.2V709z M100.8,720.4
        c2.4,0,3.9-1.5,3.9-4.1c0-2.801-1.5-4.1-3.9-4.1h-1.5v8.299L100.8,720.4L100.8,720.4z"/>
      <path fill="#1072BA" d="M109.6,716.201h6.3v3h-6.3V716.201z"/>
      <path fill="#1072BA" d="M118.8,709h3.7l2.1,6c0.4,0.9,0.8,2.4,0.8,2.4l0,0c0,0,0.4-1.5,0.8-2.4l2.1-6h3.8l1.1,14.301h-3.5
        l-0.5-6.5c-0.1-1.1,0-2.4,0-2.4l0,0c0,0-0.5,1.5-0.8,2.4l-1.5,4.1h-3l-1.5-4.1c-0.4-0.9-0.8-2.4-0.8-2.4l0,0c0,0,0.1,1.4,0,2.4
        l-0.5,6.5h-3.5L118.8,709z"/>
      <path fill="#1072BA" d="M142.6,720.4h-4.5l-0.9,3h-3.6l4.9-14.301h3.6L147,723.4h-3.6L142.6,720.4z M140.4,712.3
        c0,0-0.4,1.5-0.6,2.5l-0.9,2.799h2.9L141,714.8C140.7,713.9,140.4,712.3,140.4,712.3L140.4,712.3z"/>
      <path fill="#1072BA" d="M147.9,709h6c2.8,0,4.6,2,4.6,4.9s-1.9,5-4.6,5h-2.5v4.4h-3.5V709z M153.2,715.9c1.3,0,1.9-0.9,1.9-2
        s-0.6-1.9-1.8-1.9h-1.8v3.9H153.2z"/>
    </g>
    <g>
      <path fill="#808285" d="M429.9,117.7c0-0.4,0.1-0.5,0.5-0.5h0.399c0.3,0,0.5,0.1,0.5,0.5v12.4h6c0.4,0,0.5,0.1,0.5,0.5v0.3
        c0,0.4-0.1,0.5-0.5,0.5h-7c-0.399,0-0.5-0.1-0.5-0.5v-13.2H429.9z"/>
      <path fill="#808285" d="M442.7,121c2.6,0,4.3,2,4.3,4.8c0,0.3-0.3,0.5-0.5,0.5h-7.4c0,2.5,1.9,4,3.9,4c1.3,0,2.1-0.5,2.6-0.9
        c0.301-0.1,0.5-0.1,0.601,0.1l0.1,0.3c0.101,0.3,0.101,0.5-0.1,0.6c-0.5,0.4-1.8,1.1-3.4,1.1c-3,0-5.3-2.1-5.3-5.3
        C437.7,123,439.9,121,442.7,121z M445.5,125.2c-0.1-2.1-1.4-3.1-2.9-3.1c-1.6,0-3.1,1.1-3.5,3.1H445.5z"/>
      <path fill="#808285" d="M448.8,122.5H447.9c-0.4,0-0.5-0.1-0.5-0.5v-0.1c0-0.4,0.1-0.5,0.5-0.5h0.899V119c0-0.4,0.101-0.5,0.5-0.5
        h0.4c0.399,0,0.5,0.1,0.5,0.5v2.4h2c0.399,0,0.5,0.1,0.5,0.5v0.1c0,0.4-0.101,0.5-0.5,0.5h-2v5c0,2.4,1.399,2.6,2.3,2.6
        c0.4,0,0.5,0.1,0.5,0.5v0.3c0,0.4-0.1,0.5-0.5,0.5c-2.3,0-3.5-1.4-3.5-3.8v-5.2h-0.2V122.5L448.8,122.5z"/>
      <path fill="#808285" d="M453.6,120.6l0.801-3.1c0-0.3,0.3-0.4,0.5-0.4h0.399c0.4,0,0.5,0.3,0.4,0.5l-1,3.1
        c-0.101,0.3-0.3,0.4-0.5,0.4H454.1C453.6,121.1,453.5,120.8,453.6,120.6z"/>
      <path fill="#808285" d="M456.3,129.7l0.101-0.3c0.1-0.3,0.399-0.3,0.6-0.1c0.5,0.4,1.4,0.9,2.6,0.9c1.101,0,2-0.5,2-1.6
        c0-2.3-5.399-1.6-5.399-4.9c0-1.9,1.6-2.9,3.399-2.9c1.5,0,2.4,0.5,2.801,0.9c0.3,0.1,0.3,0.4,0.1,0.6l-0.1,0.3
        c-0.101,0.3-0.4,0.3-0.601,0.1c-0.399-0.3-1.1-0.6-2.1-0.6s-2,0.5-2,1.5c0,2.4,5.399,1.6,5.399,5c0,1.6-1.399,2.9-3.399,2.9
        c-1.8,0-2.9-0.8-3.4-1.1C456.1,130.3,456.1,130,456.3,129.7z"/>
      <path fill="#808285" d="M468.9,117.7c0-0.4,0.1-0.5,0.5-0.5h0.399c0.4,0,0.5,0.1,0.5,0.5v11.1c0,1.3,0.601,1.4,1,1.5
        c0.3,0,0.4,0.1,0.4,0.5v0.3c0,0.3-0.101,0.5-0.5,0.5c-0.9,0-2.3-0.3-2.3-2.5V117.7L468.9,117.7z"/>
      <path fill="#808285" d="M477.6,121c3,0,5.4,2.3,5.4,5.3s-2.4,5.4-5.3,5.4c-3,0-5.4-2.3-5.4-5.4C472.3,123.2,474.7,121,477.6,121z
         M477.6,130.4c2.101,0,3.9-1.8,3.9-4.1c0-2.3-1.8-4-3.9-4c-2.1,0-3.899,1.8-3.899,4C473.7,128.6,475.5,130.4,477.6,130.4z"/>
      <path fill="#808285" d="M489.2,121c3,0,5.399,2.3,5.399,5.3s-2.399,5.4-5.3,5.4c-3,0-5.399-2.3-5.399-5.4
        C483.9,123.2,486.3,121,489.2,121z M489.2,130.4c2.1,0,3.899-1.8,3.899-4.1c0-2.3-1.8-4-3.899-4c-2.101,0-3.9,1.8-3.9,4
        C485.3,128.6,487,130.4,489.2,130.4z"/>
      <path fill="#808285" d="M496.2,117.7c0-0.4,0.1-0.5,0.5-0.5h0.399c0.4,0,0.5,0.1,0.5,0.5v7.4h1.601l2.8-3.5
        c0.1-0.3,0.4-0.3,0.6-0.3h0.5c0.4,0,0.5,0.3,0.301,0.6l-3,3.8l0,0l3.5,5c0.3,0.4,0.1,0.6-0.4,0.6H503c-0.3,0-0.5-0.1-0.6-0.4
        l-3.101-4.6h-1.6v4.5c0,0.4-0.101,0.5-0.5,0.5h-0.4c-0.399,0-0.5-0.1-0.5-0.5L496.2,117.7L496.2,117.7z"/>
      <path fill="#808285" d="M514.7,125.1h0.6v-0.4c0-2-1-2.6-2.5-2.6c-1.1,0-2,0.4-2.5,0.8c-0.3,0.1-0.5,0.1-0.6-0.1l-0.101-0.3
        c-0.1-0.3-0.1-0.5,0.101-0.6c0.5-0.4,1.6-0.9,3.3-0.9c2.4,0,3.8,1.4,3.8,3.9v6c0,0.4-0.1,0.5-0.5,0.5H515.9
        c-0.4,0-0.5-0.1-0.5-0.5v-0.8c0-0.5,0-0.8,0-0.8l0,0c0,0-0.9,2.3-3.4,2.3c-1.8,0-3.4-1-3.4-3C508.4,125.4,512.7,125.1,514.7,125.1
        z M512.2,130.4c2,0,3.1-2,3.1-3.8v-0.5h-0.5c-1.6,0-4.8,0-4.8,2.4C509.9,129.4,510.7,130.4,512.2,130.4z"/>
      <path fill="#808285" d="M519,122.5h-0.8c-0.4,0-0.5-0.1-0.5-0.5v-0.1c0-0.4,0.1-0.5,0.5-0.5h0.899V119c0-0.4,0.101-0.5,0.5-0.5
        h0.4c0.4,0,0.5,0.1,0.5,0.5v2.4h2c0.4,0,0.5,0.1,0.5,0.5v0.1c0,0.4-0.1,0.5-0.5,0.5h-2v5c0,2.4,1.4,2.6,2.3,2.6
        c0.4,0,0.5,0.1,0.5,0.5v0.3c0,0.4-0.1,0.5-0.5,0.5c-2.3,0-3.5-1.4-3.5-3.8v-5.2H519V122.5z"/>
      <path fill="#808285" d="M528.5,117.7c0-0.4,0.1-0.5,0.5-0.5h0.4c0.399,0,0.5,0.1,0.5,0.5v5c0,0.5-0.101,0.9-0.101,0.9l0,0
        c0.4-1,1.8-2.6,4-2.6c2.5,0,3.4,1.4,3.4,3.9v5.9c0,0.4-0.101,0.5-0.5,0.5h-0.4c-0.399,0-0.5-0.1-0.5-0.5v-5.5c0-1.6-0.3-3-2.3-3
        c-2.1,0-3.8,1.8-3.8,4.1v4.4c0,0.4-0.101,0.5-0.5,0.5h-0.4c-0.399,0-0.5-0.1-0.5-0.5v-13.1H528.5z"/>
      <path fill="#808285" d="M544.1,121c3,0,5.4,2.3,5.4,5.3s-2.4,5.4-5.3,5.4c-3,0-5.4-2.3-5.4-5.4C538.7,123.2,541.1,121,544.1,121z
         M544.1,130.4c2.101,0,3.9-1.8,3.9-4.1c0-2.3-1.8-4-3.9-4c-2.1,0-3.899,1.8-3.899,4C540.1,128.6,542,130.4,544.1,130.4z"/>
      <path fill="#808285" d="M549.9,121.7c-0.101-0.4,0-0.5,0.399-0.5h0.4c0.3,0,0.5,0.1,0.5,0.4l2.3,7.2c0.1,0.5,0.3,1.1,0.3,1.1l0,0
        c0,0,0.101-0.6,0.4-1.1l2.399-7.2c0.101-0.3,0.301-0.4,0.5-0.4h0.5c0.301,0,0.5,0.1,0.5,0.4l2.4,7.2c0.1,0.5,0.4,1.1,0.4,1.1l0,0
        c0,0,0.1-0.6,0.3-1.1l2.3-7.2c0.1-0.3,0.3-0.4,0.5-0.4h0.4c0.399,0,0.5,0.3,0.399,0.5l-3.1,9.2c-0.1,0.3-0.3,0.4-0.5,0.4h-0.6
        c-0.301,0-0.5-0.1-0.5-0.4l-2.4-6.8c-0.1-0.5-0.3-1.1-0.3-1.1l0,0c0,0-0.101,0.6-0.4,1.1l-2,6.8c-0.1,0.3-0.3,0.4-0.5,0.4h-1
        c-0.3,0-0.5-0.1-0.6-0.4L549.9,121.7z"/>
      <path fill="#808285" d="M570.4,117.7c0-0.4,0.1-0.5,0.5-0.5h0.399c0.4,0,0.5,0.1,0.5,0.5v4.5c0,0.5-0.1,0.9-0.1,0.9l0,0
        c0,0,0.899-2,3.5-2c2.8,0,4.399,2.1,4.399,5.3c0,3.3-1.899,5.3-4.5,5.3c-2.5,0-3.399-2.1-3.399-2.1l0,0c0,0,0.1,0.3,0.1,0.8v0.6
        c0,0.3-0.1,0.5-0.5,0.5H570.9c-0.4,0-0.5-0.1-0.5-0.5V117.7L570.4,117.7z M574.9,130.4c1.8,0,3.3-1.5,3.3-4s-1.4-4-3.101-4
        c-1.6,0-3.3,1.3-3.3,4C571.7,128.4,572.7,130.4,574.9,130.4z"/>
      <path fill="#808285" d="M581.2,121.7c0-0.4,0.1-0.5,0.5-0.5h0.399c0.4,0,0.5,0.1,0.5,0.5v5.5c0,1.6,0.301,3,2.101,3
        c2.3,0,3.8-2,3.8-4.3v-4.4c0-0.4,0.1-0.5,0.5-0.5h0.4c0.399,0,0.5,0.1,0.5,0.5v9.2c0,0.4-0.101,0.5-0.5,0.5H589
        c-0.4,0-0.5-0.1-0.5-0.5v-1.1c0-0.4,0-0.8,0-0.8l0,0c-0.4,1-1.8,2.6-4,2.6c-2.4,0-3.4-1.3-3.4-3.9v-5.9h0.101V121.7L581.2,121.7z"
        />
      <path fill="#808285" d="M591.5,134c0.3,0.1,0.5,0.3,0.9,0.3c0.899,0,1.5-0.8,1.899-1.6l0.601-1.4l-4-9.4
        c-0.101-0.4,0-0.6,0.399-0.6h0.5c0.3,0,0.5,0.1,0.5,0.4l2.9,7c0.1,0.5,0.399,1,0.399,1l0,0c0,0,0.101-0.5,0.4-1l2.8-7
        c0.101-0.3,0.3-0.4,0.5-0.4h0.5c0.4,0,0.5,0.3,0.4,0.6l-4.8,11.6c-0.5,1.3-1.5,2.1-2.9,2.1c-0.6,0-1-0.3-1.4-0.4
        c-0.3-0.1-0.399-0.4-0.3-0.6l0.101-0.3C591,134,591.2,134,591.5,134z"/>
      <path fill="#808285" d="M605.4,121c2.6,0,4.3,2,4.3,4.8c0,0.3-0.3,0.5-0.5,0.5h-7.3c0,2.5,1.899,4,3.899,4
        c1.3,0,2.101-0.5,2.601-0.9c0.3-0.1,0.5-0.1,0.6,0.1l0.1,0.3c0.101,0.3,0.101,0.5-0.1,0.6c-0.5,0.4-1.8,1.1-3.4,1.1
        c-3,0-5.3-2.1-5.3-5.3C600.4,123,602.6,121,605.4,121z M608.3,125.2c-0.1-2.1-1.399-3.1-2.899-3.1c-1.601,0-3.101,1.1-3.5,3.1
        H608.3z"/>
      <path fill="#808285" d="M611.2,121.7c0-0.4,0.1-0.5,0.5-0.5h0.399c0.301,0,0.5,0.1,0.5,0.5v1.4c0,0.5-0.1,0.8-0.1,0.8l0,0
        c0.5-1.5,1.6-2.8,3.3-2.8c0.4,0,0.5,0.1,0.5,0.5v0.4c0,0.4-0.3,0.5-0.5,0.5c-2.1,0-3.1,2.4-3.1,4.5v3.8c0,0.4-0.101,0.5-0.5,0.5
        h-0.4c-0.399,0-0.5-0.1-0.5-0.5L611.2,121.7L611.2,121.7z"/>
      <path fill="#808285" d="M616.5,129.7l0.1-0.3c0.101-0.3,0.4-0.3,0.601-0.1c0.5,0.4,1.399,0.9,2.6,0.9c1.101,0,2-0.5,2-1.6
        c0-2.3-5.399-1.6-5.399-4.9c0-1.9,1.6-2.9,3.399-2.9c1.5,0,2.4,0.5,2.8,0.9c0.301,0.1,0.301,0.4,0.101,0.6l-0.101,0.3
        c-0.1,0.3-0.399,0.3-0.6,0.1c-0.4-0.3-1.1-0.6-2.1-0.6s-2,0.5-2,1.5c0,2.4,5.399,1.6,5.399,5c0,1.6-1.399,2.9-3.399,2.9
        c-1.801,0-2.9-0.8-3.4-1.1C616.3,130.3,616.3,130,616.5,129.7z"/>
      <path fill="#808285" d="M434,146.2h-0.8c-0.4,0-0.5-0.1-0.5-0.5v-0.1c0-0.4,0.1-0.5,0.5-0.5h0.8v-0.4c0-3.1,2.4-3.8,3.4-3.8h0.3
        c0.399,0,0.5,0.1,0.5,0.5v0.3c0,0.4-0.101,0.5-0.5,0.5c-0.9,0-2.101,0.3-2.101,2.5v0.4h5.301c0.399,0,0.5,0.1,0.5,0.5v9.2
        c0,0.4-0.101,0.5-0.5,0.5h-0.5c-0.301,0-0.5-0.1-0.5-0.5v-8.4h-4.4v8.4c0,0.4-0.1,0.5-0.5,0.5h-0.5c-0.4,0-0.5-0.1-0.5-0.5V146.2
        L434,146.2z M439.7,142.3v-0.8c0-0.4,0.1-0.5,0.5-0.5h0.5c0.399,0,0.5,0.1,0.5,0.5v0.8c0,0.4-0.101,0.5-0.5,0.5h-0.5
        C439.9,142.8,439.7,142.6,439.7,142.3z"/>
      <path fill="#808285" d="M443.4,145.6c0-0.4,0.1-0.5,0.5-0.5h0.399c0.3,0,0.5,0.1,0.5,0.5v1.1c0,0.4-0.1,0.8-0.1,0.8l0,0
        c0.399-0.9,1.8-2.6,4.1-2.6c2.5,0,3.4,1.4,3.4,3.9v5.9c0,0.4-0.101,0.5-0.5,0.5h-0.4c-0.399,0-0.5-0.1-0.5-0.5v-5.6
        c0-1.6-0.3-3-2.3-3c-2.1,0-3.9,1.8-3.9,4.1v4.4c0,0.4-0.1,0.5-0.5,0.5H443.7c-0.4,0-0.5-0.1-0.5-0.5v-9H443.4z"/>
      <path fill="#808285" d="M458.3,144.8c2.5,0,3.3,2,3.3,2l0,0c0,0,0-0.4,0-0.8v-4.5c0-0.4,0.101-0.5,0.5-0.5h0.4
        c0.4,0,0.5,0.1,0.5,0.5v13.2c0,0.4-0.1,0.5-0.5,0.5h-0.4c-0.399,0-0.5-0.1-0.5-0.5v-0.8c0-0.4,0.101-0.6,0.101-0.6l0,0
        c0,0-0.9,2.1-3.5,2.1c-2.8,0-4.4-2.1-4.4-5.3C453.7,147,455.6,144.8,458.3,144.8z M458.3,154.3c1.601,0,3.3-1.3,3.3-4
        c0-2-1-4-3.3-4c-1.8,0-3.3,1.5-3.3,4C455.1,152.6,456.4,154.3,458.3,154.3z"/>
      <path fill="#808285" d="M474.7,149h0.6v-0.4c0-2-1-2.6-2.5-2.6c-1.1,0-2,0.4-2.5,0.8c-0.3,0.1-0.5,0.1-0.6-0.1l-0.101-0.3
        c-0.1-0.3-0.1-0.5,0.101-0.6c0.5-0.4,1.6-0.9,3.3-0.9c2.4,0,3.8,1.4,3.8,3.9v6c0,0.4-0.1,0.5-0.5,0.5H475.9
        c-0.4,0-0.5-0.1-0.5-0.5V154c0-0.5,0-0.8,0-0.8l0,0c0,0-0.9,2.3-3.4,2.3c-1.8,0-3.4-1-3.4-3C468.6,149.2,472.8,149,474.7,149z
         M472.2,154.3c2,0,3.1-2,3.1-3.8V150h-0.5c-1.6,0-4.8,0-4.8,2.4C470,153.2,470.7,154.3,472.2,154.3z"/>
      <path fill="#808285" d="M483.1,141.6c0-0.4,0.101-0.5,0.5-0.5h0.4c0.4,0,0.5,0.1,0.5,0.5v5c0,0.5-0.1,0.9-0.1,0.9l0,0
        c0.399-1,1.8-2.6,4-2.6c2.5,0,3.399,1.4,3.399,3.9v5.9c0,0.4-0.1,0.5-0.5,0.5H490.9c-0.4,0-0.5-0.1-0.5-0.5v-5.6
        c0-1.6-0.301-3-2.301-3c-2.1,0-3.8,1.8-3.8,4.1v4.4c0,0.4-0.1,0.5-0.5,0.5h-0.3c-0.4,0-0.5-0.1-0.5-0.5v-13.1h0.1V141.6
        L483.1,141.6z"/>
      <path fill="#808285" d="M498.7,144.8c3,0,5.399,2.3,5.399,5.3s-2.399,5.4-5.3,5.4c-3,0-5.399-2.3-5.399-5.4
        C493.3,147.1,495.7,144.8,498.7,144.8z M498.7,154.3c2.1,0,3.899-1.8,3.899-4.1c0-2.3-1.8-4-3.899-4c-2.101,0-3.9,1.8-3.9,4
        C494.7,152.5,496.5,154.3,498.7,154.3z"/>
      <path fill="#808285" d="M505.6,145.6c0-0.4,0.101-0.5,0.5-0.5h0.4c0.3,0,0.5,0.1,0.5,0.5v1.1c0,0.4-0.1,0.8-0.1,0.8l0,0
        c0.5-1.4,2.1-2.6,3.8-2.6c1.899,0,2.899,0.9,3.1,2.5l0,0c0.5-1.3,2-2.5,3.8-2.5c2.5,0,3.4,1.4,3.4,3.9v5.9c0,0.4-0.1,0.5-0.5,0.5
        h-0.4c-0.399,0-0.5-0.1-0.5-0.5v-5.6c0-1.6-0.399-3-2.1-3c-2,0-3.4,2.1-3.4,4.3v4.4c0,0.4-0.1,0.5-0.5,0.5H513.2
        c-0.4,0-0.5-0.1-0.5-0.5v-5.5c0-1.5-0.3-3-2.101-3c-2,0-3.5,2.1-3.5,4.3v4.4c0,0.4-0.1,0.5-0.5,0.5H506.2c-0.4,0-0.5-0.1-0.5-0.5
        v-9.4H505.6z"/>
      <path fill="#808285" d="M527.4,144.8c2.6,0,4.3,2,4.3,4.8c0,0.3-0.3,0.5-0.5,0.5h-7.3c0,2.5,1.899,4,3.899,4
        c1.3,0,2.101-0.5,2.601-0.9c0.3-0.1,0.5-0.1,0.6,0.1l0.1,0.3c0.101,0.3,0.101,0.5-0.1,0.6c-0.5,0.4-1.8,1.1-3.4,1.1
        c-3,0-5.3-2.1-5.3-5.3C522.4,146.8,524.6,144.8,527.4,144.8z M530.1,149.1C530,147,528.7,146,527.2,146
        c-1.601,0-3.101,1.1-3.5,3.1H530.1z"/>
    </g>
    <g>
      <path fill="#808285" d="M151,214.4c-0.1-0.4,0.1-0.5,0.5-0.5h0.5c0.3,0,0.5,0.1,0.5,0.5l2.6,10.6c0.1,0.8,0.4,1.5,0.4,1.5l0,0
        c0,0,0.1-0.8,0.4-1.5l2.9-10.6c0.1-0.3,0.3-0.4,0.5-0.4h0.5c0.3,0,0.5,0.1,0.5,0.4l2.9,10.6c0.3,0.8,0.4,1.5,0.4,1.5l0,0
        c0,0,0.1-0.8,0.3-1.5l2.8-10.6c0.1-0.3,0.3-0.5,0.5-0.5h0.5c0.4,0,0.5,0.3,0.4,0.5l-3.6,13.2c-0.1,0.3-0.3,0.4-0.5,0.4h-0.8
        c-0.3,0-0.5-0.1-0.5-0.4l-2.6-9.5c-0.3-0.9-0.5-2.1-0.5-2.1l0,0c0,0-0.3,1.3-0.5,2.1l-2.8,9.5c-0.1,0.3-0.3,0.4-0.5,0.4H155
        c-0.3,0-0.5-0.1-0.5-0.5L151,214.4z"/>
      <path fill="#808285" d="M169.4,214.4c0-0.4,0.1-0.5,0.5-0.5h0.4c0.4,0,0.5,0.1,0.5,0.5v5c0,0.5-0.1,0.9-0.1,0.9l0,0
        c0.4-1,1.8-2.6,4-2.6c2.5,0,3.4,1.4,3.4,3.9v5.9c0,0.4-0.1,0.5-0.5,0.5h-0.4c-0.4,0-0.5-0.1-0.5-0.5V222c0-1.6-0.3-3-2.3-3
        c-2.1,0-3.8,1.8-3.8,4.1v4.4c0,0.4-0.1,0.5-0.5,0.5h-0.4c-0.4,0-0.5-0.1-0.5-0.5v-13.1H169.4z"/>
      <path fill="#808285" d="M185.7,221.9h0.6v-0.4c0-2-1-2.6-2.5-2.6c-1.1,0-2,0.4-2.5,0.8c-0.3,0.1-0.5,0.1-0.6-0.1l-0.1-0.3
        c-0.1-0.3-0.1-0.5,0.1-0.6c0.5-0.4,1.6-0.9,3.3-0.9c2.4,0,3.8,1.4,3.8,3.9v6c0,0.4-0.1,0.5-0.5,0.5h-0.4c-0.4,0-0.5-0.1-0.5-0.5
        v-0.8c0-0.5,0-0.8,0-0.8l0,0c0,0-0.9,2.3-3.4,2.3c-1.8,0-3.4-1-3.4-3C179.6,222,183.7,221.9,185.7,221.9z M183.2,227.1
        c2,0,3.1-2,3.1-3.8v-0.5h-0.5c-1.6,0-4.8,0-4.8,2.4C181,226.1,181.7,227.1,183.2,227.1z"/>
      <path fill="#808285" d="M190.1,219.2h-0.9c-0.4,0-0.5-0.1-0.5-0.5v-0.1c0-0.4,0.1-0.5,0.5-0.5h0.9v-2.4c0-0.4,0.1-0.5,0.5-0.5h0.4
        c0.4,0,0.5,0.1,0.5,0.5v2.4h2c0.4,0,0.5,0.1,0.5,0.5v0.1c0,0.4-0.1,0.5-0.5,0.5h-2v5c0,2.4,1.4,2.6,2.3,2.6c0.4,0,0.5,0.1,0.5,0.5
        v0.3c0,0.4-0.1,0.5-0.5,0.5c-2.3,0-3.5-1.4-3.5-3.8v-5.2h-0.2V219.2z"/>
      <path fill="#808285" d="M198.9,230.8c0.3,0.1,0.5,0.3,0.9,0.3c0.9,0,1.5-0.8,1.9-1.6l0.6-1.4l-4-9.4c-0.1-0.4,0-0.6,0.4-0.6h0.5
        c0.3,0,0.5,0.1,0.5,0.4l2.9,7c0.1,0.5,0.4,1,0.4,1l0,0c0,0,0.1-0.5,0.4-1l2.8-7c0.1-0.3,0.3-0.4,0.5-0.4h0.5
        c0.4,0,0.5,0.3,0.4,0.6l-4.8,11.6c-0.5,1.3-1.5,2.1-2.9,2.1c-0.6,0-1-0.3-1.4-0.4c-0.3-0.1-0.4-0.4-0.3-0.6l0.1-0.3
        C198.4,230.8,198.7,230.8,198.9,230.8z"/>
      <path fill="#808285" d="M213.1,217.7c3,0,5.4,2.3,5.4,5.3s-2.4,5.4-5.3,5.4c-3,0-5.4-2.3-5.4-5.4
        C207.8,220,210.2,217.7,213.1,217.7z M213.1,227c2.1,0,3.9-1.8,3.9-4.1c0-2.3-1.8-4-3.9-4s-3.9,1.8-3.9,4
        C209.2,225.2,211,227,213.1,227z"/>
      <path fill="#808285" d="M219.9,218.5c0-0.4,0.1-0.5,0.5-0.5h0.4c0.4,0,0.5,0.1,0.5,0.5v5.5c0,1.6,0.3,3,2.1,3c2.3,0,3.8-2,3.8-4.3
        v-4.4c0-0.4,0.1-0.5,0.5-0.5h0.4c0.4,0,0.5,0.1,0.5,0.5v9.2c0,0.4-0.1,0.5-0.5,0.5h-0.4c-0.4,0-0.5-0.1-0.5-0.5v-1.1
        c0-0.4,0-0.8,0-0.8l0,0c-0.4,1-1.8,2.6-4,2.6c-2.4,0-3.4-1.3-3.4-3.9v-5.9h0.1V218.5L219.9,218.5z"/>
      <path fill="#808285" d="M234.5,226.5l0.1-0.3c0.1-0.3,0.4-0.3,0.6-0.1c0.5,0.4,1.4,0.9,2.6,0.9c1.1,0,2-0.5,2-1.6
        c0-2.3-5.4-1.6-5.4-4.9c0-1.9,1.6-2.9,3.4-2.9c1.5,0,2.4,0.5,2.8,0.9c0.3,0.1,0.3,0.4,0.1,0.6l-0.1,0.3c-0.1,0.3-0.4,0.3-0.6,0.1
        c-0.4-0.3-1.1-0.6-2.1-0.6s-2,0.5-2,1.5c0,2.4,5.4,1.6,5.4,5c0,1.6-1.4,2.9-3.4,2.9c-1.8,0-2.9-0.8-3.4-1.1
        C234.4,227,234.4,226.8,234.5,226.5z"/>
      <path fill="#808285" d="M243,214.4c0-0.4,0.1-0.5,0.5-0.5h0.4c0.4,0,0.5,0.1,0.5,0.5v5c0,0.5-0.1,0.9-0.1,0.9l0,0
        c0.4-1,1.8-2.6,4-2.6c2.5,0,3.4,1.4,3.4,3.9v5.9c0,0.4-0.1,0.5-0.5,0.5h-0.4c-0.4,0-0.5-0.1-0.5-0.5V222c0-1.6-0.3-3-2.3-3
        c-2.1,0-3.8,1.8-3.8,4.1v4.4c0,0.4-0.1,0.5-0.5,0.5h-0.4c-0.4,0-0.5-0.1-0.5-0.5v-13.1H243z"/>
      <path fill="#808285" d="M258.6,217.7c3,0,5.4,2.3,5.4,5.3s-2.4,5.4-5.3,5.4c-3,0-5.4-2.3-5.4-5.4
        C253.3,220,255.7,217.7,258.6,217.7z M258.6,227c2.1,0,3.9-1.8,3.9-4.1c0-2.3-1.8-4-3.9-4s-3.9,1.8-3.9,4
        C254.7,225.2,256.5,227,258.6,227z"/>
      <path fill="#808285" d="M265.4,218.5c0-0.4,0.1-0.5,0.5-0.5h0.4c0.4,0,0.5,0.1,0.5,0.5v5.5c0,1.6,0.3,3,2.1,3c2.3,0,3.8-2,3.8-4.3
        v-4.4c0-0.4,0.1-0.5,0.5-0.5h0.4c0.4,0,0.5,0.1,0.5,0.5v9.2c0,0.4-0.1,0.5-0.5,0.5h-0.4c-0.4,0-0.5-0.1-0.5-0.5v-1.1
        c0-0.4,0-0.8,0-0.8l0,0c-0.4,1-1.8,2.6-4,2.6c-2.4,0-3.4-1.3-3.4-3.9v-5.9h0.1V218.5z"/>
      <path fill="#808285" d="M276.4,214.4c0-0.4,0.1-0.5,0.5-0.5h0.4c0.4,0,0.5,0.1,0.5,0.5v11.1c0,1.3,0.6,1.4,1,1.5
        c0.3,0,0.4,0.1,0.4,0.5v0.3c0,0.3-0.1,0.5-0.5,0.5c-0.9,0-2.3-0.3-2.3-2.5V214.4L276.4,214.4z"/>
      <path fill="#808285" d="M284.4,217.7c2.5,0,3.3,2,3.3,2l0,0c0,0,0-0.4,0-0.8v-4.5c0-0.4,0.1-0.5,0.5-0.5h0.4
        c0.4,0,0.5,0.1,0.5,0.5v13.2c0,0.4-0.1,0.5-0.5,0.5h-0.3c-0.4,0-0.5-0.1-0.5-0.5v-0.8c0-0.4,0.1-0.6,0.1-0.6l0,0
        c0,0-0.9,2.1-3.5,2.1c-2.8,0-4.4-2.1-4.4-5.3C279.8,219.8,281.7,217.7,284.4,217.7z M284.5,227c1.6,0,3.3-1.3,3.3-4c0-2-1-4-3.3-4
        c-1.8,0-3.3,1.5-3.3,4S282.6,227,284.5,227z"/>
      <path fill="#808285" d="M156.3,241.6c1.8,0,2.9,0.8,3.4,1.1c0.3,0.1,0.3,0.4,0,0.6l-0.1,0.3c-0.1,0.3-0.4,0.3-0.6,0.1
        c-0.5-0.4-1.4-0.9-2.5-0.9c-2.3,0-3.9,1.6-3.9,4c0,2.4,1.8,4,4,4c1.4,0,2.4-0.6,2.9-1c0.3-0.3,0.5-0.1,0.6,0.1l0.1,0.3
        c0.1,0.3,0.1,0.5-0.1,0.6c-0.5,0.4-1.8,1.3-3.6,1.3c-3,0-5.3-2.1-5.3-5.3C151,243.7,153.3,241.6,156.3,241.6z"/>
      <path fill="#808285" d="M166.1,241.6c3,0,5.4,2.3,5.4,5.3s-2.4,5.4-5.3,5.4c-3,0-5.4-2.3-5.4-5.4
        C160.7,243.8,163.1,241.6,166.1,241.6z M166.1,250.9c2.1,0,3.9-1.8,3.9-4.1c0-2.3-1.8-4-3.9-4s-3.9,1.8-3.9,4
        C162.2,249.1,164,250.9,166.1,250.9z"/>
      <path fill="#808285" d="M173,242.3c0-0.4,0.1-0.5,0.5-0.5h0.4c0.3,0,0.5,0.1,0.5,0.5v1.1c0,0.4-0.1,0.8-0.1,0.8l0,0
        c0.4-0.9,1.8-2.6,4.1-2.6c2.5,0,3.4,1.4,3.4,3.9v5.9c0,0.4-0.1,0.5-0.5,0.5h-0.4c-0.4,0-0.5-0.1-0.5-0.5v-5.5c0-1.6-0.3-3-2.3-3
        c-2.1,0-3.9,1.8-3.9,4.1v4.4c0,0.4-0.1,0.5-0.5,0.5h-0.4c-0.4,0-0.5-0.1-0.5-0.5v-9L173,242.3L173,242.3z"/>
      <path fill="#808285" d="M183.3,250.4l0.1-0.3c0.1-0.3,0.4-0.3,0.6-0.1c0.5,0.4,1.4,0.9,2.6,0.9c1.1,0,2-0.5,2-1.6
        c0-2.3-5.4-1.6-5.4-4.9c0-1.9,1.6-2.9,3.4-2.9c1.5,0,2.4,0.5,2.8,0.9c0.3,0.1,0.3,0.4,0.1,0.6l-0.1,0.3c-0.1,0.3-0.4,0.3-0.6,0.1
        c-0.4-0.3-1.1-0.6-2.1-0.6s-2,0.5-2,1.5c0,2.4,5.4,1.6,5.4,5c0,1.6-1.4,2.9-3.4,2.9c-1.8,0-2.9-0.8-3.4-1.1
        C183.2,250.9,183.2,250.6,183.3,250.4z"/>
      <path fill="#808285" d="M191.8,239.1v-0.8c0-0.4,0.1-0.5,0.5-0.5h0.5c0.4,0,0.5,0.1,0.5,0.5v0.8c0,0.4-0.1,0.5-0.5,0.5h-0.5
        C192,239.4,191.8,239.3,191.8,239.1z M191.9,242.3c0-0.4,0.1-0.5,0.5-0.5h0.4c0.4,0,0.5,0.1,0.5,0.5v9.2c0,0.4-0.1,0.5-0.5,0.5
        h-0.4c-0.4,0-0.5-0.1-0.5-0.5V242.3z"/>
      <path fill="#808285" d="M199.4,241.6c2.5,0,3.3,2,3.3,2l0,0c0,0,0-0.4,0-0.8v-4.5c0-0.4,0.1-0.5,0.5-0.5h0.4
        c0.4,0,0.5,0.1,0.5,0.5v13.2c0,0.4-0.1,0.5-0.5,0.5h-0.4c-0.4,0-0.5-0.1-0.5-0.5v-0.8c0-0.4,0.1-0.6,0.1-0.6l0,0
        c0,0-0.9,2.1-3.5,2.1c-2.8,0-4.4-2.1-4.4-5.3C194.9,243.7,196.8,241.6,199.4,241.6z M199.4,250.9c1.6,0,3.3-1.3,3.3-4
        c0-2-1-4-3.3-4c-1.8,0-3.3,1.5-3.3,4C196.3,249.4,197.5,250.9,199.4,250.9z"/>
      <path fill="#808285" d="M210.7,241.6c2.6,0,4.3,2,4.3,4.8c0,0.3-0.3,0.5-0.5,0.5h-7.3c0,2.5,1.9,4,3.9,4c1.3,0,2.1-0.5,2.6-0.9
        c0.3-0.1,0.5-0.1,0.6,0.1l0.1,0.3c0.1,0.3,0.1,0.5-0.1,0.6c-0.5,0.4-1.8,1.1-3.4,1.1c-3,0-5.3-2.1-5.3-5.3
        C205.7,243.6,208,241.6,210.7,241.6z M213.5,245.9c-0.1-2.1-1.4-3.1-2.9-3.1c-1.6,0-3.1,1.1-3.5,3.1H213.5z"/>
      <path fill="#808285" d="M216.5,242.3c0-0.4,0.1-0.5,0.5-0.5h0.4c0.3,0,0.5,0.1,0.5,0.5v1.4c0,0.5-0.1,0.8-0.1,0.8l0,0
        c0.5-1.5,1.6-2.8,3.3-2.8c0.4,0,0.5,0.1,0.5,0.5v0.4c0,0.4-0.3,0.5-0.5,0.5c-2.1,0-3.1,2.4-3.1,4.5v3.8c0,0.4-0.1,0.5-0.5,0.5
        h-0.4c-0.4,0-0.5-0.1-0.5-0.5v-9.1H216.5z"/>
      <path fill="#808285" d="M221.7,250.8c0-0.3,0.1-0.5,0.5-0.5h0.6c0.4,0,0.5,0.1,0.5,0.5v0.6c0,0.4-0.1,0.5-0.5,0.5h-0.6
        c-0.4,0-0.5-0.1-0.5-0.5V250.8z"/>
    </g>
    <g>
      <path fill="#808285" d="M433,312.4h-4.5c-0.4,0-0.5-0.1-0.5-0.5v-0.3c0-0.4,0.1-0.5,0.5-0.5h10.6c0.4,0,0.5,0.1,0.5,0.5v0.3
        c0,0.4-0.1,0.5-0.5,0.5h-4.6v12.4c0,0.4-0.1,0.5-0.5,0.5h-0.4c-0.399,0-0.5-0.1-0.5-0.5L433,312.4L433,312.4z"/>
      <path fill="#808285" d="M440.2,312.4v-0.8c0-0.4,0.1-0.5,0.5-0.5h0.5c0.399,0,0.5,0.1,0.5,0.5v0.8c0,0.4-0.101,0.5-0.5,0.5h-0.5
        C440.4,313,440.2,312.7,440.2,312.4z M440.3,315.7c0-0.4,0.101-0.5,0.5-0.5h0.4c0.399,0,0.5,0.1,0.5,0.5v9.2
        c0,0.4-0.101,0.5-0.5,0.5h-0.4c-0.399,0-0.5-0.1-0.5-0.5V315.7z"/>
      <path fill="#808285" d="M443.9,315.7c0-0.4,0.1-0.5,0.5-0.5h0.399c0.3,0,0.5,0.1,0.5,0.5v1.1c0,0.4-0.1,0.8-0.1,0.8l0,0
        c0.5-1.4,2.1-2.6,3.8-2.6c1.9,0,2.9,0.9,3.1,2.5l0,0c0.5-1.3,2-2.5,3.801-2.5c2.5,0,3.399,1.4,3.399,3.9v5.9
        c0,0.4-0.1,0.5-0.5,0.5H458.4c-0.4,0-0.5-0.1-0.5-0.5v-5.5c0-1.6-0.4-3-2.101-3c-2,0-3.399,2.1-3.399,4.3v4.4
        c0,0.4-0.101,0.5-0.5,0.5h-0.4c-0.4,0-0.5-0.1-0.5-0.5v-5.5c0-1.5-0.3-3-2.1-3c-2,0-3.5,2.1-3.5,4.3v4.4c0,0.4-0.101,0.5-0.5,0.5
        h-0.4c-0.4,0-0.5-0.1-0.5-0.5L443.9,315.7L443.9,315.7z"/>
      <path fill="#808285" d="M465.7,315c2.6,0,4.3,2,4.3,4.8c0,0.3-0.3,0.5-0.5,0.5h-7.3c0,2.5,1.899,4,3.899,4
        c1.301,0,2.101-0.5,2.601-0.9c0.3-0.1,0.5-0.1,0.6,0.1l0.101,0.3c0.1,0.3,0.1,0.5-0.101,0.6c-0.5,0.4-1.8,1.1-3.399,1.1
        c-3,0-5.301-2.1-5.301-5.3C460.7,317,462.9,315,465.7,315z M468.4,319.2c-0.101-2.1-1.4-3.1-2.9-3.1c-1.6,0-3.1,1.1-3.5,3.1H468.4
        z"/>
      <path fill="#808285" d="M475.6,312.4v-0.8c0-0.4,0.101-0.5,0.5-0.5h0.5c0.4,0,0.5,0.1,0.5,0.5v0.8c0,0.4-0.1,0.5-0.5,0.5h-0.5
        C475.9,313,475.6,312.7,475.6,312.4z M475.7,315.7c0-0.4,0.1-0.5,0.5-0.5h0.399c0.4,0,0.5,0.1,0.5,0.5v9.2c0,0.4-0.1,0.5-0.5,0.5
        H476.2c-0.4,0-0.5-0.1-0.5-0.5V315.7z"/>
      <path fill="#808285" d="M479.8,316.5H478.9c-0.4,0-0.5-0.1-0.5-0.5v-0.1c0-0.4,0.1-0.5,0.5-0.5h0.899V313c0-0.4,0.101-0.5,0.5-0.5
        h0.4c0.399,0,0.5,0.1,0.5,0.5v2.4h2c0.399,0,0.5,0.1,0.5,0.5v0.1c0,0.4-0.101,0.5-0.5,0.5h-2v5c0,2.4,1.399,2.6,2.3,2.6
        c0.4,0,0.5,0.1,0.5,0.5v0.3c0,0.4-0.1,0.5-0.5,0.5c-2.3,0-3.5-1.4-3.5-3.8v-5.2h-0.2V316.5L479.8,316.5z"/>
      <path fill="#808285" d="M489.7,316.5h-0.9c-0.399,0-0.5-0.1-0.5-0.5v-0.1c0-0.4,0.101-0.5,0.5-0.5h0.9V313c0-0.4,0.1-0.5,0.5-0.5
        h0.399c0.4,0,0.5,0.1,0.5,0.5v2.4h2c0.4,0,0.5,0.1,0.5,0.5v0.1c0,0.4-0.1,0.5-0.5,0.5h-2v5c0,2.4,1.4,2.6,2.301,2.6
        c0.399,0,0.5,0.1,0.5,0.5v0.3c0,0.4-0.101,0.5-0.5,0.5c-2.301,0-3.5-1.4-3.5-3.8v-5.2h-0.2V316.5L489.7,316.5z"/>
      <path fill="#808285" d="M500.1,319.1h0.601v-0.4c0-2-1-2.6-2.5-2.6c-1.101,0-2,0.4-2.5,0.8c-0.3,0.1-0.5,0.1-0.601-0.1l-0.1-0.3
        c-0.1-0.3-0.1-0.5,0.1-0.6c0.5-0.4,1.601-0.9,3.301-0.9c2.399,0,3.8,1.4,3.8,3.9v6c0,0.4-0.101,0.5-0.5,0.5h-0.4
        c-0.399,0-0.5-0.1-0.5-0.5v-0.8c0-0.5,0-0.8,0-0.8l0,0c0,0-0.899,2.3-3.399,2.3c-1.801,0-3.4-1-3.4-3
        C494,319.4,498.2,319.1,500.1,319.1z M497.6,324.4c2,0,3.101-2,3.101-3.8v-0.5h-0.5c-1.601,0-4.8,0-4.8,2.4
        C495.3,323.5,496.1,324.4,497.6,324.4z"/>
      <path fill="#808285" d="M504.3,311.7c0-0.4,0.101-0.5,0.5-0.5h0.4c0.399,0,0.5,0.1,0.5,0.5v7.4h1.6l2.8-3.5
        c0.101-0.3,0.4-0.3,0.601-0.3h0.5c0.399,0,0.5,0.3,0.3,0.6l-3,3.8l0,0l3.5,5c0.3,0.4,0.1,0.6-0.4,0.6h-0.5c-0.3,0-0.5-0.1-0.6-0.4
        l-3.1-4.6H505.8v4.5c0,0.4-0.1,0.5-0.5,0.5H504.9c-0.4,0-0.5-0.1-0.5-0.5v-13.1H504.3z"/>
      <path fill="#808285" d="M517.5,315c2.6,0,4.3,2,4.3,4.8c0,0.3-0.3,0.5-0.5,0.5H514c0,2.5,1.9,4,3.9,4c1.3,0,2.1-0.5,2.6-0.9
        c0.3-0.1,0.5-0.1,0.6,0.1l0.101,0.3c0.1,0.3,0.1,0.5-0.101,0.6c-0.5,0.4-1.8,1.1-3.399,1.1c-3,0-5.3-2.1-5.3-5.3
        C512.4,317,514.7,315,517.5,315z M520.2,319.2c-0.101-2.1-1.4-3.1-2.9-3.1c-1.6,0-3.1,1.1-3.5,3.1H520.2z"/>
      <path fill="#808285" d="M522.6,323.8l0.101-0.3c0.1-0.3,0.399-0.3,0.6-0.1c0.5,0.4,1.4,0.9,2.601,0.9c1.1,0,2-0.5,2-1.6
        c0-2.3-5.4-1.6-5.4-4.9c0-1.9,1.6-2.9,3.4-2.9c1.5,0,2.399,0.5,2.8,0.9c0.3,0.1,0.3,0.4,0.1,0.6l-0.1,0.3
        c-0.101,0.3-0.4,0.3-0.601,0.1c-0.399-0.3-1.1-0.6-2.1-0.6s-2,0.5-2,1.5c0,2.4,5.4,1.6,5.4,5c0,1.6-1.4,2.9-3.4,2.9
        c-1.8,0-2.9-0.8-3.4-1.1C522.5,324.3,522.4,324,522.6,323.8z"/>
      <path fill="#808285" d="M535.7,316.5h-0.9c-0.399,0-0.5-0.1-0.5-0.5v-0.1c0-0.4,0.101-0.5,0.5-0.5h0.9V313c0-0.4,0.1-0.5,0.5-0.5
        h0.399c0.4,0,0.5,0.1,0.5,0.5v2.4h2c0.4,0,0.5,0.1,0.5,0.5v0.1c0,0.4-0.1,0.5-0.5,0.5h-2v5c0,2.4,1.4,2.6,2.301,2.6
        c0.399,0,0.5,0.1,0.5,0.5v0.3c0,0.4-0.101,0.5-0.5,0.5c-2.301,0-3.5-1.4-3.5-3.8v-5.2h-0.2V316.5z"/>
      <path fill="#808285" d="M545.5,315c3,0,5.4,2.3,5.4,5.3s-2.4,5.4-5.301,5.4c-3,0-5.399-2.3-5.399-5.4
        C540.1,317.2,542.5,315,545.5,315z M545.5,324.4c2.1,0,3.9-1.8,3.9-4.1c0-2.3-1.801-4-3.9-4s-3.9,1.8-3.9,4
        C541.6,322.6,543.3,324.4,545.5,324.4z"/>
      <path fill="#808285" d="M428.7,347.6l0.1-0.3c0.101-0.3,0.4-0.3,0.601-0.1c0.5,0.4,1.399,0.9,2.6,0.9c1.1,0,2-0.5,2-1.6
        c0-2.3-5.4-1.6-5.4-4.9c0-1.9,1.601-2.9,3.4-2.9c1.5,0,2.4,0.5,2.8,0.9c0.3,0.1,0.3,0.4,0.101,0.6l-0.101,0.3
        c-0.1,0.3-0.399,0.3-0.6,0.1c-0.4-0.3-1.101-0.6-2.101-0.6s-2,0.5-2,1.5c0,2.4,5.4,1.6,5.4,5c0,1.6-1.4,2.9-3.4,2.9
        c-1.8,0-2.899-0.8-3.399-1.1C428.6,348.1,428.6,347.9,428.7,347.6z"/>
      <path fill="#808285" d="M441.6,338.8c2.601,0,4.301,2,4.301,4.8c0,0.3-0.301,0.5-0.5,0.5H438.1c0,2.5,1.9,4,3.9,4
        c1.3,0,2.1-0.5,2.6-0.9c0.301-0.1,0.5-0.1,0.601,0.1l0.1,0.3c0.101,0.3,0.101,0.5-0.1,0.6c-0.5,0.4-1.8,1.1-3.4,1.1
        c-3,0-5.3-2.1-5.3-5.3S438.8,338.8,441.6,338.8z M444.4,343.1c-0.101-2.1-1.4-3.1-2.9-3.1c-1.6,0-3.1,1.1-3.5,3.1H444.4z"/>
      <path fill="#808285" d="M447.5,335.6c0-0.4,0.1-0.5,0.5-0.5h0.4c0.399,0,0.5,0.1,0.5,0.5v11.1c0,1.3,0.6,1.4,1,1.5
        c0.3,0,0.399,0.1,0.399,0.5v0.3c0,0.3-0.1,0.5-0.5,0.5c-0.899,0-2.3-0.3-2.3-2.5V335.6L447.5,335.6z"/>
      <path fill="#808285" d="M451.5,335.6c0-0.4,0.1-0.5,0.5-0.5h0.4c0.399,0,0.5,0.1,0.5,0.5v11.1c0,1.3,0.6,1.4,1,1.5
        c0.3,0,0.399,0.1,0.399,0.5v0.3c0,0.3-0.1,0.5-0.5,0.5c-0.899,0-2.3-0.3-2.3-2.5V335.6L451.5,335.6z"/>
      <path fill="#808285" d="M465.2,343h0.6v-0.4c0-2-1-2.6-2.5-2.6c-1.1,0-2,0.4-2.5,0.8c-0.3,0.1-0.5,0.1-0.6-0.1l-0.101-0.3
        c-0.1-0.3-0.1-0.5,0.101-0.6c0.5-0.4,1.6-0.9,3.3-0.9c2.4,0,3.8,1.4,3.8,3.9v6c0,0.4-0.1,0.5-0.5,0.5H466.4
        c-0.4,0-0.5-0.1-0.5-0.5V348c0-0.5,0-0.8,0-0.8l0,0c0,0-0.9,2.3-3.4,2.3c-1.8,0-3.4-1-3.4-3C458.9,343.2,463.2,343,465.2,343z
         M462.7,348.3c2,0,3.1-2,3.1-3.8V344h-0.5c-1.6,0-4.8,0-4.8,2.4C460.4,347.4,461.2,348.3,462.7,348.3z"/>
      <path fill="#808285" d="M473.5,335.6c0-0.4,0.1-0.5,0.5-0.5h0.4c0.399,0,0.5,0.1,0.5,0.5v5c0,0.5-0.101,0.9-0.101,0.9l0,0
        c0.4-1,1.8-2.6,4-2.6c2.5,0,3.4,1.4,3.4,3.9v5.9c0,0.4-0.101,0.5-0.5,0.5h-0.4c-0.399,0-0.5-0.1-0.5-0.5v-5.6c0-1.6-0.3-3-2.3-3
        c-2.1,0-3.8,1.8-3.8,4.1v4.4c0,0.4-0.101,0.5-0.5,0.5h-0.4c-0.399,0-0.5-0.1-0.5-0.5v-13.1h0.2V335.6L473.5,335.6z"/>
      <path fill="#808285" d="M489.1,338.8c3,0,5.4,2.3,5.4,5.3s-2.4,5.4-5.3,5.4c-3,0-5.4-2.3-5.4-5.4
        C483.7,341.1,486,338.8,489.1,338.8z M489.1,348.3c2.101,0,3.9-1.8,3.9-4.1c0-2.3-1.8-4-3.9-4c-2.1,0-3.899,1.8-3.899,4
        C485.2,346.5,486.9,348.3,489.1,348.3z"/>
      <path fill="#808285" d="M496,339.6c0-0.4,0.1-0.5,0.5-0.5h0.4c0.3,0,0.5,0.1,0.5,0.5v1.1c0,0.4-0.101,0.8-0.101,0.8l0,0
        c0.5-1.4,2.101-2.6,3.8-2.6c1.9,0,2.9,0.9,3.101,2.5l0,0c0.5-1.3,2-2.5,3.8-2.5c2.5,0,3.4,1.4,3.4,3.9v5.9
        c0,0.4-0.101,0.5-0.5,0.5h-0.4c-0.4,0-0.5-0.1-0.5-0.5v-5.6c0-1.6-0.4-3-2.1-3c-2,0-3.4,2.1-3.4,4.3v4.4c0,0.4-0.1,0.5-0.5,0.5
        h-0.5c-0.4,0-0.5-0.1-0.5-0.5v-5.5c0-1.5-0.3-3-2.1-3c-2,0-3.5,2.1-3.5,4.3v4.4c0,0.4-0.101,0.5-0.5,0.5h-0.4
        c-0.4,0-0.5-0.1-0.5-0.5V339.6L496,339.6z"/>
      <path fill="#808285" d="M517.7,338.8c2.6,0,4.3,2,4.3,4.8c0,0.3-0.3,0.5-0.5,0.5h-7.3c0,2.5,1.899,4,3.899,4
        c1.301,0,2.101-0.5,2.601-0.9c0.3-0.1,0.5-0.1,0.6,0.1l0.101,0.3c0.1,0.3,0.1,0.5-0.101,0.6c-0.5,0.4-1.8,1.1-3.399,1.1
        c-3,0-5.301-2.1-5.301-5.3C512.7,340.8,514.9,338.8,517.7,338.8z M520.6,343.1c-0.1-2.1-1.399-3.1-2.899-3.1
        c-1.601,0-3.101,1.1-3.5,3.1H520.6z"/>
      <path fill="#808285" d="M523.4,348c0-0.3,0.1-0.5,0.5-0.5h0.6c0.4,0,0.5,0.1,0.5,0.5v0.6c0,0.4-0.1,0.5-0.5,0.5h-0.6
        c-0.4,0-0.5-0.1-0.5-0.5V348z"/>
    </g>
    <g>
      <path fill="#808285" d="M174.7,402.3c4.1,0,7.2,3.101,7.2,7.2s-3,7.4-7.2,7.4c-4.1,0-7.2-3.301-7.2-7.4S170.5,402.3,174.7,402.3z
         M174.7,415.6c3.3,0,5.8-2.6,5.8-6c0-3.399-2.4-5.899-5.8-5.899c-3.3,0-5.8,2.5-5.8,5.899C168.9,413,171.4,415.6,174.7,415.6z"/>
      <path fill="#808285" d="M183.6,407.1c0-0.399,0.1-0.5,0.5-0.5h0.4c0.4,0,0.5,0.101,0.5,0.5v5.5c0,1.601,0.3,3,2.1,3
        c2.3,0,3.8-2,3.8-4.3V406.9c0-0.4,0.1-0.5,0.5-0.5h0.4c0.4,0,0.5,0.1,0.5,0.5v9.199c0,0.4-0.1,0.5-0.5,0.5h-0.4
        c-0.4,0-0.5-0.1-0.5-0.5V415c0-0.4,0-0.8,0-0.8l0,0c-0.4,1-1.8,2.6-4,2.6c-2.4,0-3.4-1.3-3.4-3.899V407.1H183.6L183.6,407.1z"/>
      <path fill="#808285" d="M194.5,407.1c0-0.399,0.1-0.5,0.5-0.5h0.4c0.3,0,0.5,0.101,0.5,0.5v1.4c0,0.5-0.1,0.8-0.1,0.8l0,0
        c0.5-1.5,1.6-2.8,3.3-2.8c0.4,0,0.5,0.1,0.5,0.5v0.4c0,0.399-0.3,0.5-0.5,0.5c-2.1,0-3.1,2.399-3.1,4.5v3.8
        c0,0.399-0.1,0.5-0.5,0.5h-0.4c-0.4,0-0.5-0.101-0.5-0.5V407.1H194.5L194.5,407.1z"/>
      <path fill="#808285" d="M204.7,407.1c0-0.399,0.1-0.5,0.5-0.5h0.4c0.4,0,0.5,0.101,0.5,0.5v0.801c0,0.399,0,0.6,0,0.6l0,0
        c0,0,0.9-2.1,3.5-2.1c2.8,0,4.4,2.1,4.4,5.3s-1.9,5.3-4.5,5.3c-2.5,0-3.4-2-3.4-2l0,0c0,0,0.1,0.4,0.1,0.9v4.4
        c0,0.4-0.1,0.5-0.5,0.5h-0.4c-0.4,0-0.5-0.1-0.5-0.5L204.7,407.1L204.7,407.1z M209.2,415.6c1.8,0,3.3-1.5,3.3-4s-1.4-4-3.1-4
        c-1.6,0-3.3,1.301-3.3,4C206.1,413.6,207.2,415.6,209.2,415.6z"/>
      <path fill="#808285" d="M215.6,403c0-0.4,0.1-0.5,0.5-0.5h0.4c0.4,0,0.5,0.1,0.5,0.5v11.1c0,1.301,0.6,1.4,1,1.5
        c0.3,0,0.4,0.101,0.4,0.5v0.301c0,0.3-0.1,0.5-0.5,0.5c-0.9,0-2.3-0.301-2.3-2.5V403L215.6,403z"/>
      <path fill="#808285" d="M225.1,410.5h0.6v-0.4c0-2-1-2.6-2.5-2.6c-1.1,0-2,0.4-2.5,0.8c-0.3,0.101-0.5,0.101-0.6-0.1l-0.1-0.3
        c-0.1-0.301-0.1-0.5,0.1-0.601c0.5-0.399,1.6-0.899,3.3-0.899c2.4,0,3.8,1.399,3.8,3.899v6c0,0.4-0.1,0.5-0.5,0.5h-0.4
        c-0.4,0-0.5-0.1-0.5-0.5v-0.8c0-0.5,0-0.8,0-0.8l0,0c0,0-0.9,2.3-3.4,2.3c-1.8,0-3.4-1-3.4-3C218.9,410.6,223,410.5,225.1,410.5z
         M222.5,415.7c2,0,3.1-2,3.1-3.8v-0.5h-0.5c-1.6,0-4.8,0-4.8,2.399C220.3,414.7,221,415.7,222.5,415.7z"/>
      <path fill="#808285" d="M229.1,407.1c0-0.399,0.1-0.5,0.5-0.5h0.4c0.3,0,0.5,0.101,0.5,0.5v1.101c0,0.399-0.1,0.8-0.1,0.8l0,0
        c0.4-0.9,1.8-2.6,4.1-2.6c2.5,0,3.4,1.399,3.4,3.899v5.9c0,0.399-0.1,0.5-0.5,0.5H237c-0.4,0-0.5-0.101-0.5-0.5v-5.5
        c0-1.601-0.3-3-2.3-3c-2.1,0-3.9,1.8-3.9,4.1v4.4c0,0.399-0.1,0.5-0.5,0.5h-0.3c-0.4,0-0.5-0.101-0.5-0.5v-9L229.1,407.1
        L229.1,407.1z"/>
      <path fill="#808285" d="M244.7,407.7h-0.9c-0.4,0-0.5-0.101-0.5-0.5V407.1c0-0.399,0.1-0.5,0.5-0.5h0.9V404.2
        c0-0.4,0.1-0.5,0.5-0.5h0.4c0.4,0,0.5,0.1,0.5,0.5v2.399h2c0.4,0,0.5,0.101,0.5,0.5v0.101c0,0.399-0.1,0.5-0.5,0.5h-2v5
        c0,2.399,1.4,2.6,2.3,2.6c0.4,0,0.5,0.101,0.5,0.5v0.3c0,0.4-0.1,0.5-0.5,0.5c-2.3,0-3.5-1.399-3.5-3.8v-5.2L244.7,407.7
        L244.7,407.7z"/>
      <path fill="#808285" d="M254.5,406.3c3,0,5.4,2.3,5.4,5.3s-2.4,5.4-5.3,5.4c-3,0-5.4-2.3-5.4-5.4
        C249.1,408.6,251.4,406.3,254.5,406.3z M254.5,415.6c2.1,0,3.9-1.8,3.9-4.1s-1.8-4-3.9-4s-3.9,1.8-3.9,4
        C250.6,413.9,252.3,415.6,254.5,415.6z"/>
      <path fill="#808285" d="M266.9,419.099c0.5,0.301,1.3,0.5,2.4,0.5c1.9,0,3.5-0.899,3.5-3.099v-1c0-0.4,0-0.8,0-0.8l0,0
        c-0.6,1.1-1.6,1.899-3.3,1.899c-2.8,0-4.5-2.1-4.5-5.3c0-3,1.6-5,4.5-5c2.6,0,3.3,1.9,3.3,1.9l0,0c0,0,0-0.101,0-0.4V406.9
        c0-0.301,0.1-0.5,0.5-0.5h0.4c0.4,0,0.5,0.1,0.5,0.5v9.399c0,3.299-2.4,4.5-4.8,4.5c-1,0-2-0.301-2.9-0.6
        c-0.3-0.102-0.4-0.4-0.3-0.602l0.1-0.299C266.4,419.099,266.5,419,266.9,419.099z M272.7,411.5c0-3-1.5-3.9-3.1-3.9
        c-2,0-3.1,1.5-3.1,3.801c0,2.5,1.3,4,3.3,4C271.3,415.4,272.7,414.4,272.7,411.5z"/>
      <path fill="#808285" d="M280.6,406.3c2.6,0,4.3,2,4.3,4.8c0,0.301-0.3,0.5-0.5,0.5h-7.3c0,2.5,1.9,4,3.9,4
        c1.3,0,2.1-0.5,2.6-0.899c0.3-0.101,0.5-0.101,0.6,0.1l0.1,0.3c0.1,0.301,0.1,0.5-0.1,0.601c-0.5,0.399-1.8,1.1-3.4,1.1
        c-3,0-5.3-2.1-5.3-5.3C275.7,408.3,278,406.3,280.6,406.3z M283.5,410.6c-0.1-2.1-1.4-3.1-2.9-3.1c-1.6,0-3.1,1.1-3.5,3.1H283.5z"
        />
      <path fill="#808285" d="M286.8,407.7h-0.9c-0.4,0-0.5-0.101-0.5-0.5V407.1c0-0.399,0.1-0.5,0.5-0.5h0.9V404.2
        c0-0.4,0.1-0.5,0.5-0.5h0.4c0.4,0,0.5,0.1,0.5,0.5v2.399h2c0.4,0,0.5,0.101,0.5,0.5v0.101c0,0.399-0.1,0.5-0.5,0.5h-2v5
        c0,2.399,1.4,2.6,2.3,2.6c0.4,0,0.5,0.101,0.5,0.5v0.3c0,0.4-0.1,0.5-0.5,0.5c-2.3,0-3.5-1.399-3.5-3.8v-5.2L286.8,407.7
        L286.8,407.7z"/>
      <path fill="#808285" d="M295.7,419.4c0.3,0.1,0.5,0.301,0.9,0.301c0.9,0,1.5-0.801,1.9-1.601l0.6-1.399l-4-9.4
        c-0.1-0.399,0-0.6,0.4-0.6h0.5c0.3,0,0.5,0.1,0.5,0.399l2.9,7c0.1,0.5,0.4,1,0.4,1l0,0c0,0,0.1-0.5,0.4-1l2.8-7
        c0.1-0.3,0.3-0.399,0.5-0.399h0.5c0.4,0,0.5,0.3,0.4,0.6l-4.8,11.6c-0.5,1.301-1.5,2.1-2.9,2.1c-0.6,0-1-0.299-1.4-0.4
        c-0.3-0.1-0.4-0.398-0.3-0.6l0.1-0.299C295.2,419.4,295.4,419.3,295.7,419.4z"/>
      <path fill="#808285" d="M309.9,406.3c3,0,5.399,2.3,5.399,5.3S312.9,417,310,417c-3,0-5.4-2.3-5.4-5.4
        C304.6,408.6,307,406.3,309.9,406.3z M309.9,415.6c2.1,0,3.899-1.8,3.899-4.1s-1.8-4-3.899-4c-2.101,0-3.9,1.8-3.9,4
        C306,413.9,307.7,415.6,309.9,415.6z"/>
      <path fill="#808285" d="M316.7,407.1c0-0.399,0.1-0.5,0.5-0.5h0.399c0.4,0,0.5,0.101,0.5,0.5v5.5c0,1.601,0.301,3,2.101,3
        c2.3,0,3.8-2,3.8-4.3V406.9c0-0.4,0.1-0.5,0.5-0.5h0.4c0.399,0,0.5,0.1,0.5,0.5v9.199c0,0.4-0.101,0.5-0.5,0.5h-0.4
        c-0.4,0-0.5-0.1-0.5-0.5V415c0-0.4,0-0.8,0-0.8l0,0c-0.4,1-1.8,2.6-4,2.6c-2.4,0-3.4-1.3-3.4-3.899V407.1H316.7L316.7,407.1z"/>
      <path fill="#808285" d="M327.7,407.1c0-0.399,0.1-0.5,0.5-0.5h0.399c0.301,0,0.5,0.101,0.5,0.5v1.4c0,0.5-0.1,0.8-0.1,0.8l0,0
        c0.5-1.5,1.6-2.8,3.3-2.8c0.4,0,0.5,0.1,0.5,0.5v0.4c0,0.399-0.3,0.5-0.5,0.5c-2.1,0-3.1,2.399-3.1,4.5v3.8
        c0,0.399-0.101,0.5-0.5,0.5h-0.4c-0.399,0-0.5-0.101-0.5-0.5L327.7,407.1L327.7,407.1z"/>
      <path fill="#808285" d="M168,426.9c0-0.4,0.1-0.5,0.5-0.5h0.4c0.4,0,0.5,0.1,0.5,0.5v5c0,0.5-0.1,0.9-0.1,0.9l0,0
        c0.4-1,1.8-2.6,4-2.6c2.5,0,3.4,1.398,3.4,3.898v5.9c0,0.4-0.1,0.5-0.5,0.5h-0.4c-0.4,0-0.5-0.1-0.5-0.5v-5.5c0-1.6-0.3-3-2.3-3
        c-2.1,0-3.8,1.801-3.8,4.1v4.4c0,0.4-0.1,0.5-0.5,0.5h-0.4c-0.4,0-0.5-0.1-0.5-0.5v-13.1H168L168,426.9z"/>
      <path fill="#808285" d="M183.6,430.201c3,0,5.4,2.299,5.4,5.299s-2.4,5.4-5.3,5.4c-3,0-5.4-2.301-5.4-5.4
        S180.7,430.201,183.6,430.201z M183.6,439.5c2.1,0,3.9-1.799,3.9-4.1s-1.8-4-3.9-4s-3.9,1.801-3.9,4
        C179.7,437.701,181.5,439.5,183.6,439.5z"/>
      <path fill="#808285" d="M190.5,430.9c0-0.4,0.1-0.5,0.5-0.5h0.4c0.3,0,0.5,0.1,0.5,0.5v1.1c0,0.4-0.1,0.801-0.1,0.801l0,0
        c0.5-1.4,2.1-2.6,3.8-2.6c1.9,0,2.9,0.898,3.1,2.5l0,0c0.5-1.301,2-2.5,3.8-2.5c2.5,0,3.4,1.398,3.4,3.898v5.9
        c0,0.4-0.1,0.5-0.5,0.5H205c-0.4,0-0.5-0.1-0.5-0.5V434.3c0-1.6-0.4-3-2.1-3c-2,0-3.4,2.1-3.4,4.299v4.4c0,0.4-0.1,0.5-0.5,0.5
        h-0.4c-0.4,0-0.5-0.1-0.5-0.5V434.3c0-1.5-0.3-3-2.1-3c-2,0-3.5,2.1-3.5,4.299v4.4c0,0.4-0.1,0.5-0.5,0.5h-0.4
        c-0.4,0-0.5-0.1-0.5-0.5v-9.1H190.5L190.5,430.9z"/>
      <path fill="#808285" d="M212.2,430.201c2.6,0,4.3,2,4.3,4.799c0,0.301-0.3,0.5-0.5,0.5h-7.3c0,2.5,1.9,4,3.9,4
        c1.3,0,2.1-0.5,2.6-0.9c0.3-0.1,0.5-0.1,0.6,0.102l0.1,0.299c0.1,0.301,0.1,0.5-0.1,0.6c-0.5,0.4-1.8,1.102-3.4,1.102
        c-3,0-5.3-2.102-5.3-5.301C207.3,432.201,209.6,430.201,212.2,430.201z M215.1,434.5c-0.1-2.1-1.4-3.1-2.9-3.1
        c-1.6,0-3.1,1.1-3.5,3.1H215.1z"/>
      <path fill="#808285" d="M221.7,438.9l0.1-0.301c0.1-0.299,0.4-0.299,0.6-0.1c0.5,0.4,1.4,0.9,2.6,0.9c1.1,0,2-0.5,2-1.6
        c0-2.301-5.4-1.6-5.4-4.9c0-1.9,1.6-2.9,3.4-2.9c1.5,0,2.4,0.5,2.8,0.9c0.3,0.1,0.3,0.4,0.1,0.6l-0.1,0.301
        c-0.1,0.299-0.4,0.299-0.6,0.1c-0.4-0.301-1.1-0.6-2.1-0.6s-2,0.5-2,1.5c0,2.4,5.4,1.6,5.4,5c0,1.6-1.4,2.9-3.4,2.9
        c-1.8,0-2.9-0.801-3.4-1.102C221.5,439.4,221.5,439.099,221.7,438.9z"/>
      <path fill="#808285" d="M234.9,430.201c3,0,5.4,2.299,5.4,5.299s-2.4,5.4-5.3,5.4c-3,0-5.4-2.301-5.4-5.4
        C229.5,432.4,231.8,430.201,234.9,430.201z M234.9,439.5c2.1,0,3.9-1.799,3.9-4.1s-1.8-4-3.9-4s-3.9,1.801-3.9,4
        C230.8,437.701,232.7,439.5,234.9,439.5z"/>
      <path fill="#808285" d="M241.8,426.9c0-0.4,0.1-0.5,0.5-0.5h0.4c0.4,0,0.5,0.1,0.5,0.5V438c0,1.301,0.6,1.4,1,1.5
        c0.3,0,0.4,0.1,0.4,0.5v0.301c0,0.299-0.1,0.5-0.5,0.5c-0.9,0-2.3-0.301-2.3-2.5V426.9L241.8,426.9z"/>
      <path fill="#808285" d="M249.8,430.201c2.5,0,3.3,2,3.3,2l0,0c0,0,0-0.4,0-0.801v-4.5c0-0.4,0.1-0.5,0.5-0.5h0.4
        c0.4,0,0.5,0.1,0.5,0.5V440c0,0.4-0.1,0.5-0.5,0.5h-0.4c-0.4,0-0.5-0.1-0.5-0.5v-0.799c0-0.4,0.1-0.602,0.1-0.602l0,0
        c0,0-0.9,2.102-3.5,2.102c-2.8,0-4.4-2.102-4.4-5.301C245.2,432.201,247,430.201,249.8,430.201z M249.8,439.5
        c1.6,0,3.3-1.299,3.3-4.1c0-2-1-4-3.3-4c-1.8,0-3.3,1.5-3.3,4C246.7,438,247.9,439.5,249.8,439.5z"/>
      <path fill="#808285" d="M264.9,430.201c2.5,0,3.4,2,3.4,2l0,0c0,0,0-0.301,0-0.602V430.8c0-0.301,0.1-0.5,0.5-0.5h0.4
        c0.4,0,0.5,0.1,0.5,0.5V444c0,0.4-0.1,0.5-0.5,0.5h-0.4c-0.4,0-0.5-0.1-0.5-0.5v-4.5c0-0.5,0.1-0.9,0.1-0.9l0,0
        c0,0-0.9,2.102-3.5,2.102s-4.4-2.102-4.4-5.301C260.4,432.201,262.2,430.201,264.9,430.201z M264.9,439.5c1.6,0,3.3-1.299,3.3-4.1
        c0-2-1-4-3.3-4c-1.8,0-3.3,1.5-3.3,4C261.7,438,263,439.5,264.9,439.5z"/>
      <path fill="#808285" d="M271.7,430.9c0-0.4,0.1-0.5,0.5-0.5h0.4c0.4,0,0.5,0.1,0.5,0.5v5.5c0,1.6,0.3,3,2.1,3
        c2.3,0,3.8-2,3.8-4.301v-4.398c0-0.4,0.1-0.5,0.5-0.5h0.4c0.4,0,0.5,0.1,0.5,0.5v9.199c0,0.4-0.1,0.5-0.5,0.5h-0.4
        c-0.4,0-0.5-0.1-0.5-0.5v-1.1c0-0.4,0-0.801,0-0.801l0,0c-0.4,1-1.8,2.6-4,2.6c-2.4,0-3.4-1.299-3.4-3.898v-5.9L271.7,430.9
        L271.7,430.9z"/>
      <path fill="#808285" d="M282.6,427.5v-0.799c0-0.4,0.1-0.5,0.5-0.5h0.5c0.4,0,0.5,0.1,0.5,0.5v0.799c0,0.4-0.1,0.5-0.5,0.5h-0.5
        C282.9,428,282.6,427.9,282.6,427.5z M282.7,430.9c0-0.4,0.1-0.5,0.5-0.5h0.4c0.4,0,0.5,0.1,0.5,0.5v9.199c0,0.4-0.1,0.5-0.5,0.5
        h-0.4c-0.4,0-0.5-0.1-0.5-0.5V430.9z"/>
      <path fill="#808285" d="M291,430.201c1.8,0,2.9,0.799,3.4,1.1c0.3,0.1,0.3,0.4,0,0.6l-0.1,0.301c-0.1,0.299-0.4,0.299-0.6,0.1
        c-0.5-0.4-1.4-0.9-2.5-0.9c-2.3,0-3.9,1.6-3.9,4.1c0,2.4,1.8,4,4,4c1.4,0,2.4-0.6,2.9-1c0.3-0.299,0.5-0.1,0.6,0.1l0.1,0.301
        c0.1,0.301,0.1,0.5-0.1,0.6c-0.5,0.4-1.8,1.301-3.6,1.301c-3,0-5.3-2.1-5.3-5.301C285.6,432.3,288,430.201,291,430.201z"/>
      <path fill="#808285" d="M296.3,426.9c0-0.4,0.1-0.5,0.5-0.5h0.4c0.4,0,0.5,0.1,0.5,0.5v7.4h1.6l2.8-3.5
        c0.1-0.301,0.4-0.301,0.6-0.301h0.5c0.4,0,0.5,0.301,0.3,0.6l-3,3.801l0,0l3.5,5c0.3,0.4,0.1,0.6-0.4,0.6h-0.5
        c-0.3,0-0.5-0.1-0.6-0.4l-3.1-4.6h-1.6v4.5c0,0.4-0.1,0.5-0.5,0.5h-0.4c-0.4,0-0.5-0.1-0.5-0.5v-13.1H296.3z"/>
      <path fill="#808285" d="M305.2,426.9c0-0.4,0.1-0.5,0.5-0.5h0.399c0.4,0,0.5,0.1,0.5,0.5V438c0,1.301,0.601,1.4,1,1.5
        c0.301,0,0.4,0.1,0.4,0.5v0.301c0,0.299-0.1,0.5-0.5,0.5c-0.9,0-2.3-0.301-2.3-2.5V426.9L305.2,426.9z"/>
      <path fill="#808285" d="M308.6,443.3c0.301,0.1,0.5,0.299,0.9,0.299c0.9,0,1.5-0.799,1.9-1.6l0.6-1.4l-4-9.398
        c-0.1-0.4,0-0.602,0.4-0.602h0.5c0.3,0,0.5,0.102,0.5,0.4l2.899,7c0.101,0.5,0.4,1,0.4,1l0,0c0,0,0.1-0.5,0.399-1l2.801-7
        c0.1-0.299,0.3-0.4,0.5-0.4h0.5c0.399,0,0.5,0.301,0.399,0.602l-4.8,11.6c-0.5,1.299-1.5,2.1-2.9,2.1c-0.6,0-1-0.301-1.399-0.4
        c-0.3-0.1-0.4-0.4-0.3-0.6l0.1-0.301C308.2,443.3,308.4,443.099,308.6,443.3z"/>
    </g>
    <g>
      <path fill="#808285" d="M433.1,496.3c0.101-0.301,0.301-0.4,0.5-0.4h0.601c0.3,0,0.5,0.1,0.5,0.4L439.6,509.5
        c0.101,0.4,0,0.6-0.399,0.6h-0.5c-0.3,0-0.5-0.1-0.5-0.398l-1.5-4.102H431l-1.5,4.102c-0.1,0.299-0.3,0.398-0.5,0.398h-0.4
        c-0.399,0-0.5-0.299-0.399-0.6L433.1,496.3z M436.4,504.3l-1.9-5.201c-0.3-0.6-0.5-1.898-0.5-1.898l0,0c0,0-0.4,1.1-0.5,1.898
        l-1.9,5.201H436.4z"/>
      <path fill="#808285" d="M440.8,500.4c0-0.4,0.101-0.5,0.5-0.5h0.4c0.3,0,0.5,0.1,0.5,0.5v1.1c0,0.4-0.101,0.801-0.101,0.801l0,0
        c0.4-0.9,1.801-2.6,4.101-2.6c2.5,0,3.399,1.398,3.399,3.898v5.9c0,0.4-0.1,0.5-0.5,0.5H448.7c-0.4,0-0.5-0.1-0.5-0.5V504
        c0-1.6-0.3-3-2.3-3c-2.101,0-3.9,1.801-3.9,4.1v4.4c0,0.4-0.1,0.5-0.5,0.5h-0.4c-0.399,0-0.5-0.1-0.5-0.5v-9L440.8,500.4
        L440.8,500.4z"/>
      <path fill="#808285" d="M457.1,503.8h0.601v-0.4c0-2-1-2.6-2.5-2.6c-1.101,0-2,0.4-2.5,0.799c-0.3,0.102-0.5,0.102-0.601-0.1
        l-0.1-0.299c-0.1-0.301-0.1-0.5,0.1-0.602c0.5-0.398,1.601-0.898,3.301-0.898c2.399,0,3.8,1.398,3.8,3.898v6
        c0,0.4-0.101,0.5-0.5,0.5h-0.4c-0.399,0-0.5-0.1-0.5-0.5V508.8c0-0.5,0-0.801,0-0.801l0,0c0,0-0.899,2.301-3.399,2.301
        c-1.801,0-3.4-1-3.4-3C450.9,503.9,455.1,503.8,457.1,503.8z M454.6,509.099c2,0,3.101-2,3.101-3.799v-0.5h-0.5
        c-1.601,0-4.8,0-4.8,2.4C452.4,508.099,453.1,509.099,454.6,509.099z"/>
      <path fill="#808285" d="M461.2,496.4c0-0.4,0.1-0.5,0.5-0.5h0.399c0.4,0,0.5,0.1,0.5,0.5v11.1c0,1.301,0.601,1.4,1,1.5
        c0.301,0,0.4,0.1,0.4,0.5v0.301c0,0.299-0.1,0.5-0.5,0.5c-0.9,0-2.3-0.301-2.3-2.5V496.4L461.2,496.4z"/>
      <path fill="#808285" d="M464.7,512.701c0.3,0.1,0.5,0.299,0.899,0.299c0.9,0,1.5-0.799,1.9-1.6l0.6-1.4l-4-9.4
        c-0.1-0.398,0-0.6,0.4-0.6h0.5c0.3,0,0.5,0.1,0.5,0.4l2.9,7c0.1,0.5,0.399,1,0.399,1l0,0c0,0,0.101-0.5,0.4-1l2.8-7
        c0.1-0.301,0.3-0.4,0.5-0.4h0.5c0.4,0,0.5,0.301,0.4,0.6l-4.801,11.602c-0.5,1.299-1.5,2.1-2.899,2.1c-0.601,0-1-0.301-1.4-0.4
        c-0.3-0.1-0.399-0.4-0.3-0.6l0.1-0.301C464.2,512.701,464.4,512.701,464.7,512.701z"/>
      <path fill="#808285" d="M473.5,509.5c0-0.299,0-0.4,0.3-0.6l5.4-6.801c0.399-0.5,0.8-0.898,0.8-0.898l0,0c0,0-0.4,0-1,0h-4.6
        c-0.4,0-0.5-0.102-0.5-0.5V500.4c0-0.4,0.1-0.5,0.5-0.5h7c0.399,0,0.5,0.1,0.5,0.5v0.1c0,0.301,0,0.4-0.301,0.6L476.2,507.9
        c-0.4,0.5-0.9,0.9-0.9,0.9l0,0c0,0,0.4,0,1,0h5.2c0.4,0,0.5,0.1,0.5,0.5v0.299c0,0.4-0.1,0.5-0.5,0.5H474
        C473.6,510.099,473.5,510,473.5,509.5L473.5,509.5L473.5,509.5z"/>
      <path fill="#808285" d="M487.5,499.701c2.6,0,4.3,2,4.3,4.799c0,0.301-0.3,0.5-0.5,0.5H484c0,2.5,1.9,4,3.9,4
        c1.3,0,2.1-0.5,2.6-0.9c0.3-0.1,0.5-0.1,0.6,0.102l0.101,0.299c0.1,0.301,0.1,0.5-0.101,0.6c-0.5,0.4-1.8,1.102-3.399,1.102
        c-3,0-5.3-2.102-5.3-5.301C482.5,501.701,484.8,499.701,487.5,499.701z M490.3,503.9c-0.1-2.1-1.399-3.1-2.899-3.1
        c-1.601,0-3.101,1.1-3.5,3.1H490.3z"/>
      <path fill="#808285" d="M502.9,503.8h0.6v-0.4c0-2-1-2.6-2.5-2.6c-1.1,0-2,0.4-2.5,0.799c-0.3,0.102-0.5,0.102-0.6-0.1
        l-0.101-0.299c-0.1-0.301-0.1-0.5,0.101-0.602c0.5-0.398,1.6-0.898,3.3-0.898c2.399,0,3.8,1.398,3.8,3.898v6
        c0,0.4-0.1,0.5-0.5,0.5h-0.4c-0.399,0-0.5-0.1-0.5-0.5V508.8c0-0.5,0-0.801,0-0.801l0,0c0,0-0.899,2.301-3.399,2.301
        c-1.8,0-3.4-1-3.4-3C496.7,503.9,500.9,503.8,502.9,503.8z M500.4,509.099c2,0,3.1-2,3.1-3.799v-0.5H503c-1.6,0-4.8,0-4.8,2.4
        C498.1,508.099,498.9,509.099,500.4,509.099z"/>
      <path fill="#808285" d="M506.9,500.4c0-0.4,0.1-0.5,0.5-0.5h0.399c0.3,0,0.5,0.1,0.5,0.5v1.1c0,0.4-0.1,0.801-0.1,0.801l0,0
        c0.399-0.9,1.8-2.6,4.1-2.6c2.5,0,3.4,1.398,3.4,3.898v5.9c0,0.4-0.101,0.5-0.5,0.5h-0.4c-0.399,0-0.5-0.1-0.5-0.5V504
        c0-1.6-0.3-3-2.3-3c-2.1,0-3.9,1.801-3.9,4.1v4.4c0,0.4-0.1,0.5-0.5,0.5H507.2c-0.4,0-0.5-0.1-0.5-0.5v-9L506.9,500.4L506.9,500.4
        z"/>
      <path fill="#808285" d="M521.7,499.701c2.5,0,3.3,2,3.3,2l0,0c0,0,0-0.4,0-0.801v-4.5c0-0.4,0.1-0.5,0.5-0.5h0.4
        c0.399,0,0.5,0.1,0.5,0.5v13.199c0,0.4-0.101,0.5-0.5,0.5h-0.4c-0.4,0-0.5-0.1-0.5-0.5V508.8c0-0.4,0.1-0.6,0.1-0.6l0,0
        c0,0-0.899,2.1-3.5,2.1c-2.8,0-4.399-2.1-4.399-5.301C517.2,501.701,519.1,499.701,521.7,499.701z M521.9,509
        c1.6,0,3.3-1.299,3.3-4c0-2-1-4-3.3-4c-1.801,0-3.301,1.5-3.301,4S520,509,521.9,509z"/>
      <path fill="#808285" d="M537.6,499.701c3,0,5.4,2.299,5.4,5.299s-2.4,5.4-5.3,5.4c-3,0-5.4-2.301-5.4-5.4
        S534.7,499.701,537.6,499.701z M537.7,509c2.1,0,3.899-1.799,3.899-4.1s-1.8-4-3.899-4c-2.101,0-3.9,1.801-3.9,4
        C533.7,507.201,535.4,509,537.7,509z"/>
      <path fill="#808285" d="M544.6,500.4c0-0.4,0.101-0.5,0.5-0.5h0.4c0.4,0,0.5,0.1,0.5,0.5v0.801c0,0.398,0,0.6,0,0.6l0,0
        c0,0,0.9-2.1,3.5-2.1c2.8,0,4.4,2.1,4.4,5.299c0,3.201-1.9,5.301-4.5,5.301c-2.5,0-3.4-2-3.4-2l0,0c0,0,0.1,0.4,0.1,0.9v4.398
        c0,0.4-0.1,0.5-0.5,0.5H545.2c-0.4,0-0.5-0.1-0.5-0.5v-13.1L544.6,500.4L544.6,500.4z M549.1,509c1.801,0,3.301-1.5,3.301-4
        s-1.4-4-3.101-4c-1.6,0-3.3,1.301-3.3,4.1C545.8,507,547,509,549.1,509z"/>
      <path fill="#808285" d="M555.8,501.099H554.9c-0.4,0-0.5-0.1-0.5-0.5v-0.1c0-0.4,0.1-0.5,0.5-0.5h0.899v-2.4
        c0-0.398,0.101-0.5,0.5-0.5h0.4c0.399,0,0.5,0.102,0.5,0.5v2.4h2c0.399,0,0.5,0.1,0.5,0.5v0.1c0,0.4-0.101,0.5-0.5,0.5h-2v5
        c0,2.4,1.399,2.602,2.3,2.602c0.4,0,0.5,0.1,0.5,0.5v0.299c0,0.4-0.1,0.5-0.5,0.5c-2.3,0-3.5-1.4-3.5-3.799v-5.102H555.8z"/>
      <path fill="#808285" d="M560.9,497v-0.799c0-0.4,0.1-0.5,0.5-0.5h0.5c0.399,0,0.5,0.1,0.5,0.5V497c0,0.4-0.101,0.5-0.5,0.5h-0.5
        C561.1,497.5,560.9,497.4,560.9,497z M560.9,500.4c0-0.4,0.1-0.5,0.5-0.5h0.399c0.4,0,0.5,0.1,0.5,0.5v9.199
        c0,0.4-0.1,0.5-0.5,0.5H561.4c-0.4,0-0.5-0.1-0.5-0.5V500.4z"/>
      <path fill="#808285" d="M564.7,500.4c0-0.4,0.1-0.5,0.5-0.5h0.399c0.301,0,0.5,0.1,0.5,0.5v1.1c0,0.4-0.1,0.801-0.1,0.801l0,0
        c0.5-1.4,2.1-2.6,3.8-2.6c1.9,0,2.9,0.898,3.101,2.5l0,0c0.5-1.301,2-2.5,3.8-2.5c2.5,0,3.399,1.398,3.399,3.898v5.9
        c0,0.4-0.1,0.5-0.5,0.5H579.2c-0.4,0-0.5-0.1-0.5-0.5V504c0-1.6-0.4-3-2.101-3c-2,0-3.399,2.1-3.399,4.301v4.4
        c0,0.398-0.101,0.5-0.5,0.5h-0.4c-0.399,0-0.5-0.102-0.5-0.5v-5.602c0-1.5-0.3-3-2.1-3c-2,0-3.5,2.102-3.5,4.301v4.4
        c0,0.4-0.101,0.5-0.5,0.5h-0.4c-0.399,0-0.5-0.1-0.5-0.5L564.7,500.4L564.7,500.4z"/>
      <path fill="#808285" d="M582,497v-0.799c0-0.4,0.1-0.5,0.5-0.5h0.5c0.4,0,0.5,0.1,0.5,0.5V497c0,0.4-0.1,0.5-0.5,0.5h-0.5
        C582.2,497.5,582,497.4,582,497z M582,500.4c0-0.4,0.1-0.5,0.5-0.5h0.4c0.399,0,0.5,0.1,0.5,0.5v9.199c0,0.4-0.101,0.5-0.5,0.5
        h-0.4c-0.4,0-0.5-0.1-0.5-0.5V500.4z"/>
      <path fill="#808285" d="M584.8,509.5c0-0.299,0-0.4,0.3-0.6l5.4-6.801c0.4-0.5,0.8-0.898,0.8-0.898l0,0c0,0-0.399,0-1,0h-4.6
        c-0.4,0-0.5-0.102-0.5-0.5V500.4c0-0.4,0.1-0.5,0.5-0.5h7c0.399,0,0.5,0.1,0.5,0.5v0.1c0,0.301,0,0.4-0.3,0.6l-5.4,6.801
        c-0.4,0.5-0.9,0.9-0.9,0.9l0,0c0,0,0.4,0,1,0h5.2c0.4,0,0.5,0.1,0.5,0.5v0.299c0,0.4-0.1,0.5-0.5,0.5h-7.5
        C584.9,510.099,584.8,510,584.8,509.5L584.8,509.5L584.8,509.5z"/>
      <path fill="#808285" d="M599,499.701c2.6,0,4.3,2,4.3,4.799c0,0.301-0.3,0.5-0.5,0.5h-7.3c0,2.5,1.9,4,3.9,4
        c1.3,0,2.1-0.5,2.6-0.9c0.3-0.1,0.5-0.1,0.6,0.102l0.101,0.299c0.1,0.301,0.1,0.5-0.101,0.6c-0.5,0.4-1.8,1.102-3.399,1.102
        c-3,0-5.3-2.102-5.3-5.301C594,501.701,596.2,499.701,599,499.701z M601.8,503.9c-0.1-2.1-1.399-3.1-2.899-3.1
        c-1.601,0-3.101,1.1-3.5,3.1H601.8z"/>
      <path fill="#808285" d="M613.6,499.701c3,0,5.4,2.299,5.4,5.299s-2.4,5.4-5.3,5.4c-3,0-5.4-2.301-5.4-5.4
        S610.7,499.701,613.6,499.701z M613.6,509c2.101,0,3.9-1.799,3.9-4.1s-1.8-4-3.9-4c-2.1,0-3.899,1.801-3.899,4
        C609.7,507.201,611.4,509,613.6,509z"/>
      <path fill="#808285" d="M620.4,500.4c0-0.4,0.1-0.5,0.5-0.5h0.399c0.4,0,0.5,0.1,0.5,0.5v5.5c0,1.6,0.3,3,2.101,3
        c2.3,0,3.8-2,3.8-4.301v-4.398c0-0.4,0.1-0.5,0.5-0.5h0.399c0.4,0,0.5,0.1,0.5,0.5v9.199c0,0.4-0.1,0.5-0.5,0.5H628.2
        c-0.4,0-0.5-0.1-0.5-0.5v-1.1c0-0.4,0-0.801,0-0.801l0,0c-0.4,1-1.8,2.6-4,2.6c-2.4,0-3.4-1.299-3.4-3.898v-5.9L620.4,500.4
        L620.4,500.4z"/>
      <path fill="#808285" d="M631.4,500.4c0-0.4,0.1-0.5,0.5-0.5h0.399c0.3,0,0.5,0.1,0.5,0.5v1.4c0,0.5-0.1,0.799-0.1,0.799l0,0
        c0.5-1.5,1.6-2.799,3.3-2.799c0.4,0,0.5,0.1,0.5,0.5v0.4c0,0.398-0.3,0.5-0.5,0.5c-2.1,0-3.1,2.398-3.1,4.5v3.799
        c0,0.4-0.101,0.5-0.5,0.5H632c-0.4,0-0.5-0.1-0.5-0.5L631.4,500.4L631.4,500.4z"/>
      <path fill="#808285" d="M429.4,524.3c0-0.4,0.1-0.5,0.5-0.5h0.399c0.3,0,0.5,0.1,0.5,0.5v1.1c0,0.4-0.1,0.801-0.1,0.801l0,0
        c0.5-1.4,2.1-2.602,3.8-2.602c1.9,0,2.9,0.9,3.1,2.5l0,0c0.5-1.299,2-2.5,3.801-2.5c2.5,0,3.399,1.4,3.399,3.9v5.9
        c0,0.4-0.1,0.5-0.5,0.5H443.9c-0.4,0-0.5-0.1-0.5-0.5v-5.5c0-1.6-0.4-3-2.101-3c-2,0-3.399,2.1-3.399,4.301v4.398
        c0,0.4-0.101,0.5-0.5,0.5H437c-0.4,0-0.5-0.1-0.5-0.5v-5.5c0-1.5-0.3-3-2.1-3c-2,0-3.5,2.102-3.5,4.301v4.4
        c0,0.4-0.101,0.5-0.5,0.5H430c-0.4,0-0.5-0.1-0.5-0.5L429.4,524.3L429.4,524.3z"/>
      <path fill="#808285" d="M452.1,527.701h0.601v-0.4c0-2-1-2.6-2.5-2.6c-1.101,0-2,0.398-2.5,0.799c-0.3,0.1-0.5,0.1-0.601-0.1
        l-0.1-0.301c-0.1-0.299-0.1-0.5,0.1-0.6c0.5-0.4,1.601-0.9,3.301-0.9c2.399,0,3.8,1.4,3.8,3.9v6c0,0.4-0.101,0.5-0.5,0.5h-0.4
        c-0.399,0-0.5-0.1-0.5-0.5v-0.799c0-0.5,0-0.801,0-0.801l0,0c0,0-0.899,2.301-3.399,2.301c-1.801,0-3.4-1-3.4-3
        C446,527.8,450.1,527.701,452.1,527.701z M449.6,533c2,0,3.101-2,3.101-3.799v-0.5h-0.5c-1.601,0-4.8,0-4.8,2.398
        C447.3,532,448.1,533,449.6,533z"/>
      <path fill="#808285" d="M456.3,524.3c0-0.4,0.101-0.5,0.5-0.5h0.4c0.3,0,0.5,0.1,0.5,0.5v1.4c0,0.5-0.101,0.799-0.101,0.799l0,0
        c0.5-1.5,1.601-2.799,3.301-2.799c0.399,0,0.5,0.1,0.5,0.5v0.398c0,0.4-0.301,0.5-0.5,0.5c-2.101,0-3.101,2.4-3.101,4.5v3.801
        c0,0.4-0.1,0.5-0.5,0.5H456.9c-0.4,0-0.5-0.1-0.5-0.5v-9.1H456.3L456.3,524.3z"/>
      <path fill="#808285" d="M462.2,520.3c0-0.4,0.1-0.5,0.5-0.5h0.399c0.4,0,0.5,0.1,0.5,0.5v7.4h1.601l2.8-3.5
        c0.1-0.301,0.4-0.301,0.6-0.301h0.5c0.4,0,0.5,0.301,0.301,0.6l-3,3.801l0,0l3.5,5c0.3,0.4,0.1,0.6-0.4,0.6H469
        c-0.3,0-0.5-0.1-0.6-0.4l-3.101-4.6h-1.8v4.5c0,0.4-0.1,0.5-0.5,0.5h-0.4c-0.399,0-0.5-0.1-0.5-0.5v-13.1H462.2z"/>
      <path fill="#808285" d="M475.4,523.5c2.6,0,4.3,2,4.3,4.801c0,0.299-0.3,0.5-0.5,0.5h-7.4c0,2.5,1.9,4,3.9,4
        c1.3,0,2.1-0.5,2.6-0.9c0.3-0.1,0.5-0.1,0.601,0.1l0.1,0.301c0.1,0.299,0.1,0.5-0.1,0.6c-0.5,0.4-1.801,1.1-3.4,1.1
        c-3,0-5.3-2.1-5.3-5.299C470.3,525.599,472.6,523.5,475.4,523.5z M478.1,527.8c-0.1-2.1-1.399-3.1-2.899-3.1
        c-1.601,0-3.101,1.1-3.5,3.1H478.1z"/>
      <path fill="#808285" d="M481.5,524.9h-0.9c-0.399,0-0.5-0.1-0.5-0.5v-0.1c0-0.4,0.101-0.5,0.5-0.5h0.9v-2.4c0-0.4,0.1-0.5,0.5-0.5
        h0.4c0.399,0,0.5,0.1,0.5,0.5v2.4h2c0.399,0,0.5,0.1,0.5,0.5v0.1c0,0.4-0.101,0.5-0.5,0.5h-2v5c0,2.4,1.399,2.6,2.3,2.6
        c0.399,0,0.5,0.1,0.5,0.5v0.301c0,0.4-0.101,0.5-0.5,0.5c-2.3,0-3.5-1.4-3.5-3.801V524.8L481.5,524.9L481.5,524.9z"/>
      <path fill="#808285" d="M486.7,520.9v-0.801c0-0.398,0.1-0.5,0.5-0.5h0.5c0.399,0,0.5,0.102,0.5,0.5v0.801
        c0,0.4-0.101,0.5-0.5,0.5h-0.5C486.8,521.4,486.7,521.3,486.7,520.9z M486.7,524.3c0-0.4,0.1-0.5,0.5-0.5h0.399
        c0.4,0,0.5,0.1,0.5,0.5v9.199c0,0.4-0.1,0.5-0.5,0.5H487.2c-0.4,0-0.5-0.1-0.5-0.5V524.3z"/>
      <path fill="#808285" d="M490.4,524.3c0-0.4,0.1-0.5,0.5-0.5h0.399c0.3,0,0.5,0.1,0.5,0.5v1.1c0,0.4-0.1,0.801-0.1,0.801l0,0
        c0.399-0.9,1.8-2.602,4.1-2.602c2.5,0,3.4,1.4,3.4,3.9v5.9c0,0.4-0.101,0.5-0.5,0.5h-0.4c-0.399,0-0.5-0.1-0.5-0.5v-5.5
        c0-1.6-0.3-3-2.3-3c-2.1,0-3.9,1.801-3.9,4.1v4.4c0,0.4-0.1,0.5-0.5,0.5H490.7c-0.4,0-0.5-0.1-0.5-0.5v-9L490.4,524.3L490.4,524.3
        z"/>
      <path fill="#808285" d="M502.6,536.4c0.5,0.301,1.301,0.5,2.4,0.5c1.9,0,3.5-0.9,3.5-3.1v-1c0-0.4,0-0.801,0-0.801l0,0
        c-0.6,1.1-1.6,1.9-3.3,1.9c-2.8,0-4.5-2.1-4.5-5.301c0-3,1.6-5,4.5-5c2.6,0,3.3,1.9,3.3,1.9l0,0c0,0,0-0.1,0-0.4v-0.898
        c0-0.301,0.1-0.5,0.5-0.5h0.4c0.399,0,0.5,0.1,0.5,0.5v9.398c0,3.301-2.4,4.5-4.801,4.5c-1,0-2-0.299-2.899-0.6
        c-0.3-0.1-0.4-0.4-0.3-0.6l0.1-0.299C502.1,536.4,502.2,536.201,502.6,536.4z M508.4,528.701c0-3-1.5-3.9-3.101-3.9
        c-2,0-3.1,1.5-3.1,3.799c0,2.5,1.3,4,3.3,4C507,532.599,508.4,531.599,508.4,528.701z"/>
      <path fill="#808285" d="M520.6,523.5c2.601,0,4.301,2,4.301,4.801c0,0.299-0.301,0.5-0.5,0.5H517.1c0,2.5,1.9,4,3.9,4
        c1.3,0,2.1-0.5,2.6-0.9c0.301-0.1,0.5-0.1,0.601,0.1l0.1,0.301c0.101,0.299,0.101,0.5-0.1,0.6c-0.5,0.4-1.8,1.1-3.4,1.1
        c-3,0-5.3-2.1-5.3-5.299C515.6,525.599,517.8,523.5,520.6,523.5z M523.5,527.8c-0.1-2.1-1.4-3.1-2.9-3.1c-1.6,0-3.1,1.1-3.5,3.1
        H523.5z"/>
      <path fill="#808285" d="M526.8,524.9H526c-0.4,0-0.5-0.1-0.5-0.5v-0.1c0-0.4,0.1-0.5,0.5-0.5h0.8v-0.4c0-3.1,2.4-3.801,3.4-3.801
        h0.3c0.4,0,0.5,0.102,0.5,0.5v0.301c0,0.4-0.1,0.5-0.5,0.5c-0.9,0-2.1,0.301-2.1,2.5v0.4h4.8v-0.4c0-3.1,2.399-3.801,3.399-3.801
        h0.301c0.399,0,0.5,0.102,0.5,0.5v0.301c0,0.4-0.301,0.5-0.5,0.5c-0.9,0-2.101,0.301-2.101,2.5v0.4h2.101c0.399,0,0.5,0.1,0.5,0.5
        v0.1c0,0.4-0.101,0.5-0.5,0.5h-2.4v8.4c0,0.4-0.1,0.5-0.5,0.5h-0.4c-0.399,0-0.5-0.1-0.5-0.5v-8.4h-4.8v8.4c0,0.4-0.1,0.5-0.5,0.5
        h-0.3c-0.4,0-0.5-0.1-0.5-0.5v-8.4H526.8z"/>
      <path fill="#808285" d="M542.3,523.5c3,0,5.4,2.301,5.4,5.301s-2.4,5.4-5.3,5.4c-3,0-5.4-2.301-5.4-5.4
        C536.9,525.8,539.3,523.5,542.3,523.5z M542.3,532.8c2.101,0,3.9-1.801,3.9-4.1c0-2.301-1.8-4-3.9-4c-2.1,0-3.899,1.799-3.899,4
        C538.3,531.099,540.1,532.8,542.3,532.8z"/>
      <path fill="#808285" d="M549.2,524.3c0-0.4,0.1-0.5,0.5-0.5h0.399c0.301,0,0.5,0.1,0.5,0.5v1.4c0,0.5-0.1,0.799-0.1,0.799l0,0
        c0.5-1.5,1.6-2.799,3.3-2.799c0.4,0,0.5,0.1,0.5,0.5v0.398c0,0.4-0.3,0.5-0.5,0.5c-2.1,0-3.1,2.4-3.1,4.5v3.801
        c0,0.4-0.101,0.5-0.5,0.5h-0.4c-0.399,0-0.5-0.1-0.5-0.5L549.2,524.3L549.2,524.3z"/>
      <path fill="#808285" d="M555.7,524.9h-0.9c-0.399,0-0.5-0.1-0.5-0.5v-0.1c0-0.4,0.101-0.5,0.5-0.5h0.9v-2.4c0-0.4,0.1-0.5,0.5-0.5
        h0.399c0.4,0,0.5,0.1,0.5,0.5v2.4h2c0.4,0,0.5,0.1,0.5,0.5v0.1c0,0.4-0.1,0.5-0.5,0.5h-2v5c0,2.4,1.4,2.6,2.301,2.6
        c0.399,0,0.5,0.1,0.5,0.5v0.301c0,0.4-0.101,0.5-0.5,0.5c-2.301,0-3.5-1.4-3.5-3.801V524.8L555.7,524.9L555.7,524.9z"/>
      <path fill="#808285" d="M560.2,532.201l0.1-0.301c0.101-0.301,0.4-0.301,0.601-0.1c0.5,0.4,1.399,0.9,2.6,0.9c1.1,0,2-0.5,2-1.602
        c0-2.299-5.4-1.6-5.4-4.898c0-1.9,1.601-2.9,3.4-2.9c1.5,0,2.4,0.5,2.8,0.9c0.3,0.1,0.3,0.398,0.101,0.6l-0.101,0.299
        c-0.1,0.301-0.399,0.301-0.6,0.102c-0.4-0.301-1.101-0.602-2.101-0.602s-2,0.5-2,1.5c0,2.4,5.4,1.602,5.4,5
        c0,1.602-1.4,2.9-3.4,2.9c-1.8,0-2.899-0.799-3.399-1.1C560,532.701,560,532.599,560.2,532.201z"/>
    </g>
    <g>
      <path fill="#808285" d="M168.5,588.9c0-0.4,0.1-0.5,0.5-0.5h0.5c0.3,0,0.5,0.1,0.6,0.4l7,9.799c0.5,0.801,1.1,1.9,1.1,1.9l0,0
        c0,0-0.1-1.1-0.1-1.9V588.9c0-0.4,0.1-0.5,0.5-0.5h0.4c0.4,0,0.5,0.1,0.5,0.5v13.199c0,0.4-0.1,0.5-0.5,0.5h-0.5
        c-0.3,0-0.5-0.1-0.6-0.398l-7-9.801c-0.5-0.801-1.1-1.9-1.1-1.9l0,0c0,0,0.1,1.1,0.1,1.9v9.699c0,0.4-0.1,0.5-0.5,0.5h-0.5
        c-0.4,0-0.5-0.1-0.5-0.5V588.9H168.5z"/>
      <path fill="#808285" d="M186.4,592.3c2.6,0,4.3,2,4.3,4.799c0,0.301-0.3,0.5-0.5,0.5h-7.4c0,2.5,1.9,4,3.9,4
        c1.3,0,2.1-0.5,2.6-0.898c0.3-0.102,0.5-0.102,0.6,0.1l0.1,0.299c0.1,0.301,0.1,0.5-0.1,0.602c-0.5,0.398-1.8,1.1-3.4,1.1
        c-3,0-5.3-2.1-5.3-5.301C181.3,594.201,183.6,592.3,186.4,592.3z M189.2,596.599c-0.1-2.1-1.4-3.1-2.9-3.1c-1.6,0-3.1,1.1-3.5,3.1
        H189.2z"/>
      <path fill="#808285" d="M193.4,605.099c0.5,0.301,1.3,0.5,2.4,0.5c1.9,0,3.5-0.898,3.5-3.1v-1c0-0.4,0-0.799,0-0.799l0,0
        c-0.6,1.1-1.6,1.898-3.3,1.898c-2.8,0-4.5-2.1-4.5-5.299c0-3,1.6-5,4.5-5c2.6,0,3.3,1.9,3.3,1.9l0,0c0,0,0-0.102,0-0.4v-0.9
        c0-0.301,0.1-0.5,0.5-0.5h0.4c0.4,0,0.5,0.1,0.5,0.5v9.4c0,3.299-2.4,4.5-4.8,4.5c-1,0-2-0.301-2.9-0.6
        c-0.3-0.102-0.4-0.4-0.3-0.602l0.1-0.299C192.9,605,193.1,605,193.4,605.099z M199.3,597.4c0-3-1.5-3.9-3.1-3.9
        c-2,0-3.1,1.5-3.1,3.801c0,2.5,1.3,4,3.3,4C197.9,601.3,199.3,600.3,199.3,597.4z"/>
      <path fill="#808285" d="M207.5,592.3c3,0,5.4,2.299,5.4,5.299s-2.4,5.4-5.3,5.4c-3,0-5.4-2.299-5.4-5.4
        C202.2,594.5,204.6,592.3,207.5,592.3z M207.6,601.599c2.1,0,3.9-1.799,3.9-4.1c0-2.299-1.8-4-3.9-4s-3.9,1.801-3.9,4
        C203.6,599.8,205.3,601.599,207.6,601.599z"/>
      <path fill="#808285" d="M214.8,593.701h-0.9c-0.4,0-0.5-0.102-0.5-0.5v-0.102c0-0.398,0.1-0.5,0.5-0.5h0.9v-2.5
        c0-0.398,0.1-0.5,0.5-0.5h0.4c0.4,0,0.5,0.102,0.5,0.5v2.4h2c0.4,0,0.5,0.1,0.5,0.5v0.1c0,0.4-0.1,0.5-0.5,0.5h-2v5
        c0,2.4,1.4,2.602,2.3,2.602c0.4,0,0.5,0.1,0.5,0.5V602c0,0.4-0.1,0.5-0.5,0.5c-2.3,0-3.5-1.4-3.5-3.799V593.5h-0.2V593.701z"/>
      <path fill="#808285" d="M219.9,589.599V588.8c0-0.4,0.1-0.5,0.5-0.5h0.5c0.4,0,0.5,0.1,0.5,0.5v0.799c0,0.4-0.1,0.5-0.5,0.5h-0.5
        C220.2,590.099,219.9,590,219.9,589.599z M220,593c0-0.4,0.1-0.5,0.5-0.5h0.4c0.4,0,0.5,0.1,0.5,0.5v9.201
        c0,0.398-0.1,0.5-0.5,0.5h-0.4c-0.4,0-0.5-0.102-0.5-0.5V593z"/>
      <path fill="#808285" d="M229,596.4h0.6V596c0-2-1-2.6-2.5-2.6c-1.1,0-2,0.4-2.5,0.801c-0.3,0.1-0.5,0.1-0.6-0.102l-0.1-0.299
        c-0.1-0.301-0.1-0.5,0.1-0.6c0.5-0.4,1.6-0.9,3.3-0.9c2.4,0,3.8,1.4,3.8,3.9v6c0,0.398-0.1,0.5-0.5,0.5h-0.4
        c-0.4,0-0.5-0.102-0.5-0.5V601.4c0-0.5,0-0.801,0-0.801l0,0c0,0-0.9,2.301-3.4,2.301c-1.8,0-3.4-1-3.4-3
        C222.8,596.599,227.1,596.4,229,596.4z M226.4,601.701c2,0,3.1-2,3.1-3.801v-0.5H229c-1.6,0-4.8,0-4.8,2.4
        C224.2,600.701,224.9,601.701,226.4,601.701z"/>
      <path fill="#808285" d="M233.3,593.701h-0.8c-0.4,0-0.5-0.102-0.5-0.5v-0.102c0-0.398,0.1-0.5,0.5-0.5h0.9v-2.5
        c0-0.398,0.1-0.5,0.5-0.5h0.4c0.4,0,0.5,0.102,0.5,0.5v2.4h2c0.4,0,0.5,0.1,0.5,0.5v0.1c0,0.4-0.1,0.5-0.5,0.5h-2v5
        c0,2.4,1.4,2.602,2.3,2.602c0.4,0,0.5,0.1,0.5,0.5V602c0,0.4-0.1,0.5-0.5,0.5c-2.3,0-3.5-1.4-3.5-3.799V593.5h-0.3V593.701
        L233.3,593.701z"/>
      <path fill="#808285" d="M238.5,589.599V588.8c0-0.4,0.1-0.5,0.5-0.5h0.5c0.4,0,0.5,0.1,0.5,0.5v0.799c0,0.4-0.1,0.5-0.5,0.5H239
        C238.8,590.099,238.5,590,238.5,589.599z M238.6,593c0-0.4,0.1-0.5,0.5-0.5h0.4c0.4,0,0.5,0.1,0.5,0.5v9.201
        c0,0.398-0.1,0.5-0.5,0.5h-0.4c-0.4,0-0.5-0.102-0.5-0.5V593z"/>
      <path fill="#808285" d="M242.3,593c0-0.4,0.1-0.5,0.5-0.5h0.4c0.3,0,0.5,0.1,0.5,0.5v1.1c0,0.4-0.1,0.801-0.1,0.801l0,0
        c0.4-0.9,1.8-2.6,4.1-2.6c2.5,0,3.4,1.4,3.4,3.9v5.898c0,0.4-0.1,0.5-0.5,0.5h-0.4c-0.4,0-0.5-0.1-0.5-0.5v-5.5c0-1.6-0.3-3-2.3-3
        c-2.1,0-3.9,1.801-3.9,4.102v4.398c0,0.4-0.1,0.5-0.5,0.5h-0.4c-0.4,0-0.5-0.1-0.5-0.5v-9L242.3,593L242.3,593z"/>
      <path fill="#808285" d="M254.5,605.099c0.5,0.301,1.3,0.5,2.4,0.5c1.9,0,3.5-0.898,3.5-3.1v-1c0-0.4,0-0.799,0-0.799l0,0
        c-0.6,1.1-1.6,1.898-3.3,1.898c-2.8,0-4.5-2.1-4.5-5.299c0-3,1.6-5,4.5-5c2.6,0,3.3,1.9,3.3,1.9l0,0c0,0,0-0.102,0-0.4v-0.9
        c0-0.301,0.1-0.5,0.5-0.5h0.4c0.4,0,0.5,0.1,0.5,0.5v9.4c0,3.299-2.4,4.5-4.8,4.5c-1,0-2-0.301-2.9-0.6
        c-0.3-0.102-0.4-0.4-0.3-0.602l0.1-0.299C254,605,254.1,605,254.5,605.099z M260.2,597.4c0-3-1.5-3.9-3.1-3.9
        c-2,0-3.1,1.5-3.1,3.801c0,2.5,1.3,4,3.3,4C258.9,601.3,260.2,600.3,260.2,597.4z"/>
      <path fill="#808285" d="M268.5,593.701h-0.9c-0.4,0-0.5-0.102-0.5-0.5v-0.102c0-0.398,0.1-0.5,0.5-0.5h0.9v-2.5
        c0-0.398,0.1-0.5,0.5-0.5h0.4c0.4,0,0.5,0.102,0.5,0.5v2.4h2c0.4,0,0.5,0.1,0.5,0.5v0.1c0,0.4-0.1,0.5-0.5,0.5h-2v5
        c0,2.4,1.4,2.602,2.3,2.602c0.4,0,0.5,0.1,0.5,0.5V602c0,0.4-0.1,0.5-0.5,0.5c-2.3,0-3.5-1.4-3.5-3.799V593.5h-0.2V593.701
        L268.5,593.701z"/>
      <path fill="#808285" d="M273.8,588.9c0-0.4,0.1-0.5,0.5-0.5h0.4c0.4,0,0.5,0.1,0.5,0.5v5c0,0.5-0.1,0.9-0.1,0.9l0,0
        c0.4-1,1.8-2.6,4-2.6c2.5,0,3.4,1.398,3.4,3.898v5.9c0,0.4-0.1,0.5-0.5,0.5h-0.4c-0.4,0-0.5-0.1-0.5-0.5v-5.5c0-1.6-0.3-3-2.3-3
        c-2.1,0-3.8,1.801-3.8,4.1v4.4c0,0.4-0.1,0.5-0.5,0.5h-0.4c-0.4,0-0.5-0.1-0.5-0.5v-13.1H273.8L273.8,588.9z"/>
      <path fill="#808285" d="M289,592.3c2.6,0,4.3,2,4.3,4.799c0,0.301-0.3,0.5-0.5,0.5h-7.3c0,2.5,1.9,4,3.9,4
        c1.3,0,2.1-0.5,2.6-0.898c0.3-0.102,0.5-0.102,0.6,0.1l0.1,0.299c0.1,0.301,0.1,0.5-0.1,0.602c-0.5,0.398-1.8,1.1-3.4,1.1
        c-3,0-5.3-2.1-5.3-5.301C284.1,594.201,286.4,592.3,289,592.3z M291.9,596.599c-0.1-2.1-1.4-3.1-2.9-3.1c-1.6,0-3.1,1.1-3.5,3.1
        H291.9z"/>
      <path fill="#808285" d="M299.1,588.9c0-0.4,0.1-0.5,0.5-0.5h0.4c0.4,0,0.5,0.1,0.5,0.5v4.5c0,0.5-0.1,0.9-0.1,0.9l0,0
        c0,0,0.9-2,3.5-2c2.8,0,4.4,2.1,4.4,5.299c0,3.301-1.899,5.301-4.5,5.301c-2.5,0-3.4-2.1-3.4-2.1l0,0c0,0,0.1,0.299,0.1,0.799
        v0.602c0,0.299-0.1,0.5-0.5,0.5h-0.4c-0.4,0-0.5-0.102-0.5-0.5V588.9z M303.6,601.599c1.8,0,3.3-1.5,3.3-4s-1.4-4-3.101-4
        c-1.6,0-3.3,1.301-3.3,4C300.4,599.599,301.5,601.599,303.6,601.599z"/>
      <path fill="#808285" d="M314.3,592.3c2.601,0,4.3,2,4.3,4.799c0,0.301-0.3,0.5-0.5,0.5h-7.3c0,2.5,1.9,4,3.9,4
        c1.3,0,2.1-0.5,2.6-0.898c0.3-0.102,0.5-0.102,0.601,0.1l0.1,0.299c0.1,0.301,0.1,0.5-0.1,0.602c-0.5,0.398-1.801,1.1-3.4,1.1
        c-3,0-5.3-2.1-5.3-5.301C309.4,594.201,311.5,592.3,314.3,592.3z M317.2,596.599c-0.101-2.1-1.4-3.1-2.9-3.1
        c-1.6,0-3.1,1.1-3.5,3.1H317.2z"/>
      <path fill="#808285" d="M319.4,600.9l0.1-0.301c0.1-0.299,0.4-0.299,0.6-0.1c0.5,0.4,1.4,0.9,2.601,0.9c1.1,0,2-0.5,2-1.6
        c0-2.301-5.4-1.6-5.4-4.9c0-1.9,1.601-2.9,3.4-2.9c1.5,0,2.399,0.5,2.8,0.9c0.3,0.1,0.3,0.4,0.1,0.6l-0.1,0.301
        c-0.1,0.299-0.4,0.299-0.6,0.1c-0.4-0.301-1.101-0.6-2.101-0.6s-2,0.5-2,1.5c0,2.4,5.4,1.6,5.4,5c0,1.6-1.4,2.9-3.4,2.9
        c-1.8,0-2.899-0.801-3.399-1.102C319.3,601.5,319.3,601.201,319.4,600.9z"/>
      <path fill="#808285" d="M328.3,593.701h-0.8c-0.4,0-0.5-0.102-0.5-0.5v-0.102c0-0.398,0.1-0.5,0.5-0.5h0.9v-2.5
        c0-0.398,0.1-0.5,0.5-0.5h0.399c0.4,0,0.5,0.102,0.5,0.5v2.4h2c0.4,0,0.5,0.1,0.5,0.5v0.1c0,0.4-0.1,0.5-0.5,0.5h-2v5
        c0,2.4,1.4,2.602,2.3,2.602c0.4,0,0.5,0.1,0.5,0.5V602c0,0.4-0.1,0.5-0.5,0.5c-2.3,0-3.5-1.4-3.5-3.799V593.5h-0.3V593.701z"/>
      <path fill="#808285" d="M172.7,616.201c3,0,5.4,2.299,5.4,5.299s-2.4,5.4-5.3,5.4c-3,0-5.4-2.301-5.4-5.4
        S169.8,616.201,172.7,616.201z M172.7,625.5c2.1,0,3.9-1.799,3.9-4.1s-1.8-4-3.9-4c-2.1,0-3.9,1.801-3.9,4
        C168.8,623.701,170.5,625.5,172.7,625.5z"/>
      <path fill="#808285" d="M179.9,617.5h-0.8c-0.4,0-0.5-0.1-0.5-0.5v-0.1c0-0.4,0.1-0.5,0.5-0.5h0.8v-0.5c0-3.1,2.4-3.801,3.4-3.801
        h0.3c0.4,0,0.5,0.102,0.5,0.5v0.301c0,0.4-0.1,0.5-0.5,0.5c-0.9,0-2.1,0.301-2.1,2.5v0.4h4.8v-0.4c0-3.1,2.4-3.801,3.4-3.801h0.3
        c0.4,0,0.5,0.102,0.5,0.5v0.301c0,0.4-0.3,0.5-0.5,0.5c-0.9,0-2.1,0.301-2.1,2.5v0.4h2.1c0.4,0,0.5,0.1,0.5,0.5v0.1
        c0,0.4-0.1,0.5-0.5,0.5h-2.1v8.4c0,0.4-0.1,0.5-0.5,0.5h-0.9c-0.4,0-0.5-0.1-0.5-0.5v-8.4h-4.8v8.4c0,0.4-0.1,0.5-0.5,0.5h-0.4
        c-0.4,0-0.5-0.1-0.5-0.5V617.5H179.9L179.9,617.5z"/>
      <path fill="#808285" d="M195.2,616.201c2.6,0,4.3,2,4.3,4.799c0,0.301-0.3,0.5-0.5,0.5h-7.5c0,2.5,1.9,4,3.9,4
        c1.3,0,2.1-0.5,2.6-0.9c0.3-0.1,0.5-0.1,0.6,0.102l0.1,0.299c0.1,0.301,0.1,0.5-0.1,0.6c-0.5,0.4-1.8,1.102-3.4,1.102
        c-3,0-5.3-2.102-5.3-5.301C190.1,618,192.4,616.201,195.2,616.201z M197.9,620.4c-0.1-2.1-1.4-3.1-2.9-3.1c-1.6,0-3.1,1.1-3.5,3.1
        H197.9z"/>
      <path fill="#808285" d="M200.9,616.9c0-0.4,0.1-0.5,0.5-0.5h0.4c0.3,0,0.5,0.1,0.5,0.5v1.4c0,0.5-0.1,0.799-0.1,0.799l0,0
        c0.5-1.5,1.6-2.799,3.3-2.799c0.4,0,0.5,0.1,0.5,0.5v0.4c0,0.398-0.3,0.5-0.5,0.5c-2.1,0-3.1,2.398-3.1,4.5V626
        c0,0.4-0.1,0.5-0.5,0.5h-0.4c-0.4,0-0.5-0.1-0.5-0.5v-9.1H200.9L200.9,616.9z"/>
      <path fill="#808285" d="M211.5,617.5h-0.8c-0.4,0-0.5-0.1-0.5-0.5v-0.1c0-0.4,0.1-0.5,0.5-0.5h0.8v-0.5c0-3.1,2.4-3.801,3.4-3.801
        h0.3c0.4,0,0.5,0.102,0.5,0.5v0.301c0,0.4-0.1,0.5-0.5,0.5c-0.9,0-2.1,0.301-2.1,2.5v0.5h2.1c0.4,0,0.5,0.1,0.5,0.5v0.1
        c0,0.4-0.1,0.5-0.5,0.5h-2.3v8.4c0,0.4-0.1,0.5-0.5,0.5H212c-0.4,0-0.5-0.1-0.5-0.5V617.5L211.5,617.5z"/>
      <path fill="#808285" d="M220.9,616.201c3,0,5.4,2.299,5.4,5.299s-2.4,5.4-5.3,5.4c-3,0-5.4-2.301-5.4-5.4
        C215.5,618.4,217.9,616.201,220.9,616.201z M220.9,625.5c2.1,0,3.9-1.799,3.9-4.1s-1.8-4-3.9-4s-3.9,1.801-3.9,4
        C216.9,623.701,218.6,625.5,220.9,625.5z"/>
      <path fill="#808285" d="M227.8,616.9c0-0.4,0.1-0.5,0.5-0.5h0.4c0.3,0,0.5,0.1,0.5,0.5v1.4c0,0.5-0.1,0.799-0.1,0.799l0,0
        c0.5-1.5,1.6-2.799,3.3-2.799c0.4,0,0.5,0.1,0.5,0.5v0.4c0,0.398-0.3,0.5-0.5,0.5c-2.1,0-3.1,2.398-3.1,4.5V626
        c0,0.4-0.1,0.5-0.5,0.5h-0.4c-0.4,0-0.5-0.1-0.5-0.5v-9.1H227.8L227.8,616.9z"/>
      <path fill="#808285" d="M237.4,629.201c0.3,0.1,0.5,0.299,0.9,0.299c0.9,0,1.5-0.799,1.9-1.6l0.6-1.4l-4-9.4
        c-0.1-0.398,0-0.6,0.4-0.6h0.5c0.3,0,0.5,0.1,0.5,0.4l2.9,7c0.1,0.5,0.4,1,0.4,1l0,0c0,0,0.1-0.5,0.4-1l2.8-7
        c0.1-0.301,0.3-0.4,0.5-0.4h0.5c0.4,0,0.5,0.301,0.4,0.6l-4.8,11.602c-0.5,1.299-1.5,2.1-2.9,2.1c-0.6,0-1-0.301-1.4-0.4
        c-0.3-0.1-0.4-0.4-0.3-0.6l0.1-0.301C237,629.201,237.1,629.099,237.4,629.201z"/>
      <path fill="#808285" d="M251.6,616.201c3,0,5.4,2.299,5.4,5.299s-2.4,5.4-5.3,5.4c-3,0-5.4-2.301-5.4-5.4
        S248.7,616.201,251.6,616.201z M251.6,625.5c2.1,0,3.9-1.799,3.9-4.1s-1.8-4-3.9-4s-3.9,1.801-3.9,4
        C247.7,623.701,249.4,625.5,251.6,625.5z"/>
      <path fill="#808285" d="M258.5,616.9c0-0.4,0.1-0.5,0.5-0.5h0.4c0.4,0,0.5,0.1,0.5,0.5v5.5c0,1.6,0.3,3,2.1,3
        c2.3,0,3.8-2,3.8-4.301v-4.398c0-0.4,0.1-0.5,0.5-0.5h0.4c0.4,0,0.5,0.1,0.5,0.5v9.199c0,0.4-0.1,0.5-0.5,0.5h-0.4
        c-0.4,0-0.5-0.1-0.5-0.5v-1.1c0-0.4,0-0.801,0-0.801l0,0c-0.4,1-1.8,2.6-4,2.6c-2.4,0-3.4-1.299-3.4-3.898v-5.9L258.5,616.9
        L258.5,616.9z"/>
    </g>
    <g>
      <path fill="#808285" d="M433,690.201h-4.5c-0.4,0-0.5-0.102-0.5-0.5V689.4c0-0.4,0.1-0.5,0.5-0.5h10.6c0.4,0,0.5,0.1,0.5,0.5
        v0.301c0,0.398-0.1,0.5-0.5,0.5h-4.6v12.398c0,0.4-0.1,0.5-0.5,0.5h-0.4c-0.399,0-0.5-0.1-0.5-0.5L433,690.201L433,690.201z"/>
      <path fill="#808285" d="M438.5,693.4c0-0.4,0.1-0.5,0.5-0.5h0.4c0.3,0,0.5,0.1,0.5,0.5v1.4c0,0.5-0.101,0.799-0.101,0.799l0,0
        c0.5-1.5,1.601-2.799,3.3-2.799c0.4,0,0.5,0.1,0.5,0.5v0.4c0,0.398-0.3,0.5-0.5,0.5c-2.1,0-3.1,2.398-3.1,4.5v3.799
        c0,0.4-0.1,0.5-0.5,0.5h-0.4c-0.399,0-0.5-0.1-0.5-0.5L438.5,693.4L438.5,693.4z"/>
      <path fill="#808285" d="M449.7,696.8h0.6v-0.4c0-2-1-2.6-2.5-2.6c-1.1,0-2,0.4-2.5,0.799c-0.3,0.102-0.5,0.102-0.6-0.1
        l-0.101-0.299c-0.1-0.301-0.1-0.5,0.101-0.602c0.5-0.398,1.6-0.898,3.3-0.898c2.4,0,3.8,1.398,3.8,3.898v6c0,0.4-0.1,0.5-0.5,0.5
        H450.9c-0.4,0-0.5-0.1-0.5-0.5V701.8c0-0.5,0-0.801,0-0.801l0,0c0,0-0.9,2.301-3.4,2.301c-1.8,0-3.4-1-3.4-3
        C443.6,696.9,447.8,696.8,449.7,696.8z M447.2,702.099c2,0,3.1-2,3.1-3.799v-0.5h-0.5c-1.6,0-4.8,0-4.8,2.4
        C445,701.099,445.7,702.099,447.2,702.099z"/>
      <path fill="#808285" d="M453.9,693.4c0-0.4,0.1-0.5,0.5-0.5h0.399c0.3,0,0.5,0.1,0.5,0.5v1.1c0,0.4-0.1,0.801-0.1,0.801l0,0
        c0.399-0.9,1.8-2.6,4.1-2.6c2.5,0,3.4,1.398,3.4,3.898v5.9c0,0.4-0.101,0.5-0.5,0.5h-0.4c-0.399,0-0.5-0.1-0.5-0.5V697
        c0-1.6-0.3-3-2.3-3c-2.1,0-3.9,1.801-3.9,4.1v4.4c0,0.4-0.1,0.5-0.5,0.5H454.2c-0.4,0-0.5-0.1-0.5-0.5v-9L453.9,693.4L453.9,693.4
        z"/>
      <path fill="#808285" d="M464.2,701.3l0.1-0.301c0.101-0.299,0.4-0.299,0.601-0.1c0.5,0.4,1.399,0.9,2.6,0.9c1.1,0,2-0.5,2-1.6
        c0-2.301-5.4-1.602-5.4-4.9c0-1.9,1.601-2.9,3.4-2.9c1.5,0,2.4,0.5,2.8,0.9c0.3,0.1,0.3,0.4,0.101,0.6l-0.101,0.301
        c-0.1,0.299-0.399,0.299-0.6,0.1c-0.4-0.301-1.101-0.6-2.101-0.6s-2,0.5-2,1.5c0,2.398,5.4,1.6,5.4,5c0,1.6-1.4,2.898-3.4,2.898
        c-1.8,0-2.899-0.799-3.399-1.1C464,701.8,463.9,701.599,464.2,701.3z"/>
      <path fill="#808285" d="M478,696.8h0.6v-0.4c0-2-1-2.6-2.5-2.6c-1.1,0-2,0.4-2.5,0.799c-0.3,0.102-0.5,0.102-0.6-0.1l-0.1-0.299
        c-0.101-0.301-0.101-0.5,0.1-0.602c0.5-0.398,1.6-0.898,3.3-0.898c2.4,0,3.8,1.398,3.8,3.898v6c0,0.4-0.1,0.5-0.5,0.5H479.2
        c-0.4,0-0.5-0.1-0.5-0.5V701.8c0-0.5,0-0.801,0-0.801l0,0c0,0-0.9,2.301-3.4,2.301c-1.8,0-3.399-1-3.399-3
        C471.7,696.9,476,696.8,478,696.8z M475.5,702.099c2,0,3.1-2,3.1-3.799v-0.5H478c-1.6,0-4.8,0-4.8,2.4
        C473.2,701.099,474,702.099,475.5,702.099z"/>
      <path fill="#808285" d="M486.7,692.701c1.8,0,2.899,0.799,3.399,1.1c0.301,0.1,0.301,0.4,0,0.6l-0.1,0.301
        c-0.1,0.299-0.4,0.299-0.6,0.1c-0.5-0.4-1.4-0.9-2.5-0.9c-2.301,0-3.9,1.6-3.9,4.1c0,2.4,1.8,4,4,4c1.4,0,2.4-0.6,2.9-1
        c0.3-0.299,0.5-0.1,0.6,0.1l0.1,0.301c0.101,0.301,0.101,0.5-0.1,0.6c-0.5,0.4-1.8,1.301-3.6,1.301c-3,0-5.301-2.1-5.301-5.301
        C481.4,694.8,483.7,692.701,486.7,692.701z"/>
      <path fill="#808285" d="M492.3,694.099H491.4c-0.4,0-0.5-0.1-0.5-0.5v-0.1c0-0.4,0.1-0.5,0.5-0.5h0.899v-2.4
        c0-0.398,0.101-0.5,0.5-0.5h0.4c0.399,0,0.5,0.102,0.5,0.5v2.4h2c0.399,0,0.5,0.1,0.5,0.5v0.1c0,0.4-0.101,0.5-0.5,0.5h-2v5
        c0,2.4,1.399,2.602,2.3,2.602c0.4,0,0.5,0.1,0.5,0.5v0.299c0,0.4-0.1,0.5-0.5,0.5c-2.3,0-3.5-1.4-3.5-3.799v-5.102H492.3z"/>
      <path fill="#808285" d="M497.5,690v-0.799c0-0.4,0.1-0.5,0.5-0.5h0.5c0.4,0,0.5,0.1,0.5,0.5V690c0,0.4-0.1,0.5-0.5,0.5H498
        C497.7,690.5,497.5,690.4,497.5,690z M497.6,693.4c0-0.4,0.101-0.5,0.5-0.5h0.4c0.4,0,0.5,0.1,0.5,0.5v9.199
        c0,0.4-0.1,0.5-0.5,0.5h-0.4c-0.399,0-0.5-0.1-0.5-0.5V693.4z"/>
      <path fill="#808285" d="M505.9,692.701c3,0,5.399,2.299,5.399,5.299s-2.399,5.4-5.3,5.4c-3,0-5.4-2.301-5.4-5.4
        C500.5,694.9,502.9,692.701,505.9,692.701z M505.9,702c2.1,0,3.899-1.799,3.899-4.1s-1.8-4-3.899-4c-2.101,0-3.9,1.801-3.9,4
        C502,700.201,503.8,702,505.9,702z"/>
      <path fill="#808285" d="M512.8,693.4c0-0.4,0.101-0.5,0.5-0.5h0.4c0.3,0,0.5,0.1,0.5,0.5v1.1c0,0.4-0.101,0.801-0.101,0.801l0,0
        c0.4-0.9,1.801-2.6,4.101-2.6c2.5,0,3.399,1.398,3.399,3.898v5.9c0,0.4-0.1,0.5-0.5,0.5H520.7c-0.4,0-0.5-0.1-0.5-0.5V697
        c0-1.6-0.3-3-2.3-3c-2.101,0-3.9,1.801-3.9,4.1v4.4c0,0.4-0.1,0.5-0.5,0.5h-0.4c-0.399,0-0.5-0.1-0.5-0.5v-9L512.8,693.4
        L512.8,693.4z"/>
      <path fill="#808285" d="M528,693.4c0-0.4,0.1-0.5,0.5-0.5h0.4c0.3,0,0.5,0.1,0.5,0.5v1.4c0,0.5-0.101,0.799-0.101,0.799l0,0
        c0.5-1.5,1.601-2.799,3.3-2.799c0.4,0,0.5,0.1,0.5,0.5v0.4c0,0.398-0.3,0.5-0.5,0.5c-2.1,0-3.1,2.398-3.1,4.5v3.799
        c0,0.4-0.1,0.5-0.5,0.5h-0.5c-0.4,0-0.5-0.1-0.5-0.5V693.4L528,693.4z"/>
      <path fill="#808285" d="M538.2,692.701c3,0,5.399,2.299,5.399,5.299s-2.399,5.4-5.3,5.4c-3,0-5.399-2.301-5.399-5.4
        S535.3,692.701,538.2,692.701z M538.2,702c2.1,0,3.899-1.799,3.899-4.1s-1.8-4-3.899-4c-2.101,0-3.9,1.801-3.9,4
        C534.3,700.201,536,702,538.2,702z"/>
      <path fill="#808285" d="M550.5,696.8h0.6v-0.4c0-2-1-2.6-2.5-2.6c-1.1,0-2,0.4-2.5,0.799c-0.3,0.102-0.5,0.102-0.6-0.1l-0.1-0.299
        c-0.101-0.301-0.101-0.5,0.1-0.602c0.5-0.398,1.6-0.898,3.3-0.898c2.4,0,3.8,1.398,3.8,3.898v6c0,0.4-0.1,0.5-0.5,0.5H551.7
        c-0.4,0-0.5-0.1-0.5-0.5V701.8c0-0.5,0-0.801,0-0.801l0,0c0,0-0.9,2.301-3.4,2.301c-1.8,0-3.399-1-3.399-3
        C544.2,696.9,548.5,696.8,550.5,696.8z M548,702.099c2,0,3.1-2,3.1-3.799v-0.5h-0.5c-1.6,0-4.8,0-4.8,2.4
        C545.7,701.099,546.5,702.099,548,702.099z"/>
      <path fill="#808285" d="M558.4,692.701c2.5,0,3.3,2,3.3,2l0,0c0,0,0-0.4,0-0.801v-4.5c0-0.4,0.1-0.5,0.5-0.5h0.399
        c0.4,0,0.5,0.1,0.5,0.5v13.199c0,0.4-0.1,0.5-0.5,0.5H562.2c-0.4,0-0.5-0.1-0.5-0.5V701.8c0-0.4,0.1-0.6,0.1-0.6l0,0
        c0,0-0.899,2.1-3.5,2.1c-2.8,0-4.399-2.1-4.399-5.301C553.9,694.701,555.8,692.701,558.4,692.701z M558.5,702
        c1.6,0,3.3-1.299,3.3-4.1c0-2-1-4-3.3-4c-1.8,0-3.3,1.5-3.3,4C555.3,700.5,556.7,702,558.5,702z"/>
      <path fill="#808285" d="M565.3,697.5v-0.299c0-0.4,0.101-0.5,0.5-0.5h4.8c0.4,0,0.5,0.1,0.5,0.5v0.299c0,0.4-0.1,0.5-0.5,0.5h-4.8
        C565.5,698,565.3,697.701,565.3,697.5z"/>
      <path fill="#808285" d="M573.1,693.4c0-0.4,0.101-0.5,0.5-0.5h0.4c0.3,0,0.5,0.1,0.5,0.5v1.1c0,0.4-0.1,0.801-0.1,0.801l0,0
        c0.5-1.4,2.1-2.6,3.8-2.6c1.899,0,2.899,0.898,3.1,2.5l0,0c0.5-1.301,2-2.5,3.8-2.5c2.5,0,3.4,1.398,3.4,3.898v5.9
        c0,0.4-0.1,0.5-0.5,0.5h-0.4c-0.399,0-0.5-0.1-0.5-0.5V696.8c0-1.6-0.399-3-2.1-3c-2,0-3.4,2.1-3.4,4.299v4.4
        c0,0.4-0.1,0.5-0.5,0.5H580.7c-0.4,0-0.5-0.1-0.5-0.5V696.8c0-1.5-0.3-3-2.101-3c-2,0-3.5,2.1-3.5,4.299v4.4
        c0,0.4-0.1,0.5-0.5,0.5H573.7c-0.4,0-0.5-0.1-0.5-0.5v-9.1H573.1L573.1,693.4z"/>
      <path fill="#808285" d="M595.9,696.8h0.6v-0.4c0-2-1-2.6-2.5-2.6c-1.1,0-2,0.4-2.5,0.799c-0.3,0.102-0.5,0.102-0.6-0.1
        l-0.101-0.299c-0.1-0.301-0.1-0.5,0.101-0.602c0.5-0.398,1.6-0.898,3.3-0.898c2.399,0,3.8,1.398,3.8,3.898v6
        c0,0.4-0.1,0.5-0.5,0.5h-0.4c-0.399,0-0.5-0.1-0.5-0.5V701.8c0-0.5,0-0.801,0-0.801l0,0c0,0-0.899,2.301-3.399,2.301
        c-1.8,0-3.4-1-3.4-3C589.7,696.9,593.8,696.8,595.9,696.8z M593.3,702.099c2,0,3.101-2,3.101-3.799v-0.5h-0.5
        c-1.601,0-4.801,0-4.801,2.4C591.1,701.099,591.8,702.099,593.3,702.099z"/>
      <path fill="#808285" d="M600,693.4c0-0.4,0.1-0.5,0.5-0.5h0.4c0.399,0,0.5,0.1,0.5,0.5v0.801c0,0.398,0,0.6,0,0.6l0,0
        c0,0,0.899-2.1,3.5-2.1c2.8,0,4.399,2.1,4.399,5.299c0,3.1-1.899,5.301-4.5,5.301c-2.5,0-3.399-2-3.399-2l0,0c0,0,0.1,0.4,0.1,0.9
        v4.398c0,0.4-0.1,0.5-0.5,0.5h-0.4c-0.399,0-0.5-0.1-0.5-0.5L600,693.4L600,693.4L600,693.4z M604.5,702c1.8,0,3.3-1.5,3.3-4
        s-1.399-4-3.1-4c-1.601,0-3.3,1.301-3.3,4C601.3,700,602.4,702,604.5,702z"/>
      <path fill="#808285" d="M615.5,694.099h-0.9c-0.399,0-0.5-0.1-0.5-0.5v-0.1c0-0.4,0.101-0.5,0.5-0.5h0.9v-2.4
        c0-0.398,0.1-0.5,0.5-0.5h0.4c0.399,0,0.5,0.102,0.5,0.5v2.4h2c0.399,0,0.5,0.1,0.5,0.5v0.1c0,0.4-0.101,0.5-0.5,0.5h-2v5
        c0,2.4,1.399,2.602,2.3,2.602c0.399,0,0.5,0.1,0.5,0.5v0.299c0,0.4-0.101,0.5-0.5,0.5c-2.3,0-3.5-1.4-3.5-3.799v-5.102H615.5z"/>
      <path fill="#808285" d="M625.1,692.701c3,0,5.4,2.299,5.4,5.299s-2.4,5.4-5.3,5.4c-3,0-5.4-2.301-5.4-5.4
        C619.9,694.9,622.2,692.701,625.1,692.701z M625.3,702c2.101,0,3.9-1.799,3.9-4.1s-1.8-4-3.9-4c-2.1,0-3.899,1.801-3.899,4
        C621.2,700.201,623,702,625.3,702z"/>
      <path fill="#808285" d="M429.4,713.3c0-0.4,0.1-0.5,0.5-0.5h0.399c0.4,0,0.5,0.1,0.5,0.5v5c0,0.5-0.1,0.9-0.1,0.9l0,0
        c0.399-1,1.8-2.602,4-2.602c2.5,0,3.399,1.4,3.399,3.9v5.9c0,0.4-0.1,0.5-0.5,0.5H437.2c-0.4,0-0.5-0.1-0.5-0.5v-5.5
        c0-1.6-0.3-3-2.3-3c-2.101,0-3.801,1.801-3.801,4.1v4.4c0,0.4-0.1,0.5-0.5,0.5H429.7c-0.4,0-0.5-0.1-0.5-0.5v-13.1H429.4
        L429.4,713.3z"/>
      <path fill="#808285" d="M444.7,716.5c2.6,0,4.3,2,4.3,4.801c0,0.299-0.3,0.5-0.5,0.5h-7.3c0,2.5,1.899,4,3.899,4
        c1.301,0,2.101-0.5,2.601-0.9c0.3-0.1,0.5-0.1,0.6,0.1l0.101,0.301c0.1,0.299,0.1,0.5-0.101,0.6c-0.5,0.4-1.8,1.1-3.399,1.1
        c-3,0-5.301-2.1-5.301-5.299C439.7,718.599,441.9,716.5,444.7,716.5z M447.5,720.8c-0.1-2.1-1.4-3.1-2.9-3.1
        c-1.6,0-3.1,1.1-3.5,3.1H447.5z"/>
      <path fill="#808285" d="M450.5,713.3c0-0.4,0.1-0.5,0.5-0.5h0.4c0.399,0,0.5,0.1,0.5,0.5v11.1c0,1.301,0.6,1.4,1,1.5
        c0.3,0,0.399,0.1,0.399,0.5v0.301c0,0.299-0.1,0.5-0.5,0.5c-0.899,0-2.3-0.301-2.3-2.5V713.3L450.5,713.3z"/>
      <path fill="#808285" d="M454.6,717.3c0-0.4,0.101-0.5,0.5-0.5h0.4c0.4,0,0.5,0.1,0.5,0.5v0.799c0,0.4,0,0.602,0,0.602l0,0
        c0,0,0.9-2.102,3.5-2.102c2.8,0,4.4,2.102,4.4,5.301s-1.9,5.301-4.5,5.301c-2.5,0-3.4-2-3.4-2l0,0c0,0,0.1,0.398,0.1,0.898v4.4
        c0,0.4-0.1,0.5-0.5,0.5H455.2c-0.4,0-0.5-0.1-0.5-0.5v-13.1L454.6,717.3L454.6,717.3z M459.1,725.8c1.801,0,3.301-1.5,3.301-4
        s-1.4-4-3.101-4c-1.6,0-3.3,1.299-3.3,4C455.9,723.8,457,725.8,459.1,725.8z"/>
      <path fill="#808285" d="M471,729.4c0.5,0.301,1.3,0.5,2.4,0.5c1.899,0,3.5-0.9,3.5-3.1v-1c0-0.4,0-0.801,0-0.801l0,0
        c-0.601,1.1-1.601,1.9-3.301,1.9c-2.8,0-4.5-2.1-4.5-5.301c0-3,1.601-5,4.5-5c2.601,0,3.301,1.9,3.301,1.9l0,0c0,0,0-0.1,0-0.4
        v-0.898c0-0.301,0.1-0.5,0.5-0.5h0.399c0.4,0,0.5,0.1,0.5,0.5v9.398c0,3.301-2.399,4.5-4.8,4.5c-1,0-2-0.299-2.9-0.6
        c-0.3-0.1-0.399-0.4-0.3-0.6l0.101-0.299C470.5,729.201,470.6,729.201,471,729.4z M476.7,721.701c0-3-1.5-3.9-3.101-3.9
        c-2,0-3.1,1.5-3.1,3.799c0,2.5,1.3,4,3.3,4C475.4,725.599,476.7,724.599,476.7,721.701z"/>
      <path fill="#808285" d="M480.3,717.3c0-0.4,0.101-0.5,0.5-0.5h0.4c0.399,0,0.5,0.1,0.5,0.5v5.5c0,1.6,0.3,3,2.1,3
        c2.3,0,3.8-2,3.8-4.301v-4.4c0-0.398,0.101-0.5,0.5-0.5h0.4c0.4,0,0.5,0.102,0.5,0.5v9.201c0,0.4-0.1,0.5-0.5,0.5h-0.4
        c-0.399,0-0.5-0.1-0.5-0.5v-1.1c0-0.4,0-0.801,0-0.801l0,0c-0.399,1-1.8,2.6-4,2.6c-2.399,0-3.399-1.299-3.399-3.9L480.3,717.3
        L480.3,717.3L480.3,717.3z"/>
      <path fill="#808285" d="M491.2,713.9v-0.801c0-0.398,0.1-0.5,0.5-0.5h0.5c0.399,0,0.5,0.102,0.5,0.5v0.801
        c0,0.4-0.101,0.5-0.5,0.5h-0.5C491.4,714.4,491.2,714.3,491.2,713.9z M491.3,717.3c0-0.4,0.101-0.5,0.5-0.5h0.4
        c0.399,0,0.5,0.1,0.5,0.5v9.199c0,0.4-0.101,0.5-0.5,0.5h-0.4c-0.399,0-0.5-0.1-0.5-0.5V717.3z"/>
      <path fill="#808285" d="M498.9,716.5c2.5,0,3.3,2,3.3,2l0,0c0,0,0-0.4,0-0.799v-4.5c0-0.4,0.1-0.5,0.5-0.5h0.399
        c0.4,0,0.5,0.1,0.5,0.5V726.4c0,0.4-0.1,0.5-0.5,0.5H502.7c-0.4,0-0.5-0.1-0.5-0.5v-0.801c0-0.398,0.1-0.6,0.1-0.6l0,0
        c0,0-0.899,2.1-3.5,2.1c-2.8,0-4.399-2.1-4.399-5.299C494.3,718.599,496.2,716.5,498.9,716.5z M498.9,725.8
        c1.6,0,3.3-1.301,3.3-4.1c0-2-1-4-3.3-4c-1.801,0-3.301,1.5-3.301,4C495.7,724.3,497,725.8,498.9,725.8z"/>
      <path fill="#808285" d="M510.2,716.5c2.6,0,4.3,2,4.3,4.801c0,0.299-0.3,0.5-0.5,0.5h-7.3c0,2.5,1.899,4,3.899,4
        c1.301,0,2.101-0.5,2.601-0.9c0.3-0.1,0.5-0.1,0.6,0.1l0.101,0.301c0.1,0.299,0.1,0.5-0.101,0.6c-0.5,0.4-1.8,1.1-3.399,1.1
        c-3,0-5.301-2.1-5.301-5.299C505.1,718.599,507.4,716.5,510.2,716.5z M513.1,720.8c-0.1-2.1-1.399-3.1-2.899-3.1
        c-1.601,0-3.101,1.1-3.5,3.1H513.1z"/>
      <path fill="#808285" d="M519.6,729.599c0.301,0.102,0.5,0.301,0.9,0.301c0.9,0,1.5-0.801,1.9-1.6l0.6-1.4l-4-9.4
        c-0.1-0.4,0-0.6,0.4-0.6h0.5c0.3,0,0.5,0.1,0.5,0.4l2.899,7c0.101,0.5,0.4,1,0.4,1l0,0c0,0,0.1-0.5,0.399-1l2.801-7
        c0.1-0.301,0.3-0.4,0.5-0.4h0.5c0.399,0,0.5,0.301,0.399,0.6l-4.8,11.6c-0.5,1.301-1.5,2.102-2.9,2.102c-0.6,0-1-0.301-1.399-0.4
        c-0.3-0.1-0.4-0.4-0.3-0.6l0.1-0.301C519.1,729.599,519.3,729.5,519.6,729.599z"/>
      <path fill="#808285" d="M533.8,716.5c3,0,5.4,2.301,5.4,5.301s-2.4,5.4-5.3,5.4c-3,0-5.4-2.301-5.4-5.4
        C528.5,718.8,530.9,716.5,533.8,716.5z M533.8,725.8c2.101,0,3.9-1.801,3.9-4.1c0-2.301-1.8-4-3.9-4c-2.1,0-3.899,1.799-3.899,4
        C529.9,724.099,531.7,725.8,533.8,725.8z"/>
      <path fill="#808285" d="M540.6,717.3c0-0.4,0.101-0.5,0.5-0.5h0.4c0.4,0,0.5,0.1,0.5,0.5v5.5c0,1.6,0.3,3,2.1,3
        c2.301,0,3.801-2,3.801-4.301v-4.4c0-0.398,0.1-0.5,0.5-0.5h0.399c0.4,0,0.5,0.102,0.5,0.5v9.201c0,0.4-0.1,0.5-0.5,0.5H548.4
        c-0.4,0-0.5-0.1-0.5-0.5v-1.1c0-0.4,0-0.801,0-0.801l0,0c-0.4,1-1.801,2.6-4,2.6c-2.4,0-3.4-1.299-3.4-3.9L540.6,717.3
        L540.6,717.3L540.6,717.3L540.6,717.3z"/>
    </g>
  </g>
  </svg>




                            </div>
                            
                          </div>
                          <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
                          </div>
                          <!-- page 10 end -->
</article>

<article>                          
                          <!-- page 11 -->
                          <div class="page-11">
							<div class="pg-11-header">
								<h1>HOW BUYERS FIND A HOME</h1>
								<h2>Places they look</h2>
								</div><!-- .pg-11-header -->
                            <div class="pg-11-content cf">
                              <div class="full-img"><img src="<?php echo base_url(); ?>pdf/images/fnd-a-home_896p.png" alt="" style="width:100%; height:4.447in; margin-top:-20px; " /></div>
                              <p >Most buyers now begin their search online either at home, on their break at work, but more often than not on their mobile device.  Since more than 80% of buyers begin their home search online they are simultaneously taking the opportunity to educate themselves on the buying process. So today’s buyer is now more informed than every but will still rely on a realtor to guide them through the transaction. The typical home buyer takes about 3 months to purchase his home which means they have been looking for 2 months before your decided to sell your home</p>
                              
                              <table width="100%" border="0" cellspacing="0" cellpadding="3" valign="top">
                                
                                <tbody>
                                  <tr>
                                    <td width="60%">
                                      <h4 style="font-size:22px; font-family:museosansrounded-900-7g; color:<?php echo $theme ?>; margin-bottom:15px;">Home Shoppers Rely on Agents and Open Houses to Bring Their Online Research Into the Real World
                                      </h4><br>
                                      <p style="font-size:16px; font-family:museosansrounded-300-7h; color: #76777b; margin-top:5px;">With all this valuable data we are going to take advantage and are going to place your property where it’s going to gain maximum exposure to prospective buyers. </p>
                                      <td width="40%" >
                                        <table width="100%" cellspacing="0" cellpadding="0" border="0" valign="top">
                                          <tbody>
                                            <tr>
                                              <td align="left" valign="top">
                                                
                                                <img src="<?php echo base_url(); ?>pdf/images/place-2.png" alt=""  style="margin-bottom:-150px" />
                                                <br>
                                                <table width="100%" align="center"  cellspacing="1" cellpadding="1" border="0" valign="top" >
                                                  <tbody>
                                                    <tr><td align="left" style="padding-left:15px; padding-top:10px;" >  <h4  style=" font-size:19px; font-family:museosansrounded-900-7g; color:<?php echo $theme ?>;"><b>First Time Vs. Repeat Buyers</b></h4></td></tr>
                                                    <tr><td  style="padding-left:13px;"><p style=" font-size:15px; font-family:museosansrounded-300-7h; color: #76777b;">First-time buyers: 38% <br>
                                                      Avg. age of first-time buyers: 31<br>
                                                      Avg. age of repeat buyers: 52<br>
                                                      Avg. income of first-time buyers: $64,400<br>
                                                      Avg. income of repeat buyers: $96,000
                                                    </p></td></tr>
                                                  </tbody>
                                                </table>
                                                
                                              </td></tr>
                                            </tbody></table>
                                            
                                            
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>
                                    
                                  </div>
                                  <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
                                  </div>
                                  <!-- page 11 end -->
</article>
<article>
                                  <!-- page 12 -->
                                  <div class="page-12">
									<div class="pg-12-header">
									<h1>PRICING CORRECTLY</h1>
									<h2>Selling faster by setting the right price</h2>
									</div><!-- .pg-12-header -->
                                    <div class="pg-12-content cf" style="margin-top:-20px">
                                      <p>At any given time, there are plenty of buyers in the market looking for newly listed properties. As your agent I
                                      want to make sure to help you attract as many buyers as possible. One thing that can hinder this is setting the price too high. The key to getting your home sold as quickly as possible is to price it correctly from day 1. Many sellers have the tendency to want to list their home at a higher sales price than advised because they hope to increase their profit or they assume that buyers always make low offers so it’s good to start high.
                                      </p>
                                      <div class="full-img" align="center">

  <!-- 
                                      <img src="<?php echo base_url(); ?>pdf/images/pricing-money.png" alt="" style="width:90%;  " /> -->

                                      <svg version="1.1"  xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
     width="597.4px" height="351px" viewBox="0 0 597.4 351" enable-background="new 0 0 597.4 351" xml:space="preserve">
  <rect x="3.4" y="185.9" fill="#F1F2F2" width="587" height="120.1"/>
  <g>
    <g>
      <g>
        <g>
          <g>
            <g>
              <rect x="4.4" y="174.8" fill="none" width="13.4" height="15"/>
            </g>
            <rect x="14.3" y="181.8" width="2.5" height="1.5"/>
            <rect x="9.9" y="181.8" width="2.5" height="1.5"/>
            <rect x="5.4" y="181.8" width="2.5" height="1.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="17.8" y="174.8" fill="none" width="13.4" height="15"/>
            </g>
            <rect x="27.7" y="181.8" width="2.5" height="1.5"/>
            <rect x="23.2" y="181.8" width="2.5" height="1.5"/>
            <rect x="18.8" y="181.8" width="2.5" height="1.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="31.2" y="174.8" fill="none" width="13.4" height="15"/>
            </g>
            <rect x="41.1" y="181.8" width="2.5" height="1.5"/>
            <rect x="36.6" y="181.8" width="2.5" height="1.5"/>
            <rect x="32.2" y="181.8" width="2.5" height="1.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="44.6" y="174.8" fill="none" width="13.4" height="15"/>
            </g>
            <rect x="54.5" y="181.8" width="2.5" height="1.5"/>
            <rect x="50" y="181.8" width="2.5" height="1.5"/>
            <rect x="45.6" y="181.8" width="2.5" height="1.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="57.9" y="174.8" fill="none" width="13.4" height="15"/>
            </g>
            <rect x="67.9" y="181.8" width="2.5" height="1.5"/>
            <rect x="63.4" y="181.8" width="2.5" height="1.5"/>
            <rect x="59" y="181.8" width="2.5" height="1.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="71.3" y="174.8" fill="none" width="13.4" height="15"/>
            </g>
            <rect x="81.2" y="181.8" width="2.5" height="1.5"/>
            <rect x="76.8" y="181.8" width="2.5" height="1.5"/>
            <rect x="72.3" y="181.8" width="2.5" height="1.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="84.7" y="174.8" fill="none" width="13.4" height="15"/>
            </g>
            <rect x="94.6" y="181.8" width="2.5" height="1.5"/>
            <rect x="90.2" y="181.8" width="2.5" height="1.5"/>
            <rect x="85.7" y="181.8" width="2.5" height="1.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="98.1" y="174.8" fill="none" width="13.4" height="15"/>
            </g>
            <rect x="108" y="181.8" width="2.5" height="1.5"/>
            <rect x="103.6" y="181.8" width="2.5" height="1.5"/>
            <rect x="99.1" y="181.8" width="2.5" height="1.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="111.5" y="174.8" fill="none" width="13.4" height="15"/>
            </g>
            <rect x="121.4" y="181.8" width="2.5" height="1.5"/>
            <rect x="116.9" y="181.8" width="2.5" height="1.5"/>
            <rect x="112.5" y="181.8" width="2.5" height="1.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="124.9" y="174.8" fill="none" width="13.4" height="15"/>
            </g>
            <rect x="134.8" y="181.8" width="2.5" height="1.5"/>
            <rect x="130.3" y="181.8" width="2.5" height="1.5"/>
            <rect x="125.9" y="181.8" width="2.5" height="1.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="138.3" y="174.8" fill="none" width="13.4" height="15"/>
            </g>
            <rect x="148.2" y="181.8" width="2.5" height="1.5"/>
            <rect x="143.7" y="181.8" width="2.5" height="1.5"/>
            <rect x="139.3" y="181.8" width="2.5" height="1.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="151.7" y="174.8" fill="none" width="13.4" height="15"/>
            </g>
            <rect x="161.6" y="181.8" width="2.5" height="1.5"/>
            <rect x="157.1" y="181.8" width="2.5" height="1.5"/>
            <rect x="152.7" y="181.8" width="2.5" height="1.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="165" y="174.8" fill="none" width="13.4" height="15"/>
            </g>
            <rect x="174.9" y="181.8" width="2.5" height="1.5"/>
            <rect x="170.5" y="181.8" width="2.5" height="1.5"/>
            <rect x="166.1" y="181.8" width="2.5" height="1.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="178.4" y="174.8" fill="none" width="13.4" height="15"/>
            </g>
            <rect x="188.3" y="181.8" width="2.5" height="1.5"/>
            <rect x="183.9" y="181.8" width="2.5" height="1.5"/>
            <rect x="179.4" y="181.8" width="2.5" height="1.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="191.8" y="174.8" fill="none" width="13.4" height="15"/>
            </g>
            <rect x="201.7" y="181.8" width="2.5" height="1.5"/>
            <rect x="197.3" y="181.8" width="2.5" height="1.5"/>
            <rect x="192.8" y="181.8" width="2.5" height="1.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="205.2" y="174.8" fill="none" width="13.4" height="15"/>
            </g>
            <rect x="215.1" y="181.8" width="2.5" height="1.5"/>
            <rect x="210.7" y="181.8" width="2.5" height="1.5"/>
            <rect x="206.2" y="181.8" width="2.5" height="1.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="218.6" y="174.8" fill="none" width="13.4" height="15"/>
            </g>
            <rect x="228.5" y="181.8" width="2.5" height="1.5"/>
            <rect x="224" y="181.8" width="2.5" height="1.5"/>
            <rect x="219.6" y="181.8" width="2.5" height="1.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="232" y="174.8" fill="none" width="13.4" height="15"/>
            </g>
            <rect x="241.9" y="181.8" width="2.5" height="1.5"/>
            <rect x="237.4" y="181.8" width="2.5" height="1.5"/>
            <rect x="233" y="181.8" width="2.5" height="1.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="245.4" y="174.8" fill="none" width="13.4" height="15"/>
            </g>
            <rect x="255.3" y="181.8" width="2.5" height="1.5"/>
            <rect x="250.8" y="181.8" width="2.5" height="1.5"/>
            <rect x="246.4" y="181.8" width="2.5" height="1.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="258.7" y="174.8" fill="none" width="13.4" height="15"/>
            </g>
            <rect x="268.7" y="181.8" width="2.5" height="1.5"/>
            <rect x="264.2" y="181.8" width="2.5" height="1.5"/>
            <rect x="259.8" y="181.8" width="2.5" height="1.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="272.1" y="174.8" fill="none" width="13.4" height="15"/>
            </g>
            <rect x="282" y="181.8" width="2.5" height="1.5"/>
            <rect x="277.6" y="181.8" width="2.5" height="1.5"/>
            <rect x="273.1" y="181.8" width="2.5" height="1.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="285.5" y="174.8" fill="none" width="13.4" height="15"/>
            </g>
            <rect x="295.4" y="181.8" width="2.5" height="1.5"/>
            <rect x="291" y="181.8" width="2.5" height="1.5"/>
            <rect x="286.5" y="181.8" width="2.5" height="1.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="298.9" y="174.8" fill="none" width="13.4" height="15"/>
            </g>
            <rect x="308.8" y="181.8" width="2.5" height="1.5"/>
            <rect x="304.4" y="181.8" width="2.5" height="1.5"/>
            <rect x="299.9" y="181.8" width="2.5" height="1.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="312.3" y="174.8" fill="none" width="13.4" height="15"/>
            </g>
            <rect x="322.2" y="181.8" width="2.5" height="1.5"/>
            <rect x="317.7" y="181.8" width="2.5" height="1.5"/>
            <rect x="313.3" y="181.8" width="2.5" height="1.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="325.7" y="174.8" fill="none" width="13.4" height="15"/>
            </g>
            <rect x="335.6" y="181.8" width="2.5" height="1.5"/>
            <rect x="331.1" y="181.8" width="2.5" height="1.5"/>
            <rect x="326.7" y="181.8" width="2.5" height="1.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="339.1" y="174.8" fill="none" width="13.4" height="15"/>
            </g>
            <rect x="349" y="181.8" width="2.5" height="1.5"/>
            <rect x="344.5" y="181.8" width="2.5" height="1.5"/>
            <rect x="340.1" y="181.8" width="2.5" height="1.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="352.4" y="174.8" fill="none" width="13.4" height="15"/>
            </g>
            <rect x="362.4" y="181.8" width="2.5" height="1.5"/>
            <rect x="357.9" y="181.8" width="2.5" height="1.5"/>
            <rect x="353.5" y="181.8" width="2.5" height="1.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="365.8" y="174.8" fill="none" width="13.4" height="15"/>
            </g>
            <rect x="375.7" y="181.8" width="2.5" height="1.5"/>
            <rect x="371.3" y="181.8" width="2.5" height="1.5"/>
            <rect x="366.8" y="181.8" width="2.5" height="1.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="379.2" y="174.8" fill="none" width="13.4" height="15"/>
            </g>
            <rect x="389.1" y="181.8" width="2.5" height="1.5"/>
            <rect x="384.7" y="181.8" width="2.5" height="1.5"/>
            <rect x="380.2" y="181.8" width="2.5" height="1.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="392.6" y="174.8" fill="none" width="13.4" height="15"/>
            </g>
            <rect x="402.5" y="181.8" width="2.5" height="1.5"/>
            <rect x="398.1" y="181.8" width="2.5" height="1.5"/>
            <rect x="393.6" y="181.8" width="2.5" height="1.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="406" y="174.8" fill="none" width="13.4" height="15"/>
            </g>
            <rect x="415.9" y="181.8" width="2.5" height="1.5"/>
            <rect x="411.4" y="181.8" width="2.5" height="1.5"/>
            <rect x="407" y="181.8" width="2.5" height="1.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="419.4" y="174.8" fill="none" width="13.4" height="15"/>
            </g>
            <rect x="429.3" y="181.8" width="2.5" height="1.5"/>
            <rect x="424.8" y="181.8" width="2.5" height="1.5"/>
            <rect x="420.4" y="181.8" width="2.5" height="1.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="432.8" y="174.8" fill="none" width="13.4" height="15"/>
            </g>
            <rect x="442.7" y="181.8" width="2.5" height="1.5"/>
            <rect x="438.2" y="181.8" width="2.5" height="1.5"/>
            <rect x="433.8" y="181.8" width="2.5" height="1.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="446.2" y="174.8" fill="none" width="13.4" height="15"/>
            </g>
            <rect x="456.1" y="181.8" width="2.5" height="1.5"/>
            <rect x="451.6" y="181.8" width="2.5" height="1.5"/>
            <rect x="447.2" y="181.8" width="2.5" height="1.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="459.5" y="174.8" fill="none" width="13.4" height="15"/>
            </g>
            <rect x="469.4" y="181.8" width="2.5" height="1.5"/>
            <rect x="465" y="181.8" width="2.5" height="1.5"/>
            <rect x="460.6" y="181.8" width="2.5" height="1.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="472.9" y="174.8" fill="none" width="13.4" height="15"/>
            </g>
            <rect x="482.8" y="181.8" width="2.5" height="1.5"/>
            <rect x="478.4" y="181.8" width="2.5" height="1.5"/>
            <rect x="473.9" y="181.8" width="2.5" height="1.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="486.3" y="174.8" fill="none" width="13.4" height="15"/>
            </g>
            <rect x="496.2" y="181.8" width="2.5" height="1.5"/>
            <rect x="491.8" y="181.8" width="2.5" height="1.5"/>
            <rect x="487.3" y="181.8" width="2.5" height="1.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="499.7" y="174.8" fill="none" width="13.4" height="15"/>
            </g>
            <rect x="509.6" y="181.8" width="2.5" height="1.5"/>
            <rect x="505.2" y="181.8" width="2.5" height="1.5"/>
            <rect x="500.7" y="181.8" width="2.5" height="1.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="513.1" y="174.8" fill="none" width="13.4" height="15"/>
            </g>
            <rect x="523" y="181.8" width="2.5" height="1.5"/>
            <rect x="518.5" y="181.8" width="2.5" height="1.5"/>
            <rect x="514.1" y="181.8" width="2.5" height="1.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="526.5" y="174.8" fill="none" width="13.4" height="15"/>
            </g>
            <rect x="536.4" y="181.8" width="2.5" height="1.5"/>
            <rect x="531.9" y="181.8" width="2.5" height="1.5"/>
            <rect x="527.5" y="181.8" width="2.5" height="1.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="539.9" y="174.8" fill="none" width="13.4" height="15"/>
            </g>
            <rect x="549.8" y="181.8" width="2.5" height="1.5"/>
            <rect x="545.3" y="181.8" width="2.5" height="1.5"/>
            <rect x="540.9" y="181.8" width="2.5" height="1.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="553.2" y="174.8" fill="none" width="13.4" height="15"/>
            </g>
            <rect x="563.2" y="181.8" width="2.5" height="1.5"/>
            <rect x="558.7" y="181.8" width="2.5" height="1.5"/>
            <rect x="554.3" y="181.8" width="2.5" height="1.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="566.6" y="174.8" fill="none" width="13.4" height="15"/>
            </g>
            <rect x="576.5" y="181.8" width="2.5" height="1.5"/>
            <rect x="572.1" y="181.8" width="2.5" height="1.5"/>
            <rect x="567.6" y="181.8" width="2.5" height="1.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="580" y="174.8" fill="none" width="13.4" height="15"/>
            </g>
            <rect x="589.9" y="181.8" width="2.5" height="1.5"/>
            <rect x="585.5" y="181.8" width="2.5" height="1.5"/>
            <rect x="581" y="181.8" width="2.5" height="1.5"/>
          </g>
        </g>
      </g>
    </g>
  </g>
  <g>
    <g>
      <g>
        <g>
          <g>
            <g>
              <rect x="21.9" y="334.8" fill="none" width="15" height="13.1"/>
            </g>
            <rect x="28.9" y="335.8" width="1.5" height="2.4"/>
            <rect x="28.9" y="340.2" width="1.5" height="2.4"/>
            <rect x="28.9" y="344.5" width="1.5" height="2.4"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="21.9" y="321.7" fill="none" width="15" height="13.1"/>
            </g>
            <rect x="28.9" y="322.6" width="1.5" height="2.4"/>
            <rect x="28.9" y="327" width="1.5" height="2.4"/>
            <rect x="28.9" y="331.4" width="1.5" height="2.4"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="21.9" y="308.5" fill="none" width="15" height="13.1"/>
            </g>
            <rect x="28.9" y="309.5" width="1.5" height="2.4"/>
            <rect x="28.9" y="313.9" width="1.5" height="2.4"/>
            <rect x="28.9" y="318.2" width="1.5" height="2.4"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="21.9" y="295.4" fill="none" width="15" height="13.1"/>
            </g>
            <rect x="28.9" y="296.3" width="1.5" height="2.4"/>
            <rect x="28.9" y="300.7" width="1.5" height="2.4"/>
            <rect x="28.9" y="305.1" width="1.5" height="2.4"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="21.9" y="282.2" fill="none" width="15" height="13.1"/>
            </g>
            <rect x="28.9" y="283.2" width="1.5" height="2.4"/>
            <rect x="28.9" y="287.6" width="1.5" height="2.4"/>
            <rect x="28.9" y="291.9" width="1.5" height="2.4"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="21.9" y="269.1" fill="none" width="15" height="13.1"/>
            </g>
            <rect x="28.9" y="270" width="1.5" height="2.4"/>
            <rect x="28.9" y="274.4" width="1.5" height="2.4"/>
            <rect x="28.9" y="278.8" width="1.5" height="2.4"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="21.9" y="255.9" fill="none" width="15" height="13.1"/>
            </g>
            <rect x="28.9" y="256.9" width="1.5" height="2.4"/>
            <rect x="28.9" y="261.3" width="1.5" height="2.4"/>
            <rect x="28.9" y="265.6" width="1.5" height="2.4"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="21.9" y="242.8" fill="none" width="15" height="13.1"/>
            </g>
            <rect x="28.9" y="243.8" width="1.5" height="2.4"/>
            <rect x="28.9" y="248.1" width="1.5" height="2.4"/>
            <rect x="28.9" y="252.5" width="1.5" height="2.4"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="21.9" y="229.6" fill="none" width="15" height="13.1"/>
            </g>
            <rect x="28.9" y="230.6" width="1.5" height="2.4"/>
            <rect x="28.9" y="235" width="1.5" height="2.4"/>
            <rect x="28.9" y="239.3" width="1.5" height="2.4"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="21.9" y="216.5" fill="none" width="15" height="13.1"/>
            </g>
            <rect x="28.9" y="217.5" width="1.5" height="2.4"/>
            <rect x="28.9" y="221.8" width="1.5" height="2.4"/>
            <rect x="28.9" y="226.2" width="1.5" height="2.4"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="21.9" y="203.3" fill="none" width="15" height="13.1"/>
            </g>
            <rect x="28.9" y="204.3" width="1.5" height="2.4"/>
            <rect x="28.9" y="208.7" width="1.5" height="2.4"/>
            <rect x="28.9" y="213" width="1.5" height="2.4"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="21.9" y="190.2" fill="none" width="15" height="13.1"/>
            </g>
            <rect x="28.9" y="191.2" width="1.5" height="2.4"/>
            <rect x="28.9" y="195.5" width="1.5" height="2.4"/>
            <rect x="28.9" y="199.9" width="1.5" height="2.4"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="21.9" y="177" fill="none" width="15" height="13.1"/>
            </g>
            <rect x="28.9" y="178" width="1.5" height="2.4"/>
            <rect x="28.9" y="182.4" width="1.5" height="2.4"/>
            <rect x="28.9" y="186.8" width="1.5" height="2.4"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="21.9" y="163.9" fill="none" width="15" height="13.1"/>
            </g>
            <rect x="28.9" y="164.9" width="1.5" height="2.4"/>
            <rect x="28.9" y="169.2" width="1.5" height="2.4"/>
            <rect x="28.9" y="173.6" width="1.5" height="2.4"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="21.9" y="150.7" fill="none" width="15" height="13.1"/>
            </g>
            <rect x="28.9" y="151.7" width="1.5" height="2.4"/>
            <rect x="28.9" y="156.1" width="1.5" height="2.4"/>
            <rect x="28.9" y="160.5" width="1.5" height="2.4"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="21.9" y="137.6" fill="none" width="15" height="13.1"/>
            </g>
            <rect x="28.9" y="138.6" width="1.5" height="2.4"/>
            <rect x="28.9" y="142.9" width="1.5" height="2.4"/>
            <rect x="28.9" y="147.3" width="1.5" height="2.4"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="21.9" y="124.4" fill="none" width="15" height="13.1"/>
            </g>
            <rect x="28.9" y="125.4" width="1.5" height="2.4"/>
            <rect x="28.9" y="129.8" width="1.5" height="2.4"/>
            <rect x="28.9" y="134.2" width="1.5" height="2.4"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="21.9" y="111.3" fill="none" width="15" height="13.1"/>
            </g>
            <rect x="28.9" y="112.3" width="1.5" height="2.4"/>
            <rect x="28.9" y="116.6" width="1.5" height="2.4"/>
            <rect x="28.9" y="121" width="1.5" height="2.4"/>
          </g>
        </g>
      </g>
    </g>
  </g>
  <g>
    <g>
      <g>
        <g>
          <g>
            <g>
              <rect x="481.9" y="336" fill="none" width="15" height="14"/>
            </g>
            <rect x="488.9" y="337" width="1.5" height="2.6"/>
            <rect x="488.9" y="341.7" width="1.5" height="2.6"/>
            <rect x="488.9" y="346.3" width="1.5" height="2.6"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="481.9" y="322" fill="none" width="15" height="14"/>
            </g>
            <rect x="488.9" y="323.1" width="1.5" height="2.6"/>
            <rect x="488.9" y="327.7" width="1.5" height="2.6"/>
            <rect x="488.9" y="332.3" width="1.5" height="2.6"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="481.9" y="308.1" fill="none" width="15" height="14"/>
            </g>
            <rect x="488.9" y="309.1" width="1.5" height="2.6"/>
            <rect x="488.9" y="313.7" width="1.5" height="2.6"/>
            <rect x="488.9" y="318.4" width="1.5" height="2.6"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="481.9" y="294.1" fill="none" width="15" height="14"/>
            </g>
            <rect x="488.9" y="295.1" width="1.5" height="2.6"/>
            <rect x="488.9" y="299.8" width="1.5" height="2.6"/>
            <rect x="488.9" y="304.4" width="1.5" height="2.6"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="481.9" y="280.1" fill="none" width="15" height="14"/>
            </g>
            <rect x="488.9" y="281.1" width="1.5" height="2.6"/>
            <rect x="488.9" y="285.8" width="1.5" height="2.6"/>
            <rect x="488.9" y="290.4" width="1.5" height="2.6"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="481.9" y="266.1" fill="none" width="15" height="14"/>
            </g>
            <rect x="488.9" y="267.2" width="1.5" height="2.6"/>
            <rect x="488.9" y="271.8" width="1.5" height="2.6"/>
            <rect x="488.9" y="276.5" width="1.5" height="2.6"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="481.9" y="252.2" fill="none" width="15" height="14"/>
            </g>
            <rect x="488.9" y="253.2" width="1.5" height="2.6"/>
            <rect x="488.9" y="257.8" width="1.5" height="2.6"/>
            <rect x="488.9" y="262.5" width="1.5" height="2.6"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="481.9" y="238.2" fill="none" width="15" height="14"/>
            </g>
            <rect x="488.9" y="239.2" width="1.5" height="2.6"/>
            <rect x="488.9" y="243.9" width="1.5" height="2.6"/>
            <rect x="488.9" y="248.5" width="1.5" height="2.6"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="481.9" y="224.2" fill="none" width="15" height="14"/>
            </g>
            <rect x="488.9" y="225.2" width="1.5" height="2.6"/>
            <rect x="488.9" y="229.9" width="1.5" height="2.6"/>
            <rect x="488.9" y="234.5" width="1.5" height="2.6"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="481.9" y="210.2" fill="none" width="15" height="14"/>
            </g>
            <rect x="488.9" y="211.3" width="1.5" height="2.6"/>
            <rect x="488.9" y="215.9" width="1.5" height="2.6"/>
            <rect x="488.9" y="220.6" width="1.5" height="2.6"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="481.9" y="196.3" fill="none" width="15" height="14"/>
            </g>
            <rect x="488.9" y="197.3" width="1.5" height="2.6"/>
            <rect x="488.9" y="202" width="1.5" height="2.6"/>
            <rect x="488.9" y="206.6" width="1.5" height="2.6"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              <rect x="481.9" y="182.3" fill="none" width="15" height="14"/>
            </g>
            <rect x="488.9" y="183.3" width="1.5" height="2.6"/>
            <rect x="488.9" y="188" width="1.5" height="2.6"/>
            <rect x="488.9" y="192.6" width="1.5" height="2.6"/>
          </g>
        </g>
      </g>
    </g>
  </g>
  <line fill="none" stroke="#808285" stroke-width="5" stroke-miterlimit="10" x1="4.4" y1="109" x2="87.4" y2="109"/>
  <line fill="none" stroke="#808285" stroke-width="5" stroke-miterlimit="10" x1="85.4" y1="145.8" x2="184.9" y2="145.8"/>
  <line fill="none" stroke="#808285" stroke-width="5" stroke-miterlimit="10" x1="180.4" y1="183.6" x2="281.4" y2="183.6"/>
  <line fill="none" stroke="#808285" stroke-width="5" stroke-miterlimit="10" x1="276.4" y1="219.8" x2="385.2" y2="219.8"/>
  <line fill="none" stroke="#808285" stroke-width="5" stroke-miterlimit="10" x1="380.4" y1="256.6" x2="488.7" y2="256.6"/>
  <line fill="none" stroke="#808285" stroke-width="5" stroke-miterlimit="10" x1="489.4" y1="299.3" x2="590.4" y2="299.3"/>
  <line fill="none" stroke="#808285" stroke-width="5" stroke-miterlimit="10" x1="84.9" y1="148.3" x2="84.9" y2="107.6"/>
  <line fill="none" stroke="#808285" stroke-width="5" stroke-miterlimit="10" x1="182.6" y1="185.6" x2="182.6" y2="143.3"/>
  <line fill="none" stroke="#808285" stroke-width="5" stroke-miterlimit="10" x1="278.9" y1="222" x2="278.9" y2="181.3"/>
  <line fill="none" stroke="#808285" stroke-width="5" stroke-miterlimit="10" x1="382.8" y1="259" x2="382.8" y2="217.8"/>
  <line fill="none" stroke="#808285" stroke-miterlimit="10" x1="49.7" y1="302" x2="465.1" y2="302"/>
  <g>
    <path fill="#C2B59B" d="M45.2,303.9L45.2,303.9c0.1,0.1,0.2,0.1,0.3,0.1c0.3,0,0.5-0.2,0.5-0.5c0-0.1-0.1-0.3-0.2-0.4l0,0l-1.6-1.5
      l1.6-1.5l0,0c0.1-0.1,0.2-0.2,0.2-0.4c0-0.3-0.2-0.5-0.5-0.5c-0.1,0-0.2,0.1-0.3,0.1l0,0l-2,1.8c-0.1,0.1-0.2,0.2-0.2,0.4
      c0,0.1,0.1,0.3,0.2,0.4L45.2,303.9z M44.7,307c2.9,0,5.3-2.4,5.3-5.3c0-2.9-2.4-5.3-5.3-5.3c-2.9,0-5.3,2.4-5.3,5.3
      C39.4,304.6,41.8,307,44.7,307L44.7,307z M44.7,297.4c2.4,0,4.3,1.9,4.3,4.3c0,2.4-1.9,4.3-4.3,4.3c-2.4,0-4.3-1.9-4.3-4.3
      C40.4,299.3,42.4,297.4,44.7,297.4L44.7,297.4z"/>
  </g>
  <g>
    <path fill="#C2B59B" d="M470.7,302c0.1-0.1,0.2-0.2,0.2-0.4c0-0.1-0.1-0.3-0.2-0.4l-2-1.8l0,0c-0.1-0.1-0.2-0.1-0.3-0.1
      c-0.3,0-0.5,0.2-0.5,0.5c0,0.1,0.1,0.3,0.2,0.4l0,0l1.6,1.5l-1.6,1.5l0,0c-0.1,0.1-0.2,0.2-0.2,0.4c0,0.3,0.2,0.5,0.5,0.5
      c0.1,0,0.2-0.1,0.3-0.1l0,0L470.7,302z M469.2,306.9c2.9,0,5.3-2.4,5.3-5.3c0-2.9-2.4-5.3-5.3-5.3c-2.9,0-5.3,2.4-5.3,5.3
      C463.9,304.5,466.3,306.9,469.2,306.9L469.2,306.9z M469.2,297.3c2.4,0,4.3,1.9,4.3,4.3c0,2.4-1.9,4.3-4.3,4.3
      c-2.4,0-4.3-1.9-4.3-4.3C464.9,299.2,466.9,297.3,469.2,297.3L469.2,297.3z"/>
  </g>
  <g>
    <path fill="#6D6E71" d="M177.6,284.3v11.9h7.8v2.7h-10.7v-14.6H177.6L177.6,284.3z"/>
    <path fill="#6D6E71" d="M189.1,296.8c-1.4-1.4-2.1-3.1-2.1-5.2c0-2.1,0.7-3.8,2.1-5.2c1.4-1.4,3.1-2.1,5.2-2.1
      c2.1,0,3.8,0.7,5.2,2.1c1.4,1.4,2.1,3.1,2.1,5.2c0,2.1-0.7,3.8-2.1,5.2c-1.4,1.4-3.1,2.1-5.2,2.1
      C192.2,298.9,190.5,298.2,189.1,296.8z M194.4,296.2c1.3,0,2.4-0.4,3.2-1.3c0.8-0.9,1.2-2,1.2-3.3c0-1.3-0.4-2.4-1.2-3.3
      c-0.8-0.9-1.9-1.3-3.2-1.3c-1.3,0-2.4,0.4-3.2,1.3c-0.8,0.9-1.2,2-1.2,3.3c0,1.3,0.4,2.4,1.2,3.3
      C192,295.8,193.1,296.2,194.4,296.2z"/>
    <path fill="#6D6E71" d="M211.8,284.8c0.7,0.3,1.4,0.8,2.1,1.5l-2,2c-0.7-0.8-1.6-1.2-2.7-1.2c-1.1,0-1.9,0.3-2.2,0.8s-0.3,1,0,1.4
      c0.3,0.4,1.1,0.7,2.2,0.9c1.2,0.1,2.4,0.5,3.4,1.2c1,0.7,1.5,1.8,1.5,3.3c0,1.2-0.5,2.2-1.6,3s-2.3,1.3-3.8,1.3
      c-1.4,0-2.5-0.2-3.4-0.6c-0.9-0.4-1.7-0.9-2.3-1.6l2-2c0.7,0.8,1.8,1.2,3.3,1.4c1.3,0,2.1-0.3,2.4-0.8c0.3-0.5,0.3-1.1,0-1.7
      c-0.3-0.6-1.1-0.9-2.4-1c-1.2-0.1-2.2-0.5-3.2-1.1s-1.5-1.6-1.5-3c0-1.3,0.6-2.3,1.7-3.1c1.1-0.8,2.3-1.2,3.4-1.2
      C210,284.3,211,284.5,211.8,284.8z"/>
    <path fill="#6D6E71" d="M228.7,284.3v2.7h-4.9v11.9h-2.9V287H216v-2.7H228.7L228.7,284.3z"/>
    <path fill="#6D6E71" d="M249.6,284.3v2.7h-4.9v11.9h-2.9V287h-4.9v-2.7H249.6L249.6,284.3z"/>
    <path fill="#6D6E71" d="M251.8,284.3h2.9V299h-2.9V284.3z"/>
    <path fill="#6D6E71" d="M257.7,298.9v-14.6h1l6.3,7.2l6.4-7.2h1v14.6h-3v-8.5l-4.4,4.9l-4.4-4.9v8.5H257.7z"/>
    <path fill="#6D6E71" d="M275.2,298.9v-14.6H286v2.7h-7.8v3.1h5.9v2.7h-5.9v3.3h7.8v2.7L275.2,298.9L275.2,298.9z"/>
  </g>
  <text transform="matrix(1 0 0 1 502.1113 317.3066)" fill="#6D6E71" font-family="'MyriadPro-Regular'" font-size="12">HOME SEEN AS</text>
  <text transform="matrix(1 0 0 1 504.8125 331.707)" fill="#6D6E71" font-family="'MyriadPro-Regular'" font-size="12">U</text>
  <text transform="matrix(1 0 0 1 512.5762 331.707)" fill="#6D6E71" font-family="'MyriadPro-Regular'" font-size="12">N</text>
  <text transform="matrix(1 0 0 1 520.4717 331.707)" fill="#6D6E71" font-family="'MyriadPro-Regular'" font-size="12">D</text>
  <text transform="matrix(1 0 0 1 528.4629 331.707)" fill="#6D6E71" font-family="'MyriadPro-Regular'" font-size="12">E</text>
  <text transform="matrix(1 0 0 1 534.3672 331.707)" fill="#6D6E71" font-family="'MyriadPro-Regular'" font-size="12">S</text>
  <text transform="matrix(1 0 0 1 540.2832 331.707)" fill="#6D6E71" font-family="'MyriadPro-Regular'" font-size="12">I</text>
  <text transform="matrix(1 0 0 1 543.1514 331.707)" fill="#6D6E71" font-family="'MyriadPro-Regular'" font-size="12">R</text>
  <text transform="matrix(1 0 0 1 549.667 331.707)" fill="#6D6E71" font-family="'MyriadPro-Regular'" font-size="12">A</text>
  <text transform="matrix(1 0 0 1 557.0117 331.707)" fill="#6D6E71" font-family="'MyriadPro-Regular'" font-size="12">B</text>
  <text transform="matrix(1 0 0 1 563.5156 331.707)" fill="#6D6E71" font-family="'MyriadPro-Regular'" font-size="12">L</text>
  <text transform="matrix(1 0 0 1 569.1787 331.707)" fill="#6D6E71" font-family="'MyriadPro-Regular'" font-size="12">E</text>
  <text transform="matrix(1 0 0 1 512.6113 346.1074)" fill="#6D6E71" font-family="'MyriadPro-Regular'" font-size="12">B</text>
  <text transform="matrix(1 0 0 1 518.9355 346.1074)" fill="#6D6E71" font-family="'MyriadPro-Regular'" font-size="12">Y</text>
  <text transform="matrix(1 0 0 1 525.4277 346.1074)" fill="#6D6E71" font-family="'MyriadPro-Regular'" font-size="12"> </text>
  <text transform="matrix(1 0 0 1 527.9707 346.1074)" fill="#6D6E71" font-family="'MyriadPro-Regular'" font-size="12">B</text>
  <text transform="matrix(1 0 0 1 534.4746 346.1074)" fill="#6D6E71" font-family="'MyriadPro-Regular'" font-size="12">U</text>
  <text transform="matrix(1 0 0 1 542.2393 346.1074)" fill="#6D6E71" font-family="'MyriadPro-Regular'" font-size="12">Y</text>
  <text transform="matrix(1 0 0 1 548.6465 346.1074)" fill="#6D6E71" font-family="'MyriadPro-Regular'" font-size="12">E</text>
  <text transform="matrix(1 0 0 1 554.5508 346.1074)" fill="#6D6E71" font-family="'MyriadPro-Regular'" font-size="12">R</text>
  <text transform="matrix(1 0 0 1 561.0068 346.1074)" fill="#6D6E71" font-family="'MyriadPro-Regular'" font-size="12">S</text>
  <g>
    <line fill="none" x1="75.4" y1="64.3" x2="500.4" y2="217.3"/>
    <g>
      <g>
        <g>
          <g>
            <g>
              
                <rect x="75" y="59" transform="matrix(-0.9409 -0.3387 0.3387 -0.9409 135.9598 156.7278)" fill="none" width="13.3" height="15"/>
            </g>
            <rect x="85" y="67" transform="matrix(0.3389 -0.9408 0.9408 0.3389 -7.5621 125.7632)" width="1.5" height="2.5"/>
            <rect x="80.8" y="65.5" transform="matrix(0.3385 -0.941 0.941 0.3385 -8.8129 120.8682)" width="1.5" height="2.5"/>
            <rect x="76.6" y="64" transform="matrix(0.3389 -0.9408 0.9408 0.3389 -10.3147 115.8938)" width="1.5" height="2.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              
                <rect x="87.5" y="63.5" transform="matrix(-0.9409 -0.3386 0.3386 -0.9409 158.7022 169.6866)" fill="none" width="13.3" height="15"/>
            </g>
            <rect x="97.4" y="71.5" transform="matrix(0.3385 -0.941 0.941 0.3385 -3.5131 140.4974)" width="1.5" height="2.5"/>
            <rect x="93.2" y="70.1" transform="matrix(0.3389 -0.9408 0.9408 0.3389 -4.9739 135.5554)" width="1.5" height="2.5"/>
            <rect x="89.1" y="68.4" transform="matrix(0.3386 -0.9409 0.9409 0.3386 -6.1006 130.6652)" width="1.5" height="2.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              
                <rect x="100" y="68" transform="matrix(-0.9409 -0.3386 0.3386 -0.9409 181.445 182.6579)" fill="none" width="13.3" height="15"/>
            </g>
            <rect x="110" y="76" transform="matrix(0.3392 -0.9407 0.9407 0.3392 0.4964 155.1784)" width="1.5" height="2.5"/>
            <rect x="105.8" y="74.4" transform="matrix(0.3389 -0.9408 0.9408 0.3389 -0.7503 150.294)" width="1.5" height="2.5"/>
            <rect x="101.6" y="73" transform="matrix(0.3382 -0.9411 0.9411 0.3382 -2.2125 145.4442)" width="1.5" height="2.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              
                <rect x="112.5" y="72.5" transform="matrix(-0.9409 -0.3386 0.3386 -0.9409 204.1841 195.6167)" fill="none" width="13.3" height="15"/>
            </g>
            <rect x="122.5" y="80.5" transform="matrix(0.3389 -0.9408 0.9408 0.3389 4.5295 169.9621)" width="1.5" height="2.5"/>
            <rect x="118.3" y="79.1" transform="matrix(0.3389 -0.9408 0.9408 0.3389 3.121 165.1794)" width="1.5" height="2.5"/>
            <rect x="114.1" y="77.6" transform="matrix(0.3388 -0.9409 0.9409 0.3388 1.8198 160.2144)" width="1.5" height="2.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              
                <rect x="125" y="77" transform="matrix(-0.9409 -0.3387 0.3387 -0.9409 226.9063 208.615)" fill="none" width="13.3" height="15"/>
            </g>
            <rect x="134.9" y="85" transform="matrix(0.3388 -0.9409 0.9409 0.3388 8.5508 184.6697)" width="1.5" height="2.5"/>
            <rect x="130.8" y="83.6" transform="matrix(0.3389 -0.9408 0.9408 0.3389 7.1526 179.7936)" width="1.5" height="2.5"/>
            <rect x="126.6" y="82" transform="matrix(0.3382 -0.9411 0.9411 0.3382 5.928 174.9545)" width="1.5" height="2.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              
                <rect x="137.5" y="81.5" transform="matrix(-0.9409 -0.3387 0.3387 -0.9409 249.6414 221.5675)" fill="none" width="13.3" height="15"/>
            </g>
            <rect x="147.5" y="89.5" transform="matrix(0.3385 -0.941 0.941 0.3385 12.6477 199.4885)" width="1.5" height="2.5"/>
            <rect x="143.3" y="87.9" transform="matrix(0.3386 -0.9409 0.9409 0.3386 11.3582 194.543)" width="1.5" height="2.5"/>
            <rect x="139.1" y="86.6" transform="matrix(0.3385 -0.941 0.941 0.3385 9.8998 189.7223)" width="1.5" height="2.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              
                <rect x="150" y="86" transform="matrix(-0.9409 -0.3386 0.3386 -0.9409 272.3985 234.5144)" fill="none" width="13.3" height="15"/>
            </g>
            <rect x="159.9" y="94" transform="matrix(0.3389 -0.9408 0.9408 0.3389 16.5979 214.123)" width="1.5" height="2.5"/>
            <rect x="155.8" y="92.6" transform="matrix(0.3388 -0.9409 0.9409 0.3388 15.2277 209.3908)" width="1.5" height="2.5"/>
            <rect x="151.6" y="90.9" transform="matrix(0.3386 -0.9409 0.9409 0.3386 14.0712 204.3484)" width="1.5" height="2.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              
                <rect x="162.5" y="90.5" transform="matrix(-0.9409 -0.3386 0.3386 -0.9409 295.1217 247.4977)" fill="none" width="13.3" height="15"/>
            </g>
            <rect x="172.4" y="98.5" transform="matrix(0.3389 -0.9408 0.9408 0.3389 20.6569 228.8803)" width="1.5" height="2.5"/>
            <rect x="168.3" y="96.9" transform="matrix(0.3386 -0.9409 0.9409 0.3386 19.4273 224.017)" width="1.5" height="2.5"/>
            <rect x="164" y="95.5" transform="matrix(0.3386 -0.9409 0.9409 0.3386 17.9218 219.0832)" width="1.5" height="2.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              
                <rect x="175" y="95" transform="matrix(-0.9409 -0.3387 0.3387 -0.9409 317.8483 260.4687)" fill="none" width="13.3" height="15"/>
            </g>
            <rect x="184.9" y="103" transform="matrix(0.3389 -0.9408 0.9408 0.3389 24.6913 243.628)" width="1.5" height="2.5"/>
            <rect x="180.8" y="101.6" transform="matrix(0.3392 -0.9407 0.9407 0.3392 23.2426 238.791)" width="1.5" height="2.5"/>
            <rect x="176.6" y="99.9" transform="matrix(0.3385 -0.941 0.941 0.3385 22.1377 233.8413)" width="1.5" height="2.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              
                <rect x="187.5" y="99.5" transform="matrix(-0.9409 -0.3388 0.3388 -0.9409 340.5761 273.4655)" fill="none" width="13.3" height="15"/>
            </g>
            <rect x="197.4" y="107.5" transform="matrix(0.3382 -0.9411 0.9411 0.3382 28.7979 258.4563)" width="1.5" height="2.5"/>
            <rect x="193.3" y="106.1" transform="matrix(0.3386 -0.9409 0.9409 0.3386 27.3439 253.526)" width="1.5" height="2.5"/>
            <rect x="189.1" y="104.5" transform="matrix(0.3385 -0.941 0.941 0.3385 26.0688 248.5988)" width="1.5" height="2.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              
                <rect x="200" y="104" transform="matrix(-0.9409 -0.3387 0.3387 -0.9409 363.3438 286.3997)" fill="none" width="13.3" height="15"/>
            </g>
            <rect x="209.9" y="112" transform="matrix(0.3389 -0.9408 0.9408 0.3389 32.7548 273.0964)" width="1.5" height="2.5"/>
            <rect x="205.8" y="110.6" transform="matrix(0.3389 -0.9408 0.9408 0.3389 31.3154 268.313)" width="1.5" height="2.5"/>
            <rect x="201.5" y="109" transform="matrix(0.3386 -0.9409 0.9409 0.3386 30.0125 263.2903)" width="1.5" height="2.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              
                <rect x="212.5" y="108.5" transform="matrix(-0.9409 -0.3387 0.3387 -0.9409 386.0804 299.369)" fill="none" width="13.3" height="15"/>
            </g>
            <rect x="222.4" y="116.4" transform="matrix(0.3389 -0.9408 0.9408 0.3389 36.8472 287.7728)" width="1.5" height="2.5"/>
            <rect x="218.3" y="115.1" transform="matrix(0.3383 -0.941 0.941 0.3383 35.4389 283.1704)" width="1.5" height="2.5"/>
            <rect x="214.1" y="113.5" transform="matrix(0.3389 -0.9408 0.9408 0.3389 34.0863 277.9991)" width="1.5" height="2.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              
                <rect x="225" y="113" transform="matrix(-0.9409 -0.3387 0.3387 -0.9409 408.8092 312.3608)" fill="none" width="13.3" height="15"/>
            </g>
            <rect x="235" y="121" transform="matrix(0.3392 -0.9407 0.9407 0.3392 40.764 302.5054)" width="1.5" height="2.5"/>
            <rect x="230.8" y="119.5" transform="matrix(0.3392 -0.9407 0.9407 0.3392 39.3434 297.6041)" width="1.5" height="2.5"/>
            <rect x="226.6" y="118.1" transform="matrix(0.3383 -0.941 0.941 0.3383 38.1834 292.9236)" width="1.5" height="2.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              
                <rect x="237.5" y="117.5" transform="matrix(-0.9409 -0.3387 0.3387 -0.9409 431.535 325.3199)" fill="none" width="13.3" height="15"/>
            </g>
            <rect x="247.5" y="125.5" transform="matrix(0.3389 -0.9408 0.9408 0.3389 44.8574 317.3246)" width="1.5" height="2.5"/>
            <rect x="243.3" y="123.9" transform="matrix(0.3389 -0.9408 0.9408 0.3389 43.5772 312.3982)" width="1.5" height="2.5"/>
            <rect x="239.1" y="122.6" transform="matrix(0.3385 -0.941 0.941 0.3385 42.1683 307.6249)" width="1.5" height="2.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              
                <rect x="250" y="122" transform="matrix(-0.9409 -0.3387 0.3387 -0.9409 454.3012 338.2672)" fill="none" width="13.3" height="15"/>
            </g>
            <rect x="259.9" y="129.9" transform="matrix(0.3386 -0.9409 0.9409 0.3386 48.9767 332.0634)" width="1.5" height="2.5"/>
            <rect x="255.8" y="128.6" transform="matrix(0.3382 -0.9411 0.9411 0.3382 47.5797 327.4304)" width="1.5" height="2.5"/>
            <rect x="251.6" y="127" transform="matrix(0.3385 -0.941 0.941 0.3385 46.2545 322.3198)" width="1.5" height="2.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              
                <rect x="262.5" y="126.5" transform="matrix(-0.9409 -0.3387 0.3387 -0.9409 477.0071 351.2575)" fill="none" width="13.3" height="15"/>
            </g>
            <rect x="272.5" y="134.5" transform="matrix(0.3389 -0.9408 0.9408 0.3389 52.9012 346.7971)" width="1.5" height="2.5"/>
            <rect x="268.3" y="133.1" transform="matrix(0.3389 -0.9408 0.9408 0.3389 51.4719 341.9974)" width="1.5" height="2.5"/>
            <rect x="264.1" y="131.6" transform="matrix(0.3382 -0.9411 0.9411 0.3382 50.2586 337.0889)" width="1.5" height="2.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              
                <rect x="275" y="131" transform="matrix(-0.9409 -0.3387 0.3387 -0.9409 499.7619 364.2105)" fill="none" width="13.3" height="15"/>
            </g>
            <rect x="285" y="139" transform="matrix(0.3383 -0.941 0.941 0.3383 57.0858 361.6734)" width="1.5" height="2.5"/>
            <rect x="280.8" y="137.4" transform="matrix(0.3392 -0.9407 0.9407 0.3392 55.6004 356.5259)" width="1.5" height="2.5"/>
            <rect x="276.6" y="136.1" transform="matrix(0.3379 -0.9412 0.9412 0.3379 54.3614 351.899)" width="1.5" height="2.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              
                <rect x="287.5" y="135.5" transform="matrix(-0.9409 -0.3387 0.3387 -0.9409 522.4956 377.1778)" fill="none" width="13.3" height="15"/>
            </g>
            <rect x="297.5" y="143.5" transform="matrix(0.3392 -0.9407 0.9407 0.3392 60.9038 376.2002)" width="1.5" height="2.5"/>
            <rect x="293.3" y="141.9" transform="matrix(0.3386 -0.9409 0.9409 0.3386 59.7679 371.4126)" width="1.5" height="2.5"/>
            <rect x="289.1" y="140.5" transform="matrix(0.3382 -0.9411 0.9411 0.3382 58.4235 366.6072)" width="1.5" height="2.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              
                <rect x="300" y="140" transform="matrix(-0.9409 -0.3387 0.3387 -0.9409 545.2307 390.14)" fill="none" width="13.3" height="15"/>
            </g>
            <rect x="309.9" y="147.9" transform="matrix(0.3385 -0.941 0.941 0.3385 65.1292 391.0445)" width="1.5" height="2.5"/>
            <rect x="305.8" y="146.6" transform="matrix(0.3386 -0.9409 0.9409 0.3386 63.6327 386.294)" width="1.5" height="2.5"/>
            <rect x="301.6" y="145" transform="matrix(0.3385 -0.941 0.941 0.3385 62.3714 381.2793)" width="1.5" height="2.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              
                <rect x="312.5" y="144.5" transform="matrix(-0.9409 -0.3387 0.3387 -0.9409 567.9933 403.1087)" fill="none" width="13.3" height="15"/>
            </g>
            <rect x="322.5" y="152.5" transform="matrix(0.3385 -0.941 0.941 0.3385 69.105 405.8519)" width="1.5" height="2.5"/>
            <rect x="318.3" y="151.1" transform="matrix(0.3386 -0.9409 0.9409 0.3386 67.6548 401.0273)" width="1.5" height="2.5"/>
            <rect x="314.1" y="149.5" transform="matrix(0.3392 -0.9407 0.9407 0.3392 66.2547 395.7927)" width="1.5" height="2.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              
                <rect x="325" y="149" transform="matrix(-0.9409 -0.3387 0.3387 -0.9409 590.7167 416.1027)" fill="none" width="13.3" height="15"/>
            </g>
            <rect x="335" y="157" transform="matrix(0.3386 -0.9409 0.9409 0.3386 73.1555 420.5507)" width="1.5" height="2.5"/>
            <rect x="330.8" y="155.4" transform="matrix(0.3392 -0.9407 0.9407 0.3392 71.7397 415.4179)" width="1.5" height="2.5"/>
            <rect x="326.5" y="154.1" transform="matrix(0.3385 -0.941 0.941 0.3385 70.3453 410.7221)" width="1.5" height="2.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              
                <rect x="337.5" y="153.5" transform="matrix(-0.9409 -0.3387 0.3387 -0.9409 613.4165 429.062)" fill="none" width="13.3" height="15"/>
            </g>
            <rect x="347.5" y="161.5" transform="matrix(0.3385 -0.941 0.941 0.3385 77.1918 435.321)" width="1.5" height="2.5"/>
            <rect x="343.3" y="159.9" transform="matrix(0.3385 -0.941 0.941 0.3385 75.9344 430.3942)" width="1.5" height="2.5"/>
            <rect x="339.1" y="158.5" transform="matrix(0.3385 -0.941 0.941 0.3385 74.4921 425.4875)" width="1.5" height="2.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              
                <rect x="350" y="158" transform="matrix(-0.9409 -0.3386 0.3386 -0.9409 636.2133 441.9778)" fill="none" width="13.3" height="15"/>
            </g>
            <rect x="359.9" y="165.9" transform="matrix(0.3392 -0.9407 0.9407 0.3392 81.0995 449.7627)" width="1.5" height="2.5"/>
            <rect x="355.8" y="164.7" transform="matrix(0.3386 -0.9409 0.9409 0.3386 79.7339 445.2501)" width="1.5" height="2.5"/>
            <rect x="351.6" y="163" transform="matrix(0.3386 -0.9409 0.9409 0.3386 78.4785 440.2058)" width="1.5" height="2.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              
                <rect x="362.5" y="162.5" transform="matrix(-0.9409 -0.3386 0.3386 -0.9409 658.9353 454.924)" fill="none" width="13.3" height="15"/>
            </g>
            <rect x="372.5" y="170.5" transform="matrix(0.3392 -0.9407 0.9407 0.3392 85.0778 464.5647)" width="1.5" height="2.5"/>
            <rect x="368.3" y="169.2" transform="matrix(0.3385 -0.941 0.941 0.3385 83.7976 460.0198)" width="1.5" height="2.5"/>
            <rect x="364" y="167.6" transform="matrix(0.3386 -0.9409 0.9409 0.3386 82.4287 454.8978)" width="1.5" height="2.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              
                <rect x="375" y="167" transform="matrix(-0.9409 -0.3387 0.3387 -0.9409 681.6293 467.9931)" fill="none" width="13.3" height="15"/>
            </g>
            <rect x="385" y="175" transform="matrix(0.3394 -0.9406 0.9406 0.3394 89.0332 479.2433)" width="1.5" height="2.5"/>
            <rect x="380.8" y="173.4" transform="matrix(0.3392 -0.9407 0.9407 0.3392 87.8555 474.3412)" width="1.5" height="2.5"/>
            <rect x="376.6" y="172" transform="matrix(0.3385 -0.941 0.941 0.3385 86.5976 469.7038)" width="1.5" height="2.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              
                <rect x="387.5" y="171.5" transform="matrix(-0.9409 -0.3387 0.3387 -0.9409 704.3844 480.9241)" fill="none" width="13.3" height="15"/>
            </g>
            <rect x="397.5" y="179.5" transform="matrix(0.3398 -0.9405 0.9405 0.3398 92.9551 493.8456)" width="1.5" height="2.5"/>
            <rect x="393.3" y="177.9" transform="matrix(0.3384 -0.941 0.941 0.3384 92.118 489.3717)" width="1.5" height="2.5"/>
            <rect x="389.1" y="176.5" transform="matrix(0.3386 -0.9409 0.9409 0.3386 90.634 484.4133)" width="1.5" height="2.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              
                <rect x="399.9" y="176" transform="matrix(-0.9409 -0.3388 0.3388 -0.9409 726.9192 493.9192)" fill="none" width="13.3" height="15"/>
            </g>
            <rect x="410" y="184" transform="matrix(0.3378 -0.9412 0.9412 0.3378 97.6177 509.2365)" width="1.5" height="2.5"/>
            <rect x="405.8" y="182.4" transform="matrix(0.3392 -0.9407 0.9407 0.3392 95.8887 503.8528)" width="1.5" height="2.5"/>
            <rect x="401.6" y="181" transform="matrix(0.339 -0.9408 0.9408 0.339 94.5225 498.9984)" width="1.5" height="2.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              
                <rect x="412.5" y="180.5" transform="matrix(-0.941 -0.3385 0.3385 -0.941 749.9562 506.7626)" fill="none" width="13.3" height="15"/>
            </g>
            <rect x="422.4" y="188.5" transform="matrix(0.3386 -0.9409 0.9409 0.3386 101.3564 523.689)" width="1.5" height="2.5"/>
            <rect x="418.3" y="186.9" transform="matrix(0.3386 -0.9409 0.9409 0.3386 100.0963 518.7908)" width="1.5" height="2.5"/>
            <rect x="414.1" y="185.5" transform="matrix(0.3388 -0.9409 0.9409 0.3388 98.6075 513.7887)" width="1.5" height="2.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              
                <rect x="425" y="185" transform="matrix(-0.9409 -0.3388 0.3388 -0.9409 772.542 519.8681)" fill="none" width="13.3" height="15"/>
            </g>
            <rect x="434.9" y="193" transform="matrix(0.3384 -0.941 0.941 0.3384 105.4683 538.5005)" width="1.5" height="2.5"/>
            <rect x="430.8" y="191.4" transform="matrix(0.3386 -0.9409 0.9409 0.3386 104.1514 533.5188)" width="1.5" height="2.5"/>
            <rect x="426.6" y="190" transform="matrix(0.339 -0.9408 0.9408 0.339 102.5823 528.4694)" width="1.5" height="2.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              
                <rect x="437.5" y="189.5" transform="matrix(-0.9409 -0.3386 0.3386 -0.9409 795.3939 532.7028)" fill="none" width="13.3" height="15"/>
            </g>
            <rect x="447.4" y="197.5" transform="matrix(0.3384 -0.941 0.941 0.3384 109.5038 553.2403)" width="1.5" height="2.5"/>
            <rect x="443.3" y="195.9" transform="matrix(0.3378 -0.9412 0.9412 0.3378 108.457 548.5485)" width="1.5" height="2.5"/>
            <rect x="439.1" y="194.5" transform="matrix(0.3384 -0.941 0.941 0.3384 106.7609 543.3839)" width="1.5" height="2.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              
                <rect x="450" y="194" transform="matrix(-0.9409 -0.3387 0.3387 -0.9409 818.0464 545.7804)" fill="none" width="13.3" height="15"/>
            </g>
            <rect x="460" y="202" transform="matrix(0.3392 -0.9407 0.9407 0.3392 113.2334 567.713)" width="1.5" height="2.5"/>
            <rect x="455.8" y="200.5" transform="matrix(0.3386 -0.9409 0.9409 0.3386 112.1711 563.0206)" width="1.5" height="2.5"/>
            <rect x="451.6" y="199" transform="matrix(0.3386 -0.9409 0.9409 0.3386 110.7832 558.0667)" width="1.5" height="2.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              
                <rect x="462.5" y="198.5" transform="matrix(-0.9409 -0.3386 0.3386 -0.9409 840.8589 558.6603)" fill="none" width="13.3" height="15"/>
            </g>
            <rect x="472.5" y="206.5" transform="matrix(0.3378 -0.9412 0.9412 0.3378 117.8335 582.9591)" width="1.5" height="2.5"/>
            <rect x="468.3" y="204.9" transform="matrix(0.3378 -0.9412 0.9412 0.3378 116.5702 578.0396)" width="1.5" height="2.5"/>
            <rect x="464.1" y="203.5" transform="matrix(0.3392 -0.9407 0.9407 0.3392 114.5924 572.59)" width="1.5" height="2.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              
                <rect x="474.9" y="203.1" transform="matrix(-0.9409 -0.3388 0.3388 -0.9409 863.2751 571.8895)" fill="none" width="13.3" height="15"/>
            </g>
            <rect x="485" y="211" transform="matrix(0.3386 -0.9409 0.9409 0.3386 121.5318 597.4147)" width="1.5" height="2.5"/>
            <rect x="480.7" y="209.6" transform="matrix(0.3378 -0.9412 0.9412 0.3378 120.4026 592.7944)" width="1.5" height="2.5"/>
            <rect x="476.6" y="208" transform="matrix(0.339 -0.9408 0.9408 0.339 118.6799 587.4152)" width="1.5" height="2.5"/>
          </g>
        </g>
        <g>
          <g>
            <g>
              
                <rect x="487.5" y="207.5" transform="matrix(-0.9409 -0.3387 0.3387 -0.9409 886.2727 584.6688)" fill="none" width="13.3" height="15"/>
            </g>
            <rect x="497.5" y="215.5" transform="matrix(0.339 -0.9408 0.9408 0.339 125.3826 612.021)" width="1.5" height="2.5"/>
            <rect x="493.2" y="214" transform="matrix(0.339 -0.9408 0.9408 0.339 124.0173 607.0485)" width="1.5" height="2.5"/>
            <rect x="489.1" y="212.5" transform="matrix(0.3386 -0.9409 0.9409 0.3386 122.865 602.3192)" width="1.5" height="2.5"/>
          </g>
        </g>
      </g>
    </g>
  </g>
  <polygon fill="#C2B59B" points="539,228 520.2,236.6 501.5,245.2 501.5,245.2 501.5,293.6 576.4,293.6 576.4,245.2 "/>
  <rect x="509.4" y="219.5" fill="#C2B59B" width="13" height="13"/>
  <rect x="507.6" y="217.3" fill="#C2B59B" width="16.7" height="4.3"/>
  <rect x="506.5" y="250.1" fill="#FFFFFF" width="17.4" height="18.6"/>
  <rect x="554" y="250.1" fill="#FFFFFF" width="17.4" height="18.6"/>
  <rect x="529.3" y="258.3" fill="#9B8579" width="19.3" height="35.3"/>
  <g>
    <g>
      <path fill="#FBBD90" d="M5.8,59.2l16.3-4.6c0,0,3.2-4.9,4.4-6.8c1-1.7,2.6-2.2,4.7-3c1.1-0.4,26.9-9.4,26.9-9.4
        c1.5-0.5,3.2,0.3,3.8,1.8c0.5,1.5-0.3,3.2-1.8,3.8l-7.8,2.8l0.3,1l13.1-4.7c1.5-0.5,3.2,0.3,3.8,1.8c0.5,1.5-0.3,3.2-1.8,3.8
        l-13.1,4.7l0.4,1l15.5-5.5c1.5-0.5,3.2,0.3,3.8,1.8c0.5,1.5-0.3,3.2-1.8,3.8L57,57l0.3,1l10.3-3.7c1.5-0.5,3.2,0.3,3.8,1.8
        c0.5,1.5-0.3,3.2-1.8,3.8l-16.2,5.8l0,0l0,0L6,83.7V59.2H5.8z"/>
      <path fill="#D9A47E" d="M5.8,83.1l47.3-18l0,0l0.1,0.3l-0.1-0.3l16.3-5.8c1.4-0.5,2.1-2,1.6-3.4s-2-2.1-3.4-1.6L57,58.1l-0.5-1.5
        L72.2,51c1.4-0.5,2.1-2,1.6-3.4s-2-2.1-3.4-1.6l-15.7,5.6l-0.5-1.5l13.3-4.8c0.7-0.2,1.2-0.7,1.5-1.4c0.3-0.6,0.3-1.4,0.1-2
        c-0.5-1.4-2-2.1-3.4-1.6l-13.4,4.8l-0.5-1.5l8.1-2.9c0.7-0.2,1.2-0.7,1.5-1.4c0.3-0.6,0.3-1.4,0.1-2c-0.2-0.7-0.7-1.2-1.4-1.5
        c-0.6-0.3-1.4-0.3-2-0.1c0,0-25.7,9-26.9,9.4l-0.4,0.2C29,46,27.6,46.5,26.7,48c-1.1,1.9-4.3,6.8-4.4,6.8l-0.1,0.1L5.7,59.6v-0.7
        l16.2-4.6c0.4-0.6,3.3-5,4.3-6.7c0.9-1.6,2.5-2.3,4.4-2.9l0.5-0.2c1.1-0.4,26.9-9.4,26.9-9.4c0.8-0.3,1.7-0.2,2.5,0.1
        c0.8,0.4,1.4,1,1.7,1.8c0.3,0.8,0.2,1.7-0.1,2.5c-0.4,0.8-1,1.4-1.8,1.7l-7.5,2.7l0.2,0.4l12.9-4.6c1.7-0.6,3.5,0.3,4.1,2
        c0.3,0.8,0.2,1.7-0.1,2.5c-0.4,0.8-1,1.4-1.8,1.7l-12.8,4.6l0.2,0.4l15.2-5.4c1.7-0.6,3.5,0.3,4.1,2c0.6,1.7-0.3,3.5-2,4.1
        L57.6,57l0.2,0.4l9.6-3.6c1.7-0.6,3.5,0.3,4.1,2c0.6,1.7-0.3,3.5-2,4.1l-16.1,5.7l0,0L5.8,83.7V83.1z"/>
    </g>
    <g>
      <g>
        
          <rect x="46.4" y="16.8" transform="matrix(0.7215 0.6924 -0.6924 0.7215 44.5485 -34.8459)" fill="#C7B89D" width="38.3" height="42.3"/>
        <g>
          
            <rect x="53.5" y="32.1" transform="matrix(0.7215 0.6924 -0.6924 0.7215 42.6005 -38.8922)" fill="#FFFFFF" width="32.3" height="2.9"/>
          
            <rect x="50.1" y="35.7" transform="matrix(0.7215 0.6924 -0.6924 0.7215 44.1778 -35.4901)" fill="#FFFFFF" width="32.3" height="2.9"/>
          
            <rect x="46.7" y="39.3" transform="matrix(0.7215 0.6924 -0.6924 0.7215 45.7038 -32.1721)" fill="#FFFFFF" width="32.3" height="2.9"/>
          
            <rect x="43.2" y="42.7" transform="matrix(0.7215 0.6924 -0.6924 0.7215 47.1408 -28.8119)" fill="#FFFFFF" width="32.3" height="2.9"/>
          
            <rect x="40.5" y="44.8" transform="matrix(0.7215 0.6924 -0.6924 0.7215 47.1182 -24.7019)" fill="#FFFFFF" width="27.6" height="2.9"/>
        </g>
      </g>
      <g>
        
          <rect x="34.2" y="6.8" transform="matrix(0.908 0.419 -0.419 0.908 17.8549 -20.5122)" fill="#DDCCAD" width="42.8" height="47.2"/>
        <g>
          
            <rect x="40.3" y="22.8" transform="matrix(0.908 0.419 -0.419 0.908 15.6164 -22.2077)" fill="#FFFFFF" width="36.1" height="3.3"/>
          
            <rect x="38" y="27.9" transform="matrix(0.908 0.419 -0.419 0.908 17.5218 -20.7534)" fill="#FFFFFF" width="36.1" height="3.3"/>
          
            <rect x="35.6" y="32.9" transform="matrix(0.908 0.419 -0.419 0.908 19.4075 -19.2889)" fill="#FFFFFF" width="36.1" height="3.3"/>
          
            <rect x="33.3" y="37.9" transform="matrix(0.908 0.419 -0.419 0.908 21.2914 -17.8738)" fill="#FFFFFF" width="36.1" height="3.3"/>
          
            <rect x="31.2" y="41.8" transform="matrix(0.908 0.419 -0.419 0.908 22.4873 -15.5539)" fill="#FFFFFF" width="30.9" height="3.3"/>
        </g>
      </g>
    </g>
    <g>
      <g>
        <g>
          
            <rect x="43.5" y="31.9" transform="matrix(0.7411 -0.6714 0.6714 0.7411 -11.1376 51.0063)" fill="#4FBE96" width="34.2" height="16.1"/>
        </g>
        <g>
          <path fill="#145B47" d="M77.6,34.5L53.5,56.3l-9.8-10.9l24.1-21.8L77.6,34.5z M53.5,55.2l22.9-20.8l-8.8-9.7L44.8,45.5
            L53.5,55.2z"/>
        </g>
        <g>
          
            <ellipse transform="matrix(0.7411 -0.6714 0.6714 0.7411 -11.2102 51.0459)" fill="#145B47" cx="60.6" cy="40.1" rx="4.8" ry="5.9"/>
        </g>
        <g>
          <g>
            <g>
              
                <rect x="63" y="31.5" transform="matrix(0.7411 -0.6714 0.6714 0.7411 -4.1124 53.3698)" fill="#FFFFFF" width="8.2" height="1"/>
            </g>
            <g>
              
                <rect x="64.2" y="32.7" transform="matrix(0.7411 -0.6714 0.6714 0.7411 -4.6393 54.4462)" fill="#FFFFFF" width="8.2" height="1"/>
            </g>
            <g>
              
                <rect x="66.5" y="34.1" transform="matrix(0.7411 -0.6714 0.6714 0.7411 -5.2189 55.5755)" fill="#FFFFFF" width="5.9" height="1"/>
            </g>
          </g>
          <g>
            <g>
              
                <rect x="48" y="45.1" transform="matrix(0.7411 -0.6714 0.6714 0.7411 -17.1486 46.8016)" fill="#FFFFFF" width="8.2" height="1"/>
            </g>
            <g>
              
                <rect x="49" y="46.4" transform="matrix(0.7411 -0.6714 0.6714 0.7411 -17.6989 47.8058)" fill="#FFFFFF" width="8.2" height="1"/>
            </g>
            <g>
              
                <rect x="51.3" y="47.7" transform="matrix(0.7411 -0.6714 0.6714 0.7411 -18.2924 48.9241)" fill="#FFFFFF" width="5.9" height="1"/>
            </g>
          </g>
        </g>
        <g>
          <path fill="#4FBE96" d="M64.2,39.2c-0.4-0.2-1.3,0.2-1.6,0.4l0,0c-0.3,0-0.6,0.2-0.6,0.2l0,0l-0.8-0.9c-0.1-0.3-0.2-0.7-0.4-1.2
            c0,0,0.1-0.1,0-0.3c0-0.3-0.4-0.7-0.5-0.6c0,0-0.1,0-0.1,0.1c-0.1-0.1-0.2-0.2-0.3-0.3c-0.2-0.1-0.3-0.3-0.5-0.3
            c-0.5-0.3-1.2-0.4-1.8,0.1l0,0c-0.1,0-0.1,0.1-0.1,0.1c-0.3,0.3-0.5,0.5-0.6,0.8c-0.3,0.7,0,1.4,0.5,2c0,0-0.1,0-0.1,0.1
            c-0.1,0.2,0.2,0.5,0.5,0.6c0.2,0.1,0.3,0,0.3,0c0.4,0.3,0.9,0.4,1.3,0.5c0.1,0.2,0.5,0.6,0.7,0.8l0,0l0,0c0,0-0.2,0.3-0.2,0.6
            l0,0c-0.2,0.3-0.6,1.1-0.5,1.5c0,0.2,0.1,0.4,0.3,0.7c1.5,0.6,3.1,0.5,4.2-0.5s1.4-2.6,0.9-4.2C64.6,39.4,64.4,39.3,64.2,39.2z"
            />
        </g>
      </g>
      <g>
        <g>
          
            <rect x="47.9" y="44.3" transform="matrix(0.9882 -0.1531 0.1531 0.9882 -7.245 10.5672)" fill="#4FBE96" width="34.2" height="16.1"/>
        </g>
        <g>
          <path fill="#145B47" d="M82.1,57.1l-32.1,5l-2.2-14.5l32.1-5L82.1,57.1z M50.7,61.2l30.5-4.7l-2-12.9l-30.5,4.7L50.7,61.2z"/>
        </g>
        <g>
          
            <ellipse transform="matrix(0.9882 -0.1531 0.1531 0.9882 -7.2568 10.5742)" fill="#145B47" cx="65" cy="52.4" rx="4.8" ry="5.9"/>
        </g>
        <g>
          <g>
            <g>
              
                <rect x="70.7" y="48.8" transform="matrix(0.9882 -0.1532 0.1532 0.9882 -6.666 12.0419)" fill="#FFFFFF" width="8.2" height="1"/>
            </g>
            <g>
              
                <rect x="70.9" y="50.5" transform="matrix(0.9882 -0.1533 0.1533 0.9882 -6.927 12.0973)" fill="#FFFFFF" width="8.2" height="1"/>
            </g>
            <g>
              
                <rect x="72.4" y="52.2" transform="matrix(0.9882 -0.1533 0.1533 0.9882 -7.1821 12.1711)" fill="#FFFFFF" width="5.9" height="1"/>
            </g>
          </g>
          <g>
            <g>
              
                <rect x="50.6" y="51.9" transform="matrix(0.9882 -0.1531 0.1531 0.9882 -7.3756 8.9911)" fill="#FFFFFF" width="8.2" height="1"/>
            </g>
            <g>
              
                <rect x="50.8" y="53.6" transform="matrix(0.9882 -0.153 0.153 0.9882 -7.6267 9.0324)" fill="#FFFFFF" width="8.2" height="1"/>
            </g>
            <g>
              
                <rect x="52.3" y="55.3" transform="matrix(0.9882 -0.1529 0.1529 0.9882 -7.8769 9.1002)" fill="#FFFFFF" width="5.9" height="1"/>
            </g>
          </g>
        </g>
        <g>
          <path fill="#4FBE96" d="M68.4,53.7c-0.3-0.4-1.2-0.5-1.5-0.6l0,0c-0.2-0.2-0.6-0.2-0.6-0.2l0,0l-0.2-1.2
            c0.1-0.3,0.3-0.7,0.3-1.2c0,0,0.1-0.1,0.2-0.2c0.1-0.3,0.1-0.8-0.1-0.8h-0.1c0-0.1,0-0.2-0.1-0.4c-0.1-0.2-0.1-0.4-0.2-0.5
            c-0.3-0.5-0.7-1-1.6-0.9c0,0,0,0-0.1,0s-0.1,0-0.1,0c-0.4,0.1-0.7,0.2-1,0.4c-0.7,0.4-0.8,1.2-0.6,2h-0.1
            c-0.2,0.1-0.1,0.6,0.1,0.8c0.1,0.2,0.2,0.2,0.3,0.1c0.2,0.5,0.5,0.8,0.8,1.1c0,0.2,0.1,0.8,0.2,1.1c0,0,0,0,0,0.1l0,0
            c0,0-0.3,0.1-0.5,0.3l0,0c-0.3,0.1-1.1,0.6-1.3,1c-0.1,0.2-0.1,0.4-0.1,0.7c0.9,1.4,2.3,2.2,3.8,2c1.4-0.2,2.6-1.4,3-3
            C68.6,54.1,68.5,53.9,68.4,53.7z"/>
        </g>
      </g>
      <g>
        <g>
          
            <rect x="43.4" y="56.9" transform="matrix(0.9177 0.3973 -0.3973 0.9177 30.7817 -18.6836)" fill="#4FBE96" width="34.2" height="16.1"/>
        </g>
        <g>
          <path fill="#145B47" d="M72.5,78.1L42.7,65.2l5.8-13.4l29.8,12.9L72.5,78.1z M43.8,64.8l28.3,12.3l5.2-12L49,52.8L43.8,64.8z"/>
        </g>
        <g>
          
            <ellipse transform="matrix(0.9177 0.3973 -0.3973 0.9177 30.7655 -18.6936)" fill="#145B47" cx="60.5" cy="64.9" rx="4.8" ry="5.9"/>
        </g>
        <g>
          <g>
            <g>
              
                <rect x="66.4" y="67" transform="matrix(0.9178 0.3971 -0.3971 0.9178 32.5958 -22.4583)" fill="#FFFFFF" width="8.2" height="1"/>
            </g>
            <g>
              
                <rect x="65.7" y="68.6" transform="matrix(0.9177 0.3973 -0.3973 0.9177 33.1901 -22.0551)" fill="#FFFFFF" width="8.2" height="1"/>
            </g>
            <g>
              
                <rect x="66.2" y="70.3" transform="matrix(0.9177 0.3972 -0.3972 0.9177 33.8046 -21.6373)" fill="#FFFFFF" width="5.9" height="1"/>
            </g>
          </g>
          <g>
            <g>
              
                <rect x="47.7" y="58.9" transform="matrix(0.9177 0.3973 -0.3973 0.9177 27.8539 -15.7016)" fill="#FFFFFF" width="8.2" height="1"/>
            </g>
            <g>
              
                <rect x="47" y="60.5" transform="matrix(0.9177 0.3973 -0.3973 0.9177 28.4251 -15.2921)" fill="#FFFFFF" width="8.2" height="1"/>
            </g>
            <g>
              
                <rect x="47.5" y="62.1" transform="matrix(0.9177 0.3972 -0.3972 0.9177 29.0106 -14.9038)" fill="#FFFFFF" width="5.9" height="1"/>
            </g>
          </g>
        </g>
        <g>
          <path fill="#4FBE96" d="M62.7,67.9c0-0.4-0.7-1.1-1-1.3l0,0c-0.1-0.3-0.4-0.5-0.4-0.5l0,0l0.4-1.1c0.3-0.2,0.6-0.5,0.9-0.9
            c0,0,0.1,0,0.3-0.1c0.3-0.2,0.5-0.6,0.3-0.7h-0.1c0-0.1,0.1-0.2,0.1-0.4c0.1-0.2,0.1-0.4,0.1-0.6c0.1-0.6-0.1-1.2-0.9-1.6
            c0,0,0,0-0.1,0c-0.1,0-0.1,0-0.1,0c-0.4-0.1-0.7-0.2-1-0.2c-0.8,0-1.3,0.6-1.6,1.3c0,0,0-0.1-0.1-0.1c-0.2,0-0.4,0.4-0.3,0.7
            c0,0.2,0.1,0.3,0.1,0.3c-0.1,0.5,0,1,0.1,1.4c-0.1,0.2-0.3,0.7-0.4,1l0,0l0,0c0,0-0.3-0.1-0.6,0l0,0c-0.3,0-1.3-0.1-1.6,0.2
            c-0.1,0.1-0.3,0.3-0.5,0.5c0,1.7,0.8,3.1,2.2,3.7c1.3,0.6,2.9,0.2,4.2-0.9C62.7,68.3,62.7,68.1,62.7,67.9z"/>
        </g>
      </g>
    </g>
    <g>
      <g>
        <g>
          <path fill="#FBBD90" d="M5.8,59.3l19.6-5.8l12.5-2.8l12.3-4c2.2-0.8,3.9,0.8,4.4,2.1c0.8,2.2-0.4,4.4-1.8,4.9l-11.5,4L31.3,72
            L5.8,82.4V59.3z"/>
        </g>
        <g>
          <path fill="#D7A37D" d="M5.8,81.5l25.3-10.1l9.8-13.8L52,53.7c2-0.7,3-2.6,2.3-4.5c-0.8-2.2-2.8-2.3-4.5-1.7l-11.9,4.2
            c-0.1,0-0.1,0-0.2,0l0.2-0.9l0,0l11.5-4c2.6-0.9,4.8,0,5.6,2.2c0.8,2.3-0.4,4.7-2.9,5.5l-10.7,3.8l-9.8,13.8L5.8,82.4V81.5z"/>
        </g>
      </g>
      <g>
        
          <rect x="6.8" y="63.3" transform="matrix(0.331 0.9436 -0.9436 0.331 74.8254 26.1765)" fill="#F1F2F2" width="24.3" height="5.2"/>
      </g>
      <g>
        <polygon fill="#221205" points="5.8,54.4 13.5,53.2 22.5,79 5.8,86.4       "/>
      </g>
    </g>
  </g>
  <g>
    <path fill="#58595B" d="M8.9,92c0-0.2,0.1-0.4,0.4-0.4h0.3c0.2,0,0.4,0.1,0.4,0.4v9.2h4.4c0.2,0,0.4,0.1,0.4,0.4v0.2
      c0,0.2-0.1,0.4-0.4,0.4H9.3c-0.2,0-0.4-0.1-0.4-0.4V92z"/>
    <path fill="#58595B" d="M16.3,92c0-0.2,0.1-0.4,0.4-0.4H17c0.2,0,0.4,0.1,0.4,0.4v9.7c0,0.2-0.1,0.4-0.4,0.4h-0.3
      c-0.2,0-0.4-0.1-0.4-0.4V92z"/>
    <path fill="#58595B" d="M19.6,100.7l0.2-0.2c0.1-0.2,0.3-0.2,0.5,0c0.4,0.3,1.2,0.9,2.4,0.9c1.2,0,2.1-0.7,2.1-1.8
      c0-2.6-5.2-2-5.2-5.2c0-1.7,1.4-2.8,3.3-2.8c1.2,0,2.2,0.5,2.5,0.8c0.2,0.1,0.2,0.3,0.1,0.5l-0.1,0.2c-0.1,0.2-0.3,0.2-0.5,0.1
      c-0.4-0.3-1.1-0.7-2-0.7c-1.2,0-2.2,0.7-2.2,1.8c0,2.5,5.2,1.8,5.2,5.2c0,1.6-1.2,2.9-3.2,2.9c-1.5,0-2.6-0.7-3.1-1.1
      C19.5,101.1,19.4,100.9,19.6,100.7z"/>
    <path fill="#58595B" d="M30.4,92.6H27c-0.2,0-0.4-0.1-0.4-0.4V92c0-0.2,0.1-0.4,0.4-0.4h7.8c0.2,0,0.4,0.1,0.4,0.4v0.2
      c0,0.2-0.1,0.4-0.4,0.4h-3.4v9.2c0,0.2-0.1,0.4-0.4,0.4h-0.3c-0.2,0-0.4-0.1-0.4-0.4v-9.2H30.4z"/>
    <path fill="#58595B" d="M40.5,92c0-0.2,0.1-0.4,0.4-0.4h3.3c1.9,0,3.2,1.2,3.2,3.2c0,1.9-1.4,3.2-3.2,3.2h-2.6v3.7
      c0,0.2-0.1,0.4-0.4,0.4h-0.3c-0.2,0-0.4-0.1-0.4-0.4V92z M43.9,97.1c1.4,0,2.3-0.8,2.3-2.3c0-1.4-0.9-2.2-2.3-2.2h-2.5v4.5H43.9z"
      />
    <path fill="#58595B" d="M49.2,92c0-0.2,0.1-0.4,0.4-0.4h2.8c1,0,1.5,0.1,1.9,0.3c0.9,0.4,1.5,1.4,1.5,2.6c0,1.4-0.8,2.6-2,2.9l0,0
      c0,0,0.1,0.1,0.3,0.4l2,3.8c0.1,0.3,0,0.4-0.3,0.4h-0.4c-0.2,0-0.3-0.1-0.4-0.3l-2.2-4.1h-2.6v4c0,0.2-0.1,0.4-0.4,0.4h-0.3
      c-0.2,0-0.4-0.1-0.4-0.4L49.2,92L49.2,92z M52.7,96.8c1.3,0,2.1-0.9,2.1-2.2c0-0.8-0.4-1.5-1.1-1.8c-0.3-0.1-0.6-0.2-1.4-0.2h-2.1
      v4.2H52.7z"/>
    <path fill="#58595B" d="M58.3,92c0-0.2,0.1-0.4,0.4-0.4H59c0.2,0,0.4,0.1,0.4,0.4v9.7c0,0.2-0.1,0.4-0.4,0.4h-0.3
      c-0.2,0-0.4-0.1-0.4-0.4V92z"/>
    <path fill="#58595B" d="M66.8,91.5c1.9,0,3,0.7,3.5,1.1c0.2,0.1,0.2,0.3,0.1,0.5l-0.1,0.2c-0.1,0.2-0.3,0.2-0.5,0.1
      c-0.4-0.3-1.5-0.9-2.9-0.9c-2.5,0-4.2,1.9-4.2,4.4s1.7,4.5,4.3,4.5c1.6,0,2.6-0.8,3.1-1.1c0.2-0.1,0.4-0.1,0.5,0l0.1,0.2
      c0.1,0.2,0.1,0.4,0,0.5c-0.5,0.4-1.8,1.4-3.7,1.4c-3.2,0-5.3-2.4-5.3-5.5C61.5,93.8,63.7,91.5,66.8,91.5z"/>
    <path fill="#58595B" d="M72.8,92c0-0.2,0.1-0.4,0.4-0.4h5.2c0.2,0,0.4,0.1,0.4,0.4v0.2c0,0.2-0.1,0.4-0.4,0.4h-4.5v3.8h3.5
      c0.2,0,0.4,0.1,0.4,0.4V97c0,0.2-0.1,0.4-0.4,0.4h-3.6v3.9h4.8c0.2,0,0.4,0.1,0.4,0.4v0.2c0,0.2-0.1,0.4-0.4,0.4h-5.4
      c-0.2,0-0.4-0.1-0.4-0.4V92z"/>
  </g>
  <g>
    <path fill="#58595B" d="M89.5,133.2c0-0.2,0.1-0.3,0.3-0.3h2.4c1.4,0,2.4,0.9,2.4,2.4s-1,2.4-2.4,2.4h-1.9v2.8
      c0,0.2-0.1,0.3-0.3,0.3h-0.2c-0.2,0-0.3-0.1-0.3-0.3V133.2z M92,137c1,0,1.7-0.6,1.7-1.7c0-1.1-0.7-1.7-1.7-1.7h-1.8v3.4H92L92,137
      z"/>
    <path fill="#58595B" d="M95.9,133.2c0-0.2,0.1-0.3,0.3-0.3h2.1c0.7,0,1.1,0.1,1.4,0.2c0.7,0.3,1.1,1,1.1,2c0,1.1-0.6,1.9-1.5,2.2
      l0,0c0,0,0.1,0.1,0.2,0.3l1.5,2.9c0.1,0.2,0,0.3-0.2,0.3h-0.3c-0.2,0-0.3-0.1-0.3-0.2l-1.6-3.1h-1.9v3c0,0.2-0.1,0.3-0.3,0.3h-0.2
      c-0.2,0-0.3-0.1-0.3-0.3V133.2z M98.5,136.8c0.9,0,1.5-0.7,1.5-1.7c0-0.6-0.3-1.1-0.8-1.4c-0.2-0.1-0.5-0.1-1-0.1h-1.5v3.2H98.5z"
      />
    <path fill="#58595B" d="M102.6,133.2c0-0.2,0.1-0.3,0.3-0.3h0.2c0.2,0,0.3,0.1,0.3,0.3v7.3c0,0.2-0.1,0.3-0.3,0.3h-0.2
      c-0.2,0-0.3-0.1-0.3-0.3V133.2z"/>
    <path fill="#58595B" d="M108.9,132.8c1.4,0,2.2,0.6,2.6,0.8c0.1,0.1,0.1,0.2,0,0.4l-0.1,0.1c-0.1,0.1-0.2,0.1-0.4,0
      c-0.3-0.2-1.1-0.7-2.1-0.7c-1.9,0-3.1,1.4-3.1,3.3c0,1.9,1.2,3.4,3.1,3.4c1.2,0,2-0.6,2.3-0.9c0.1-0.1,0.3-0.1,0.4,0l0.1,0.1
      c0.1,0.1,0.1,0.3,0,0.4c-0.4,0.3-1.3,1-2.8,1c-2.4,0-3.9-1.8-3.9-4.1C105,134.5,106.6,132.8,108.9,132.8z"/>
    <path fill="#58595B" d="M113.3,133.2c0-0.2,0.1-0.3,0.3-0.3h3.8c0.2,0,0.3,0.1,0.3,0.3v0.1c0,0.2-0.1,0.3-0.3,0.3h-3.3v2.9h2.7
      c0.2,0,0.3,0.1,0.3,0.3v0.1c0,0.2-0.1,0.3-0.3,0.3h-2.7v2.9h3.5c0.2,0,0.3,0.1,0.3,0.3v0.1c0,0.2-0.1,0.3-0.3,0.3h-4
      c-0.2,0-0.3-0.1-0.3-0.3V133.2z"/>
    <path fill="#58595B" d="M122.2,133.2c0-0.2,0.1-0.3,0.3-0.3h2.1c0.7,0,1.1,0.1,1.4,0.2c0.7,0.3,1.1,1,1.1,2c0,1.1-0.6,1.9-1.5,2.2
      l0,0c0,0,0.1,0.1,0.2,0.3l1.5,2.9c0.1,0.2,0,0.3-0.2,0.3h-0.3c-0.2,0-0.3-0.1-0.3-0.2l-1.6-3.1H123v3c0,0.2-0.1,0.3-0.3,0.3h-0.3
      c-0.2,0-0.3-0.1-0.3-0.3L122.2,133.2L122.2,133.2z M124.8,136.8c0.9,0,1.5-0.7,1.5-1.7c0-0.6-0.3-1.1-0.8-1.4
      c-0.2-0.1-0.5-0.1-1-0.1H123v3.2H124.8z"/>
    <path fill="#58595B" d="M128.9,133.2c0-0.2,0.1-0.3,0.3-0.3h3.8c0.2,0,0.3,0.1,0.3,0.3v0.1c0,0.2-0.1,0.3-0.3,0.3h-3.3v2.9h2.7
      c0.2,0,0.3,0.1,0.3,0.3v0.1c0,0.2-0.1,0.3-0.3,0.3h-2.7v2.9h3.5c0.2,0,0.3,0.1,0.3,0.3v0.1c0,0.2-0.1,0.3-0.3,0.3h-4
      c-0.2,0-0.3-0.1-0.3-0.3V133.2z"/>
    <path fill="#58595B" d="M134.9,133.2c0-0.2,0.1-0.3,0.3-0.3h2.2c2.3,0,3.9,1.5,3.9,3.9c0,2.5-1.6,4-3.9,4h-2.2
      c-0.2,0-0.3-0.1-0.3-0.3V133.2z M137.3,140.1c1.9,0,3.2-1.1,3.2-3.3c0-2.1-1.3-3.3-3.2-3.3h-1.7v6.5L137.3,140.1L137.3,140.1z"/>
    <path fill="#58595B" d="M142.9,133.2c0-0.2,0.1-0.3,0.3-0.3h0.2c0.2,0,0.3,0.1,0.3,0.3v4.9c0,1.4,0.9,2.2,2.2,2.2
      c1.3,0,2.2-0.8,2.2-2.2v-4.8c0-0.2,0.1-0.3,0.3-0.3h0.2c0.2,0,0.3,0.1,0.3,0.3v4.9c0,1.8-1.2,2.9-2.9,2.9c-1.8,0-3-1.1-3-2.9v-5
      H142.9L142.9,133.2z"/>
    <path fill="#58595B" d="M154.2,132.8c1.4,0,2.2,0.6,2.6,0.8c0.1,0.1,0.1,0.2,0,0.4l-0.1,0.1c-0.1,0.1-0.2,0.1-0.4,0
      c-0.3-0.2-1.1-0.7-2.1-0.7c-1.9,0-3.1,1.4-3.1,3.3c0,1.9,1.2,3.4,3.1,3.4c1.2,0,2-0.6,2.3-0.9c0.1-0.1,0.3-0.1,0.4,0l0.1,0.1
      c0.1,0.1,0.1,0.3,0,0.4c-0.4,0.3-1.3,1-2.8,1c-2.4,0-3.9-1.8-3.9-4.1C150.3,134.5,151.9,132.8,154.2,132.8z"/>
    <path fill="#58595B" d="M160.4,133.6h-2.5c-0.2,0-0.3-0.1-0.3-0.3v-0.1c0-0.2,0.1-0.3,0.3-0.3h5.8c0.2,0,0.3,0.1,0.3,0.3v0.1
      c0,0.2-0.1,0.3-0.3,0.3h-2.5v6.9c0,0.2-0.1,0.3-0.3,0.3h-0.2c-0.2,0-0.3-0.1-0.3-0.3V133.6z"/>
    <path fill="#58595B" d="M165,133.2c0-0.2,0.1-0.3,0.3-0.3h0.2c0.2,0,0.3,0.1,0.3,0.3v7.3c0,0.2-0.1,0.3-0.3,0.3h-0.2
      c-0.2,0-0.3-0.1-0.3-0.3V133.2z"/>
    <path fill="#58595B" d="M171.4,132.8c2.3,0,3.9,1.8,3.9,4c0,2.3-1.7,4.1-3.9,4.1c-2.3,0-3.9-1.8-3.9-4.1
      C167.4,134.6,169.1,132.8,171.4,132.8z M171.4,140.2c1.8,0,3.1-1.5,3.1-3.4c0-1.9-1.3-3.3-3.1-3.3c-1.8,0-3.1,1.4-3.1,3.3
      C168.2,138.7,169.6,140.2,171.4,140.2z"/>
    <path fill="#58595B" d="M176.9,133.2c0-0.2,0.1-0.3,0.3-0.3h0.3c0.1,0,0.2,0.1,0.3,0.2l3.8,5.5c0.3,0.4,0.6,1.1,0.6,1.1l0,0
      c0,0-0.1-0.7-0.1-1.1v-5.4c0-0.2,0.1-0.3,0.3-0.3h0.2c0.2,0,0.3,0.1,0.3,0.3v7.3c0,0.2-0.1,0.3-0.3,0.3h-0.2
      c-0.1,0-0.2-0.1-0.3-0.2l-3.8-5.5c-0.3-0.4-0.6-1.1-0.6-1.1l0,0c0,0,0.1,0.7,0.1,1.1v5.4c0,0.2-0.1,0.3-0.3,0.3h-0.2
      c-0.2,0-0.3-0.1-0.3-0.3v-7.3H176.9z"/>
  </g>
  <g>
    <path fill="#58595B" d="M189.1,169.2c0-0.2,0.1-0.3,0.3-0.3h2.4c1.4,0,2.4,0.9,2.4,2.4s-1,2.4-2.4,2.4h-1.9v2.8
      c0,0.2-0.1,0.3-0.3,0.3h-0.2c-0.2,0-0.3-0.1-0.3-0.3V169.2z M191.7,173c1,0,1.7-0.6,1.7-1.7c0-1.1-0.7-1.7-1.7-1.7h-1.8v3.4H191.7
      L191.7,173z"/>
    <path fill="#58595B" d="M195.6,169.2c0-0.2,0.1-0.3,0.3-0.3h2.1c0.7,0,1.1,0.1,1.4,0.2c0.7,0.3,1.1,1,1.1,2c0,1.1-0.6,1.9-1.5,2.2
      l0,0c0,0,0.1,0.1,0.2,0.3l1.5,2.9c0.1,0.2,0,0.3-0.2,0.3h-0.3c-0.2,0-0.3-0.1-0.3-0.2l-1.6-3.1h-1.9v3c0,0.2-0.1,0.3-0.3,0.3h-0.2
      c-0.2,0-0.3-0.1-0.3-0.3V169.2z M198.2,172.8c0.9,0,1.5-0.7,1.5-1.7c0-0.6-0.3-1.1-0.8-1.4c-0.2-0.1-0.5-0.1-1-0.1h-1.5v3.2H198.2z
      "/>
    <path fill="#58595B" d="M202.3,169.2c0-0.2,0.1-0.3,0.3-0.3h0.2c0.2,0,0.3,0.1,0.3,0.3v7.3c0,0.2-0.1,0.3-0.3,0.3h-0.2
      c-0.2,0-0.3-0.1-0.3-0.3V169.2z"/>
    <path fill="#58595B" d="M208.6,168.8c1.4,0,2.2,0.6,2.6,0.8c0.1,0.1,0.1,0.2,0,0.4l-0.1,0.1c-0.1,0.1-0.2,0.1-0.4,0
      c-0.3-0.2-1.1-0.7-2.1-0.7c-1.9,0-3.1,1.4-3.1,3.3c0,1.9,1.2,3.4,3.1,3.4c1.2,0,2-0.6,2.3-0.9c0.1-0.1,0.3-0.1,0.4,0l0.1,0.1
      c0.1,0.1,0.1,0.3,0,0.4c-0.4,0.3-1.3,1-2.8,1c-2.4,0-3.9-1.8-3.9-4.1C204.7,170.5,206.3,168.8,208.6,168.8z"/>
    <path fill="#58595B" d="M213,169.2c0-0.2,0.1-0.3,0.3-0.3h3.8c0.2,0,0.3,0.1,0.3,0.3v0.1c0,0.2-0.1,0.3-0.3,0.3h-3.3v2.9h2.7
      c0.2,0,0.3,0.1,0.3,0.3v0.1c0,0.2-0.1,0.3-0.3,0.3h-2.7v2.9h3.5c0.2,0,0.3,0.1,0.3,0.3v0.1c0,0.2-0.1,0.3-0.3,0.3h-4
      c-0.2,0-0.3-0.1-0.3-0.3V169.2z"/>
    <path fill="#58595B" d="M221.8,169.2c0-0.2,0.1-0.3,0.3-0.3h2.1c0.7,0,1.1,0.1,1.4,0.2c0.7,0.3,1.1,1,1.1,2c0,1.1-0.6,1.9-1.5,2.2
      l0,0c0,0,0.1,0.1,0.2,0.3l1.5,2.9c0.1,0.2,0,0.3-0.2,0.3h-0.3c-0.2,0-0.3-0.1-0.3-0.2l-1.6-3.1h-1.9v3c0,0.2-0.1,0.3-0.3,0.3h-0.2
      c-0.2,0-0.3-0.1-0.3-0.3V169.2z M224.4,172.8c0.9,0,1.5-0.7,1.5-1.7c0-0.6-0.3-1.1-0.8-1.4c-0.2-0.1-0.5-0.1-1-0.1h-1.5v3.2H224.4z
      "/>
    <path fill="#58595B" d="M228.5,169.2c0-0.2,0.1-0.3,0.3-0.3h3.8c0.2,0,0.3,0.1,0.3,0.3v0.1c0,0.2-0.1,0.3-0.3,0.3h-3.3v2.9h2.7
      c0.2,0,0.3,0.1,0.3,0.3v0.1c0,0.2-0.1,0.3-0.3,0.3h-2.7v2.9h3.5c0.2,0,0.3,0.1,0.3,0.3v0.1c0,0.2-0.1,0.3-0.3,0.3h-4
      c-0.2,0-0.3-0.1-0.3-0.3V169.2z"/>
    <path fill="#58595B" d="M234.6,169.2c0-0.2,0.1-0.3,0.3-0.3h2.2c2.3,0,3.9,1.5,3.9,3.9c0,2.5-1.6,4-3.9,4h-2.2
      c-0.2,0-0.3-0.1-0.3-0.3V169.2L234.6,169.2z M237,176.1c1.9,0,3.2-1.1,3.2-3.3c0-2.1-1.3-3.3-3.2-3.3h-1.6v6.5L237,176.1L237,176.1
      z"/>
    <path fill="#58595B" d="M242.5,169.2c0-0.2,0.1-0.3,0.3-0.3h0.2c0.2,0,0.3,0.1,0.3,0.3v4.9c0,1.4,0.9,2.2,2.2,2.2s2.2-0.8,2.2-2.2
      v-4.8c0-0.2,0.1-0.3,0.3-0.3h0.2c0.2,0,0.3,0.1,0.3,0.3v4.9c0,1.8-1.2,2.9-2.9,2.9c-1.8,0-3-1.1-3-2.9v-5H242.5L242.5,169.2z"/>
    <path fill="#58595B" d="M253.8,168.8c1.4,0,2.2,0.6,2.6,0.8c0.1,0.1,0.1,0.2,0,0.4l-0.1,0.1c-0.1,0.1-0.2,0.1-0.4,0
      c-0.3-0.2-1.1-0.7-2.1-0.7c-1.9,0-3.1,1.4-3.1,3.3c0,1.9,1.2,3.4,3.1,3.4c1.2,0,2-0.6,2.3-0.9c0.1-0.1,0.3-0.1,0.4,0l0.1,0.1
      c0.1,0.1,0.1,0.3,0,0.4c-0.4,0.3-1.3,1-2.8,1c-2.4,0-3.9-1.8-3.9-4.1C250,170.5,251.6,168.8,253.8,168.8z"/>
    <path fill="#58595B" d="M260,169.6h-2.5c-0.2,0-0.3-0.1-0.3-0.3v-0.1c0-0.2,0.1-0.3,0.3-0.3h5.8c0.2,0,0.3,0.1,0.3,0.3v0.1
      c0,0.2-0.1,0.3-0.3,0.3h-2.5v6.9c0,0.2-0.1,0.3-0.3,0.3h-0.2c-0.2,0-0.3-0.1-0.3-0.3V169.6z"/>
    <path fill="#58595B" d="M264.7,169.2c0-0.2,0.1-0.3,0.3-0.3h0.2c0.2,0,0.3,0.1,0.3,0.3v7.3c0,0.2-0.1,0.3-0.3,0.3H265
      c-0.2,0-0.3-0.1-0.3-0.3V169.2z"/>
    <path fill="#58595B" d="M271,168.8c2.3,0,3.9,1.8,3.9,4c0,2.3-1.7,4.1-3.9,4.1c-2.3,0-3.9-1.8-3.9-4.1
      C267.1,170.5,268.8,168.8,271,168.8z M271,176.2c1.8,0,3.1-1.5,3.1-3.4c0-1.9-1.3-3.3-3.1-3.3s-3.1,1.4-3.1,3.3
      C267.9,174.7,269.2,176.2,271,176.2z"/>
    <path fill="#58595B" d="M276.6,169.2c0-0.2,0.1-0.3,0.3-0.3h0.3c0.1,0,0.2,0.1,0.3,0.2l3.8,5.5c0.3,0.4,0.6,1.1,0.6,1.1l0,0
      c0,0-0.1-0.7-0.1-1.1v-5.4c0-0.2,0.1-0.3,0.3-0.3h0.2c0.2,0,0.3,0.1,0.3,0.3v7.3c0,0.2-0.1,0.3-0.3,0.3H282c-0.1,0-0.2-0.1-0.3-0.2
      l-3.8-5.5c-0.3-0.4-0.6-1.1-0.6-1.1l0,0c0,0,0.1,0.7,0.1,1.1v5.4c0,0.2-0.1,0.3-0.3,0.3h-0.2c-0.2,0-0.3-0.1-0.3-0.3V169.2
      L276.6,169.2z"/>
  </g>
  <g>
    <path fill="#58595B" d="M285.5,206.5c0-0.2,0.1-0.3,0.3-0.3h2.4c1.4,0,2.4,0.9,2.4,2.4s-1,2.4-2.4,2.4h-1.9v2.8
      c0,0.2-0.1,0.3-0.3,0.3h-0.2c-0.2,0-0.3-0.1-0.3-0.3V206.5z M288,210.3c1,0,1.7-0.6,1.7-1.7c0-1.1-0.7-1.7-1.7-1.7h-1.8v3.4H288
      L288,210.3z"/>
    <path fill="#58595B" d="M291.9,206.5c0-0.2,0.1-0.3,0.3-0.3h2.1c0.7,0,1.1,0.1,1.4,0.2c0.7,0.3,1.1,1,1.1,2c0,1.1-0.6,1.9-1.5,2.2
      l0,0c0,0,0.1,0.1,0.2,0.3l1.5,2.9c0.1,0.2,0,0.3-0.2,0.3h-0.3c-0.2,0-0.3-0.1-0.3-0.2l-1.6-3.1h-1.9v3c0,0.2-0.1,0.3-0.3,0.3h-0.2
      c-0.2,0-0.3-0.1-0.3-0.3V206.5L291.9,206.5z M294.5,210.1c0.9,0,1.5-0.7,1.5-1.7c0-0.6-0.3-1.1-0.8-1.4c-0.2-0.1-0.5-0.1-1-0.1
      h-1.5v3.2H294.5z"/>
    <path fill="#58595B" d="M298.6,206.5c0-0.2,0.1-0.3,0.3-0.3h0.2c0.2,0,0.3,0.1,0.3,0.3v7.3c0,0.2-0.1,0.3-0.3,0.3h-0.2
      c-0.2,0-0.3-0.1-0.3-0.3V206.5z"/>
    <path fill="#58595B" d="M304.9,206.1c1.4,0,2.2,0.6,2.6,0.8c0.1,0.1,0.1,0.2,0,0.4l-0.1,0.1c-0.1,0.1-0.2,0.1-0.4,0
      c-0.3-0.2-1.1-0.7-2.1-0.7c-1.9,0-3.1,1.4-3.1,3.3s1.2,3.4,3.1,3.4c1.2,0,2-0.6,2.3-0.9c0.1-0.1,0.3-0.1,0.4,0l0.1,0.1
      c0.1,0.1,0.1,0.3,0,0.4c-0.4,0.3-1.3,1-2.8,1c-2.4,0-3.9-1.8-3.9-4.1C301,207.8,302.6,206.1,304.9,206.1z"/>
    <path fill="#58595B" d="M309.3,206.5c0-0.2,0.1-0.3,0.3-0.3h3.8c0.2,0,0.3,0.1,0.3,0.3v0.1c0,0.2-0.1,0.3-0.3,0.3h-3.3v2.9h2.7
      c0.2,0,0.3,0.1,0.3,0.3v0.1c0,0.2-0.1,0.3-0.3,0.3h-2.7v2.9h3.5c0.2,0,0.3,0.1,0.3,0.3v0.1c0,0.2-0.1,0.3-0.3,0.3h-4
      c-0.2,0-0.3-0.1-0.3-0.3V206.5z"/>
    <path fill="#58595B" d="M318.2,206.5c0-0.2,0.1-0.3,0.3-0.3h2.1c0.7,0,1.1,0.1,1.4,0.2c0.7,0.3,1.1,1,1.1,2c0,1.1-0.6,1.9-1.5,2.2
      l0,0c0,0,0.1,0.1,0.2,0.3l1.5,2.9c0.1,0.2,0,0.3-0.2,0.3h-0.3c-0.2,0-0.3-0.1-0.3-0.2l-1.6-3.1H319v3c0,0.2-0.1,0.3-0.3,0.3h-0.3
      c-0.2,0-0.3-0.1-0.3-0.3L318.2,206.5L318.2,206.5z M320.8,210.1c0.9,0,1.5-0.7,1.5-1.7c0-0.6-0.3-1.1-0.8-1.4
      c-0.2-0.1-0.4-0.1-1-0.1H319v3.2H320.8z"/>
    <path fill="#58595B" d="M324.9,206.5c0-0.2,0.1-0.3,0.3-0.3h3.8c0.2,0,0.3,0.1,0.3,0.3v0.1c0,0.2-0.1,0.3-0.3,0.3h-3.3v2.9h2.7
      c0.2,0,0.3,0.1,0.3,0.3v0.1c0,0.2-0.1,0.3-0.3,0.3h-2.7v2.9h3.5c0.2,0,0.3,0.1,0.3,0.3v0.1c0,0.2-0.1,0.3-0.3,0.3h-4
      c-0.2,0-0.3-0.1-0.3-0.3V206.5z"/>
    <path fill="#58595B" d="M330.9,206.5c0-0.2,0.1-0.3,0.3-0.3h2.2c2.3,0,3.9,1.5,3.9,3.9c0,2.5-1.6,4-3.9,4h-2.2
      c-0.2,0-0.3-0.1-0.3-0.3V206.5z M333.3,213.4c1.9,0,3.2-1.1,3.2-3.3c0-2.1-1.3-3.3-3.2-3.3h-1.7v6.5L333.3,213.4L333.3,213.4z"/>
    <path fill="#58595B" d="M338.8,206.5c0-0.2,0.1-0.3,0.3-0.3h0.2c0.2,0,0.3,0.1,0.3,0.3v4.9c0,1.4,0.9,2.2,2.2,2.2s2.2-0.8,2.2-2.2
      v-4.8c0-0.2,0.1-0.3,0.3-0.3h0.2c0.2,0,0.3,0.1,0.3,0.3v4.9c0,1.8-1.2,2.9-2.9,2.9c-1.8,0-3-1.1-3-2.9L338.8,206.5L338.8,206.5z"/>
    <path fill="#58595B" d="M350.2,206.1c1.4,0,2.2,0.6,2.6,0.8c0.1,0.1,0.1,0.2,0,0.4l-0.1,0.1c-0.1,0.1-0.2,0.1-0.4,0
      c-0.3-0.2-1.1-0.7-2.1-0.7c-1.9,0-3.1,1.4-3.1,3.3s1.2,3.4,3.1,3.4c1.2,0,2-0.6,2.3-0.9c0.1-0.1,0.3-0.1,0.4,0l0.1,0.1
      c0.1,0.1,0.1,0.3,0,0.4c-0.4,0.3-1.3,1-2.8,1c-2.4,0-3.9-1.8-3.9-4.1C346.3,207.8,347.9,206.1,350.2,206.1z"/>
    <path fill="#58595B" d="M356.4,206.9h-2.5c-0.2,0-0.3-0.1-0.3-0.3v-0.1c0-0.2,0.1-0.3,0.3-0.3h5.8c0.2,0,0.3,0.1,0.3,0.3v0.1
      c0,0.2-0.1,0.3-0.3,0.3h-2.5v6.9c0,0.2-0.1,0.3-0.3,0.3h-0.2c-0.2,0-0.3-0.1-0.3-0.3V206.9z"/>
    <path fill="#58595B" d="M361,206.5c0-0.2,0.1-0.3,0.3-0.3h0.2c0.2,0,0.3,0.1,0.3,0.3v7.3c0,0.2-0.1,0.3-0.3,0.3h-0.2
      c-0.2,0-0.3-0.1-0.3-0.3V206.5z"/>
    <path fill="#58595B" d="M367.4,206.1c2.3,0,3.9,1.8,3.9,4c0,2.3-1.7,4.1-3.9,4.1c-2.3,0-3.9-1.8-3.9-4.1
      C363.4,207.9,365.1,206.1,367.4,206.1z M367.4,213.5c1.8,0,3.1-1.5,3.1-3.4c0-1.9-1.3-3.3-3.1-3.3c-1.8,0-3.1,1.4-3.1,3.3
      C364.2,212,365.6,213.5,367.4,213.5z"/>
    <path fill="#58595B" d="M372.9,206.5c0-0.2,0.1-0.3,0.3-0.3h0.3c0.1,0,0.2,0.1,0.3,0.2l3.8,5.5c0.3,0.4,0.6,1.1,0.6,1.1l0,0
      c0,0-0.1-0.7-0.1-1.1v-5.4c0-0.2,0.1-0.3,0.3-0.3h0.2c0.2,0,0.3,0.1,0.3,0.3v7.3c0,0.2-0.1,0.3-0.3,0.3h-0.2
      c-0.1,0-0.2-0.1-0.3-0.2l-3.8-5.5c-0.3-0.4-0.6-1.1-0.6-1.1l0,0c0,0,0.1,0.7,0.1,1.1v5.4c0,0.2-0.1,0.3-0.3,0.3h-0.2
      c-0.2,0-0.3-0.1-0.3-0.3L372.9,206.5L372.9,206.5z"/>
  </g>
  <g>
    <path fill="#58595B" d="M389.3,243.1c0-0.2,0.1-0.3,0.3-0.3h2.4c1.4,0,2.4,0.9,2.4,2.4s-1,2.4-2.4,2.4h-1.9v2.8
      c0,0.2-0.1,0.3-0.3,0.3h-0.2c-0.2,0-0.3-0.1-0.3-0.3V243.1z M391.9,246.9c1,0,1.7-0.6,1.7-1.7c0-1.1-0.7-1.7-1.7-1.7h-1.8v3.4
      H391.9L391.9,246.9z"/>
    <path fill="#58595B" d="M395.8,243.1c0-0.2,0.1-0.3,0.3-0.3h2.1c0.7,0,1.1,0.1,1.4,0.2c0.7,0.3,1.1,1,1.1,2c0,1.1-0.6,1.9-1.5,2.2
      l0,0c0,0,0.1,0.1,0.2,0.3l1.5,2.9c0.1,0.2,0,0.3-0.2,0.3h-0.3c-0.2,0-0.3-0.1-0.3-0.2l-1.6-3.1h-1.9v3c0,0.2-0.1,0.3-0.3,0.3h-0.2
      c-0.2,0-0.3-0.1-0.3-0.3V243.1L395.8,243.1z M398.4,246.7c0.9,0,1.5-0.7,1.5-1.7c0-0.6-0.3-1.1-0.8-1.4c-0.2-0.1-0.5-0.1-1-0.1
      h-1.5v3.2H398.4z"/>
    <path fill="#58595B" d="M402.5,243.1c0-0.2,0.1-0.3,0.3-0.3h0.2c0.2,0,0.3,0.1,0.3,0.3v7.3c0,0.2-0.1,0.3-0.3,0.3h-0.2
      c-0.2,0-0.3-0.1-0.3-0.3V243.1z"/>
    <path fill="#58595B" d="M408.7,242.7c1.4,0,2.2,0.6,2.6,0.8c0.1,0.1,0.1,0.2,0,0.4l-0.1,0.1c-0.1,0.1-0.2,0.1-0.4,0
      c-0.3-0.2-1.1-0.7-2.1-0.7c-1.9,0-3.1,1.4-3.1,3.3c0,1.9,1.2,3.4,3.1,3.4c1.2,0,2-0.6,2.3-0.9c0.1-0.1,0.3-0.1,0.4,0l0.1,0.1
      c0.1,0.1,0.1,0.3,0,0.4c-0.4,0.3-1.3,1-2.8,1c-2.4,0-3.9-1.8-3.9-4.1C404.9,244.4,406.5,242.7,408.7,242.7z"/>
    <path fill="#58595B" d="M413.2,243.1c0-0.2,0.1-0.3,0.3-0.3h3.8c0.2,0,0.3,0.1,0.3,0.3v0.1c0,0.2-0.1,0.3-0.3,0.3H414v2.9h2.7
      c0.2,0,0.3,0.1,0.3,0.3v0.1c0,0.2-0.1,0.3-0.3,0.3H414v2.9h3.5c0.2,0,0.3,0.1,0.3,0.3v0.1c0,0.2-0.1,0.3-0.3,0.3h-4
      c-0.2,0-0.3-0.1-0.3-0.3V243.1z"/>
    <path fill="#58595B" d="M422,243.1c0-0.2,0.1-0.3,0.3-0.3h2.1c0.7,0,1.1,0.1,1.4,0.2c0.7,0.3,1.1,1,1.1,2c0,1.1-0.6,1.9-1.5,2.2
      l0,0c0,0,0.1,0.1,0.2,0.3l1.5,2.9c0.1,0.2,0,0.3-0.2,0.3h-0.3c-0.2,0-0.3-0.1-0.3-0.2l-1.6-3.1h-1.9v3c0,0.2-0.1,0.3-0.3,0.3h-0.2
      c-0.2,0-0.3-0.1-0.3-0.3V243.1L422,243.1z M424.6,246.7c0.9,0,1.5-0.7,1.5-1.7c0-0.6-0.3-1.1-0.8-1.4c-0.2-0.1-0.5-0.1-1-0.1h-1.5
      v3.2H424.6z"/>
    <path fill="#58595B" d="M428.7,243.1c0-0.2,0.1-0.3,0.3-0.3h3.8c0.2,0,0.3,0.1,0.3,0.3v0.1c0,0.2-0.1,0.3-0.3,0.3h-3.4v2.9h2.7
      c0.2,0,0.3,0.1,0.3,0.3v0.1c0,0.2-0.1,0.3-0.3,0.3h-2.7v2.9h3.5c0.2,0,0.3,0.1,0.3,0.3v0.1c0,0.2-0.1,0.3-0.3,0.3h-4
      c-0.2,0-0.3-0.1-0.3-0.3L428.7,243.1L428.7,243.1z"/>
    <path fill="#58595B" d="M434.8,243.1c0-0.2,0.1-0.3,0.3-0.3h2.2c2.3,0,3.9,1.5,3.9,3.9c0,2.5-1.6,4-3.9,4h-2.2
      c-0.2,0-0.3-0.1-0.3-0.3V243.1z M437.2,250c1.9,0,3.2-1.1,3.2-3.3c0-2.1-1.3-3.3-3.2-3.3h-1.7v6.5L437.2,250L437.2,250z"/>
    <path fill="#58595B" d="M442.7,243.1c0-0.2,0.1-0.3,0.3-0.3h0.2c0.2,0,0.3,0.1,0.3,0.3v4.9c0,1.4,0.9,2.2,2.2,2.2s2.2-0.8,2.2-2.2
      v-4.8c0-0.2,0.1-0.3,0.3-0.3h0.2c0.2,0,0.3,0.1,0.3,0.3v4.9c0,1.8-1.2,2.9-2.9,2.9c-1.8,0-3-1.1-3-2.9L442.7,243.1L442.7,243.1
      L442.7,243.1z"/>
    <path fill="#58595B" d="M454,242.7c1.4,0,2.2,0.6,2.6,0.8c0.1,0.1,0.1,0.2,0,0.4l-0.1,0.1c-0.1,0.1-0.2,0.1-0.4,0
      c-0.3-0.2-1.1-0.7-2.1-0.7c-1.9,0-3.1,1.4-3.1,3.3c0,1.9,1.2,3.4,3.1,3.4c1.2,0,2-0.6,2.3-0.9c0.1-0.1,0.3-0.1,0.4,0l0.1,0.1
      c0.1,0.1,0.1,0.3,0,0.4c-0.4,0.3-1.3,1-2.8,1c-2.4,0-3.9-1.8-3.9-4.1C450.1,244.4,451.7,242.7,454,242.7z"/>
    <path fill="#58595B" d="M460.2,243.5h-2.5c-0.2,0-0.3-0.1-0.3-0.3v-0.1c0-0.2,0.1-0.3,0.3-0.3h5.8c0.2,0,0.3,0.1,0.3,0.3v0.1
      c0,0.2-0.1,0.3-0.3,0.3H461v6.9c0,0.2-0.1,0.3-0.3,0.3h-0.2c-0.2,0-0.3-0.1-0.3-0.3V243.5z"/>
    <path fill="#58595B" d="M464.9,243.1c0-0.2,0.1-0.3,0.3-0.3h0.2c0.2,0,0.3,0.1,0.3,0.3v7.3c0,0.2-0.1,0.3-0.3,0.3h-0.2
      c-0.2,0-0.3-0.1-0.3-0.3V243.1z"/>
    <path fill="#58595B" d="M471.2,242.7c2.3,0,3.9,1.8,3.9,4c0,2.3-1.7,4.1-3.9,4.1c-2.3,0-3.9-1.8-3.9-4.1S468.9,242.7,471.2,242.7z
       M471.2,250.1c1.8,0,3.1-1.5,3.1-3.4c0-1.9-1.3-3.3-3.1-3.3s-3.1,1.4-3.1,3.3C468.1,248.6,469.4,250.1,471.2,250.1z"/>
    <path fill="#58595B" d="M476.8,243.1c0-0.2,0.1-0.3,0.3-0.3h0.3c0.1,0,0.2,0.1,0.3,0.2l3.8,5.5c0.3,0.4,0.6,1.1,0.6,1.1l0,0
      c0,0-0.1-0.7-0.1-1.1v-5.4c0-0.2,0.1-0.3,0.3-0.3h0.2c0.2,0,0.3,0.1,0.3,0.3v7.3c0,0.2-0.1,0.3-0.3,0.3h-0.3
      c-0.1,0-0.2-0.1-0.3-0.2l-3.8-5.5c-0.3-0.4-0.6-1.1-0.6-1.1l0,0c0,0,0.1,0.7,0.1,1.1v5.4c0,0.2-0.1,0.3-0.3,0.3h-0.2
      c-0.2,0-0.3-0.1-0.3-0.3V243.1z"/>
  </g>
  <g>
    <g>
      <g>
        <path fill="<?php echo $theme ?>" d="M208.4,224.4c0,6.9,2.6,13.2,6.9,18l18.3,31.3c0.4,0.7,1.1,1.1,1.9,1.1l0,0c0.8,0,1.5-0.4,1.9-1.1
          l21.1-34.8c0.2-0.3,0.3-0.6,0.3-0.8c2.4-4,3.8-8.8,3.8-13.8c0-15-12.2-27.1-27.1-27.1C220.6,197.3,208.4,209.5,208.4,224.4
          L208.4,224.4z M235.6,268.3l-11.2-19.2c3.4,1.5,7.2,2.4,11.1,2.4c4.3,0,8.3-1,11.9-2.8L235.6,268.3z M258.1,224.4
          c0,12.5-10.2,22.6-22.6,22.6c-12.5,0-22.6-10.2-22.6-22.6c0-12.5,10.2-22.6,22.6-22.6C248,201.8,258.1,211.9,258.1,224.4
          L258.1,224.4z"/>
      </g>
      <g>
        <path fill="$theme" d="M235.7,204.8c-10.6,0-19.3,8.6-19.3,19.3c0,10.6,8.6,19.3,19.3,19.3c10.6,0,19.3-8.7,19.3-19.3
          C254.9,213.4,246.3,204.8,235.7,204.8L235.7,204.8z M235.7,241.6c-9.7,0-17.5-7.9-17.5-17.5c0-9.7,7.9-17.5,17.5-17.5
          c9.7,0,17.5,7.9,17.5,17.5C253.2,233.7,245.3,241.6,235.7,241.6L235.7,241.6z"/>
        <path fill="$theme" d="M229.7,211.4L229,210l-0.8,0.4l0.7,1.4C229.2,211.6,229.5,211.5,229.7,211.4L229.7,211.4z"/>
        <path fill="$theme" d="M221.6,224.4c0-0.3,0-0.6,0-0.9h-2v1.8h2C221.6,224.9,221.6,224.7,221.6,224.4L221.6,224.4z"/>
        <path fill="$theme" d="M236.9,210v-2h-1.7v2c0.3,0,0.6,0,0.9,0C236.3,209.9,236.6,210,236.9,210L236.9,210z"/>
        <path fill="<?php echo $theme ?>" d="M250.8,217.8l-0.4-0.8l-1.6,0.8c0.1,0.3,0.3,0.5,0.4,0.8L250.8,217.8z"/>
        <path fill="<?php echo $theme ?>" d="M243.7,212.1c0.3,0.2,0.5,0.3,0.7,0.5l0.9-1.4l-0.7-0.5L243.7,212.1z"/>
        <path fill="<?php echo $theme ?>" d="M222.3,215.8l1.4,1c0.2-0.3,0.3-0.5,0.5-0.7l-1.4-1L222.3,215.8z"/>
        <path fill="<?php echo $theme ?>" d="M242,237.5l1.1,2.1l0.8-0.4l-1.1-2.1C242.5,237.3,242.2,237.4,242,237.5L242,237.5z"/>
        <path fill="<?php echo $theme ?>" d="M247.4,233.2l1.8,1.3l0.5-0.7l-1.8-1.3C247.8,232.7,247.6,233,247.4,233.2L247.4,233.2z"/>
        <path fill="<?php echo $theme ?>" d="M250.4,223.5c0,0.3,0,0.6,0,0.9c0,0.3,0,0.6,0,0.9h2v-1.8H250.4L250.4,223.5z"/>
        <path fill="<?php echo $theme ?>" d="M235.1,238.8v2h1.8v-2c-0.3,0-0.6,0-0.9,0S235.4,238.8,235.1,238.8L235.1,238.8z"/>
        <path fill="<?php echo $theme ?>" d="M226.8,238.3l0.7,0.5l1.3-2c-0.3-0.1-0.5-0.3-0.7-0.5L226.8,238.3z"/>
        <path fill="<?php echo $theme ?>" d="M221.2,231.8l0.4,0.8l1.9-1c-0.1-0.3-0.3-0.5-0.4-0.8L221.2,231.8z"/>
        <path fill="<?php echo $theme ?>" d="M236.6,211.5h-1.2v13.3l-7.3,8l0.2,0.2l7.1-7.8h9.4v-1.7h-8.1L236.6,211.5L236.6,211.5z"/>
      </g>
      <polygon fill="<?php echo $theme ?>" points="539,228 501.5,245.2 501.5,230.2 539,213     "/>
      <polygon fill="<?php echo $theme ?>" points="539,228 576.4,245.2 576.4,230.2 539,213     "/>
      <path fill="<?php echo $theme ?>" d="M504.9,248.5v9.3v3.2v9.3h20.7V261v-3.2v-9.3H504.9z M508.1,251.7h5.5v6.1h-5.5V251.7L508.1,251.7z
         M508.1,260.9h5.5v6.1h-5.5V260.9L508.1,260.9z M522.3,267h-5.5v-6.1h5.5V267z M516.8,257.8v-6.1h5.5v6.1H516.8z"/>
      <path fill="<?php echo $theme ?>" d="M552.4,248.5v9.3v3.2v9.3h20.7V261v-3.2v-9.3H552.4z M555.6,251.7h5.5v6.1h-5.5V251.7z M555.6,260.9h5.5
        v6.1h-5.5V260.9z M569.8,267h-5.5v-6.1h5.5V267z M564.3,257.8v-6.1h5.5v6.1H564.3z"/>
    </g>
    <g>
      <path fill="<?php echo $theme ?>" d="M247.1,110.1c0.1-0.2,0.3-0.3,0.5-0.2l0.4,0.1c0.2,0.1,0.3,0.2,0.3,0.4l0.5,6.4c0,0.6,0.1,1.4,0.1,1.4l0,0
        c0,0,0.5-0.6,0.9-1l4.4-4.7c0.1-0.2,0.3-0.2,0.5-0.1l0.4,0.1c0.2,0.1,0.3,0.2,0.2,0.4l-2.5,9.4c-0.1,0.2-0.2,0.3-0.5,0.2l-0.3-0.1
        c-0.2-0.1-0.3-0.2-0.2-0.4l1.8-6.8c0.1-0.5,0.4-1.4,0.4-1.4l0,0c0,0-0.6,0.8-1,1.2l-3.9,4c-0.1,0.2-0.3,0.2-0.5,0.1l-0.3-0.1
        c-0.2-0.1-0.3-0.2-0.3-0.4l-0.5-5.6c0-0.6,0-1.6,0-1.6l0,0c0,0-0.3,0.9-0.5,1.4l-2.8,6.4c-0.1,0.2-0.3,0.3-0.5,0.2l-0.3-0.1
        c-0.2-0.1-0.3-0.2-0.2-0.5L247.1,110.1z"/>
      <path fill="<?php echo $theme ?>" d="M260.7,114.8c0.1-0.2,0.3-0.2,0.5-0.1l0.5,0.2c0.2,0.1,0.3,0.2,0.3,0.4l0.2,10.4c0,0.3-0.2,0.4-0.4,0.3
        l-0.3-0.1c-0.2-0.1-0.3-0.2-0.3-0.4v-3.2l-4-1.4l-2,2.5c-0.1,0.2-0.3,0.2-0.5,0.1l-0.3-0.1c-0.3-0.1-0.3-0.3-0.2-0.5L260.7,114.8z
         M261.1,121.2v-4c0-0.5,0.1-1.4,0.1-1.4l0,0c0,0-0.5,0.7-0.8,1.2l-2.6,3.1L261.1,121.2z"/>
      <path fill="<?php echo $theme ?>" d="M267,117.1c0.1-0.2,0.2-0.3,0.5-0.2l2.7,0.9c0.9,0.3,1.4,0.6,1.7,0.9c0.7,0.7,1,1.8,0.6,3
        c-0.5,1.3-1.6,2.1-2.8,2.1l0,0c0,0,0.1,0.2,0.1,0.5l0.7,4.2c0,0.3-0.1,0.4-0.4,0.3l-0.4-0.1c-0.2-0.1-0.3-0.2-0.3-0.4l-0.7-4.7
        l-2.5-0.9l-1.3,3.8c-0.1,0.2-0.2,0.3-0.5,0.2l-0.3-0.1c-0.2-0.1-0.3-0.2-0.2-0.5L267,117.1z M268.7,122.7c1.2,0.4,2.2-0.1,2.7-1.4
        c0.3-0.8,0.1-1.6-0.4-2.1c-0.2-0.2-0.5-0.4-1.2-0.6l-2-0.7l-1.4,4L268.7,122.7z"/>
      <path fill="<?php echo $theme ?>" d="M275.5,120.1c0.1-0.2,0.2-0.3,0.5-0.2l0.3,0.1c0.2,0.1,0.3,0.2,0.2,0.5l-1.4,3.9l1.7,0.6l3.9-3.2
        c0.2-0.1,0.3-0.2,0.5-0.1l0.4,0.1c0.3,0.1,0.3,0.3,0.1,0.5l-4.2,3.3l0,0l1.2,5.8c0.1,0.3-0.1,0.4-0.4,0.3l-0.4-0.1
        c-0.2-0.1-0.3-0.2-0.3-0.4l-1.1-5.4l-1.7-0.6l-1.5,4.4c-0.1,0.2-0.2,0.3-0.5,0.2l-0.3-0.1c-0.2-0.1-0.3-0.2-0.2-0.5L275.5,120.1z"
        />
      <path fill="<?php echo $theme ?>" d="M283.7,122.9c0.1-0.2,0.2-0.3,0.5-0.2l4.9,1.7c0.2,0.1,0.3,0.2,0.2,0.5l-0.1,0.2c-0.1,0.2-0.2,0.3-0.5,0.2
        l-4.2-1.5l-1.3,3.6l3.4,1.2c0.2,0.1,0.3,0.2,0.2,0.5l-0.1,0.2c-0.1,0.2-0.2,0.3-0.5,0.2l-3.4-1.2l-1.3,3.7l4.5,1.6
        c0.2,0.1,0.3,0.3,0.2,0.5l-0.1,0.2c-0.1,0.2-0.2,0.3-0.5,0.2l-5.1-1.8c-0.2-0.1-0.3-0.2-0.2-0.5L283.7,122.9z"/>
      <path fill="<?php echo $theme ?>" d="M293.5,127l-3.2-1.1c-0.2-0.1-0.3-0.2-0.2-0.5l0.1-0.2c0.1-0.2,0.2-0.3,0.5-0.2l7.3,2.6
        c0.2,0.1,0.3,0.3,0.2,0.5l-0.1,0.2c-0.1,0.2-0.3,0.3-0.5,0.2l-3.2-1.1l-3,8.6c-0.1,0.2-0.2,0.3-0.5,0.2l-0.3-0.1
        c-0.2-0.1-0.3-0.3-0.2-0.5L293.5,127z"/>
      <path fill="<?php echo $theme ?>" d="M302,129.4c0-0.3,0.2-0.4,0.4-0.3l0.3,0.1c0.2,0.1,0.3,0.2,0.3,0.4l0.1,8.1c0,0.6-0.1,1.4-0.1,1.4l0,0
        c0,0,0.5-0.7,0.8-1.1l5.2-6.3c0.1-0.2,0.3-0.2,0.5-0.1l0.3,0.1c0.3,0.1,0.3,0.3,0.1,0.5l-6.6,8c-0.1,0.2-0.3,0.2-0.5,0.1l-0.5-0.2
        c-0.2-0.1-0.3-0.2-0.3-0.4V129.4L302,129.4z"/>
      <path fill="<?php echo $theme ?>" d="M313.6,133.3c0.1-0.2,0.3-0.2,0.5-0.1l0.5,0.2c0.2,0.1,0.3,0.2,0.3,0.4l0.2,10.4c0,0.3-0.2,0.4-0.4,0.3
        l-0.3-0.1c-0.2-0.1-0.3-0.2-0.3-0.4v-3.2l-4-1.4l-2,2.5c-0.1,0.2-0.3,0.2-0.5,0.1l-0.3-0.1c-0.3-0.1-0.3-0.3-0.2-0.5L313.6,133.3z
         M313.9,139.8v-4c0-0.5,0.1-1.4,0.1-1.4l0,0c0,0-0.5,0.7-0.8,1.2l-2.6,3.1L313.9,139.8z"/>
      <path fill="<?php echo $theme ?>" d="M319.8,135.6c0.1-0.2,0.2-0.3,0.5-0.2l0.3,0.1c0.2,0.1,0.3,0.2,0.2,0.5l-3,8.6l4.2,1.5
        c0.2,0.1,0.3,0.2,0.2,0.5l-0.1,0.2c-0.1,0.2-0.3,0.3-0.5,0.2l-4.9-1.7c-0.2-0.1-0.3-0.2-0.2-0.5L319.8,135.6z"/>
      <path fill="<?php echo $theme ?>" d="M326.3,137.9c0.1-0.2,0.2-0.3,0.5-0.2l0.3,0.1c0.2,0.1,0.3,0.3,0.2,0.5l-2.1,6.1c-0.6,1.7,0.1,3.1,1.8,3.7
        s3.2,0,3.8-1.8l2.1-6c0.1-0.2,0.3-0.3,0.5-0.2l0.3,0.1c0.2,0.1,0.3,0.2,0.2,0.5l-2.1,6.1c-0.8,2.2-2.8,3.1-5,2.3
        c-2.2-0.8-3.3-2.7-2.5-4.9L326.3,137.9z"/>
      <path fill="<?php echo $theme ?>" d="M336.5,141.5c0.1-0.2,0.2-0.3,0.5-0.2l4.9,1.7c0.2,0.1,0.3,0.2,0.2,0.5l-0.1,0.2c-0.1,0.2-0.2,0.3-0.5,0.2
        l-4.2-1.5L336,146l3.4,1.2c0.2,0.1,0.3,0.2,0.2,0.5l-0.1,0.2c-0.1,0.2-0.3,0.3-0.5,0.2l-3.4-1.2l-1.3,3.7l4.5,1.6
        c0.2,0.1,0.3,0.2,0.2,0.5l-0.1,0.2c-0.1,0.2-0.3,0.3-0.5,0.2l-5.1-1.8c-0.2-0.1-0.3-0.2-0.2-0.5L336.5,141.5z"/>
    </g>
  </g>
  </svg>


                                      </div><br>
                                      
                                      <table width="100%" border="0" cellspacing="0" cellpadding="8">
                                        
                                        <tbody>
                                          <tr>
                                            <td width="50%">
                                              <h4 style="font-size:18px; font-family:museosansrounded-900-7g; color:<?php echo $theme ?>;">1. On Market Longer</h4>
                                              <p style="font-size:16px; font-family:museosansrounded-300-7h; color: #76777b;">Properties that are over priced tend to stay on the market
                                              significantly longer than those that are priced to sell.</p>
                                            </td>
                                            <td width="50%">
                                                <h4 style="font-size:18px; font-family:museosansrounded-900-7g; color:<?php echo $theme ?>;">3. Lost Time</h4>
                                              <p style="font-size:16px; font-family:museosansrounded-300-7h; color: #76777b;">Time lost in waiting for an offer can be time spent accepting
                                                offers, conducting inspections & opening escrow.</p>
                                            </td>
                                            
                                          </tr>

                                          <tr>
                                            <td width="50%">
                                               <h4 style="font-size:18px; font-family:museosansrounded-900-7g; color:<?php echo $theme ?>;">2. Price Reduction</h4>
                                              <p style="font-size:16px; font-family:museosansrounded-300-7h; color: #76777b;">Overpriced properties will most certainly need to do atleast
                                                1 price reduction to regenerate interest in your property. </p>
                                            </td>
                                            <td width="50%">
                                                <h4 style="font-size:18px; font-family:museosansrounded-900-7g; color:<?php echo $theme ?>;">4. Stigma Developed</h4>
                                              <p style="font-size:16px; font-family:museosansrounded-300-7h; color: #76777b;">As buyers see the property advertised over and over again,
  they will start wondering if there’s something wrong with it.</p>
                                            </td>
                                            
                                          </tr>
                                        </tbody>
                                      </table>
                                      
                                    </div>
                                    <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
                                    </div>
                                    <!-- page 12 end -->
</article>
<article>
                                    <!-- page 12 -->
                                    <div class="page-13">
									<div class="pg-13-header">
                                      <h1>AVERAGE DAYS ON MARKET</h1>
                                      <h2>How long will it take to sell your home.</h2>
									  </div><!-- .pg-13-header -->
                                      <div class="pg-13-content cf">
                                        <table width="100%" cellspacing="0" class="days" cellpadding="8" border="0" style="margin-top:-20px; margin-botton:-20px;">
                                          
                                          <tbody>
                                            <tr>
                                              <td width="40%" align="center" valign="top" >
                                                
                                                <table width="100%" cellspacing="0" cellpadding="0" border="0" valign="top" >
                                                  <tr>
                                                    <td align="center" valign="top" height="250px"><img src="<?php echo base_url(); ?>pdf/images/bg-round.png" style="margin-bottom:-200px;">
                                                      <span style=" color:#fff;font-size: 120px; height: 250px;line-height: 2;" >35</span></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="center" valign="top">
                                                        <br>
                                                        <h4 style="font-size:18px; font-family:museosansrounded-900-7g; color:<?php echo $theme ?>;"><b>Avg. Days On Market</b></h4>
                                                      </td></tr>
                                                    </table>
                                                    
                                                    
                                                    
                                                    
                                                  </td>
                                                  <td width="60%">
                                                    <p style="font-size:16px; font-family:museosansrounded-300-7h; color: #76777b; padding-top:15px;">Days on market has a direct correlation with a buyers interest level
                                                        in your property. Depending on the geographic area of your home
                                                        the number of days that your home is on the market can vary.
                                                        Currently the market is in an upswing and the shortage of
                                                        inventory is leading to homes flying off the market
                                                      <br>         <br> 
                                                      There are a few factors that come into play when attempting to
                                                      determine how long it will take these factors are    <br>      <br> 
                                                    </p><table width="100%" cellspacing="0" cellpadding="0" border="0">
                                                    <thead style="">
                                                      <tr bgcolor="#e7e7e8">
                                                        <th  style="">Market</th> <th>Season</th> <th  style="">Economy</th>
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                      <tr>
                                                       <td style="font-size:15px; font-family:museosansrounded-300-7h; color: #76777b; text-align:center;">Can be a geographic location or type of housing. So if a certain eclectic neighborhood is deemed desirable that create demand which will lead to homes being sold quickly.
                                                        </td>
                                                        <td style="font-size:15px; font-family:museosansrounded-300-7h; color: #76777b; text-align:center;">When someone is looking to pack up and move they typically would do so in good weather. So if your home is listed during the winter or the rainy season this may add to days on market.
                                                        </td>
                                                        <td style="font-size:15px; font-family:museosansrounded-300-7h; color: #76777b; text-align:center;">
                                                          When interest rates are low the typical median home price tends to rise. During this time motivated buyers take less time to commit to a home which leads to less time on market and quicker sales.
                                                        </td>
                                                      </tr>
                                                    </tbody>
                                                  </table>
                                                  <p></p>
                                                </td>
                                                
                                              </tr>
                                            </tbody>
                                          </table>
                                          <div class="clearfix"></div>
                                          <div class="full-img" style=" position:relative; width:650px; height:300px; z-index:300;display:block;  margin-top:-40px; "><!-- <img src="<?php echo base_url(); ?>pdf/images/day-market_<?php echo $areaSalesAnalysis['chart']['color']; ?>.png" alt="" style="width:%; margin-top:-47px;" /> -->


  <svg version="1.1" x="0px" y="0px" width="612px" height="367.8px" viewBox="0 0 612 367.8" enable-background="new 0 0 612 367.8"
     xml:space="preserve">
  <polygon fill="<?php echo $theme ?>" points="0,-0.3 167,8.6 308.1,83.5 433.9,165.9 479.9,261.7 608.7,327.6 612.1,367.8 0.4,367.8 "/>
  <polygon fill="#A7A9AC" stroke="#A7A9AC" stroke-width="0.5" stroke-miterlimit="10" points="0.3,6.7 144.5,68.5 251.8,182.4 
    307.1,257.2 399.4,329.7 610.7,359.1 614.1,367.8 0.4,367.8 "/>
  <line fill="none" stroke="#A7A9AC" stroke-width="0.5" stroke-miterlimit="10" x1="545.7" y1="296.1" x2="5.5" y2="296.1"/>
  <line fill="none" stroke="#A7A9AC" stroke-width="0.5" stroke-miterlimit="10" x1="463.2" y1="229.2" x2="2.8" y2="229.2"/>
  <line fill="none" stroke="#A7A9AC" stroke-width="0.5" stroke-miterlimit="10" x1="435.3" y1="168.9" x2="3.9" y2="168.9"/>
  <line fill="none" stroke="#A7A9AC" stroke-width="0.5" stroke-miterlimit="10" x1="335.2" y1="102" x2="1" y2="102"/>
  <line fill="none" stroke="#A7A9AC" stroke-width="0.5" stroke-miterlimit="10" x1="218.8" y1="38.6" x2="5.5" y2="38.6"/>
  <rect x="451.2" y="38.6" fill="<?php echo $theme ?>" width="24.6" height="24"/>
  <rect x="451.2" y="72.3" fill="#A7A9AC" stroke="#A7A9AC" stroke-width="0.5" stroke-miterlimit="10" width="23.6" height="23"/>
  <text transform="matrix(1.0242 0 0 1 489.0605 53.3486)" font-family="'museosansrounded-300-7h'" font-size="14">DAYS ON MARKET</text>
  <text transform="matrix(1.0242 0 0 1 489.0605 86.3486)" font-family="'museosansrounded-300-7h'" font-size="14">BUYER INTEREST</text>
  <path fill="#2A4D83" d="M349.8,183.8"/>
  </svg>

                                          

                                          </div>
  <div class="down-img" style="position:relative; margin-left:10px; margin-top:-36px; display:block; z-index:350;">
    

  <img src="<?php echo base_url(); ?>pdf/images/down-data.png" alt=""  /> 
  </div>
                                          <br>
                                          
                                          
                                          
                                        </div>
                                        <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
                                        </div>
                                        <!-- page 12 end -->
</article>                  
<article>
	<div class="page-9a">
		<div class="pg-9a-header">
        	<h1>PICS & ONLINE EXPOSURE</h1>
            <h2>Marketing Your Property</h2>
        </div><!-- .pg-9-header -->
   	  	<div class="pg-9a-content cf">
			<div class="pg9a-blk cf">
            	<div class="pg9a-detail-area"><div class="pg9a-title" style="color:#28b1e3;">Imagery</div>
                    <div>
                        Did you know that listings with professional photos sell for more money? Not only that, but they sell quicker. Since 92% of buyers are home shopping online the importance of good photos has never been more apparent. We will incorporate the photos that will be enhanced to show your home in the best light possible. This should lead to more inquiries in a shorter amount of time. 
                    </div>
                </div><!-- .pg9-detail-area -->
            	<div class="pg9a-detail-area"><div class="pg9a-title" style="color:#6dccd5;">MLS & More</div>
                    <div>
                        The MLS which is an acronym for the multiple listing service which is the preferred network utilized by realtors to make real estate listings available online. This is the very first place where we will list your home because realtors who are currently working with pre-approved buyers will be notified first. All the enhanced photos, property details, and sales price will be placed within the listing.
                    </div>
                </div><!-- .pg9-detail-area -->
            	<div class="pg9a-detail-area"><div class="pg9a-title" style="color:#105481;">Syndication</div>
                    <div>
                        Since the MLS now provides its real estate listings to the thousands of individual websites including 4 of the largest real estate website which are: Trulia, Redfin, Zillow & Realtor.com. Between these sites they capture about 120 million visitors every month. This surely help us get your property the necessary exposure to get it sold quickly.
                    </div>
                </div><!-- .pg9-detail-area -->

            </div><!-- .pg9-blk -->
			<div class="pg9a-blk cf">
               
                <div class="grph-prx"><img src="assets/images/synd4.jpg" alt="" width="325"/></div>
            </div><!-- .pg9-blk -->
  	  	</div><!-- .pg-9-content -->
            <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
    </div><!-- .page-7 -->
</article>
									   
<article>
	<div class="page-9a">
		<div class="pg-9a-header">
        	<h1>PRINTED COLLATERAL</h1>
            <h2>Marketing Your Property</h2>
        </div><!-- .pg-9-header -->
   	  	<div class="pg-9a-content cf">
			<div class="pg9a-blk cf">
            	<div class="pg9a-detail-area"><div class="pg9a-title" style="color:#28b1e3;">Just Listed Postcards</div>
                    <div>
                       We will prepare just listed postcards which we will use to let the surround homes that your home has officially gone on the market. This is great resource to generate buyers leads since many people usually have friends or family that might want to move in the neighborhood. The designed postcard, flyers,a door hangers will all contain pictures, property details, pricing information. We will answer all inquiries from interested parties. 
                    </div>
                </div><!-- .pg9-detail-area -->
            	<div class="pg9a-detail-area"><div class="pg9a-title" style="color:#6dccd5;">Just Listed Flyers</div>
                    <div>
                        We will prepare just listed flyers in addition to the postcards which we will post on the boards of surrounding businesses, real estate offices, escrow offices, & other parties within the real estate industry. This initiative will help us get some additional property exposure and prospective buyer inquiries. 
                    </div>
                </div><!-- .pg9-detail-area -->
            	<div class="pg9a-detail-area"><div class="pg9a-title" style="color:#105481;">Door Hangers</div>
                    <div>
                      Will have door hangers ready on for use on days which we will be showcasing the property. This is a great way to let the nearby neighbors know that they can see the property for themselves.
                    </div>
                </div><!-- .pg9-detail-area -->
            	<div class="pg9a-detail-area"><div class="pg9a-title" style="color:#231f20;">C-T-A Sign</div>
                    <div>
                        CTA signs which is an acronym for Call-To-Action will be placed on the real estate sign in front of your property. This sign will contain a code that people can text to instantly receive sale information regarding your property. <br><br>We will follow up diligently with all leads that are gathered from these initiatives.
                    </div>
                </div><!-- .pg9-detail-area -->

            </div><!-- .pg9-blk -->
			<div class="pg9a-blk cf">
               
                <div class="grph-prx"><img src="assets/images/newsample.png" style="background-color:<?php echo $theme ?>;" alt="" width="325"/></div>
            </div><!-- .pg9-blk -->
  	  	</div><!-- .pg-9-content -->
            <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
    </div><!-- .page-7 -->
</article>

<article>
	<div class="page-9a">
		<div class="pg-9a-header">
        	<h1>SOCIAL MEDIA & NETWORKING</h1>
            <h2>Marketing Your Property</h2>
        </div><!-- .pg-9-header -->
   	  	<div class="pg-9a-content cf">
			<div class="pg9a-blk cf">
            	<div class="pg9a-detail-area"><div class="pg9a-title" style="color:#28b1e3;">Email Marketing</div>
                    <div>
                        We have vast network of emails consisting of past clients, prospective buyers, other real estate agents, and brokers which we will leverage to get your property maximum exposure. We will begin with a just listed campaign and proceed with subsequent campaigns showcasing your property to prospective buyers.
                    </div>
                </div><!-- .pg9-detail-area -->
            	<div class="pg9a-detail-area"><div class="pg9a-title" style="color:#6dccd5;">Social Media Marketing</div>
                    <div>
                       We will leverage Facebook, Instagram, LinkedIn & Twitter to increase awareness about your property. These social media sites have a combined user base of over 1.3 billion spread-out across the world. On a local level the numbers are much more scaled down but just as massive relative to size of the neighborhood. We want to maximize property exposure by placing the enhanced pictures along with videos to help prospective buyers get a closer look of your property. 
                    </div>
                </div><!-- .pg9-detail-area -->
            	<div class="pg9a-detail-area"><div class="pg9a-title" style="color:#105481;">Open Houses & Showings</div>
                    <div>
                       Depending on your availability and willingness we will schedule both open houses and private viewings of your property. Open house events are a great way to showcase your property as well as generate prospective buyer leads. 
                    </div>
                </div><!-- .pg9-detail-area -->
            	<div class="pg9a-detail-area"><div class="pg9a-title" style="color:#231f20;">Broker 2 Broker Networking</div>
                    <div>Brokers are consistently networking with other brokers find the homes that matches their clients criteria. We will network with all surrounding brokers and realtors to see if your properties a match for one of their prospective buyers. </div>
                </div><!-- .pg9-detail-area -->

            </div><!-- .pg9-blk -->
			<div class="pg9a-blk cf">
               
                <div class="grph-prx"><img src="assets/images/social4.png" style="background-color:<?php echo $theme ?>;" alt="" width="325"/></div>
            </div><!-- .pg9-blk -->
  	  	</div><!-- .pg-9-content -->
            <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
    </div><!-- .page-7 -->
</article>

<article>                                        
										<!-- page 14 -->
                                        <div class="page-15">
										<div class="pg-15-header">
                                          <h1>ANALYZE & OPTIMIZE </h1>
                                          <h2>Review selling price</h2>
										  </div><!-- .pg-15-header -->
                                          <div class="pg-15-content cf" style="margin-top:-20px;">
                                            <p>When your property first hits the market the entire audience which consists of realtors, prospective buyers, and  sellers all place eyes on your listing. They all make rapid judgements as to it’s price, current condition, and location. How they first perceive it will determine the viewing activity over the next few weeks. If we receive no viewings initially, we are facing the possibility that that market as a whole is rejecting the value proposition of your listing. Our
                                            solution? Reduce the price.</p>
                                            <p>Reducing the price of your home is never an easy call but often time is a necessary one that might need to be made in order to get your home sold. Many homeowners feel that they are giving up hard won equity which they have built up. In reality a slight reduction can help avoid problems down the line. The question is, When is the best time? From the time the property is first placed on the market the rule of thumb is 30-45 days.</p>
                                            
                                             <h3>At Listing Time</h3>
                                            <table class="tg">
												  <tr>
													<th class="tg-yw4l">Home A</th>
													<th class="tg-yw4l">Home B</th>
													<th class="tg-yw4l">Jane & Joe</th>
													<th class="tg-yw4l">Home D</th>
													<th class="tg-yw4l">Home E</th>
													
												  </tr>
												  <tr>
													<td class="tg-yw4l">$368,000</td>
													<td class="tg-yw4l">$349,000</td>
													<td class="tg-yw4l">$345,000</td>
													<td class="tg-yw4l">$341,000</td>
													<td class="tg-yw4l">$333,000</td>
													
												  </tr>
												</table>
                                            <br><br>
											<h3>After Price Reduction</h3>
											 <table class="tg">
												  <tr>
													<th class="tg-yw42">Home A</th>
													<th class="tg-yw42">Home B</th>
													<th class="tg-yw42">Jane & Joe</th>
													<th class="tg-yw42">Home D</th>
													<th class="tg-yw42">Home E</th>
													<th class="tg-yw42">Home F</th>
													
												  </tr>
												  <tr>
													<td class="tg-yw4l">Expired</td>
													<td class="tg-yw4l">$339,000</td>
													<td class="tg-yw4l">$345,000</td>
													<td class="tg-yw4l">$341,000</td>
													<td class="tg-yw4l">$333,000</td>
													<td class="tg-yw4l">$332,500</td>
													
												  </tr>
												  <tr>
													<td class="tg-yw4l"></td>
													<td class="tg-yw4l">Reduced & Sold</td>
													<td class="tg-yw4l"></td>
													<td class="tg-yw4l">Sold</td>
													<td class="tg-yw4l">Sold</td>
													<td class="tg-yw4l">Just Added</td>
													
												  </tr>
												</table>
												
                                            
                                            
                                            <p>Joe and Jane went from being very competitively priced to being the highest property in their price range. From a buyer’s perspective, their home now offers the worst value proposition in the marketplace.
                                            </p>
											<div class="full-img"><img src="<?php echo base_url(); ?>pdf/images/3hse.png" alt="" style="width:100%; background-color:<?php echo $theme ?>;  " /></div>
                                          </div>
                                          <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
                                          </div>
                                          <!-- page 14 end -->
                                          <!-- page 15 -->
                                          <div class="page-16">
										  <div class="pg-16-header">
                                            <h1>NEGOTIATING OFFERS</h1>
                                            <h2>Keeping things on your terms.</h2>
											</div><!-- .pg-16-header -->
                                            <div class="pg-16-content cf">
                                              <table width="100%" cellspacing="0" cellpadding="8" border="0" >
                                                
                                                <tbody>
                                                  <tr>
                                                  <td width="60%" valign="top">
                                                      
                                                      <p style="font-size:19px; font-family:museosansrounded-300-7h; color: #76777b;">In a perfect world, every homebuyer and every home seller would get exactly the deal they want for their real estate transaction. In reality, the best deals are the ones in which each side feels they got most of what they wanted and didn’t have to up too much
                                                      </p><br>
                                                      
                                                      <p style="font-size:19px; font-family:museosansrounded-300-7h; color: #76777b;">The negotiating portion of a real estate transaction can be exciting, frustrating, and tedious. As a seller you want to get you feel your home is worth and I want to help make that happen. My qualifications will help keep the negotiating terms in your favor.
                                                      </p><br>
                                                       <p style="font-size:20px; font-family:museosansrounded-300-7h; color: #76777b;">The goal is to make sure you avoid pitfalls that many sellers are faced when selling their home. The most common are:</p>
                                                      <br><br>
                                                      <p>
                                                      <ul style="">
                                                        <li style="font-size:20px; font-family:museosansrounded-900-7g; color: <?php echo $theme ?>;">Not making sure buyers are qualified</li> <br>
                                                        <li style="font-size:20px; font-family:museosansrounded-900-7g; color: <?php echo $theme ?>;">Not understanding contract and forms</li> <br>
                                                        <li style="font-size:20px; font-family:museosansrounded-900-7g; color: <?php echo $theme ?>;">Failing to disclose all property facts </li><br> 
                                                        <li style="font-size:20px; font-family:museosansrounded-900-7g; color: <?php echo $theme ?>;">Setting up contingencies</li> <br>
                                                        <li style="font-size:20px; font-family:museosansrounded-900-7g; color: <?php echo $theme ?>;">Handling the buyers deposit</li> 
                                                      </ul>
                                                      </p>
                                                      <br><br>
                                                      <h3 style="font-size:19px; font-family:museosansrounded-300-7h; color: #76777b;">The thing to remember about negotiating is that its not where you start but rather where you finish. My goal is to make sure that you finish first every time.</h3>
                                                    </td>
                                                    <td width="40%" align="right"> <div class="full-img">

                                                  <!--   <img src="<?php echo base_url(); ?>pdf/images/agent-offer.png" alt="" style="width:100%;  " /> -->
  <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
     width="424.5px" height="839.5px" viewBox="0 0 424.5 839.5" enable-background="new 0 0 424.5 839.5" xml:space="preserve">
  <path opacity="0.3" fill="<?php echo $theme ?>" enable-background="new    " d="M389.8,751.3c0,6.6-5.6,12-12.5,12H107.2
    c-6.9,0-12.5-5.4-12.5-12v-733c0-6.6,5.6-12,12.5-12h270.1c6.9,0,12.5,5.4,12.5,12V751.3z"/>
  <circle fill="none" stroke="<?php echo $theme ?>" stroke-width="6" stroke-miterlimit="10" cx="35.9" cy="156.9" r="30.1"/>
  <text transform="matrix(1 0 0 1 -7893.5 -7806.5)" font-family="'Bariol-Thin'" font-size="22">f</text>
  <circle fill="none" stroke="<?php echo $theme ?>" stroke-width="6" stroke-miterlimit="10" cx="35.9" cy="242.4" r="30.1"/>
  <text transform="matrix(1 0 0 1 -7894.5 -7711.2207)" font-family="'Bariol-Thin'" font-size="22">f</text>
  <circle fill="none" stroke="<?php echo $theme ?>" stroke-width="6" stroke-miterlimit="10" cx="35.9" cy="326.4" r="30.1"/>
  <circle fill="none" stroke="<?php echo $theme ?>" stroke-width="6" stroke-miterlimit="10" cx="35.9" cy="417.8" r="30.1"/>
  <text transform="matrix(1 0 0 1 -7885.5 -7787.5)" fill="<?php echo $theme ?>" font-family="'museosansrounded-300-7h'" font-size="33">.</text>
  <text transform="matrix(1 0 0 1 118.3066 50.25)" fill="<?php echo $theme ?>" font-family="'museosansrounded-300-7h'" font-size="36"><b>As your agent </b></text>
  <text transform="matrix(1 0 0 1 191.7065 93.4502)" fill="<?php echo $theme ?>" font-family="'museosansrounded-300-7h'"   font-size="36"><b>I will...</b></text>
  <g>
    
      <rect x="17.4" y="154" transform="matrix(-0.7071 -0.7071 0.7071 -0.7071 -57.0537 296.4814)" fill="#A3A3A3" width="30.9" height="12.2"/>
    
      <rect x="27.7" y="146.9" transform="matrix(-0.7071 0.7071 -0.7071 -0.7071 199.0102 223.6034)" fill="#A3A3A3" width="51" height="12.2"/>
  </g>
  <g>
    
      <rect x="17.5" y="236.5" transform="matrix(-0.7071 -0.7071 0.7071 -0.7071 -115.3544 437.352)" fill="#A3A3A3" width="30.9" height="12.2"/>
    
      <rect x="27.7" y="229.4" transform="matrix(-0.7071 0.7071 -0.7071 -0.7071 257.312 364.4696)" fill="#A3A3A3" width="51" height="12.2"/>
  </g>
  <g>
    
      <rect x="17.4" y="322" transform="matrix(-0.7071 -0.7071 0.7071 -0.7071 -175.9566 583.404)" fill="#A3A3A3" width="30.9" height="12.2"/>
    
      <rect x="27.7" y="315" transform="matrix(-0.7071 0.7071 -0.7071 -0.7071 317.9131 510.5261)" fill="#A3A3A3" width="51" height="12.2"/>
  </g>
  <g>
    
      <rect x="17.4" y="410.6" transform="matrix(-0.7071 -0.7071 0.7071 -0.7071 -238.5105 734.5133)" fill="#A3A3A3" width="30.9" height="12.2"/>
    
      <rect x="27.7" y="403.5" transform="matrix(-0.7071 0.7071 -0.7071 -0.7071 380.4775 661.61)" fill="#A3A3A3" width="51" height="12.2"/>
  </g>
  <circle fill="none" stroke="<?php echo $theme ?>" stroke-width="6" stroke-miterlimit="10" cx="35.9" cy="504.8" r="30.1"/>
  <g>
    
      <rect x="17.4" y="497.6" transform="matrix(-0.7071 -0.7071 0.7071 -0.7071 -300.03 883.0311)" fill="#A3A3A3" width="30.9" height="12.2"/>
    
      <rect x="27.7" y="490.5" transform="matrix(-0.7071 0.7071 -0.7071 -0.7071 441.9915 810.1338)" fill="#A3A3A3" width="51" height="12.2"/>
  </g>
  <rect x="103.8" y="134.3" fill="none" width="279" height="71"/>
  <text transform="matrix(1 0 0 1 103.75 149.9141)" font-family="'museosansrounded-300-7h'" font-size="18">Present offers immediatly and</text>
  <text transform="matrix(1 0 0 1 103.75 176.3135)" font-family="'museosansrounded-300-7h'" font-size="18">help discard unfavorable ones.</text>
  <rect x="103.8" y="216.3" fill="none" width="278" height="71"/>
  <text transform="matrix(1 0 0 1 103.75 231.9141)" font-family="'museosansrounded-300-7h'" font-size="18">Help you review and understand </text>
  <text transform="matrix(1 0 0 1 103.75 258.3135)" font-family="'museosansrounded-300-7h'" font-size="18">the offer that you like most</text>
  <rect x="103.8" y="300.3" fill="none" width="279" height="71"/>
  <text transform="matrix(1 0 0 1 103.75 315.9141)" font-family="'museosansrounded-300-7h'" font-size="18">Create contgencies to help</text>
  <text transform="matrix(1 0 0 1 103.75 342.3135)" font-family="'museosansrounded-300-7h'" font-size="18">protect your selling interests</text>
  <rect x="103.8" y="382.3" fill="none" width="278" height="71"/>
  <text transform="matrix(1 0 0 1 103.75 397.9141)" font-family="'museosansrounded-300-7h'" font-size="18">Disclose all details of your prop</text>
  <text transform="matrix(1 0 0 1 367.75 397.9141)" font-family="'museosansrounded-300-7h'" font-size="18">-</text>
  <text transform="matrix(1 0 0 1 103.75 424.3135)" font-family="'museosansrounded-300-7h'" font-size="18">erty to help protect you</text>
  <rect x="103.8" y="475.3" fill="none" width="278" height="71"/>
  <text transform="matrix(1 0 0 1 103.75 490.9141)" font-family="'museosansrounded-300-7h'" font-size="18">Get you the most money in the </text>
  <text transform="matrix(1 0 0 1 103.75 517.3145)" font-family="'museosansrounded-300-7h'" font-size="18">quickest time possible</text>
  <rect x="175.2" y="569.5" transform="matrix(-0.9776 0.2105 -0.2105 -0.9776 622.1417 1263.2134)" fill="#939598" width="137.4" height="190.4"/>
  <g>
    
      <rect x="175.7" y="567.2" transform="matrix(-0.9776 0.2105 -0.2105 -0.9776 622.6498 1258.5688)" fill="#FFFFFF" stroke="#D1D3D4" stroke-miterlimit="10" width="137.4" height="190.4"/>
    <path fill="#B7B7B8" d="M327.9,723.9c-0.4,0.3-0.8,0.6-1.2,0.9c-2.8-2.8-5.4-4.7-6.3-5.3c-4.1,0.3-6.7,5.7-5.4,9.3l-0.1,0.1
      l-0.7-1.3c0,0,3-3.9-7.3-7c-0.3,11.1,5.3,8.3,5.3,8.3l1,1.1l-19.8,14.3l0.9,4.8l24.7-5.3c0.4-0.8,0.7-1.7,0.8-2.5l1.4,2.1l10.6-2.3
      L327.9,723.9z M311.9,726.7c-0.3,0.2-0.7,0.2-1,0c-0.1-0.2-0.2-0.4-0.1-0.7c-0.2-0.2-0.4-0.4-0.6-0.6c-0.6-0.7-1-1.4-0.7-1.6
      c0.2-0.1,0.8,0.3,1.4,1c0.2,0.2,0.4,0.5,0.5,0.7c0.2-0.1,0.5,0,0.7,0.2C312.3,726,312.2,726.4,311.9,726.7z"/>
    <g>
      <path fill="#02323D" d="M196.2,607.8c0.1,0.7,0.4,1.3,0.6,1.8c0.2,0.5,0.5,0.8,0.8,1c0.4,0.2,0.7,0.4,1.2,0.4c0.5,0,1,0,1.6-0.1
        c0.1,0,0.3-0.1,0.5-0.1c0.2-0.1,0.5-0.1,0.7-0.2c0.2-0.1,0.5-0.2,0.8-0.3c0.2-0.1,0.5-0.2,0.7-0.3l1,2.2c-0.2,0.2-0.6,0.3-0.9,0.5
        c-0.3,0.2-0.7,0.3-1,0.5c-0.4,0.1-0.7,0.2-1.1,0.4c-0.4,0.1-0.7,0.2-1,0.3c-1.2,0.3-2.3,0.3-3.1,0.1c-0.9-0.2-1.6-0.5-2.2-1
        c-0.6-0.5-1.1-1.1-1.4-1.8c-0.4-0.7-0.6-1.5-0.8-2.3c-0.2-0.8-0.2-1.6-0.2-2.3c0-0.8,0.2-1.6,0.5-2.3c0.4-0.7,0.9-1.3,1.6-1.9
        c0.7-0.6,1.8-1,3.1-1.2c0.6-0.1,1.2-0.2,1.8-0.2c0.6,0,1.1,0,1.7,0l0.8,3.9l-2.3,0.5l-0.4-1.8c-0.2,0-0.4,0-0.5,0
        c-0.2,0-0.3,0-0.5,0.1c-0.5,0.1-1,0.3-1.3,0.6c-0.3,0.2-0.6,0.6-0.7,1c-0.1,0.4-0.2,0.8-0.2,1.3C196,606.7,196,607.3,196.2,607.8z
        "/>
      <path fill="#02323D" d="M213.5,606c0.1,0.6,0.2,1.2,0.1,1.8s-0.3,1.1-0.6,1.6c-0.3,0.5-0.7,0.9-1.3,1.3c-0.6,0.4-1.3,0.6-2.1,0.8
        c-0.8,0.2-1.6,0.2-2.2,0.1c-0.7-0.1-1.2-0.3-1.7-0.6c-0.5-0.3-0.9-0.7-1.2-1.2c-0.3-0.5-0.5-1.1-0.7-1.8c-0.1-0.6-0.2-1.2-0.1-1.8
        c0.1-0.6,0.3-1.1,0.6-1.6c0.3-0.5,0.7-0.9,1.3-1.3c0.6-0.4,1.3-0.6,2.1-0.8c0.8-0.2,1.6-0.2,2.2-0.1c0.7,0.1,1.2,0.3,1.7,0.6
        c0.5,0.3,0.9,0.7,1.2,1.2C213.2,604.8,213.4,605.4,213.5,606z M210.1,606.7c-0.1-0.3-0.1-0.6-0.2-0.8c-0.1-0.2-0.2-0.5-0.4-0.7
        s-0.3-0.3-0.5-0.4c-0.2-0.1-0.5-0.1-0.7,0c-0.3,0.1-0.5,0.2-0.7,0.4c-0.2,0.2-0.3,0.4-0.4,0.6c-0.1,0.2-0.1,0.5-0.1,0.8
        c0,0.3,0.1,0.6,0.1,0.8c0.1,0.3,0.1,0.6,0.2,0.9c0.1,0.3,0.2,0.5,0.4,0.7c0.1,0.2,0.3,0.3,0.5,0.4c0.2,0.1,0.5,0.1,0.7,0
        c0.3-0.1,0.5-0.2,0.7-0.4c0.2-0.2,0.3-0.4,0.3-0.6c0.1-0.2,0.1-0.5,0.1-0.8C210.2,607.3,210.2,607,210.1,606.7z"/>
      <path fill="#02323D" d="M220.3,599.8c0.6-0.1,1.1-0.1,1.5-0.1c0.4,0.1,0.8,0.2,1.1,0.5c0.3,0.2,0.5,0.5,0.7,0.9
        c0.2,0.4,0.3,0.7,0.4,1.2l0.8,3.6l1.1-0.2l0.4,1.9c-0.3,0.2-0.7,0.4-1.1,0.6c-0.4,0.2-0.8,0.3-1.1,0.4c-0.5,0.1-0.9,0.1-1.2,0
        c-0.3-0.1-0.6-0.2-0.8-0.4s-0.4-0.4-0.5-0.6c-0.1-0.2-0.2-0.5-0.2-0.7l-0.7-3.2c-0.1-0.5-0.2-0.8-0.5-0.9s-0.5-0.2-0.9-0.1
        c-0.2,0-0.4,0.1-0.7,0.3c-0.2,0.1-0.4,0.3-0.6,0.5l1.3,5.9l-3.4,0.7l-1.4-6.6l-1.1,0.2l-0.5-2l4.3-0.9l0.2,0.7c0,0,0,0,0.1,0
        s0,0,0.1,0c0.4-0.4,0.8-0.7,1.2-1C219.4,600.1,219.9,599.8,220.3,599.8z"/>
      <path fill="#02323D" d="M228.5,595.5l0.6,2.6l2.5-0.5l0.5,2.1l-2.4,0.5l0.6,3c0.1,0.5,0.3,0.9,0.5,1c0.2,0.1,0.5,0.2,1,0.1
        c0.1,0,0.3-0.1,0.6-0.2c0.2-0.1,0.5-0.2,0.8-0.3l0.8,2c-0.2,0.1-0.4,0.2-0.6,0.4s-0.5,0.2-0.7,0.3c-0.2,0.1-0.5,0.2-0.7,0.2
        c-0.2,0.1-0.4,0.1-0.6,0.2c-0.8,0.2-1.4,0.2-1.9,0.1c-0.5-0.1-0.9-0.2-1.2-0.5c-0.3-0.2-0.5-0.5-0.7-0.8c-0.1-0.3-0.2-0.7-0.4-1
        l-0.8-3.9l-1.2,0.2l-0.4-1.8l1.3-0.7l0.3-2.4L228.5,595.5z"/>
      <path fill="#02323D" d="M237.5,597.7c0.2-0.2,0.4-0.4,0.6-0.7c0.2-0.2,0.5-0.5,0.7-0.7c0.2-0.2,0.5-0.4,0.8-0.6
        c0.3-0.2,0.6-0.3,0.9-0.4c0.3-0.1,0.5,0,0.6,0.1c0.1,0.1,0.2,0.4,0.3,0.7c0,0.2,0.1,0.4,0.1,0.6c0,0.2,0,0.5,0,0.7
        c0,0.2-0.1,0.5-0.1,0.7c-0.1,0.2-0.2,0.5-0.3,0.7l-3.2,0.2l0.8,3.8l1.1-0.2l0.5,2.1l-5.4,1.2l-0.5-2.1l1-0.2l-0.9-4.6l-1,0.2
        l-0.5-2.1l4.2-0.9l0.3,1.3H237.5z"/>
      <path fill="#02323D" d="M251.2,600.2l1.2-0.2c0.1,0.3,0.2,0.6,0.2,0.9c0.1,0.3,0.2,0.6,0.2,0.9c-0.4,0.2-0.7,0.5-1.2,0.7
        c-0.5,0.2-0.9,0.4-1.4,0.4c-0.4,0.1-0.8,0.1-1.1,0c-0.4-0.1-0.6-0.4-0.7-0.8h0c-0.2,0.4-0.5,0.6-0.7,0.8c-0.2,0.2-0.5,0.4-0.7,0.5
        c-0.2,0.1-0.5,0.2-0.7,0.3c-0.2,0.1-0.4,0.1-0.5,0.1c-0.6,0.1-1.1,0.1-1.4,0c-0.4-0.1-0.7-0.2-1-0.5c-0.3-0.2-0.5-0.5-0.6-0.7
        c-0.1-0.3-0.2-0.6-0.3-0.8c-0.1-0.3-0.1-0.6,0-0.9c0-0.3,0.1-0.6,0.3-0.8c0.2-0.3,0.5-0.5,0.8-0.8c0.4-0.2,0.8-0.5,1.4-0.7
        l2.3-0.7l-0.1-0.3c-0.1-0.4-0.2-0.7-0.5-0.8c-0.2-0.2-0.6-0.2-1.2-0.1c-0.4,0.1-0.8,0.2-1.3,0.4c-0.5,0.2-0.9,0.4-1.2,0.6
        l-0.9-1.9c0.2-0.2,0.5-0.3,0.8-0.5c0.3-0.1,0.6-0.3,1-0.5c0.3-0.1,0.7-0.2,1-0.4c0.4-0.1,0.7-0.2,1-0.3c0.6-0.1,1.1-0.2,1.6-0.2
        c0.5,0,0.9,0.1,1.3,0.3c0.4,0.2,0.7,0.4,1,0.8c0.2,0.4,0.5,0.8,0.6,1.4L251.2,600.2z M246.6,599.7c-0.3,0.1-0.5,0.3-0.6,0.5
        c-0.1,0.2-0.1,0.4-0.1,0.6c0.1,0.3,0.2,0.5,0.4,0.7c0.2,0.1,0.4,0.2,0.7,0.1c0.2,0,0.4-0.1,0.6-0.2c0.2-0.1,0.4-0.3,0.5-0.5
        l-0.3-1.5L246.6,599.7z"/>
      <path fill="#02323D" d="M256.3,592c0.5-0.1,1-0.2,1.6-0.2c0.5,0,1.1,0,1.5,0l0.6,2.9l-2.2,0.5l-0.2-1.1c-0.1,0-0.2,0-0.3,0
        c-0.1,0-0.2,0-0.2,0.1c-0.3,0.1-0.5,0.2-0.7,0.3c-0.2,0.1-0.3,0.4-0.4,0.6c-0.1,0.2-0.1,0.5-0.1,0.8c0,0.3,0,0.6,0.1,0.9
        c0.1,0.5,0.2,0.8,0.4,1.1c0.1,0.3,0.3,0.5,0.5,0.6c0.2,0.1,0.4,0.2,0.6,0.2c0.2,0,0.5,0,0.7,0c0.4-0.1,0.7-0.2,1.2-0.4
        c0.4-0.2,0.8-0.4,1.1-0.5c0.2,0.3,0.3,0.6,0.5,1c0.2,0.3,0.4,0.6,0.5,1c-0.4,0.4-1,0.6-1.6,0.9c-0.6,0.2-1.2,0.5-1.8,0.6
        c-0.9,0.2-1.7,0.2-2.4,0.1c-0.6-0.1-1.2-0.4-1.6-0.7c-0.4-0.4-0.8-0.8-1-1.3c-0.2-0.5-0.4-1.1-0.6-1.7c-0.1-0.5-0.2-1.1-0.1-1.7
        c0-0.6,0.1-1.1,0.4-1.7c0.2-0.5,0.7-1,1.2-1.4C254.6,592.5,255.3,592.2,256.3,592z"/>
      <path fill="#02323D" d="M264.1,587.9l0.6,2.6l2.4-0.5l0.5,2.1l-2.4,0.5l0.6,3c0.1,0.5,0.3,0.9,0.5,1c0.2,0.1,0.5,0.2,1,0.1
        c0.1,0,0.3-0.1,0.6-0.2c0.2-0.1,0.5-0.2,0.8-0.3l0.8,2c-0.2,0.1-0.4,0.2-0.6,0.4c-0.2,0.1-0.5,0.2-0.7,0.3
        c-0.2,0.1-0.5,0.2-0.7,0.2s-0.4,0.1-0.6,0.2c-0.8,0.2-1.4,0.2-1.9,0.1c-0.5-0.1-0.9-0.2-1.2-0.5c-0.3-0.2-0.5-0.5-0.7-0.8
        c-0.1-0.3-0.2-0.7-0.4-1l-0.8-3.9l-1.2,0.2l-0.4-1.8l1.3-0.7l0.3-2.4L264.1,587.9z"/>
    </g>
    
      <rect x="168.4" y="580.2" transform="matrix(-0.9776 0.2105 -0.2105 -0.9776 469.8535 1127.1688)" fill="#A7A9AC" width="13.1" height="16.8"/>
    
      <rect x="183.9" y="584.1" transform="matrix(-0.9776 0.2105 -0.2105 -0.9776 505.6013 1116.0177)" fill="#BCBEC0" width="19" height="1.7"/>
    
      <rect x="184.7" y="587.6" transform="matrix(-0.9776 0.2105 -0.2105 -0.9776 507.8717 1122.8398)" fill="#BCBEC0" width="19" height="1.7"/>
    
      <rect x="185.4" y="591.2" transform="matrix(-0.9776 0.2105 -0.2105 -0.9776 510.0883 1129.6741)" fill="#BCBEC0" width="19" height="1.7"/>
    
      <rect x="193.8" y="617" transform="matrix(-0.9776 0.2105 -0.2105 -0.9776 594.9244 1174.2972)" fill="#BCBEC0" width="82.3" height="3.5"/>
    
      <rect x="195.2" y="623.6" transform="matrix(-0.9776 0.2105 -0.2105 -0.9776 599.0931 1186.9208)" fill="#BCBEC0" width="82.3" height="3.5"/>
    
      <rect x="196.6" y="630.1" transform="matrix(-0.9776 0.2105 -0.2105 -0.9776 603.2696 1199.6198)" fill="#BCBEC0" width="82.3" height="3.5"/>
    
      <rect x="198" y="636.7" transform="matrix(-0.9776 0.2105 -0.2105 -0.9776 607.4323 1212.2456)" fill="#BCBEC0" width="82.3" height="3.5"/>
    
      <rect x="199.5" y="643.3" transform="matrix(-0.9776 0.2105 -0.2105 -0.9776 611.6246 1224.9355)" fill="#BCBEC0" width="82.3" height="3.5"/>
    
      <rect x="200.9" y="649.8" transform="matrix(-0.9776 0.2105 -0.2105 -0.9776 615.7774 1237.5668)" fill="#BCBEC0" width="82.3" height="3.5"/>
    
      <rect x="208.1" y="683.6" transform="matrix(-0.9776 0.2105 -0.2105 -0.9776 637.2739 1302.8173)" fill="#BCBEC0" width="82.3" height="3.5"/>
    
      <rect x="209.6" y="690.2" transform="matrix(-0.9776 0.2105 -0.2105 -0.9776 641.4669 1315.6624)" fill="#BCBEC0" width="82.3" height="3.5"/>
    
      <rect x="216.9" y="728.1" transform="matrix(-0.9776 0.2105 -0.2105 -0.9776 608.246 1393.7378)" fill="#A7A9AC" width="26" height="2.3"/>
    
      <rect x="217.9" y="732.4" transform="matrix(-0.9776 0.2105 -0.2105 -0.9776 610.9835 1402.0652)" fill="#A7A9AC" width="26" height="2.3"/>
    <g>
      <g>
        <path fill="<?php echo $theme ?>" d="M210.1,733.2c-5.9,0-11.4-2.9-14.8-7.7c-2.8-4-3.9-8.7-3-13.5c0.8-4.7,3.5-8.9,7.4-11.7
          c3-2.2,6.6-3.3,10.3-3.3c5.9,0,11.4,2.9,14.8,7.7c2.8,4,3.9,8.7,3,13.5c-0.8,4.7-3.5,8.9-7.4,11.7
          C217.4,732.1,213.9,733.2,210.1,733.2z M210.1,699c-3.3,0-6.5,1-9.3,2.9c-3.5,2.5-5.9,6.2-6.6,10.5c-0.7,4.3,0.2,8.5,2.7,12.1
          c3,4.3,8,6.9,13.3,6.9c3.3,0,6.5-1,9.3-2.9c3.5-2.5,5.9-6.2,6.6-10.5c0.7-4.3-0.2-8.5-2.7-12.1C220.3,701.6,215.4,699,210.1,699z
          "/>
      </g>
      <g>
        <path fill="<?php echo $theme ?>" d="M210.1,734.7c-6.4,0-12.4-3.1-16-8.3c-6.2-8.8-4.1-21.1,4.8-27.2c3.3-2.3,7.2-3.5,11.2-3.5
          c6.4,0,12.4,3.1,16,8.3c6.2,8.8,4.1,21.1-4.8,27.2C218,733.5,214.2,734.7,210.1,734.7z M210.1,696.4c-3.9,0-7.6,1.2-10.8,3.4
          c-8.5,6-10.6,17.7-4.6,26.2c3.5,5,9.3,8,15.4,8c3.9,0,7.6-1.2,10.8-3.4c8.5-6,10.6-17.7,4.6-26.2
          C222,699.4,216.2,696.4,210.1,696.4z"/>
      </g>
      <g>
        <path fill="<?php echo $theme ?>" d="M210.1,726.4c-3.6,0-7.1-1.8-9.2-4.8c-1.7-2.4-2.4-5.4-1.9-8.4c0.5-2.9,2.2-5.5,4.6-7.2
          c1.9-1.3,4.1-2,6.4-2c3.6,0,7.1,1.8,9.2,4.8c1.7,2.4,2.4,5.4,1.9,8.4c-0.5,2.9-2.2,5.5-4.6,7.2
          C214.7,725.7,212.4,726.4,210.1,726.4z M210.1,705.8c-1.9,0-3.8,0.6-5.3,1.7c-2,1.4-3.4,3.6-3.8,6c-0.4,2.4,0.1,4.9,1.6,7
          c1.7,2.5,4.6,4,7.6,4c1.9,0,3.8-0.6,5.3-1.7c2-1.4,3.4-3.6,3.8-6c0.4-2.4-0.1-4.9-1.6-7C216,707.3,213.2,705.8,210.1,705.8z"/>
      </g>
      
        <rect x="201.7" y="711.6" transform="matrix(-0.8186 0.5743 -0.5743 -0.8186 788.602 1176.7405)" fill="<?php echo $theme ?>" width="13.7" height="2.6"/>
      
        <rect x="203.7" y="714.5" transform="matrix(-0.8187 0.5743 -0.5743 -0.8187 794.0521 1180.8645)" fill="<?php echo $theme ?>" width="13.7" height="2.6"/>
      
        <rect x="205.8" y="717.4" transform="matrix(-0.8187 0.5742 -0.5742 -0.8187 799.4325 1185.0779)" fill="<?php echo $theme ?>" width="13.7" height="2.6"/>
    </g>
    <g>
      
        <rect x="268" y="723.6" transform="matrix(-0.9776 0.2105 -0.2105 -0.9776 713.403 1371.981)" fill="<?php echo $theme ?>" width="31.3" height="0.7"/>
    </g>
    <g>
      <g>
        <path fill="#02323D" d="M267.2,746.1c-0.1,0-0.1,0-0.2,0c-0.2-0.1-0.3-0.2-0.2-0.5l3.9-13.8c-2.2,0.7-4.2,0.9-5.9,0.4
          c-1-0.4-1.6-1.1-1.7-2c-0.1-1.5,1.2-3.1,3.1-4c1.9-0.9,4.1-1.2,6.3-0.8l4-14.1c0-0.2,0.2-0.3,0.4-0.3c0.2,0,0.3,0.1,0.4,0.3
          c0.6,4.6,1.7,9,3.1,13.4c0.1-0.2,0.3-0.3,0.4-0.5c1.8-2,3-4.3,3.9-6.5c-0.1-0.5-0.2-0.9-0.3-1.3c-0.4-1.8-0.8-5.3,0.1-6.6
          c0.3-0.4,0.6-0.6,1.1-0.6c0.2,0,0.7,0,1,0.6c0.6,1.2,0.4,4.5-1.1,8.1c1.6,5.9,4,11.6,7.2,16.8c0.1,0.2,0.1,0.4-0.1,0.5
          c-0.2,0.1-0.4,0.1-0.5-0.1c-3.1-5-5.5-10.4-7-16.1c-0.9,1.9-2,4-3.6,5.8c-0.2,0.3-0.5,0.5-0.7,0.8c0.9,2.6,1.9,5.3,3.1,7.8
          c0.7,1.2,1.3,2.5,1.9,3.9c0.1,0.2,0,0.4-0.2,0.5c-0.2,0.1-0.4,0-0.5-0.2c-0.7-1.2-1.3-2.5-1.9-3.8c-1.2-2-2.9-4.1-5.3-5.6
          c0,0,0,0-0.1,0c-1.9,1.5-4.1,2.7-6.2,3.5l-4.1,14.3C267.4,746,267.3,746.1,267.2,746.1z M278.3,727.5c1.2,0.8,2.3,1.8,3.3,3
          c-0.6-1.4-1.2-2.9-1.7-4.4C279.5,726.6,278.9,727.1,278.3,727.5z M268.6,726.2c-0.7,0.1-1.4,0.4-2,0.7c-1.9,0.9-2.8,2.3-2.7,3.3
          c0,0.6,0.4,1.1,1.2,1.3c1.6,0.5,3.7,0.3,5.9-0.5l1.4-4.9C271,725.9,269.8,725.9,268.6,726.2z M273.1,726.2l-1.3,4.5
          c1.8-0.7,3.6-1.8,5.2-3C275.8,726.9,274.4,726.4,273.1,726.2z M273.3,725.5c1.5,0.3,3,0.8,4.4,1.7c0.7-0.6,1.4-1.2,2-1.8
          c-1.3-4-2.3-8-3-12.2L273.3,725.5z M285.5,709.8c-0.2,0-0.3,0.1-0.5,0.3c-0.7,1-0.5,3.8,0,6c0,0.1,0,0.2,0.1,0.2
          c1-3,1.2-5.6,0.7-6.4c-0.1-0.2-0.2-0.2-0.2-0.2C285.5,709.8,285.5,709.8,285.5,709.8z"/>
      </g>
    </g>
  </g>
  <path fill="#FFD59C" d="M334,726.8c-0.2,0.1-3,19.1-3,19.1l7.1,5.9c0,0,8.4-14.2,8.2-15.4s-4.1-12.7-6.3-12.4
    C337.8,724.4,334,726.8,334,726.8z"/>
  <linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="439.5039" y1="-43.2188" x2="558.8438" y2="-43.2188" gradientTransform="matrix(0.7444 0 0 -0.7444 -23.8314 716.9078)">
    <stop  offset="0" style="stop-color:#FFFFFF"/>
    <stop  offset="0.6405" style="stop-color:#FFE1B8"/>
    <stop  offset="1" style="stop-color:#FFD498"/>
  </linearGradient>
  <path fill="url(#SVGID_1_)" d="M359.2,790.6l-8.1-12.1h-27.5L303.4,748l14-22.6c0,0,17.7,7.1,4.8,22c4.7,5.1,9.1,7.8,9.1,7.8
    l12.7-19.6c0,0-7-14.5-8-16.1c-1-1.6,10.5-19.4,18.4-8.4c7.8,11,26.7,41.1,30.3,57.9c6.7,8.7,7.6,11,7.6,11L359.2,790.6z"/>
  <path fill="#FFD59C" d="M309.3,738.3l4.6,3.1c0,0,6.8-4.8,6.4-12.5c-2-1.5-3.8-2.2-3.8-2.2L309.3,738.3z"/>
  <g>
    <path fill="#FDB714" d="M316.3,724.5c0,0,1.2-5.1-9.6-4c4,10.3,8.2,6,8.2,6l2.2,1l1.1-1.7L316.3,724.5z M314,724.6
      c-0.2,0.4-0.6,0.5-0.9,0.4c-0.2-0.1-0.3-0.3-0.3-0.6c-0.2-0.1-0.5-0.2-0.8-0.4c-0.8-0.4-1.4-0.9-1.3-1.1c0.1-0.2,0.8,0,1.7,0.4
      c0.3,0.1,0.5,0.3,0.7,0.5c0.2-0.1,0.5-0.2,0.7-0.1C314.1,723.8,314.2,724.2,314,724.6z"/>
    <polygon fill="#02323D" points="363.9,758.8 315.6,728.1 318.4,724 372.8,742.2   "/>
    <circle fill="<?php echo $theme ?>" cx="370.9" cy="751.8" r="9.9"/>
    <path fill="#02323D" d="M374.9,748.3c-0.3-0.2-0.6-0.3-1-0.5l0,0l0,0c-0.6-0.2-1.2-0.3-1.9-0.3c-2.8,0.1-4.9,2.5-4.7,5.2
      c0.1,1.9,1.3,3.6,2.9,4.3l0,0l8.9,4.2l3.7-9.2L374.9,748.3z"/>
    <circle fill="<?php echo $theme ?>" cx="380.8" cy="756.6" r="5"/>
  </g>
  <linearGradient id="SVGID_2_" gradientUnits="userSpaceOnUse" x1="463.125" y1="4.3213" x2="490.172" y2="4.3213" gradientTransform="matrix(0.7444 0 0 -0.7444 -23.8314 716.9078)">
    <stop  offset="0" style="stop-color:#FFF5E5"/>
    <stop  offset="0.1105" style="stop-color:#FFFFFF"/>
    <stop  offset="0.3626" style="stop-color:#FFF7EC"/>
    <stop  offset="1" style="stop-color:#FEEACB"/>
  </linearGradient>
  <path fill="url(#SVGID_2_)" d="M341.5,722.2c-2.8,5.1-12.9,13.7-23.7,3.4c-2.9-2.7-2.6-9,1.2-10.9c1.1,0.2,4.2,1,7.9,2.5
    c7.8-12.7,16.4-20.7,17.2-20.2s8.9,6.7,10.2,14.2C349.8,712.2,344.6,716.4,341.5,722.2z"/>
  <path fill="<?php echo $theme ?>" d="M380.7,840.9l-26.4-46.4c0,0-1.4-10.3,10.8-19.6c12.7-9.6,22.7-6.2,22.7-6.2l41.5,41.5V844L380.7,840.9z"/>
  <path fill="#FFD59C" d="M326.8,717.2c-1.6,0.7-5.6,3.3-5.6,3.3s-6.4-3.5-2.3-5.8C322,715.2,325.3,716.4,326.8,717.2z"/>
  <path fill="#FFFFFF" d="M307.4,720.7c0,0,7.1-0.7,8.3,3.8c0.9,0.8,1.6,1.1,1.6,1.1l-0.4,0.5l-1.6-1.1
    C314.3,722.3,307.4,720.7,307.4,720.7z"/>
  </svg>


                                                    </div></td>
                                                  </tr>
                                                </tbody>
                                              </table>
                                            </div>
                                            <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
                                            </div>
                                            <!-- page 15 end -->
</article>
                                            
<article>											
											<!-- page 16 -->
                                            <div class="page-17">
											<div class="pg-17-header">
                                              <h1>TYPICAL TRANSACTION </h1>
                                              <h2>What you should expect moving forward.</h2>
											   </div><!-- .pg-17-header -->
                                              <div class="pg-17-content cf">
                                                <div class="full-img"><img src="<?php echo base_url(); ?>pdf/images/typ-trans_896p.png" alt="" style="width:100%;  " /></div>
                                                
                                              </div>
                                              <sethtmlpagefooter name="MyFooter1" value="on" /><pagebreak type="NEXT-ODD" pagenumstyle="1" />
                                              </div>
                                              <!-- page 16 end -->
</article>
<article>
                                              <!-- page 16 -->
                                              <div class="page-18">
											  <div class="pg-18-header">
                                                <h1>A PROMISE TO MY CLIENTS </h1>
                                                <h2>My duties to you</h2></div><!-- .pg-18-header -->
                                                <div class="pg-18-content cf">
                                                 <h3>As your real estate agent i am held under law to owe you certain specific duties, in addition to any duties or obligations set forth in our listing agreement my fiduciary duties to you include:</h3>

                                                  <h2>Loyalty</h2><p>Loyalty is one of the most fundamental fiduciary duties owed by me to you. This duty obligates me to act at all times solely your best interest and exclude of all other interests, including my own self-interest.</p>

   <h2>Confidentiality</h2><p>As your agent I am obligated to safeguard your confidence and secrets. I therefore, must keep confidential any information that might weaken your bargaining position if it were revealed.</p>

   <h2>Disclosure</h2><p>As your agent I am obligated to disclose to you all relevant and material information
  that I know might affect the seller’s ability to obtain the highest price and best terms in the sale of his property.</p>

  <h2>Obedience</h2><p>As your agent I am obligated to obey promptly and efficiently all lawful instructions that you give me pertaining to the sale of your property. However, this duty plainly does not include an obligation to obey any unlawful instructions</p>

  <h2>Reasonable care and diligence</h2><p>As your agent I am obligated to use reasonable care and diligence in pursuing your real estate affairs. The standard of care expected by me to you is that of a competent real estate professional.</p>

   <h2>Accounting</h2><p>As your agent I am obligated to account for all money or property belonging to you
  that is entrusted to you. This duty compels me to safeguard any money, deeds, or other
  documents entrusted to me that relate to your transactions or affairs.</p>

                                                  <p align="right">




                                                  



                                                  </p>
                                                  
                                                </div>
                                                
                                              </div>
                                              <!-- page 16 end -->
</article>
                                            </div>
                                          </body>
                                        </html>