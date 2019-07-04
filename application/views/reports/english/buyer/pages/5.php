<div class="container">
	<div class="section page5">
	
		<header>
			<h2 class="underline title-bold">Prospective Property</h2>
			<p>Overview of your property</p>
		</header>


		<div class="table-wrapper">
			<h2>OWNER, ADDRESS & LEGAL DESCRIPTION</h2>
		
			<div class="table-row">
				<div class="row">
					<div class="col-xs-12">
						<p>Primary Owner: <?php echo $primary_owner; ?></p>
					</div>
				</div>
			</div>

			<div class="table-row">
				<div class="row">
					<div class="col-xs-12">
						<p>Secondary Owner: <?php echo $secondary_owner; ?></p>
					</div>
				</div>
			</div>

			<div class="table-row">
				<div class="row">
					<div class="col-xs-12">
						<p>Site Address: <?php echo $property->PropertyProfile->SiteAddress.', '. $property->PropertyProfile->SiteCity.', '. $property->PropertyProfile->SiteState.' '.$property->PropertyProfile->SiteZip; ?></p>
					</div>
				</div>
			</div>

			<div class="table-row">
				<div class="row">
					<div class="col-xs-12">
						<p>Mailing Address: <?php echo $property->PropertyProfile->MailAddress.', '. $property->PropertyProfile->MailCity.', '. $property->PropertyProfile->MailState.' '.$property->PropertyProfile->MailZip; ?></p>
					</div>
				</div>
			</div>

			<div class="table-row">
				<div class="row">
					<div class="col-xs-6">
						<p>APN : <?php echo $property->PropertyProfile->APN; ?></p>
					</div>

					<div class="col-xs-6">
						<p>County Name: <?php echo $property->SubjectValueInfo->CountyName; ?></p>
					</div>
				</div>
			</div>

			<div class="table-row">
				<div class="row">
					<div class="col-xs-6">
						<p>Census Tract: <?php echo $property->PropertyProfile->CensusTract; ?></p>
					</div>

					<div class="col-xs-6">
						<p>Housing Tract #: <?php echo $property->PropertyProfile->HousingTract; ?></p>
					</div>
				</div>
			</div>

			<div class="table-row">
				<div class="row">
					<div class="col-xs-6">
						<p>Lot Number: <?php echo $property->PropertyProfile->LotNumber; ?></p>
					</div>

					<div class="col-xs-6">
						<p>Page Grid: <?php echo $property->PropertyProfile->TBMGrid; ?></p>
					</div>
				</div>
			</div>

			<div class="table-row">
				<div class="row">
					<div class="col-xs-12">
						<p class="no-lineheight">Brief Legal Description:<br >
						<?php echo $property->PropertyProfile->LegalDescriptionInfo->LegalBriefDescription; ?></p>
					</div>
				</div>
			</div>

		</div> <!-- .table-wrapper -->






		<div class="table-wrapper">
			<h2>BEDS, BATHS, & SQUARE FOOTAGE</h2>

			<div class="table-row">
				<div class="row">
					<div class="col-xs-4">
						<p>Bedrooms: <?php echo $property->PropertyProfile->PropertyCharacteristics->Bedrooms; ?></p>
					</div>

					<div class="col-xs-4">
						<p>Year: <?php echo $property->PropertyProfile->PropertyCharacteristics->YearBuilt; ?></p>
					</div>

					<div class="col-xs-4">
						<p>Square Feet: <?php echo $property->PropertyProfile->PropertyCharacteristics->BuildingArea; ?></p>
					</div>
				</div>
			</div>

			<div class="table-row">
				<div class="row">
					<div class="col-xs-4">
						<p>Bathrooms: <?php echo $property->PropertyProfile->PropertyCharacteristics->Baths; ?></p>
					</div>

					<div class="col-xs-4">
						<p>Garage: <?php echo $property->PropertyProfile->PropertyCharacteristics->GarageNumCars; ?></p>
					</div>

					<div class="col-xs-4">
						<p>Lot Size: <?php echo $property->PropertyProfile->PropertyCharacteristics->LotSize; ?></p>
					</div>
				</div>
			</div>

			<div class="table-row">
				<div class="row">
					<div class="col-xs-4">
						<p>Partial Bath: 0</p>
					</div>

					<div class="col-xs-4">
						<p>Fireplace: <?php echo $property->PropertyProfile->PropertyCharacteristics->Fireplace; ?></p>
					</div>

					<div class="col-xs-4">
						<p># of Units: <?php echo $property->PropertyProfile->PropertyCharacteristics->NumUnits; ?></p>
					</div>
				</div>
			</div>

			<div class="table-row">
				<div class="row">
					<div class="col-xs-4">
						<p>Total Rooms: <?php echo sizeof($property->PropertyProfile->PropertyCharacteristics->TotalRooms); ?></p>
					</div>

					<div class="col-xs-4">
						<p>Pool/Spa: <?php echo $property->PropertyProfile->PropertyCharacteristics->Pool; ?></p>
					</div>

					<div class="col-xs-4">
						<p>Zoning: <?php echo trim($property->PropertyProfile->PropertyCharacteristics->Zoning); ?></p>
					</div>
				</div>
			</div>

		
			<div class="table-row">
				<div class="row">
					<div class="col-xs-12">
						<p>Property Type: <?php echo $property->PropertyProfile->PropertyCharacteristics->UseCode; ?></p>
					</div>
				</div>
			</div>

			<div class="table-row">
				<div class="row">
					<div class="col-xs-12">
						<p>Use Code: <?php echo $property->PropertyProfile->PropertyCharacteristics->UseCode; ?></p>
					</div>
				</div>
			</div>
		</div>












		<div class="table-wrapper">
			<h2>ASSESSED VALUE & TAX DETAILS</h2>
		
			

			<div class="table-row">
				<div class="row">
					<div class="col-xs-6">
						<p>Assessed Value: $<?php echo $property->PropertyProfile->AssessmentTaxInfo->AssessedValue; ?></p>
					</div>

					<div class="col-xs-6">
						<p>Tax Amount: $<?php echo $property->PropertyProfile->AssessmentTaxInfo->TaxAmount; ?></p>
					</div>
				</div>
			</div>

			<div class="table-row">
				<div class="row">
					<div class="col-xs-6">
						<p>Land Value: $<?php echo $property->PropertyProfile->AssessmentTaxInfo->LandValue; ?></p>
					</div>

					<div class="col-xs-6">
						<p>Tax Status: <?php echo $property->PropertyProfile->AssessmentTaxInfo->TaxStatus; ?></p>
					</div>
				</div>
			</div>

			<div class="table-row">
				<div class="row">
					<div class="col-xs-6">
						<p>Improvement Value: $<?php echo $property->PropertyProfile->AssessmentTaxInfo->ImprovementValue; ?> </p>
					</div>

					<div class="col-xs-6">
						<p>Tax Rate Area: <?php echo $property->PropertyProfile->AssessmentTaxInfo->TaxRateArea; ?>%</p>
					</div>
				</div>
			</div>

			<div class="table-row">
				<div class="row">
					<div class="col-xs-6">
						<p>% Improvement: <?php echo $property->PropertyProfile->AssessmentTaxInfo->PercentImproved; ?>% </p>
					</div>

					<div class="col-xs-6">
						<p>Tax Year: <?php echo $property->PropertyProfile->AssessmentTaxInfo->TaxYear; ?></p>
					</div>
				</div>
			</div>

		</div> <!-- .table-wrapper -->

	</div>

<!--	<div class="seperator"></div>-->
</div>
