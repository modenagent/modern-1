<?php
class Api_log_model extends CI_Model 
{
	function __construct() {
        // Set table name
        $this->table = 'lp_api_logs';
    }

    public function syncLogs($user_id, $request_type, $request_url, $request_data, $response_data, $logId = 0) 
    {
        if(is_array($request_data)) {
            $request_data = json_encode($request_data, true);
        }
        if ($logId == 0) {
            $data = array(
                'user_id' => $user_id,
                'request_type' => $request_type,
                'request_data' => !empty($request_data) ? $request_data : '',
                'request_url' => $request_url,
                'created' => date('Y-m-d H:i:s')
            );
            $this->db->insert($this->table, $data);
            return $this->db->insert_id();
        
        } else {
            if (is_array($response_data)) {
                $response_data = json_encode($response_data, true);
            }
            $data = array(
                'response_data' => !empty($response_data) ? $response_data : '',
                'updated' => date('Y-m-d H:i:s'),
            );
            $this->db->update($this->table, $data, array('id' => $logId));
        }
    }

}
