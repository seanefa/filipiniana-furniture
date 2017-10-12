<!DOCTYPE html>

<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="image/favicon.ico" rel="icon" />
<title>Package - Filipiniana Furniture Shop</title>
<meta name="description" content="Furniture shop">
<?php include"css.php";?>
</head>
<body>
<div class="wrapper-wide">
<?php include"header.php";?>  <div id="container">
    <div class="container">
      <!-- Breadcrumb Start-->
      <ul class="breadcrumb">
        <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="index.php" itemprop="url"><span itemprop="title"><i class="fa fa-home"></i></span></a></li>
        <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="products.php" itemprop="url"><span itemprop="title">Package</span></a></li>
        <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="view-product.php" itemprop="url"><span itemprop="title">Package</span></a></li>
      </ul>
      <!-- Breadcrumb End-->
      <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-12">
          <?php

include "userconnect.php";

$id = $_GET['id'];

$sql = "SELECT * FROM tblpackages where packageID = '$id'";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);

/*
                  $frameID = $row['prodFrameworkID'];
                  $fabricID = $row['prodFabricID'];
                  $catID = $row['prodCatID'];
                  $typeID = $row['prodTypeID'];

$frameSql = "SELECT * from tblframeworks where frameworkID = '$frameID'";
$frameresult = mysqli_query($conn,$frameSql);
$framerow = mysqli_fetch_assoc($frameresult);

$fabricSql = "SELECT * from tblfabrics where fabricID = '$fabricID'";
$fabricresult = mysqli_query($conn,$fabricSql);
$fabricrow = mysqli_fetch_assoc($fabricresult);

$catSql = "SELECT * from tblfurn_category where categoryID = '$catID'";
$catresult = mysqli_query($conn,$catSql);
$catrow = mysqli_fetch_assoc($catresult);

$typeSql = "SELECT * from tblfurn_type where typeID = '$typeID'";
$typeresult = mysqli_query($conn,$typeSql);
$typerow = mysqli_fetch_assoc($typeresult);
*/



                  


