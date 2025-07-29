<?php defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Report extends REST_Controller
{
    // Initialize Constructor Here
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('validation_helper');
        //$this->load->helper('api_helper');
        $this->load->model('user_model');
        // $this->methods['user_get']['limit'] = 500; //500 requests per hour per user/key
        // $this->methods['user_post']['limit'] = 100; //100 requests per hour per user/key
        // $this->methods['user_delete']['limit'] = 50; //50 requests per hour per user/key
        //
        $tokenValidity = validateToken();
        if ($tokenValidity['status'] == 'error') {
            $this->response($tokenValidity, 401);
        }
    }

    /*
     *  @name: propertyId_get
     *  @author: Avtar Gaur <info@modernagent.io>
     *  @created: Feb 13, 2019
     *  @description: Get Property APNs
     */
    public function propertyid_get()
    {
        $data = array();
        $data = validate_my_params(
            array(
                'address' => 'required',
                'city' => 'required',
                'token' => 'required',
            )
        );

        if ($data['status'] == 'success') {
            $paramData = $data['data'];
            $requestParams = array(
                'Address' => $paramData['address'],
                'LastLine' => $paramData['city'],
                'ClientReference' => '<CustCompFilter><SQFT>0.20</SQFT><Radius>0.75</Radius></CustCompFilter>',
                'OwnerName' => '',
                'reportType' => '187',
            );

            $reqURL = 'http://api.sitexdata.com/sitexapi/sitexapi.asmx/AddressSearch?' . http_build_query($requestParams);
            $apiCallRequest = base_url('lp/getSearchResults/1') . '?requrl=' . urlencode($reqURL);
            $opts = array('http' => array('header' => "User-Agent:MyAgent/1.0\r\n"));
            $context = stream_context_create($opts);
            $apnData = file_get_contents($apiCallRequest, false, $context);
            // $xml = simplexml_load_string($apnData);
            $xml = simplexml_load_string($apnData, "SimpleXMLElement", LIBXML_NOCDATA);
            $apns = json_decode(json_encode($xml), true);
            $apns['ReportURL'] = str_replace(array("\n", "\r"), '', $apns['ReportURL']);
            $reportDataCode = get_string_between('/187/', '.asmx/', $apns['ReportURL']);
            $reportDataParam = get_string_between('?reportInfo=', '&filter', $apns['ReportURL']);
            $propertyApns = array();
            if ($apns['StatusCode'] != 'OK') {
                $propertyApns = $apns['Status'];
                $resultType = 'error';
                $code = 400;
            } elseif (isset($apns['Locations'])) { // gathering the apns and address data to return to api
                foreach ($apns['Locations'] as $key => $value) {
                    $propertyApns[] = array(
                        'apn' => $value['APN'],
                        'fips' => $value['FIPS'],
                        'address' => $value['Address'],
                        'city' => $value['City'],
                        'state' => $value['State'],
                        'zip' => $value['ZIP'],
                        'reportDataCode' => $reportDataCode,
                        'reportDataParam' => $reportDataParam,
                        // 'report'            =>  $apns['ReportURL']
                        // 'Owner'     =>  $value['Owner']
                    );
                    $resultType = 'success';
                    $code = 200;
                }
            }

            // https://api.sitexdata.com/187/1E0F8F50-6300-4d9f-BA0F-180ADAEDF187.asmx/GetXML?reportInfo=dKisb-FCbSKAO1siAin0oLD6GZBGc3cisVNb2RkavotM-XDGonqXvlgdE1B8fm7sOQNUkEVo0mdo7oUYtX3qlxgf6HMky4B6DqNDt4KpO0S-CHpF4KlZimY1&filter=%3CCustCompFilter%3E%3CSQFT%3E0.20%3C/SQFT%3E%3CRadius%3E2.00%3C/Radius%3E%3C%20/CustCompFilter%3E
            // property lookup result
            $result = array(
                'status' => $resultType,
                'apnData' => $propertyApns,
            );

            // response to the api
            $this->response($result, $code);
        } else {
            $this->response(array('status' => 'error', 'message' => $data['errors']), 400);
        }
    }

    /*
     *  @name: generateReport_post
     *  @author: Avtar Gaur <info@modernagent.io>
     *  @created: Feb 14, 2019
     *  @description: Generate Property Report
     */
    public function generateReport_post()
    {
        $data = array();
        $data = validate_my_params(
            array(
                'reportDataCode' => 'required',
                'reportDataParam' => 'required',
                'profile_image' => 'required',
                'fullname' => 'required',
                'title' => 'required',
                'phone' => '',
                'email' => 'required',
                'licenceno' => '',
                'company_logo' => 'required',
                'companyname' => 'required',
                'street' => 'required',
                'city' => 'required',
                'zip' => 'required',
                'state' => 'required',
                // 'user_image'        =>  '',
                // 'company_image'     =>  '',
                // 'presentation'      =>  '',
                // 'pdfID'             =>  '',
                // 'showpartner'       =>  '',
                'theme' => '',
                'report_lang' => '',
                // 'custom_comps'      =>  '',
                'token' => 'required',
                'report_type' => '',
            ),
            1
        );

        if ($data['status'] == 'success') {
            $data = $data['data'];

            // processing the data sent and prepare array to be used for report generation
            $reportDataArray = array(
                'report187' => 'http://api.sitexdata.com/187/' . $data['reportDataCode'] . '.asmx/GetXML?reportInfo=' . $data['reportDataParam'] . '&filter=0.202.00</CustCompFilter>',
                'user' => array(
                    'profile_image' => $data['profile_image'],
                    'fullname' => $data['fullname'],
                    'title' => $data['title'],
                    'phone' => $data['phone'],
                    'email' => $data['email'],
                    'licenceno' => $data['licenceno'],
                    'company_logo' => $data['company_logo'],
                    'companyname' => $data['companyname'],
                    'street' => $data['street'],
                    'city' => $data['city'],
                    'zip' => $data['zip'],
                    'state' => $data['state'],
                ),
                'user_image' => '',
                'presentation' => (!empty($data['report_type'])) ? $data['report_type'] : 'seller',
                'company_image' => '',
                'pdfID' => '',
                'showpartner' => 'off',
                'theme' => (!empty($data['theme'])) ? rgb2hex($data['theme']) : '#1bbc9b',
                'report_lang' => (!empty($data['report_lang'])) ? $data['report_lang'] : 'english',
                'custom_comps' => "'0','1','2','3','4','5','6','7'",
                'callFromApi' => 1,
                'token' => $data['token'],
            );
            // error message
            $msg = "Unknown error while trying to generate report pdf for user account with token " . $data['token'];

            // try catching the report generation so that Exceptions can be handled
            try {
                $response = $this->reports->getPropertyData(1, $reportDataArray); // this is an api call
                if (isset($response['status']) && $response['status'] === false) {
                    $msg = $response['msg'];
                }
            } catch (Exception $e) {
                $response = false;
                $msg = $e->getMessage();
            }
            // dump($response);
            if ($response['status']) {
                $this->response(array('status' => 'success', 'reportLink' => $response['reportLink']), 201);
            } else {
                $extraMessage = '';
                if ($callFromApi == 1) {
                    $extraMessage = ' From API';
                }

                $this->base_model->queue_mail("info@modernagent.io", 'Urgent! Error occured while generating PDF' . $extraMessage, $msg, null, 'info@modernagent.io');
                $this->response(array('status' => 'error', 'message' => $msg), 417);
            }
        } else {
            $this->response(array('status' => 'error', 'message' => $data['errors']), 400);
        }
    }
}
