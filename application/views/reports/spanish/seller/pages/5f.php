<div class="container">
	<div class="section page5">
	
		<header>
			<h2 class="underline title-bold">
			<?php 
			if (isset($report_content_data['title']['value']) && !empty($report_content_data['title']['value'])) {
				echo $report_content_data['title']['value'];
			} else {
				echo 'CÓMO LOS COMPRADORES ENCUENTRAN UNA PROPIEDAD';
			}
			?>
			</h2>
			<p>
			<?php 
			if (isset($report_content_data['sub_title']['value']) && !empty($report_content_data['sub_title']['value'])) {
				echo $report_content_data['sub_title']['value'];
			} else {
				echo 'Los lugares que más buscan';
			}
			?>
			</p>
		</header>

        <div class="row">

          <div class="col-xs-12">
            
          <h3 class="text-uppercase">
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
				echo 'La mayoría de los compradores comienzan su búsqueda en línea, ya sea en casa, en sus momentos de descanso en el trabajo, pero mucho más a menudo en su dispositivo móvil. Dado que más del 80% de los compradores comienzan su búsqueda de propiedades en línea, están tomando al mismo tiempo la oportunidad de educarse en el proceso de compra. Así que el comprador de hoy está más informado que nunca, pero todavía dependen de un agente inmobiliario para guiarlos a través de la transacción. El comprador de una casa típicamente se toma aproximadamente 3 meses para comprarla, lo que significa que han estado buscando durante 2 meses antes de que decidir vender tu casa';
			}
			?>
          </p>

        </div>

        <div class="col-xs-12">
         
            <div class="pi-chart-bg">   

            <div class="inner-pichart">     

         <img class="img-responsive theme-bg" src="<?php echo base_url("assets/reports/spanish/seller/images/5/pi.png")?>" alt=""/>

           </div>

          </div>

      </div>

    </div>

    <div class="row">

      <div class="home-top">
        
      
     <div class="col-xs-6">
       
     <h4 class="home">
		<?php 
		if (isset($report_content_data['paragraph_2_title']['value']) && !empty($report_content_data['paragraph_2_title']['value'])) {
			echo $report_content_data['paragraph_2_title']['value'];
		} else {
			echo 'Home Shoppers Rely on Agents <br> and Open Houses to Bring Their Online <br> Research Into the Real World';
		}
		?>
       </h4>
       
       <p class="valuable"> 
        <?php 
		if (isset($report_content_data['paragraph_2_content']['value']) && !empty($report_content_data['paragraph_2_content']['value'])) {
			echo nl2br($report_content_data['paragraph_2_content']['value']);
		} else {
			echo "With all this valuable data we are going to take advantage and
        are going to place your property where it's going to gain maximum
        exposure to prospective buyers.";
		}
		?>
       </p>


     </div>


     <div class="col-xs-6">
        
      <h4 class="home">
		<?php 
		if (isset($report_content_data['paragraph_3_title']['value']) && !empty($report_content_data['paragraph_3_title']['value'])) {
			echo $report_content_data['paragraph_3_title']['value'];
		} else {
			echo 'Compradores por Primera Vez Vs. Compradores Sucesivos';
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
