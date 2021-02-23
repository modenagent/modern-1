<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Widget extends CI_Controller {
    
    private $user_id;

    public function __construct()
    {
        parent::__construct();
        $this->user_id = 82;          
    }

    public function index()
    {
    	if(isset($this->user_id) && !empty($this->user_id))
    	{
    		// $userInfo = $this->base_model->get_record_result_array('lp_user_mst',array('user_id_pk' => $this->user_id));

            $tableName = "lp_user_mst";
            $user = $this->base_model->get_login_data_from_id( $tableName,'user_id_pk', $this->user_id);
            $user_info = (array) $user; 
            if(isset($user_info) && !empty($user_info))
            {
                if ($user_info['is_active'] == 'Y') 
                {
	              	$user_data = array(
		              	'userid'    => $user_info['user_id_pk'],
		              	'username'    => ucfirst($user_info['first_name']).' '.ucfirst($user_info['last_name']),
		                'user_email'    => $user_info['email'],
		              	'logged_in'    => TRUE,
	              	);

                  	$session_data = $this->session->set_userdata($user_data);
                }

                $data['title'] = "Widget";
                $data['user_id'] = $user->user_id_pk;
                $data['user_name'] = isset($user->user_name) && !empty($user->user_name) ? $user->user_name : '';
                $data['users'] = (array) $user;
                echo "<pre>ddd"; print_r($user); exit;
              $data['topReports'] = $this->base_model->get_all_record_by_id('lp_my_listing', array('user_id_fk' => $userId),'project_date','desc');
              $data['reports'] = $this->base_model->get_all_record_by_id('lp_my_listing', 
                                              array(
                                                  'user_id_fk' => $userId,
                                                  'is_active' => 'Y'
                                              ),
                                              'project_date','desc'
                                            );
              }

    	}
    	else
    	{

    	}
    }

    public function getWidgetData()
    {
        $user_id = $this->input->post('user_id');
        if(isset($user_id) && !empty($user_id))
        {
            $tableName = "lp_user_mst";
            $user = $this->base_model->get_login_data_from_id( $tableName,'user_id_pk', $user_id);

            $data['user'] = $data['agentInfo'] = $user_info = (array) $user;

            if(isset($user_info) && !empty($user_info))
            {
                if ($user_info['is_active'] == 'Y') 
                {
                    $user_data = array(
                        'userid'    => $user_info['user_id_pk'],
                        'username'    => ucfirst($user_info['first_name']).' '.ucfirst($user_info['last_name']),
                        'user_email'    => $user_info['email'],
                        'logged_in'    => TRUE,
                    );

                    $session_data = $this->session->set_userdata($user_data);
                }

                $data['title'] = "Widget";
                $data['user_id'] = $user_id = $user_info['user_id_pk'];
                $data['user_name'] = isset($user_info['user_name']) && !empty($user_info['user_name']) ? $user_info['user_name'] : '';
                $data['salesRep'] = array();
                if(isset($user_info['parent_id']) && !empty($user_info['parent_id']))
                {
                    $parent_id = $user_info['parent_id'];
                    $sales_rep_info = $this->base_model->get_record_by_id('lp_user_mst', array('user_id_pk'=>$parent_id));
                    $data['salesRep'] = (array) $sales_rep_info;
                }
                
                $data['reports'] = $this->base_model->get_all_record_by_id ('lp_my_listing',  
                        array(
                                'user_id_fk' => $user_id,
                                'is_active' => 'Y'
                            ),
                            'project_date','desc'
                );

                // $data['reportTemplates'] = $this->base_model->all_records('lp_report_templates');  
                $this->load->model('package_model');
                $data['report_price'] = $this->package_model->get_reports_price();

                $data['reportTemplates'] = $this->base_model->all_records('lp_seller_report_templates');
                
                $html = $this->load->view('user/dashboard_widget', $data, true);
                $result['res'] = $html;

                header('Content-Type: text/javascript; charset=utf8');
                header('Access-Control-Allow-Origin: http://localhost/mylistingpitch');
                header('Access-Control-Max-Age: 3628800');
                header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');              
                
            }
        }
        else
        {
            header('Content-Type: application/json; charset=utf8');
            $result['res'] = 'ERROR: Access denied, you are not authorized to use this widget.';
            // echo json_encode($data);
        }
        echo json_encode($result); exit;
    }
}