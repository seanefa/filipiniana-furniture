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
					<a data-toggle="modal" href="#accountmodal"><small><span class="fa fa-user-circle-o" aria-expanded="false"></span>&nbsp;Account</small></a>
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
				<a href="accesshome.php"><img class="img-fluid col-12" src="/admin/plugins/images/<?php echo "" . $row["comp_logo"];?>"></a>
				<?php
					}
				}
				?>
			</div>
			<div class="col-12 col-sm-6 col-md-4 col-lg-4 col-xl-4 text-center">
				<ul class="ul-inline">
					<li class="li-inline"><a href="access.php">PROFILE</a></li>
					<li class="li-inline"><a href="">ABOUT</a></li>
					<li class="li-inline"><a href="accesspromos.php">PROMOS</a></li>
					<li class="li-inline"><a href="accessproduction.php">PRODUCTION</a></li>
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
				<nav class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 navbar navbar-toggleable-md sticky-top navbar-inverse bg-web">
				 	<button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				  </button>
					<?php
					include "userconnect.php";
					$sql="SELECT * from tblcustomer where customerID='" . $_SESSION["userID"] . "'";
					$result=$conn->query($sql);
					if($result->num_rows>0)
					{
						while($row=$result->fetch_assoc())
						{
					?>
						<a class="navbar-brand" href="access.php">Hello, <?php echo "" . $row['customerFirstName'];?>!</a>
					<?php
						}
					}
					$conn->close();
					?>
				  	<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav mr-auto">
							<li class="nav-item">
							<a class="nav-link" href="accessproducts.php">FURNITURES</a>
							</li>
							<li class="nav-item">
							<a class="nav-link" href="">OFFICE</a>
							</li>
							<li class="nav-item">
							<a class="nav-link" href="accesspromos.php">SERIES</a>
							</li>
							<li class="nav-item">
							<a class="nav-link" href=".php">DECORATIONS</a>
							</li>
						</ul>
						<!-- Right Side Of Navbar -->
		       			<ul class="nav navbar-nav navbar-right">
							<li clas="nav-item">
								<a class="btn btn-outline-success" title="Cart" data-toggle="modal" href="#myCart"><i class="fa fa-shopping-cart"></i></a>
							</li>
							&nbsp;
							<li clas="nav-item">
								<a class="btn btn-outline-warning" href="userlogout.php" title="Log out"><i class="fa fa-sign-out"></i></a>
							</li>
		       			</ul>
				  	</div>
				</nav>