?>
<script type="text/javascript">
            
            $(document).ready(function(){

  
var q = 0;
$('#addPBtn').attr('data-quantity',q);
  $('body').on('change','#input-quantity',function(){
  
    q = $('#input-quantity').val();
     if(q <= 0){

      $('#addPBtn').attr('data-quantity',0);
    $('#addPBtn').prop('disabled',true);
      $('#message').html('Input Quantity');
      $('#message').css('color','red');
      
      
    }else{
      $('#addPBtn').attr('data-quantity',''+q);
      $('#addPBtn').prop('disabled',false);
      $('#message').html('');
    }


  });

  $('body').on('keyup','#input-quantity',function(){
    q = $('#input-quantity').val();
     if(q <= 0){

      $('#addPBtn').attr('data-quantity',0);
    $('#addPBtn').prop('disabled',true);
      $('#message').html('Input Quantity');
      $('#message').css('color','red');
      
      
    }else{
      $('#addPBtn').attr('data-quantity',''+q);
      $('#addPBtn').prop('disabled',false);
      $('#message').html('');
    }


  });
});


        </script>
          <div itemscope itemtype="http://schema.org/Product">
            <h1 class="title" itemprop="name"><?php echo $row['packageDescription']; ?></h1>
            <div class="row product-info">
              <div class="col-sm-4">
                <div class="image"><img class="img-responsive" style="height: 520px;width: 320px;" itemprop="image" id="zoom_01" src="../admin/plugins/images/2017-08-241503568724.png" title="Product" alt="image/product/macbook_air_1-350x525.jpg" data-zoom-image="../admin/plugins/images/2017-08-241503568724.png" /> </div>
                <!--
                <div class="center-block text-center"><span class="zoom-gallery"><i class="fa fa-search"></i> Click image for Gallery</span></div>
                <div class="image-additional" id="gallery_01"> <a class="thumbnail" href="#" data-zoom-image="image/product/macbook_air_1-600x900.jpg" data-image="image/product/macbook_air_1-350x525.jpg" title="Product"> <img src="image/product/macbook_air_1-66x99.jpg" title="Product" alt = "Product"/></a> <a class="thumbnail" href="#" data-zoom-image="image/product/macbook_air_4-600x900.jpg" data-image="image/product/macbook_air_4-350x525.jpg" title="Product"><img src="image/product/macbook_air_4-66x99.jpg" title="Product" alt="Product" /></a> <a class="thumbnail" href="#" data-zoom-image="image/product/macbook_air_2-600x900.jpg" data-image="image/product/macbook_air_2-350x525.jpg" title="Product"><img src="image/product/macbook_air_2-66x99.jpg" title="Product" alt="Product" /></a> <a class="thumbnail" href="#" data-zoom-image="image/product/macbook_air_3-600x900.jpg" data-image="image/product/macbook_air_3-350x525.jpg" title="Product"><img src="image/product/macbook_air_3-66x99.jpg" title="Product" alt="Product" /></a> </div>
                !-->
              </div>
              <div class="col-sm-8">
                <ul class="list-unstyled description">
                  <li><b>Package Code:</b> <span itemprop="mpn">Package <?php echo $row['packageID']; ?></span></li>
                  <li><b>Availability:</b> <span class="instock">In Stock</span></li>
                </ul>
                <ul class="price-box">
                  <li class="price" itemprop="offers" itemscope itemtype="http://schema.org/Offer"> <span itemprop="price">&#8369 <?php echo $row['packagePrice']; ?><span itemprop="availability" content="In Stock"></span></span></li>
                  <li></li>
                </ul>
                <div class="form-body">
                  <div class="row">
                    <div class="form-group">
                      <h4>Package Inclusions</h4>
                      <table class="table color-bordered-table muted-bordered-table" id="tblCategories">
                        <thead>

                          <th style="text-align: center;">Furniture</th>
                          <th style="text-align: center;">Furniture Type</th>
                          <th style="text-align: center;">Furniture Name</th>
                          <th style="text-align: center;">Furniture Price</th>
                        </thead>
                        <tbody style="text-align: center;">
                          <tr>
                            <?php
                            $sql1 = "SELECT * FROM tblpackages where packageID = $id;";
                            $result1 = mysqli_query($conn, $sql1);
                            $row1 = mysqli_fetch_assoc($result1);

                            $sqls = "SELECT * from tblpackages a inner join tblpackage_inclusions b on a.packageID = b.package_incID inner join tblproduct c on c.productID = b.product_incID inner join tblfurn_type d on d.typeID = c.prodTypeID WHERE a.packageID = '$id';";
                            $results = mysqli_query($conn, $sqls);
                            while ($rows = mysqli_fetch_assoc($results))
                            {
                              if($rows['package_incStatus'] == 'Listed'){
                              echo ('
                                <td><a href="view-product.php?id='.$rows['productID'].'"><img src="../admin/plugins/images/'.$rows['prodMainPic'].'" style="height: 100px; width: 105px;" alt="Product" title="'.$rows['productName'].'" class="img-thumbnail"></a></td>
                                <td>'.$rows['typeName'].'</td>
                                <td>'.$rows['productName'].'</td>
                                <td><small>&#8369;</small>'.$rows['productPrice'].'</td>
                                ');?>
                              <?php echo ('</tr>');
                            }
                            }
                            ?>
                          </tr>
                        </tbody>
                        
                      </table>
                    </div>
                  </div>
                </div>
                <div id="product">
                  <div class="cart">
                    <div>
                      <div class="qty">
                        <label class="control-label" for="input-quantity">Qty</label>
                        <input type="number" name="quantity" value="1" size="2" id="input-quantity" class="form-control" />
                        

                        <div class="clear"></div>
                      </div>
                      <button id="addPBtn" href="#myModal1" data-toggle="modal" data-id="P<?php echo $row1['packageID']; ?>" data-name="<?php echo $row1['packageDescription']; ?>" data-summary="<?php echo $row1['packageDescription']; ?>" data-price="<?php echo $row1['packagePrice']; ?>" data-image="../admin/plugins/images/2017-08-241503568724.png" class="btn btn-success waves-effect text-left my-cart-btn" data-quantity="1"   data-dismiss="modal">Add to Cart</button>
                    </div>
                    <div>
                      <button type="button" class="wishlist" onClick=""><i class="fa fa-heart"></i> Add to Wish List</button>
                      <br />
                      <button type="button" class="wishlist" onClick=""><i class="fa fa-exchange"></i> Compare this Product</button>
                    </div>
                  </div>
                </div>
                <div class="rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                  <meta itemprop="ratingValue" content="0" />
                  <p><span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span> <a onClick="&#8369 ('a[href=\'#tab-review\']').trigger('click'); return false;" href=""><span itemprop="reviewCount">1 reviews</span></a> / <a onClick="&#8369 ('a[href=\'#tab-review\']').trigger('click'); return false;" href="">Write a review</a></p>
                </div>
                <hr>
                <!-- AddThis Button BEGIN -->
                <div class="addthis_toolbox addthis_default_style"> <a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> <a class="addthis_button_tweet"></a> <a class="addthis_button_google_plusone" g:plusone:size="medium"></a> <a class="addthis_button_pinterest_pinit" pi:pinit:layout="horizontal" pi:pinit:url="http://www.addthis.com/features/pinterest" pi:pinit:media="http://www.addthis.com/cms-content/images/features/pinterest-lg.png"></a> <a class="addthis_counter addthis_pill_style"></a> </div>
                <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-514863386b357649"></script>
                <!-- AddThis Button END -->
                <br>
                <ul class="nav nav-tabs">
              <li class="active"><a href="#tab-description" data-toggle="tab">Description</a></li>
              <li><a href="#tab-review" data-toggle="tab">Reviews (2)</a></li>
            </ul>
            <div class="tab-content">
              <div itemprop="description" id="tab-description" class="tab-pane active">
                <div>
                  <h4><p><a><?php //echo $catrow['categoryName'];?></a> ,  <a><?php //echo $typerow['typeName'];?></a></p></h4>
                  
                  <p><?php //echo $row['productDescription']; ?></p>
                </div>
              </div>
              <div id="tab-specification" class="tab-pane">
                <div id="tab-specification" class="tab-pane">
                  

                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <td colspan="2"><strong>Framework</strong></td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><?php //echo $framerow['frameworkName'];?></td>
                    </tr>
                  </tbody>
                  </table>
                <table class="table table-bordered">
                <thead>
                    <tr>
                      <td colspan="2"><strong>Fabric</strong></td>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td><?php //echo $fabricrow['fabricName'];?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              </div>
              <div id="tab-review" class="tab-pane">
                <form class="form-horizontal">
                  <div id="review">
                    <div>
                      <table class="table table-striped table-bordered">
                        <tbody>
                          <tr>
                            <td style="width: 50%;"><strong><span>Airabells</span></strong></td>
                            <td class="text-right"><span>20/01/2016</span></td>
                          </tr>
                          <tr>
                            <td colspan="2"><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                              <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> </div></td>
                          </tr>
                        </tbody>
                      </table>
                      <table class="table table-striped table-bordered">
                        <tbody>
                          <tr>
                            <td style="width: 50%;"><strong><span>Elayski</span></strong></td>
                            <td class="text-right"><span>20/01/2016</span></td>
                          </tr>
                          <tr>
                            <td colspan="2"><p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>
                              <div class="rating"> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> </div></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="text-right"></div>
                  </div>
                  <h2>Write a review</h2>
                  <div class="form-group required">
                    <div class="col-sm-12">
                      <label for="input-name" class="control-label">Your Name</label>
                      <input type="text" class="form-control" id="input-name" value="" name="name">
                    </div>
                  </div>
                  <div class="form-group required">
                    <div class="col-sm-12">
                      <label for="input-review" class="control-label">Your Review</label>
                      <textarea class="form-control" id="input-review" rows="5" name="text"></textarea>
                      <div class="help-block"><span class="text-danger">Note:</span> HTML is not translated!</div>
                    </div>
                  </div>
                  <div class="form-group required">
                    <div class="col-sm-12">
                      <label class="control-label">Rating</label>
                      &nbsp;&nbsp;&nbsp; Bad&nbsp;
                      <input type="radio" value="1" name="rating">
                      &nbsp;
                      <input type="radio" value="2" name="rating">
                      &nbsp;
                      <input type="radio" value="3" name="rating">
                      &nbsp;
                      <input type="radio" value="4" name="rating">
                      &nbsp;
                      <input type="radio" value="5" name="rating">
                      &nbsp;Good</div>
                  </div>
                  <div class="buttons">
                    <div class="pull-right">
                      <button class="btn btn-primary" id="button-review" type="button">Continue</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            </div>
            </div>
            <h3 class="subtitle">Related Products</h3>
            <div class="owl-carousel related_pro">
              <?php
                include "userconnect.php"; 
                $ctr = 0;
                $sql="SELECT * from tblpackages where packageID != '$id' order by packageID desc;";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)){
                  
                  if($row['packageID']==""){$row['packageDescription']="________________";}
                  if($row['packageStatus'] != "Archived"){
                    echo '<div class="product-thumb clearfix hovereffect card">
                    <div class="image"><a href="view-product.php?id='.$row['packageID'].'"><img style="height:280px; width:200;" src="../admin/plugins/images/2017-08-241503568724.png" alt="Product" class="img-responsive" onerror="productImgError(this);"/></a></div>
                    <div class="caption">
                      <br>
                      <h4><a href="view-product.php?id='.$row['packageID'].'">'.substr($row['packageDescription'], 0,20).'</a></h4>
                      <p class="price"><span class="price-new">&#8369;'.number_format($row['packagePrice'],2).'</span> <span class="price-old"> </span></p>
                    </div>
                    ';?>
                    <div class="button-group">
                      <button type="button" class="btn btn-primary" data-toggle="modal" href="#viewPackageModal" data-remote="product-form.php?id=<?php echo $row['packageID'];?> #viewP"><i class='fa fa-info-circle'></i>Add to Cart</button>
                      <div class="add-to-links">
                        <button type="button" data-toggle="tooltip" title="Add to Wish List" onClick=""><i class="fa fa-heart"></i></button>
                        <button type="button" data-toggle="tooltip" title="Compare this Product" onClick=""><i class="fa fa-exchange"></i></button>
                      </div>
                    </div>
                  </div><?php echo '';

                }
                $ctr++;
              }
              /*
<button href="#myModal1" data-toggle="modal" data-id="<?php echo $row['productID'] ?>" data-name="<?php echo $row['productName'] ?>" data-summary="<?php echo $row['productDescription'] ?>" data-price="<?php echo $row['productPrice'] ?>" data-quantity="1" data-image="../admin/plugins/images/<?php echo $row['prodMainPic'] ?>" class="btn-primary my-cart-btn"><span>Add to Cart</span></button>
              */
              ?>
            </div>
          </div>
        </div>
        <!--Middle Part End -->
      </div>
    </div>
  </div>
<?php include"footer.php";?>
</div>
<!-- JS Part Start-->
<?php include"scripts.php";?>
<script type="text/javascript">
// Elevate Zoom for Product Page image
$("#zoom_01").elevateZoom({
	gallery:'gallery_01',
	cursor: 'pointer',
	galleryActiveClass: 'active',
	imageCrossfade: true,
	zoomWindowFadeIn: 500,
	zoomWindowFadeOut: 500,
	lensFadeIn: 500,
	lensFadeOut: 500,
	loadingIcon: 'image/progress.gif'
	}); 
//////pass the images to swipebox
$("#zoom_01").bind("click", function(e) {
  var ez =   $('#zoom_01').data('elevateZoom');
	$.swipebox(ez.getGalleryList());
  return false;
});
</script>
<!-- JS Part End-->
</body>
</html>