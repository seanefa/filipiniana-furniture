<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link href="image/favicon.ico" rel="icon" />
	<link rel="stylesheet" href="css/myStyle.css">
	<title>Profile - Filipiniana Furniture Shop</title>
	<meta name="description" content="Furniture shop">
	<script type="text/javascript" src="js/myScript.js"></script>
	<?php include"css.php";?>
	<script>

		function loadProdInfo(id){
			$.ajax({
				type: 'post',
				url: 'prod-info-output.php',
				data: {
					id: id,
				},
				success: function (response) {
					$( '#displayProd' ).html(response);
				}
			});
		}
	$(document).ready(function(){
	});
	</script>
</head>
<body style="background: #ffffff;">
	<?php
	include "header.php";
	if(!isset($_SESSION["userID"]))
	{
		echo "<script>
		window.location.href='login.php';
		alert('You have no access here. You must logged in first.');
		</script>";
	}
	$cID = $_SESSION["userID"];
	echo $cID;
	?>
	<div id="container">
		<div class="container">
			<ul class="breadcrumb">
				<li><a href="home.php"><i class="fa fa-home"></i></a></li>
				<li><a href="production.php">Production</a></li>
			</ul>
			<br>
			<div class="row">
				<?php include "accountmenu.php"; ?>
				<!--Middle Part Start-->
				<div class="col-sm-9" id="content">
					<h2>Production</h2>
					<div class="row">
						<div class="col-sm-12">
							<div class="well">
								<div class="row">
									<div class="col-sm-12">
										<div class="descriptions">
											<div class="row">
												<div class="col-md-12">
													<h2>List of Orders</h2>
													<table class="table color-bordered-table">
														<thead>
															<th style="text-align:left"><b>ORDER ID</b></th>
															<th style="text-align:left"><b>Date Ordered</b></th>
															<th style="text-align:right"><b>Status</b></th>
															<th style="text-align:right"><b>Action</b></th>
														</thead>
														<tbody>
															<?php
															include "userconnect.php";
															$down = 0;
															$bal = 0;
															$sql = "SELECT * FROM tblorders a, tblcustomer b, tbluser c WHERE c.userCustID = b.customerID and b.customerID = a.custOrderID and c.userID = '$cID' and orderStatus != 'Finished' and orderStatus!='Archived'";
															$res = mysqli_query($conn,$sql);
															while($trow = mysqli_fetch_assoc($res)){
																$date = date_create($trow['dateOfReceived']);
																$date = date_format($date,"F d, Y");
																echo '<tr>
																<td>'.$date.'</td>
																<td>'.$date.'</td>
																<td style="text-align:right">'.$trow['orderStatus'].'</td>
																<td style="text-align:right"><button type="button" class="btn btn-primary" onclick="loadProdInfo('.$trow['orderID'].')" style="text-align:center;color:white;"><span class=" ti-receipt"></span> View </button></td>
																</tr>';
															}
															?>
														</tbody>
													</table>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<h2 style="margin-left:2%;">Production Information</h2>
													<div id="displayProd">

													</div>
												</div>
											</div>
										</div>

									</div>	
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<div id="myModal" class="modal fade" role="dialog " aria-hidden="true" style="display: none;" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <!-- Modal content -->
      <div class="modal-content clearable-content">
        <div class="modal-body">

        </div>
      </div>
    </div>
  </div>
</div>
	<?php include"footer.php";?>
	<!--img src="pics/userpictures/<?php echo "" . $row["customerDP"];?>" style="height:150px; width:150px;" alt="Product" class="img-responsive profilepic"/-->
	<?php include "scripts.php";?>
</body>
</html>
