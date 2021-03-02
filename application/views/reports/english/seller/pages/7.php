<div class="container">
    <page class="pdf7">
        <h1 class="main_title top_title">Prospective Property</h1>
        <img src="<?php echo base_url().'assets/reports/english/seller/images/1/line.png'; ?>" alt="line" class="bordered_img">
        <div class="d-flex">
            <div class="col-12">
                <h4 class="mt-0 sub_title">Overview of Your Property</h4>
            </div>
        </div>
        <div class="d-flex mt-20">    
            <div class="col-12">
                <h4 class="table_title">Owner, Address & Legal Description</h4>
                <table>
                    <tr>
                        <td colspan="2">Primary Owner: <?php echo isset($primary_owner) && !empty($primary_owner) ? $primary_owner : '-'; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Secondary Owner:  <?php echo isset($secondary_owner) && !empty($secondary_owner) ? $secondary_owner : '-'; ?></td>
                    </tr>
                    <tr>
                        <?php 
                            $site_address = $property->PropertyProfile->SiteAddress.', '. $property->PropertyProfile->SiteCity.', '. $property->PropertyProfile->SiteState.' '.$property->PropertyProfile->SiteZip; 
                        ?>
                        <td colspan="2">Site Address: <?php echo isset($site_address) && !empty($site_address) ? $site_address : '-'; ?></td>
                    </tr>
                    <tr>
                        <?php 
                            $mailing_address = $property->PropertyProfile->MailAddress.', '. $property->PropertyProfile->MailCity.', '. $property->PropertyProfile->MailState.' '.$property->PropertyProfile->MailZip; 
                        ?>
                        <td colspan="2">Mailing Address:<?php echo isset($mailing_address) && !empty($mailing_address) ? $mailing_address : '-'; ?></td>
                    </tr>
                    <tr>
                        <td>APN : <?php echo isset($property->PropertyProfile->APN) && !empty($property->PropertyProfile->APN) ? $property->PropertyProfile->APN : '-'; ?></td>
                        <td>County Name: <?php echo isset($property->SubjectValueInfo->CountyName) && !empty($property->SubjectValueInfo->CountyName) ? $property->SubjectValueInfo->CountyName : '-'; ?></td>
                    </tr>
                    <tr>
                        <td>Census Tract: <?php echo isset($property->PropertyProfile->CensusTract) && !empty($property->PropertyProfile->CensusTract) ? $property->PropertyProfile->CensusTract : '-'; ?></td>
                        <td>Housing Tract #: <?php echo isset($property->PropertyProfile->HousingTract) && !empty($property->PropertyProfile->HousingTract) ? $property->PropertyProfile->HousingTract : '-'; ?></td>
                    </tr>
                    <tr>
                        <td>Lot Number: <?php echo isset($property->PropertyProfile->LotNumber) && !empty($property->PropertyProfile->LotNumber) ? $property->PropertyProfile->LotNumber : '-'; ?></td>
                        <td>Page Grid: <?php echo isset($property->PropertyProfile->TBMGrid) && !empty($property->PropertyProfile->TBMGrid) ? $property->PropertyProfile->TBMGrid : '-'; ?></td>
                    </tr>
                    <tr>
                        <td colspan="2">Brief Legal Description:<br>
                        <?php echo isset($property->PropertyProfile->LegalDescriptionInfo->LegalBriefDescription) && !empty($property->PropertyProfile->LegalDescriptionInfo->LegalBriefDescription) ? $property->PropertyProfile->LegalDescriptionInfo->LegalBriefDescription : '-'; ?></td>
                    </tr>
                </table> 
                <h4 class="table_title">Beds, Baths & Square Footage</h4>
                <table>
                    <tr>
                        <td>Bedrooms: <?php echo isset($property->PropertyProfile->PropertyCharacteristics->Bedrooms) && !empty($property->PropertyProfile->PropertyCharacteristics->Bedrooms) ? $property->PropertyProfile->PropertyCharacteristics->Bedrooms : '-'; ?></td>
                        <td>Year: <?php echo isset($property->PropertyProfile->PropertyCharacteristics->YearBuilt) && !empty($property->PropertyProfile->PropertyCharacteristics->YearBuilt) ? $property->PropertyProfile->PropertyCharacteristics->YearBuilt : '-'; ?></td>
                        <td>Square Feet: <?php echo isset($property->PropertyProfile->PropertyCharacteristics->BuildingArea) && !empty($property->PropertyProfile->PropertyCharacteristics->BuildingArea) ? $property->PropertyProfile->PropertyCharacteristics->BuildingArea : '-'; ?></td>
                    </tr>
                    <tr>
                        <td>Bathrooms: <?php echo isset($property->PropertyProfile->PropertyCharacteristics->Baths) && !empty($property->PropertyProfile->PropertyCharacteristics->Baths) ? $property->PropertyProfile->PropertyCharacteristics->Baths : '-'; ?></td>
                        <td>Garage: <?php echo isset($property->PropertyProfile->PropertyCharacteristics->GarageNumCars) && !empty($property->PropertyProfile->PropertyCharacteristics->GarageNumCars) ? $property->PropertyProfile->PropertyCharacteristics->GarageNumCars : '-'; ?></td>
                        <td>Lot Size: <?php echo isset($property->PropertyProfile->PropertyCharacteristics->LotSize) && !empty($property->PropertyProfile->PropertyCharacteristics->LotSize) ? $property->PropertyProfile->PropertyCharacteristics->LotSize : '-'; ?></td>
                    </tr>
                    <tr>
                        <td>Partial Bath: 0</td>
                        <td>Fireplace: <?php echo isset($property->PropertyProfile->PropertyCharacteristics->Fireplace) && !empty($property->PropertyProfile->PropertyCharacteristics->Fireplace) ? $property->PropertyProfile->PropertyCharacteristics->Fireplace : '-'; ?></td>
                        <td># of Units: <?php echo isset($property->PropertyProfile->PropertyCharacteristics->NumUnits) ? $property->PropertyProfile->PropertyCharacteristics->NumUnits : '-'; ?></td>
                    </tr>
                    <tr>
                        <td>Total Rooms: <?php echo isset($property->PropertyProfile->PropertyCharacteristics->TotalRooms) && !empty($property->PropertyProfile->PropertyCharacteristics->TotalRooms) ? sizeof($property->PropertyProfile->PropertyCharacteristics->TotalRooms) : '-'; ?></td>
                        <td>Pool/Spa:<?php echo isset($property->PropertyProfile->PropertyCharacteristics->Pool) && !empty($property->PropertyProfile->PropertyCharacteristics->Pool) ? $property->PropertyProfile->PropertyCharacteristics->Pool : '-'; ?></td>
                        <td>Zoning: <?php echo isset($property->PropertyProfile->PropertyCharacteristics->Zoning) && !empty($property->PropertyProfile->PropertyCharacteristics->Zoning) ? $property->PropertyProfile->PropertyCharacteristics->Zoning : '-'; ?></td>
                    </tr>
                    <tr>
                        <td colspan="3">Property Type: <?php echo isset($property->PropertyProfile->PropertyCharacteristics->UseCode) && !empty($property->PropertyProfile->PropertyCharacteristics->UseCode) ? $property->PropertyProfile->PropertyCharacteristics->UseCode : '-'; ?></td>
                    </tr>
                    <tr>
                        <td colspan="3">Use Code: <?php echo isset($property->PropertyProfile->PropertyCharacteristics->UseCode) && !empty($property->PropertyProfile->PropertyCharacteristics->UseCode) ? $property->PropertyProfile->PropertyCharacteristics->UseCode : '-'; ?></td>
                    </tr>
                </table>
                <h4 class="table_title">Assessed Value & Tax Details</h4>
                <table>
                    <tr>
                        <td>Assessed Value: <?php echo isset($property->PropertyProfile->AssessmentTaxInfo->AssessedValue) && !empty($property->PropertyProfile->AssessmentTaxInfo->AssessedValue) ? '$'.$property->PropertyProfile->AssessmentTaxInfo->AssessedValue : '-'; ?></td>
                        <td>Tax Amount: <?php echo isset($property->PropertyProfile->AssessmentTaxInfo->TaxAmount) && !empty($property->PropertyProfile->AssessmentTaxInfo->TaxAmount) ? '$'.$property->PropertyProfile->AssessmentTaxInfo->TaxAmount : '-'; ?></td>
                    </tr>
                    <tr>
                        <td>Land Value: <?php echo isset($property->PropertyProfile->AssessmentTaxInfo->LandValue) && !empty($property->PropertyProfile->AssessmentTaxInfo->LandValue) ? '$'.$property->PropertyProfile->AssessmentTaxInfo->LandValue : '-'; ?></td>
                        <td>Tax Status: <?php echo isset($property->PropertyProfile->AssessmentTaxInfo->TaxStatus) && !empty($property->PropertyProfile->AssessmentTaxInfo->TaxStatus) ? $property->PropertyProfile->AssessmentTaxInfo->TaxStatus : '-'; ?></td>
                    </tr>
                    <tr>
                        <td>Improvement Value: <?php echo isset($property->PropertyProfile->AssessmentTaxInfo->ImprovementValue) && !empty($property->PropertyProfile->AssessmentTaxInfo->ImprovementValue) ? $property->PropertyProfile->AssessmentTaxInfo->ImprovementValue : '-'; ?></td>
                        <td>Tax Rate Area: <?php echo isset($property->PropertyProfile->AssessmentTaxInfo->TaxRateArea) && !empty($property->PropertyProfile->AssessmentTaxInfo->TaxRateArea) ? $property->PropertyProfile->AssessmentTaxInfo->TaxRateArea.'%' : '-'; ?></td>
                    </tr>
                    <tr>
                        <td>% Improvement: <?php echo isset($property->PropertyProfile->AssessmentTaxInfo->PercentImproved) && !empty($property->PropertyProfile->AssessmentTaxInfo->PercentImproved) ? $property->PropertyProfile->AssessmentTaxInfo->PercentImproved.'%' : '-'; ?></td>
                        <td>Tax Year: <?php echo isset($property->PropertyProfile->AssessmentTaxInfo->TaxYear) && !empty($property->PropertyProfile->AssessmentTaxInfo->TaxYear) ? $property->PropertyProfile->AssessmentTaxInfo->TaxYear : '-'; ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </page>
</div>