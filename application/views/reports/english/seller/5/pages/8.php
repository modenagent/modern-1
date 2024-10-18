<style>
    .img-fluid{
        max-width: 100%;
        height: auto;
    }
    .text-center{
        text-align: center;
    }
    .f14{
        font-size: 14px;
    }
    .mx-auto{
        margin: 0 auto;
    }
    .d-block{
        display: block;
    }
    .page8_pdf_header {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        padding-bottom: 20px;
        text-align: left;
        color: #ffff;
        height: 110px;
    }
    .pdf-body{
        position: absolute;
        top: 110px;
        left: 0;
        right: 0;
    }
    .location-map{
        height: 500px;
        width: 100%;
        object-fit: cover;
        object-position: top;
    }
    .page8-page-title {
        font-family: 'BebasNeue Book';
        font-size: 80px;
        line-height: 70px;
        color: #152270;
        text-align: center;
        }
    .page8-page-title span{
        font-family: "Bebas Neue", sans-serif;
        color: #d79547;
        }
    .page8_pdf_header p {
        font-size: 18px;
        color: #000;
        font-weight: 500;
        margin: 0;
    }
    .grid::after{
        display: table;
        content: '';
        width: 100%;
    }
    .grid > .col-3 {
        float: left;
        width: 25%;
    }
    .property-detail {
        background: url(<?php echo base_url("assets/reports/english/seller/5/img/decorator-h.png"); ?>) no-repeat #152170;
        background-size: 65%;
        padding: 20px;
        color: #fff;
        font-weight: 700;
        text-align: center;
        margin-top: 30px;
        margin-bottom: 40px;
        background-position: center;
    }
    .property-detail .number{
        font-size: 84px;
        line-height: 84px;
        font-family: 'BebasNeue Regular';
        color: #d79547;
    }
    .property-detail + img{
        margin-bottom: 40px;
    }
</style>
<div class="page_container">
    <div class="pdf_page size_letter">
        <div class="page8_pdf_header">
            <div class="page8-page-title">RANGE OF <span>SALES</span></div>
        </div>
        <div class="pdf-body">
            <img src="<?php echo base_url("assets/reports/english/seller/5/img/map.png"); ?>" class="img-fluid location-map" alt="">
            <div class="property-detail">
                <div class="grid">
                    <div class="col-3">
                        <div class="number">07</div>Total Comps
                    </div>
                    <div class="col-3">
                        <div class="number">112</div>Avg. Soft</div>
                    <div class="col-3">
                        <div class="number">02</div>Avg. #Beds
                    </div>
                    <div class="col-3">
                        <div class="number">01</div>Avg. #Baths
                    </div>
                </div>
            </div>
            <img src="<?php echo base_url("assets/reports/english/seller/5/img/price-range.png"); ?>" class="img-fluid mx-auto d-block" alt="">
            <p class="text-center f14">
                Above are the average property details for homes that are close in proximity to yours AND have been sold within<br>
                the last 12-months. The range represents the low AND the high sales price for the properties that were sold in the<br>
                last 12-months. Only the properties that closely match yours were used. The factors that were analzyed were<br>
                Square Footage, No. Of Beds, No. of Baths, & Lot Size.
            </p>
        </div>
    </div>
</div>
