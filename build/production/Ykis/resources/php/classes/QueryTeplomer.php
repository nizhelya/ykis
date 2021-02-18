<?php

class QueryTeplomer
{

	private $_db;
	protected $login;
	protected $password;
	protected $result;
	protected $res_callback;
	protected $sql;	
	protected $sql_callback;
	protected $row;	
	protected $teplomer_id;
	protected $dteplomer_id;
	protected $pok_id;
	protected $address_id;
	protected $what;
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

		
		if(isset($params->what) && ($params->what)) {
		 $this->what = $params->what;
		} else {
		  $this->what = null;
		}
		if(isset($params->house_id) && ($params->house_id)) {
		 $this->house_id = (int) $params->house_id;
		} else {
		  $this->house_id = 0;
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
		if(isset($params->teplomer_id) && ($params->teplomer_id)) {
		  $this->teplomer_id = (int) $params->teplomer_id;
		} else {
		  $this->teplomer_id = 0;
		}
		if(isset($params->dteplomer_id) && ($params->dteplomer_id)) {
		  $this->dteplomer_id = (int) $params->dteplomer_id;
		} else {
		  $this->dteplomer_id = 0;
		}
	      if(isset($params->pok_id) && ($params->pok_id)) {
		  $this->pok_id= (int) $params->pok_id;
		} else {
		  $this->pok_id= 0;
		}

	      if(isset($params->data) && ($params->data)) {
		  $this->data= $params->data;
		} else {
		  $this->data= "";
		}
	       
		switch ($this->what) {
//   КВАРТИРНЫЙ ТЕПЛОМЕР
			case "TekPokTeplomera":			
			$this->sql='SELECT t1.*,t2.pred,t2.tek,t2.qty,t2.pok_id,t2.gkal,t2.data as fdate,t2.date_do as date_old,t2.tek as tekp,t2.gkal as newKubov FROM YIS.TEPLOMER as t1,YIS.PTEPLOMER  as t2  WHERE t1.teplomer_id='.$this->teplomer_id.' AND t2.teplomer_id='.$this->teplomer_id.' ORDER BY t2.pok_id DESC limit 1';		
					//print($this->sql);
			break;
			case "AllPokTeplomera":			
				$this->sql='SELECT t1.*,t1.data as fdate,t1.date_do as date_old,t1.gkal as newKubov FROM YIS.PTEPLOMER as t1 WHERE t1.teplomer_id='.$this->teplomer_id.'  ORDER BY t1.pok_id DESC  LIMIT 10 ';
				//	  print($this->sql);
			break;
			case "AllPokTeplomeraAll":
				$this->sql='SELECT t1.*,t1.data as fdate,t1.date_do as date_old,t1.gkal as newKubov FROM YIS.PTEPLOMER as t1 WHERE t1.teplomer_id='.$this->teplomer_id.'  ORDER BY t1.pok_id DESC  ';

			break;
			
			case "AppTeplomer"://применяется
				  $this->sql='SELECT *  FROM YIS.TEPLOMER as t1  WHERE t1.address_id='.$this->address_id.'  AND t1.spisan=0 ';
					//print($this->sql); 
			break;
			case "AppHTeplomer"://применяется
				  $this->sql='SELECT * FROM YIS.TEPLOMER as t1  WHERE t1.address_id='.$this->address_id.' AND t1.spisan=1 ';
					//print($this->sql);
					
			break;	
			case "TekNachAppTeplomera":			  
			   $this->sql='SELECT address_id,data,DATE_FORMAT(data,"%m-%Y") as fdate,SUBSTRING(`usluga`,1,5) as usluga,CONCAT_WS(" ",mec,god) as period,zadol,'
				  .'"Гкал" as edizm,gkal as qty,tarif,nachisleno-perer as nachisleno,perer,-(budjet+pbudjet) as budjet,'
				  .'nachisleno+perer+budjet+pbudjet as itogo,oplacheno,subsidia,dolg FROM YIS.OTOPLENIE WHERE address_id='.$this->address_id.' ORDER BY data DESC LIMIT 1 ';
			//print($this->sql); 
			break;
//   ТЕПЛОМЕР ОРГАНИЗАЦИИ
			 case "OrgTeplomer"://применяется
				  $this->sql='SELECT *  FROM YISGRAND.TEPLOMER  WHERE YISGRAND.TEPLOMER.filial_id='.$this->filial_id.'  AND YISGRAND.TEPLOMER.spisan=0 ';
					//print($this->sql); 
			break;
			case "OrgHTeplomer"://применяется
				  $this->sql='SELECT *  FROM YISGRAND.TEPLOMER WHERE YISGRAND.TEPLOMER.filial_id='.$this->filial_id.'  AND YISGRAND.TEPLOMER.spisan=1 ';
					//print($this->sql);
					
			break;	
			      case "TekPokOrgTeplomera":			
			      $this->sql='SELECT t1.*,t2.pred,t2.tek,t2.qty,t2.pok_id,t2.gkal,t2.data as fdate,t2.date_do as date_old,t2.tek as tekp,t2.gkal as newKubov '
			      .' FROM YISGRAND.TEPLOMER as t1,YISGRAND.PTEPLOMER  as t2 WHERE t1.teplomer_id='.$this->teplomer_id.' AND t2.teplomer_id='.$this->teplomer_id.' ORDER BY t2.pok_id DESC limit 1';		
			
					//print($this->sql);
			break;
			
			case "AllPokOrgTeplomera":			
			$this->sql='SELECT t1.*,t1.data as fdate,t1.date_do as date_old,t1.gkal as newKubov FROM YISGRAND.PTEPLOMER as t1 WHERE t1.teplomer_id='.$this->teplomer_id.'  ORDER BY t1.pok_id DESC  LIMIT 10 ';
				//	  print($this->sql);
			break;
			case "AllPokOrgTeplomeraAll":
				$this->sql='SELECT t1.*,t1.data as fdate,t1.date_do as date_old,t1.gkal as newKubov FROM YISGRAND.PTEPLOMER as t1 WHERE t1.teplomer_id='.$this->teplomer_id.'  ORDER BY t1.pok_id DESC ';
				//	  print($this->sql);

			break;
			case "TekNachOrgTeplomera":			  
			   $this->sql='SELECT filial_id,data,DATE_FORMAT(data,"%m-%Y") as fdate,SUBSTRING(`usluga`,1,5) as usluga,CONCAT_WS(" ",mec,god) as period,zadol,'
				  .'"Гкал" as edizm,gkal as qty,tarif,nachisleno-perer as nachisleno,perer,'
				  .'nachisleno+perer as itogo,oplacheno,dolg FROM YISGRAND.OTOPLENIE WHERE filial_id='.$this->filial_id.' ORDER BY data DESC LIMIT 1 ';
			//print($this->sql); 
			break;
//   ДОМОВОЙ ТЕПЛОМЕР
			case "Dteplomer"://применяется			
			    $this->sql='SELECT *  FROM YIS.DTEPLOMER  WHERE YIS.DTEPLOMER.house_id='.$this->house_id.'  AND YIS.DTEPLOMER.spisan=0 ORDER BY YIS.DTEPLOMER.vvod';
					//print( $this->sql);  
		      break;		  
		      case "HDteplomers"://применяется			
			     $this->sql='SELECT *  FROM YIS.DTEPLOMER  WHERE YIS.DTEPLOMER.house_id='.$this->house_id.'  AND YIS.DTEPLOMER.spisan=1 ';
			//print( $this->sql);  
		      break;


			  case "TekPokDTeplomera"://применяется	
			    $this->sql='SELECT t1.dteplomer_id,t1.house_id,t1.house,t1.allapp,t1.koef,t1.vvod,t1.out,t1.appartment,t1.first_app,t1.last_app,t1.nomer,t1.model,'
					.'t1.area,t1.area_dt,t1.area_dta,t1.area_ta,t1.area_dto,t1.area_to,t1.area_tra,t1.area_tro,t1.area_mop,t1.tnb_dt,t1.edizm,t1.note,'
					.'t2.pok_id,t2.date_do as data,t2.date_ot,t2.date_do,t2.pred,t2.tek as tekp,t2.gkal_dt as gkal,t2.tek,t2.gkm2,t2.operator ,t3.gkal_hour ,t3.otoplenie  as tarif ,'
					.' t4.gkal_dt,t4.gkal_otsa,t4.gkal_otso,t4.gkal_otta,t4.gkal_otto FROM YIS.PDTEPLOMER as t2   LEFT JOIN YIS.DTEPLOMER as t1  ON t1.dteplomer_id = t2.dteplomer_id '
					. 'LEFT JOIN YIS.TARIF_TEPLO as t3 ON t3.house_id = t2.house_id and t3.`data` = CONCAT(EXTRACT(YEAR_MONTH FROM curdate()),"01") LEFT JOIN YIS.HEATHOUSE as t4  ON t4.dteplomer_id = t2.dteplomer_id and ' 
					.' t4.data = t2.data  WHERE   t2.dteplomer_id='.$this->dteplomer_id.'  ORDER BY t2.pok_id DESC  limit 1 ';
					//print_r($this->sql); 
			  break;
			  case "TekPokHeatHouse"://применяется	
			    $this->sql='SELECT t1.*  FROM YIS.HEATHOUSE as t1  WHERE  t1.dteplomer_id='.$this->dteplomer_id.' and t1.gkal_dt !=0  ORDER BY t1.`data`  DESC';
					//print_r($this->sql); 
			  break;

			  case "PokHeatHouse":// НЕ применяется	
			     $this->sql='SELECT t1.* FROM YIS.HEATHOUSE as t1  WHERE  t1.dteplomer_id='.$this->dteplomer_id.' AND t1.gkal_dt !=0  ORDER BY t1.data DESC limit 1 ';
					//print_r($this->sql); 
			  break;

			    case "AllPokDTeplomera":	//применяется	
		
			   $this->sql='SELECT t1.*,t2.area as darea,t2.area_dt as darea_dt,t2.area_dta as darea_dta,t2.area_ta as darea_ta, '
			   .' t2.area_dto as darea_dto,t2.area_to as darea_to,t2.area_tra as darea_tra,t2.area_tro as darea_tro,t2.area_mop as darea_mop '
			   .' FROM YIS.PDTEPLOMER as t1 ,YIS.DTEPLOMER as t2  WHERE  t1.dteplomer_id='.$this->dteplomer_id.' and  t2.dteplomer_id='.$this->dteplomer_id.'  ORDER BY t1.pok_id DESC  ';
		 
			  //  print_r($this->sql); 
			break;	
			  case "TekNachHouse":			  
			   $this->sql='SELECT house_id,data,'
					.'CONCAT_WS(" ",mec,god) as period,'
					.'sum(zadol) as zadol,'
					.'CASE WHEN gkal=0 THEN "м2" ELSE "Гкал" END as edizm,'
					.'CASE WHEN gkal=0 THEN square ELSE gkal END as qty,'
					.'CASE WHEN gkal=0 THEN tarif ELSE tarif END as tarif,'
					.'sum(nachisleno) as nachisleno,'
					.'sum(perer) as perer,'
					.'sum(itogo) as itogo,'
					.'sum(oplacheno) as oplacheno,'
					.'sum(dolg) as dolg '
					.' FROM YIS.OTOPLENIE'
					.' WHERE house_id='.$this->house_id.' '
					.' ORDER BY data DESC LIMIT 1 ';
					    //print($this->sql); 
			break;


			  case "OrgByDteplomer":// применяется	
			    $this->sql='SELECT t1.* ,'
					.'(SELECT t2.`gkal` FROM YISGRAND.OTOPLENIE as t2 WHERE t2.filial_id = t1.filial_id  ORDER BY t2.data DESC LIMIT 1 ) as gkal,  '
					.'(SELECT t3.`gkal` FROM YISGRAND.PODOGREV  as t3 WHERE t3.filial_id = t1.filial_id  ORDER BY t3.data DESC LIMIT 1 ) as gkal_podogrev  '
					.' FROM YISGRAND.TM_ORG_FILIAL as t1    WHERE  t1.dteplomer_id ='.$this->dteplomer_id.'';
					//print_r($this->sql); 
			  break;
			  
			  case "AllOrgByHouse":// применяется	
			  $this->sql='SELECT t1.`filial_id`, t1.`kod_vik`, t1.`kod_ytke`, t1.`org_id`, t1.`golovnoe`, t1.`ind`, t1.`org`, t1.`address_id`, t1.`raion_id`, t1.`street_id`,'
			  .'t1.`house_id`, t1.`dvodomer`, t1.`dvodomer_id`, t1.`dteplomer_id`, t1.`dteplomer`, t1.`is_flat`, t1.`sobstv_id`, t1.`usobstv_id`, t1.`type_id`, t1.`typeh_id`,'
			  .'t1.`appartment`, t1.`address`,(case WHEN  t1.`vkl_otopl` = 1 THEN t1.`area` ELSE 0 END) as area, t1.`visota`, t1.`volume`, t1.`people`, t1.`rwork_id`, '
			  .'t1.`tarif_gv`, t1.`tarif_xv`, t1.`tarif_st`, t1.`tarif_ot`,t1.`name`, t1.`fname`, t1.`dogovor_id`, t1.`rteplo`, t1.`rvoda`, t1.`gkal_hw_gvs`, t1.`gkal_yw_gvs`,'
			  .'t1.`gkal_h_ot`, t1.`gkal_y_ot`, t1.`gkal_ys_gvs`,t1.`gkal_hs_gvs`, t1.`nrx_gvs_d`, t1.`nrx_xv_d`, t1.`pstoki`, t1.`qty_hour`, t1.`vkl_gvoda`, t1.`vkl_otopl`,'
			  .'t1.`vkl_xvoda`, t1.`vkl_stoki`, t1.`norma_xv`,t1.`norma_gv`, t1.`xvodomer`, t1.`gvodomer`, t1.`teplomer`, t1.`distributor`, t1.`type_voda`, t1.`type_teplo`,'
			  .'t1.`enaudit`, t1.`enaudit_id`,t1.`tne`, t1.`kte`, t1.`length`, t1.`diametr`, t1.`heated`, t1.`vibor`, t1.`operator` '
			  .' FROM YISGRAND.TM_ORG_FILIAL as t1 WHERE  t1.house_id ='.$this->house_id.' ORDER BY t1.enaudit DESC';
					//print_r($this->sql); 
			  break;

			  case "MopByDteplomer":// применяется	
			    $this->sql='SELECT '
					.'YIS.MOP.`mop_id`,'
					.'YIS.MOP.`dteplomer_id`,'
					.'YIS.MOP.`house_id`,'
					.'YIS.MOP.`name`, '
					.'YIS.MOP.`mopid`, '
					.'YIS.MOP.`gkal_year`, '
					.'YIS.MOP.`temp` as tempr, '
					.'(SELECT CONCAT_WS(" ",YIS.MOPN.`mec`,YIS.MOPN.`god`) FROM YIS.MOPN WHERE YIS.MOPN.`mop_id`= YIS.MOP.`mop_id` ORDER BY YIS.MOPN.`data` DESC LIMIT 1) AS period, '
					.'(SELECT YIS.MOPN.`gkal` FROM YIS.MOPN WHERE YIS.MOPN.`mop_id`= YIS.MOP.`mop_id` ORDER BY YIS.MOPN.`data` DESC LIMIT 1) AS gkal, '
					.'(SELECT YIS.MOPN.`area` FROM YIS.MOPN WHERE YIS.MOPN.`mop_id`= YIS.MOP.`mop_id` ORDER BY YIS.MOPN.`data` DESC LIMIT 1) AS area, '
					.'(SELECT YIS.MOPN.`temp` FROM YIS.MOPN WHERE YIS.MOPN.`mop_id`= YIS.MOP.`mop_id` ORDER BY YIS.MOPN.`data` DESC LIMIT 1) AS temp, '
					.'(SELECT YIS.MOPN.`day_ot` FROM YIS.MOPN WHERE YIS.MOPN.`mop_id`= YIS.MOP.`mop_id` ORDER BY YIS.MOPN.`data` DESC LIMIT 1) AS day_ot '
					.' FROM YIS.MOP '
					.' WHERE  YIS.MOP.`house_id` ='.$this->house_id
					.' AND YIS.MOP.`dteplomer_id` ='.$this->dteplomer_id;
					//print_r($this->sql); 
			  break;

		
		} // End of Switch ($what)	
		
//		$this->result = $_db->query($this->sql) or die('Connect Error (' . $_db->connect_errno . ') ' . $_db->connect_error);

		$this->result = $_db->query($this->sql) or die('Connect Error in '.$this->what.'(' .  $this->sql . ')');

		
		while ($this->row = $this->result->fetch_assoc()) {
			array_push($this->res, $this->row);
		}
		$this->results['data']	= $this->res;
		
		return $this->results;
	}

