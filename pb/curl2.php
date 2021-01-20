<?php

$url = "http://localhost/ykis/pb/pb.php";
//$url = "https://postman-echo.com/post";
$xml ="<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?>\n<Transfer xmlns=\"http://debt.privatbank.ua/Transfer\" interface=\"Debt\" action=\"Presearch\">\n\t<Data xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:type=\"Payer\">\n<Unit name=\"street\" value=\"213434\"/>\t\t\n<Unit name=\"house\" value=\"34\" />\n\t</Data>\n</Transfer>";  
 
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_SSL_VERIFYPEER=> 0,
  CURLOPT_SSL_VERIFYHOST=>0,

  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS =>array("xml" =>$xml),
));
header('Content-Type: text/json; charset=utf-8');

$response = curl_exec($curl);
/*
$array_data = json_decode($response);

$xmldata = json_encode(simplexml_load_string($array_data['data']));
*/
print_r($response);
curl_close($curl);

/*
function prv($var) {
    static $int=0;
    echo '<pre><b style="background: yellow;padding: 1px 5px;">'.$int.'</b> ';
    var_dump($var);
    echo '</pre>';
    $int++;
}
// Вы можете изменить тестовые данные ниже, если вы хотите проверить определенные поля.
// Например, вы можете установить его на зеркало
$XMLOutput1 = <<<XML
<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Transfer xmlns="http://debt.privatbank.ua/Transfer" interface="Debt" action="Presearch">
<Data xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:type="Payer">
<Unit name="street" value="837"/>		
<Unit name="house" value="26" />
<Unit name="flat" value="21" />
<Unit name="ls" value="" />
</Data>
</Transfer>
XML;

 
$xml ="<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?>\n<Transfer xmlns=\"http://debt.privatbank.ua/Transfer\" interface=\"Debt\" action=\"Presearch\">\n\t<Data xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:type=\"Payer\">\n<Unit name=\"street\" value=\"213434\"/>\t\t\n<Unit name=\"house\" value=\"34\" />\n\t</Data>\n</Transfer>";  
 
//$curl_file = curl_file_create('/var/www/html/ykis/pb/test.xml', 'text/xml' , 'test.xml');
//$url = "http://localhost/ykis/pb/pb1.php";
$url = "https://postman-echo.com/post";
//https://postman-echo.com/post

$channel = curl_init();
curl_setopt($channel, CURLOPT_URL, $url );//Это URL, который PHP должен получать. Вы можете также устанавливать эту опцию при инициализации сессии функцией curl_init().
curl_setopt($channel, CURLOPT_POST, TRUE);//Установите эту опцию в ненулевое значение, если вы хотите, чтобы PHP выполнял регулярный HTTP POST. 
curl_setopt($channel, CURLOPT_RETURNTRANSFER,1);//Передаёт ненулевое значение, если вы хотите, чтобы CURL непосредственно возвращала полученную информацию, вместо её печати напрямую.
curl_setopt($channel, CURLOPT_VERBOSE, TRUE);//Установите эту опцию в ненулевое значение, если вы хотите, чтобы CURL сообщала обо всех действиях.
//curl_setopt($channel, CURLOPT_SSLVERSION, 3);//Передаёт long как параметр, который содержит используемую версию SSL (2 или 3). 
//curl_setopt($channel, CURLOPT_HEADER, $headers);//Установите эту опцию в ненулевое значение, если вы хотите, чтобы шапка/header включалась в вывод.
//curl_setopt($channel, CURLOPT_POSTFIELDS, array('xml' => $curl_file)); //Передаёт строку, содержащую полные данные для передачи операцией HTTP "POST".
curl_setopt($channel, CURLOPT_POSTFIELDS, array("xmlData" => $XMLOutput1)); //Передаёт строку, содержащую полные данные для передачи операцией HTTP "POST".

//curl_setopt($channel, CURLINFO_HEADER_OUT, TRUE);// - Содержимое полученного заголовка Content-type, или NULL в случае, когда этот заголовок не был получен
curl_setopt($channel, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($channel, CURLOPT_SSL_VERIFYHOST, 0);


#curl_exec - выполняет CURL-сессию.
$result = curl_exec( $channel );


header('Content-Type: text/html; charset=utf-8');

if ($result === FALSE) {
    echo 'cURL Error: ' . curl_errno($channel);#curl_errno - возвращает целое число, содержащее номер последней ошибки.
    echo '<br>cURL ErrorNo: ' . curl_error($channel);#возвращает строку содержащую номер последней ошибки для текущей сессии.
    return;
} else {
	$array_data = simplexml_load_string(mb_convert_encoding($result, "UTF-8", "auto"));
  //echo 'cURL data: ' . $result;#curl_errno - возвращает целое число, содержащее номер последней ошибки.
	//$array_data = json_decode(json_encode(simplexml_load_string($result)), true);
	//print_r($array_data);//print mb_convert_encoding($result, "windows-1251", "auto")."<br>\n";
       //print_r($result);//print mb_convert_encoding($result, "windows-1251", "auto")."<br>\n";

// print mb_detect_encoding($result,"auto")."<br>\n"; 

}
curl_close( $channel );

*/
		
?>
