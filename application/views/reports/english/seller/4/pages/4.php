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
        font-size: 23px;
        font-weight: 700;
        padding: 12px 20px;
        position: relative;
        display: inline-block;
        color: #fff;
        margin-top: 20px;
        margin-bottom: 10px;
    }
    .section-title::before {
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
    }
    .properties{
        background-color: #e9eaf2;
        padding: 5px 20px;
        margin-bottom: 10px;
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
</style>
<div class="page_container">
    <div class="pdf_page size_letter">
        <div class="pdf_header">
            <div class="page4-title">PROSPECTIVE PROPERTY</div>
            <p>OVERVIEW OF YOUR PROPERTY</p>
        </div>
        <div class="pdf-body">
            <div class="section-title">OWNER, ADDRESS & LEGAL DESCRIPTION</div>
            <div class="grid">
                <div class="col-6">
                    <div class="properties">Primary Owner: HERNANDEZ GERARDO J</div>
                    <div class="properties">Secondary Owner: MENDOZA YESSICA S</div>
                    <div class="properties">Site Address: 1358 5TH ST, LA VERNE, CA 91750</div>
                    <div class="properties">Mailing Address:1358 5TH ST, LA VERNE, CA 91750</div>
                    <div class="properties">Brief Legal Description:<br> LOT:44 TR#:6654 TRACT NO 6654 LOT 44</div>
                </div>
                <div class="col-6">
                    <div class="properties">APN : 8381-021-001</div>
                    <div class="properties">County Name: LOS ANGELES</div>
                    <div class="properties">Census Tract: 4089.00</div>
                    <div class="properties">Housing Tract #: 6654</div>
                    <div class="properties">Lot Number: 44</div>
                    <div class="properties">Page Grid: E2</div>
                </div>
            </div>
            <div class="section-title">BEDS, BATHS, & SQUARE FOOTAGE</div>
            <div>
                <div class="properties">
                    <div class="grid">
                        <div class="col-4">Bedrooms: 2</div>
                        <div class="col-4">Year: 1949</div>
                        <div class="col-4 text-right">Square Feet: 786</div>
                    </div>
                </div>
                <div class="properties">
                    <div class="grid">
                        <div class="col-4">Bathrooms: 1</div>
                        <div class="col-4">Garage: -</div>
                        <div class="col-4 text-right">Lot Size: 6155</div>
                    </div>
                </div>
                <div class="properties">
                    <div class="grid">
                        <div class="col-4">Partial Bath: 0</div>
                        <div class="col-4">Fireplace: -</div>
                        <div class="col-4 text-right"># of Units: 0</div>
                    </div>
                </div>
                <div class="properties">
                    <div class="grid">
                        <div class="col-4">Total Rooms: 1</div>
                        <div class="col-4">Pool/Spa:-</div>
                        <div class="col-4 text-right">Zoning: LVPR4.5D*</div>
                    </div>
                </div>
                <div class="properties">
                    Property Type: Single Family Residential
                </div>
                <div class="properties">
                    Use Code: Single Family Residential
                </div>
            </div>
            <div class="section-title">ASSESSED VALUE & TAX DETAILS</div>
            <div>
                <div class="properties">
                    <div class="grid">
                        <div class="col-6">Assessed Value: $411621</div>
                        <div class="col-6">Tax Amount: $4998.36</div>
                    </div>
                </div>
                <div class="properties">
                    <div class="grid">
                        <div class="col-6">Land Value: $324278</div>
                        <div class="col-6">Tax Status: Current</div>
                    </div>
                </div>
                <div class="properties">
                    <div class="grid">
                        <div class="col-6">Improvement Value: $87343</div>
                        <div class="col-6">Tax Rate Area: 5-283%</div>
                    </div>
                </div>
                <div class="properties">
                    <div class="grid">
                        <div class="col-6">% Improvement: 0.2122%</div>
                        <div class="col-6">Tax Year: 2022</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
