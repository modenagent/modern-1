<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

$active_group = 'default';
$active_record = true;

$db['default']['hostname'] = !empty($_ENV['DB_HOST']) ? $_ENV['DB_HOST'] : 'localhost';
$db['default']['username'] = $_ENV['DB_USER'];
$db['default']['password'] = $_ENV['DB_PASSWORD'];

$db['default']['database'] = $_ENV['DB_DATABASE'];
$db['default']['dbdriver'] = 'mysqli';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = true;
$db['default']['db_debug'] = true;
$db['default']['cache_on'] = false;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = true;
$db['default']['stricton'] = false;

/* End of file database.php */
/* Location: ./application/config/database.php */
