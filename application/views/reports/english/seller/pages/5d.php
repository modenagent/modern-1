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
