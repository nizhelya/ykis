<?php
include_once 'pb.config.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') { 
header('Content-Type: application/json; charset=utf-8');
$result = file_get_contents('php://input'); 
$JsonData = json_encode($result);

$_db = new mysqli('localhost',   LOGIN ,PASSWORD, 'YISGRAND');
if ($_db->connect_error) {
die('4Connection Error (' . $_db->connect_errno . ') ' . $_db->connect_error);
  }
    $_db->set_charset("utf8");
    if ($result) {
     
	
	print_r(json_decode($JsonData));
    }else {
    
    return false;
  }
 
} else {
	die('No Content Received From Datafeed');
}
 
 
?>
