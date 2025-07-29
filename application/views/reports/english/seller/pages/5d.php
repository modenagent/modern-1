<div class="container">
    <div class="section page5">

        <header>
                <h2 class="underline title-bold">Sales Comparables</h2>
                <p> PROPERTIES THAT HAVE RECENTLY SOLD.</p>
        </header>

        <div class="">
        <?php if (sizeof($_comparables) > 0): ?>
            <?php $avaiProperty = 0;?>
            <?php foreach ($_comparables as $key => $item): ?>
                <?php
if ($key > 8) {
    break;
}
?>
                <?php if (($avaiProperty + 1) % 2): ?><!-- Start row div when odd number -->
                <div class="row vertical-align" >
                <?php endif;?>
                    <div class="col-xs-6 responsive-100">

                        <h5 class="arrow"> <?php echo $item['Address']; ?> </h5>

                        <div class="map1" id='map1'>
                            <?php
if (!empty($item['img'])): ?>
                                <img src="<?php echo $item['img']; ?>" class="img-fluid" alt="<?php echo $item['Address']; ?>" style="width:100%;max-width: 100%;height: auto;" >
                            <?php
else:
?>
                            <img src="https://maps.googleapis.com/maps/api/staticmap?zoom=14&size=180x100&maptype=roadmap&markers=color:0x<?php echo str_replace("#", "", $theme); ?>%7Clabel:S%7C<?php echo $item['Latitude'] . ',' . $item['Longitude']; ?>&style=feature:water|element:geometry.fill|color:0xd3d3d3&style=feature:transit|color:0x808080|visibility:off&style=feature:road.highway|element:geometry.stroke|visibility:on|color:0xb3b3b3&style=feature:road.highway|element:geometry.fill|color:0xffffff&style=feature:road.local|element:geometry.fill|visibility:on|color:0xffffff|weight:1.8&style=feature:road.local|element:geometry.stroke|color:0xd7d7d7&style=feature:poi|element:geometry.fill|visibility:on|color:0xebebeb&style=feature:administrative|element:geometry|color:0xa7a7a7&style=feature:road.arterial|element:geometry.fill|color:0xffffff&style=feature:road.arterial|element:geometry.fill|color:0xffffff&style=feature:landscape|element:geometry.fill|visibility:on|color:0xefefef&style=feature:road|element:labels.text.fill|color:0x696969&style=feature:administrative|element:labels.text.fill|visibility:on|color:0x737373&style=feature:poi|element:labels.icon|visibility:off&style=feature:poi|element:labels|visibility:off&style=feature:road.arterial|element:geometry.stroke|color:0xd6d6d6&style=feature:road|element:labels.icon|visibility:off&style=feature:poi|element:geometry.fill|color:0xdadada&key=AIzaSyCABfewmARxxJI0N1SUWOaoS3dfYiXhSDg"
                                        style="width:100%;"   alt=""/>
                            <?php endif;?>
                        </div>

                        <div class="btn-group price-button-group">

                            <button type="button" style="font-size:17px; font-family: montserrat; letter-spacing:2px; border-color:<?php echo $theme; ?>; background-color:<?php echo $theme; ?>;" class="btn btn-default pull-left"> SALE PRICE </button>
                            <button type="button" style="font-size:17px; border-color:<?php echo $theme; ?>;"class="btn btn-warning"> <?php echo $item['Price']; ?> </button>

                        </div>

                        <table class="table table-top-sales responsive-100">
                            <tbody>
                                <tr class="gray-color">
                                        <td style="padding-right: 80px;">Days on Market</td>
                                        <td> Dist. </td>
                                        <td> Sqft. </td>
                                        <td> $/Sqft </td>
                                </tr>

                                <tr class="text-mybold">
                                        <td style="padding-right: 80px;"> <?php echo $item['DaysOnMarket']; ?> </td>
                                        <td><?php echo isset($item['Distance']) && !empty($item['Distance']) ? $item['Distance'] : '-'; ?></td>
                                        <td><?php echo isset($item['SquareFeet']) && !empty($item['SquareFeet']) ? $item['SquareFeet'] : '-'; ?></td>
                                        <td> <?php echo isset($item['PricePerSQFT']) && !empty($item['PricePerSQFT']) ? '$' . $item['PricePerSQFT'] : '-'; ?> </td>
                                </tr>

                                <tr class="gray-color">
                                        <td style="padding-right: 80px;">Bed/Bath</td>
                                        <td> Year Bit </td>
                                        <td> Lot Area </td>
                                        <td> Pool </td>
                                </tr>

                                <tr class="text-mybold">
                                        <td style="padding-right: 80px;"> <?php echo $item['Beds']; ?>/<?php echo $item['Baths']; ?> </td>
                                        <td><?php echo $item['Year']; ?></td>
                                        <td><?php echo $item['LotSize']; ?></td>
                                        <td><?php echo $item['Pool']; ?></td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                <?php if ((($avaiProperty) % 2) || ($avaiProperty + 1) == count($_comparables) || $key == 8): ?><!-- End row div when even number or it is last item -->
                </div>
                <?php endif;?>
                <?php $avaiProperty++;?>
            <?php endforeach;?>
        <?php endif;?>
        </div>
    </div>
</div>
