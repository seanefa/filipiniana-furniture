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
    <!-- View OR Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="viewORModal" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-lg">
        <div class="modal-content" id="viewOR">
          <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3>Package Information</h3>
          </div>
          <div class="modal-body">
            <div class="descriptions">
              <div class="form-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label">Name</label>
                      <input type="text" id="firstName" class="form-control" placeholder="Fabulous Package" name="pName" value="" disabled/> 
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label class="control-label">Price</label>
                      <input id="firstName" class="form-control" placeholder="0.00" name="pPrice" value="" disabled/> 
                    </div>
                  </div>
                </div>
              </div>

                <div class="form-body">
                  <div class="row">
                    <div class="form-group">
                      <table class="table color-bordered-table muted-bordered-table" id="tblCategories">
                        <thead>
                          <th style="text-align: center;">Furniture Type</th>
                          <th style="text-align: center;">Product Name</th>
                          <th style="text-align: center;">Product Price</th>
                        </thead>
                        <tbody style="text-align: center;">
                          <tr>
                            <?php
                            
                            ?>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

            </div>
          </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Close</button>
            </div>
          </div>

      </div>
    </div>
    <!-- /.modal -->
    <!-- Accept OR Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="acceptORModal" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-lg">
        <div class="modal-content" id="acceptOR">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 class="modal-title" id="modalProduct">Accept Order Request</h3>
          </div>
          <form action="job-update.php" method="post">
            <div class="modal-body">
              <div class="descriptions">
                <div class="form-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                       

                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                       

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </form>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success waves-effect text-left" id="updateBtn" disabled=""><i class="fa fa-check"></i> Save</button>
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
            </div>
          </div>

      </div>
    </div>
    <!-- /.modal -->
  </body>
  </html>