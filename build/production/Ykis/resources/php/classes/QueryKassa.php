<?php

class QueryKassa
{

	private $_db;
	protected $login;
	protected $password;
	protected $result;
	protected $res_callback;
	protected $sql;	
	protected $sql_callback;
	protected $row;	
	protected $id;
	protected $what;
	protected $nomer;
	protected $type;
	protected $pokaz;
	protected $pred;
	protected $tek;
	protected $kub;
	protected $t; 
	protected $data=NULL;
	protected $res=array();	
	public	  $results=array();
	
	/*public function connect($this->login,$this->password)
	{
		//                 'hostname', 'username' ,'password', 'database'
		$_db = new mysqli('localhost', 'cthubq' ,'hfljyt;crbq', 'YISGRAND');
		
		if ($_db->connect_error) {
			die('Connection Error (' . $_db->connect_errno . ') ' . $_db->connect_error);
		}
		$_db->set_charset("utf8");
    
		return $_db;
	}*/
	
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

		
		if(isset($params->what) && ($params->what)) {
		 $this->what = $params->what;
		} else {
		  $this->what = null;
		}
		if(isset($params->address_id) && ($params->address_id)) {
		  $this->address_id = (int) $params->address_id;
		} else {
		  $this->address_id = 0;
		}
		if(isset($params->filial_id) && ($params->filial_id)) {
		  $this->filial_id = (int) $params->filial_id;
		} else {
		  $this->filial_id = 0;
		}
		if(isset($params->org_id) && ($params->org_id)) {
		  $this->org_id = (int) $params->org_id;
		} else {
		  $this->org_id = 0;
		}
		if(isset($params->raion_id) && ($params->raion_id)) {
		  $this->raion_id = (int) $params->raion_id;
		} else {
		  $this->raion_id = 0;
		}
		if(isset($params->data) && ($params->data)) {
		  $this->data =$params->data;
		 // $this->data =preg_replace("/(\d+)\D+(\d+)\D+(\d+)/","$3-$2-$1",$params->data);
		} else {
		  $this->data= date("Ymd");
		}
		if(isset($params->what_id) && ($params->what_id)) {
		  $this->id = (int) $params->what_id;
		} else {
		  $this->id = 0;
		}
		$this->t= date('Ymd');
		
