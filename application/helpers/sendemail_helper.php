<?php 

if(!function_exists('send_email')){
	function send_email($fromemail, $from_name, $to, $subject, $content,$myPdf=array(),$ccTo=null){
		$instance = &get_instance();
		$instance->load->library('email');

		$config['protocol']     = 'smtp';
        $config['smtp_host']    = 'mail.turbanbot.com';
        $config['smtp_port']    = '587';
        $config['smtp_timeout'] = '120';
        $config['smtp_user']    = 'help@turbanbot.com';
        $config['smtp_pass']    = 'avtarits4u#';
        $config['charset']      = 'utf-8';
        $config['newline']      = "\r\n";
        $config['mailtype']     = 'html'; // or html
        $config['validation']   = TRUE; // bool whether to validate email or not  
		 $instance->email->initialize($config);
		    

        $instance->email->initialize($config);
		
		$instance->email->from($fromemail, $from_name);
        $instance->email->to($to); 
        if(!is_null($ccTo)){
            $instance->email->cc($ccTo);
        }
        $instance->email->subject($subject);
        $instance->email->message($content);  

        foreach($myPdf as $file){
            $instance->email->attach($file);
        }

        if($instance->email->send()){
         	return true;
        }else{
          	return false;
        }

	} 

          
}

?>
