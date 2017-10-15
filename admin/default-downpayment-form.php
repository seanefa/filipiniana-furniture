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
    <div class="modal fade" tabindex="-1" role="dialog" id="updateJobModal" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-lg">
        <div class="modal-content" id="update">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 class="modal-title" id="modalProduct">Update Default Downpayment</h3>
          </div>
          <form action="default-downpayment-update.php" method="post">
            <div class="modal-body">
              <div class="descriptions">
                <div class="form-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <?php 
                        $tsql = "SELECT * FROM tbldownpayment;";
                        $tresult = mysqli_query($conn, $tsql);
                        $trow = mysqli_fetch_assoc($tresult);
                        $udp = $trow['downpaymentPercentage']*100;
                        ?>
                        <label class="control-label">Downpayment</label><span id="x" style="color:red"> *</span>
                        <input type="number" style="text-align:right;" id="editname" class="form-control" placeholder="50" name="name" value="<?php echo $udp; ?>"><span id="message"></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success waves-effect text-left" id="updateBtn"><i class="fa fa-check"></i> Save</button>
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </body>
  </html>