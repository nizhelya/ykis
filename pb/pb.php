<?php
include_once 'pb.config.php';
$xmlOut = Array();

if($_SERVER['REQUEST_METHOD'] == 'POST') { 
header('Content-Type: text/xml; charset=utf-8');
$result = file_get_contents('php://input'); 
$JsonData = json_decode($result);

$_db = new mysqli('localhost',   LOGIN ,PASSWORD, 'YISGRAND');
if ($_db->connect_error) {
die('Connection Error (' . $_db->connect_errno . ') ' . $_db->connect_error);
  }
    $_db->set_charset("utf8");
    if ($result) {
      $sql_xml_out='INSERT INTO YISGRAND.TEST_JSON(`info`) VALUES ($result)';
      $result_xml_out = $_db->query($sql_xml_out) or die('Connect Error (' . $_db->connect_error . ') ' . $_db->connect_error);
	
	print_r($JsonData);
    }else {
    
    return false;
  }
 
} else {
	die('No Content Received From Datafeed');
}
 
 
?>