		switch ($this->what) {

			case "OplataApp":			
			      $this->sql='SELECT * FROM YIS.OPLATA WHERE `address_id` = '.$this->address_id.' ORDER BY YIS.OPLATA.`data` DESC ' ;
			     // print_r($this->sql); 
			break;
			/*
			case "OtoplenieApp":			
			      $this->sql='SELECT t1.* , IFNULL(t2.zadol,0) as hzadol,IFNULL(t2.oplata,0) as itogo,IFNULL(t2.dolg,0) as hdolg FROM YIS.OTOPLENIE as t1 '
			      .' LEFT JOIN YIS.KREDIT_TEPLO as t2   USING (`address_id`,`data`) WHERE t1.`address_id` = '.$this->address_id.' ORDER BY t1.`data` DESC  LIMIT 12' ;
			     
			break;
			*/
			case "OtoplenieApp":			
			      $this->sql='SELECT t1.*  FROM YIS.OTOPLENIE as t1  WHERE t1.`address_id` = '.$this->address_id.' ORDER BY t1.`data` DESC  LIMIT 12' ;			     
			break;
			case "OtoplenieAppAll":	
			      $this->sql='SELECT t1.*  FROM YIS.OTOPLENIE as t1  WHERE t1.`address_id` = '.$this->address_id.' ORDER BY t1.`data` DESC ' ;			     
			break;
			case "PodogrevApp":			
			      $this->sql='SELECT * FROM YIS.PODOGREV WHERE `address_id` = '.$this->address_id.' ORDER BY YIS.PODOGREV.`data` DESC LIMIT 12' ;
			     // print_r($this->sql); 
			break;
			case "PodogrevAppAll":			
			      $this->sql='SELECT * FROM YIS.PODOGREV WHERE `address_id` = '.$this->address_id.' ORDER BY YIS.PODOGREV.`data` DESC ' ;
			     // print_r($this->sql); 
			break;
			case "PtnApp":			
			      $this->sql='SELECT * FROM YIS.PTN WHERE `address_id` = '.$this->address_id.' ORDER BY YIS.PTN.`data` DESC LIMIT 12' ;
			     // print_r($this->sql); 
			break;
			case "PtnAppAll":			
			      $this->sql='SELECT * FROM YIS.PTN as t1  WHERE t1.`address_id` = '.$this->address_id.' ORDER BY t1.`data` DESC' ;
			     // print_r($this->sql); 
			break;
			case "VodaApp":			
			      $this->sql='SELECT * FROM YIS.VODA as t1 WHERE t1.`address_id` = '.$this->address_id.' ORDER BY t1.`data` DESC LIMIT 12' ;
			     // print_r($this->sql); 
			break;
			case "VodaAppAll":			
			      $this->sql='SELECT * FROM YIS.VODA as t1  WHERE t1.`address_id` = '.$this->address_id.' ORDER BY t1.`data` DESC' ;
			     // print_r($this->sql); 
			break;
			
			case "AvodaApp":			
			      $this->sql='SELECT * FROM YIS.AVODA as t1 WHERE t1.`address_id` = '.$this->address_id.' ORDER BY t1.`data` DESC LIMIT 12' ;
			     // print_r($this->sql); 
			break;
			case "AvodaAppAll":			
			      $this->sql='SELECT * FROM YIS.AVODA as t1  WHERE t1.`address_id` = '.$this->address_id.' ORDER BY t1.`data` DESC' ;
			     // print_r($this->sql); 
			break;
			case "StokiApp":			
			      $this->sql='SELECT * FROM YIS.STOKI as t1  WHERE t1.`address_id` = '.$this->address_id.' ORDER BY t1.`data` DESC LIMIT 12' ;
			     // print_r($this->sql); 
			break;
			case "StokiAppAll":			
			      $this->sql='SELECT * FROM YIS.STOKI as t1 WHERE t1.`address_id` = '.$this->address_id.' ORDER BY t1.`data` DESC ' ;
			     // print_r($this->sql); 
			break;
			case "KvartplataApp":			
			      $this->sql='SELECT t1.* FROM YIS.KVARTPLATA as t1  WHERE t1.`address_id` = '.$this->address_id.'  ORDER BY t1.`data` DESC LIMIT 12' ;
			     // print_r($this->sql); 
			break;
			case "KvartplataAppAll":			
			      $this->sql='SELECT t1.* FROM YIS.KVARTPLATA as t1  WHERE t1.`address_id` = '.$this->address_id.'  ORDER BY t1.`data` DESC ' ;
			     // print_r($this->sql); 
			break;
			case "TboApp":			
			      $this->sql='SELECT * FROM YIS.TBO WHERE `address_id` = '.$this->address_id.'  ORDER BY YIS.TBO.`data` DESC LIMIT 12' ;
			     // print_r($this->sql); 
			break;
			case "TboAppAll":			
			      $this->sql='SELECT * FROM YIS.TBO WHERE `address_id` = '.$this->address_id.'  ORDER BY YIS.TBO.`data` DESC ' ;
			     // print_r($this->sql); 
			break;
			case "LgotaNachVoda":			
			      $this->sql='SELECT * FROM YIS.BVODA WHERE `address_id` = '.$this->address_id.'  AND YIS.BVODA.data=CONCAT(EXTRACT(YEAR_MONTH FROM CURDATE()),"01")';
			     // print_r($this->sql); 
			break;
			case "LgotaNachPtn":			
			      $this->sql='SELECT * FROM YIS.BPTN WHERE `address_id` = '.$this->address_id.'  AND YIS.BPTN.data=CONCAT(EXTRACT(YEAR_MONTH FROM CURDATE()),"01")';
			     // print_r($this->sql); 
			break;
			case "LgotaNachPtnData":			
			      $this->sql='SELECT * FROM YIS.BPTN WHERE `address_id` = '.$this->address_id.'  AND YIS.BPTN.`data`= "'.$this->data.'"' ;
			     //print_r($this->sql); 
			break;
			case "LgotaNachVodaData":			
			      $this->sql='SELECT * FROM YIS.BVODA WHERE `address_id` = '.$this->address_id.'  AND YIS.BVODA.`data`= "'.$this->data.'"' ;
			     //print_r($this->sql); 
			break;
			case "LgotaNachStoki":			
			      $this->sql='SELECT * FROM YIS.BSTOKI WHERE `address_id` = '.$this->address_id.'  AND YIS.BSTOKI.data=CONCAT(EXTRACT(YEAR_MONTH FROM CURDATE()),"01")';
			     // print_r($this->sql); 
			break;
			case "LgotaNachStokiData":			
			      $this->sql='SELECT * FROM YIS.BSTOKI WHERE `address_id` = '.$this->address_id.'  AND YIS.BSTOKI.`data`= "'.$this->data.'"' ;
			     //print_r($this->sql); 
			break;
			case "LgotaNachPodogrev":			
			      $this->sql='SELECT * FROM YIS.BPODOGREV WHERE `address_id` = '.$this->address_id.'  AND YIS.BPODOGREV.data=CONCAT(EXTRACT(YEAR_MONTH FROM CURDATE()),"01")';
			     // print_r($this->sql); 
			break;
			case "LgotaNachPodogrevData":			
			      $this->sql='SELECT * FROM YIS.BPODOGREV WHERE `address_id` = '.$this->address_id.'  AND YIS.BPODOGREV.`data`= "'.$this->data.'"' ;
			     //print_r($this->sql); 
			break;
			case "LgotaNachOtoplenie":			
			      $this->sql='SELECT * FROM YIS.BOTOPLENIE WHERE `address_id` = '.$this->address_id.'  AND YIS.BOTOPLENIE.data=CONCAT(EXTRACT(YEAR_MONTH FROM CURDATE()),"01")';
			     // print_r($this->sql); 
			break;
			case "LgotaNachOtoplenieData":			
			      $this->sql='SELECT * FROM YIS.BOTOPLENIE WHERE `address_id` = '.$this->address_id.'  AND YIS.BOTOPLENIE.`data`= "'.$this->data.'"' ;
			     //print_r($this->sql); 
			break;
			case "LgotaNachKvartplata":			
			      $this->sql='SELECT * FROM YIS.BKVARTPLATA WHERE `address_id` = '.$this->address_id.'  AND YIS.BKVARTPLATA.data=CONCAT(EXTRACT(YEAR_MONTH FROM CURDATE()),"01")';
			     // print_r($this->sql); 
			break;
			case "LgotaNachKvartplataData":			
			      $this->sql='SELECT * FROM YIS.BKVARTPLATA WHERE `address_id` = '.$this->address_id.'  AND YIS.BKVARTPLATA.`data`= "'.$this->data.'"' ;
			     //print_r($this->sql); 
			break;
			case "LgotaNachTbo":			
			      $this->sql='SELECT * FROM YIS.BTBO WHERE `address_id` = '.$this->address_id.'  AND YIS.BTBO.data=CONCAT(EXTRACT(YEAR_MONTH FROM CURDATE()),"01")';
			     // print_r($this->sql); 
			break;
			case "LgotaNachTboData":			
			      $this->sql='SELECT * FROM YIS.BTBO WHERE `address_id` = '.$this->address_id.'  AND YIS.BTBO.`data`= "'.$this->data.'"' ;
			     //print_r($this->sql); 
			break;
			case "TekNachAllApp":		  
			   if($this->raion_id == 2 ||  $this->raion_id == 5 || $this->raion_id == 6 || $this->raion_id == 7 || $this->raion_id == 10){ 
				  $this->sql='SELECT CONCAT_WS(" ",t1.mec,t1.god) as period1, CONCAT_WS(" ",t2.mec,t2.god) as period2,'
					      .' t1.zadol as zadol1,t2.zadol as zadol2,'
					      .' t1.zadol + t2.zadol as zadol ,'
					      .' t1.nachisleno as nachisleno1,t2.nachisleno as nachisleno2,'
					      .' t1.nachisleno + t2.nachisleno  as nachisleno,'
					      .' (t1.budjet+t1.pbudjet) as budjet1,(t2.budjet+t2.pbudjet) as budjet2,'
					      .' t1.budjet+t1.pbudjet + t2.budjet+t2.pbudjet as budjet ,'
					      .' t1.oplacheno as oplacheno1,t2.oplacheno as oplacheno2,'
					      .' t1.oplacheno+t2.oplacheno as oplacheno,'
					      .' t1.subsidia as subsidia1,t2.subsidia as subsidia2,'
					      .' t1.subs as subs1,t2.subs as subs2,'
					      .' t1.subsidia+t2.subsidia as subsidia,'
					      .' t1.subs + t2.subs as subs,'
					      .' t1.dolg as dolg1,t2.dolg as dolg2,'
					      .' t1.dolg +t2.dolg as dolg '					      
					      .'FROM YIS.VODA as t1,YIS.STOKI as t2'
					      .' WHERE t1.address_id='.$this->id.'  AND t2.address_id='.$this->id.'  AND t1.data=CONCAT(EXTRACT(YEAR_MONTH FROM curdate()),"01")  AND '
					      .'t2.data=CONCAT(EXTRACT(YEAR_MONTH FROM curdate()),"01") ';
				} else if ($this->house_id == 22 ) {
				$this->sql='SELECT CONCAT_WS(" ",t1.mec,t1.god) as period1, CONCAT_WS(" ",t2.mec,t2.god) as period2, CONCAT_WS(" ",t3.mec,t3.god) as period3,'
					      .'CONCAT_WS(" ",t8.mec,t8.god) as period8,CONCAT_WS(" ",t4.mec,t4.god) as period4, CONCAT_WS(" ",t5.mec,t5.god) as period5,'
					      .'CONCAT_WS(" ",t6.mec,t6.god) as period6, CONCAT_WS(" ",t7.mec,t7.god) as period7,'
					      .'t1.zadol as zadol1,t2.zadol as zadol2,t3.zadol as zadol3,t8.zadol as zadol8,t4.zadol as zadol4,t5.zadol as zadol5,'
					      .'t6.zadol -t6.kzadol  as zadol6,t7.zadol as zadol7,'
					      .'(t1.zadol + t2.zadol + t3.zadol + t8.zadol + t4.zadol  + t5.zadol + t6.zadol -t6.kzadol + t7.zadol) as zadol ,'
					      .'t1.nachisleno as nachisleno1,t2.nachisleno as nachisleno2,t3.nachisleno as nachisleno3,t8.nachisleno as nachisleno8,'
					      .'t4.nachisleno  as nachisleno4,t5.nachisleno as nachisleno5,t6.nachisleno - t6.knachisleno + t6.koplata as nachisleno6,t7.nachisleno as nachisleno7,'
					      .'t1.nachisleno + t2.nachisleno + t3.nachisleno + t3.nachisleno + t4.nachisleno + t5.nachisleno + t6.nachisleno + t7.nachisleno as nachisleno,'
					      .'(t1.budjet+t1.pbudjet) as budjet1,(t2.budjet+t2.pbudjet) as budjet2,(t3.budjet+t3.pbudjet) as budjet3,'
					      .'(t4.budjet+t4.pbudjet) as budjet4,(t5.budjet+t5.pbudjet) as budjet5,(t6.budjet+t6.pbudjet) as budjet6,(t7.budjet+t7.pbudjet) as budjet7,'
					      .'((t1.budjet+t1.pbudjet) + (t2.budjet+t2.pbudjet)+(t3.budjet+t3.pbudjet) +'
					      .'(t4.budjet+t4.pbudjet) + (t5.budjet+t5.pbudjet) +(t6.budjet+t6.pbudjet) + (t7.budjet+t7.pbudjet)) as budjet ,'
					      .'t1.oplacheno as oplacheno1,t2.oplacheno as oplacheno2,t3.oplacheno as oplacheno3, t8.oplacheno as oplacheno8, '
					      .'t4.oplacheno  as oplacheno4,t5.oplacheno as oplacheno5,t6.oplacheno as oplacheno6,t7.oplacheno as oplacheno7,'
					      .'t1.oplacheno+t2.oplacheno+t3.oplacheno +t8.oplacheno + t4.oplacheno +t5.oplacheno+t6.oplacheno +t7.oplacheno as oplacheno,'
					      .'t1.subsidia as subsidia1,t2.subsidia as subsidia2,t3.subsidia as subsidia3,'
					      .'t4.subsidia as subsidia4,t5.subsidia as subsidia5,t6.subsidia as subsidia6, t7.subsidia as subsidia7,'
					      .'t1.subs as subs1,t2.subs as subs2,t3.subs as subs3,t4.subs as subs4,t5.subs as subs5,t6.subs as subs6,t7.subs as subs7, '
					      .'t1.subsidia+t2.subsidia+t3.subsidia+t4.subsidia+t5.subsidia+t6.subsidia +t7.subsidia as subsidia,t1.subs+t2.subs+t3.subs+t4.subs+'
					      .'t5.subs+t6.subs +t7.subs as subs,'
					      .'t1.dolg as dolg1,t2.dolg as dolg2,t3.dolg as dolg3,t8.dolg as dolg8,t4.dolg as dolg4,t5.dolg as dolg5,t3.fdolg,t3.fdolg as dolg9,t3.ddolg,'
					      .'t3.ddolg as dolg10,t6.dolg-t6.kdolg as dolg6 ,t7.dolg as dolg7 ,'
					      .'t1.dolg +t2.dolg+t3.dolg +t8.dolg +t4.dolg   +t5.dolg+t6.dolg -t6.kdolg +t7.dolg  as dolg '					      
					      .'FROM YIS.VODA as t1,YIS.STOKI as t2,OSBB.KVARTPLATA as t3,OSBB.TBO as t4,YIS.PODOGREV as t5,YIS.OTOPLENIE as t6 ,YIS.PTN as t7,OSBB.RFOND as t8  '
					      .' WHERE t1.address_id='.$this->id.'  AND t2.address_id='.$this->id.' AND t3.address_id='.$this->id.'  AND t4.address_id='.$this->id.' AND '
					      .' t5.address_id='.$this->id.'  AND t6.address_id='.$this->id.' AND t7.address_id='.$this->id.'  AND t8.address_id='.$this->id.' AND ' .'t1.data=CONCAT(EXTRACT(YEAR_MONTH FROM curdate()),"01")  AND '
					      .'t2.data=CONCAT(EXTRACT(YEAR_MONTH FROM curdate()),"01") AND t3.data=CONCAT(EXTRACT(YEAR_MONTH FROM curdate()),"01")  AND '
					      .'t4.data=CONCAT(EXTRACT(YEAR_MONTH FROM curdate()),"01")  AND t5.data=CONCAT(EXTRACT(YEAR_MONTH FROM curdate()),"01")  AND '
					      .'t6.data=CONCAT(EXTRACT(YEAR_MONTH FROM curdate()),"01") AND t7.data=CONCAT(EXTRACT(YEAR_MONTH FROM curdate()),"01") AND '
					      .'t8.data=CONCAT(EXTRACT(YEAR_MONTH FROM curdate()),"01")';
			      } else {
				$this->sql='SELECT CONCAT_WS(" ",t1.mec,t1.god) as period1, CONCAT_WS(" ",t2.mec,t2.god) as period2, CONCAT_WS(" ",t3.mec,t3.god) as period3,'
					      .'CONCAT_WS(" ",t3.mec,t3.god) as period8,CONCAT_WS(" ",t4.mec,t4.god) as period4, CONCAT_WS(" ",t5.mec,t5.god) as period5,'
					      .'CONCAT_WS(" ",t6.mec,t6.god) as period6, CONCAT_WS(" ",t7.mec,t7.god) as period7,'
					      .'t1.zadol as zadol1,t2.zadol as zadol2,t3.zadol as zadol3,t3.rzadol as zadol8,t4.zadol as zadol4,t5.zadol as zadol5,'
					      .'t6.zadol -t6.kzadol  as zadol6,t7.zadol as zadol7,'
					      .'(t1.zadol + t2.zadol + t3.zadol + t3.rzadol + t4.zadol  + t5.zadol + t6.zadol -t6.kzadol + t7.zadol) as zadol ,'
					      .'t1.nachisleno as nachisleno1,t2.nachisleno as nachisleno2,t3.nachisleno as nachisleno3,t3.remont as nachisleno8,'
					      .'t4.nachisleno  as nachisleno4,t5.nachisleno as nachisleno5,t6.nachisleno - t6.knachisleno + t6.koplata as nachisleno6,t7.nachisleno as nachisleno7,'
					      .'t1.nachisleno + t2.nachisleno + t3.nachisleno + t3.remont + t4.nachisleno + t5.nachisleno + t6.nachisleno + t7.nachisleno as nachisleno,'
					      .'(t1.budjet+t1.pbudjet) as budjet1,(t2.budjet+t2.pbudjet) as budjet2,(t3.budjet+t3.pbudjet) as budjet3,'
					      .'(t4.budjet+t4.pbudjet) as budjet4,(t5.budjet+t5.pbudjet) as budjet5,(t6.budjet+t6.pbudjet) as budjet6,(t7.budjet+t7.pbudjet) as budjet7,'
					      .'((t1.budjet+t1.pbudjet) + (t2.budjet+t2.pbudjet)+(t3.budjet+t3.pbudjet) +'
					      .'(t4.budjet+t4.pbudjet) + (t5.budjet+t5.pbudjet) +(t6.budjet+t6.pbudjet) + (t7.budjet+t7.pbudjet)) as budjet ,'
					      .'t1.oplacheno as oplacheno1,t2.oplacheno as oplacheno2,t3.oplacheno as oplacheno3, t3.roplacheno as oplacheno8, '
					      .'t4.oplacheno  as oplacheno4,t5.oplacheno as oplacheno5,t6.oplacheno as oplacheno6,t7.oplacheno as oplacheno7,'
					      .'t1.oplacheno+t2.oplacheno+t3.oplacheno +t3.roplacheno + t4.oplacheno +t5.oplacheno+t6.oplacheno +t7.oplacheno as oplacheno,'
					      .'t1.subsidia as subsidia1,t2.subsidia as subsidia2,t3.subsidia as subsidia3,'
					      .'t4.subsidia as subsidia4,t5.subsidia as subsidia5,t6.subsidia as subsidia6, t7.subsidia as subsidia7,'
					      .'t1.subs as subs1,t2.subs as subs2,t3.subs as subs3,t4.subs as subs4,t5.subs as subs5,t6.subs as subs6,t7.subs as subs7, '
					      .'t1.subsidia+t2.subsidia+t3.subsidia+t4.subsidia+t5.subsidia+t6.subsidia +t7.subsidia as subsidia,t1.subs+t2.subs+t3.subs+t4.subs+'
					      .'t5.subs+t6.subs +t7.subs as subs,'
					      .'t1.dolg as dolg1,t2.dolg as dolg2,t3.dolg as dolg3,t3.rdolg as dolg8,t4.dolg as dolg4,t5.dolg as dolg5,t3.fdolg,t3.fdolg as dolg9,t3.ddolg,'
					      .'t3.ddolg as dolg10,t6.dolg-t6.kdolg as dolg6 ,t7.dolg as dolg7 ,'
					      .'t1.dolg +t2.dolg+t3.dolg +t3.rdolg +t4.dolg   +t5.dolg+t6.dolg -t6.kdolg +t7.dolg  as dolg '					      
					      .'FROM YIS.VODA as t1,YIS.STOKI as t2,YIS.KVARTPLATA as t3,YIS.TBO as t4,YIS.PODOGREV as t5,YIS.OTOPLENIE as t6 ,YIS.PTN as t7  '
					      .' WHERE t1.address_id='.$this->id.'  AND t2.address_id='.$this->id.' AND t3.address_id='.$this->id.'  AND t4.address_id='.$this->id.' AND '
					      .' t5.address_id='.$this->id.'  AND t6.address_id='.$this->id.' AND t7.address_id='.$this->id.' AND t1.data=CONCAT(EXTRACT(YEAR_MONTH FROM curdate()),"01")  AND '
					      .'t2.data=CONCAT(EXTRACT(YEAR_MONTH FROM curdate()),"01") AND t3.data=CONCAT(EXTRACT(YEAR_MONTH FROM curdate()),"01")  AND '
					      .'t4.data=CONCAT(EXTRACT(YEAR_MONTH FROM curdate()),"01")  AND t5.data=CONCAT(EXTRACT(YEAR_MONTH FROM curdate()),"01")  AND '
					      .'t6.data=CONCAT(EXTRACT(YEAR_MONTH FROM curdate()),"01") AND t7.data=CONCAT(EXTRACT(YEAR_MONTH FROM curdate()),"01")';
				}
							// print_r($this->sql); 

		    break;

			    case "TekNachAllApp1":		  
			   if($this->raion_id == 2 ||  $this->raion_id == 5 || $this->raion_id == 6 || $this->raion_id == 7 || $this->raion_id == 10){ 
				  $this->sql='SELECT CONCAT_WS(" ",t1.mec,t1.god) as period1, CONCAT_WS(" ",t2.mec,t2.god) as period2,'
					      .' t1.zadol as zadol1,t2.zadol as zadol2,'
					      .' t1.zadol + t2.zadol as zadol ,'
					      .' t1.nachisleno as nachisleno1,t2.nachisleno as nachisleno2,'
					      .' t1.nachisleno + t2.nachisleno  as nachisleno,'
					      .' (t1.budjet+t1.pbudjet) as budjet1,(t2.budjet+t2.pbudjet) as budjet2,'
					      .' t1.budjet+t1.pbudjet + t2.budjet+t2.pbudjet as budjet ,'
					      .' t1.oplacheno as oplacheno1,t2.oplacheno as oplacheno2,'
					      .' t1.oplacheno+t2.oplacheno as oplacheno,'
					      .' t1.subsidia as subsidia1,t2.subsidia as subsidia2,'
					      .' t1.subs as subs1,t2.subs as subs2,'
					      .' t1.subsidia+t2.subsidia as subsidia,'
					      .' t1.subs + t2.subs as subs,'
					      .' t1.dolg as dolg1,t2.dolg as dolg2,'
					      .' t1.dolg +t2.dolg as dolg '					      
					      .'FROM YIS.VODA as t1,YIS.STOKI as t2'
					      .' WHERE t1.address_id='.$this->id.'  AND t2.address_id='.$this->id.'  AND '
					      .'t1.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 1 MONTH)),"01")  AND '
					      .'t2.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 1 MONTH)),"01") ';
				} else if ($this->house_id == 22 ) {
				$this->sql='SELECT CONCAT_WS(" ",t1.mec,t1.god) as period1, CONCAT_WS(" ",t2.mec,t2.god) as period2, CONCAT_WS(" ",t3.mec,t3.god) as period3,'
					      .'CONCAT_WS(" ",t8.mec,t8.god) as period8,CONCAT_WS(" ",t4.mec,t4.god) as period4, CONCAT_WS(" ",t5.mec,t5.god) as period5,'
					      .'CONCAT_WS(" ",t6.mec,t6.god) as period6, CONCAT_WS(" ",t7.mec,t7.god) as period7,'
					      .'t1.zadol as zadol1,t2.zadol as zadol2,t3.zadol as zadol3,t8.zadol as zadol8,t4.zadol as zadol4,t5.zadol as zadol5,'
					      .'t6.zadol -t6.kzadol  as zadol6,t7.zadol as zadol7,'
					      .'(t1.zadol + t2.zadol + t3.zadol + t8.zadol + t4.zadol  + t5.zadol + t6.zadol -t6.kzadol + t7.zadol) as zadol ,'
					      .'t1.nachisleno as nachisleno1,t2.nachisleno as nachisleno2,t3.nachisleno as nachisleno3,t8.nachisleno as nachisleno8,'
					      .'t4.nachisleno  as nachisleno4,t5.nachisleno as nachisleno5,t6.nachisleno - t6.knachisleno + t6.koplata as nachisleno6,t7.nachisleno as nachisleno7,'
					      .'t1.nachisleno + t2.nachisleno + t3.nachisleno + t3.nachisleno + t4.nachisleno + t5.nachisleno + t6.nachisleno + t7.nachisleno as nachisleno,'
					      .'(t1.budjet+t1.pbudjet) as budjet1,(t2.budjet+t2.pbudjet) as budjet2,(t3.budjet+t3.pbudjet) as budjet3,'
					      .'(t4.budjet+t4.pbudjet) as budjet4,(t5.budjet+t5.pbudjet) as budjet5,(t6.budjet+t6.pbudjet) as budjet6,(t7.budjet+t7.pbudjet) as budjet7,'
					      .'((t1.budjet+t1.pbudjet) + (t2.budjet+t2.pbudjet)+(t3.budjet+t3.pbudjet) +'
					      .'(t4.budjet+t4.pbudjet) + (t5.budjet+t5.pbudjet) +(t6.budjet+t6.pbudjet) + (t7.budjet+t7.pbudjet)) as budjet ,'
					      .'t1.oplacheno as oplacheno1,t2.oplacheno as oplacheno2,t3.oplacheno as oplacheno3, t8.oplacheno as oplacheno8, '
					      .'t4.oplacheno  as oplacheno4,t5.oplacheno as oplacheno5,t6.oplacheno as oplacheno6,t7.oplacheno as oplacheno7,'
					      .'t1.oplacheno+t2.oplacheno+t3.oplacheno +t8.oplacheno + t4.oplacheno +t5.oplacheno+t6.oplacheno +t7.oplacheno as oplacheno,'
					      .'t1.subsidia as subsidia1,t2.subsidia as subsidia2,t3.subsidia as subsidia3,'
					      .'t4.subsidia as subsidia4,t5.subsidia as subsidia5,t6.subsidia as subsidia6, t7.subsidia as subsidia7,'
					      .'t1.subs as subs1,t2.subs as subs2,t3.subs as subs3,t4.subs as subs4,t5.subs as subs5,t6.subs as subs6,t7.subs as subs7, '
					      .'t1.subsidia+t2.subsidia+t3.subsidia+t4.subsidia+t5.subsidia+t6.subsidia +t7.subsidia as subsidia,t1.subs+t2.subs+t3.subs+t4.subs+'
					      .'t5.subs+t6.subs +t7.subs as subs,'
					      .'t1.dolg as dolg1,t2.dolg as dolg2,t3.dolg as dolg3,t8.dolg as dolg8,t4.dolg as dolg4,t5.dolg as dolg5,t3.fdolg,t3.fdolg as dolg9,t3.ddolg,'
					      .'t3.ddolg as dolg10,t6.dolg-t6.kdolg as dolg6 ,t7.dolg as dolg7 ,'
					      .'t1.dolg +t2.dolg+t3.dolg +t8.dolg +t4.dolg   +t5.dolg+t6.dolg -t6.kdolg +t7.dolg  as dolg '			      
					      .'FROM YIS.VODA as t1,YIS.STOKI as t2,OSBB.KVARTPLATA as t3,OSBB.TBO as t4,YIS.PODOGREV as t5,YIS.OTOPLENIE as t6 ,YIS.PTN as t7,OSBB.RFOND as t8  '
					      .' WHERE t1.address_id='.$this->id.'  AND t2.address_id='.$this->id.' AND t3.address_id='.$this->id.'  AND t4.address_id='.$this->id.' AND '
					      .' t5.address_id='.$this->id.'  AND t6.address_id='.$this->id.' AND t7.address_id='.$this->id.' AND t8.address_id='.$this->id.' AND '
					      .'t1.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 1 MONTH)),"01")  AND '
					      .'t2.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 1 MONTH)),"01") AND '
					      .'t3.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 1 MONTH)),"01")  AND '
					      .'t4.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 1 MONTH)),"01")  AND '
					      .'t5.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 1 MONTH)),"01")  AND '
					      .'t6.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 1 MONTH)),"01")  AND '
					      .'t7.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 1 MONTH)),"01")  AND '
					      .'t8.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 1 MONTH)),"01")';
				} else {
				$this->sql='SELECT CONCAT_WS(" ",t1.mec,t1.god) as period1, CONCAT_WS(" ",t2.mec,t2.god) as period2, CONCAT_WS(" ",t3.mec,t3.god) as period3,'
					      .'CONCAT_WS(" ",t3.mec,t3.god) as period8,CONCAT_WS(" ",t4.mec,t4.god) as period4, CONCAT_WS(" ",t5.mec,t5.god) as period5,'
					      .'CONCAT_WS(" ",t6.mec,t6.god) as period6, CONCAT_WS(" ",t7.mec,t7.god) as period7,'
					      .'t1.zadol as zadol1,t2.zadol as zadol2,t3.zadol as zadol3,t3.rzadol as zadol8,t4.zadol as zadol4,t5.zadol as zadol5,'
					      .'t6.zadol -t6.kzadol  as zadol6,t7.zadol as zadol7,'
					      .'(t1.zadol + t2.zadol + t3.zadol + t3.rzadol + t4.zadol  + t5.zadol + t6.zadol -t6.kzadol + t7.zadol) as zadol ,'
					      .'t1.nachisleno as nachisleno1,t2.nachisleno as nachisleno2,t3.nachisleno as nachisleno3,t3.remont as nachisleno8,'
					      .'t4.nachisleno  as nachisleno4,t5.nachisleno as nachisleno5,t6.nachisleno - t6.knachisleno + t6.koplata as nachisleno6,t7.nachisleno as nachisleno7,'
					      .'t1.nachisleno + t2.nachisleno + t3.nachisleno + t3.remont + t4.nachisleno + t5.nachisleno + t6.nachisleno + t7.nachisleno as nachisleno,'
					      .'(t1.budjet+t1.pbudjet) as budjet1,(t2.budjet+t2.pbudjet) as budjet2,(t3.budjet+t3.pbudjet) as budjet3,'
					      .'(t4.budjet+t4.pbudjet) as budjet4,(t5.budjet+t5.pbudjet) as budjet5,(t6.budjet+t6.pbudjet) as budjet6,(t7.budjet+t7.pbudjet) as budjet7,'
					      .'((t1.budjet+t1.pbudjet) + (t2.budjet+t2.pbudjet)+(t3.budjet+t3.pbudjet) +'
					      .'(t4.budjet+t4.pbudjet) + (t5.budjet+t5.pbudjet) +(t6.budjet+t6.pbudjet) + (t7.budjet+t7.pbudjet)) as budjet ,'
					      .'t1.oplacheno as oplacheno1,t2.oplacheno as oplacheno2,t3.oplacheno as oplacheno3, t3.roplacheno as oplacheno8, '
					      .'t4.oplacheno  as oplacheno4,t5.oplacheno as oplacheno5,t6.oplacheno as oplacheno6,t7.oplacheno as oplacheno7,'
					      .'t1.oplacheno+t2.oplacheno+t3.oplacheno +t3.roplacheno + t4.oplacheno +t5.oplacheno+t6.oplacheno +t7.oplacheno as oplacheno,'
					      .'t1.subsidia as subsidia1,t2.subsidia as subsidia2,t3.subsidia as subsidia3,'
					      .'t4.subsidia as subsidia4,t5.subsidia as subsidia5,t6.subsidia as subsidia6, t7.subsidia as subsidia7,'
					      .'t1.subs as subs1,t2.subs as subs2,t3.subs as subs3,t4.subs as subs4,t5.subs as subs5,t6.subs as subs6,t7.subs as subs7, '
					      .'t1.subsidia+t2.subsidia+t3.subsidia+t4.subsidia+t5.subsidia+t6.subsidia +t7.subsidia as subsidia,t1.subs+t2.subs+t3.subs+t4.subs+'
					      .'t5.subs+t6.subs +t7.subs as subs,'
					      .'t1.dolg as dolg1,t2.dolg as dolg2,t3.dolg as dolg3,t3.rdolg as dolg8,t4.dolg as dolg4,t5.dolg as dolg5,t3.fdolg,t3.fdolg as dolg9,t3.ddolg,'
					      .'t3.ddolg as dolg10,t6.dolg-t6.kdolg as dolg6 ,t7.dolg as dolg7 ,'
					      .'t1.dolg +t2.dolg+t3.dolg +t3.rdolg +t4.dolg   +t5.dolg+t6.dolg -t6.kdolg +t7.dolg  as dolg '		      
					      .'FROM YIS.VODA as t1,YIS.STOKI as t2,YIS.KVARTPLATA as t3,YIS.TBO as t4,YIS.PODOGREV as t5,YIS.OTOPLENIE as t6 ,YIS.PTN as t7  '
					      .' WHERE t1.address_id='.$this->id.'  AND t2.address_id='.$this->id.' AND t3.address_id='.$this->id.'  AND t4.address_id='.$this->id.' AND '
					      .' t5.address_id='.$this->id.'  AND t6.address_id='.$this->id.' AND t7.address_id='.$this->id.' AND '
					      .'t1.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 1 MONTH)),"01")  AND '
					      .'t2.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 1 MONTH)),"01") AND '
					      .'t3.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 1 MONTH)),"01")  AND '
					      .'t4.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 1 MONTH)),"01")  AND '
					      .'t5.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 1 MONTH)),"01")  AND '
					      .'t6.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 1 MONTH)),"01")  AND '
					      .'t7.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 1 MONTH)),"01")';
			  // print_r($this->sql); 

				}
		    break;

			    case "TekNachAllApp2":		  
			   if($this->raion_id == 2 ||  $this->raion_id == 5 || $this->raion_id == 6 || $this->raion_id == 7 || $this->raion_id == 10){ 
				  $this->sql='SELECT CONCAT_WS(" ",t1.mec,t1.god) as period1, CONCAT_WS(" ",t2.mec,t2.god) as period2,'
					      .' t1.zadol as zadol1,t2.zadol as zadol2,'
					      .' t1.zadol + t2.zadol as zadol ,'
					      .' t1.nachisleno as nachisleno1,t2.nachisleno as nachisleno2,'
					      .' t1.nachisleno + t2.nachisleno  as nachisleno,'
					      .' (t1.budjet+t1.pbudjet) as budjet1,(t2.budjet+t2.pbudjet) as budjet2,'
					      .' t1.budjet+t1.pbudjet + t2.budjet+t2.pbudjet as budjet ,'
					      .' t1.oplacheno as oplacheno1,t2.oplacheno as oplacheno2,'
					      .' t1.oplacheno+t2.oplacheno as oplacheno,'
					      .' t1.subsidia as subsidia1,t2.subsidia as subsidia2,'
					      .' t1.subs as subs1,t2.subs as subs2,'
					      .' t1.subsidia+t2.subsidia as subsidia,'
					      .' t1.subs + t2.subs as subs,'
					      .' t1.dolg as dolg1,t2.dolg as dolg2,'
					      .' t1.dolg +t2.dolg as dolg '					      
					      .'FROM YIS.VODA as t1,YIS.STOKI as t2'
					      .' WHERE t1.address_id='.$this->id.'  AND t2.address_id='.$this->id.'  AND '
					      .'t1.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 2 MONTH)),"01")  AND '
					      .'t2.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 2 MONTH)),"01") ';
			      } elseif ($this->house_id == 22 ) {
			      $this->sql='SELECT CONCAT_WS(" ",t1.mec,t1.god) as period1, CONCAT_WS(" ",t2.mec,t2.god) as period2, CONCAT_WS(" ",t3.mec,t3.god) as period3,'
					      .'CONCAT_WS(" ",t8.mec,t8.god) as period8,CONCAT_WS(" ",t4.mec,t4.god) as period4, CONCAT_WS(" ",t5.mec,t5.god) as period5,'
					      .'CONCAT_WS(" ",t6.mec,t6.god) as period6, CONCAT_WS(" ",t7.mec,t7.god) as period7,'
					      .'t1.zadol as zadol1,t2.zadol as zadol2,t3.zadol as zadol3,t8.zadol as zadol8,t4.zadol as zadol4,t5.zadol as zadol5,'
					      .'t6.zadol -t6.kzadol  as zadol6,t7.zadol as zadol7,'
					      .'(t1.zadol + t2.zadol + t3.zadol + t8.zadol + t4.zadol  + t5.zadol + t6.zadol -t6.kzadol + t7.zadol) as zadol ,'
					      .'t1.nachisleno as nachisleno1,t2.nachisleno as nachisleno2,t3.nachisleno as nachisleno3,t8.nachisleno as nachisleno8,'
					      .'t4.nachisleno  as nachisleno4,t5.nachisleno as nachisleno5,t6.nachisleno - t6.knachisleno + t6.koplata as nachisleno6,t7.nachisleno as nachisleno7,'
					      .'t1.nachisleno + t2.nachisleno + t3.nachisleno + t3.nachisleno + t4.nachisleno + t5.nachisleno + t6.nachisleno + t7.nachisleno as nachisleno,'
					      .'(t1.budjet+t1.pbudjet) as budjet1,(t2.budjet+t2.pbudjet) as budjet2,(t3.budjet+t3.pbudjet) as budjet3,'
					      .'(t4.budjet+t4.pbudjet) as budjet4,(t5.budjet+t5.pbudjet) as budjet5,(t6.budjet+t6.pbudjet) as budjet6,(t7.budjet+t7.pbudjet) as budjet7,'
					      .'((t1.budjet+t1.pbudjet) + (t2.budjet+t2.pbudjet)+(t3.budjet+t3.pbudjet) +'
					      .'(t4.budjet+t4.pbudjet) + (t5.budjet+t5.pbudjet) +(t6.budjet+t6.pbudjet) + (t7.budjet+t7.pbudjet)) as budjet ,'
					      .'t1.oplacheno as oplacheno1,t2.oplacheno as oplacheno2,t3.oplacheno as oplacheno3, t8.oplacheno as oplacheno8, '
					      .'t4.oplacheno  as oplacheno4,t5.oplacheno as oplacheno5,t6.oplacheno as oplacheno6,t7.oplacheno as oplacheno7,'
					      .'t1.oplacheno+t2.oplacheno+t3.oplacheno +t8.oplacheno + t4.oplacheno +t5.oplacheno+t6.oplacheno +t7.oplacheno as oplacheno,'
					      .'t1.subsidia as subsidia1,t2.subsidia as subsidia2,t3.subsidia as subsidia3,'
					      .'t4.subsidia as subsidia4,t5.subsidia as subsidia5,t6.subsidia as subsidia6, t7.subsidia as subsidia7,'
					      .'t1.subs as subs1,t2.subs as subs2,t3.subs as subs3,t4.subs as subs4,t5.subs as subs5,t6.subs as subs6,t7.subs as subs7, '
					      .'t1.subsidia+t2.subsidia+t3.subsidia+t4.subsidia+t5.subsidia+t6.subsidia +t7.subsidia as subsidia,t1.subs+t2.subs+t3.subs+t4.subs+'
					      .'t5.subs+t6.subs +t7.subs as subs,'
					      .'t1.dolg as dolg1,t2.dolg as dolg2,t3.dolg as dolg3,t8.dolg as dolg8,t4.dolg as dolg4,t5.dolg as dolg5,t3.fdolg,t3.fdolg as dolg9,t3.ddolg,'
					      .'t3.ddolg as dolg10,t6.dolg-t6.kdolg as dolg6 ,t7.dolg as dolg7 ,'
					      .'t1.dolg +t2.dolg+t3.dolg +t8.dolg +t4.dolg   +t5.dolg+t6.dolg -t6.kdolg +t7.dolg  as dolg '					      
					      .'FROM YIS.VODA as t1,YIS.STOKI as t2,OSBB.KVARTPLATA as t3,OSBB.TBO as t4,YIS.PODOGREV as t5,YIS.OTOPLENIE as t6 ,YIS.PTN as t7,OSBB.RFOND as t8  '
					      .' WHERE t1.address_id='.$this->id.'  AND t2.address_id='.$this->id.' AND t3.address_id='.$this->id.'  AND t4.address_id='.$this->id.' AND '
					      .' t5.address_id='.$this->id.'  AND t6.address_id='.$this->id.' AND t7.address_id='.$this->id.' AND t8.address_id='.$this->id.' AND '
					      .'t1.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 2 MONTH)),"01")  AND '
					      .'t2.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 2 MONTH)),"01") AND '
					      .'t3.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 2 MONTH)),"01")  AND '
					      .'t4.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 2 MONTH)),"01")  AND '
					      .'t5.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 2 MONTH)),"01")  AND '
					      .'t6.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 2 MONTH)),"01")  AND '
					      .'t7.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 2 MONTH)),"01")  AND '
					      .'t8.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 2 MONTH)),"01")';

				} else {
				$this->sql='SELECT CONCAT_WS(" ",t1.mec,t1.god) as period1, CONCAT_WS(" ",t2.mec,t2.god) as period2, CONCAT_WS(" ",t3.mec,t3.god) as period3,'
					      .'CONCAT_WS(" ",t3.mec,t3.god) as period8,CONCAT_WS(" ",t4.mec,t4.god) as period4, CONCAT_WS(" ",t5.mec,t5.god) as period5,'
					      .'CONCAT_WS(" ",t6.mec,t6.god) as period6, CONCAT_WS(" ",t7.mec,t7.god) as period7,'
					      .'t1.zadol as zadol1,t2.zadol as zadol2,t3.zadol as zadol3,t3.rzadol as zadol8,t4.zadol as zadol4,t5.zadol as zadol5,'
					      .'t6.zadol -t6.kzadol  as zadol6,t7.zadol as zadol7,'
					      .'(t1.zadol + t2.zadol + t3.zadol + t3.rzadol + t4.zadol  + t5.zadol + t6.zadol -t6.kzadol + t7.zadol) as zadol ,'
					      .'t1.nachisleno as nachisleno1,t2.nachisleno as nachisleno2,t3.nachisleno as nachisleno3,t3.remont as nachisleno8,'
					      .'t4.nachisleno  as nachisleno4,t5.nachisleno as nachisleno5,t6.nachisleno - t6.knachisleno + t6.koplata as nachisleno6,t7.nachisleno as nachisleno7,'
					      .'t1.nachisleno + t2.nachisleno + t3.nachisleno + t3.remont + t4.nachisleno + t5.nachisleno + t6.nachisleno + t7.nachisleno as nachisleno,'
					      .'(t1.budjet+t1.pbudjet) as budjet1,(t2.budjet+t2.pbudjet) as budjet2,(t3.budjet+t3.pbudjet) as budjet3,'
					      .'(t4.budjet+t4.pbudjet) as budjet4,(t5.budjet+t5.pbudjet) as budjet5,(t6.budjet+t6.pbudjet) as budjet6,(t7.budjet+t7.pbudjet) as budjet7,'
					      .'((t1.budjet+t1.pbudjet) + (t2.budjet+t2.pbudjet)+(t3.budjet+t3.pbudjet) +'
					      .'(t4.budjet+t4.pbudjet) + (t5.budjet+t5.pbudjet) +(t6.budjet+t6.pbudjet) + (t7.budjet+t7.pbudjet)) as budjet ,'
					      .'t1.oplacheno as oplacheno1,t2.oplacheno as oplacheno2,t3.oplacheno as oplacheno3, t3.roplacheno as oplacheno8, '
					      .'t4.oplacheno  as oplacheno4,t5.oplacheno as oplacheno5,t6.oplacheno as oplacheno6,t7.oplacheno as oplacheno7,'
					      .'t1.oplacheno+t2.oplacheno+t3.oplacheno +t3.roplacheno + t4.oplacheno +t5.oplacheno+t6.oplacheno +t7.oplacheno as oplacheno,'
					      .'t1.subsidia as subsidia1,t2.subsidia as subsidia2,t3.subsidia as subsidia3,'
					      .'t4.subsidia as subsidia4,t5.subsidia as subsidia5,t6.subsidia as subsidia6, t7.subsidia as subsidia7,'
					      .'t1.subs as subs1,t2.subs as subs2,t3.subs as subs3,t4.subs as subs4,t5.subs as subs5,t6.subs as subs6,t7.subs as subs7, '
					      .'t1.subsidia+t2.subsidia+t3.subsidia+t4.subsidia+t5.subsidia+t6.subsidia +t7.subsidia as subsidia,t1.subs+t2.subs+t3.subs+t4.subs+'
					      .'t5.subs+t6.subs +t7.subs as subs,'
					      .'t1.dolg as dolg1,t2.dolg as dolg2,t3.dolg as dolg3,t3.rdolg as dolg8,t4.dolg as dolg4,t5.dolg as dolg5,t3.fdolg,t3.fdolg as dolg9,t3.ddolg,'
					      .'t3.ddolg as dolg10,t6.dolg-t6.kdolg as dolg6 ,t7.dolg as dolg7 ,'
					      .'t1.dolg +t2.dolg+t3.dolg +t3.rdolg +t4.dolg   +t5.dolg+t6.dolg -t6.kdolg +t7.dolg  as dolg '				      
					      .'FROM YIS.VODA as t1,YIS.STOKI as t2,YIS.KVARTPLATA as t3,YIS.TBO as t4,YIS.PODOGREV as t5,YIS.OTOPLENIE as t6 ,YIS.PTN as t7  '
					      .' WHERE t1.address_id='.$this->id.'  AND t2.address_id='.$this->id.' AND t3.address_id='.$this->id.'  AND t4.address_id='.$this->id.' AND '
					      .' t5.address_id='.$this->id.'  AND t6.address_id='.$this->id.' AND t7.address_id='.$this->id.' AND '
					      .'t1.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 2 MONTH)),"01")  AND '
					      .'t2.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 2 MONTH)),"01") AND '
					      .'t3.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 2 MONTH)),"01")  AND '
					      .'t4.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 2 MONTH)),"01")  AND '
					      .'t5.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 2 MONTH)),"01")  AND '
					      .'t6.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 2 MONTH)),"01")  AND '
					      .'t7.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 2 MONTH)),"01")';
					      
			  }
			  			 //  print_r($this->sql); 

		    break;
		    case "TekNachAllApp3":		  
			   if($this->raion_id == 2 ||  $this->raion_id == 5 || $this->raion_id == 6 || $this->raion_id == 7 || $this->raion_id == 10){ 
				  $this->sql='SELECT CONCAT_WS(" ",t1.mec,t1.god) as period1, CONCAT_WS(" ",t2.mec,t2.god) as period2,'
					      .' t1.zadol as zadol1,t2.zadol as zadol2,'
					      .' t1.zadol + t2.zadol as zadol ,'
					      .' t1.nachisleno as nachisleno1,t2.nachisleno as nachisleno2,'
					      .' t1.nachisleno + t2.nachisleno  as nachisleno,'
					      .' (t1.budjet+t1.pbudjet) as budjet1,(t2.budjet+t2.pbudjet) as budjet2,'
					      .' t1.budjet+t1.pbudjet + t2.budjet+t2.pbudjet as budjet ,'
					      .' t1.oplacheno as oplacheno1,t2.oplacheno as oplacheno2,'
					      .' t1.oplacheno+t2.oplacheno as oplacheno,'
					      .' t1.subsidia as subsidia1,t2.subsidia as subsidia2,'
					      .' t1.subs as subs1,t2.subs as subs2,'
					      .' t1.subsidia+t2.subsidia as subsidia,'
					      .' t1.subs + t2.subs as subs,'
					      .' t1.dolg as dolg1,t2.dolg as dolg2,'
					      .' t1.dolg +t2.dolg as dolg '					      
					      .'FROM YIS.VODA as t1,YIS.STOKI as t2'
					      .' WHERE t1.address_id='.$this->id.'  AND t2.address_id='.$this->id.'  AND '
					      .'t1.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 3 MONTH)),"01")  AND '
					      .'t2.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 3 MONTH)),"01") ';
			    } else if ($this->house_id == 22 ) {
			    $this->sql='SELECT CONCAT_WS(" ",t1.mec,t1.god) as period1, CONCAT_WS(" ",t2.mec,t2.god) as period2, CONCAT_WS(" ",t3.mec,t3.god) as period3,'
					      .'CONCAT_WS(" ",t8.mec,t8.god) as period8,CONCAT_WS(" ",t4.mec,t4.god) as period4, CONCAT_WS(" ",t5.mec,t5.god) as period5,'
					      .'CONCAT_WS(" ",t6.mec,t6.god) as period6, CONCAT_WS(" ",t7.mec,t7.god) as period7,'
					      .'t1.zadol as zadol1,t2.zadol as zadol2,t3.zadol as zadol3,t8.zadol as zadol8,t4.zadol as zadol4,t5.zadol as zadol5,'
					      .'t6.zadol -t6.kzadol  as zadol6,t7.zadol as zadol7,'
					      .'(t1.zadol + t2.zadol + t3.zadol + t8.zadol + t4.zadol  + t5.zadol + t6.zadol -t6.kzadol + t7.zadol) as zadol ,'
					      .'t1.nachisleno as nachisleno1,t2.nachisleno as nachisleno2,t3.nachisleno as nachisleno3,t8.nachisleno as nachisleno8,'
					      .'t4.nachisleno  as nachisleno4,t5.nachisleno as nachisleno5,t6.nachisleno - t6.knachisleno + t6.koplata as nachisleno6,t7.nachisleno as nachisleno7,'
					      .'t1.nachisleno + t2.nachisleno + t3.nachisleno + t3.nachisleno + t4.nachisleno + t5.nachisleno + t6.nachisleno + t7.nachisleno as nachisleno,'
					      .'(t1.budjet+t1.pbudjet) as budjet1,(t2.budjet+t2.pbudjet) as budjet2,(t3.budjet+t3.pbudjet) as budjet3,'
					      .'(t4.budjet+t4.pbudjet) as budjet4,(t5.budjet+t5.pbudjet) as budjet5,(t6.budjet+t6.pbudjet) as budjet6,(t7.budjet+t7.pbudjet) as budjet7,'
					      .'((t1.budjet+t1.pbudjet) + (t2.budjet+t2.pbudjet)+(t3.budjet+t3.pbudjet) +'
					      .'(t4.budjet+t4.pbudjet) + (t5.budjet+t5.pbudjet) +(t6.budjet+t6.pbudjet) + (t7.budjet+t7.pbudjet)) as budjet ,'
					      .'t1.oplacheno as oplacheno1,t2.oplacheno as oplacheno2,t3.oplacheno as oplacheno3, t8.oplacheno as oplacheno8, '
					      .'t4.oplacheno  as oplacheno4,t5.oplacheno as oplacheno5,t6.oplacheno as oplacheno6,t7.oplacheno as oplacheno7,'
					      .'t1.oplacheno+t2.oplacheno+t3.oplacheno +t8.oplacheno + t4.oplacheno +t5.oplacheno+t6.oplacheno +t7.oplacheno as oplacheno,'
					      .'t1.subsidia as subsidia1,t2.subsidia as subsidia2,t3.subsidia as subsidia3,'
					      .'t4.subsidia as subsidia4,t5.subsidia as subsidia5,t6.subsidia as subsidia6, t7.subsidia as subsidia7,'
					      .'t1.subs as subs1,t2.subs as subs2,t3.subs as subs3,t4.subs as subs4,t5.subs as subs5,t6.subs as subs6,t7.subs as subs7, '
					      .'t1.subsidia+t2.subsidia+t3.subsidia+t4.subsidia+t5.subsidia+t6.subsidia +t7.subsidia as subsidia,t1.subs+t2.subs+t3.subs+t4.subs+'
					      .'t5.subs+t6.subs +t7.subs as subs,'
					      .'t1.dolg as dolg1,t2.dolg as dolg2,t3.dolg as dolg3,t8.dolg as dolg8,t4.dolg as dolg4,t5.dolg as dolg5,t3.fdolg,t3.fdolg as dolg9,t3.ddolg,'
					      .'t3.ddolg as dolg10,t6.dolg-t6.kdolg as dolg6 ,t7.dolg as dolg7 ,'
					      .'t1.dolg +t2.dolg+t3.dolg +t8.dolg +t4.dolg   +t5.dolg+t6.dolg -t6.kdolg +t7.dolg  as dolg '			
					      .'FROM YIS.VODA as t1,YIS.STOKI as t2,OSBB.KVARTPLATA as t3,OSBB.TBO as t4,YIS.PODOGREV as t5,YIS.OTOPLENIE as t6 ,YIS.PTN as t7,OSBB.RFOND as t8  '
					      .' WHERE t1.address_id='.$this->id.'  AND t2.address_id='.$this->id.' AND t3.address_id='.$this->id.'  AND t4.address_id='.$this->id.' AND '
					      .' t5.address_id='.$this->id.'  AND t6.address_id='.$this->id.' AND t7.address_id='.$this->id.' AND t8.address_id='.$this->id.' AND '
					      .'t1.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 3 MONTH)),"01")  AND '
					      .'t2.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 3 MONTH)),"01") AND '
					      .'t3.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 3 MONTH)),"01")  AND '
					      .'t4.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 3 MONTH)),"01")  AND '
					      .'t5.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 3 MONTH)),"01")  AND '
					      .'t6.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 3 MONTH)),"01")  AND '
					      .'t7.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 3 MONTH)),"01")  AND '
					      .'t8.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 3 MONTH)),"01")';

				} else {
				$this->sql='SELECT CONCAT_WS(" ",t1.mec,t1.god) as period1, CONCAT_WS(" ",t2.mec,t2.god) as period2, CONCAT_WS(" ",t3.mec,t3.god) as period3,'
					      .'CONCAT_WS(" ",t3.mec,t3.god) as period8,CONCAT_WS(" ",t4.mec,t4.god) as period4, CONCAT_WS(" ",t5.mec,t5.god) as period5,'
					      .'CONCAT_WS(" ",t6.mec,t6.god) as period6, CONCAT_WS(" ",t7.mec,t7.god) as period7,'
					      .'t1.zadol as zadol1,t2.zadol as zadol2,t3.zadol as zadol3,t3.rzadol as zadol8,t4.zadol as zadol4,t5.zadol as zadol5,'
					      .'t6.zadol -t6.kzadol  as zadol6,t7.zadol as zadol7,'
					      .'(t1.zadol + t2.zadol + t3.zadol + t3.rzadol + t4.zadol  + t5.zadol + t6.zadol -t6.kzadol + t7.zadol) as zadol ,'
					      .'t1.nachisleno as nachisleno1,t2.nachisleno as nachisleno2,t3.nachisleno as nachisleno3,t3.remont as nachisleno8,'
					      .'t4.nachisleno  as nachisleno4,t5.nachisleno as nachisleno5,t6.nachisleno - t6.knachisleno + t6.koplata as nachisleno6,t7.nachisleno as nachisleno7,'
					      .'t1.nachisleno + t2.nachisleno + t3.nachisleno + t3.remont + t4.nachisleno + t5.nachisleno + t6.nachisleno + t7.nachisleno as nachisleno,'
					      .'(t1.budjet+t1.pbudjet) as budjet1,(t2.budjet+t2.pbudjet) as budjet2,(t3.budjet+t3.pbudjet) as budjet3,'
					      .'(t4.budjet+t4.pbudjet) as budjet4,(t5.budjet+t5.pbudjet) as budjet5,(t6.budjet+t6.pbudjet) as budjet6,(t7.budjet+t7.pbudjet) as budjet7,'
					      .'((t1.budjet+t1.pbudjet) + (t2.budjet+t2.pbudjet)+(t3.budjet+t3.pbudjet) +'
					      .'(t4.budjet+t4.pbudjet) + (t5.budjet+t5.pbudjet) +(t6.budjet+t6.pbudjet) + (t7.budjet+t7.pbudjet)) as budjet ,'
					      .'t1.oplacheno as oplacheno1,t2.oplacheno as oplacheno2,t3.oplacheno as oplacheno3, t3.roplacheno as oplacheno8, '
					      .'t4.oplacheno  as oplacheno4,t5.oplacheno as oplacheno5,t6.oplacheno as oplacheno6,t7.oplacheno as oplacheno7,'
					      .'t1.oplacheno+t2.oplacheno+t3.oplacheno +t3.roplacheno + t4.oplacheno +t5.oplacheno+t6.oplacheno +t7.oplacheno as oplacheno,'
					      .'t1.subsidia as subsidia1,t2.subsidia as subsidia2,t3.subsidia as subsidia3,'
					      .'t4.subsidia as subsidia4,t5.subsidia as subsidia5,t6.subsidia as subsidia6, t7.subsidia as subsidia7,'
					      .'t1.subs as subs1,t2.subs as subs2,t3.subs as subs3,t4.subs as subs4,t5.subs as subs5,t6.subs as subs6,t7.subs as subs7, '
					      .'t1.subsidia+t2.subsidia+t3.subsidia+t4.subsidia+t5.subsidia+t6.subsidia +t7.subsidia as subsidia,t1.subs+t2.subs+t3.subs+t4.subs+'
					      .'t5.subs+t6.subs +t7.subs as subs,'
					      .'t1.dolg as dolg1,t2.dolg as dolg2,t3.dolg as dolg3,t3.rdolg as dolg8,t4.dolg as dolg4,t5.dolg as dolg5,t3.fdolg,t3.fdolg as dolg9,t3.ddolg,'
					      .'t3.ddolg as dolg10,t6.dolg-t6.kdolg as dolg6 ,t7.dolg as dolg7 ,'
					      .'t1.dolg +t2.dolg+t3.dolg +t3.rdolg +t4.dolg   +t5.dolg+t6.dolg -t6.kdolg +t7.dolg  as dolg '		
					      .'FROM YIS.VODA as t1,YIS.STOKI as t2,YIS.KVARTPLATA as t3,YIS.TBO as t4,YIS.PODOGREV as t5,YIS.OTOPLENIE as t6 ,YIS.PTN as t7  '
					      .' WHERE t1.address_id='.$this->id.'  AND t2.address_id='.$this->id.' AND t3.address_id='.$this->id.'  AND t4.address_id='.$this->id.' AND '
					      .' t5.address_id='.$this->id.'  AND t6.address_id='.$this->id.' AND t7.address_id='.$this->id.' AND '
					      .'t1.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 3 MONTH)),"01")  AND '
					      .'t2.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 3 MONTH)),"01") AND '
					      .'t3.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 3 MONTH)),"01")  AND '
					      .'t4.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 3 MONTH)),"01")  AND '
					      .'t5.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 3 MONTH)),"01")  AND '
					      .'t6.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 3 MONTH)),"01")  AND '
					      .'t7.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 3 MONTH)),"01")';
			 //  print_r($this->sql); 
			  }
		    break;
		    case "TekNachAllOrg":		  
				  $this->sql='SELECT CONCAT_WS(" ",t1.mec,t1.god) as period1, CONCAT_WS(" ",t2.mec,t2.god) as period2,t1.zadol as zadol1,t2.zadol as zadol2,'
					      .' t1.zadol + t2.zadol as zadol ,t1.itogo as nachisleno1,t2.itogo as nachisleno2, t1.itogo + t2.itogo  as nachisleno,'
					      .' t1.oplacheno as oplacheno1,t2.oplacheno as oplacheno2,t1.oplacheno+t2.oplacheno as oplacheno, t1.dolg as dolg1,t2.dolg as dolg2,t1.dolg +t2.dolg as dolg '      
					      .'FROM YISGRAND.VODA as t1,YISGRAND.STOKI as t2'
					      .' WHERE t1.filial_id='.$this->filial_id.'  AND t2.filial_id='.$this->filial_id.'  AND t1.data=CONCAT(EXTRACT(YEAR_MONTH FROM curdate()),"01")  AND '
					      .'t2.data=CONCAT(EXTRACT(YEAR_MONTH FROM curdate()),"01") ';
				
		    break;
		     case "TekNachAllOrg1":		  
				  $this->sql='SELECT CONCAT_WS(" ",t1.mec,t1.god) as period1, CONCAT_WS(" ",t2.mec,t2.god) as period2,t1.zadol as zadol1,t2.zadol as zadol2,'
					      .' t1.zadol + t2.zadol as zadol ,t1.itogo as nachisleno1,t2.itogo as nachisleno2, t1.itogo + t2.itogo  as nachisleno,'
					      .' t1.oplacheno as oplacheno1,t2.oplacheno as oplacheno2,t1.oplacheno+t2.oplacheno as oplacheno, t1.dolg as dolg1,t2.dolg as dolg2,t1.dolg +t2.dolg as dolg '      
					      .'FROM YISGRAND.VODA as t1,YISGRAND.STOKI as t2'
					      .' WHERE t1.filial_id='.$this->filial_id.'   AND t2.filial_id='.$this->filial_id.'   AND t1.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 1 MONTH)),"01")  AND '
					      .'t2.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 1 MONTH)),"01") ';
		    break;
		     case "TekNachAllOrg2":		  
				  $this->sql='SELECT CONCAT_WS(" ",t1.mec,t1.god) as period1, CONCAT_WS(" ",t2.mec,t2.god) as period2,t1.zadol as zadol1,t2.zadol as zadol2,'
					      .' t1.zadol + t2.zadol as zadol ,t1.itogo as nachisleno1,t2.itogo as nachisleno2, t1.itogo + t2.itogo  as nachisleno,'
					      .' t1.oplacheno as oplacheno1,t2.oplacheno as oplacheno2,t1.oplacheno+t2.oplacheno as oplacheno, t1.dolg as dolg1,t2.dolg as dolg2,t1.dolg +t2.dolg as dolg '      
					      .'FROM YISGRAND.VODA as t1,YISGRAND.STOKI as t2'
					      .' WHERE t1.filial_id='.$this->filial_id.'   AND t2.filial_id='.$this->filial_id.'   AND t1.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 2 MONTH)),"01")  AND '
					      .'t2.data=CONCAT(EXTRACT(YEAR_MONTH FROM DATE_SUB(curdate(), INTERVAL 2 MONTH)),"01") ';
		    break;
			case "AppTekOplata":
			 $this->sql='SELECT rec_id,address_id,address, god, data,kvartplata,remont,ptn,otoplenie,podogrev,voda,stoki,tbo,summa,prixod,kassa,nomer,operator,data_in ,CASE WHEN data = "'
			.$this->t.'" AND operator = "'.$this->login.'" THEN 1 ELSE 0 END as chek FROM YIS.OPLATA  WHERE YIS.OPLATA.address_id='.$this->id.' ORDER BY YIS.OPLATA.rec_id DESC LIMIT 1';
			// print($this->sql);   
		    break;
	    case "AppTekOplataFive":
			 $this->sql='SELECT rec_id,address, god, data,kvartplata,remont,ptn,otoplenie,podogrev,voda,stoki,tbo,summa,prixod,kassa,nomer,operator,data_in ,CASE WHEN data = "'
			.$this->t.'" AND operator = "'.$this->login.'" THEN 1 ELSE 0 END as chek FROM YIS.OPLATA  WHERE YIS.OPLATA.address_id='.$this->id.' ORDER BY YIS.OPLATA.rec_id DESC LIMIT 5';
			// print($this->sql);   
		    break;
			case "AppVodomerKassa"://применяется
				  $this->sql='SELECT YIS.VODOMER.vodomer_id,'
					    .'YIS.VODOMER.address_id,'
					    .'YIS.VODOMER.address,'
					    .'YIS.VODOMER.house_id,'
					    .'YIS.VODOMER.out,'
					    .'YIS.VODOMER.voda,'
					    .'YIS.VODOMER.st,'
					    .'YIS.VODOMER.place,'
					    .'YIS.VODOMER.obr,'
					    .'YIS.VODOMER.nomer,'
					    .'YIS.VODOMER.model_id,'
					    .'YIS.VODOMER.model,'
					    .'YIS.VODOMER.note,'
					    .'YIS.VODOMER.position '
					    .' FROM YIS.VODOMER '
					    .' WHERE YIS.VODOMER.address_id='.$this->id.'  AND YIS.VODOMER.spisan=0 AND YIS.VODOMER.out=0';
			break;

			case "TekPokTeplomerov":			
			      $this->sql='SELECT YIS.VODOMER.address_id,YIS.VODOMER.type,UCASE(YIS.VODOMER.place) as place,YIS.VODOMER.nomer,YIS.VODOMER.model,YIS.VODOMER.obr,DATE_FORMAT(max(YIS.WATER.data),"%d-%m-%Y") as fdate,'
				      .'max(YIS.WATER.pred) as pred,max(YIS.WATER.tek) as tek,YIS.WATER.operator FROM YIS.VODOMER,YIS.WATER  WHERE YIS.VODOMER.address_id='.$this->id.' AND YIS.VODOMER.nomer= YIS.WATER.nomer AND '
				      .'YIS.WATER.address_id='.$this->id.' GROUP BY YIS.VODOMER.nomer,data ORDER BY YIS.WATER.data DESC ';
			       //print_r($this->sql); 
			break;
		} // End of Switch ($what)
		
	
		

