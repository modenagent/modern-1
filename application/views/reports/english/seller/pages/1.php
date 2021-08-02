<div class="container">
	<div class="section">
		<div class="body">
			<img width="100%" class="img-responsive" src="<?php echo base_url("assets/reports/english/seller/images/1/1_b3.jpg") ?>">	
			<div class="section-content">
				<p>Seller's Report</p>
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
                                        <img  class="img-cover" src="<?php if($callFromApi == 1) echo $user['profile_image']; else echo base_url().$user['profile_image']; ?>"  />
                                </div>
                                <?php else: ?>
                                <div class="col-xs-3"></div>
                                <?php endif; ?>
                                <div class="<?php echo ($user['profile_image'] != '' && $user['profile_image'] != 'no')?'col-xs-6':'col-xs-9'  ?>">
                                    <h4 class="client-name"><?php echo $user['fullname']; ?></h4>
                                    <p class="client-detail" >
                                    <p class="client-detail" ><?php echo $user['title']; ?></p>
                                    <p class="client-detail" >CA BRE#<?php echo $user['licenceno']; ?></p>
                                    <p class="client-detail" > Direct: <?php echo $user['phone']; ?></p>
                                    <p class="client-detail" > <?php echo $user['email']; ?></p>
                                    <p class="client-detail" >  <?php echo $user['companyname']; ?></p>
                                    <p class="client-detail" > <?php echo $user['street']; ?></p>
                                    <p class="client-detail" > <?php echo $user['city']; ?>, &nbsp; <?php echo $user['state'];  ?>&nbsp;<?php echo $user['zip']; ?></p>
                                    </p>		
                                </div>
                            </div>
                        </div>
                        <div class="right-footer pull-right" style="">
                            <?php if($user['company_logo'] != ''):?><img src="<?php if($callFromApi == 1) echo $user['company_logo']; else echo base_url().$user['company_logo']; ?>" style=""  alt="Logo Image"/><?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</div>
