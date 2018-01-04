
<!-- View Product Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="viewProductModal" aria-hidden="true" style="display: none;">

  <div class="modal-dialog modal-lg" >
    <div class="modal-content" id="view">
      <?php
      include "userconnect.php";
      $jsID=$_GET['id'];

      $tsql = "SELECT * FROM tblproduct WHERE productID = $jsID;";
      $tresult = mysqli_query($conn,$tsql);
      $trow = mysqli_fetch_assoc($tresult);
      $framework = $trow['prodFrameworkID'];
      $fabric = $trow['prodFabricID'];
      $type = $trow['prodTypeID'];
      $category = $trow['prodCatID'];


      $asql = "SELECT * FROM tblframeworks WHERE frameworkID = $framework;";
      $aresult = mysqli_query($conn,$asql);
      $arow;
      if($aresult){
      $arow = mysqli_fetch_assoc($aresult);
    }else{
      $arow = 'Unavailable';
    }

      $bsql = "SELECT * FROM tblfabrics WHERE fabricID = $fabric;";
      $bresult = mysqli_query($conn,$bsql);
      $brow;
      if($bresult){
      $brow = mysqli_fetch_assoc($bresult);
      }else{
      $brow = 'Unavailable';
    }

      $leesql = "SELECT * FROM tblfurn_category WHERE categoryID = $category;";
      $leeresult = mysqli_query($conn,$leesql);
      $leerow;
      if($leeresult){
      $leerow = mysqli_fetch_assoc($leeresult);
    }else{
      $leerow = 'Unavailable';
    }

      $csql = "SELECT * FROM tblfurn_type WHERE typeID = $type;";
      $cresult = mysqli_query($conn,$csql);
      $crow;
      if($cresult){
      $crow = mysqli_fetch_assoc($cresult);
    }else{
      $crow = 'Unavailable';
    }

      $sql1 = "SELECT * FROM tblprodsonpromo where prodPromoID = '$jsID';";
                            $results = mysqli_query($conn, $sql1);

                            if($results){
                            $rows = mysqli_fetch_assoc($results);
                            
                              if($rows['onPromoStatus'] == 'Active'){
                                $ids = $rows['prodPromoID'];
                                
                                $sql2 = "SELECT * FROM tblproduct where productID = '$ids';";
                                $result2 = mysqli_query($conn,$sql2);
                                $row2 = mysqli_fetch_assoc($result2);


                                $typeID = $row2['prodTypeID'];

                                $typeSql = "SELECT * from tblfurn_type where typeID = '$typeID'";
                              $typeresult = mysqli_query($conn,$typeSql);
                              $typerow = mysqli_fetch_assoc($typeresult);
                            echo ('<input value="'.$rows['promoDescID'].'" id="promoChecker'.$trow['productID'].'" class="promo" type="hidden"/>');
                            
                            }
                          }else{
                            echo ('<input value="0" id="promoChecker'.$trow['productID'].'" class="promo" type="hidden"/>');
                          }


      ?>
      <div class="modal-body">
        <div class="descriptions">
			<div class="">
            	<h2 class="m-b-0 m-t-0" style="text-align: center;"><?php echo $trow['productName'];?></h2>
                	<hr>
                    <div class="row">
                      <div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="white-box text-center"> <img style="height:350px; width:270;" src="../admin/plugins/products/<?php echo $trow['prodMainPic']; ?>" alt="<?php echo $trow['prodMainPic']; ?>" class="img-responsive"/> </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-2">
							<h4 class="box-title m-t-40">Description</h4>
                         	<p><?php echo $trow['productDescription'];?></p>
                        	<h4 class="m-t-40">Price</h4>
                         	<h2 class="text-success" style="font-weight: bold;">&#8369;<?php echo number_format($trow['productPrice']);?></h2>
                        </div>
                    	
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <h3 class="box-title">General Info</h3>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <tbody >
                                                    <tr>
                                                        <td style="text-align:left">Design</td>
                                                        <td style="text-align:left"><?php echo $trow['prodDesign'];?> </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align:left">Category</td>
                                                        <td style="text-align:left"> <?php echo $leerow['categoryName'];?> </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align:left">Type</td>
                                                        <td style="text-align:left"> <?php echo $crow['typeName'];?> </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align:left">Framework</td>
                                                        <td style="text-align:left"> <?php echo $arow['frameworkName'];?> </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align:left">Fabric</td>
                                                        <td style="text-align:left"> <?php if(isset($brow['fabricName'])){echo $brow['fabricName'];}else{ echo 'Unavailable';} ?> </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align:left">Dimension Specification</td>
                                                        <td style="text-align:left"> <?php echo $trow['prodSizeSpecs']?> </td>
                                                    </tr>
                                                </tbody>
                                                <td>
                                                  <h4><span>Quantity</span></h4><input id="quan" type="number" min="0" step="1" class="form-control" value="1" required/>
                                                  <span id="message"></span>
                                                <td>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>


        </div>

      </div>
      <div class="modal-footer">
        <button value="<?php echo $trow['productID'] ?>" id="addBtn" href="#myModal1" data-toggle="modal" data-id="<?php echo $trow['productID'] ?>" data-name="<?php echo $trow['productName'] ?>" data-summary="<?php echo $trow['productDescription'] ?>" data-price="<?php echo $trow['productPrice'] ?>" data-image="../admin/plugins/images/<?php echo $trow['prodMainPic'] ?>" class="btn btn-primary waves-effect text-left my-cart-btn" data-quantity="1" data-dismiss="modal"><i class="glyphicon glyphicon-shopping-cart"></i><span> Add to Cart</span></button>

        <button type="button" class="btn btn-danger waves-effect text-left" onclick="location.href = 'home.php'; location.reload();" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Close</button>
      </div>
    </div>
  </div>
