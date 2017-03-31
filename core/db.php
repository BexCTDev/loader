<?php // Version : 1.0 ?>
<?php
require_once "loader.php";
class DB extends Loader {
	public function __construct() {
			$this->user = DB_USERNAME;
			$this->password = DB_PASSWORD;
			$this->host = DB_HOSTNAME;
			$this->log_file = LOADER_LOGS . '/loader.log';
	}
	public function connect($database = false) {
		if($database){
			$conn = new mysqli($this->host, $this->user, $this->password, $database);
		} else {
			$conn = new mysqli($this->host, $this->user, $this->password );
		}
		if ($conn->connect_error)
		{	
			$error['error'] = $conn->connect_error; 
			return $error;
		}
		return $conn;
	}
	public function query($query, $database = false) {
		$db = @$this->connect($database);
		if(!is_array($db)){
			$result = @$db->query($query);
			if($result) {
				return $result;
			} else {
				$message = $this->write_log('danger', 'SQL query failed : ' . $query . ' | ' .$db->error);
				return $message;
			}
		} else {
			$message = $this->write_log('danger', 'Failed to Connect to MySQL : ' . $db['error']);
			return $message;
		}
	}
}