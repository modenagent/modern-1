

<!--4 box-->
<div class="main-four-div-container2 bg-white container">
	<div class="" style="padding:5% 5% 0 5%;">
     
      <header>
            <h2 class="underline underline-white title-bold white-c">
			<?php 
			if (isset($report_content_data['title']['value']) && !empty($report_content_data['title']['value'])) {
				echo $report_content_data['title']['value'];
			} else {
				echo 'Typical Transaction';
			}
			?>
			</h2>
            <p class="text-uppercase expect">
			<?php 
			if (isset($report_content_data['sub_title']['value']) && !empty($report_content_data['sub_title']['value'])) {
				echo $report_content_data['sub_title']['value'];
			} else {
				echo 'What you should expect moving forward.';
			}
			?>
			</p>
    </header>


		<div class="img-box" style="padding-top:5%;">
			
           <img class="img-responsive" src="<?php echo base_url("assets/reports/spanish/seller/images/9/typical.png")?>" alt=""/>
		
		</div>

	</div>
</div>
