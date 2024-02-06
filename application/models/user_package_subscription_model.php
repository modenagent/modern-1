<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class User_package_subscription_model extends MY_Model
{
    public $_table = 'lp_user_package_subscription';
    public $belongs_to = array('package' => array('model' => 'package_model', 'primary_key' => 'package_id'));
}
