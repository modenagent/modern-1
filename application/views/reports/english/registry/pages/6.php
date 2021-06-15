<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registry</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url("assets/reports/english/registry/6/style.css"); ?>">

</head>
<body>
    <page>
        <h2 class="address">
            <?php echo $property->PropertyProfile->SiteAddress ; ?> <span><?php echo $property->PropertyProfile->SiteCity ; ?>, <?php echo $property->PropertyProfile->SiteState ; ?></span>
        </h2>
        <div class="qr_bg">
            <div>
                <h1>WELCOME</h1>
                <p>
                    Thank you for visiting. Please scan<br>
                    the QR code with your smart<br>
                    phone’s camera.
                </p>
            </div>
            <?php
            $image = base_url("user/generate_qr_code/$unique_key/6");
            ?>
            <img src="<?php echo $image; ?>" alt="QR Code" class="qr_img">
        </div>
        
        <div class="sign">
            <?php if($user['profile_image'] != '' && $user['profile_image'] != 'no'):?>
                <div class="profile_img" style="background-image: url(<?php echo base_url().$user['profile_image']; ?>)">
            <?php else: ?>
                <div class="profile_img">
            <?php endif; ?>
                </div>
            <div class="sign_name"><?php echo $user['fullname']; ?></div>
        </div>
        <img src="<?php echo base_url("assets/reports/english/registry/6/img/flare.png"); ?>" alt="flare" class="flare_img">
    </page>
</body>
</html>