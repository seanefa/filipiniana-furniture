<?php
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
  <!-- New Fabric Type Modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="newFabricTypeModal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content" id="new">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title" id="modalProduct">New Type</h3>
        </div>
        <form name="form1" action="add-fabric-type.php" method="post">
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
                          <label class="control-label">Texture</label><span id="x" style="color:red"> *</span>
                          <select class="form-control" tabindex="1" name="rem" required>
                      <option value="" selected disabled>Select Fabric Texture</option>
                            <?php
                            include "dbconnect.php";
                            $sql = "SELECT * FROM tblfabric_texture order by textureName;";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result))
                            {
                              if($row['textureStatus']=='Listed'){
                                echo('<option value='.$row['textureID'].'>'.$row['textureName'].'</option>');
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
                        <label class="control-label">Weaves</label>
                        <textarea id="fabrictypeWeaves" class="form-control" name="weaves"></textarea></div></div>
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
      </div>
      <!-- /.modal -->
      <!-- Update Fabric Type Modal -->
      <div class="modal fade" tabindex="-1" role="dialog" id="updateFabricTypeModal" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content" id="update">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h3 class="modal-title" id="modalProduct">Update Type</h3>
            </div>
            <form action="fabric-type-update.php" method="post">
              <div class="modal-body">
                <div class="descriptions">
                  <?php
                  $tsql = "SELECT * FROM tblfabric_type WHERE f_typeID = $jsID";
                  $tresult = mysqli_query($conn,$tsql);
                  if($tresult){
                  $trow = mysqli_fetch_assoc($tresult);
                  ?>

                  <div class="form-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="control-label">Name</label><span id="x" style="color:red"> *</span>
                          <input type="text" id="editname" class="form-control" name="name" value="<?php echo $trow['f_typeName']; $_SESSION['tempname'] = $trow['f_typeName'];?>" required/><span id="message"></span> </div>
                        </div>
                      </div>
                      
                        <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label class="control-label">Texture</label><span id="x" style="color:red"> *</span>
                              <select class="form-control" data-placeholder="Choose a Fabric" tabindex="1" id="select" name="texture" required>
                                <?php
                                include "dbconnect.php";
                                $sql = "SELECT * FROM tblfabric_texture;";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result))
                                {
                                  if($row['textureStatus']=='Listed'){
                                    echo('<option value='.$row['textureID'].' >'.$row['textureName'].'</option>');
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
                            <label class="control-label">Weaves</label>
                            <textarea id="remText" class="form-control" name="weaves"><?php echo $trow['f_typeWeaves'];?></textarea></div>
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
          <?php
          }
          ?>
          <!-- /.modal -->
          <!-- Delete Fabric Type Modal -->
          <div class="modal fade" tabindex="-1" role="dialog" id="deleteFabricTypeModal" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content" id="delete">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h3 class="modal-title">Deactivate Type</h3>
                </div>
                <div class="modal-body">
                  <h4>Are you sure you want to deactivate this type?</h4>
                </div>
                <div class="modal-footer">
                  <a href="delete-fabric-type.php?id=<?php echo $jsID;?>" type="button" role="button" class="btn btn-danger waves-effect text-left">Confirm</a>
                  <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Cancel</button>
                </div>
              </div>
            </div>
          </div>
        </body>
        </html>