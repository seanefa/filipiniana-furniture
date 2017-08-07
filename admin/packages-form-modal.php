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
<!DOCTYPE html>
<html>
<head>
</head>
<body>
  <!-- New Framework Modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="newPackageModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg" >
      <div class="modal-content" id="add">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title" id="modalProduct">New Package</h3>
        </div>
        <div class="modal-body">
          <div class="descriptions">
            <form enctype="multipart/form-data" action="add-Package.php" method="post">
              <div class="form-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label">Name</label>
                      <input type="text" id="firstName" class="form-control" placeholder="Fabulous Package" name="pName" required/> 
                    </div>
                  </div>
                </div>
                <div class="row"><!--/span-->
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label">Price</label>
                      <input type="number" id="firstName" class="form-control" placeholder="0.00" name="pPrice" required/> 
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label">Inclusion</label>
                      <table class="table color-bordered-table muted-bordered-table" id="tblCategories">
                        <thead>
                          <th style="text-align: center;">Product Name</th>
                          <th style="text-align: center;">Product Price</th>
                          <th style="text-align: center;">Actions</th>
                        </thead>
                        <tbody style="text-align: center;">
                          <tr>
                            <?php
                            include 'checkbox_value.php';
                            ?>
                          </tr>
                          <script type="text/javascript">
                            function confirmDelete(id) {
                              window.location.href="delete-job.php?id="+id+"";
                            }
                            function edit(id){
                              window.location.href="update-job.php?id="+id+"";
                            }
                          </script>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <input type="submit" class="btn btn-success waves-effect text-left" value="Save">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>



  <!-- /.modal -->
</body>
</html>