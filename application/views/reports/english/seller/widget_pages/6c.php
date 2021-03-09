<div class="container">
	<div class="section page7">
	
		<header>
			<h2 class="underline title-bold">
			<?php 
			if (isset($report_content_data['title']['value']) && !empty($report_content_data['title']['value'])) {
				echo $report_content_data['title']['value'];
			} else {
				echo 'Pics & Online Exposure';
			}
			?>
			</h2>
			<p>
			<?php 
			if (isset($report_content_data['sub_title']['value']) && !empty($report_content_data['sub_title']['value'])) {
				echo $report_content_data['sub_title']['value'];
			} else {
				echo 'Marketing Your Property';
			}
			?>
			</p>
		</header>

		<div class="row">
			<div class="two-grid-wrapper">
				<div class="col-xs-6">
					<div class="left-grid">
						<div class="text-block-condensed">
							<h2>
							<?php 
							if (isset($report_content_data['paragraph_1_title']['value']) && !empty($report_content_data['paragraph_1_title']['value'])) {
								echo $report_content_data['paragraph_1_title']['value'];
							} else {
								echo 'Imagery';
							}
							?>
							</h2>
							<p>
							<?php 
							if (isset($report_content_data['paragraph_1_content']['value']) && !empty($report_content_data['paragraph_1_content']['value'])) {
								echo nl2br($report_content_data['paragraph_1_content']['value']);
							} else {
								echo 'Did you know that listings with professional photos sell for more money? Not only that, but they sell quicker. Since 92% of buyers are home shopping online, the importance of good photos has never been more apparent. We will incorporate photos that will be enhanced to show your home in the best light possible. This should lead to more inquiries in a shorter amount of time.';
							}
							?>
							</p>
						</div>
						<div class="text-block-condensed">
							<h2>
							<?php 
							if (isset($report_content_data['paragraph_2_title']['value']) && !empty($report_content_data['paragraph_2_title']['value'])) {
								echo $report_content_data['paragraph_2_title']['value'];
							} else {
								echo 'MLS & MORE';
							}
							?>
							</h2>
							<p>
							<?php 
							if (isset($report_content_data['paragraph_2_content']['value']) && !empty($report_content_data['paragraph_2_content']['value'])) {
								echo nl2br($report_content_data['paragraph_2_content']['value']);
							} else {
								echo 'The MLS, which is an acronym for the multiple listing service is the preferred network utilized by realtors to make real estate listings available online. This is the very first place where we will list your home because realtors who are currently working with pre-approved buyers will be notified first. All the enhanced photos, property details, and sales price will be placed within the listing.';
							}
							?>
							</p>
						</div>
						<div class="text-block-condensed">
							<h2>
							<?php 
							if (isset($report_content_data['paragraph_3_title']['value']) && !empty($report_content_data['paragraph_3_title']['value'])) {
								echo $report_content_data['paragraph_3_title']['value'];
							} else {
								echo 'Syndication';
							}
							?>
							</h2>
							<p>
							<?php 
							if (isset($report_content_data['paragraph_3_content']['value']) && !empty($report_content_data['paragraph_3_content']['value'])) {
								echo nl2br($report_content_data['paragraph_3_content']['value']);
							} else {
								echo 'Since the MLS now provides its real estate listings to the thousands of individual websites including 4 of the largest real estate websites which are: Trulia, Redfin, Zillow & Realtor.com. Between these sites they capture about 120 million visitors every month. This surely help us get your property the necessary exposure to get it sold quickly.';
							}
							?>
							</p>
						</div>
						
					</div>
				</div>
				<div class="col-xs-6">
					<div class="right-grid">
						<img width="100%" class="img-responsive" src="<?php echo base_url("assets/reports/english/seller/images/6c/6c3.jpg")?>" alt="">
					</div>
				</div>
		</div> <!-- .two-grid-wrapper -->


	</div>

	
    </div>
</div>
