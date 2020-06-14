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

		function getNavBar(){
			echo '<nav class="navbar navbar-inverse">
		      <div class="container-fluid">
		        <div class="navbar-header">
		          <a class="navbar-brand" href="index.php">TimeIn</a>
		        </div>
		        <ul class="nav navbar-nav">
		          <li id="navDashboard"><a href="index.php">Dashboard</a></li>
		          <li id="navProjects"><a href="projects.php">Projects</a></li>
		          <li id="navStaff"><a href="staff.php">Staff</a></li>
		          <li id="navTimesheet"><a href="#">TimeSheet</a></li>
		          <li id="navInvoice"><a href="#">Invoice</a></li>
		        </ul>
		        <ul class="nav navbar-nav navbar-right">
		          <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
		          <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
		        </ul>
		      </div>
		    </nav>';
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

	  	public function addProject($job_code, $proj_name, $proj_ref, $proj_id){

	  		$sql = "INSERT INTO project VALUES('".$job_code."', '".$proj_name."', '".$proj_ref."', '".$proj_id."')";
	  		// echo $sql;
	  		if ($this->conn->query($sql) === FALSE) 
			  echo "Error: " . $sql . "<br>" . $this->conn->error;

	  	}

	  	public function editProject($job_code, $proj_name, $proj_ref, $proj_id){

	  		$sql = "UPDATE project SET proj_name='".$proj_name."', proj_ref='".$proj_ref."', proj_id='".$proj_id."' WHERE job_code='".$job_code."'";
	  		// echo $sql;
	  		if ($this->conn->query($sql) === FALSE) 
			  echo "Error: " . $sql . "<br>" . $this->conn->error;

	  	}

	  	public function removeProject($job_code){

	  		$sql = "DELETE FROM project WHERE job_code='".$job_code."'";
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