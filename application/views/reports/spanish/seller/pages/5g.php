<div class="container">
	<div class="section page5">
	
		<header>
			<h2 class="underline title-bold">
			<?php 
			if (isset($report_content_data['title']['value']) && !empty($report_content_data['title']['value'])) {
				echo $report_content_data['title']['value'];
			} else {
				echo 'EL PRECIO CORRECTO';
			}
			?>
			</h2>
			<p>
			<?php 
			if (isset($report_content_data['sub_title']['value']) && !empty($report_content_data['sub_title']['value'])) {
				echo $report_content_data['sub_title']['value'];
			} else {
				echo 'Vende más rápido al colocar el precio correcto';
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
				echo "En cualquier momento dado, hay muchos compradores en el mercado en busca de propiedades recién publicadas. Como tu agente quiero asegurarme de que atraigas a tantos compradores como sea posible. Una cosa que puede obstaculizar esto es fijar un precio demasiado alto. La clave para conseguir vender su casa lo más rápido posible es fijar el precio correctamente desde el día 1. Muchos vendedores tienen la tendencia de publicar su casa a un precio de venta más alto de lo aconsejado, bien porque esperan aumentar sus ganancias o porque asumen que los compradores hacen ofertas a un precio más bajo, por eso les parece bien comenzar con una oferta elevada";
			}
			?>
			</p>

        </div>

        <div class="col-xs-12">
         
            <div class="dollar">       

         <img class="img-responsive" src="<?php echo base_url("assets/reports/spanish/seller/images/5/Princing.png")?>" alt=""/>

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
			echo '1. MAYOR TIEMPO';
		}
		?>
		</h4>
       
		<p class="valuable2"> 
        <?php 
		if (isset($report_content_data['paragraph_1_content']['value']) && !empty($report_content_data['paragraph_1_content']['value'])) {
			echo nl2br($report_content_data['paragraph_1_content']['value']);
		} else {
			echo 'Las propiedades que se ofrecen caras tienden a permanecer en el mercado mucho más tiempo que aquellos que tienen un precio de venta adecuado.';
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
			echo '3. TIEMPO PERDIDO';
		}
		?>
		</h4>   
     
		<p class="valuable2"> 
		<?php 
		if (isset($report_content_data['paragraph_3_content']['value']) && !empty($report_content_data['paragraph_3_content']['value'])) {
			echo nl2br($report_content_data['paragraph_3_content']['value']);
		} else {
			echo 'El tiempo perdido a la espera de una oferta puede ser tiempo dedicado a aceptar ofertas, realizar inspecciones y abrir depósitos escrow.';
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
			echo '2. REDUCCIÓN DE PRECIO';
		}
		?>
		</h4>
       
		<p class="valuable2"> 
        <?php 
		if (isset($report_content_data['paragraph_2_content']['value']) && !empty($report_content_data['paragraph_2_content']['value'])) {
			echo nl2br($report_content_data['paragraph_2_content']['value']);
		} else {
			echo 'Las propiedades sobrevaloradas con toda seguridad, necesitarán al menos 1 reducción de precio para lograr nuevo interés.';
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
			echo '4. DESARROLLO DE ESTIGMA';
		}
		?>
		</h4>   
     
		<p class="valuable2"> 
		<?php 
		if (isset($report_content_data['paragraph_4_content']['value']) && !empty($report_content_data['paragraph_4_content']['value'])) {
			echo nl2br($report_content_data['paragraph_4_content']['value']);
		} else {
			echo "A medida que los compradores ven la propiedad anunciada una y otra vez, van a empezar a preguntarse si tendrá algún problema.";
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
