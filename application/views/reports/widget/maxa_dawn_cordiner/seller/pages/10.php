<page class="pdf10">
    <h1 class="main_title top_title">Sales Comparables</h1>
    <?php
        if(isset($comparables) && !empty($comparables))
        {
            $count = 0;

            foreach ($comparables as $key => $value) 
            {
                if($key > 8)
                {
                    break;
                }
                if($count==0):
                ?>
                    <div class="d-flex mt-35 row-30">
                <?php elseif($count==2):?>
                    <div class="d-flex mt-20 row-30">
            	<?php endif; ?>

            		<div class="col-50">
			             <div class="house_pricing">
			                <div class="address_title"><?php echo isset($value['Address']) && !empty($value['Address']) ? $value['Address'] : '-'; ?></div>
			                <img src="https://i.ibb.co/8NSnDM8/villa5.png" alt="villa5"  class="img-fluid">
			                <ul class="pricing_buttons">
			                    <li><a class="btn_sale">Sale Price</a></li>
			                    <li><a href="#" class="btn_price"><?php echo isset($value['Price']) && !empty($value['Price']) ? $value['Price'] : '-'; ?></a></li>
			                </ul>
			                <table class="reverse_bg">
			                    <tr>
			                        <td>Sold Date</td>
			                        <td>Dist</td>
			                        <td>Sq.ft.</td>
			                        <td>$/Sqft</td>
			                    </tr>
			                    <tr>
	                                <td><?php echo isset($value['Date']) && !empty($value['Date']) ? $value['Date'] : '-'; ?></td>
	                                <td><?php echo isset($value['Distance']) && !empty($value['Distance']) ? $value['Distance'] : '-'; ?></td>
	                                <td><?php echo isset($value['SquareFeet']) && !empty($value['SquareFeet']) ? $value['SquareFeet'] : '-'; ?></td>
	                                <td><?php echo isset($value['PricePerSQFT']) && !empty($value['PricePerSQFT']) ? '$'.$value['PricePerSQFT'] : '-'; ?></td>
	                            </tr>
			                    <tr>
			                        <td>Bed/Bath</td>
			                        <td>Year Bit</td>
			                        <td>Lot Area</td>
			                        <td>Pool</td>
			                    </tr>
			                    <tr>
			                        <td><?php echo isset($value['Beds']) && !empty($value['Beds']) ? $value['Beds'] : '-';echo isset($value['Baths']) && !empty($value['Baths']) ? '/'.$value['Baths'] : '-'; ?></td>
	                                <td><?php echo isset($value['Year']) && !empty($value['Year']) ? $value['Year'] : '-'; ?></td>
	                                <td><?php echo isset($value['LotSize']) && !empty($value['LotSize']) ? $value['LotSize'] : '-'; ?></td>
	                                <td><?php echo isset($value['Pool']) && !empty($value['Pool']) ? $value['Pool'] : '-'; ?></td>
			                    </tr>
			                </table>
			             </div>
			        </div>


            	<?php
            	if($count == 1 || $count == 3): ?>
            	</div>
            	<?php endif;

            	$count++;
            }
        }
    ?>
</page>