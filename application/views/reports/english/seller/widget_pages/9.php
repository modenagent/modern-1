<page class="pdf9">
    <h1 class="main_title top_title">Sales Comparables</h1>
    <img src="<?php echo base_url().'assets/reports/english/seller/images/1/line.png'; ?>" alt="line" class="bordered_img">
    <div class="d-flex">
        <div class="col-12">
            <h4 class="m-0 sub_title">Properties that have Recently Sold</h4>
        </div>
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
    ?>
                <?php if(($count+1) % 2):?>
                    <div class="d-flex mt-35 row-30">
                <?php endif; ?>
                <div class="col-50">
                    <div class="house_pricing">
                        <div class="address">
                            <?php echo isset($value['Address']) && !empty($value['Address']) ? $value['Address'] : '-'; ?>                          
                        </div>
                        <img src="https://i.ibb.co/Nxb33RM/24ad-Traditional.jpg" alt="24ad-Traditional" class="img-fluid">
                        <ul class="pricing_buttons">
                            <li>
                                <a class="btn_sale">Sale Price</a>
                            </li>
                            <li>
                                <a href="javascript:void(0);" class="btn_price">    <?php echo isset($value['Price']) && !empty($value['Price']) ? $value['Price'] : '-'; ?>
                                </a>
                            </li>
                        </ul>
                        <table>
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
                <?php if((($count) % 2) || $key==8 || ($count+1) == count($comparables)):?>
                    </div>
                <?php endif; ?>
                <?php $count++; ?>
    <?php
            }
        }
    ?>
</page>