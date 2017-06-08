<?php 
	require_once("../../includes/initialize.php");
	if($session->is_logged_in()) {
  		redirect_to("index.php");
	}
	if (isset($_POST['submit'])) { // Form has been submitted.

		  $username = trim($_POST['username']);
		  $password = trim($_POST['password']);
		  $message = "" ;
		  // Check database to see if username/password exist.
		  $found_user = User::authenticate($username, $password);
		  if ($found_user) {
			    $session->login($found_user);
			    $message=$found_user->username." logged in";
			    log_action("Login",$message);
			    redirect_to("index.php?login=true");
		  } else {
			    // username/password combo was not found in the database
			    $message ="username/password combination incorrect.";
		  }
		  
	} else{ // Form has not been submitted.
		    if (isset($_GET['login'])){
			  $message  = "failed" ;
		    }else{
		  	  $message  = "";
		    }
		  $username = "";
		  $password = "";
	}
	if (isset($_GET['logout']) && $_GET['logout']==1) {
				$message = "You are now logged out.";
	}
?>
<?php include_layout_template("admin_header.php"); ?>
		<h2>Staff Login</h2>
		<?php echo output_message($message); ?>
		<form action="login.php?login=failed" method="post">
		  <table>
		    <tr>
		      <td>Username:</td>
		      <td>
		        <input type="text" name="username" maxlength="30" value="<?php echo htmlentities($username); ?>" />
		      </td>
		    </tr>
		    <tr>
		      <td>Password:</td>
		      <td>
		        <input type="password" name="password" maxlength="30" value="<?php echo htmlentities($password); ?>" />
		      </td>
		    </tr>
		    <tr>
		      <td colspan="2">
		        <input type="submit" name="submit" value="Login" />
		      </td>
		    </tr>
		  </table>
		</form>
    </div>
 <?php include_layout_template("admin_footer.php"); ?>
<?php if(isset($database)) { $database->close_connection(); } ?>