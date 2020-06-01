<?php

	if(empty($_SESSION)) 
		session_start();

	class App
	{
		private $host = 'localhost';
		private $user = 'root';
		private $pwd = '';
		private $db = 'timein';
		private $conn;
		function __construct()
		{
			$this->conn = new mysqli($this->host, $this->user, $this->pwd, $this->db);
			if ($this->conn->connect_error) 
				die("Connection failed: " . $this->conn->connect_error);
		}

		/********** PROJECT DATA ************/

		public function cleanInput($str){

			$str = mysqli_real_escape_string($this->conn,$str);
			$a = array("&", "<", ">");
			$b = array("&amp;", "&lt;", "&gt;");
			for( $i=0; $i<count($b); $i++ )
				$str = str_replace( $a[$i], $b[$i], $str);
			return $str;
		}

		public function getProjects(){

	  		// print_r($this->conn);
	  		$sql = "SELECT * FROM project";
	  		$result = $this->conn->query($sql);
	  		if (!is_object($result)) {
		  		echo $this->conn->connect_error;
		  		return "No data fetched";
		  	}
		  	return $result;
	  	}

	  	public function addProject($job_no, $proj_name, $proj_ref, $proj_id){

	  		$sql = "INSERT INTO project VALUES('".$job_no."', '".$proj_name."', '".$proj_ref."', '".$proj_id."')";
	  		// echo $sql;
	  		if ($this->conn->query($sql) === FALSE) 
			  echo "Error: " . $sql . "<br>" . $this->conn->error;

	  	}


	  	/************** STAFF DATA *************/

	  	/************** TIMESHEET DATA *************/

	  	/************** INVOICE DATA *************/

	}

	
  		
  	$app = new app();
  	// print_r($app->getProjects());

  	
?>