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
  <!-- Restock Raw Materials -->
  <div class="modal fade" tabindex="-1" role="dialog" id="restockRawMaterialModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" id="restock">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title" id="modalProduct">Restock Material</h3>
        </div>
        <form action="raw-materials-restock.php" method="post">
          <div class="modal-body">
            <div class="descriptions">
              <div class="form-body">

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Supplier</label><span id="x" style="color:red"> *</span>
                      <select class="form-control" data-placeholder="Choose a Fabric" tabindex="1" name="supplier">
                        <?php
                        include "dbconnect.php";
                        $sql = "SELECT * FROM tblsupplier ORDER BY supCompName;";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result))
                        {
                          if($row['supStatus']=='Listed'){
                            echo('<option value='.$row['supplierID'].'>'.$row['supCompName'].'</option>');
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
                      <label class="control-label">Quantity(in pcs)</label><span id="x" style="color:red"> *</span>
                      <input type="text" id="remText" class="form-control" name="quantity">
                    </div>
                  </div>
                </div>


                  <!--<div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label">Pieces per box</label><span id="x" style="color:red"> *</span>
                        <input type="text" id="remText" class="form-control" name="pcs">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label">No. of boxes</label><span id="x" style="color:red"> *</span>
                        <input type="number" id="" class="form-control" name="box">
                      </div>
                    </div>
                  </div>-->

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
  <!-- /.modal -->

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

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Quantity(in pcs)</label><span id="x" style="color:red"> *</span>
                      <input type="text" id="remText" class="form-control" name="quantity">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Remarks</label><span id="x" style="color:red"> *</span>
                      <input type="text" id="remText" class="form-control" placeholder="Pull-Out" name="remarks">
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