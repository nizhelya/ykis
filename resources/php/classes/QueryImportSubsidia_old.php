<?php

class QueryUpload
{
	private $_db;	
	public $results;
	
	public function __construct()
	{
		//                 'hostname', 'username' ,'password', 'database'
		$_db = new mysqli('localhost', 'cthubq' ,'hfljyt;crbq', 'YISGRAND');
		
		if ($_db->connect_error) {
			die('Connection Error (' . $_db->connect_errno . ') ' . $_db->connect_error);
		}
		$_db->set_charset("utf8");
    
		return $_db;
	}

	function import_dbf($name,$dbf_file)
{

$_db = $this->__construct();	

	switch(strtoupper($name))
	{
	
	
	case "UTKE.DBF":
				$_sql_trancate ='TRUNCATE TABLE YIS.SUB_TEPLO'; 
				$_result_trancate = $_db->query($_sql_trancate) or die('Connect Error (' . $_db->connect_errno . ') ' . $_db->connect_error);
				$table="YIS.SUB_TEPLO";
	break;
	case "ютке.DBF":
				
				$_sql_trancate ='TRUNCATE TABLE YIS.SUB_TEPLO'; 
				$_result_trancate = $_db->query($_sql_trancate) or die('Connect Error (' . $_db->connect_errno . ') ' . $_db->connect_error);
				$table="YIS.SUB_TEPLO";
	break;
	case "OTOPLENIE.DBF":
				$_sql_trancate ='TRUNCATE TABLE YIS.SUB_OTOPL'; 
				$_result_trancate = $_db->query($_sql_trancate) or die('Connect Error (' . $_db->connect_errno . ') ' . $_db->connect_error);
				$table="YIS.SUB_OTOPL";
	break;
	case "PTN.DBF":
				$_sql_trancate ='TRUNCATE TABLE YIS.SUB_PTN'; 
				$_result_trancate = $_db->query($_sql_trancate) or die('Connect Error (' . $_db->connect_errno . ') ' . $_db->connect_error);
				$table="YIS.SUB_PTN";
	break;
	case "VIK.DBF":
				$_sql_trancate ='TRUNCATE TABLE YIS.SUB_VODA'; 
				$_result_trancate = $_db->query($_sql_trancate) or die('Connect Error (' . $_db->connect_errno . ') ' . $_db->connect_error);
				$table="YIS.SUB_VODA";
	break;
	case "южводоканал.DBF":
				$_sql_trancate ='TRUNCATE TABLE YIS.SUB_VODA'; 
				$_result_trancate = $_db->query($_sql_trancate) or die('Connect Error (' . $_db->connect_errno . ') ' . $_db->connect_error);
				$table="YIS.SUB_VODA";	break;
	case "UGTRANS.DBF":
				$_sql_trancate ='TRUNCATE TABLE YIS.SUB_TBO'; 
				$_result_trancate = $_db->query($_sql_trancate) or die('Connect Error (' . $_db->connect_errno . ') ' . $_db->connect_error);
				$table="YIS.SUB_TBO";
	break;
	case "южтранс.DBF":
				
				$_sql_trancate ='TRUNCATE TABLE YIS.SUB_TBO'; 
				$_result_trancate = $_db->query($_sql_trancate) or die('Connect Error (' . $_db->connect_errno . ') ' . $_db->connect_error);
				$table="YIS.SUB_TBO";
	break;
	
}
	 $terminated=";";
		 $enclosed='"';
		 $escaped="\\\\";
		 $line="\\n";

if (!$dbf = dbase_open ($dbf_file, 0)){ die("Could not open $dbf_file for import."); }
$num_rec = dbase_numrecords($dbf);
$num_fields = dbase_numfields($dbf);
$fields = array();
//$this->results = $num_rec;

switch(strtoupper($name))
	{
	case "UTKE.DBF":
	case "южтранс.DBF":
	case "VIK.DBF":
	case "ютке.DBF":
	case "UGTRANS.DBF":
	case "южводоканал.DBF":
	
	for ($i=1; $i<=$num_rec; $i++){
	$row = @dbase_get_record_with_names($dbf,$i);
	$this->results = $row;
	$q = 'INSERT INTO '.$table.' (`address_id`,`data1`,`data2` ,`kvartplata`, `otoplenie`,`podogrev`,`voda`, `tbo`, `stoki`,`kv`, `ot`,`gv`,`xv`,`tb`,`st`,`summa`,`pr` )  values (';
	foreach ($row as $key => $val){
	if (  $key == 'RASH' OR $key == 'DAT1' OR $key == 'DAT2'  OR $key == 'SM1' OR  $key == 'SM2' OR $key == 'SM3' OR $key == 'SM4' OR $key == 'SM7' OR $key == 'SM8' OR $key == 'OB1' OR $key == 'OB2' OR
	$key == 'OB3' OR $key == 'OB4' OR $key == 'OB7' OR $key == 'OB8'  OR $key == 'SUMMA' OR $key == 'MON'){ 
	$q .= "'" . addslashes(trim($val)) . "',"; 
	}
	
	
	}
	$q = substr($q, 0, -1);
	$q .= ')';
	$_result = $_db->query($q) or die('Connect Error (' . $_db->connect_errno . ') ' . $_db->connect_error);
	}

	break;
	case "OTOPLENIE.DBF":	
	case "PTN.DBF":
	for ($i=1; $i<=$num_rec; $i++){
	$row = @dbase_get_record_with_names($dbf,$i);
	$this->results = $row;
	$q = 'INSERT INTO '.$table.' (`address_id`,`summa` )  values (';
	foreach ($row as $key => $val){
	if (  $key == 'N1' OR $key ==  'N2' ){ 
	$q .= "'" . addslashes(trim($val)) . "',"; 
	}
	
	}
	$q = substr($q, 0, -1);
	$q .= ')';
	$_result = $_db->query($q) or die('Connect Error (' . $_db->connect_errno . ') ' . $_db->connect_error);
	}
	break;
}


     return $this->results;
}

}	
    $fileName = $_FILES['filedata']['name'];
    $tmpName  = $_FILES['filedata']['tmp_name'];
    $fileSize = $_FILES['filedata']['size'];
    $fileType = $_FILES['filedata']['type'];
	  $table = 'YIS.SUB_'.$fileName.''; 


   // Проверяем загружен ли файл
   if(is_uploaded_file($_FILES['filedata']['tmp_name']))
   {
     // Если файл загружен успешно, перемещаем его
     // из временной директории в конечную
     move_uploaded_file($_FILES["filedata"]["tmp_name"], "/tmp/".$_FILES["filedata"]["name"]);
   } else {
      echo("Ошибка загрузки файла");
   }
	//	print($fileName);
	//	print($tmpName);
	//	print($fileSize);

	 if($_FILES['filedata']['size'] > 1024*3*1024)
   {
     echo ("Размер файла превышает три мегабайта");
     exit;
   } else {
            $obj = new QueryUpload();
						$active=$obj->import_dbf($fileName,'/tmp/'.$fileName);
					echo json_encode(array("success" => true));
		}
