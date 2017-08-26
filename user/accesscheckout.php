<?php
session_start();
if(!isset($_SESSION["userID"]))
{
	header("Location: error.html");
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Check out - Filipiniana Furnitures</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="x-ua-compatible" content="ie-edge">
		<link rel="icon" href="pics/filfurniturelogo.png">
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
		<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
		<script src="js/myScript.js"></script>
		<link  rel="stylesheet" href="css/custom.css">
		<link rel="stylesheet" href="css/header.css">
		<link rel="stylesheet" href="css/custom.css">
		<link rel="stylesheet" href="css/footer.css">
	</head>
	<body>
		<?php
		include "accessheader.php";
		?>
		<!--checkout-->
		<div class="jumbotron-fluid">
			<hr>
			<h1 class="text-center"><b>CHECK OUT</b></h1>
			<hr>
		</div>
		<div class="container">
			<form action="accessorder.php" method="post">
				<h6 class="text-center"><b>Order Information</b></h6>
				<br>
				<div class="table-responsive">
					<table id="orderTbl" class="table data-table table-striped table-bordered">
						<thead class="bg-web">
							<tr>
								<th>Product Name</th>
								<th>Dimension</th>
								<th>Quantity</th>
								<th>Price</th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
					<div class="container">
						<div class="row">
							<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
								<label>Order Remarks</label>
								<textarea class="form-control" name="orderremarks"></textarea>
							</div>
							<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
								<label>Pick up/Delivery date</label>
								<input type="date" class="form-control" name="dateofrelease"/>
							</div>
						</div>
					</div>
				</div>
				<br>
				<div class="card-deck">
					<div class="card border-web">
						<div class="card-header bg-web">
							<b>Customer Information</b>
						</div>
						<div class="card-block">
							<?php
							include "userconnect.php";
							$sql="SELECT * from tblcustomer where customerID='" . $_SESSION['userID'] . "'";
							$result=$conn->query($sql);
							if($result->num_rows>0)
							{
								while($row=$result->fetch_assoc())
								{
							?>
							<input type="text" class="form-control" placeholder="First Name" value="<?php echo "" . $row['customerFirstName'];?>" disabled/><br>
							<input type="text" class="form-control" placeholder="Middle Name" value="<?php echo "" . $row['customerMiddleName'];?>" disabled/><br>
							<input type="text" class="form-control" placeholder="Last Name" value="<?php echo "" . $row['customerLastName'];?>" disabled/><br>
							<textarea class="form-control" placeholder="Address" disabled><?php echo "" . $row['customerAddress'];?></textarea><br>
							<input type="text" class="form-control" placeholder="Contact Number" value="<?php echo "" . $row['customerContactNum'];?>" disabled/><br>
							<input type="email" class="form-control" placeholder="Email" value="<?php echo "" . $row['customerEmail'];?>" disabled/><br>
							<?php
								}
							}
							?>
						</div>
					</div>
					<div class="card border-web">
						<div class="card-header bg-web">
							<b>Delivery Information</b>
						</div>
						<div class="card-block text-center	">
							<input id="pickupradiobtn" value="pickup" type="radio" name="deliveryorpickup" checked>Pickup
							&nbsp;<input value="delivery" type="radio" id="deliveryradiobtn" name="deliveryorpickup">Delivery<br><br>
							<input type="text" name="street" id="street" class="form-control" placeholder="Street Address" required/><br>
							<input type="text" name="barangay" id="street" class="form-control" placeholder="Barangay" required/><br>
							<input type="text" name="city" id="city" class="form-control" placeholder="City" required/><br>
							<label><b>Delivery Location</b></label>
							<select class="form-control" id="deliverylocation">
								<option>Philippines</option>
							</select>
							<br>
							<label><b>Delivery Rate</b></label>
							<input type="number" class="form-control" value="0" id="deliveryrates">
						</div>
					</div>
				</div>
				<div class="text-center">
					<input type="submit" class="text-center btn btn-web" value="Save and Print">
				</div>
			</form>
		</div>
		<br>
		<?php
		include "accessfooter.php";
		?>
<!--
			<div class="jumbotron-fluid">
				<div class="row">
					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center">
						<button onClick="footerToggle() "class="btn text-primary text-center"style="background-color:white;"><i class="fa fa-copyright"></i>&nbsp;Marie and Friends. All rights reserved</button>
					</div>
				</div>
			</div>
-->
	</body>
</html>