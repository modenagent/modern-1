<style>
    .pdf_header {
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
    .page-title {
        font-size: 40px;
        font-weight: 700;
        color: #3fbfb0;
        background: url(img/title-decoration.png) no-repeat;
        background-size: 350px;
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
    .page6-property-name {
        background-color: #152170;
        padding: 10px 50px;
        color: #fff;
    }
    .page6-property-name .page6-address {
        font-size: 20px;
        font-weight: 600;
        text-align: center;
    }
    .page6-property-name .page6-address img {
        width: 16px;
        vertical-align: middle;
        margin-right: 5px;
    }
    .sale-price b{
        color: #3fbfb0;
        font-size: 24px;
        margin-left: 20px;
    }
    .grid > .col-6:first-child .property-tile{
        margin-right: 10px;
    }
    .grid > .col-6:last-child .property-tile{
        margin-left: 10px;
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
    .page6-property-detail {
        background: #04081d;
        padding: 5px 15px;
    }
    table {
        width: 100%;
        color: #fff;
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
        <div class="pdf6_header">
            <div class="page6-title">SALES COMPARABLES</div>
            <p>PROPERTIES THAT HAVE RECENTLY SOLD</p>
        </div>
        <div class="pdf-body">
            <div class="grid">
                <div class="col-6">
                    <div class="property-tile">
                        <img src="<?php echo base_url("assets/reports/english/seller/4/img/location-tile.png"); ?>" class="img-fluid" alt="">
                        <div class="page6-property-name">
                            <div class="page6-address"><img src="<?php echo base_url("assets/reports/english/seller/4/img/location-pin.png"); ?>" alt=""> 1889 BONITA AVE LA VERNE</div>
                            <div class="sale-price" style="margin-left: 4px;">Sale Price <b>$631,500</b></div>
                        </div>
                        <div class="page6-property-detail">
                            <table>
                                <tr>
                                    <td>
                                        Sold Date<br>5/10/2023
                                    </td>
                                    <td>
                                        Dist<br>0.5
                                    </td>
                                    <td>
                                        Sq.ft<br>940
                                    </td>
                                    <td>
                                        $/Sqft<br>$671
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Bed/Bath<br>2/1
                                    </td>
                                    <td>
                                        Year Bit<br>1952
                                    </td>
                                    <td>
                                        Lot Area<br>5,246
                                    </td>
                                    <td>
                                        Pool<br>No
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="property-tile">
                        <img src="<?php echo base_url("assets/reports/english/seller/4/img/location-tile.png"); ?>" class="img-fluid" alt="">
                        <div class="page6-property-name">
                            <div class="page6-address"><img src="<?php echo base_url("assets/reports/english/seller/4/img/location-pin.png"); ?>" alt=""> 1507 2ND ST LA VERNE</div>
                            <div class="sale-price" style="margin-left: 30px;">Sale Price <b>$635,000</b></div>
                        </div>
                        <div class="page6-property-detail">
                            <table>
                                <tr>
                                    <td>
                                        Sold Date<br>3/15/2023
                                    </td>
                                    <td>
                                        Dist<br>0.24
                                    </td>
                                    <td>
                                        Sq.ft<br>912
                                    </td>
                                    <td>
                                        $/Sqft<br>$696
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Bed/Bath<br>3/1
                                    </td>
                                    <td>
                                        Year Bit<br>1953
                                    </td>
                                    <td>
                                        Lot Area<br>7,435
                                    </td>
                                    <td>
                                        Pool<br>No
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="grid mt-20">
                <div class="col-6">
                    <div class="property-tile">
                        <img src="<?php echo base_url("assets/reports/english/seller/4/img/location-tile.png"); ?>" class="img-fluid" alt="">
                        <div class="page6-property-name">
                            <div class="page6-address"><img src="<?php echo base_url("assets/reports/english/seller/4/img/location-pin.png"); ?>" alt=""> 1845 WALNUT ST LA VERNE</div>
                            <div class="sale-price" style="margin-left: 6px;">Sale Price <b>$470,000</b></div>
                        </div>
                        <div class="page6-property-detail">
                            <table>
                                <tr>
                                    <td>
                                        Sold Date<br>4/25/2022
                                    </td>
                                    <td>
                                        Dist<br>0.58
                                    </td>
                                    <td>
                                        Sq.ft<br>770
                                    </td>
                                    <td>
                                        $/Sqft<br>$610
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Bed/Bath<br>3/1
                                    </td>
                                    <td>
                                        Year Bit<br>1924
                                    </td>
                                    <td>
                                        Lot Area<br>7,446
                                    </td>
                                    <td>
                                        Pool<br>No
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="property-tile">
                        <img src="<?php echo base_url("assets/reports/english/seller/4/img/location-tile.png"); ?>" class="img-fluid" alt="">
                        <div class="page6-property-name">
                            <div class="page6-address"><img src="<?php echo base_url("assets/reports/english/seller/4/img/location-pin.png"); ?>" alt=""> 1848 1ST ST LA VERNE</div>
                            <div class="sale-price" style="margin-left: 30px;">Sale Price <b>$590,000</b></div>
                        </div>
                        <div class="page6-property-detail">
                            <table>
                                <tr>
                                    <td>
                                        Sold Date<br>4/8/2022
                                    </td>
                                    <td>
                                        Dist<br>0.54
                                    </td>
                                    <td>
                                        Sq.ft<br>698
                                    </td>
                                    <td>
                                        $/Sqft<br>$845
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        Bed/Bath<br>1/1
                                    </td>
                                    <td>
                                        Year Bit<br>1910
                                    </td>
                                    <td>
                                        Lot Area<br>4,917
                                    </td>
                                    <td>
                                        Pool<br>No
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
