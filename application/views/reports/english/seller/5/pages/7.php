<style>
    .page6_pdf_header {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        padding-bottom: 20px;
        text-align: left;
        color: #ffff;
        height: 120px;
    }
    .pdf-body{
        position: absolute;
        top: 120px;
        left: 0;
        right: 0;
    }
    .text-right{
        text-align: right;
    }
    .page6-title {
        font-family: 'BebasNeue Book';
        font-size: 80px;
        line-height: 70px;
        color: #152270;
        text-align: center;
    }
    .page6-title span{
        font-family: "Bebas Neue", sans-serif;
        color: #d79547;
    }
    .page6_pdf_header p {
        font-size: 18px;
        color: #000;
        font-weight: 500;
        margin: 0;
    }
    .img-fluid{
        max-width: 100%;
        height: auto;
    }
    .page6-property-name {
        padding: 8px 20px;
        color: #fff;
        background-size: 80%;
        background-position-x: -100%;
        background-repeat: no-repeat;
    }
    .property-tile.blue  .page6-property-name{
        background-image:  url(<?php echo base_url("assets/reports/english/seller/5/img/blue-pattern.png"); ?>);
        background-color: #152170;
    }
    .property-tile.orange  .page6-property-name{
        background-image:  url(<?php echo base_url("assets/reports/english/seller/5/img/yellow-pattern.png"); ?>);
        background-color: #d79547;
    }
    .property-tile.blue .sale-price b {
        color: #d79547;
    }
    .property-tile.orange .sale-price b {
        color: #152170;
    }
    .page6-property-name .page6-address {
        font-size: 18px;
        font-weight: 600;
    }
    .sale-price {
        font-size: 14px;
    }
    .page6-property-name .page6-address img {
        width: 16px;
        vertical-align: middle;
        margin-right: 5px;
    }
    .sale-price b{
        font-family: 'BebasNeue Regular';
        font-size: 28px;
        margin-left: 20px;
    }
    .page6-grid > .col-6:first-child .property-tile{
        margin-right: 2px;
    }
    .page6-grid > .col-6:last-child .property-tile{
        margin-left: 2px;
    }
    .property-tile{
        padding: 12px;
    }
    .property-tile.blue{
        background-color: #e9eaf2
    }
    .property-tile.orange{
        background-color: #f2f0ed
    }
    .page6-grid::after{
        display: table;
        content: '';
        width: 100%;
    }
    .page6-grid > .col-6 {
        float: left;
        width: 50%;
    }
    .page6-property-detail {
        padding: 5px 0;
    }
    table {
        width: 100%;
        color: #000;
        font-size: 12px;
        border-collapse: collapse;
    }
    table td {
        padding: 8px 5px;
        font-weight: 500;
    }
    table tr:first-child td {
        border-bottom: 1px solid #23252f;
    }
    .mt-20{
        margin-top: 20px;
    }
</style>

<div class="page_container">
    <div class="pdf_page size_letter">
        <div class="page6_pdf_header">
            <div class="page6-title">SALES <span>COMPARABLES</span></div>
        </div>
        <div class="pdf-body">
            <div class="page6-grid">
                <div class="col-6">
                    <div class="property-tile blue">
                        <img src="<?php echo base_url("assets/reports/english/seller/5/img/home1.png"); ?>" class="img-fluid" alt="">
                        <div class="page6-property-name">
                            <div class="page6-address"><img src="<?php echo base_url("assets/reports/english/seller/5/img/location-pin.png"); ?>" alt=""> 2404 PEPPER STREET</div>
                            <div class="sale-price" style="margin-left: 28px;">Sale Price <b>$425,000</b></div>
                        </div>
                        <div class="page6-property-detail">
                            <table>
                                <tr>
                                    <td>
                                        Sold Date<br>03/13/2024
                                    </td>
                                    <td>
                                        Dist<br>-
                                    </td>
                                    <td>
                                        Sq.ft<br>758
                                    </td>
                                    <td>
                                        $/Sqft<br>-
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Bed/Bath<br>2/1
                                    </td>
                                    <td>
                                        Year Bit<br>1970
                                    </td>
                                    <td>
                                        Lot Area<br>6,742
                                    </td>
                                    <td>
                                        Pool<br>Association,<br>Community
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="property-tile orange">
                        <img src="<?php echo base_url("assets/reports/english/seller/5/img/home2.png"); ?>" class="img-fluid" alt="">
                        <div class="page6-property-name">
                            <div class="page6-address"><img src="<?php echo base_url("assets/reports/english/seller/5/img/location-pin.png"); ?>" alt=""> 3361 BUTTERFIELD</div>
                            <div class="sale-price" style="margin-left: 28px;">Sale Price <b>$1,700</b></div>
                        </div>
                        <div class="page6-property-detail">
                            <table>
                                <tr>
                                    <td>
                                        Sold Date<br>11/27/2023
                                    </td>
                                    <td>
                                        Dist<br>-
                                    </td>
                                    <td>
                                        Sq.ft<br>750
                                    </td>
                                    <td>
                                        $/Sqft<br>-
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Bed/Bath<br>1/1
                                    </td>
                                    <td>
                                        Year Bit<br>1969
                                    </td>
                                    <td>
                                        Lot Area<br>750
                                    </td>
                                    <td>
                                        Pool<br>None<br>&nbsp;
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page6-grid mt-20">
                <div class="col-6">
                    <div class="property-tile orange">
                        <img src="<?php echo base_url("assets/reports/english/seller/5/img/home3.png"); ?>" class="img-fluid" alt="">
                        <div class="page6-property-name">
                            <div class="page6-address"><img src="<?php echo base_url("assets/reports/english/seller/5/img/location-pin.png"); ?>" alt="">473 JUNIPER STREET</div>
                            <div class="sale-price" style="margin-left: 28px;">Sale Price <b>$3,000</b></div>
                        </div>
                        <div class="page6-property-detail">
                            <table>
                                <tr>
                                    <td>
                                        Sold Date<br>01/29/2024
                                    </td>
                                    <td>
                                        Dist<br>-
                                    </td>
                                    <td>
                                        Sq.ft<br>1,179
                                    </td>
                                    <td>
                                        $/Sqft<br>-
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Bed/Bath<br>3/2
                                    </td>
                                    <td>
                                        Year Bit<br>1984
                                    </td>
                                    <td>
                                        Lot Area<br>3,485
                                    </td>
                                    <td>
                                        Pool<br>None<br>&nbsp;<br>&nbsp;
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="property-tile blue">
                        <img src="<?php echo base_url("assets/reports/english/seller/5/img/home4.png"); ?>" class="img-fluid" alt="">
                        <div class="page6-property-name">
                            <div class="page6-address"><img src="<?php echo base_url("assets/reports/english/seller/5/img/location-pin.png"); ?>" alt=""> 4692 CANYON PARK LANE</div>
                            <div class="sale-price" style="margin-left: 28px;">Sale Price <b>$700,000</b></div>
                        </div>
                        <div class="page6-property-detail">
                            <table>
                                <tr>
                                    <td>
                                        Sold Date<br>02/09/2024
                                    </td>
                                    <td>
                                        Dist<br>-
                                    </td>
                                    <td>
                                        Sq.ft<br>1,144
                                    </td>
                                    <td>
                                        $/Sqft<br>-
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Bed/Bath<br>2/2
                                    </td>
                                    <td>
                                        Year Bit<br>1983
                                    </td>
                                    <td>
                                        Lot Area<br>1,575
                                    </td>
                                    <td>
                                        Pool<br>Association,<br>Community,<br>Gas Heat
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
