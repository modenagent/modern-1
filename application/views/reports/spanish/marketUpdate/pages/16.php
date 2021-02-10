<style>
body {
        background-color:#ffffff;
}
</style>

<header class="page-16-header" style="background-image: url(<?php echo base_url('assets/reports/english/marketUpdate/assets/images/header-2021.jpg');?>);">
    <h2 class="title-center heading-market">VENTAS RECIENTES</h2>
    <h2 class="title-center heading-zipcode"> Codigo Postal: <?php echo $zipCode; ?></h2>
</header><!-- /header -->
<div class="table-wrapper page-16-content" style="padding-top: 18px">
    <div class="table-row gray-color">
        <div class="row table-heading">
            <div class="col-xs-5">
                <p>Direccion de Propiedad</p>
            </div>

            <div class="col-xs-2">
                <p>Precio</p>
            </div>

            <div class="col-xs-2">
                <p>Sqft</p>
            </div>

            <div class="col-xs-1">
                <p>Cuartos</p>
            </div>

            <div class="col-xs-2">
                <p>Banos</p>
            </div>
        </div>
    </div>
    <?php if(sizeof($_comparables)>0): ?>
        <?php $avaiProperty = 0; $i = 1; ?>
        <?php foreach ($_comparables as $key => $item): ?>
            <?php 
                if($key>8){
                    break;
                }
            ?>
            <div class="table-row <?php if($i % 2 == 0)echo 'gray-color'; ?>">
                <div class="row">
                    <div class="col-xs-5">
                        <p><?php echo $item['Address']; ?></p>
                    </div>
                    <div class="col-xs-2">
                        <p class="sale-price-560"><?php echo $item['Price']; ?></p>
                    </div>
                    <div class="col-xs-2">
                        <p><?php echo $item['SquareFeet']; ?></p>
                    </div>
                    <div class="col-xs-1">
                        <p><?php echo $item['Beds']; ?></p>
                    </div>
                    <div class="col-xs-2">
                        <p><?php echo $item['Baths']; ?></p>
                    </div>
                </div>
            </div>
            <?php $avaiProperty++; $i++; ?>
        <?php endforeach;?>
    <?php endif; ?>
</div>
<div class="section-article">
    <h1 class="curious-about-heading"><b>ESTA INTERESADO EN DESCUBRIR EL VALOR DE SU PROPIEDAD?<br >
        COMPLETAMENTE GRATIS!</b>
    </h1>
    <div class="row">
        <div class="col-xs-6">
            <div class="article-1 gray-color">
                <img src="<?php echo base_url('assets/reports/english/marketUpdate/assets/icon/01.png');?>">
                <p style="text-transform: none;">www.modernagent.io/cma</p>
            </div>
        </div>
            <div class="title-bold theme-clr" style="font-size: 40px;position: absolute; left: 48.5%; top: 48%;">&</div>
        <div class="col-xs-6">
            <div class="article-2 gray-color">
                <img src="<?php echo base_url('assets/reports/english/marketUpdate/assets/icon/02.png');?>">
                
                <p>codigo: <strong><?php echo $user['ref_code']; ?></strong></p>
            </div>
        </div>
    </div>
    <h3 class="">VISITENOS ARRIBA PARA RECIBIR UN ANALISIS DE SU PROPIEDAD VIA MENSAJE DE TEXTO.</h3>
</div>
<div class="footer page-16-ftr" style="background-image: url(<?php echo base_url('assets/reports/english/marketUpdate/assets/images/footer16-bg.jpg');?>);"> 
    
    <div class="row">
        <div class="footer-inner">
            <div class="ftsection col-xs-12">
                <div class="left-footer pull-left col-xs-8">
                    <div class="row">
                        <?php if($user['profile_image'] != '' && $user['profile_image'] != 'no'):?>
                         <div class="page-16-ftr-agentpic col-xs-4">
                            <img class="img-responsive page-16-ftr-img" src="<?php echo base_url().$user['profile_image']; ?>"  >
                        </div>
                        <?php else: ?>
                        <div class="col-xs-3"></div>
                        <?php endif; ?>
                        <div class="<?php echo ($user['profile_image'] != '' && $user['profile_image'] != 'no')?'col-xs-7':'col-xs-9'  ?>">
                            <div class="page-16-ftr-address">
                                <h4 class="client-name"><?php echo $user['fullname']; ?></h4>

                                <p> <?php echo $user['title']; ?></p>
                                <p> CA BRE#<?php echo $user['licenceno']; ?></p>
                                <p>Direct: <?php echo $user['phone']; ?></p>
                                <p><?php echo $user['email']; ?></p>
                                <p><?php echo $user['companyname']; ?></p>
                                <p><?php echo $user['street']; ?></p>
                                <p><?php echo $user['city']; ?>, <?php echo $user['state']; ?> <?php echo $user['zip']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="right-footer pull-right page-16-ftrr-logo col-xs-4">
                    <?php if($user['company_logo'] != ''):?><img src="<?php echo base_url().$user['company_logo']; ?>" alt="Logo Image" style="max-height:" /><?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</div>