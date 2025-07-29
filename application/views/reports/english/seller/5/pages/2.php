<style>
    .pdf_header {
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      padding: 40px 0;
      text-align: center;
    }
    .pdf-body {
      position: absolute;
      top: 200px;
      left: 0;
      right: 0;
    }
    .page-title {
      font-family: 'BebasNeue Book';
      font-size: 80px;
      line-height: 70px;
      color: #152270;
    }
    .text-center{
      text-align: center;
    }
    .page-title span{
      font-family: "Bebas Neue", sans-serif;
      color: #d79547;
    }
    .img-fluid{
      max-width: 100%;
      height: auto;
    }
    .d-block{
      display: block;
    }
    img.decor-img {
      width: 300px;
      /* margin-top: -20px; */
    }
    .thankyou-msg {
      font-size: 20px;
      text-align: center;
      margin-top: 40px;
      margin-bottom: 60px;
      line-height: 30px;
    }
    .divider{
      background-color: #d79547;
      height:2px;
      width:400px;
      margin: 20px auto;
    }
    .thankyou-msg + .mx-auto{
      margin:0 auto;
      display: block;
      width: 220px;
    }
</style>

<div class="page_container">
    <div class="pdf_page size_letter">
        <img src="<?php echo base_url("assets/reports/english/seller/5/img/decorator.png"); ?>" alt="" class="img-fluid decor-img">
        <div class="pdf-body">
            <div class="page-title text-center">DEAR<br><span>OWNER</span></div>
            <div class="thankyou-msg">
            <p>
                Thank you for listing your home with us. We pride<br>
                ourselves on delivering extraordinary service led by<br>
                expertise, integrity, and a commitment to achieving all of<br>
                your real estate goals.
            </p>
            <div class="divider"></div>
            <p>
                Selling a home is a rewarding experience: From listing to<br>
                closing and beyond, you have a dedicated real estate<br>
                expert at your side, guiding you through the transaction<br>
                and leading the way to incredible results.
            </p>
            </div>
            <img src="<?php echo base_url("assets/reports/english/seller/5/img/thank you.png"); ?>" class="img-fluid mx-auto" alt="">
        </div>
    </div>
</div>
