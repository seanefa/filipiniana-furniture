<?php
include "menu.php";
include 'dbconnect.php';
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
<!DOCTYPE>
<html>
<head>
</head>
<body>
  <div class="modal fade" tabindex="-1" role="dialog" id="newJobModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" id="new">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title" id="modalProduct">New Material Type</h3>
        </div>
        <form action="material-type-add.php" method="post">
          <div class="modal-body">
            <div class="descriptions">
              <div class="form-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                     <label class="control-label">Name</label> <span id="x" style="color:red"> *</span>
                      <input type="text" maxlength="45" id="matTypeName" class="form-control" name="name" required><span id="matTypeNameValidate"></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Remarks</label>
                      <textarea type="text" class="form-control" name="desc"></textarea>
                    </div>
                  </div>
                </div>
                <!--<div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label">Unit of Measurement</label><span id="x" style="color:red"> *</span>
                    <select class="form-control" multiple="multiple" data-placeholder="Select Variant Attributes" tabindex="1" name="attribs[]" id="unit">
                      <?php
                      $sql = "SELECT * FROM tblunitofmeasure;";
                      $result = mysqli_query($conn, $sql);
                      while ($row = mysqli_fetch_assoc($result))
                      {
                        if($row['unStatus']=='Active'){
                          echo('<option value='.$row['unID'].'>'.$row['unName'].'</option>');
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>-->
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success waves-effect text-left" id="saveBtn" disabled=""><i class="fa fa-check"></i> Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
          </div>
        </form>
      </div>
    </div>
    <!-- /.modal -->
    <!-- Update Material Type Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="updateJobModal" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-lg">
        <div class="modal-content" id="update">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 class="modal-title" id="modalProduct">Update Material Type</h3>
          </div>
          <form action="material-type-update.php" method="post">
            <div class="modal-body">
              <div class="descriptions">
                <?php
                $tsql = "SELECT * FROM tblmat_type WHERE matTypeID = $jsID";
                $tresult = mysqli_query($conn,$tsql);
                $trow = mysqli_fetch_assoc($tresult);
                ?>
                <div class="form-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label">Name</label><span id="x" style="color:red"> *</span>
                        <input type="text" id="editname" class="form-control" placeholder="Name" name="name" value="<?php echo $trow['matTypeName']; $_SESSION['tempname'] = $trow['matTypeName'];?>"><span id="message1"></span>
                      </div>
                    </div>
                  </div>
              <br>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label">Remarks</label>
                      <textarea type="text" id="rem" class="form-control" name="desc"><?php echo $trow['matTypeRemarks']?></textarea>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success waves-effect text-left" id="updateBtn" disabled=""><i class="fa fa-check"></i> Save</button>
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
            </div>
          </div>

        </form>
      </div>
    </div>
    <!-- /.modal -->
    <!-- Delete Material Type Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="deleteJobModal" aria-hidden="true" style="display: none;">
      <div class="modal-dialog">
        <div class="modal-content" id="delete">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 class="modal-title">Deactivate Material Type</h3>
          </div>
          <div class="modal-body">
            <h4>Are you sure you want to deactivate this Material Type?</h4>
          </div>
          <div class="modal-footer">
            <a href="delete-material-type.php?id=<?php echo $jsID;?>" type="button" role="button" class="btn btn-danger waves-effect text-left">Confirm</a>
            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </body>
  </html>