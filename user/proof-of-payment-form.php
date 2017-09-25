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
					$sql = "SELECT * from tbluser a, tblcustomer b WHERE a.userCustID = b.customerID and  a.userID = " . $_SESSION["userID"] . "";
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
				</div>
				<br>
				<div class="row">
					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">
						<a href="customize.php"><button class="btn btn-success"><h6 style="color:white;">Customization</h6></button></a>&nbsp;
						<a href="profile.php"><button class="btn btn-warning"><h6 style="color:white;">Order Information</h6></button></a>&nbsp;
						<a href="production.php"><button class="btn btn-sky"><h6 style="color:white;">Production Information</h6></button></a>
					</div>
				</div>
			</div>
			<div class="col-12 col-sm-6 col-md-6 col-lg-7 col-xl-8">
				<h1 class="text-center">Proof of Payment Form</h1> 
				<div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" id="content">
          <form enctype="multipart/form-data" action="send-proof.php" autocomplete="off" class="form-horizontal" method="post">
            <fieldset id="account">
              <legend class="text-success">You can refer to your receipt.</legend>
              <div class="form-group required">
                <label for="input-firstname" class="col-sm-2 control-label">Order #</label>
                <div class="col-sm-10 col-md-10 col-lg-10 col-xl-10">
					<select class="form-control" name="orderid">
						<option disabled>Choose Order</option>
					<?php
					include "userconnect.php";
					$orders = "SELECT * from tblorders";
					$result = $conn->query($orders);
					if($result->num_rows>0){
						while($row=$result->fetch_assoc()){
							?>
						<option><?php echo "" . $row["orderID"];?></option>
						<?php
						}
					}
					$conn->close();
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
                  <input type="text" class="form-control" id="input-email" placeholder="" name="amountpaid" required>
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
            <div class="buttons">
              <div class="pull-right">
                <input type="submit" class="btn btn-primary" value="Save" name="register">
              </div>
            </div>
			</form>
			 </div>
				</div>
			</div>
		</div>
	</div>
	<?php include "scripts.php";?>
</body>
</html>