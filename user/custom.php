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
		<title>Filipiniana Furnitures - Check out</title>
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
				<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<!--navbar-->
					<br><br>
					<nav class="navbar navbar-toggleable-md fixed-top navbar-inverse bg-inverse">
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
						  		<li class="nav-item">
									<a class="nav-link" href="access.php"><i class="fa fa-user-circle-o"></i>&nbsp;ACCOUNT <span class="sr-only">(current)</span></a>
						  		</li>
						  		<li class="nav-item">
									<a class="nav-link" href="accessproducts.php"><i class="fa fa-bed"></i>&nbsp;PRODUCTS</a>
						  		</li>
						  		<li class="nav-item active">
									<a class="nav-link" href="accesscustom.php"><i class="fa fa-hand-pointer-o"></i>&nbsp;CUSTOMIZE</a>
						  		</li>
						  		<li class="nav-item">
									<a class="nav-link" href="accessproduction.php"><i class="fa fa-cog fa-spin"></i>&nbsp;PRODUCTION</a>
						  		</li>
							</ul>
					  </div>
					</nav>
				</div>
			</div>
		</div>
		<div class="jumbotron-fluid">
			<!--customization-->
			<hr>
			<h1 class="text-center"><b>CUSTOMIZATION</b></h1>
			<hr>
			<div class="container">
				<div class="row">
					<div class="col-12 col-sm-12 col-md-4 col-lg-3 col-xl-3">
						<div class="card">
							<div class="card-header text-center">
								<h1 class="card-title">Frameworks</h1>
							</div>
							<div class="card-block"></div>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-md-8 col-lg-9 col-xl-9">
						<div class="card">
							<div class="card-block text-center">
								<img class="img-fluid table-responsive"><h1><canvas id="canvas" width="720" height="500" style="background-color: gray; border: 1px solid #000000;"></canvas></h1>
							</div>
							<div class="card-footer text-center">
								<button role="button" class="btn btn-success"><i class="fa fa-sitemap"></i>&nbsp;Convert to Image</button>
								<button role="button" class="btn btn-warning"><i class="fa fa-cart-plus"></i>&nbsp;Estimate Furniture</button>
								<button role="button" class="btn btn-primary" onclick="clearCanvas()"><i class="fa fa-history"></i>&nbsp;Reset</button>
							</div>
						</div>
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<div class="card-deck">
						<!--upload image-->
							
							<!--Framework-->
							<div class="card" id="framework">
								<div class="card-header text-center">
									<h1 class="card-title">Framework</h1>
								</div>
								<div class="card-block">
									<div class="form-group">

									<script type="text/javascript">
									/*window.onload = function(){
									var canvas = document.getElementById("canvas");
									var img = document.getElementById('frame2');
									var ctx = canvas.getContext("2d");
									
									ctx.drawImage(img,10,10);
									}*/
									var canvas = document.getElementById("canvas");
									var frameimg,fabimg;
									var ctx = canvas.getContext("2d");

									function clearCanvas(){
										var result = confirm('Canvas will be cleared. Are you sure?');
										if(result){
										$('#framework').toggle();
										$('#fabric').toggle();
										var ctx = canvas.getContext("2d");
										ctx.clearRect(0, 0, canvas.width, canvas.height);
										}
									}

										function addFrameImage(id){
											
									var temp = 'frame'+id;
									
									frameimg = document.getElementById(temp);
									
									$('#framework').toggle();
									$('#fabric').toggle();
									ctx.drawImage(frameimg,10,10,500,500);
									
	
										}

										function addFabricImage(id){
											
									var temp = 'fabric'+id;
									fabimg = document.getElementById(temp);
									ctx.globalCompositeOperation = 'source-in';
									ctx.drawImage(fabimg,10,10,500,500);
	
										}

										function tryKo(){
											alert('oke');
										}
									</script>

									<?php 
									include "userconnect.php";
									$sql = "SELECT * FROM tblframeworks;";
	                              $result = mysqli_query($conn,$sql);
										
								if($result){
	                              while ($row = mysqli_fetch_assoc($result))
	                              {
	                                if($row['frameworkStatus']=="Listed"){
	                                	
	                                	echo '
	                                		<input type="image" src="/admin/plugins/images/'.$row['frameworkPic'].'" alt="Unavailable" class="img-responsive border-animate" height="150" width="145" onclick="addFrameImage('.$row['frameworkID'].')" />

	                                		<img style="display:none" id="frame'.$row['frameworkID'].'" src="/admin/plugins/images/'.$row['frameworkPic'].'" alt="Unavailable" class="img-responsive" height="150" width="145">';

	                                }
	                            }
									}


									?>
									
										<div class="dropdown">



										</div>
										
									</div>
								</div>
							</div>
							<!--fabric-->
							<div id="fabric" class="card" style="display: none">
								<div class="card-header text-center">
									<h1 class="card-title">Fabric</h1>
								</div>
								<div class="card-block">
									
									<div class="dropdown">
									<?php 

									$sql = "SELECT * FROM tblfabrics;";
                              $result = mysqli_query($conn, $sql);
                              while ($row = mysqli_fetch_assoc($result))
                              {
                                if($row['fabricStatus']=="Listed"){
                                	echo '

                                	<input type="image" src="/admin/plugins/images/'.$row['fabricPic'].'" alt="Unavailable" class="img-responsive" height="150" width="145" onclick="addFabricImage('.$row['fabricID'].')" />

                                	<img style="display:none" id="fabric'.$row['fabricID'].'" src="/admin/plugins/images/'.$row['fabricPic'].'" alt="Unavailable" class="img-responsive" height="150" width="145">';
                                }
                            }

									?>
										
									</div>
									<!--
									<div class="dropdown">
										<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Choose Fabric Pattern</button>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										  <a class="dropdown-item" href="#">Polkadots</a>
											<a class="dropdown-item" href="#">Stripes</a>
										</div>
									</div>
									<div class="dropdown">
										<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Choose Primary Color</button>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										  <a class="dropdown-item" href="#">Blue</a>
											<a class="dropdown-item" href="#">Red</a>
											<a class="dropdown-item" href="#">Green</a>
											<a class="dropdown-item" href="#">Go</a>
											<a class="dropdown-item" href="#">ZAIDO!!!</a>
										</div>

									</div>

									<div class="dropdown">
										<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Choose Secondary Color</button>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										  <a class="dropdown-item" href="#">Roses</a>
											<a class="dropdown-item" href="#">Red</a>
											<a class="dropdown-item" href="#">Violets</a>
											<a class="dropdown-item" href="#">Blue</a>
										</div>
									</div>
									!-->
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<br>
<!--
		<footer class="jumbotron-fluid footer">
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
						<li><a href="#" class="btn btn-web">Home</a></li>
						<li><a href="#" class="btn btn-web">Products</a></li>
						<li><a href="#" class="btn btn-web">User Manual</a></li>
					</ul>
				</div>
				<div class="col-md-5 col-lg-5 col-xl-5">
					<h3 class="text-center"><b>About</b></h3>
					<hr>
					<p class="text-justify"><?php echo "" . $row['comp_about'];?></p>
				</div>
				<div class="col-md-4 col-lg-4 col-xl-4">
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
				<?php
					}
				}
				$conn->close();
				?>
			</div>
		</footer>
-->
<!--
			<div class="jumbotron-fluid">
				<div class="row">
					<div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<p class="text-primary text-center"style="background-color:white;"><i class="fa fa-copyright"></i>&nbsp;Aira and Friends. All rights reserved</p>
					</div>
				</div>
			</div>
-->
	</body>
</html>
