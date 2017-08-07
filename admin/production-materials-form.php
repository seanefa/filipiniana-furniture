<?php

session_start();
if(isset($GET['id'])){
  $jsID = $_GET['id']; 
}
$jsID=$_GET['id'];

$_SESSION['varname'] = $jsID;
include 'dbconnect.php';
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

?>
<!-- New Framework Material Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="newFrameworkMaterialModal" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="new">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title" id="modalProduct">New Production Material</h3>
      </div>
      <form action="" method = "post">
        <div class="modal-body">
          <div class="descriptions">

            <div class="form-body">

              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label">Category</label><span id="x" style="color:red"> *</span>
                    <select class="form-control" data-placeholder="Choose a Category" tabindex="1" name="cat">
                      <option value="0">Choose Category</option>
                      <?php
                      $sql = "SELECT * FROM tblfurn_category;";
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

                <div class="col-md-3">
                  <div class="form-group">
                    <label class="control-label">Type</label><span id="x" style="color:red"> *</span>
                    <select class="form-control" data-placeholder="Choose a Category" tabindex="1" name="_category">
                      <?php
                      $sql = "SELECT * FROM tblfurn_type;";
                      $result = mysqli_query($conn, $sql);
                      while ($row = mysqli_fetch_assoc($result))
                      {
                        if($row['typeStatus']=='Listed'){
                          echo('<option value='.$row['typeID'].'>'.$row['typeName'].'</option>');
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-5">
                  <div class="form-group">
                    <label class="control-label">Furniture Name</label><span id="x" style="color:red"> *</span>
                    <select class="form-control" tabindex="1" name="material">
                      <?php
                      include "dbconnect.php";
        // Create connection
                      $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
                      if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                      }
                      $sql = "SELECT * FROM tblproduct;";
                      $result = mysqli_query($conn, $sql);
                      while ($row = mysqli_fetch_assoc($result))
                      {
                        if($row['prodStat']!='Archived'){
                          echo('<option value='.$row['productID'].'>'.$row['productName'].'</option>');
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div role="tabpanel" class="tab-pane fade active in" id="job">
                  <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                      <div class="row">
                        <div class="table-responsive">
                          <label class="control-label">Materials Needed</label><span id="x" style="color:red"> *</span>
                          <table class="table color-bordered-table muted-bordered-table dataTable display nowrap" id="tblProducts">
                            <thead>
                              <tr>
                                <th style="text-align: left;">Material</th>
                                <th style="text-align: left;">Variant</th>
                                <th style="text-align: left;">Size/Quantity</th>
                                <th style="text-align: left;">Unit</th>
                                <th style="text-align: left;"></th>                          
                              </thead>
                              <tbody  id="tb_row" style="text-align: left;">
                              <tr>
                                <td>
                                  <select class="form-control" tabindex="1" name="material">
                                    <?php
                                    include "dbconnect.php";
        // Create connection
                                    $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
                                    if (!$conn) {
                                      die("Connection failed: " . mysqli_connect_error());
                                    }
                                    $sql = "SELECT * FROM tblmaterials;";
                                    $result = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_assoc($result))
                                    {
                                      if($row['materialStatus']=='Listed'){
                                        echo('<option value='.$row['materialID'].'>'.$row['materialName'].'</option>');
                                      }
                                    }
                                    ?>
                                  </select>
                                </td>
                                <td>
                                  <select class="form-control" tabindex="1" name="material">
                                    <?php
                                    include "dbconnect.php";
        // Create connection
                                    $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
                                    if (!$conn) {
                                      die("Connection failed: " . mysqli_connect_error());
                                    }
                                    $sql = "SELECT * FROM tblmaterials;";
                                    $result = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_assoc($result))
                                    {
                                      if($row['materialStatus']=='Listed'){
                                        echo('<option value='.$row['materialID'].'>'.$row['materialName'].'</option>');
                                      }
                                    }
                                    ?>
                                  </select>
                                </td>
                                <td>
                                  <input type="text" id="username" class="form-control" name="Dimensions" placeholder="500" required />
                                </td>
                                <td>
                                  <select class="form-control" data-placeholder="Choose a Fabric" tabindex="1" name="unit">
                                    <?php
                                    include "dbconnect.php";
        // Create connection
                                    $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
                                    if (!$conn) {
                                      die("Connection failed: " . mysqli_connect_error());
                                    }
                                    $sql = "SELECT * FROM tblunitofmeasure;";
                                    $result = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_assoc($result))
                                    {
                                      if($row['unStatus'] !='Archived'){
                                        echo('<option value='.$row['unID'].'>'.$row['unUnit'].'</option>');
                                      }
                                    }
                                    ?>
                                  </select>
                                </td>
                                <td>

                                  <button id="addBtn" type="button" class="btn btn-success">+</button>
                                  <button id="removeBtn" type="button" class="btn btn-danger">X</button>
                                </td>
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
          </div>
          <div class="modal-footer">
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
        $category = $trow['prodTypeID'];


        $asql = "SELECT * FROM tblframeworks WHERE frameworkID = $framework;";
        $aresult = mysqli_query($conn,$asql);
        $arow = mysqli_fetch_assoc($aresult);

        $bsql = "SELECT * FROM tblfabrics WHERE fabricID = $fabric;";
        $bresult = mysqli_query($conn,$bsql);
        $brow = mysqli_fetch_assoc($bresult);

        $csql = "SELECT * FROM tblfurn_type WHERE typeID = $category;";
        $cresult = mysqli_query($conn,$csql);
        $crow = mysqli_fetch_assoc($cresult);

        ?>
        <div class="modal-body">
          <div class="descriptions">
            <div class="">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="white-box text-center"> <img src="plugins/images/<?php echo $trow['prodMainPic']?>" alt="Unavailable" class="img-responsive"> </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <h4 class="m-b-0 m-t-0" style="text-align: center;">Product Name</h4>
                    <div class="row">
                      <h4 class="m-b-0 m-t-0" style="text-align: center;"><?php echo $trow['productName'];?></h4>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <h4 class="m-b-0 m-t-0" style="text-align: center;">Dimensions(L x W x H)</h4>
                    <div class="row">
                      <h4 class="m-b-0 m-t-0" style="text-align: center;"> <?php echo $trow['prodSizeSpecs'];?> </h4>
                    </div>
                  </div>
                </div>
                <br>
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="table-responsive">
                    <table class="table table-bordered display nowrap" id="tblPackages">
                      <thead>
                        <tr>
                          <th style="text-align: center;">Materials</th>
                          <th style="text-align: center;">Quantity</th>
                          <th style="text-align: center;">Unit</th>
                        </tr>
                      </thead>
                      <tbody>
                        <td> </td>
                        <td> </td>
                        <td> </td>
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

  <!-- Update Framework Material Modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="updateFrameworkMaterialModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" id="update">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title" id="modalProduct">Update Production Material</h3>
        </div>
        <form enctype="multipart/form-data" role="form" action="" method="post">
          <div class="modal-body">
            <div class="descriptions">
              <?php
              $tsql = "SELECT * FROM tblmat_var WHERE variantID = $jsID";
              $tresult = mysqli_query($conn,$tsql);
              $trow = mysqli_fetch_assoc($tresult);
              ?>

              <input type="hidden" name="id" value="<?php echo $jsID?>">
              <div class="form-body">
                <div class="row">
                  <div class="col-md-5">
                    <div class="form-group">
                      <label class="control-label">Material</label><span id="x" style="color:red"> *</span>
                      <select class="form-control" tabindex="1" name="material">
                        <?php
                        include "dbconnect.php";
        // Create connection
                        $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
                        if (!$conn) {
                          die("Connection failed: " . mysqli_connect_error());
                        }
                        $sql = "SELECT * FROM tblmaterials;";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result))
                        {
                          if($row['materialStatus']=='Listed'){
                            echo('<option value='.$row['materialID'].'>'.$row['materialName'].'</option>');
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label class="control-label">Size/Quantity</label><span id="x" style="color:red"> *</span>
                      <input type="text" id="username" class="form-control" name="Dimensions" placeholder="500" required /><span id="message"></span> </div>
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label class="control-label">Unit</label><span id="x" style="color:red"> *</span>
                        <select class="form-control" data-placeholder="Choose a Fabric" tabindex="1" name="unit">
                          <?php
                          include "dbconnect.php";
        // Create connection
                          $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
                          if (!$conn) {
                            die("Connection failed: " . mysqli_connect_error());
                          }
                          $sql = "SELECT * FROM tblunitofmeasure;";
                          $result = mysqli_query($conn, $sql);
                          while ($row = mysqli_fetch_assoc($result))
                          {
                            if($row['unStatus'] !='Archived'){
                              echo('<option value='.$row['unID'].'>'.$row['unUnit'].'</option>');
                            }
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-1" style="margin-top: 35px;">
                      <a href="javascript:void(0)" class="text-inverse" title="Remove" data-toggle="tooltip" data-original-title="Remove" aria-describedby="tooltip553156"  style="margin-top: 50px;"><i class="ti-close"></i></a>
                    </div>
                  </div>
                </div>






              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success waves-effect text-left" id="addFab" disabled=""><i class="fa fa-check"></i> Save</button>
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
            </div>

          </div>
        </form>
      </div>
    </div>
    <!-- /.modal -->

    <!-- Delete Framework Material Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="deleteFrameworkMaterialModal" aria-hidden="true" style="display: none;">
      <div class="modal-dialog">
        <div class="modal-content" id="delete">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 class="modal-title">Deactivate Production Material?</h3>
          </div>
          <div class="modal-body">
            <h4>Are you sure you want to deactivate this Production Material?</h4>
          </div>
          <div class="modal-footer">
            <a href="variants-delete.php?id=<?php echo $jsID;?>" type="button" role="button" class="btn btn-danger waves-effect text-left">Confirm</a>
            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>