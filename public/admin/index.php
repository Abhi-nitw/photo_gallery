<?php 
	require_once("../../includes/initialize.php");
	if (!$session->is_logged_in()) { redirect_to("login.php");}
?>
<?php include_layout_template("admin_header.php"); ?>
<?php 
	if(isset($_GET['login'])&&$_GET['login']=='true'){
		echo "<h3 style=\"margin-bottom:0; margin-top:0;\">";
		echo "Welcome Back <b style=\"color:blue;\">'";
		echo  $_SESSION['username']."'</b></h3><br>";
	}else{
		echo "<h3 style=\"margin-bottom:0; margin-top:0;\">";
		echo "Welcome <b style=\"color:blue;\">'";
		echo  $_SESSION['username']."'</b></h3><br>";
	}
?>
<a href="../index.php">&laquo;View public site</a>
	<h2>Menu</h2>
	<?php echo output_message($message); ?>
	<ul>
		<li><a href="logfile.php">view log file</a></li>
		<li><a href="list_photos.php">view uploaded photos</a></li>
		<li><a href="photo_upload.php">upload photo</a></li>
		<li><a href="logout.php">logout</a></li>
	</ul>
<?php include_layout_template("admin_footer.php"); ?>
