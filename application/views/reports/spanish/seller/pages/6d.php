<div class="container">
	<div class="section page7">
	
		<header>
			<h2 class="underline title-bold">
			<?php 
			if (isset($report_content_data['title']['value']) && !empty($report_content_data['title']['value'])) {
				echo $report_content_data['title']['value'];
			} else {
				echo 'Colaterales impresos';
			}
			?>
			</h2>
			<p>
			<?php 
			if (isset($report_content_data['sub_title']['value']) && !empty($report_content_data['sub_title']['value'])) {
				echo $report_content_data['sub_title']['value'];
			} else {
				echo 'Vendiendo tu propiedad';
			}
			?>
			</p>
		</header>

		<div class="row">
			<div class="two-grid-wrapper">
				<div class="col-xs-6">
					<div class="left-grid">
						<div class="text-block-condensed">
							<h2>
							<?php 
							if (isset($report_content_data['paragraph_1_title']['value']) && !empty($report_content_data['paragraph_1_title']['value'])) {
								echo $report_content_data['paragraph_1_title']['value'];
							} else {
								echo 'Tarjetas de Recién Puesto';
							}
							?>
							</h2>
							<p>
							<?php 
							if (isset($report_content_data['paragraph_1_content']['value']) && !empty($report_content_data['paragraph_1_content']['value'])) {
								echo nl2br($report_content_data['paragraph_1_content']['value']);
							} else {
								echo 'Prepararemos tarjetas de Recién Puesto en Venta que vamos a utilizar para dejar que las viviendas vecinas sepan que tu casa está en el mercado. Este es un gran recurso para generar compradores, ya que muchas personas suelen tener amigos o familiares que podrían querer mudarse al vecindario para estar cera. Una postal diseñada, volantes, anuncios colgables en la puerta contendrán detalles e información de precios. Responderemos a todas las preguntas de las partes interesadas.';
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
								echo 'Volantes de Recién Puesto en Venta';
							}
							?>
							</h2>
							<p>
							<?php 
							if (isset($report_content_data['paragraph_2_content']['value']) && !empty($report_content_data['paragraph_2_content']['value'])) {
								echo nl2br($report_content_data['paragraph_2_content']['value']);
							} else {
								echo 'Prepararemos folletos o volantes que podemos pegar en las puertas o pizarras de anuncios de  negocios cercanos, oficinas de bienes raíces, oficinas de escrow y otros dentro de la industria de bienes raíces. Esta iniciativa nos ayudará a obtener una exposición adicional de la propiedad y mayores consultas de compradores potenciales.';
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
								echo 'Letreros';
							}
							?>
							</h2>
							<p>
							<?php 
							if (isset($report_content_data['paragraph_3_content']['value']) && !empty($report_content_data['paragraph_3_content']['value'])) {
								echo nl2br($report_content_data['paragraph_3_content']['value']);
							} else {
								echo 'Tendremos anuncios colgables de puerta listo para su uso en los días que estaremos mostrando la propiedad. Esta es una gran manera de dejarles saber a los vecinos cercanos que pueden ver la propiedad por sí mismos.';
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
								echo 'Signos C-T-A (Llamada a Acción)';
							}
							?>
							</h2>
							<p>
							<?php 
							if (isset($report_content_data['paragraph_4_content']['value']) && !empty($report_content_data['paragraph_4_content']['value'])) {
								echo nl2br($report_content_data['paragraph_4_content']['value']);
							} else {
								echo 'Los signos CTA se colocarán en el cartel principal delante de tu propiedad. Este signo contendrá un código que la gente puede enviar al instante para recibir información sobre tu propiedad.<br><br>Además, haremos un seguimiento diligente con todos los leads o clientes potenciales que surjan por estas iniciativas.';
							}
							?>
							</p>
						</div>
						
					</div>
				</div>
				<div class="col-xs-6">
					<div class="right-grid">
						<img width="100%" class="img-responsive" src="<?php echo base_url("assets/reports/spanish/seller/images/6c/6c2.jpg")?>" alt="">
					</div>
				</div>
		</div> <!-- .two-grid-wrapper -->


	</div>
    </div>
</div>
