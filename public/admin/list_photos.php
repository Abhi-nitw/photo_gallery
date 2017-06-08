<?php 
	require_once("../../includes/initialize.php");
	if (!$session->is_logged_in()) { redirect_to("login.php");}
?>
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
<?php include_layout_template('admin_header.php'); ?>
<?php 
  if (!isset($page)||$page==1) {
    echo "<h3 style=\"margin-bottom:0; margin-top:0;\">";
    echo "You are now in list photos area <b style=\"color:blue;\">'";
    echo $_SESSION['username']."'</b></h3><br>";
    echo "<a href=\"index.php\">&laquo;view home page</a>"; //public index.php
  }else{
    echo "<a href=\"list_photos.php\">&laquo;Back to main page</a>";
  }

?>
<h2>Photographs</h2>
<?php echo output_message($message); ?>
<table class="bordered">
  <tr>
    <th>Image</th>
    <th>Filename</th>
    <th>Caption</th>
    <th>Size</th>
    <th>Type</th>
    <th>comments</th>
    <th>&nbsp;</th>
  </tr>
<?php foreach($photos as $photo): ?>
  <tr>
    <td><a  href="/photo_gallery/public/images/<?php echo $photo->filename; ?>" target="_blank">
    	<img src="../<?php echo $photo->image_path();?>" width="100"/></a>
    </td>
    <td><?php echo $photo->filename; ?></td>
    <td><?php echo $photo->caption; ?></td>
    <td><?php echo $photo->size_as_text(); ?></td>
    <td><?php echo $photo->type; ?></td>
    <td><a href="comments.php?id=<?php echo $photo->id; ?>"><?php echo count($photo->comments()) ;?></a></td>
    <td><a href="delete_photo.php?id=<?php echo $photo->id; ?>">Delete</a></td>
  </tr>
<?php endforeach; ?>
</table>
<br />
<div id="pagination" style="clear: both;">
  <?php 
    if ($pagination->total_pages()>1) {
      if ($pagination->has_previous_page()) {
        echo "<a href=\"list_photos.php?page=".$pagination->previous_page()."\">";
        echo "&laquo; Previous</a>";
      }
      for($i=1; $i<=$pagination->total_pages(); $i++){
        if($i==$page){
          echo "&nbsp;<span class=\"selected\">{$i}</span>&nbsp;";
        }else{
          echo "&nbsp;<a href=\"list_photos.php?page={$i}\">{$i}</a>&nbsp;";
        }
      }
      // echo "&nbsp;";
      if ($pagination->has_next_page()) {
        echo "<a href=\"list_photos.php?page=".$pagination->next_page()."\">";
        echo "Next &raquo;</a>";
      }
    }

  ?>
</div>
<br>
<a href="photo_upload.php">Upload a new photograph</a>
<?php include_layout_template("admin_footer.php"); ?>
