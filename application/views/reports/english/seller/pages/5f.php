<div class="container">
	<div class="section page5">
	
		<header>
			<h2 class="underline title-bold res-fs-h2">
			<?php 
			if (isset($report_content_data['title']['value']) && !empty($report_content_data['title']['value'])) {
				echo $report_content_data['title']['value'];
			} else {
				echo 'How Buyers Find a Home';
			}
			?>
			</h2>
			<p>
			<?php 
			if (isset($report_content_data['sub_title']['value']) && !empty($report_content_data['sub_title']['value'])) {
				echo $report_content_data['sub_title']['value'];
			} else {
				echo 'PLACES THEY LOOK';
			}
			?>
			</p>
		</header>

        <div class="row">

          <div class="col-xs-12">
            
          <h3 class="text-uppercase res-fs-h3">
			<?php 
			if (isset($report_content_data['paragraph_1_title']['value']) && !empty($report_content_data['paragraph_1_title']['value'])) {
				echo $report_content_data['paragraph_1_title']['value'];
			} else {
				echo 'how buyers find a home';
			}
			?>
		  </h3>    
          
          <p class="most-buyers"> 
			<?php 
			if (isset($report_content_data['paragraph_1_content']['value']) && !empty($report_content_data['paragraph_1_content']['value'])) {
				echo nl2br($report_content_data['paragraph_1_content']['value']);
			} else {
				echo 'Most buyers now begin their search online either at home, on their break at work, but more often than not, on their mobile device. Since more than 80% of buyers begin their home search online they are simultaneously taking the opportunity to educate themselves on the buying process. So todays buyer is now more informed than ever but will still rely on a realtor to guide them through the transaction. The typical home buyer takes about 3 months to purchase their home, which means they have been looking for 2 months before your decided to sell your home.';
			}
			?>
          </p>

        </div>

        <div class="col-xs-12">
         
            <div class="pi-chart-bg">   

            <div class="inner-pichart">     

         <img class="img-responsive theme-bg" src="<?php echo base_url("assets/reports/english/seller/images/5/pi.png")?>" alt=""/>

           </div>

          </div>

      </div>

    </div>

    <div class="row">

      <div class="home-top">
        
      
     <div class="col-xs-6 responsive-100">
       
		<h4 class="home">
		<?php 
		if (isset($report_content_data['paragraph_2_title']['value']) && !empty($report_content_data['paragraph_2_title']['value'])) {
			echo $report_content_data['paragraph_2_title']['value'];
		} else {
			echo 'Home Shoppers Rely on Agents <br> and Open Houses to Bring Their Online Research Into the <br> Real World';
		}
		?>
		</h4>
       
		<p class="valuable"> 
        <?php 
		if (isset($report_content_data['paragraph_2_content']['value']) && !empty($report_content_data['paragraph_2_content']['value'])) {
			echo nl2br($report_content_data['paragraph_2_content']['value']);
		} else {
			echo "With all this valuable data, we are going to take advantage, and
        going to place your property where it's going to gain maximum
        exposure to prospective buyers.";
		}
		?>
		</p>


     </div>


     <div class="col-xs-6 responsive-100">
        
      <h4 class="home">
		<?php 
		if (isset($report_content_data['paragraph_3_title']['value']) && !empty($report_content_data['paragraph_3_title']['value'])) {
			echo $report_content_data['paragraph_3_title']['value'];
		} else {
			echo 'First Time Vs. Repeat Buyers';
		}
		?>
	  </h4>   
     
      <p class="valuable"> 
		<?php 
		if (isset($report_content_data['paragraph_3_content']['value']) && !empty($report_content_data['paragraph_3_content']['value'])) {
			echo nl2br($report_content_data['paragraph_3_content']['value']);
		} else {
			echo 'First-time buyers: 38%
      <br> Avg. age of first-time buyers: 31
      <br> Avg. age of repeat buyers: 52
      <br> Avg. income of first-time buyers: $64,400
      <br> Avg. income of repeat buyers: $96,000';
		}
		?>
      </p>
      
     </div>

    </div>

		<div class="table-wrapper">

	</div>

  </div>
      

</div>

</div>
