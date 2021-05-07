
    <page class="pdf4 px-30">
        <h1 class="mt-20">TESTIMONIALS</h1>
        <div class="testimonial_box">

        <?php
        if(isset($testimonials) && !empty($testimonials))
        {
            list($upper_testimonial, $lower_testimonial) = array_chunk($testimonials, ceil(count($testimonials) / 2));

            if(isset($upper_testimonial) && !empty($upper_testimonial))
            {
                ?>
                <div class="d-flex">
                    <?php

                    foreach ($upper_testimonial as $key => $value) 
                    { ?>
                        <div class="col-50">
                            <p>
                                <?php echo trim($value['content']); ?>
                            </p>
                            <img src='<?php echo base_url("assets/reports/widget/$report_dir_name/$presentation_type/images/rating.png");?>' alt="rating">
                            <div class="feedbacker_name">- <?php echo $value['name']; ?></div>
                    </div>
                    <?php }
                    ?>
                </div>
            <?php }

            if(isset($lower_testimonial) && !empty($lower_testimonial))
            {
            ?>
            <div class="d-flex mt-50">
            <?php

                foreach ($lower_testimonial as $k => $v) 
                { ?>
                    <div class="col-50">
                        <p><?php echo trim($v['content']); ?></p>
                        <img src='<?php echo base_url("assets/reports/widget/$report_dir_name/$presentation_type/images/rating.png");?>' alt="rating">
                        <div class="feedbacker_name">- <?php echo $v['name']; ?></div>
                    </div>

               <?php } ?>
            </div>
            <?php }

        }
        ?>


        </div>
    </page>
