<?php

class QueryAddress
{
	private $_db;
	protected $_result;
	protected $address_id;
	protected $private;
	protected $appartment;
	protected $_total;
	protected $_count;
	protected $_sql;
	protected $_sql_total;
	protected $_limit;
	protected $login;
	protected $password;
	protected $_array;
	protected $_id;
	protected $_what;	
	protected $_place;
	protected $_type;
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
		
		if(isset($params->what) && ($params->what)) {
		 $_what = $params->what;
		} else {
		  $_what = null;
		}
		if(isset($params->what_id) && ($params->what_id)) {
		  $_id = (int) $params->what_id;
		} else {
		  $_id = 0;
		}

		if(isset($params->address_id) && ($params->address_id)) {
		 $this->address_id = $params->address_id;
		} else {
		  $this->address_id = null;
		}
		if(isset($params->house_id) && ($params->house_id)) {
		 $this->house_id = $params->house_id;
		} else {
		  $this->house_id = null;
		}
		if(isset($params->privat) && ($params->privat)) {
		 $this->privat = $params->privat;
		} else {
		  $this->privat = 0;
		}
		if(isset($params->appartment) && ($params->appartment)) {
		 $this->appartment = $params->appartment;
		} else {
		  $this->appartment = null;
		}

		switch ($_what) {
	//inuse
		  case "raion":
			  $_sql_total=null; 
			  $_sql='SELECT * FROM YIS.RAION ORDER BY raion';
			   //print($_sql); 
		    break;
		     case "street":
			  $_sql_total=null; 
			  $_sql='SELECT * FROM YIS.STREET ';
			    
		    break;
		      case "house":
			  $_sql_total=null; 
			  $_sql='SELECT * FROM YIS.HOUSE';
	      //print($_sql);
			    
		    break;
		  case "HouseUpdateTeplo":
			  $_sql='SELECT t1.* FROM YIS.HOUSE as t1 WHERE t1.house_id='.$this->house_id.'';
	      //print($_sql);
			    
		    break;
		  case "StreetsFromRaion":
			$_sql_total=null; 
			if ($_id==0) {
			  $_sql='SELECT * FROM YIS.STREET ORDER BY street';
			} else {
			  $_sql='SELECT YIS.STREET.privat,YIS.STREET.street_id, YIS.STREET.street FROM YIS.STREET, YIS.HOUSE WHERE YIS.STREET.street_id=YIS.
			  HOUSE.street_id AND YIS.HOUSE.raion_id='.$_id.' GROUP BY YIS.STREET.street_id ORDER BY YIS.STREET.street';
			}
			    
		    break;

		    case "HousesFromRaion":
			  $_sql_total=null; 
			  $_sql='SELECT raion_id,street_id,house_id,raion,house,house as item FROM YIS.HOUSE WHERE raion_id= '.$_id.' ORDER BY house';
			    
		    break;
/*
		    case "HousesFromStreet":
			  $_sql_total=null; 
			  if ($_id == 0) {
			    $_sql='SELECT raion_id,street_id,house_id,house,raion,house,house as item FROM YIS.HOUSE ORDER BY house';
			  }  else if($this->privat) {
			    $_sql='SELECT raion_id,street_id,house_id,address_id,house,raion,house,street,address,appartment,address as item,cast(appartment as unsigned) as app FROM YIS.ADDRESS WHERE street_id= '.$_id.' ORDER BY app';
			   } else {
			    $_sql='SELECT raion_id,street_id,house_id,house,raion,house,house as item FROM YIS.HOUSE WHERE street_id= '.$_id.' ORDER BY house';
			  }   
//print($_sql);
		    break;
		    */
		      case "HousesFromStreet":
			  $_sql_total=null; 
			  if ($_id == 0) {
			    $_sql='SELECT raion_id,street_id,house_id,house,raion,house,house as item FROM YIS.HOUSE ORDER BY house';
			  }  else if($this->privat) {
			    $_sql='SELECT raion_id,street_id,house_id,address_id,house,raion,house,street,address,appartment,address as item,cast(appartment as unsigned) as app 
			    FROM YIS.ADDRESS WHERE street_id= '.$_id.' ORDER BY app';
			  
			   } else {
			    $_sql='SELECT raion_id,street_id,house_id,house,raion,house,house as item FROM YIS.HOUSE WHERE street_id= '.$_id.' ORDER BY house';
			  }   
		    break;
		   
		   case "AddressFromHouse":
			  $_sql_total=null; 
			   $_sql='SELECT raion_id,street_id,house_id,address_id,house,raion,house,street,address,appartment,address as item,cast(appartment as unsigned) as app 
			    FROM YIS.ADDRESS WHERE house_id= '.$_id.' ORDER BY app';
		    break;
		    
		       case "AddressFromHouses":
			  $_sql_total=null; 
			  if ($_id == 0) { $_sql='SELECT address_id, address FROM YIS.ADDRESS ORDER BY address';
			  } else {
			  $_sql='SELECT * FROM YIS.ADDRESS WHERE house_id= '.$_id.'';
			    //print($_sql);
			  }
		    break;
			
		     case "address":
			  $_sql_total=null; 
			  $_sql='SELECT * FROM YIS.ADDRESS  WHERE address_id='.$_id.' LIMIT 1';
			    
		    break;


		    case "CheckFlat":

			  $_sql_total=null; 
			  $_sql='SELECT raion_id,street_id,house_id,address_id,house,raion,house,street,address,appartment FROM YIS.ADDRESS WHERE house_id='.$this->house_id.' AND appartment="'.$this->appartment.'" LIMIT 1';
			// print($_sql);  
		    break;
		    case "HistoryAppartment":
			  $_sql_total=null; 
			  $_sql= 'SELECT *  FROM YIS.APP_HISTORY WHERE `address_id`='.$_id.' order by `data_in` DESC'; 
//print($_sql);
		    break;
		     case "SearchCitizen":
		     $_sql_total=null; 
			  $_sql= 'SELECT t1.`raion_id`, t2.`house`,t1.`address_id`,t1.`address`,t1.`fio` as owner ,t1.`nanim`  FROM YIS.APPARTMENT as t1,YIS.HOUSE as t2 WHERE t2.house_id = t1.house_id and  t1.`raion_id` in(1,2,3,4)'; 
//print($_sql);
		    break;
		      $_sql_total=null; 
			  $_sql= 'SELECT t1.`raion_id`, t2.`house`,t1.`address_id`,t1.`address`,t1.`fio` as owner ,t1.`nanim`  FROM YIS.APPARTMENT as t1,YIS.HOUSE as t2 WHERE t2.house_id = t1.house_id and  t1.`raion_id` in(1,2,3,4,5)'; 
//print($_sql);
		    break;
		    case "Appartment":
			  $_sql_total=null; 
			  $_sql= 'SELECT `raion_id`, `house_id`,`address_id`,`address`,`kod`,`lift`,`fio` as owner ,`order`,`data` as data_ordera,`privat`,'
				  .'`room`,`area_full`,`area_life`,`area_balk`,`area_dop`,`area_otopl`, `nanim`,`tenant`,`absent`,`podnan`,`lgotchik`,(CASE WHEN lgotchik > 0 THEN 1 ELSE 0 END ) as lgota, `vxvoda`,'
				  .'`vgvoda`, `teplomer`,`dteplomer_id`,`dvodomer_id`,`teplomer_id`,`boiler`,`kvartplata`,`otoplenie`,`podogrev`,`voda`,`stoki`,`tbo`,`subsidia`,aggr_voda,' .'aggr_teplo,aggr_tbo,aggr_kv,`type_teplo`,`type_voda`,`length`,`diametr`,`enaudit`,`tne`,`kte`,`heated`,`phone`,`email`,`operator`,'
				  .'`what_change`,`data_change`,`data_change` as chdate, inn, passport, vidan,  viddata, '
				  .'(SELECT `nomer` FROM YIS.DOGOVOR_YTKE WHERE `address_id`='.$_id.' LIMIT 1) AS dog_ytke, '
				  .'(SELECT `nomer` FROM YIS.DOGOVOR_VIK WHERE `address_id`='.$_id.' LIMIT 1) AS dog_vik,'
				  .'(SELECT `nomer` FROM YISGRAND.DOGOVOR_VIK WHERE `address_id`='.$_id.' LIMIT 1) AS rdog_vik'
				  .' FROM YIS.APPARTMENT WHERE `address_id`='.$_id.' order by `data_in` limit 1'; 
//print($_sql);  
		 break;
		   case "TabHouseResidents":
	$_sql= 'SELECT t1.* , cast(t2.`appartment` as unsigned) as  app FROM YIS.APPARTMENT as t1 LEFT JOIN YIS.ADDRESS as t2 USING(`address_id`)  WHERE t1.`house_id`='.$this->house_id.' order by app' ; 

//print($_sql);  
		 break;
		    case "Lgotnik"://применяется
			 // $_sql_total='SELECT * FROM VODOMER WHERE address_id='.$_id.''; 
			   $_sql='SELECT YIS.LGOTAMEN.`lgotnik_id`,YIS.LGOTAMEN.`lgota_id`,YIS.LGOTAMEN.`address_id`, YIS.LGOTAMEN.`address`, YIS.LGOTAMEN.`kartochka`, YIS.LGOTAMEN.`inn`, YIS.LGOTAMEN.`passport`, '
				  .' CONCAT(YIS.LGOTAMEN.`surname`,\' \', SUBSTRING(YIS.LGOTAMEN.`firstname`,1,1),\'.\',SUBSTRING(YIS.LGOTAMEN.`lastname`,1,1),\'.\') as fio, '
				  .' YIS.LGOTAMEN.`surname`, YIS.LGOTAMEN.`firstname`, YIS.LGOTAMEN.`lastname`, YIS.LGOTAMEN.`surname_ua`, YIS.LGOTAMEN.`firstname_ua`, YIS.LGOTAMEN.`lastname_ua`, '
				  .' YIS.LGOTAMEN.`document`, YIS.LGOTAMEN.`lgota`, YIS.LGOTAMEN.`category`, YIS.LGOTAMEN.`people`, YIS.LGOTAMEN.`percent`, YIS.LGOTAMEN.`given`, YIS.LGOTAMEN.`data`, '
					.' YIS.LGOTAMEN.`start`, YIS.LGOTAMEN.`finish`,YIS.LGOTAMEN.`gr`, YIS.LGOTAMEN.`vkl`,'
					.' YIS.LGOTAMEN.`raion`, YIS.LGOTAMEN.`operator`, YIS.LGOTAMEN.`data_in` FROM YIS.LGOTAMEN WHERE  YIS.LGOTAMEN.address_id='.$_id.' AND YIS.LGOTAMEN.vkl = "да"';
			break;
			 case "Famaly"://применяется
			 // $_sql_total='SELECT * FROM VODOMER WHERE address_id='.$_id.''; 
			   $_sql='SELECT t1.*  FROM YISGRAND.FAMALY as t1 WHERE  t1.address_id='.$_id.' AND t1.vkl = "да"';
			   			   	//print($_sql);  

			break;
			case "HistoryFamaly"://применяется
			   $_sql='SELECT *  FROM YISGRAND.FAMALY as t1 WHERE  t1.address_id='.$_id.'';
		    break;  
			  
	    case "HistoryLgotnik"://применяется
			   $_sql='SELECT YIS.LGOTAMEN.`lgotnik_id`,YIS.LGOTAMEN.`lgota_id`,YIS.LGOTAMEN.`address_id`, YIS.LGOTAMEN.`address`, YIS.LGOTAMEN.`kartochka`, YIS.LGOTAMEN.`inn`, YIS.LGOTAMEN.`passport`, '
				  .' CONCAT(YIS.LGOTAMEN.`surname`,\' \', SUBSTRING(YIS.LGOTAMEN.`firstname`,1,1),\'.\',SUBSTRING(YIS.LGOTAMEN.`lastname`,1,1),\'.\') as fio, '
				  .' YIS.LGOTAMEN.`surname`, YIS.LGOTAMEN.`firstname`, YIS.LGOTAMEN.`lastname`, YIS.LGOTAMEN.`surname_ua`, YIS.LGOTAMEN.`firstname_ua`, YIS.LGOTAMEN.`lastname_ua`, '
				  .' YIS.LGOTAMEN.`document`, YIS.LGOTAMEN.`lgota`, YIS.LGOTAMEN.`category`, YIS.LGOTAMEN.`people`, YIS.LGOTAMEN.`percent`, YIS.LGOTAMEN.`given`, YIS.LGOTAMEN.`data`, '
					.' YIS.LGOTAMEN.`start`, YIS.LGOTAMEN.`finish`,YIS.LGOTAMEN.`gr`, YIS.LGOTAMEN.`vkl`,'
					.' YIS.LGOTAMEN.`raion`, YIS.LGOTAMEN.`operator`, YIS.LGOTAMEN.`data_in` FROM YIS.LGOTAMEN WHERE  YIS.LGOTAMEN.address_id='.$_id.'';
	//print($_sql);  

		    break;
		     case "TekNach":			  
			  $_sql_total='SELECT * FROM YIS.KVARTPLATA  WHERE address_id='.$_id.''; 
			   $_sql='(SELECT 1 as p,address_id,data,DATE_FORMAT(data,"%m-%Y") as fdate,SUBSTRING(`usluga`,1,5) as usluga,CONCAT_WS(" ",mec,god) as period,zadol,0 as hzadol,'
				  .'CASE WHEN people=0 THEN "куб" ELSE "чел" END as edizm,xkub+gkub+people as qty,tarif,nachisleno-perer as nachisleno,perer,-(budjet+pbudjet) as budjet,'
				  .'nachisleno+perer+budjet+pbudjet as itogo,oplacheno,subsidia,subs,dolg,0 as hdolg FROM YIS.VODA  WHERE address_id='.$_id.' ORDER BY data DESC LIMIT 1 ) UNION ' 
				  .' (SELECT 2 as p,address_id,data,DATE_FORMAT(data,"%m-%Y") as fdate,SUBSTRING(`usluga`,1,5) as usluga,CONCAT_WS(" ",mec,god) as period,zadol,0 as hzadol,'
				  .'CASE WHEN people=0 THEN "куб" ELSE "чел" END as edizm,xkub+gkub+people as qty,tarif,nachisleno-perer as nachisleno,perer,-(budjet+pbudjet) as budjet,'
				  .'nachisleno+perer+budjet+pbudjet as itogo,oplacheno,subsidia,subs,dolg,0 as hdolg FROM YIS.STOKI  WHERE address_id='.$_id.' ORDER BY data DESC LIMIT 1 ) UNION '
				  .' (SELECT 3 as p,address_id,data,DATE_FORMAT(data,"%m-%Y") as fdate,SUBSTRING(`usluga`,1,5) as usluga,CONCAT_WS(" ",mec,god) as period,zadol,0 as hzadol,'
				  .'CASE WHEN people=0 THEN "куб" ELSE "чел" END as edizm,gkub+people as qty,tarif,nachisleno-perer as nachisleno,perer,-(budjet+pbudjet) as budjet,'
				  .'nachisleno+perer+budjet+pbudjet as itogo,oplacheno,subsidia,subs,dolg,0 as hdolg FROM YIS.PODOGREV  WHERE address_id='.$_id.' ORDER BY data DESC LIMIT 1 ) UNION '    
				  .' (SELECT 4 as p,address_id,data,DATE_FORMAT(data,"%m-%Y") as fdate,SUBSTRING(`usluga`,1,5) as usluga,CONCAT_WS(" ",mec,god) as period,zadol,0 as hzadol,'
				  .'CASE WHEN gkal=0 THEN "м2" ELSE "Гкал" END as edizm,CASE WHEN gkal=0 THEN square ELSE gkal END as qty,CASE WHEN gkal=0 THEN tarif ELSE tarif_gkal END as tarif,'
				  .'nachisleno-perer as nachisleno,perer,-(budjet+pbudjet) as budjet,nachisleno+perer+budjet+pbudjet as itogo,oplacheno,subsidia,subs,dolg,0 as hdolg '
				   .'FROM YIS.OTOPLENIE  WHERE address_id='.$_id.' ORDER BY data DESC LIMIT 1 ) UNION '    
				  .' (SELECT 5 as p,address_id,data,DATE_FORMAT(data,"%m-%Y") as fdate,SUBSTRING(`usluga`,1,5) as usluga,CONCAT_WS(" ",mec,god) as period,zadol,0 as hzadol,"м2" as edizm,square as qty,tarif,'
				   .'nachisleno-perer-raznoe as nachisleno,perer,-(budjet+pbudjet) as budjet,'
				  .'nachisleno+perer+budjet+pbudjet as itogo,oplacheno,subsidia,dolg,0 as hdolg FROM YIS.KVARTPLATA  WHERE address_id='.$_id.' ORDER BY data DESC LIMIT 1 ) UNION '    
				  .' (SELECT 6 as p,address_id,data,DATE_FORMAT(data,"%m-%Y") as fdate,SUBSTRING(`usluga`,1,5) as usluga,CONCAT_WS(" ",mec,god) as period,zadol,0 as hzadol,'
				  .'"чел" as edizm,people as qty,tarif,nachisleno-perer as nachisleno,perer,-(budjet+pbudjet) as budjet,'
				  .'nachisleno+perer+budjet+pbudjet as itogo,oplacheno,subsidia,subs,dolg,0 as hdolg FROM YIS.TBO  WHERE address_id='.$_id.' ORDER BY data DESC LIMIT 1 )  ORDER BY data DESC ,p';
//print($_sql);
		    break;
		       case "YearNachisleno":
			  $_sql_total=null; 
			  $_sql='SELECT god FROM YIS.VODA    GROUP BY god DESC'; 
					    
		    break;
		       case "NachDetail":
			 //print_r($_period); 
			  $_sql_total=null; 
			  $_sql='SELECT * FROM '.$_table.' WHERE address_id='.$_id.' and data=DATE_FORMAT("'.$_period.'","%Y-%m-%d")'; 
				//	      print($_sql);
		    break;

		} // End of Switch ($what)
		
	
		if($_db){
		

		$_result = $_db->query($_sql) or die('Connect Error in '. $_what .'  (    ' .  $_sql . '    ) ' . $_db->connect_error);

		$_array=array();
		while ($row = $_result->fetch_assoc()) {
			array_push($_array, $row);
		}
		$results = array();
		$results['success']= true;


		//if ($results['total']	= $_total;
		$results['total']= null;
		/*if(isset($results['total') && ($results['total')) {
		 $results['total' = $results['total';
		} else {
		   $results['total'= null;
		}*/


		$results['data']= $_array;
		}else{
		 $results['success']= false;
		}
		return $results;
	}
	public function updateRecords(stdClass $params)      // ================================= UPDATE RECORDS
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
		//$this->recs=implode(',',$params->rec);
		//$this->recs=implode('":"',$this->rec);

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
		
				//print($this->recs);

		switch ($this->what) {
		
	case "AppartmentUpdateBti":
		 $this->sql='CALL YISGRAND.AppartmentUpdateBti("'
		.$this->address_id.'","'
		.$this->house_id.'","'
		.$this->tenant.'","'
		.$this->absent.'","'
		.$this->podnan.'","'		
		.$this->nanim.'", "'
		.$this->owner.'", "'
		.$this->inn.'", "'
		.$this->passport.'", "'
		.$this->vidan.'", "'
		.$this->viddata.'", "'
		.$this->privat.'", "'
		.$this->order.'", "'
		.$this->data_ordera.'","'
		.$this->what_change.'", "'
		.$this->data_change.'", "'
		.$this->info.'", "'
		.$this->phone.'", "'
		.$this->email.'","'
		.$this->chdata.'",'
		.' @success, @msg)';
			 // print($this->sql);
	break;
	case "AppartmentUpdateKod":
		 $this->sql='CALL YISGRAND.newAddressKod("'.$this->address_id.'", @success, @msg)';
			 // print($this->sql);
	break;
	case "AppartmentUpdateTbo":
		 $this->sql='CALL YISGRAND.AppartmentUpdateTbo("'
		.$this->address_id.'","'
		.$this->tbo.'",'		
		.' @success, @msg)';
			 // print($this->sql);
	break;
	case "AppartmentUpdateTeplo":
		 $this->sql='CALL YISGRAND.AppartmentUpdateTeplo("'
		.$this->address_id.'","'		
		.$this->area_otopl.'","'		
		.$this->teplomer.'","'
		.$this->dteplomer_id.'","'
		.$this->boiler.'", "'		
		.$this->podogrev.'", "'
		.$this->otoplenie.'", "'		
		.$this->type_teplo.'","'		
		.$this->length.'","'
		.$this->diametr.'","'
		.$this->enaudit.'","'		
		.$this->tne.'","'
		.$this->kte.'","'
		.$this->heated.'",'		
		.' @success, @msg)';
			 // print($this->sql);
	break;
	case "AppartmentUpdateVoda":
		 $this->sql='CALL YISGRAND.AppartmentUpdateVoda("'
		.$this->address_id.'","'		
		.$this->distributor.'","'
		.$this->dvodomer_id.'","'		
		.$this->vgvoda.'", "'
		.$this->vxvoda.'", "'
		.$this->voda.'", "'
		.$this->stoki.'", "'		
		.$this->type_voda.'",'		
		.' @success, @msg)';			
	break;
 case "AppartmentChangeBti":
		 $this->sql='CALL YISGRAND.AppartmentChangeBti("'
		.$this->address_id.'","'
		.$this->house_id.'","'		
		.$this->tenant.'","'
		.$this->absent.'","'
		.$this->podnan.'","'
		.$this->nanim.'", "'
		.$this->owner.'", "'
		.$this->inn.'", "'
		.$this->passport.'", "'
		.$this->vidan.'", "'
		.$this->viddata.'", "'
		.$this->privat.'", "'
		.$this->order.'", "'
		.$this->data_ordera.'","'
		.$this->what_change.'", "'
		.$this->data_change.'", "'
		.$this->info.'", "'
		.$this->phone.'","'
		.$this->email.'","'
		.$this->operator.'","'
		.$this->chdata.'", '
		.' @success, @msg)';
			// print($this->sql);
		break;
			case "AppVodaIns":
				 $this->sql='UPDATE YIS.VODA SET zadol="'.$this->zadol.'",'
				.'YIS.VODA.people="'.$this->people.'",'
				.'YIS.VODA.xkub="'.$this->xkub.'",'
				.'YIS.VODA.kub_avg="'.$this->kub_avg.'",'
				.'YIS.VODA.kub_add="'.$this->kub_add.'",'
				.'YIS.VODA.xvoda_add="'.$this->xvoda_add.'",'
				.'YIS.VODA.xvoda_avg="'.$this->xvoda_avg.'",'
				.'YIS.VODA.gkub="'.$this->gkub.'",'
				.'YIS.VODA.kubn="'.$this->kubn.'",'
				.'YIS.VODA.pkub="'.$this->pkub.'",'
				.'YIS.VODA.tarif="'.$this->tarif.'",'
				.'YIS.VODA.norma="'.$this->norma.'",'
				.'YIS.VODA.xvoda="'.$this->xvoda.'",'
				.'YIS.VODA.gvoda="'.$this->gvoda.'",'
				.'YIS.VODA.perer="'.$this->perer.'",'
				.'YIS.VODA.nachisleno="'.$this->nachisleno.'",'
				.'YIS.VODA.xkub_lg="'.$this->xkub_lg.'",'
				.'YIS.VODA.gkub_lg="'.$this->gkub_lg.'",'
				.'YIS.VODA.budjet="'.$this->budjet.'",'
				.'YIS.VODA.pbudjet="'.$this->pbudjet.'",'
				.'YIS.VODA.oplacheno="'.$this->oplacheno.'",'
				.'YIS.VODA.rzadol="'.$this->rzadol.'",'
				.'YIS.VODA.roplata="'.$this->roplata.'",'
				.'YIS.VODA.roplacheno="'.$this->roplacheno.'",'
				.'YIS.VODA.rdolg="'.$this->rdolg.'",'
				.'YIS.VODA.dolg="'.$this->dolg.'",'
				.'YIS.VODA.info="'.$this->info.'",'
				.'YIS.VODA.operator="'.$this->login.'",'
				.'YIS.VODA.data_in= CURDATE() '
				.' WHERE YIS.VODA.address_id='.$this->address_id.' AND '
				.' YIS.VODA.data = CONCAT(EXTRACT(YEAR_MONTH FROM "'.$this->data.'"),"01") LIMIT 1';
			   //print_r($this->sql); 
			break;
		      case "AppStokiIns":
			 $this->sql='UPDATE YIS.STOKI SET zadol="'.$this->zadol.'",'
				.'YIS.STOKI.people="'.$this->people.'",'
				.'YIS.STOKI.xkub="'.$this->xkub.'",'
				.'YIS.STOKI.kub_avg="'.$this->kub_avg.'",'
				.'YIS.STOKI.kub_add="'.$this->kub_add.'",'
				.'YIS.STOKI.xvoda_add="'.$this->xvoda_add.'",'
				.'YIS.STOKI.xvoda_avg="'.$this->xvoda_avg.'",'
				.'YIS.STOKI.gkub="'.$this->gkub.'",'
				.'YIS.STOKI.kubn="'.$this->kubn.'",'
				.'YIS.STOKI.pkub="'.$this->pkub.'",'
				.'YIS.STOKI.tarif="'.$this->tarif.'",'
				.'YIS.STOKI.norma="'.$this->norma.'",'
				.'YIS.STOKI.xvoda="'.$this->xvoda.'",'
				.'YIS.STOKI.gvoda="'.$this->gvoda.'",'
				.'YIS.STOKI.perer="'.$this->perer.'",'
				.'YIS.STOKI.nachisleno="'.$this->nachisleno.'",'
				.'YIS.STOKI.xkub_lg="'.$this->xkub_lg.'",'
				.'YIS.STOKI.gkub_lg="'.$this->gkub_lg.'",'
				.'YIS.STOKI.budjet="'.$this->budjet.'",'
				.'YIS.STOKI.pbudjet="'.$this->pbudjet.'",'
				.'YIS.STOKI.oplacheno="'.$this->oplacheno.'",'
				.'YIS.STOKI.dolg="'.$this->dolg.'",'
				.'YIS.STOKI.info="'.$this->info.'",'
				.'YIS.STOKI.operator="'.$this->login.'",'
				.'YIS.STOKI.data_in= CURDATE() '
				.' WHERE YIS.STOKI.address_id='.$this->address_id.' AND '
				.' YIS.STOKI.data = CONCAT(EXTRACT(YEAR_MONTH FROM "'.$this->data.'"),"01") LIMIT 1';
			    //print_r($this->sql); 
			break;
			case "AppAvodaIns":
				 $this->sql='UPDATE YIS.AVODA as t1 SET t1.zadol="'.$this->zadol.'",t1.abonplata="'.$this->abonplata.'",t1.perer="'.$this->perer.'",'
				.'t1.nachisleno="'.$this->nachisleno.'",t1.oplacheno="'.$this->oplacheno.'",t1.dolg="'.$this->dolg.'",t1.operator="'.$this->login.'" '
				.' WHERE t1.address_id='.$this->address_id.' AND  t1.data = CONCAT(EXTRACT(YEAR_MONTH FROM "'.$this->data.'"),"01") LIMIT 1';
			break;
			case "AppPodogrevIns":
				 $this->sql='UPDATE YIS.PODOGREV as t1 SET t1.zadol="'.$this->zadol.'",'
				.'t1.people="'.$this->people.'",'
				.'t1.kub="'.$this->kub.'",'
				.'t1.gkal="'.$this->gkal.'",'
				.'t1.tarif="'.$this->tarif.'",'
				.'t1.norma="'.$this->norma.'",'
				.'t1.podogrev="'.$this->podogrev.'",'
				.'t1.perer="'.$this->perer.'",'
				.'t1.nachisleno="'.$this->nachisleno.'",'
				.'t1.gkub_lg="'.$this->gkub_lg.'",'
				.'t1.budjet="'.$this->budjet.'",'
				.'t1.pbudjet="'.$this->pbudjet.'",'
				.'t1.oplacheno="'.$this->oplacheno.'",'
				.'t1.dolg="'.$this->dolg.'",'
				.'t1.info="'.$this->info.'",'
				.'t1.operator="'.$this->login.'",'
				.'t1.data_in= CURDATE() '
				.' WHERE t1.address_id='.$this->address_id.' AND  t1.data = CONCAT(EXTRACT(YEAR_MONTH FROM "'.$this->data.'"),"01") LIMIT 1';
			    //print_r($this->sql); 
			break;
			case "AppPtnIns":
				 $this->sql='UPDATE YIS.PTN as t1 SET t1.zadol="'.$this->zadol.'",'
				.'t1.tarif_m2="'.$this->tarif_m2.'",'
				.'t1.square="'.$this->square.'",'
				.'t1.gkm2="'.$this->gkm2.'",'
				.'t1.gkal="'.$this->gkal.'",'
				.'t1.tarif="'.$this->tarif.'",'
				.'t1.ptn="'.$this->ptn.'",'
				.'t1.perer="'.$this->perer.'",'
				.'t1.nachisleno="'.$this->nachisleno.'",'
				.'t1.square_lg="'.$this->square_lg.'",'
				.'t1.budjet="'.$this->budjet.'",'
				.'t1.pbudjet="'.$this->pbudjet.'",'
				.'t1.oplacheno="'.$this->oplacheno.'",'
				.'t1.dolg="'.$this->dolg.'",'
				.'t1.info="'.$this->info.'",'
				.'t1.operator="'.$this->login.'",'
				.'t1.data_in= CURDATE() '
				.' WHERE t1.address_id='.$this->address_id.' AND  t1.data = CONCAT(EXTRACT(YEAR_MONTH FROM "'.$this->data.'"),"01") LIMIT 1';
			    //print_r($this->sql); 
			break;
	case "AppOtoplenieIns":
				 $this->sql='UPDATE YIS.OTOPLENIE as t1 SET zadol="'.$this->zadol.'",'
				 .'t1.metod="'.$this->metod.'",'
				.'t1.square="'.$this->square.'",'
				.'t1.gkal="'.$this->gkal.'",'
				.'t1.gkm2_add="'.$this->gkm2_add.'",'
				.'t1.gkm2="'.$this->gkm2.'",'
				.'t1.gkm2_mop="'.$this->gkm2_mop.'",'
				.'t1.gkal_mop="'.$this->gkal_mop.'",'
				.'t1.tarif="'.$this->tarif.'",'
				.'t1.tarif_gkal="'.$this->tarif_gkal.'",'
				.'t1.data_perer="'.$this->data_perer.'",'
				.'t1.tarif_perer="'.$this->tarif_perer.'",'
				.'t1.gkm2_perer="'.$this->gkal_old.'",'
				.'t1.gkm2_perer="'.$this->gkal_new.'",'				
				.'t1.perer_gkal="'.$this->perer_gkal.'",'
				.'t1.gkm2_perer="'.$this->gkm2_perer.'",'
				.'t1.perer="'.$this->perer.'",'
				.'t1.mop="'.$this->mop.'",'
				.'t1.otoplenie="'.$this->otoplenie.'",'
				.'t1.otoplenie_gkal="'.$this->otoplenie_gkal.'",'
				.'t1.nachisleno="'.$this->nachisleno.'",'
				.'t1.square_lg="'.$this->square_lg.'",'
				.'t1.budjet="'.$this->budjet.'",'
				.'t1.pbudjet="'.$this->pbudjet.'",'
				.'t1.budjet_mop="'.$this->budjet_mop.'",'
				.'t1.gkal_add="'.$this->gkal_add.'",'
				.'t1.budjet_m2="'.$this->budjet_m2.'",'
				.'t1.gkm2_lg="'.$this->gkm2_lg.'",'
				.'t1.square_lg="'.$this->square_lg.'",'
				.'t1.oplacheno="'.$this->oplacheno.'",'
				.'t1.dolg="'.$this->dolg.'",'
				.'t1.kzadol="'.$this->kzadol.'",'
				.'t1.kdolg="'.$this->kdolg.'",'
				.'t1.koplacheno="'.$this->koplacheno.'",'
				.'t1.knachisleno="'.$this->knachisleno.'",'
				.'t1.koplata="'.$this->koplata.'",'
				.'t1.info="'.$this->info.'",'
				.'t1.operator="'.$this->login.'",'
				.'t1.data_in= CURDATE() '
				.'WHERE t1.address_id='.$this->address_id.' AND t1.data = CONCAT(EXTRACT(YEAR_MONTH FROM "'.$this->data.'"),"01") LIMIT 1';
			    //print_r($this->sql); 
			break;
	case "AppKvartplataIns":
				 $this->sql='UPDATE YIS.KVARTPLATA SET zadol="'.$this->zadol.'",'
				.'YIS.KVARTPLATA.square="'.$this->square.'",'
				.'YIS.KVARTPLATA.kvartplata="'.$this->kvartplata.'",'
				.'YIS.KVARTPLATA.dop="'.$this->dop.'",'
				.'YIS.KVARTPLATA.tarif="'.$this->tarif.'",'
				.'YIS.KVARTPLATA.perer="'.$this->perer.'",'
				.'YIS.KVARTPLATA.nachisleno="'.$this->nachisleno.'",'
				.'YIS.KVARTPLATA.square_lg="'.$this->square_lg.'",'
				.'YIS.KVARTPLATA.budjet="'.$this->budjet.'",'
				.'YIS.KVARTPLATA.pbudjet="'.$this->pbudjet.'",'
				.'YIS.KVARTPLATA.oplacheno="'.$this->oplacheno.'",'
				.'YIS.KVARTPLATA.dolg="'.$this->dolg.'",'
				.'YIS.KVARTPLATA.info="'.$this->info.'",'
				.'YIS.KVARTPLATA.operator="'.$this->login.'",'
				.'YIS.KVARTPLATA.data_in= CURDATE() '
				.' WHERE YIS.KVARTPLATA.address_id='.$this->address_id.' AND '
				.' YIS.KVARTPLATA.data = CONCAT(EXTRACT(YEAR_MONTH FROM "'.$this->data.'"),"01") LIMIT 1';
			    //print_r($this->sql); 
			break;
	case "AppTboIns":
				 $this->sql='UPDATE YIS.TBO SET zadol="'.$this->zadol.'",'
				.'YIS.TBO.people="'.$this->people.'",'
				.'YIS.TBO.tbo="'.$this->tbo.'",'
				.'YIS.TBO.tarif="'.$this->tarif.'",'
			  .'YIS.TBO.perer="'.$this->perer.'",'
				.'YIS.TBO.nachisleno="'.$this->nachisleno.'",'
				.'YIS.TBO.people_lg="'.$this->people_lg.'",'
				.'YIS.TBO.budjet="'.$this->budjet.'",'
				.'YIS.TBO.pbudjet="'.$this->pbudjet.'",'
				.'YIS.TBO.oplacheno="'.$this->oplacheno.'",'
				.'YIS.TBO.dolg="'.$this->dolg.'",'
				.'YIS.TBO.info="'.$this->info.'",'
				.'YIS.TBO.operator="'.$this->login.'",'
				.'YIS.TBO.data_in= CURDATE() '
				.' WHERE YIS.TBO.address_id='.$this->address_id.' AND '
				.' YIS.TBO.data = CONCAT(EXTRACT(YEAR_MONTH FROM "'.$this->data.'"),"01") LIMIT 1';
			    //print_r($this->sql); 
			break;
	case "HouseUpdate":
				 $this->sql='UPDATE YIS.HOUSE as t1 SET t1.storeys_id="'.$this->storeys_id.'",'
				.'t1.itp_id="'.$this->itp_id.'",'
				.'t1.gvs="'.$this->gvs.'",'
				.'t1.mop="'.$this->mop.'",'
				.'t1.tnb="'.$this->tnb.'",'
				.'t1.typeh_id="'.$this->typeh_id.'",'
				.'t1.enaudit="'.$this->enaudit.'"'				
				.' WHERE t1.house_id='.$this->house_id.'  LIMIT 1';
			   // print_r($this->sql); 
			break;		
	case "addLgotaVoda":
			      $this->sql='CALL YISGRAND.addLgotaVoda('
										      .$this->lgotnik_id.','
										      .$this->lgota_id.','
										      .$this->house_id.','
										      .$this->address_id.',"'
													.$this->address.'","'
										      .$this->fio.'","'
													.$this->lgota.'","'
													.$this->percent.'","'
										      .$this->inn.'","'
										      .$this->people.'","'
										      .$this->category.'","'
										      .$this->pok_id.'","'
										      .$this->gr.'","'
										      .$this->qty.'","'
										      .$this->tarif.'","'
										      .$this->data.'","'
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->summa.'","'
										      .$this->chekInput.'","'
										      .$this->chekVoda.'","'
										      .$this->checkType.'","'
										      .$this->info.'",'
										      .'@success,@msg)';
			break;
	case "addLgotaStoki":
			      $this->sql='CALL YISGRAND.addLgotaStoki('
										      .$this->lgotnik_id.','
										      .$this->lgota_id.','
										      .$this->house_id.','
										      .$this->address_id.',"'
													.$this->address.'","'
										      .$this->fio.'","'
													.$this->lgota.'","'
													.$this->percent.'","'
										      .$this->inn.'","'
										      .$this->people.'","'
										      .$this->category.'","'
										      .$this->pok_id.'","'
										      .$this->gr.'","'
										      .$this->qty.'","'
										      .$this->tarif.'","'
										      .$this->data.'","'
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->summa.'","'
										      .$this->chekInput.'","'
										      .$this->chekVoda.'","'
										      .$this->checkType.'","'
										      .$this->info.'",'
										      .'@success,@msg)';
			break;
	case "addLgotaPtn":
			    $this->sql='CALL YISGRAND.addLgotaPtn('.$this->lgotnik_id.','.$this->lgota_id.','.$this->house_id.','.$this->address_id.',"'.$this->address.'","'.$this->fio.'","'.$this->lgota.'","'.$this->percent.'","'.$this->inn.'","'.$this->people.'","'.$this->category.'","'.$this->pok_id.'","'.$this->gr.'","'.$this->qty.'","'.$this->tarif.'","'.$this->data.'","'.$this->sdata.'","'.$this->fdata.'","'.$this->summa.'","'.$this->chekInput.'","'.$this->checkType.'","'.$this->info.'",@success,@msg)';

			break;
	case "addLgotaOtoplenie":
			      $this->sql='CALL YISGRAND.addLgotaOtoplenie('
										      .$this->lgotnik_id.','
										      .$this->lgota_id.','
										      .$this->house_id.','
										      .$this->address_id.',"'
										      .$this->address.'","'
										      .$this->fio.'","'
										      .$this->lgota.'","'
										      .$this->percent.'","'
										      .$this->inn.'","'
										      .$this->people.'","'
										      .$this->category.'","'
										      .$this->pok_id.'","'
										      .$this->gr.'","'
										      .$this->m2.'","'
										      .$this->gkm2.'","'
										      .$this->gkal.'","'
										      .$this->qty.'","'
										      .$this->tarif.'","'
										      .$this->data.'","'
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->summa.'","'
										      .$this->chekInput.'","'
										      .$this->checkType.'","'
										      .$this->info.'",'
										      .'@success,@msg)';
//print($this->sql);

			break;
	case "addLgotaKvartplata":
			      $this->sql='CALL YISGRAND.addLgotaKvartplata('
										      .$this->lgotnik_id.','
										      .$this->lgota_id.','
										      .$this->house_id.','
										      .$this->address_id.',"'
													.$this->address.'","'
										      .$this->fio.'","'
													.$this->lgota.'","'
													.$this->percent.'","'
										      .$this->inn.'","'
										      .$this->people.'","'
										      .$this->category.'","'
										      .$this->pok_id.'","'
										      .$this->gr.'","'
										      .$this->qty.'","'
										      .$this->tarif.'","'
										      .$this->data.'","'
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->summa.'","'
										      .$this->chekInput.'","'
										      .$this->checkType.'","'
										      .$this->info.'",'
										      .'@success,@msg)';
			break;
	case "addLgotaTbo":
			      $this->sql='CALL YISGRAND.addLgotaTbo('
										      .$this->lgotnik_id.','
										      .$this->lgota_id.','
										      .$this->house_id.','
										      .$this->address_id.',"'
													.$this->address.'","'
										      .$this->fio.'","'
													.$this->lgota.'","'
													.$this->percent.'","'
										      .$this->inn.'","'
										      .$this->people.'","'
										      .$this->category.'","'
										      .$this->pok_id.'","'
										      .$this->gr.'","'
										      .$this->qty.'","'
										      .$this->tarif.'","'
										      .$this->data.'","'
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->summa.'","'
										      .$this->chekInput.'","'
										      .$this->checkType.'","'
										      .$this->info.'",'
										      .'@success,@msg)';

			break;
	case "addLgotaPererVoda":
			      $this->sql='CALL YISGRAND.addLgotaPererVoda('
										      .$this->lgotnik_id.','
										      .$this->lgota_id.','
										      .$this->house_id.','
										      .$this->address_id.',"'													.$this->address.'","'
										      .$this->fio.'","'													.$this->lgota.'","'													.$this->percent.'","'
										      .$this->inn.'","'
										      .$this->people.'","'
										      .$this->category.'","'
										      .$this->pok_id.'","'
										      .$this->gr.'","'
										      .$this->qty.'","'
										      .$this->tarif.'","'
										      .$this->data.'","'
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->summa.'","'
										      .$this->info.'",'
										      .'@success,@msg)';
			break;
	case "addLgotaPererStoki":
			      $this->sql='CALL YISGRAND.addLgotaPererStoki('
										      .$this->lgotnik_id.','
										      .$this->lgota_id.','
										      .$this->house_id.','
										      .$this->address_id.',"'
										      .$this->address.'","'
										      .$this->fio.'","'
										      .$this->lgota.'","'
										      .$this->percent.'","'
										      .$this->inn.'","'
										      .$this->people.'","'
										      .$this->category.'","'
										      .$this->pok_id.'","'
										      .$this->gr.'","'
										      .$this->qty.'","'
										      .$this->tarif.'","'
										      .$this->data.'","'
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->summa.'","'
										      .$this->info.'",'
										      .'@success,@msg)';
			break;
	case "addLgotaPererPtn":
			       $this->sql='CALL YISGRAND.addLgotaPererPtn('.$this->lgotnik_id.','.$this->lgota_id.','.$this->house_id.','.$this->address_id.',"'.$this->address.'","'.$this->fio.'","'.$this->lgota.'","'.$this->percent.'","'.$this->inn.'","'.$this->people.'","'.$this->category.'","'.$this->pok_id.'","'.$this->gr.'","'.$this->qty.'","'.$this->tarif.'","'.$this->data.'","'.$this->sdata.'","'.$this->fdata.'","'.$this->summa.'","'.$this->info.'",@success,@msg)';
			       			//  print_r($this->sql); 

			       break;
	case "addLgotaPererOtoplenie":
			      $this->sql='CALL YISGRAND.addLgotaPererOtoplenie('
										      .$this->lgotnik_id.','
										      .$this->lgota_id.','
										      .$this->house_id.','
										      .$this->address_id.',"'
										      .$this->address.'","'
										      .$this->fio.'","'
										      .$this->lgota.'","'
										      .$this->percent.'","'
										      .$this->inn.'","'
										      .$this->people.'","'
										      .$this->category.'","'
										      .$this->pok_id.'","'
										      .$this->gr.'","'
										      .$this->m2.'","'
										      .$this->gkm2.'","'
										      .$this->gkal.'","'
										      .$this->qty.'","'
										      .$this->tarif.'","'
										      .$this->data.'","'
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->summa.'","'
										      .$this->chekInput.'","'
										      .$this->checkType.'","'
										      .$this->info.'",'
										      .'@success,@msg)';
			break;
	case "addLgotaPererKvartplata":
			      $this->sql='CALL YISGRAND.addLgotaPererKvartplata('
										      .$this->lgotnik_id.','
										      .$this->lgota_id.','
										      .$this->house_id.','
										      .$this->address_id.',"'
													.$this->address.'","'
										      .$this->fio.'","'
													.$this->lgota.'","'
													.$this->percent.'","'
										      .$this->inn.'","'
										      .$this->people.'","'
										      .$this->category.'","'
										      .$this->pok_id.'","'
										      .$this->gr.'","'
										      .$this->qty.'","'
										      .$this->tarif.'","'
										      .$this->data.'","'
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->summa.'","'
										      .$this->info.'",'
										      .'@success,@msg)';
			break;
	case "addLgotaPererTbo":
			      $this->sql='CALL YISGRAND.addLgotaPererTbo('
										      .$this->lgotnik_id.','
										      .$this->lgota_id.','
										      .$this->house_id.','
										      .$this->address_id.',"'
													.$this->address.'","'
										      .$this->fio.'","'
													.$this->lgota.'","'
													.$this->percent.'","'
										      .$this->inn.'","'
										      .$this->people.'","'
										      .$this->category.'","'
										      .$this->pok_id.'","'
										      .$this->gr.'","'
										      .$this->qty.'","'
										      .$this->tarif.'","'
										      .$this->data.'","'
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->summa.'","'
										      .$this->info.'",'
										      .'@success,@msg)';

			break;
	case "editLgotaVoda":
			      $this->sql='CALL YISGRAND.editLgotaVoda('
										      .$this->rec_id.','
										      .$this->address_id.',"'
										      .$this->qty.'","'
										      .$this->tarif.'","'
										      .$this->data.'","'
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->summa.'","'
										      .$this->info.'",'
										      .'@success,@msg)';
			break;
	case "editLgotaStoki":
			      $this->sql='CALL YISGRAND.editLgotaStoki('
										      .$this->rec_id.','
										      .$this->address_id.',"'
										      .$this->qty.'","'
										      .$this->tarif.'","'
										      .$this->data.'","'
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->summa.'","'
										      .$this->info.'",'
										      .'@success,@msg)';
			  // print_r($this->sql); 

			break;

	case "editLgotaPtn":
										      $this->sql='CALL YISGRAND.editLgotaPtn('.$this->rec_id.','.$this->address_id.',"'.$this->qty.'","'.$this->tarif.'","'.$this->data.'","'.$this->sdata.'","'.$this->fdata.'","'.$this->summa.'","'.$this->info.'",@success,@msg)';

			break;
	case "editLgotaOtoplenie":
			      $this->sql='CALL YISGRAND.editLgotaOtoplenie('
										      .$this->rec_id.','
										      .$this->address_id.',"'
										      .$this->m2.'","'
										      .$this->gkm2.'","'
										      .$this->gkal.'","'
										      .$this->qty.'","'
										      .$this->tarif.'","'
										      .$this->data.'","'
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->summa.'","'
										      .$this->info.'",'
										      .'@success,@msg)';
										      			//   print_r($this->sql); 

			break;
	case "editLgotaKvartplata":
			      $this->sql='CALL YISGRAND.editLgotaKvartplata('
										      .$this->rec_id.','
										      .$this->address_id.',"'
										      .$this->people.'","'
										      .$this->qty.'","'
										      .$this->tarif.'","'
										      .$this->data.'","'
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->summa.'","'
										      .$this->info.'",'
										      .'@success,@msg)';
			break;
	case "editLgotaTbo":
			      $this->sql='CALL YISGRAND.editLgotaTbo('
										      .$this->rec_id.','
										      .$this->address_id.',"'
										      .$this->qty.'","'
										      .$this->tarif.'","'
										      .$this->data.'","'
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->summa.'","'
										      .$this->info.'",'
										      .'@success,@msg)';

			break;
		case "addLgotnik":
			      $this->sql='CALL YISGRAND.addLgotnik("'
										      .$this->lgota_id.'","'
										      .$this->address_id.'","'
										      .$this->address.'","'
										      .$this->surname.'","'
										      .$this->firstname.'","'
										      .$this->lastname.'","'
										      .$this->surname_ua.'","'
										      .$this->firstname_ua.'","'
										      .$this->lastname_ua.'","'
										      .$this->kartochka.'","'
										      .$this->inn.'","'
										      .$this->passport.'","'
										      .$this->document.'","'
										      .$this->data.'","'
										      .$this->start.'","'
										      .$this->finish.'","'
										      .$this->given.'","'
										      .$this->people.'","'
													.$this->percent.'","'
										      .$this->vkl.'",'
										      .'@success,@msg)';
			break;
			case "editCitizen":
			      $this->sql='CALL YISGRAND.editCitizen("'
										      .$this->rec_id.'","'
										      .$this->address_id.'","'
										      .$this->surname.'","'
										      .$this->firstname.'","'
										      .$this->lastname.'","'
										      .$this->born.'","'
										      .$this->datap.'","'
										      .$this->inn.'","'
										      .$this->subsidia.'","'
										      .$this->document.'","'
										      .$this->datapasp.'","'
										      .$this->seria.'","'
										      .$this->nomer.'","'
										      .$this->organ.'","'
										      .$this->rodstvo.'","'
										      .$this->vkl.'","'
										      .$this->absent.'",'
										      .'@success,@msg)';
										      			 //  print_r($this->sql); 

			break;
			case "addCitizen":
			      $this->sql='CALL YISGRAND.addCitizen("'
										      .$this->address_id.'","'
										      .$this->surname.'","'
										      .$this->firstname.'","'
										      .$this->lastname.'","'
										      .$this->born.'","'					      										      .$this->datap.'","'
										      .$this->inn.'","'
										      .$this->subsidia.'","'
										      .$this->document.'","'
										      .$this->datapasp.'","'
										      .$this->seria.'","'
										      .$this->nomer.'","'
										      .$this->organ.'","'					      										      .$this->rodstvo.'","'
										      .$this->vkl.'","'
										      .$this->absent.'",'
										      .'@success,@msg)';
										      			 //  print_r($this->sql); 

			break;
			case "addDogovorVik":
			      $this->sql='CALL YISGRAND.addDogovorVik("'
										      .$this->address_id.'","'
										      .$this->address.'","'
										      .$this->nanim.'","'
										      .$this->nomer.'","'
										      .$this->inn.'","'
										      .$this->passport.'","'
										      .$this->start.'","'
										      .$this->finish.'","'
										      .$this->vidan.'","'
										      .$this->viddata.'",'
										      .'@success,@msg)';
			break;
			case "editDogovorVik":
			      $this->sql='CALL YISGRAND.editDogovorVik("'
										      .$this->rec_id.'","'
										      .$this->address.'","'
										      .$this->nanim.'","'
										      .$this->nomer.'","'
										      .$this->inn.'","'
										      .$this->passport.'","'
										      .$this->start.'","'
										      .$this->finish.'","'
										      .$this->vidan.'","'
										      .$this->viddata.'",'
										      .'@success,@msg)';
			break;
			case "addDogRestrVik":
			      $this->sql='CALL YISGRAND.addDogRestrVik("'
										      .$this->address_id.'","'
										      .$this->address.'","'
										      .$this->nanim.'","'
										      .$this->phone.'","'
										      .$this->nomer.'","'
										      .$this->inn.'","'
										      .$this->passport.'","'
										      .$this->start.'","'
										      .$this->finish.'","'
										      .$this->dolg.'","'
										      .$this->oplata.'","'
										      .$this->vidan.'","'
										      .$this->viddata.'","'
										      .$this->vkl.'",'
										      .'@success,@msg)';
			break;
			case "editDogRestrVik":
			      $this->sql='CALL YISGRAND.editDogRestrVik("'	      .$this->address_id.'","'
										      .$this->dog_id.'","'
										      .$this->address.'","'
										      .$this->nanim.'","'
										      .$this->phone.'","'
										      .$this->nomer.'","'
										      .$this->inn.'","'
										      .$this->passport.'","'
										      .$this->start.'","'
										      .$this->finish.'","'
										      .$this->dolg.'","'
										      .$this->oplata.'","'
										      .$this->vidan.'","'
										      .$this->viddata.'","'
										      .$this->vkl.'",'
										      .'@success,@msg)';
			break;
			case "addDogovorYtke":
			      $this->sql='CALL YISGRAND.addDogovorYtke("'
										      .$this->address_id.'","'
										      .$this->address.'","'
										      .$this->nanim.'","'
										      .$this->nomer.'","'
										      .$this->inn.'","'
										      .$this->passport.'","'
										      .$this->start.'","'
										      .$this->finish.'","'
										      .$this->vidan.'","'
										      .$this->viddata.'","'
										      .$this->kredit.'",'
										      .'@success,@msg)';
			break;
			case "editDogovorYtke":
			      $this->sql='CALL YISGRAND.editDogovorYtke("'
										      .$this->rec_id.'","'
										      .$this->address_id.'","'
										      .$this->address.'","'
										      .$this->nanim.'","'
										      .$this->nomer.'","'
										      .$this->inn.'","'
										      .$this->passport.'","'
										      .$this->start.'","'
										      .$this->finish.'","'
										      .$this->vidan.'","'
										      .$this->viddata.'","'
										      .$this->kredit.'",'
										      .'@success,@msg)';
 //print_r($this->sql); 

			break;
			case "editLgotnik":
			      $this->sql='CALL YISGRAND.editLgotnik("'
										      .$this->lgotnik_id.'","'
										      .$this->lgota_id.'","'
										      .$this->surname.'","'
										      .$this->firstname.'","'
										      .$this->lastname.'","'
										      .$this->surname_ua.'","'
										      .$this->firstname_ua.'","'
										      .$this->lastname_ua.'","'
										      .$this->kartochka.'","'
										      .$this->inn.'","'
										      .$this->passport.'","'
										      .$this->document.'","'
										      .$this->data.'","'
										      .$this->start.'","'
										      .$this->finish.'","'
										      .$this->given.'","'
										      .$this->people.'","'
										      .$this->percent.'","'
										      .$this->vkl.'",'
										      .'@success,@msg)';
										      			  // print_r($this->sql); 

			break;
		case "editOplataApp":
		  $this->sql='CALL YISGRAND.editOplataApp('
		  .$this->rec_id.','
		  .$this->address_id.',"'
		  .$this->kvartplata.'","'
		  .$this->remont.'","'
		  .$this->otoplenie.'","'
		  .$this->ptn.'","'
		  .$this->podogrev.'","'
		  .$this->voda.'","'.
		  $this->stoki.'","'
		  .$this->tbo.'","'
		  .$this->summa.'","'
		  .$this->god.'","'
		  .$this->prixod.'","'
		  .$this->kassa.'","'
		  .$this->data.'","'
		  .$this->pr.'","'
		  .$this->nomer.'","'
		  .$this->data_in.'",@success,@msg)';
		//	print($this->sql);
			break;
			case "editOplataOrg":
			      $this->sql='CALL YISGRAND.editOplataOrg('
										      .$this->rec_id.','
										      .$this->filial_id.','
										      .$this->otoplenie.',"'
										      .$this->podogrev.'",'
										      .$this->voda.','
										      .$this->stoki.','
										      .$this->summa.','
										      .$this->god.',"'
										      .$this->prixod.'","'
										      .$this->kassa.'","'
										      .$this->data.'","'
										      .$this->nomer.'","'
										      .$this->data_in.'",'
										      .'@success,@msg)';
//print($this->sql);
			break;
			case "delLgotaVodaPerer":
			      $this->sql='CALL YISGRAND.delLgotaVodaPerer('.$this->rec_id.',@success,@msg)';
			break;
			case "delDogovor":
			      $this->sql='CALL YISGRAND.delDogovor('.$this->org_id.','.$this->rec_id.',@success,@msg)';
			break;
   			case "delLgotaStokiPerer":
			      $this->sql='CALL YISGRAND.delLgotaStokiPerer('.$this->rec_id.',@success,@msg)';
			break;
			case "delLgotaPtnPerer":
			      $this->sql='CALL YISGRAND.delLgotaPtnPerer('.$this->rec_id.',@success,@msg)';
			break;
			case "delLgotaOtopleniePerer":
			      $this->sql='CALL YISGRAND.delLgotaOtopleniePerer('.$this->rec_id.',@success,@msg)';
			break;
   			case "delLgotaKvartplataPerer":
			      $this->sql='CALL YISGRAND.delLgotaKvartplataPerer('.$this->rec_id.',@success,@msg)';
			break;
			case "delLgotaTboPerer":
			      $this->sql='CALL YISGRAND.delLgotaTboPerer('.$this->rec_id.',@success,@msg)';
			break;
			case "delLgotaVoda":
			      $this->sql='CALL YISGRAND.delLgotaVoda('.$this->rec_id.',@success,@msg)';
			break;
   			case "delLgotaStoki":
			      $this->sql='CALL YISGRAND.delLgotaStoki('.$this->rec_id.',@success,@msg)';
			break;
			case "delLgotaPtn":
			      $this->sql='CALL YISGRAND.delLgotaPtn('.$this->rec_id.',@success,@msg)';
			break;
			case "delLgotaOtoplenie":
			      $this->sql='CALL YISGRAND.delLgotaOtoplenie('.$this->rec_id.',@success,@msg)';
			break;
   			case "delLgotaKvartplata":
			      $this->sql='CALL YISGRAND.delLgotaKvartplata('.$this->rec_id.',@success,@msg)';
			break;
			case "delLgotaTbo":
			      $this->sql='CALL YISGRAND.delLgotaTbo('.$this->rec_id.',@success,@msg)';
			break;
			case "delLgotaUtszn":
			      $this->sql='CALL YISGRAND.delLgotaUtszn_org('.$this->usluga_id.','.$this->rec_id.',@success,@msg)';
			break;	
			case "delSubsidiaUtszn":
			      $this->sql='CALL YISGRAND.delSubsidiaUtszn_org('.$this->usluga_id.','.$this->rec_id.',@success,@msg)';
			break;	
			case "editDbfLgota":
			      $this->sql='CALL YISGRAND.editDbfLgotaOrg('.$this->rec_id.','.$this->org_id.',"'.$this->lgotnik_id.'","'.$this->data.'","'.$this->monthin.'","'.$this->yearin.'","'.$this->data1.'","'.$this->data2.'","'.$this->lgcode.'","'.$this->flag.'","'.$this->summ.'","'.$this->voda.'","'.$this->stoki.'","'.$this->fact.'","'.$this->tarif.'",@success,@msg)';
//print($this->sql);
			break;
			case "delDbfLgota":
			      $this->sql='CALL YISGRAND.delDbfLgotaOrg('.$this->rec_id.','.$this->org_id.',@success,@msg)';
			   //  print($this->sql);

			break;
			case "addDbfLgota":
			      $this->sql='CALL YISGRAND.addDbfLgotaOrg('.$this->org_id.',"'.$this->cdpr.'","'.$this->lgotnik_id.'","'.$this->data.'","'.$this->monthin.'","'.$this->yearin.'","'.$this->data1.'","'.$this->data2.'","'.$this->lgcode.'","'.$this->flag.'","'.$this->summ.'","'.$this->fact.'","'.$this->tarif.'",@success,@msg)';
//print($this->sql);
			break;
		case "clear_pr_voda_stoki":
			      $this->sql='UPDATE YIS.VODA SET YIS.VODA.`pr` = 0 WHERE YIS.VODA.`data` = CONCAT(EXTRACT(YEAR_MONTH FROM CURDATE()),"01")';
						$this->results['res'] = 1;	
		break;
	case "vvod_tarif_voda_stoki":
	$this->sql='UPDATE YIS.TARIF_VODA as t1  SET t1.'.$this->name_tar.' = "'.$this->new_tar.'"  WHERE t1.`house_id` = "'.$this->house_id.'"  AND t1.`data` = CONCAT(EXTRACT(YEAR_MONTH FROM "'.$this->data.'"),"01") ';
		$this->results['res'] = 1;	
		break;
		case "PrintAktUtsznAll":
		
		$this->sql='INSERT INTO YISGRAND.TMP_TABLE SET YISGRAND.TMP_TABLE.`rec_id` = '.$this->rec_id.',YISGRAND.TMP_TABLE.`org_id` = '.$this->usluga_id.'';
		$this->results['res'] = 1;	
		break;
		
		case "PrintAktSubsidiaAll":
		
		$this->sql='INSERT INTO YISGRAND.TMP_TABLE SET YISGRAND.TMP_TABLE.`rec_id` = '.$this->address_id.'';
		$this->results['res'] = 1;	
		break;
		case "ReestrSubsidiaUtsznAll":
		$this->sql='INSERT INTO YISGRAND.TMP_TABLE SET YISGRAND.TMP_TABLE.`rec_id` = '.$this->rec_id.',YISGRAND.TMP_TABLE.`org_id` = '.$this->usluga_id.'';
		$this->results['res'] = 1;	
		break;
		case "ReestrLgotaUtsznAll":
		$this->sql='INSERT INTO YISGRAND.TMP_TABLE SET YISGRAND.TMP_TABLE.`rec_id` = '.$this->rec_id.',YISGRAND.TMP_TABLE.`org_id` = '.$this->usluga_id.'';
		$this->results['res'] = 1;	
		break;
		case "nachislenie_voda":
			       $this->sql='CALL YISGRAND.nachislenie_voda(@success,@msg)';				    
			break;
			case "FixDolgKvartplataOsmd":
			       $this->sql='CALL YISGRAND.FixDolgKvartplataOsmd("'.$this->house_id.'",@success,@msg)';				    
			break;
			case "update_kubov_norma":
			       $this->sql='CALL YISGRAND.update_kubov_norma("'.$this->data.'",@success,@msg)';				    
			break;
	  case "nachislenie_voda_house":
			      $this->sql='CALL YISGRAND.nachislenie_voda_house("'.$this->house_id.'",@success,@msg)';
			   // print_r($this->sql); 
		break;
		case "chekOrgImport":
			      $this->sql='CALL YISGRAND.chekOrgImport(@success,@msg)';
			  break;
		 case "addOplataAllOrg":			
			      $this->sql='CALL YISGRAND.addOplataAllOrg('.$this->rec_id.', @success,@msg)';
			 // print($this->sql);
			break;
		 case "addOplataOrg":
			$this->sql='CALL YISGRAND.addOplataOrg('.$this->rec_id.',"'.$this->edrpou.'","'.$this->mfo.'","'.$this->pr.'","'.$this->data.'","'.$this->nomer.'",'
						.''.$this->iorg_id.','.$this->org_id.','.$this->filial_id.','.$this->ins.',"'.$this->rs.'","'.$this->summa.'","'.$this->note.'",@success,@msg)';
						//print($this->sql);
			break;
			case "exportOshadBankLgota"://применяется
				  switch ($this->usluga_id) {
					case 1://применяется
					      $this->sql='CALL YISGRAND.lgota_export_kvartplata("'.$this->data.'",@success,@msg)';
				  	break;
				  	case 2://применяется
					      $this->sql='CALL YISGRAND.lgota_export_teplo("'.$this->data.'",@success,@msg)';
				  	break;
				  	case 3://применяется
					      $this->sql='CALL YISGRAND.lgota_export_voda("'.$this->data.'",@success,@msg)';
				  	break;
				  	case 4://применяется
					      $this->sql='CALL YISGRAND.lgota_export_stoki("'.$this->data.'",@success,@msg)';
				  	break;
				  	case 5://применяется
					      $this->sql='CALL YISGRAND.lgota_export_tbo("'.$this->data.'",@success,@msg)';
				  	break;
				  	case 7://применяется
					      $this->sql='CALL YISGRAND.lgota_export_teplo("'.$this->data.'",@success,@msg)';
				  	break;
				}	
			break;	
		case "exportOshadBank"://применяется
				  switch ($this->usluga_id) {
					case 1://применяется
					      $this->sql='CALL YISGRAND.subsidia_export_kvartplata("'.$this->data.'",@success,@msg)';
				  	break;
				  	case 2://применяется
					      $this->sql='CALL YISGRAND.subsidia_export_teplo("'.$this->data.'",@success,@msg)';
				  	break;
				  	case 3://применяется
					      $this->sql='CALL YISGRAND.subsidia_export_voda("'.$this->data.'",@success,@msg)';
				  	break;
				  	case 4://применяется
					      $this->sql='CALL YISGRAND.subsidia_export_stoki("'.$this->data.'",@success,@msg)';
				  	break;
				  	case 5://применяется
					      $this->sql='CALL YISGRAND.subsidia_export_tbo("'.$this->data.'",@success,@msg)';
				  	break;
				  	case 7://применяется
					      $this->sql='CALL YISGRAND.subsidia_export_teplo("'.$this->data.'",@success,@msg)';
				  	break;
				}	
			break;	
		case "update_oplata_utszn"://применяется
					      $this->sql='CALL YISGRAND.update_oplata_utszn("'.$this->lgota.'","'.$this->org_id.'","'.$this->data.'",@success,@msg)';
					
			break;
		case "dolg_utszn"://применяется
					      $this->sql='CALL YISGRAND.dolg_utszn(@new_id,@new_name,@success,@msg)';
					
			break;	
		case "importOshadBankLgota"://применяется
				  switch ($this->usluga_id) {
					case 1://применяется
					      $this->sql='CALL YISGRAND.lgota_import_kvartplata("'.$this->data.'",@success,@msg)';
				  	break;
				  	case 2://применяется
					      $this->sql='CALL YISGRAND.lgota_import_teplo("'.$this->data.'",@success,@msg)';
				  	break;
				  	case 3://применяется
					      $this->sql='CALL YISGRAND.lgota_import_voda("'.$this->data.'",@success,@msg)';
				  	break;
				  	case 4://применяется
					      $this->sql='CALL YISGRAND.lgota_import_stoki("'.$this->data.'",@success,@msg)';
				  	break;
				  	case 5://применяется
					      $this->sql='CALL YISGRAND.lgota_import_tbo("'.$this->data.'",@success,@msg)';
				  	break;
				  	case 7://применяется
					      $this->sql='CALL YISGRAND.lgota_import_teplo("'.$this->data.'",@success,@msg)';
				  	break;
				}	
			break;			
		case "importOshadBank"://применяется
				  switch ($this->usluga_id) {
					case 1://применяется
					      $this->sql='CALL YISGRAND.subsidia_import_kvartplata("'.$this->data.'",@success,@msg)';
				  	break;
				  	case 2://применяется
					      $this->sql='CALL YISGRAND.subsidia_import_teplo("'.$this->data.'",@success,@msg)';
				  	break;
				  	case 3://применяется
					      $this->sql='CALL YISGRAND.subsidia_import_voda("'.$this->data.'",@success,@msg)';
				  	break;
				  	case 4://применяется
					      $this->sql='CALL YISGRAND.subsidia_import_stoki("'.$this->data.'",@success,@msg)';
				  	break;
				  	case 5://применяется
					      $this->sql='CALL YISGRAND.subsidia_import_tbo("'.$this->data.'",@success,@msg)';
				  	break;
				  	case 7://применяется
					      $this->sql='CALL YISGRAND.subsidia_import_teplo("'.$this->data.'",@success,@msg)';
				  	break;
				}	
			break;				
		case "input_lgota_oshadbank"://применяется
				  switch ($this->usluga_id) {
				  	case 1://применяется
					      $this->sql='CALL YISGRAND.lgota_oplata_kvartplata("'.$this->data.'",@success,@msg)';
				  	break;
				  	case 2://применяется
					      $this->sql='CALL YISGRAND.lgota_oplata_teplo("'.$this->data.'",@success,@msg)';
				  	break;
				  	case 3://применяется
					      $this->sql='CALL YISGRAND.lgota_oplata_voda("'.$this->data.'",@success,@msg)';
				  	break;
				  	case 4://применяется
					      $this->sql='CALL YISGRAND.lgota_oplata_stoki("'.$this->data.'",@success,@msg)';
				  	break;
				  	case 5://применяется
					      $this->sql='CALL YISGRAND.lgota_oplata_tbo("'.$this->data.'",@success,@msg)';
				  	break;
				  	case 7://применяется
					      $this->sql='CALL YISGRAND.lgota_oplata_teplo("'.$this->data.'",@success,@msg)';
				  	break;
				}	
			break;		      						
		case "input_subsidia_oshadbank"://применяется
				  switch ($this->usluga_id) {
				  	case 1://применяется
					      $this->sql='CALL YISGRAND.subsidia_oplata_kvartplata("'.$this->data.'",@success,@msg)';
				  	break;
				  	case 2://применяется
					      $this->sql='CALL YISGRAND.subsidia_oplata_teplo("'.$this->data.'",@success,@msg)';
				  	break;
				  	case 3://применяется
					      $this->sql='CALL YISGRAND.subsidia_oplata_voda("'.$this->data.'",@success,@msg)';
				  	break;
				  	case 4://применяется
					      $this->sql='CALL YISGRAND.subsidia_oplata_stoki("'.$this->data.'",@success,@msg)';
				  	break;
				  	case 5://применяется
					      $this->sql='CALL YISGRAND.subsidia_oplata_tbo("'.$this->data.'",@success,@msg)';
				  	break;
				  	case 7://применяется
					      $this->sql='CALL YISGRAND.subsidia_oplata_teplo("'.$this->data.'",@success,@msg)';
				  	break;
				}	
			break;	
		case "input_subsidia":
			      $this->sql='CALL YISGRAND.input_subsid("'.$this->data.'",@success,@msg)';
			      // print($this->sql);
			      break;
		case "otkat_oplata_lgota_oshad"://применяется
				  switch ($this->usluga_id) {
					case 1://применяется
					      $this->sql='CALL YISGRAND.lgota_oplata_otkat_kvartplata("'.$this->data.'",@success,@msg)';
				  	break;
				  	case 2://применяется
					      $this->sql='CALL YISGRAND.lgota_oplata_otkat_teplo("'.$this->data.'",@success,@msg)';
				  	break;
				  	case 3://применяется
					      $this->sql='CALL YISGRAND.lgota_oplata_otkat_voda("'.$this->data.'",@success,@msg)';
				  	break;
				  	case 4://применяется
					      $this->sql='CALL YISGRAND.lgota_oplata_otkat_stoki("'.$this->data.'",@success,@msg)';
				  	break;
				  	case 5://применяется
					      $this->sql='CALL YISGRAND.lgota_oplata_otkat_tbo("'.$this->data.'",@success,@msg)';
				  	break;
				  	case 7://применяется
					      $this->sql='CALL YISGRAND.lgota_oplata_otkat_teplo("'.$this->data.'",@success,@msg)';
				  	break;
				}	
			break;		      							
		case "otkat_oplata_subsidia_oshad"://применяется
				  switch ($this->usluga_id) {
					case 1://применяется
					      $this->sql='CALL YISGRAND.subsidia_oplata_otkat_kvartplata("'.$this->data.'",@success,@msg)';
				  	break;
				  	case 2://применяется
					      $this->sql='CALL YISGRAND.subsidia_oplata_otkat_teplo("'.$this->data.'",@success,@msg)';
				  	break;
				  	case 3://применяется
					      $this->sql='CALL YISGRAND.subsidia_oplata_otkat_voda("'.$this->data.'",@success,@msg)';
				  	break;
				  	case 4://применяется
					      $this->sql='CALL YISGRAND.subsidia_oplata_otkat_stoki("'.$this->data.'",@success,@msg)';
				  	break;
				  	case 5://применяется
					      $this->sql='CALL YISGRAND.subsidia_oplata_otkat_tbo("'.$this->data.'",@success,@msg)';
				  	break;
				  	case 7://применяется
					      $this->sql='CALL YISGRAND.subsidia_oplata_otkat_teplo("'.$this->data.'",@success,@msg)';
				  	break;
				}	
			break;	
		case "otkat_oplata_subsidia":
			      $this->sql='CALL YISGRAND.otkat_oplata_subsidia("'.$this->data.'",@success,@msg)';
			break;
		case "update_fio_subsidia":
			      $this->sql='CALL YISGRAND.update_fio_subsidia("'.$this->data.'",@success,@msg)';
			  break;
		case "vipiskaSchetovVik":
			      $this->sql='CALL YISGRAND.vipiskaSchetovVik("'.$this->data.'",@success,@msg)';
			  break;
		case "updateSchetaVik":
			      $this->sql='CALL YISGRAND.updateSchetaVik("'.$this->data.'",@success,@msg)';
			      			      			 //  print_r($this->sql); 

			  break;
		case "input_port":
			      $this->sql='CALL YISGRAND.input_port("'.$this->data.'",@success,@msg)';
			break;
	
		 case "update_lgota_from_utszn":
			      $this->sql='CALL YISGRAND.update_lgota_from_utszn(@success,@msg)';
			      			 // print_r($this->sql); 
			      			 break;
		case "insert_lgota_from_utszn":
			      $this->sql='CALL YISGRAND.insert_lgota_from_utszn(@success,@msg)';
			      			 // print_r($this->sql); 
			      			 break;
		case "update_utszn_subsidia":
		  switch ($this->usluga_id) {
				
				case "2":
				    $this->sql='CALL YISGRAND.update_utszn_subsidia_ot("'.$this->data.'",@success,@msg)';

				break;
				case "3":
				    $this->sql='CALL YISGRAND.update_utszn_subsidia_xv("'.$this->data.'",@success,@msg)';

				break;
				case "4":
				    $this->sql='CALL YISGRAND.update_utszn_subsidia_st("'.$this->data.'",@success,@msg)';

				break;
				case "5":
				    $this->sql='CALL YISGRAND.update_utszn_subsidia_tbo("'.$this->data.'",@success,@msg)';

				break;
				case "7":
				    $this->sql='CALL YISGRAND.update_utszn_subsidia_ptn("'.$this->data.'",@success,@msg)';

				break;
				}		    
			      			 //print_r($this->sql); 
			      break;
		case "update_utszn_lgota":
		  switch ($this->usluga_id) {				
				case "2":
				    $this->sql='CALL YISGRAND.update_utszn_lgota_ot("'.$this->data.'",@success,@msg)';

				break;
				case "3":
				    $this->sql='CALL YISGRAND.update_utszn_lgota_xv("'.$this->data.'",@success,@msg)';

				break;
				case "4":
				    $this->sql='CALL YISGRAND.update_utszn_lgota_st("'.$this->data.'",@success,@msg)';

				break;
				case "5":
				    $this->sql='CALL YISGRAND.update_utszn_lgota_tbo("'.$this->data.'",@success,@msg)';

				break;
				case "7":
				    $this->sql='CALL YISGRAND.update_utszn_lgota_ptn("'.$this->data.'",@success,@msg)';

				break;
				}		    
			      break;
		 case "insOplatalgotaUtszn":
		  switch ($this->usluga_id) {	
				
				case "2":
				$this->sql='CALL YISGRAND.insOplatalgotaUtszn_ot("'.$this->data.'","'.$this->oplata.'","'.$this->pr.'",@success,@msg)';
  // print_r($this->sql);

				break;
				case "3":
				$this->sql='CALL YISGRAND.insOplatalgotaUtszn_xv("'.$this->data.'","'.$this->oplata.'","'.$this->pr.'",@success,@msg)';
   //print_r($this->sql);

				break;
				case "4":
				$this->sql='CALL YISGRAND.insOplatalgotaUtszn_st("'.$this->data.'","'.$this->oplata.'","'.$this->pr.'",@success,@msg)';
  // print_r($this->sql);

				break;
				case "5":
				$this->sql='CALL YISGRAND.insOplatalgotaUtszn_tbo("'.$this->data.'","'.$this->oplata.'","'.$this->pr.'",@success,@msg)';
  // print_r($this->sql);
				break;
				case "7":
				$this->sql='CALL YISGRAND.insOplatalgotaUtszn_ptn("'.$this->data.'","'.$this->oplata.'","'.$this->pr.'",@success,@msg)';
  // print_r($this->sql);
				break;
				}		    
			      break;
		  case "insOplataSubsidiaUtszn":
		  switch ($this->usluga_id) {	
				
				case "2":
				$this->sql='CALL YISGRAND.insOplataSubsidiaUtszn_ot("'.$this->data.'","'.$this->oplata.'","'.$this->pr.'",@success,@msg)';
   // print_r($this->sql);
				break;
				case "3":
				$this->sql='CALL YISGRAND.insOplataSubsidiaUtszn_xv("'.$this->data.'","'.$this->oplata.'","'.$this->pr.'",@success,@msg)';
  // print_r($this->sql);
				break;
				case "4":
				$this->sql='CALL YISGRAND.insOplataSubsidiaUtszn_st("'.$this->data.'","'.$this->oplata.'","'.$this->pr.'",@success,@msg)';
  // print_r($this->sql);
				break;
				case "5":
				$this->sql='CALL YISGRAND.insOplataSubsidiaUtszn_tbo("'.$this->data.'","'.$this->oplata.'","'.$this->pr.'",@success,@msg)';
  // print_r($this->sql);
				break;
				case "7":
				$this->sql='CALL YISGRAND.insOplataSubsidiaUtszn_ptn("'.$this->data.'","'.$this->oplata.'","'.$this->pr.'",@success,@msg)';
  // print_r($this->sql);
				break;
			
				}		    
			      break;
		case "editSubsidiaUtszn":
			       $this->sql='CALL YISGRAND.editSubsidiaUtszn_org('.$this->usluga_id.','.$this->rec_id.',"'.$this->data.'","'.$this->inn.'","'.$this->st.'","'.$this->zadol.'","'.$this->nachisleno.'","'.$this->perer.'","'.$this->norma.'",'.'"'.$this->oplata.'","'.$this->poplata.'","'.$this->doplata.'","'.$this->dolg.'","'.$this->fin.'",@success,@msg)';
			break;
		case "editLgotaUtszn":
			       $this->sql='CALL YISGRAND.editLgotaUtszn_org('.$this->usluga_id.','.$this->rec_id.',"'.$this->data.'","'.$this->inn.'","'.$this->st.'","'.$this->zadol.'","'.$this->nachisleno.'","'.$this->perer.'","'.$this->norma.'",'.'"'.$this->oplata.'","'.$this->poplata.'","'.$this->doplata.'","'.$this->dolg.'","'.$this->fin.'",@success,@msg)';
			break;	
		
		
	
			case "input_oplata_gerz":
			      $this->sql='CALL YISGRAND.input_oplata_gerz(@success,@msg)';
			break;
			case "control_port":
			      $this->sql='CALL YISGRAND.control_port("'.$this->data.'",@success,@msg)';
			break;
			case "control_subsidia":
			      $this->sql='CALL YISGRAND.control_subsidia("'.$this->data.'",@success,@msg)';
			break;
	case "otkat_oplata_port":
			      $this->sql='CALL YISGRAND.otkat_oplata_port("'.$this->data.'",@success,@msg)';
			break;
			
			case "fixDolgTeplo":
			      $this->sql='CALL YISGRAND.fixDolgTeplo("'.$this->fdata.'",@success,@msg)';
			break;
			
			case "update_vozvrat_subsidia":
		  switch ($this->usluga_id) {
				
				case "2":
				    $this->sql='CALL YISGRAND.update_vozvrat_subsidia_otoplenie("'.$this->sdate.'","'.$this->fdate.'",@success,@msg)';

				break;
				case "3":
				    $this->sql='CALL YISGRAND.update_vozvrat_subsidia_voda("'.$this->sdate.'","'.$this->fdate.'",@success,@msg)';
				break;
				case "4":
				    $this->sql='CALL YISGRAND.update_vozvrat_subsidia_stoki("'.$this->sdate.'","'.$this->fdate.'",@success,@msg)';

				break;
				case "5":
				    $this->sql='CALL YISGRAND.update_vozvrat_subsidia_tbo("'.$this->sdate.'","'.$this->fdate.'",@success,@msg)';

				break;
				case "7":
				    $this->sql='CALL YISGRAND.update_vozvrat_subsidia_ptn("'.$this->sdate.'","'.$this->fdate.'",@success,@msg)';

				break;
				}		    
			      			 //print_r($this->sql); 
			      break;
			
			case "insOplataSubsidiaVozvrat":
		      switch ($this->usluga_id) {
				
				case "2":
				    $this->sql='CALL YISGRAND.VozvratSubsidiaOplata_otoplenie(@success,@msg)';

				break;
				case "3":
				    $this->sql='CALL YISGRAND.VozvratSubsidiaOplata_voda(@success,@msg)';
				break;
				case "4":
				    $this->sql='CALL YISGRAND.VozvratSubsidiaOplata_stoki(@success,@msg)';

				break;
				case "5":
				    $this->sql='CALL YISGRAND.VozvratSubsidiaOplata_tbo(@success,@msg)';

				break;
				case "7":
				    $this->sql='CALL YISGRAND.VozvratSubsidiaOplata_ptn(@success,@msg)';

				break;
				}		    
			      			 //print_r($this->sql); 
			      break;
			case "NachOplataKredit":
			      $this->sql='CALL YISGRAND.NachOplataKredit("'.$this->fdata.'",@success,@msg)';
			break;
			
	   case "addPortovik":
			      $this->sql='CALL YISGRAND.addPortovik("'.$this->data.'",'.$this->address_id.','.$this->tabn.',@success,@msg)';
			   // print_r($this->sql); 

			break;
		
		case "pereraschet_voda_stoki":
			      $this->sql='CALL YISGRAND.pereraschet_voda_stoki("'
										      .$this->house_id.'","'
										      .$this->allkv.'","'
										      .$this->tarif_manual.'","'
										      .$this->address_ot.'","'
										      .$this->address_do.'","'
													.$this->xv9.'","'
										      .$this->ch_xv9.'","'
													.$this->st9.'","'
													.$this->ch_st9.'","'
										      .$this->xv16.'","'
										      .$this->ch_xv16.'","'
										      .$this->st16.'","'
										      .$this->ch_st16.'","'
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->info.'",'
										      .'@success,@msg)';
			  //  print_r($this->sql); 

			break;
		case "vvod_tarif_teplo":
	$this->sql='UPDATE YIS.TARIF_TEPLO as t1  SET t1.'.$this->name_tar.' = '.$this->new_tar.' WHERE t1.`house_id` = '.$this->house_id.' and t1.`data` = CONCAT(EXTRACT(YEAR_MONTH FROM CURDATE()),"01")';
						$this->results['res'] = 1;	
		break;
		case "clear_pr_podogrev":
			      $this->sql='UPDATE YIS.PODOGREV SET YIS.PODOGREV.`pr` = 0 WHERE YIS.PODOGREV.`data` = CONCAT(EXTRACT(YEAR_MONTH FROM CURDATE()),"01")';
						$this->results['res'] = 1;	
		break;
		case "nachislenie_ptn":
			       $this->sql='CALL YISGRAND.nachislenie_ptn(@success,@msg)';				    
			break;
	  case "nachislenie_ptn_house":
			      $this->sql='CALL YISGRAND.nachislenie_ptn_house("'.$this->house_id.'",@success,@msg)';
			  //  print_r($this->sql); 

			break;
		case "pereraschet_podogrev":
			      $this->sql='CALL YISGRAND.pereraschet_podogrev("'
										      .$this->house_id.'","'
										      .$this->allkv.'","'
										      .$this->tarif_manual.'","'
										      .$this->address_ot.'","'
										      .$this->address_do.'","'
													.$this->gv9.'","'
										      .$this->ch_gv9.'","'
											    .$this->gv16.'","'
										      .$this->ch_gv16.'","'
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->info.'",'
										      .'@success,@msg)';
			  // print_r($this->sql); 

			break;
			case "nachislenie_kvartplata":
			       $this->sql='CALL YISGRAND.nachislenie_kvartplata(@success,@msg)';				    
			break;
			case "nachislenie_kvartplata_house":
			      $this->sql='CALL YISGRAND.nachislenie_kvartplata_house("'.$this->house_id.'",@success,@msg)';
			  //  print_r($this->sql); 

			break;
			case "vvod_tarif_kvartplata":
			      $this->sql='UPDATE YIS.TARIF SET YIS.TARIF.'.$this->name_tar.' = '.$this->new_tar.' WHERE YIS.TARIF.`house_id` = '.$this->house_id.'';
						$this->results['res'] = 1;	
		break;
		case "clear_pr_kvartplata":
			      $this->sql='UPDATE YIS.KVARTPLATA SET YIS.KVARTPLATA.`pr` = 0 WHERE YIS.KVARTPLATA.`osmd` = 0 AND YIS.KVARTPLATA.`data` = CONCAT(EXTRACT(YEAR_MONTH FROM CURDATE()),"01")';
						$this->results['res'] = 1;	
		break;

			case "pereraschet_kvartplata":
			      $this->sql='CALL YISGRAND.pereraschet_kvartplata("'
										      .$this->house_id.'","'
										      .$this->allkv.'","'
										      .$this->tarif_manual.'","'
										      .$this->address_ot.'","'
										      .$this->address_do.'","'
													.$this->kv9.'","'
										      .$this->ch_kv9.'","'
													.$this->kv9f1.'","'
													.$this->ch_kv9f1.'","'
										      .$this->kv16.'","'
										      .$this->ch_kv16.'","'
										      .$this->kv16f1.'","'
										      .$this->ch_kv16f1.'","'
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->info.'",'
										      .'@success,@msg)';
			 //  print_r($this->sql); 

			break;
			case "vvod_tarif_tbo":
			      $this->sql='UPDATE YIS.TARIF SET YIS.TARIF.'.$this->name_tar.' = '.$this->new_tar.' WHERE YIS.TARIF.`house_id` = '.$this->house_id.'';
						$this->results['res'] = 1;	
			break;
			case "vvod_osmd_rko":
			$this->sql='INSERT INTO YISGRAND.COMPANY_HOUSES SET  YISGRAND.COMPANY_HOUSES.`house_id` = '.$this->house_id.',YISGRAND.COMPANY_HOUSES.`osmd_id` = '.$this->osmd_id.','
						.'YISGRAND.COMPANY_HOUSES.`org_id` = '.$this->org_id.', YISGRAND.COMPANY_HOUSES.`house` = "'.$this->house.'",'
						.'YISGRAND.COMPANY_HOUSES.`abbr` = "'.$this->abbr.'",YISGRAND.COMPANY_HOUSES.`edrpou` = "'.$this->edrpou.'"';
			$this->results['res'] = 1;
			break;
			case "del_osmd_rko":
			$this->sql='DELETE FROM YISGRAND.COMPANY_HOUSES WHERE  YISGRAND.COMPANY_HOUSES.`house_id` = '.$this->house_id.' and  YISGRAND.COMPANY_HOUSES.`org_id` = '.$this->org_id.'';
			$this->results['res'] = 1;
			break;
			
			case "clear_pr_tbo":
			$this->sql='UPDATE YIS.TBO SET YIS.TBO.`pr` = 0 WHERE YIS.TBO.`data` = CONCAT(EXTRACT(YEAR_MONTH FROM CURDATE()),"01")';
			$this->results['res'] = 1;	
			break;
			
			
			case "nachislenie_tbo":
			       $this->sql='CALL YISGRAND.nachislenie_tbo(@success,@msg)';				    
			break;
				case "nachislenie_tbo_house":
			      $this->sql='CALL YISGRAND.nachislenie_tbo_house("'.$this->house_id.'",@success,@msg)';
			  //  print_r($this->sql); 

			break;
			case "pereraschet_tbo":
			      $this->sql='CALL YISGRAND.pereraschet_tbo("'
										      .$this->house_id.'","'
										      .$this->allkv.'","'
										      .$this->tarif_manual.'","'
										      .$this->address_ot.'","'
										      .$this->address_do.'","'
													.$this->tbo.'","'
										      .$this->ch_tbo.'","'
										      .$this->sdata.'","'
										      .$this->fdata.'","'
										      .$this->info.'",'
										      .'@success,@msg)';
			  //  print_r($this->sql); 

			break;
		case "newAddress":
			      $this->sql='CALL YISGRAND.newAddress("'
										      .$this->qtykv.'","'
										      .$this->nomerkv.'","'
										      .$this->raion_id.'","'
										      .$this->street_id.'","'
									              .$this->house_id.'","'
									              .$this->tarif.'","'
										      .$this->kvartplata.'","'
										      .$this->tbo.'","'
										      .$this->voda.'","'
										      .$this->stoki.'","'
										      .$this->podogrev.'","'
										      .$this->otoplenie.'",'
										      .'@success,@msg)';
			    //print_r($this->sql); 

			break;
			case "delAddress":
			      $this->sql='CALL YISGRAND.delAddress('.$this->delAddressId.','.$this->control.',@success,@msg)';
			    //print_r($this->sql); 

			break;
			case "addBasaNachAddress":
			      $this->sql='CALL YISGRAND.addBasaNachAddress("'
			      .$this->address_id.'","'
			      .$this->data.'","'
			      .$this->kvartplata.'","'
			      .$this->tbo.'","'
			      .$this->voda.'","'
			      .$this->stoki.'","'
			      .$this->podogrev.'","'
			      .$this->otoplenie.'",@success,@msg)';
			       

			break;
			case "checkDelAddress":
			      $this->sql='CALL YISGRAND.checkDelAddress('.$this->address_id.',@success,@msg)';
			    //print_r($this->sql); 

			break;	
		case "newHouse":
			      $this->sql='CALL YISGRAND.newHouse("'
										      .$this->newhouse.'","'
										      .$this->tarif.'","'
										      .$this->nomer.'","'
										      .$this->raion_id.'","'
										      .$this->street_id.'",'
 									       .'@new_id,@new_name,@success,@msg)';
			    //print_r($this->sql); 

			break;
		case "addHouseOsmd":
			      $this->sql='CALL YISGRAND.addHouseOsmd('.$this->house_id.',"'.$this->newOsmd.'",@success,@msg)';
			      break;
		case "addHouseRko":
			      $this->sql='CALL YISGRAND.addHouseRko('.$this->house_id.','.$this->rko.',@success,@msg)';
			      break;
		 case "PrintSchetRko":
		 $this->sql='INSERT INTO YISGRAND.TMP_TABLE SET YISGRAND.TMP_TABLE.`rec_id` = '.$this->house_id.',YISGRAND.TMP_TABLE.`org_id` = '.$this->osmd_id.'';
		 $this->results['res'] = 1;	
		 break;
		  case "newStreet":
			      $this->sql='CALL YISGRAND.newStreet("'.$this->newStreet.'","'.$this->abbr.'",'.$this->privat.',@new_id,@new_name,@success,@msg)';
			    //print_r($this->sql); 

			break;
		case "EnauditAddHouses":			
			      $this->sql='CALL YISGRAND.EnauditAddHouses("'.implode(',',$this->houses).'",@success,@msg)';

			// print($this->sql);
			break;	
		case "EnauditControl":			
			      $this->sql='CALL YISGRAND.EnauditControl(@success,@msg)';

			// print($this->sql);
			break;	
		    case "newRaion":
			      $this->sql='CALL YISGRAND.newRaion("'.$this->newRaion.'",@new_id,@new_name,@success,@msg)';
			    //print_r($this->sql); 

			break;
		   case "ExportBudjetEmail":
			      $this->sql='CALL YISGRAND.ExportBudjetEmail("'.$this->org_id.'","'.$this->data.'",@success,@msg)';
			    //print_r($this->sql); 
			break;
		case "EmailInfoApp":
			      $this->sql='CALL YISGRAND.EmailInfoAddress("'.$this->address_id.'",@success)';
		      break;

		} // End of Switch ($what)  

		$this->result = $_db->query($this->sql) or die('Connect Error in '.$this->what.' ('.$this->sql.') ' . $_db->connect_error);
		
		$this->sql_callback='SELECT @new_id,@new_name,@success, @msg';

		$this->res_callback = $_db->query($this->sql_callback) or die('Connect Error >>>  ' . $_db->connect_errno . '  <<< ' . $_db->connect_error);
		
		while ($this->row = $this->res_callback->fetch_assoc()) {
			$this->results['success'] = $this->row['@success'];
			$this->results['msg'] = $this->row['@msg'];
			$this->results['new_id'] = $this->row['@new_id'];
			$this->results['new_name'] = $this->row['@new_name'];
		}
		
		return $this->results;

	} // ================================= UPDATE RECORDS


	}