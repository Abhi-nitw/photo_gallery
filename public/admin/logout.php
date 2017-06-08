<?php 
	require_once("../../includes/initialize.php");
	if (!$session->is_logged_in()) { 
		redirect_to("login.php");
	}else{
		$message = $_SESSION['username']." logged out.";
		log_action("Logout",$message);
		session_destroy();
		redirect_to("login.php?logout=1");
	}
?>