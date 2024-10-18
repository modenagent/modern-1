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
    .pdf7_header {
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
        height: 615px;
        width: 100%;
        object-fit: cover;
        object-position: top;
    }
    .page7-title {
        font-size: 40px;
        font-weight: 700;
        color: #3fbfb0;
        background: url(<?php echo base_url("assets/reports/english/seller/4/img/title-decoration.png"); ?>) no-repeat;
        background-size:460px 8px;
        background-position: center right;
        line-height: 50px
    }
    .pdf7_header p {
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
        background: #152170;
        padding: 20px;
        color: #fff;
        font-weight: 700;
        text-align: center;
        margin-bottom: 20px;
    }
    .property-detail .number{
        font-size: 60px;
        color: #3fbfb0;
        line-height: 60px;
    }
</style>
<div class="page_container">
    <div class="pdf_page size_letter">
        <div class="pdf7_header">
            <div class="page7-title">RANGE OF SALES</div>
            <p>BASED ON RECENT COMPARABLE SALES.</p>
        </div>
        <div class="pdf-body">
            <img src="<?php echo base_url("assets/reports/english/seller/4/img/location.png"); ?>" class="img-fluid location-map" alt="">
            <div class="property-detail">
                <div class="grid">
                    <div class="col-3">
                        <div class="number">04</div>Total Comps
                    </div>
                    <div class="col-3">
                        <div class="number">830</div>Avg. Soft</div>
                    <div class="col-3">
                        <div class="number">02</div>Avg. #Beds
                    </div>
                    <div class="col-3">
                        <div class="number">01</div>Avg. #Baths
                    </div>
                </div>
            </div>
            <img src="<?php echo base_url("assets/reports/english/seller/4/img/price-range.png"); ?>" class="img-fluid mx-auto d-block" alt="">
            <p class="text-center f14">
                Above are the average property details for homes that are close in proximity to yours AND have been sold within<br>
                the last 12-months. The range represents the low AND the high sales price for the properties that were sold in the<br>
                last 12-months. Only the properties that closely match yours were used. The factors that were analzyed were<br>
                Square Footage, No. Of Beds, No. of Baths, & Lot Size.
            </p>
        </div>
    </div>
</div>
