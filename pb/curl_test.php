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

$pb = new PrivatBank(  MID , MKEY ,SKEY );
$pb->set_urls('http://localhost/ykis/pb/test.php','http://localhost/ykis/pb/test.php');
$pb->set_mode('test');
$pb->set_transaction(492,25.36 ,'Квартплата',601);
$pb->set_transaction(492,350.36 ,'Отопление',101);
$pb->set_transaction(492,120.00 ,'Подогрев',102);
$pb->set_transaction(492,253.12 ,'Вода',201);
$pb->set_transaction(492,222.11 ,'Стоки',202);
$xml_result = $pb->create_payment();



$requestVars = array(
'id' => array(1, 2,"id"=>1234),
'name' => "log",
'logfile' => "@/var/www/html/pb.xml");

$xml = convertToStringArray($requestVars);
/*
 
$xml ='<?xml version="1.0" encoding="UTF-8" standalone="yes"?>
<Transfer xmlns="http://debt.privatbank.ua/Transfer" interface="Debt" action="Presearch">
	<Data xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:type="Payer">
		<Unit name="ls" value="6314" />
	</Data>
</Transfer> ';  
*/  
//$url = "http://localhost/ykis/pb/pb.php";
$url = "http://localhost/ykis/pb/test.php";
//$url = "https://yis.yuzhny.com/kommuna/pb/pb.php";


