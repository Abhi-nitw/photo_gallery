<?php 
	require_once("../../includes/initialize.php");
	if (!$session->is_logged_in()) { redirect_to("login.php");}
?>
<?php 
		if (empty($_GET['comment_id'])) {
			$session->message("No comment ID was provided.");
			redirect_to("list_photos.php");
		}else{
			$comment = Comment::find_by_id($_GET['comment_id']);
			if ($comment && $comment->delete()) {
				$session->message("The comment \"{$comment->body}\" by \"{$comment->author}\" was deleted.");
				redirect_to("comments.php?id={$comment->photograph_id}");
			}else{
				$session->message("The comment could not be deleted.");
				redirect_to("list_photos.php");
			}
		}
?>
<?php if(isset($database)){$database->close_connection();} ?>