<?php 
	// if it's going to need the database , then it's probably smart to require it before start .
	require_once(LIB_PATH.DS."database.php"); // to insure load once 
	class DatabaseObject {
		protected static $table_name;
		// common database methods
		public function table_attributes(){
			static::attributes(); 
			//for non-static function , static binding this method
		}
		public function sanitized_attributes(){
			global $database;
			$clean_attributes = array();
			foreach ($this->attributes() as $key => $value) {
				$clean_attributes[$key] = $database->escape_value($value);
			}
			return $clean_attributes;
		}
		public static function find_all(){
			return self::find_by_mysql("SELECT * FROM ".static::$table_name);
			 //static for late static binding
		}
		public static function find_by_id($id=0){
			global $database;
			$result_array = self::find_by_mysql("SELECT * FROM ".static::$table_name." WHERE id =".$database->escape_value($id)."  LIMIT 1 ");
			return !empty($result_array) ? array_shift($result_array) : false ;	
		}
		public static function find_by_mysql($mysql=""){
			global $database;
			$result_set = $database->query($mysql);
			$object_array = array();
			while ($row = $database->fetch_array($result_set)) {
				$object_array[] = self::instantiate($row);
			}
			return $object_array;
		}
		public static function count_all(){
			global $database;
			$mysql = "SELECT count(*) FROM ".static::$table_name;
			$result_set = $database->query($mysql);
			$row = $database->fetch_array($result_set);
			return array_shift($row);
		}
		private static function instantiate($record){
			// could check that $record exists and is an array
			$class_name = get_Called_Class(); //get_Called_Class for late static binding
			$object = new $class_name;
			
			// simple , long-form approach
				// $object->id         =  $record['id'];
				// $object->username   =  $record['username'];
				// $object->password   =  $record['password'];
				// $object->first_name =  $record['first_name'];
				// $object->last_name  =  $record['last_name'];
			// more dynamic , short-form approach
				foreach($record as $attribute => $value) {
					if($object->has_attribute($attribute)){
						$object->$attribute = $value;   
					}
				}
				return $object;
		}
		private function has_attribute($attribute){
			// get_object_vars returns an associated array with all attributes (including private ones)
			$object_vars = get_object_vars($this);
			// we don't want value , we just want to know if key exists or not 
			return array_key_exists($attribute, $object_vars) ;
		}
		public function save(){
			// A new record won't have id
			return (isset($this->id))? $this->update() : $this->create() ;
		}
		public function create(){
			global $database;
			$attributes = $this->sanitized_attributes();
			$mysql  = "INSERT INTO ".static::$table_name." (";
			$mysql .= join(", ",array_keys($attributes));
			$mysql .= ") VALUES ('";
			$mysql .= join("', '",array_values($attributes));
			$mysql .= "')";
			if ($database->query($mysql)) {
				$this->id = $database->insert_id();
				return true;
			} else {
				return false;
			}
		}
		public function update(){
			global $database;
			$attributes = $this->sanitized_attributes();
			$attribute_pairs = array();
			foreach ($attributes as $key => $value) {
				$attribute_pairs[] = "{$key} = '{$value}'" ;
			}
			$mysql  = "UPDATE  ".static::$table_name."  SET ";
			$mysql .= join(", ",$attribute_pairs);
			$mysql .= " WHERE id=".$database->escape_value($this->id);
			$database->query($mysql);
			return ($database->affected_rows()==1) ? true : false ;
		}
		public function delete(){
			global $database;
			$mysql  = "DELETE FROM  ".static::$table_name;
			$mysql .= " WHERE id='".$database->escape_value($this->id)."'";
			$mysql .= " LIMIT 1";
			$database->query($mysql);
			return ($database->affected_rows()==1) ? true : false ;
		}
	}
?>