	public function inTeplomerHistory(stdClass $params)
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
		  $this->address_id = 0;
		}
		if(isset($params->teplomer_id) && ($params->teplomer_id)) {
		  $this->teplomer_id = (int) $params->teplomer_id;
		} else {
		  $this->teplomer_id = 0;
		}
		if(isset($params->dteplomer_id) && ($params->dteplomer_id)) {
		  $this->dteplomer_id = (int) $params->dteplomer_id;
		} else {
		  $this->dteplomer_id = 0;
		}
		switch ($this->what) {
			case "ATeplomer":			
			     $this->sql='CALL YISGRAND.in_ateplomer_history('.$this->teplomer_id.',@success,@msg)';
					//print($this->sql);
			break;
			case "OTeplomer":			
			     $this->sql='CALL YISGRAND.in_oteplomer_history('.$this->teplomer_id.',@success,@msg)';
					//print($this->sql);
			break;
			case "Dteplomer":			
			     $this->sql='CALL YISGRAND.in_dteplomer_history('.$this->dteplomer_id.',@success,@msg)';
					//print($this->sql);
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

	public function outTeplomerHistory(stdClass $params)
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
		  $this->address_id = 0;
		}
		if(isset($params->teplomer_id) && ($params->teplomer_id)) {
		  $this->teplomer_id = (int) $params->teplomer_id;
		} else {
		  $this->teplomer_id = 0;
		}
		if(isset($params->dteplomer_id) && ($params->dteplomer_id)) {
		  $this->dteplomer_id = (int) $params->dteplomer_id;
		} else {
		  $this->dteplomer_id = 0;
		}
		
		switch ($this->what) {
			case "ATeplomer":			
			     $this->sql='CALL YISGRAND.out_ateplomer_history('.$this->teplomer_id.',@success,@msg)';
			break;
			case "back_spisan_ateplomer":
			      $this->sql='CALL YISGRAND.back_spisan_ateplomer('.$this->address_id.','.$this->teplomer_id.',@success,@msg)';
			break;
			case "back_spisan_oteplomer":
			      $this->sql='CALL YISGRAND.back_spisan_oteplomer('.$this->filial_id.','.$this->teplomer_id.',@success,@msg)';
			break;
			case "OTeplomer":			
			    $this->sql='CALL YISGRAND.out_oteplomer_history('.$this->teplomer_id.',@success,@msg)';
					//print($this->sql);
		//print($this->sql);
			break;
			case "Dteplomer":			
			    $this->sql='CALL YISGRAND.out_dteplomer_history('.$this->dteplomer_id.',@success,@msg)';
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
	    public function addTeplomer(stdClass $params)
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
	if(isset($params->allapp) && ($params->allapp)) {
		 $this->allapp = (int) $params->allapp;
		} else {
		  $this->allapp = 0;
		}
		switch ($this->what) {
			case "addAppTeplomer":			
			      $this->sql='CALL YISGRAND.add_ateplomer("'.$this->address_id.'","'.$this->sdate.'","'.$this->pdate.'","'.$this->pp.'",
			      "'.$this->nomer.'", "'.$this->model_id.'", "'.$this->tek.'","'.$this->koef.'", "'.$this->edizm.'", @teplomer_id, @success, @msg)';
			 //  print($this->sql);
			break;
			
		
			case "changeAppTeplomer":			
			    $this->sql='CALL YISGRAND.change_ateplomer("'.$this->teplomer_id.'",'.$this->address_id.',"'.$this->sdate.'","'.$this->pdate.'","'.$this->fpdate.'","'.$this->pp.'",
			    "'.$this->nomer.'","'.$this->model_id.'","'.$this->tek.'","'.$this->koef.'","'.$this->edizm.'",@teplomer_id, @success, @msg)';
			 //   print($this->sql);
			break;
			case "addOrgTeplomer":			
			    $this->sql='CALL YISGRAND.add_oteplomer("'.$this->filial_id.'","'.$this->sdate.'","'.$this->pdate.'","'.$this->pp.'",
			      "'.$this->nomer.'", "'.$this->model_id.'", "'.$this->tek.'","'.$this->koef.'", "'.$this->edizm.'", @teplomer_id, @success, @msg)';
			 //   print($this->sql);
			break;
			case "changeOrgTeplomer":			
			    $this->sql='CALL YISGRAND.change_oteplomer("'.$this->teplomer_id.'","'.$this->filial_id.'","'.$this->sdate.'","'.$this->pdate.'","'.$this->fpdate.'","'.$this->pp.'",
			    "'.$this->nomer.'", "'.$this->model_id.'","'.$this->tek.'","'.$this->koef.'","'.$this->edizm.'", @teplomer_id, @success, @msg)';
			 //   print($this->sql);
			break;
			case "editAppTeplomer":			
			     $this->sql='CALL YISGRAND.edit_ateplomer("'.$this->teplomer_id.'","'.$this->sdate.'","'.$this->pdate.'","'.$this->fpdate.'","'.$this->pp.'",
			     "'.$this->plomba.'","'.$this->nomer.'","'.$this->model_id.'","'.$this->tek.'","'.$this->koef.'","'.$this->edizm.'", @success, @msg)';				
