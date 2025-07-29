<?php defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Calander extends REST_Controller
{
//    Initialize Constructor Here
    public function __construct()
    {
        parent::__construct();
        $this->methods['user_get']['limit'] = 500; //500 requests per hour per user/key
        $this->methods['user_post']['limit'] = 100; //100 requests per hour per user/key
        $this->methods['user_delete']['limit'] = 50; //50 requests per hour per user/key
    }
//    Calander View API
    public function calander_view_get()
    {
        $userId = $this->get('userid');
        if ($userId) {
//            $this->load->helpers('calander_helper');
//            Calling get_user_calander from helper
            $resp = get_user_calander($userId);
//            $this->response(json_decode($resp));
            echo $this->get('callback') . "(" . $resp . ")";
        } else {
            $resp = array(
                'status' => 'error',
                'data' => 'You are not logged in.',
            );
            echo $this->get('callback') . "(" . json_encode($resp) . ")";
        }

    }
}
