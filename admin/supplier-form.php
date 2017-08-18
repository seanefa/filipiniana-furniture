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
          <h3 class="modal-title" id="modalProduct">New Supplier</h3>
        </div>
        <form action="supplier-add.php" method="post">
          <div class="modal-body">
            <div class="descriptions">
              <div class="form-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group field">
                     <label class="control-label">Company Name</label> <span id="x" style="color:red"> *</span>
                      <input type="text" id="companyName" class="form-control" name="compname" required><span id="companyNameValidate"></span>
                    </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group field">
                      <label class="control-label">Company Address</label><span id="x" style="color:red"> *</span>
                      <textarea id="companyAddress" class="form-control" name="compadd" required></textarea><span id="companyAddressValidate"></span>
                    </div>
                  </div>
                </div>

                <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="control-label">Telephone Number</label><span id="x" style="color:red"> *</span>
                    <select class="form-control" multiple="multiple" data-placeholder="Select Variant Attributes" tabindex="1" name="telNumber[]" id="telNumber">
                    </select>
                  </div>
                </div>
              </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group field">
                      <label class="control-label">Contact Person</label><span id="x" style="color:red"> *</span>
                      <input type="text" id="contactPerson" class="form-control" name="conper" required><span id="contactPersonValidate"></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group field">
                      <label class="control-label">Position</label><span id="x" style="color:red"> *</span>
                      <input type="text" id="position" class="form-control" name="posi" required><span id="positionValidate"></span>
                    </div>
                  </div>
                </div>
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
    </div>
    <!-- /.modal -->
    <!-- Update Job Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="updateJobModal" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-lg">
        <div class="modal-content" id="update">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 class="modal-title" id="modalProduct">Update Job</h3>
          </div>
          <form action="supplier-update.php" method="post">
            <div class="modal-body">
              <div class="descriptions">
                <?php
                $tsql = "SELECT * FROM tblsupplier WHERE supplierID = $jsID";
                $tresult = mysqli_query($conn,$tsql);
                $trow = mysqli_fetch_assoc($tresult);
                ?>
                <div class="form-body">
                <div class="row">
                  <div class="col-md-12">
                    <input type="hidden" name="id" value="<?php echo $jsID?>">
                    <div class="form-group">
                     <label class="control-label">Company Name</label> <span id="x" style="color:red"> *</span>
                      <input type="text" id="editName" onkeyup="updateValidate('Name')" class="form-control" value="<?php echo $trow['supCompName']?>" name="compname" required><span id="messageName"></span>
                    </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Company Address</label><span id="x" style="color:red"> *</span>
                      <input type="text" id="editAddress" onkeyup="updateValidate('Address')" class="form-control" value="<?php echo $trow['supCompAdd']?>" name="compadd" required><span id="messageAddress"></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Telephone Number</label><span id="x" style="color:red"> *</span>
                      <input type="text" id="editNumber" onkeyup="updateValidate('Number')" data-mask="+63 (999) 999-9999" class="form-control" value="<?php echo $trow['supCompNum']?>" name="telnum" required><span id="messageNumber"></span>
                    </div>
                  </div>
                </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label">Contact Person</label><span id="x" style="color:red"> *</span>
                      <input type="text" id="editPerson" onkeyup="updateValidate('Person')" class="form-control" value="<?php echo $trow['supContactPerson']?>" name="conper" required><span id="messagePerson"></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label">Position</label><span id="x" style="color:red"> *</span>
                      <input type="text" id="editPosition" onkeyup="updateValidate('Position')" class="form-control" value="<?php echo $trow['supPosition']?>" name="posi" required><span id="messagePosition"></span>
                    </div>
                  </div>
                </div>


              </div>
            </div>
          </div>
            <div class="modal-footer">
              <button id="updateBtn" type="submit" class="btn btn-success waves-effect text-left"><i class="fa fa-check"></i> Save</button>
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
            </div>

        </form>
      </div>
    </div>
    <!-- /.modal -->
    <!-- Delete Job Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="deleteJobModal" aria-hidden="true" style="display: none;">
      <div class="modal-dialog">
        <div class="modal-content" id="delete">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 class="modal-title">Deactivate Supplier</h3>
          </div>
          <div class="modal-body">
            <h4>Are you sure you want to deactivate this Supplier?</h4>
          </div>
          <div class="modal-footer">
            <a href="supplier-delete.php?id=<?php echo $jsID;?>" type="button" role="button" class="btn btn-danger waves-effect text-left">Confirm</a>
            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </body>
  </html>