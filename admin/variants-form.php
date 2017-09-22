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
if (!$conn)
{
  die("Connection failed: " . mysqli_connect_error());
}

?>
 

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
                    <label class="control-label">Material</label><span id="x" style="color:red"> *</span>
                    <select id='material' class="form-control" tabindex="1" name="material" required>
                      <option value="" selected disabled>Select Material</option>
                      <?php
                      include "dbconnect.php";
                      $sql = "SELECT * FROM tblmaterials a, tblmat_type b WHERE a.materialType = b.matTypeID order by materialName;";
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
              </div>
                
              <div class="row">
                <label class="control-label"> &nbsp;Variants</label><span id="x" style="color:red"> * </span><span style="font-size:13px"> (if you will need more than three variant, you may want to split them) </span>
                  <div class="form-group" id="dynamic_field">
                    <div class="col-xs-5">
                        <select class="form-control" data-placeholder="Select Attributes" tabindex="1" name="attribs[]" id="attribs">
                          <?php
                          $sql = "SELECT * FROM tblattributes;";
                          $result = mysqli_query($conn, $sql);
                          while ($row = mysqli_fetch_assoc($result))
                          {
                            if($row['attributeStatus']=='Active'){
                              echo('<option value='.$row['attributeID'].'>'.$row['attributeName'].'</option>');
                            }
                          }
                          ?>
                        </select>
                    </div>
                    <div class="col-xs-7" id="input_multiple">
                        <select class="form-control" onkeyup="updateValidate('0')" multiple="multiple" data-placeholder="(separated by comma or enter)" tabindex="1" name="attrib[]" id="attrib0" required><span id="message0"></span>
                    </select>
                        <div class="control-label" id="input_field"></div>
                    </div>
                  </div>
              </div>
              <div class="row">
                  <div class="form-group" id="dynamic_field">
                    <div class="col-xs-5">
                        <select class="form-control" data-placeholder="Select Attributes" tabindex="1" name="attribs[]" id="attribs1"><span id="message1"></span>
                          <?php
                          $sql = "SELECT * FROM tblattributes;";
                          $result = mysqli_query($conn, $sql);
                          while ($row = mysqli_fetch_assoc($result))
                          {
                            if($row['attributeStatus']=='Active'){
                              echo('<option value='.$row['attributeID'].'>'.$row['attributeName'].'</option>');
                            }
                          }
                          ?>
                        </select>
                    </div>
                    <div class="col-xs-7" id="input_multiple">
                        <select class="form-control" disabled="true" onkeyup="updateValidate('1')" multiple="multiple" data-placeholder="(separated by comma or enter)" tabindex="1" name="attrib1[]" id="attrib1">
                    </select>
                        <div class="control-label" id="input_field1"></div>
                    </div>
                  </div>
              </div>  
              <div class="row">
                  <div class="form-group" id="dynamic_field">
                    <div class="col-xs-5">
                        <select class="form-control" data-placeholder="Select Attributes" tabindex="1" name="attribs[]" id="attribs2">
                          <?php
                          $sql = "SELECT * FROM tblattributes;";
                          $result = mysqli_query($conn, $sql);
                          while ($row = mysqli_fetch_assoc($result))
                          {
                            if($row['attributeStatus']=='Active'){
                              echo('<option value='.$row['attributeID'].'>'.$row['attributeName'].'</option>');
                            }
                          }
                          ?>
                        </select>
                    </div>
                    <div class="col-xs-7" id="input_multiple">
                        <select class="form-control" disabled="true" multiple="multiple" data-placeholder="(separated by comma or enter)" tabindex="1" name="attrib2[]" onkeyup="updateValidate('2')" id="attrib2"><span id="message2"></span>
                    </select>
                        <div class="control-label" id="input_field2"></div>
                    </div>
                  </div>
              </div>  
                
              <!-- <div class="row">
              <div class="col-md-12 ">
                  <div class="form-group">
                <label class="control-label">Variants: &nbsp;&nbsp;</label><span id="attribbValidate"></span>
                    <select class="form-control" multiple="multiple" data-placeholder="45g / Yellow / Odorless (separated by comma or enter)" tabindex="1" name="attribs[]" id="attribs" required>
                    </select>
                  </div>
                </div>
              </div> -->
                
             <!-- <label class="box-title">Description</label><span id="x" style="color:red"> *</span>
              <div class="row">
                <div class="col-md-12 ">
                  <div class="form-group">
                    <textarea class="form-control" rows="4" name="desc" placeholder="Ex. Red,Leather,Ikat Patterned"></textarea>
                  </div>
                </div>
              </div>-->

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
              $tsql = "SELECT * FROM tblmat_var WHERE mat_varID = $jsID";
              $tresult = mysqli_query($conn,$tsql);
              $trow = mysqli_fetch_assoc($tresult);
              ?>

              <div class="form-body">

              <input type="hidden" name="id" value="<?php echo $jsID?>">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="hidden" name="" value="<?php echo $trow['mat_varID']?>">
                      <label class="control-label">Material</label><span id="x" style="color:red"> *</span>
                      <select id='material' name="material" class="form-control" tabindex="1" required>
                        <?php
                        include "dbconnect.php";
                        $sql = "SELECT * FROM tblmaterials;";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result))
                        {
                          if($row['materialStatus']=='Listed'){
                            if ($trow["materialID"] == $row['materialID'])
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
                      <label class="control-label">Material Variant</label>
                      <textarea class="form-control" rows="2" name="description" id="description" required><?php echo $trow['mat_varDescription']?></textarea><span id='descValid'></span>
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
