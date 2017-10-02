<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="image/favicon.ico" rel="icon" />
	<link rel="stylesheet" href="css/myStyle.css">
	<title>Address Book - Filipiniana Furniture Shop</title>
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
        		<li><a href="addressbook.php">Address Book</a></li>
			</ul>
			<br>
			<div class="row">
				<?php include "accountmenu.php"; ?>
				<!--Middle Part Start-->
				<div class="col-sm-9" id="content">
					<h2>My Address Book</h2>
					<h5>Default Address</h5>
					<div class="row">
						<div class="col-sm-6">
							<div class="well">
									<h5>Shipping Address
										<div class="pull-right">
											<a href="changeaddress.php"  style="color:#1A9CB7;">EDIT</a>
										</div>
									</h5>
									<hr>
									<?php 
									include "userconnect.php";
									$sql = "SELECT * from tbluser a join tblcustomer b WHERE a.userCustID = b.customerID and  a.userID = " . $_SESSION["userID"] . "";
									$result = $conn->query($sql);
									if($result->num_rows>0)
									{
										while($row=$result->fetch_assoc())
										{
											?>
											<span><?php echo "" . $row["customerFirstName"] . " " . substr($row["customerMiddleName"],0,1)?>.<?php echo "" . " " . $row["customerLastName"];?></span>
											<br>
											<span><?php echo "" . $row["customerAddress"];?></span>
											<br>
											<span><?php echo "" . $row["customerContactNum"];?></span>
											<?php
										}
									}
									$conn->close();
									?>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="well">
									<h5>Billing Address
										<div class="pull-right">
											<a href="changeaddress.php"  style="color:#1A9CB7;">EDIT</a>
										</div>
									</h5>
									<hr>
									<?php 
									include "userconnect.php";
									$sql = "SELECT * from tbluser a join tblcustomer b WHERE a.userCustID = b.customerID and  a.userID = " . $_SESSION["userID"] . "";
									$result = $conn->query($sql);
									if($result->num_rows>0)
									{
										while($row=$result->fetch_assoc())
										{
											?>
											<span><?php echo "" . $row["customerFirstName"] . " " . substr($row["customerMiddleName"],0,1)?>.<?php echo "" . " " . $row["customerLastName"];?></span>
											<br>
											<span><?php echo "" . $row["customerAddress"];?></span>
											<br>
											<span><?php echo "" . $row["customerContactNum"];?></span>
											<?php
										}
									}
									$conn->close();
									?>
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