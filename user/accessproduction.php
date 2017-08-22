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
		<?php
		include "plugins.php";
		?>
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
					<div class="col-6 col-sm-4 col-md-3 col-lg-3 col-xl-3">
						<div class="card">
							<img class="card-img-top img-fluid img-thumbnail" src="/admin/plugins/images/<?php echo "" . $row['prodMainPic'];?>">
							<div class="card-block text-center">
								<div class="card-title"><h4><b><?php echo "" . $row['productName'];?></b></h4></div>
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