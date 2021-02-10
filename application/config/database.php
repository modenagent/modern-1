<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$active_group = 'default';
$active_record = TRUE;

$db['default']['hostname'] = !empty($_ENV['DB_HOST'])?$_ENV['DB_HOST']:'localhost';
$db['default']['username'] = !empty($_ENV['DB_USER'])?$_ENV['DB_USER']:'listingpitch';
$db['default']['password'] = !empty($_ENV['DB_PASSWORD'])?$_ENV['DB_PASSWORD']:'listingpitch';


$db['default']['database'] = !empty($_ENV['DB_DATABASE'])?$_ENV['DB_DATABASE']:'listingpitch';
$db['default']['dbdriver'] = 'mysqli';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;


/* End of file database.php */
/* Location: ./application/config/database.php */