</div>
<!-- /.modal -->

<!-- View Package Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="viewPackageModal" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-lg">
        <div class="modal-content" id="viewP">
          <div class="modal-header">
            <h3 style="text-align: center;">Package Information</h3>
          </div>
          <?php
          $sql = "SELECT * FROM tblpackages WHERE packageID = $jsID";
          $result = mysqli_query($conn,$sql);
          $row = mysqli_fetch_assoc($result);
          ?>
          <div class="modal-body">
            <div class="descriptions">
              <div class="form-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label">Name</label>
                      <input type="text" id="firstName" class="form-control" placeholder="Fabulous Package" name="pName" value="<?php echo $row['packageDescription'];?>" disabled/> 
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label">Price</label>
                      <input id="firstName" class="form-control" placeholder="0.00" name="pPrice" value="<?php echo $row['packagePrice'];?>" disabled/> 
                    </div>
                  </div>
                </div>
              </div>

                <div class="form-body">
                  <div class="row">
                    <div class="form-group">
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
                            $sql1 = "SELECT * FROM tblpackages where packageID = $jsID;";
                            $result1 = mysqli_query($conn, $sql1);
                            $row1 = mysqli_fetch_assoc($result1);

                            $sql = "SELECT * from tblpackages a inner join tblpackage_inclusions b on a.packageID = b.package_incID inner join tblproduct c on c.productID = b.product_incID inner join tblfurn_type d on d.typeID = c.prodTypeID WHERE a.packageID = '$jsID'";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result))
                            {
                              if($row['package_incStatus'] == 'Listed'){
                              echo ('
                                <td><img src="../admin/plugins/images/'.$row['prodMainPic'].'" style="height: 120px; width: 110px;" alt="Product" title="'.$row['productName'].'" class="img-thumbnail"></td>
                                <td>'.$row['typeName'].'</td>
                                <td>'.$row['productName'].'</td>
                                <td><small>&#8369;</small>'.$row['productPrice'].'</td>
                                ');?>
                              <?php echo ('</tr>');
                            }
                            }
                            ?>
                          </tr>
                        </tbody>
                        <td>
                                                  <h4><span>Quantity</span></h4><input id="pquan" type="number" min="0" step="1" class="form-control" value="1" required/>
                                                  <span id="pmessage"></span>
                                                <td>
                        
                      </table>
                    </div>
                  </div>
                </div>

            </div>
          </div>
            <div class="modal-footer">
              <button id="paddBtn" href="#myModal1" data-toggle="modal" data-id="P<?php echo $row1['packageID']; ?>" data-name="<?php echo $row1['packageDescription']; ?>" data-summary="<?php echo $row1['packageDescription']; ?>" data-price="<?php echo $row1['packagePrice']; ?>" data-image="../admin/plugins/images/2017-08-241503568724.png" class="btn btn-primary waves-effect text-left my-cart-btn" data-quantity="1" data-dismiss="modal"><i class="glyphicon glyphicon-shopping-cart"></i><span> Add to Cart</span></button>

              <button type="button" onclick="location.reload();" class="btn btn-danger waves-effect text-left" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i> Close</button>
            </div>
        </div>
      </div>
      </div>

<!-- /.modal -->