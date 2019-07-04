<div class="container">
	<div class="section page5">
	
		<header>
			<h2 class="underline title-bold">Prospective Property</h2>
			<p>Overview of your property</p>
		</header>


		<div class="table-wrapper">
			<h2>PROPIETARIO, DIRECCIÓN & DESCRIPCIÓN LEGAL</h2>
		
			<div class="table-row">
				<div class="row">
					<div class="col-xs-12">
						<p>Propietario Principal: : <?php echo $primary_owner; ?></p>
					</div>
				</div>
			</div>

			<div class="table-row">
				<div class="row">
					<div class="col-xs-12">
						<p>Propietario Principal: <?php echo $secondary_owner; ?></p>
					</div>
				</div>
			</div>

			<div class="table-row">
				<div class="row">
					<div class="col-xs-12">
						<p>Dirección: <?php echo $property->PropertyProfile->SiteAddress.', '. $property->PropertyProfile->SiteCity.', '. $property->PropertyProfile->SiteState.' '.$property->PropertyProfile->SiteZip; ?></p>
					</div>
				</div>
			</div>

			<div class="table-row">
				<div class="row">
					<div class="col-xs-12">
						<p>Dirección de Correo: <?php echo $property->PropertyProfile->MailAddress.', '. $property->PropertyProfile->MailCity.', '. $property->PropertyProfile->MailState.' '.$property->PropertyProfile->MailZip; ?></p>
					</div>
				</div>
			</div>

			<div class="table-row">
				<div class="row">
					<div class="col-xs-6">
						<p>APN : <?php echo $property->PropertyProfile->APN; ?></p>
					</div>

					<div class="col-xs-6">
						<p>Condado: <?php echo $property->SubjectValueInfo->CountyName; ?></p>
					</div>
				</div>
			</div>

			<div class="table-row">
				<div class="row">
					<div class="col-xs-6">
						<p>Sector Censal: <?php echo $property->PropertyProfile->CensusTract; ?></p>
					</div>

					<div class="col-xs-6">
						<p>Sector Habitacional #: <?php echo $property->PropertyProfile->HousingTract; ?></p>
					</div>
				</div>
			</div>

			<div class="table-row">
				<div class="row">
					<div class="col-xs-6">
						<p>Número de Lote: <?php echo $property->PropertyProfile->LotNumber; ?></p>
					</div>

					<div class="col-xs-6">
						<p>Folio: <?php echo $property->PropertyProfile->TBMGrid; ?></p>
					</div>
				</div>
			</div>

			<div class="table-row">
				<div class="row">
					<div class="col-xs-12">
						<p class="no-lineheight">Breve Descripción Legal:<br >
						<?php echo $property->PropertyProfile->LegalDescriptionInfo->LegalBriefDescription; ?></p>
					</div>
				</div>
			</div>

		</div> <!-- .table-wrapper -->






		<div class="table-wrapper">
			<h2>HABITACIONES, BAÑOS, & MEDIDAS EN PIES CUADRADOS</h2>

			<div class="table-row">
				<div class="row">
					<div class="col-xs-4">
						<p>Habitaciones: <?php echo $property->PropertyProfile->PropertyCharacteristics->Bedrooms; ?></p>
					</div>

					<div class="col-xs-4">
						<p>Año de Construcción: <?php echo $property->PropertyProfile->PropertyCharacteristics->YearBuilt; ?></p>
					</div>

					<div class="col-xs-4">
						<p>Pies Cuadrados: <?php echo $property->PropertyProfile->PropertyCharacteristics->BuildingArea; ?></p>
					</div>
				</div>
			</div>

			<div class="table-row">
				<div class="row">
					<div class="col-xs-4">
						<p>Baños: <?php echo $property->PropertyProfile->PropertyCharacteristics->Baths; ?></p>
					</div>

					<div class="col-xs-4">
						<p>Garaje: <?php echo $property->PropertyProfile->PropertyCharacteristics->GarageNumCars; ?></p>
					</div>

					<div class="col-xs-4">
						<p>Tamaño de Lote: <?php echo $property->PropertyProfile->PropertyCharacteristics->LotSize; ?></p>
					</div>
				</div>
			</div>

			<div class="table-row">
				<div class="row">
					<div class="col-xs-4">
						<p>Baños Parciales: 0</p>
					</div>

					<div class="col-xs-4">
						<p>Chimenea: <?php echo $property->PropertyProfile->PropertyCharacteristics->Fireplace; ?></p>
					</div>

					<div class="col-xs-4">
						<p># de Unidades: <?php echo $property->PropertyProfile->PropertyCharacteristics->NumUnits; ?></p>
					</div>
				</div>
			</div>

			<div class="table-row">
				<div class="row">
					<div class="col-xs-4">
						<p>Total de Habitaciones: <?php echo sizeof($property->PropertyProfile->PropertyCharacteristics->TotalRooms); ?></p>
					</div>

					<div class="col-xs-4">
						<p>Piscina/Spa: <?php echo $property->PropertyProfile->PropertyCharacteristics->Pool; ?></p>
					</div>

					<div class="col-xs-4">
						<p>Zona: <?php echo trim($property->PropertyProfile->PropertyCharacteristics->Zoning); ?></p>
					</div>
				</div>
			</div>

		
			<div class="table-row">
				<div class="row">
					<div class="col-xs-12">
						<p>Tipo de Propiedad: <?php echo $property->PropertyProfile->PropertyCharacteristics->UseCode; ?></p>
					</div>
				</div>
			</div>

			<div class="table-row">
				<div class="row">
					<div class="col-xs-12">
						<p>Código de Uso: <?php echo $property->PropertyProfile->PropertyCharacteristics->UseCode; ?></p>
					</div>
				</div>
			</div>
		</div>












		<div class="table-wrapper">
			<h2>VALOR DE TASACIÓN & DETALLE DE IMPUESTOS</h2>
		
			

			<div class="table-row">
				<div class="row">
					<div class="col-xs-6">
						<p>Valor de Tasación: $<?php echo $property->PropertyProfile->AssessmentTaxInfo->AssessedValue; ?></p>
					</div>

					<div class="col-xs-6">
						<p>Impuesto a pagar: $<?php echo $property->PropertyProfile->AssessmentTaxInfo->TaxAmount; ?></p>
					</div>
				</div>
			</div>

			<div class="table-row">
				<div class="row">
					<div class="col-xs-6">
						<p>Valor del Terreno: $<?php echo $property->PropertyProfile->AssessmentTaxInfo->LandValue; ?></p>
					</div>

					<div class="col-xs-6">
						<p>Status: <?php echo $property->PropertyProfile->AssessmentTaxInfo->TaxStatus; ?></p>
					</div>
				</div>
			</div>

			<div class="table-row">
				<div class="row">
					<div class="col-xs-6">
						<p>Valor de Mejora: $<?php echo $property->PropertyProfile->AssessmentTaxInfo->ImprovementValue; ?> </p>
					</div>

					<div class="col-xs-6">
						<p>Impuesto de Área: <?php echo $property->PropertyProfile->AssessmentTaxInfo->TaxRateArea; ?>%</p>
					</div>
				</div>
			</div>

			<div class="table-row">
				<div class="row">
					<div class="col-xs-6">
						<p>% Mejora: <?php echo $property->PropertyProfile->AssessmentTaxInfo->PercentImproved; ?>% </p>
					</div>

					<div class="col-xs-6">
						<p>Año Fiscal: <?php echo $property->PropertyProfile->AssessmentTaxInfo->TaxYear; ?></p>
					</div>
				</div>
			</div>

		</div> <!-- .table-wrapper -->

	</div>

</div>
