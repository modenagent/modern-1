<?php 

    // $config['protocol']    	= 'smtp';
    // $config['smtp_host']    = 'smtpout.asia.secureserver.net';
    // $config['smtp_port']    = '25';
    // $config['smtp_timeout'] = '60';
    // $config['smtp_user']    = 'sunit.chand@giggsol.com';
    // $config['smtp_pass']    = 'giggs123!@#';
    // $config['charset']    	= 'utf-8';
    // $config['newline']    	= "\r\n";
    // $config['mailtype'] 	= 'text'; // or html
    // $config['validation'] 	= TRUE; // bool whether to validate email or not      


    $config['protocol']     = 'smtp';
    $config['smtp_host']    = $_ENV['MAIL_HOST'];
    $config['smtp_port']    = $_ENV['MAIL_PORT'];
    $config['smtp_timeout'] = '60';
    $config['smtp_user']    = $_ENV['MAIL_USER'];
    $config['smtp_pass']    = $_ENV['MAIL_PASSWORD'];
    $config['charset']      = 'utf-8';
    $config['newline']      = "\r\n";
    $config['mailtype']     = 'html'; // or html
    $config['validation']   = TRUE; // bool whether to validate email or not 
?>