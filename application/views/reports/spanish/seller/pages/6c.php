<div class="container">
	<div class="section page7">
	
		<header>
			<h2 class="underline title-bold">
			<?php 
			if (isset($report_content_data['title']['value']) && !empty($report_content_data['title']['value'])) {
				echo $report_content_data['title']['value'];
			} else {
				echo 'Imágenes y mercadeo en línea';
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
								echo 'Imágenes';
							}
							?>
							</h2>
							<p>
							<?php 
							if (isset($report_content_data['paragraph_1_content']['value']) && !empty($report_content_data['paragraph_1_content']['value'])) {
								echo nl2br($report_content_data['paragraph_1_content']['value']);
							} else {
								echo '¿Sabías que los anuncios con fotos profesionales se venden mejor? No sólo eso, sino que se venden más rápido. Desde el que 92% de los compradores hacen sus compras en línea, es más evidente que nunca la importancia de buenas fotos. Vamos a incorporar fotos optimizadas que mostrarán tu casa lo mejor posible. Esto atraerá más clientes potenciales en un período más corto de tiempo.';
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
								echo 'Servicios MLS (Múltiples Anuncios) y Más';
							}
							?>
							</h2>
							<p>
							<?php 
							if (isset($report_content_data['paragraph_2_content']['value']) && !empty($report_content_data['paragraph_2_content']['value'])) {
								echo nl2br($report_content_data['paragraph_2_content']['value']);
							} else {
								echo 'El Servicio MLS, que es un acrónimo en inglés para el servicio de listado múltiple, la red preferida utilizada por los agentes inmobiliarios para publicar listados de bienes raíces disponibles en línea. Este es el primer lugar donde vamos a anunciar tu vivienda porque los corredores de bienes raíces que están trabajando con compradores pre-aprobados serán notificados de primero. El anuncio incluirá fotos mejoradas, detalles de propiedad y precio de venta.';
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
								echo 'Sindicación';
							}
							?>
							</h2>
							<p>
							<?php 
							if (isset($report_content_data['paragraph_3_content']['value']) && !empty($report_content_data['paragraph_3_content']['value'])) {
								echo nl2br($report_content_data['paragraph_3_content']['value']);
							} else {
								echo 'El Servicio MLS ahora ofrece sus listados de bienes raíces a miles de sitios web individuales, incluyendo los 4 sitios web más grandes de bienes raíces que son: Trulia, Redfin, Zillow & Realtor.com. Sólo estos sitios reciben alrededor de 120 millones de visitantes cada mes. Esto seguramente nos ayudará a lograr que tu propiedad tenga la exposición necesaria para que se venda rápidamente.';
							}
							?>
							</p>
						</div>
						
					</div>
				</div>
				<div class="col-xs-6">
					<div class="right-grid">
						<img width="100%" class="img-responsive" src="<?php echo base_url("assets/reports/spanish/seller/images/6c/6c3.jpg")?>" alt="">
					</div>
				</div>
		</div> <!-- .two-grid-wrapper -->


	</div>

	
    </div>
</div>
