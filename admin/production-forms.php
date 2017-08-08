<?php
include "menu.php";
include 'dbconnect.php';
session_start();


if(isset($_GET['id'])){
 $jsID = $_GET['id']; 
}

if(isset($_GET['smth'])){
$pr = $_GET['smth'];
}

if(isset($_GET['oID'])){
$oID = $_GET['oID'];
}

$jsID = $_GET['id']; 
$oID = $_GET['oID'];
$pr = $_GET['smth'];


$_SESSION['varname'] = $jsID;
$conn = mysqli_connect($servername, $username, $password, $dbname);

?>
<!DOCTYPE>
<html>
<head>
</head>
<body>

<!-- New Production Tracking Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="newProductionTrackingModal" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="new">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title" id="modalProduct">New Production Tracking</h3>
      </div>
      <form action="" method = "post">
        <div class="modal-body">
          <div class="descriptions">

            <div class="form-body">

              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label">Category</label><span id="x" style="color:red"> *</span>
                    <select class="form-control" data-placeholder="Choose a Category" tabindex="1" name="cat">
                      <option value="0">Choose Category</option>
                      <?php
                      $sql = "SELECT * FROM tblfurn_category order by categoryName;";
                      $result = mysqli_query($conn, $sql);
                      while ($row = mysqli_fetch_assoc($result))
                      {
                        if($row['categoryStatus']=='Listed'){
                          echo('<option value='.$row['categoryID'].'>'.$row['categoryName'].'</option>');
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label class="control-label">Type</label><span id="x" style="color:red"> *</span>
                    <select class="form-control" data-placeholder="Choose a Category" tabindex="1" name="_category">
                      <?php
                      $sql = "SELECT * FROM tblfurn_type order by typeNames;";
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

                <div class="col-md-5">
                  <div class="form-group">
                    <label class="control-label">Furniture Name</label><span id="x" style="color:red"> *</span>
                    <select class="form-control" tabindex="1" name="material">
                      <?php
                      include "dbconnect.php";
        // Create connection
                      $conn = mysqli_connect($servername, $username, $password, $dbname);
        // Check connection
                      if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                      }
                      $sql = "SELECT * FROM tblproduct;";
                      $result = mysqli_query($conn, $sql);
                      while ($row = mysqli_fetch_assoc($result))
                      {
                        if($row['prodStat']!='Archived'){
                          echo('<option value='.$row['productID'].'>'.$row['productName'].'</option>');
                        }
                      }
                      ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div role="tabpanel" class="tab-pane fade active in" id="job">
                  <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                      <div class="row">
                        <div class="table-responsive">
                          <table class="table display nowrap" id="tblProducts">
                            <thead>
                              <tr>
                                <th style="text-align: left;">Category</th>
                                <th style="text-align: left;">Type</th>
                                <th style="text-align: left;">Name</th>
                                <th style="text-align: left;">Quantity</th>
                                <th style="text-align: left;">Remarks</th>
                                <th style="text-align: left;">Actions</th>                          
                              </thead>
                              <tbody  id="tb_row" style="text-align: left;">
                              <tr>
                                <td>
                                  
                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>
                                  <button id="addBtn" type="button" class="btn btn-success">+</button>
                                  <button id="removeBtn" type="button" class="btn btn-danger">X</button>
                                </td>
                              </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
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

 <!-- Update Mode of Payment Modal -->
 <div class="modal fade" tabindex="-1" role="dialog" id="updateModeofPaymentModal" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="update">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title" id="modalProduct">Update Production Record <?php echo $jsID ?></h3>
      </div>
      <form action="save-prod.php" method="post">
        <div class="modal-body">
          <div class="descriptions">
            <div class="form-body">
              <input type="hidden" name="recID" value="<?php echo $jsID?>">
              <input type="hidden" name="orID" value="<?php echo $oID?>">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="control-label">Phase</label>
                    <select class="form-control" data-placeholder="Choose a Fabric" tabindex="1" name="phase">
                      <option value="--">-- Choose Phase --</option>
                      <option value="Carpentry">Carpentry</option>
                      <option value="Carving">Carving</option>
                      <option value="Filling">Filling</option>
                      <option value="Upholstery">Upholstery</option>
                      <option value="Finishing">Finishing</option>
                    </select>
                  </div>
                </div>
              </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">Employee Handler</label>
                  <select class="form-control" data-placeholder="Choose a Fabric" tabindex="1" name="emp">
                    <option value="--">-- Choose Employee --</option>
                    <?php
                    include "dbconnect.php";
                    $sql = "SELECT * FROM tblemployee";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result))
                    {
                      if($row['empStatus']=='Active'){
                        echo('<option value='.$row['empID'].'>'.$row['empFirstName'].$row['empMidName']. $row['empLastName'].'</option>');
                      }
                    }
                    ?>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">Status</label>
                  <select class="form-control" data-placeholder="Choose a Fabric" tabindex="1" name="stat">
                    <option value="--">-- Choose Status --</option>
                    <option value="Started">Started</option>
                    <option value="Finished">Finished</option>
                    <option value="Cancelled">Cancelled</option>
                  </select>
                </div>
              </div>
            </div>

              <div class="row">
              <label class="box-title">Remarks</label>
                <div class="col-md-12 ">
                  <div class="form-group">
                    <textarea class="form-control" rows="4" name="desc"></textarea>
                  </div>
                </div>
              </div>

            

            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success waves-effect text-left"><i class="fa fa-check"></i> Save</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        </div>
      </div>

    </form>
  </div>
