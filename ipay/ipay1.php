<?php
include_once 'ipay.class.php';
include_once 'ipay_config.php';
include_once 'XmlToArray.php';

if($_SERVER['REQUEST_METHOD'] == 'POST') { 
header('Content-Type: text/xml; charset=utf-8');
$result = file_get_contents('php://input'); 
//$xmlData = json_decode(json_encode(simplexml_load_string($result)),true);
		    
	         $_db = new mysqli('localhost',   LOGIN ,PASSWORD, 'YISGRAND');
	      if ($_db->connect_error) {
		die('Connection Error (' . $_db->connect_errno . ') ' . $_db->connect_error);
	      }
		$_db->set_charset("utf8");
		
            $xmlIn = $_db->real_escape_string($result);

		
		  $sql_search='INSERT YISGRAND.IPAY SET xmlIn ="'.$xmlIn.'"';
		  $result_search = $_db->query($sql_search) or die('Connect Error (' . $_db->connect_error . ') ' . $_db->connect_error);

		 
	  
		  
} else {
	die('No Content Received From Datafeed');
}
 
 ?>
