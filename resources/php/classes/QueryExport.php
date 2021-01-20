<?php

class QueryExport
{
	private $_db;
	protected $_result;
	protected $_visit;
	protected $_msg;
	protected $_stmt;
	protected $_id;
	protected $login;
	protected $password;
	protected $smtp = "91.192.128.1"; // SMTP сервер
	protected $reply_email ='yis@yuzhny.com';
	protected $name_send='Южненская Коммунальная Информационная Система -ЮКИС';
	protected $msg_html ; 
	protected $msg_txt ; 
	protected $_mphone;
	protected $address;
	protected $address_id;
	protected $user_id;
	protected $sql;
	public $results;

	
	
					public function connect($login,$password)
					{
						//                 'hostname', 'username' ,'password', 'database'
						$_db = new mysqli('localhost', $login ,$password, 'YISGRAND');
						if ($_db->connect_error) {
							return false;
						} else {		
						$_db->set_charset("utf8");    
						return $_db;
						}
					}
							
	public function getResults(stdClass $params)
	{
						
					if(isset($params->login) && ($params->login)) {
							$this->login= addslashes($params->login);
					} else {
						$this->login= null;
					}		
					if(isset($params->password) && ($params->password)) {
						$this->password= $params->password;
					} else {
						$this->password= null;
					}

					$_db = $this->connect($this->login,$this->password);

			
		switch ($_what) {
		 
		     case "registration":
			$_sql='SELECT user_id,login,surname,firstname,lastname,email,mphone,role,active,visit,remember FROM YISGRAND.USERS WHERE YISGRAND.USERS.user_id='.$_id.''; 
			//print($_sql);    
		    break;
		      case "login":
			$_sql='SELECT user_id,login,surname,firstname,lastname,email,mphone,role,active,visit,remember FROM YISGRAND.USERS WHERE YISGRAND.USERS.user_id='.$_id.''; 
			//print($_sql);    
		    break;
	    
		    case "activation":
			$_sql='SELECT user_id,login,surname,firstname,lastname,email,mphone,role,active,visit,remember FROM YISGRAND.USERS WHERE YISGRAND.USERS.login="'.$_login.'" and YISGRAND.USERS.keysend="'.$_keysend.'"'; 
			//$_sql='SELECT user_id,login,surname,firstname,lastname,email,mphone,role,active,visit,remember FROM USERS WHERE login="'.$_login.'"'; 
			//print($_sql);    
		    break;
				
		} // End of Switch ($what)
		
		
		
		$_db = $this->__construct();
		
		
		$_result = $_db->query($_sql) or die('Connect Error (' . $_db->connect_errno . ') ' . $_db->connect_error);
		$rows=mysqli_affected_rows($_db);
		$_array=array();
		$results = array();		
		if($rows){
		    while ($row = $_result->fetch_assoc()) {			
			array_push($_array, $row);
			$results['success']= true;
			$results['data']= $_array;
		   }
		}else{
			$results['success']	= false;
			
		}
		
		
		return $results;
	}
	public function exportToEmail(stdClass $params)
	{
						function utf8_2_win1251 ($str_src)
							{
							$str_dst = "";
							$i = 0;
							while ($i<strlen($str_src))
							{
							$code_dst = 0;
							$code_src1 = ord($str_src[$i]);
							$i++;

							if ($code_src1<=127)
							{
							$str_dst .= chr($code_src1);
							continue;
							}
							else
							if (($code_src1 & 0xE0) == 0xC0)
							{
							$code_src2 = ord($str_src[$i++]);
							if (($code_src2 & 0xC0) != 0x80)
							continue;

							$code_dst = ( ($code_src1 & 0x1F) << 6) + ($code_src2 & 0x3F);
							}
							else
							if (($code_src1 & 0xF0) == 0xE0)
							{
							$code_src2 = ord($str_src[$i++]);
							if (($code_src2 & 0xC0) != 0x80)
							continue;

							$code_src3 = ord($str_src[$i++]);
							if (($code_src3 & 0xC0) != 0x80)
							continue;

							$code_dst = ( ($code_src1 & 0x1F) << 12) + ( ($code_src2 & 0x3F) << 6) + ($code_src3 & 0x3F);
							}
							else
							if (($code_src1 & 0xF8) == 0xF0)
							{
							$code_src2 = ord($str_src[$i++]);
							if (($code_src2 & 0xC0) != 0x80)
							continue;

							$code_src3 = ord($str_src[$i++]);
							if (($code_src3 & 0xC0) != 0x80)
							continue;

							$code_src4 = ord($str_src[$i++]);
							if (($code_src4 & 0xC0) != 0x80)
							continue;

							$code_dst = ( ($code_src1 & 0x1F) << 18) + ( ($code_src2 & 0x3F) << 12) + ( ($code_src3 & 0x3F) << 6) + ($code_src4 & 0x3F);
							}
							else
							{
							continue;
							}

							if ($code_dst)
							{
							if ($code_dst==0x401)
							{ 
							$str_dst .= "";
							} 
							else
							if ($code_dst==0x451)
							{ 
							$str_dst .= "";
							} 
							else 
							if ( ($code_dst>=0x410) && ($code_dst<=0x44F) )
							{ 
							$str_dst .= chr ($code_dst-848);
							}
							else
							$str_dst .= "&#{$code_dst};";
							}
							}
							return $str_dst;
							} 
					if(isset($params->login) && ($params->login)) {
							$this->login= addslashes($params->login);
					} else {
						$this->login= null;
					}		
					if(isset($params->password) && ($params->password)) {
						$this->password= $params->password;
					} else {
						$this->password= null;
					}
					if(isset($params->what) && ($params->what)) {
					$this->what = $params->what;
					} else {
						$this->what = null;
						}
					$_db = $this->connect($this->login,$this->password);

					$array = (array) $params;
					foreach ( $array as $key => $value ) 
						{
						if(isset($value)) { 
								if (is_int($value)) { $this->$key= (int)$value;}
								else if (is_float($value)) { $this->$key= $value;}
								else {$this->$key =$_db->real_escape_string($value);}
						}
					}
					$_db = $this->connect($this->login,$this->password);

					require("../phpmailer/class.phpmailer.php");
//print($this->what);
					switch ($this->what) {
					case "ExportEmail":
					switch($this->vibor)
					{
						
						case 'otoplenie':
						$filename = "/tmp/otoplen.dbf";
						$this->sql='SELECT t1.`CDPR`,t1.`IDCODE`,t1.`FIO`,t1.`PPOS`,t1.`RS`,t1.`YEARIN`,t1.`MONTHIN`,t1.`LGCODE`,t1.`DATA1`,t1.`DATA2`,
						t1.`LGKOL`,t1.`LGKAT`,t1.`LGPRC`,t1.`SUMM`,t1.`FACT`,t1.`TARIF`,t1.`FLAG` FROM YISGRAND.DBF_OTOPLENIE as t1 
						WHERE  t1.`data` =CONCAT(EXTRACT(YEAR_MONTH FROM "'.$this->data.'"),"01")';						break;
						case 'voda':
						$filename = "/tmp/voda.dbf";
						$this->sql='SELECT t1.`CDPR`,t1.`IDCODE`,t1.`FIO`,t1.`PPOS`,t1.`RS`,t1.`YEARIN`,t1.`MONTHIN`,t1.`LGCODE`,t1.`DATA1`,t1.`DATA2`,
						t1.`LGKOL`,t1.`LGKAT`,t1.`LGPRC`,t1.`SUMM`,t1.`FACT`,t1.`TARIF`,t1.`FLAG` FROM YISGRAND.DBF_VODA as t1 
						WHERE  t1.`data` =CONCAT(EXTRACT(YEAR_MONTH FROM "'.$this->data.'"),"01")';
						break;	
							
						case 'tbo':
						$filename = "/tmp/tbo.dbf";
						$this->sql='SELECT t1.`CDPR`,t1.`IDCODE`,t1.`FIO`,t1.`PPOS`,t1.`RS`,t1.`YEARIN`,t1.`MONTHIN`,t1.`LGCODE`,t1.`DATA1`,t1.`DATA2`,
						t1.`LGKOL`,t1.`LGKAT`,t1.`LGPRC`,t1.`SUMM`,t1.`FACT`,t1.`TARIF`,t1.`FLAG` FROM YISGRAND.DBF_TBO as t1 
						WHERE  t1.`data` =CONCAT(EXTRACT(YEAR_MONTH FROM "'.$this->data.'"),"01")';
						break;
						case 'dolg_utszn':
						$filename = '/tmp/'.$this->org.'.M'.$this->mes;
						$this->sql='SELECT t1.`COD`,t1.`CDPR`,t1.`NCARD`,t1.`IDPIL`,t1.`PASPPIL`,t1.`FIOPIL`,t1.`INDEX`,t1.`CDUL`,t1.`HOUSE`,t1.`BUILD`,t1.`APT`,t1.`KAT`,t1.`LGCODE`, t1.`DATEIN`,t1.`DATEOUT`,t1.`MonthZv`,t1.`YearZv`,t1.`RAH`,t1.`MONEY`,t1.`EBK`,t1.`Sum_Borg`  FROM YISGRAND.`LGOTNIK_UTSZN` as t1  WHERE 1 ';
						break;
						case '1':
						$filename = "/tmp/kvartplata.csv";
						$this->sql='SELECT cast(t1.`utszn_id`  as char) ,cast(t1.`oshad_id`  as char),cast(t1.`fio`  as char),cast(t1.`address_id`  as char),replace(cast(t1.`nachisleno`  as char),".",","),replace(cast(t1.`dolg`  as char),".",",") FROM YIS.SUBS_KVARTPLATA as t1 WHERE t1.`data` =CONCAT(EXTRACT(YEAR_MONTH FROM "'.$this->data.'"),"01")';
						break;
						case '11':
						$filename = "/tmp/kvartplata.csv";
						$this->sql='SELECT cast(t1.`utszn_id`  as char) ,cast(t1.`oshad_id`  as char),cast(t1.`fio`  as char),cast(t1.`address_id`  as char),replace(cast(t1.`nachisleno`  as char),".",","),replace(cast(t1.`dolg`  as char),".",",") FROM YIS.LG_KVARTPLATA as t1 WHERE t1.`data` =CONCAT(EXTRACT(YEAR_MONTH FROM "'.$this->data.'"),"01")';
						break;
						case '2':
						$filename = "/tmp/otoplenie.csv";
						$this->sql='SELECT cast(t1.`utszn_id`  as char) ,cast(t1.`oshad_id`  as char),cast(t1.`fio`  as char),cast(t1.`address_id`  as char),replace(cast(t1.`nachisleno`  as char),".",","),replace(cast(t1.`dolg`  as char),".",",") FROM YIS.SUBS_TEPLO as t1 WHERE t1.`data` =CONCAT(EXTRACT(YEAR_MONTH FROM "'.$this->data.'"),"01")';
						break;
						case '22':
						$filename = "/tmp/otoplenie.csv";
						$this->sql='SELECT cast(t1.`utszn_id`  as char) ,cast(t1.`oshad_id`  as char),cast(t1.`fio`  as char),cast(t1.`address_id`  as char),replace(cast(t1.`nachisleno`  as char),".",","),replace(cast(t1.`dolg`  as char),".",",") FROM YIS.LG_TEPLO as t1 WHERE t1.`data` =CONCAT(EXTRACT(YEAR_MONTH FROM "'.$this->data.'"),"01")';
						break;
						case '3':
						$filename = "/tmp/voda.csv";
						$this->sql='SELECT cast(t1.`utszn_id`  as char) ,cast(t1.`oshad_id`  as char),cast(t1.`fio`  as char),cast(t1.`address_id`  as char),replace(cast(t1.`nachisleno`  as char),".",","),replace(cast(t1.`dolg`  as char),".",",") FROM YIS.SUBS_VODA as t1 WHERE t1.`data` =CONCAT(EXTRACT(YEAR_MONTH FROM "'.$this->data.'"),"01")';
						break;	
						case '33':
						$filename = "/tmp/voda.csv";
						$this->sql='SELECT cast(t1.`utszn_id`  as char) ,cast(t1.`oshad_id`  as char),cast(t1.`fio`  as char),cast(t1.`address_id`  as char),replace(cast(t1.`nachisleno`  as char),".",","),replace(cast(t1.`dolg`  as char),".",",") FROM YIS.LG_VODA as t1 WHERE t1.`data` =CONCAT(EXTRACT(YEAR_MONTH FROM "'.$this->data.'"),"01")';
						break;	
						case '4':
						$filename = "/tmp/stoki.csv";
						$this->sql='SELECT cast(t1.`utszn_id`  as char) ,cast(t1.`oshad_id`  as char),cast(t1.`fio`  as char),cast(t1.`address_id`  as char),replace(cast(t1.`nachisleno`  as char),".",","),replace(cast(t1.`dolg`  as char),".",",") FROM YIS.SUBS_STOKI as t1 WHERE t1.`data` =CONCAT(EXTRACT(YEAR_MONTH FROM "'.$this->data.'"),"01")';
						break;	
						case '44':
						$filename = "/tmp/stoki.csv";
						$this->sql='SELECT cast(t1.`utszn_id`  as char) ,cast(t1.`oshad_id`  as char),cast(t1.`fio`  as char),cast(t1.`address_id`  as char),replace(cast(t1.`nachisleno`  as char),".",","),replace(cast(t1.`dolg`  as char),".",",") FROM YIS.LG_STOKI as t1 WHERE t1.`data` =CONCAT(EXTRACT(YEAR_MONTH FROM "'.$this->data.'"),"01")';
						break;	
						case '5':
						$filename = "/tmp/tbo.csv";
						$this->sql='SELECT cast(t1.`utszn_id`  as char) ,cast(t1.`oshad_id`  as char),cast(t1.`fio`  as char),cast(t1.`address_id`  as char),replace(cast(t1.`nachisleno`  as char),".",","),replace(cast(t1.`dolg`  as char),".",",") FROM YIS.SUBS_TBO as t1 WHERE t1.`data` =CONCAT(EXTRACT(YEAR_MONTH FROM "'.$this->data.'"),"01")';
						break;	
						case '55':
						$filename = "/tmp/tbo.csv";
						$this->sql='SELECT cast(t1.`utszn_id`  as char) ,cast(t1.`oshad_id`  as char),cast(t1.`fio`  as char),cast(t1.`address_id`  as char),replace(cast(t1.`nachisleno`  as char),".",","),replace(cast(t1.`dolg`  as char),".",",") FROM YIS.LG_TBO as t1 WHERE t1.`data` =CONCAT(EXTRACT(YEAR_MONTH FROM "'.$this->data.'"),"01")';
						break;	
						case '7':
						$filename = "/tmp/otoplenie.csv";
						$this->sql='SELECT cast(t1.`utszn_id`  as char) ,cast(t1.`oshad_id`  as char),cast(t1.`fio`  as char),cast(t1.`address_id`  as char),replace(cast(t1.`nachisleno`  as char),".",","),replace(cast(t1.`dolg`  as char),".",",") FROM YIS.SUBS_TEPLO as t1 WHERE t1.`data` =CONCAT(EXTRACT(YEAR_MONTH FROM "'.$this->data.'"),"01")';
						break;	
						case '77':
						$filename = "/tmp/otoplenie.csv";
						$this->sql='SELECT cast(t1.`utszn_id`  as char) ,cast(t1.`oshad_id`  as char),cast(t1.`fio`  as char),cast(t1.`address_id`  as char),replace(cast(t1.`nachisleno`  as char),".",","),replace(cast(t1.`dolg`  as char),".",",") FROM YIS.LG_TEPLO as t1 WHERE t1.`data` =CONCAT(EXTRACT(YEAR_MONTH FROM "'.$this->data.'"),"01")';
						break;	
						}
						$_result = $_db->query($this->sql) or die('Connect Error in '.$this->what.' ('.$this->sql.') ' . $_db->connect_error);
						$_success = 1;
						switch($this->vibor) {
						case 'otoplenie':															
						case 'voda':																	
						case 'tbo':
						$dbf_lgota =Array(
						Array ("CDPR", "N", 12,0),
						Array ("IDCODE", "C", 10),
						Array ("FIO", "C", 50),
						Array ("PPOS", "C", 15),
						Array ("RS", "C", 25),
						Array ("YEARIN", "N", 4,0),
						Array ("MONTHIN", "N", 2,0),
						Array ("LGCODE", "N", 4,0),
						Array ("DATA1", "D"),
						Array ("DATA2", "D"),
						Array ("LGKOL", "N", 2,0),
						Array ("LGKAT", "C", 3),
						Array ("LGPRC", "N", 3,0),
						Array ("SUMM", "N", 8,2),
						Array ("FACT", "N", 19,6),
						Array ("TARIF", "N", 14,7),
						Array ("FLAG", "N", 1,0));
						
						if (! dbase_create($filename, $dbf_lgota)) {
						$_msg = "Error db_lgota";
						$_success = 0;
						exit();
						}
						$db = dbase_open($filename,2);
						if ($db) {
						$row_no   = 0;
						 while ($row = $_result->fetch_row()) {
							$record=array();
							for ($i = 0; $i < $_result->field_count; ++$i) {
							$record[]= convert_cyr_string(utf8_2_win1251($row[$i]),"w","a");
							}
						$row_no++;
						if(! dbase_add_record($db,$record)) {
						$_msg = "Error db append";
							$_success = 0;
							exit () ;
						} else {
							$_msg = "db append";
							$_success = 1;
						}
						}
						}else {
							$_msg = 'Error db open '.$filename;
							$_success = 0;
						}
							dbase_close($db);
							break;
						case 'dolg_utszn':
						$dbf_lgota =Array(
						Array ("COD", "N", 4,0),
						Array ("CDPR", "N", 12,0),
						Array ("NCARD", "N", 10,0),
						Array ("IDPIL", "C", 10),
						Array ("PASPPIL", "C", 14),
						Array ("FIOPIL", "C", 50),
						Array ("INDEX", "N", 6,0),
						Array ("CDUL", "N", 5,0),
						Array ("HOUSE", "C", 7),
						Array ("BUILD", "C", 2),
						Array ("APT", "C", 4),
						Array ("KAT", "N", 4,0),
						Array ("LGCODE", "N", 4,0),
						Array ("DATEIN", "C",10),
						Array ("DATEOUT", "C",10),
						Array ("MonthZv", "N", 2,0),
						Array ("YearZv", "N", 4,0),
						Array ("RAH", "C", 25),
						Array ("MONEY", "N", 1,0),
						Array ("EBK", "C", 10),
						Array ("Sum_Borg", "N", 9,2));
						
						if (! dbase_create($filename, $dbf_lgota)) {
						$_msg = "Error db_lgota";
						$_success = 0;
						exit();
						}
						$db = dbase_open($filename,2);
						if ($db) {
						$row_no   = 0;
						 while ($row = $_result->fetch_row()) {
							$record=array();
							for ($i = 0; $i < $_result->field_count; ++$i) {
							$record[]= convert_cyr_string(utf8_2_win1251($row[$i]),"w","a");
							}
						$row_no++;
						if(! dbase_add_record($db,$record)) {
						$_msg = "Error db append";
							$_success = 0;
							exit () ;
						} else {
							$_msg = "db append";
							$_success = 1;
						}
						}
						}else {
							$_msg = 'Error db open '.$filename;
							$_success = 0;
						}
							dbase_close($db);
							break;	
						case '1':
						case '2':														
						case '3':
						case '4':
						case '5':
						case '7':
						case '11':
						case '22':														
						case '33':
						case '44':
						case '55':
						case '77':

							if ($handle = fopen($filename, 'w')) {
							}else {		
							throw new Exception("Cannot open file '.$filename");
							}
							$fields_cnt = $_result->field_count;
							$csv_terminated = "\r\n";;
							$csv_separator = ";";
							$csv_enclosed = '"';
							$csv_escaped = "\\";
						while ($row = $_result->fetch_array()) {
							$svod =$csv_enclosed;
							for ($j = 0; $j < $fields_cnt; $j++) {
							$svod .= $row[$j];
							if ($j < $fields_cnt-1) {
								$svod .= $csv_enclosed.$csv_separator.$csv_enclosed;
							}
							} // end for
							if (fwrite($handle,$svod.$csv_enclosed.$csv_terminated) === FALSE) {
							echo 'Не могу записать файл '.$filename;
							exit;
							} 
							}
							fclose($handle);																	
							break;
							}
							if($_success ) {
							$mail = new PHPMailer();
							  $mail->IsSMTP();// отсылать используя SMTP
							  $mail->Host = '91.192.128.1'; // SMTP сервер
							  $mail->SMTPAuth = true;     // включить SMTP аутентификацию
							  $mail->Username = 'yis';                 // SMTP username
							  $mail->Password = 'yis2018';      // SMTP password
							  $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
							  $mail->Port = 587;       
							  $mail->From     = 'yis@yuzhny.com'; // укажите от кого письмо							
							  $mail->FromName = 'Южненская Коммунальная Информационная Система -ЮКИС'; // имя отправителя
							  $mail->AddAddress($this->subjectTo); // е-мэил кому отправлять
							  $mail->AddReplyTo($this->subjectFrom,"Info"); // е-мэил того кому прейдет ответ на ваше письмо
							  $mail->WordWrap = 350;// set word wrap
							  $mail->AddAttachment($filename);         // add attachments
							  $mail->IsHTML(false);// отправить в html формате
							  $mail->CharSet    = 'utf-8';

							  $mail->Subject  =  $this->tema; // тема письма
							  $mail->Body     =   $this->message; // тело письма в html формате
							$mail->AltBody  =  $this->message; // тело письма текстовое
							if(!$mail->Send()) {
								$_msg = "Ошибка. Файл не отправлен";
								$_success = 0;
							} else {
								$_msg = "Файл отправлен";
								$_success = 1;
							}																			
							} else {
							  $_msg = "файл начислений на бюджет  не создан";
							  $_success = 0;
							}
						break;
			
		} // End of Switch ($what)  
				
			$this->results['success'] = $_success;
			$this->results['msg'] = $_msg;
					
		return $this->results;
	}



}