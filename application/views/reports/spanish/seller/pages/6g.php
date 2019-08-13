<div class="container">
	<div class="section page7">
	
		<header>
			<h2 class="underline title-bold">
			<?php 
			if (isset($report_content_data['title']['value']) && !empty($report_content_data['title']['value'])) {
				echo $report_content_data['title']['value'];
			} else {
				echo 'Negociando ofertas';
			}
			?>
			</h2>
			<p>
			<?php 
			if (isset($report_content_data['sub_title']['value']) && !empty($report_content_data['sub_title']['value'])) {
				echo $report_content_data['sub_title']['value'];
			} else {
				echo 'Manteniendo las cosas según tus términos.';
			}
			?>
			</p>
		</header>

		<div class="row">
			<div class="two-grid-wrapper">
				<div class="col-xs-6">
					<div class="left-grid">
						<div class="text-block-condensed">
							
							<p class="perfect-world">
							<?php 
							if (isset($report_content_data['content']['value']) && !empty($report_content_data['content']['value'])) {
								echo nl2br($report_content_data['content']['value']);
							} else {
								echo "En un mundo perfecto, cada comprador y cada vendedor obtendría exactamente el acuerdo que quieren para su transacción de bienes raíces. En realidad, las mejores ofertas son aquellas en los que cada lado siente que tiene la mayor parte de lo que querían y no tuvieron que renunciar a mucho.
                                <br>
                                <br>
								La parte de negociación de una transacción de bienes raíces puede ser emocionante, frustrante y tediosa a la vez. Como vendedor, quieres obtener el mejor valor por tu casa y yo te ayudaré a que esto suceda. Mis capacidades ayudarán a mantener los términos de la negociación a tu favor. 
                                <br>
                                <br>
                                El objetivo es asegurarse de que evites trampas con las que muchos vendedores se enfrentan al vender su casa. Los más comunes son:";
							}
							?>
							</p><br><br>
                             
                             	<h4 class="making" style="color: <?php echo $theme ?>;">
								<?php 
								if (isset($report_content_data['point_1_title']['value']) && !empty($report_content_data['point_1_title']['value'])) {
									echo $report_content_data['point_1_title']['value'];
								} else {
									echo '- No buscar los compradores adecuados';
								}
								?>
								</h4>
                             	<h4 class="making" style="color: <?php echo $theme ?>;">
								<?php 
								if (isset($report_content_data['point_2_title']['value']) && !empty($report_content_data['point_2_title']['value'])) {
									echo $report_content_data['point_2_title']['value'];
								} else {
									echo '- No entender los formularios de contrato';
								}
								?>
								</h4>
                             	<h4 class="making" style="color: <?php echo $theme ?>;">
								<?php 
								if (isset($report_content_data['point_3_title']['value']) && !empty($report_content_data['point_3_title']['value'])) {
									echo $report_content_data['point_3_title']['value'];
								} else {
									echo '- No revelar materiales sobre la propiedad';
								}
								?>
								</h4>
                             	<h4 class="making" style="color: <?php echo $theme ?>;" >
								<?php 
								if (isset($report_content_data['point_4_title']['value']) && !empty($report_content_data['point_4_title']['value'])) {
									echo $report_content_data['point_4_title']['value'];
								} else {
									echo '- Crean contingencias inefectivas.';
								}
								?>
								</h4>
                                <h4 class="making" style="color: <?php echo $theme ?>;">
								<?php 
								if (isset($report_content_data['point_5_title']['value']) && !empty($report_content_data['point_5_title']['value'])) {
									echo $report_content_data['point_5_title']['value'];
								} else {
									echo '- Manipulación del depósito de los compradores';
								}
								?>
								</h4>  <br>

                                <p> 
                                <?php 
								if (isset($report_content_data['footer_content']['value']) && !empty($report_content_data['footer_content']['value'])) {
									echo nl2br($report_content_data['footer_content']['value']);
								} else {
									echo "Lo que hay que recordar acerca de la negociación es que no se trata donde se inicia, sino más bien donde termina.";
								}
								?>
                                </p>                           
						</div>
					
					</div>
				</div>
				<div class="col-xs-6">
					<div class="right-grid">
						<img width="100%" class="img-responsive" src="<?php echo base_url("assets/reports/spanish/seller/images/6g/6g2.jpg")?>" alt="">
					</div>
				</div>
		</div> <!-- .two-grid-wrapper -->


	</div>

	
</div>
</div>
