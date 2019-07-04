<?php
if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

/**
 * Role management library
 * @author 	 Avtar Gaur <developer.avtargaur@gmail.com>
 */
class Role_lib {
	
	/**
	 * Constructor method
	 * 
	 */
	public function __construct() {
		$this->CI =& get_instance();
	}
	/**
	* Set access paths into session
	* @param integer $role_id
	*/
	public function set_access_paths($role_id) {
		$this->CI->load->model('role_model');
		$sessionData['access_paths'] = $this->CI->role_model->get_access_paths($role_id);
		$this->CI->session->set_userdata($sessionData);
		//var_dump($access_paths);
		//die("Testing");
	}
	/**
	* Checks if user has access path
	* @parama string $path
	* @return boolean
	*/
	public function has_access($path) {
		//return true;
		$accessPaths = $this->CI->session->userdata('access_paths');
		return in_array($path, $accessPaths);
	}
	/**
	* Check if user has Admin Role
	* @return boolean
	*/
	public function is_admin($roleId=null){
		if(is_null($roleId)) {
			$roleId = $this->CI->session->userdata('role_id');
		}
		return ($roleId==1);
	}
	/**
	* Check if user has Manager Level 1 Role
	* @return boolean
	*/
	public function is_manager_l1($roleId=null){
		if(is_null($roleId)) {
			$roleId = $this->CI->session->userdata('role_id');
		}
		return ($roleId==2);
	}
	/**
	* Check if user has Sales Representative Role
	* @return boolean
	*/
	public function is_sales_rep($roleId=null){
		if(is_null($roleId)) {
			$roleId = $this->CI->session->userdata('role_id');
		}
		return ($roleId==3);
	}
	
}
