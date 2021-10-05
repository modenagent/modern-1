<div class="container">
	<div class="section page7">
	
		<header>
			<h2 class="underline title-bold">
			<?php 
			if (isset($report_content_data['title']['value']) && !empty($report_content_data['title']['value'])) {
				echo $report_content_data['title']['value'];
			} else {
				echo 'Negotiating Offers';
			}
			?>
			</h2>
			<p>
			<?php 
			if (isset($report_content_data['sub_title']['value']) && !empty($report_content_data['sub_title']['value'])) {
				echo $report_content_data['sub_title']['value'];
			} else {
				echo 'Keeping things on your terms.';
			}
			?>
			</p>
		</header>

		<div class="row">
			<div class="two-grid-wrapper">
				<div class="col-xs-6">
					<div class="left-grid">
						<div class="text-block-condensed">
							
							<p class="perfect-world">
							<?php 
							if (isset($report_content_data['content']['value']) && !empty($report_content_data['content']['value'])) {
								echo nl2br($report_content_data['content']['value']);
							} else {
								echo "In a perfect world, every home buyer and every home seller would get exactly the deal they want for their real estate transaction. In reality, the best deals are the ones in which each side feels they got most of what they wanted and didn't have to give up too much.
                                <br>
                                <br>
								The negotiating portion of a real estate transaction can be exciting, frustrating, and tedious. As a seller you want to get what you feel your
                                home is worth and I want to help make that happen. My qualifications will help keep the negotiating terms in your favor.
                                <br>
                                <br>
                                The goal is to make sure you avoid pitfalls that many sellers are faced when selling their home. The most common are:";
							}
							?>
							</p><br><br>
                             
                             	<h4 class="making" style="color: <?php echo $theme ?>;">
								<?php 
								if (isset($report_content_data['point_1_title']['value']) && !empty($report_content_data['point_1_title']['value'])) {
									echo $report_content_data['point_1_title']['value'];
								} else {
									echo '- Not making sure buyers are qualified';
								}
								?>
								</h4>
                             	<h4 class="making" style="color: <?php echo $theme ?>;">
								<?php 
								if (isset($report_content_data['point_2_title']['value']) && !empty($report_content_data['point_2_title']['value'])) {
									echo $report_content_data['point_2_title']['value'];
								} else {
									echo '- Not understanding contract and forms';
								}
								?>
								</h4>
                             	<h4 class="making" style="color: <?php echo $theme ?>;">
								<?php 
								if (isset($report_content_data['point_3_title']['value']) && !empty($report_content_data['point_3_title']['value'])) {
									echo $report_content_data['point_3_title']['value'];
								} else {
									echo '- Failing to disclose all property facts';
								}
								?>
								</h4>
                             	<h4 class="making" style="color: <?php echo $theme ?>;" >
								<?php 
								if (isset($report_content_data['point_4_title']['value']) && !empty($report_content_data['point_4_title']['value'])) {
									echo $report_content_data['point_4_title']['value'];
								} else {
									echo '- Setting up contingencies';
								}
								?>
								</h4>
                                <h4 class="making" style="color: <?php echo $theme ?>;">
								<?php 
								if (isset($report_content_data['point_5_title']['value']) && !empty($report_content_data['point_5_title']['value'])) {
									echo $report_content_data['point_5_title']['value'];
								} else {
									echo '- Handling the buyers deposit';
								}
								?>
								</h4>  <br>

                                <p> 
                                <?php 
								if (isset($report_content_data['footer_content']['value']) && !empty($report_content_data['footer_content']['value'])) {
									echo nl2br($report_content_data['footer_content']['value']);
								} else {
									echo "The thing to remember about negotiating is that it's not where you start but rather where you finish. My goal is to make sure that you finish first every time.";
								}
								?>
                                </p>                           
						</div>
					
					</div>
				</div>
				<div class="col-xs-6">
					<div class="right-grid">
						<img width="100%" class="img-responsive page-right-img" src="<?php echo base_url("assets/reports/english/seller/images/6g/6g2.jpg")?>" alt="">
					</div>
				</div>
		</div> <!-- .two-grid-wrapper -->


	</div>

	
</div>
</div>
