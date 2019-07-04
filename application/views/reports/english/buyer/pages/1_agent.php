<div class="container">
	<div class="section">
		<div class="body">
			<img width="100%" class="img-responsive" src="<?php echo base_url("assets/reports/english/buyer/images/1/1_c_agent.jpg")?>">	
			<div class="section-content">
				<p>Buyers Report</p>
				<h1><?php echo $property->PropertyProfile->SiteAddress ; ?></h1>

				<div class="line" style="background-color:<?php echo $theme ?>; "></div>

				<p><?php echo $property->PropertyProfile->SiteCity; ?>, <?php echo $property->PropertyProfile->SiteState ; ?> <?php echo $property->PropertyProfile->SiteZip; ?></p>
			</div>
		</div>
		<div class="footer">
			<!-- <div class="container" style="border: 1px solid yellow;"> -->
				<div class="row">
					<div class="footer-inner">
						<div class="col-xs-12">
                                                    <div class="left-footer col-xs-6">
                                                        <div class="row">
                                                            <?php if($user['profile_image'] != '' && $user['profile_image'] != 'no'):?>
                                                            <div class="pull-left">
                                                                    <img width="147px" style="border-radius:7%;" class="img-responsive" src="<?php echo base_url().$user['profile_image']; ?>"  >
                                                            </div>
                                                            <?php endif; ?>
                                                            <div class="pull-left">
                                                                <div>
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
                                                    </div>
                                                    <div class="left-footer pull-right col-xs-6">
                                                        <div class="row">
                                                            <div class="pull-right">
                                                                <div>
                                                                    <h4 class="client-name"><?php echo $partner[0]['fullname']; ?></h4>
                                                                    <p class="client-detail" ></p>
                                                                    <p class="client-detail" ><?php echo $partner[0]['title']; ?></p>
                                                                    <p class="client-detail" >CA BRE#<?php echo $partner[0]['licenceno']; ?></p>
                                                                    <p class="client-detail" > Direct: <?php echo $partner[0]['phone']; ?></p>
                                                                    <p class="client-detail" > <?php echo $partner[0]['email']; ?></p>
                                                                </div>
                                                            </div>
                                                            <?php if($partner[0]['profile_image'] != '' && $partner[0]['profile_image'] != 'no'):?>
                                                            <div class="pull-right">
                                                                    <img width="147px" style="border-radius:7%;" class="img-responsive" src="<?php echo base_url().$partner[0]['profile_image']; ?>"  >
                                                            </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xs-12">
                                                            <div class="pull-left company-img">
                                                                <?php if($user['company_logo'] != ''):?><img src="<?php echo base_url().$user['company_logo']; ?>" style="max-height:130px;max-width:300px;padding-bottom: 0px;"  alt="Logo Image"/><?php endif; ?>
                                                            </div>
                                                            <div class="pull-right company-img">
                                                                <?php if($partner[0]['company_image'] != ''):?><img src="<?php echo base_url().$partner[0]['company_image']; ?>" style="max-height:130px;max-width:300px;padding-bottom: 0px;"  alt="Logo Image"/><?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
						</div>
					</div>
				</div>
			<!-- </div> -->
		</div>
    </div>

<!--	<div class="page-seperator"></div>-->
</div>
