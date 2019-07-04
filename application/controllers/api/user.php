<?php defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'/libraries/REST_Controller.php';

class User extends REST_Controller
{
    // Initialize Constructor Here
    function __construct() {
        parent::__construct();
        $this->load->helper('validation_helper');
        $this->load->helper('api_helper');
        $this->load->model('user_model');
        // $this->methods['user_get']['limit'] = 500; //500 requests per hour per user/key
        // $this->methods['user_post']['limit'] = 100; //100 requests per hour per user/key
        // $this->methods['user_delete']['limit'] = 50; //50 requests per hour per user/key
    }

    /*
     *  @name: login_post
     *  @author: Avtar Gaur <developer.avtargaur@gmail.com>
     *  @created: Jan 27, 2019
     *  @description: Login with username and password to get the access_token
    */
    public function login_post(){
        $data = array();
        $data   =   validate_my_params(
                                        array(
                                                'email'         =>  'required',
                                                'password'      =>  'required'
                                        )
                                    );

        if($data['status'] == 'success'){
            $tableName = "lp_user_mst";
            $user = $this->base_model->get_login_data($tableName, $data['data']['email'], $data['data']['password']); 

            // if user is found
            if($user){
                // user login
                if($user->is_active == 'Y'){
                    //generate token
                    $token = generateToken($user->user_id_pk);

                    $user->token = $token;
                    unset($user->password);
                    unset($user->billing_cvv_code);
                    unset($user->billing_creadit_card_no);
                    unset($user->billing_zipcode);
                    unset($user->billing_name);
                    $resp = array(
                                "status"=>"success",
                                "message"=>"Login successful",
                                "data"=> $user
                            );

                    $this->response($resp, 200);
                }else{
                    $resp = array(
                                "status"=>"error",
                                "message"=>"User is inactive"
                            );

                    $this->response($resp, 400);
                }
            }else{
                $resp = array(
                            "status"=>"error",
                            "message"=>"Wrong Email or Password"
                        );

                $this->response($resp, 400);
            }
        }else{
            $resp = array(
                        "status"=>"error",
                        "message"=>"Email and Password are required"
                    );

            $this->response($resp, 400);
        }
    }

    public function validateToken_get(){
        $this->response(validateToken('', TRUE), 200);
    }

    // User Profile View Function
    public function profileview_get(){
        $userId = $this->get('userid');
        if($userId){
            $result = $this->base_model->get_user_details($userId);
            if($result){
                $resp = array(
                    'status'=>'success',
                    'data'=>$result
                );
                echo $this->get('callback')."(".json_encode($resp).")";
            } else {
                $resp = array(
                    'status'=>'error',
                    'data'=>'You are session expired.'
                );
                echo $this->get('callback')."(".json_encode($resp).")";
            }           
        }else{
            $resp = array(
                'status'=>'error',
                'data'=>'You are not logged in.'
            );
            echo $this->get('callback')."(".json_encode($resp).")";
        }
    }
    // profile edit
    public function profileedit_get(){
        $userId = $this->get('userid');
        if($userId){
            $fname = $this->get('fname');
            $lname = $this->get('lname');
            $uemail = $this->get('uemail');
            $data = array(                 
                'first_name' => $fname,
                'last_name'=> $lname,
                'primary_email'=> $uemail
            );
            $where = array(
                'user_id_pk' => $userId
            );
            $result = $this->base_model->update_record_by_id('att_user_mst',$data,$where);  
            if($result){
                $resp = array(
                    'status'=>'success',
                    'message'=>'Profile is updated successfully.'
                );
                echo $this->get('callback')."(".json_encode($resp).")";               
            }else{
                $resp = array(
                    'status'=>'error',
                    'message'=>'Profile could not be updated.'
                );
                echo $this->get('callback')."(".json_encode($resp).")"; 
            }
        }else{
            $resp = array(
                'status'=>'error',
                'data'=>'You are not logged in.'
            );
            echo $this->get('callback')."(".json_encode($resp).")";
        }
    }  
    // Image Upload
    public function imageupload_post(){
        $userId = $this->post('userid');		//this line uncomment by vijay
//        $userId = 1;		//this line comment by vijay
//        $this->response($userId, 200);
//        echo $this->get('callback')."(".json_encode($userId).")";
        if($userId){
            $resp = user_image($userId);
            echo $this->post('callback')."(".$resp.")";
        }else{
            $resp = array(
                'status'=>'error',
                'data'=>'You are not logged in.'
            );
            echo $this->post('callback')."(".json_encode($resp).")";
        }
    }
    //Class ends here
}
?>