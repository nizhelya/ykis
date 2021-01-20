<?php

class QueryVodomer
{

	private $_db;
	protected $login;
	protected $password;
	protected $result;
	protected $address_id;
	protected $what;
	protected $vodomer_id;
	protected $res_callback;
	protected $sql;	
	protected $sql_callback;
	protected $row;	
	protected $pok_id;	
	protected $type;
	protected $pokaz;
	protected $pred;
	protected $tek;
	protected $st;
	protected $kub;
	protected $data=NULL;
	protected $res=array();	
	public	  $results=array();
	
		
	public function connect($login,$password)	{
		
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

		$array = (array) $params;
		foreach ( $array as $key => $value ) 
		  {
		  if(isset($value)) { 
					if (is_int($value)) { $this->$key= (int)$value;}
					else if (is_float($value)) { $this->$key= $value;}
					else {$this->$key =$value;}
		  }
		}
	      
//==================КВАРТИРНЫЕ ВОДОМЕРЫ=============================//

		switch ($this->what) {
			case "TekPokVodomera":			
			      $this->sql='SELECT t1.*,t2.*,t1.voda as type,UCASE(t1.place) as place,t1.date_ar as data_ot,t1.date_ao as data_do,t2.date_do as date_old,t2.tek as tekp,t2.kub as newKubov FROM YIS.VODOMER as t1,YIS.WATER  as t2  WHERE t1.vodomer_id='.$this->vodomer_id.' AND t2.vodomer_id='.$this->vodomer_id.' ORDER BY t2.pok_id DESC limit 1';
			break;
			
			case "TekPokWater":			
			        $this->sql='SELECT t1.*,t2.*,t1.voda as type,UCASE(t1.place) as place,t1.date_ar as data_ot,t1.date_ao as data_do,t2.date_do as date_old,t2.tek as tekp,t2.kub as newKubov FROM YIS.VODOMER as t1,YIS.WATER  as t2  WHERE t1.vodomer_id=t2.vodomer_id and t2.pok_id ='.$this->pok_id.'';

			break;
			case "AllPokVodomera":			
				$this->sql='SELECT * FROM YIS.WATER as t1 WHERE t1.vodomer_id='.$this->vodomer_id.'  ORDER BY t1.pok_id DESC  LIMIT 10 ';
				//	  print($this->sql);
			break;
			case "AllPokVodomeraAll":
				$this->sql='SELECT * FROM YIS.WATER as t1 WHERE t1.vodomer_id='.$this->vodomer_id.'  ORDER BY t1.pok_id DESC  ';

			break;

			case "AppVodomer"://применяется
				 $this->sql='SELECT t1.`vodomer_id`,t2.* FROM YIS.AVODOMER as t1 LEFT JOIN YIS.VODOMER as t2 USING (vodomer_id) '
					    .' WHERE t1.address_id='.$this->address_id.' AND t2.spisan=0  ORDER BY t1.vodomer_id DESC';
					// print($this->sql); 
			break;
			
			case "AppHVodomer"://применяется
				  $this->sql='SELECT *  FROM YIS.VODOMER as t1 WHERE t1.address_id='.$this->address_id.' AND t1.spisan=1 ORDER BY t1.vodomer_id DESC';
					  // print($this->sql); 
					
			break;	
			case "OnPoverkaVodomer"://применяется
				  $this->sql='(SELECT t1.vodomer_id,t1.nomer,t1.model,t1.voda,t1.address,t1.obr,t1.joint,t1.date_ar,t1.date_ao FROM YIS.VODOMER as t1 WHERE t1.dvodomer_id='.$this->dvodomer_id.'  AND t1.spisan=0 AND t1.out=1 ) UNION  '
				  .' (SELECT t2.vodomer_id,t2.nomer,t2.model,t2.voda,t3.fname as address,t2.obr,t2.joint,t2.date_ar,t2.date_ao FROM YISGRAND.VODOMER as t2 ,YISGRAND.TM_ORG_FILIAL as t3  '
				  . ' WHERE t2.dvodomer_id='.$this->dvodomer_id.'  AND t2.spisan=0 AND t2.out=1  AND t2.filial_id=t3.filial_id )';
					 //print($this->sql);  
					
			break;	
			case "VodomerAvg"://применяется
				  $this->sql='CALL YISGRAND.VodomerAvg("'.$this->dvodomer_id.'","'.$this->data.'")';
					//print($this->sql);  
					
			break;	
			
			case "ExistentVodomer"://применяется
				  $this->sql='SELECT t1.`vodomer_id`,t1.`nomer` FROM YIS.VODOMER  as t1  WHERE t1.`house_id`='.$this->house_id.' AND t1.`joint`= 1  ORDER BY t1.`nomer` ';
					  // print($this->sql); 
			break;

// =============ВОДОМЕРЫ ОРГАНИЗАЦИИ==================== // 

			case "TekPokOVodomera":			
			       $this->sql='SELECT t1.*,t2.*,t1.voda as type,UCASE(t1.place) as place,t1.date_ar as data_ot,t1.date_ao as data_do,t2.date_do as date_old,t2.tek as tekp,t2.kub as newKubov FROM YISGRAND.VODOMER as t1,YISGRAND.WATER  as t2  WHERE t1.vodomer_id='.$this->vodomer_id.' AND t2.vodomer_id='.$this->vodomer_id.' ORDER BY t2.pok_id DESC limit 1';
			break;
			
			case "TekPokWaterOrg":			
			      $this->sql='SELECT t1.*,t2.*,t1.voda as type,UCASE(t1.place) as place,t1.date_ar as data_ot,t1.date_ao as data_do,t2.date_do as date_old,t2.tek as tekp,t2.kub as newKubov FROM YISGRAND.VODOMER as t1,YISGRAND.WATER  as t2  WHERE t1.vodomer_id=t2.vodomer_id and t2.pok_id ='.$this->pok_id.'';
			break;
			case "AllPokOVodomera":			
				$this->sql='SELECT t1.*,t1.data as fdate,t1.date_do as date_old,t1.kub as newKubov FROM YISGRAND.WATER as t1 WHERE t1.vodomer_id='.$this->vodomer_id.'  ORDER BY t1.pok_id DESC  LIMIT 4 ';
				//	  print($this->sql);
			break;
			case "AllPokOVodomeraAll":
				$this->sql='SELECT t1.*,t1.data as fdate , t1.date_do as date_old ,t1.kub as newKubov FROM YISGRAND.WATER as t1 WHERE t1.vodomer_id='.$this->vodomer_id.'  ORDER BY t1.pok_id DESC  ';

			break;
			
			case "OrgVodomer"://применяется
				  $this->sql='SELECT t1.`vodomer_id`,t2.* FROM YISGRAND.FVODOMER as t1 LEFT JOIN YISGRAND.VODOMER as t2 USING (vodomer_id) '
					    .' WHERE t1.filial_id='.$this->filial_id.' AND t2.spisan=0  ORDER BY t1.vodomer_id DESC';
					//  print($this->sql); 
			break;

			case "AboutVodomer"://применяется
				  $this->sql='SELECT GROUP_CONCAT("Объект код: ", t1.`filial_id`," Название: " ,t1.`name` SEPARATOR "<br>") AS filials  FROM YISGRAND.TM_ORG_FILIAL as t1 '
					    .' WHERE t1.`filial_id` IN  (SELECT t2.`filial_id` FROM YISGRAND.FVODOMER as t2 WHERE t2.`vodomer_id`='.$this->vodomer_id.')';
					//  print($this->sql); 
			break;

			case "ExistentVod"://применяется
				  $this->sql='SELECT t1.`vodomer_id`,t1.`nomer` FROM YISGRAND.VODOMER as t1 WHERE t1.`house_id`='.$this->house_id.' AND t1.`joint`=1 ORDER BY t1.`nomer` ';
					 //  print($this->sql); 
			break;
			
			case "OrgHVodomer"://применяется
				  $this->sql='SELECT * FROM YISGRAND.VODOMER WHERE YISGRAND.VODOMER.filial_id='.$this->filial_id.' AND YISGRAND.VODOMER.spisan=1 ORDER BY YISGRAND.VODOMER.vodomer_id DESC';
					   //print($this->sql); 
					
			break;	
			case "TekNachOrgVodomera":			  
			   $this->sql='SELECT filial_id, data, fdate, usluga, period, sum(zadol) as zadol, hzadol ,edizm, qty,gkal, tarif, sum(nachisleno) as nachisleno, sum(perer) as perer,  sum(itogo) as itogo, sum(oplacheno) as oplacheno,  sum(dolg) as dolg,  hdolg FROM((SELECT 1 as p,filial_id,data,DATE_FORMAT(data,"%m-%Y") as fdate,SUBSTRING(`usluga`,1,5) as usluga,CONCAT_WS(" ",mec,god) as period,zadol,0 as hzadol,'
				  .'CASE WHEN people=0 THEN "куб" ELSE "чел" END as edizm,xkub+gkub+people as qty,0 as gkal,tarif,nachisleno-perer as nachisleno,perer,'
				  .'nachisleno+perer as itogo,oplacheno,dolg,0 as hdolg FROM YISGRAND.VODA  WHERE filial_id='.$this->filial_id.' ORDER BY data DESC LIMIT 1 ) UNION ' 
				  .' (SELECT 2 as p,filial_id,data,DATE_FORMAT(data,"%m-%Y") as fdate,SUBSTRING(`usluga`,1,5) as usluga,CONCAT_WS(" ",mec,god) as period,zadol,0 as hzadol,'
				  .'CASE WHEN people=0 THEN "куб" ELSE "чел" END as edizm,xkub+gkub+people as qty,0 as gkal,tarif,nachisleno-perer as nachisleno,perer,'
				  .'nachisleno+perer as itogo,oplacheno,dolg,0 as hdolg FROM YISGRAND.STOKI  WHERE filial_id='.$this->filial_id.' ORDER BY data DESC LIMIT 1 ) UNION '
				  .' (SELECT 3 as p,filial_id,data,DATE_FORMAT(data,"%m-%Y") as fdate,SUBSTRING(`usluga`,1,5) as usluga,CONCAT_WS(" ",mec,god) as period,zadol,0 as hzadol,'
				  .'CASE WHEN people=0 THEN "куб" ELSE "чел" END as edizm,kub+people as qty,gkal,tarif,nachisleno-perer as nachisleno,perer,'
				  .'nachisleno+perer as itogo,oplacheno ,dolg,0 as hdolg FROM YISGRAND.PODOGREV  WHERE filial_id='.$this->filial_id.' ORDER BY data DESC LIMIT 1 ) '
				  .' ORDER BY data DESC ,p) AS a group by p with rollup';
			//print($this->sql); 
			break;
		

// ========== Домовые водомеры ===========

		     case "Dvodomer"://применяется			
			    $this->sql='SELECT t1.*  FROM YIS.DVODOMER as t1 WHERE t1.house_id= '.$this->house_id.'  AND t1.spisan=0 ORDER BY t1.vvod';
					//print( $this->sql);  
		      break;	
		      case "HDvodomer"://применяется			
			    $this->sql='SELECT t1.*  FROM YIS.DVODOMER as t1  WHERE t1.house_id='.$this->house_id.'   AND t1.spisan=1 ORDER BY t1.vvod';
					//print( $this->sql);  
		      break;	
			  case "TekPokDVodomera"://применяется	
			    $this->sql='SELECT t1.*,t2.*,t1.voda as type,t1.date_ar as data_ot,t1.date_ao as data_do,t2.date_do as date_old,t2.tek as tekp,t2.kub as newKubov FROM YIS.DVODOMER as t1,YIS.PDVODOMER  as t2 '
					  .' WHERE t1.dvodomer_id='.$this->dvodomer_id.' AND t2.dvodomer_id='.$this->dvodomer_id.' ORDER BY t2.pok_id DESC limit 1';
			  break;
			    case "TekPokDVod"://применяется	
			    $this->sql='SELECT t1.*,t2.*,t1.voda as type,t1.date_ar as data_ot,t1.date_ao as data_do,t2.date_do as date_old,t2.tek as tekp,t2.kub as newKubov FROM YIS.DVODOMER as t1,YIS.PDVODOMER  as t2 '
					  .' WHERE t1.dvodomer_id='.$this->dvodomer_id.' AND t2.dvodomer_id='.$this->dvodomer_id.' ORDER BY t2.pok_id DESC limit 1';
			  break;
			    case "AllPokDVodomera":	//применяется	
		
			    $this->sql='SELECT * FROM YIS.PDVODOMER  WHERE  YIS.PDVODOMER.dvodomer_id='.$this->dvodomer_id.'  ORDER BY YIS.PDVODOMER.pok_id DESC  LIMIT 12';
		 
			  //  print_r($this->sql); 
			break;	
			case "AllPokDVodomeraAll":	//применяется	
		
			    $this->sql='SELECT * FROM YIS.PDVODOMER  WHERE  YIS.PDVODOMER.dvodomer_id='.$this->dvodomer_id.'  ORDER BY YIS.PDVODOMER.pok_id DESC  ';
		 
			  //  print_r($this->sql); 
			break;	
			    case "OrgByDvodomer":// применяется	
			    $this->sql='SELECT t1.*,CONCAT(t1.fname," (",t1.name,")") as name,(SELECT t2.house FROM YIS.HOUSE as t2 WHERE t2.house_id = t1.house_id ) as address,'				
					.'(SELECT t3.xkub+t3.gkub FROM YISGRAND.VODA as t3 WHERE t3.filial_id =t1.filial_id ORDER BY t3.data DESC LIMIT 1 ) as kub,  '
					.'(SELECT t4.xkub+t4.gkub FROM YISGRAND.STOKI as t4  WHERE t4.filial_id = t1.filial_id ORDER BY t4.data DESC LIMIT 1 ) as skub  '
					.' FROM YISGRAND.TM_ORG_FILIAL as t1  WHERE  t1.dvodomer_id ='.$this->dvodomer_id.'';
					//print_r($this->sql); 
			  break;
			    case "AllOrgByHouse":// применяется	
			    $this->sql='SELECT t1.*,CONCAT(t1.fname," (",t1.name,")") as name, (SELECT t2.house FROM YIS.HOUSE as t2 WHERE t2.house_id = t1.house_id ) as address, '
					.'(SELECT t3.xkub+t3.gkub FROM YISGRAND.VODA as t3  WHERE t3.filial_id =t1.filial_id  ORDER BY t3.data DESC LIMIT 1 ) as kub,  '
					.'(SELECT t4.xkub+t4.gkub FROM YISGRAND.STOKI as t4 WHERE t4.filial_id = t1.filial_id ORDER BY t4.data DESC LIMIT 1 ) as skub  '
					.' FROM YISGRAND.TM_ORG_FILIAL as t1  WHERE t1.house_id ='.$this->house_id.' AND (t1.dvodomer_id ='.$this->dvodomer_id.' OR t1.dvodomer_id =0)';
					//print_r($this->sql); 
			  break;
			  case "WaterHouse"://применяется	
			    $this->sql='SELECT t1.* FROM YIS.WATERHOUSE as t1  WHERE t1.house_id='.$this->house_id.' AND t1.house_id !=17  AND t1.dvodomer_id='.$this->dvodomer_id.' '
					.' AND t1.data=CONCAT(EXTRACT(YEAR_MONTH FROM "'.$this->data.'"),"01") limit 1 ';
					//print_r($this->sql); 
			  break;
			  case "AllWaterHouse"://применяется	
			    $this->sql='SELECT *  FROM YIS.WATERHOUSE  WHERE YIS.WATERHOUSE.raion_id = '.$this->raion_id.' AND YIS.WATERHOUSE.data=CONCAT(EXTRACT(YEAR_MONTH FROM CURDATE()),"01")';
					//print_r($this->sql); 
			  break;
			  case "AllWaterHouseRaion"://применяется	
			    $this->sql='SELECT *  FROM YIS.WATERHOUSE  WHERE  YIS.WATERHOUSE.raion_id ='.$this->raion_id.' AND YIS.WATERHOUSE.data=CONCAT(EXTRACT(YEAR_MONTH FROM "'.$this->data.'"),"01")';
					//print_r($this->sql); 
			  break;
			  case "AllWaterHouseStreet"://применяется	
			    $this->sql='SELECT *  FROM YIS.WATERHOUSE  WHERE  YIS.WATERHOUSE.street_id ='.$this->street_id.' AND YIS.WATERHOUSE.data=CONCAT(EXTRACT(YEAR_MONTH FROM CURDATE()),"01")';
					//print_r($this->sql); 
			  break;
			  case "AllWaterHouseData"://применяется	
			    $this->sql='SELECT *  FROM YIS.WATERHOUSE  WHERE  YIS.WATERHOUSE.raion_id = 1 AND YIS.WATERHOUSE.data=CONCAT(EXTRACT(YEAR_MONTH FROM "'.$this->data.'"),"01")';
					//print_r($this->sql); 
			  break;
		} // End of Switch ($what)	      StWaterHouse
		
		$this->result = $_db->query($this->sql) or die('Connect Error in '.$this->what.'( '.$this->sql.' )' . $_db->connect_error);
		
		while ($this->row = $this->result->fetch_assoc()) {
			array_push($this->res, $this->row);
		}
		$this->results['data']	= $this->res;
		
		return $this->results;
	}
	public function addVodomer(stdClass $params)
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

