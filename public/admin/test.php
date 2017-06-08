<?php 
	require_once("../../includes/initialize.php");
	if (!$session->is_logged_in()) { redirect_to("login.php");}
?>
<?php include_layout_template("admin_header.php"); ?>
<a href="index.php">&laquo;Back </a>
<br>
	<?php 
		// $user = new User();
		// $user->username = "sabhishek";
		// $user->password = "secretpwd";
		// $user->first_name = "abhishek";
		// $user->last_name = "singh";
		// // $user->create();
		// $user->save();


		// $user = User::find_by_id(9);
		// $user->password="testing";
		// $user->first_name = "test";
		// $user->last_name="test";
		// // $user->update();
		// $user->save();

		// $user = User::find_by_id(8);
		// if($user->delete()){
		// 	echo "user_id : ".$user->id ." | username : ".$user->username." was deleted.";
		// }else{
		// 	echo "user couldn't deleted.check user_id ";
		// }
		//though user is deleted but instances has the stored values so we can use them.

	?>
<?php include_layout_template("admin_footer.php"); ?>
