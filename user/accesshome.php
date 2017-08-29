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
		<title>Home - Filipiniana Furnitures</title>
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
		<link rel="stylesheet" href="css/hover.css">
	</head>
	<body>
		<!--navbar-->
		<?php
		include "accessheader.php";
		?>
		<div class="container-fluid">
			<div class="row">
				<!--carousel-->
				<div class="container">
					<div class="row">
						<div id="carousel" class="carousel slide col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12" data-ride="carousel">
							<ol class="carousel-indicators">
							  <li data-target="#carousel" data-slide-to="0" class="active"></li>
								<li data-target="#carousel" data-slide-to="1" class=""></li>
								<li data-target="#carousel" data-slide-to="2" class=""></li>
							  <li data-target="#carousel" data-slide-to="3" class=""></li>
							</ol>
							<br>
						  <div class="carousel-inner" role="listbox">
								<div class="carousel-item active">
									<img class="img-fluid" src="pics/LIVINGROOMBANNER.png" alt="Living Room">
								</div>
								<div class="carousel-item">
									<img class="img-fluid" src="pics/DININGROOMBANNER.png" alt="Dining Room">
								</div>
								<div class="carousel-item">
									<img class="img-fluid" src="pics/banner.png" alt="Banner">
								</div>
								<div class="carousel-item">
									<img class="img-fluid" src="pics/companybanner.jpg" alt="Company Banner">
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--featured products-->
		<div class="jumbotron-fluid">
			<hr>
			<h1 class="text-center"><b>PRODUCTS</b></h1>
			<hr>
		</div>
		<div class="container">
			<div class="row justify-content-center">
				<?php
				include "userconnect.php";
				$sql = "SELECT * FROM tblproduct WHERE prodStat = 'Pre-Order' LIMIT 8";
				$result = mysqli_query($conn, $sql);
					if(mysqli_num_rows($result) > 0)
				{
					while($row = mysqli_fetch_assoc($result))
					{
				?>
				<div class="col-6 col-sm-4 col-md-3 col-lg-3 col-xl-3">
					<div class="card text-center">
						<form method="post">
							<input type="hidden" value="<?php echo "" . $row["prodID"];?>" name="i_d"/>
						</form>
						<img class="card-img-top img-fluid img-thumbnail" alt="Product Image" src="/admin/plugins/images/<?php echo "" . $row["prodMainPic"];?>">
						<div class="card-block">
							<p class="card-text">
								<?php echo "" . $row["productName"]; ?><br>
								<b>Php&nbsp;<?php echo "" . number_format($row["productPrice"]); ?></b>
							</p>
							<button role="button" class="btn btn-success" title="Add to Cart"><i class="fa fa-cart-plus"></i></button>
							<button role="button" title="View Product" data-toggle="modal" data-target="#viewmodal" class="btn"><i class="fa fa-eye"></i></button>
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
			<div class="text-center">
				<a href="userproducts.php">See all products</a>
			</div>
		</div>
		<!--promos-->
		<div class="jumbotron-fluid">
			<hr>
			<h1 class="text-center"><b>GOOD NEWS</b></h1>
			<hr>
		</div>
		<div class="container">
			<div class="row justify-content-center">
				<?php
					include "userconnect.php";
					$sql = "SELECT * FROM tblpromos where promoStatus = 'Active' limit 6";
					$result = mysqli_query($conn, $sql);
					if(mysqli_num_rows($result) > 0)
					{
						while($row = mysqli_fetch_assoc($result))
						{
				?>
							<div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-4">
								<div class="hovereffect">
                	<img class="img-fluid" src="/admin/plugins/images/<?php echo "" . $row["promoImage"];?>">
									<div class="overlay">
										<h2><?php echo "" . $row["promoName"];?></h2>
										<a class="info" data-toggle="#viewmodal" href=""><span class="fa fa-eye"></span>&nbsp; View</a>
										<a class="info" href=""><span class="fa fa-check-circle"></span>&nbsp; Avail</a>
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
			<div class="text-center">
				<a href=".php">See all promos</a>
			</div>
		</div>
		<br>
		<a href="" id="scroll-to-top"></a>
		<!--footer-->
		<?php
		include 'accessfooter.php';
		?>
<!--footer start from here-->

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
		<!--details about the promo modal-->
		<div class="modal fade" id="promomodal">
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
		$(document).ready(function() {
			$("#scroll-to-top").illBeBack();
		});
    </script>
</html>
