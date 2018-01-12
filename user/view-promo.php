<!DOCTYPE html>

<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="image/favicon.ico" rel="icon" />
<title>Promos - Filipiniana Furniture Shop</title>
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
        <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="products.php" itemprop="url"><span itemprop="title">Promos</span></a></li>
        <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="view-product.php" itemprop="url"><span itemprop="title">Promos</span></a></li>
      </ul>
      <!-- Breadcrumb End-->
      <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-12">
          <?php

include "userconnect.php";

$id = $_GET['id'];

$sql = "SELECT * FROM tblpromos where promoID = '$id'";
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
            <h1 class="title" itemprop="name"><?php echo $row['promoDescription']; ?></h1>
            <div class="row product-info">
              <div class="col-sm-4">
                <div class="image"><img class="img-responsive" style="height: 520px;width: 320px;" itemprop="image" id="zoom_01" src="../admin/plugins/promos/<?php echo $row['promoImage'];?>" title="Product" alt="Unavailable" data-zoom-image="../admin/plugins/images/2017-08-241503568724.png" /> </div>
                <!--
                <div class="center-block text-center"><span class="zoom-gallery"><i class="fa fa-search"></i> Click image for Gallery</span></div>
                <div class="image-additional" id="gallery_01"> <a class="thumbnail" href="#" data-zoom-image="image/product/macbook_air_1-600x900.jpg" data-image="image/product/macbook_air_1-350x525.jpg" title="Product"> <img src="image/product/macbook_air_1-66x99.jpg" title="Product" alt = "Product"/></a> <a class="thumbnail" href="#" data-zoom-image="image/product/macbook_air_4-600x900.jpg" data-image="image/product/macbook_air_4-350x525.jpg" title="Product"><img src="image/product/macbook_air_4-66x99.jpg" title="Product" alt="Product" /></a> <a class="thumbnail" href="#" data-zoom-image="image/product/macbook_air_2-600x900.jpg" data-image="image/product/macbook_air_2-350x525.jpg" title="Product"><img src="image/product/macbook_air_2-66x99.jpg" title="Product" alt="Product" /></a> <a class="thumbnail" href="#" data-zoom-image="image/product/macbook_air_3-600x900.jpg" data-image="image/product/macbook_air_3-350x525.jpg" title="Product"><img src="image/product/macbook_air_3-66x99.jpg" title="Product" alt="Product" /></a> </div>
                !-->
              </div>
              <div class="col-sm-8">
                <ul class="list-unstyled description">
                  <li><b>Promo Code:</b> <span itemprop="mpn">Promo <?php echo $row['promoID']; ?></span></li>
                  <li><b>Availability:</b> <span class="instock"><?php echo $row['promoStartDate']; ?> to <?php echo $row['promoEnd']; ?></span></li>
                </ul>
                <?php
                $prid = $row['tblproductID'];
                $prsql = "SELECT * FROM tblproduct where productID = '$prid'"; 
                $prresult = mysqli_query($conn,$prsql);
                $prrow = mysqli_fetch_assoc($prresult);

                ?>
                <h3>Free Item:</h3>
                <ul class="price-box">
                  <li class="price" itemprop="offers" itemscope itemtype="http://schema.org/Offer"> <span itemprop="price"><?php echo $prrow['productName']; ?><span itemprop="availability" content="In Stock"></span></span></li>
                  <li></li>
                </ul>
                <div class="form-body">
                  <div class="row">
                    <div class="form-group">
                      <h4>Products on Promo</h4>
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
                            include "userconnect.php";
                            $sql1 = "SELECT * FROM tblprodsonpromo where promoDescID = '$id';";
                            $results = mysqli_query($conn, $sql1);

                            while ($rows = mysqli_fetch_assoc($results))
                            {
                              if($rows['onPromoStatus'] == 'Active'){
                                $ids = $rows['prodPromoID'];
                                
                                $sql2 = "SELECT * FROM tblproduct where productID = '$ids';";
                                $result2 = mysqli_query($conn,$sql2);
                                $row2 = mysqli_fetch_assoc($result2);


                                $typeID = $row2['prodTypeID'];

                                $typeSql = "SELECT * from tblfurn_type where typeID = '$typeID'";
                              $typeresult = mysqli_query($conn,$typeSql);
                              $typerow = mysqli_fetch_assoc($typeresult);
                              echo ('
                                <td><a href="view-product.php?id='.$row2['productID'].'"><img src="../admin/plugins/products/'.$row2['prodMainPic'].'" style="height: 100px; width: 105px;" alt="Product" title="'.$row2['productName'].'" class="img-thumbnail"></a></td>
                                <td>'.$typerow['typeName'].'</td>
                                <td>'.$row2['productName'].'</td>
                                <td><small>&#8369;</small>'.$row2['productPrice'].'</td>
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