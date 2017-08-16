<?php
session_start();
if(!isset($_SESSION["userID"]))
{
	header("Location: error.html");
}
$userid = $_SESSION["userID"];
$_SESSION['passId'] = $userid;

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
			<form action="add-Custom_prod.php" method="post">
				<div class="row">
					<div class="col-12 col-sm-12 col-md-4 col-lg-3 col-xl-3">

						<div id="productDesc" style="display: none">
						<div class="card">
							<div class="card-header text-center">
								<h1 class="card-title">Design Information</h1>
								<h4>Size specification</h4>
								<input type="number" name="cust_height" class="form-control" placeholder="Height" required>
								<input type="number" name="cust_width" class="form-control" placeholder="Width" required>
								<input type="number" name="cust_length" class="form-control" placeholder="Length" required>
								<br>
								<h4>Fabric</h4>

								<select name="cust_fabric" class="form-control" data-placeholder="Choose a Fabric" id="chooseFabric">
                        <option value="0" selected disabled>Choose a Fabric</option>
                        <?php
                        include "dbconnect.php";
            // Create connection
                        $conn = mysqli_connect($servername, $username, $password, $dbname);
            // Check connection
                        if (!$conn) {
                          die("Connection failed: " . mysqli_connect_error());
                        }
                        $sql = "SELECT * FROM tblfabrics order by fabricName;";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result))
                        {
                          if($row['fabricStatus']=='Listed'){
                            echo('<option value='.$row['fabricID'].'>'.$row['fabricName'].'</option>
                            	
                            	');
                          }
                        }
                        ?>
                      </select>
                      <?php
                        include "dbconnect.php";
            // Create connection
                        $conn = mysqli_connect($servername, $username, $password, $dbname);
            // Check connection
                        if (!$conn) {
                          die("Connection failed: " . mysqli_connect_error());
                        }
                        $sql = "SELECT * FROM tblfabrics order by fabricName;";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result))
                        {
                          if($row['fabricStatus']=='Listed'){
                            echo('<input value="'.$row['fabricPic'].'" id="'.$row['fabricID'].'" type="hidden">
                            	
                            	');
                          }
                        }
                        ?>
                      			<br>
                      			<br>
                      			<img src='' id="tempImage" style="width: 100px;height: 100px;">
                      			<br>
                      			<br>
								<h4>Remarks</h4>
								<textarea name="cust_remarks" class="form-control" rows="4" cols="10"></textarea>
								
							</div>
							<div class="card-block"></div>
						</div>
					</div>
					</div>

					<div id="changeSize" class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
					<!-- col-12 col-sm-12 col-md-8 col-lg-9 col-xl-9 !-->
						<div class="card">
							<div class="card-block text-center">
								<img class="img-fluid table-responsive">
									<div class="literCanvas"></div>
									<div id="thisCanvas" style="display: none">
									<canvas id="canvas" height="550" width="700" style="border:1px solid #000000; background-color: gray"></canvas>
									</div>
									<img name="cust_image" src='' style="display: none;" height="550" width="700" id="savedImage">
									<input type="hidden" name="cust_img_data" id="cust_img_data" value=""/>
									
										
									
							</div>
							<div class="card-footer text-center">
								<div class="card-footer text-center" id="anotherDesign" style="display: none">
								<img src='' id="tempImage">
									<button type="button" class='btn btn-primary' id="newDesign">New Design</button>
									<button type="submit" class='btn btn-success' id="submitThis">Submit Design</button>

								</div>
								<button type="button" class='btn btn-primary' id="saveDesign">Save Design</button>

								<button type="button" class='btn btn-primary' id="chooseExist">Choose existing framework</button>
							</div>
						</div>
					</div>
				</div>
				</form>
				<br>
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
						<div class="card-deck">
						<!--upload image-->
							
							<!--Framework-->

									
							<!--fabric-->
							
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
<script src="//cdnjs.cloudflare.com/ajax/libs/react/0.14.7/react-with-addons.js"></script>
    							<script src="//cdnjs.cloudflare.com/ajax/libs/react/0.14.7/react-dom.js"></script>

    <!-- Literally Canvas -->
										    <script src="js/literallycanvas.js"></script>
										  <script type="text/javascript"></script>
										  <link href="css/literallycanvas.css" rel="stylesheet">
										  <script>
										  //remove white pixels
										  function white2transparent(img)
										{
										    var c = document.createElement('canvas');

										    var w = img.width, h = img.height;

										    c.width = w;
										    c.height = h;

										    var ctx = c.getContext('2d');

										    ctx.drawImage(img, 0, 0, w, h);
										    var imageData = ctx.getImageData(0,0, w, h);
										    var pixel = imageData.data;

										    var r=0, g=1, b=2,a=3;
										    for (var p = 0; p<pixel.length; p+=4)
										    {
										      if (
										          pixel[p+r] == 255 &&
										          pixel[p+g] == 255 &&
										          pixel[p+b] == 255) // if white then change alpha to 0
										      {pixel[p+a] = 0;}
										    }

										    ctx.putImageData(imageData,0,0);

										    return c.toDataURL('image/png');
										}
										  //

  										var lc;
									  $(document).ready(function(){
									  	var canvas = document.getElementById('canvas');
									  	var ctx = canvas.getContext('2d');

									    lc = LC.init(
									            document.getElementsByClassName('literCanvas')[0],
									            {
									              imageURLPrefix: 'img',
									              imageSize: {width: 700, height: 550},
									             tools: [LC.tools.Line,LC.tools.Eraser,
      												LC.tools.Rectangle, LC.tools.Ellipse, LC.tools.Eyedropper, LC.tools.Polygon, LC.tools.Pan],
      												toolbarPosition : 'top'
									            }
									        );
									    
									    var fabimg = document.getElementById('tempImage');
									    var img = document.getElementById('savedImage');

									    $('#chooseFabric').on('change',function(){



									    	var fabID = $(this).val();
									    	var getFab = $('#'+fabID).val();

									    	//img.src = white2transparent(img);

									    	$('#tempImage').prop('src','fabrics/patterns/'+getFab);
									    	fabimg = document.getElementById('tempImage');

									    	ctx.drawImage(img,10,10,700,550);

									    	ctx.globalCompositeOperation = 'source-in';

									    	
									    	////// -white pixels
									    	/*	
									    	var w = img.width, h = img.height;

										    canvas.width = w;
										    canvas.height = h;

									    	var imageData = ctx.getImageData(0,0, w, h);
										    var pixel = imageData.data;

										    var r=0, g=1, b=2,a=3;
										    for (var p = 0; p<pixel.length; p+=4)
										    {
										      if (
										          pixel[p+r] == 255 &&
										          pixel[p+g] == 255 &&
										          pixel[p+b] == 255) // if white then change alpha to 0
										      {pixel[p+a] = 0;}
										    }

										    ctx.putImageData(imageData,40,100);

											
											*/
										    //////end white pixels
									    	
											ctx.drawImage(fabimg,10,10,700,550);

									    	$('#thisCanvas').show();
									    	$('#savedImage').hide();




									    });


									    $('#saveDesign').on('click',function(){

									    	var d =lc.getImage().toDataURL();

									    	$('#cust_img_data').val(d);
									    	$('.literCanvas').hide();
									    	$('#saveDesign').hide();

									    	$('#newDesign').show();

									    	$('#savedImage').show();
									    	$('#savedImage').prop('src',d);


									    	

									    	$('#submitThis').show();
									    	$('#chooseExist').hide();

									    	$('#anotherDesign').show();
									    	$('#productDesc').show();

									    	$('#changeSize').prop('class','col-12 col-sm-12 col-md-8 col-lg-9 col-xl-9');


									    	

									    });
									    $('#newDesign').on('click', function(){
									    	$('.literCanvas').show();

									    	$('#changeSize').prop('class','col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12');

									    	$('#submitThis').hide();
									    	$('#chooseExist').show();

									    	$('#savedImage').hide();
									    	$('#newDesign').hide();
									    	$('#saveDesign').show();

									    	$('#anotherDesign').hide();
									    	$('#productDesc').hide();
									    	lc.clear();
									    });
									  });
									/*window.onload = function(){
									var canvas = document.getElementById("canvas");
									var img = document.getElementById('frame2');
									var ctx = canvas.getContext("2d");
									
									ctx.drawImage(img,10,10);
									}*/

									/*
									var canvas;
									canvas = document.getElementById('canvas');

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
									ctx.drawImage(frameimg,10,10,300,300);
									
	
										}

										function addFabricImage(id){
											
									var temp = 'fabric'+id;
									fabimg = document.getElementById(temp);
									ctx.globalCompositeOperation = 'source-in';
									ctx.drawImage(fabimg,10,10,300,300);
	
										}

										function tryKo(){
											alert('oke');
										}
										*/
									</script>
	</body>
</html>
