<?php
$xmlOut = Array();
if (isset($_POST["xmlData"])) {
 
	$xmlData = $_POST["xmlData"];

	         $_db = new mysqli('localhost', 'cthubq' ,'hfljyt;crbq', 'YISGRAND');
	      if ($_db->connect_error) {
		die('Connection Error (' . $_db->connect_errno . ') ' . $_db->connect_error);
	      }
		$_db->set_charset("utf8");
		
		$sql_insert='INSERT INTO YISGRAND.PB (`create_in`,`xmlIn`) VALUES (NOW(),"'.mysql_escape_string($xmlData).'")';
		$result_insert = $_db->query($sql_insert) or die('Connect Error (' . $_db->connect_error . ') ' . $_db->connect_error);
		
		if ($result_insert ) {
		$sql_id='SELECT LAST_INSERT_ID() as id';
		$result_id = $_db->query($sql_id) or die('Connect Error (' . $_db->connect_error . ') ' . $_db->connect_error);

		while ($res_row_id = $result_id->fetch_assoc()) {
		  $id= $res_row_id['id'];		
		}
		
		if($id) {
		  $sql_search='CALL YISGRAND.PrivatBank_xml("'.$id.'",@success)';
		  $result_search = $_db->query($sql_search) or die('Connect Error (' . $_db->connect_error . ') ' . $_db->connect_error);

		  $sql_callback='SELECT @success';
		  $res_callback = $_db->query($sql_callback) or die('Connect Error (' . $_db->connect_error . ') ' . $_db->connect_error);
		
		      while ($row_callback = $res_callback->fetch_assoc()) {
			     $result = $row_callback['@success'];
			    } 
			    if ($result) {
				$sql_xml_out='SELECT t1.`xmlOut` FROM YISGRAND.PB as t1 WHERE t1.`rec_id` = "'.$id.'"';
				$result_xml_out = $_db->query($sql_xml_out) or die('Connect Error (' . $_db->connect_error . ') ' . $_db->connect_error);
				while ($res_row = $result_xml_out->fetch_assoc()) {
				$xmlOut['xml']= $res_row['xmlOut'];
				} 
				print_r($xmlOut['xml']);
				//return $xmlOut['xml'];
				}else {
				return false;
				}
			    }
		  } 	
		  
		  
} else {
	die('No Content Received From Datafeed');
}
 
 
?>