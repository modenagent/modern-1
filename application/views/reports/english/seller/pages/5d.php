<div class="container">
    <div class="section page5">
	
        <header>
                <h2 class="underline title-bold">Sales Comparables</h2>
                <p> PROPERTIES THAT HAVE RECENTLY SOLD.</p>
        </header>

        <div class="">
        <?php if(sizeof($_comparables)>0): ?>
            <?php $avaiProperty = 0; ?>
            <?php foreach ($_comparables as $key => $item): ?>
                <?php 
                    if($key>8){
                        break;
                    }
                ?>
                <?php if(($avaiProperty+1) % 2):?><!-- Start row div when odd number -->
                <div class="row" >
                <?php endif; ?>
                    <div class="col-xs-6">

                        <h5 class="arrow"> <?php echo $item['Address']; ?> </h5>

                        <div class="map1" id='map1'>
                        </div>

                        <div class="btn-group price-button-group">

                            <button type="button" style="font-size:17px; font-family: montserrat; letter-spacing:2px; border-color:<?php echo $theme; ?>; background-color:<?php echo $theme; ?>;" class="btn btn-default pull-left"> SALE PRICE </button>
                            <button type="button" style="font-size:17px; border-color:<?php echo $theme; ?>;"class="btn btn-warning"> <?php echo $item['Price']; ?> </button>

                        </div>

                        <table class="table table-top-sales">
                            <tbody>
                                <tr class="gray-color">
                                        <td style="padding-right: 80px;">Sold Date</td>
                                        <td> Dist. </td>
                                        <td> Sqft. </td>
                                        <td> $/Sqft </td>
                                </tr>

                                <tr class="text-mybold">
                                        <td style="padding-right: 80px;"> <?php echo $item['Date']; ?> </td>
                                        <td> <?php echo $item['Distance']; ?> </td>
                                        <td> <?php echo $item['SquareFeet']; ?> </td>
                                        <td> $<?php echo $item['PricePerSQFT']; ?> </td>
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
                <?php if((($avaiProperty) % 2) || ($avaiProperty+1) == count($_comparables['comparable']) || $key==8):?><!-- End row div when even number or it is last item -->
                </div>
                <?php endif; ?>
                <?php $avaiProperty++; ?>
            <?php endforeach;?>
        <?php endif; ?>
        </div>
    </div>
</div>
