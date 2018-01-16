<?php
include "userconnect.php";
$sql = "SELECT * FROM tblcompany_info";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="image/favicon.ico" rel="icon" />
<title>Packages - <?php echo $row['comp_name']?></title>
<meta name="description" content="Furniture shop">
<?php include"css.php";?>
</head>
<body>
<div class="wrapper-wide">
<?php include"header.php";?>
<div id="container">
    <div class="container">
      <!-- Breadcrumb Start-->
      <ul class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i></a></li>
        <li><a href="products.php">Packages</a></li>
      </ul>
      <!-- Breadcrumb End-->
      <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-12">
          <h1 class="title">Packages</h1>
          
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
                $ctr = 0;
                $sql="SELECT * from tblpackages order by packageID desc;";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)){
                  if($row['packageStatus'] != "Archived"){
                    echo '<div class="product-layout product-list col-xs-12">
                    <div class="product-thumb">
                    <div class="image"><a href="view-package.php?id='.$row['packageID'].'"><img style="height:280px; width:200;" src="../admin/plugins/images/2017-08-241503568724.png" alt="Product" class="img-responsive" onerror="productImgError(this);"/></a></div>
                    <div class="caption">
                      <br>
                      <h4><a href="view-product.php">'.substr($row['packageDescription'], 0,20).'</a></h4>
                      <p class="price"><span class="price-new">&#8369;'.number_format($row['packagePrice'],2).'</span> <span class="price-old"> </span></p>
                      
                      
                    </div>
                    ';?>
                    <div class="button-group">
                      <button href="#myModal1" data-toggle="modal" data-id="<?php echo $row['packageID'] ?>" data-name="<?php echo $row['packageDescription'] ?>" data-summary="Package" data-price="<?php echo $row['packagePrice'] ?>" data-quantity="1" data-image="../admin/plugins/images/2017-08-241503568724.png" class="btn-primary my-cart-btn"><span>Add to Cart</span></button>
                    </div>
                  </div>
                </div><?php echo '';
                }
                $ctr++;
              }
              ?>
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
</div>
<?php include"footer.php";?>
<?php include"scripts.php";?>
</body>
</html>