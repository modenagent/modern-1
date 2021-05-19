<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Registry extends CI_Controller {
	public function __construct()
    {
            parent::__construct();            
    }
    public function guest($unique_key)
    {
    	//check if $unique_key is exist
    	$table = 'lp_registry_master';
    	$where['unique_key'] = $unique_key;
    	$is_valid = $this->base_model->check_existent($table,$where);
    	if($is_valid) {
    		$record = $this->base_model->get_record_by_id($table,$where, $fields='id');
    		$table = 'lp_registry_users';
    		$where_check['registry_id'] = $record->id;
    		$data_exist = $this->base_model->check_existent($table,$where_check);
    		if($data_exist) {
    			redirect("registry/registerd/$unique_key");
    		}



	    	if($this->input->post()) {
	    		 $this->form_validation->set_rules('name', 'Name', 'trim|required');
	    		 $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
	    		 $this->form_validation->set_rules('phone', 'Phone', 'trim|required');

	    		 if ($this->form_validation->run() == FALSE){

	    		 }
	    		 else {

		    		
		    		$user_record = array();
		    		$user_record['registry_id'] = $record->id;
		    		$user_record['name'] = $this->input->post('name');
		    		$user_record['email'] = $this->input->post('email');
		    		$user_record['phone'] = $this->input->post('phone');

		    		$this->base_model->insert_one_row($table,$user_record);
		    		redirect("registry/user/$unique_key");
	    		 }


	    	}

	    	$data['unique_key'] = $unique_key;
	    	$this->load->view('registery/form');
    	}
    	else {
    		redirect("/");
    	}
    	
    }

    public function user($unique_key)
    {
    	$table = 'lp_registry_master';
    	$where['unique_key'] = $unique_key;
    	$is_valid = $this->base_model->check_existent($table,$where);
    	if($is_valid) {
	    	$this->load->view('registery/thankyou');
	    }
	    else {
    		redirect("/");
    	}
    }

    public function registerd($unique_key)
    {
    	$table = 'lp_registry_master';
    	$where['unique_key'] = $unique_key;
    	$is_valid = $this->base_model->check_existent($table,$where);
    	if($is_valid) {
	    	$this->load->view('registery/registered');
	    }
	    else {
    		redirect("/");
    	}
    }
}