		switch ($this->what) {
			case "addAppVodomer":
			    $this->sql='CALL YISGRAND.add_avodomer("'
							    .$this->joint.'","'
							    .$this->joint_id.'","'
							    .$this->address_id.'","'
							    .$this->sdate.'","'
							    .$this->pdate.'","'
							    .$this->plomba.'","'
							    .$this->pp.'","'
							    .$this->zdate.'","'
							    .$this->nomer.'" ,"'
							    .$this->model_id.'","'
							    .$this->place.'","'
							    .$this->position.'","'
							    .$this->obr.'", "'
							    .$this->voda.'","'
							    .$this->st.'","'
							    .$this->tek.'","'
							    .$this->paused.'",'
							    .'@vodomer_id,@success,@msg)';
//print($this->sql);

			break;
			case "addDVodomer":			
				$this->sql='CALL YISGRAND.add_dvodomer("'							   
							    .$this->house_id.'","'
							    .$this->vvod.'","'
							    .$this->nomer.'","'
							    .$this->model_id.'","'
							    .$this->allapp.'","'
							    .$this->first_app.'","'
							    .$this->last_app.'","'
							    .$this->voda.'", "'
							    .$this->sdate.'","'
							    .$this->pdate.'","'
							    .$this->plomba.'","'
							    .$this->pp.'","'
							    .$this->zdate.'","'
							    .$this->st.'","'
							    .$this->vd.'","'
							    .$this->tek.'","'
							    .$this->paused.'",'
							    .'@vodomer_id,@success,@msg)';
			break;	    
			case "editAppVodomer":			
			      $this->sql='CALL YISGRAND.edit_avodomer("'							  
							    .$this->vodomer_id.'","'
							    .$this->joint.'","'
							    .$this->sdate.'","'
							    .$this->pdate.'","'
							    .$this->plomba.'","'
							    .$this->fpdate.'","'
							    .$this->pp.'","'
							    .$this->zdate.'","'
							    .$this->nomer.'","'
							    .$this->model_id.'","'
							    .$this->place.'", "'
							    .$this->position.'","'
							    .$this->obr.'", "'
							    .$this->voda.'","'
							    .$this->st.'","'
							    .$this->tek.'","'
							    .$this->paused.'",'
							    .'@success,@msg)';
//print($this->sql);
			break;	
			case "editDVodomer":			
				$this->sql='CALL YISGRAND.edit_dvodomer("'
							    .$this->dvodomer_id.'","'
							    .$this->house_id.'","'
							    .$this->vvod.'","'
							    .$this->nomer.'","'
							    .$this->model_id.'","'
							    .$this->allapp.'","'
							    .$this->first_app.'","'
							    .$this->last_app.'", "'
							    .$this->voda.'", "'
							    .$this->sdate.'","'
							    .$this->pdate.'","'
							    .$this->plomba.'","'
							    .$this->pp.'","'
							    .$this->fpdate.'","'
							    .$this->zdate.'","'
							    .$this->st.'","'
							    .$this->vd.'","'
							    .$this->tek.'","'
							    .$this->paused.'",'
							    .'@success,@msg)';
//print($this->sql);

			break;	    
			case "changeAppVodomer":
			      $this->sql='CALL YISGRAND.change_avodomer('.$this->new_id.','.$this->address_id.','.$this->vodomer_id.','.'@success,@msg)';


			break;	             
			case "addOrgVodomer":			
			    $this->sql='CALL YISGRAND.add_ovodomer("'
							    .$this->joint.'","'
							    .$this->joint_id.'","'
							    .$this->filial_id.'","'
							    .$this->sdate.'","'
							    .$this->pdate.'","'
							    .$this->plomba.'","'
							    .$this->pp.'","'
							    .$this->zdate.'","'
							    .$this->nomer.'","'
							    .$this->model_id.'","'
							    .$this->place.'","'
							    .$this->position.'","'
							    .$this->obr.'", "'
							    .$this->voda.'","'
							    .$this->st.'","'
							    .$this->vd.'","'
							    .$this->tek.'","'
							    .$this->paused.'",'
							    .'@vodomer_id,@success,@msg)';
			break;	
			case "changeOrgVodomer":			
			   			    $this->sql='CALL YISGRAND.change_ovodomer('.$this->new_id.','.$this->filial_id.','.$this->vodomer_id.','.'@success,@msg)';

			break;	
			case "editOrgVodomer":			
			      $this->sql='CALL YISGRAND.edit_ovodomer("'							  
							    .$this->vodomer_id.'","'
							    .$this->joint.'","'
							    .$this->sdate.'","'
							    .$this->pdate.'","'
							    .$this->plomba.'","'
							    .$this->fpdate.'","'
							    .$this->pp.'","'
							    .$this->zdate.'","'
							    .$this->nomer.'","'
							    .$this->model_id.'","'
							    .$this->place.'", "'
							    .$this->position.'","'
							    .$this->obr.'", "'
							    .$this->voda.'","'
							    .$this->st.'","'
							    .$this->vd.'","'
							    .$this->tek.'","'
							    .$this->paused.'",'
							    .'@success,@msg)';

//print($this->sql);

			break;	
			case "addFilialDvodomer":			
				$this->sql='CALL YISGRAND.addFilialDvodomer('.$this->dvodomer_id.','.$this->filial_id.',@success,@msg)';
			break;	    
			case "delFilialDvodomer":			
				$this->sql='CALL YISGRAND.delFilialDvodomer('.$this->filial_id.',@success,@msg)';
			break;	   
			
			
		}
		$this->result = $_db->query($this->sql) or die('Connect Error in '.$this->what.'(' .  $this->sql . ') ' . $_db->connect_error);

		
		$this->sql_callback='SELECT @vodomer_id,@success,@msg';

