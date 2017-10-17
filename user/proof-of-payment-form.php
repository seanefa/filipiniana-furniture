<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="image/favicon.ico" rel="icon" />
	<link rel="stylesheet" href="css/myStyle.css">
	<title>Proof of Payment - Filipiniana Furniture Shop</title>
	<meta name="description" content="Furniture shop">
	<script type="text/javascript" src="js/myScript.js"></script>
	<?php include"css.php";?>
	<script>
	$(document).ready(function(){
		$("#orderid").change(function(){
			var val = $("#orderid").val();
			alert(val);
			if(val!=0){
				$("#input-firstname").("disabled",false);
				$("#input-email").("disabled",false);
				$("#input-telephone").("disabled",false);
				$("#input-firstname").("required",true);
				$("#input-email").("required",true);
				$("#input-telephone").("required",true);
				$("#saveBtn").("disabled",false);
			}
			else{
				$("#input-firstname").("disabled",true);
				$("#input-email").("disabled",true);
				$("#input-telephone").("disabled",true);
			}
		});
	});
	</script>
</head>
<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['register'])) { //user registering

    	require 'process-registration.php';
    }
}
?>
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
	else{
		$id = $_SESSION["userID"];
		$_SESSION["ID"] = $id;
	}
	?>
	<div id="container">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="home.php"><i class="fa fa-home"></i></a></li>
				<li><a href="proof-of-payment-form.php">Proof of Payment</a></li>
			</ul>
			<br>
			<div class="row">
				<?php include "accountmenu.php"; ?>
				<!--Middle Part Start-->
				<div class="col-sm-9" id="content">
					<div class="row">
						<div class="col-sm-12">
							<div class="well">
								<?php include "userconnect.php";
								$sql="SELECT * from tbluser a join tblcustomer b WHERE a.userCustID = b.customerID and  a.userID = " . $_SESSION["userID"] . "";
								$result = $conn->query($sql);
								if($result->num_rows>0){
									while($row=$result->fetch_assoc()){
										?>
										<form enctype="multipart/form-data" action="send-proof.php" autocomplete="off" class="form-horizontal" method="post">
											<fieldset>
												<div class="col-md-12">
													<div class="row">
														<div class="table-responsive">          
															<table class="table table-hover table-striped">
																<thead>
																	<tr>
																		<th>Order #</th>
																		<th>Placed On</th>
																		<th>Total</th>
																		<th>Balance</th>
																		<th>Status</th>
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

																	$sqls = "SELECT * FROM tblorders where custOrderID = '$uid' and orderStatus != 'Archived' and orderStatus != 'Finished';";
																	$sresult = mysqli_query($conn,$sqls);


																	while($srow = mysqli_fetch_assoc($sresult)){
																		$orderid = $srow['orderID'];
																		$isql = "SELECT * FROM tblinvoicedetails where invorderID = '$orderid';";
																		$iresult = mysqli_query($conn,$isql);
																		$irow = mysqli_fetch_assoc($iresult);
																		?>

																		<tr>
																			<td style="color:#1A9CB7;"><?php echo $srow['orderID'];?></td>
																			<td><?php echo $srow['dateOfReceived'];?></td>
																			<td>₱ <?php echo $srow['orderPrice'];?></td>
																			<td>₱ <?php echo $irow['balance'];?></td>
																			<td><?php $stat = $srow['orderStatus']; if($stat == 'WFA'){ $stat = "Waiting for Approval"; echo $stat; }else{ echo $stat; };?></td>
																		</tr>

																		<?php
																	}

																	?>

																</tbody>
															</table>
														</div>
													</div>
												</div>
												<legend>Proof of Payment Form&nbsp;<i><small class="text-danger" id="_lblAccountMsg"></small></i></legend>
												<p class="text-success" style="text-align: center;">You can refer to your receipt.</p>
												<div class="form-group required">
													<label for="input-firstname" class="col-sm-2 control-label">Order #</label>
													<div class="col-sm-10 col-md-10 col-lg-10 col-xl-10">
														<select class="form-control" id="orderid" name="orderid">
															<option value="0">Choose an Order</option>
															<?php
															$id = $_SESSION["userID"];

															$usql = "SELECT * FROM tbluser where userID = '$id';";
															$uresult = mysqli_query($conn,$usql);
															$urow = mysqli_fetch_assoc($uresult);

															$uid = $urow['userCustID'];

															//$sqls = "SELECT * FROM tblorders where custOrderID = '$uid' and orderStatus = 'WFP'";
															$sqls = "SELECT * FROM tblorders where orderStatus != 'WFA' AND orderStatus!='Ongoing' AND orderStatus!='Archived' AND orderStatus!='Finished' AND custOrderID = '$uid';";
															//$sqls = "SELECT * FROM tblorders where custOrderID = '$uid'";
															$sresult = mysqli_query($conn,$sqls);


															while($srow = mysqli_fetch_assoc($sresult)){
																?>
																<option value="<?php $srow['orderID']?>"><?php echo "" . $srow["orderID"];?></option>
																<?php
															}

															?>
														</select>
														<!--                  <input type="text" class="form-control" id="input-firstname" placeholder="" value="" name="branchcode" required>-->
													</div>
												</div>
												<div class="form-group required">
													<label for="input-firstname" class="col-sm-2 control-label">Swift Code</label>
													<div class="col-sm-10 col-md-10 col-lg-10 col-xl-10">
														<input type="text" class="form-control" id="input-firstname" placeholder="" value="" name="branchcode" required>
													</div>
												</div>
												<div class="form-group required">
													<label for="input-email" class="col-sm-2 control-label">Amount Paid</label>
													<div class="col-sm-10">
														<input type="number" min="0" class="form-control" id="input-email" placeholder="" name="amountpaid" required>
													</div>
												</div>
												<div class="form-group required">
													<label for="input-telephone" class="col-sm-2 control-label">Date Paid</label>
													<div class="col-sm-10">
														<input type="date" class="form-control" id="input-telephone" value="" name="datepaid" required>
													</div>
												</div>
												<div class="form-group required">
													<label for="input-block" class="col-sm-2 control-label">Photo</label>
													<div class="col-sm-10">
														<input type="file" name="receiptphoto" class="" required/>
													</div>
												</div>
											</fieldset>
											<div style="text-align: center;">
												<a href="account.php" class="btn btn-info">CANCEL</a>
												<input type="submit" class="btn btn-primary" value="SAVE" name="register" id="saveBtn">
											</div>
										</form>
										<?php
									}
								}
								?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--Middle Part End -->
		</div>
	</div>
	<?php include"footer.php";?>
</div>
<!--img src="pics/userpictures/<?php echo "" . $row["customerDP"];?>" style="height:150px; width:150px;" alt="Product" class="img-responsive profilepic"/-->
<?php include "scripts.php";?>
</body>
</html>