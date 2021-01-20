<?php
include_once 'pb.config.php';
$xmlOut = Array();

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

		
		  $sql_search='CALL YISGRAND.PrivatBank_xml("'.$xmlIn.'",@billIdentifier,@success)';
		  $result_search = $_db->query($sql_search) or die('Connect Error (' . $_db->connect_error . ') ' . $_db->connect_error);

		  $sql_callback='SELECT @billIdentifier,@success';
		  $res_callback = $_db->query($sql_callback) or die('Connect Error (' . $_db->connect_error . ') ' . $_db->connect_error);
		
		      while ($row_callback = $res_callback->fetch_assoc()) {
			     $billIdentifier = $row_callback['@billIdentifier'];
			     $result = $row_callback['@success'];

			    } 
			    if ($result) {
				$sql_xml_out='SELECT t1.`xmlOut` FROM YISGRAND.PB as t1 WHERE t1.`billIdentifier` = "'.$billIdentifier.'"';
				$result_xml_out = $_db->query($sql_xml_out) or die('Connect Error (' . $_db->connect_error . ') ' . $_db->connect_error);
				while ($res_row = $result_xml_out->fetch_assoc()) {
				$xmlOut['xml']= $res_row['xmlOut'];
				} 
				 // print(htmlentities($xmlOut['xml'], ENT_QUOTES, "UTF-8"));
				 print($xmlOut['xml']);

				}else {
				return false;
				}
			   
		  	
	 // print_r($xmlData);
	  
		  
} else {
	die('No Content Received From Datafeed');
}
 
 
?>
