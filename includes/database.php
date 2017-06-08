<?php 
	// making this file to work with any kind of database i.e. oracle etc 
	// just use methods for that database no big changes in any other files only change in this file
	//  will set our site .
	require_once(LIB_PATH.DS."config.php");
	class MysqlDatabase {
		private $connection;
		public $last_query;
		private $magic_quote_active;
		private $real_escape_string_exists;
		function __construct(){
			$this->open_connection();
			$this->magic_quote_active=get_magic_quotes_gpc();
			$this->real_escape_string_exists=function_exists("mysqli_real_escape_string");
		}
		public function open_connection(){
			$this->connection=mysqli_connect("localhost","gallery","Abhi@8801");
			if (!$this->connection) {
					die("DataBase connection failed: ".mysqli_connect_error());
			}else{
				$db_select=mysqli_select_db($this->connection,"photo_gallery");
				if (!$db_select) {
					die("DataBase selection failed: ".mysqli_error($this->connection));
				}
			}
		}
		public function close_connection(){
			if (isset($this->connection)) {
				mysqli_close($this->connection);
				unset($this->connection);
		}
		}
		public function query($mysql){
			$this->last_query = $mysql ;
			$result = mysqli_query($this->connection,$mysql);
			$this->confirm_query($result);
			return $result;
		}	
		public function escape_value($value){
			if ($this->real_escape_string_exists) {//PHP v4.3.0 or higher
				//undo any magic quote effects so mysql_real_escape_string can do the work
				if ($this->magic_quote_active) {$value=stripslashes($value);}
				$value=mysqli_real_escape_string($this->connection,$value);
			} else {//before PHP v4.3.0
				//if magic quotes aren't already on then add slashes manually
				if (!$this->magic_quote_active) {$value=addslashes($value);}
				//if magic quotes are active ,the slashes are already exist	
			}
			return $value;
		}
		// "Database neutral" methods
		public function fetch_array($result_set){
			return mysqli_fetch_array($result_set);
		}	
		public function num_rows($result_set){
			return mysqli_num_rows($result_set);
		}
		public function insert_id(){
			//get the last id inserted over current db connection
			return mysqli_insert_id($this->connection);
		}
		public function affected_rows(){
			return mysqli_affected_rows($this->connection) ;
		}
		private function confirm_query($result){
			if (!$result) {
				$output = "DataBase query failed  : " . mysqli_error($this->connection) ."<br>";
				$output.= "Last Mysql query : ".$this->last_query;
				die($output);
			}	
		}

	}



	$database = new MysqlDatabase();

?>