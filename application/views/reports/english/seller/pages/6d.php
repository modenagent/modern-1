<div class="container">
	<div class="section page7">
	
		<header>
			<h2 class="underline title-bold">
			<?php 
			if (isset($report_content_data['title']['value']) && !empty($report_content_data['title']['value'])) {
				echo $report_content_data['title']['value'];
			} else {
				echo 'Printed Collateral';
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
								echo 'Just Listed Postcards';
							}
							?>
							</h2>
							<p>
							<?php 
							if (isset($report_content_data['paragraph_1_content']['value']) && !empty($report_content_data['paragraph_1_content']['value'])) {
								echo nl2br($report_content_data['paragraph_1_content']['value']);
							} else {
								echo 'We will prepare just listed postcards which we will use to let the surrounding homes that your home has officially gone on the market. This is great resource to generate buyers leads since many people usually have friends or family that might want to move into the neighborhood. The designed postcard, flyers,a door hangers will all contain pictures, property details, and pricing information. We will answer all inquiries from interested parties.';
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
								echo 'Just Listed Flyers';
							}
							?>
							</h2>
							<p>
							<?php 
							if (isset($report_content_data['paragraph_2_content']['value']) && !empty($report_content_data['paragraph_2_content']['value'])) {
								echo nl2br($report_content_data['paragraph_2_content']['value']);
							} else {
								echo 'We will prepare just listed flyers in addition to
                                the postcards which we will post on the boards of surrounding businesses, real estate offices, escrow offices, & other parties within the real estate industry. This initiative will help us get some additional property exposure and prospective buyer inquiries.';
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
								echo 'Door Hangers';
							}
							?>
							</h2>
							<p>
							<?php 
							if (isset($report_content_data['paragraph_3_content']['value']) && !empty($report_content_data['paragraph_3_content']['value'])) {
								echo nl2br($report_content_data['paragraph_3_content']['value']);
							} else {
								echo 'Will have door hangers ready on for use on days which we will be showcasing the property. This is a great way to let the nearby neighbors know that they can see the property for themselves.';
							}
							?>
							</p>
						</div>

						<div class="text-block-condensed">
							<h2>
							<?php 
							if (isset($report_content_data['paragraph_4_title']['value']) && !empty($report_content_data['paragraph_4_title']['value'])) {
								echo $report_content_data['paragraph_4_title']['value'];
							} else {
								echo 'C-T-A SiGN';
							}
							?>
							</h2>
							<p>
							<?php 
							if (isset($report_content_data['paragraph_4_content']['value']) && !empty($report_content_data['paragraph_4_content']['value'])) {
								echo nl2br($report_content_data['paragraph_4_content']['value']);
							} else {
								echo 'CTA signs which is an acronym for Call-ToAction
                                will be placed on the real estate sign in front of your property. This sign will contain a code that people can text to instantly receive sale information regarding your property.<br><br>We will follow up diligently with all leads that
                                are gathered from these initiatives.';
							}
							?>
							</p>
						</div>
						
					</div>
				</div>
				<div class="col-xs-6">
					<div class="right-grid">
						<img width="100%" class="img-responsive" src="<?php echo base_url("assets/reports/english/seller/images/6c/6c2.jpg")?>" alt="">
					</div>
				</div>
		</div> <!-- .two-grid-wrapper -->


	</div>
    </div>
</div>
