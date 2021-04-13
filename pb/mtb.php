<?php

include_once 'pb.config.php';

if($_SERVER['REQUEST_METHOD'] == 'GET') { 
header('Content-Type: text/html; charset=utf-8');

  if (!empty($_GET["command"]) && $_GET["command"]=="pay") {

  if(isset($_GET["account"]) && !empty($_GET["account"])) {
      $address_id =  $_GET["account"];
  } else {
      $address_id = 0;
  }
 
  if(isset($_GET["sum"]) && !empty($_GET["sum"])) {
      $summa =  $_GET["sum"];
  } else {
      $summa = 0;
  }
   if(isset($_GET["date_time"]) && !empty($_GET["date_time"])) {
      $data =  $_GET["date_time"];
  } else {
      $data = "";
  }
    if(isset($_GET["txn_id"]) && !empty($_GET["txn_id"])) {
      $payment_id =  $_GET["txn_id"];
  } else {
      $payment_id = 0;
  }
	if ($payment_id !=0 ) { 
	  $_db = new mysqli('localhost', LOGIN ,PASSWORD, 'YISGRAND');
	  if ($_db->connect_error) {
	  die('Connection Error (' . $_db->connect_errno . ') ' . $_db->connect_error);					
	  }
	  $_db->set_charset("utf8");
	  $sql_opl='CALL YISGRAND.OplataPaymentMarfin("'.$payment_id.'","'.$summa.'",@date_time, @success,  @msg)';
	  $result_opl = $_db->query($sql_opl) or die('Connect Error (' . $sql_opl . ') ' . $_db->connect_error);
	  $result_opl_callback='SELECT @date_time, @success,  @msg';
	  $res_opl_callback = $_db->query($result_opl_callback) or die('Connect Error in (' .  $result_opl_callback . ') ' . $_db->connect_error);
	  while ($res_row = $res_opl_callback->fetch_assoc()) {
	  $results['success'] = $res_row['@success'];
	  $results['msg']	=$res_row['@msg'];
	  $results['date_time']	=$res_row['@date_time'];
	  }
	  if ($results['success'] == "1") {
	      $response = array();
	      $response["txn_id"] = $payment_id;
	      $response["result"] = "10" ;
	      $response["message"] = $results['msg'];
	      $response["date_time"] =$results['date_time'];

	      } else  {
	      $response = array();
	      $response["txn_id"] = $payment_id;
	      $response["result"] = "21" ;
	      $response["message"] = $results['msg'];
	      $response["date_time"] =$results['date_time'];
	      }
	      print_r(json_encode($response));
    }else {
    
    return false;
    }
 } else {
	die('No Content Received From Datafeed');
} 
} else {
	die('No Content Received From Datafeed');
} 

?>