<?php
include_once '../fb_config.php';
$today = date("Ym01"); 
$pstatus = "";
$address_id = "";
$summa ="";
$pay_id = "";
$date_time = "";
$error = "Error";
if (isset($_GET['query'])){
  $_db = new mysqli('localhost', LOGIN ,PASSWORD, 'YISGRAND');
  if ($_db->connect_error) {
      die('Connection Error (' . $_db->connect_errno . ') ' . $_db->connect_error);
  }
  $_db->set_charset("utf8");
  $getMsg = explode(';', $_GET['query']);
  $pstatus = $getMsg[0]; 
   switch($pstatus) {
	case '01':
	$address_id = $getMsg[1];
	$sql_query='CALL YISGRAND.FbPayment01('.$address_id.',@kod, @summa,@msg)';
	$result_query = $_db->query($sql_query) or die('Connect Error (' . $sql_query . ') ' . $_db->connect_error);				    
	$result_callback='SELECT @kod, @summa, @msg';
	$res_callback = $_db->query($result_callback) or die('Connect Error in (' .  $result_callback . ') ' . $_db->connect_error);
	while ($res_row = $res_callback->fetch_assoc()) {
	  $results['kod'] = $res_row['@kod'];
	  $results['summa']	=$res_row['@summa'];
	  $results['msg']	=$res_row['@msg'];
	  }
	  switch($results['kod']) {
	    case '0':
	    $strNewMsg  = '02;0;'.$getMsg[1].';'.$results['summa'].';'.$results['msg'].';'; 
	    break;
	    case '1':
	    $strNewMsg  = '02;1;'.$getMsg[1].';0;'.$results['msg'].';'; 
	    break;
	    case '2':
	    $strNewMsg  = '02;2;'.$getMsg[1].';0;'.$results['msg'].';';
	    break;
	    case '5':
	    $strNewMsg  = '02;5;'.$getMsg[1].';';
	    break;
	    default:
	    $strNewMsg  = '02;9;'; 
	   
	  }
	 
	break;
	case '03':
	$address_id = $getMsg[1];
	$oplata = $getMsg[2];	  
	$pay_id = $getMsg[3];
	$date_time = $getMsg[4];
	$sql_query='CALL YISGRAND.FbPayment03('.$address_id.',"'.$oplata.'","'.$pay_id.'","'.$date_time.'", @kod)';
	$result_query = $_db->query($sql_query) or die('Connect Error (' . $sql_query . ') ' . $_db->connect_error);				    
	$result_callback='SELECT @kod';
	$res_callback = $_db->query($result_callback) or die('Connect Error in (' .  $result_callback . ') ' . $_db->connect_error);
	while ($res_row = $res_callback->fetch_assoc()) {
	  $results['kod'] = $res_row['@kod'];	 
	  }
	  switch($results['kod']) {
	    case '0':
	    $strNewMsg  = '04;0;'.$getMsg[1].';'.$oplata.';'.$pay_id.';';
	    break;
	    case '1':
	    $strNewMsg  = '04;1;'.$getMsg[1].';'.$oplata.';'.$pay_id.';'; 
	    break;
	    case '5':
	    $strNewMsg  = '04;5;'.$getMsg[1].';'.$oplata.';'.$pay_id.';'; 
	    break;
	  
	    default:
	    $strNewMsg  = '04;9;';
	  
	  }
	break;
	case '05': 
	$pay_id = $getMsg[1];	
	$sql_query='CALL YISGRAND.FbPayment05("'.$pay_id.'",@kod,@address_id,@summa)';
	$result_query = $_db->query($sql_query) or die('Connect Error (' . $sql_query . ') ' . $_db->connect_error);				    
	$result_callback='SELECT @kod, @address_id, @summa';
	$res_callback = $_db->query($result_callback) or die('Connect Error in (' .  $result_callback . ') ' . $_db->connect_error);
	while ($res_row = $res_callback->fetch_assoc()) {
	  $results['kod'] = $res_row['@kod'];
	  $results['summa']	=$res_row['@summa'];
	  $results['address_id']	=$res_row['@address_id'];	 
	  }
	  switch($results['kod']) {
	    case '0':
	    $strNewMsg  = '06;0;'.$results['address_id'].';'.$results['summa'].';'.$pay_id.';';
	    break;
	    case '1':
	    $strNewMsg  = '06;1;'.$results['address_id'].';'.$results['summa'].';'.$pay_id.';';
	    break;
	    case '5':
	    $strNewMsg  = '06;5;';
	    break;
	    case '6':
	    $strNewMsg  = '06;6;';
	    break;
	    default:
	    $strNewMsg  = '06;9;';	  
	  }
	break;
	case '07':
	$pay_id = $getMsg[1];
	$sql_query='CALL YISGRAND.FbPayment07("'.$pay_id.'",@kod,@address_id,@summa)';
	$result_query = $_db->query($sql_query) or die('Connect Error (' . $sql_query . ') ' . $_db->connect_error);				    
	$result_callback='SELECT @kod, @address_id, @summa';
	$res_callback = $_db->query($result_callback) or die('Connect Error in (' .  $result_callback . ') ' . $_db->connect_error);
	while ($res_row = $res_callback->fetch_assoc()) {
	  $results['kod'] = $res_row['@kod'];
	  $results['summa']	=$res_row['@summa'];
	  $results['address_id']	=$res_row['@address_id'];	 
	  }
	  switch($results['kod']) {
	    case '0':
	    $strNewMsg  = '08;0;'.$results['address_id'].';'.$results['summa'].';'.$pay_id.';';
	    break;
	    case '1':
	    $strNewMsg  = '08;1;'.$results['address_id'].';'.$results['summa'].';'.$pay_id.';';
	    break;
	    case '5':
	    $strNewMsg  = '08;5;';
	    break;
	    case '9':
	    $strNewMsg  = '08;9;';
	    break;
	    default:
	    $strNewMsg  = '08;9;';
	  }
	break;
	 default:
	 print($error);
} 
print($strNewMsg);
}else{
print($error);
}
   
?>