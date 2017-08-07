<?php
include "dbconnect.php";
$sql = "SELECT * FROM tblcompany_info";
$res = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($res);
?>
<html>
<head>
  <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
<head>
<div style="text-align:center">
<div class="pull-left">
	<img height="115px" src="plugins/images/<?php echo $row['prodMainPic'];?>"/>
</div>
<div class="pull-left">
<h1 style="text-align:center"> <?php echo $row['comp_name'];?> </h1>
<h5 style="text-align:center"><?php echo $row['comp_address'];?></h5>
<h5 style="text-align:center"><?php echo $row['comp_num'];?></h5>
</div>
</div>
<br><br>
</html>