
				<nav class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 navbar navbar-toggleable-md fixed-top navbar-inverse bg-web-faded">
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
						<a class="navbar-brand" href="access.php"><?php echo "" . $row['comp_name'];?></a>
					<?php
						}
					}
					$conn->close();
					?>
				  	<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav mr-auto">
					  		<li class="nav-item">
								<a class="nav-link" href="access.php"><i class="fa fa-user-circle-o"></i>&nbsp;PROFILE <span class="sr-only">(current)</span></a>
					  		</li>
					  		<li class="nav-item">
								<a class="nav-link" href="accessproducts.php"><i class="fa fa-bed"></i>&nbsp;PRODUCTS</a>
					  		</li>
					  		<li class="nav-item">
								<a class="nav-link" href="accesspromos.php"><i class="fa fa-gift"></i>&nbsp;PROMOS</a>
					  		</li>
					  		<li class="nav-item">
								<a class="nav-link" href="custom.php"><i class="fa fa-hand-pointer-o"></i>&nbsp;CUSTOMIZE</a>
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