		$this->res_callback = $_db->query($this->sql_callback) or die('Connect Error in '.$this->what.'(' .  $this->sql_callback . ') ' . $_db->connect_error);
		
		while ($this->row = $this->res_callback->fetch_assoc()) {
			$this->results['vodomer_id'] = $this->row['@vodomer_id'];
			$this->results['success'] = $this->row['@success'];
			$this->results['msg']	=$this->row['@msg'];
		}			
		return $this->results;

	}
	 public function updateVodomer(stdClass $params)
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
					else {$this->$key =$_db->real_escape_string($value);}
		  }
		}

		

		switch ($this->what) {
			
			case "updateWaterHouseDay":
			       $this->sql='CALL YISGRAND.updateWaterHouseDay(@success,@msg)';				    
			break;
			case "update_pokaz_ovodomer":
			       $this->sql='CALL YISGRAND.update_pokaz_ovodomer('.$this->filial_id.',@success,@msg)';				    
			break;
			
			
			case "update_pokaz_ovodomer_filial":
			       $this->sql='CALL YISGRAND.update_pokaz_ovodomer_filial("'.$this->data.'",'.$this->filial_id.',@success,@msg)';	
			    //   print($this->sql);

			break;
			case "updateVvodDvodomer":
			       $this->sql='CALL YISGRAND.updateVvodDvodomer( '.$this->dvodomer_id.',"' .$this->allapp.'","'.$this->first_app.'","'.$this->last_app.'",@success,@msg)';
			    //   print($this->sql);

			break;
			case "insPoverka":
			       $this->sql='CALL YISGRAND.insPoverka( '.$this->vodomer_id.',"'.$this->date_ar.'","'.$this->date_ao.'",@success,@msg)';
			    //   print($this->sql);

			break;
			case "insPoverkaOrg":
			       $this->sql='CALL YISGRAND.insPoverkaOrg( '.$this->vodomer_id.',"'.$this->date_ar.'","'.$this->date_ao.'",@success,@msg)';
			    //   print($this->sql);

			break;
			case "insPoverkaDvod":
			       $this->sql='CALL YISGRAND.insPoverkaDvod( '.$this->dvodomer_id.',"'.$this->date_ar.'","'.$this->date_ao.'",@success,@msg)';
			    //   print($this->sql);

			break;
			case "update_norma_voda_filial":
			       $this->sql='CALL YISGRAND.update_norma_voda_filial("'.$this->data.'",'.$this->filial_id.',@success,@msg)';	
			       			     //print($this->sql);
			break;
			
			case "update_nachislenie_filial":
			       $this->sql='CALL YISGRAND.update_nachislenie_filial("'.$this->data.'",'.$this->filial_id.',@success,@msg)';	
			       //print($this->sql);
			break;
			case "all_nach_norma_voda_org":
			       $this->sql='CALL YISGRAND.all_nach_norma_voda_org(@success,@msg)';				    
			break;
			case "all_nach_norma_voda_kv":
			       $this->sql='CALL YISGRAND.all_nach_norma_voda_kv(@success,@msg)';				    
			break;
			case "all_nach_norma_podogrev_kv":
			       $this->sql='CALL YISGRAND.all_nach_norma_podogrev_kv(@success,@msg)';				    
			break;

			case "nach_norma_voda_org_dvodomer":
			       $this->sql='CALL YISGRAND.nach_norma_voda_org_dvodomer( '
							    .$this->house_id.', '
							    .$this->dvodomer_id.','
							    .'@success,@msg)';		
//print($this->sql);
			    
			break;
			//in use
			case "updateVvodWaterHouseDay":
		$this->sql='CALL YISGRAND.updateVvodWaterHouseDay('.$this->house_id.','.$this->dvodomer_id.',"'.$this->voda.'","'.$this->qtyDay.'","'.$this->qtyKub.'","'.$this->data.'","'.$this->info.'",@success,@msg)';		
//print($this->sql);
			    
			break;
			
			case "AddMeedlePokOTeplomera":
			$this->sql='CALL YISGRAND.AddMeedlePokOTeplomera('.$this->teplomer_id.',"'.$this->sdate.'","'.$this->date_ar.'","'.$this->date_ao.'","'.$this->data_ot.'","'.$this->data_do.'", '
				    .' @data_ot,@data_do,@pok_do,@pok_ot,@rday,@days,@qty_kub,@kub_day,@kubov,@success,@msg)';
				    				 //   print($this->sql);

			break;
			case "AddMeedlePokTeplomera":
			$this->sql='CALL YISGRAND.AddMeedlePokTeplomera("'.$this->teplomer_id.'","'.$this->sdate.'","'.$this->date_ar.'","'.$this->date_ao.'","'.$this->data_ot.'","'.$this->data_do.'", '
				    .' @data_ot,@data_do,@pok_do,@pok_ot,@rday,@days,@qty_kub,@kub_day,@kubov,@success,@msg)';
				    				 //   print($this->sql);
			break;
			case "AddMeedlePokVod":
			$this->sql='CALL YISGRAND.AddMeedlePokVod("'.$this->vodomer_id.'","'.$this->sdate.'","'.$this->date_ar.'","'.$this->date_ao.'","'.$this->data_ot.'","'.$this->data_do.'", '
				    .' @data_ot,@data_do,@pok_do,@pok_ot,@rday,@days,@qty_kub,@kub_day,@kubov,@success,@msg)';
				    				 //   print($this->sql);

			break;
			case "DelAvgPokVod":
			$this->sql='CALL YISGRAND.DelAvgPokVod("'.$this->dvodomer_id.'","'.$this->data.'",@success,@msg)';
				    				  // print($this->sql);
			break;
			case "AddAvgPokVod":
			$this->sql='CALL YISGRAND.AddAvgPokVod("'.$this->dvodomer_id.'","'.$this->data.'",@success,@msg)';
				    				  // print($this->sql);
			break;
			case "AddAOPokVod":
			$this->sql='CALL YISGRAND.AddAOPokVod("'.$this->dvodomer_id.'",@success,@msg)';
				    				  // print($this->sql);
			break;
			case "AddMeedlePokVodOrg":
			$this->sql='CALL YISGRAND.AddMeedlePokVodOrg("'.$this->vodomer_id.'","'.$this->sdate.'","'.$this->date_ar.'","'.$this->date_ao.'","'.$this->data_ot.'","'.$this->data_do.'", '
				    .' @data_ot,@data_do,@pok_do,@pok_ot,@rday,@days,@qty_kub,@kub_day,@kubov,@success,@msg)';
				    	//print($this->sql);

			break;
			case "AddMeedlePokDVod":
			$this->sql='CALL YISGRAND.AddMeedlePokDVod('.$this->dvodomer_id.',"'.$this->sdate.'","'.$this->date_ar.'","'.$this->date_ao.'","'.$this->data_ot.'","'.$this->data_do.'", '
				    .' @data_ot,@data_do,@pok_do,@pok_ot,@rday,@days,@qty_kub,@kub_day,@kubov,@success,@msg)';				    				 //   print($this->sql);

			break;
			
			case "DVodomer":			
			     $this->sql='CALL YIS.update_dvodomer('.$this->vodomer_id.',"'.$this->nomer.'",'.$this->model_id.',"'.$this->first_app.'", "'.$this->last_app.'","'.$this->voda.'",'.'@success,@msg)';
			//print($this->sql);

			break;	    

		}
		$this->result = $_db->query($this->sql) or die('Connect Error in '.$this->what.'(' .  $this->sql . ') ' . $_db->connect_error);
		
		$this->sql_callback='SELECT @data_ot,@data_do,@pok_do,@pok_ot,@rday,@days,@qty_kub,@kub_day,@kubov,@success,@msg';

		$this->res_callback = $_db->query($this->sql_callback) or die('Connect Error in '.$this->what.'(' .  $this->sql_callback . ') ' . $_db->connect_error);
		
		while ($this->row = $this->res_callback->fetch_assoc()) {
			$this->results['success'] = $this->row['@success'];
			$this->results['msg']	=$this->row['@msg'];
			$this->results['data_ot'] = $this->row['@data_ot'];
			$this->results['data_do']	=$this->row['@data_do'];
			$this->results['pok_ot'] = $this->row['@pok_ot'];
			$this->results['pok_do']	=$this->row['@pok_do'];
			$this->results['rday'] = $this->row['@rday'];
			$this->results['days']	=$this->row['@days'];
			$this->results['qty_kub'] = $this->row['@qty_kub'];
			$this->results['kub_day'] = $this->row['@kub_day'];
			$this->results['kubov']	=$this->row['@kubov'];
		}			
		return $this->results;

	  }

	public function delVodomer(stdClass $params)
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
		if(isset($params->vodomer_id) && ($params->vodomer_id)) {
		  $this->vodomer_id = (int) $params->vodomer_id;
		} else {
		  $this->vodomer_id = 0;
		}
		if(isset($params->dvodomer_id) && ($params->dvodomer_id)) {
		  $this->dvodomer_id = (int) $params->dvodomer_id;
		} else {
		  $this->dvodomer_id = 0;
		}
		switch ($this->what) {
			case "AVodomer":
			      $this->sql='CALL YISGRAND.del_avodomer('.$this->vodomer_id.',@success,@msg)';

			break;
			case "OVodomer":			
			      $this->sql='CALL YISGRAND.del_ovodomer('.$this->vodomer_id.',@success,@msg)';
			break;	    
			case "DVodomer":			
			    $this->sql='CALL YISGRAND.del_dvodomer('.$this->dvodomer_id.',@success,@msg)';
			break;	    
		}
