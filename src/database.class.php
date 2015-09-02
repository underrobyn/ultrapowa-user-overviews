<?php

class databaseConnection { // Define Hostname, Username, Password and database
	private $hn = "127.0.0.1";
	private $un = "root";
	private $ps = "";
	private $db = "ucsdb";
	
	public function connect() { // Connect to database
		$conn = @mysqli_connect($this->hn,$this->un,$this->ps,$this->db);
		
		if (!$conn) {
			die("The server is currently down"); // If connection fails just kill the script
		} else {
			$this->databaseConnection = $conn; // If connection succeeds define it
		}
		
		return $this->databaseConnection;
	}
	
	public function queryDB($sql) { // Get the SQL query and return it
		return @mysqli_query($this->databaseConnection,$sql);
	}
	
	public function disconnect() { // Kill the database connection
		@mysqli_close($this->databaseConnection);
	}
	
	public function errors() { // Display any errors (Only use when developing)
		return mysqli_error($this->databaseConnection);
	}
}
