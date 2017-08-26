<?php
session_start();
if(!isset($_SESSION['userID']))
{
	header("Location: error.html");
}
?>
<!DOCTYPE html>

<html>
	<head>
		<title>Profile - Filipiniana Furnitures</title>
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
		<!--settings-->
		<div class="jumbotron-fluid">
			<hr>
			<h1 class="text-center"><b>SETTINGS</b></h1>
			<hr>
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<div class="card-deck">
							<div class="card border-web">
								<div class="card-header text-center">
									<h3>Account</h3>
								</div>
								<?php
								include "userconnect.php";
								$sql="SELECT * from tbluser where userID='" . $_SESSION["userID"] . "'";
								$result=$conn->query($sql);
								if($result->num_rows>0)
								{
									while($row=$result->fetch_assoc())
									{
								?>
								<div class="card-block text-center">
									<form action="accessupdateaccountinfo.php" method="post">
										<label class="text-center"><b>Change Username/Password</b></label><br>
										<input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo "" . $row["userName"];?>"><br>
										<input type="password" name="oldpass" class="form-control" placeholder="Old Password"><br>
										<input type="password" name="newpass" class="form-control" placeholder="New Password"><br>
										<input type="password" name="conpass" class="form-control" placeholder="Confirm Password"><br>
										<button type="submit" class="btn btn-outline-web">Save</button>
									</form>
								</div>
								<?php
									}
								}
								$conn->close();
								?>
							</div>
							<div class="card border-web">
								<div class="card-header text-center">
									<h3>Information</h3>
								</div>
								<div class="card-block">
								<?php
								include "userconnect.php";
								$sql=$conn->query("SELECT * from tblcustomer where customerID =" .$_SESSION['userID']);
								if($sql->num_rows>0)
								{
								while($row=$sql->fetch_assoc())
								{
								?>
									<form action="accessupdateprofileinfo.php" method="post">
										<div class="form-group row">
											<label for="inputFirstName" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-form-label">First Name:</label>
											<div class="col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<input type="text" class="form-control" name="fname" placeholder="First Name" value="<?php echo "" .$row['customerFirstName'];?>"><br>
											</div>
										</div>
										<div class="form-group row">
											<label for="inputMidName" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-form-label">Middle Name:</label>
											<div class="col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<input type="text" class="form-control" name="mname" placeholder="Middle Name" value="<?php echo "" .$row['customerMiddleName'];?>"><br>
											</div>
										</div>
										<div class="form-group row">
											<label for="inputLastName" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-form-label">Last Name:</label>
											<div class="col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<input type="text" class="form-control" name="lname" placeholder="Last Name" value="<?php echo "" . $row['customerLastName'];?>"><br>
											</div>
										</div>
										<div class="form-group row">
											<label for="inputAddress" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-form-label">Address:</label>
											<div class="col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<textarea type="text" class="form-control" name="address" placeholder="Address"><?php echo "" .$row['customerAddress'];?></textarea>
											</div>
										</div>
										<div class="form-group row">
											<label for="inputContact" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-form-label">Contact Number:</label>
											<div class="col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<input type="text" class="form-control" name="contact" placeholder="Contact Number" value="<?php echo "" .$row['customerContactNum'];?>"><br>
											</div>
										</div>
										<div class="form-group row">
											<label for="inputEmail" class="col-sm-4 col-md-4 col-lg-4 col-xl-4 col-form-label">Email:</label>
											<div class="col-sm-8 col-md-8 col-lg-8 col-xl-8">
												<input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo "" .$row['customerEmail'];?>"><br>
											</div>
										</div>
										<div class="form-group text-center">
											<button type="submit" class="btn btn-outline-web">Save</button>
										</div>
									</form>
								<?php
									}
								}
								$conn->close();
								?>
								</div>
							</div>
						</div>
					</div>
        </div>
			</div>
		</div>
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