$channel = curl_init();
curl_setopt($channel, CURLOPT_URL, $url );//Это URL, который PHP должен получать. Вы можете также устанавливать эту опцию при инициализации сессии функцией curl_init().
curl_setopt($channel, CURLOPT_POST, TRUE);//Установите эту опцию в ненулевое значение, если вы хотите, чтобы PHP выполнял регулярный HTTP POST. 
curl_setopt($channel, CURLOPT_RETURNTRANSFER, TRUE);//Передаёт ненулевое значение, если вы хотите, чтобы CURL непосредственно возвращала полученную информацию, вместо её печати напрямую.
curl_setopt($channel, CURLOPT_VERBOSE, TRUE);//Установите эту опцию в ненулевое значение, если вы хотите, чтобы CURL сообщала обо всех действиях.
//curl_setopt($channel, CURLOPT_SSLVERSION, 3);//Передаёт long как параметр, который содержит используемую версию SSL (2 или 3). 
curl_setopt($channel, CURLOPT_HEADER, TRUE);//Установите эту опцию в ненулевое значение, если вы хотите, чтобы шапка/header включалась в вывод.
curl_setopt($channel, CURLOPT_POSTFIELDS, $xml );//Передаёт строку, содержащую полные данные для передачи операцией HTTP "POST".
//curl_setopt($channel, CURLINFO_HEADER_OUT, TRUE);// - Содержимое полученного заголовка Content-type, или NULL в случае, когда этот заголовок не был получен
curl_setopt($channel, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($channel, CURLOPT_SSL_VERIFYHOST, 0);


#curl_exec - выполняет CURL-сессию.
$result = curl_exec( $channel );
prv(curl_getinfo($channel,CURLINFO_HEADER_OUT));
//prv(curl_getinfo($channel,CURLINFO_EFFECTIVE_URL));// Последний использованный URL
prv(curl_getinfo($channel,CURLINFO_HTTP_CODE));//Последний полученный код HTTP
//prv(curl_getinfo($channel,CURLINFO_CONTENT_LENGTH_DOWNLOAD));//Размер закачиваемых данных
//prv(curl_getinfo($channel,CURLINFO_CONTENT_TYPE));//Содержимое полученного заголовка Content-type, или NULL в случае, когда этот заголовок не был получен
//prv(curl_getinfo($channel,CURLINFO_FILETIME));//Дата модификации загруженного документа, если она неизвестна, возвращается -1.
prv(curl_getinfo($channel,CURLINFO_CONNECT_TIME));//Время, затраченное на установку соединения, в секундах
prv(curl_getinfo($channel,CURLINFO_SSL_VERIFYRESULT));//Результат проверки SSL сертификата, запрошенной с помощью установки параметра CURLOPT_SSL_VERIFYPEER



if ($result === FALSE) {
    echo 'cURL Error: ' . curl_errno($channel);#curl_errno - возвращает целое число, содержащее номер последней ошибки.
    echo '<br>cURL ErrorNo: ' . curl_error($channel);#возвращает строку содержащую номер последней ошибки для текущей сессии.
    return;
} else {
prv($result);
 //print mb_detect_encoding($result,"auto")."<br>\n"; //опре
//print mb_convert_encoding($result, "windows-1251", "auto")."<br>\n";
// print mb_detect_encoding($result,"auto")."<br>\n"; 

}
curl_close( $channel );
/*
#curl_setopt - устанавливает опции для CURL-трансфера/transfer.

#curl_setopt($channel, CURLOPT_INFILESIZE, TRUE);//Если вы выгружаете файл на удалённый сайт, эта опция должна использоваться, для того чтобы сообщит PHP, какой будет ожидаемый размер infile.
#curl_setopt($channel, CURLOPT_PUT, TRUE);//Установите эту опцию в ненулевое значение, чтобы HTTP PUT файл. Файл для PUT обязан быть установлен с помощью CURLOPT_INFILE и CURLOPT_INFILESIZE.
#curl_setopt($channel, CURLOPT_VERBOSE, FALSE);//Установите эту опцию в ненулевое значение, если вы хотите, чтобы CURL сообщала обо всех действиях.
#curl_setopt($channel, CURLOPT_HEADER, FALSE);//Установите эту опцию в ненулевое значение, если вы хотите, чтобы шапка/header включалась в вывод.
#curl_setopt($channel, CURLOPT_NOPROGRESS, FALSE);// Установите эту опцию в ненулевое значение, если вы не хотите, чтобы PHP выводил индикатор процесса CURL-трансфера. 
//(PHP автоматически устанавливает эту опцию в ненулевое значение, изменять её необходимо лишь при отладке.)
#curl_setopt($channel, CURLOPT_NOBODY, TRUE);//Установите эту опцию в ненулевое значение, если вы не хотите, чтобы тело/body включалось в вывод.
#curl_setopt($channel, CURLOPT_FAILONERROR, FALSE);//Установите эту опцию в ненулевое значение, если вы хотите, чтобы PHP завершал работу скрыто, 
//если возвращаемый HTTP-код имеет значение выше 300. По умолчанию страница возвращается нормально с игнорированием кода.
#curl_setopt($channel, CURLOPT_UPLOAD, TRUE); //Установите эту опцию в ненулевое значение, если вы хотите, чтобы PHP подготавливал файл к выгрузке.
#curl_setopt($channel, CURLOPT_POST, TRUE);//Установите эту опцию в ненулевое значение, если вы хотите, чтобы PHP выполнял регулярный HTTP POST. 
//Этот POST имеет нормальный вид application/x-www-form-urlencoded, чаще всего используемый HTML-формами.
#curl_setopt($channel, CURLOPT_FTPLISTONLY, FALSE );//Установите эту опцию в ненулевое значение, и PHP будет выводит листинг имён FTP-директории.
#curl_setopt($channel, CURLOPT_FTPAPPEND, FALSE);//Установите эту опцию в ненулевое значение, и PHP будет присоединять к удалённому/remote файлу, вместо его перезаписи.
#curl_setopt($channel, CURLOPT_NETRC, FALSE);//Установите эту опцию в ненулевое значение, и PHP будет сканировать ваш файл ~./netrc с целью поиска 
//ваших username и password для удалённого сайта, с которым вы устанавливаете соединение.
#curl_setopt($channel, CURLOPT_FOLLOWLOCATION, FALSE);//Установите эту опцию в ненулевое значение, чтобы следовать любому "Location: " header, который сервер высылает 
//как часть HTTP header"а (заметьте, что это рекурсия, PHP будет следовать за всеми "Location: "-header"ами, которые высылаются.)
#curl_setopt($channel, CURLOPT_MUTE, FALSE);//Установите эту опцию в ненулевое значение, и PHP будет работать скрыто в отношении CURL-функций.
#curl_setopt($channel, CURLOPT_TIMEOUT, 30);//Передаёт long как параметр, который содержит максимальное время в секундах, которое вы отводите для работы CURL-функций.
#curl_setopt($channel, CURLOPT_CONNECTTIMEOUT, 0);//Передаёт long как параметр, который содержит максимальное время в секундах, которое вы отводите для ожидания 
//при попытке подключения. Используйте 0 чтобы ждать бесконечно.
#curl_setopt($channel, CURLOPT_LOW_SPEED_LIMIT, 30);//Передаёт long как параметр, который содержит скорость трансфера в байтах в секунду, ниже которого трансфер должен работать в процессе 
//выполнения CURLOPT_LOW_SPEED_TIME, в секундах, чтобы PHP считал его слишком медленным и прерывал его.
#curl_setopt($channel, CURLOPT_LOW_SPEED_TIME, 30);//Передаёт long как параметр, который содержит время в секундах, ниже которого трансфер должен работать в процессе выполнения 
//CURLOPT_LOW_SPEED_LIMIT, чтобы PHP считал его слишком медленным и прерывал его.
#curl_setopt($channel, CURLOPT_RESUME_FROM, 30);//Передаёт long как параметр, который содержит смещение в байтах, с которого трансфер должен стартовать.
#curl_setopt($channel, CURLOPT_SSLVERSION, 3);//Передаёт long как параметр, который содержит используемую версию SSL (2 или 3). 
//По умолчанию PHP пытается определить это сам, хотя в некоторых случаях вы обязаны устанавливать это вручную.
#curl_setopt($channel, CURLOPT_SSL_VERIFYHOST, 1);//Передаёт long, если CURL должна проверять Common-имя peer-сертификата в SSL handshake/"рукопожатие". 
//Значение 1 указывает, что мы должны проверить существование общего /common имени, значение 2 указывает, что мы должны убедиться в совпадении с предоставленным hostname.
#curl_setopt($channel, CURLOPT_TIMECONDITION, 0);//Передаёт long как параметр, который определяет, как рассматривается CURLOPT_TIMEVALUE.
//Вы можете установить этот параметр для TIMECOND_IFMODSINCE или TIMECOND_ISUNMODSINCE. Это действует только для HTTP.
#curl_setopt($channel, CURLOPT_TIMEVALUE, 12121212);// Передаёт long как параметр, который является временем в секундах, 
//прошедшим после 1 января 1970. Это время используется, как специфицировано опцией CURLOPT_TIMEVALUE, или по умолчанию будет использоваться TIMECOND_IFMODSINCE.
#curl_setopt($channel, CURLOPT_RETURNTRANSFER, TRUE);//Передаёт ненулевое значение, если вы хотите, чтобы CURL непосредственно возвращала полученную информацию, вместо её печати напрямую.

Параметр value должен быть строкой для следующих значений параметра option:

#curl_setopt($channel, CURLOPT_URL, $url );//Это URL, который PHP должен получать. Вы можете также устанавливать эту опцию при инициализации сессии функцией curl_init().
#curl_setopt($channel, CURLOPT_POSTFIELDS, $xml_data );//Передаёт строку, содержащую полные данные для передачи операцией HTTP "POST".
#curl_setopt($channel, CURLOPT_USERPWD, $user );//Передаёт в РНР строку, отформатированную в виде [username]:[password], для использования при соединении.
#curl_setopt($channel, CURLOPT_PROXYUSERPWD, $user );//Передаёт в РНР строку, отформатированную в виде [username]:[password], для соединения с HTTP-прокси.
#curl_setopt($channel, CURLOPT_REFERER, $refer );//Передаёт строку, содержащую "referer/ссылающийся" header, используемый в HTTP-запросе.
#curl_setopt($channel, CURLOPT_USERAGENT, $agent );//Передаёт строку, содержащую "user-agent" header, используемый в HTTP-запросе.
#curl_setopt($channel, CURLOPT_FTPPORT, $agent );//Передаёт строку, содержащую значение, которое будет использоваться для получения IP-адреса для инструкции ftp "POST".
//POST-инструкция указывает удалённому серверу: соединиться со специфицированным IP-адресом. Строка может быть обычным IP-адресом, 
//hostname/именем хоста, именем сетевого интерфейса (под UNIX), или просто обычным "-", используемым для системного IP-адреса по умолчанию.
#curl_setopt($channel, CURLOPT_COOKIE, $cookie );//Передаёт строку с содержимым куки/cookie, установленным в HTTP header
#curl_setopt($channel, CURLOPT_SSLCERT, $sert );//Передаёт строку, содержащую filename форматированного сертификата PEM.
#curl_setopt($channel, CURLOPT_SSLCERTPASSWD, $spass );//Передаёт строку, содержащую password, необходимый для работы сертификата CURLOPT_SSLCERT.
#curl_setopt($channel, CURLOPT_COOKIEFILE, $filename );//Передаёт строку, содержащую имя файла с данными куки. Этот cookie-файл может иметь формат Netscape, 
//или содержать обычные шапки/headers в HTTP-стиле, забитые в файл.
#curl_setopt($channel, CURLOPT_CUSTOMREQUEST, $spass );//Передаёт строку, используемую вместо GET или HEAD при выполнении HTTP-запроса. 
//Это делается для выполнения DELETE или других, более скрытых HTTP-запросов. Верными значениями являются GET, POST и так далее; 
//то есть не вводите здесь полную строку HTTP-запроса. Например, ввод "GET /index.html HTTP/1.0" будет некорректным. (не делайте это, если не уверены, что ваш сервер поддерживает эту команду.)
#curl_setopt($channel, CURLOPT_PROXY, $name );//Передаёт имя HTTP-прокси туннельным запросам.
#curl_setopt($channel, CURLOPT_INTERFACE, $extip );//Передаёт имя исходящего сетевого интерфейса для использования. Это может быть имя интерфейса, IP-адрес или имя хоста.
#curl_setopt($channel, CURLOPT_KRB4LEVEL, $clear );//Передаёт KRB4 (Kerberos 4) уровень секретности. Это любая из следующих строк (в порядке от менее до более мощной): "clear", "safe", "confidential", //"private". Если эта строка не совпадает с какой-либо из указанных, то используется "private". Если вы установите здесь NULL, это отключит KRB4-безопасность. 
//KRB4-безопасность работает в настоящее время только с транзакциями FTP.
#curl_setopt($channel, CURLOPT_HTTPHEADER, $header );//Передаёт массив полей HTTP-headerа для установки.
#curl_setopt($channel, CURLOPT_QUOTE, $header );//Передаёт массив FTP-команд для выполнения на сервере до выполнения FTP-запроса.
#curl_setopt($channel, CURLOPT_POSTQUOTE, $header );//Передаёт массив FTP-команд для выполнения на сервере после выполнения FTP-запроса. 
#curl_setopt($channel, CURLOPT_SSL_VERIFYPEER, FALSE);
#curl_setopt($channel, CURLOPT_SSL_VERIFYHOST, FALSE);
#curl_setopt($channel, CURLOPT_MAXREDIRS,1);


#curl_setopt($channel, CURLINFO_HEADER_OUT, true);	// если этот параметр не указать не работает!
Возвращает информацию о последней операции, opt может быть одной из следующих констант: 
    CURLINFO_EFFECTIVE_URL - Последний использованный URL
    CURLINFO_HTTP_CODE - Последний полученный код HTTP
    CURLINFO_FILETIME - Дата модификации загруженного документа, если она неизвестна, возвращается -1.
    CURLINFO_TOTAL_TIME - Полное время выполнения операции в секундах.
    CURLINFO_NAMELOOKUP_TIME - Время разрешения имени сервера в секундах.
    CURLINFO_CONNECT_TIME - Время, затраченное на установку соединения, в секундах
    CURLINFO_PRETRANSFER_TIME - Время, прошедшее от начала операции до готовности к фактической передаче данных, в секундах
    CURLINFO_STARTTRANSFER_TIME - Время, прошедшее от начала операции до момента передачи первого байта данных, в секундах
    CURLINFO_REDIRECT_TIME - Общее время, затраченное на перенапрвления, в секундах
    CURLINFO_SIZE_UPLOAD - Количество байт при закачке
    CURLINFO_SIZE_DOWNLOAD - Количество байт при загрузке
    CURLINFO_SPEED_DOWNLOAD - Средняя скорость закачки
    CURLINFO_SPEED_UPLOAD - Средняя скорость загрузки
    CURLINFO_HEADER_SIZE - Суммарный размер всех полученных заголовков
    CURLINFO_REQUEST_SIZE - Суммарный размер всех отправленных запросов, в настоящее время используется только для HTTP запросов
    CURLINFO_SSL_VERIFYRESULT - Результат проверки SSL сертификата, запрошенной с помощью установки параметра CURLOPT_SSL_VERIFYPEER
    CURLINFO_CONTENT_LENGTH_DOWNLOAD - размер загруженного документа, прочитанный из заголовка Content-Length
    CURLINFO_CONTENT_LENGTH_UPLOAD - Размер закачиваемых данных
    CURLINFO_CONTENT_TYPE - Содержимое полученного заголовка Content-type, или NULL в случае, когда этот заголовок не был получен
*/

		
?>