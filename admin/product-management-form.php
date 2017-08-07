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
    <!-- New On-Hand Modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="newOnHandModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" id="newOnHand">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title" id="modalProduct">New On-Hand Product</h3>
        </div>
        <form action="product-on-hand.php" method="post">
          <div class="modal-body">
            <div class="descriptions">
              <div class="form-body">

                <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Category</label><span id="x" style="color:red"> *</span>
                      <select class="form-control" data-placeholder="Choose a Fabric" tabindex="1" name="cat">
                        <?php
                        include "dbconnect.php";
            // Create connection
                        $conn = mysqli_connect($servername, $username, $password, $dbname);
            // Check connection
                        if (!$conn) {
                          die("Connection failed: " . mysqli_connect_error());
                        }
                        $sql = "SELECT * FROM tblfurn_type;";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result))
                        {
                          if($row['typeStatus']=='Listed'){
                            echo('<option value='.$row['typeID'].'>'.$row['typeName'].'</option>');
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
                      <label class="control-label">Furniture Name</label><span id="x" style="color:red"> *</span>
                      <select class="form-control" data-placeholder="Choose a Fabric" tabindex="1" name="sfid">
                        <?php
                        include "dbconnect.php";
            // Create connection
                        $conn = mysqli_connect($servername, $username, $password, $dbname);
            // Check connection
                        if (!$conn) {
                          die("Connection failed: " . mysqli_connect_error());
                        }
                        $sql = "SELECT * FROM tblproduct";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result))
                        {
                          if($row['prodStat']=='Pre-Order'){
                            echo('<option value='.$row['productID'].'>'.$row['productName'].'</option>');
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
                      <label class="control-label">Quantity</label>
                      <input type="text" id="" class="form-control" name="quan">
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

    <!-- New On-Promo Modal -->
  <div class="modal fade" tabindex="-1" role="dialog" id="newOnPromoModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" id="newOnPromo">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title" id="modalProduct">New On-Promo Product</h3>
        </div>
        <form action="" method="post">
          <div class="modal-body">
            <div class="descriptions">
              <div class="form-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                     <label class="control-label">Name</label> <span id="x" style="color:red"> *</span>
                      <input type="text" id="" class="form-control" name="name" required><span id="message"></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Description</label>
                      <input type="text" id="" class="form-control" name="desc">
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



    <!-- Add On-Hand Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="addOnHandModal" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-lg">
        <div class="modal-content" id="addOnHand">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 class="modal-title" id="modalProduct">Add On-Hand Quantity</h3>
          </div>
          <form action="" method="post">
            <div class="modal-body">
              <div class="descriptions">
                <div class="form-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label">Quantity</label><span id="x" style="color:red"> *</span>
                        <input type="number" id="" class="form-control" name="box">
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success waves-effect text-left" id="addBtn"><i class="fa fa-check"></i> Save</button>
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
    <!-- /.modal -->

    <!-- Add On-Promo Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="addOnPromoModal" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-lg">
        <div class="modal-content" id="addOnPromo">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 class="modal-title" id="modalProduct">Add On-Promo Quantity</h3>
          </div>
          <form action="" method="post">
            <div class="modal-body">
              <div class="descriptions">
                <div class="form-body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label">Quantity</label><span id="x" style="color:red"> *</span>
                        <input type="number" id="" class="form-control" name="box">
                      </div>
                    </div>
                  </div>

                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success waves-effect text-left" id="addBtn"><i class="fa fa-check"></i> Save</button>
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
    <!-- /.modal -->

    <!-- Deduct On-Hand Modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="deductOnHandModal" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-lg">
        <div class="modal-content" id="deductOnHand">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 class="modal-title" id="modalProduct">Deduct On-Hand Quantity</h3>
          </div>
          <form action="" method="post">
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
              <button type="submit" class="btn btn-success waves-effect text-left" id="deductBtn"><i class="fa fa-check"></i> Save</button>
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
    <!-- /.modal -->

    <!-- Deduct On-Promo Modal -->
        <div class="modal fade" tabindex="-1" role="dialog" id="deductOnPromoModal" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-lg">
        <div class="modal-content" id="deductOnPromo">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 class="modal-title" id="modalProduct">Deduct On-Promo Quantity</h3>
          </div>
          <form action="" method="post">
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
              <button type="submit" class="btn btn-success waves-effect text-left" id="deductBtn"><i class="fa fa-check"></i> Save</button>
              <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
    <!-- /.modal -->


  </body>
  </html>