<div class="container">
	<div class="section">
		<div class="body">
			<img width="100%" class="img-responsive" src="<?php echo base_url("assets/reports/english/buyer/images/1/1_c.jpg")?>">	
			<div class="section-content">
				<p>Buyers Report</p>
				<h1><?php echo $property->PropertyProfile->SiteAddress ; ?></h1>

				<div class="line" style="background-color:<?php echo $theme ?>; "></div>

				<p><?php echo $property->PropertyProfile->SiteCity; ?>, <?php echo $property->PropertyProfile->SiteState ; ?> <?php echo $property->PropertyProfile->SiteZip; ?></p>
			</div>
		</div>
		<div class="footer">
			<div class="row">
                            <div class="footer-inner">
							<div class="col-xs-12">
                                <div class="left-footer pull-left">
                                    <div class="row">
                                        <?php if($user['profile_image'] != '' && $user['profile_image'] != 'no'):?>
                                        <div class="col-xs-6">
                                              <img width="130px" height="130px" style="border-radius:100%; margin-top:0px; margin-left:0px;" class="img-responsive" src="<?php echo base_url().$user['profile_image']; ?>" />
                                        </div>
                                        <?php else: ?>
                                        <div class="col-xs-3"></div>
                                        <?php endif; ?>
										<div class="<?php echo ($user['profile_image'] != '' && $user['profile_image'] != 'no')?'col-xs-6':'col-xs-9'  ?>">
                                                <h4 class="client-name"><?php echo $user['fullname']; ?></h4>
                                                <p class="client-detail" ></p>
                                                <p class="client-detail" ><?php echo $user['title']; ?></p>
                                                <p class="client-detail" >CA BRE#<?php echo $user['licenceno']; ?></p>
                                                <p class="client-detail" > Direct: <?php echo $user['phone']; ?></p>
                                                <p class="client-detail" > <?php echo $user['email']; ?></p>
                                                <p class="client-detail" >  <?php echo $user['companyname']; ?></p>
                                                <p class="client-detail" > <?php echo $user['street']; ?></p>
                                                <p class="client-detail" > <?php echo $user['city']; ?>, &nbsp; <?php echo $user['state'];  ?>&nbsp;<?php echo $user['zip']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="right-footer pull-right" style="padding-top:0px !important;">
                                                <?php if($user['company_logo'] != ''):?><img src="<?php echo base_url().$user['company_logo']; ?>" style="max-height:130px;max-width:300px;padding-bottom: 0px;"  alt="Logo Image"/><?php endif; ?>
                                </div>
                               </div>
							</div>
                        </div>
		</div>
    </div>
</div>
