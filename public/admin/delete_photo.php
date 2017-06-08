<?php 
	require_once("../../includes/initialize.php");
	if (!$session->is_logged_in()) { redirect_to("login.php");}
?>
<?php 
	if (empty($_GET['id'])) {
		$session->message("No photograph ID was provided.");
		redirect_to("index.php");
	}
	$photo = Photograph::find_by_id($_GET['id']);
	if ($photo && $photo->destroy()) {
			$session->message("The photo was deleted.");
			global $database;
			Comment::delete_comments_by_photo_id($photo->id);
			if($database->affected_rows()){
				$session->message("The photo and it's associated comments has been deleted.");
				redirect_to("list_photos.php");
			}else{
				$session->message("The photo was deleted.");
				redirect_to("list_photos.php");
			}
		}else{
			$session->message("The photo could not be deleted.");
			redirect_to("list_photos.php");
		}
?>
<?php if(isset($database)){$database->close_connection();} ?>