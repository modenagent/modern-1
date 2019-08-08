<div class="container">
	<div class="section page5 average-days">
	
		<header>
			<h2 class="underline title-bold">
			<?php 
			if (isset($report_content_data['title']['value']) && !empty($report_content_data['title']['value'])) {
				echo $report_content_data['title']['value'];
			} else {
				echo 'Promedio de días en el mercado';
			}
			?>
			</h2>
			<p>
			<?php 
			if (isset($report_content_data['sub_title']['value']) && !empty($report_content_data['sub_title']['value'])) {
				echo $report_content_data['sub_title']['value'];
			} else {
				echo '¿CUÁNTO TARDARÁ EN VENDER SU CASA?';
			}
			?>
			</p>
		</header>

        <div class="row">

          <div class="col-xs-4">
            
            <div class="avg-text-box">

            <p class="text-uppercase text-left avg-text">
			<?php 
			if (isset($report_content_data['average_days_text']['value']) && !empty($report_content_data['average_days_text']['value'])) {
				echo $report_content_data['average_days_text']['value'];
			} else {
				echo 'Avg. Days On Market';
			}
			?>
			</p>  
             
             
             <div style="background-color:<?php echo $theme ?>;" class="avg-box">
             
              <div class="thirty-five"> 

				<h1 class="thirty-five-text"> 
				<?php 
				if (isset($report_content_data['average_days']['value']) && !empty($report_content_data['average_days']['value'])) {
					echo $report_content_data['average_days']['value'];
				} else {
					echo '35';
				}
				?>
				</h1>
               
               </div>
            </div>

            </div>

            
    
          </div>

          <div class="col-xs-8">
          
			<p class="most-buyers3"> 
			<?php 
			if (isset($report_content_data['content']['value']) && !empty($report_content_data['content']['value'])) {
				echo nl2br($report_content_data['content']['value']);
			} else {
				echo "Days on market has a direct correlation with a buyers interest level in your property. Depending on the <br> geographic area of your home the number of days that your home is on the market can vary. Currently the market is in an upswing and the shortage of inventory is leading to homes flying off the market
				<br><br>
				There are a few factors that come into play when attempting to determine how long it will take these factors are";
			}
			?>
			</p>

        </div>

    </div>

<!-- marketing content top start  -->

    <div class="market-content-top2">
      
    <div class="row">
    
     <div class="col-xs-6">
       
		<h4 class="home">
		<?php 
		if (isset($report_content_data['paragraph_1_title']['value']) && !empty($report_content_data['paragraph_1_title']['value'])) {
			echo $report_content_data['paragraph_1_title']['value'];
		} else {
			echo 'Market';
		}
		?>
		</h4>
       
		<p class="valuable2"> 
        <?php 
		if (isset($report_content_data['paragraph_1_content']['value']) && !empty($report_content_data['paragraph_1_content']['value'])) {
			echo nl2br($report_content_data['paragraph_1_content']['value']);
		} else {
			echo 'Can be a geographic location or type of  housing. So if a certain eclectic  neighborhood is deemed desirable that create demand which will lead to homes being sold quickly.';
		}
		?>
		</p>


     </div>


     <div class="col-xs-6">
        
		<h4 class="home">
		<?php 
		if (isset($report_content_data['paragraph_2_title']['value']) && !empty($report_content_data['paragraph_2_title']['value'])) {
			echo $report_content_data['paragraph_2_title']['value'];
		} else {
			echo 'Season';
		}
		?>
		</h4>   
     
		<p class="valuable2"> 
		<?php 
		if (isset($report_content_data['paragraph_2_content']['value']) && !empty($report_content_data['paragraph_2_content']['value'])) {
			echo nl2br($report_content_data['paragraph_2_content']['value']);
		} else {
			echo 'When someone is looking to pack up and move they typically would do so in good weather. So if your home is listed during the winter or the rainy season this may add to days on market.';
		}
		?>
		</p>
      
     </div>

    </div>

    <div class="row">
      
     <div class="col-xs-6">
        
      <div class="col-xs-1"> 
      
      <div class="market-small-box" style="background:<?php echo $theme ?>;;">
        
      </div>

      <div class="market-small-box2" style="background:<?php echo $theme ?>;;">
        
      </div>
     
      </div> 

      <div class="col-xs-11"> 

		<h4 class="home market-left">
		<?php 
		if (isset($report_content_data['point_1']['value']) && !empty($report_content_data['point_1']['value'])) {
			echo $report_content_data['point_1']['value'];
		} else {
			echo 'DAYS ON MARKET';
		}
		?>
		</h4>

		<h4 class="home interest-top">
		<?php 
		if (isset($report_content_data['point_2']['value']) && !empty($report_content_data['point_2']['value'])) {
			echo $report_content_data['point_2']['value'];
		} else {
			echo 'BUYER INTEREST';
		}
		?>
		</h4> 


      </div>  
     
          
     </div>


     <div class="col-xs-6">
        
		<h4 class="home">
		<?php 
		if (isset($report_content_data['paragraph_3_title']['value']) && !empty($report_content_data['paragraph_3_title']['value'])) {
			echo $report_content_data['paragraph_3_title']['value'];
		} else {
			echo 'Economy';
		}
		?>
		</h4>   
     
		<p class="valuable2"> 
		<?php 
		if (isset($report_content_data['paragraph_3_content']['value']) && !empty($report_content_data['paragraph_3_content']['value'])) {
			echo nl2br($report_content_data['paragraph_3_content']['value']);
		} else {
			echo 'When interest rates are low the typical median home price tends to rise. During this time motivated buyers take less time to commit to a home which leads to less time on market and quicker sales.';
		}
		?>
		</p>
      
     </div>

    </div>

    <div class="row">

     <div class="col-xs-12">
      
      <div class="graph-content"> 
       
       <div class="inner-content-graph theme-bg">

       
         <img class="img-responsive" src="<?php echo base_url("assets/reports/spanish/seller/images/5/Average.png")?>" alt=""/>

       </div>

       </div>

     </div>
     
    </div>

<!-- marketing content top end -->
  </div>



		<div class="table-wrapper">

	</div>

</div>
</div>
