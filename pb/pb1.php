<?php
include_once 'pb.config.php';
$POST = array(); 
if($_SERVER['REQUEST_METHOD'] == 'POST') { 
header('Content-Type: text/xml; charset=utf-8');

    //print_r($_SERVER['REQUEST_METHOD']);  

  $result = file_get_contents('php://input'); 
  $array_data = json_decode(json_encode(simplexml_load_string($result)), true);
/*
  $exploded = explode('&',json_decode($putdata));  
  
  foreach($exploded as $pair) { 
    $item = explode('=', $pair); 
    if(count($item) == 2) { 
      $POST[urldecode($item[0])] = urldecode($item[1]); 
    } 
  } 
  */
  print_r($array_data);
} else {
	die('No Content Received From Datafeed');
}
 
 
?>