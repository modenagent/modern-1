<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    function getReportPages($language, $type)
    {
    	$reports = [];
    	$sql = 'SELECT page_no, page_title, page_path 
    	FROM lp_user_report_content 
    	WHERE user_id = 0 
    	AND report_type = ? 
    	AND language = ?';
    	$result = $this->db->query($sql, [$type, $language]);
    	if ($result->num_rows()) {
    		$data = $result->result();
    		foreach ($data as $key => $row) {
    			$reports['pages'][] = [
    				'no' => $row->page_no,
    				'title' => $row->page_title,
    				'path' => $row->page_path,
    			];
    		}
    		$reports['count'] = $result->num_rows();
    		$reports['type'] = $type;
    		$reports['language'] = $language;
    	}
    	return $reports;
    }

    function getReportPageData($userId, $type, $language, $page)
    {
    	$data = [];
    	$sql = 'SELECT id, user_id, page_no, page_title, page_path, data 
    	FROM lp_user_report_content 
    	WHERE user_id = ? 
    	AND report_type = ? 
    	AND language = ? 
    	AND page_no = ? 
        AND status = 1';
    	$result = $this->db->query($sql, [$userId, $type, $language, $page]);
    	if ($result->num_rows()) {
    		$data = $result->row_array();
    	}
    	return $data;
    }

    function saveReportPageData($userId, $reportType, $language, $page, $reportDataToSave)
    {
    	$defaultData = $this->getReportPageData(0, $reportType, $language, $page);
    	$existingData = $this->getReportPageData($userId, $reportType, $language, $page);
    	if (!empty($existingData)) {
    		// Update
    		$data = array(
               'data' => json_encode($reportDataToSave),
               'updated_at' => date('Y-m-d H:i:s'),
               'updated_by' => $this->session->userdata('userid') 
            );

			$this->db->where('id', $existingData['id']);
			$this->db->where('user_id', $userId);
			$this->db->where('report_type', $reportType);
			$this->db->where('language', $language);
			$this->db->where('page_no', $page);
			$this->db->update('lp_user_report_content', $data); 

    	} else {
    		// Insert
    		$data = array(
		        'user_id' => $userId,
		        'report_type' => strtolower($reportType),
		        'language' => strtolower($language),
		        'page_no' => $page,
		        'page_title' => $defaultData['page_title'],
		        'page_path' => $defaultData['page_path'],
		        'data' => json_encode($reportDataToSave),
		        'created_at' => date('Y-m-d H:i:s'),
		        'updated_at' => date('Y-m-d H:i:s'),
		        'updated_by' => $this->session->userdata('userid')
			);

			$this->db->insert('lp_user_report_content', $data);
    	}	
    }

    public function prepare_user_report_data($userId, $reportType, $language, $page)
    {
        $default_data = $this->getReportPageData(0, $reportType, $language, $page);
        $user_data = $this->getReportPageData($userId, $reportType, $language, $page);

        $data = [];

        if (empty($user_data)) {
            $data = json_decode($default_data['data'], true);
        } else {
            $user_data_values = json_decode($user_data['data'], true);
            $admin_data_values = json_decode($default_data['data'], true);

            $data = $user_data_values;
            foreach ($user_data_values as $key => $value) {
                $data[$key]['limit'] = $admin_data_values[$key]['limit'];
                $data[$key]['type'] = $admin_data_values[$key]['type'];
            }
        }

        return $data;
    }
}
?>