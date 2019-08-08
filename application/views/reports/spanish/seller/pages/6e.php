<div class="container">
	<div class="section page7">
	
		<header>
			<h2 class="underline title-bold">
			<?php 
			if (isset($report_content_data['title']['value']) && !empty($report_content_data['title']['value'])) {
				echo $report_content_data['title']['value'];
			} else {
				echo 'Redes Sociales y Networking';
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
								echo 'Mercadeo por Email';
							}
							?>
							</h2>
							<p>
							<?php 
							if (isset($report_content_data['paragraph_1_content']['value']) && !empty($report_content_data['paragraph_1_content']['value'])) {
								echo nl2br($report_content_data['paragraph_1_content']['value']);
							} else {
								echo 'Tenemos una amplia red de correos electrónicos que consta de clientes pasados, compradores potenciales, otros agentes de bienes raíces, y corredores que aprovecharemos para que tu propiedad obtenga la máxima exposición. Comenzaremos con una campaña de Anuncio Recién Puesto en Venta y proseguiremos con campañas subsecuentes que muestren tu propiedad a los compradores potenciales.';
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
								echo 'Mercadeo en las Redes Sociales';
							}
							?>
							</h2>
							<p>
							<?php 
							if (isset($report_content_data['paragraph_2_content']['value']) && !empty($report_content_data['paragraph_2_content']['value'])) {
								echo nl2br($report_content_data['paragraph_2_content']['value']);
							} else {
								echo 'Aprovecharemos Facebook, Instagram, LinkedIn y Twitter para aumentar la conciencia de existencia de tu propiedad. Estos sitios de redes sociales tienen una base de usuarios combinados de más de 1,300 millones de usuarios de todo el mundo. A nivel local los números son mucho más reducidos, pero son altos en relación con el tamaño de tu vecindario. Queremos maximizar la exposición de la propiedad mediante la colocación de imágenes optimizadas junto con videos para ayudar a que los posibles compradores obtengan una mirada más cercana de tu propiedad.';
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
								echo 'Puertas Abiertas y Demostraciones';
							}
							?>
							</h2>
							<p>
							<?php 
							if (isset($report_content_data['paragraph_3_content']['value']) && !empty($report_content_data['paragraph_3_content']['value'])) {
								echo nl2br($report_content_data['paragraph_3_content']['value']);
							} else {
								echo 'Dependiendo de tu disponibilidad y voluntad, programaremos vistas abiertas y privadas de tu propiedad. Los eventos de puertas abiertas son una gran manera de mostrar tu propiedad, así como generar posibles clientes potenciales.';
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
								echo 'Networking de Corredor a Corredor';
							}
							?>
							</h2>
							<p>
							<?php 
							if (isset($report_content_data['paragraph_4_content']['value']) && !empty($report_content_data['paragraph_4_content']['value'])) {
								echo nl2br($report_content_data['paragraph_4_content']['value']);
							} else {
								echo 'Los brókers hacen networking con otros brókers para encontrar viviendas que coincidan con los criterios de sus clientes. Contactaremos a toda nuestra red de corredores y agentes de bienes raíces para ver si tu propiedad podría interesarles a uno de sus compradores potenciales.';
							}
							?>
							</p>
						</div>
						
					</div>
				</div>
				<div class="col-xs-6">
					<div class="right-grid">
						<img width="100%" class="img-responsive" src="<?php echo base_url("assets/reports/spanish/seller/images/6e/6e2.jpg")?>" alt="">
					</div>
				</div>
		</div> <!-- .two-grid-wrapper -->


	</div>

	
    </div>
</div>
