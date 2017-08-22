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
		<title>Profile - Filipiniana Furnitures</title>
		<?php
		include "plugins.php";
		?>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<!--navbar-->
				<br><br><br>
				<?php
				include "accessheader.php";
				?>
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
									<h3 class="card-title text-web text-fluid"><?php echo "" . $row["customerFirstName"] . " " . $row['customerLastName'];?></h3>
								</div>
								<ul class="list-group list-group-flush text-center">
									<li class="list-group-item">Lives in <?php echo "" . $row['customerAddress'];?></li>
								</ul>
								<div class="card-footer text-center">
									<a class="btn btn-sm btn-outline-web" href="accessprofilesettings.php"><i class="fa fa-wrench"></i>&nbsp;Settings</a>
								</div>
							</div>
						</div>
						<div class="col-12 col-sm-7 col-md-8 col-lg-9 col-xl-9">
							<br>
							<h3 class="text-center"><strong>Recently Ordered Products</strong></h3>
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
