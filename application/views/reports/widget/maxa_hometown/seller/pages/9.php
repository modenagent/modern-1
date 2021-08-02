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
                <?php if($count==0):?>
                    <div class="d-flex mt-35 row-30">
                <?php elseif($count==2):?>
                    <div class="d-flex mt-20 row-30">
                <?php endif; ?>
                <div class="col-50">
                    <div class="house_pricing">
                        <div class="address">
                            <?php echo isset($value['Address']) && !empty($value['Address']) ? $value['Address'] : '-'; ?>                          
                        </div>
                        <?php
                            if($use_rets_api == 1)
                            {
                        ?> 
                                <img src="<?php echo $value['img']; ?>" alt="<?php echo $value['Address']; ?>" class="img-fluid">
                        <?php
                            }
                            else
                            {
                        ?>
                                <img src="https://maps.googleapis.com/maps/api/staticmap?zoom=14&size=180x100&maptype=roadmap&markers=color:color:0xf2964a%7Clabel:S%7C<?php echo $value['Latitude'].','.$value['Longitude']; ?>&style=feature:water|element:geometry.fill|color:0xd3d3d3&style=feature:transit|color:0x808080|visibility:off&style=feature:road.highway|element:geometry.stroke|visibility:on|color:0xb3b3b3&style=feature:road.highway|element:geometry.fill|color:0xffffff&style=feature:road.local|element:geometry.fill|visibility:on|color:0xffffff|weight:1.8&style=feature:road.local|element:geometry.stroke|color:0xd7d7d7&style=feature:poi|element:geometry.fill|visibility:on|color:0xebebeb&style=feature:administrative|element:geometry|color:0xa7a7a7&style=feature:road.arterial|element:geometry.fill|color:0xffffff&style=feature:road.arterial|element:geometry.fill|color:0xffffff&style=feature:landscape|element:geometry.fill|visibility:on|color:0xefefef&style=feature:road|element:labels.text.fill|color:0x696969&style=feature:administrative|element:labels.text.fill|visibility:on|color:0x737373&style=feature:poi|element:labels.icon|visibility:off&style=feature:poi|element:labels|visibility:off&style=feature:road.arterial|element:geometry.stroke|color:0xd6d6d6&style=feature:road|element:labels.icon|visibility:off&style=feature:poi|element:geometry.fill|color:0xdadada&key=AIzaSyCABfewmARxxJI0N1SUWOaoS3dfYiXhSDg"  class="img-fluid">
                        <?php
                            }
                        ?>
                        
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
        else
        {
    ?>
            <div class="d-flex">
                <div class="col-12">
                    <h4 class="m-0 sub_title">No Comparables Found.</h4>
                </div>
            </div>
    <?php
        }
    ?>
</page>