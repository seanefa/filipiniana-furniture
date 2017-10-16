<?php
include "menu.php";
include 'dbconnect.php';
session_start(); 
if(isset($GET['id'])){
  $jsID = $_GET['id']; 
}
$jsID=$_GET['id'];

$_SESSION['varid'] = $jsID;

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
  <div class="modal fade" tabindex="-1" role="dialog" id="restockRawMaterialModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" id="deduct">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title" id="modalProduct">Deduct Material</h3>
        </div>
        <form action="raw-materials-deduct.php" method="post">
          <div class="modal-body">
            <div class="descriptions">
              <div class="form-body">
                <?php
                include "dbconnect.php";
                $sql = "SELECT * FROM tblmat_inventory WHERE mat_inventoryID ='$jsID'";
                $res = mysqli_query($conn,$sql);
                $pRow = mysqli_fetch_assoc($res);
                $count = $pRow['matVarQuantity'];
                ?>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Quantity </label><span id="x" style="color:red"> *</span>
                      <input style="text-align:right;" type="number" id="quan" class="form-control" name="quan1">
                      <input type="hidden" id="quanOrig" style="text-align:right" value="<?php echo $count;?>">
                      <p id="quanError"></p>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Reason </label><span id="x" style="color:red"> *</span>
                      <textarea id="remarks" class="form-control" placeholder="Pull-Out" name="remarks" required rows="4"></textarea>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success waves-effect text-left" id="restockBtn"><i class="fa fa-check"></i> Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

</body>
</html>