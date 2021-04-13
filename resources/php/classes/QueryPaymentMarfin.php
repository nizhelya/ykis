<?php
include_once './yis_config.php';

class QueryPaymentMarfin
{
	private $_db;
	protected $login;
	protected $result;
	protected $res_callback;
	protected $sql;	
	protected $sql_callback;
	protected $url_callback;
	protected $row;	
	protected $what;
	protected $nomer;
	protected $type;
	protected $pokaz;
	protected $pred;
	protected $tek;
	protected $kvartplata =0;
	protected $teplo=0;
	protected $voda=0;
	protected $tbo=0;
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
	
		switch ($this->what) {

		

			case "PaymentStatus":			
			      $this->sql='SELECT t1.`status`,t1.`address_id`,t1.`raion_id` FROM YISGRAND.MTB_PAYMENT as t1 ,YISGRAND.ADDRESS as t2 '
			      .' WHERE t1.payment_id='.$this->pay_id.' AND t1.`address_id`= '.$this->address_id.' LIMIT 1 ';
			break;
		case "MarfinPayment":			
			      $this->sql='SELECT t1.* FROM YISGRAND.MTB_PAYMENT as t1  WHERE t1.address_id='.$this->address_id.' ORDER BY t1.payment_id DESC';
			      // print_r($this->sql); 
			break;
		} // End of Switch ($what)
		
	
		

		$this->result = $_db->query($this->sql) or die('Connect Error in '.$this->what.'(' .  $this->sql . ') ' . $_db->connect_error);
		
		while ($this->row = $this->result->fetch_assoc()) {
			array_push($this->res, $this->row);
		}
		$this->results['data']	= $this->res;
		
		return $this->results;
	}


public function newOplata(stdClass $params){
	
$_db = $this->connect();
$_sql_trancate ='TRUNCATE TABLE YISGRAND.PB_REESTR';
$_result_trancate = $_db->query($_sql_trancate) or die('Connect Error1 (' . $_db->connect_errno . ') ' . $_db->connect_error);
$array = (array) $params;
  foreach ( $array as $key => $value ) 
    {
      if(isset($value)) { 
	if (is_int($value)) { $this->$key= (int)$value;}
	else if (is_float($value)) { $this->$key= $value;}
	else {$this->$key =$value;}
	}
    }

 

 $partner = array();
 $data = array();
 $requestData = array();


$partner["PartnerToken"] = "8aff556f-1025-439a-8c7d-fda279523332";
$partner["OperationType"] = 20002;
$partner["Locale"] = "uk";


$data["DateStart"] = $this->first_date;
$data["DateFinish"] = $this->last_date;
$data["Decrypted"] = true;


		 
$requestData["Partner"] =  $partner;
$requestData["Data"] = json_encode($data);	 

$json_data= json_encode($requestData);	

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://stage-papi.xpay.com.ua/cipher',
 // CURLOPT_URL => 'https://papi.xpay.com.ua:1112/cipher',
  CURLOPT_RETURNTRANSFER => true, 
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_SSL_VERIFYHOST => 0,
  //CURLOPT_SSLVERSION => 3,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => $json_data
));
//cURL Error: 35<br>cURL ErrorNo: Unknown SSL protocol error in connection to stage-papi.xpay.com.ua:443 {"type":"rpc","tid":22,"action":"QueryPaymentMarfin","method":"newOplata","result":null}

$curl_result = curl_exec( $curl );
curl_close( $curl );

$curl_result_code = $curl_result;	
$curl_url = curl_init();
curl_setopt_array($curl_url, array(
 CURLOPT_URL => 'https://stage-papi.xpay.com.ua:488/xpay',
 
//  CURLOPT_URL => 'https://papi.xpay.com.ua:488/xpay',
  CURLOPT_RETURNTRANSFER => true, 
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_SSL_VERIFYHOST => 0,
  //CURLOPT_SSLVERSION => 3,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => $curl_result_code
));
//cURL Error: 35<br>cURL ErrorNo: Unknown SSL protocol error in connection to stage-papi.xpay.com.ua:443 {"type":"rpc","tid":22,"action":"QueryPaymentMarfin","method":"newOplata","result":null}

$curl_result_url = curl_exec( $curl_url );

curl_close( $curl_url );
$paym = json_decode($curl_result_url,true);

print_r($paym);

/*

  if(isset($paym['Code']) && ($paym['Code'])) {
    $code =  $paym['Code'];
  } else {
    $code = 0;
  }
  
   if(isset($paym['Message']) && ($paym['Message'])) {
    $message =  $paym['Message'];
  } else {
    $message = 0;
  }
 
 if(isset($paym['Data']['OperationID']) && ($paym['Data']['OperationID'])) {
    $ndoc =  $paym['Data']['OperationID'];
  } else {
    $ndoc = "";
  }
  
   if(isset($paym['Data']['OperationStatus']) && ($paym['Data']['OperationStatus'])) {
    $status =  $paym['Data']['OperationStatus'];
  } else {
    $status = "";
  }
  
   if(isset($paym['Data']['URI']) && ($paym['Data']['URI'])) {
    $uri =  $paym['Data']['URI'];
  } else {
    $uri = "";
  }
  
   if(isset($paym['Data']['uuid']) && ($paym['Data']['uuid'])) {
    $uuid =  $paym['Data']['uuid'];
  } else {
    $uuid = "";
  }
  
  if ($code == "200" && $status == "10" ) { 
  $this->results['success']=1;
  $this->results['url'] = $uri;
  //print_r($this->results['url']);

  $this->up_stat ='INSERT INTO  YISGRAND.PB_REESTR( `pay_id`, `ndoc`,`pdate`,`fio`, `address_id`,`address`,`kvartplata`,`otoplenie`, `ptn`,`voda`, `stoki`, `fdolg` ,`tbo`, `ddolg`,
`kvartplatap`,`rfond`,`rfondp`,`energy`,`gvoda`,`pod`,`vaxta`,`summa` )  values ( ';
  			    //   print_r($this->up_stat); 
  			   

  $this->upd_status = $_db->query($this->up_stat) or die('Connect Error in '.$this->what.'(' .  $this->up_stat . ') ' . $_db->connect_error);
  
  
  } else {
    $this->results['success']=0;
    $this->results['msg']='Сервіс платежів Xpay<br>Платеж не сформований';
    }	


*/

  return $this->results;

}
	
}