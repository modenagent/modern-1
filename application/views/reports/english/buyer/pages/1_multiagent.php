<div class="container">
	<div class="section page5">
	
		<header>
			<h2 class="underline title-bold">Our Partners</h2>
                        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
		</header>


		<div class="partner-block">
                    <div class="footer">
                        <?php foreach ($partner as $_partner)  : ?> 
                            <div class="row" style="padding-bottom: 50px;">
                                <div class="footer-inner">
                                    <div class="left-footer pull-left col-xs-12">
                                        <div class="row">
                                            <?php if($_partner['profile_image'] != '' && $_partner['profile_image'] != 'no'):?>
                                            <div class="pull-left">
                                                    <img width="147px" style="border-radius:7%;" class="img-responsive" src="<?php echo base_url().$_partner['profile_image']; ?>"  >
                                            </div>
                                            <?php endif; ?>
                                            <div class="pull-left">
                                                <div>
                                                    <h4 class="client-name"><?php echo $_partner['fullname']; ?></h4>
                                                    <p class="client-detail" ></p>
                                                    <p class="client-detail" ><?php echo $_partner['title']; ?></p>
                                                    <p class="client-detail" >CA BRE#<?php echo $_partner['licenceno']; ?></p>
                                                    <p class="client-detail" > Direct: <?php echo $_partner['phone']; ?></p>
                                                    <p class="client-detail" > <?php echo $_partner['email']; ?></p>
                                                </div>
                                            </div>
                                            <div class="right-footer pull-right">
                                                    <?php if($_partner['company_image'] != ''):?><img src="<?php echo base_url().$_partner['company_image']; ?>" style="max-height:130px;max-width:300px;padding-bottom: 0px;"  alt="Logo Image"/><?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

		</div> 




	</div>

<!--	<div class="seperator"></div>-->
</div>
