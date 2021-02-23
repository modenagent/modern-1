<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('../simplesaml/lib/_autoload.php');
if(empty($_GET['site_id'])) {
    echo "Invalid request";die;
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$auth_id = $_GET['site_id'];

if(!empty($auth_id)) {

    $auth = new \SimpleSAML\Auth\Simple($auth_id);
}
else {
    echo "Invalid request.";die;
}


if (!$auth->isAuthenticated())
{
    
// die;
    $auth->requireAuth();
}
else
{


    $attributes = $auth->getAttributes();

    ob_start();
    $root_dir = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR ;
    $root_dir = str_replace('\\', '/', $root_dir);
    define('FCPATH', $root_dir);
    include('index_ci.php');

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);


    ob_end_clean();
?>
<div id="cma-widget-container">
	
</div>
<script type="text/javascript">
    var app_main_url = "//<?=$_ENV['APP_DOMAIN']?>/SAMLConfig/index/<?=$auth_id?>";
    console.log(app_main_url);
</script>
<?php
// var_dump($attributes);
//     die("IN");
    $CI =& get_instance();

    if(!empty($attributes['email']) && !empty($attributes['email'][0])) {
        $email = $attributes['email'][0];
        $get_where = array('email'=>$email);

        $user = $CI->base_model->get_record_by_id('lp_user_mst',$get_where);
        $newdata = array(
        'userid'    => $user->user_id_pk,
        'username'  => ucfirst($user->first_name).' '.ucfirst($user->last_name),
        'user_email' => $user->email,
        'logged_in' => TRUE
        );
        // $session = SimpleSAML_Session::getSessionFromRequest();
        // $session->cleanup();
        $sessionData = $CI->session->set_userdata($newdata);
        $_SESSION['userdata'] = $newdata;
        
    }
    else {
        echo "Email not found";die;
    }


?>
<!-- <script type="text/javascript" src="cma_test.js"></script> -->
<?php }
?>