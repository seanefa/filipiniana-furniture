<?php
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
  <!-- New Fabrict Texture Modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="newFabrictTextureModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" id="new">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title" id="modalProduct">New Texture</h3>
        </div>
        <form name="form1" action="add-fab-text.php" method="post">
          <div class="modal-body">
            <div class="descriptions">
              <div class="form-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Name</label><span id="x" style="color:red"> *</span>
                      <input type="text" id="fabricTextureName" class="form-control" name="name" required/><span id="fabricTextureNameValidate"></span> </div>
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
                <button type="submit" class="btn btn-success waves-effect text-left" id="saveBtn" disabled=""><i class="fa fa-check"></i> Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- /.modal -->
      <!-- Update Fabrict Texture Modal -->
      <div class="modal fade" tabindex="-1" role="dialog" id="updateFabrictTextureModal" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content" id="update">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h3 class="modal-title" id="modalProduct">Update Texture</h3>
            </div>
            <form action="fab-text-update.php" method="post">
              <div class="modal-body">
                <div class="descriptions">
                  <?php
                  $tsql = "SELECT * FROM tblfabric_texture WHERE textureID = $jsID";
                  $tresult = mysqli_query($conn,$tsql);
                  $trow = mysqli_fetch_assoc($tresult);
                  ?>

                  <div class="form-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="control-label">Name</label><span id="x" style="color:red"> *</span>
                          <input type="text" id="editname" class="form-control" name="name" value="<?php echo $trow['textureName']; $_SESSION['tempname'] = $trow['textureName'];?>" required/><span id="message"></span> </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="control-label">Description</label>
                            <textarea class="form-control" rows="4" name="desc" id="remText"><?php echo $trow['textureDescription'];?></textarea></div>
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
          <!-- Delete Fabrict Texture Modal -->
          <div class="modal fade" tabindex="-1" role="dialog" id="deleteFabrictTextureModal" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content" id="delete">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h3 class="modal-title">Deactivate Texture</h3>
                </div>
                <div class="modal-body">
                  <h4>Are you sure you want to deactivate this Texture?</h4>
                </div>
                <div class="modal-footer">
                  <a href="delete-fab-text.php?id=<?php echo $jsID;?>" type="button" role="button" class="btn btn-danger waves-effect text-left">Confirm</a>
                  <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </body>