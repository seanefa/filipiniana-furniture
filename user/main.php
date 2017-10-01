<div class="wrapper-wide">
  <?php include"header.php";?>
  <?php include"revolutionslider.php";?>
  <div id="container">
    <div class="container">
      <div class="row">
        <!-- Feature Box Start-->
        <div class="container">
          <div class="custom-feature-box row">
            <?php
            include "userconnect.php";
            $sql="SELECT * from tblcompany_info";
            $result=$conn->query($sql);
            if($result->num_rows>0)
            {
              while($row=$result->fetch_assoc())
              {
                ?>
                <div class="col-sm-12 col-xs-12">
                  <div class="feature-box fbox_1">
                    <div class="title">About <?php echo "" . $row['comp_name'];?></div>
                    <p><?php echo "" . $row['comp_about'];?></p>
                  </div>
                </div>
                <?php
              }
            }
            $conn->close();
            ?>
          </div>
        </div>
        <!-- Feature Box End-->
      </div>
    </div>
    <div class="container">
      <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-xs-12">
          <div id="product-tab" class="product-tab">
            <ul id="tabs" class="tabs">
              <h2 style="text-align: center;">Featured Furnitures</h2>
            </ul>
              <div class="owl-carousel product_carousel_tab">
                <?php
                include "userconnect.php";

                $sql1 = "SELECT * FROM tblproduct;";
                $result1 = mysqli_query($conn,$sql1);
                 while ($trow = mysqli_fetch_assoc($result1)){
                  if($trow['prodStat'] != "Archived"){
                    echo '<input type="hidden" id="package'.$trow['productID'].'" value="0"/>
                      <input type="hidden" id="product'.$trow['productID'].'" value="'.$trow['productName'].'"/>
                      <input type="hidden" id="pic'.$trow['productID'].'" value="'.$trow['prodMainPic'].'"/>
                      <input type="hidden" id="price'.$trow['productID'].'" value="'.$trow['productPrice'].'"/>
                      <input type="hidden" id="size'.$trow['productID'].'" value="'.$trow['productDescription'].'"/>
                      <input type="hidden" id="uprice'.$trow['productID'].'" value="'.$trow['productPrice'].'"/>
                      <input type="hidden" id="quant'.$trow['productID'].'" value="1" />';
                  }
                }

                $ctr = 0;
                $sql="SELECT * from tblproduct order by productID desc;";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)){
                  if($row['prodTypeID']==""){$row['productDescription']="________________";}
                  if($row['prodStat'] != "Archived"){
                    echo ('<div class="product-thumb clearfix hovereffect card">
                    <div class="image"><a href="view-product.php"><img style="height:280px; width:200;" src="../admin/plugins/images/'.$row['prodMainPic'].'" alt="Product" class="img-responsive" onerror="productImgError(this);"/></a></div>
                    <br>
                    <div class="caption">
                      <h4><a href="view-product.php">'.substr($row['productName'], 0,20).'</a></h4>
                      <p class="price"><span class="price-new">&#8369;'.number_format($row['productPrice'],2).'</span>
                       <span class="price-old"> </span></p>
                      '); ?>
            
                    </div>
                    <div class="button-group">
                      <button type="button" class="btn btn-primary" data-toggle="modal" href="#viewProductModal" data-remote="product-form.php?id=<?php echo $row['productID'];?> #view"><i class='fa fa-info-circle'></i> Add to Cart</button>

                      <div class="add-to-links">
                        <button type="button" data-toggle="tooltip" title="Add to Wish List" onClick=""><i class="fa fa-heart"></i></button>
                        <button type="button" data-toggle="tooltip" title="Compare this Product" onClick=""><i class="fa fa-exchange"></i></button>
                      </div>
                    </div>
                  </div> <?php
                }
                $ctr++;
              }
              ?>
            </div>
        </div>
        </div>
    </div>
      <!--Middle Part End-->
       <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-xs-12">
          <div id="product-tab" class="product-tab">
            <ul id="tabs" class="tabs">
              <h2 style="text-align: center;">Latest Furnitures</h2>
            </ul>
              <div class="owl-carousel product_carousel_tab">
                <?php
                include "userconnect.php"; 
                $ctr = 0;
                $sql="SELECT * from tblproduct order by productID desc;";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)){
                  if($row['prodTypeID']==""){$row['productDescription']="________________";}
                  if($row['prodStat'] != "Archived"){
                    echo '<div class="product-thumb clearfix hovereffect card">
                    <div class="image"><a href="view-product.php"><img style="height:280px; width:200;" src="../admin/plugins/images/'.$row['prodMainPic'].'" alt="Product" class="img-responsive" onerror="productImgError(this);"/></a></div>
                    <div class="caption">
                      <br>
                      <h4><a href="view-product.php">'.substr($row['productName'], 0,20).'</a></h4>
                      <p class="price"><span class="price-new">&#8369;'.number_format($row['productPrice'],2).'</span> <span class="price-old"> </span></p>
                    </div>
                    ';?>
                    <div class="button-group">
                      <button type="button" class="btn btn-primary" data-toggle="modal" href="#viewProductModal" data-remote="product-form.php?id=<?php echo $row['productID'];?> #view"><i class='fa fa-info-circle'></i>Add to Cart</button>
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
    </div>
      <!--Middle Part End-->
    <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-xs-12">
          <div id="product-tab" class="product-tab">
            <ul id="tabs" class="tabs">
              <h2 style="text-align: center;">Featured Packages</h2>
            </ul>
              <div class="owl-carousel product_carousel_tab">
                <?php
                include "userconnect.php"; 
                $ctr = 0;
                $sql="SELECT * from tblpackages order by packageID desc;";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)){
                  if($row['packageStatus'] != "Archived"){
                    echo '<div class="product-thumb clearfix hovereffect card">
                    <div class="image"><a href="view-product.php"><img style="height:280px; width:200;" src="..user/pics/28282-NX18M6.jpg" alt="Product" class="img-responsive" onerror="productImgError(this);"/></a></div>
                    <div class="caption">
                      <br>
                      <h4><a href="view-product.php">'.substr($row['packageDescription'], 0,20).'</a></h4>
                      <p class="price"><span class="price-new">&#8369;'.number_format($row['packagePrice'],2).'</span> <span class="price-old"> </span></p>
                      <input type="hidden" id="P_package'.$row['packageID'].'" value="'.$row['packageID'].'"/>
        <input type="hidden" id="P_product'.$row['packageID'].'" value="'.$row['packageDescription'].'"/>
        <input type="hidden" id="P_price'.$row['packageID'].'" value="'.$row['packagePrice'].'"/>
        <input type="hidden" id="P_size'.$row['packageID'].'" value="'.$row['packageDescription'].'"/>
        <input type="hidden" id="P_uprice'.$row['packageID'].'" value="'.$row['packagePrice'].'"/>
        <input id="P_quant'.$row['packageID'].'" type="hidden" value="1"/>
                    </div>
                    ';?>
                    <div class="button-group">
                      <button href="#myModal1" data-toggle="modal" data-id="<?php echo $row['packageID'] ?>" data-name="<?php echo $row['packageDescription'] ?>" data-summary="Package" data-price="<?php echo $row['packagePrice'] ?>" data-quantity="1" data-image="../admin/plugins/images/<?php echo $row['prodMainPic'] ?>" class="btn-primary my-cart-btn"><span>Add to Cart</span></button>
                        <button type="button" data-toggle="tooltip" title="Add to Wish List" onClick=""><i class="fa fa-heart"></i></button>
                        <button type="button" data-toggle="tooltip" title="Compare this Product" onClick=""><i class="fa fa-exchange"></i></button>
                      </div>
                    </div>
                  </div><?php echo'';
                }
                $ctr++;
              }
              ?>
            </div>
        </div>
        </div>
    </div>
      <!--Middle Part End-->
      <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-xs-12">
          <div id="product-tab" class="product-tab">
            <ul id="tabs" class="tabs">
              <h2 style="text-align: center;">Promos</h2>
            </ul>
              <div class="owl-carousel product_carousel_tab">
                <?php
                include "userconnect.php"; 
                $ctr = 0;
                $sql="SELECT * from tblpromos order by promoID desc;";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)){
                  if($row['promoStatus'] == "Active"){
                    echo '<div class="product-thumb clearfix hovereffect card">
                    <div class="image"><a href="view-product.php"><img style="height:280px; width:200;" src="../admin/plugins/images/'.$row['promoImage'].'" alt="Product" class="img-responsive" onerror="productImgError(this);"/></a></div>
                      <h4 style="text-transform:uppercase;"><a href="view-product.php">'.$row['promoName'].'</a></h4>
                    <div class="overlay"> 
                    <div class="caption">                      
                      <h2><a href="view-product.php" style="color:white;">'.$row['promoDescription'].'</a></h2>
                      </div>
                    </div>
                  </div>';
                }
                $ctr++;
              }
              ?>
            </div>
        </div>
        </div>
    </div>
      <!--Middle Part End-->
  </div>
</div>
<?php include"footer.php";?>
</div>