//print($this->sql);
			break;
			case "editOrgTeplomer":			
			    $this->sql='CALL YISGRAND.edit_oteplomer("'.$this->teplomer_id.'","'.$this->sdate.'","'.$this->pdate.'","'.$this->fpdate.'","'.$this->pp.'",
			     "'.$this->plomba.'","'.$this->nomer.'","'.$this->model_id.'","'.$this->tek.'","'.$this->koef.'","'.$this->edizm.'", @success, @msg)';	
			 //   print($this->sql);
			break;

			case "updateVvodDteplomer":
			       $this->sql='CALL YISGRAND.updateVvodDteplomer( "'.$this->dteplomer_id.'","' .$this->allapp.'","'.$this->first_app.'","'.$this->last_app.'",@success,@msg)';
			    //   print($this->sql);

			break;
			case "add_DTeplomer":			
				$this->sql='CALL YISGRAND.add_dteplomer("'							   
							    .$this->house_id.'","'
							    .$this->vvod.'","'
							    .$this->nomer.'","'
							    .$this->model_id.'","'
							    .$this->allapp.'","'
							    .$this->first_app.'","'
							    .$this->last_app.'","'
							    .$this->edizm.'", "'
							    .$this->sdate.'","'
							    .$this->pdate.'","'
							    .$this->plomba.'","'
							    .$this->pp.'","'
							    .$this->zdate.'","'
							    .$this->koef.'","'
							    .$this->tek.'","'
							    .$this->paused.'",'
							    .'@teplomer_id,@success,@msg)';
			break;	
			case "edit_DTeplomer":			
				$this->sql='CALL YISGRAND.edit_dteplomer("'
							    .$this->dteplomer_id.'","'
							    .$this->house_id.'","'
							    .$this->nomer.'","'
							    .$this->model_id.'","'							  
							    .$this->edizm.'", "'
							    .$this->sdate.'","'
							    .$this->pdate.'","'
							    .$this->plomba.'","'
							    .$this->pp.'","'
							    .$this->fpdate.'","'
							    .$this->zdate.'","'
							    .$this->koef.'","'							  
							    .$this->tek.'","'
							    .$this->paused.'",'
							    .'@success,@msg)';
