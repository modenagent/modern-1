<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registry</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:wght@100;300;400;500;600;700,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url("assets/reports/english/registry/2/style.css"); ?>">

</head>
<body>
    <page>
        <h1>WELCOME</h1>
        <p>
            Thank you for visiting. Please scan<br>
            the QR code with your smart<br>
            phone’s camera.
        </p>
        <div class="qr_bg">
            <?php
            $image = base_url("user/generate_qr_code/$unique_key/9");
            ?>
            <img src="<?php echo $image; ?>" alt="QR Code" width="490" height="490">
            <h3 class="address"><?php echo $property->PropertyProfile->SiteAddress ; ?> <span><?php echo $property->PropertyProfile->SiteCity ; ?>, <?php echo $property->PropertyProfile->SiteState ; ?></span></h3>
        </div>
    </page>
</body>
</html>