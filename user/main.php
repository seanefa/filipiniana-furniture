<div class="wrapper-wide">
<?php include"header.php";?>
<?php include"revolutionslider.php";?>
  <div id="container">
    <div class="container">
      <div class="row">
        <!-- Feature Box Start-->
        <div class="container">
          <div class="custom-feature-box row">
            <div class="col-sm-6 col-xs-12">
              <div class="feature-box fbox_1">
                <div class="title">Free Shipping</div>
                <p>Free shipping on order over Php 100,000</p>
              </div>
            </div>
            <div class="col-sm-6 col-xs-12">
              <div class="feature-box fbox_2">
                <div class="title">Easy Return</div>
                <p>Easy return in *insert number of days here* days after purchasing</p>
              </div>
            </div>
          </div>
        </div>
        <!-- Feature Box End-->
      </div>
    </div>
    <div class="container">
      <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-xs-12">
          <!-- Banner Start -->
          <div class="marketshop-banner">
            <div class="row">
              <!-- PRODUCT -->
              <?php
              include "userconnect.php";
              $sql = "SELECT * FROM tblproduct WHERE prodStat = 'Pre-Order' LIMIT 8";
              $result = mysqli_query($conn, $sql);
              if(mysqli_num_rows($result) > 0)
              {
                while($row = mysqli_fetch_assoc($result))
                {
                  ?>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-x">
                    <form method="post">
                      <input type="hidden" value="<?php echo "" . $row["prodID"];?>" name="i_d"/>
                    </form>
                    <div class="hovereffect card">
                      <img class="card-img-top img-fluid" onerror="productImgError(this);" style="height: 230px; width:auto;" alt="" src="/admin/plugins/products/<?php echo "" . $row["prodMainPic"];?>">
                      <div class="overlay">
                        <h2>
                        <?php echo "" . $row["productName"]; ?>
                        <br><br>
                        Php&nbsp;<?php echo "" . number_format($row["productPrice"]); ?>
                        </h2>
                      </div>
                    </div>
                  </div>
                  <?php
                }
              }
              mysqli_close($conn);
              ?>

              <!-- PROMO -->
              <?php
              include "userconnect.php";
              $sql = "SELECT * FROM tblpromos where promoStatus = 'Active' limit 6";
              $result = mysqli_query($conn, $sql);
              if(mysqli_num_rows($result) > 0)
              {
                while($row = mysqli_fetch_assoc($result))
                {
                  ?>
                  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="hovereffect card">
                      <img class="img-fluid" onerror="promoImgError(this);" src="/admin/plugins/promos/<?php echo "" . $row["promoImage"];?>" style="height: 230px; width:auto;">
                      <div class="overlay">
                        <h2><?php echo "" . $row["promoName"];?></h2>
                      </div>
                    </div>
                  </div>
                  <?php
                }
              }
              mysqli_close($conn);
              ?>
            </div>
          </div>
          <!-- Banner End -->
          <!-- Product Tab Start -->
          <div id="product-tab" class="product-tab">
            <ul id="tabs" class="tabs">
              <li><a href="#tab-featured">Featured</a></li>
              <li><a href="#tab-latest">Latest</a></li>
              <li><a href="#tab-bestseller">Bestseller</a></li>
              <li><a href="#tab-special">Special</a></li>
            </ul>
            <div id="tab-featured" class="tab_content">
              <div class="owl-carousel product_carousel_tab">
                <div class="product-thumb clearfix">
                  <div class="image"><a href="view-product.php"><img src="image/product/apple_cinema_30-270x405.jpg" alt="Product" title="Product" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="view-product.php">Product</a></h4>
                    <p class="price"><span class="price-new">&#8369 110.00</span> <span class="price-old">&#8369 122.00</span><span class="saving">-10%</span></p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick="cart.add('42');"><span>Add to Cart</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="Add to Wish List" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="Compare this Product" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
                <div class="product-thumb clearfix">
                  <div class="image"><a href="view-product.php"><img src="image/product/samsung_tab_1-270x405.jpg" alt="Product" title="Product" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="view-product.php">Product</a></h4>
                    <p class="price"> <span class="price-new">&#8369 230.00</span> <span class="price-old">&#8369 241.99</span> <span class="saving">-5%</span> </p>
                    <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick="cart.add('49');"><span>Add to Cart</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="Add to Wish List" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="Compare this Product" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
                <div class="product-thumb clearfix">
                  <div class="image"><a href="view-product.php"><img src="image/product/sony_vaio_1-270x405.jpg" alt="Product" title="Product" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="view-product.php">Product</a></h4>
                    <p class="price"> <span class="price-new">&#8369 902.00</span> <span class="price-old">&#8369 1,202.00</span> <span class="saving">-25%</span> </p>
                    <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick="cart.add('46');"><span>Add to Cart</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="Add to Wish List" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="Compare this Product" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
                <div class="product-thumb clearfix">
                  <div class="image"><a href="view-product.php"><img src="image/product/macbook_1-270x405.jpg" alt="Product" title="Product" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="view-product.php">Product</a></h4>
                    <p class="price"> &#8369 211.00 </p>
                    <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick="cart.add('43');"><span>Add to Cart</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="Add to Wish List" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="Compare this Product" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
                <div class="product-thumb clearfix">
                  <div class="image"><a href="view-product.php"><img src="image/product/iphone_1-270x405.jpg" alt="Product" title="Product" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="view-product.php">Product</a></h4>
                    <p class="price"> &#8369 123.20 </p>
                    <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>Add to Cart</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="Add to Wish List" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="Compare this Product" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
                <div class="product-thumb clearfix">
                  <div class="image"><a href="view-product.php"><img src="image/product/canon_eos_5d_1-270x405.jpg" alt="Product" title="Product" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="view-product.php">Product</a></h4>
                    <p class="price"> <span class="price-new">&#8369 98.00</span> <span class="price-old">&#8369 122.00</span> <span class="saving">-20%</span> </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>Add to Cart</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="Add to Wish List" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="Compare this Product" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div id="tab-latest" class="tab_content">
              <div class="owl-carousel product_carousel_tab">
                <div class="product-thumb">
                  <div class="image"><a href="view-product.php"><img src="image/product/macbook_2-270x405.jpg" alt="Product" title="Product" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="view-product.php">Product</a></h4>
                    <p class="price"> &#8369 110.00 </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>Add to Cart</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="Add to wishlist" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="Add to compare" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
                <div class="product-thumb">
                  <div class="image"><a href="view-product.php"><img src="image/product/macbook_3-270x405.jpg" alt="Product" title="Product" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="view-product.php">Product</a></h4>
                    <p class="price"> &#8369 123.00 </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>Add to Cart</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="Add to wishlist" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="Add to compare" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
                <div class="product-thumb">
                  <div class="image"><a href="view-product.php"><img src="image/product/macbook_4-270x405.jpg" alt="Product" title="Product" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="view-product.php">Product</a></h4>
                    <p class="price"> &#8369 85.00 </p>
                    <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>Add to Cart</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="Add to wishlist" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="Add to compare" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
                <div class="product-thumb">
                  <div class="image"><a href="view-product.php"><img src="image/product/iphone_6-270x405.jpg" alt="Product" title="Product" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="view-product.php">Product</a></h4>
                    <p class="price"> &#8369 134.00 </p>
                    <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>Add to Cart</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="Add to wishlist" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="Add to compare" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
                <div class="product-thumb">
                  <div class="image"><a href="view-product.php"><img src="image/product/nikon_d300_5-270x405.jpg" alt="Product" title="Product" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="view-product.php">Product</a></h4>
                    <p class="price"> <span class="price-new">&#8369 66.80</span> <span class="price-old">&#8369 90.80</span> <span class="saving">-27%</span> </p>
                    <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>Add to Cart</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="Add to wishlist" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="Add to compare" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
                <div class="product-thumb">
                  <div class="image"><a href="view-product.php"><img src="image/product/nikon_d300_4-270x405.jpg" alt="Product" title="Product" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="view-product.php">Product</a></h4>
                    <p class="price"> &#8369 88.00 </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>Add to Cart</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="Add to wishlist" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="Add to compare" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
                <div class="product-thumb">
                  <div class="image"><a href=""><img src="image/product/macbook_5-270x405.jpg" alt="Product" title="Product" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="view-product.php">Product</a></h4>
                    <p class="price"> <span class="price-new">&#8369 95.00</span> <span class="price-old">&#8369 99.00</span> <span class="saving">-4%</span> </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick="cart.add('61');"><span>Add to Cart</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="Add to wishlist" onClick="wishlist.add('61');"><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="Add to compare" onClick="compare.add('61');"><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div id="tab-bestseller" class="tab_content">
              <div class="owl-carousel product_carousel_tab">
                <div class="product-thumb">
                  <div class="image"><a href="view-product.php"><img src="image/product/FinePix-Long-Zoom-Camera-270x405.jpg" alt="Product" title="Product" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="view-product.php">Product</a></h4>
                    <p class="price"> &#8369 122.00 </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>Add to Cart</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="Add to wishlist" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="Add to compare" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
                <div class="product-thumb">
                  <div class="image"><a href="view-product.php"><img src="image/product/nikon_d300_1-270x405.jpg" alt="Product" title="Product" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="view-product.php">Product</a></h4>
                    <p class="price"> <span class="price-new">&#8369 92.00</span> <span class="price-old">&#8369 98.00</span> <span class="saving">-6%</span> </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>Add to Cart</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="Add to wishlist" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="Add to compare" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div id="tab-special" class="tab_content">
              <div class="owl-carousel product_carousel_tab">
                <div class="product-thumb">
                  <div class="image"><a href="view-product.php"><img src="image/product/ipod_touch_1-270x405.jpg" alt="Product" title="Product" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="view-product.php">Product</a></h4>
                    <p class="price"> <span class="price-new">&#8369 62.00</span> <span class="price-old">&#8369 122.00</span> <span class="saving">-50%</span> </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>Add to Cart</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="Add to wishlist" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="Add to compare" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
                <div class="product-thumb">
                  <div class="image"><a href=""><img src="image/product/macbook_5-270x405.jpg" alt="Product" title="Product" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="view-product.php">Product</a></h4>
                    <p class="price"> <span class="price-new">&#8369 95.00</span> <span class="price-old">&#8369 99.00</span> <span class="saving">-4%</span> </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick="cart.add('61');"><span>Add to Cart</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="Add to wishlist" onClick="wishlist.add('61');"><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="Add to compare" onClick="compare.add('61');"><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
                <div class="product-thumb">
                  <div class="image"><a href="view-product.php"><img src="image/product/macbook_air_1-270x405.jpg" alt="Product" title="Product" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="view-product.php">Product</a></h4>
                    <p class="price"> <span class="price-new">&#8369 1,142.00</span> <span class="price-old">&#8369 1,202.00</span> <span class="saving">-5%</span> </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>Add to Cart</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="Add to wishlist" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="Add to compare" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
                <div class="product-thumb clearfix">
                  <div class="image"><a href="view-product.php"><img src="image/product/apple_cinema_30-270x405.jpg" alt="Product" title="Product" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="view-product.php">Product</a></h4>
                    <p class="price"><span class="price-new">&#8369 110.00</span> <span class="price-old">&#8369 122.00</span><span class="saving">-10%</span></p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick="cart.add('42');"><span>Add to Cart</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="Add to Wish List" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="Compare this Product" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
                <div class="product-thumb">
                  <div class="image"><a href="view-product.php"><img src="image/product/macbook_pro_1-270x405.jpg" alt=" Product " title=" Product " class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="view-product.php"> Product </a></h4>
                    <p class="price"> <span class="price-new">&#8369 1,400.00</span> <span class="price-old">&#8369 1,900.00</span> <span class="saving">-26%</span> </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>Add to Cart</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="Add to wishlist" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="Add to compare" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
                <div class="product-thumb">
                  <div class="image"><a href="view-product.php"><img src="image/product/samsung_tab_1-270x405.jpg" alt="Product" title="Product" class="img-responsive" /></a></div>
                  <div class="caption">
                    <h4><a href="view-product.php">Product</a></h4>
                    <p class="price"> <span class="price-new">&#8369 230.00</span> <span class="price-old">&#8369 241.99</span> <span class="saving">-5%</span> </p>
                    <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>Add to Cart</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="Add to wishlist" onClick=""><i class="fa fa-heart"></i></button>
                      <button type="button" data-toggle="tooltip" title="Add to compare" onClick=""><i class="fa fa-exchange"></i></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Product Tab Start -->
        </div>
        <!--Middle Part End-->
      </div>
    </div>
  </div>
<?php include"footer.php";?>
</div>