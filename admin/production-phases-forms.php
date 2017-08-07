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
          <h3 class="modal-title" id="modalProduct">New Phase</h3>
        </div>
        <form action="" method="post">
          <div class="modal-body">
            <div class="descriptions">
              <div class="form-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                     <label class="control-label">Product Name</label> <span id="x" style="color:red"> *</span>
                      <input type="text" id="username" class="form-control" name="name" required><span id="message"></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                     <label class="control-label">Design</label> <span id="x" style="color:red"> *</span>
                      <input type="text" id="username" class="form-control" name="name" required><span id="message"></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                     <label class="control-label">Phases:</label> <span id="x" style="color:red"> *</span>
                      <div class="row">
                     <input type="checkbox" name="chk_group" value="value1" /> Carpentry<br />
                     <input type="checkbox" name="chk_group" value="value2" /> Carving<br />
                     <input type="checkbox" name="chk_group" value="value3" /> Filling<br />
                     <input type="checkbox" name="chk_group" value="value3" /> Finishing<br />
                     <input type="checkbox" name="chk_group" value="value3" /> Upholstery
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
    <!-- Update Job Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="updateJobModal" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-lg">
      <div class="modal-content" id="update">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title" id="modalProduct">Update Phase</h3>
        </div>
        <form action="" method="post">
          <div class="modal-body">
            <div class="descriptions">
              <div class="form-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                     <label class="control-label">Product Name</label> <span id="x" style="color:red"> *</span>
                      <input type="text" id="username" class="form-control" name="name" required><span id="message"></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                     <label class="control-label">Design</label> <span id="x" style="color:red"> *</span>
                      <input type="text" id="username" class="form-control" name="name" required><span id="message"></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                     <label class="control-label">Phases:</label> <span id="x" style="color:red"> *</span>
                      <div class="row">
                     <input type="checkbox" name="chk_group" value="value1" /> Carpentry<br />
                     <input type="checkbox" name="chk_group" value="value2" /> Carving<br />
                     <input type="checkbox" name="chk_group" value="value3" /> Filling<br />
                     <input type="checkbox" name="chk_group" value="value3" /> Finishing<br />
                     <input type="checkbox" name="chk_group" value="value3" /> Upholstery
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
    <!-- Delete Job Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="deleteJobModal" aria-hidden="true" style="display: none;">
      <div class="modal-dialog">
        <div class="modal-content" id="delete">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 class="modal-title">Deactivate Production Phase</h3>
          </div>
          <div class="modal-body">
            <h4>Are you sure you want to deactivate this Production Phase?</h4>
          </div>
          <div class="modal-footer">
            <a href="delete-job.php?id=<?php echo $jsID;?>" type="button" role="button" class="btn btn-danger waves-effect text-left">Confirm</a>
            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>
  </body>
  </html>