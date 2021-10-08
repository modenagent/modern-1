<div class="container">
	<div class="section page6">
	
			<img width="100%" class="img-responsive" src="<?php echo base_url("assets/reports/english/buyer/images/6/bg3.jpg")?>" alt="">
                        <div class="page6-content">
                            <header>
                                <h2 class="underline title-bold">Neighborhood Stats</h2>
                                <p>A Little Insight</p>
                            </header>
                            <div class="row">
					<div class="insights">
						<div class="col-xs-6">
							<div class="left-insight">
								<img  class="img-responsive theme-bg" src="<?php echo base_url("assets/reports/english/buyer/images/6/gender.png")?>" alt="">
								
								<div class="text-content">
									<h2>Male To Female Ratio</h2>
									<p>These figures represent the male to female ratio in your neighborhood. The housing census is taken every 10 years so depending on the time of this report these figures can be slightly different.
								</p>
								</div>
							</div>
						</div>
						<div class="col-xs-6">
							<div class="right-insight">
								<div class="gender-block">
									<p class="gender">FEMALE</p>
									<h1 class="perc"><?php echo $female_ratio ?></h1>
								</div>
							</div>
							<div class="right-insight">
								<div class="gender-block">
									<p class="gender">MALE</p>
									<h1 class="perc"><?php echo $male_ratio ?></h1>
								</div>
							

								<div class="text-content">
										<h2>Avg. Household Income</h2>
										<p>
											The figure to the right represents the average household income within your perspective neighborhood. This information is gathered from the household census that is taken every 10 years.
                                                                                </p>
                                                                                <p style="color: <?php echo $theme ?>; font-size:70px;font-family: 'MontserratBold';">$<?php echo $household_income ?>k</p>
								</div>
							</div>   <!-- .right-insight  -->
						</div> <!-- .col-xs-6 -->
					</div> <!-- .insights -->
				</div> <!-- .row -->
			
				
				<ul class="features">
					<li>
                                            <img  class="img-responsive" style="padding-left:35px;" src="<?php echo base_url("assets/reports/english/buyer/images/6/home.png")?>" alt="">
						<p>Avg. Sale Price <br > $<?php echo (string)$property->ComparableSalesReport->AreaSalesAnalysisInfo->MedianValue; ?></p>
					</li>
					<li>
						<img  class="img-responsive" style="padding-left:35px;" src="<?php echo base_url("assets/reports/english/buyer/images/6/sqr_feet.png")?>" alt="">
						<p>Avg. Sqft <br >  <?php echo (string)$property->ComparableSalesReport->AreaSalesAnalysisInfo->MedianLivingArea; ?></p>
					</li>
					<li>
						<img  class="img-responsive" style="padding-left:30px;" src="<?php echo base_url("assets/reports/english/buyer/images/6/bed.png")?>" alt="">
						<p>Avg. Beds <br > <?php echo (string)$property->ComparableSalesReport->AreaSalesAnalysisInfo->MedianNumBeds; ?> Beds</p>
					</li>
					<li>
						<img  class="img-responsive"  style="padding-left:30px;" src="<?php echo base_url("assets/reports/english/buyer/images/6/cup.png")?>" alt="">
						<p>Avg. Baths <br > <?php echo (string)$property->ComparableSalesReport->AreaSalesAnalysisInfo->MedianNumBaths; ?> Baths</p>
					</li>
				</ul>
                        </div>
			<div class="page-content">

			</div> <!-- .page-content -->

	</div> <!-- .page6 -->

<!--	<div class="seperator"></div>-->
</div>