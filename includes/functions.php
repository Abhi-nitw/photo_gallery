<?php 
	function redirect_to($location=NULL){
		if($location!=NULL){
			header("Location:{$location}");
			exit();
		}
	}
	function strip_zeros_from_date($marked_string=""){
		// first remove the marked zeros
		$no_zeros = str_replace('*0', '', $marked_string);
		// then remove any remaining marks
		$cleaned_string = str_replace('*', '', $no_zeros);
		return $cleaned_string;
	}
	function output_message($message=""){
		if (!empty($message)) {
			echo "<p class = \"message\">{$message}</p>";
		}else {
			return "";
		}
	}
	function __autoload($class_name){
		$class_name = strtolower($class_name);
		$path = LIB_PATH.DS."{$class_name}.php";
		if(file_exists($path)){
			require_once($path);
		}else{
			die("The file {$class_name}.php counld not found . <br>");
		}
	}
	function include_layout_template($template=""){
		include(SITE_ROOT.DS.'public'.DS.'layouts'.DS.$template);
	}
	function log_action($action,$message=""){
		$logfile = SITE_ROOT.DS."logs".DS."log.txt";
		date_default_timezone_set('Asia/Kolkata');
		setlocale(LC_TIME, "C");
		if ($handle = fopen($logfile , 'a')) {//append
				$timestamp = strftime("%Y-%m-%d %H:%M:%S",time());
				$content =  $timestamp." | ".$action." : ".$message."\n";
				fwrite($handle,$content);
				fclose($handle);
		}else{
			echo "Could open log file for writting .";
		}
	}
	function datetime_to_text($datetime="") {
		  $unixdatetime = strtotime($datetime);
		  return strftime("%B %d, %Y at %I:%M %p", $unixdatetime);
	}
?>
