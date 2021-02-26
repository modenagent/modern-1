<div class="container">
<page class="pdf2">
    <div class="d-flex">
        <h1 class="main_title top_title">Meet Your Agent</h1>
    </div>
    <div class="d-flex mt-60">
        <div class="col-60">
            <div class="d-flex">
                <img src="https://i.ibb.co/qyHKv61/laura-chouette-nk-Wnc-W-GP8-unsplash.jpg" alt="laura-chouette-nk-Wnc-W-GP8-unsplash"
                    border="0" class="col-50 profile_pic">
                <div class="signature vertical_sign col-40">
                    <img src="https://i.ibb.co/LRwvgXQ/line.png" alt="line" class="img-fluid">
                    <h2 class="profile_name">First<br>Last</h2>
                    <p class="profile_title">Realtor®</p>
                    <img src="https://i.ibb.co/LRwvgXQ/line.png" alt="line" class="img-fluid">
                    <a class="tel_number  mt-30" href="tel:000.000.0000">O   &nbsp;<span>000.000.0000</span></a>
                    <a class="tel_number" href="tel:000.000.0000">M <span>000.000.0000</span></a>
                    <a href="mailto:name@domain.com" class="contact_info mt-20">name@domain.com</a>
                    <a href="https://hometownerealestate.net" class="contact_info">hometownerealestate.net</a>
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