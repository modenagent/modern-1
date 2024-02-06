<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class User_default_templates_model extends MY_Model
{
    public $_table = 'lp_user_default_templates';
    public $belongs_to = array('theme_color_obj' => array('model' => 'report_templates_model', 'primary_key' => 'theme_color'));
}
