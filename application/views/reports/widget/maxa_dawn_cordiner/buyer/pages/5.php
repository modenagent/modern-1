<page>
    <h1 class="main_title top_title">Prospective Property</h1>
    <div class="d-flex">    
        <div class="col-12">
            <h4 class="table_title mt-50">Owner, Address & Legal Description</h4>
            <table>
                <tr>
                    <td colspan="2">Primary Owner: <?php echo $primary_owner; ?></td>
                </tr>
                <tr>
                    <td colspan="2">Secondary Owner: <?php echo $secondary_owner; ?></td>
                </tr>
                <tr>
                    <td colspan="2">Site Address: <?php echo $property->PropertyProfile->SiteAddress.', '. $property->PropertyProfile->SiteCity.', '. $property->PropertyProfile->SiteState.' '.$property->PropertyProfile->SiteZip; ?></td>
                </tr>
                <tr>
                    <td colspan="2">Mailing Address: <?php echo $property->PropertyProfile->MailAddress.', '. $property->PropertyProfile->MailCity.', '. $property->PropertyProfile->MailState.' '.$property->PropertyProfile->MailZip; ?></td>
                </tr>
                <tr>
                    <td>APN : <?php echo $property->PropertyProfile->APN; ?></td>
                    <td class="f300">County Name: <?php echo $property->SubjectValueInfo->CountyName; ?></td>
                </tr>
                <tr>
                    <td>Census Tract: <?php echo $property->PropertyProfile->CensusTract; ?></td>
                    <td class="f300">Housing Tract #: <?php echo $property->PropertyProfile->HousingTract; ?></td>
                </tr>
                <tr>
                    <td>Lot Number: <?php echo $property->PropertyProfile->LotNumber; ?></td>
                    <td class="f300">Page Grid: <?php echo $property->PropertyProfile->TBMGrid; ?></td>
                </tr>
                <tr>
                    <td colspan="2">Brief Legal Description:<br>
                    <?php echo $property->PropertyProfile->LegalDescriptionInfo->LegalBriefDescription; ?></td>
                </tr>
            </table> 
            <h4 class="table_title">Beds, Baths & Square Footage</h4>
            <table>
                <tr>
                    <td>Bedrooms: <?php echo $property->PropertyProfile->PropertyCharacteristics->Bedrooms; ?></td>
                    <td>Year: <?php echo $property->PropertyProfile->PropertyCharacteristics->YearBuilt; ?></td>
                    <td>Square Feet: <?php echo $property->PropertyProfile->PropertyCharacteristics->BuildingArea; ?></td>
                </tr>
                <tr>
                    <td>Bathrooms: <?php echo $property->PropertyProfile->PropertyCharacteristics->Baths; ?></td>
                    <td>Garage: <?php echo $property->PropertyProfile->PropertyCharacteristics->GarageNumCars; ?></td>
                    <td>Lot Size: <?php echo $property->PropertyProfile->PropertyCharacteristics->LotSize; ?></td>
                </tr>
                <tr>
                    <td>Partial Bath: 0</td>
                    <td>Fireplace: <?php echo $property->PropertyProfile->PropertyCharacteristics->Fireplace; ?></td>
                    <td># of Units: <?php echo $property->PropertyProfile->PropertyCharacteristics->NumUnits; ?></td>
                </tr>
                <tr>
                    <td>Total Rooms: <?php echo sizeof($property->PropertyProfile->PropertyCharacteristics->TotalRooms); ?></td>
                    <td>Pool/Spa:<?php echo $property->PropertyProfile->PropertyCharacteristics->Pool; ?></td>
                    <td>Zoning: <?php echo trim($property->PropertyProfile->PropertyCharacteristics->Zoning); ?></td>
                </tr>
                <tr>
                    <td colspan="3">Property Type: <?php echo $property->PropertyProfile->PropertyCharacteristics->UseCode; ?></td>
                </tr>
                <tr>
                    <td colspan="3">Residential</td>
                </tr>
                <tr>
                    <td colspan="3">Use Code: <?php echo $property->PropertyProfile->PropertyCharacteristics->UseCode; ?></td>
                </tr>
            </table>
            <h4 class="table_title">Assessed Value & Tax Details</h4>
            <table>
                <tr>
                    <td>Assessed Value: $<?php echo $property->PropertyProfile->AssessmentTaxInfo->AssessedValue; ?></td>
                    <td>Tax Amount: $<?php echo $property->PropertyProfile->AssessmentTaxInfo->TaxAmount; ?></td>
                </tr>
                <tr>
                    <td>Land Value: $<?php echo $property->PropertyProfile->AssessmentTaxInfo->LandValue; ?></td>
                    <td>Tax Status: <?php echo $property->PropertyProfile->AssessmentTaxInfo->TaxStatus; ?></td>
                </tr>
                <tr>
                    <td>Improvement Value: $<?php echo $property->PropertyProfile->AssessmentTaxInfo->ImprovementValue; ?></td>
                    <td>Tax Rate Area: <?php echo $property->PropertyProfile->AssessmentTaxInfo->TaxRateArea; ?>%</td>
                </tr>
                <tr>
                    <td>% Improvement: <?php echo $property->PropertyProfile->AssessmentTaxInfo->PercentImproved; ?>%</td>
                    <td>Tax Year: <?php echo $property->PropertyProfile->AssessmentTaxInfo->TaxYear; ?></td>
                </tr>
            </table>
        </div>
    </div>
</page>