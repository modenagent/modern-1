<?php if( !defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

class Rets {
	private $rets;
	public function __construct() {
            $config = new \PHRETS\Configuration;
			$config->setLoginUrl('https://sdmls-rets.connectmls.com/server/login')
			        ->setUsername('683241')
			        ->setPassword('8JTDyMSq45XPF5N8')
			        ->setRetsVersion('1.7.2');
			 $this->rets = new \PHRETS\Session($config);
        }

    public function searchData($search='',$search_mlsid = 0) {
    	$connect = $this->rets->Login();
    	if($search_mlsid) {
    		$results = $this->rets->Search('Property', 'RE_1', '(L_City='.$search.')|(LMD_MP_AddressLine='.$search.')|(L_DisplayId='.$search.')',['Limit' => 10,'Select' =>'LR_remarks1616,L_City,L_OriginalPrice,L_DisplayId']);
    	}
    	else {

			$results = $this->rets->Search('Property', 'RE_1', '(L_Status=|2_0),(L_City='.$search.')',['Limit' => 25,'Select' =>'LR_remarks1616,L_City,L_OriginalPrice,L_DisplayId']);
			if(!(is_array($results) && count($results))) {
				// echo "in";
				$results = $this->rets->Search('Property', 'RE_1', '(L_Status=|2_0)',['Limit' => 25,'Select' =>'LR_remarks1616,L_City,L_OriginalPrice,L_DisplayId']);
			}
    	}
		$data = array();

		foreach ($results as $r) {
			$obj = array();
			$obj['city'] = $r['L_City'];
			$obj['address'] = $r['LR_remarks1616'];
			$obj['price'] = $r['L_OriginalPrice'];
			$obj['mlsId'] = $r['L_DisplayId'];
			$data[] = $obj;
		    
		}

		return $data;
    }

    public function getDataBymlsId($mlsId = '') {

    	$connect = $this->rets->Login();
    	
    	$results = $this->rets->Search('Property', 'RE_1', '(L_DisplayId='.$mlsId.')',['Limit' => 8,'Select' =>'LR_remarks1616,L_City,L_OriginalPrice,L_DisplayId,L_ListingDate,LM_Int4_1,LM_Int1_1,L_PricePerSQFT,LM_Int2_6,LM_Int2_1,LM_Int4_6,LFD_Pool_25']);
    	
		$data = array();

		foreach ($results as $r) {
			$obj = array();
			$obj['city'] = $r['L_City'];
			$obj['address'] = $r['LR_remarks1616'];
			$obj['price'] = $r['L_OriginalPrice'];
			$obj['mlsId'] = $r['L_DisplayId'];
			$obj['listDate'] = $r['L_ListingDate'];
			$obj['area'] = $r['LM_Int4_1'];
			$obj['bedrooms'] = $r['LM_Int1_1'];
			$obj['pricePerSQFT'] = $r['L_PricePerSQFT'];
			$obj['bathrooms'] = $r['LM_Int2_6'];
			$obj['yearBuilt'] = $r['LM_Int2_1'];
			$obj['lotSize'] = $r['LM_Int4_6'];
			$obj['pool'] = $r['LFD_Pool_25'];
			$data[] = $obj;
		    
		}

		return $data;
    }

    public function getImages($mlsId = '') {

    	$photos = $this->rets->GetObject("Property", "Photo", $mlsId, '0', 1);
    	$data = array();
		foreach ($photos as $photo) {
		    $listing = $photo->getContentId();
    		$data[$listing] = $photo->getLocation();
        }

        return $data;
    }

    public function check_crmls($search='',$limit=2)
    {
    	$config = new \PHRETS\Configuration;
		$config->setLoginUrl('https://pt.rets.crmls.org/contact/rets/login')
        ->setUsername('AWARDSUPERSTARS')
        ->setPassword('6azE$DsY')
        ->setRetsVersion('1.5');
		 $rets = new \PHRETS\Session($config);
		 $limit = (int)$limit;
		 if($limit > 20) {
		 	$limit = 20;
		 }

    	$connect = $rets->Login();
		$results = $rets->Search('Property', 'Residential', '(ListOfficeName=Century 21 Award),(City=SD)',['Limit' => $limit,'QueryType' => 'DMQL2','Format' => 'COMPACT-DECODED','StandardNames' => 0]);
		return $results;
    }
}