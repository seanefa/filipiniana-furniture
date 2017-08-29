<div class="container-fluid">
	<div class="row justify-content-between">
		<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
			<ul class="ul-inline">
				<li class="li-inline red"><a><small><span class="fa fa-heart"></span>&nbsp;Wishlist</small></a></li>
				<li class="li-inline"><a><small><span class="fa fa-map-marker"></span>&nbsp;Branches</small></a></li>
			</ul>
		</div>
		<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4 text-right">
			<ul class="ul-inline">
				<li class="li-inline">
					<a data-toggle="modal" href="#signupmodal"><small><span class="fa fa-user-plus" aria-expanded="false"></span>&nbsp;Sign Up</small></a>
				</li>
				<li class="li-inline">
					<a data-toggle="modal" href="#loginmodal"><small><span class="fa fa-sign-in" aria-expanded="false"></span>&nbsp;Log In</small></a>
				</li>
				<li class="li-inline">
					<a data-toggle="modal" data-target="#myCart" href="" title="Cart"><small><span class="fa fa-shopping-cart"></span>&nbsp;Cart<span class="badge text-info"></span></small></a>
				</li>
			</ul>
		</div>
	</div>
	<div class="container">
		<div class="row align-items-center">
			<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4">
				<?php
				include "userconnect.php";
				$sql="SELECT * from tblcompany_info";
				$result=$conn->query($sql);
				if($result->num_rows>0){
					while($row=$result->fetch_assoc()){
				?>
				<a href="userhome.php"><img class="img-fluid col-12" src="/admin/plugins/images/<?php echo "" . $row["comp_logo"];?>"></a>
				<?php
					}
				}
				?>
			</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 text-center">
				<ul class="ul-inline">
					<li class="li-inline"><a href="userhome.php">HOME</a></li>
					<li class="li-inline"><a href="#">ABOUT</a></li>
					<li class="li-inline"><a href="userpromos.php">PROMOS</a></li>
				</ul>
			</div>
			<div class="col-12 col-sm-12 col-md-4 col-lg-4 col-xl-4 text-right">
				<form class="form-inline">
					<input type="text" class="form-control">&nbsp;<button class="btn btn-web"><span class="fa fa-search"></span></button>
				</form>
			</div>
<!--
			<div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3c">
				<br>
				<form class="form-group text-center" action="uservalidate.php" method="post">
					<input type="text" class="form-control" name="username" placeholder="Username" required/>
					<br>
					<input type="password" class="form-control" name="password" placeholder="Password" required/>
					<br>
					<button type="submit" class="btn btn-web"><b>Log In</b></button>
					<button type="button" class="btn btn-web" data-toggle="modal" data-target="#signupmodal"><b>Sign Up</b></button>
				</form>
			</div>
-->
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
				<a class="nav-link" href="userproducts.php">FURNITURES</a>
	  		</li>
	  		<li class="nav-item">
				<a class="nav-link" href="#">OFFICE</a>
	  		</li>
	  		<li class="nav-item">
				<a class="nav-link" href="userpackages.php">PACKAGES</a>
	  		</li>
	  		<li class="nav-item">
				<a class="nav-link" href="#">DECORATIONS</a>
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
										<button type="submit" class="btn btn-primary">Save</button>
										<button type="reset" class="btn btn-warning">Clear</button>
										<button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="loginmodal">
			<div class="modal-dialog" role="document">
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
							<div class="btn-group" role="group">
								<button type="submit" class="btn btn-primary">Log In</button>
								<button type="reset" class="btn btn-warning">Clear</button>
								<button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

<!--

<div class="modal fade" id="accountmodal">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h3 class="text-center">ACCOUNT</h3>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="container">
					<div class="row">
						<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
							<h4 class="text-center"><span class="fa fa-sign-in"></span>&nbsp;Log In</h4>
							<form class="form-control text-center" action="uservalidate.php" method="post">
								<input type="text" class="form-control" placeholder="Username" name="username" required><br>
								<input type="password" name="password" class="form-control" placeholder="Password" required><br>
								<button class="btn btn-web" type="submit">Log In</button><br>
							</form>
						</div>
						<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
							<h4 class="text-center"><span class="fa fa-user-plus"></span>&nbsp;Sign Up</h4>
							<form class="form-control text-center" action="newuser.php" method="post">
								<input type="text" class="form-control" placeholder="Username" name="uname" required><br>
								<input type="email" class="form-control" placeholder="Email Address" name="email" required><br>
								<input type="password" class="form-control" placeholder="Password" name="upass" required><br>
								<button class="btn btn-web" type="submit">Sign Up</button><br>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>-->