</div>
<!-- /.modal -->
<!-- View -->
<div class="modal fade" tabindex="-1" role="dialog" id="deleteModeofPaymentModal" aria-hidden="true" style="display: none;">
  <div class="modal-dialog">
    <div class="modal-content" id="view">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title" id="modalProduct">Production History: <?php echo $jsID. $oID . $pr;?></h3>
      </div> 
      <div class="modal-body">
        <div class="row">
          <h3>Product Name:<?php echo $pr;?></h3>
        </div>
        <div class="row">
        <div class="table-responsive">
              <table class="table color-bordered-table muted-bordered-table">
                          <thead>
                            <tr>
                              <th style="text-align: center;">Phase</th>
                              <th style="text-align: center;">Handler</th>
                              <th style="text-align: center;">Date Start</th>
                              <th style="text-align: center;">Date End</th>
                              <th style="text-align: center;">Remarks</th>
                            </tr>
                          </thead>
                          <tbody style="text-align: center;">
                            <tr>
                              <?php
                              include "dbconnect.php";
                              $sql = "SELECT * FROM tblproduction a inner join tblorder_request b on b.order_requestID = a.productionOrderReq inner join tblorders c on c.orderID = b.tblOrdersID inner join tblproduct d on d.productID = b.orderProductID WHERE a.productionOrderReq = '$jsID'";
                              $result = mysqli_query($conn, $sql);
                              while ($row = mysqli_fetch_assoc($result))
                              {
                                  echo('<td>'. $row['prodPhase'] .'</td>
                                    <td>'.$row['productionEmp'].'</td>
                                    <td>'.$row['prodDateStart'].'</td>
                                    <td>'.$row['prodDateEnd'].'</td>
                                    <td>'.$row['productionRemarks'].'</td></tr>
                                    ');
                                }
                              ?>
                            </tr>
                        </tbody>
                      </table>
              </div>
        </div>
      <div class="modal-footer">
        <a href="delete-modeofpayment.php?id=<?php echo $jsID;?>" type="button" role="button" class="btn btn-danger waves-effect text-left">Confirm</a>
        <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>

<!-- New Production Tracking Modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="newProductionTrackingModal" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="history">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title" id="modalProduct">Production History</h3>
      </div>
      <form action="" method = "post">
        <div class="modal-body">
          <div class="descriptions">

            <div class="form-body">

              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label">Furniture Name: </label>
                  </div>
                </div>
              </div>

                      <div class="row">
                        <div class="table-responsive">
                          <table class="table display nowrap" id="tblProducts">
                            <thead>
                              <tr>
                                <th style="text-align: left;">Phase Name</th>
                                <th style="text-align: left;">Handler</th>
                                <th style="text-align: left;">Date Start</th>
                                <th style="text-align: left;">Date End</th>
                                <th style="text-align: left;">Remarks</th>
                              </thead>
                              <tbody  id="tb_row" style="text-align: left;">
                              <tr>
                                <td>
                                  
                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                                <td>

                                </td>
                              </tr>
                              </tbody>
                            </table>
                          </div>
                        </div>
              </div>

            </div>
          </div>            
        </form>
      </div>
    </div>

  </div>

</body>
</html>