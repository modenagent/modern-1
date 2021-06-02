<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registry</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:wght@300;400;500;600;700,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url("assets/reports/english/registry/1/style.css"); ?>">
</head>
<body>
    <page>
        <h1>WELCOME.</h1>
        <h2>Please scan<br>to sign-in</h2>
        <?php
        $image = base_url("user/generate_qr_code/$unique_key");
        ?>
        <img src="<?php echo $image; ?>" alt="QR Code" width="230" height="230">
        <h3 class="address"><?php echo $property->PropertyProfile->SiteAddress ; ?> <span><?php echo $property->PropertyProfile->SiteCity ; ?>, <?php echo $property->PropertyProfile->SiteState ; ?></span></h3>
        <p>
            Loratur? Quis quatia nonsectam vero que sitas et, quidigende quiam
            quatur? At aut magni niscimo lorrum ut volores doluptatur, quidita cus.
            Cepero ipitium earibus ciaspiet es volestrum fugiti tis volorrum quiam
            in comniet laborem porest, ea
        </p>
    </page>
</body>
</html>