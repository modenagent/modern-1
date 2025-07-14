    <page class="pdf8">
        <div class="gray_title">
            <h2 class="small_big">Sales Comparables <span>PROPERTIES THAT HAVE RECENTLY SOLD</span></h2>
        </div>
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
                    <div class="d-flex row-30">
                <?php elseif($count==2):?>
                    <div class="d-flex mt-20 row-30">
                <?php endif; ?>

                    <div class="col-50">
                         <div class="house_pricing">
                            <div class="address_title"><?php echo isset($value['Address']) && !empty($value['Address']) ? $value['Address'] : '-'; ?></div>
                            <img src="<?php echo $value['img'] ?>"  class="img-fluid">
                            <ul class="pricing_buttons">
                                <li><a class="btn_sale">Sale Price</a></li>
                                <li><a href="#" class="btn_price"><?php echo isset($value['Price']) && !empty($value['Price']) ? $value['Price'] : '-'; ?></a></li>
                            </ul>
                            <table>
                                <tr>
                                    <td>Days on Market</td>
                                    <td>Dist</td>
                                    <td>Sq.ft.</td>
                                    <td>$/Sqft</td>
                                </tr>
                                <tr>
                                    <td><?php echo isset($value['DaysOnMarket']) && !empty($value['DaysOnMarket']) ? $value['DaysOnMarket'] : '-'; ?></td>
                                    <td><?php echo isset($value['Distance']) && !empty($value['Distance']) ? $value['Distance'] : '-'; ?></td>
                                    <td><?php echo isset($value['SquareFeet']) && !empty($value['SquareFeet']) ? $value['SquareFeet'] : '-'; ?></td>
                                    <td><?php echo isset($value['PricePerSQFT']) && !empty($value['PricePerSQFT']) ? $value['PricePerSQFT'] : '-'; ?></td>
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
                                    <td><?php echo isset($value['Pool']) && !empty($value['Pool']) ? substr($value['Pool'], 0, 15) : '-'; ?></td>
                                </tr>
                            </table>
                         </div>
                    </div>


                <?php
                if($count == 1 || $count == 3 || count($comparables) == ($count+1) ): ?>
                </div>
                <?php endif;

                $count++;
            }
        }
        ?>

    </page>