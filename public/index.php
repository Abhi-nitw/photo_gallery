<?php require_once("../includes/initialize.php");?>
<?php 
	// 1.current page no : 
	$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;
	$_SESSION['page']=$page;//so that we can go back to same page
	// 2.records per page :
	$per_page = 10;
	// 3.total record count : 
	$total_count = Photograph::count_all();

	// Find all the photos 
	// use pagination instead
	// $photos = Photograph::find_all();

	$pagination = new Pagination($page,$per_page,$total_count);
	//instead of finding all records , just find for this page
	$mysql  = "SELECT * FROM photographs ";
	$mysql .= "LIMIT {$per_page} ";
	$mysql .= "OFFSET {$pagination->offset()} ";
	$photos = Photograph::find_by_mysql($mysql);

?>
<?php include_layout_template("header.php");?>
<?php 
	if (!isset($page)||$page==1) {
		echo "<a href=\"admin/index.php\">&laquo;View admin site</a>";
	}else{
		echo "<a href=\"index.php\">&laquo;Back to main page</a>";
	}

?>
<!-- <a href="admin/index.php">&laquo;View admin site</a> -->
<hr>
<?php //display the messages//echo output_message($message); ?>
<?php foreach ($photos as $photo) : ?>
	<div style="float: left;margin: 20px;">
		<a href="photo.php?id=<?php echo $photo->id; ?>">
			<img src="<?php echo $photo->image_path(); ?>" width="200" height="150">
		</a>
		<p><?php echo $photo->caption; ?></p>
	</div>
<?php endforeach; ?>
<div id="pagination" style="clear: both;">
	<?php 
		if ($pagination->total_pages()>1) {
			if ($pagination->has_previous_page()) {
				echo "<a href=\"index.php?page=".$pagination->previous_page()."\">";
				echo "&laquo; Previous</a>";
			}
			for($i=1; $i<=$pagination->total_pages(); $i++){
				if($i==$page){
					echo "&nbsp;<span class=\"selected\">{$i}</span>&nbsp;";
				}else{
					echo "&nbsp;<a href=\"index.php?page={$i}\">{$i}</a>&nbsp;";
				}
			}
			// echo "&nbsp;";
			if ($pagination->has_next_page()) {
				echo "<a href=\"index.php?page=".$pagination->next_page()."\">";
				echo "Next &raquo;</a>";
			}
		}

	?>
</div>
<?php include_layout_template("footer.php");?>