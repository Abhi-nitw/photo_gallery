<?php
	// if it's going to need the database , then it's probably smart choice to require it before start .
	require_once(LIB_PATH.DS."database.php"); // to insure load once 

	class Comment extends DatabaseObject{
		protected static $table_name = "comments";
		protected static $db_fields = array('id','photograph_id','created','author','body');

		public $id;
		public $photograph_id;
		public $created;
		public $author;
		public $body;

		public static function make($photo_id , $author="Anonymous" , $body=""){
			//set  local machine time 
			date_default_timezone_set('Asia/Kolkata');
			setlocale(LC_TIME, "C");
			if(!empty($photo_id) && !empty($author) && !empty($body)){
				$comment = new Comment();
				$comment->photograph_id = (int)$photo_id;
				$comment->created = strftime("%Y-%m-%d %H:%M:%S",time());
				$comment->author = $author;
				$comment->body = $body;
				return $comment;
			}else{
				return false;
			}
		}
		public static function find_comments_on($photo_id=0){
			global $database;
			$mysql  = "SELECT * FROM ".self::$table_name;
			$mysql .= " WHERE photograph_id=".$database->escape_value($photo_id);
			$mysql .= " ORDER BY created ASC ";
			return self::find_by_mysql($mysql);
		}
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
		public function delete_comments_by_photo_id($photo_id){
			global $database;
			$mysql  = "DELETE FROM  ".static::$table_name;
			$mysql .= " WHERE photograph_id='".$database->escape_value($photo_id)."'";
			$database->query($mysql);
		}
	}
?>