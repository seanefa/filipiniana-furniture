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
		<title>Filipiniana Furnitures - Accounts</title>
		<!--meta tags-->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="x-ua-compatible" content="ie-edge">
		<!--bootstrap 4-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
		<!--custom css-->
		<link rel="stylesheet" href="custom.css">
		<!--scripts-->
		<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
		<!--google icons-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<!--font awesome icons-->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<!--my css-->
		<link rel="stylesheet" href="myStyle.css">
		<!--javascript-->
		<script src="myScript.js"></script>
		<link rel="icon" href="pics/filfurniturelogo.png">
	</head>
	<body>
		<div class="jumbotron-fluid">
			<div class="row">
				<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<!--navbar-->
					<br><br>
					<nav class="navbar navbar-toggleable-md fixed-top navbar-inverse bg-inverse">
					 	<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					  	</button>
						<?php
						include "userconnect.php";
						$sql="SELECT * from tblcompany_info";
						$result=$conn->query($sql);
						if($result->num_rows>0)
						{
							while($row=$result->fetch_assoc())
							{
						?>
						<a class="navbar-brand" href="access.php"><?php echo "" . $row['comp_name'];?></a>
						<?php
							}
						}
						$conn->close();
						?>
					  	<div class="collapse navbar-collapse" id="navbarSupportedContent">
							<ul class="navbar-nav mr-auto">
						  		<li class="nav-item active">
									<a class="nav-link" href="access.php"><i class="fa fa-user-circle-o"></i>&nbsp;ACCOUNT <span class="sr-only">(current)</span></a>
						  		</li>
						  		<li class="nav-item">
									<a class="nav-link" href="accessproducts.php"><i class="fa fa-bed"></i>&nbsp;PRODUCTS</a>
						  		</li>
						  		<li class="nav-item">
									<a class="nav-link" href="accesscustomization.php"><i class="fa fa-hand-pointer-o"></i>&nbsp;CUSTOMIZE</a>
						  		</li>
						  		<li class="nav-item">
									<a class="nav-link" href="accessaccessproduction.php"><i class="fa fa-cog fa-spin"></i>&nbsp;PRODUCTION</a>
						  		</li>
							</ul>
							<!-- Right Side Of Navbar -->
		          			<ul class="nav navbar-nav navbar-right">
								<li clas="nav-item">
									<a class="btn btn-outline-danger" href="userlogout.php" title="Log out"><i class="fa fa-sign-out"></i></a>
								</li>
		        			</ul>
					  	</div>
					</nav>
				</div>
			</div>
		</div>
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
									<h3>Display</h3>
								</div>
								<div class="card-block">
									<img class="img-fluid img-thumbnail text-center" alt="Display Picture" src="pics/demitdonald.jpg"><br>
									<form class="form-group text-center" action="update.php" method="post">
										<input type="file" class="form-control"><br>
										<textarea type="text" class="form-control" placeholder="update BIO..."></textarea><br>
										<button type="submit" class="btn btn-outline-web">Save</button>
									</form>
								</div>
							</div>
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
		<br>
		<footer class="jumbotron-fluid footer">
			<div class="row">
				<?php
				include "userconnect.php";
				$sql="SELECT * from tblcompany_info";
				$result=$conn->query($sql);
				if($result->num_rows>0)
				{
					while($row=$result->fetch_assoc())
					{
				?>
				<div class="col-md-3 col-lg-3 col-xl-3">
					<h3><b>Navigation Links</b></h3>
					<hr>
					<ul>
						<li><a href="#" class="btn btn-web">Home</a></li>
						<li><a href="#" class="btn btn-web">Products</a></li>
						<li><a href="#" class="btn btn-web">User Manual</a></li>
					</ul>
				</div>
				<div class="col-md-5 col-lg-5 col-xl-5">
					<h3 class="text-center"><b>About</b></h3>
					<hr>
					<p class="text-justify"><?php echo "" . $row['comp_about'];?></p>
				</div>
				<div class="col-md-4 col-lg-4 col-xl-4">
					<h3 class="text-center"><b>Additional Infos</b></h3>
					<hr>
					<div class="row">
						<div class="col-md-12 col-lg-12 col-xl-12 text-center">
							<b>Visit Us</b>
							<br>
							<?php echo "" . $row['comp_address'];?><br>
						</div>
					</div>
					<hr>
					<div class="row text-center">
						<div class="col-md-6 col-lg-6 col-xl-6">
							<b>Contact</b>
							<br>
							<?php echo "" . $row['comp_num'];?><br>
						</div>
						<div class="col-md-6 col-lg-6 col-xl-6">
							<b>Email</b>
							<br>
							<?php echo "" . $row['comp_email'];?><br>
						</div>
					</div>
				</div>
				<?php
					}
				}
				$conn->close();
				?>
			</div>
		</footer>
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
