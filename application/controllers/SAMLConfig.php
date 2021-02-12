<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SAMLConfig extends CI_Controller {

    public function __construct() {        
        parent::__construct();
        // $this->verify_admin_session();

    }

    public function index($id = '')
    {   

        // var_dump($_ENV['STRIPE_KEY_SANDBOX']);
        // die;
        $data = array();

        require_once(FCPATH .'simplesaml/lib/_autoload.php');

        if(!empty($id)) {

        $auth = new \SimpleSAML\Auth\Simple($id);
        }
        else {
            echo "Invalid request";die;
        }
        

        if (!$auth->isAuthenticated())
            {
                // The user is not authenticated.

                $auth->requireAuth();
            }
            else
            {
                // We are authenticated, let's get the attributes
                $attributes = $auth->getAttributes();

                var_dump($attributes);

                // Restore codeigniter's session
                $session = SimpleSAML_Session::getSessionFromRequest();
                $session->cleanup();

                // Add the attributes to the restored session
                $_SESSION['attributes'] = $attributes;

              // Do something based on attributes:
             // redirect, etc..


            }


    }

}