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
		<title>Production - Filipiniana Furnitures</title>
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
		<script src="myScript.js"></script>
		<link  rel="stylesheet" href="css/custom.css">
		<link rel="stylesheet" href="css/header.css">
		<link rel="stylesheet" href="css/custom.css">
		<link rel="stylesheet" href="css/footer.css">
	</head>
	<body>
					<!--navbar-->
					<?php
					include "accessheader.php";
					?>
		<div class="jumbotron-fluid">
			<!--account-->
			<hr>
			<h1 class="text-center"><b>PRODUCTION</b></h1>
			<hr>
			<div class="container">
				<div class="row">
					<?php
					include "userconnect.php";
					$sql="SELECT production.*, request.*, product.*, orders.*, customer.* from tblproduction as production join tblorder_request as request join tblproduct as product join tblorders as orders join tblcustomer as customer WHERE production.productionOrderReq = request.order_requestID and request.orderProductID = product.productID and request.tblOrdersID = orders.orderID and orders.custOrderID = customer.customerID and customer.customerID = 1";
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
								Started: <?php echo "" . $row['prodStartDate'];?><br>
								Will end: <?php echo "" . $row['prodEndDate'];?>
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
			<?php
			include "accessfooter.php";
			?>
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