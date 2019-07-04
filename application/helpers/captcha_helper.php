<?php

    function  create_image()
    {
        $ref = &get_instance();
        $image;
        $image = imagecreatetruecolor(200, 50) or die("Cannot Initialize new GD image stream");
        $background_color = imagecolorallocate($image, 255, 255, 255);
        $text_color = imagecolorallocate($image, 0, 255, 255);
        $line_color = imagecolorallocate($image, 64, 64, 64);
        $pixel_color = imagecolorallocate($image, 0, 0, 255);
        imagefilledrectangle($image, 0, 0, 200, 50, $background_color);
        for ($i = 0; $i < 3; $i++) {
            imageline($image, 0, rand() % 50, 200, rand() % 50, $line_color);
        }
        for ($i = 0; $i < 1000; $i++) {
            imagesetpixel($image, rand() % 200, rand() % 50, $pixel_color);
        }
        $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $len = strlen($letters);
        $letter = $letters[rand(0, $len - 1)];
        $text_color = imagecolorallocate($image, 0, 0, 0);
        $word = "";
        for ($i = 0; $i < 6; $i++) {
            $letter = $letters[rand(0, $len - 1)];
            imagestring($image, 7, 5 + ($i * 30), 20, $letter, $text_color);
            $word .= $letter;
        }

        $ref->load->library('session');
        $time = time();
        $ref->session->set_userdata('captcha_string'.$time,$word);
        $ref->session->set_userdata('timestamp',$time);
        //time()
        // $_SESSION['captcha_string'] = $word;
        $images = glob("*.png");
        foreach ($images as $image_to_delete) {
            @unlink($image_to_delete);
        }
        imagepng($image, "assets/captcha/image" . $ref->session->userdata('timestamp') . ".png");
        return $image;
    }

?>