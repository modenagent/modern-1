<div class="container">
	<div class="section page5">
	
		<header>
			<h2 class="underline title-bold">
			<?php 
			if (isset($report_content_data['title']['value']) && !empty($report_content_data['title']['value'])) {
				echo $report_content_data['title']['value'];
			} else {
				echo 'Pricing Correctly';
			}
			?>
			</h2>
			<p>
			<?php 
			if (isset($report_content_data['sub_title']['value']) && !empty($report_content_data['sub_title']['value'])) {
				echo $report_content_data['sub_title']['value'];
			} else {
				echo 'Selling faster by setting the right price';
			}
			?>
			</p>
		</header>

        <div class="row">

          <div class="col-xs-12">
          
          <p class="most-buyers2"> 
			<?php 
			if (isset($report_content_data['content']['value']) && !empty($report_content_data['content']['value'])) {
				echo nl2br($report_content_data['content']['value']);
			} else {
				echo "At any given time, there are plenty of buyers in the market looking for newly listed properties. As your agent, I want to make sure to help you attract as many buyers as possible. One thing that can hinder this is setting the price too high. The key to getting your home sold as quickly as possible is to price it correctly from day 1. Many sellers have the tendency to want to list their home at a higher sales price than advised because they hope to increase their profit or they assume that buyers always make low offers so it's good to start high.";
			}
			?>
          </p>

        </div>

        <div class="col-xs-12">
         
            <div class="dollar">       

         <img class="img-responsive" src="<?php echo base_url("assets/reports/english/seller/images/5/Princing.png")?>" alt=""/>

          </div>

      </div>

    </div>

<!-- marketing content top start  -->

    <div class="market-content-top">
      
    <div class="row">
    
     <div class="col-xs-6">
       
		<h4 class="home" style="color:<?php echo $theme ?>;">
		<?php 
		if (isset($report_content_data['paragraph_1_title']['value']) && !empty($report_content_data['paragraph_1_title']['value'])) {
			echo $report_content_data['paragraph_1_title']['value'];
		} else {
			echo '1. On Market Longer';
		}
		?>
		</h4>
       
		<p class="valuable2"> 
        <?php 
		if (isset($report_content_data['paragraph_1_content']['value']) && !empty($report_content_data['paragraph_1_content']['value'])) {
			echo nl2br($report_content_data['paragraph_1_content']['value']);
		} else {
			echo 'Properties that are over priced tend to stay on <br> the market significantly longer than <br> those that are priced to sell.';
		}
		?>
		</p>


     </div>


     <div class="col-xs-6">
        
		<h4 class="home" style="color:<?php echo $theme ?>;">
		<?php 
		if (isset($report_content_data['paragraph_3_title']['value']) && !empty($report_content_data['paragraph_3_title']['value'])) {
			echo $report_content_data['paragraph_3_title']['value'];
		} else {
			echo '3. Lost Time';
		}
		?>
		</h4>   
     
		<p class="valuable2"> 
		<?php 
		if (isset($report_content_data['paragraph_3_content']['value']) && !empty($report_content_data['paragraph_3_content']['value'])) {
			echo nl2br($report_content_data['paragraph_3_content']['value']);
		} else {
			echo 'Time lost in waiting for an offer can be time <br> spent accepting offers, conducting <br> inspections & opening escrow.';
		}
		?>
		</p>
      
     </div>

    </div>

    <div class="row">
      
     <div class="col-xs-6">
       
		<h4 class="home" style="color:<?php echo $theme ?>;">
		<?php 
		if (isset($report_content_data['paragraph_2_title']['value']) && !empty($report_content_data['paragraph_2_title']['value'])) {
			echo $report_content_data['paragraph_2_title']['value'];
		} else {
			echo '2. Price Reduction';
		}
		?>
		</h4>
       
		<p class="valuable2"> 
        <?php 
		if (isset($report_content_data['paragraph_2_content']['value']) && !empty($report_content_data['paragraph_2_content']['value'])) {
			echo nl2br($report_content_data['paragraph_2_content']['value']);
		} else {
			echo 'Time lost in waiting for an offer can be time <br> spent accepting offers, conducting <br>inspections & opening escrow.';
		}
		?>
		</p>


     </div>


     <div class="col-xs-6">
        
		<h4 class="home" style="color:<?php echo $theme ?>;">
		<?php 
		if (isset($report_content_data['paragraph_4_title']['value']) && !empty($report_content_data['paragraph_4_title']['value'])) {
			echo $report_content_data['paragraph_4_title']['value'];
		} else {
			echo '4. Stigma Developed';
		}
		?>
		</h4>   
     
		<p class="valuable2"> 
		<?php 
		if (isset($report_content_data['paragraph_4_content']['value']) && !empty($report_content_data['paragraph_4_content']['value'])) {
			echo nl2br($report_content_data['paragraph_4_content']['value']);
		} else {
			echo "As buyers see the property advertised over <br> and over again, they will start wondering if <br> there's something wrong with it.";
		}
		?>
		</p>
      
     </div>

    </div>

<!-- marketing content top end -->
  </div>



		<div class="table-wrapper">

	</div>

</div>
</div>
