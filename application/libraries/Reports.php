<?php
/**
 * The Library for the operations related to Report Generation.
 *
 *
 * Date: Nov 30, 2016
 */

use Knp\Snappy\Pdf;

class Reports
{

    private function _prepareMinMaxComparable($priceRate, &$firstTime, &$minPrice, &$maxPrice, &$tmp_property, &$tmp_lot_size, &$lotSize, &$min_lot_size, &$max_lot_size)
    {
        if ($firstTime) {
            $minPrice = floatval($priceRate);
            $maxPrice = floatval($priceRate);

            $min_lot_size = $lotSize;
            $max_lot_size = $lotSize;
            $firstTime = false;
        }
        if ($minPrice > floatval($priceRate)) {
            $minPrice = floatval($priceRate);
        }
        if ($maxPrice < floatval($priceRate)) {
            $maxPrice = floatval($priceRate);
        }

        if ($min_lot_size > $lotSize) {
            $min_lot_size = $lotSize;
        }
        if ($max_lot_size < $lotSize) {
            $max_lot_size = $lotSize;
        }

        $tmp_property += $priceRate;
        $tmp_lot_size += $lotSize;
    }

    public function getPropertyData($callFromApi = 0, $reportData = array())
    {
        $CI = &get_instance();
        $errorMsg = "Unexpacted error occured while trying to create " . $_POST['report_lang'] . " " . $_POST['presentation'] . " Report PDF for user account " . $CI->session->userdata('user_email');
        // loading the required helper
        $CI->load->helper('dataapi');
        $user_info = null;

        // if call is from the API then we give the data after processing on our end
        if ($callFromApi == 1) {
            $_POST = $reportData;
            $data['callFromApi'] = $callFromApi;
        }

        $rep111 = $_POST['report111'];
        $reportLang = isset($_POST['report_lang']) && !empty($_POST['report_lang']) ? strtolower($_POST['report_lang']) : '';
        $compKeys = json_decode(stripslashes($_POST['custom_comps']));
        $rep111 = urldecode($rep111);
        $report111 = @simplexml_load_file($rep111);

        $rep187 = $_POST['report187'];
        $rep187 = urldecode($rep187);
        $report187 = simplexml_load_file($rep187);
        // changes for local version starts here and comment above line => $report187 = simplexml_load_file($rep187);
        // $report187 = simplexml_load_file("sample.xml");
        // changes for local version ends here

        $data['mapinfo'] = $report111;
        $data['property'] = $report187;
        $data['report_lang'] = $reportLang;
        $data['user'] = $_POST['user'];
        if ($_POST['user_image'] != '') {
            $data['user']['profile_image'] = $_POST['user_image'];
        }
        if ($_POST['company_image'] != '') {
            $data['user']['company_logo'] = $_POST['company_image'];
        }

        if ($data['user']['email'] != '') {
            // $CI =& get_instance();
            $ref_code = $CI->db->select('ref_code')
                ->where('email', $data['user']['email'])
                ->get('lp_user_mst')
                ->row_array();

            $data['user']['ref_code'] = $ref_code['ref_code'];

            $user_info = $CI->db->select(array('user_id_pk', 'mobile', 'website'))
                ->where('email', $data['user']['email'])
                ->get('lp_user_mst')
                ->row_array();

            $data['user']['ref_code'] = $ref_code['ref_code'];
            $data['user']['mobile'] = $user_info['mobile'];
            $data['user']['website'] = $user_info['website'];
        }

        $data['partner'] = array();
        if ($_POST['showpartner'] == 'on') {
            if (isset($_POST['partner']) && !empty($_POST['partner'])) {
                foreach ($_POST['partner'] as $_key => $_partner) {
                    foreach ($_partner as $i => $_data) {
                        $data['partner'][$i][$_key] = $_data;
                    }
                }
            }

            if (!empty($data['partner'])) {
                $data['user_id_fk'] = $CI->session->userdata('userid');
                foreach ($data['partner'] as $_partner) {
                    // Currently these partner details in databse are of no use
                    //$CI->base_model->insert_one_row('lp_partner_details',$_partner);
                }
            }
        }
        $ownerNamePrimary = (string) $report187->PropertyProfile->PrimaryOwnerName;
        $ownerNameSecondary = (string) $report187->PropertyProfile->SecondaryOwnerName;
        if (strpos($ownerNamePrimary, ";") !== false) {
            $_primeNameArr = explode(";", $ownerNamePrimary);
            $ownerNamePrimary = ucwords(trim($_primeNameArr[0]));
            if ($ownerNameSecondary == '') {
                $ownerNameSecondary = ucwords(trim($_primeNameArr[1]));
            }
        }
        if (strpos($ownerNamePrimary, ",") !== false) {
            $_primeNameArr = explode(",", $ownerNamePrimary);
            //Setting Last name at last like for HERNANDEZ, GERARDO JOVANNI name will be GERARDO JOVANNI HERNANDEZ
            $ownerNamePrimary = ucwords(trim($_primeNameArr[1])) . ' ' . ucwords(trim($_primeNameArr[0]));
        }
        if (strpos($ownerNameSecondary, ",") !== false) {
            $_secNameArr = explode(",", $ownerNameSecondary);
            //Setting Last name at last like for HERNANDEZ, GERARDO JOVANNI name will be GERARDO JOVANNI HERNANDEZ
            $ownerNameSecondary = ucwords(trim($_secNameArr[1])) . ' ' . ucwords(trim($_secNameArr[0]));
        }
        $data['primary_owner'] = $ownerNamePrimary;
        $data['secondary_owner'] = $ownerNameSecondary;
        $data['presentation'] = $_POST['presentation'];
        $reportItems['comparable'] = array();
        if ($_POST['presentation'] != 'registry') {
            $rets_login = '';
            $rets_pasword = '';
            if ($user_info) {
                $userId = $user_info['user_id_pk'];
                $CI->load->model('user_rets_api_details_model');
                $rets_api_data = $CI->user_rets_api_details_model->get_by('user_id', $userId);
            }

            if ($CI->input->post('use_rets') && ($CI->input->post('use_rets') == 1 || $CI->input->post('use_rets') == 'true') && $rets_api_data && !empty($rets_api_data)) {
                //Start RETS

                $user_name = $rets_api_data->user_name;
                $encrypted_password = $rets_api_data->user_password;
                $password = openssl_decrypt($encrypted_password, "AES-128-ECB", $CI->config->item('encryption_key'));

                // $comparables = $this->sort_properties($report187, $comparableTemp);
                // $reportItems['comparable'] = $comparables['sorted'];

                $mls_comparables = array();

                $mls_ids = $compKeys;

                if (isset($mls_ids) && !empty($mls_ids)) {
                    $CI->load->library('rets');
                    foreach ($mls_ids as $m_key => $m_value) {
                        $mls_id = $m_value;
                        $endPoint = '/' . $mls_id;
                        // $result = $this->make_request('GET', $endPoint);
                        $result = $CI->rets->callSimplyRets($user_name, $password, $endPoint);
                        $response = json_decode($result, true);

                        if (isset($response) && !empty($response)) {
                            $mls_comparables[$m_key]['mls_id'] = isset($mls_id) && !empty($mls_id) ? $mls_id : '';
                            $mls_comparables[$m_key]['img'] = isset($response['photos'][0]) && !empty($response['photos'][0]) ? $response['photos'][0] : '';
                            $mls_comparables[$m_key]['Address'] = isset($response['address']['full']) && !empty($response['address']['full']) ? $response['address']['full'] : '';
                            $mls_comparables[$m_key]['cityState'] = isset($response['address']['city']) && !empty($response['address']['city']) ? $response['address']['city'] . ', ' . $response['address']['state'] : '';
                            $mls_comparables[$m_key]['Price'] = isset($response['listPrice']) && !empty($response['listPrice']) ? dollars(number_format((string) $response['listPrice'])) : '';
                            $mls_comparables[$m_key]['PriceRate'] = isset($response['listPrice']) && !empty($response['listPrice']) ? (float) $response['listPrice'] : 0.00;
                            $mls_comparables[$m_key]['Date'] = isset($response['listDate']) && !empty($response['listDate']) ? date('m/d/Y', strtotime($response['listDate'])) : '';
                            $mls_comparables[$m_key]['Distance'] = 0;
                            $mls_comparables[$m_key]['SquareFeet'] = isset($response['property']['area']) && !empty($response['property']['area']) ? number_format((string) $response['property']['area']) : '';
                            $mls_comparables[$m_key]['PricePerSQFT'] = isset($response['property']['area']) && !empty($response['property']['area']) ? round($response['listPrice'] / $response['property']['area'], 2) : '-';
                            $mls_comparables[$m_key]['Beds'] = isset($response['property']['bedrooms']) && !empty($response['property']['bedrooms']) ? number_format((string) $response['property']['bedrooms']) : '';
                            $mls_comparables[$m_key]['Baths'] = isset($response['property']['bathrooms']) && !empty($response['property']['bathrooms']) ? number_format((string) $response['property']['bathrooms']) : '';
                            $mls_comparables[$m_key]['Year'] = isset($response['property']['yearBuilt']) && !empty($response['property']['yearBuilt']) ? (string) $response['property']['yearBuilt'] : '';
                            $mls_comparables[$m_key]['Pool'] = isset($response['property']['pool']) && !empty($response['property']['pool']) && $response['property']['pool'] != 'None' ? 'Yes' : 'No';
                            $lotSizeArea = isset($response['property']['lotSizeArea']) && !empty($response['property']['lotSizeArea']) ? number_format((string) $response['property']['lotSizeArea']) : '';
                            $mls_comparables[$m_key]['LotSize'] = $lotSizeArea;
                            $mls_comparables[$m_key]['BuildingArea'] = $lotSizeArea;
                        }
                    }
                }

                $reportItems['comparable'] = $mls_comparables;

                //END RETS
            } else {

                $comparableTemp = $this->get_all_properties($report187);

                if (empty($compKeys)) {
                    $comparables = $this->sort_properties($report187, $comparableTemp);
                    $reportItems['comparable'] = $comparables['sorted'];
                } else {
                    foreach ($comparableTemp as $key => $_property) {
                        if (in_array($key, $compKeys)) {
                            array_push($reportItems['comparable'], $_property);
                        }
                    }
                }
            }

            // var_dump($data);die;
            if (empty($reportItems['comparable'])) {
                return ["status" => false, "showError" => true, "msg" => "Report can not be generated due to lack of comparable data."];
            }

            $salesAnalysis = $this->sales_analysis($reportItems['comparable']);

            $reportItems['priceMinRange'] = round($salesAnalysis['minPrice'] / 1000, 2);
            $reportItems['priceMaxRange'] = round($salesAnalysis['maxPrice'] / 1000, 2);

            $propertyYear = (string) $report187->PropertyProfile->PropertyCharacteristics->YearBuilt[0];
            $reportItems['areaYear'] = $propertyYear;
            $reportItems['areaYearLow'] = minMaxArray('Year', 'min', $reportItems['comparable']);
            $reportItems['areaYearMedian'] = minMaxArray('Year', 'median', $reportItems['comparable']);
            $reportItems['areaYearHigh'] = minMaxArray('Year', 'max', $reportItems['comparable']);

            $reportItems['areaBedrooms'] = (string) $report187->PropertyProfile->PropertyCharacteristics->Bedrooms[0];
            $reportItems['areaBedroomsLow'] = minMaxArray('Beds', 'min', $reportItems['comparable']);
            $reportItems['areaBedroomsMedian'] = minMaxArray('Beds', 'median', $reportItems['comparable']);
            $reportItems['areaBedroomsHigh'] = minMaxArray('Beds', 'max', $reportItems['comparable']);

            $reportItems['areaBaths'] = (string) $report187->PropertyProfile->PropertyCharacteristics->Baths[0];
            $reportItems['areaBathsLow'] = minMaxArray('Baths', 'min', $reportItems['comparable']);
            $reportItems['areaBathsMedian'] = minMaxArray('Baths', 'median', $reportItems['comparable']);
            $reportItems['areaBathsHigh'] = minMaxArray('Baths', 'max', $reportItems['comparable']);

            $areaLotSize = number_format((string) $report187->PropertyProfile->PropertyCharacteristics->LotSize[0]);
            $areaLotSizeLow = number_format($salesAnalysis['min_lot_size']); //number_format(minMaxArray('LotSize', 'min', $reportItems['comparable']));
            $areaLotSizeMedian = number_format($salesAnalysis['tmp_lot_size'] / count($reportItems['comparable'])); //number_format(minMaxArray('LotSize', 'median', $reportItems['comparable']));
            $areaLotSizeHigh = number_format($salesAnalysis['max_lot_size']); // number_format(minMaxArray('LotSize', 'max', $reportItems['comparable']));

            $reportItems['areaLotSize'] = $areaLotSize;
            $reportItems['areaLotSizeLow'] = $areaLotSizeLow;
            $reportItems['areaLotSizeMedian'] = $areaLotSizeMedian;
            $reportItems['areaLotSizeHigh'] = $areaLotSizeHigh;

            $areaLivingAreaLow = number_format(minMaxArray('BuildingArea', 'min', $reportItems['comparable']));
            $areaLivingAreaMedian = number_format(minMaxArray('BuildingArea', 'median', $reportItems['comparable']));
            $areaLivingAreaHigh = number_format(minMaxArray('BuildingArea', 'max', $reportItems['comparable']));

            $reportItems['areaLivingArea'] = (string) $report187->PropertyProfile->PropertyCharacteristics->BuildingArea[0];
            $reportItems['areaLivingAreaLow'] = $areaLivingAreaLow;
            $reportItems['areaLivingAreaMedian'] = $areaLivingAreaMedian;
            $reportItems['areaLivingAreaHigh'] = $areaLivingAreaHigh;

            $areaSalePriceLow = number_format((double) $report187->ComparableSalesReport->AreaSalesAnalysisInfo->PriceRangeMin);
            $areaSalePriceMedian = number_format((double) $report187->ComparableSalesReport->AreaSalesAnalysisInfo->MedianValue);
            $areaSalePriceHigh = number_format((double) $report187->ComparableSalesReport->AreaSalesAnalysisInfo->PriceRangeMax);

            $reportItems['areaPriceFoot'] = number_format((string) $report187->PropertyProfile->SaleLoanInfo->PricePerSQFT[0]);
            $reportItems['areaPriceFootLow'] = number_format(minMaxArray('PricePerSQFT', 'min', $reportItems['comparable']));
            $reportItems['areaPriceFootMedian'] = number_format(minMaxArray('PricePerSQFT', 'median', $reportItems['comparable']));
            $reportItems['areaPriceFootHigh'] = number_format(minMaxArray('PricePerSQFT', 'max', $reportItems['comparable']));

            $reportItems['areaSalePriceLow'] = dollars($areaSalePriceLow);
            $reportItems['areaSalePriceMedian'] = dollars($areaSalePriceMedian);
            $reportItems['areaSalePriceHigh'] = dollars($areaSalePriceHigh);

            $reportItems['areaTotalRoomsLow'] = minMaxArray('TotalRooms', 'min', $reportItems['comparable']);
            $reportItems['areaTotalRoomsMedian'] = minMaxArray('TotalRooms', 'median', $reportItems['comparable']);
            $reportItems['areaTotalRoomsHigh'] = minMaxArray('TotalRooms', 'max', $reportItems['comparable']);

            $reportItems['stories'] = (string) $report187->PropertyProfile->PropertyCharacteristics->NoOfStories[0];
            $propPool = $report187->PropertyProfile->PropertyCharacteristics->Pool[0];
            if ($propPool != 'Yes') {
                $propPool = 'No';
            }
            $reportItems['propertyPool'] = number_format((double) $report187->PropertyProfile->PropertyCharacteristics->Pool[0]);
            $reportItems['propertyPoolLow'] = number_format((double) minMaxArray('Pool', 'min', $reportItems['comparable']));
            $reportItems['propertyPoolMedian'] = number_format((double) minMaxArray('Pool', 'median', $reportItems['comparable']));
            $reportItems['propertyPoolHign'] = number_format((double) minMaxArray('Pool', 'max', $reportItems['comparable']));

            $reportItems['propertySalePrice'] = number_format((double) $report187->PropertyProfile->SaleLoanInfo->SalesPrice);
            $reportItems['propertySalePriceLow'] = number_format($salesAnalysis['minPrice']); //number_format(minMaxArray('PriceRate', 'min', $reportItems['comparable']));
            $reportItems['propertySalePriceMedian'] = number_format($salesAnalysis['median_price']); //number_format(minMaxArray('PriceRate', 'median', $reportItems['comparable']));
            $reportItems['propertySalePriceLowHigh'] = number_format($salesAnalysis['maxPrice']); //number_format(minMaxArray('PriceRate', 'max', $reportItems['comparable']));

            $areaSalesChart['series'] = '';
            $areaSalesChart['date'] = '';

            $minRadius = minMaxArray('Distance', 'min', $reportItems['comparable']);
            $medianRadius = minMaxArray('Distance', 'median', $reportItems['comparable']);
            $maxRadius = minMaxArray('Distance', 'max', $reportItems['comparable']);
            $reportItems['areaMinRadius'] = $minRadius;
            $reportItems['areaMedianRadius'] = $medianRadius;
            $reportItems['areaMaxRadius'] = $maxRadius;

            $ChartArr = array();
            $tmp2 = array();

            $totalMonthsReport = 0;
            foreach ($reportItems['comparable'] as $key => $item) {
                /*****************************************/
                if ($key > 8) {
                    break;
                }

                $date = date_create($item['Date']);
                $tmepDate = date_format($date, "M'y");
                $months[] = array('date' => $tmepDate, 'value' => $item['PriceRate']);
            }

            // var_dump($months);die;

            foreach ($months as $key => $itemMonth) {
                if ($key < (sizeof($months) - 1)) {
                    $tmp2['date'] .= $itemMonth['date'] . '|';
                    $tmp2['series'] .= $itemMonth['value'] . ',';
                } else {
                    $tmp2['date'] .= $itemMonth['date'];
                    $tmp2['series'] .= $itemMonth['value'];
                }
                if ($itemMonth['value'] != '_') {
                    $totalMonthsReport++;
                }
                array_push($ChartArr, $tmp2);
            }
        }

        $chart_color = !empty($CI->input->post('theme')) ? str_replace("#", "", $CI->input->post('theme')) : '082147';
        $data['theme'] = $CI->input->post('theme');
        if (is_array($CI->input->post('subscribe_temp')) && in_array(trim($CI->input->post('presentation')), $CI->input->post('subscribe_temp')) && !empty($CI->input->post('selected_theme'))) {
            $chart_color = !empty($CI->input->post('selected_theme')) ? str_replace("#", "", $CI->input->post('selected_theme')) : '082147';
            $data['theme'] = $CI->input->post('selected_theme');
        }
        // $tmp2['color'] = str_replace("#", "", $CI->input->post('theme'));
        $tmp2['color'] = $chart_color;

        $reportItems['chart'] = $tmp2;
        $reportItems['totalMonthsReport'] = $totalMonthsReport;
        $data['areaSalesAnalysis'] = $reportItems;

        if ($CI->input->post('presentation') == 'registry') {
            $data['unique_key'] = time() . substr(md5(rand()), 0, 10);
            $data['pdf_page'] = $CI->input->post('pdf_page');
        }
        // $data['seller_cma'] = isset($_POST['seller_cma']) ? $_POST['seller_cma'] : '';
        $pageList = [];

        if (isset($_POST['selected_pages'])) {
            $pageList = json_decode($_POST['selected_pages']);
            if (empty($pageList)) {
                if ($_POST['seller_theme'] == 3) {
                    $pageList = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18];
                } else if ($_POST['seller_theme'] == 2) {
                    $pageList = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 21];
                } else {
                    $pageList = [1, 2, 3, 4, 5, 6, 7, 8];
                }
            }
        } else {
            if ($_POST['seller_theme'] == 3) {
                $pageList = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18];
            } else if ($_POST['seller_theme'] == 2) {
                // $pageList = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 21];
                $pageList = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21];
            } else {
                // $pageList = [1, 2, 3, 4, 5, 6, 7, 8];
                $pageList = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20];
            }
        }
        $data['pageList'] = $pageList;
        $data['seller_theme'] = (!empty($_POST['seller_theme']) && $_POST['seller_theme'] != 'undefined') ? $_POST['seller_theme'] : 1;
        $data['mu_theme'] = (!empty($_POST['mu_theme']) && $_POST['mu_theme'] != 'undefined') ? $_POST['mu_theme'] : 1;
        // $data['mu_theme'] = $_POST['mu_theme'] ?? 1;

        // echo "<pre>";
        // print_r($data);die;
        $PdfGenResponse = $this->preparePdf($reportLang, $data, $_POST['presentation'], $report187->PropertyProfile->SiteAddress);
        $pdfFileName = $PdfGenResponse['pdf_filename'];
        $reportGenerated = $PdfGenResponse['report_generated'];
        $errorMsg = $PdfGenResponse['error_msg'];

        // if it is an api call then we get the user id from the token
        if ($callFromApi == 1) {
            $currentUserId = getUserIdByToken($reportData['token']);
        } else {
            $currentUserId = $CI->session->userdata('userid');
        }
        if ($reportGenerated) {
            $insertPdfReport = array(
                'project_name' => $CI->db->escape_str($report187->PropertyProfile->SiteAddress),
                'report_path' => $pdfFileName,
                'user_id_fk' => $currentUserId,
                'property_owner' => $CI->db->escape_str($report187->PropertyProfile->PrimaryOwnerName),
                'property_address' => $CI->db->escape_str($report187->PropertyProfile->SiteAddress . ', ' . $report187->PropertyProfile->SiteCity . ' ' . $report187->PropertyProfile->SiteState . ' ' . $report187->PropertyProfile->SiteZip),
                'property_apn' => $CI->db->escape_str($report187->PropertyProfile->APN),
                'property_lat' => $CI->db->escape_str($report187->PropertyProfile->PropertyCharacteristics->Latitude),
                'property_lng' => $CI->db->escape_str($report187->PropertyProfile->PropertyCharacteristics->Longitude),
                'report_type' => $_POST['presentation'],
                'pdf_data' => json_encode($data),
            );

            // if it is an api call then we mark it as active
            if ($callFromApi == 1) {
                $insertPdfReport['is_active'] = 'Y';
            }

            $CI->base_model->insert_one_row('lp_my_listing', $insertPdfReport);
            $project_id = $CI->base_model->get_last_insert_id();
            $CI->session->set_userdata('project_id', $project_id);

            //Insert into registry table

            if ($CI->input->post('presentation') == 'registry' && $project_id > 0) {
                $registry_data = array();
                $registry_data['listing_id'] = $project_id;
                $registry_data['unique_key'] = $data['unique_key'];
                $CI->base_model->insert_one_row('lp_registry_master', $registry_data);

            }

            // if call is from api then we directly send the report link
            if ($callFromApi == 1) {
                return array("status" => true, 'reportLink' => base_url($pdfFileName));
            } else {
                return array("status" => true);
            }

        } else {
            return array("status" => false, "msg" => $errorMsg);
        }
    }

    public function get_all_properties($report187)
    {
        $_comparableTemp = array();
        $index = 0;
        for ($j = 0; $j < sizeof($report187->ComparableSalesReport->ComparableSales->ComparableSale); $j++) {
            // echo $report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->Proximity[0]. '<= 0.2 <br >';
            // if(sizeof($reportItems['comparableTemp'])<9){
            $proximity_val = $report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->Proximity[0] . '';
            $build_area = (string) $report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->BuildingArea[0] . '';
            if (floatval($proximity_val) <= 2) { //&& ($minBuildArea<=floatval($build_area)) && ($maxBuildArea>=floatval($build_area)) && $months_diff<=12
                $i = strval($j + 1);
                $tmp['index'] = $index++;
                $tmp['Date'] = formatDate((string) $report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->RecordingDate[0]);
                $tmp['ChartLabelVal'] = date('Y-m', strtotime((string) $report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->RecordingDate[0]));
                $tmp['Price'] = dollars(number_format((string) $report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->SalePrice[0]));
                $tmp['PriceRate'] = (string) $report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->SalePrice[0];
                $tmp['PricePerSQFT'] = (string) $report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->PricePerSQFT[0];
                $tmp['TotalRooms'] = (string) $report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->TotalRooms[0];

                $tmp['Address'] = properCase((string) $report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->SiteAddress[0] . ' ' . $report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->SiteCity[0]);
                $tmp['cityState'] = properCase((string) $report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->SiteCity[0]);
                $tmp['Distance'] = floatval((string) $report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->Proximity[0]);
                $tmp['Beds'] = number_format((string) $report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->Bedrooms[0]);
                $tmp['SquareFeet'] = number_format((string) $report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->BuildingArea[0]);
                $tmp['BuildingArea'] = (string) $report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->BuildingArea[0] . '';
                $tmp['Baths'] = (int) $report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->Baths[0];
                $tmp['Bedrooms'] = (int) $report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->Bedrooms[0];
                $tmp['Year'] = (string) $report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->YearBuilt[0];
                $tmp['LotSize'] = number_format((string) $report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->LotSize);
                $tmp['Latitude'] = (string) $report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->Latitude;
                $tmp['Longitude'] = (string) $report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->Longitude;
                $tmpPool = (string) $report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->Pool[0];
                if ($tmpPool != 'Yes') {
                    $tmpPool = 'No';
                }
                $tmp['Pool'] = $tmpPool;
                //$apn= (string)$report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->APN[0].'';
                array_push($_comparableTemp, $tmp);
                //array_push($hasComparable, $apn);
            }
        }
        return $_comparableTemp;
    }
    public function sort_properties($report187, $_comparableTemp, $paramsAdjustment = false)
    {
        $CI = &get_instance();
        $adjustableParams = [];

        $userId = $CI->session->userdata('userid');
        if ($userId) {
            $data = array();
            $data['user_id'] = $userId;
            $CI->load->model('params_adjustment_model');
            $adjustableParams = (array) $CI->params_adjustment_model->get_by($data);
        }

        $_maxLimit = 8;
        $comparable = array();
        // print_r($reportItems['comparableTemp']);

        //********* COmpare ale property Sold in last 12 months ************/
        //COmpare ale property +-20 % of build area
        //$reportItems['comparableTempSold'] = array();
        $date = new DateTime();
        $currentdate = $date->format('m/d/Y');
        // $months_diff  = monthsBetween(formatDate($report187->ComparableSalesReport->ComparableSales->ComparableSale[$j]->RecordingDate[0]),$currentdate);
        $minBuildArea = (floatval($report187->PropertyProfile->PropertyCharacteristics->BuildingArea) * 80 / 100); //-20%
        $maxBuildArea = (floatval($report187->PropertyProfile->PropertyCharacteristics->BuildingArea) * 120 / 100); //+20%
        // $maxBedrooms = (int) $report187->PropertyProfile->PropertyCharacteristics->Bedrooms + 1; //+1
        // $minBedrooms = (int) $report187->PropertyProfile->PropertyCharacteristics->Bedrooms - 1; //-1
        // $maxBaths = (int) $report187->PropertyProfile->PropertyCharacteristics->Baths + 1; //+1
        // $minBaths = (int) $report187->PropertyProfile->PropertyCharacteristics->Baths - 1; //-1

        $adjustedBedrooms = ((int) ($paramsAdjustment && !empty($adjustableParams) && isset($adjustableParams['black_knight_beds'])) ? $adjustableParams['black_knight_beds'] : $report187->PropertyProfile->PropertyCharacteristics->Bedrooms);
        $maxBedrooms = $adjustedBedrooms + 1; //+1
        $minBedrooms = $adjustedBedrooms - 1; //-1

        $adjustedBaths = ((int) ($paramsAdjustment && !empty($adjustableParams) && isset($adjustableParams['black_knight_baths'])) ? $adjustableParams['black_knight_baths'] : $report187->PropertyProfile->PropertyCharacteristics->Baths);
        $maxBaths = $adjustedBaths + 1; //+1
        $minBaths = $adjustedBaths - 1; //-1

        $maxLotSize = (floatval($report187->PropertyProfile->PropertyCharacteristics->LotSize) * 120 / 100); //+20%
        $minLotSize = (floatval($report187->PropertyProfile->PropertyCharacteristics->LotSize) * 20 / 100); //-20%
        $maxPricePerSQFT = (floatval($report187->PropertyProfile->SaleLoanInfo->PricePerSQFT) * 120 / 100); //+20%
        $minPricePerSQFT = (floatval($report187->PropertyProfile->SaleLoanInfo->PricePerSQFT) * 80 / 100); //+20%
        $count = 0;

        foreach ($_comparableTemp as $key => $compareableProperty) {
            if ($count++ > ($_maxLimit - 1)) {
                break;
            }

            $months_diff = monthsBetween($compareableProperty['Date'], $currentdate);
            $build_area = floatval(str_replace(",", "", $compareableProperty['BuildingArea']));
            $bedrooms = (int) $compareableProperty['Bedrooms'];
            $baths = (int) $compareableProperty['Baths'];
            $lotSize = floatval(str_replace(",", "", $compareableProperty['LotSize']));
            $pricePerSQFT = floatval(str_replace(",", "", $compareableProperty['PricePerSQFT']));
            if (
                $months_diff <= 12 &&
                ($minBuildArea <= $build_area && $maxBuildArea >= $build_area) &&
                (($paramsAdjustment && ($bedrooms >= $adjustedBedrooms) && ($baths >= $adjustedBaths)) ||
                    (!$paramsAdjustment && ($minBedrooms <= $bedrooms && $maxBedrooms >= $bedrooms) && ($minBaths <= $baths && $maxBaths >= $baths))) &&
                ($minLotSize <= $lotSize && $maxLotSize >= $lotSize) &&
                ($minPricePerSQFT <= $pricePerSQFT && $maxPricePerSQFT >= $pricePerSQFT)
            ) {
                array_push($comparable, $compareableProperty);
                unset($_comparableTemp[$key]);
            }
        }
        //If comaparable sales count is not 9 then we need to fill remaning from parent set without any conditions
        $_count = count($comparable);
        //echo "Actual Count:".$countComparables;
        if ($_count != $_maxLimit) {
            foreach ($_comparableTemp as $key => $compareableProperty) {
                $months_diff = monthsBetween($compareableProperty['Date'], $currentdate);
                $build_area = floatval(str_replace(",", "", $compareableProperty['BuildingArea']));
                $bedrooms = (int) $compareableProperty['Bedrooms'];
                $baths = (int) $compareableProperty['Baths'];
                $pricePerSQFT = floatval(str_replace(",", "", $compareableProperty['PricePerSQFT']));
                if (
                    $months_diff <= 12 &&
                    ($minBuildArea <= $build_area && $maxBuildArea >= $build_area) &&
                    (($paramsAdjustment && ($bedrooms >= $adjustedBedrooms) && ($baths >= $adjustedBaths)) ||
                        (!$paramsAdjustment && ($minBedrooms <= $bedrooms && $maxBedrooms >= $bedrooms) && ($minBaths <= $baths && $maxBaths >= $baths))) &&
                    ($minPricePerSQFT <= $pricePerSQFT && $maxPricePerSQFT >= $pricePerSQFT)
                ) {
                    array_push($comparable, $compareableProperty);
                    unset($_comparableTemp[$key]);
                    if (++$_count == $_maxLimit) {
                        break;
                    }

                }
            }
        }
        if ($_count != $_maxLimit) {
            foreach ($_comparableTemp as $key => $compareableProperty) {
                $months_diff = monthsBetween($compareableProperty['Date'], $currentdate);
                $build_area = floatval(str_replace(",", "", $compareableProperty['BuildingArea']));
                $bedrooms = (int) $compareableProperty['Bedrooms'];
                $pricePerSQFT = floatval(str_replace(",", "", $compareableProperty['PricePerSQFT']));
                if ($months_diff <= 12 &&
                    ($minBuildArea <= $build_area && $maxBuildArea >= $build_area) &&
                    (($paramsAdjustment && $bedrooms >= $adjustedBedrooms) ||
                        (!$paramsAdjustment && $minBedrooms <= $bedrooms && $maxBedrooms >= $bedrooms)) &&
                    ($minPricePerSQFT <= $pricePerSQFT &&
                        $maxPricePerSQFT >= $pricePerSQFT)) {
                    array_push($comparable, $compareableProperty);
                    unset($_comparableTemp[$key]);
                    if (++$_count == $_maxLimit) {
                        break;
                    }
                }
            }
        }
        if ($_count != $_maxLimit) {
            foreach ($_comparableTemp as $key => $compareableProperty) {
                $months_diff = monthsBetween($compareableProperty['Date'], $currentdate);
                $build_area = floatval(str_replace(",", "", $compareableProperty['BuildingArea']));
                $pricePerSQFT = floatval(str_replace(",", "", $compareableProperty['PricePerSQFT']));
                if ($months_diff <= 12 && ($minBuildArea <= $build_area && $maxBuildArea >= $build_area) && ($minPricePerSQFT <= $pricePerSQFT && $maxPricePerSQFT >= $pricePerSQFT)) {
                    array_push($comparable, $compareableProperty);
                    unset($_comparableTemp[$key]);
                    if (++$_count == $_maxLimit) {
                        break;
                    }

                }
            }
        }
        if ($_count != $_maxLimit) {
            foreach ($_comparableTemp as $key => $compareableProperty) {
                $months_diff = monthsBetween($compareableProperty['Date'], $currentdate);
                $pricePerSQFT = floatval(str_replace(",", "", $compareableProperty['PricePerSQFT']));
                if ($months_diff <= 12 && ($minPricePerSQFT <= $pricePerSQFT && $maxPricePerSQFT >= $pricePerSQFT)) {
                    array_push($comparable, $compareableProperty);
                    unset($_comparableTemp[$key]);
                    if (++$_count == $_maxLimit) {
                        break;
                    }

                }
            }
        }
        if ($_count != $_maxLimit) {
            foreach ($_comparableTemp as $key => $compareableProperty) {
                $months_diff = monthsBetween($compareableProperty['Date'], $currentdate);
                if ($months_diff <= 12) {
                    array_push($comparable, $compareableProperty);
                    unset($_comparableTemp[$key]);
                    if (++$_count == $_maxLimit) {
                        break;
                    }

                }
            }
        }
        if ($_count != $_maxLimit) {
            foreach ($_comparableTemp as $key => $compareableProperty) {
                array_push($comparable, $compareableProperty);
                unset($_comparableTemp[$key]);
                if (++$_count == $_maxLimit) {
                    break;
                }

            }
        }
        return array('sorted' => $comparable, 'all' => $_comparableTemp);
    }

    public function get_all_rets_properties($data)
    {
        $_comparableTemp = array();
        $index = 0;
        foreach ($data as $key => $val) {
            $date = !empty($val['modified']) ? $val['modified'] : $val['listDate'];
            // print_r((string) date('Y-m-d', strtotime($date)));die;
            $date = (string) date('Y-m-d', strtotime($date));
            $_comparableTemp[$index]['index'] = $val['mlsId'];

            $_comparableTemp[$index]['Date'] = date('m/d/Y', strtotime($date)); //formatDate((string) $date);
            $_comparableTemp[$index]['ChartLabelVal'] = date('Y-m', strtotime($date));
            $_comparableTemp[$index]['Price'] = $this->dollars(number_format($val['listPrice']));
            $_comparableTemp[$index]['PriceRate'] = (string) $val['listPrice'];
            $_comparableTemp[$index]['PricePerSQFT'] = round($val['listPrice'] / $val['property']['area'], 2);
            // $_comparableTemp[$index]['TotalRooms'] = $val['mlsId'];
            $_comparableTemp[$index]['Address'] = $val['address']['full'] . ' ' . $val['address']['city'];
            $_comparableTemp[$index]['cityState'] = $val['address']['city'];
            // $_comparableTemp[$index]['State'] = $val['address']['state'];
            // $_comparableTemp[$index]['Distance'] = $val['mlsId'];
            // $_comparableTemp[$index]['Beds'] = $val['property']['bedrooms'];
            $_comparableTemp[$index]['SquareFeet'] = number_format($val['property']['area']);
            $_comparableTemp[$index]['BuildingArea'] = $val['property']['lotSizeArea'];
            $_comparableTemp[$index]['Baths'] = (int) $val['property']['bathrooms'];
            $_comparableTemp[$index]['Bedrooms'] = (int) $val['property']['bedrooms'];
            $_comparableTemp[$index]['Year'] = $val['property']['yearBuilt'];
            $_comparableTemp[$index]['LotSize'] = $val['property']['lotSizeArea'];
            $_comparableTemp[$index]['Latitude'] = $val['geo']['lat'];
            $_comparableTemp[$index]['Longitude'] = $val['geo']['lng'];
            $_comparableTemp[$index]['Pool'] = (isset($val['property']['pool']) && $val['property']['pool'] != 'None') ? 'Yes' : 'No';

            $index++;
        }

        return $_comparableTemp;
    }

    public function sort_rets_properties($_comparableTemp, $propertyArea, $paramsAdjustment = false)
    {
        $CI = &get_instance();
        $adjustableParams = [];
        if (count($_comparableTemp) < 7) {
            return array('sorted' => $_comparableTemp, 'all' => []);
        }
        $count = 0;
        $comparable = array();
        $res = $this->get_rets_sorts($_comparableTemp, $comparable, $count, $propertyArea, 'sqft');

        $_comparableTemp = $res['comparableTemp'];
        $comparable = $res['comparable'];
        $count = count($comparable);

        $userId = $CI->session->userdata('userid');
        if ($userId) {
            $data = array();
            $data['user_id'] = $userId;
            $CI->load->model('params_adjustment_model');
            $adjustableParams = (array) $CI->params_adjustment_model->get_by($data);
        }

        if ($count < 7) {
            $adjustedBedrooms = ((int) ($paramsAdjustment && !empty($adjustableParams) && isset($adjustableParams['rets_beds'])) ? $adjustableParams['rets_beds'] : $report187->PropertyProfile->PropertyCharacteristics->Bedrooms);
            $res = $this->get_rets_sorts($_comparableTemp, $comparable, $count, $adjustedBedrooms, 'bedroom');
            $_comparableTemp = $res['comparableTemp'];
            $comparable = $res['comparable'];
            $count = count($comparable);

            if ($count < 7) {
                $adjustedBaths = ((int) ($paramsAdjustment && !empty($adjustableParams) && isset($adjustableParams['rets_baths'])) ? $adjustableParams['rets_baths'] : $report187->PropertyProfile->PropertyCharacteristics->Baths);
                $res = $this->get_rets_sorts($_comparableTemp, $comparable, $count, $adjustedBaths, 'bathroom');
                $_comparableTemp = $res['comparableTemp'];
                $comparable = $res['comparable'];
                $count = count($comparable);
            }
        }

        // $_maxLimit = 8;

        // $count = 0;
        // $max = ($adjustedBedrooms > $adjustedBaths) ? $adjustedBedrooms : $adjustedBaths;

        // for ($i = $max; $max > 0; $i--) {
        //     $res = $this->get_rets_sorts($_comparableTemp, $comparable, $count, $adjustedBedrooms, $adjustedBaths);
        //     $_comparableTemp = $res['comparableTemp'];
        //     $comparable = $res['comparable'];
        //     $count = count($comparable);
        //     if ($count > ($_maxLimit - 1)) {
        //         break;
        //     }
        //     $adjustedBedrooms = ($adjustedBedrooms > 1) ? $adjustedBedrooms - 1 : 1;
        //     $adjustedBaths = ($adjustedBaths > 1) ? $adjustedBaths - 1 : 1;
        //     $max--;
        // }

        return array('sorted' => $comparable, 'all' => $_comparableTemp);
    }

    public function get_rets_sorts($_comparableTemp, $comparable, $count, $variable, $type)
    {
        $_maxLimit = 7;
        foreach ($_comparableTemp as $key => $compareableProperty) {
            if ($count > $_maxLimit) {
                break;
            }
            $bedrooms = (int) $compareableProperty['Bedrooms'];
            $baths = (int) $compareableProperty['Baths'];
            $sqft = (int) $compareableProperty['SquareFeet'];

            if (($type == 'sqft' && ($sqft >= $variable)) || ($key == 'bedroom' && ($bedrooms >= $variable)) || ($key == 'bathroom' && ($baths >= $variable))) {
                array_push($comparable, $compareableProperty);
                unset($_comparableTemp[$key]);
                $count++;
            }
        }
        return ['comparableTemp' => $_comparableTemp, 'comparable' => $comparable];
    }

    public function dollars($dollarAmount)
    {
        // Prepend '$' symbol to figures that represent price
        if ((string) $dollarAmount == '') {
            return '';
        }
        if ($dollarAmount == '0') {
            return '0';
        } else {
            return '$' . $dollarAmount;
        }
    }

    public function monthsBetween($startDate, $endDate)
    {
        $retval = "";

        // Assume mm-dd-YYYY - as is common MYSQL format
        $splitStart = explode('/', $startDate);
        $splitEnd = explode('/', $endDate);

        if (is_array($splitStart) && is_array($splitEnd)) {
            $difYears = $splitEnd[2] - $splitStart[2];
            $difMonths = $splitEnd[0] - $splitStart[0];
            $difDays = $splitEnd[1] - $splitStart[1];

            $retval = ($difDays > 0) ? $difMonths : $difMonths - 1;
            $retval += $difYears * 12;
        }
        return $retval;
    }

    public function sales_analysis($sortedComps)
    {
        $firstTime = true;
        $tmp_property = 0;
        $min_tmp_price = 0;
        $max_tmp_price = 0;
        $tmp_lot_size = 0;
        $min_lot_size = 0;
        $max_lot_size = 0;
        $minPrice = $maxPrice = $count = $medianPrice = 0;
        // Median price calculation
        $priceRate_array = array_column($sortedComps, 'PriceRate');
        sort($priceRate_array);
        $count_priceRate_array = count($priceRate_array);
        $middleval = floor(($count_priceRate_array - 1) / 2);
        if ($count_priceRate_array % 2) {
            $medianPrice = $priceRate_array[$middleval];
        } else {
            $low = $priceRate_array[$middleval];
            $high = $priceRate_array[$middleval + 1];
            $medianPrice = (($low + $high) / 2);
        }

        // Median price calculation

        foreach ($sortedComps as $compareableProperty) {
            $lotSize = floatval(str_replace(",", "", $compareableProperty['LotSize']));
            $this->_prepareMinMaxComparable($compareableProperty['PriceRate'], $firstTime, $minPrice, $maxPrice, $tmp_property, $tmp_lot_size, $lotSize, $min_lot_size, $max_lot_size);
        }
        $result = array('minPrice' => $minPrice, 'maxPrice' => $maxPrice, 'tmp_property' => $tmp_property, 'min_lot_size' => $min_lot_size, 'max_lot_size' => $max_lot_size, 'tmp_lot_size' => $tmp_lot_size, 'median_price' => $medianPrice);
        return $result;
    }
    /**
     * Prepares PDF files from HTML and static pdf pages
     * @param $reportLang string Report Language
     * @param $data array set of report data
     * @param $presentationType string
     * @param $siteAddress string Property Address
     * @return array Generation Status and filepath/error message
     */
    public function preparePdf($reportLang, $data, $presentationType, $siteAddress)
    {
        $CI = &get_instance();

        if (empty($reportLang)) {
            $reportLang = 'english';
        }

        //@var $turboMode boolean If true than it uses pre stored static theme pages and using qpdf tool it merge these with dynamic content pdf being gnerated with wkhtmltopdf tool
        $turboMode = false;
        //if(($presentationType=="seller" || $presentationType=="buyer") && $reportLang=='english'){
        if ($presentationType == "buyer" && $reportLang == 'english') {
            $themeMap = array(
                //@todo: Set these indexes as unique color code in DB table
                "coldwell_banker" => rgb2hex("rgb(0,41,128)"),
                "keller_williams_burgundy" => rgb2hex("rgb(180,1,1)"),
                "dilbeck_green" => rgb2hex("rgb(0,51,13)"),
                "modern_black" => rgb2hex("rgb(15,15,15)"),
                "modern_gray" => rgb2hex("rgb(149,165,166)"),
                "modern_orange" => rgb2hex("rgb(255,92,57)"),
                "modern_teal" => rgb2hex("rgb(27,188,155)"),
                "prudential_blue" => rgb2hex("rgb(8,72,135)"),
                "purple_intero" => rgb2hex("rgb(122,0,61)"),
                "realty_excutives_blie" => rgb2hex("rgb(0,28,61)"),
                "realty_world_red" => rgb2hex("rgb(239, 26, 44)"),
                "red_remax" => rgb2hex("rgb(180,28,48)"),
                "sotheby_blue" => rgb2hex("rgb(0, 35, 73)"),
                "teal_exit" => rgb2hex("rgb(0,140,154)"),

            );
            foreach ($themeMap as $index => $_color) {
                if (trim($data['theme']) == $_color) {
                    $colorCode = $index;
                }
            }
            //Finding if there are static pdf pages available for this theme. If found then set $turboMode true.
            $tailFile = "temp/static/{$presentationType}/" . $colorCode . '_tail.pdf';
            $contentsFile = "temp/static/{$presentationType}/" . $colorCode . '_contents.pdf';
            if (file_exists($tailFile) && filesize($tailFile) > 1 && file_exists($contentsFile) && filesize($contentsFile) > 1) {
                $turboMode = true;
            }
        }

        /**
         * Start Code to fetch customized text data of user
         */
        $data['user_id_for_report_customization'] = 0;
        if ($data['user']['email'] != '') {
            $CI->load->model('user_model');
            $userInfo = $CI->user_model->getUserDetailsByEmail($data['user']['email'], ['user_id_pk', 'email', 'role_id_fk', 'customer_id', 'ref_code']);
            $data['user_id_for_report_customization'] = $userInfo['user_id_pk'];
        }

        $customization_data = [];
        if ($presentationType == "seller" && !empty($data['user_id_for_report_customization'])) {
            $CI->load->model('report_model');
            $customization_data['9']['report_content_data'] = $CI->report_model->prepare_user_report_data($data['user_id_for_report_customization'], $presentationType, $reportLang, 9);
            $customization_data['10']['report_content_data'] = $CI->report_model->prepare_user_report_data($data['user_id_for_report_customization'], $presentationType, $reportLang, 10);
            $customization_data['11']['report_content_data'] = $CI->report_model->prepare_user_report_data($data['user_id_for_report_customization'], $presentationType, $reportLang, 11);
            $customization_data['12']['report_content_data'] = $CI->report_model->prepare_user_report_data($data['user_id_for_report_customization'], $presentationType, $reportLang, 12);
            $customization_data['13']['report_content_data'] = $CI->report_model->prepare_user_report_data($data['user_id_for_report_customization'], $presentationType, $reportLang, 13);
            $customization_data['14']['report_content_data'] = $CI->report_model->prepare_user_report_data($data['user_id_for_report_customization'], $presentationType, $reportLang, 14);
            $customization_data['15']['report_content_data'] = $CI->report_model->prepare_user_report_data($data['user_id_for_report_customization'], $presentationType, $reportLang, 15);
            $customization_data['16']['report_content_data'] = $CI->report_model->prepare_user_report_data($data['user_id_for_report_customization'], $presentationType, $reportLang, 16);
            $customization_data['17']['report_content_data'] = $CI->report_model->prepare_user_report_data($data['user_id_for_report_customization'], $presentationType, $reportLang, 17);
            $customization_data['18']['report_content_data'] = $CI->report_model->prepare_user_report_data($data['user_id_for_report_customization'], $presentationType, $reportLang, 18);
            $customization_data['19']['report_content_data'] = $CI->report_model->prepare_user_report_data($data['user_id_for_report_customization'], $presentationType, $reportLang, 19);
        }
        $data['customization_pages_data'] = $customization_data;

        /**
         * END Code to fetch customized text data of user
         */

        if ($turboMode) {
            $html = $CI->load->view("reports/" . $reportLang . "/" . $presentationType . "/dynamic", $data, true);
        } else {
            $html = $CI->load->view("reports/" . $reportLang . "/" . $presentationType . "/index", $data, true);

        }
        // echo "<pre>Hello"; print_r('reports/'.$reportLang.'/'.$presentationType.'/index');die;//print_r($html); exit;
        //file_put_contents("tmp.html", $html);
        $wkhtmltopdfPath = $CI->config->item('wkhtmltopdf_path');
        if ($turboMode && $presentationType == 'seller' && $reportLang == 'english') {
            $zoom = $CI->config->item('wkhtmltopdf_zoom_seller');
        } else if ($_POST['seller_theme'] == 1 && $presentationType != 'marketUpdate') {
            $checkLastPages = array_filter($data['pageList'], function ($page) {
                return in_array($page, [13, 14, 15, 16, 17, 18, 19, 20]);
            });
            $zoom = $CI->config->item('wkhtmltopdf_zoom');
            if (empty($checkLastPages)) {
                $zoom = $CI->config->item('wkhtmltopdf_zoom_seller');
            }
        }
        // else if ($presentationType == 'marketUpdate' && in_array($data['mu_theme'], [4, 5, 6, 7])) {
        //     $zoom = $CI->config->item('wkhtmltopdf_zoom_seller');
        // }
        else {
            $zoom = $CI->config->item('wkhtmltopdf_zoom');
            // $checkLastPages = array_filter($data['pageList'], function ($page) {
            //     return in_array($page, [13, 14, 15, 16, 17, 18, 19, 20]);
            // });
            // $zoom = $CI->config->item('wkhtmltopdf_zoom');
            // if (empty($checkLastPages)) {
            //     $zoom = $CI->config->item('wkhtmltopdf_zoom_seller');
            // }
        }

        $snappy = new Pdf($wkhtmltopdfPath);
        //$snappy = new Pdf($this->binaryPath);
        $options = [
            'margin-top' => 0,
            'margin-right' => 0,
            'margin-bottom' => 0,
            'margin-left' => 0,
            'page-size' => 'Letter',
            'zoom' => $zoom,
            'load-error-handling' => 'ignore',
            'load-media-error-handling' => 'ignore',
            'encoding' => 'utf-8',
        ];
        $snappy->setTimeout(150);
        $output = $snappy->getOutputFromHtml(
            $html,
            $options,
            200,
            array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="report.pdf"',
            )
        );
        $pdfFileName = $pdfFileDynamic = 'temp/' . str_replace(" ", "_", $siteAddress) . '_' . md5(time() . rand()) . '.pdf';
        file_put_contents($pdfFileDynamic, $output);
        if (filesize($pdfFileDynamic) < 10000) { // Output pdf should be atleast 100KB of size otherwise some error has occured
            return array(
                'report_generated' => false,
                'error_msg' => "Empty PDF generated while trying to create " . $reportLang . " " . $presentationType . " Report for user account " . $CI->session->userdata('user_email'),
                'pdf_filename' => '',
            );
        }
        if ($turboMode) {
            $qpdf_path = $CI->config->item('qpdf_path');
            //Merging Static pdf pages with dynamic pdf pages
            $pdfFileName = 'temp/' . str_replace(" ", "_", $siteAddress) . '_' . md5(time() . rand()) . '.pdf';
            if ($presentationType == "seller") {
                $res = exec($qpdf_path . " {$pdfFileDynamic} --pages {$pdfFileDynamic} 1 {$contentsFile} 1 {$pdfFileDynamic} 2-7 {$tailFile} 1-12 -- {$pdfFileName}");
            } else {
                $res = exec($qpdf_path . " {$pdfFileDynamic} --pages {$pdfFileDynamic} 1 {$contentsFile} 1 {$pdfFileDynamic} 2-6 {$tailFile} 1-13 -- {$pdfFileName}");
            }
            //Removing dynamic as it is not needed any more
            unlink($pdfFileDynamic);
        } /*else {
        $pdfFileName = $pdfFileDynamic;
        //$res = exec("qpdf  {$pdffFileDynamic} --pages {$pdfFileDynamic} 1 temp/S-2.pdf 1 {$pdfFileDynamic} 2-7 temp/S-9-20.pdf 1-12 -- {$pdfFileName}");
        }*/
        return array(
            'report_generated' => true,
            'pdf_filename' => $pdfFileName,
            'error_msg' => '',
        );
    }

    public function getPropertyDataForWidget($reportData = array())
    {
        $CI = &get_instance();
        $errorMsg = "Unexpacted error occured while trying to create " . $_POST['report_lang'] . " " . $_POST['presentation'] . " Report PDF for user account " . $CI->session->userdata('user_email');
        // loading the required helper
        $CI->load->helper('dataapi');

        $rep111 = $_POST['report111'];
        $reportLang = isset($_POST['report_lang']) && !empty($_POST['report_lang']) ? strtolower($_POST['report_lang']) : '';
        $compKeys = json_decode(stripslashes($_POST['custom_comps']));

        $rep111 = urldecode($rep111);
        $report111 = @simplexml_load_file($rep111);

        $context = stream_context_create(
            array(
                'ssl' => array(
                    'verify_peer' => false,
                    "verify_peer_name" => false,
                ),
            )
        );

        libxml_set_streams_context($context);

        $rep187 = $_POST['report187'];
        $rep187 = urldecode($rep187);
        $report187 = simplexml_load_file($rep187);
        $use_rets_api = isset($_POST['use_rets_api']) && !empty($_POST['use_rets_api']) ? $_POST['use_rets_api'] : 0;

        // changes for local version starts here and comment above line => $report187 = simplexml_load_file($rep187);
        // $report187 = simplexml_load_file("sample.xml");
        // changes for local version ends here

        $data['mapinfo'] = $report111;
        $data['property'] = $report187;

        $data['use_rets_api'] = $use_rets_api;
        $data['user'] = $_POST['user'];
        if ($_POST['user_image'] != '') {
            $data['user']['profile_image'] = $_POST['user_image'];
        }
        if ($_POST['company_image'] != '') {
            $data['user']['company_logo'] = $_POST['company_image'];
        }

        if ($data['user']['email'] != '') {
            $CI = &get_instance();
            $ref_code = $CI->db->select('ref_code')
                ->where('email', $data['user']['email'])
                ->get('lp_user_mst')
                ->row_array();

            $data['user']['ref_code'] = $ref_code['ref_code'];

            $user_info = $CI->db->select(array('mobile', 'website', 'company_url', 'company_add', 'company_city', 'company_state', 'comapny_zip'))
                ->where('email', $data['user']['email'])
                ->get('lp_user_mst')
                ->row_array();

            $data['user']['ref_code'] = $ref_code['ref_code'];
            $data['user']['mobile'] = $user_info['mobile'];
            $data['user']['website'] = $user_info['website'];
            $data['user']['company_url'] = $user_info['company_url'];
            $data['user']['company_add'] = $user_info['company_add'];
            $data['user']['company_city'] = $user_info['company_city'];
            $data['user']['company_state'] = $user_info['company_state'];
            $data['user']['company_zip'] = $user_info['company_zip'];
        }

        $data['partner'] = array();
        if ($_POST['showpartner'] == 'on') {
            if (isset($_POST['partner']) && !empty($_POST['partner'])) {
                foreach ($_POST['partner'] as $_key => $_partner) {
                    foreach ($_partner as $i => $_data) {
                        $data['partner'][$i][$_key] = $_data;
                    }
                }
            }

            if (!empty($data['partner'])) {
                $data['user_id_fk'] = $CI->session->userdata('userid');
                foreach ($data['partner'] as $_partner) {
                    // Currently these partner details in databse are of no use
                    //$CI->base_model->insert_one_row('lp_partner_details',$_partner);
                }
            }
        }
        $ownerNamePrimary = (string) $report187->PropertyProfile->PrimaryOwnerName;
        $ownerNameSecondary = (string) $report187->PropertyProfile->SecondaryOwnerName;
        if (strpos($ownerNamePrimary, ";") !== false) {
            $_primeNameArr = explode(";", $ownerNamePrimary);
            $ownerNamePrimary = ucwords(trim($_primeNameArr[0]));
            if ($ownerNameSecondary == '') {
                $ownerNameSecondary = ucwords(trim($_primeNameArr[1]));
            }
        }
        if (strpos($ownerNamePrimary, ",") !== false) {
            $_primeNameArr = explode(",", $ownerNamePrimary);
            //Setting Last name at last like for HERNANDEZ, GERARDO JOVANNI name will be GERARDO JOVANNI HERNANDEZ
            $ownerNamePrimary = ucwords(trim($_primeNameArr[1])) . ' ' . ucwords(trim($_primeNameArr[0]));
        }
        if (strpos($ownerNameSecondary, ",") !== false) {
            $_secNameArr = explode(",", $ownerNameSecondary);
            //Setting Last name at last like for HERNANDEZ, GERARDO JOVANNI name will be GERARDO JOVANNI HERNANDEZ
            $ownerNameSecondary = ucwords(trim($_secNameArr[1])) . ' ' . ucwords(trim($_secNameArr[0]));
        }
        $data['primary_owner'] = $ownerNamePrimary;
        $data['secondary_owner'] = $ownerNameSecondary;

        // if it is an api call then we get the user id from the token
        $currentUserId = $CI->session->userdata('userid');

        if (empty($currentUserId)) {
            $user_info_id = $CI->db->select(array('user_id_pk'))
                ->where('email', $data['user']['email'])
                ->get('lp_user_mst')
                ->row_array();
            $currentUserId = $user_info_id['user_id_pk'];
        }

        $tableName = "lp_user_mst";
        $user_details = $CI->base_model->get_login_data_from_id("lp_user_mst", 'user_id_pk', $currentUserId);
        $data['cma_url'] = $user_details->cma_url;
        $data['report_dir_name'] = $user_details->report_dir_name;
        $use_rets_api = $user_details->use_rets_api;

        if (!empty($user_details->parent_id)) {
            $parent_id = $user_details->parent_id;
            $sales_rep_info = $CI->base_model->get_record_by_id('lp_user_mst', array('user_id_pk' => $parent_id));

            if (!empty($sales_rep_info->use_rets_api)) {
                $use_rets_api = $sales_rep_info->use_rets_api;
            }

            if (!empty($sales_rep_info->cma_url)) {
                $data['cma_url'] = $sales_rep_info->cma_url;
            }
            if ($sales_rep_info->role_id_fk == 3) {
                $data['report_dir_name'] = $sales_rep_info->report_dir_name;
            }
        }
        $data['use_rets_api'] = $use_rets_api;
        $simply_rets = 0;
        if ($data['report_dir_name'] == 'maxa_hometown') {
            $simply_rets = 1;
        }

        $reportItems['comparable'] = array();
        if ((true && $_POST['presentation'] == 'seller') || (true && $_POST['presentation'] == 'marketUpdate') || (true && $_POST['presentation'] == 'buyer')) {
            $comparableTemp = $this->get_all_properties($report187);

            if (true && ($_POST['presentation'] == 'seller' || $_POST['presentation'] == 'buyer')) {
                if (empty($compKeys) && $use_rets_api == 0) {
                    $comparables = $this->sort_properties($report187, $comparableTemp);
                    $reportItems['comparable'] = $comparables['sorted'];
                } else {
                    if ($use_rets_api == 1) {
                        $comparables = $this->sort_properties($report187, $comparableTemp);
                        $reportItems['comparable'] = $comparables['sorted'];

                        $mls_comparables = array();

                        $mls_ids = json_decode(stripslashes($_POST['custom_comps']), true);

                        if (isset($mls_ids) && !empty($mls_ids) && $simply_rets) {
                            foreach ($mls_ids as $m_key => $m_value) {
                                $mls_id = $m_value;
                                $endPoint = 'properties/' . $mls_id;
                                $result = $this->make_request('GET', $endPoint);
                                $response = json_decode($result, true);

                                if (isset($response) && !empty($response)) {
                                    $mls_comparables[$m_key]['mls_id'] = isset($mls_id) && !empty($mls_id) ? $mls_id : '';
                                    $mls_comparables[$m_key]['img'] = isset($response['photos'][0]) && !empty($response['photos'][0]) ? $response['photos'][0] : '';
                                    $mls_comparables[$m_key]['Address'] = isset($response['address']['full']) && !empty($response['address']['full']) ? $response['address']['full'] : '';
                                    $mls_comparables[$m_key]['Price'] = isset($response['listPrice']) && !empty($response['listPrice']) ? dollars(number_format((string) $response['listPrice'])) : '';
                                    $mls_comparables[$m_key]['Date'] = isset($response['listDate']) && !empty($response['listDate']) ? date('m/d/Y', strtotime($response['listDate'])) : '';
                                    $mls_comparables[$m_key]['Distance'] = 0;
                                    $mls_comparables[$m_key]['SquareFeet'] = isset($response['property']['area']) && !empty($response['property']['area']) ? number_format((string) $response['property']['area']) : '';
                                    $mls_comparables[$m_key]['PricePerSQFT'] = '';
                                    $mls_comparables[$m_key]['Beds'] = isset($response['property']['bedrooms']) && !empty($response['property']['bedrooms']) ? number_format((string) $response['property']['bedrooms']) : '';
                                    $mls_comparables[$m_key]['Baths'] = isset($response['property']['bathrooms']) && !empty($response['property']['bathrooms']) ? number_format((string) $response['property']['bathrooms']) : '';
                                    $mls_comparables[$m_key]['Year'] = isset($response['property']['yearBuilt']) && !empty($response['property']['yearBuilt']) ? (string) $response['property']['yearBuilt'] : '';
                                    $mls_comparables[$m_key]['LotSize'] = isset($response['property']['lotSize']) && !empty($response['property']['lotSize']) ? number_format((string) $response['property']['lotSize']) : '';
                                    $mls_comparables[$m_key]['Pool'] = isset($response['property']['pool']) && !empty($response['property']['pool']) ? (string) $response['property']['pool'] : '';
                                }
                            }
                        } elseif ($simply_rets == 0) {
                            $CI->load->library('rets');
                            $rets = new Rets();
                            if (isset($mls_ids) && !empty($mls_ids)) {
                                $mlsId = implode(',', $mls_ids);
                                $responses = $rets->getDataBymlsId($mlsId);
                            } else {
                                $search_city = $report187->PropertyProfile->SiteCity;

                                $responses = $rets->getRecentSold($search_city);
                                if (empty($responses)) {
                                    return array(
                                        'report_generated' => false,
                                        'error_msg' => "Comparable not found for $search_city",
                                        'pdf_filename' => '',
                                    );
                                }
                            }
                            $listingKeyNumeric = array_column($responses, 'ListingKeyNumeric');
                            $listingKeyNumeric = implode(',', $listingKeyNumeric);
                            $rets_images = $rets->getImages($listingKeyNumeric);
                            foreach ($responses as $m_key => $response) {
                                $mls_comparables[$m_key]['mls_id'] = !empty($response['mlsId']) ? $response['mlsId'] : '';
                                $mls_comparables[$m_key]['img'] = isset($rets_images[$response['ListingKeyNumeric']]) ? $rets_images[$response['ListingKeyNumeric']] : '';
                                $mls_comparables[$m_key]['Address'] = !empty($response['address']) ? $response['address'] : '';
                                $mls_comparables[$m_key]['Price'] = !empty($response['price']) ? dollars(number_format((string) $response['price'])) : '';
                                $mls_comparables[$m_key]['PriceRate'] = (float) $response['price'];
                                $mls_comparables[$m_key]['Date'] = !empty($response['listDate']) ? date('m/d/Y', strtotime($response['listDate'])) : '';
                                $mls_comparables[$m_key]['Distance'] = 0;
                                $mls_comparables[$m_key]['SquareFeet'] = !empty($response['area']) ? number_format((string) $response['area']) : '';
                                $mls_comparables[$m_key]['SquareFeetVal'] = $response['area'];
                                $mls_comparables[$m_key]['PricePerSQFT'] = !empty($response['pricePerSQFT']) ? dollars(number_format((string) $response['pricePerSQFT'])) : '';
                                $mls_comparables[$m_key]['Beds'] = !empty($response['bedrooms']) ? number_format((string) $response['bedrooms']) : '';
                                $mls_comparables[$m_key]['Baths'] = !empty($response['bathrooms']) ? number_format((string) $response['bathrooms']) : '';
                                $mls_comparables[$m_key]['Year'] = !empty($response['yearBuilt']) ? (string) $response['yearBuilt'] : '';
                                $mls_comparables[$m_key]['LotSize'] = !empty($response['lotSize']) ? number_format((string) $response['lotSize']) : '';
                                $mls_comparables[$m_key]['Pool'] = (!empty($response['pool']) && trim($response['pool']) != 'N/K') ? (string) $response['pool'] : '';
                            }
                        }
                        $data['mls_comparables'] = $mls_comparables;
                    } else {
                        foreach ($comparableTemp as $key => $_property) {
                            if (in_array($key, $compKeys)) {
                                array_push($reportItems['comparable'], $_property);
                            }
                        }
                    }
                }
            }

            if (true && $_POST['presentation'] == 'marketUpdate') {
                $compKeys = json_decode(stripslashes($_POST['comparable_custom_comps']));
                if (empty($compKeys)) {
                    $comparables = $this->sort_properties($report187, $comparableTemp);
                    $reportItems['comparable'] = $comparables['sorted'];
                } else {
                    foreach ($comparableTemp as $key => $_property) {
                        if (in_array($key, $compKeys)) {
                            array_push($reportItems['comparable'], $_property);
                        }
                    }
                }
            }

        }

        if (empty($reportItems['comparable'])) {
            return ["status" => false, "showError" => true, "msg" => "Report can not be generated due to lack of comparable data."];
        }

        $salesAnalysis = $this->sales_analysis($reportItems['comparable']);

        $reportItems['priceMinRange'] = round($salesAnalysis['minPrice'] / 1000, 2);
        $reportItems['priceMaxRange'] = round($salesAnalysis['maxPrice'] / 1000, 2);

        $propertyYear = (string) $report187->PropertyProfile->PropertyCharacteristics->YearBuilt[0];
        $reportItems['areaYear'] = $propertyYear;
        $reportItems['areaYearLow'] = minMaxArray('Year', 'min', $reportItems['comparable']);
        $reportItems['areaYearMedian'] = minMaxArray('Year', 'median', $reportItems['comparable']);
        $reportItems['areaYearHigh'] = minMaxArray('Year', 'max', $reportItems['comparable']);

        $reportItems['areaBedrooms'] = (string) $report187->PropertyProfile->PropertyCharacteristics->Bedrooms[0];
        $reportItems['areaBedroomsLow'] = minMaxArray('Beds', 'min', $reportItems['comparable']);
        $reportItems['areaBedroomsMedian'] = minMaxArray('Beds', 'median', $reportItems['comparable']);
        $reportItems['areaBedroomsHigh'] = minMaxArray('Beds', 'max', $reportItems['comparable']);

        $reportItems['areaBaths'] = (string) $report187->PropertyProfile->PropertyCharacteristics->Baths[0];
        $reportItems['areaBathsLow'] = minMaxArray('Baths', 'min', $reportItems['comparable']);
        $reportItems['areaBathsMedian'] = minMaxArray('Baths', 'median', $reportItems['comparable']);
        $reportItems['areaBathsHigh'] = minMaxArray('Baths', 'max', $reportItems['comparable']);

        $areaLotSize = number_format((string) $report187->PropertyProfile->PropertyCharacteristics->LotSize[0]);
        $areaLotSizeLow = number_format($salesAnalysis['min_lot_size']); //number_format(minMaxArray('LotSize', 'min', $reportItems['comparable']));
        $areaLotSizeMedian = number_format($salesAnalysis['tmp_lot_size'] / count($reportItems['comparable'])); //number_format(minMaxArray('LotSize', 'median', $reportItems['comparable']));
        $areaLotSizeHigh = number_format($salesAnalysis['max_lot_size']); // number_format(minMaxArray('LotSize', 'max', $reportItems['comparable']));

        $reportItems['areaLotSize'] = $areaLotSize;
        $reportItems['areaLotSizeLow'] = $areaLotSizeLow;
        $reportItems['areaLotSizeMedian'] = $areaLotSizeMedian;
        $reportItems['areaLotSizeHigh'] = $areaLotSizeHigh;

        $areaLivingAreaLow = number_format(minMaxArray('BuildingArea', 'min', $reportItems['comparable']));
        $areaLivingAreaMedian = number_format(minMaxArray('BuildingArea', 'median', $reportItems['comparable']));
        $areaLivingAreaHigh = number_format(minMaxArray('BuildingArea', 'max', $reportItems['comparable']));

        $reportItems['areaLivingArea'] = (string) $report187->PropertyProfile->PropertyCharacteristics->BuildingArea[0];
        $reportItems['areaLivingAreaLow'] = $areaLivingAreaLow;
        $reportItems['areaLivingAreaMedian'] = $areaLivingAreaMedian;
        $reportItems['areaLivingAreaHigh'] = $areaLivingAreaHigh;

        $areaSalePriceLow = number_format((double) $report187->ComparableSalesReport->AreaSalesAnalysisInfo->PriceRangeMin);
        $areaSalePriceMedian = number_format((double) $report187->ComparableSalesReport->AreaSalesAnalysisInfo->MedianValue);
        $areaSalePriceHigh = number_format((double) $report187->ComparableSalesReport->AreaSalesAnalysisInfo->PriceRangeMax);

        $reportItems['areaPriceFoot'] = number_format((string) $report187->PropertyProfile->SaleLoanInfo->PricePerSQFT[0]);
        $reportItems['areaPriceFootLow'] = number_format(minMaxArray('PricePerSQFT', 'min', $reportItems['comparable']));
        $reportItems['areaPriceFootMedian'] = number_format(minMaxArray('PricePerSQFT', 'median', $reportItems['comparable']));
        $reportItems['areaPriceFootHigh'] = number_format(minMaxArray('PricePerSQFT', 'max', $reportItems['comparable']));

        $reportItems['areaSalePriceLow'] = dollars($areaSalePriceLow);
        $reportItems['areaSalePriceMedian'] = dollars($areaSalePriceMedian);
        $reportItems['areaSalePriceHigh'] = dollars($areaSalePriceHigh);

        $reportItems['areaTotalRoomsLow'] = minMaxArray('TotalRooms', 'min', $reportItems['comparable']);
        $reportItems['areaTotalRoomsMedian'] = minMaxArray('TotalRooms', 'median', $reportItems['comparable']);
        $reportItems['areaTotalRoomsHigh'] = minMaxArray('TotalRooms', 'max', $reportItems['comparable']);

        $reportItems['stories'] = (string) $report187->PropertyProfile->PropertyCharacteristics->NoOfStories[0];
        $propPool = $report187->PropertyProfile->PropertyCharacteristics->Pool[0];
        if ($propPool != 'Yes') {
            $propPool = 'No';
        }
        $reportItems['propertyPool'] = number_format((double) $report187->PropertyProfile->PropertyCharacteristics->Pool[0]);
        $reportItems['propertyPoolLow'] = number_format((double) minMaxArray('Pool', 'min', $reportItems['comparable']));
        $reportItems['propertyPoolMedian'] = number_format((double) minMaxArray('Pool', 'median', $reportItems['comparable']));
        $reportItems['propertyPoolHign'] = number_format((double) minMaxArray('Pool', 'max', $reportItems['comparable']));

        $reportItems['propertySalePrice'] = number_format((double) $report187->PropertyProfile->SaleLoanInfo->SalesPrice);
        $reportItems['propertySalePriceLow'] = number_format($salesAnalysis['minPrice']); //number_format(minMaxArray('PriceRate', 'min', $reportItems['comparable']));
        $reportItems['propertySalePriceMedian'] = number_format($salesAnalysis['median_price']); //number_format(minMaxArray('PriceRate', 'median', $reportItems['comparable']));
        $reportItems['propertySalePriceLowHigh'] = number_format($salesAnalysis['maxPrice']); //number_format(minMaxArray('PriceRate', 'max', $reportItems['comparable']));

        $areaSalesChart['series'] = '';
        $areaSalesChart['date'] = '';

        $minRadius = minMaxArray('Distance', 'min', $reportItems['comparable']);
        $medianRadius = minMaxArray('Distance', 'median', $reportItems['comparable']);
        $maxRadius = minMaxArray('Distance', 'max', $reportItems['comparable']);
        $reportItems['areaMinRadius'] = $minRadius;
        $reportItems['areaMedianRadius'] = $medianRadius;
        $reportItems['areaMaxRadius'] = $maxRadius;

        $ChartArr = array();
        $tmp2 = array();

        $now = date('Y-m');
        for ($x = 10; $x >= 1; $x--) {
            $ym = date('Y-m', strtotime($now . " -$x month"));
            $ym_txt = date('My', strtotime($now . " -$x month"));
            $ChartArr[$ym] = array(
                'label' => $ym_txt,
                'val' => 0,
            );
        }
        foreach ($comparableTemp as $comp_tmp_key => $comp_tmp_val) {
            $chart_ind = $comp_tmp_val['ChartLabelVal'];
            $chart_price = $comp_tmp_val['PriceRate'];
            if (isset($ChartArr[$chart_ind])) {
                $ChartArr[$chart_ind]['val'] += $chart_price;
            }
        }
        $tmp2['date'] = implode('|', array_column($ChartArr, 'label'));
        $tmp2['series'] = implode(',', array_column($ChartArr, 'val'));

        $chart_color = !empty($CI->input->post('theme')) ? str_replace("#", "", $CI->input->post('theme')) : '082147';
        // $tmp2['color'] = str_replace("#", "", $CI->input->post('theme'));
        $tmp2['color'] = $chart_color;

        $reportItems['chart'] = $tmp2;
        $reportItems['totalMonthsReport'] = 0;
        $data['areaSalesAnalysis'] = $reportItems;
        $data['theme'] = $CI->input->post('theme');

        /* bio */
        $data['bio'] = isset($_POST['bio']) && !empty($_POST['bio']) ? $_POST['bio'] : '';
        /* bio */

        /* testimonials */
        $testimonials = isset($_POST['testimonials']) && !empty($_POST['testimonials']) ? json_decode($_POST['testimonials']) : array();
        $testimonials_name = isset($_POST['testimonials_name']) && !empty($_POST['testimonials_name']) ? json_decode($_POST['testimonials_name']) : array();

        if (isset($testimonials) && !empty($testimonials)) {
            foreach ($testimonials as $t_key => $t_value) {
                $name = '';
                if (array_key_exists($t_key, $testimonials_name)) {
                    $name = $testimonials_name[$t_key];
                }
                $data['testimonials'][] = array('content' => $t_value, 'name' => $name);
            }
        }
        /* testimonials */

        $data['pdfPages'] = isset($_POST['pdfPages']) && !empty($_POST['pdfPages']) ? explode(',', $_POST['pdfPages']) : array();

        $data['fromcma'] = 0;
        if (isset($_POST['fromcma']) && $_POST['fromcma'] == '1') {

            $data['fromcma'] = 1;
        }

        /*Featured section*/
        if (!empty($CI->input->post('featured_homes')) && json_decode($CI->input->post('featured_homes'))) {
            $data['featured_homes'] = json_decode($CI->input->post('featured_homes'));
        } else {
            $data['featured_homes'] = $CI->base_model->all_records('lp_featured_home');
        }
        /*Featured section*/

        /*Dynamic setting*/
        if (trim($CI->input->post('presentation')) == 'seller' && $CI->input->post('page') && is_array($CI->input->post('page'))) {
            $data['page'] = $CI->input->post('page');
            $page_data = $CI->input->post('page');
            //Bio
            $page_data['bio'] = $CI->input->post('bio');
            //Bio
            //Testimonial
            $page_data['testimonials'] = $data['testimonials'];
            //Testimonial
            //Featured Section
            if (!empty($CI->input->post('featured_homes')) && json_decode($CI->input->post('featured_homes'))) {
                $page_data['featured_homes'] = json_decode($CI->input->post('featured_homes'));
            }
            //Featured Section
            // var_dump($page_data);die;
            $page_data = serialize($page_data);
            $check_page_condition = [
                'user_id' => $currentUserId,
                'language' => 'english',
                'report_type' => trim($CI->input->post('presentation')),
            ];
            $CI->load->model('widget_report_dynamic_data_model');
            $check_page_contents = $CI->widget_report_dynamic_data_model->get_by($check_page_condition);
            if ($check_page_contents) {
                $CI->widget_report_dynamic_data_model->update($check_page_contents->id, ['data' => $page_data]);
            } else {
                $check_page_condition['data'] = $page_data;
                $CI->widget_report_dynamic_data_model->insert($check_page_condition);

            }
        }
        if ($data['fromcma'] == 1) {
            $data['page'] = array();
            $check_page_condition = [
                'user_id' => $currentUserId,
                'language' => 'english',
                'report_type' => trim($CI->input->post('presentation')),
            ];
            $CI->load->model('widget_report_dynamic_data_model');
            $check_page_contents = $CI->widget_report_dynamic_data_model->get_by($check_page_condition);
            if ($check_page_contents) {
                $page_data = unserialize($check_page_contents->data);
                $data['page'] = $page_data;
                if (!empty($page_data['testimonials'])) {
                    $data['testimonials'] = $page_data['testimonials'];
                }
                if (!empty($page_data['featured_homes'])) {
                    $data['featured_homes'] = $page_data['featured_homes'];
                }

            }
        }
        /*Dynamic setting*/

        $PdfGenResponse = $this->prepareWidgetPdf($reportLang, $data, $_POST['presentation'], $report187->PropertyProfile->SiteAddress);
        $pdfFileName = $PdfGenResponse['pdf_filename'];
        $reportGenerated = $PdfGenResponse['report_generated'];
        $errorMsg = $PdfGenResponse['error_msg'];

        if ($reportGenerated) {
            $insertPdfReport = array(
                'project_name' => $CI->db->escape_str($report187->PropertyProfile->SiteAddress),
                'report_path' => $pdfFileName,
                'user_id_fk' => $currentUserId,
                'property_owner' => $CI->db->escape_str($report187->PropertyProfile->PrimaryOwnerName),
                'property_address' => $CI->db->escape_str($report187->PropertyProfile->SiteAddress . ', ' . $report187->PropertyProfile->SiteCity . ' ' . $report187->PropertyProfile->SiteState . ' ' . $report187->PropertyProfile->SiteZip),
                'property_apn' => $CI->db->escape_str($report187->PropertyProfile->APN),
                'property_lat' => $CI->db->escape_str($report187->PropertyProfile->PropertyCharacteristics->Latitude),
                'property_lng' => $CI->db->escape_str($report187->PropertyProfile->PropertyCharacteristics->Longitude),
                'report_type' => $_POST['presentation'],
            );

            $CI->base_model->insert_one_row('lp_my_listing', $insertPdfReport);
            $project_id = $CI->base_model->get_last_insert_id();
            $CI->session->set_userdata('project_id', $project_id);

            // if call is from api then we directly send the report link
            return array("status" => true, 'reportLink' => base_url($pdfFileName), 'project_id' => $project_id);

        } else {
            return array("status" => false, "msg" => $errorMsg);
        }
    }

    public function prepareWidgetPdf($reportLang, $data, $presentationType, $siteAddress)
    {
        $CI = &get_instance();

        if (empty($reportLang)) {
            $reportLang = 'english';
        }

        //@var $turboMode boolean If true than it uses pre stored static theme pages and using qpdf tool it merge these with dynamic content pdf being gnerated with wkhtmltopdf tool
        $turboMode = false;
        /**
         * Start Code to fetch customized text data of user
         */
        $data['user_id_for_report_customization'] = 0;
        $data['presentation_type'] = $presentationType;
        if ($data['user']['email'] != '') {
            $CI->load->model('user_model');
            $userInfo = $CI->user_model->getUserDetailsByEmail($data['user']['email'], ['user_id_pk', 'email', 'role_id_fk', 'customer_id', 'ref_code']);
            $data['user_id_for_report_customization'] = $userInfo['user_id_pk'];
        }

        $customization_data = [];
        if ($presentationType == "seller" && !empty($data['user_id_for_report_customization'])) {
            $CI->load->model('report_model');
            $customization_data['12']['report_content_data'] = $CI->report_model->prepare_user_widget_report_data($presentationType, $reportLang, 12);
            $customization_data['13']['report_content_data'] = $CI->report_model->prepare_user_widget_report_data($presentationType, $reportLang, 13);
            $customization_data['14']['report_content_data'] = $CI->report_model->prepare_user_widget_report_data($presentationType, $reportLang, 14);
            $customization_data['15']['report_content_data'] = $CI->report_model->prepare_user_widget_report_data($presentationType, $reportLang, 15);
            $customization_data['16']['report_content_data'] = $CI->report_model->prepare_user_widget_report_data($presentationType, $reportLang, 16);
            $customization_data['17']['report_content_data'] = $CI->report_model->prepare_user_widget_report_data($presentationType, $reportLang, 17);
            $customization_data['18']['report_content_data'] = $CI->report_model->prepare_user_widget_report_data($presentationType, $reportLang, 18);
            $customization_data['19']['report_content_data'] = $CI->report_model->prepare_user_widget_report_data($presentationType, $reportLang, 19);
        }

        $data['customization_pages_data'] = $customization_data;

        /**
         * END Code to fetch customized text data of user
         */

        if ($turboMode) {
            $html = $CI->load->view("reports/" . $reportLang . "/" . $presentationType . "/dynamic", $data, true);
        } else {
            $load_view = 'reports/widget/' . $data['report_dir_name'] . '/' . $presentationType . '/index';
            // die($load_view);
            if (!empty($data['report_dir_name']) && (is_file(APPPATH . 'views/' . $load_view . EXT))) {
                $html = $CI->load->view($load_view, $data, true);

            } else {

                $html = $CI->load->view("reports/" . $reportLang . "/" . $presentationType . "/widget_index", $data, true);
            }

        }
        if (isset($_POST['print_html']) && $_POST['print_html'] == 1) {
            echo $html;
            exit;
        }

        //file_put_contents("tmp.html", $html);
        $wkhtmltopdfPath = $CI->config->item('wkhtmltopdf_path');
        if ($turboMode && $presentationType == 'seller' && $reportLang == 'english') {
            $zoom = $CI->config->item('wkhtmltopdf_zoom_seller');
        } else {
            $zoom = $CI->config->item('wkhtmltopdf_zoom');
        }
        $snappy = new Pdf($wkhtmltopdfPath);
        //$snappy = new Pdf($this->binaryPath);
        $options = [
            'margin-top' => 0,
            'margin-right' => 0,
            'margin-bottom' => 0,
            'margin-left' => 0,
            'page-size' => 'Letter',
            'zoom' => $zoom,
            'load-error-handling' => 'ignore',
            'load-media-error-handling' => 'ignore',
        ];
        $snappy->setTimeout(150);
        $output = $snappy->getOutputFromHtml(
            $html,
            $options,
            200,
            array(
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'attachment; filename="report.pdf"',
            )
        );
        $pdfFileName = $pdfFileDynamic = 'temp/' . str_replace(" ", "_", $siteAddress) . '_' . md5(time() . rand()) . '.pdf';
        file_put_contents($pdfFileDynamic, $output);
        if (filesize($pdfFileDynamic) < 10000) { // Output pdf should be atleast 100KB of size otherwise some error has occured
            return array(
                'report_generated' => false,
                'error_msg' => "Empty PDF generated while trying to create " . $reportLang . " " . $presentationType . " Report for user account " . $CI->session->userdata('user_email'),
                'pdf_filename' => '',
            );
        }

        return array(
            'report_generated' => true,
            'pdf_filename' => $pdfFileName,
            'error_msg' => '',
        );
    }

    public function make_request($http_method, $endpoint, $body_params = '')
    {
        $login = $_ENV['RETS_API_USERNAME'];
        $password = $_ENV['RETS_API_PASSWORD'];

        $ch = curl_init($_ENV['RETS_API_ENDPOINT'] . $endpoint);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $http_method);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body_params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "$login:$password");
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($body_params),
            )
        );

        $error_msg = curl_error($ch);

        $result = curl_exec($ch);
        return $result;
    }

}
