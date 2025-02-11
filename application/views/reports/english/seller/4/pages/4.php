<style>
    .pdf_header {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        padding-bottom: 20px;
        text-align: left;
        color: #ffff;
        height: 95px;
    }
    .pdf-body{
        position: absolute;
        top: 95px;
        left: 0;
        right: 0;
    }
    .text-right{
        text-align: right;
    }
    .page4-title {
        font-size: 40px;
        font-weight: 700;
        color: #3fbfb0;
        background: url(<?php echo base_url("assets/reports/english/seller/4/img/title-decoration.png"); ?>) no-repeat;
        background-size: 300px;
        background-position: center right;
        line-height: 50px
    }
    .pdf_header p {
        font-size: 18px;
        color: #000;
        font-weight: 500;
        margin: 0;
    }
    .img-fluid{
        max-width: 100%;
        height: auto;
    }
    .d-block{
        display: block;
    }
    .section-title{
        background-color: #152170;
        font-size: 18px;
        font-weight: 700;
        padding: 10px 20px;
        position: relative;
        display: inline-block;
        color: #fff;
        width: 55%;
        margin-top: 20px;
        margin-bottom: 10px;
    }
    /* .section-title::before {
        content: '';
        border-top: 17px solid #fff;
        border-left: 18px solid transparent;
        border-right: 18px solid transparent;
        position: absolute;
        left: -15px;
        top: -6px;
        transform: rotate(135deg);
    }
    .section-title::after {
        content: '';
        border-top: 17px solid #fff;
        border-left: 18px solid transparent;
        border-right: 18px solid transparent;
        position: absolute;
        right: -15px;
        bottom: -6px;
        transform: rotate(-38deg);
    } */
    .properties{
        background-color: #e9eaf2;
        padding: 5px 20px;
        margin-bottom: 10px;
        font-size: 15px;
    }
    .grid > .col-6:first-child .properties{
        margin-right: 10px;
    }
    .grid > .col-6:last-child .properties{
        margin-left: 10px;
    }
    .properties:nth-child(odd){
        background-color: #dff5f2;
    }
    .grid::after{
        display: table;
        content: '';
        width: 100%;
    }
    .grid > .col-6 {
        float: left;
        width: 50%;
    }
    .grid > .col-4 {
        float: left;
        width: 33%;
    }
    .ml-20 {
        margin-left: 20px;
    }
    .body-margin {
        margin: 0px 20px;
    }
</style>
<div class="page_container">
    <div class="pdf_page size_letter">
        <div class="pdf_header ml-20">
            <div class="page4-title">PROSPECTIVE PROPERTY</div>
            <p>OVERVIEW OF YOUR PROPERTY</p>
        </div>
        <div class="pdf-body body-margin">
            <div class="section-title">OWNER, ADDRESS & LEGAL DESCRIPTION</div>
            <div class="grid">
                <div class="col-6">
                <div class="properties">Primary Owner: <?php echo isset($primary_owner) && !empty($primary_owner) ? $primary_owner : '-'; ?></div>
                    <div class="properties">Secondary Owner: <?php echo isset($secondary_owner) && !empty($secondary_owner) ? $secondary_owner : '-'; ?></div>
