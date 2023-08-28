<div class="container">
	<div class="section page7">
	
		<header>
			<h2 class="underline title-bold">
			<?php 
			if (isset($report_content_data['title']['value']) && !empty($report_content_data['title']['value'])) {
				echo $report_content_data['title']['value'];
			} else {
				echo 'Social Media & Networking';
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
			<div class="two-grid-wrapper vertical-align">
				<div class="col-xs-6 responsive-100">
					<div class="left-grid">
						<div class="text-block-condensed">
							<h2>
							<?php 
							if (isset($report_content_data['paragraph_1_title']['value']) && !empty($report_content_data['paragraph_1_title']['value'])) {
								echo $report_content_data['paragraph_1_title']['value'];
							} else {
								echo 'Email Marketing';
							}
							?>
							</h2>
							<p>
							<?php 
							if (isset($report_content_data['paragraph_1_content']['value']) && !empty($report_content_data['paragraph_1_content']['value'])) {
								echo nl2br($report_content_data['paragraph_1_content']['value']);
							} else {
								echo 'We have a vast network of emails consisting of past clients, prospective buyers, other real estate agents, and brokers which we will leverage to get your property maximum exposure. We will begin with a just listed campaign and proceed with subsequent campaigns showcasing your property to prospective buyers.';
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
								echo 'Social Media Marketing';
							}
							?>
							</h2>
							<p>
							<?php 
							if (isset($report_content_data['paragraph_2_content']['value']) && !empty($report_content_data['paragraph_2_content']['value'])) {
								echo nl2br($report_content_data['paragraph_2_content']['value']);
							} else {
								echo 'We will leverage Facebook, Instagram, LinkedIn & Twitter to increase awareness about your property. These social media sites have a combined user base of over 1.3 billion spread-out across the world. On a local level the numbers are much more scaled down but just as massive relative to size of the neighborhood. We want to maximize property exposure by placing the enhanced pictures along with videos to help prospective buyers get a closer look of your property.';
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
								echo 'Open Houses & Showings';
							}
							?>
							</h2>
							<p>
							<?php 
							if (isset($report_content_data['paragraph_3_content']['value']) && !empty($report_content_data['paragraph_3_content']['value'])) {
								echo nl2br($report_content_data['paragraph_3_content']['value']);
							} else {
								echo 'Depending on your availability and willingness we will schedule both open houses and private viewings of your property. Open house events are a great way to showcase your property as well as generate prospective buyer leads.';
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
								echo 'Broker 2 Broker Networking';
							}
							?>
							</h2>
							<p>
							<?php 
							if (isset($report_content_data['paragraph_4_content']['value']) && !empty($report_content_data['paragraph_4_content']['value'])) {
								echo nl2br($report_content_data['paragraph_4_content']['value']);
							} else {
								echo 'Brokers are consistently networking with other brokers to find the homes that matches their clients criteria. We will network with all surrounding brokers and realtors to see if your properties is a match for one of theirs.';
							}
							?>
							</p>
						</div>
						
					</div>
				</div>
				<div class="col-xs-6 responsive-100">
					<div class="right-grid">
						<img width="100%" class="img-responsive page-right-img" src="<?php echo base_url("assets/reports/english/seller/images/6e/6e2.jpg")?>" alt="">
					</div>
				</div>
		</div> <!-- .two-grid-wrapper -->


	</div>

	
    </div>

</div>
