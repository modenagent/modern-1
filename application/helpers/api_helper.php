<?php
    /**
     * generate the token for a user and save it to the database
     * Avtr Gour <info@modernagent.io
     * Jan 28, 2019
     */
    function generateToken($number){
        $CI = &get_instance();
        // creating a token
        $token = md5($number.date(now()) ."2fnw23dpqi0u9234hnfewioe2iur2093u");

        // check if there is already a token active then we give that otherwise we delete existing and create new one
        $getActiveToken = $CI->db->where('uid', $number)
                                ->where('archived', NULL)
                                ->limit(1)
                                ->get('apitokens')
                                ->row_array();

        // if there is no active token then we add the newly created one
        if(empty($getActiveToken)){
            $insertData= array(
                            'token' =>  $token,
                            'uid'   =>  $number
                         );
            $CI->db->insert('apitokens', $insertData);
            return $token;
        }else{
            // returning the token that exists
            return $getActiveToken['token'];
        }
    }

    /**
     * generate a new token for a user and archive the already existing one's for this user
     * Avtr Gour <info@modernagent.io
     * Jan 28, 2019
     */
    function regenerateToken($number){
        $CI = &get_instance();
        // creating a token
        $token = md5($number.date(now()) ."2fnw23dpqi0u9234hnfewioe2iur2093u");

        // check if there is already token active then
        $getActiveToken = $CI->db->where('uid', $number)
                                ->where('archived', NULL)
                                ->get('apitokens')
                                ->row_array();

        // if there are active tokens then we archive them and then create new one
        if(!empty($getActiveToken)){
            // marking the already existing one's as archived
            $CI->db->where('uid', $number)->update('apitokens', array('archived' => 1));
        }

        // creating new token 
        $insertData= array(
                        'token' =>  $token,
                        'uid'   =>  $number
                     );

        $CI->db->insert('apitokens', $insertData);
        return $token;
    }

    /*
     * Function: validateToken
     * Description: It validates the access token provided with the request
     *
     * @author: Avtar Gaur <info@modernagent.io>
     * @updatedOn: Jan 28, 2019
     */
    function validateToken($token = '', $returnALL = false){
        $CI=& get_instance();

        // if token is not provided in the params then we look into the GET POST vars
        if($token == ''){
            $token = $CI->input->get_post('token');
        }

        if(empty($token)){
            return array(
                        'status' => 'error',
                        'message'   =>  'Token is required'
                   );
        }
        $q = $CI->db->select('uid')
                        ->where('token is NOT NULL and token like ', $token)
                        ->limit(1)
                        ->get('apitokens')
                        ->row_array();

        if(count($q) > 0){
            if($returnALL){
                $user = checkUnique("lp_user_mst", "user_id_pk", $q['uid'], "*");
                unset($user['password']);
                unset($user['billing_cvv_code']);
                unset($user['billing_creadit_card_no']);
                unset($user['billing_zipcode']);
                unset($user['billing_name']);
                return $user;
            }else{
                return TRUE;
            }
        }else{
            return array(
                        'status' => 'error',
                        'message'   =>  'Invalid Token, you can get a newed token by logging in again.'
                   );
        }
    }

    /**
     * Get userId by token 
     * Avtr Gour <info@modernagent.io
     * Feb 14, 2019
     */
    function getUserIdByToken($token = ''){
        $CI = &get_instance();

        // checking uid for the token
        $getActiveToken = $CI->db->where('token', $token)
                                ->where('archived', NULL)
                                ->get('apitokens')
                                ->row_array();

        // if there are active tokens then return the uid of that token
        if(!empty($getActiveToken)){
            return $getActiveToken['uid'];
        }
        return 0;
    }

    /*
     * Function: checkUnique
     * Description: Common method to check the uniqueness of a value in a colum in a table and return valurs or bool
     *
     * @author: Avtar Gaur <info@modernagent.io>
     * @created: Jan 28, 2019
     */
    function checkUnique($tableName, $columnName, $value, $returnKey = -1){
        $CI = &get_instance();

        $selectStr = $columnName;

        if($returnKey != -1){
            if($returnKey == '*'){
                $selectStr = '*';
            }elseif($columnName != $returnKey){
                $selectStr .= ', '. $returnKey;
            }
        }

        $check = $CI->db->select($selectStr)
                                ->where($columnName,$value)
                                        ->limit(1)
                                            ->get($tableName)
                                                ->row_array();


        if(!empty($check)){
            if($returnKey == -1){
                return 1;
            }elseif($returnKey == '*'){
                return $check;
            }else{
                return $check[$returnKey];
            }
        }else{
            return 0;
        }
    }

    /*
     * Function: apiCommonSuccess
     * Description: Common method for successful api request
     *
     * @author: Avtar Gaur <info@modernagent.io>
     * @created: Jan 28, 2019
     */
    function apiCommonSuccess($data){
        // enabling gzip compression
        if(substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')){
            ob_start("ob_gzhandler");
        }else{
            ob_start();
        }

        $CI= &get_instance();

        $data['status'] = 'success';

        $CI->benchmark->mark('code_end');
        $data['elapsed_time'] = $CI->benchmark->elapsed_time('code_start', 'code_end');

        //header('Content-Type: application/json');
        //error_log('Dump from apiCommonSuccess: '.json_encode($data, true));
        echo json_encode($data);
        exit();
    }

    /*
     * Function: apiCommonSuccess
     * Description: Common method for error api request
     *
     * @author: Avtar Gaur <info@modernagent.io>
     * @created: Jan 28, 2019
     */
    function apiCommonErrorWithData($data){
        // enabling gzip compression
        if(substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')){
            ob_start("ob_gzhandler");
        }else{
            ob_start();
        }

        $CI= &get_instance();

        $data['status'] = 'failure';

        $CI->benchmark->mark('code_end');
        $data['elapsed_time'] = $CI->benchmark->elapsed_time('code_start', 'code_end');

        echo json_encode($data);
        exit();
    }

    /*
     * Function: apiCommonSuccess
     * Description: Common method for error api request
     *
     * @author: Avtar Gaur <info@modernagent.io>
     * @created: Jan 28, 2019
     */
    function apiCommonError($response_code = 200, $message = ''){
        $CI= &get_instance();

        echo json_encode(
                    array(
                        'status'    => 'failure',
                        'message'   => $message,
                        'code'      => $code
                    )
                );
        exit();
    }
    function dump($var, $die = 0){
        echo '<pre>';
        print_r($var);
        echo '</pre>';
        if($die == 1)
            die();
    }

    function get_string_between($start, $end, $string){
        $string = " ".$string;
        $ini = strpos($string,$start);
        if ($ini == 0) return "";
        $ini += strlen($start);   
        $len = strpos($string,$end,$ini) - $ini;
        return substr($string,$ini,$len);
    }

    function rgb2hex($color){
        $rgb = get_string_between('rgb(', ')', $color);
        $rgbarr = explode(',', $rgb, 3);

        return sprintf("#%02x%02x%02x", $rgbarr[0], $rgbarr[1], $rgbarr[2]);
    }
?>