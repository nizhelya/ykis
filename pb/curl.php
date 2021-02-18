<?php
include_once 'XmlToArray.php';
include_once 'pb.config.php';
include_once 'PrivatBank.class.php';

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

$XMLOutput2 = <<<XML
<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Transfer xmlns="http://debt.privatbank.ua/Transfer" interface="Debt" action="Search">
<Data xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:type="Payer" presearchId="1338200416144048"/>
</Transfer>
XML;
$XMLOutput = <<<XML
<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Transfer action="Search" interface="Debt" xmlns="http://debt.privatbank.ua/Transfer">
<Data xsi:type="Payer" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance">
<Unit name="bill_identifier" value="1334"/>
</Data>
</Transfer>
XML;

//$xml = convertToStringArray($requestVars);
/*
 
$xml ='<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Transfer xmlns="http://debt.privatbank.ua/Transfer" interface="Debt" action="Presearch">
	<Data xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:type="Payer">
		<Unit name="ls" value="6314" />
	</Data>
</Transfer> ';  
*/  
//$curl_file = curl_file_create('/var/www/html/ykis/pb/test.xml', 'text/xml' , 'test.xml');
//$url = "http://localhost/ykis/pb/pb.php";
$url = "https://yis.yuzhny.com/kommuna/pb/pb.php";

$headers = array(
	'cache-control: max-age=0',
	'upgrade-insecure-requests: 1',
	'user-agent: Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.97 Safari/537.36',
	'sec-fetch-user: ?1',
	'accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3',
	'x-compress: null',
	'sec-fetch-site: none',
	'sec-fetch-mode: navigate',
	'accept-encoding: deflate, br',
	'accept-language: ru-RU,ru;q=0.9,en-US;q=0.8,en;q=0.7',
);

$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => $url,
  CURLOPT_RETURNTRANSFER => true, 
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSLVERSION => 3,
  CURLOPT_HEADER => $headers,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "<?xml version=\"1.0\" encoding=\"UTF-8\" standalone=\"yes\"?>\n<Transfer xmlns=\"http://debt.privatbank.ua/Transfer\" interface=\"Debt\" action=\"Presearch\">\n\t<Data xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xsi:type=\"Payer\">\n<Unit name=\"street\" value=\"213434\"/>\t\t\n<Unit name=\"house\" value=\"34\" />\n\t</Data>\n</Transfer>"
));
/*
curl_setopt($channel, CURLOPT_URL, $url );//Это URL, который PHP должен получать. Вы можете также устанавливать эту опцию при инициализации сессии функцией curl_init().
curl_setopt($channel, CURLOPT_POST, TRUE);//Установите эту опцию в ненулевое значение, если вы хотите, чтобы PHP выполнял регулярный HTTP POST. 
curl_setopt($channel, CURLOPT_RETURNTRANSFER,1);//Передаёт ненулевое значение, если вы хотите, чтобы CURL непосредственно возвращала полученную информацию, вместо её печати напрямую.
curl_setopt($channel, CURLOPT_VERBOSE, TRUE);//Установите эту опцию в ненулевое значение, если вы хотите, чтобы CURL сообщала обо всех действиях.
curl_setopt($channel, CURLOPT_HEADER, $headers);//Установите эту опцию в ненулевое значение, если вы хотите, чтобы шапка/header включалась в вывод.
curl_setopt($channel, CURLOPT_POSTFIELDS, array('xml' => $curl_file)); //Передаёт строку, содержащую полные данные для передачи операцией HTTP "POST".
//curl_setopt($channel, CURLOPT_POSTFIELDS, array("xmlData" => $XMLOutput1)); //Передаёт строку, содержащую полные данные для передачи операцией HTTP "POST".
//curl_setopt($channel, CURLINFO_HEADER_OUT, TRUE);// - Содержимое полученного заголовка Content-type, или NULL в случае, когда этот заголовок не был получен
curl_setopt($channel, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($channel, CURLOPT_SSL_VERIFYHOST, 0);

*/
#curl_exec - выполняет CURL-сессию.
$result = curl_exec( $curl );

//header('Content-Type: text/html; charset=utf-8');

if ($result === FALSE) {
    echo 'cURL Error: ' . curl_errno($curl);#curl_errno - возвращает целое число, содержащее номер последней ошибки.
    echo '<br>cURL ErrorNo: ' . curl_error($curl);#возвращает строку содержащую номер последней ошибки для текущей сессии.
    return;
} else {
	//$array_data = simplexml_load_string(mb_convert_encoding($result, "UTF-8", "auto"));
	print_r(htmlentities($result));

}
curl_close( $curl );
json: cannot unmarshal object into Go struct field Packet.Data of type string{"type":"rpc","tid":14,"action":"QueryPaymentMarfin","method":"newOplata","result":{"kvartplata":0,"otoplenie":0,"podogrev":0,"voda":0,"stoki":0,"tbo":0,"ptn":0,"payment_id":"8713","edrpou":"43760474","firstname":"\u0421\u0435\u0440\u0433\u0435\u0439","patronymic":"\u041e\u043b\u0435\u043a\u0441\u0430\u043d\u0434\u0440\u043e\u0432\u0438\u0447","surname":"\u041d\u0456\u0436\u0435\u043b\u044c\u0441\u044c\u043a\u0438\u0439","account":"6314","address":null,"data_in":"2021-02-13 22:14:48","success":0,"msg":"\u0421\u0435\u0440\u0432\u0456\u0441 \u043f\u043b\u0430\u0442\u0435\u0436\u0456\u0432 Xpay<br>\u041f\u043b\u0430\u0442\u0435\u0436 \u043d\u0435 \u0441\u0444\u043e\u0440\u043c\u043e\u0432\u0430\u043d\u0438\u0439"}}
		
?>