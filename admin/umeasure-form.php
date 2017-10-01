<?php
include "dbconnect.php";
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
<!-- New Promo Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="newFrameworkMaterialModal" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="new">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title" id="modalProduct">New Unit of Measurement</h3>
      </div>
      <form action="add-umeasure.php" method = "post">
        <div class="modal-body">
          <div class="descriptions">
            <div class="form-body">
              
                
                <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label">Unit Category</label><span id="x" style="color:red"> *</span>
                    <select class="form-control" multiple="multiple" data-placeholder="Select Category" tabindex="1" name="attribs[]" id="attribs" required>
                      <?php
                      $sql = "SELECT * FROM tblunitofmeasurement_category order by uncategoryName;";
                      $result = mysqli_query($conn, $sql);
                      while ($row = mysqli_fetch_assoc($result))
                      {
                        if($row['uncategoryStatus']=='Active'){
                          echo('<option value='.$row['uncategoryID'].'>'.$row['uncategoryName'].'</option>');
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
                      <label class="control-label">Name</label><span id="x" style="color:red"> *</span>
                      <input type="text" id="unitName" class="form-control" name="uType" required /><span id="message"></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Unit</label><span id="x" style="color:red"> *</span>
                      <input type="text" id="unitMeasure" class="form-control" name="uUnit" required/><span id="message1"></span> </div>
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
    <!-- /.modal -->
    <!-- Update Promo Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="updatePromoModal" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-lg">
        <div class="modal-content" id="update">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 class="modal-title" id="modalProduct">Update Unit of Measurement</h3>
          </div>
          <form action="umeasure-update.php" method="post">
            <div class="modal-body">
              <div class="descriptions">
                <?php
                $rsql = "SELECT * FROM tblunitofmeasure WHERE unID = $jsID";
                $rresult = mysqli_query($conn,$rsql);
                $rrow = mysqli_fetch_assoc($rresult);
                ?>

                <div class="form-body">
                  <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="control-label">Name</label><span id="x" style="color:red"> *</span>
                        <input type="text" id="edit1" name="uType" class="form-control" value="<?php echo $rrow['unType'];  $_SESSION['tempname'] = $rrow['unType'];?>" onkeyup="updateValidate('1')" required/><span id="messagename"></span>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="control-label">Unit</label><span id="x" style="color:red"> *</span>
                          <input type="text" name="uUnit" value="<?php echo $rrow['unUnit'];?>" class="form-control" id="edit2" onkeyup="updateValidate('2')" required/><span id="messageUnit"></span> </div>
                        </div>
                  </div>
                    
                <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label">Unit Category</label><span id="x" style="color:red"> *</span>
                    <select class="form-control" multiple="multiple" data-placeholder="Select Category" tabindex="1" name="attribs[]" id="attribs" required>
                      <?php
                      $sql = "SELECT * FROM tblunit_cat a, tblunitofmeasurement_category b WHERE a.unitID = '$jsID' AND a.uncategoryID = b.uncategoryID;";
                      $result = mysqli_query($conn, $sql);
                      $attribs = "";
                      while ($row = mysqli_fetch_assoc($result))
                      {
                          $attribs = $attribs . $trow['uncategoryID'] . ",";
                          
                        /*if($row['uncategoryStatus']=='Active'){
                          echo('<option value='.$row['uncategoryID'].'>'.$row['uncategoryName'].'</option>');
                        }*/
                      }
                        
                      $temp = substr(trim($attribs), 0, -1);
                      //$attribs = array();
                      $attribs = explode(',',$temp);
                      sort($attribs);
                    
                      $sql1 = "SELECT * FROM tblunitofmeasurement_category;";
                      $result1 = mysqli_query($conn, $sql1);
                      $cnt = 0;
                      while ($row1 = mysqli_fetch_assoc($result1))
                      {
                        if($attribs[$cnt]==$row1['uncategoryID']){
                          echo('<option value='.$row1['uncategoryID'].' selected="selected">'.$row1['uncategoryName'].'</option>');
                          $cnt++;
                        }
                        else{
                          echo('<option value='.$row1['uncategoryID'].'>'.$row1['uncategoryName'].'</option>');
                        }
                        //$cnt++;
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
                    
                </div>
                <div class="modal-footer">
                <span id="notif" style="color:red"></span>
                  <button type="submit" class="btn btn-success waves-effect text-left" id="updateBtn"><i class="fa fa-check"></i> Save</button>
                  <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!-- /.modal -->
        <!-- Delete Promo Modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="deletePromoModal" aria-hidden="true" style="display: none;">
          <div class="modal-dialog">
            <div class="modal-content" id="delete">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 class="modal-title">Deactivate Unit of Measurement</h3>
              </div>
              <div class="modal-body">
                <h4>Are you sure you want to deactivate this Measurement?</h4>
              </div>
              <div class="modal-footer">
                <a href="delete-umeasure.php?id=<?php echo $jsID;?>" type="button" role="button" class="btn btn-danger waves-effect text-left">Confirm</a>
                <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Cancel</button>
              </div>
            </div>
          </div>
        </div>
