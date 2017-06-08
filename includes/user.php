<?php 
	// if it's going to need the database , then it's probably smart to require it before start .
	require_once(LIB_PATH.DS."database.php"); // to insure load once 
	class User extends DatabaseObject{
		protected static $table_name = "users";
		protected static $db_fields = array('id','username','password','first_name','last_name');
		public $id;
		public $username;
		public $password;
		public $first_name;
		public $last_name;
		public function attributes(){
			// return an array of attribute names and their values
			$attributes=array();
			foreach ( self::$db_fields as $field) {
				if (property_exists($this, $field)) {
					$attributes[$field] = $this->$field;
				}
			}
			return $attributes;
		}
		public static function authenticate($username="", $password="") {
		    global $database;
		    $username = $database->escape_value($username);
		    $password = $database->escape_value($password);

		    $mysql  = "SELECT * FROM users ";
		    $mysql .= "WHERE username = '{$username}' ";
		    $mysql .= "AND password = '{$password}' ";
		    $mysql .= "LIMIT 1";
		    $result_array = self::find_by_mysql($mysql);
				return !empty($result_array) ? array_shift($result_array) : false;
		}
		public function full_name(){
			if (isset($this->first_name) && isset($this->last_name)) {
				return $this->first_name." ".$this->last_name ;
			}else {
				return "";
			}
		}
	}
?>