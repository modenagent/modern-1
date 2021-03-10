<page class="pdf14">
	<?php
        $heading = isset($report_content_data['title']['value']) && !empty($report_content_data['title']['value']) ? $report_content_data['title']['value'] : 'Digital Marketing Plan';
    ?>
	<h1 class="main_title top_title"><?php echo $heading; ?></h1>
	<img src="<?php echo base_url().'assets/reports/english/seller/images/1/line.png'; ?>" alt="line" class="bordered_img">
	<div class="d-flex">
	    <div class="col-12">
	    	<?php
		        $sub_heading = isset($report_content_data['sub_title']['value']) && !empty($report_content_data['sub_title']['value']) ? $report_content_data['sub_title']['value'] : 'Our Marketing Strategy';
		    ?>
	        <h4 class="mt-0"><?php echo $sub_heading; ?></h4>
	        <?php 
	        	$content = isset($report_content_data['content']['value']) && !empty($report_content_data['content']['value']) ? nl2br($report_content_data['content']['value']) : 'Other agents may have a digital strategy of posting your house on social media and then rely on other
	            agents to expose your house to buyers. I have an entire digital marketing strategy where I will:<br><br>1) ADVERTISE your property, via paid ads on Facebook, Instagram, Google and all real estate sites (think zillow, realtor.com etc.)<br><br>2) Cultivate lists of people who have shown interest in a home like yours, where they work, where they live currently, and more to run personalized ads on online platforms';
	        ?>
	        <p class="f14"><?php echo $content; ?></p>
	    </div>
	</div>
	<div class="d-flex">    
	    <div class="col-50">
	    	<?php
                $para_1_title = isset($report_content_data['paragraph_1_title']['value']) && !empty($report_content_data['paragraph_1_title']['value']) ? $report_content_data['paragraph_1_title']['value'] : 'Email and Social Media Marketing:';
            ?>
	        <h4 class="crimson"><?php echo $para_1_title; ?></h4>
	        <?php
                $para_1_content = isset($report_content_data['paragraph_1_content']['value']) && !empty($report_content_data['paragraph_1_content']['value']) ? nl2br($report_content_data['paragraph_1_content']['value']) : 'I offer marketing prowess to help get more buyers’ eyes on your house. I will digitally market, via email and social media, your house to hundreds of local buyers, through these marketing efforts:';
            ?>
	        <p class="f14"><?php echo $para_1_content; ?></p>
	        <ul class="f14">
	        	<?php
	                $para_1_point_1_title = isset($report_content_data['para_1_point_1_title']['value']) && !empty($report_content_data['para_1_point_1_title']['value']) ? nl2br($report_content_data['para_1_point_1_title']['value']) : 'I will market your house via email blasts to buyers who have shown interest in homes like yours';
	            ?>
	            <li><?php echo $para_1_point_1_title; ?></li>
	            <?php
	                $para_1_point_2_title = isset($report_content_data['para_1_point_2_title']['value']) && !empty($report_content_data['para_1_point_2_title']['value']) ? nl2br($report_content_data['para_1_point_2_title']['value']) : 'I will run digital ads on Facebook and Instagram to hundreds of local buyers looking for a home just like yours';
	            ?>
	            <li><?php echo $para_1_point_2_title; ?></li>
	            <?php
	                $para_1_point_3_title = isset($report_content_data['para_1_point_3_title']['value']) && !empty($report_content_data['para_1_point_3_title']['value']) ? nl2br($report_content_data['para_1_point_3_title']['value']) : 'Marketing reports that show the results of my ads of your house on social media and through email blasts';
	            ?>
	            <li><?php echo $para_1_point_3_title; ?></li>
	        </ul>
	        <img src="<?php echo base_url().'assets/reports/english/seller/images/14/mockup-1.jpg'; ?>" alt="<?php echo $para_1_title; ?>" class="web_design"> 
	    </div>
	    <div class="col-50">
	    	<?php
                $para_2_title = isset($report_content_data['paragraph_1_title']['value']) && !empty($report_content_data['paragraph_1_title']['value']) ? $report_content_data['paragraph_1_title']['value'] : 'Video Social Media Ads:';
            ?>
	        <h4 class="crimson"><?php echo $para_2_title; ?></h4>
	        <?php
                $para_2_content = isset($report_content_data['paragraph_2_content']['value']) && !empty($report_content_data['paragraph_2_content']['value']) ? nl2br($report_content_data['paragraph_2_content']['value']) : 'I will run beautiful, professionally produced videos ads on social media to get the attention of potential buyers. I offer you:';
            ?>
	        <p class="f14"><?php echo $para_2_content; ?></p>

	        <ul class="f14">
	        	<?php
	                $para_2_point_1_title = isset($report_content_data['para_2_point_1_title']['value']) && !empty($report_content_data['para_2_point_1_title']['value']) ? nl2br($report_content_data['para_2_point_1_title']['value']) : 'Professionally produced video ads run to hundreds of potential buyers on Facebook and Instagram';
	            ?>
	            <li><?php echo $para_2_point_1_title; ?></li>
	            <?php
	                $para_2_point_2_title = isset($report_content_data['para_2_point_2_title']['value']) && !empty($report_content_data['para_2_point_2_title']['value']) ? nl2br($report_content_data['para_2_point_2_title']['value']) : 'I can run ads for all stages of the listing (Just Listed, Open Houses, Price Reduced, and Active Listing) this way your home is always in front of potential buyers with the latest information.';
	            ?>
	            <li><?php echo $para_2_point_2_title; ?></li>
	            <?php
	                $para_2_point_3_title = isset($report_content_data['para_2_point_3_title']['value']) && !empty($report_content_data['para_2_point_3_title']['value']) ? nl2br($report_content_data['para_2_point_3_title']['value']) : 'As the ads run I will deliver an impressive seller report that continually updates with up to the minute results';
	            ?>
	            <li><?php echo $para_2_point_3_title; ?></li>
	        </ul>
	        <img src="<?php echo base_url().'assets/reports/english/seller/images/14/mock-up-2.jpg'; ?>" alt="<?php echo $para_2_title; ?>" class="w100">
	    </div>
	</div>
	</page>