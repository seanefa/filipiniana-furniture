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
        <h3 class="modal-title" id="modalProduct">New Material Attribute</h3>
      </div>
      <form action="materialattri-add.php" method = "post">
        <div class="modal-body">
          <div class="descriptions">
            <div class="form-body">

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label">Attribute Name</label><span id="x" style="color:red"> *</span>
                    <input type="text" id="materialName" class="form-control" maxlength="45" name="name" required><span id="message"></span> 
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label">Measurement(s)</label><span id="x" style="color:red"> *</span>
                    <select class="form-control" multiple="multiple" data-placeholder="Select Measurement Category" tabindex="1" name="attribs[]" id="attribs" required>
                      <?php
                      $sql = "SELECT * FROM tblunitofmeasurement_category order by uncategoryName;";
                      $result = mysqli_query($conn, $sql);
                      while ($row = mysqli_fetch_assoc($result))
                      {
                        if($row['uncategoryStatus']=='Active' || $row['uncategoryStatus']=='Hidden' ){
                          echo('<option value='.$row['uncategoryID'].'>'.$row['uncategoryName'].'</option>');
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
        <div class="modal-footer">
        <span id="notif" style="color:red"></span>
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
          <h3 class="modal-title" id="modalProduct">Update Material Attribute</h3>
        </div>
        <form enctype="multipart/form-data" role="form" action="materialattri-update.php" method="post">
          <div class="modal-body">
            <div class="descriptions">
              <?php
              //$tsql = "SELECT * FROM tblmaterials a, tblmat_attribs b, tblattributes c WHERE b.matID = a.materialID AND b.attribID = c.attributeID AND a.materialID = '$jsID';"; 
              $tsql = "SELECT * FROM tblattributes WHERE attributeID = '$jsID';";
              $tresult = mysqli_query($conn,$tsql);
              $trow = mysqli_fetch_assoc($tresult);
              ?>

              <div class="form-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label">Attribute Name</label><span id="x" style="color:red"> *</span>
                        <input type="text" id="editname" maxlength="45" class="form-control" name="name" value="<?php echo $trow['attributeName']; $_SESSION['tempname'] =$trow['attributeName'];?>" required/><span id="message1"></span> </div>
                      </div>
                    </div>

                 <!-- <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label">Attributes(Ex.Type, Color, Pattern)</label><span id="x" style="color:red"> *</span>
                    <div id="tags" class="col-md-12">
                      
                      <input type="text" class="form-control" value=""/>
                    </div> 
                  </div>
                </div>
              </div>-->

              <?php
                      /*$attribs = $trow['materialVarAttribs'];
                      $attribsArr = explode(",", $attribs);
                      foreach($attribsArr as $a){
                        echo "<span>". $a ."</span>";
                      }*/
                      ?>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="control-label">Measurement</label><span id="x" style="color:red"> *</span>
                            <select class="form-control"  multiple="multiple" data-placeholder="Select Variant Attributes" tabindex="1" name="attribs[]" id="attribs" required>
                              <?php
                              $sql1 = "SELECT * FROM tblattributes a, tblattribute_measure b, tblunitofmeasurement_category c WHERE a.attributeStatus = 'Active' AND a.attributeID = '$jsID' AND b.attributeID = a.attributeID AND b.uncategoryID = c.uncategoryID;";
                              $res = mysqli_query($conn,$sql1);
                              $attribs = "";
                              while($trow = mysqli_fetch_assoc($res)){ //choosing kung ano pa nandun;
                                //if($row['mat_attribStatus']=="Active"){
                                $attribs = $attribs . $trow['uncategoryID'] . ",";
                              
                              }
                              $temp = substr(trim($attribs), 0, -1);
                              //$attribs = array();
                              $attribs = explode(',',$temp);
                              sort($attribs);
                              
                              $sql = "SELECT * FROM tblunitofmeasurement_category;";
                              $result = mysqli_query($conn, $sql);
                              $cnt = 0;
                              while ($row = mysqli_fetch_assoc($result))
                              {
                                if($attribs[$cnt]==$row['uncategoryID']){
                                  echo('<option value='.$row['uncategoryID'].' selected="selected">'.$row['uncategoryName'].'</option>');
                                  $cnt++;
                                }
                                else{
                                  echo('<option value='.$row['uncategoryID'].'>'.$row['uncategoryName'].'</option>');
                                }
                                //$cnt++;
                              }

                              ?>
                            </select>
                          </div>
                        </div>
                      </div>

                      <input type="hidden" name="intags" id="intags" >

                    </div>

                  </div>
                </div>
                <div class="modal-footer">
                <span id="notif" style="color:red"></span>
                  <button type="submit" class="btn btn-success waves-effect text-left" id="updateBtn"><i class="fa fa-check"></i> Save</button>
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
                <h3 class="modal-title">Deactivate Material</h3>
              </div>
              <div class="modal-body">
                <h4>Are you sure you want to deactivate this Material?</h4>
              </div>
              <div class="modal-footer">
                <a href="delete-material-attribute.php?id=<?php echo $jsID;?>" type="button" role="button" class="btn btn-danger waves-effect text-left">Confirm</a>
                <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Cancel</button>
              </div>
            </div>
          </div>
        </div>