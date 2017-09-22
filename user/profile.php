<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="image/favicon.ico" rel="icon" />
	<link rel="stylesheet" href="css/myStyle.css">
	<title>Profile - Filipiniana Furniture Shop</title>
	<meta name="description" content="Furniture shop">
	<script type="text/javascript" src="js/myScript.js"></script>
	<?php include"css.php";?>
</head>
<body style="background: #fff;">
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
	<br>
	<div class="breadcrumbs">
	</div>
	<div class="container">
		<div class="row">
			<div class="col-12 col-sm-6 col-md-6 col-lg-5 col-xl-4">
				<br>
				<div class="profilethumb">
					<?php 
					include "userconnect.php";
					$sql = "SELECT * from tbluser as user join tblcustomer as customer where userID = " . $_SESSION["userID"] . "";
					$result = $conn->query($sql);
					if($result->num_rows>0)
					{
						while($row=$result->fetch_assoc())
						{
					?>
					<div class="row">
						<div class="col-12 col-sm-12 col-md-5 col-lg-5 col-xl-5">
							<img src="pics/userpictures/<?php echo "" . $row["customerDP"];?>" style="height:150px; width:150px;" alt="Product" class="img-responsive profilepic"/>
						</div>
						<div class="col-12 col-sm-12 col-md-7 col-lg-7 col-xl-7">
							<div class="info text-center">
								<h4><?php echo "" . $row["customerLastName"] . ", " . $row["customerFirstName"] . " " . substr($row["customerMiddleName"], 0, 1);?>.</h4>
								<h6><?php echo "" . $row["customerAddress"];?></h6>
								<ul class="text-left">
									<li><?php echo "" . $row["customerEmail"];?></li>
									<li><?php echo "" . $row["customerContactNum"];?></li>
								</ul>
								<a href="updateinfo.php"><button class="btn btn-primary">Update</button></a>
							</div>
						</div>
					</div>
					<?php
						}
					}
					$conn->close();
					?>
					<br>
					<div class="row">
						<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
							<h4 class="text-center">Proof of Payment</h4>
						</div>
					</div>
				</div>
				<br>
			</div>
			<div class="col-12 col-sm-6 col-md-6 col-lg-7 col-xl-8">
				<h1 class="text-center">Order Information</h1>
			</div>
		</div>
	</div>
	<?php include "scripts.php";?>
</body>
</html>