//print($this->sql);
		$this->result = $_db->query($this->sql) or die('Connect Error in '.$this->what.'(' .  $this->sql . ') ' . $_db->connect_error);
		
		$this->sql_callback='SELECT @success,@msg';

		$this->res_callback = $_db->query($this->sql_callback) or die('Connect Error in '.$this->what.'(' .  $this->sql_callback . ') ' . $_db->connect_error);
		
		while ($this->row = $this->res_callback->fetch_assoc()) {
			$this->results['success'] = $this->row['@success'];
			$this->results['msg']	=$this->row['@msg'];
		}			
		return $this->results;

	  }
		public function spisanVodomer(stdClass $params)
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
		if(isset($params->filial_id) && ($params->filial_id)) {
		  $this->filial_id = (int) $params->filial_id;
		} else {
		  $this->filial_id = 0;
		}
		if(isset($params->address_id) && ($params->address_id)) {
		  $this->address_id = (int) $params->address_id;
		} else {
		  $this->filial_id = 0;
		}

		if(isset($params->vodomer_id) && ($params->vodomer_id)) {
		  $this->vodomer_id = (int) $params->vodomer_id;
		} else {
		  $this->vodomer_id = 0;
		}
		if(isset($params->dvodomer_id) && ($params->dvodomer_id)) {
		  $this->dvodomer_id = (int) $params->dvodomer_id;
		} else {
		  $this->dvodomer_id = 0;
		}
		
		switch ($this->what) {
			case "AVodomer":
			      $this->sql='CALL YISGRAND.spisan_avodomer('.$this->vodomer_id.',@success,@msg)';
			break;
			case "AVodomerBack":
			      $this->sql='CALL YISGRAND.back_spisan_avodomer('.$this->vodomer_id.',@success,@msg)';
			break;
			case "OVodomerBack":
			      $this->sql='CALL YISGRAND.back_spisan_ovodomer('.$this->vodomer_id.',@success,@msg)';
			break;
			case "DVodomerBack":
			      $this->sql='CALL YISGRAND.back_spisan_dvodomer('.$this->dvodomer_id.',@success,@msg)';
			break;
			case "OVodomer":			
			      $this->sql='CALL YISGRAND.spisan_ovodomer('.$this->filial_id.','.$this->vodomer_id.',@success,@msg)';
			break;	    
			case "DVodomer":			
			      $this->sql='CALL YISGRAND.spisan_dvodomer('.$this->dvodomer_id.',@success,@msg)';
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

public function inVodomerHistory(stdClass $params)
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
		if(isset($params->vodomer_id) && ($params->vodomer_id)) {
		  $this->vodomer_id = (int) $params->vodomer_id;
		} else {
		  $this->vodomer_id = 0;
		}
		if(isset($params->dvodomer_id) && ($params->dvodomer_id)) {
		  $this->dvodomer_id = (int) $params->dvodomer_id;
		} else {
		  $this->dvodomer_id = 0;
		}
		
		switch ($this->what) {
			case "AVodomer":
			      $this->sql='CALL YISGRAND.in_avodomer_history('.$this->vodomer_id.',@success,@msg)';
			break;
			case "OVodomer":			
			      $this->sql='CALL YISGRAND.in_ovodomer_history('.$this->vodomer_id.',@success,@msg)';
			break;	    
			case "DVodomer":			
			      $this->sql='CALL YISGRAND.in_dvodomer_history('.$this->dvodomer_id.',@success,@msg)';
			      //print($this->sql);

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
public function outVodomerHistory(stdClass $params)
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
		if(isset($params->dvodomer_id) && ($params->dvodomer_id)) {
		  $this->dvodomer_id = (int) $params->dvodomer_id;
		} else {
		  $this->dvodomer_id = 0;
		}		
		if(isset($params->vodomer_id) && ($params->vodomer_id)) {
		  $this->vodomer_id = (int) $params->vodomer_id;
		} else {
		  $this->vodomer_id = 0;
		}
		
		switch ($this->what) {
			case "AVodomer":
			      $this->sql='CALL YISGRAND.out_avodomer_history('.$this->vodomer_id.',@success,@msg)';
			break;
			case "OVodomer":			
			      $this->sql='CALL YISGRAND.out_ovodomer_history('.$this->vodomer_id.',@success,@msg)';
			break;	    
			case "DVodomer":			
			      $this->sql='CALL YISGRAND.out_dvodomer_history('.$this->dvodomer_id.',@success,@msg)';
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

public function delPokVodomera(stdClass $params)
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
		 if(isset($params->pok_id) && ($params->pok_id)) {
		 $this->pok_id = (int) $params->pok_id;
		} else {
		  $this->pok_id = 0;
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
	if(isset($params->rec_id) && ($params->rec_id)) {
		  $this->rec_id = (int) $params->rec_id;
		} else {
		  $this->rec_id = 0;
		}

		switch ($this->what) {
			case "AVodomer":
			      $this->sql='CALL YISGRAND.delete_pokaz_avodomera('.$this->pok_id.','.$this->address_id.',@success,@msg)';
			break;
			case "OVodomer":			
			      $this->sql='CALL YISGRAND.delete_pokaz_ovodomera('.$this->pok_id.','.'@success,@msg)';
			      //print($this->sql);

			break;	    
			case "DVodomer":			
			      $this->sql='CALL YISGRAND.delete_pokaz_dvodomera('.$this->pok_id.',@success,@msg)';
			break;	  

		}
//print($this->sql);

		$this->result = $_db->query($this->sql) or die('Connect Error in '.$this->what.'(' .  $this->sql . ') ' . $_db->connect_error);
		
		$this->sql_callback='SELECT @success,@msg';

		$this->res_callback = $_db->query($this->sql_callback) or die('Connect Error in '.$this->what.'(' .  $this->sql_callback . ') ' . $_db->connect_error);
		
		while ($this->row = $this->res_callback->fetch_assoc()) {
			$this->results['success'] = $this->row['@success'];
			$this->results['msg']	=$this->row['@msg'];
		}			
		return $this->results;
	}
	public function newPokVodomera(stdClass $params)
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

		$array = (array) $params;
		foreach ( $array as $key => $value ) 
		  {
		  if(isset($value)) { 
					if (is_int($value)) { $this->$key= (int)$value;}
					else if (is_float($value)) { $this->$key= $value;}
					else {$this->$key =$_db->real_escape_string($value);}
		  }
		}
		$this->sql='';
		switch ($this->what) {
			case "AVodomer":
			      $this->sql='CALL YISGRAND.input_new_pokaz_avodomer('.$this->vodomer_id.',"'.$this->tek.'","'.$this->newValue.'","'.$this->date_new.'",@success,@msg)';
			      			//print($this->sql);

			break;
			case "AVodomerK":
			$this->sql='CALL YISGRAND.input_new_pokaz_avodomer_bank('.$this->vodomer_id.',"'.$this->tek.'","'.$this->newValue.'","'.$this->login.'",@success,@msg)';
			      			//print($this->sql);

			break;

			case "OVodomer":			
			      $this->sql='CALL YISGRAND.input_new_pokaz_ovodomer('.$this->vodomer_id.',"'.$this->type.'",'.$this->tek.','.$this->newValue.',@success,@msg)';
								//print($this->sql);
		    
			break;
			
			case "insHandOrg":			
			      $this->sql='CALL YISGRAND.input_hand_pokaz_ovodomer('
										    .$this->vodomer_id.','
										    .'"'.$this->type.'",'
										    .$this->tek.','
										    .$this->newValue
										    .',@success,@msg)';
			break;

			case "insHandApp":			
			      $this->sql='CALL YISGRAND.input_hand_pokaz_avodomer('
										    .$this->vodomer_id.','
										   .$this->address_id.','
										    .'"'.$this->type.'",'
										    .$this->tek.','
										    .$this->newKubov
										    .',@success,@msg)';
			break;
			case "insMeedlePokTeplomera":			
			      $this->sql='CALL YISGRAND.insMeedlePokTeplomera('.$this->teplomer_id.','.$this->address_id.',"'.$this->newKubov.'",
			      "'.$this->date_ar.'","'.$this->date_ao.'","'.$this->data_ot.'","'.$this->data_do.'","'.$this->pok_do.'","'.$this->pok_ot.'","'.$this->rday.'",
			      "'.$this->days.'","'.$this->qty_kub.'","'.$this->kub_day.'",@success,@msg)';
			break;
			case "insMeedlePokOTeplomera":			
			      $this->sql='CALL YISGRAND.insMeedlePokOTeplomera('.$this->teplomer_id.','.$this->filial_id.',"'.$this->newKubov.'",
			      "'.$this->date_ar.'","'.$this->date_ao.'","'.$this->data_ot.'","'.$this->data_do.'","'.$this->pok_do.'","'.$this->pok_ot.'","'.$this->rday.'",
			      "'.$this->days.'","'.$this->qty_kub.'","'.$this->kub_day.'",@success,@msg)';
			break;
			case "insMeedlePokVod":			
			      $this->sql='CALL YISGRAND.insMeedlePokVod('.$this->vodomer_id.','.$this->address_id.',"'.$this->type.'","'.$this->tek.'","'.$this->newKubov.'",
			      "'.$this->date_ar.'","'.$this->date_ao.'","'.$this->data_ot.'","'.$this->data_do.'","'.$this->pok_do.'","'.$this->pok_ot.'","'.$this->rday.'",
			      "'.$this->days.'","'.$this->qty_kub.'","'.$this->kub_day.'",@success,@msg)';
			break;
			case "insMeedlePokVodOrg":
			      $this->sql='CALL YISGRAND.insMeedlePokVodOrg('.$this->vodomer_id.','.$this->filial_id.',"'.$this->type.'","'.$this->tek.'","'.$this->newKubov.'",
			      "'.$this->date_ar.'","'.$this->date_ao.'","'.$this->data_ot.'","'.$this->data_do.'","'.$this->pok_do.'","'.$this->pok_ot.'","'.$this->rday.'",
			      "'.$this->days.'","'.$this->qty_kub.'","'.$this->kub_day.'",@success,@msg)';
			break;
			case "insMeedlePokDVod":			
			      $this->sql='CALL YISGRAND.insMeedlePokDVod('.$this->dvodomer_id.','.$this->house_id.',"'.$this->type.'","'.$this->tek.'","'.$this->newKubov.'",
			      "'.$this->date_ar.'","'.$this->date_ao.'","'.$this->data_ot.'","'.$this->data_do.'","'.$this->pok_do.'","'.$this->pok_ot.'","'.$this->rday.'",
			      "'.$this->days.'","'.$this->qty_kub.'","'.$this->kub_day.'",@success,@msg)';
			break;
			
			case "DVodomer":			
			      $this->sql='CALL YISGRAND.input_new_pokaz_dvodomer('.$this->dvodomer_id.','.$this->tek.','.$this->newValue.',"'.$this->date_new.'",@success,@msg)';

			break;	 
			case "NachDvodomer":			
			      $this->sql='CALL YISGRAND.NachDvodomer("'.$this->dvodomer_id.'","'.$this->date_new.'",@success,@msg)';

			break;	    
		}
//print($this->sql);
		$this->result = $_db->query($this->sql) or die('Connect Error in '.$this->what.'(' .  $this->sql . ') ' . $_db->connect_error);
		
		$this->sql_callback='SELECT @success,@msg';

		$this->res_callback = $_db->query($this->sql_callback) or die('Connect Error in '.$this->what.'(' .  $this->sql_callback . ') ' . $_db->connect_error);
		
		while ($this->row = $this->res_callback->fetch_assoc()) {
			$this->results['success'] = $this->row['@success'];
			$this->results['msg']	=$this->row['@msg'];
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