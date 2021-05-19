<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registery</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/registery/style.css') ?>">
</head>
<body>
    <section class="banner">
        <form action="" method="POST">
            <div class="validation_error">
                <?php echo validation_errors(); ?>
            </div>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" required value="<?php echo set_value('name');?>">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required value="<?php echo set_value('email');?>">
            </div>
            <div class="form-group">
                <label for="phone">Phone</label>
                <input type="text" name="phone" id="phone" required value="<?php echo set_value('phone');?>">
            </div>

            <button type="submit" class="btn_submit">submit</button>
        </form>
    </section>
</body>
</html>