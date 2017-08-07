<?php
include "dbconnect.php";


$id = $_POST["id"];


if($id=="All"){
	$tempSQL = '';
	$tempID = "";
	$ctr = 0;
	$sql = "SELECT * FROM tblproduct order by productID desc;";
	$result = mysqli_query($conn, $sql);

	while ($row = mysqli_fetch_assoc($result)){
		$random = rand(0,2);
		if($row['prodTypeID']==""){$row['productDescription']="________________";}
		if($row['prodStat'] != "Archived"){
			echo ('
				<form method="get" id="formProduct">
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="text-align:center;">
				<div class="thumbnail instafilta-target">
				<div class="product-img">
				<img height="112px" width="120px" src="plugins/images/'.$row['prodMainPic'].'"/>
				<div class="pro-img-overlay">
				<button type="button" class="btn btn-info" data-toggle="modal" href="prod-forms.php" data-remote="prod-forms.php?id='.$row['productID'].' #view" data-target="#myProduct" value="'.$row['productID'].'" style="margin-top:20px;">View Product<br>Details<input type="hidden" id="idBtn" value="'.$row['productID'].'"/></button>
				</div>
				</div>
				<div class="product-text">
				<h3 class="box-title m-b-0">'.substr($row['productName'], 0,20).'</h3>
				<label>Price</label>
				<br>
				<span style="color:green; font-weight:600;">&#8369;'.number_format($row['productPrice'],2).'</span>
				<br><br>
				<label>Quantity</label>
				<input type="hidden" id="product'.$row['productID'].'" value="'.$row['productName'].'"/>
				<input type="hidden" id="price'.$row['productID'].'" value="'.$row['productPrice'].'"/>
				<input type="hidden" id="size'.$row['productID'].'" value="'.$row['prodSizeSpecs'].'"/>
				<input value="0" id="quant'.$row['productID'].'" type="number" class="form-control" step="1" min="0" value="" name="quantity" style="margin: 0 auto; width:65px; text-align:right;" required/>
				<br>
				<!-- ADD TO CART -->
				<button style="padding:10px 10px;" onclick="btnClick('.$row['productID'].')" id="'.$row['productID'].'"  type="button" class="btn btn-success" value="'.$row['productID'].'" >Add to Cart</button>
				</div>
				</div>
				</div>
				</form>
				'); 
				}
				$ctr++;
			}

		if($ctr==0){
			echo "<h2>Nothing to show.</h2>";
		}
		} 
else if($id=="On-Hand"){
	$tempSQL = '';
	$tempID = "";
	$ctr = 0;
	$sql = "SELECT * FROM tblproduct order by productID desc;";
	$result = mysqli_query($conn, $sql);

	while ($row = mysqli_fetch_assoc($result)){
		$random = rand(0,2);
		if($row['prodTypeID']==""){$row['productDescription']="________________";}
		if($row['prodStat'] == "On-Hand"){
			echo ('
				<form method="get" id="formProduct">
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="text-align:center;">
				<div class="thumbnail instafilta-target">
				<div class="product-img">
				<img height="112px" width="120px" src="plugins/images/'.$row['prodMainPic'].'"/>
				<div class="pro-img-overlay">
				<button type="button" class="btn btn-info" data-toggle="modal" href="prod-forms.php" data-remote="prod-forms.php?id='.$row['productID'].' #view" data-target="#myProduct" value="'.$row['productID'].'" style="margin-top:20px;">View Product<br>Details<input type="hidden" id="idBtn" value="'.$row['productID'].'"/></button>
				</div>
				</div>
				<div class="product-text">
				<h3 class="box-title m-b-0">'.substr($row['productName'], 0,20).'</h3>
				<label>Price</label>
				<br>
				<span style="color:green; font-weight:600;">&#8369;'.number_format($row['productPrice'],2).'</span>
				<br><br>
				<label>Quantity</label>
				<input type="hidden" id="product'.$row['productID'].'" value="'.$row['productName'].'"/>
				<input type="hidden" id="price'.$row['productID'].'" value="'.$row['productPrice'].'"/>
				<input type="hidden" id="size'.$row['productID'].'" value="'.$row['prodSizeSpecs'].'"/>
				<input value="0" id="quant'.$row['productID'].'" type="number" class="form-control" step="1" min="0" value="" name="quantity" style="margin: 0 auto; width:65px; text-align:right;" required/>
				<br>
				<!-- ADD TO CART -->
				<button style="padding:10px 10px;" onclick="btnClick('.$row['productID'].')" id="'.$row['productID'].'"  type="button" class="btn btn-success" value="'.$row['productID'].'" >Add to Cart</button>
				</div>
				</div>
				</div>
				</form>
				'); 
				}
				$ctr++;
			}

		if($ctr==0){
			echo "<h2>Nothing to show.</h2>";
		}
		} 
else if($id=="Packages"){
	$tempSQL = '';
	$tempID = "";
	$ctr = 0;
	$sql = "SELECT * FROM tblpackages";
	$result = mysqli_query($conn, $sql);

	while ($row = mysqli_fetch_assoc($result)){
		$random = rand(0,2);
		//if($row['prodTypeID']==""){$row['productDescription']="________________";}
		if($row['packageStatus'] == "Listed"){
			echo ('
				<form method="get" id="formProduct">
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="text-align:center;">
				<div class="thumbnail instafilta-target">
				<div class="product-img">
				<img height="112px" width="120px" src="plugins/images/package"/>
				<div class="pro-img-overlay">
				<button type="button" class="btn btn-info" data-toggle="modal" href="packages-form.php" data-remote="packages-form.php?id='.$row['packageID'].' #viewOMPackage" data-target="#myPackages" value="'.$row['packageID'].'" style="margin-top:20px;">View Package<br>Details<input type="hidden" id="idBtn" value="'.$row['packageID'].'"/></button>
				</div>
				</div>
				<div class="product-text">
				<label>Price</label>
				<br>
				<span style="color:green; font-weight:600;">&#8369;'.number_format($row['packagePrice'],2).'</span>
				<br><br>
				<h3 class="box-title m-b-0">'.substr($row['packageDescription'], 0,20).'</h3>
				<label>Quantity</label>
				<input type="hidden" id="product'.$row['packageID'].'" value="'.$row['packageDescription'].'"/>
				<input type="hidden" id="price'.$row['packageID'].'" value="'.$row['packagePrice'].'"/>
				<input type="hidden" id="size'.$row['packageID'].'" value="'.$row['packageDescription'].'"/>
				<input value="0" id="quant'.$row['packageID'].'" type="number" class="form-control" step="1" min="0" value="" name="quantity" style="margin: 0 auto; width:65px; text-align:right;" required/>
				<br>
				<!-- ADD TO CART -->
				<button style="padding:10px 10px;" onclick="btnClick('.$row['packageID'].')" id="'.$row['packageID'].'"  type="button" class="btn btn-success" value="'.$row['packageID'].'" >Add to Cart</button>
				</div>
				</div>
				</div>
				</form>
				'); 
				}
				$ctr++;
			}
		if($ctr==0){
			echo "<h2>Nothing to show</h2>";
		}
		}
else{ //category
	$tempSQL = '';
	$tempID = "";
	$ctr = 0;
	$sql = "SELECT * FROM tblproduct WHERE prodCatID = '$id'";
	$result = mysqli_query($conn, $sql);
	while ($row = mysqli_fetch_assoc($result)){
		$random = rand(0,2);
		if($row['prodTypeID']==""){$row['productDescription']="________________";}
		if($row['prodStat'] != "Archived"){
			echo ('
				<form method="get" id="formProduct">
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="text-align:center;">
				<div class="thumbnail instafilta-target">
				<div class="product-img">
				<img height="112px" width="120px" src="plugins/images/'.$row['prodMainPic'].'"/>
				<div class="pro-img-overlay">
				<button type="button" class="btn btn-info" data-toggle="modal" href="prod-forms.php" data-remote="prod-forms.php?id='.$row['productID'].' #view" data-target="#myProduct" value="'.$row['productID'].'" style="margin-top:20px;">View Product<br>Details<input type="hidden" id="idBtn" value="'.$row['productID'].'"/></button>
				</div>
				</div>
				<div class="product-text">
				<h3 class="box-title m-b-0">'.substr($row['productName'], 0,20).'</h3>
				<label>Price</label>
				<br>
				<span style="color:green; font-weight:600;">&#8369;'.number_format($row['productPrice'],2).'</span>
				<br><br>
				<label>Quantity</label>
				<input type="hidden" id="product'.$row['productID'].'" value="'.$row['productName'].'"/>
				<input type="hidden" id="price'.$row['productID'].'" value="'.$row['productPrice'].'"/>
				<input type="hidden" id="size'.$row['productID'].'" value="'.$row['prodSizeSpecs'].'"/>
				<input value="0" id="quant'.$row['productID'].'" type="number" class="form-control" step="1" min="0" value="" name="quantity" style="margin: 0 auto; width:65px; text-align:right;" required/>
				<br>
				<!-- ADD TO CART -->
				<button style="padding:10px 10px;" onclick="btnClick('.$row['productID'].')" id="'.$row['productID'].'"  type="button" class="btn btn-success" value="'.$row['productID'].'" >Add to Cart</button>
				</div>
				</div>
				</div>
				</form>
				'); 
				$ctr++;
				}
			}
		if($ctr==0){
			echo "<h2>Nothing to show.</h2>";
		}
		} 


if(isset($_POST['type'])){	
	$tempSQL = '';
	$tempID = "";
	$ctr = 0;
	$sql = "SELECT * FROM tblproduct WHERE prodTypeID = '$id'";
	$result = mysqli_query($conn, $sql);
	while ($row = mysqli_fetch_assoc($result)){
		$random = rand(0,2);
		if($row['prodTypeID']==""){$row['productDescription']="________________";}
		if($row['prodStat'] != "Archived"){
			echo ('
				<form method="get" id="formProduct">
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12" style="text-align:center;">
				<div class="thumbnail instafilta-target">
				<div class="product-img">
				<img height="112px" width="120px" src="plugins/images/'.$row['prodMainPic'].'"/>
				<div class="pro-img-overlay">
				<button type="button" class="btn btn-info" data-toggle="modal" href="prod-forms.php" data-remote="prod-forms.php?id='.$row['productID'].' #view" data-target="#myProduct" value="'.$row['productID'].'" style="margin-top:20px;">View Product<br>Details<input type="hidden" id="idBtn" value="'.$row['productID'].'"/></button>
				</div>
				</div>
				<div class="product-text">
				<h3 class="box-title m-b-0">'.substr($row['productName'], 0,20).'</h3>
				<label>Price</label>
				<br>
				<span style="color:green; font-weight:600;">&#8369;'.number_format($row['productPrice'],2).'</span>
				<br><br>
				<label>Quantity</label>
				<input type="hidden" id="product'.$row['productID'].'" value="'.$row['productName'].'"/>
				<input type="hidden" id="price'.$row['productID'].'" value="'.$row['productPrice'].'"/>
				<input type="hidden" id="size'.$row['productID'].'" value="'.$row['prodSizeSpecs'].'"/>
				<input value="0" id="quant'.$row['productID'].'" type="number" class="form-control" step="1" min="0" value="" name="quantity" style="margin: 0 auto; width:65px; text-align:right;" required/>
				<br>
				<!-- ADD TO CART -->
				<button style="padding:10px 10px;" onclick="btnClick('.$row['productID'].')" id="'.$row['productID'].'"  type="button" class="btn btn-success" value="'.$row['productID'].'" >Add to Cart</button>
				</div>
				</div>
				</div>
				</form>
				'); 
				$ctr++;
				}
			}
		if($ctr==0){
			echo "<h2>Nothing to show.</h2>";
		}
		} 




?> 