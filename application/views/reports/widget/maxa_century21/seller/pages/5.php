    <page class="pdf4">
        <h2 class="small_big">PORTFOLIO AT A GLANCE<span> FEATURED LIST OF HOMES SOLD</span></h2>
        <p class="mt-30">
            <?php 
                if(!empty($page['portfolio_txt'])) {
                    echo  nl2br($page['portfolio_txt']);
                }
            ?>
        </p>
        <div class="d-flex mt-50"> 
        <?php
        foreach ($featured_homes as $key => $featured_home) {
            if($key == 4) {break;} 
            ?>
            <?php if($key==2):?> <div class="d-flex"> <?php endif;?>
                <div class="col-50">
                    <img src='<?php echo base_url($featured_home->image);?>' alt="villa1"  class="img-fluid villa_img">
                    <p class="product_detail">
                        <b>SOLD FOR $<?php echo number_format($featured_home->price) ?></b>
                       <span> <?php echo $featured_home->address; ?> <br> <?php echo $featured_home->city; ?></span>
                    </p>
                </div>

                <?php if($key==1 && count($featured_homes) >2 ):?> </div> <?php endif;?>
        <?php }
        ?>
        </div>
    </page>