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
?>
<!DOCTYPE>
<html>
<head>
</head>
<body>
  <!-- New -->
  <div class="modal fade" tabindex="-1" role="dialog" id="updateModeofPaymentModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" id="update">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title" id="modalProduct">Update Delivery Information</h3>
        </div>
        <form action="save-del.php" method="post">
          <input type="hidden" name="recID" value="<?php echo $jsID?>">
          <div class="modal-body">
            <div class="descriptions">
              <div class="form-body">
                <?php
                include "dbconnect.php";
                $sql = "SELECT * FROM tbldelivery WHERE deliveryID = '$jsID'";
                $res = mysqli_query($conn,$sql);
                $row = mysqli_fetch_assoc($res);
                $add = $row['deliveryAddress'];
                $rem = $row['deliveryRemarks'];
                $emp = $row['deliveryEmpAssigned'];
                $status = $row['deliveryStatus'];

                $date = new DateTime();
                $date = date_format($date, "Y-m-d");
                ?>

                <input type="hidden" id="stat" value="<?php echo $status?>">
                <div class="row" id="ch">
                  <div class="col-md-12">
                    <h4><input type="checkbox" name="finPhase" id="finPhase" value="finish"/>
                      Finish Delivery
                    </h4>
                  </div>
                </div>
                <br>
                <div id="updateDel">

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                      <label class="control-label">Date </label><span id="x" style="color:red"> *</span>
                      <input type="date" id="dateCh" name="dateCh" class="form-control" value="<?php echo $date;?>"/> 
                    </div> 
                    </div> 
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label">Delivery Status</label><span id="x" style="color:red"> *</span>
                        <select class="form-control" data-placeholder="Choose a Fabric" tabindex="1" name="status">
                          <?php
                          include "dbconnect.php";
                          $sql = "SELECT * FROM tbldelivery_status";
                          $result = mysqli_query($conn, $sql);
                          while ($row = mysqli_fetch_assoc($result))
                          {
                            echo('<option value='.$row['statusName'].'>'.$row['statusName'].'</option>');
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label">Delivery Address</label><span id="x" style="color:red"> *</span>
                        <textarea name="delAdd" class="form-control" id="delAdd" required><?php echo $add?></textarea>
                      </div>
                    </div>
                  </div>

                  <!-- <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label">Delivery Status</label><span id="x" style="color:red"> *</span>
                        <select class="form-control" data-placeholder="Choose a Fabric" tabindex="1" name="status">
                          <?php
                          include "dbconnect.php";
                          $sql = "SELECT * FROM tbldelivery_status";
                          $result = mysqli_query($conn, $sql);
                          while ($row = mysqli_fetch_assoc($result))
                          {
                            echo('<option value='.$row['statusName'].'>'.$row['statusName'].'</option>');
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div> -->

                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label">Delivery Man</label><span id="x" style="color:red"> *</span>
                        <select class="form-control" data-placeholder="Choose a Fabric" tabindex="1" name="emp">
                          <?php
                          include "dbconnect.php";
                          $sql = "SELECT * FROM tblemployee";
                          $result = mysqli_query($conn, $sql);
                          while ($row = mysqli_fetch_assoc($result))
                          {
                            if($row['empStatus']=='Active'){
                              if($emp==$row['empID']){
                                echo('<option value='.$row['empID'].' selected>'.$row['empFirstName'].' '.$row['empMidName'].' '.$row['empLastName'].'</option>');
                              }
                              else{
                                echo('<option value='.$row['empID'].'>'.$row['empFirstName'].' '.$row['empMidName'].' '.$row['empLastName'].'</option>');
                              }
                            }
                          }
                          ?>
                          <!-- <option value="0">None</option> -->
                        </select>
                      </div>
                    </div>
                  </div>

                 <!--  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label">Status</label>
                        <select class="form-control" data-placeholder="Choose a Fabric" tabindex="1" name="stat">
                          <option value="--">-- Choose Status --</option>
                          <option value="Ongoing">Start Delivery</option>
                          <option value="Cancelled">Cancelled</option>
                        </select>
                      </div>
                    </div>
                  </div> -->

                  <div class="row">
                    <div class="col-md-12 ">
                      <div class="form-group">
                        <label class="box-title">Remarks</label>
                        <textarea class="form-control" rows="4" name="rem"><?php echo $rem?></textarea>
                      </div>
                    </div>
                  </div>
                </div>

                <div id="finishDel">
                  <div class="row">
                    <div class="col-md-12">
                      <label class="control-label">Date Delivered: </label><span id="x" style="color:red"> *</span>
                      <input type="date" id="dateFinish" name="dateFinish" class="form-control" value="<?php echo $date;?>"/> 

                    </div> 
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-md-12 ">
                      <div class="form-group">
                        <label class="box-title">Remarks</label>
                        <textarea class="form-control" rows="4" name="rem"></textarea>
                      </div>
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


  <!-- View -->
  <div class="modal fade" tabindex="-1" role="dialog" id="deleteModeofPaymentModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content" id="view">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title" id="modalProduct">Delivery History</h3>
        </div> 
        <div class="modal-body">
          <div class="row">
          </div>
          <div class="row">
            <div class="table-responsive">
              <table class="table color-bordered-table muted-bordered-table">
                <thead>
                  <tr>
                    <th style="text-align: center;">Date</th>
                    <th style="text-align: center;">Employee</th>
                    <th style="text-align: center;">Remarks</th>
                    <th style="text-align: center;">Status</th>
                  </tr>
                </thead>
                <tbody style="text-align: center;">
                  <tr>
                    <?php
                    include "dbconnect.php";
                    $ctr = 0;
                    //$sql = "SELECT * FROM tbldelivery a inner join tblorder_request b on b.order_requestID = a.deliveryOrdReq inner join tblorders c on c.orderID = b.tblOrdersID inner join tblproduct d on d.productID = b.orderProductID  inner join tblcustomer e on e.customerID = c.custOrderID";
                    $sql = "SELECT * FROM tbldelivery_history a, tbldelivery b, tblemployee c WHERE a.delHist_recID = b.deliveryID and b.deliveryID = '$jsID' and a.delHistDeliveryMan = c.empID";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result))
                    {

                      $date = date_create($row['delHistDate']);
                      $date = date_format($date,"F d, Y");

                      echo('
                        <tr><td>'. $date .'</td>
                        <td>'.$row['empFirstName'].' '.$row['empLastName'].'</td>
                        <td>'.$row['delHistRemarks'].'</td>
                        <td>'.$row['delHistStatus'].'</td>
                        </tr>
                        ');
                      $ctr++;
                    }
                    if($ctr==0){
                      echo('<tr><td colspan="4">No available data</td></tr>');

                    }
                    ?>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>


    <div class="modal fade" tabindex="-1" role="dialog" id="updateModeofPaymentModal" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-lg">
        <div class="modal-content" id="delRec">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 class="modal-title" id="modalProduct">Issue Delivery Receipt</h3>
          </div>
          <form action="issue-del-rep.php" method="post">
            <input type="hidden" name="recID" value="<?php echo $jsID?>">
            <div class="modal-body">
              <div class="descriptions">
                <div class="form-body">
                  <?php
                  include "dbconnect.php";
                  $sql = "SELECT * FROM tbldelivery WHERE deliveryID = '$jsID'";
                  $res = mysqli_query($conn,$sql);
                  $row = mysqli_fetch_assoc($res);
                  $add = $row['deliveryAddress'];
                  $rem = $row['deliveryRemarks'];
                  $emp = $row['deliveryEmpAssigned'];
                  ?>

                  <div class="row">
                    <div class="col-md-12">
                      <h4 style="text-align:center"> Issueing a delivery receipt is done on the actual deivery day therefore the system will take today's date as the delivery date and the status for this delivery record will be 'Start Delivery'.</h4>
                      <h4 style="text-align:center"> Continue?</h4>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-success waves-effect text-left"><i class="fa fa-check"></i> Continue</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
          </div>

        </form>
      </div>
    </div>

  </body>
  </html>