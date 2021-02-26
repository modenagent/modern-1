<?php

if(empty($_GET['site_id'])) {
    echo "Invalid request";die;
}

$auth_id = $_GET['site_id'];

if(!empty($auth_id)) {


    ob_start();
    $root_dir = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR ;
    $root_dir = str_replace('\\', '/', $root_dir);
    define('FCPATH', $root_dir);
    define("CI_REQUEST", "external");
    include('index_ci.php');
    ob_end_clean();
    $CI =& get_instance();

	//Check if id is exist in our DB
	$get_where = array('unique_id'=>$auth_id);

    $idp_data = $CI->base_model->get_record_by_id('lp_idps',$get_where);
    // var_dump($idp_data);die;
    if($idp_data && !empty($idp_data)) {
        include('../simplesaml/lib/_autoload.php');

    	$auth = new \SimpleSAML\Auth\Simple($auth_id);
    	
    }
    else {
    	echo "Invalid ID.";die;

    }
}
else {
    echo "Invalid request.";die;
}


if (!$auth->isAuthenticated())
{
   $auth->requireAuth();
}
else
{


    $attributes = $auth->getAttributes();


	$attr_values = array();
	foreach ($attributes as $key => $value) {
		$attr_val = $value;
		if(is_array($value) && isset($value[0])) {
			$attr_val = $value[0];
		}
		
		if($idp_data->email == $key) { //Email
			$attr_values['email'] = $attr_val;
		}
		elseif($idp_data->username == $key) { //Email
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
		elseif($idp_data->sales_rep == $key) { // Phone	
			$attr_values['parent_id'] = $attr_val;		
		}
	}
    if(!empty($attr_values['email'])) {
        $email = $attr_values['email'];

        $get_where = array('email'=>$email);
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

        	//check email exist of sales rep

        	$sales_rep_email = $attr_values['parent_id'];
        	$parent_id = '';

        	$get_where = array('email'=>$sales_rep_email);
        	$sales_rep = $CI->base_model->get_record_by_id('lp_user_mst',$get_where);
        	if($sales_rep && !empty($sales_rep)) {
        		$parent_id = $sales_rep->user_id_pk;
        	}
        	else {
        		echo 'You are not authorize'; die;
        	}
        	//Get company info
        	$get_where = array('user_id_pk'=>$idp_data->company_id);
        	$comp_info = $CI->base_model->get_record_by_id('lp_user_mst',$get_where);


        	//Register user with field mapping
        	$random_password = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);
        	$encrypted_password = password_hash($random_password,PASSWORD_DEFAULT);
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

        // $session = SimpleSAML_Session::getSessionFromRequest();
        // $session->cleanup();

        $sessionData = $CI->session->set_userdata($newdata);
        $_SESSION['userdata'] = $newdata;
        
    }
    else {
        echo "Email not found";die;
    }


?>
    <script type="text/javascript">
        var app_main_url = "//<?=$_ENV['APP_DOMAIN']?>/widget/getWidgetData";
    </script>
    <script type="text/javascript" src="cma.js"></script>
<?php 
}
?>
