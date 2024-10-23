<style>
    .pdf1_page {
        margin: 0 auto;
        box-sizing: border-box;
        background-color: #fff;
        position: relative;
    }
    .pdf1_page > img{
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
    .mt-20 {
        margin-top: 20px;
    }

</style>
<?php
$site_address = $property->PropertyProfile->SiteAddress;

$city = ucwords(strtolower($property->PropertyProfile->SiteCity));
$state = strtoupper($property->PropertyProfile->SiteState);
$zip = strtoupper($property->PropertyProfile->SiteZip);
// echo $site_address;die;
?>
<div class="page_container">
    <div class="pdf1_page size_letter">
        <img src="<?php echo base_url("assets/reports/english/seller/4/img/image1.png"); ?>" alt="" class="img-fluid">
        <div class="pdf_header">
            <h1 class="seller-report"><b class="d-block">SELLERS</b> REPORT</h1>
            <div class="address">
                <img src="<?php echo base_url("assets/reports/english/seller/4/img/marker.png"); ?>" alt="">
                <b>
                    <?php if (isset($site_address) && !empty($site_address)) {?>
                    <?php echo ucwords(strtolower($site_address) . ','); ?>
                    <?php }?>
                </b>
                <span><?php echo ucwords(strtolower($city)); ?> <?php echo ', ' . ucwords(strtolower($state)); ?> <?php echo ', ' . ucwords(strtolower($zip)); ?></span>
            </div>
        </div>
        <div class="pdf_footer">
            <div class="grid">
                <div class="col-8 ">
                    <div class="grid mt-20">
                        <div class="col-4">
                        <?php if ($user['profile_image'] != '' && $user['profile_image'] != 'no') {?>
                            <img src="<?php echo (($callFromApi == 1) ? $user['profile_image'] : (base_url() . $user['profile_image'])); ?>" alt="<?php echo $user['fullname']; ?>" class="img-fluid zoe-dp">
                        <?php }?>
                            <!-- <img src="<?php echo base_url("assets/reports/english/seller/4/img/zoe.png"); ?>" class="img-fluid zoe-dp" alt=""> -->
                        </div>
                        <div class="col-8 ">
                            <div class="zoe-noelle">
                            <?php if (isset($user['fullname']) && !empty($user['fullname'])) {?>
                                <?php echo $user['fullname']; ?>
                            <?php }?>
                            </div>
                            <div class="realtor">
                                <?php if (isset($user['title']) && !empty($user['title'])) {?>
                                    <?php echo $user['title']; ?>
                                <?php }?>
                            </div>
                            <div class="license">CA BRE#0123456789</div>
                            <?php if (isset($user['phone']) && !empty($user['phone'])) {?>
                                <div class="contact-detail">
                                    <img src="<?php echo base_url("assets/reports/english/seller/5/img/phone.png"); ?>" alt=""> O <span><?php echo $user['phone']; ?></span>
                                </div>
                            <?php }?>
                            <?php if (isset($user['email']) && !empty($user['email'])) {?>
                                <div class="contact-detail">
                                    <img src="<?php echo base_url("assets/reports/english/seller/5/img/email.png"); ?>" alt=""> <?php echo $user['email']; ?>
                                </div>
                            <?php }?>
                            <div class="contact-detail">
                                <img src="<?php echo base_url("assets/reports/english/seller/4/img/address.png"); ?>" alt=""> 985 Success ave sucess, CA 91252
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <img src="<?php echo base_url($user['company_logo']); ?>" class="img-fluid img-flare" alt="">
                    <!-- <img src="<?php echo base_url("assets/reports/english/seller/4/img/flare.png"); ?>" class="img-fluid img-flare" alt=""> -->
                </div>
            </div>
        </div>
    </div>
</div>
