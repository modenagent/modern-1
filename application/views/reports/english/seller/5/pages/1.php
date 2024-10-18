<style>
    .page-title {
        font-size: 80px;
        line-height: 80px;
        color: #152270;
        font-family: 'BebasNeue Book';
    }
    .page-title span{
        color: #d79547;
        font-family: "Bebas Neue", sans-serif;
    }
    .pdf_header {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        padding: 30px 0;
        text-align: center;
        height: 130px;
    }
    .blue-bar{
        position: absolute;
        bottom: 0;
        max-width: 330px;
        left: 40px;
    }
    .pdf-body{
        position: absolute;
        top: 130px;
        left: 0;
        right: 0;
    }
    .img-fluid{
        max-width: 100%;
        height: auto;
    }
    .d-block{
        display: block;
    }
    .position-relative{
        position: relative;
    }
    .address {
        width: 330px;
        margin-top: 0;
        text-align: center;
        color: #fff;
        position: absolute;
        left: 40px;
        bottom: 180px;
    }
    .address b {
        font-size: 40px;
        color: #fff;
        display: block;
        line-height: 50px;
        margin-bottom: 60px;
        margin-top: 20px;
    }
    .address img {
        display: block;
        margin: 0 auto 10px;
        width: 60px;
    }
    .the-agency {
        width: 400px;
        right: 0;
        position: absolute;
        bottom: 50px;
        font-size: 14px;
    }
    .pdf_body {
        position: absolute;
        top: 290px;
        bottom: 1.2in;
        left: 0;
        right: 0;
    }
    .authenticity {
        font-size: 20px;
        font-weight: 700;
        margin-bottom: 5px;
    }
    .the-agency img {
        width: 96px;
        right: -22px;
        position: relative;
        top: 2px;
    }
    .the-agency p{
        margin-top: 0;
    }
    .realtor-info{
        position: absolute;
        bottom: 50px;
        width: 265px;
        left: 60px;
    }
    .contact-me {
        font-size: 11px;
        color: #fff;
        margin-bottom: 40px;
        text-align: center;
        text-decoration: underline;
        text-decoration-color: #d79547;
        text-decoration-thickness: 2px;
        text-underline-offset: 6px;
    }
    .jerry-dp {
        width: 60px;
        border-radius: 50px;
    }
    .jerry-hernandez{
        font-size: 20px;
        font-weight: 700;
        color: #fff;
    }
    .realtor {
        color: #d79547;
        font-weight: 600;
        margin: 5px 0;
    }
    .contact-detail img{
        width: 14px;
        margin-right: 5px;
    }
    .contact-detail{
        font-size: 14px;
        color: #fff;
        margin-bottom: 3px;
    }
    .grid::after{
        display: table;
        content: '';
        width: 100%;
    }
    .col-4{
        width: 33%;
        float: left;
    }
    .col-8{
        float: left;
        width: 67%;
    }
</style>
<div class="page_container">
    <div class="pdf_page size_letter">
        <div class="pdf_header">
            <div class="page-title"><span>SELLER</span> REPORT</div>
        </div>
        <div class="pdf-body">
            <img src="<?php echo base_url("assets/reports/english/seller/5/img/hero.png"); ?>" class="img-fluid" alt="">
        </div>
        <div class="pdf_footer">
            <img src="<?php echo base_url("assets/reports/english/seller/5/img/blue-bar"); ?>.png" class="blue-bar" alt="">
            <div class="address">
                <img src="<?php echo base_url("assets/reports/english/seller/5/img/marker.png"); ?>" alt="">
                <b>
                    13585TH ST,<br>
                    LAVER NE,<br>
                    CA, 91750
                </b>
                <div class="contact-me">For more information, please contact me.</div>

            </div>
            <div class="realtor-info">
                <div class="grid">
                    <div class="col-4">
                        <img src="<?php echo base_url("assets/reports/english/seller/5/img/jerry.png"); ?>" class="img-fluid jerry-dp" alt="">
                    </div>
                    <div class="col-8">
                        <div class="jerry-hernandez">Jerry Hernandez</div>
                        <div class="realtor">Realtor</div>
                        <div class="contact-detail">
                            <img src="<?php echo base_url("assets/reports/english/seller/5/img/phone.png"); ?>" alt=""> 2133097296
                        </div>
                        <div class="contact-detail">
                            <img src="<?php echo base_url("assets/reports/english/seller/5/img/email.png"); ?>" alt=""> info@modernagent.io
                        </div>
                    </div>
                </div>
            </div>
            <div class="the-agency">
                <div class="grid">
                    <div class="col-4">
                        <img src="<?php echo base_url("assets/reports/english/seller/5/img/agency.png"); ?>" class="img-fluid" alt="">
                    </div>
                    <div class="col-8">
                        <div class="authenticity">
                            AUTHENTICITY ABOVE ALL.
                        </div>
                        <p>
                            This is not intended to solicit currently <br>
                            listed properties. This information is<br>
                            deemed reliable, but not guaranteed.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
