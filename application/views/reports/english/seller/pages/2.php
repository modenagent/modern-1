<div class="container">
<page class="pdf2">
    <div class="d-flex">
        <h1 class="main_title top_title">Meet Your Agent</h1>
    </div>
    <div class="d-flex mt-60">
        <div class="col-60">
            <div class="d-flex">
                <?php 
                    if($user['profile_image'] != '' && $user['profile_image'] != 'no')
                    {
                ?>  
                        <img src="<?php if($callFromApi == 1) echo $user['profile_image']; else echo base_url().$user['profile_image']; ?>" alt="<?php echo $user['fullname']; ?>" border="0" class="col-50 profile_pic">
                <?php
                    }
                ?>

                <div class="signature vertical_sign col-40">
                    <img src="<?php echo base_url().'assets/reports/english/seller/images/1/line.png' ?>" alt="line" border="0" class="img-fluid">

                    <h2 class="profile_name"><?php echo $user['fullname']; ?></h2>
                    <p class="profile_title"><?php echo $user['title']; ?></p>
                    <img src="<?php echo base_url().'assets/reports/english/seller/images/1/line.png' ?>" alt="line" border="0" class="img-fluid">
                    <a class="tel_number" href="tel:<?php echo $user['phone']; ?>">M <span><?php echo $user['phone']; ?></span></a>
                    <a href="mailto:<?php echo $user['email']; ?>" class="contact_info mt-20"><?php echo $user['email']; ?></a>
                </div>
            </div>
        </div>
        <div class="col-40">
            <p class="text-justify">Ad renatuasta, con vignonferor horum in
                dem morunt. Scibull atiam. Uli, conlostil ta
                iti, quod di sentem mum, sentesimis? </p>
            <p class="text-justify">Patis etili, quo aperfi nia viricii speriore
                noverem eretius cus, vis etemquem dent?
                Ici ine audees parbemus, consulistra
                consis. Aritra acre faciendius et? que furi
                tum non. Tion cus periate ctatemolut laute
                quam as ea coribearum quam, autate
                si tem quiae porrundionet quas etur
                sequatur moloreperum sequost.</p>
        </div>
    </div>

    <div class="d-flex mt-60 pad">
    	<?php
    		if(isset($testimonials) && !empty($testimonials))
    		{
    			list($upper_testimonial, $lower_testimonial) = array_chunk($testimonials, ceil(count($testimonials) / 2));

    			if(isset($upper_testimonial) && !empty($upper_testimonial))
    			{
    		?>
    				<div class="col-50">
    				<?php

	    				foreach ($upper_testimonial as $key => $value) 
	    				{
	    			?>
							<div class="feedback">
				                <p> <?php echo $value; ?></p>
				                <div class="username"><?php echo $user['fullname']; ?> <img src="https://i.ibb.co/v1ZVZjY/rating.png" alt="rating" class="rating"></div>
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
				                <p> <?php echo $v; ?></p>
				                <div class="username"><?php echo $user['fullname']; ?> <img src="https://i.ibb.co/v1ZVZjY/rating.png" alt="rating" class="rating"></div>
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
    			<div class="username">No Testimonials Found.</div>
    	<?php
    		}
    	?>
    </div>
</page>
</div>