<head>
	<link rel="stylesheet" href="css/header.css">
</head>
<div class="container-fluid bg-wood">
	<div class="container">
		<div class="row">
			<div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
				<?php
				include "userconnect.php";
				$sql="SELECT * from tblcompany_info";
				$result=$conn->query($sql);
				if($result->num_rows>0){
					while($row=$result->fetch_assoc()){
				?>
					<img class="img-fluid col-12" src="/admin/plugins/images/<?php echo "" . $row["comp_logo"];?>">
				<?php
					}
				}
				?>
			</div>
			<div class="col-12 col-sm-6 col-md-8 col-lg-9 col-xl-10 text-right">
				<br>
				<div class="text-right">
					<form class="form-inline text-right">
						<input type="text" class="form-control"/>&nbsp;
						<button type="submit" class="btn btn-primary"><span class="fa fa-search"></span></button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<nav class="col-12 col-md-12 col-md-12 col-lg-12 col-xl-12 navbar navbar-toggleable-md navbar-inverse bg-web sticky-top">
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
			<a class="navbar-brand" href="userhome.php"><?php echo "" . $row['comp_name'];?></a>
		<?php
			}
		}
		$conn->close();
	?> 
  	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
	  		<li class="nav-item">
				<a class="nav-link" href="userhome.php"><i class="fa fa-home"></i>&nbsp;HOME <span class="sr-only">(current)</span></a>
	  		</li>
	  		<li class="nav-item">
				<a class="nav-link" href="userproducts.php"><i class="fa fa-bed"></i>&nbsp;PRODUCTS</a>
	  		</li>
	  		<li class="nav-item">
				<a class="nav-link" href="userpromos.php"><i class="fa fa-gift"></i>&nbsp;PROMOS</a>
	  		</li>
			<li class="nav-item">
				<a class="nav-link" data-toggle="modal" data-target="#myCart" href=""><span class="fa fa-shopping-cart"></span>&nbsp;CART&nbsp;<span class="badge text-info"></span></a>
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
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-toggle="modal" href="#signupmodal"><span class="fa fa-user-plus">&nbsp;Sign Up</span></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="modal" href="#loginmodal"><span class="fa fa-sign-in">&nbsp;Log In</span></a>
				</li>
			</ul>
<!--
		<form class="form-inline my-2 my-lg-0" action="uservalidate.php" method="post">
			<input type="text" class="form-control" name="username" placeholder="Username" required/><br>&nbsp;
			<input type="password" class="form-control" name="password" placeholder="Password" required/><br>&nbsp;
			<button role="button" type="submit" class="btn btn-outline-warning">Log in</button>&nbsp;
			<button type="button" data-target="#signupmodal" data-toggle="modal" class="btn btn-outline-success">Sign up</button>
		</form>
-->
  	</div>
</nav>
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
							<label><small>Note: All fields are <b class="text-danger">required.</b></small></label><br><br>

							<div class="form-group row">
								<div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
										<input type="text" class="form-control" placeholder="First Name" name="fname" required/>
								</div>
								<div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
									<input type="text" class="form-control" placeholder="Middle Name" name="mname" required/>
								</div>
								<div class="col-sm-4 col-md-4 col-lg-4 col-xl-4">
									<input type="text" class="form-control" placeholder="Last Name" name="lname" required/>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
									<textarea type="text" class="form-control" placeholder="Address" name="address" required></textarea><br>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
									<input type="email" class="form-control" placeholder="Email" name="email" required/><br>
								</div>
								<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
									<input type="text" class="form-control" placeholder="Contact Number" name="number" required/>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
									<input type="text" class="form-control" placeholder="Username" name="uname" required/><br>
								</div>
								<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6">
									<input type="password" class="form-control" placeholder="Password" name="upass" required/><br>
									<input type="password" class="form-control" placeholder="Confirm Password" name="cpass" required/><br>
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