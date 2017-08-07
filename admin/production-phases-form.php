<?php
include 'titleHeader.php';
include 'dbconnect.php';
session_start();
if(isset($_GET['id'])){
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
<body>
  <!-- New Production Phases Modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="newProductionPhasesModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" id="new">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title" id="modalProduct">New <?php echo $titlePage;?></h3>
        </div>
        <form name="form1" action="add-production-phases.php" method="post">
          <div class="modal-body">
            <div class="descriptions">
              <div class="form-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Name</label><span id="x" style="color:red"> *</span>
                      <input type="text" id="username" class="form-control" name="name" required/><span id="message"></span> </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label">Description</label>
                        <textarea class="form-control" rows="4" name="desc"></textarea></div>
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
      <!-- Update Production Phases Modal -->
      <div class="modal fade" tabindex="-1" role="dialog" id="updateProductionPhasesModal" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content" id="update">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h3 class="modal-title" id="modalProduct">Update <?php echo $titlePage;?></h3>
            </div>
            <form action="production-phases-update.php" method="post">
              <div class="modal-body">
                <div class="descriptions">
                  <?php
                  $tsql = "SELECT * FROM WHERE ID = $jsID";
                  $tresult = mysqli_query($conn,$tsql);
                  $trow = mysqli_fetch_assoc($tresult);
                  ?>

                  <div class="form-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="control-label">Name</label><span id="x" style="color:red"> *</span>
                          <input type="text" id="editname" class="form-control" name="name" value="<?php echo $trow['']; $_SESSION['tempname'] = $trow[''];?>" required/><span id="message"></span> </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="control-label">Description</label>
                            <textarea class="form-control" rows="4" name="desc" id="remText"><?php echo $trow[''];?></textarea></div>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="submit" class="btn btn-success waves-effect text-left" id="updateBtn" disabled=""><i class="fa fa-check"></i> Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- /.modal -->
          <!-- Delete Production Phases Modal -->
          <div class="modal fade" tabindex="-1" role="dialog" id="deleteProductionPhasesModal" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content" id="delete">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h3 class="modal-title">Deactivate <?php echo $titlePage;?></h3>
                </div>
                <div class="modal-body">
                  <h4>Are you sure you want to deactivate this <?php echo $titlePage;?>?</h4>
                </div>
                <div class="modal-footer">
                  <a href="delete-production-phases.php?id=<?php echo $jsID;?>" type="button" role="button" class="btn btn-danger waves-effect text-left">Confirm</a>
                  <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </body>