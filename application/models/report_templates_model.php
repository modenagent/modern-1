<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Report_templates_model extends MY_Model
{
    public $_table = 'lp_report_templates';
    public $primary_key = 'report_templates_id_pk';
}