		$this->result = $_db->query($this->sql) or die('Connect Error in '.$this->what.'(' .  $this->sql . ') ' . $_db->connect_error);
		
		while ($this->row = $this->result->fetch_assoc()) {
			array_push($this->res, $this->row);
		}
		$this->results['data']	= $this->res;
		
		return $this->results;
	}

public function newOplata(stdClass $params)
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

		if(isset($params->what) && ($params->what)) {
		 $this->what = $params->what;
		} else {
		  $this->what = null;
		}
		if(isset($params->cbDo1) && ($params->cbDo1)) {
		  $this->cbDo1 = (int) $params->cbDo1;
		} else {
		  $this->cbDo1 = 0;
		}
		if(isset($params->cbDo2) && ($params->cbDo2)) {
		  $this->cbDo2 = (int) $params->cbDo2;
		} else {
		  $this->cbDo2 = 0;
		}
		if(isset($params->cbDo3) && ($params->cbDo3)) {
		  $this->cbDo3 = (int) $params->cbDo3;
		} else {
		  $this->cbDo3 = 0;
		}
		if(isset($params->cbDo4) && ($params->cbDo4)) {
		  $this->cbDo4 = (int) $params->cbDo4;
		} else {
		  $this->cbDo4 = 0;
		}
		if(isset($params->cbDo5) && ($params->cbDo5)) {
		  $this->cbDo5 = (int) $params->cbDo5;
		} else {
		  $this->cbDo5 = 0;
		}
		if(isset($params->cbDo6) && ($params->cbDo6)) {
		  $this->cbDo6 = (int) $params->cbDo6;
		} else {
		  $this->cbDo6 = 0;
		}
		if(isset($params->cbDo7) && ($params->cbDo7)) {
		  $this->cbDo7 = (int) $params->cbDo7;
		} else {
		  $this->cbDo7 = 0;
		}
		if(isset($params->cbDo8) && ($params->cbDo8)) {
		  $this->cbDo8 = (int) $params->cbDo8;
		} else {
		  $this->cbDo8 = 0;
		}
		if(isset($params->cbNext1) && ($params->cbNext1)) {
		  $this->cbNext1 = (int) $params->cbNext1;
		} else {
		  $this->cbNext1 = 0;
		}
		if(isset($params->cbNext2) && ($params->cbNext2)) {
		  $this->cbNext2 = (int) $params->cbNext2;
		} else {
		  $this->cbNext2 = 0;
		}
		if(isset($params->cbNext3) && ($params->cbNext3)) {
		  $this->cbNext3 = (int) $params->cbNext3;
		} else {
		  $this->cbNext3 = 0;
		}
		if(isset($params->cbNext4) && ($params->cbNext4)) {
		  $this->cbNext4 = (int) $params->cbNext4;
		} else {
		  $this->cbNext4 = 0;
		}
		if(isset($params->cbNext5) && ($params->cbNext5)) {
		  $this->cbNext5 = (int) $params->cbNext5;
		} else {
		  $this->cbNext5 = 0;
		}
		if(isset($params->cbNext6) && ($params->cbNext6)) {
		  $this->cbNext6 = (int) $params->cbNext6;
		} else {
		  $this->cbNext6 = 0;
		}
		if(isset($params->cbNext7) && ($params->cbNext7)) {
		  $this->cbNext7 = (int) $params->cbNext7;
		} else {
		  $this->cbNext7 = 0;
		}
		if(isset($params->cbNext8) && ($params->cbNext8)) {
		  $this->cbNext8 = (int) $params->cbNext8;
		} else {
		  $this->cbNext8 = 0;
		}
		if(isset($params->zadol1) && ($params->zadol1)) {
		  $this->zadol1 =  $params->zadol1;
		} else {
		  $this->zadol1 = 0;
		}
		if(isset($params->zadol2) && ($params->zadol2)) {
		  $this->zadol2 =  $params->zadol2;
		} else {
		  $this->zadol2 = 0;
		}
		if(isset($params->zadol3) && ($params->zadol3)) {
		  $this->zadol3 =  $params->zadol3;
		} else {
		  $this->zadol3 = 0;
		}
		if(isset($params->zadol4) && ($params->zadol4)) {
		  $this->zadol4 =  $params->zadol4;
		} else {
		  $this->zadol4 = 0;
		}
		if(isset($params->zadol5) && ($params->zadol5)) {
		  $this->zadol5 =  $params->zadol5;
		} else {
		  $this->zadol5 = 0;
		}
		if(isset($params->zadol6) && ($params->zadol6)) {
		  $this->zadol6 =  $params->zadol6;
		} else {
		  $this->zadol6 = 0;
		}
		if(isset($params->zadol7) && ($params->zadol7)) {
		  $this->zadol7 =  $params->zadol7;
		} else {
		  $this->zadol7 = 0;
		}
		if(isset($params->zadol8) && ($params->zadol8)) {
		  $this->zadol8 =  $params->zadol8;
		} else {
		  $this->zadol8 = 0;
		}
		if(isset($params->dolg1) && ($params->dolg1)) {
		  $this->dolg1 =  $params->dolg1;
		} else {
		  $this->dolg1 = 0;
		}
		if(isset($params->dolg2) && ($params->dolg2)) {
		  $this->dolg2 =  $params->dolg2;
		} else {
		  $this->dolg2 = 0;
		}
		if(isset($params->dolg3) && ($params->dolg3)) {
		  $this->dolg3 =  $params->dolg3;
		} else {
		  $this->dolg3 = 0;
		}
		if(isset($params->dolg4) && ($params->dolg4)) {
		  $this->dolg4 =  $params->dolg4;
		} else {
		  $this->dolg4 = 0;
		}
		if(isset($params->dolg5) && ($params->dolg5)) {
		  $this->dolg5 =  $params->dolg5;
		} else {
		  $this->dolg5 = 0;
		}
		if(isset($params->dolg6) && ($params->dolg6)) {
		  $this->dolg6 =  $params->dolg6;
		} else {
		  $this->dolg6 = 0;
		}
		if(isset($params->dolg7) && ($params->dolg7)) {
		  $this->dolg7 =  $params->dolg7;
		} else {
		  $this->dolg7 = 0;
		}
		if(isset($params->dolg8) && ($params->dolg8)) {
		  $this->dolg8 =  $params->dolg8;
		} else {
		  $this->dolg8 = 0;
		}
		if(isset($params->dolg9) && ($params->dolg9)) {
		  $this->dolg9 =  $params->dolg9;
		} else {
		  $this->dolg9 = 0;
		}
		if(isset($params->dolg10) && ($params->dolg10)) {
		  $this->dolg10 =  $params->dolg10;
		} else {
		  $this->dolg10 = 0;
		}
		if(isset($params->newOplata) && ($params->newOplata)) {
		  $this->newOplata =  $params->newOplata;
		} else {
		  $this->newOplata = 0;
		}
		if(isset($params->newOplataOrg) && ($params->newOplataOrg)) {
		  $this->newOplataOrg =  $params->newOplataOrg;
		} else {
		  $this->newOplataOrg = 0;
		}
		if(isset($params->address_id) && ($params->address_id)) {
		  $this->address_id = (int) $params->address_id;
		} else {
		  $this->address_id = 0;
		}
		if(isset($params->filial_id) && ($params->filial_id)) {
		  $this->filial_id = (int) $params->filial_id;
		} else {
		  $this->filial_id = 0;
		}
		if(isset($params->prixod_id) && ($params->prixod_id)) {
		  $this->prixod_id = (int) $params->prixod_id;
		} else {
		  $this->prixod_id = 0;
		}
		if(isset($params->user_id) && ($params->user_id)) {
		  $this->user_id = (int) $params->user_id;
		} else {
		  $this->user_id = 0;
		}
		if(isset($params->date_oplata) && ($params->date_oplata)) {
		  $this->date_oplata= $params->date_oplata;
		} else {
		   $this->date_oplata='';
		}	
		
		switch ($this->what) {

			case "AppTekOplata":			
			      $this->sql='CALL YISGRAND.newOplataApp("'
					.$this->address_id.'","'
					.$this->cbDo1.'","'
					.$this->cbDo2.'","'
					.$this->cbDo3.'","'
					.$this->cbDo4.'","'
					.$this->cbDo5.'","'
					.$this->cbDo6.'","'
					.$this->cbDo7.'","'
					.$this->cbDo8.'","'
					.$this->cbNext1.'","'
					.$this->cbNext2.'","'
					.$this->cbNext3.'","'
					.$this->cbNext4.'","'
					.$this->cbNext5.'","'
					.$this->cbNext6.'","'
					.$this->cbNext7.'","'
					.$this->cbNext8.'","'
					.$this->zadol1.'","'
					.$this->zadol2.'","'
					.$this->zadol3.'","'
					.$this->zadol4.'","'
					.$this->zadol5.'","'
					.$this->zadol6.'","'
					.$this->zadol7.'","'
					.$this->zadol8.'","'
					.$this->dolg1.'","'
					.$this->dolg2.'","'
					.$this->dolg3.'","'
					.$this->dolg4.'","'
					.$this->dolg5.'","'
					.$this->dolg6.'","'
					.$this->dolg7.'","'
					.$this->dolg8.'","'
					.$this->newOplata.'","'
					.$this->user_id.'","'
					.$this->prixod_id.'","'
					.$this->date_oplata.'", @success, @msg)';
			break;
			case "OplataDolgMgkc":			
			      $this->sql='CALL YISGRAND.OplataDolgMgkc("'.$this->address_id.'","'.$this->dolg9.'","'.$this->user_id.'","'.$this->prixod_id.'","'.$this->date_oplata.'", @success, @msg)';
					//print( $this->sql);

			break;
			case "OplataDolgDobrobut":			
			      $this->sql='CALL YISGRAND.OplataDolgDobrobut("'.$this->address_id.'","'.$this->dolg10.'","'.$this->user_id.'","'.$this->prixod_id.'","'.$this->date_oplata.'", @success, @msg)';
					//print( $this->sql);

			break;
			case "OrgTekOplata":			
			      $this->sql='CALL YISGRAND.newOplataOrg("'
					.$this->filial_id.'","'
					.$this->cbDo1.'","'
					.$this->cbDo2.'","'
					.$this->cbDo3.'","'
					.$this->cbDo4.'","'
					.$this->cbNext1.'","'
					.$this->cbNext2.'","'
					.$this->cbNext3.'","'
					.$this->cbNext4.'","'
					.$this->zadol1.'","'
					.$this->zadol2.'","'
					.$this->zadol3.'","'
					.$this->zadol4.'","'
					.$this->dolg1.'","'
					.$this->dolg2.'","'
					.$this->dolg3.'","'
					.$this->dolg4.'","'
					.$this->newOplataOrg.'","'
					.$this->user_id.'","'
					.$this->prixod_id.'","'
					.$this->date_oplata.'",'
					.' @success, @msg)';
			break;
		}
