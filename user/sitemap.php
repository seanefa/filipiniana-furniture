<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="image/favicon.ico" rel="icon" />
<title>Site Map - Filipiniana Furniture Shop</title>
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
        <li><a href="sitemap.php">Site Map</a></li>
      </ul>
      <!-- Breadcrumb End-->
      <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-12">
          <h1 class="title">Site Map</h1>
          <div class="row">
            <div class="col-sm-3 hidden-xs hidden-sm sitemap-icon"><i class="fa fa-sitemap"></i></div>
            <div class="col-md-5 col-sm-6">
              <ul class="sitemap">
                <li><a href="products.php">Furnitures</a>
                  <ul>
                    <li><a href="category.php">Categories</a>
                      <ul>
						  <?php
						  include "userconnect.php";
						  $sql="SELECT * from tblfurn_category";
						  $result=$conn->query($sql);
						  if($result->num_rows>0){
							  while($row=$result->fetch_assoc()){
							?>
                        <li><a href="category.php?id=C<?php echo $row['categoryID']?>"><?php echo "" . $row["categoryName"];?></a></li>
						  <?php
							  }
						  }
						  ?>
                      </ul>
					</li>
					  <li><a href="">Types</a>
						  <ul>
							  <?php
							  include "userconnect.php";
							  $sql="SELECT * from tblfurn_type";
							  $result=$conn->query($sql);
							  if($result->num_rows>0){
								  while($row=$result->fetch_assoc()){
								?>
							  <li><a href="category.php?id=T<?php echo $row['typeID']?>"><?php echo "" . $row["typeName"];?></a></li>
							  <?php
								  }
							  }
							  $conn->close();
							  ?>
						  </ul>
					  </li>
                  </ul>
                </li>
                <li><a href="packages.php">Packages</a>
                  <ul>
					  <?php
					  include "userconnect.php";
					  $sql="SELECT * from tblpackages";
					  $result=$conn->query($sql);
					  if($result->num_rows>0){
						  while($row=$result->fetch_assoc()){
						?>
                    
					  <?php
						  }
					  }
					  $conn->close();
					  ?>
                  </ul>
                </li>
                <li><a href="promos.php">Promos</a>
                </li>
              </ul>
            </div>
            <div class="col-md-4 col-sm-6">
              <ul class="sitemap">
                <li><a href="#">Special Offers</a></li>
                <li><a href="login.php">My Account</a>
                  <ul>
                    <li><a href="account.php">Account Dashboard</a></li>
                    <li><a href="addressbook.php">Address Book</a></li>
                    <li><a href="customization.php">Customization</a></li>
                    <li><a href="orders.php">Orders</a></li>
                    <li><a href="updateinfo.php">Personal Information</a></li>
                    <li><a href="production.php">Production Information</a></li>
                    <li><a href="proof-of-payment-form.php">Proof of Payment</a></li>
                    <li><a href="returns.php">Returns</a></li>
                    <li><a href="reviews.php">Reviews</a></li>
                  </ul>
                </li>
                <li><a href="">Shopping Cart</a></li>
                <li><a href="checkout.php">Checkout</a></li>
                <li><a href="search.php">Search</a></li>
                <li><a href="#">Information</a>
                  <ul class="sitemap">
                    <li><a href="about-us.php">About Us</a></li>
                    <li><a href="delivery-information.php">Delivery Information</a></li>
                    <li><a href="privacy-policy.php">Privacy Policy</a></li>
                    <li><a href="terms-condition.php">Terms &amp; Conditions</a></li>
                    <li><a href="contact-us">Contact Us</a></li>
                  </ul>
                </li>
              </ul>
            </div>
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