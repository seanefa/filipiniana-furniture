<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link href="image/favicon.ico" rel="icon" />
  <link rel="stylesheet" href="css/myStyle.css">
  <title>Wishlists - Filipiniana Furniture Shop</title>
  <meta name="description" content="Furniture shop">
  <script type="text/javascript" src="js/myScript.js"></script>
  <?php include"css.php";?>
</head>
<body style="background: #ffffff;">
  <?php 
  include "header.php";
  if(!isset($_SESSION["userID"]))
  {
    echo "<script>
    window.location.href='login.php';
    alert('You have no access here. You must logged in first.');
    </script>";
  }
  ?>
  <div id="container">
    <div class="container">
      <ul class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-home"></i></a></li>
        <li><a href="wishlists.php">Wishlists</a></li>
      </ul>
      <br>
      <div class="row">
        <?php include "accountmenu.php"; ?>
        <!--Middle Part Start-->
        <div class="col-sm-9" id="content">
          <h2>My Wishlists</h2>
          <div class="row">
            <div class="col-sm-12">
              <div class="well">
                  
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td class="text-center">Image</td>
                  <td class="text-left">Product Name</td>
                  <td class="text-right">Availability</td>
                  <td class="text-right">Unit Price</td>
                  <td class="text-right">Action</td>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td class="text-center"><a href="product.php"><img src="image/product/samsung_tab_1-50x75.jpg" alt="Aspire Ultrabook Laptop" title="Aspire Ultrabook Laptop" /></a></td>
                  <td class="text-left"><a href="product.php">Product1</a></td>
                  <td class="text-right">In Stock</td>
                  <td class="text-right"><div class="price"> ₱ 25000.00 </div></td>
                  <td class="text-right"><button class="btn btn-primary" title="" data-toggle="tooltip" onClick="cart.add('48');" type="button" data-original-title="Add to Cart"><i class="fa fa-shopping-cart"></i></button>
                    <a class="btn btn-danger" title="" data-toggle="tooltip" href="http://localhost/2.2.0.0-compiled/index.php?route=account/wishlist&amp;remove=48" data-original-title="Remove"><i class="fa fa-times"></i></a></td>
                </tr>
                <tr>
                  <td class="text-center"><a href="product.php"><img src="image/product/sony_vaio_1-50x75.jpg" alt="Xitefun Causal Wear Fancy Shoes" title="Xitefun Causal Wear Fancy Shoes" /></a></td>
                  <td class="text-left"><a href="product.php">Product2</a></td>
                  <td class="text-right">Pre-Order</td>
                  <td class="text-right"><div class="price"> ₱ 40000.00 </div></td>
                  <td class="text-right"><button class="btn btn-primary" title="" data-toggle="tooltip" onClick="" type="button" data-original-title="Add to Cart"><i class="fa fa-shopping-cart"></i></button>
                    <a class="btn btn-danger" title="" data-toggle="tooltip" href="" data-original-title="Remove"><i class="fa fa-times"></i></a></td>
                </tr>
              </tbody>
            </table>
          </div>
              </div>
            </div>
          </div>
        </div>
        <!--Middle Part End -->
      </div>
    </div>
  </div>
  <?php include"footer.php";?>
  <!--img src="pics/userpictures/<?php echo "" . $row["customerDP"];?>" style="height:150px; width:150px;" alt="Product" class="img-responsive profilepic"/-->
  <?php include "scripts.php";?>
</body>
</html>