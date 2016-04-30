<?php
// UPUO 1.0B https://github.com/jake-cryptic/ultrapowa-user-overviews
class Database { // Define Hostname, Username, Password and database
	public $config;
	
	private $hn = "127.0.0.1";
	private $un = "root";
	private $ps = "";
	private $db = "ucsdb";
	
	public function Connect() { // Connect to database
		$conn = @new mysqli($this->hn,$this->un,$this->ps,$this->db);
		
		if ($conn->connect_error) {
			unset($conn); // If connection fails just unset the connection and kill the script
			die("<h1 style=\"font-family:sans-serif\">Database server is unreachable</h1>"); 
		} else {
			$conn->set_charset("utf8"); // If connection succeeds set charset and define it
			$this->dbConn = $conn; 
		}
		
		return $this->dbConn;
	}
	
	public function Esc($c) { // Get the SQL query and return it
		return @htmlspecialchars($this->dbConn->real_escape_string($c));
	}
	
	public function Run($sql) { // Get the SQL query and return it
		return @$this->dbConn->query($sql);
	}
	
	public function Disconnect() { // Kill the database connection
		@$this->dbConn->close();
	}
	
	public function Error() { // Display any errors (Only use when developing)
		if ($this->config->meta->DEBUG == true) {
			return "<h2>SQL Error:</h2>{$this->dbConn->error}";
		} else {
			return "<h2>The request failed</h2>";
		}
	}
}
?>
