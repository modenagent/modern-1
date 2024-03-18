<?php
class Lp extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $origin = $_SERVER['HTTP_ORIGIN'];
        $allowed_domains = array('https://' . $_ENV['WIDGET_DOMAIN'], 'http://' . $_ENV['WIDGET_DOMAIN']);
        if (in_array($origin, $allowed_domains)) {
            header('Access-Control-Allow-Origin: ' . $origin);
            header('Access-Control-Allow-Credentials: true');

        }
    }

    public function getSearchResults()
    {
        $request = $_GET['requrl'];
        $request .= '&key=' . getSitexKey();

        $getsortedresults = isset($_GET['getsortedresults']) ? $_GET['getsortedresults'] : 'false';

        // if($getsortedresults != 'true') {

        //     $req_send= "https://dev.modernagent.io/index.php?/lp/getSearchResults?&requrl=".urlencode($request);

        //     echo file_get_contents($req_send);die;
        // }
        // else {
        //     $req_send = "https://dev.modernagent.io/index.php?/lp/getSearchResults?&requrl=".urlencode($request).'&getsortedresults=true';
        //     $request = 'http://modernagent.localhost.com/sample.xml';

        // }

        if ($getsortedresults == 'true') {
            //Check user and api
            $file = simplexml_load_file($request);
            $check_presentaion = $this->input->get('presentation');
            $propertyStatus = $this->input->get('propertyStatus');

            //RETS API
            $userId = $this->session->userdata('userid');
            if (empty($userId)) {
                $userId = $this->input->get('user_id');
            }
            $this->load->model('user_rets_api_details_model');
            $rets_api_data = $this->user_rets_api_details_model->get_by('user_id', $userId);
            // print_r($rets_api_data);die;
            if ($rets_api_data && !empty($rets_api_data) && $check_presentaion && ($check_presentaion == 'seller' || $check_presentaion == 'marketUpdate')) {
                $this->load->model('params_adjustment_model');
                // $retsRadius = $this->input->get('radius') ?? "0.25";
                $retsSqft = $this->input->get('sqft') ?? "0.20";
                $data = array();
                $data['user_id'] = $userId;
                $adjustableParams = (array) $this->params_adjustment_model->get_by($data);
                $propertyBaths = 0;
                $propertyBeds = 0;

                $properties = $sorted = $all = array();
                $postalCode = $file->PropertyProfile->SiteZip;
                $citi = $file->PropertyProfile->SiteCity;
                $address = $this->input->get('address');
                $query = '?q=' . urlencode($address) . '&postalCodes=' . $postalCode . '&status=' . $propertyStatus . '&limit=50';
                $properties['Lat'] = (string) $file->PropertyProfile->PropertyCharacteristics->Latitude;
                $properties['Long'] = (string) $file->PropertyProfile->PropertyCharacteristics->Longitude;
                $propertyBuildingArea = (int) $file->PropertyProfile->PropertyCharacteristics->BuildingArea;
                $this->load->library('rets');

                $user_name = $rets_api_data->user_name;
                $encrypted_password = $rets_api_data->user_password;
                $password = openssl_decrypt($encrypted_password, "AES-128-ECB", $this->config->item('encryption_key'));
                if (!empty($adjustableParams) && $adjustableParams['rets_flag']) {
                    // $retsRadius = $adjustableParams['rets_radius'] ?? "0.25";
                    // $retsSqft = $adjustableParams['rets_sqft'] ?? "0.20";
                    $propertyBaths = $adjustableParams['rets_baths'] ?? 1;
                    $propertyBeds = $adjustableParams['rets_beds'] ?? 1;

                    $minPropertyBuildingArea = $propertyBuildingArea - ($propertyBuildingArea * $retsSqft);
                    $maxPropertyBuildingArea = $propertyBuildingArea + ($propertyBuildingArea * $retsSqft);

                    // $min_lat = (float) $properties['Lat'] - 0.02;
                    // $min_long = (float) $properties['Long'] - 0.02;
                    // $max_lat = (float) $properties['Lat'] + 0.02;
                    // $max_long = (float) $properties['Long'] + 0.02;

                    $query_1 = $query . '&minarea=' . $minPropertyBuildingArea . '&maxarea=' . $maxPropertyBuildingArea;
                    // $query_2 = $query_1 . '&points=' . $min_lat . ',' . $min_long . '&points=' . $max_lat . ',' . $max_long;
                    $query_2 = $query_1;

                    if ($propertyBaths > 0) {
                        $query_2 = $query_2 . '&minbaths=' . $propertyBaths; // . '&maxbaths=' . $propertyBaths;
                    }

                    if ($propertyBeds > 0) {
                        $query_2 = $query_2 . '&minbeds=' . $propertyBeds; // . '&maxbeds=' . $propertyBeds;
                    }
                    // print_r($query_2);
                    // echo '<br> ----------------------------------------------------------------';
                    $result = $this->rets->callSimplyRets($user_name, $password, $query_2);
                    $response = json_decode($result, true);
                    if (empty($response) || count($response) <= 1) {
                        // print_r($query_1);
                        // echo '<br> ----------------------------------------------------------------';
                        $result = $this->rets->callSimplyRets($user_name, $password, $query_1);
                        $response = json_decode($result, true);
                    }
                    // echo "<pre>";
                    // print_r($response);die;
                }

                if (!isset($response) || empty($response) || count($response) <= 1) {
                    // print_r($query);
                    // echo '<br> ----------------------------------------------------------------';
                    $result = $this->rets->callSimplyRets($user_name, $password, $query);
                    $response = json_decode($result, true);
                }
                // print_r($response);
                // die;
                if (isset($response) && !empty($response)) {
                    $retsData = $this->reports->get_all_rets_properties($response);
                    usort($retsData, function ($a, $b) {
                        return (int) $b['SquareFeet'] <=> (int) $a['SquareFeet'];
                    });
                    // echo "<pre>";
                    $propertiesComparableData = $this->reports->sort_rets_properties($file, $retsData, $propertyBuildingArea, true);
                    // print_r($propertiesComparableData);die;
                    $properties['all'] = $propertiesComparableData['all'];
                    $properties['sorted'] = $propertiesComparableData['sorted'];
                    // foreach ($response as $key => $value) {
                    //     if ($key <= 7) {
                    //         $sorted[$value['mlsId']] = array(
                    //             'index' => $value['mlsId'],
                    //             'Address' => $value['address']['full'] . ' ' . $value['address']['city'],
                    //             'Price' => $value['listPrice'],
                    //             'Latitude' => $value['geo']['lat'],
                    //             'Longitude' => $value['geo']['lng'],
                    //         );
                    //     } else {
                    //         $all[$value['mlsId']] = array(
                    //             'index' => $value['mlsId'],
                    //             'Address' => $value['address']['full'] . ' ' . $value['address']['city'],
                    //             'Price' => $value['listPrice'],
                    //             'Latitude' => $value['geo']['lat'],
                    //             'Longitude' => $value['geo']['lng'],
                    //         );
                    //     }
                    // }
                }
                // $file = simplexml_load_file($request);
                // $file = json_decode(file_get_contents($req_send));
                // echo($file);die;

                // $properties['all'] = $all;
                // $properties['sorted'] = $sorted;

                $properties['use_rets'] = true;
                echo json_encode($properties);

            } else {

                $this->load->helper('dataapi');
                $file = simplexml_load_file($request);
                $this->load->library('reports');
                $allComparable = $this->reports->get_all_properties($file);
                $comparables = $this->reports->sort_properties($file, $allComparable, true);
                $comparables['Lat'] = (string) $file->PropertyProfile->PropertyCharacteristics->Latitude;
                $comparables['Long'] = (string) $file->PropertyProfile->PropertyCharacteristics->Longitude;
                $properties['use_rets'] = false;
                echo json_encode($comparables);
            }

        } else {
            $opts = array('http' => array('header' => "User-Agent:MyAgent/1.0\r\n"));
            $context = stream_context_create($opts);
            $file = file_get_contents($request, false, $context);
            echo trim($file);
        }
    }

    // generating pdf for the property
    public function getPropertyData()
    {
        $msg = "Unknown error while trying to generate report pdf for user account " . $this->session->userdata('user_email');
        try {
            $response = $this->reports->getPropertyData();
            if (isset($response['status']) && $response['status'] === false) {
                $msg = $response['msg'];
            }
        } catch (Exception $e) {
            $response = false;
            $msg = $e->getMessage();
        }
        if ($response['status']) {
            echo json_encode(array('status' => 'success'));
        } else {
            $this->base_model->queue_mail("info@modernagent.io", 'Urgent! Error occured while generating PDF', $msg, null, 'info@modernagent.io');
            $responseArray = ['status' => 'fail', 'msg' => $msg];
            if (isset($response['showError']) && ($response['showError'] == true || $response['showError'] == 'true')) {
                $responseArray['showError'] = true;
            }
            echo json_encode($responseArray);
        }
    }

    public function getDistanceBetweenPointsNew($latitude1, $longitude1, $latitude2, $longitude2, $unit = 'Mi')
    {
        $theta = $longitude1 - $longitude2;
        $distance = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
        $distance = acos($distance);
        $distance = rad2deg($distance);
        $distance = $distance * 60 * 1.1515;switch ($unit) {
            case 'Mi':break;case 'Km':$distance = $distance * 1.609344;
        }
        return (round($distance, 2));
    }

    public function getReportResults()
    {

        header('Content-type: application/xml');
        echo file_get_contents($_GET['requrl']);
    }
    public function send_queued_mails()
    {

        $status_where = array('status' => 'pending');
        $mails = $this->base_model->get_record_result_array('lp_mail_cron', $status_where);
        //Check If environment var is of devlopment or of production
        $env_mode = 'devlopment'; //Set default value
        if (!empty($_ENV['ENV_MODE'])) {
            $env_mode = trim($_ENV['ENV_MODE']);
        }
        if (strtolower($env_mode) == 'production') {
            $this->load->library('mandrill');
            $mandrill_ready = null;
            try {
                $mandrill_key = '';
                if (!empty($_ENV['MANDRILL_KEY'])) {
                    $mandrill_key = trim($_ENV['MANDRILL_KEY']);
                    $this->mandrill->init($mandrill_key);
                    $mandrill_ready = true;
                }
            } catch (Mandrill_Exception $e) {
                $mandrill_ready = false;
            }

            if ($mandrill_ready) {
                foreach ($mails as $key => $mail) {
                    $this->db->where('mail_cron_id', $mail['mail_cron_id']);
                    $this->db->update('lp_mail_cron', array('status' => 'queued'));
                }
                foreach ($mails as $key => $mail) {
                    $mailData = array(
                        'html' => $mail['content'], //Consider using a view file
                        'subject' => $mail['subject'],
                        'from_email' => 'noreply@modernagent.io',
                        'from_name' => 'ModernAgent.io',
                        'to' => array(array('email' => $mail['email_address'], "type" => "to")), //Check documentation for more details on this one
                        "track_opens" => true,
                        "track_clicks" => true,
                        "auto_text" => true,
                    );
                    $invoices_tobe_delete = [];
                    $i = 1;
                    $attachments = json_decode($mail['attachments']);
                    if (is_array($attachments)) {
                        foreach ($attachments as $attachment) {

                            if (strpos($attachment, 'user_invoices') !== false) {
                                $invoices_tobe_delete[] = $attachment;
                            }

                            $attachment_get = file_get_contents($attachment);
                            $attachment_encoded = base64_encode($attachment_get);
                            $mailData['attachments'][] = array(
                                'path' => base_url($attachment),
                                'type' => "application/pdf",
                                'name' => "document" . $i++ . ".pdf",
                                'content' => $attachment_encoded,
                            );
                        }
                    }
                    $mail_response = $this->mandrill->messages_send($mailData);
                    $this->db->where('mail_cron_id', $mail['mail_cron_id']);

                    if ($mail_response[0]['status'] == 'queued' || $mail_response[0]['status'] == 'sent') {
                        $updatedData = array('status' => 'finished', 'delivered_at' => date('Y-m-d H:i:s'));
                    } else {
                        $updatedData = array('status' => 'failed');
                    }
                    $this->db->update('lp_mail_cron', $updatedData);

                    /**
                     * Delete Invoice file after attachment send through mail
                     */
                    if (!empty($invoices_tobe_delete)) {
                        foreach ($invoices_tobe_delete as $key => $delete_invoice) {
                            if ($delete_invoice != '' && file_exists($delete_invoice)) {
                                unlink($delete_invoice);
                            }
                        }
                    }
                }

            }
        } else {

            $this->load->config('email');
            $this->load->library('email');

            foreach ($mails as $mail) {
                # code...
                $this->email->from('noreply@modernagent.io', 'ModernAgent.io');
                $this->email->to($mail['email_address']);

                $this->email->subject($mail['subject']);
                $this->email->message($mail['content']);

                // echo $this->email->print_debugger();

                $invoices_tobe_delete = [];
                $i = 1;
                $attachments = json_decode($mail['attachments']);
                if (is_array($attachments)) {
                    foreach ($attachments as $attachment) {
                        $attachment_path = FCPATH . $attachment;
                        if (!empty($attachment) && file_exists($attachment_path)) {

                            if (strpos($attachment, 'user_invoices') !== false) {
                                $invoices_tobe_delete[] = $attachment_path;
                            }

                            $this->email->attach($attachment_path);
                        }

                    }
                }
                $mail_response = $this->email->send();

                // die;

                if ($mail_response) {
                    $updatedData = array('status' => 'finished', 'delivered_at' => date('Y-m-d H:i:s'));
                } else {
                    $updatedData = array('status' => 'failed');
                }
                $update_where = array('mail_cron_id' => $mail['mail_cron_id']);
                $this->base_model->update_record_by_id('lp_mail_cron', $updatedData, $update_where);

                /**
                 * Delete Invoice file after attachment send through mail
                 */
                if (!empty($invoices_tobe_delete)) {
                    foreach ($invoices_tobe_delete as $key => $delete_invoice) {
                        if ($delete_invoice != '' && file_exists($delete_invoice)) {

                            unlink($delete_invoice);
                        }
                    }
                }

            }

        }

    }
    public function coupon_usage_report()
    {
        $day = date('w');
        $week_start = date('M/d', strtotime('-' . (7 + $day) . ' days'));
        $week_start_date = date('Y-m-d 00:00:00', strtotime('-' . (7 + $day) . ' days'));
        $week_end = date('M/d', strtotime('-' . ($day + 1) . ' days'));
        $week_next_date = date('Y-m-d 00:00:00', strtotime('-' . ($day) . ' days'));

        $sql = "SELECT lh.report_type,lh.project_name, lh.property_address, u.user_id_pk,u.email,u.first_name,u.last_name,u2.email as u_email,u2.first_name as u_fname,u2.last_name as u_lname,l.id as r_id,l.redeem_count as r_count,lh.redeem_at,c.coupon_id_pk,c.coupon_code,c.coupons_applied_cnt,c.uses_per_user FROM lp_coupon_mst as c
                    JOIN lp_user_mst as u ON REPLACE (c.coupon_code, 'REF', '')*1 = u.user_id_pk
                    LEFT JOIN lp_coupon_redeem_log as l ON l.coupon_id_fk = c.coupon_id_pk
                    LEFT JOIN lp_coupon_redeem_log_history as lh ON lh.redeem_log_id = l.id
                    LEFT JOIN lp_user_mst as u2 ON u2.user_id_pk = l.user_id
                    where c.coupon_code like 'REF%'
                    AND u.role_id_fk=3 AND u.parent_id!='' AND u.parent_id is not null AND u .email is not null AND u .email !=''
                    AND lh.redeem_at >='{$week_start_date}' AND lh.redeem_at <'{$week_next_date}'
                    ";
        $res = $this->db->query($sql);
        $result = array();
        foreach ($res->result() as $data) {
            $result[$data->user_id_pk]['full_name'] = ucwords($data->first_name . " " . $data->last_name);
            $result[$data->user_id_pk]['email'] = $data->email;
            $result[$data->user_id_pk]['email'] = $data->email;
            $result[$data->user_id_pk]['coupon_code'] = $data->coupon_code;
            $result[$data->user_id_pk]['usage_per_user'] = $data->uses_per_user;
            $result[$data->user_id_pk]['coupon_id_pk'] = $data->coupon_id_pk;
            if ($data->r_id) {
                $result[$data->user_id_pk]['log'][$data->r_id]['full_name'] = ucwords($data->u_fname . " " . $data->u_lname);
                $result[$data->user_id_pk]['log'][$data->r_id]['redeem_count'] = $data->r_count;
                if ($data->redeem_at) {

                    $result[$data->user_id_pk]['log'][$data->r_id]['history'][] = array(
                        'redeem_at' => $data->redeem_at,
                        'report_type' => $data->report_type,
                        'project_name' => $data->project_name,
                        'property_address' => $data->property_address,
                    );
                }
            }
        }
        foreach ($result as $data) {
            $html = $this->load->view('usage_report_email', array('data' => $data, 'week_start' => $week_start, 'week_end' => $week_end), true);

            $this->base_model->queue_mail($data['email'], 'Weekly referral code usage Report', $html);

            //Refresh Reffaral code coupon use per week.
            $this->db->where('coupon_id_fk', $data['coupon_id_pk']);
            $this->db->update('lp_coupon_redeem_log', array('redeem_count' => 0));
        }

    }
    public function curl_ac_sync()
    {

        // By default, this sample code is designed to get the result from your ActiveCampaign installation and print out the result
        $url = 'https://pacificcoasttitlecompany.api-us1.com';
        $params = array(

            // the API Key can be found on the "Your Settings" page under the "API" tab.
            // replace this with your API Key
            'api_key' => 'f7b1a3866ad1121b612376d0d33b42f92bdd4ef9425526dc8ef216ff507f1cacb4a79187',

            // this is the action that adds a contact
            'api_action' => 'contact_sync',

            // define the type of output you wish to get back
            // possible values:
            // - 'xml'  :      you have to write your own XML parser
            // - 'json' :      data is returned in JSON format and can be decoded with
            //                 json_decode() function (included in PHP since 5.2.0)
            // - 'serialize' : data is returned in a serialized format and can be decoded with
            //                 a native unserialize() function
            'api_output' => 'serialize',
        );
        $sql = "select u.first_name,u.last_name,u.email,u.phone,u.registered_date,concat(sales.first_name,sales.last_name) as sales_rep, c.company_name, c.company_add
                    from lp_user_mst as u
                    join lp_user_mst as sales on sales.user_id_pk = u.parent_id and sales.role_id_fk = 3
                    join lp_user_mst as c on c.user_id_pk = sales.parent_id and c.role_id_fk = 2
                    where u.role_id_fk=4";
        $query = $this->db->query($sql);
        $res = $query->result_array();
        echo "<pre>";
        //print_r($res);//die;
        foreach ($res as $row) {
            // here we define the data we are posting in order to perform an update
            $post = array(
                'email' => $row['email'],
                'first_name' => $row['first_name'],
                'last_name' => $row['last_name'],
                'phone' => $row['phone'], //'+91 9898989898',

                'orgname' => 'Modern Agent',
                'tags' => 'api',
                // assign to lists:
                'p[1]' => 1, // example list ID (REPLACE '123' WITH ACTUAL LIST ID, IE: p[5] = 5)
                'status[1]' => 1, // 1: active, 2: unsubscribed (REPLACE '123' WITH ACTUAL LIST ID, IE: status[5] = 1)
                'field[1,0]' => date('Y-m-d', strtotime($row['registered_date'])),
                'field[2,0]' => $row['sales_rep'],
                'field[3,0]' => $row['company_name'],
                'field[4,0]' => $row['company_add'],
            );

            // This section takes the input fields and converts them to the proper format
            $query = "";
            foreach ($params as $key => $value) {
                $query .= urlencode($key) . '=' . urlencode($value) . '&';
            }

            $query = rtrim($query, '& ');

            // This section takes the input data and converts it to the proper format
            $data = "";
            foreach ($post as $key => $value) {
                $data .= urlencode($key) . '=' . urlencode($value) . '&';
            }

            $data = rtrim($data, '& ');

            // clean up the url
            $url = rtrim($url, '/ ');

            // This sample code uses the CURL library for php to establish a connection,
            // submit your request, and show (print out) the response.
            if (!function_exists('curl_init')) {
                die('CURL not supported. (introduced in PHP 4.0.2)');
            }

            // If JSON is used, check if json_decode is present (PHP 5.2.0+)
            if ($params['api_output'] == 'json' && !function_exists('json_decode')) {
                die('JSON not supported. (introduced in PHP 5.2.0)');
            }

            // define a final API request - GET
            $api = $url . '/admin/api.php?' . $query;

            $request = curl_init($api); // initiate curl object
            curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
            curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
            curl_setopt($request, CURLOPT_POSTFIELDS, $data); // use HTTP POST to send form data
            //curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment if you get no gateway response and are using HTTPS
            curl_setopt($request, CURLOPT_FOLLOWLOCATION, true);

            $response = (string) curl_exec($request); // execute curl post and store results in $response

            // additional options may be required depending upon your server configuration
            // you can find documentation on curl options at http://www.php.net/curl_setopt
            curl_close($request); // close curl object

            if (!$response) {
                die('Nothing was returned. Do you have a connection to Email Marketing server?');
            }

            // This line takes the response and breaks it into an array using:
            // JSON decoder

            // unserializer
            $result[] = unserialize($response);
            // XML parser...
            // ...
        }
        // Result info that is always returned

        // The entire result printed out

        echo '<pre>';

        print_r($result);

        echo '</pre>';

        // Raw response printed out
        echo 'Raw response printed out:<br />';
        echo '<pre>';
        print_r($response);
        echo '</pre>';

        // API URL that returned the result
        echo 'API URL that returned the result:<br />';
        echo $api;

        echo '<br /><br />POST params:<br />';
        echo '<pre>';

        echo '</pre>';
    }
    public function get_reports()
    {
        if ($this->session->userdata('userid')) {
            $reports = $this->base_model->get_all_record_by_id('lp_my_listing',
                array(
                    'user_id_fk' => $this->session->userdata('userid'),
                    'is_active' => 'Y',
                ),
                'project_date', 'desc'
            );
            $resp = array(
                'status' => 'success',
                'data' => $reports,
            );
        } else {
            $resp = array(
                'status' => 'fail',
                'msg' => 'User is not logged in.',
            );
        }
        echo json_encode($resp);
        exit;
    }
    public function get_bills()
    {
        if ($this->session->userdata('userid')) {
            $billing = $this->dashboard_model->getBillingHistory($this->session->userdata('userid'));
            $resp = array(
                'status' => 'success',
                'data' => $billing,
            );
        } else {
            $resp = array(
                'status' => 'fail',
                'msg' => 'User is not logged in.',
            );
        }
        echo json_encode($resp);
        exit;
    }
    public function report_progress()
    {
        $report = $this->input->post('report');
        // $rows = file("temp/logs.csv");
        // $last_row = array_pop($rows);
        // $row = str_getcsv($last_row);
        $data = null;
        $data = $row = "Page 1 of 1
Done";
        /*if(!empty($row)){
        $data = $row[0];
        }*/
        if (strpos($data, "%") !== false) {
            //preparing content %
            // e.g. 84%
            $data = trim(str_replace("%", "", $data));
            echo json_encode(array('type' => "content_percent", 'percent' => (int) $data));
        } else if (strpos($data, "Page") !== false) {
            //Pages done
            //e.g. Page 1 of 21
            if ($report == 'market') {
                // Because market report having 1 page only
                $data = '1 of 1';
            }
            $data = trim(str_replace("Page", "", $data));
            $pagesArray = explode("of", $data);
            echo json_encode(
                array(
                    'type' => "pages_done",
                    "pages" => (int) trim($pagesArray[0]),
                    "max" => (int) trim($pagesArray[1]),
                )
            );
        }

    }
}
