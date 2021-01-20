<?php


$myURL = 'http://localhost/ykis/pb/pb.php';

// Вы можете изменить тестовые данные ниже, если вы хотите проверить определенные поля.
// Например, вы можете установить его на зеркало
$XMLOutput = <<<XML
<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Transfer action="Search" interface="Debt" xmlns="http://debt.privatbank.ua/Transfer">
<Data xsi:type="Payer" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
<Unit name="bill_identifier" value="1334"/>
</Data>
</Transfer>
XML;


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $myURL);
curl_setopt($ch, CURLOPT_POSTFIELDS, array("xmlData" => $XMLOutput));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
// Shared hosting users on GoDaddy or other hosts may need to uncomment the following lines:
// curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
// curl_setopt($ch, CURLOPT_PROXY,"http://64.202.165.130:3128"); // Replace this IP with whatever your host specifies.
// End shared hosting options
$response = curl_exec($ch);
/*
if ($response == false) {
  print "CURL Error: \n" . curl_error($ch);
} else {
  print "Response to customer save of \n";
}
*/
  print $response;

curl_close($ch);
 /*
$foxyResponse = simplexml_load_string($response);
print "<pre>";
var_dump($foxyResponse);
print "</pre>";
*/

?>