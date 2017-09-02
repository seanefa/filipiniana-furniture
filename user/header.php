<!--
<div class="container-fluid">
	<div class="row justify-content-between">
		<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
			<ul class="ul-inline">
				<li class="li-inline red"><a> <span class="fa fa-heart"></span>&nbsp;Wishlist </a></li>
				<li class="li-inline"><a> <span class="fa fa-map-marker"></span>&nbsp;Branches </a></li>
			</ul>
		</div>
		<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4 text-right">
			<ul class="ul-inline">
				<li class="li-inline">
					<a data-toggle="modal" href="#signupmodal"> <span class="fa fa-user-plus" aria-expanded="false"></span>&nbsp;Sign Up </a>
				</li>
				<li class="li-inline">
					<a data-toggle="modal" href="#loginmodal"> <span class="fa fa-sign-in" aria-expanded="false"></span>&nbsp;Log In </a>
				</li>
				<li class="li-inline">
					<a data-toggle="modal" data-target="#myCart" href="" title="Cart"> <span class="fa fa-shopping-cart"></span>&nbsp;Cart<span class="badge text-info"></span> </a>
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
		</div>
	</div>
</div>
-->
<!--
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
		<form class="form-inline my-2 my-lg-0" action="uservalidate.php" method="post">
			<input type="text" class="form-control" name="username" placeholder="Username" required/><br>&nbsp;
			<input type="password" class="form-control" name="password" placeholder="Password" required/><br>&nbsp;
			<button role="button" type="submit" class="btn btn-outline-warning">Log in</button>&nbsp;
			<button type="button" data-target="#signupmodal" data-toggle="modal" class="btn btn-outline-success">Sign up</button>
		</form>
  	</div>
</nav>
-->
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
							<label> Note: All fields are <b class="text-danger">required.</b> </label><br><br>
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

<div class="container-fluid bg-web">
	<div class="row">
		<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<br>
		</div>
	</div>
</div>
<br>
<div class="container">
	<div class="row justify-content-between">
		<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4">
			<?php
			include "userconnect.php";
			$sql="SELECT * from tblcompany_info";
			$result=$conn->query($sql);
			if($result->num_rows>0){
				while($row=$result->fetch_assoc()){
			?>
			<ul class="ul-inline">
				<li class="li-inline"><a><span class="fa fa-phone"></span>&nbsp;<?php echo "" . $row["comp_num"];?></a></li>
				<li class="li-inline"><a><span class="fa fa-envelope"></span>&nbsp;<?php echo "" . $row["comp_email"];?></a></li>
			</ul>
			<?php
				}
			}
			?>
		</div>
		<div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-4 text-right">
			<ul class="ul-inline">
				<li class="li-inline">
					<a href="useraccounts.php"><span class="fa fa-user-circle"></span>&nbsp;Sign Up</a>
				</li>
				<li class="li-inline">
					<a data-toggle="modal" data-target="#myCart" href="" title="Cart"> <span class="fa fa-shopping-cart"></span>&nbsp;Cart<span class="badge text-info"></span> </a>
				</li>
			</ul>
		</div>
	</div>
</div>
<div class="container-fluid">
	<div class="row justify-content-center">
		<div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
			<?php
			include "userconnect.php";
			$sql="SELECT * from tblcompany_info";
			$result=$conn->query($sql);
			if($result->num_rows>0){
				while($row=$result->fetch_assoc()){
			?>
			<a href="userhome.php"><img class="img-fluid col-12" src="/admin/plugins/logo/<?php echo "" . $row["comp_logo"];?>"></a>
			<?php
				}
			}
			$conn->close();
			?>
		</div>
	</div>
</div>
<br>
<nav class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 navbar navbar-toggleable-md navbar-default bg-clean sticky-top">
 	<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
		<ul class="nav">
			<li class="nav-item">
				<a class="nav-link" href="userhome.php"><span class="fa fa-home"></span>&nbsp;HOME</a>
			</li>
	  		<li class="nav-item">
				<a class="nav-link" href="userproducts.php"><span class="fa fa-bed"></span>&nbsp;PRODUCTS</a>
	  		</li>
	  		<li class="nav-item">
				<a class="nav-link" href="userpackages.php"><span class="fa fa-object-group"></span>&nbsp;PACKAGES</a>
	  		</li>
	  		<li class="nav-item">
				<a class="nav-link" href="userpromos.php"><span class="fa fa-gift"></span>&nbsp;PROMOS</a>
	  		</li>
		</ul>
	</div>
</nav>