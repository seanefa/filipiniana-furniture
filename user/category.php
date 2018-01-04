<!DOCTYPE html>
<html>
<head>
<?php 
  
  include "userconnect.php";
  $thisID = $_GET['id'];
  $catID ='';
  $typeID = '';
  $ttlesql = '';
  if(substr($thisID,0,1) == 'C'){
    $catID = substr($thisID,1);
    $ttlesql = "SELECT * FROM tblfurn_category where categoryID = '$catID';";

  }else if(substr($thisID,0,1) == 'T'){
    $typeID = substr($thisID,1);
    $ttlesql = "SELECT * FROM tblfurn_type where typeID = '$typeID';";

  }
  $ttlresult = mysqli_query($conn,$ttlesql);

  $ttlerow = mysqli_fetch_assoc($ttlresult);

  
?>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="image/favicon.ico" rel="icon" />
<title><?php if(substr($thisID,0,1) == "C"){ echo $ttlerow['categoryName']; }else if(substr($thisID,0,1) == "T"){ echo $ttlerow['typeName']; }?> - Filipiniana Furniture Shop</title>
<meta name="description" content="Furniture shop">
<?php include"css.php";?>
</head>
<body>
<div class="wrapper-wide">
<?php include"header.php";?>
<script type="text/javascript">
  
</script>
  <div id="container">
    <div class="container">
      <!-- Breadcrumb Start-->
      <ul class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i></a></li>
        <li><a href="products.php"><?php if(substr($thisID,0,1) == "C"){ echo $ttlerow['categoryName']; }else if(substr($thisID,0,1) == "T"){ echo $ttlerow['typeName']; }?></a></li>
      </ul>
      <!-- Breadcrumb End-->
      <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-12">
          <h1 class="title"><?php if(substr($thisID,0,1) == "C"){ echo $ttlerow['categoryName']; }else if(substr($thisID,0,1) == "T"){ echo $ttlerow['typeName']; }?></h1>
          
          <div class="product-filter">
            <div class="row">
              <div class="col-md-4 col-sm-5">
                <div class="btn-group">
                  <button type="button" id="list-view" class="btn btn-default" data-toggle="tooltip" title="List"><i class="fa fa-th-list"></i></button>
                  <button type="button" id="grid-view" class="btn btn-default" data-toggle="tooltip" title="Grid"><i class="fa fa-th"></i></button>
                </div>
                <!--a href="compare.php" id="compare-total">Product Compare (0)</a--> 
              </div>
              <div class="col-sm-2 text-right">
                <label class="control-label" for="input-sort">Sort By:</label>
              </div>
              <div class="col-md-3 col-sm-2 text-right">
                <select id="input-sort" class="form-control col-sm-3">
                  <option value="" selected="selected">Default</option>
                  <!--option value="">Name (A - Z)</option>
                  <option value="">Name (Z - A)</option>
                  <option value="">Price (Low &gt; High)</option>
                  <option value="">Price (High &gt; Low)</option>
                  <option value="">Rating (Highest)</option>
                  <option value="">Rating (Lowest)</option>
                  <option value="">Model (A - Z)</option>
                  <option value="">Model (Z - A)</option-->
                </select>
              </div>
              <div class="col-sm-1 text-right">
                <label class="control-label" for="input-limit">Show:</label>
              </div>
              <div class="col-sm-2 text-right">
                <select id="input-limit" class="form-control">
                  <option value="" selected="selected">20</option>
                  <option value="">25</option>
                  <option value="">50</option>
                  <option value="">75</option>
                  <option value="">100</option>
                </select>
              </div>
            </div>
          </div>
          <br />
          <div class="row products-products">
              <?php
                include "userconnect.php";
                 if(substr($thisID,0,1) == "C"){ 
 
                  $ctr = 0;
                $sql="SELECT * from tblproduct where prodCatID = '$catID' order by productID desc;";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)){
                  if($row['prodTypeID']==""){$row['productDescription']="________________";}
                  if($row['prodStat'] != "Archived"){
                    echo ' <div class="product-layout product-list col-xs-12">
                    <div class="product-thumb">
                    <div class="image"><a href="view-product.php?id='.$row['productID'].'"><img style="height:405px; width:270;" src="../admin/plugins/products/'.$row['prodMainPic'].'" alt="'. $row["productName"].'" class="img-responsive" onerror="productImgError(this);"/></a></div>
                    <br>
                    <div class="caption">
                      <h4><a href="view-product.php">'.substr($row['productName'], 0,20).'</a></h4>
                      <p class="price"><span class="price-new">&#8369;'.number_format($row['productPrice'],2).'</span> <span class="price-old"> </span></p>
                    </div>
                    ';?>
                    <div class="button-group">
                     <button type="button" class="btn btn-primary" data-toggle="modal" href="#viewProductModal" data-remote="product-form.php?id=<?php echo $row['productID'];?> #view"><i class='fa fa-info-circle'></i>Add to Cart</button>
                    </div>
                  </div>
                </div><?php echo'';
                }
                $ctr++;
              }

                  }

                 else if(substr($thisID,0,1) == "T"){ 
                  $ctr = 0;
                $sql="SELECT * from tblproduct where prodTypeID = '$typeID' order by productID desc;";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)){
                  if($row['prodTypeID']==""){$row['productDescription']="________________";}
                  if($row['prodStat'] != "Archived"){
                    echo ' <div class="product-layout product-list col-xs-12">
                    <div class="product-thumb">
                    <div class="image"><a href="view-product.php?id='.$row['productID'].'"><img style="height:405px; width:270;" src="../admin/plugins/products/'.$row['prodMainPic'].'" alt="'. $row["productName"].'" class="img-responsive" onerror="productImgError(this);"/></a></div>
                    <br>
                    <div class="caption">
                      <h4><a href="view-product.php">'.substr($row['productName'], 0,20).'</a></h4>
                      <p class="price"><span class="price-new">&#8369;'.number_format($row['productPrice'],2).'</span> <span class="price-old"> </span></p>
                    </div>
                    ';?>
                    <div class="button-group">
                     <button type="button" class="btn btn-primary" data-toggle="modal" href="#viewProductModal" data-remote="product-form.php?id=<?php echo $row['productID'];?> #view"><i class='fa fa-info-circle'></i>Add to Cart</button>
                    </div>
                  </div>
                </div><?php echo'';
                }
                $ctr++;
              }

                }

                
              ?>
            </div>
          </div>
          <!--div class="row">
            <div class="col-sm-6 text-left">
              <ul class="pagination">
                <li class="active"><span>1</span></li>
                <li><a href="#">2</a></li>
                <li><a href="#">&gt;</a></li>
                <li><a href="#">&gt;|</a></li>
              </ul>
            </div>
            <div class="col-sm-6 text-right">Showing 1 to 12 of 15 (2 Pages)</div>
          </div>
        </div-->
        <!--Middle Part End -->
      </div>
    </div>
  </div>
<?php include"footer.php";?>
</div>
<?php include"scripts.php";?>
</body>
</html>