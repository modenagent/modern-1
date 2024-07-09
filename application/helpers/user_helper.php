<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

if (!function_exists('user_image')) {
    function user_image($uid = null)
    {
        $ui =  & get_instance();
        $status = "";
        $msg = "";
        $fileuri = '';
        $file_element_name = 'imgupload';
        if ($status != "error") {
            $config['upload_path'] = './assets/uploads/user_img/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size'] = 10240;
            $config['encrypt_name'] = true;
            $ui->load->library('upload', $config);
            if (!$ui->upload->do_upload($file_element_name)) {
                $status = 'error';
                $msg = $ui->upload->display_errors('', '');
            } else {
                $data = $ui->upload->data();
                $status = "success";
                $msg = "File successfully uploaded";
                $fileuri = $data['file_name'];
                $uploadedFolderPath = 'assets/uploads/user_img/';
                $data2 = array(
                    'profile_image' => $uploadedFolderPath . $fileuri,
                );
                $where = array(
                    'user_id_pk' => $uid,
                );
                $getImgUrl = $ui->base_model->get_record_by_id('att_user_mst', $where);
                @unlink($getImgUrl->profile_image);
                $updateRes = $ui->base_model->update_record_by_id('att_user_mst', $data2, $where);
            }
        }
        if ($fileuri != '') {
            $result = array(
                'status' => $status,
                'msg' => $msg,
                'fileuri' => $fileuri,
                'data' => $data,
                'img' => $getImgUrl,
            );
        } else {
            $result = array(
                'status' => $status,
                'msg' => $msg,
            );
        }
        return $resp = json_encode($result);
    }
}
// user trail history
if (!function_exists('user_trail')) {
    function user_trail($uid, $title, $desc)
    {
        $userTrail =  & get_instance();
        $data = array(
            'user_id_fk' => $uid,
            'user_trail_title' => $title,
            'user_trail_msg' => $desc,
            'added_date' => date('Y-m-d'),
        );
        $result = $userTrail->base_model->insert_one_row('user_trail_history', $data);
        if ($result) {
            $response = array("status" => "success", "msg" => "Added successfully.");
            return json_encode($response);
        } else {
            $response = array("status" => "error", "msg" => "Not added.");
            return json_encode($response);
        }
    }
}
// clean phone number from unexpacted charactors like (,),-,+ etc
//return clean valid phone number
if (!function_exists('clean_phone')) {
    function clean_phone($phone)
    {
        //remove +1 or + 1 country code
        $phone = str_replace("+1", '', str_replace("+ 1", '', $phone));
        //remove any other character other than numeric
        $phone = preg_replace('/[^0-9\-]/', '', $phone);
        //check if phone length is 10
        return strlen($phone) == 10 ? $phone : false;
    }
}

if (!function_exists('is_enterprise_user')) {
    function is_enterprise_user()
    {
        $ci =  & get_instance();
        $userId = $ci->session->userdata('userid');
        $ci->load->model('user_model');
        $result = $ci->user_model->getUserDetails($userId, ['user_id_pk', 'role_id_fk', 'is_enterprise_user']);
        if (isset($result['is_enterprise_user']) && $result['is_enterprise_user'] == 1) {
            return true;
        } else {
            return false;
        }
    }
}

if (!function_exists('generate_sso_token')) {
    function generate_sso_token($company_id)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        $randomString = (string) time();
        for ($i = 0; $i < 4; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $randomString .= $company_id;
        for ($i = 0; $i < 4; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}

//Stripe Key
if (!function_exists('getStripeKey')) {
    function getStripeKey()
    {
        $mode = 'live';
        if (!empty($_ENV['STRIPE_MODE'])) {
            $mode = $_ENV['STRIPE_MODE'];
        }
        if (strtolower($mode) == 'sandbox' && !empty($_ENV['STRIPE_KEY_SANDBOX'])) {
            return $_ENV['STRIPE_KEY_SANDBOX'];
        } elseif (!empty($_ENV['STRIPE_KEY_LIVE'])) {
            return $_ENV['STRIPE_KEY_LIVE'];
        } else {
            return '';
        }
    }
}

//Stripe Key
if (!function_exists('getStripeSecret')) {
    function getStripeSecret()
    {
        $mode = 'live';
        if (!empty($_ENV['STRIPE_MODE'])) {
            $mode = $_ENV['STRIPE_MODE'];
        }
        if (strtolower($mode) == 'sandbox' && !empty($_ENV['STRIPE_KEY_SECRET_SANDBOX'])) {
            return $_ENV['STRIPE_KEY_SECRET_SANDBOX'];
        } elseif (!empty($_ENV['STRIPE_KEY_SECRET_LIVE'])) {
            return $_ENV['STRIPE_KEY_SECRET_LIVE'];
        } else {
            return '';
        }
    }
}
//Sitex Key
if (!function_exists('getSitexKey')) {
    function getSitexKey()
    {
        if (!empty($_ENV['SITEX_API'])) {
            return $_ENV['SITEX_API'];
        } else {
            return '';
        }
    }
}

//Google Map API key
if (!function_exists('getGoogleMapKey')) {
    function getGoogleMapKey()
    {
        if (!empty($_ENV['GOOGLE_MAP_KEY'])) {
            return $_ENV['GOOGLE_MAP_KEY'];
        } else {
            return '';
        }
    }
}

//Generate Random string
if (!function_exists('generateRandomString')) {
    function generateRandomString()
    {
        return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);
    }
}

//Check access
if (!function_exists('hasAccess')) {
    function hasAccess($path)
    {
        $CI =  & get_instance();
        $CI->load->library('role_lib');
        $hasAccess = $CI->role_lib->has_access($path);
        if ($CI->input->is_ajax_request()) {
            return $hasAccess;
        }
        if (!$hasAccess) {
            $CI->session->set_flashdata('error', 'Access denied');
            redirect('admin/dashboard');
            return;
        }
        return true;
    }
}

if (!function_exists('unmask_phone_number')) {
    function unmask_phone_number($masked_number)
    {
        // Remove all non-numeric characters
        return preg_replace('/\D/', '', $masked_number);
    }
}
