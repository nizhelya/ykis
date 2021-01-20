<?php 
function get_client_ip() {
     $ipaddress = '';
     if (isset($_SERVER['HTTP_CLIENT_IP']) AND ($_SERVER['HTTP_CLIENT_IP']))
         $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
     else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']) AND ($_SERVER['HTTP_X_FORWARDED_FOR']))
         $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
     else if(isset($_SERVER['HTTP_X_FORWARDED']) AND ($_SERVER['HTTP_X_FORWARDED']))
         $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
     else if(isset($_SERVER['HTTP_FORWARDED_FOR']) AND ($_SERVER['HTTP_FORWARDED_FOR']))
         $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
     else if(isset($_SERVER['HTTP_FORWARDED']) AND ($_SERVER['HTTP_FORWARDED']))
         $ipaddress = $_SERVER['HTTP_FORWARDED'];
     else if(isset($_SERVER['REMOTE_ADDR']) AND ($_SERVER['REMOTE_ADDR']))
         $ipaddress = $_SERVER['REMOTE_ADDR'];
     else
         $ipaddress = '10.1.0.104';
     return $ipaddress; 
}
$ip = get_client_ip();

switch ($ip) {
#Мой
case "127.0.0.1":
case "10.1.0.104":
#Artushkina
case "195.138.90.24":
case "195.138.87.207":

#УТиСЗН
case "178.93.2.148":
#Львова
case "10.3.1.70":
case "85.238.102.47";
case "213.174.21.193";
case "85.238.103.44";
#Офис
case "10.3.0.74":

#Младенова Ирина Петровна
case "185.177.242.96":

$login="cthubq";
$password = "hfljyt;crbq";

break;

}
 define('LOGIN',	$login);
 define('PASSWORD',	$password);
?>