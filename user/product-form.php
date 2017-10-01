
<!-- View Product Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="viewProductModal" aria-hidden="true" style="display: none;">

  <div class="modal-dialog modal-lg" >
    <div class="modal-content" id="view">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <?php
      include "userconnect.php";

      if(isset($GET['id'])){
        $jsID = $_GET['id'];
        }
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
      $arow = mysqli_fetch_assoc($aresult);

      $bsql = "SELECT * FROM tblfabrics WHERE fabricID = $fabric;";
      $bresult = mysqli_query($conn,$bsql);
      $brow = mysqli_fetch_assoc($bresult);

      $leesql = "SELECT * FROM tblfurn_category WHERE categoryID = $category;";
      $leeresult = mysqli_query($conn,$leesql);
      $leerow = mysqli_fetch_assoc($leeresult);

      $csql = "SELECT * FROM tblfurn_type WHERE typeID = $type;";
      $cresult = mysqli_query($conn,$csql);
      $crow = mysqli_fetch_assoc($cresult);

      ?>
      <div class="modal-body">
        <div class="descriptions">
			<div class="">
            	<h2 class="m-b-0 m-t-0" style="text-align: center;"><?php echo $trow['productName'];?></h2>
                	<hr>
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-2">
							<h4 class="box-title m-t-40">Description</h4>
                         	<p><?php echo $trow['productDescription'];?></p>
                        	<h4 class="m-t-40">Price</h4>
                         	<h2 class="text-success" style="font-weight: bold;">&#8369;<?php echo number_format($trow['productPrice']);?></h2>
                        </div>
                    	<div class="col-lg-4 col-md-4 col-sm-4">
                            <div class="white-box text-center"> <img style="height:280px; width:200;" src="pics/'<?php echo $trow['prodMainPic'] ?>'" alt="unavailable" class="img-responsive"/> </div>
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
                                                        <td style="text-align:left"> <?php echo $brow['fabricName'];?> </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="text-align:left">Dimension Specification</td>
                                                        <td style="text-align:left"> <?php echo $trow['prodSizeSpecs']?> </td>
                                                    </tr>
                                                    <!--tr>
                                                        <td>Style</td>
                                                        <td> Contemporary &amp; Modern </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Wheels Included</td>
                                                        <td> Yes </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Upholstery Included</td>
                                                        <td> Yes </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Upholstery Type</td>
                                                        <td> Cushion </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Head Support</td>
                                                        <td> No </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Suitable For</td>
                                                        <td> Study &amp; Home Office </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Adjustable Height</td>
                                                        <td> Yes </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Model Number</td>
                                                        <td> F01020701-00HT744A06 </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Armrest Included</td>
                                                        <td> Yes </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Care Instructions</td>
                                                        <td> Handle With Care, Keep In Dry Place, Do Not Apply Any Chemical For Cleaning. </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Finish Type</td>
                                                        <td> Matte </td>
                                                    </tr-->
                                                </tbody>
                                                <td>
                                                  <h4><span>Quantity</span></h4><input id="quan" type="number" min="0" step="1" class="form-control" required/>
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
        <button id="addBtn" href="#myModal1" data-toggle="modal" data-id="<?php echo $trow['productID'] ?>" data-name="<?php echo $trow['productName'] ?>" data-summary="<?php echo $trow['productDescription'] ?>" data-price="<?php echo $trow['productPrice'] ?>" data-image="../admin/plugins/images/<?php echo $trow['prodMainPic'] ?>" class="btn btn-success waves-effect text-left my-cart-btn" data-dismiss="modal" disabled><span>Add to Cart</span></button>

        <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- /.modal -->