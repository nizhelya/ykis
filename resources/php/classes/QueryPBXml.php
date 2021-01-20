<?php
include_once './yis_config.php';

class QueryPBXml
{
	private $_db;
	protected $login;
	protected $password;
	protected $result;
	protected $sql_total;
	protected $total;
	protected $key;
	protected $count;
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
	protected $data=NULL;
	protected $res=array();	
	public	  $results=array();
	
	public function __construct()
	{
		//                 'hostname', 'username' ,'password', 'database'
		$_db = new mysqli('localhost', LOGIN ,PASSWORD, 'YIS');
		
		if ($_db->connect_error) {
			die('Connection Error (' . $_db->connect_errno . ') ' . $_db->connect_error);
		}
		$_db->set_charset("utf8");
    
		return $_db;
	}


	public function getResults(stdClass $params)  // ================================= GET RESULTS
	{
		$_db = $this->__construct();
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
				case "xmlData":
				$this->sql='INSERT YISGRAND.PBTEST SET YISGRAND.PBTEST.id = 1';
		break;

		} 	
		$_result = $_db->query($this->sql) or die('Connect Error in '.$this->what.' ( ' . $this->sql . ' ) ' . $_db->connect_error);
		
		while ($this->row = $_result->fetch_assoc()) {
			array_push($this->res, $this->row);
		}
		$this->results['data']	= $this->res;
		$this->results['total']	= $this->total;

		
		return $this->results;
	}  // ================================= GET RESULTS




	public function createRecord(stdClass $params) // ================================= CREATE RECORD
	{

		$_db = $this->__construct();

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
			
		}

		return $this;

	} // ================================= CREATE RECORD


		public function destroyRecord(stdClass $params)      // ================================= DESTROY RECORD
		{

		$_db = $this->__construct();


		$array = (array) $params;

		foreach ( $array as $key => $value ) 
		    {
			if(isset($value)) {
			    if (is_int($value)) { $this->$key= (int)$value;}
			    else if (is_float($value)) { $this->$key= $value;}
			    else {$this->$key =$_db->real_escape_string($value);}
			}
		    }

		

		  return $this;

		} 
		public function updateRecords(stdClass $params)      // ================================= UPDATE RECORD
		{

		$_db = $this->__construct();

		$array = (array) $params;

		foreach ( $array as $key => $value ) 
		    {
			if(isset($value)) {
			    if (is_int($value)) { $this->$key= (int)$value;}
			    else if (is_float($value)) { $this->$key= $value;}
			    else {$this->$key =$_db->real_escape_string($value);}
			}
		    }

		
		return $this;

	} // ================================= UPDATE RECORD








	public function __destruct()
	{
		$_db = $this->__construct();
		$_db->close();
		
		return $this;
	}
}