<?php
include_once 'XmlToArray.php';
include_once 'pb.config.php';
include_once 'PrivatBank.class.php';
include 'XmlToJson.class.php';

$url = "http://localhost/ykis/pb/test.xml";


print XmlToJson::Parse($url);

/*
$_db = new mysqli('localhost', 'cthubq' ,'hfljyt;crbq', 'YIS');
if ($_db->connect_error) {
die('Connection Error (' . $_db->connect_errno . ') ' . $_db->connect_error);
}
$_db->set_charset("utf8");


$sql_opl='CALL YISGRAND.PrivatBank_xml("'.$xml.'", @xmlOut,@succes)';
$result_opl = $_db->query($sql_opl) or die('Connect Error (' . $sql_opl . ') ' . $_db->connect_error);
$result_opl_callback='SELECT @xmlOut';
$res_opl_callback = $_db->query($result_opl_callback) or die('Connect Error in (' .  $result_opl_callback . ') ' . $_db->connect_error);
while ($res_row = $res_opl_callback->fetch_assoc()) {
$results['xml']	= $res_row['@xmlOut'];
$results['success']	=$res_row['@success'];
}
    
 */
?>