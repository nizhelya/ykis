<?php

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://stage-papi.xpay.com.ua/cipher',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{"Partner":{"PartnerToken":"8aff556f-1025-439a-8c7d-fda279523332","OperationType":10005},"Data":"{\\"PayType\\":\\"7\\",\\"Phone\\":\\"\\",\\"Email\\":\\"\\",\\"Account\\":\\"6314\\",\\"FirstName\\":\\"\\\\u0421\\\\u0435\\\\u0440\\\\u0433\\\\u0435\\\\u0439\\",\\"LastName\\":\\"\\\\u041d\\\\u0456\\\\u0436\\\\u0435\\\\u043b\\\\u044c\\\\u0441\\\\u044c\\\\u043a\\\\u0438\\\\u0439\\",\\"MiddleName\\":\\"\\\\u041e\\\\u043b\\\\u0435\\\\u043a\\\\u0441\\\\u0430\\\\u043d\\\\u0434\\\\u0440\\\\u043e\\\\u0432\\\\u0438\\\\u0447\\",\\"Service\\":[{\\"ServiceCode\\":\\"31783053\\",\\"Sum\\":19077},{\\"ServiceCode\\":\\"30750184\\",\\"Sum\\":3490}],\\"BillAttr\\":{\\"PayerAddress\\":\\"\\\\u0413\\\\u0440.\\\\u0414\\\\u0435\\\\u0441\\\\u0430\\\\u043d\\\\u0442\\\\u0443 21\\\\\\/71\\"},\\"Transaction\\":{\\"TransactionID\\":\\"8813\\",\\"TerminalID\\":\\"1\\",\\"DateTime\\":\\"2021-02-17 11:52:59\\"}}"}
',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'charset:utf-8'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
