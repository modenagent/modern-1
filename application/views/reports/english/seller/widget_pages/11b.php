<div class="container no-padding">
	<div class="section page11">
	
		<header>
			<h2 class="underline title-bold">
			<?php 
			if (isset($report_content_data['title']['value']) && !empty($report_content_data['title']['value'])) {
				echo $report_content_data['title']['value'];
			} else {
				echo 'A Promise to my Clients';
			}
			?>
			</h2>
			<p>
			<?php 
			if (isset($report_content_data['sub_title']['value']) && !empty($report_content_data['sub_title']['value'])) {
				echo $report_content_data['sub_title']['value'];
			} else {
				echo 'My duties to you';
			}
			?>
			</p>
		</header>

		<p class="page-tagline">
		<?php 
		if (isset($report_content_data['content']['value']) && !empty($report_content_data['content']['value'])) {
			echo nl2br($report_content_data['content']['value']);
		} else {
			echo "As your real estate agent, in addition to any duties or commitments set forth in our listing agreement, my fiduciary duties to you include but are not limited to:";
		}
		?>
		</p>

        <ol class="vesting">
                <h3 class="vesting-title">
				<?php 
				if (isset($report_content_data['point_1_title']['value']) && !empty($report_content_data['point_1_title']['value'])) {
					echo $report_content_data['point_1_title']['value'];
				} else {
					echo 'Loyalty';
				}
				?>
				</h3>
                <li>
				<?php 
				if (isset($report_content_data['point_1_content']['value']) && !empty($report_content_data['point_1_content']['value'])) {
					echo nl2br($report_content_data['point_1_content']['value']);
				} else {
					echo 'Loyalty is my first and foremost duty to you.  This means that I must act with your best interest in mind, to the exclusion of all other interests including my own.';
				}
				?>
				</li>

        </ol>



        <ol class="vesting">
                <h3 class="vesting-title">
				<?php 
				if (isset($report_content_data['point_2_title']['value']) && !empty($report_content_data['point_2_title']['value'])) {
					echo $report_content_data['point_2_title']['value'];
				} else {
					echo 'Confidentiality';
				}
				?>
				</h3>
                <li>
				<?php 
				if (isset($report_content_data['point_2_content']['value']) && !empty($report_content_data['point_2_content']['value'])) {
					echo nl2br($report_content_data['point_2_content']['value']);
				} else {
					echo 'As your agent I am obligated to safeguard your confidence and secrets. I therefore, must keep confidential any information that might weaken your bargaining position if it were revealed.';
				}
				?>
				</li>

        </ol>



        <ol class="vesting">
                <h3 class="vesting-title">
				<?php 
				if (isset($report_content_data['point_3_title']['value']) && !empty($report_content_data['point_3_title']['value'])) {
					echo $report_content_data['point_3_title']['value'];
				} else {
					echo 'Disclosure';
				}
				?>
				</h3>
                <li>
				<?php 
				if (isset($report_content_data['point_3_content']['value']) && !empty($report_content_data['point_3_content']['value'])) {
					echo nl2br($report_content_data['point_3_content']['value']);
				} else {
					echo 'As your agent, I am responsible to disclose to you, all relevant and material information that I know might affect your ability to obtain the highest price and best terms in the sale of your property.';
				}
				?>
				</li>

        </ol>


		 <ol class="vesting">
                <h3 class="vesting-title">
				<?php 
				if (isset($report_content_data['point_4_title']['value']) && !empty($report_content_data['point_4_title']['value'])) {
					echo $report_content_data['point_4_title']['value'];
				} else {
					echo 'Obedience';
				}
				?>
				</h3>
                <li>
				<?php 
				if (isset($report_content_data['point_4_content']['value']) && !empty($report_content_data['point_4_content']['value'])) {
					echo nl2br($report_content_data['point_4_content']['value']);
				} else {
					echo 'As your agent, I am bound to obey promptly and efficiently all lawful instructions that you give me pertaining to the sale of your property.';
				}
				?>
				</li>

        </ol>


		<ol class="vesting">
                <h3 class="vesting-title">
				<?php 
				if (isset($report_content_data['point_5_title']['value']) && !empty($report_content_data['point_5_title']['value'])) {
					echo $report_content_data['point_5_title']['value'];
				} else {
					echo 'Reasonable care and diligence';
				}
				?>
				</h3>
                <li>
				<?php 
				if (isset($report_content_data['point_5_content']['value']) && !empty($report_content_data['point_5_content']['value'])) {
					echo nl2br($report_content_data['point_5_content']['value']);
				} else {
					echo 'To assist you in your real estate transaction, the standard of care expected of me, by you, should be that of a competent real estate professional.';
				}
				?>
				</li>

        </ol>


		 <ol class="vesting">
                <h3 class="vesting-title">
				<?php 
				if (isset($report_content_data['point_6_title']['value']) && !empty($report_content_data['point_6_title']['value'])) {
					echo $report_content_data['point_6_title']['value'];
				} else {
					echo 'Accounting';
				}
				?>
				</h3>
                <li>
				<?php 
				if (isset($report_content_data['point_6_content']['value']) && !empty($report_content_data['point_6_content']['value'])) {
					echo nl2br($report_content_data['point_6_content']['value']);
				} else {
					echo 'As your realtor, I am bound to safeguard any money, deeds, or other documents you entrust to me, related to your real estate transaction.';
				}
				?>
				</li>

        </ol>


		

	</div>

	
</div>
