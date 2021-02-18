<?php
include_once './yis_config.php';

class QueryLoad
{

	private $_db;
	protected $login;
	protected $password;
	protected $result;
	protected $res_callback;
	protected $sql;	
	protected $sql_callback;
	protected $row;	
	protected $what_id;
	protected $what;
	protected $nomer;
	protected $type;
	protected $pokaz;
	protected $pred;
	protected $tek;
	protected $kub;
	protected $data=NULL;
	protected $res=array();	
	public	  $results=array();
	

	public function connect()
	{
		//                 'hostname', 'username' ,'password', 'database'
		$_db = new mysqli('localhost', LOGIN ,PASSWORD, 'YISGRAND');
		if ($_db->connect_error) {
			return false;
		} else {		
		$_db->set_charset("utf8");    
		return $_db;
		}
	}



	public function getResults(stdClass $params)
	{

		$_db = $this->connect();
		

		$array = (array) $params;
		foreach ( $array as $key => $value ) 
		  {
		  if(isset($value)) { 
					if (is_int($value)) { $this->$key= (int)$value;}
					else if (is_float($value)) { $this->$key= $value;}
					else {$this->$key =$value;}
		  }
		}
		$this->sql="";

		switch ($this->what) {
		case "StOrg"://in use			
		  $this->sql='SELECT t1.`org_id`,replace(replace(t1.`sname`,"\n",""),"\"","") as sname 
		  FROM YISGRAND.TM_ORG as  t1 WHERE  t1.`sname` like  replace("%'.$this->query.'%","\"","")  OR  t1.`edrpou` like replace("%'.$this->query.'%","\"","") ORDER BY t1.`sname`';
					  // print_r($this->sql); 
			break;
		case "getOrg"://in use			
			      $this->sql='SELECT * FROM YISGRAND.TM_ORG ';
					  // print_r($this->sql); 
			break;
		case "OrgCat":			
				$this->sql='SELECT `sobstv_id` AS cat_id, name FROM SPR_SOBSTV ORDER BY `sobstv_id`';
					    //print_r($this->sql); 
		break;
		case "Tarif":
				$this->sql='SELECT * FROM YIS.TARIF ORDER BY YIS.TARIF.`raion`';
					    //print($_sql); 
		break;
		case "TarifFromRaion":
				$this->sql='SELECT * FROM YIS.TARIF WHERE YIS.TARIF.`raion` ='.$this->what_id.' ORDER BY YIS.TARIF.`house_id`';
					    //print($_sql); 
		break;
		case "TarifFromRaionVoda":
				$this->sql='SELECT * FROM YIS.TARIF_VODA as t1 WHERE t1.`raion` ='.$this->what_id.' and t1.`data` = CONCAT(EXTRACT(YEAR_MONTH FROM CURDATE()),"01") ORDER BY t1.`house_id` ';
					    //print($_sql); 
		break;
		case "enaudit_in":
				$this->sql='SELECT * FROM YIS.TARIF_TEPLO as t1 WHERE  t1.`data` = CONCAT(EXTRACT(YEAR_MONTH FROM CURDATE()),"01") '
				.' and t1.enaudit = 1 and t1.`raion` ='.$this->raion_id.'  ORDER BY t1.`house_id`  ';
					    //print($_sql); 
		break;
		case "enaudit_out":
				$this->sql='SELECT * FROM YIS.TARIF_TEPLO as t1 WHERE  t1.`data` = CONCAT(EXTRACT(YEAR_MONTH FROM CURDATE()),"01") '
				.' and t1.enaudit = 0 and t1.`raion` ='.$this->raion_id.' ORDER BY t1.`house_id` ';
					    //print($_sql); 
		break;
		case "TarifVoda":
				$this->sql='SELECT * FROM YIS.TARIF_VODA as t1 WHERE t1.`house_id` ='.$this->house_id.'  ORDER BY t1.`rec_id` DESC LIMIT 12';
					    //print($_sql); 
		break;
		case "TarifVodaAll":
				$this->sql='SELECT * FROM YIS.TARIF_VODA as t1 WHERE t1.`house_id` ='.$this->house_id.'  ORDER BY t1.`rec_id` DESC';
					    //print($_sql); 
		break;
		case "Tarif_Ot":
				$this->sql='SELECT * FROM YIS.TARIF_TEPLO as t1 WHERE t1.`raion` ='.$this->what_id.' and t1.`data` = CONCAT(EXTRACT(YEAR_MONTH FROM CURDATE()),"01") ORDER BY t1.`house_id` ';
					    //print($_sql); 
		break;
		case "raion":
				$this->sql='SELECT * FROM YIS.RAION ORDER BY raion';
					    //print($_sql); 
		break;
		case "street":
				$this->sql='SELECT * FROM YIS.STREET ';
			    
		break;
		case "house":
				$this->sql='SELECT * FROM YIS.HOUSE WHERE raion_id in(1,2,3,4,5)';
					    //print($_sql);
		break;
		case "Prixod":			
			      $this->sql='SELECT * FROM YIS.PRIXOD WHERE  1' ;
			    
		break;
		case "StreetsFromRaion":
				if ($this->what_id==0) {
				    $this->sql='SELECT * FROM YIS.STREET ORDER BY street';
				} else {
				    $this->sql='SELECT YIS.STREET.street_id,'
						.'YIS.STREET.street '
						.' FROM YIS.STREET,YIS.HOUSE '
						.' WHERE YIS.STREET.street_id=YIS.HOUSE.street_id '
						.' AND YIS.HOUSE.raion_id='.$this->what_id.' '
						.' GROUP BY YIS.STREET.street_id '
						.' ORDER BY YIS.STREET.street';
				}
				  // print($this->sql);

		break;
		case "HousesFromRaion":
				$this->sql='SELECT raion_id,street_id,house_id,raion,house,house as item FROM YIS.HOUSE WHERE raion_id= '.$this->what_id.' ORDER BY house';
			    
		break;
		case "HousesFromStreet":
				if ($this->what_id == 0) { 
				    $this->sql='SELECT * FROM YIS.HOUSE ORDER BY house ';
				} else {
				    $this->sql='SELECT * FROM YIS.HOUSE WHERE street_id='.$this->what_id.'';
				}  
				  // print($this->sql);
		break;
		case "AddressFromHouses":
				 $this->sql='SELECT `address_id`, `address`,cast(appartment as unsigned) as app '
						 . 'FROM YIS.ADDRESS '
						 .' WHERE YIS.ADDRESS.`house_id`= '. $this->what_id.' '
						 .' ORDER BY app ';
				//print($this->sql);
			 
		    break;
	case "AddressFromHousesTarif":
			 
					$this->sql='SELECT * FROM YIS.APPARTMENT WHERE tar_house= '.$this->what_id.'';
			   // print($_sql);
			  
		    break;
	case "AddressDt":
	$this->sql='SELECT t1.address_id,t1.enaudit,t1.enaudit_id,t1.address,t1.area_full,t1.area_otopl,t1.otoplenie,t1.dteplomer_id FROM YIS.APPARTMENT as t1 WHERE t1.house_id= '.$this->house_id.'';
			   // print($_sql);
			  
		    break;
		case "Dteplomer"://применяется			
			    $this->sql='SELECT  *  FROM YIS.DTEPLOMER ';
					  //print( $this->sql);  
		      break;	
		case "Dvodomer"://применяется ??			
			    $this->sql='SELECT  *  FROM YIS.DVODOMER ';
					  //print( $this->sql);  
			break;	
		case "DteplomerHouse"://применяется			
			    $this->sql='SELECT * FROM YIS.DTEPLOMER '
					.' WHERE YIS.DTEPLOMER.house_id='.$this->what_id.''
					.' AND YIS.DTEPLOMER.spisan=0 ';
					// print( $this->sql);  
		      break;	
		case "DvodomerHouse"://применяется			
			    $this->sql='SELECT * FROM YIS.DVODOMER '
					.' WHERE YIS.DVODOMER.house_id='.$this->what_id.''
					.' AND YIS.DVODOMER.spisan=0 ';
					// print( $this->sql);  
		      break;		  	  
		case "Types"://применяется		
			      $this->sql='SELECT * FROM SPR_TYPES ORDER BY name';
			     //print_r($this->sql); 
			break;

		case "Sobstv"://применяется			
			      $this->sql='SELECT * FROM SPR_SOBSTV ORDER BY name';
			     //print_r($this->sql); 
			break;
		case "Sobstvu"://применяется			
			      $this->sql='SELECT * FROM SPR_SOBSTVU ORDER BY name';
			     //print_r($this->sql); 
			break;
		case "Rwork"://применяется			
			      $this->sql='SELECT * FROM SPR_RWORK ORDER BY name';
			     //print_r($this->sql); 
			break;
		
			case "OrgPhones":	
		
			      $this->sql='SELECT TM_PHONES.`phone_id` , TM_PHONES.`org_id` , TM_PHONES.`filial_id` , TM_PHONES.`phone` , TM_PHONES.`pname` , TM_ORG_FILIAL.`name`
			      FROM TM_PHONES
			      LEFT JOIN TM_ORG_FILIAL ON TM_PHONES.`filial_id` = TM_ORG_FILIAL.`filial_id`
			      WHERE TM_PHONES.`org_id` = "'.$this->what_id.'"
			      ORDER BY name';
			      //print_r($this->sql); 
			break;


			case "FilPhones":	
		
			      $this->sql='SELECT TM_PHONES.`phone_id` , TM_PHONES.`org_id` , TM_PHONES.`filial_id` , TM_PHONES.`phone` , TM_PHONES.`pname` , TM_ORG_FILIAL.`name`
			      FROM TM_PHONES
			      LEFT JOIN TM_ORG_FILIAL ON TM_PHONES.`filial_id` = TM_ORG_FILIAL.`filial_id`
			      WHERE TM_PHONES.`filial_id` = "'.$this->what_id.'"
			      ORDER BY pname';
			      //print_r($this->sql); 
			break;

			
			case "FilSobstvCateg":			
			      $this->sql='SELECT * FROM SPR_SOBSTV ORDER BY `sobstv_id` DESC';
			      //print_r($this->sql); 
			break;

			case "OrgServTypes":			
			      $this->sql='SELECT * FROM TM_SERVICES_TYPES ORDER BY `serv_type_id` DESC';
			      //print_r($this->sql); 
			break;

			case "Temperature":	//- 		
			      $this->sql='SELECT * FROM  YISGRAND.SP_TEMPERATURE ORDER BY YISGRAND.SP_TEMPERATURE.data DESC';
			      //print_r($this->sql); 
			break;


			case "Temperature_r":	//-		
			      $this->sql='SELECT * FROM  TM_TEMPERATURE_R ORDER BY date_from DESC';
			      //print_r($this->sql); 
			break;

			case "Temperature_pr":	//-		
			      $this->sql='SELECT * FROM  TM_TEMPERATURE_PR ORDER BY date_from DESC';
			      //print_r($this->sql); 
			break;


			case "TeplomerModel":	//-		
			      $this->sql='SELECT * FROM  YISGRAND.TMODEL ORDER BY model';
			      //print_r($this->sql); 
			break;

			case "VodomerModel":	//-		
			      $this->sql='SELECT * FROM  YISGRAND.VMODEL ORDER BY model';
			      //print_r($this->sql); 
			break;

			case "Uhpte":			
			      $this->sql='SELECT * FROM  YISGRAND.SPR_TYPESH ORDER BY name';
			      //print_r($this->sql); 
			break;

			case "Koef":			
			      $this->sql='SELECT * FROM  YISGRAND.TM_KOEF ORDER BY kname';
			      //print_r($this->sql); 
			break;

			case "Bank":			
			      $this->sql='SELECT * FROM  YISGRAND.BANKS ORDER BY sname';
			      //print_r($this->sql); 
			break;

			case "Mopt":			
			      $this->sql='SELECT * FROM  YIS.MOPT ORDER BY YIS.MOPT.`name`';
			      //print_r($this->sql); 
			break;
			case "FmOrgInfo": //in use			
			      $this->sql='SELECT * FROM TM_ORG WHERE org_id="'.$this->org_id.'" LIMIT 1';
			      //print_r($this->sql); 
			break;

			

		} // End of Switch ($what)
		
	
		
		$this->result = $_db->query($this->sql) or die('Connect Error in '.$this->what. ' (' .  $this->sql . ') ' . $_db->connect_error);

//		$this->result = $_db->query($this->sql) or die('Connect Error (' . $_db->connect_errno . ') ' . $_db->connect_error);
		
		while ($this->row = $this->result->fetch_assoc()) {
			array_push($this->res, $this->row);
		}
		$this->results['data']	= $this->res;
		
		return $this->results;
	}


/*	public function __destruct()
	{
		$_db = $this->connect($this->login,$this->password);
		$_db->close();
		
		return $this;
	}*/
}