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

</script>
<!-- New Framework Material Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="newFrameworkMaterialModal" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="new">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title" id="modalProduct">New Material Variant</h3>
      </div>
      <form action="variants-add.php" method = "post">
        <div class="modal-body">
          <div class="descriptions">
            <div class="form-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">

                    <input type="hidden" name="recID" id="recID" value="0">
                    <label class="control-label">Material</label><span id="x" style="color:red"> *</span>
                    <select id='material' class="form-control" tabindex="1" name="material" required>
                      <option value="" selected disabled>Select Material</option>
                      <?php
                      include "dbconnect.php";
                      $sql = "SELECT * FROM tblmaterials a, tblmat_type b WHERE a.materialType = b.matTypeID;";
                      $result = mysqli_query($conn, $sql);
                      while ($row = mysqli_fetch_assoc($result))
                      {
                        if($row['materialStatus']=='Listed'){
                          echo('<option value='.$row['materialID'].'>'.$row['materialName'].'-'.$row['matTypeName'].'</option>');
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
              <div class="col-md-12 ">
                  <div class="form-group">
                <label class="control-label">Attributes: &nbsp;&nbsp;</label><span id="attribbValidate"></span>
                    <div id="form">

                    </div>
                  </div>
                </div>
              </div>
             <!-- <label class="box-title">Description</label><span id="x" style="color:red"> *</span>
              <div class="row">
                <div class="col-md-12 ">
                  <div class="form-group">
                    <textarea class="form-control" rows="4" name="desc" placeholder="Ex. Red,Leather,Ikat Patterned"></textarea>
                  </div>
                </div>
              </div>-->
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Remarks</label>
                      <textarea class="form-control" rows="4" name="remarks"></textarea>
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
<!-- /.modal 
  <!-- Update Framework Material Modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="updateFrameworkMaterialModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" id="update">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title" id="modalProduct">Update Material Variant</h3>
        </div>
        <form enctype="multipart/form-data" role="form" action="variants-update.php" method="post">
          <div class="modal-body">
            <div class="descriptions">
              <?php
              $tsql = "SELECT * FROM tblmat_var WHERE variantID = $jsID";
              $tresult = mysqli_query($conn,$tsql);
              $trow = mysqli_fetch_assoc($tresult);
              ?>

              <div class="form-body">

              <input type="hidden" name="recID" id="recID" value="<?php echo $jsID?>">
              <input type="hidden" name="id" value="<?php echo $jsID?>">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="hidden" name="material" value="<?php echo $trow['mat_varID']?>">
                      <label class="control-label">Material</label><span id="x" style="color:red"> *</span>
                      <select id='material' class="form-control" data-placeholder="Choose a Fabric" tabindex="1">
                        <?php
                        include "dbconnect.php";
                        $sql = "SELECT * FROM tblmaterials;";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result))
                        {
                          if($row['materialStatus']=='Listed'){
                            if ($trow["mat_varID"] == $row['materialID'])
                            {
                              echo('<option value="'.$row['materialID'].'" selected="selected">'.$row['materialName'].'</option>');
                            }
                            else
                            {
                              echo('<option value='.$row['materialID'].'>'.$row['materialName'].'</option>');
                            }

                          }
                          
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                <div class="col-md-12 ">
                  <div class="form-group">
                    <div id="form">

                    </div>
                  </div>
                </div>
              </div>

               <!-- <label class="box-title">Description</label><span id="x" style="color:red"> *</span>
                <div class="row">
                  <div class="col-md-12 ">
                    <div class="form-group">
                      <textarea class="form-control" rows="4" name="desc" placeholder="Ex. Red,Leather,Ikat Patterned"><?php //echo $trow['variantDescription'];?></textarea>
                    </div>
                  </div>
                </div>-->

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Remarks</label>
                      <textarea class="form-control" rows="4" name="remarks"><?php echo $trow['variantRemarks']?></textarea>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success waves-effect text-left" id="addFab"><i class="fa fa-check"></i> Save</button>
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
            <h3 class="modal-title">Deactivate Material Variant?</h3>
          </div>
          <div class="modal-body">
            <h4>Are you sure you want to deactivate this Material Variant?</h4>
          </div>
          <div class="modal-footer">
            <a href="variants-delete.php?id=<?php echo $jsID;?>" type="button" role="button" class="btn btn-danger waves-effect text-left">Confirm</a>
            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>