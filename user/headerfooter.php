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
		<div class="container-fluid">
			<div class="row">
				<!--navbar-->
				<nav class="col-12 col-md-12 col-md-12 col-lg-12 col-xl-12 navbar sticky-top navbar-toggleable-md navbar-inverse bg-web-faded img-fluid">
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
					<img class="mx-auto d-block img-fluid" src="/admin/plugins/images/<?php echo "" .$row['comp_logo'];?>">&nbsp;
				<?php
					}
				}
				?>
					<?php
					include "userconnect.php";
					$sql="SELECT * from tblcompany_info";
					$result=$conn->query($sql);
					if($result->num_rows>0)
					{
						while($row=$result->fetch_assoc())
						{
					?>
					<a class="navbar-brand" href="userhome.php"><?php echo "" . $row['comp_name'];?></a>
					<?php
						}
					}
					$conn->close();
					?>
				  	<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav mr-auto">
					  		<li class="nav-item active">
								<a class="nav-link" href="userhome.php"><i class="fa fa-home"></i>&nbsp;HOME <span class="sr-only">(current)</span></a>
					  		</li>
					  		<li class="nav-item">
								<a class="nav-link" href="userproducts.php"><i class="fa fa-bed"></i>&nbsp;PRODUCTS</a>
					  		</li>
					  		<li class="nav-item dropdown">
								<a class="nav-link" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" href="">
									<i class="fa fa-user-circle-o"></i>&nbsp;ACCOUNTS
								</a>
								<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
									<a class="dropdown-item" data-toggle="modal" href="" data-target="#loginmodal">Log In</a>
									<a class="dropdown-item" data-toggle="modal" href="" data-target="#signupmodal">Sign Up</a>
								</div>
					  		</li>
						</ul>
						<ul class="navbar-nav navbar-right">
							<li class="nav-item">
								<a class="nav-link" data-toggle="modal" data-target="#myCart" href=""><span class="fa fa-shopping-cart"></span>&nbsp;CART&nbsp;<span class="badge text-info">1738</span></a>
							</li>
						</ul>
						<form class="form-inline my-2 my-lg-0">
							<input class="form-control mr-sm-2" type="text">
							<button class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fa fa-search"></i>&nbsp;Search</button>
						</form>
				  	</div>
				</nav>
			</div>
		</div>
		
		
		<!--footer-->
		<footer class="jumbotron-fluid footer sticky-bottom">
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
						<li><a href="userhome.php" class="btn btn-web">Home</a></li>
						<li><a href="userproducts.php" class="btn btn-web">Products</a></li>
						<li><a href="#" class="btn btn-web">User Manual</a></li>
					</ul>
				</div>
				<div class="col-md-5 col-lg-5 col-xl-5">
					<h3 class="text-center"><b>About</b></h3>
					<hr>
					<p class="text-justify"><?php echo "" . $row['comp_about'];?></p>
				</div>
				<div class="col-md-4 col-lg-4 col-xl-4">
					<div class="container">
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
				</div>
				<?php
					}
				}
				$conn->close();
				?>
			</div>
		</footer>
		<!--signup modal-->
		<div class="modal fade" id="signupmodal">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h6 class="modal-title"><i class="fa fa-user-plus"></i>&nbsp;Sign up</h6>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<form action="newuser.php" method="post">
							<div class="form-group row">
								<div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
										<input type="text" class="form-control" placeholder="*First Name" name="fname" required/>
								</div>
								<div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
									<input type="text" class="form-control" placeholder="*Middle Name" name="mname" required/>
								</div>
								<div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
									<input type="text" class="form-control" placeholder="*Last Name" name="lname" required/>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
									<textarea type="text" class="form-control" placeholder="*Address" name="address" required></textarea><br>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
									<input type="email" class="form-control" placeholder="*Email" name="email" required/><br>
								</div>
								<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
									<input type="text" class="form-control" placeholder="*Contact Number" name="number" required/>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
									<input type="text" class="form-control" placeholder="*Username" name="uname" required/><br>
								</div>
								<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
									<input type="password" class="form-control" placeholder="*Password" name="upass" required/><br>
									<input type="password" class="form-control" placeholder="*Confirm Password" name="cpass" required/><br>
								</div>
							</div>
							<div class="form-group row text-center">
								<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
									<div class="btn-group" role="group">
										<button type="submit" class="btn btn-primary"><i class="fa fa-check-circle"></i>&nbsp;Save</button>
										<button type="reset" class="btn btn-warning"><i class="fa fa-minus-circle"></i>&nbsp;Clear</button>
										<button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close"><i lass="fa fa-times-circle"></i>&nbsp;Cancel</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!--login modal-->
		<div class="modal fade" id="loginmodal">
			<div class="modal-dialog modal-sm" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h6><i class="fa fa-sign-in"></i>&nbsp;Log In</h6>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body text-center">
						<form class="form-group" action="uservalidate.php" method="post">
							<input type="text" class="form-control" name="username" placeholder="*Username" required/><br>
							<input type="password" class="form-control" name="password" placeholder="*Password" required/><br>
							<button role="button" type="submit" class="btn btn-web">Log in</button>
						</form>
					</div>
				</div>
			</div>
		</div>
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
</html>