//print( $this->sql);
		$this->result = $_db->query($this->sql) or die('Connect Error in '.$this->what.'(' .  $this->sql . ') ' . $_db->connect_error);
		
		$this->sql_callback='SELECT @success,@msg';

		$this->res_callback = $_db->query($this->sql_callback) or die('Connect Error in '.$this->what.'(' .  $this->sql_callback . ') ' . $_db->connect_error);
		
		while ($this->row = $this->res_callback->fetch_assoc()) {
			$this->results['success'] = $this->row['@success'];
			$this->results['msg']	=$this->row['@msg'];
		}			
		return $this->results;
	      }
public function delOplata(stdClass $params)
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


		$array = (array) $params;
		foreach ( $array as $key => $value ) 
		  {
		  if(isset($value)) { 
					if (is_int($value)) { $this->$key= (int)$value;}
					else if (is_float($value)) { $this->$key= $value;}
					else {$this->$key =$value;}
		  }
		}
		$this->sql='';
		switch ($this->what) {
			case "delOplataApp":
			      $this->sql='CALL YISGRAND.delOplataApp('.$this->rec_id.',@success, @msg)';

			break;
			case "delOplataPb":
			      $this->sql='CALL YISGRAND.delOplataPb('.$this->payment_id.',@success, @msg)';

			break;
			case "delOplataPbEmpty":
			      $this->sql='CALL YISGRAND.delOplataPbEmpty("'.$this->data.'",@success, @msg)';

			break;
			case "PrivatBank_oplata_add":
			      $this->sql='CALL YISGRAND.PrivatBank_oplata_add('.$this->payment_id.',@success, @msg)';

			break;
			case "delOplataIpay":
			      $this->sql='CALL YISGRAND.delOplataIpay('.$this->payment_id.',@success, @msg)';

			break;
			case "delOplataIpayEmpty":
			      $this->sql='CALL YISGRAND.delOplataIpayEmpty("'.$this->data.'",@success, @msg)';

			break;
			case "Ipay_oplata_add":
			      $this->sql='CALL YISGRAND.Ipay_oplata_add('.$this->payment_id.',@success, @msg)';

			break;
			case "delOplataOrg":			
			      		 $this->sql='CALL YISGRAND.delOplataOrg('.$this->rec_id.', @success, @msg)';

			break;
			}
	
		$this->result = $_db->query($this->sql) or die('Connect Error in '.$this->what.'(' .  $this->sql . ') ' . $_db->connect_error);
		
		$this->sql_callback='SELECT @success,@msg';

		$this->res_callback = $_db->query($this->sql_callback) or die('Connect Error in '.$this->what.'(' .  $this->sql_callback . ') ' . $_db->connect_error);
		
		while ($this->row = $this->res_callback->fetch_assoc()) {
			$this->results['success'] = $this->row['@success'];
			$this->results['msg']	=$this->row['@msg'];
		}			
		return $this->results;
	      }
	    public function getRaspechatka(stdClass $params)
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
		
		
		$array = (array) $params;
		foreach ( $array as $key => $value ) 
		  {
		  if(isset($value)) { 
					if (is_int($value)) { $this->$key= (int)$value;}
					else if (is_float($value)) { $this->$key= $value;}
					else {$this->$key =$value;}
		  }
		}
		$this->sql='';
		
		switch ($this->what) {
			case "raspechatkaOplataApp":
			      if($this->raion_id == 2 || $this->raion_id == 5 || $this->raion_id == 10){ 
				      $this->sql='CALL YISGRAND.raspechatkaOplataAppVoda('.$this->address_id.',@success,@content)';
			      } else {
				      $this->sql='CALL YISGRAND.raspechatkaOplataApp('.$this->address_id.',@success,@content)';
			      }
			break;
			case "raspechatkaOplataOrg":			
				      $this->sql='CALL YISGRAND.raspechatkaOplataOrgVoda('.$this->filial_id.',@success,@content)';
//print( $this->sql);

			break;
			case "InfoOplataSubsidia":			
			      $this->sql='CALL YISGRAND.InfoOplataSubsidia('.$this->org_id.',@content,@success,@msg)';
			//  print($this->sql);
			break;
			case "raspechatkaOplataDolgMgkc":			
				      $this->sql='CALL YISGRAND.raspechatkaOplataDolgMgkc('.$this->address_id.',@success,@content)';
//print( $this->sql);

			break;
			case "raspechatkaOplataDolgDobrobut":			
				      $this->sql='CALL YISGRAND.raspechatkaOplataDolgDobrobut('.$this->address_id.',@success,@content)';
//print( $this->sql);

			break;
			case "schetVik":			
				      $this->sql='CALL YISGRAND.schetVik('.$this->rec_id.',"'.$this->sdata.'",@success,@content)';
//print( $this->sql);
			break;
			case "PrintSchetRko":
				      $this->sql='CALL YISGRAND.PrintSchetRko('.$this->org_id.',"'.$this->data.'",@success,@content)';
			 //   print_r($this->sql); 
			break;
			case "AktSubsUtszn":
				      $this->sql='CALL YISGRAND.AktSubsUtsznOrg('.$this->rec_id.',@success,@content)';
			 //   print_r($this->sql); 
			break;
			case "AktSubsidiaAll":
				      $this->sql='CALL YISGRAND.AktSubsidiaAll("'.$this->org_id.'","'.$this->address_id.'",@success,@content)';
			  //  print_r($this->sql); 
			break;
			case "AktLgotaUtsznAll":
			  switch ($this->usluga_id) {
							
				case "2":
				      $this->sql='CALL YISGRAND.AktLgotaUtsznAll_ot("'.$this->data.'",@success,@content)';
				break;
				case "3":
				      $this->sql='CALL YISGRAND.AktLgotaUtsznAll_xv("'.$this->data.'",@success,@content)';
				break;
				case "4":
				      $this->sql='CALL YISGRAND.AktLgotaUtsznAll_st("'.$this->data.'",@success,@content)';
				break;
				case "5":
				      $this->sql='CALL YISGRAND.AktLgotaUtsznAll_tbo("'.$this->data.'",@success,@content)';

				break;		
				case "7":
				      $this->sql='CALL YISGRAND.AktLgotaUtsznAll_ptn("'.$this->data.'",@success,@content)';

				break;		
				}	
			break;
			case "AktSubsUtsznAll":
				switch ($this->usluga_id) {
							
				case "2":
				      $this->sql='CALL YISGRAND.AktSubsidiaUtsznAll_ot("'.$this->data.'",@success,@content)';
				break;
				case "3":
				      $this->sql='CALL YISGRAND.AktSubsidiaUtsznAll_xv("'.$this->data.'",@success,@content)';
				break;
				case "4":
				      $this->sql='CALL YISGRAND.AktSubsidiaUtsznAll_st("'.$this->data.'",@success,@content)';
				break;
				case "5":
				      $this->sql='CALL YISGRAND.AktSubsidiaUtsznAll_tbo("'.$this->data.'",@success,@content)';

				break;		
				case "7":
				      $this->sql='CALL YISGRAND.AktSubsidiaUtsznAll_ptn("'.$this->data.'",@success,@content)';

				break;	
				}	
			 //   print_r($this->sql); 
			break;
			case "Forma3LgotaUtszn":
			  switch ($this->usluga_id) {
							
				case "2":
				      $this->sql='CALL YISGRAND.Forma3LgotaUtszn_ot("'.$this->data.'",@success,@content)';
				break;
				case "3":
				      $this->sql='CALL YISGRAND.Forma3LgotaUtszn_xv("'.$this->data.'",@success,@content)';
				break;
				case "4":
				      $this->sql='CALL YISGRAND.Forma3LgotaUtszn_st("'.$this->data.'",@success,@content)';
				break;
				case "5":
				      $this->sql='CALL YISGRAND.Forma3LgotaUtszn_tbo("'.$this->data.'",@success,@content)';

				break;		
				case "7":
				      $this->sql='CALL YISGRAND.Forma3LgotaUtszn_ptn("'.$this->data.'",@success,@content)';

				break;	
				}	
			    //print_r($this->sql); 
			break;
			
			case "ReestrLgotaUtsznAll":
			  switch ($this->usluga_id) {
							
				case "2":
				      $this->sql='CALL YISGRAND.ReestrLgotaUtsznAll_ot("'.$this->data.'",@success,@content)';
				break;
				case "3":
				      $this->sql='CALL YISGRAND.ReestrLgotaUtsznAll_xv("'.$this->data.'",@success,@content)';
				break;
				case "4":
				      $this->sql='CALL YISGRAND.ReestrLgotaUtsznAll_xv("'.$this->data.'",@success,@content)';
				break;
				case "5":
				      $this->sql='CALL YISGRAND.ReestrLgotaUtsznAll_tbo("'.$this->data.'",@success,@content)';

				break;		
				case "7":
				      $this->sql='CALL YISGRAND.ReestrLgotaUtsznAll_ot("'.$this->data.'",@success,@content)';

				break;	
				}		    
			    //print_r($this->sql); 
			break;
		
			case "ReestrSubsidiaUtsznAll":
				switch ($this->usluga_id) {
			
				case "2":
				      $this->sql='CALL YISGRAND.ReestrSubsidiaUtsznAll_ot("'.$this->data.'",@success,@content)';
				break;
				case "3":
				      $this->sql='CALL YISGRAND.ReestrSubsidiaUtsznAll_xv("'.$this->data.'",@success,@content)';
				break;
				case "4":
				      $this->sql='CALL YISGRAND.ReestrSubsidiaUtsznAll_xv("'.$this->data.'",@success,@content)';
				break;
				case "5":
				      $this->sql='CALL YISGRAND.ReestrSubsidiaUtsznAll_tbo("'.$this->data.'",@success,@content)';
				break;
				case "7":
				      $this->sql='CALL YISGRAND.ReestrSubsidiaUtsznAll_ot("'.$this->data.'",@success,@content)';
				break;
				}
			break;
			case "ReestrLgotaToOshadBank":
				switch ($this->usluga_id) {
				case 1://применяется
				      $this->sql='CALL YISGRAND.ReestrLgotaOshadBank_kv("0","'.$this->data.'",@success,@content)';
				break;
				case 2://применяется
				      $this->sql='CALL YISGRAND.ReestrLgotaOshadBank_ot("0","'.$this->data.'",@success,@content)';
				      			    //print_r($this->sql); 
				break;
				case 3:
				      $this->sql='CALL YISGRAND.ReestrLgotaOshadBank_xv("0","'.$this->data.'",@success,@content)';
				break;
				case 4:
				      $this->sql='CALL YISGRAND.ReestrLgotaOshadBank_st("0","'.$this->data.'",@success,@content)';
				break;
				case 5:
				      $this->sql='CALL YISGRAND.ReestrLgotaOshadBank_tbo("0","'.$this->data.'",@success,@content)';
				break;
				
				}
			break;
			case "ReestrLgotaFromOshadBank":
				switch ($this->usluga_id) {
				case 1://применяется
				      $this->sql='CALL YISGRAND.ReestrLgotaOshadBank_kv("1","'.$this->data.'",@success,@content)';
				break;
				case 2://применяется
				      $this->sql='CALL YISGRAND.ReestrLgotaOshadBank_ot("1","'.$this->data.'",@success,@content)';
				      			    //print_r($this->sql); 
				break;
				case 3:
				      $this->sql='CALL YISGRAND.ReestrLgotaOshadBank_xv("1","'.$this->data.'",@success,@content)';
				break;
				case 4:
				      $this->sql='CALL YISGRAND.ReestrLgotaOshadBank_st("1","'.$this->data.'",@success,@content)';
				break;
				case 5:
				      $this->sql='CALL YISGRAND.ReestrLgotaOshadBank_tbo("1","'.$this->data.'",@success,@content)';
				break;
				
				}
			break;
			case "ReestrSubsToOshadBank":
				switch ($this->usluga_id) {
				case 1://применяется
				      $this->sql='CALL YISGRAND.ReestrOshadBank_kv("0","'.$this->data.'",@success,@content)';
				break;
				case 2://применяется
				      $this->sql='CALL YISGRAND.ReestrOshadBank_ot("0","'.$this->data.'",@success,@content)';
				break;
				case 3:
				      $this->sql='CALL YISGRAND.ReestrOshadBank_xv("0","'.$this->data.'",@success,@content)';
				break;
				case 4:
				      $this->sql='CALL YISGRAND.ReestrOshadBank_st("0","'.$this->data.'",@success,@content)';
				break;
				case 5:
				      $this->sql='CALL YISGRAND.ReestrOshadBank_tbo("0","'.$this->data.'",@success,@content)';
				break;
				
				}
			break;
			case "ReestrSubsFromOshadBank":
				switch ($this->usluga_id) {
				case 1://применяется
				      $this->sql='CALL YISGRAND.ReestrOshadBank_kv("1","'.$this->data.'",@success,@content)';
				break;
				case 2://применяется
				      $this->sql='CALL YISGRAND.ReestrOshadBank_ot("1","'.$this->data.'",@success,@content)';
				break;
				case 3:
				      $this->sql='CALL YISGRAND.ReestrOshadBank_xv("1","'.$this->data.'",@success,@content)';
				break;
				case 4:
				      $this->sql='CALL YISGRAND.ReestrOshadBank_st("1","'.$this->data.'",@success,@content)';
				break;
				case 5:
				      $this->sql='CALL YISGRAND.ReestrOshadBank_tbo("1","'.$this->data.'",@success,@content)';
				break;
				
				}
			break;
			case "DogovoraHouse":
				switch ($this->org_id) {
				    
				case 2://применяется
				      $this->sql='CALL YISGRAND.DogovoraHouse_ytke('.$this->house_id.',@content,@success,@msg)';
				break;
				case 3:
				      $this->sql='CALL YISGRAND.DogovoraHouse_vik('.$this->house_id.',@content,@success,@msg)';
				break;
				
				case 5:
				      $this->sql='CALL YISGRAND.DogovoraHouse_ugtrans('.$this->house_id.',@content,@success,@msg)';
				break;
				
				}
			break;
			}
			
	
		

		$this->result = $_db->query($this->sql) or die('Connect Error in '.$this->what.' ('.$this->sql.') ' . $_db->connect_error);
		
		$this->sql_callback='SELECT @content,@success';

		$this->res_callback = $_db->query($this->sql_callback) or die('Connect Error >>>  ' . $_db->connect_errno . '  <<< ' . $_db->connect_error);
		
		while ($this->row = $this->res_callback->fetch_assoc()) {
			$this->results['content'] = $this->row['@content'];
			$this->results['success'] = $this->row['@success'];
			$this->results['sql'] = $this->sql;
		}
		return $this->results;




}
/*	public function __destruct()
	{
		$_db = $this->connect($this->login,$this->password);
		$_db->close();
		
		return $this;
	}*/
}