//print($this->sql);

			break;	    
			case "change_DTeplomer":			
			   $this->sql='CALL YISGRAND.change_dteplomer('.$this->house_id.','.$this->dteplomer_id.',"'.$this->sdate.'","'.$this->pdate.'","'.$this->nomer.'",'.$this->model_id.','.$this->tek.','
							    .$this->koef.',"'.$this->edizm.'",@teplomer_id,@success,@msg)';
			   // print($this->sql);
			break;
			
			case "addMop":	
			      $this->sql='CALL YISGRAND.add_update_mop('.$this->mop_id.','.$this->house_id.','.$this->dteplomer_id.','.$this->mopid.', '
							    .$this->gkal_year.', @newmop_id, @success, @msg)';
			 //  print($this->sql);
			break;
		}
		
		$this->result = $_db->query($this->sql) or die('Connect Error in '.$this->what.'(' .  $this->sql . ') ' . $_db->connect_error);
		
		$this->sql_callback='SELECT @teplomer_id,@success,@msg';

		$this->res_callback = $_db->query($this->sql_callback) or die('Connect Error in '.$this->what.'(' .  $this->sql_callback . ') ' . $_db->connect_error);
		
		while ($this->row = $this->res_callback->fetch_assoc()) {
			$this->results['teplomer_id'] = $this->row['@teplomer_id'];
			$this->results['success'] = $this->row['@success'];
			$this->results['msg']	=$this->row['@msg'];
		}
			
		return $this->results;

	}
	    public function delTeplomer(stdClass $params)
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
			case "ATeplomer":			
			    $this->sql='CALL YISGRAND.spisan_ateplomer('.$this->address_id.','.$this->teplomer_id.',@success,@msg)';
			    //print($this->sql);
			break;
			case "delete_ateplomer":			
			$this->sql='CALL YISGRAND.delete_ateplomer('.$this->address_id.','.$this->teplomer_id.',@success,@msg)';
			    //print($this->sql);
			break;
			case "OTeplomer":			
			$this->sql='CALL YISGRAND.spisan_oteplomer('.$this->filial_id.','.$this->teplomer_id.',@success,@msg)';
			    //print($this->sql);
			break;
			case "DelOTeplomer":			
			$this->sql='CALL YISGRAND.del_oteplomer('.$this->filial_id.','.$this->teplomer_id.',@success,@msg)';
			    //print($this->sql);
			break;
			case "Dteplomer":			
			 $this->sql='CALL YISGRAND.del_dteplomer('.$this->dteplomer_id.',@success,@msg)';
			    //print($this->sql);
			break;
			case "delMop":			
			 $this->sql='CALL YISGRAND.del_mop('.$this->mop_id.',@success,@msg)';
			    //print($this->sql);
			break;
		}
		
		$this->result = $_db->query($this->sql) or die('Connect Error in '.$this->what.'(' .  $this->sql . ') ' . $_db->connect_error);
		
		$this->sql_callback='SELECT @teplomer_id,@success,@msg';

		$this->res_callback = $_db->query($this->sql_callback) or die('Connect Error in '.$this->what.'(' .  $this->sql_callback . ') ' . $_db->connect_error);
		
		while ($this->row = $this->res_callback->fetch_assoc()) {
			$this->results['teplomer_id'] = $this->row['@teplomer_id'];
			$this->results['success'] = $this->row['@success'];
			$this->results['msg']	=$this->row['@msg'];
		}
			
		return $this->results;

	}
	public function delPokTeplomera(stdClass $params)
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
			case "ATeplomer":			
			     $this->sql='CALL YISGRAND.delete_pokaz_ateplomera('.$this->pok_id.',@success,@msg)';
		//print($this->sql);
			break;
	    		case "OTeplomer":			
			     $this->sql='CALL YISGRAND.delete_pokaz_oteplomera('.$this->pok_id.',@success,@msg)';
		//print($this->sql);
			break;
			case "Dteplomer":			
			   $this->sql='CALL YISGRAND.delete_pokaz_dteplomera('.$this->pok_id.','.$this->house_id.','.$this->dteplomer_id.',@success,@msg)';
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
	public function newPokTeplomera(stdClass $params)
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

		/*NewPokTeplomera*/
		switch ($this->what) {
			case "ATeplomer":			
			    $this->sql='CALL YISGRAND.input_new_pokaz_ateplomera('.$this->address_id.', '.$this->teplomer_id.',"'.$this->date_old.'","'.$this->date_new.'", '
			    .'"'.$this->tek.'",'.$this->newValue.', @success,@msg)';
		//print($this->sql);
			break;
			case "OTeplomer":			
			    $this->sql='CALL YISGRAND.input_new_pokaz_oteplomera('.$this->filial_id.','.$this->teplomer_id.',"'.$this->date_old.'","'.$this->date_new.'", '
			    .' "'.$this->tek.'",'.$this->newValue.',@success,@msg)';
		//print($this->sql);
			break;
			case "OTeplomerGkal":			
			    $this->sql='CALL YISGRAND.input_new_gkal_oteplomera('.$this->filial_id.','.$this->teplomer_id.',"'.$this->date_old.'","'.$this->date_new.'","'.$this->newValue.'",@success,@msg)';
		//print($this->sql);
			break;
			case "insHandOrgTepl":			
			    $this->sql='CALL YISGRAND.input_hand_pokaz_oteplomera('.$this->filial_id.','.$this->teplomer_id.',"'.$this->date_do.'","'.$this->data_tek.'",'.$this->tek.','.$this->newValue.',@success,@msg)';
		//print($this->sql);
			break;
			
			case "NachislenieDteplomer":
			$this->sql='CALL YISGRAND.nachislenie_otoplenie('.$this->house_id.','.$this->dteplomer_id.',"'.$this->date_do.'","'.$this->data_tek.'","'.$this->ldate_ot.'","'.$this->ldate_to.'",@success,@msg)';
			 
			break;
			case "UpdateAreaDteplomer":
			$this->sql='CALL YISGRAND.UpdateAreaDteplomer('.$this->dteplomer_id.',"'.$this->area_mop.'",@success,@msg)';
			break;
			case "FixAreaDteplomer":
			$this->sql='CALL YISGRAND.FixAreaDteplomer('.$this->dteplomer_id.',"'.$this->area_mop.'",@success,@msg)';
			break;
			
			case "Dteplomer":
			      switch ($this->dteplomer_id) {
			      case "58":
				    $this->sql='CALL YISGRAND.input_new_pokaz_dteplomera_add('.$this->house_id.','.$this->dteplomer_id.',"'.$this->date_do.'","'.$this->date_tek.'",
				    "'.$this->tek.'","'.$this->newValue.'",@success,@msg)';

				break;
				default:
				    $this->sql='CALL YISGRAND.input_new_pokaz_dteplomera('.$this->house_id.','.$this->dteplomer_id.',"'.$this->date_do.'","'.$this->date_tek.'",
				    "'.$this->tek.'","'.$this->newValue.'",@success,@msg)';
			      }		 
			      			      			// print_r($this->sql); 

			      break;
						
			case "HeatHouse":		
	    $this->sql='CALL YISGRAND.input_new_pokaz_heathouse_do_m2('.$this->dteplomer_id.','.$this->house_id.',"'.$this->date_do.'","'.$this->date_tek.'",'.$this->newValue.',@success,@msg)';
		//print($this->sql);
			break;
		      case "NachOtoplenieSquare":			
			   $this->sql='CALL YISGRAND.NachOtoplenieSquare('.$this->dteplomer_id.','.$this->house_id.',"'.$this->date_do.'","'.$this->date_tek.'",'.$this->newValue.',@success,@msg)';
		//print($this->sql);
			break;
			case "Middle":			
			   $this->sql='CALL YISGRAND.input_new_pokaz_middle('.$this->house_id.','.$this->dteplomer_id.','.$this->day_middle.',@success,@msg)';
		//print($this->sql);
			break;

			case "HotWater":			
			   $this->sql='CALL YISGRAND.nachisl_gvs_house('.$this->house_id.','.$this->dteplomer_id.',"'.$this->day_gv.'", @success, @msg)';
	//	print($this->sql);
			break;

			
			case "SaldoOtoplOrg":			
			   $this->sql='UPDATE YISGRAND.OTOPLENIE SET `zadol` = '.$this->zadol.', `dolg` = '.$this->zadol.'+`nachisleno`-`oplacheno` WHERE filial_id = '.$this->filial_id.' AND EXTRACT(YEAR_MONTH FROM `data`) = EXTRACT(YEAR_MONTH FROM curdate())';
		//print($this->sql);
			break;
			case "PererOrgGkal":			
			   $this->sql='CALL YISGRAND.input_perer_org_gkal('.$this->filial_id.',"'.$this->data.'","'.$this->tarif.'", "'.$this->newValue.'", "'.$this->note.'",@success,@msg)';
		//print($this->sql);
			break;
			case "NachOplataKreditAddress":
			      $this->sql='CALL YISGRAND.NachOplataKreditAddress('.$this->address_id.',"'.$this->data.'",@success,@msg)';
			break;
		case "AppOtopleniePererIns":			
			   $this->sql='CALL YISGRAND.input_perer_app_gkal('.$this->address_id.',"'.$this->data_perer.'",'.$this->gkal_old.','.$this->gkal_new.','.$this->tarif_perer.', "'.$this->info.'",@success,@msg)';
		//print($this->sql);
			break;
			case "PererOrgDt":			
			   $this->sql='CALL YISGRAND.input_perer_org_square_dteplomera('.$this->house_id.','.$this->dteplomer_id.','.$this->filial_id.', "'.$this->data.'" ,'.$this->newValueDayDt.','.$this->newValueSquareDt.', "'.$this->note.'",@success,@msg)';
		//print($this->sql);
			break;
			case "PererDteplomer":			
			   $this->sql='CALL YISGRAND.input_perer_gkal_dteplomera('.$this->house_id.','.$this->dteplomer_id.',"'.$this->data_perer.'" ,'.$this->gkal_perer.',"'.$this->note.'",@success,@msg)';
		//print($this->sql);
			break;
			
			case "PererOtoplenieSquare":			
			   $this->sql='CALL YISGRAND.PererOtoplenieSquare('.$this->dteplomer_id.','.$this->house_id.',"'.$this->data.'" ,"'.$this->note.'",@success,@msg)';
		//print($this->sql);
			break;

		}
		
		//print($this->sql);
//		$this->result = $_db->query($this->sql) or die('Connect Error (' . $_db->connect_errno . ') ' . $_db->connect_error);
		$this->result = $_db->query($this->sql) or die('Connect Error in '.$this->what.'(' .  $this->sql . ') ' . $_db->connect_error);


		$this->sql_callback='SELECT @success,@msg';

		$this->res_callback = $_db->query($this->sql_callback) or die('Connect Error in '.$this->what.'(' .  $this->sql_callback . ') ' . $_db->connect_error);
		
		while ($this->row = $this->res_callback->fetch_assoc()) {
			$this->results['success'] = $this->row['@success'];
			$this->results['msg']	=$this->row['@msg'];
			
		}
			
		return $this->results;
;
	}
/*	public function __destruct()
	{
		$_db = $this->connect($this->login,$this->password);
		$_db->close();
		
		return $this;
	}*/
}