<?php
$site_address = $property->PropertyProfile->SiteAddress . ', ' . $property->PropertyProfile->SiteCity . ', ' . $property->PropertyProfile->SiteState . ' ' . $property->PropertyProfile->SiteZip;
$mailing_address = $property->PropertyProfile->MailAddress . ', ' . $property->PropertyProfile->MailCity . ', ' . $property->PropertyProfile->MailState . ' ' . $property->PropertyProfile->MailZip;
?>
                    <div class="properties">Site Address: <?php echo isset($site_address) && !empty($site_address) ? $site_address : '-'; ?></div>
                    <div class="properties">Mailing Address: <?php echo isset($mailing_address) && !empty($mailing_address) ? $mailing_address : '-'; ?></div>
                    <div class="properties">Brief Legal Description:<br> <?php echo isset($property->PropertyProfile->LegalDescriptionInfo->LegalBriefDescription) && !empty($property->PropertyProfile->LegalDescriptionInfo->LegalBriefDescription) ? $property->PropertyProfile->LegalDescriptionInfo->LegalBriefDescription : '-'; ?> </div>
                </div>
                <div class="col-6">
                <div class="properties">APN : <?php echo isset($property->PropertyProfile->APN) && !empty($property->PropertyProfile->APN) ? $property->PropertyProfile->APN : '-'; ?></div>
                    <div class="properties">County Name: <?php echo isset($property->SubjectValueInfo->CountyName) && !empty($property->SubjectValueInfo->CountyName) ? $property->SubjectValueInfo->CountyName : '-'; ?></div>
                    <div class="properties">Census Tract: <?php echo isset($property->PropertyProfile->CensusTract) && !empty($property->PropertyProfile->CensusTract) ? $property->PropertyProfile->CensusTract : '-'; ?></div>
                    <div class="properties">Housing Tract #: <?php echo isset($property->PropertyProfile->HousingTract) && !empty($property->PropertyProfile->HousingTract) ? $property->PropertyProfile->HousingTract : '-'; ?></div>
                    <div class="properties">Lot Number: <?php echo isset($property->PropertyProfile->LotNumber) && !empty($property->PropertyProfile->LotNumber) ? $property->PropertyProfile->LotNumber : '-'; ?></div>
                    <div class="properties">Page Grid: <?php echo isset($property->PropertyProfile->TBMGrid) && !empty($property->PropertyProfile->TBMGrid) ? $property->PropertyProfile->TBMGrid : '-'; ?></div>
                </div>
            </div>
            <div class="section-title">BEDS, BATHS, & SQUARE FOOTAGE</div>
            <div>
                <div class="properties">
                    <div class="grid">
                        <div class="col-4">Bedrooms: <?php echo isset($property->PropertyProfile->PropertyCharacteristics->Bedrooms) && !empty($property->PropertyProfile->PropertyCharacteristics->Bedrooms) ? $property->PropertyProfile->PropertyCharacteristics->Bedrooms : '-'; ?></div>
                        <div class="col-4">Year: <?php echo isset($property->PropertyProfile->PropertyCharacteristics->YearBuilt) && !empty($property->PropertyProfile->PropertyCharacteristics->YearBuilt) ? $property->PropertyProfile->PropertyCharacteristics->YearBuilt : '-'; ?></div>
                        <div class="col-4 text-right">Square Feet: <?php echo isset($property->PropertyProfile->PropertyCharacteristics->BuildingArea) && !empty($property->PropertyProfile->PropertyCharacteristics->BuildingArea) ? $property->PropertyProfile->PropertyCharacteristics->BuildingArea : '-'; ?></div>
                    </div>
                </div>
                <div class="properties">
                    <div class="grid">
                        <div class="col-4">Bathrooms: <?php echo isset($property->PropertyProfile->PropertyCharacteristics->Baths) && !empty($property->PropertyProfile->PropertyCharacteristics->Baths) ? $property->PropertyProfile->PropertyCharacteristics->Baths : '-'; ?></div>
                        <div class="col-4">Garage: <?php echo isset($property->PropertyProfile->PropertyCharacteristics->GarageNumCars) && !empty($property->PropertyProfile->PropertyCharacteristics->GarageNumCars) ? $property->PropertyProfile->PropertyCharacteristics->GarageNumCars : '-'; ?></div>
                        <div class="col-4 text-right">Lot Size: <?php echo isset($property->PropertyProfile->PropertyCharacteristics->LotSize) && !empty($property->PropertyProfile->PropertyCharacteristics->LotSize) ? $property->PropertyProfile->PropertyCharacteristics->LotSize : '-'; ?></div>
                    </div>
                </div>
                <div class="properties">
                    <div class="grid">
                        <div class="col-4">Partial Bath: 0</div>
                        <div class="col-4">Fireplace: <?php echo isset($property->PropertyProfile->PropertyCharacteristics->Fireplace) && !empty($property->PropertyProfile->PropertyCharacteristics->Fireplace) ? $property->PropertyProfile->PropertyCharacteristics->Fireplace : '-'; ?></div>
                        <div class="col-4 text-right"># of Units: <?php echo isset($property->PropertyProfile->PropertyCharacteristics->NumUnits) ? $property->PropertyProfile->PropertyCharacteristics->NumUnits : '-'; ?></div>
                    </div>
                </div>
                <div class="properties">
                    <div class="grid">
                        <div class="col-4">Total Rooms: <?php echo isset($property->PropertyProfile->PropertyCharacteristics->TotalRooms) && !empty($property->PropertyProfile->PropertyCharacteristics->TotalRooms) ? sizeof($property->PropertyProfile->PropertyCharacteristics->TotalRooms) : '-'; ?></div>
                        <div class="col-4">Pool/Spa: <?php echo isset($property->PropertyProfile->PropertyCharacteristics->Pool) && !empty($property->PropertyProfile->PropertyCharacteristics->Pool) ? $property->PropertyProfile->PropertyCharacteristics->Pool : '-'; ?></div>
                        <div class="col-4 text-right">Zoning: <?php echo isset($property->PropertyProfile->PropertyCharacteristics->Zoning) && !empty($property->PropertyProfile->PropertyCharacteristics->Zoning) ? $property->PropertyProfile->PropertyCharacteristics->Zoning : '-'; ?></div>
                    </div>
                </div>
                <div class="properties">
                    Property Type: <?php echo isset($property->PropertyProfile->PropertyCharacteristics->UseCode) && !empty($property->PropertyProfile->PropertyCharacteristics->UseCode) ? $property->PropertyProfile->PropertyCharacteristics->UseCode : '-'; ?>
                </div>
                <div class="properties">
                    Use Code: <?php echo isset($property->PropertyProfile->PropertyCharacteristics->UseCode) && !empty($property->PropertyProfile->PropertyCharacteristics->UseCode) ? $property->PropertyProfile->PropertyCharacteristics->UseCode : '-'; ?>
                </div>
            </div>
            <div class="section-title">ASSESSED VALUE & TAX DETAILS</div>
            <div>
                <div class="properties">
                    <div class="grid">
                        <div class="col-6">Assessed Value: <?php echo isset($property->PropertyProfile->AssessmentTaxInfo->AssessedValue) && !empty($property->PropertyProfile->AssessmentTaxInfo->AssessedValue) ? '$' . $property->PropertyProfile->AssessmentTaxInfo->AssessedValue : '-'; ?></div>
                        <div class="col-6">Tax Amount: <?php echo isset($property->PropertyProfile->AssessmentTaxInfo->TaxAmount) && !empty($property->PropertyProfile->AssessmentTaxInfo->TaxAmount) ? '$' . $property->PropertyProfile->AssessmentTaxInfo->TaxAmount : '-'; ?></div>
                    </div>
                </div>
                <div class="properties">
                    <div class="grid">
                        <div class="col-6">Land Value: <?php echo isset($property->PropertyProfile->AssessmentTaxInfo->LandValue) && !empty($property->PropertyProfile->AssessmentTaxInfo->LandValue) ? '$' . $property->PropertyProfile->AssessmentTaxInfo->LandValue : '-'; ?></div>
                        <div class="col-6">Tax Status: <?php echo isset($property->PropertyProfile->AssessmentTaxInfo->TaxStatus) && !empty($property->PropertyProfile->AssessmentTaxInfo->TaxStatus) ? $property->PropertyProfile->AssessmentTaxInfo->TaxStatus : '-'; ?></div>
                    </div>
                </div>
                <div class="properties">
                    <div class="grid">
                        <div class="col-6">Improvement Value: <?php echo isset($property->PropertyProfile->AssessmentTaxInfo->ImprovementValue) && !empty($property->PropertyProfile->AssessmentTaxInfo->ImprovementValue) ? $property->PropertyProfile->AssessmentTaxInfo->ImprovementValue : '-'; ?></div>
                        <div class="col-6">Tax Rate Area: <?php echo isset($property->PropertyProfile->AssessmentTaxInfo->TaxRateArea) && !empty($property->PropertyProfile->AssessmentTaxInfo->TaxRateArea) ? $property->PropertyProfile->AssessmentTaxInfo->TaxRateArea . '%' : '-'; ?></div>
                    </div>
                </div>
                <div class="properties">
                    <div class="grid">
                        <div class="col-6">% Improvement: <?php echo isset($property->PropertyProfile->AssessmentTaxInfo->PercentImproved) && !empty($property->PropertyProfile->AssessmentTaxInfo->PercentImproved) ? $property->PropertyProfile->AssessmentTaxInfo->PercentImproved . '%' : '-'; ?></div>
                        <div class="col-6">Tax Year: <?php echo isset($property->PropertyProfile->AssessmentTaxInfo->TaxYear) && !empty($property->PropertyProfile->AssessmentTaxInfo->TaxYear) ? $property->PropertyProfile->AssessmentTaxInfo->TaxYear : '-'; ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
