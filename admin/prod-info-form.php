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
<script>
function deleteRow(row){
  var result = confirm("Remove Product?");
  if(result){
    var i=row.parentNode.parentNode.rowIndex;
    document.getElementById('selectedMaterials').deleteRow(i);
  }
}
</script>
<!-- New Framework Material Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="newFrameworkMaterialModal" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="new">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title" id="modalProduct">New Production Information</h3>
      </div>
      <form id="myForm" action="prod-info-add.php" method = "post">
        <div class="modal-body">
          <div class="descriptions">

            <div class="form-body">

              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label">Category</label><span id="x" style="color:red"> *</span>
                    <select class="form-control" data-placeholder="Choose a Category" tabindex="1" name="cat" id="cat">
                      <option value="0">Choose Category</option>
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

                <div class="col-md-3">
                  <div class="form-group">
                    <label class="control-label">Type</label><span id="x" style="color:red"> *</span>
                    <select class="form-control" data-placeholder="Choose a Category" tabindex="1" name="_category" id="type" disabled>


                    </select>
                  </div>
                </div>

               <!--<div class="row">
              <div class="col-md-12 ">
                <div class="form-group">
                  <div id="type">

                  </div>
                </div>
              </div>
            </div>-->

            <div class="col-md-5">
              <div class="form-group">
                <label class="control-label">Furniture Name</label><span id="x" style="color:red"> *</span>
                <select class="form-control" tabindex="1" name="prod" id="products" disabled>

                </select>
                <p id="errorProd" style="color:red"></p>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="control-label">Phase</label><span id="x" style="color:red"> *</span>
                <select class="form-control" tabindex="1" name="phase">
                  <?php
                  include "dbconnect.php";
                  $sql = "SELECT * FROM tblphases order by phaseName;";
                  $result = mysqli_query($conn, $sql);
                  while ($row = mysqli_fetch_assoc($result))
                  {
                    if($row['phaseStatus']!='Archived'){
                      echo('<option value='.$row['phaseID'].'>'.$row['phaseName'].'</option>');
                    }
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
        <h4><label class="control-label">Materials Needed</label></h4>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label class="control-label">Type</label><span id="x" style="color:red"> *</span>
                <select class="form-control" tabindex="1" name="material" id="mat">
                  <option value="">Choose Material Type</option>
                  <?php
                  include "dbconnect.php";
                  $sql = "SELECT * FROM tblmat_type order by matTypeName;";
                  $result = mysqli_query($conn, $sql);
                  while ($row = mysqli_fetch_assoc($result))
                  {
                    if($row['matTypeStatus']=='Listed'){
                      echo('<option value='.$row['matTypeID'].' data-name="'.$row['matTypeName'].'">'.$row['matTypeName'].'</option>');
                    }
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label class="control-label">Material</label><span id="x" style="color:red"> *</span>
                <select class="form-control" tabindex="1" name="var" id="var">
                  <option value="">-</option>
                </select>
                <p id="errorMat" style="color:red"></p>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <label class="control-label">Quantity</label><span id="x" style="color:red"> *</span>
                <input type="text" class="form-control" name="quan" id="quan" placeholder="500" style="text-align: right" />
                <p id="error" style="color:red"></p>
              </div>
            </div>

            <div class="col-md-2">
                    <label class="control-label">Unit</label><span id="x" style="color:red">
                    <select class="form-control"  data-placeholder="Select Material Category" tabindex="1" id="unit">';
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
                </div>

            <div class="col-md-1">
              <div class="form-group pull-right">
                <button id="addBtn" type="button" class="btn btn-success" style="margin-top: 27px;" disabled><i class="ti-plus"></i></button>
              </div>
            </div>

          </div>
          <div class="row">
            <div role="tabpanel" class="tab-pane fade active in" id="job">
              <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                  <div class="row">
                    <div class="table-responsive">
                      <table class="table color-bordered-table muted-bordered-table dataTable display nowrap" id="selectedMaterials">
                        <thead>
                          <tr>
                            <th style="text-align: left;">Type</th>
                            <th style="text-align: left;">Material</th>
                            <th style="text-align: left;">Quantity</th>
                            <th style="text-align: left;">Unit</th>
                            <th style="text-align: left;">Action</th>                          
                          </thead>
                          <tbody  id="tblMat" style="text-align: left;">
                            <tr id="hide">
                              <td colspan="5" style="text-align: center;">Nothing to show.</td>
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
        <button type="submit" class="btn btn-success waves-effect text-left" id="saveBtn"><i class="fa fa-check"></i> Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
      </div>                
    </form>
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
      <form action="prod-info-update.php" method = "post">
        <div class="modal-body">
          <div class="descriptions">
            <?php
            $sql1 = "SELECT * FROM tblprod_info a, tblproduct b, tblfurn_type c, tblfurn_category d WHERE a.prodInfoProduct = b.productID and b.prodTypeID = c.typeID and d.categoryID = b.prodCatID and prodInfoID = '$jsID';";
            $res = mysqli_query($conn,$sql1);
            $srow = mysqli_fetch_assoc($res);
            ?>
            <div class="form-body">
              <input type="hidden" name="recID" value="<?php echo $jsID?>"/>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label">Category</label><span id="x" style="color:red"> *</span>
                    <select class="form-control" data-placeholder="Choose a Category" tabindex="1" name="cat" id="cat">

                      <?php
                      $sql = "SELECT * FROM tblfurn_category order by categoryName;";
                      $result = mysqli_query($conn, $sql);
                      while ($row = mysqli_fetch_assoc($result))
                      {
                        if($row['categoryStatus']=='Listed'){
                          if ($srow["prodCatID"] == $row['categoryID'])
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

                <div class="col-md-3">
                  <div class="form-group">
                    <label class="control-label">Type</label><span id="x" style="color:red"> *</span>
                    <select class="form-control" data-placeholder="Choose a Category" tabindex="1" name="_category" id="type">
                      <?php
                      $sql = "SELECT * FROM tblfurn_type order by typeName;";
                      $result = mysqli_query($conn, $sql);
                      while ($row = mysqli_fetch_assoc($result))
                      {
                        if($row['typeStatus']=='Listed'){
                          if ($srow["prodTypeID"] == $row['typeID'])
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

               <!--<div class="row">
              <div class="col-md-12 ">
                <div class="form-group">
                  <div id="type">

                  </div>
                </div>
              </div>
            </div>-->

            <div class="col-md-5">
              <div class="form-group">
                <label class="control-label">Furniture Name</label><span id="x" style="color:red"> *</span>
                <select class="form-control" tabindex="1" name="prod" id="products">
                  <?php
                  $sql = "SELECT * FROM tblproduct order by productName;";
                  $result = mysqli_query($conn, $sql);
                  while ($row = mysqli_fetch_assoc($result))
                  {
                    if($row['prodStat']!='Archived'){
                      if ($srow["productID"]==$row['productID'])
                      {
                        echo('<option value="'.$row['productID'].'" selected="selected">'.$row['productName'].'</option>');
                      }
                      else
                      {
                        echo('<option value='.$row['productID'].'>'.$row['productName'] .'</option>');
                      }

                    }
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="control-label">Phase</label><span id="x" style="color:red"> *</span>
                <select class="form-control" tabindex="1" name="phase">
                  <?php
                  include "dbconnect.php";
                  $sql = "SELECT * FROM tblphases order by phaseName;";
                  $result = mysqli_query($conn, $sql);
                  while ($row = mysqli_fetch_assoc($result))
                  {
                    if($row['phaseStatus']!='Archived'){
                      if ($srow["prodInfoPhase"] == $row['phaseID'])
                      {
                        echo('<option value="'.$row['phaseID']. '" selected="selected">'.$row['phaseName'].'</option>');
                      }
                      else
                      {
                        echo('<option value="'.$row['phaseID'].'">'.$row['phaseName'].'</option>');
                      }
                    }
                  }
                  ?>
                </select>
              </div>
            </div>
          </div>
          <h4><label class="control-label">Materials Needed</label></h4>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label class="control-label">Type</label><span id="x" style="color:red"> *</span>
                <select class="form-control" tabindex="1" name="material" id="mat">
                  <?php
                  include "dbconnect.php";
                  $sql = "SELECT * FROM tblmat_type order by matTypeName;";
                  $result = mysqli_query($conn, $sql);
                  while ($row = mysqli_fetch_assoc($result))
                  {
                    if($row['matTypeStatus']=='Listed'){
                      echo('<option value='.$row['matTypeID'].' data-name="'.$row['matTypeName'].'">'.$row['matTypeName'].'</option>');
                    }
                  }
                  ?>
                </select>
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label class="control-label">Material</label><span id="x" style="color:red"> *</span>
                <select class="form-control" tabindex="1" name="var" id="var" disabled>

                </select>
              </div>
            </div>

            <div class="col-md-2">
              <div class="form-group">
                <label class="control-label">Quantity(in pcs)</label><span id="x" style="color:red"> *</span>
                <input type="text" class="form-control" name="quan" id="quan" placeholder="500" style="text-align: right" />
              </div>
            </div>

            <div class="col-md-2">
                    <label class="control-label">Unit</label><span id="x" style="color:red">
                    <select class="form-control"  data-placeholder="Select Material Category" tabindex="1" id="unit">';
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
                </div>

            <div class="col-md-1">
              <div class="form-group pull-right">
                <button id="addBtn" type="button" class="btn btn-success" style="margin-top: 27px;"><i class="ti-plus"></i></button>
              </div>
            </div>

          </div>


          <div class="row">
            <div role="tabpanel" class="tab-pane fade active in" id="job">
              <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                  <div class="row">
                    <div class="table-responsive">
                      <table class="table color-bordered-table muted-bordered-table dataTable display nowrap" id="selectedMaterials">
                        <thead>
                          <tr>
                            <th style="text-align: left;">Type</th>
                            <th style="text-align: left;">Material</th>
                            <th style="text-align: left;">Quantity</th>
                            <th style="text-align: left;">Unit</th>
                            <th style="text-align: left;">Action</th>                          
                          </thead>
                          <tbody  id="tblMat" style="text-align: left;">
                            <?php
                            $sql = "SELECT * FROM tblprod_materials a, tblmaterials b, tblmat_var c, tblmat_type d, tblunitofmeasure e WHERE a.p_matMaterialID = b.materialID and a.p_matUnit = e.unID and d.matTypeID = b.materialType and a.p_matDescID = c.variantID and p_prodInfoID = '$jsID'";
                            $res = mysqli_query($conn,$sql);
                            while($row = mysqli_fetch_assoc($res)){
                              if($row['p_matStatus']!="Archived"){
                                $descName = desc($row['variantID']);

                                echo "<tr id='trowID".$row['p_matID']."'>
                                <td>".$row['matTypeName']."</td>
                                <td><input type='hidden' class='form-control' id='exist".$row['p_matID']."' name='existRec[]' value='". $row['materialID'] ."'/>". $descName.'-'.$row['materialName']."</td>"."
                                <input type='hidden' class='form-control' name='mat_var[]' value='". $row['variantID'] ."' />
                                </td>
                                <td><input type='text' class='col-lg-4' name='quan[]' value='". $row['p_matQuantity'] ."'/>
                                </td>
                                <td>".$row['unUnit']."<input type='hidden' class='form-control' id='quan' style='text-align:right;' name='unit[]' value='". $row['unID'] ."'/></td>";
                                echo '<td><input id="remove" type="button" onclick="deleteExisting('.$row['p_matID'].')" class="btn btn-danger" value="X"/></td></tr>';

                              //<input type='hidden' class='form-control' name='quan[]' value='". $row['p_matQuantity']  ."'/>
                              }}

                              function desc($iid){
                                include "dbconnect.php";
                                $sql = "SELECT * FROM tblvariant_desc a, tblmat_var b WHERE b.variantID = a.varMatvarID AND a.varMatvarID = '$iid'";
                                $result = mysqli_query($conn,$sql);
                                $desc = "";
                                while($row = mysqli_fetch_assoc($result)){
                                  $desc = $desc . $row['varVariantDesc'] . "-";
                                }
                                $temp = substr(trim($desc), 0, -1);
                                return $temp;
                              }
                              ?>
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
          <button type="submit" class="btn btn-success waves-effect text-left"><i class="fa fa-check"></i> Save</button>
          <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
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
          <h3 class="modal-title">Deactivate Production Information?</h3>
        </div>
        <div class="modal-body">
          <h4>Are you sure you want to deactivate this Production Information?</h4>
        </div>
        <div class="modal-footer">
          <a href="prod-info-delete.php?id=<?php echo $jsID;?>" type="button" role="button" class="btn btn-danger waves-effect text-left">Confirm</a>
          <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>


  <!-- View Product Modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="viewProductModal" aria-hidden="true" style="display: none;">

    <div class="modal-dialog modal-lg" >
      <div class="modal-content" id="view1">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        </div>
        <?php
          $tsql = "SELECT * FROM tblproduct WHERE productID = $jsID;";
      $tresult = mysqli_query($conn,$tsql);
      $trow = mysqli_fetch_assoc($tresult);
        ?>
        <div class="modal-body">
          <div class="descriptions">
            <div class="">
              <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <h4 class="m-b-0 m-t-0">Product Name: <?php echo $trow['productName'];?></h4>
                    
                  </div>
                </div>
                <input type="hidden" name="prodID" value="<?php echo $jsID;?>">
                <div class="row" style="margin:20px;">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Phase</label><span id="x" style="color:red"> *</span>
                      <select class="form-control" tabindex="1" name="phase" id="phase">
                        <?php
                        include "dbconnect.php";
                        $sql = "SELECT * FROM tblphases;";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result))
                        {
                          if($row['phaseStatus']!='Archived'){
                            echo('<option value="'.$row['phaseID'].'">'.$row['phaseName'].'</option>');
                          }

                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="table-responsive">
                <h4 style="margine:10px;"><label class="control-label">Materials Needed</label></h4>
                    <table class="table table-bordered display nowrap">
                      <thead>
                        <tr>
                          <th style="text-align: center;">Type</th>
                          <th style="text-align: center;">Material</th>
                          <th style="text-align: center;">Quantity</th>
                          <th style="text-align: center;">Unit</th>
                        </tr>
                      </thead>
                      <tbody id="tblMatView">

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