<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="image/favicon.ico" rel="icon" />
	<link rel="stylesheet" href="css/myStyle.css">
	<title>Reviews - Filipiniana Furniture Shop</title>
	<meta name="description" content="Furniture shop">
	<script type="text/javascript" src="js/myScript.js"></script>
	<?php include"css.php";?>
</head>
<body style="background: #ffffff;">
	<?php 
	include "header.php";
	if(!isset($_SESSION["userID"]))
	{
		echo "<script>
		window.location.href='login.php';
		alert('You have no access here. You must logged in first.');
		</script>";
	}
	?>
	<div id="container">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="home.php"><i class="fa fa-home"></i></a></li>
				<li><a href="reviews.php">Reviews</a></li>
			</ul>
			<br>
			<div class="row">
				<?php include "accountmenu.php"; ?>
				<!--Middle Part Start-->
				<div class="col-sm-9" id="content">
					<h2>My Reviews</h2>
					<div class="row">
						<div class="col-sm-12">
							<div class="well">
								
							</div>
						</div>
					</div>
				</div>
				<!--Middle Part End -->
			</div>
		</div>
	</div>
	<?php include"footer.php";?>
	<!--img src="pics/userpictures/<?php echo "" . $row["customerDP"];?>" style="height:150px; width:150px;" alt="Product" class="img-responsive profilepic"/-->
	<?php include "scripts.php";?>
</body>
</html>