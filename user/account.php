<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="image/favicon.ico" rel="icon" />
	<link rel="stylesheet" href="css/myStyle.css">
	<title>My Account - Filipiniana Furniture Shop</title>
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

	include 'toastr-buttons.php';

	if (!empty($_SESSION['createSuccess'])) {
		echo  '<script>
		$(document).ready(function () {
			$("#toastNewSuccess").click();
		});
</script>';
unset($_SESSION['createSuccess']);
}
if (!empty($_SESSION['updateSuccess'])) {
	echo  '<script>
	$(document).ready(function () {
		$("#toastUpdateSuccess").click();
	});
</script>';
unset($_SESSION['updateSuccess']);
}
if (!empty($_SESSION['deactivateSuccess'])) {
	echo  '<script>
	$(document).ready(function () {
		$("#toastDeactivateSuccess").click();
	});
</script>';
unset($_SESSION['deactivateSuccess']);
}
if (!empty($_SESSION['reactivateSuccess'])) {
	echo  '<script>
	$(document).ready(function () {
		$("#toastReactivateSuccess").click();
	});
</script>';
unset($_SESSION['reactivateSuccess']);
}
if (!empty($_SESSION['actionFailed'])) {
	echo  '<script>
	$(document).ready(function () {
		$("#toastFailed").click();
	});
</script>';
unset($_SESSION['actionFailed']);
}
?>
<div id="container">
	<div class="container">
		<ul class="breadcrumb">
			<li><a href="home.php"><i class="fa fa-home"></i></a></li>
			<li><a href="account.php">My Account</a></li>
		</ul>
		<br>
		<div class="row">
			<?php include "accountmenu.php"; ?>
			<!--Middle Part Start-->
			<div class="col-sm-9" id="content">
				<h2>Account Dashboard</h2>
				<div class="row">
					<div class="col-sm-4">
						<div class="well">
							<h5>Personal Information
								<div class="pull-right">
									<a href="updateinfo.php" style="color:#1A9CB7;">EDIT</a>
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
									<span><?php echo "" . $row["customerEmail"];?></span>
									<br><br>
									<span>Newsletter Subscription</span>
									<br><br>
									<a href="changemail.php" style="color:#1A9CB7;">CHANGE EMAIL</a><br>
									<a href="changeaccountinformation.php" style="color:#1A9CB7;">CHANGE USERNAME & PASSWORD</a>
									<?php
								}
							}
							$conn->close();
							?>
						</div>
					</div>

					<div class="col-sm-4">
						<div class="well">
							<h5>Default Shipping Address
								<div class="pull-right">
									<a href="changeaddress.php" style="color:#1A9CB7;">EDIT</a>
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

					<div class="col-sm-4">
						<div class="well">
							<h5>Default Billing Address
								<div class="pull-right">
									<a href="changeaddress.php" style="color:#1A9CB7;">EDIT</a>
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
				<hr>
				<h2>Recent Orders</h2>
				<br>
				<h6><a href="production.php" style="color:#1A9CB7;">VIEW PRODUCTION DETAILS</a></h6>
				<div class="col-md-12">
					<div class="row">
						<div class="table-responsive">
							<table class="table table-hover table-striped">
								<thead>
									<tr>
										<th>Order #</th>
										<th>Placed On</th>
										<th>Total</th>
										<th>Status</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php

									include "userconnect.php";
									$id = $_SESSION["userID"];

									$usql = "SELECT * FROM tbluser where userID = '$id';";
									$uresult = mysqli_query($conn,$usql);
									$urow = mysqli_fetch_assoc($uresult);

									$uid = $urow['userCustID'];

									$sqls = "SELECT * FROM tblorders where custOrderID = '$uid';";
									$sresult = mysqli_query($conn,$sqls);


									while($srow = mysqli_fetch_assoc($sresult)){
										$rid = str_pad($srow['orderID'], 6, '0', STR_PAD_LEFT);
										$oid = $srow['orderID'];

										?>

										<tr>
											<td style="color:#1A9CB7;"><?php echo $rid;?></td>
											<td><?php echo $srow['dateOfReceived'];?></td>
											<td>₱ <?php echo $srow['orderPrice'];?></td>
											<td><?php
											$stat = $srow['orderStatus'];
											if($stat == 'WFA'){
												$stat = "Waiting for Approval";
												echo $stat;
											}
											else if($stat == 'WFP')
											{
												$stat = "Waiting for Payment";
											}
											echo $stat;?></td>
											<?php if($srow['orderStatus'] != 'WFA'){
												?>
												<td></td>
											</tr>

											<?php
										}
										else
										{
											echo '<td><a href="cancel-ordReq.php?id='.$oid.'" class="pull-right" style="color:#1A9CB7;">Cancel Request</a></td>';
										}
									}

									?>

								</tbody>
							</table>
						</div>
					</div>
				</div>
				<h2>Customized Product Request</h2>
				<br>
				<div class="col-md-12">

					<div class="row">
						<div class="table-responsive">
							<table class="table table-hover table-striped">
								<thead>
									<tr>
										<th>Request #</th>
										<th>Placed On</th>
										<th>Status</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php

									include "userconnect.php";
									$id = $_SESSION["userID"];

									$usql = "SELECT * FROM tbluser where userID = '$id';";
									$uresult = mysqli_query($conn,$usql);
									$urow = mysqli_fetch_assoc($uresult);

									$uid = $urow["userCustID"];

									$sqls = "SELECT * FROM tblcustomize_request where tblcustomerID = '$uid';";
									$sresult = mysqli_query($conn,$sqls);


									while($srow = mysqli_fetch_assoc($sresult)){
										$rid = str_pad($srow['customizedID'], 6, '0', STR_PAD_LEFT);
										$cid = $srow['customizedID'];
										?>

										<tr>
											<td style="color:#1A9CB7;"><?php echo $rid;?></td>
											<td><?php echo $srow['dateRequest'];?></td>
											<td><?php
											$stat = $srow['customStatus'];

											if($stat == 'WFA')
											{
												$stat = "Waiting for Approval";
											}
											else if($stat == 'WFP')
											{
												$stat = "Waiting for Payment";
											}
											echo $stat;?></td>
											<?php
											if($srow['customStatus'] != 'WFA'){
												?>
												<!-- <td><a href="" class="pull-right" style="color:#1A9CB7;">Cancel Order</a></td> -->
											</tr>
											<?php
										}
										else
										{
											echo '<td><a href="cancel-custom.php?id='.$cid.'" class="pull-right" style="color:#1A9CB7;">Cancel Request</a></td>';
										}
									}

									?>

								</tbody>
							</table>
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
<div id="myModal" class="modal fade" role="dialog " aria-hidden="true" style="display: none;" tabindex="-1">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<!-- Modal content -->
			<div class="modal-content clearable-content">
				<div class="modal-body">

				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>
