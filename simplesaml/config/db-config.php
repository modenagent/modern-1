<?php
$samlbasedir= dirname(dirname(dirname(__FILE__)));
include $samlbasedir.'/'.'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable($samlbasedir);
      
$dotenv->load();
$DB_HOST = $_ENV['DB_HOST'];
$DB_USER = $_ENV['DB_USER'];
$DB_PASSWORD = $_ENV['DB_PASSWORD'];
$DB_DATABASE = $_ENV['DB_DATABASE'];

// Create connection
$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD,$DB_DATABASE);

$idps_config = array();    
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT unique_id, metadata_url FROM lp_idps WHERE metadata_url != ''";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

  while($row = $result->fetch_assoc()) {

    $dir_check = '../metadata/'.$row['unique_id'];
    if(!is_dir($dir_check)) {
        var_dump(mkdir($dir_check));die;
    }
  
    $unique_id=(string)$row['unique_id'];

    $idps_config[] = array(
      'unique_id' => $row['unique_id'],
      'metadata_url' => $row['metadata_url']
    );
    
  }
}

/*Load IDps from Database*/

