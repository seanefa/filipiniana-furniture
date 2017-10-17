<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="image/favicon.ico" rel="icon" />
<title>Search - Filipiniana Furniture Shop</title>
<meta name="description" content="Furniture shop">
<?php include"css.php";?>
</head>
<body>
<div class="wrapper-wide">
<?php include"header.php";?>

  <?php
  include "userconnect.php";

  $str ='';
  if(isset($_POST['search'])){
  $str = $_POST['search'];
  }

  $str = mysqli_real_escape_string($conn, $str);

  $sql = "SELECT * FROM tblproduct where productName like '$str%'";
  $result = mysqli_query($conn,$sql);


  ?>
  <div id="container">
    <div class="container">
      <!-- Breadcrumb Start-->
      <ul class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i></a></li>
        <li><a href="search.php">Search</a></li>
      </ul>
      <!-- Breadcrumb End-->
      <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-12">
          <h1 class="title">Search - <?php echo $str;?></h1>
          
          <br>
          <div class="product-filter">
            <div class="row">
              <div class="col-md-4 col-sm-5">
                <div class="btn-group">
                  <button type="button" id="list-view" class="btn btn-default" data-toggle="tooltip" title="List"><i class="fa fa-th-list"></i></button>
                  <button type="button" id="grid-view" class="btn btn-default" data-toggle="tooltip" title="Grid"><i class="fa fa-th"></i></button>
                </div>
            </div>
          </div>
          <br />
          <div class="row products-category">
            <?php
            if(mysqli_num_rows($result) != 0){

            while($row = mysqli_fetch_assoc($result)){
              
            ?>
            <div class="product-layout product-list col-xs-12">
              <div class="product-thumb">
                <div class="image"><a href="view-product.php?id=<?php echo $row['productID'] ?>"><img style="height:280px; width:200;" src="../admin/plugins/images/<?php echo $row['prodMainPic']; ?>" alt="Product" class="img-responsive" onerror="productImgError(this);"/></a></div>
                <div>
                  <div class="caption">
                    <h4><a href="view-product.php?id=<?php echo $row['productID'] ?>"><?php echo $row['productName'];?></a></h4>
                    <p class="description"> <?php echo $row['productDescription'];?></p>
                    <p class="price"> <span class="price-new">&#8369;<?php echo number_format($row['productPrice']);?></span></p>
                  </div>
                  <div class="button-group">
                    <button type="button" class="btn btn-primary" data-backdrop="static" data-keyboard="false" data-toggle="modal" href="#viewProductModal" data-remote="product-form.php?id=<?php echo $row['productID']; ?> #view"><i class="glyphicon glyphicon-shopping-cart"></i> Add to Cart</button>
                  </div>
                </div>
              </div>
            </div>
            <?php
            
            }
          }else{
            echo '<h1 class="title">Product not found</h1>';
          }

            ?>
          </div>
        </div>
        <!--Middle Part End -->
      </div>
    </div>
  </div>
<?php include"footer.php";?>
</div>
<?php include"scripts.php";?>
</body>
</html>