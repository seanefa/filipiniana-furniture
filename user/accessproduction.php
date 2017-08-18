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
		<title>Filipiniana Furnitures - Production</title>
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
	</head>
	<body>
		<div class="jumbotron-fluid">
			<div class="row">
				<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<!--navbar-->
					<br><br>
					<?php
					include "accessheader.php";
					?>
				</div>
			</div>
		</div>
		<div class="jumbotron-fluid">
			<br>
			<!--account-->
			<hr>
			<h1 class="text-center"><b>FURNITURE PRODUCTION</b></h1>
			<hr>
			<div class="container">
				<div class="row">
					<?php
					include "userconnect.php";
					$sql="SELECT production.*, request.*, product.* from tblproduction as production join tblorder_request as request on production.productionOrderReq = request.order_requestID join tblproduct as product on request.orderProductID = product.productID";
					$result=$conn->query($sql);
					if($result->num_rows>0)
					{
						while($row=$result->fetch_assoc())
						{
					?>
					<div class="col-6 col-sm-4 col-md-3 col-lg-3 col-xl-2">
						<div class="card">
							<img class="card-img-top img-fluid img-thumbnail" src="/admin/plugins/images/<?php echo "" . $row['prodMainPic'];?>">
							<div class="card-block">
								<div class="card-title"><?php echo "" . $row['productName'];?></div>
								<?php echo "" . $row['productionStatus'];?><br>
								<?php echo "" . $row['prodDateStart'];?>
								<?php echo "" . $row['prodDateEnd'];?>
							</div>
						</div>
					</div>
					<?php
						}
					}
					?>
				</div>
			</div>
			<br>
			<!--footer-->
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
						<button onClick="footerToggle()" class="btn text-primary text-center"style="background-color:white;"><i class="fa fa-copyright"></i>&nbsp;Aira and Friends. All rights reserved</button>
					</div>
				</div>
			</div>
-->
			<!--modal-->
			<div class="modal fade" id="signupmodal">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Product Name</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>