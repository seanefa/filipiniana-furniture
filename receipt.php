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
		<div class="jumbotron-fluid">
			<div class="row">
				<!--navbar-->
				<nav class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 navbar navbar-toggleable-md fixed-top navbar-inverse bg-inverse">
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
		<br><br><br><br>
		<div class="jumbtron-fluid">
			<div class="row">
				<hr>
				<h1 class="text-center"><b>RECEIPT</b></h1>
				<hr>
			</div>
		</div>
		<br>
		<?php
		include "userconnect.php";
		$sql="SELECT * from tblcompany_info";
		$result=$conn->query($sql);
		if($result->num_rows>0)
		{
			while($row=$result->fetch_assoc())
			{
		?>
		<div class="container">
			<div class="row justify-content-center">
				<div class="bond-paper border-web">
					<div class="row">
						<div class="col-md-5 col-lg-5 col-xl-5">
							<table class="table table-bordered table-reflow">
								<thead>
									<tr>
										<th class="text-center" colspan="3">Payment of the following:</th>
									</tr>
									<tr>
										<th>PARTICULARS</th>
										<th colspan="2">Amount</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td></td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<th>Amount Due</th>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<th>Less: SC/PWD Discount</th>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<th>TOTAL AMOUNT DUE</th>
										<td colspan="2"></td>
									</tr>
									<tr>
										<th colspan="3" class="text-center">Payment in the form of</th>
									</tr>
									<tr>
										<td>Cash</td>
										<td></td>
										<td></td>
									</tr>
									<tr>
										<td colspan="3">CHECK No.</td>
									</tr>
									<tr>
										<td colspan="3">Bank</td>
									</tr>
									<tr>
										<th colspan="3">TOTAL AMOUNT DUE</th>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-md-7 col-lg-7 col-xl-7">
						<?php
						include "userconnect.php";
						$sql="SELECT * from tblcompany_info";
						$date=date("Y/m/d");
						$result=$conn->query($sql);
						if($result->num_rows>0)
						{
							while($row=$result->fetch_assoc())
							{
						?>
							<h1 class="text-center"><?php echo "" . $row["comp_name"];?></h1>
							<p class="text-center"><?php echo "" . $row["comp_address"];?></p>
							<hr>
							<h3 class="text-center"><u><b>OFFICIAL RECEIPT</b></u></h3><br>
							<p class="text-right">Date:&nbsp;<b><?php echo "" . $date;?></b></p>
							<h4>RECEIVED FROM:</h4>
							<p>Address:</p>
							<b>TIN</b><br><br>
							<p>engaged in the Business style of<b></b></p>
							<b>The sum of (Php)</b><br><br>
							<p>in <b>full[&nbsp;&nbsp;&nbsp;] partial[&nbsp;&nbsp;&nbsp;]</b> payment of:</p>
							<br>
							<hr>
							<br>
							<div class="row">
								<div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
									<b>Sr Citizen TIN: .....................................</b><br>
									<b>OSCA/PWD ID No.: ............................</b><br><br>
									<b>Signature: ..................................</b>
								</div>
								<div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
									<b><i>Issued By:</i></b><br><br>
									<span class="text-center">_____________________________________</span><br>
									<h4 class="text-center"><b>Authorized Signature</b></h4>
								</div>
							</div>
							<br><br><br><br><br>
							<div class="row">
								<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
									<p class="text-center">"This Document is not Valid for Claiming Input Taxes"<br>This Official Receipt shall be valid for five(5) years from the dateof ATP.</p>
								</div>
							</div>
						<?php
							}
						}
						?>
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
		<br>
	</body>
</html>