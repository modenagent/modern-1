<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Rets
{
    private $rets;
    public function __construct()
    {
        $config = new \PHRETS\Configuration;
        // $config->setLoginUrl('https://sdmls-rets.connectmls.com/server/login')
        //         ->setUsername('683241')
        //         ->setPassword('8JTDyMSq45XPF5N8')
        //         ->setRetsVersion('1.7.2');
        $config->setLoginUrl('https://pt.rets.crmls.org/contact/rets/login')
            ->setUsername('AWARDSUPERSTARS')
            ->setPassword('6azE$DsY')
            ->setRetsVersion('1.5');
        $this->rets = new \PHRETS\Session($config);
    }

    public function searchData($search = '', $search_mlsid = 0)
    {
        $connect = $this->rets->Login();

        $search_city = $search;
        if ($search_mlsid) {
            $search_city = $mlsId = $search_number = $search_street = '';
            $explode_search = explode(',', $search);
            if (count($explode_search) > 1 && trim($explode_search[1]) != '') {
                $search_street = trim($explode_search[1]);
                $search_number = trim($explode_search[0]);
            } else {
                $mlsId = trim($explode_search[0]);
            }
        }

        $city_lookup = $this->rets->GetLookupValues('Property', 'City');
        // $city_values = array();
        $city_value = '';
        foreach ($city_lookup as $city_lookup_key => $city_lookup_value) {
            // $city_values[trim($city_lookup_value['Value'])] = $city_lookup_value['LongValue'];
            if ($search_city != '' && trim(strtolower($city_lookup_value['LongValue'])) == trim(strtolower($search_city))) {
                $city_value = $city_lookup_value['Value'];
            }
        }

        if ($search_mlsid) {
            $search_fields = '(ListOfficeName=Century 21 Award)';
            if (!empty($search_street)) {
                $search_fields = $search_fields . ',(StreetName=' . $search_street . '),(StreetNumberNumeric=' . $search_number . '),(StandardStatus=S)';
            } elseif (!empty($mlsId)) {
                $search_fields = $search_fields . ',(ListingId=' . $mlsId . ')';
            }
            // echo $search_fields;die;
            $results = $this->rets->Search('Property', 'Residential', $search_fields, ['Limit' => 10, 'Select' => 'StreetNumberNumeric,StreetName,City,StateOrProvince,PostalCode,ClosePrice,ListPrice,ListingId,CloseDate']);
        } else {
            // SDMLS
            // $results = $this->rets->Search('Property', 'RE_1', '(L_Status=|2_0),(L_City='.$search.')',['Limit' => 25,'Select' =>'LR_remarks1616,L_City,L_OriginalPrice,L_DisplayId']);

            $results = $this->rets->Search('Property', 'Residential', '(ListOfficeName=Century 21 Award),(City=' . $city_value . '),(StandardStatus=S)', ['Select' => 'StreetNumberNumeric,StreetName,City,StateOrProvince,PostalCode,ClosePrice,ListPrice,ListingId,CloseDate']);

            // if(!(is_array($results) && count($results))) {
            //     // echo "in";
            //     $results = $this->rets->Search('Property', 'RE_1', '(L_Status=|2_0)',['Limit' => 25,'Select' =>'LR_remarks1616,L_City,L_OriginalPrice,L_DisplayId']);
            // }
        }
        $data = array();

        foreach ($results as $r) {
            $obj = array();
            $obj['city'] = $r['City'];
            $obj['address'] = $this->getFullAddress($r);
            $obj['price'] = (!empty(trim($r['ClosePrice']))) ? $r['ClosePrice'] : $r['ListPrice'];
            $obj['mlsId'] = $r['ListingId'];
            $obj['CloseDate'] = $r['CloseDate'];
            $data[] = $obj;

        }

        usort($data, function ($a, $b) {
            return $b['CloseDate'] <=> $a['CloseDate'];
        });

        return $data;
    }

    private function getFullAddress($result, $addional_fields = null)
    {
        $address_array = array();
        $fileds_to_check = [
            'StreetNumberNumeric',
            'StreetName',
            // 'City',
            // 'StateOrProvince',
            // 'PostalCode',

        ];
        if (is_array($addional_fields) && count($addional_fields)) {
            $fileds_to_check = array_merge($fileds_to_check, $addional_fields);
        }
        foreach ($fileds_to_check as $key => $value) {
            if (isset($result[$value]) && !empty(trim($result[$value]))) {
                $address_array[] = trim($result[$value]);
            }

        }

        if (count($address_array)) {
            return implode(' ', $address_array);
        } else {
            return '';
        }
    }

    public function getRecentSold($search_city = '')
    {

        $connect = $this->rets->Login();

        $city_lookup = $this->rets->GetLookupValues('Property', 'City');
        $city_value = '';
        foreach ($city_lookup as $city_lookup_key => $city_lookup_value) {
            if ($search_city != '' && trim(strtolower($city_lookup_value['LongValue'])) == trim(strtolower($search_city))) {
                $city_value = $city_lookup_value['Value'];
            }
        }
        if (empty($city_value)) {
            return null;
        }

        $results = $this->rets->Search('Property', 'Residential', '(ListOfficeName=Century 21 Award),(City=' . $city_value . '),(StandardStatus=S)', ['Select' => 'StreetNumberNumeric,StreetName,City,StateOrProvince,PostalCode,ClosePrice,ListPrice,ListingId,CloseDate,ListingContractDate,LotSizeSquareFeet,BedroomsTotal,PricePerSquareFoot,BathroomsTotalInteger,YearBuilt,PoolFeatures,ListingKeyNumeric']);

        $data = array();

        foreach ($results as $r) {
            $obj = array();
            // $obj['city'] = $r['L_City'];
            // $obj['address'] = $r['LR_remarks1616'];
            // $obj['price'] = $r['L_OriginalPrice'];
            // $obj['mlsId'] = $r['L_DisplayId'];
            // $obj['listDate'] = $r['L_ListingDate'];
            // $obj['area'] = $r['LM_Int4_1'];
            // $obj['bedrooms'] = $r['LM_Int1_1'];
            // $obj['pricePerSQFT'] = $r['L_PricePerSQFT'];
            // $obj['bathrooms'] = $r['LM_Int2_6'];
            // $obj['yearBuilt'] = $r['LM_Int2_1'];
            // $obj['lotSize'] = $r['LM_Int4_6'];
            // $obj['pool'] = $r['LFD_Pool_25'];

            $obj['city'] = $r['City'];
            $additional_fileds = ['City', 'PostalCode'];
            $obj['address'] = $this->getFullAddress($r, $additional_fileds);
            $obj['price'] = (!empty(trim($r['ClosePrice']))) ? $r['ClosePrice'] : $r['ListPrice'];
            $obj['mlsId'] = $r['ListingId'];
            $obj['listDate'] = (!empty(trim($r['CloseDate']))) ? $r['CloseDate'] : $r['ListingContractDate'];
            $obj['area'] = $r['LotSizeSquareFeet'];
            $obj['bedrooms'] = $r['BedroomsTotal'];
            $obj['pricePerSQFT'] = $r['PricePerSquareFoot'];
            $obj['bathrooms'] = $r['BathroomsTotalInteger'];
            $obj['yearBuilt'] = $r['YearBuilt'];
            $obj['lotSize'] = '';
            $obj['pool'] = $r['PoolFeatures'];
            $obj['ListingKeyNumeric'] = $r['ListingKeyNumeric'];
            $data[] = $obj;

        }

        usort($data, function ($a, $b) {
            return $b['CloseDate'] <=> $a['CloseDate'];
        });

        $data = array_slice($data, 0, 8);

        return $data;
    }

    public function getDataBymlsId($mlsId = '')
    {

        $connect = $this->rets->Login();
        // SDMLS
        // $results = $this->rets->Search('Property', 'RE_1', '(L_DisplayId='.$mlsId.')',['Limit' => 8,'Select' =>'LR_remarks1616,L_City,L_OriginalPrice,L_DisplayId,L_ListingDate,LM_Int4_1,LM_Int1_1,L_PricePerSQFT,LM_Int2_6,LM_Int2_1,LM_Int4_6,LFD_Pool_25']);

        // echo $mlsId;die;

        $results = $this->rets->Search('Property', 'Residential', '(ListOfficeName=Century 21 Award),(ListingId=' . $mlsId . ')', ['Select' => 'StreetNumberNumeric,StreetName,City,StateOrProvince,PostalCode,ClosePrice,ListPrice,ListingId,CloseDate,ListingContractDate,LotSizeSquareFeet,BedroomsTotal,PricePerSquareFoot,BathroomsTotalInteger,YearBuilt,PoolFeatures,ListingKeyNumeric']);

        $data = array();

        foreach ($results as $r) {
            $obj = array();
            // $obj['city'] = $r['L_City'];
            // $obj['address'] = $r['LR_remarks1616'];
            // $obj['price'] = $r['L_OriginalPrice'];
            // $obj['mlsId'] = $r['L_DisplayId'];
            // $obj['listDate'] = $r['L_ListingDate'];
            // $obj['area'] = $r['LM_Int4_1'];
            // $obj['bedrooms'] = $r['LM_Int1_1'];
            // $obj['pricePerSQFT'] = $r['L_PricePerSQFT'];
            // $obj['bathrooms'] = $r['LM_Int2_6'];
            // $obj['yearBuilt'] = $r['LM_Int2_1'];
            // $obj['lotSize'] = $r['LM_Int4_6'];
            // $obj['pool'] = $r['LFD_Pool_25'];

            $obj['city'] = $r['City'];
            $additional_fileds = ['City', 'PostalCode'];
            $obj['address'] = $this->getFullAddress($r, $additional_fileds);
            $obj['price'] = (!empty(trim($r['ClosePrice']))) ? $r['ClosePrice'] : $r['ListPrice'];
            $obj['mlsId'] = $r['ListingId'];
            $obj['listDate'] = (!empty(trim($r['CloseDate']))) ? $r['CloseDate'] : $r['ListingContractDate'];
            $obj['area'] = $r['LotSizeSquareFeet'];
            $obj['bedrooms'] = $r['BedroomsTotal'];
            $obj['pricePerSQFT'] = $r['PricePerSquareFoot'];
            $obj['bathrooms'] = $r['BathroomsTotalInteger'];
            $obj['yearBuilt'] = $r['YearBuilt'];
            $obj['lotSize'] = '';
            $obj['pool'] = $r['PoolFeatures'];
            $obj['ListingKeyNumeric'] = $r['ListingKeyNumeric'];
            $data[] = $obj;

        }

        return $data;
    }

    public function getImages($recordId = '')
    {

        $photos = $this->rets->Search("Media", "Media", "(MediaType=Image),(ResourceRecordKeyNumeric=$recordId),(Order=0)", ['QueryType' => 'DMQL2']);
        $data = array();
        foreach ($photos as $photo) {
            // $listing = $photo->getContentId();
            $data[$photo['ResourceRecordKeyNumeric']] = $photo['MediaURL'];
        }

        return $data;
    }

    public function check_crmls($limit = 2)
    {
        $config = new \PHRETS\Configuration;
        $config->setLoginUrl('https://pt.rets.crmls.org/contact/rets/login')
            ->setUsername('AWARDSUPERSTARS')
            ->setPassword('6azE$DsY')
            ->setRetsVersion('1.5');
        $rets = new \PHRETS\Session($config);
        $limit = (int) $limit;
        if ($limit > 20) {
            $limit = 20;
        }

        $connect = $rets->Login();
        $results = $rets->Search('Property', 'Residential', '(ListOfficeName=Century 21 Award),(City=SD)', ['Limit' => $limit, 'QueryType' => 'DMQL2', 'Format' => 'COMPACT-DECODED', 'StandardNames' => 0]);
        return $results;
    }

    public function callSimplyRets($login, $password, $endpoint = '', $body_params = '')
    {
        // $login = $_ENV['RETS_API_USERNAME'];
        // $password = $_ENV['RETS_API_PASSWORD'];
        $req_endpoint = $_ENV['RETS_API_ENDPOINT'] . 'properties';

        $endpoint = $req_endpoint . $endpoint;
        $ch = curl_init($endpoint);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $body_params);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, "$login:$password");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($body_params))
        );

        $result = curl_exec($ch);
        // Check the return value of curl_exec(), too
        if ($result === false) {
            return json_encode(['error' => 'Something went wrong', 'message' => curl_error($ch)]);
            // throw new Exception(curl_error($ch), curl_errno($ch));
        }
        return $result;
    }
}
