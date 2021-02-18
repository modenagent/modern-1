<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SAMLConfig extends CI_Controller {

    public function __construct() { 
        parent::__construct();


        if(!($this->session->userdata('userid'))) {
            
            $auth_id = $this->uri->segment(3, 0);
            require_once(FCPATH .'simplesaml/lib/_autoload.php');


            if(!empty($auth_id)) {

                $auth = new \SimpleSAML\Auth\Simple($auth_id);
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
                // We are authenticated, let's get the attributes
                $attributes = $auth->getAttributes();

                if(!empty($attributes['email']) && !empty($attributes['email'][0])) {
                    $email = $attributes['email'][0];
                    $get_where = array('email'=>$email);

                    $user = $this->base_model->get_record_by_id('lp_user_mst',$get_where);

                    $newdata = array(
                    'userid'    => $user->user_id_pk,
                    'username'  => ucfirst($user->first_name).' '.ucfirst($user->last_name),
                    'user_email' => $user->email,
                    'logged_in' => TRUE
                    );
                    $sessionData = $this->session->set_userdata($newdata);
                }
            }

        }


    }

    public function index($id = '')
    {   

        $data['title'] = "Dashboard";
        $data['current'] = "dashboard";
        $userId = $data['user_id'] = $this->session->userdata('userid');
        
        $userName = $data['user_name'] = $this->session->userdata('username');
        
        $data['users'] = $this->base_model->get_record_result_array('lp_user_mst',array('user_id_pk' => $userId));
        $data['topReports'] = $this->base_model->get_all_record_by_id('lp_my_listing', array('user_id_fk' => $userId),'project_date','desc');
        $data['reports'] = $this->base_model->get_all_record_by_id('lp_my_listing', 
                                        array(
                                            'user_id_fk' => $this->session->userdata('userid'),
                                            'is_active' => 'Y'
                                        ),
                                        'project_date','desc'
                                      );

        $data['agentInfo'] = $this->base_model->get_record_by_id('lp_user_mst',
                                array(
                                  'user_id_pk'=>$this->session->userdata('userid')
                            ));
        $data['reportTemplates'] = $this->base_model->all_records('lp_report_templates');  

        $this->load->model('package_model');
        $data['report_price'] = $this->package_model->get_reports_price();

        $this->load->helper('captcha');
        create_image();
        $this->load->view('user/header_widget', $data);
        $this->load->view('user/dashboard', $data);
        $this->load->view('user/footer');


        

    }

}