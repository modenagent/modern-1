<style>
    .pdf_page > img{
        height: 870px;
        width: 100%;
    }
    .pdf_header {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        padding: 40px 0;
        text-align: center;
    }
    .img-fluid{
        max-width: 100%;
        height: auto;
    }
    .d-block{
        display: block;
    }
    .pdf_header h1.seller-report {
        font-size: 65px;
        color: #fff;
        margin: 65px 0 0;
        line-height: 65px;
        font-weight: 300;
        text-align: left;
        padding-left: 35px;
    }
    .pdf_header h1.seller-report  b{
        color: #152170;
    }
    .address {
        max-width: 365px;
        margin-top: 120px;
        text-align: center;
        color: #fff;
    }
    .address img{
        display: block;
        margin: 0 auto 10px;
    }
    .address b {
        font-size: 45px;
        color: #16d3ba;
        display: block;
    }
    .address span {
        font-size: 22px;
        width: 211px;
        display: block;
        margin: 0 auto;
        padding-top: 8px;
        border-top: 1px solid #fff;
    }
    .pdf_footer {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding-top: 10px;
        text-align: left;
        font-size: 16px;
    }
    .pdf_footer p{
        margin: 0;
    }
    .page_text{
        float: right;
    }
    .page_title{
        float: left;
    }
    .pdf_body {
        position: absolute;
        top: 290px;
        bottom: 1.2in;
        left: 0;
        right: 0;
    }
    .zoe-dp{
        width: 160px;
        border-radius: 50px
    }
    .zoe-noelle {
        font-size: 18px;
        font-weight: 700;
        color: #000;
    }
    .realtor {
        color: #16d3ba;
        font-weight: 600;
    }
    .contact-detail img{
        width: 14px;
        margin-right: 5px;
    }
    .contact-detail,.license{
        font-size: 14px;
        color: #000;
        margin-bottom: 3px;
    }
    .license{
        text-decoration: underline;
        text-decoration-color: #1bd0b9;
        text-underline-offset: 5px;
        margin-bottom: 10px;
        text-decoration-thickness: 2px;
    }
    .grid::after{
        display: table;
        content: '';
        width: 100%;
    }
    .grid > .col-3 {
        float: left;
        width: 25%;
        text-align: center;
    }
    .grid > .col-6 {
        float: left;
        width: 50%;
    }
    .grid > .col-4 {
        float: left;
        width: 33%;
    }
    .grid > .col-8 {
        float: left;
        width: 67%;
    }
    .img-flare{
        width: 160px;
    }
</style>

<div class="page_container">
    <div class="pdf_page size_letter">
        <img src="<?php echo base_url("assets/reports/english/seller/4/img/image1.png"); ?>" alt="" class="img-fluid">
        <div class="pdf_header">
            <h1 class="seller-report"><b class="d-block">SELLERS</b> REPORT</h1>
            <div class="address">
                <img src="<?php echo base_url("assets/reports/english/seller/4/img/marker.png"); ?>" alt="">
                <b>1358 5TH ST</b>
                <span>LA VERNE, CA 91 750</span>
            </div>
        </div>
        <div class="pdf_footer">
            <div class="grid">
                <div class="col-8">
                    <div class="grid">
                        <div class="col-4">
                            <img src="<?php echo base_url("assets/reports/english/seller/4/img/zoe.png"); ?>" class="img-fluid zoe-dp" alt="">
                        </div>
                        <div class="col-8">
                            <div class="zoe-noelle">ZOE NOELLE</div>
                            <div class="realtor">Realtor</div>
                            <div class="license">CA BRE#0123456789</div>
                            <div class="contact-detail">
                                <img src="<?php echo base_url("assets/reports/english/seller/4/img/phone.png"); ?>" alt=""> 2133097286
                            </div>
                            <div class="contact-detail">
                                <img src="<?php echo base_url("assets/reports/english/seller/4/img/share.png"); ?>" alt=""> infp@modernagent.io
                            </div>
                            <div class="contact-detail">
                                <img src="<?php echo base_url("assets/reports/english/seller/4/img/address.png"); ?>" alt=""> 985 Success ave sucess, CA 91252
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <img src="<?php echo base_url("assets/reports/english/seller/4/img/flare.png"); ?>" class="img-fluid img-flare" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
