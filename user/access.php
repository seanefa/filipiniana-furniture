s<?php
session_start();
if(!isset($_SESSION["userID"]))
{
	header("Location: error.html");
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Filipiniana Furnitures - Home</title>
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
		<!--custom css-->
		<link rel="stylesheet" href="custom.css">
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
		<div class="container">
			<div class="row">
				<!--navbar-->
				<br>
				<nav class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 navbar navbar-toggleable-md fixed-top navbar-inverse bg-inverse">
				 	<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				  	</button>
					<?php
					include "userconnect.php";
					$sql="SELECT * from tblcustomer where customerID='" . $_SESSION["userID"] . "'";
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
								<a class="nav-link" href="accesscustom.php"><i class="fa fa-hand-pointer-o"></i>&nbsp;CUSTOMIZE</a>
					  		</li>
					  		<li class="nav-item">
								<a class="nav-link" href="accessproduction.php"><i class="fa fa-cog fa-spin"></i>&nbsp;PRODUCTION</a>
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
		<!--account-->
		<div class="jumbotron-fluid">
			<hr>
			<h1 class="text-center"><b>PROFILE</b></h1>
			<hr>
		</div>
		<div class="container">
			<div class="row">
				<?php
				include "userconnect.php";
				$sql="SELECT A.*, B.* from tblcustomer A join tbluser B where B.userID = '" . $_SESSION['userID'] . "' AND B.userCustID=A.customerID";
				$result=$conn->query($sql);
				if($result->num_rows > 0)
				{
					while($row=$result->fetch_assoc())
					{
				?>
				<div class="container">
					<div class="row">
						<div class="col-12 col-sm-5 col-md-4 col-lg-3 col-xl-3">
							<div class="card">
								<div class="card-header text-center">
									<h1 class="card-title text-web text-fluid"><?php echo "" . $row["customerFirstName"] . " " . $row['customerLastName'];?></h1>
								</div>
								<img class="card-img-top img-fluid img-thumbnail" src="pics/demitdonald.jpg">
								<ul class="list-group list-group-flush">
									<li class="list-group-item">Lives in <?php echo "" . $row['customerAddress'];?></li>
									<li class="list-group-item"><?php echo "" . $row['customerContactNum'];?></li>
									<li class="list-group-item"><?php echo "" .$row['customerEmail'];?></li>
								</ul>
								<div class="card-block">
									<b>BIO</b>
									<p>Hi I'm friendly pls love me.</p>
								</div>
								<div class="card-footer text-center">
									<a class="btn btn-sm btn-outline-web" href="accessprofilesettings.php"><i class="fa fa-wrench"></i>&nbsp;Settings</a>
								</div>
							</div>
						</div>
						<div class="col-12 col-sm-7 col-md-8 col-lg-9 col-xl-9">
							<br>
							<h3 class="text-center"><strong>My Designs</strong></h3>
							<br>
							<div class="row">
								<div class="col-6 col-sm-4 col-md-3 col-lg-3 col-xl-3">
									<div class="card">
										<div class="card-header">
										</div>
										<img class="card-img-top img-fluid img-thumbnail" src="">
										<div class="card-block">
											<p class="card-text">
											</p>
										</div>
										<div class="card-footer text-center">
											<button role="button" class="btn btn-success" title="View Product"><i class="fa fa-search"></i></button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
					}
				}
				$conn->close();
				?>
			</div>
		</div>
		<br>
<!--
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
-->
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
