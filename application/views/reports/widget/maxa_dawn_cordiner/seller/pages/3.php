<page class="pdf2 p-0">
    
    <div class="d-flex no_gutter">
        <div class="col-60 p-50">
            <h2 class="small_big"><span>MEET </span> <?php if(!empty($user['first_name'])) {echo $user['first_name'];} ?> <?php if(!empty($user['last_name'])) {echo $user['last_name'];} ?></h2>
            <div class="mini_line mx-0"></div>
            <?php 
            if(isset($bio) && !empty($bio))
            {
	        ?>
	            
            <p class="text-justify mt-0"><?php echo trim($bio); ?></p>
	                
	        <?php
	           }
	        ?>
        </div>
        <div class="col-40">
        	<?php
        	if($user['profile_image'] != '' && $user['profile_image'] != 'no') { ?>
            <img src="<?php echo base_url().$user['profile_image']; ?>" alt="profile-pic" class="img-fluid">
        	<?php } ?>
        </div>
    </div>

    <div class="d-flex orange_bg">

    	<?php
            if(isset($testimonials) && !empty($testimonials))
            {
                list($upper_testimonial, $lower_testimonial) = array_chunk($testimonials, ceil(count($testimonials) / 2));

                if(isset($upper_testimonial) && !empty($upper_testimonial))
                {
            	?>
                    <div class="col-50">
                    	<h2 class="small_big white">
			                <span>CLIENTS</span>
			                LOVE US!
			            </h2>
			            <div class="mini_line mx-0 white"></div>
                    <?php

                        foreach ($upper_testimonial as $key => $value) 
                        {
                    ?>
                            <div class="feedback">
                                <p> <?php echo trim($value['content']); ?></p>
                                <div class="username"><?php echo $value['name']; ?> </div>
                            </div>
                    <?php
                        }
                    ?>
                    </div>
                <?php
                }

                if(isset($lower_testimonial) && !empty($lower_testimonial))
                {
            	?>
                    <div class="col-50">
                    <?php

                        foreach ($lower_testimonial as $k => $v) 
                        {
                    ?>
                            <div class="feedback">
                                <p> <?php echo trim($v['content']); ?></p>
                                <div class="username"><?php echo $v['name']; ?></div>
                            </div>
                    <?php
                        }
                    ?>
                    </div>
                <?php
                }
            }
            else
            {
        	?>
                <div class="feedback"><div class="username">No Testimonials Found.</div></div>
        	<?php
            }
        	?>

    </div>
</page>