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
								<a class="nav-link" href="accesshome.php">Home</a>
					  		</li>
					  		<li class="nav-item">
								<a class="nav-link" href="access.php">Proifle<span class="sr-only">(current)</span></a>
					  		</li>
					  		<li class="nav-item">
								<a class="nav-link" href="accessproducts.php">Products</a>
					  		</li>
					  		<li class="nav-item">
								<a class="nav-link" href="accesspromos.php">Promos</a>
					  		</li>
					  		<li class="nav-item">
								<a class="nav-link" href="custom.php">Customize</a>
					  		</li>
					  		<li class="nav-item">
								<a class="nav-link" href="accessproduction.php">Production</a>
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