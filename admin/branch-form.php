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
  <!-- New Branch Modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="newBranchModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" id="new">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title" id="modalProduct">New Branch</h3>
        </div>
            <form action="add-branch.php" method="post">
        <div class="modal-body">
          <div class="descriptions">
              <div class="form-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Location</label><span id="x" style="color:red"> *</span>
                      <input type="text" id="branchName" class="form-control" placeholder="Location" name="location" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Address</label><span id="x" style="color:red"> *</span>
						<textarea class="form-control" plaseholder="Address" name="address" required></textarea>
                    </div>
                  </div>
                </div>
                <label class="control-label">Remarks</label>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
						<textarea class="form-control" name="remarks"></textarea>
                    </div>
                  </div>
                </div>
              </div>
          </div>
          </div>
                <div class="modal-footer">
                  <input type="submit" class="btn btn-success waves-effect text-left" value="Save">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
      </div>
    </div>
  <!-- /.modal -->
  <!-- Update Branch Modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="updateBranchModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" id="update">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title" id="modalProduct">Update Branch</h3>
        </div>
        <form action="branch-update.php" method="post">
          <div class="modal-body">
            <div class="descriptions">
              <?php
              $tsql = "SELECT * FROM tblbranches WHERE branchID = $jsID";
              $tresult = mysqli_query($conn,$tsql);
              $trow = mysqli_fetch_assoc($tresult);
              ?>

              <div class="form-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Location</label><span id="x" style="color:red"> *</span>
                      <input type="text" id="branchName" class="form-control" placeholder="Location" name="location" value="<?php echo $trow['branchLocation'];?>" required>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Address</label><span id="x" style="color:red"> *</span>
                      <input type="text" id="branchName" class="form-control" placeholder="Address" name="address" value="<?php echo $trow['branchAddress'];?>"required>
                    </div>
                  </div>
                </div>
                <label class="control-label">Remarks</label>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="text" id="branchName" class="form-control" placeholder="Remarks" name="remarks" value="<?php echo $trow['branchRemarks'];?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success waves-effect text-left"><i class="fa fa-check"></i> Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
          </div>
      </form>
    </div>
  </div>
  <!-- /.modal -->
  <!-- Delete Branch Modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="deleteBranchModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content" id="delete">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title">Delete Branch</h3>
        </div>
        <div class="modal-body">
          <h4>Are you sure you want to delete this branch?</h4>
        </div>
        <div class="modal-footer">
          <a href="delete-branch.php?id=<?php echo $jsID;?>" type="button" role="button" class="btn btn-danger waves-effect text-left">Confirm</a>
          <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
	  </div>
	</div>
</body>
</html>