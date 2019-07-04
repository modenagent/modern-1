<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('get_user_calander')){
    function get_user_calander($uid = NULL){
        $uc = & get_instance();
//        $uc->load->model('base_model');
        
        $where = array(
            'calendar_id_pk' => $uid
        );
        $user_calander = $uc->base_model->get_record_by_id('att_school_calendar',$where);
        if($user_calander){
            $result = array(
                'response' => '1', 
                'msg' => 'Success.',
                'data' => $user_calander
                );
            }else{
                $result = array(
                    'response' => '0',
                    'msg' => 'Failed.'
                    );
            }
            return $resp = json_encode($result);
    }
}