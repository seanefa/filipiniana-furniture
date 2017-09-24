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
					<br>
					<div class="row">
						<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
							<a href="proof-of-payment-form.php"><h4 class="text-center">Proof of Payment</h4></a>
						</div>
					</div>
				</div>
				<br>
			</div>
			<div class="col-12 col-sm-6 col-md-6 col-lg-7 col-xl-8">
				<h1 class="text-center">Proof of Payment Form</h1>
			</div>
		</div>
		 <div class="row">
        <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6" id="content">
          <form enctype="multipart/form-data" action="updatepersonalinformation.php" autocomplete="off" class="form-horizontal" method="post">
            <fieldset id="account">
              <legend>Your Personal Details</legend>
              <div class="form-group required">
                <label for="input-firstname" class="col-sm-2 control-label">Deposited From (Bank Branch)</label>
                <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
                  <input type="text" class="form-control" id="input-firstname" placeholder="First Name" value="<?php echo "" . $row["customerFirstName"];?>" name="fname" required>
                </div>
                <div class="col-sm-3">
                  <input type="text" class="form-control" id="input-middlename" placeholder="Middle Name" value="<?php echo "" . $row["customerMiddleName"];?>" name="mname">
                </div>
                <div class="col-sm-3">
                  <input type="text" class="form-control" id="input-lastname" placeholder="Last Name" value="<?php echo "" . $row["customerLastName"];?>" name="lname" required>
                </div>
              </div>
              <div class="form-group required">
                <label for="input-email" class="col-sm-2 control-label">Amount Paid</label>
                <div class="col-sm-10">
                  <input type="email" class="form-control" id="input-email" placeholder="E-Mail" value="<?php echo "" . $row["customerEmail"];?>" name="email" required>
                </div>
              </div>
              <div class="form-group required">
                <label for="input-telephone" class="col-sm-2 control-label">Date Paid</label>
                <div class="col-sm-10">
                  <input type="tel" class="form-control" id="input-telephone" placeholder="Contact" value="<?php echo "" . $row["customerContactNum"];?>" name="number" required>
                </div>
              </div>
              <div class="form-group required">
                <label for="input-block" class="col-sm-2 control-label">Proof of Payment Picture</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="input-address" placeholder="e.g. #1255 Saint Francis St., Brgy. Parang, Marikina City" value="<?php echo "" . $row["customerAddress"];?>" name="address" required>
                </div>
              </div>
              <div class="form-group required">
                <label for="input-block" class="col-sm-2 control-label">Picture</label>
                <div class="col-sm-10">
                  <input type="file" name="image" class="form-control"/>
					<input type="hidden" name="exist_image" value="<?php echo "" . $row["customerDP"];?>">
                </div>
              </div>
            </fieldset>
            <div class="buttons">
              <div class="pull-right">
                <input type="submit" class="btn btn-primary" value="Save" name="register" id="">
              </div>
            </div>
			</form>
	</div>
	
	<?php include "scripts.php";?>
</body>
</html>