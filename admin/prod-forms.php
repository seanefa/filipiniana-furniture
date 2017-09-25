<?php
include "menu.php";
include "dbconnect.php";
?>
<!DOCTYPE>
<html>
<head>
</head>
<body>
  <?php

  session_start();
  if(isset($GET['id'])){
    $jsID = $_GET['id'];
  }
  $jsID=$_GET['id'];

  $_SESSION['varname'] = $jsID;
  $conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  ?>
  <!-- New Framework Modal -->
  <div class="modal fade" role="dialog" id="newProductModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" >
      <div class="modal-content" id="new">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title" id="modalProduct">New Product</h3>
        </div>
        <form enctype="multipart/form-data" action="add-prod.php" method="post">
          <div class="modal-body">
            <div class="descriptions">

              <div class="form-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label">Category</label><span id="x" style="color:red"> *</span>
                      <select class="form-control" data-placeholder="Choose a Category" tabindex="1" id="category" name="_category">
                        <option value="">Select category</option>
                        <?php
                        $sql = "SELECT * FROM tblfurn_category order by categoryName;";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result))
                        {
                          if($row['categoryStatus']=='Listed'){
                            echo('<option value='.$row['categoryID'].'>'.$row['categoryName'].'</option>');
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <!--/span-->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label">Type</label><span id="x" style="color:red"> *</span>
                      <select class="form-control" data-placeholder="Choose a Category" tabindex="1" id="type" name="_type" id="type">
                        <option value="">Nothing to show</option>
                      </select>
                    </div>
                  </div>
                  <!--/span-->
                </div>
                <!--/row-->
                <!--/row-->
                <!--/row-->

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Name</label><span id="x" style="color:red"> *</span>
                      <input type="text" id="username" class="form-control" placeholder="Elizabeth" name="_prodName" required/><span id="message"></span>
                    </div>
                  </div>
                  <!--/span-->
                  <!--/span-->
                </div>


                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">Design</label><span id="x" style="color:red"> *</span>
                        <div class="row">
                        <div class="col-md-12">
                          <h5>
                          <?php
                        include "dbconnect.php";
                        $sql = "SELECT * FROM tblfurn_design;";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result))
                        {
                          if($row['designStatus']!='Archived'){
                            echo '<label class="radio-inline"><input type="radio" name="design" value="'.$row['designID'].'" checked>'.$row['designName'].'</label>';
                          }
                        }
                        ?>
                      </h5>
                        </div>
                        </div>
                    </div>
                  </div>
                <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">Fabric</label>
                      <select class="form-control" data-placeholder="Choose a Fabric" tabindex="1" name="_fabric" id="_fabric" disabled>
                        <option value="0">Choose a Fabric</option>
                        <?php
                        include "dbconnect.php";
                        $sql = "SELECT * FROM tblfabrics order by fabricName;";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result))
                        {
                          if($row['fabricStatus']=='Listed'){
                            echo('<option value='.$row['fabricID'].'>'.$row['fabricName'].'</option>');
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">Framework</label><span id="x" style="color:red"> *</span>
                      <select class="form-control" data-placeholder="Choose a Framework" tabindex="1" name="_framework" id="framework">
                        <?php
                        $sql = "SELECT * FROM tblframeworks order by frameworkName;";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result))
                        {
                          if($row['frameworkStatus']=='Listed'){
                            echo('<option value='.$row['frameworkID'].'>'.$row['frameworkName'].'</option>');
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>


                  <!--<div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">Capacity</label><span id="x" style="color:red">*</span>

                    </div>
                  </div>
                </div>-->
                <input type="hidden" id="firstName" name ="capacity" class="form-control" placeholder="4" style="text-align:right" />

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">Dimension Specification</label><span id="x" style="color:red"> *</span>
                      <textarea type="text" name ="dimensions" rows="4" class="form-control" style="text-align:right" required></textarea>
                    </div>
                  </div>
                  <!--<div class="col-md-2">
                    <div class="form-group">
                      <label class="control-label">Dimensions (ft)</label><span id="x" style="color:red"> *</span>
                      <input type="text" id="dime" name ="dimensions" class="form-control" placeholder="L x W x H" style="text-align:right" readonly="true" required />
                      <input role="number" max="3" type="hidden" id="Length" name ="Length" class="form-control" placeholder="Length" style="text-align:right" required />
                      <input role="number" max="3" type="hidden" id="width" name ="width" class="form-control" placeholder="Width" style="text-align:right" required />
                      <input role="number" type="hidden" id="height" name ="height" class="form-control" placeholder="Height" max="3" style="text-align:right" required />
                      <input id="saveDime" type="hidden" class="form-control" value="Done">
                    </div>
                  </div>
                  <div class="col-md-2">
                    <label class="control-label">Unit</label><span id="x" style="color:red">*</span>
                    <select class="form-control"  data-placeholder="Select Material Category" tabindex="1" name="unit">';
                     <?php
                      $sql = "SELECT * FROM tblunitofmeasure order by unUnit;";
                      $result = mysqli_query($conn, $sql);
                      while ($row = mysqli_fetch_assoc($result))
                      {
                        if($row['unStatus']!='Archived'){
                          echo('<option value='.$row['unID'].'>'.$row['unUnit'].'</option>');
                        }
                      }
                      ?>
                    </select>
                </div>-->
                    <div class="col-md-8">
                      <div class="form-group">
                        <label class="control-label">Description</label>
                        <textarea class="form-control" rows="4" name="_prodDesc"></textarea>
                      </div>
                    </div>
                  </div>
                  <!--/span-->
                  <div class="row">
                    <!--div class="col-md-6">
                    <div class="form-group">
                    <label>Quantity On-Hand</label>
                    <div class="input-group">
                    <div class="input-group-addon"></div>
                    <input type="number" class="form-control" step="0.01" id="exampleInputuname" name="quan" style="text-align: right;" required/> </div>
                    </div>
                    </div-->
                    <div class="col-md-4 pull-right">
                      <div class="form-group">
                        <label>Price</label><span id="x" style="color:red">*</span>
                        <div class="input-group">
                          <div class="input-group-addon"><small>&#8369;</small></div>
                          <input class="form-control" id="thisPrice" name="_price" placeholder="0.00" style="text-align: right;" required/> </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                      <h3 class="box-title m-t-20">Upload Image</h3>
                      <div class="product-img"><br>
                      <input type="file" name="image" class="dropify" value="<?php "" . $row["prodMainPic"];?>">
                      </div>
                      </div>
                    </div>
  </div>
</div>
</div>
<div class="modal-footer"><span id="notif" style="color:red"></span>
  <button type="submit" class="btn btn-success waves-effect text-left" id="addFab" disabled=""><i class="fa fa-check"></i> Save</button>
  <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>

</div>
</form>

</div>
</div>
</div>


<!-- /.modal -->
<!-- View Product Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="viewProductModal" aria-hidden="true" style="display: none;">

  <div class="modal-dialog modal-lg" >
    <div class="modal-content" id="view">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <?php


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
                            <div class="white-box text-center"> <img src="plugins/products/<?php echo $trow['prodMainPic']?>" alt="Unavailable" class="img-responsive"> </div>
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
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- /.modal -->
<!-- Update Product Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="updateProductModal" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="update">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title" id="modalProduct">Update Product</h3>
        <?php

        $rsql = "SELECT * FROM tblproduct WHERE productID = $jsID;";
        $rresult = mysqli_query($conn,$rsql);
        $trow = mysqli_fetch_assoc($rresult);
        ?>
      </div>
      <form action="prod-update.php" method="post" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="descriptions">
            <div class="form-body">
              <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label">Category</label><span id="x" style="color:red"> *</span>
                      <select class="form-control" data-placeholder="Choose a Category" tabindex="1" name="_category" id="category">
                        <?php
                        $sql = "SELECT * FROM tblfurn_category order by categoryName;";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result))
                        {
                          if($row['categoryStatus']=='Listed'){
                            if ($trow["prodCatID"] == $row['categoryID'])
                            {
                              echo('<option value="'.$row['categoryID'].'" selected="selected">'.$row['categoryName'].'</option>');
                            }
                            else
                            {
                              echo('<option value="'.$row['categoryID'].'">'.$row['categoryName'].'</option>');
                            }

                          }
                        }
                        ?>
                      </select>
                    </div>
                </div>
                <!--/span-->
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label">Type</label><span id="x" style="color:red">*</span>
                    <select class="form-control" data-placeholder="Choose a Category" tabindex="1" name="_type" id="type">
                      <?php
                      $sql = "SELECT * FROM tblfurn_type order by typeName;";
                      $result = mysqli_query($conn, $sql);
                      while ($row = mysqli_fetch_assoc($result))
                      {
                        if($row['typeStatus']=='Listed'){
                            if ($trow["prodTypeID"] == $row['typeID'])
                            {
                              echo('<option value="'.$row['typeID'].'" selected="selected">'.$row['typeName'].'</option>');
                            }
                            else
                            {
                              echo('<option value='.$row['typeID'].'>'.$row['typeName'].'</option>');
                            }

                          }
                      }
                      ?>
                    </select>
                  </div>
                </div>


                <!--/span-->
              </div>
              <!--/row-->
              <!--/row-->
              <!--/row-->

              <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                    <label class="control-label">Name</label><span id="x" style="color:red">*</span>
                    <input type="text" id="editname" class="form-control" placeholder="Manilennia" name="_name" value="<?php echo $trow['productName']; $_SESSION['tempname'] = $trow['productName'];?>" required/><span id="message"></span>
                  </div>
                </div>
                <!--/span-->
              </div>


              <div class="row">

                <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">Design</label><span id="x" style="color:red"> *</span>
                        <div class="row">
                        <div class="col-md-12">
                        <h5>

                          <?php
                        include "dbconnect.php";
                        $sql = "SELECT * FROM tblfurn_design;";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result))
                        {
                          if($row['designStatus']!='Archived'){
                            if($trow['prodDesign']==$row['designID']){
                              echo '<label class="radio-inline"><input id="select" type="radio" name="_design" value="'.$row['designID'].'" checked>'.$row['designName'].'</label>';
                            }
                            else{
                            echo '<label class="radio-inline"><input id="select" type="radio" name="_design" value="'.$row['designID'].'">'.$row['designName'].'</label>';
                          }
                          }
                        }
                        ?>
                        </h5>
                        </div>
                        </div>
                    </div>
                  </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label">Fabric</label><span id="x" style="color:red">*</span>
                    <select id="_fabric" class="form-control" data-placeholder="Choose a Fabric" tabindex="1" name="_fabric" disabled>
                      <option value="">Choose a Fabric</option>
                      <?php
                      include "dbconnect.php";
                      $sql = "SELECT * FROM tblfabrics order by fabricName;";
                      $result = mysqli_query($conn, $sql);
                      while ($row = mysqli_fetch_assoc($result))
                      {
                        if($row['fabricStatus']=='Listed'){
                          echo('<option value='.$row['fabricID'].'>'.$row['fabricName'].'</option>');
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>


                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label">Framework</label><span id="x" style="color:red">*</span>
                    <select id="framework" class="form-control" data-placeholder="Choose a Framework" tabindex="1" name="_framework">
                      <?php
                      $sql = "SELECT * FROM tblframeworks order by frameworkName;";
                      $result = mysqli_query($conn, $sql);
                      while ($row = mysqli_fetch_assoc($result))
                      {
                        if($row['frameworkStatus']=='Listed'){
                            if ($trow["prodFrameworkID"] == $row['frameworkID'])
                            {
                              echo('<option value="'.$row['frameworkID'].'" selected="selected">'.$row['frameworkName'].'</option>');
                            }
                            else
                            {
                              echo('<option value='.$row['frameworkID'].'>'.$row['frameworkName'].'</option>');
                            }

                          }
                      }
                      ?>
                    </select>
                  </div>
                </div>
                <!--<div class="col-md-2">
                  <div class="form-group">
                    <label class="control-label">Capacity</label><span id="x" style="color:red">*</span>
                    <input type="number" id="remText" name ="capacity" class="form-control" placeholder="No. of Seaters" style="text-align:right" value="<?php echo $trow['prodCapacity'];?>" required />
                  </div>-->
                </div>
              </div>

              <input type="hidden" id="remText" name ="capacity" class="form-control" placeholder="No. of Seaters" style="text-align:right" value="<?php echo $trow['prodCapacity'];?>" required />

              <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">Dimension Specification</label><span id="x" style="color:red"> *</span>
                      <textarea type="text" name ="dimensions" rows="4" class="form-control" style="text-align:right" value="<?php echo $trow['prodSizeSpecs'];?>" required></textarea>
                    </div>
                  </div>
                <!--/span-->
                <!--<div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label">Dimensions (ft)</label><span id="x" style="color:red">*</span>
                    <input type="hidden" id="checkDime" name="_dimensions" value="<?php echo $trow['prodSizeSpecs'];?>"/>
                    <input type="text" id="updime" name ="_dimensions" class="form-control" placeholder="Height, Width, Length" style="text-align:right" readonly="true" value="<?php echo $trow['prodSizeSpecs'];?>" required />
                      <?php
                      $dimeArr = array();
                      $dimeArr = explode(',',$trow['prodSizeSpecs']);
                      ?>
                      <input role="number" max="3" type="hidden" id="uplength" name ="_length" class="form-control" placeholder="Length" style="text-align:right" value="<?php echo $dimeArr[2]?>"  required />
                      <input role="number" max="3" type="hidden" id="upwidth" name ="_width" class="form-control" placeholder="Width" style="text-align:right" value="<?php echo $dimeArr[1]?>"  required />
                      <input role="number" type="hidden" id="upheight" name ="_height" class="form-control" placeholder="Height" max="3" style="text-align:right" value="<?php echo $dimeArr[0]?>" required />
                      <input id="upsaveDime" type="hidden" class="form-control" value="Done">
                  </div>
                </div>-->
                <div class="col-md-8">
                  <div class="form-group">
                    <label class="control-label">Description</label>
                    <textarea type="text" id="descText" class="form-control" rows="4" name="_description"><?php echo $trow['productDescription'];?></textarea>
                  </div>
                </div>
              </div>

              <div class="row">
<!--div class="col-md-6">
<div class="form-group">
<label>Quantity On-Hand</label>
<div class="input-group">
<div class="input-group-addon"></div>
<input type="number" class="form-control" step="0.01" id="exampleInputuname" name="quan" style="text-align: right;" value="<?php echo $trow['prodQuantity'];?>" required/> </div>
</div>
</div-->
<div class="col-md-4 pull-right">
  <div class="form-group">
    <label>Price</label>
    <div class="input-group">
      <div class="input-group-addon"><small>&#8369;</small></div>
      <input class="form-control" step="0.01" id="remText" name="_price" placeholder="0.00" style="text-align: right;" value="<?php echo $trow['productPrice'];?>" required/> </div>
    </div>
  </div>
</div>


   <div class="row">
                  <div class="col-md-12">
                    <h3 class="box-title m-t-20">Upload Image</h3><span id="x" style="color:red">*</span>
                    <input type="file" enctype="multipart/form-data" id="image" name="image" class="dropify" data-default-file="plugins/products/<?php echo $trow['prodMainPic']?>">
                    <input type="hidden" name="exist_image" value="<?php echo $trow['prodMainPic']?>">
                    </div>
                  </div>

<div class="modal-footer"><span id="notif" style="color:red"></span>
  <button type="submit" class="btn btn-success waves-effect text-left" id="updateBtn" disabled=""><i class="fa fa-check"></i> Save</button>
  <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>

</div>
</div>
</div>
</div>
</form>
</div>
</div>
</div>
<!-- /.modal -->
<!-- Delete Product Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="deleteProductModal" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content" id="delete">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title">Deactivate Product</h3>
      </div>
      <div class="modal-body">
        <h4>Are you sure you want to deactivate this Product?</h4>
      </div>
      <div class="modal-footer">
        <a href="delete-prod.php?id=<?php echo $jsID;?>" type="button" role="button" class="btn btn-danger waves-effect text-left">Confirm</a>
        <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
<!-- /.modal -->

</div>
</div>
</div>
</div>
</body>
</html>
