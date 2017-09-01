<!DOCTYPE html>
<html>
	<head>
		<title>Products - Filipiniana Furnitures</title>
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
		<link rel="stylesheet" href="css/hoverv2.css">
	</head>
	<body>
		<!--navbar-->
		<?php
		include "header.php";
		?>
		<!--product type-->
		<div class="jumbotron-fluid">
			<hr>
			<h1 class="text-center"><b>PRODUCTS</b></h1>
			<hr>
		</div>
		<div class="jumbotron-fluid">
			<br>
			<h3 class="text-center"><b>Product type</b></h3>
			<br>
		</div>
		<!--products-->
		<div class="container">
			<div class="row justify-content-center">
				<?php
				include "userconnect.php";
				$sql = "SELECT A.typeName, B.* FROM `tblfurn_type` as A INNER JOIN tblproduct as B where A.typeID = B.prodTypeID and B.prodStat = 'Pre-Order' limit 30";
				$result = mysqli_query($conn, $sql);
				if(mysqli_num_rows($result) > 0)
				{
					while ($row = mysqli_fetch_assoc($result))
					{
				?>
				<div class="col-6 col-sm-4 col-md-3 col-lg-3 col-xl-3">
					
					<div class="hovereffect">
						<img class="img-fluid" src="/admin/plugins/products/<?php echo "" . $row["prodMainPic"];?>">
						<div class="overlay">
							<h2><?php echo "" . $row["productName"];?><br><br>Php&nbsp;<?php echo "" . number_format($row["productPrice"]);?></h2>
							<a class="info" href=""><span class="fa fa-eye"></span></a>
							<a class="info" href=""><span class="fa fa-shopping-cart"></span></a>
						</div>
    			</div>
				</div>
				<?php
					}
				}
				mysqli_close($conn);
				?>
			</div>
			<br>
		</div>
		<br>
		<!--footer-->
		<?php
		include 'footer.php';
		?>
		<!--cart-->
		<div class="modal fade" id="myCart">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Product Name</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<table id="cartTbl" class="table table-reflow table-bordered table-striped">
							<thead class="bg-web">
								<tr>
									<th>Product Name</th>
									<th>Dimensions</th>
									<th>Quantity</th>
									<th>Price</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<!--view modal-->
		<div class="modal fade" id="viewmodal">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
					</div>
					<div class="modal-body">
					</div>
				</div>
			</div>
		</div>
	</body>
	<!--scripts-->
	<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
	<!--javascript-->
	<script src="js/myScript.js" type="text/javascript"></script>
	<script src="js/illbeback.min.js" type="text/javascript"></script>
	<script type="text/javascript">
    	$(document).ready(function(){
    		$("#scroll-to-top").illBeBack();
    	});
    </script>
</html>
