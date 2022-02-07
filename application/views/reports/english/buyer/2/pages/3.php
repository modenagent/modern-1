<page class="certificate">
    <div class="certificate_black">
        <div class="p-50">
            <h2 class="small_big orange"><span>DICIDING TO</span>BUY</h2>
            <div class="mini_line white"></div>
            <p>
                We wanted to congratulate you on taking the first steps
                towards homeownership. For many this is a monumental
                period in their lives. Whether this is your first home
                purchase or your second you can rest assured that you
                are in excellent hands. Our goal is to keep you in the loop
                of every detail regarding your transaction. For this very
                reason we have prepared this buyer’s proposal report
                that is a great point of reference to better understand the
                home buying process.
            
            </p>
            
            <p>
                We look forward to the closing of your transaction.
            </p>
            
            <!-- <img src="<?php echo base_url("assets/reports/english/buyer/2/images/primera-signature.png"); ?>" alt="signature" class="sign_img"> -->
            <?php 
                if(isset($user['fullname']) && !empty($user['fullname']))
                {
            ?>
                    <div class="profile_name">
                        <?php echo $user['fullname']; ?>
                    </div>
            <?php
                }
            ?>
        </div>

        <div class="welcome_text">WELCOME TO OUR FAMILY</div>
        <div class="mini_welcome">- YOU ARE IN GREAT HANDS -</div>
    </div>
</page>