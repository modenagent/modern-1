<div class="container no-padding">
	<div class="section page11">
	
		<header>
			<h2 class="underline title-bold">
			<?php 
			if (isset($report_content_data['title']['value']) && !empty($report_content_data['title']['value'])) {
				echo $report_content_data['title']['value'];
			} else {
				echo 'Mi promesa para con mis clientes';
			}
			?>
			</h2>
			<p>
			<?php 
			if (isset($report_content_data['sub_title']['value']) && !empty($report_content_data['sub_title']['value'])) {
				echo $report_content_data['sub_title']['value'];
			} else {
				echo 'Mis deberes contigo';
			}
			?>
			</p>
		</header>

		<p class="page-tagline">
		<?php 
		if (isset($report_content_data['content']['value']) && !empty($report_content_data['content']['value'])) {
			echo nl2br($report_content_data['content']['value']);
		} else {
			echo "Como tu agente de bienes raíces, en virtud del derecho establecido por la Ley, tengo ciertos deberes que cumplir contigo, además de otros deberes u obligaciones establecidos en el acuerdo de venta; por ende, mis deberes fiduciarios contigo son:";
		}
		?>
		</p>

		<ol class="vesting">
			<h3 class="vesting-title">
			<?php 
			if (isset($report_content_data['point_1_title']['value']) && !empty($report_content_data['point_1_title']['value'])) {
				echo $report_content_data['point_1_title']['value'];
			} else {
				echo 'Lealtad';
			}
			?>
			</h3>
			<li>
			<?php 
			if (isset($report_content_data['point_1_content']['value']) && !empty($report_content_data['point_1_content']['value'])) {
				echo nl2br($report_content_data['point_1_content']['value']);
			} else {
				echo 'La lealtad es uno de los deberes fiduciarios más fundamentales de mí para ti. Este deber me obliga a actuar en todo momento exclusivamente en tu mejor interés y excluir intereses de terceros, incluyendo mi propio interés.';
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
				echo 'Confidencialidad';
			}
			?>
			</h3>
			<li>
			<?php 
			if (isset($report_content_data['point_2_content']['value']) && !empty($report_content_data['point_2_content']['value'])) {
				echo nl2br($report_content_data['point_2_content']['value']);
			} else {
				echo 'Como tu agente, estoy en la obligación de salvaguardar tus datos confidenciales y secretos. Por lo tanto, debo mantener la confidencialidad de cualquier información que pudiera debilitar tu posición de negociación, si se revela.';
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
				echo 'Divulgación';
			}
			?>
			</h3>
			<li>
			<?php 
			if (isset($report_content_data['point_3_content']['value']) && !empty($report_content_data['point_3_content']['value'])) {
				echo nl2br($report_content_data['point_3_content']['value']);
			} else {
				echo 'Como tu agente estoy obligado a revelarte toda la información pertinente y el material que sé que podría afectar la capacidad del vendedor para obtener el precio más alto y las mejores condiciones en la venta de su propiedad.';
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
				echo 'Obediencia';
			}
			?>
			</h3>
			<li>
			<?php 
			if (isset($report_content_data['point_4_content']['value']) && !empty($report_content_data['point_4_content']['value'])) {
				echo nl2br($report_content_data['point_4_content']['value']);
			} else {
				echo 'Como su agente estoy obligado a obedecer de manera rápida y eficaz todas las instrucciones legales que me des sobre la venta de tu propiedad. Sin embargo, este deber claramente no incluye la obligación de obedecer instrucciones ilegales.';
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
				echo 'Cuidado y Diligencia Razonables';
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
				echo 'Contabilidad';
			}
			?>
			</h3>
			<li>
			<?php 
			if (isset($report_content_data['point_6_content']['value']) && !empty($report_content_data['point_6_content']['value'])) {
				echo nl2br($report_content_data['point_6_content']['value']);
			} else {
				echo 'Como tu agente, estoy obligado a darte cuenta de todo el dinero o propiedad que te pertenece o que se te ha encomendado. Este deber me obliga a salvaguardar cualquier garantía, títulos u otros documentos que me hayan confiado, que se relacionen con sus transacciones o asuntos.';
			}
			?>
			</li>
			
		</ol>

		

	</div>

	
</div>
