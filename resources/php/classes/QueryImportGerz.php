<?php
    
    $fileName = str2url($_FILES['filedata']['name']);
    $tmpName  = $_FILES['filedata']['tmp_name'];
    $fileSize = $_FILES['filedata']['size'];
    $fileType = $_FILES['filedata']['type'];
    //$tmp_dir=session_save_path().'/';
    $uploaddir = '/var/www/';
    $file_name = $uploaddir.$fileName;
    //echo 'Каталог для временных файлов: '.$file_name."<br>\n";
if(is_uploaded_file($_FILES['filedata']['tmp_name']))  {
    // Если файл загружен успешно, перемещаем его  из временной директории в конечную
    move_uploaded_file($_FILES["filedata"]["tmp_name"],$file_name);
  } else {
    echo("Ошибка загрузки файла");
  }

	 if($_FILES['filedata']['size'] > 1024*3*1024) {
	 echo ("Размер файла превышает три мегабайта");
	 exit;
	 } else {
            $obj = new QueryUpload();
            $active=$obj->upload($file_name);
            echo json_encode(array(
            "success" => true
            ));
            }


	function rus2translit($string) {
	$converter = array(
        'а' => 'a',   'б' => 'b',   'в' => 'v',
        'г' => 'g',   'д' => 'd',   'е' => 'e',
        'ё' => 'e',   'ж' => 'zh',  'з' => 'z',
        'и' => 'i',   'й' => 'y',   'к' => 'k',
        'л' => 'l',   'м' => 'm',   'н' => 'n',
        'о' => 'o',   'п' => 'p',   'р' => 'r',
        'с' => 's',   'т' => 't',   'у' => 'u',
        'ф' => 'f',   'х' => 'h',   'ц' => 'c',
        'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',
        'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',
        'э' => 'e',   'ю' => 'yu',  'я' => 'ya',
        
        'А' => 'A',   'Б' => 'B',   'В' => 'V',
        'Г' => 'G',   'Д' => 'D',   'Е' => 'E',
        'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',
        'И' => 'I',   'Й' => 'Y',   'К' => 'K',
        'Л' => 'L',   'М' => 'M',   'Н' => 'N',
        'О' => 'O',   'П' => 'P',   'Р' => 'R',
        'С' => 'S',   'Т' => 'T',   'У' => 'U',
        'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',
        'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',
        'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',
        'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
        );
        return strtr($string, $converter);
        }
	function str2url($str) {
	// переводим в транслит
	$str = rus2translit($str);
	// в нижний регистр
	$str = strtolower($str);
	// заменям все ненужное нам на "-"
	$str = preg_replace('~[^-.a-z0-9_]+~u', '-', $str);
	// удаляем начальные и конечные '-'
	$str = trim($str, "-");
	return $str;
	}
	
	
class QueryUpload
{
	private $_db;	
	public $results;
	
	public function __construct()
	{
		//                 'hostname', 'username' ,'password', 'database'
		$_db = new mysqli('localhost', 'cthubq' ,'hfljyt;crbq', 'YISGRAND');
		
		if ($_db->connect_error) {
			return false;
		} else {		
		$_db->set_charset("utf8");    
		return $_db;
		}
	}

	
     
	
	public function upload($name)
	{

		$_db = $this->__construct();	
				$_sql_trancate ='TRUNCATE TABLE YISGRAND.GERZ_IMPORT'; 
				$_result_trancate = $_db->query($_sql_trancate) or die('Connect Error (' . $_db->connect_errno . ') ' . $_db->connect_error);
		 
		 $terminated=";";
		 $enclosed='"';
		 $escaped="\\\\";
		 $line="\\n";
		//print($name);

		 $_sql_update='LOAD  DATA INFILE "'.$name.'" REPLACE INTO TABLE YISGRAND.GERZ_IMPORT  FIELDS TERMINATED BY "'.$terminated.'" ENCLOSED BY \''.$enclosed.'\' ESCAPED BY "'.$escaped.'" LINES TERMINATED BY "'.$line.'"  IGNORE 1 LINES (rec_id,gerz_id,firma_id,org_id,usluga_id,address_id, @Pdate,@Date_ob,@Dateb,fio,rec1,rec2,rec3,rec4,rec5,rec6,rec7, rec8, rec9,rec10,summa,summap) SET pdate = STR_TO_DATE(@Pdate, "%d.%m.%Y"),date_ob = STR_TO_DATE(@Date_ob, "%d.%m.%Y"),sdate = STR_TO_DATE(@Dateb, "%d.%m.%Y")';
		 		//print($_sql_update);

		$_result = $_db->query($_sql_update) or die('Connect Error (' . $name . ') ' . $_db->connect_error);
		 
		
		    $_sql='CALL YISGRAND.input_gerz(@success, @msg)';
		    $_results = $_db->query($_sql) or die('Connect Error (' . $_db->connect_error . ') ' . $_db->connect_error);
		    
		    
		 //$rows=mysqli_affected_rows($_db);
		
		 return true;
		
	}
}
?>
     
      
	
   