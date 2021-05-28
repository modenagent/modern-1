<?php
// die;
include('../simplesaml/lib/_autoload.php');
if(empty($_GET['site_id'])) {
    echo "Invalid request";die;
}


$auth_id = $_GET['site_id'];
if(!empty($auth_id)) {
    	$auth = new \SimpleSAML\Auth\Simple($auth_id);
}
else {
    echo "Invalid request.";die;
}

if (!$auth->isAuthenticated()) {
   $auth->requireAuth();
    // echo "Please login to use widget";
    die;
}
else {

    $attributes = $auth->getAttributes();

    ob_start();
    $root_dir = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR ;
    $root_dir = str_replace('\\', '/', $root_dir);
    define('FCPATH', $root_dir);
    define("CI_REQUEST", "external");
    include('index_ci.php');
    ob_end_clean();
    $CI =& get_instance();

    $get_where = array('unique_id'=>$auth_id);
    $idp_data = $CI->base_model->get_record_by_id('lp_idps',$get_where);
    
    if($idp_data && !empty($idp_data)) {
    	$attr_values = array();
    	foreach ($attributes as $key => $value) {
    		$attr_val = $value;
    		if(is_array($value) && isset($value[0])) {
    			$attr_val = $value[0];
    		}
    		
    		if($idp_data->email == $key) { //Email
    			$attr_values['email'] = $attr_val;
    		}
    		elseif($idp_data->username == $key) { //UserName
    			$attr_values['username'] = $attr_val;
    		}
    		elseif ($idp_data->first_name == $key) { //First Name
    			$attr_values['first_name'] = $attr_val;
    		}
    		elseif($idp_data->last_name == $key) { // Last Name
    			$attr_values['last_name'] = $attr_val;

    		}
    		elseif($idp_data->phone == $key) { // Phone
    			$attr_values['phone'] = $attr_val;
    		}
            elseif($idp_data->image == $key) { // Image
                $attr_values['image'] = $attr_val;
            }
    		// elseif($idp_data->sales_rep == $key) { // Phone	
    		// 	$attr_values['parent_id'] = $attr_val;		
    		// }
    	}
        if(!empty($attr_values['email'])) {
            $email = $attr_values['email'];

            $get_where = array('email'=>$email);
            $user = $CI->base_model->get_record_by_id('lp_user_mst',$get_where);
            if($user && !empty($user)) {

                //Update data

                //check if user is associate with same company

                $get_where = array('user_id_pk'=>$idp_data->company_id);
                $comp_info = $CI->base_model->get_record_by_id('lp_user_mst',$get_where);
                // var_dump($comp_info);die;
                if($idp_data->company_id != $user->parent_id && $idp_data->unique_id != '1613127833MWAI1583MYPL' && $idp_data->unique_id != '1613123268USXC86GYBN') {
                    die("You are already registered with other company.Please contact Administrator");
                }

                $update_data = array();
                if(!empty($attr_values['first_name'])) {
                    $update_data['first_name'] = $attr_values['first_name'];
                }
                if(!empty($attr_values['last_name'])) {
                    $update_data['last_name'] = $attr_values['last_name'];
                }
                if(!empty($attr_values['email'])) {
                    $update_data['email']=$attr_values['email'];
                }
                if(!empty($attr_values['phone'])) {
                    $update_data['phone'] = $attr_values['phone'];
                }

                if(!empty($attr_values['image']) && empty($user->profile_image) || true) {
                    $url=$attr_values['image'];
                    $contents=@file_get_contents($url);
                    
                    // die("IN");
                    if(!empty($contents)) {
                        $process_upload = true;

                        //check existing image
                        if(!empty($user->profile_image)) {

                            $arrContextOptions=array(
                                "ssl"=>array(
                                    "verify_peer"=>false,
                                    "verify_peer_name"=>false,
                                ),
                            );

                            $content1=@file_get_contents('https://'.$_ENV['APP_DOMAIN'].'/'.$user->profile_image,false,stream_context_create($arrContextOptions));
                            // $content1=@file_get_contents('https://'.$_ENV['APP_DOMAIN'].'/'.$user->profile_image);
                        
                            if(!empty($content1) && md5($contents) != md5($content1)) {
                                $process_upload = true;

                                unlink($root_dir.$user->profile_image);
                            }
                            else {

                                $process_upload = false;
                            }

                        }

                        if($process_upload) {

                            $upload_path = $root_dir.'assets/images/';
                            $image_name = 'widget_user_'.substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8).".jpg";
                            $save_path=$upload_path.$image_name;
                            file_put_contents($save_path,$contents);
                            $profile_image = 'assets/images/'.$image_name;
                            $update_data['profile_image'] = $profile_image;

                        }
                    }
                }

                if(count($update_data)) {

                    $update_where = array(
                        'user_id_pk' => $user->user_id_pk,
                    );

                    $CI->base_model->update_record_by_id('lp_user_mst',$update_data,$update_where);
                }



    	        $newdata = array(
    	        'userid'    => $user->user_id_pk,
    	        'username'  => ucfirst($user->first_name).' '.ucfirst($user->last_name),
    	        'user_email' => $user->email,
    	        'logged_in' => TRUE
    	        );
            }
            else {

            	//check email exist of sales rep

            	// $sales_rep_email = $attr_values['parent_id'];
            	$parent_id = '';

            	
            	//Get company info
            	$get_where = array('user_id_pk'=>$idp_data->company_id);
            	$comp_info = $CI->base_model->get_record_by_id('lp_user_mst',$get_where);
                // var_dump($comp_info);die;
                if($comp_info && !empty($comp_info)) {
                    if($comp_info->role_id_fk == 3) {
                        $parent_id = $comp_info->user_id_pk;
                    }

                    elseif(empty($_GET['company'])) {
                        echo "Invalid request";die;
                    }
                    else {

                        $company_url = $_GET['company'];

                        $get_where = array('company_url'=>$company_url,'parent_id'=>$comp_info->user_id_pk);
                        $comp_info = $CI->base_model->get_record_by_id('lp_user_mst',$get_where);
                        if($comp_info && !empty($comp_info)) {
                            $parent_id = $comp_info->user_id_pk;
                        }
                        else {
                            echo 'You are not authorize'; die;
                        }
                    }

                }
                else {
                    echo 'You are not authorize'; die;
                }

                


            	//Register user with field mapping
            	$random_password = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);
            	$encrypted_password = password_hash($random_password,PASSWORD_DEFAULT);
                $profile_image = '';
                if(!empty($attr_values['image'])) {
                    $url=$attr_values['image'];
                    $contents=@file_get_contents($url);
                    if(!empty($contents)) {

                    $upload_path = $root_dir.'assets/images/';
                    $image_name = 'widget_user_'.substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8).".jpg";
                    $save_path=$upload_path.$image_name;
                    file_put_contents($save_path,$contents);
                    $profile_image = 'assets/images/'.$image_name;
                    }
                }
            	$user = array(
                    'password' => $encrypted_password,
                    'user_name' => null ,
                    'first_name' => $attr_values['first_name'],
                    'last_name' => $attr_values['last_name'],
                    'email'=>$attr_values['email'],
                    'phone' => $attr_values['phone'],
                    'parent_id' => $parent_id,
                    'role_id_fk' => 4,
                    'license_no'=>  '',
                    'company_name'=>  $comp_info->company_name,
                    'company_add' => $comp_info->company_add,
                    'company_city' => $comp_info->company_city == 0 ? '' :$comp_info->company_city,
                    'comapny_zip' => empty($comp_info->company_zip) ? '' :$comp_info->company_zip ,
                    'company_logo' => '',
                    'company_phone' => '',
                    'company_suite' => '',
                    'company_state' => '',
                    'user_credits' => '0',
                    'registered_date' => date('Y-m-d H:i:s', time()),
                    'is_active' => 'Y',
                    'profile_image' => $profile_image,
                );

                $resp = $CI->base_model->insert_one_row('lp_user_mst', $user);
                $get_where = array('email'=>$attr_values['email']);
    	        $user = $CI->base_model->get_record_by_id('lp_user_mst',$get_where);
    	        if($user && !empty($user)) {

    		        $newdata = array(
    		        'userid'    => $user->user_id_pk,
    		        'username'  => ucfirst($user->first_name).' '.ucfirst($user->last_name),
    		        'user_email' => $user->email,
    		        'logged_in' => TRUE
    		        );
    	        }
    	        else {
    	        	echo "You are not Registered";die;
    	        }
            }
            $sessionData = $CI->session->set_userdata($newdata);
            $_SESSION['userdata'] = $newdata;

            
            $token = generateToken($user->user_id_pk);

            

            $cookie= array(

               'name'   => 'sso_user_token',
               'value'  => $token,                            
               'expire' => '86400',
               'domain' => '.'.$_ENV['MAIN_DOMAIN'],
               'secure' => TRUE

           );

            $CI->load->helper('cookie');


            $CI->input->set_cookie($cookie);
            // var_dump(get_cookie('sso_unique_id',true));die;
            
        }
        else {
            echo "Email not found";die;
        }
        ?>
        <script type="text/javascript">
            var app_main_url = "https://<?=$_ENV['APP_DOMAIN']?>/widget/getWidgetData";
        </script>
        <script type="text/javascript" src="cma.js"></script>
    <?php 
    }
}
?>