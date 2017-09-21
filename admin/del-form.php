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
                ?>

                <div class="row">
                  <div class="col-md-12">
                    <h4><input type="checkbox" name="finPhase" id="finPhase" value="finish"/>
                      Finish Delivery?</h4>
                    </div>
                  </div>
                  <br>
                  <div id="updateDel">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="control-label">Delivery Address</label><span id="x" style="color:red"> *</span>
                          <textarea name="delAdd" class="form-control" id="delAdd" required><?php echo $add?></textarea>
                        </div>
                      </div>
                    </div>

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
                      <input type="date" id="dateFinish" name="dateFinish" class="form-control"/> 

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
          <h3 class="modal-title" id="modalProduct">Delivery History: <?php echo $jsID. $oID . $pr;?></h3>
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
                    <th style="text-align: center;">Order ID</th>
                    <th style="text-align: center;">Cutomer Name</th>
                    <th style="text-align: center;">Furniture Name</th>
                    <th style="text-align: center;">Date</th>
                    <th style="text-align: center;">Status</th>
                    <th style="text-align: center;">Remarks</th>
                  </tr>
                </thead>
                <tbody style="text-align: center;">
                  <tr>
                    <?php
                    include "dbconnect.php";
                    $sql = "SELECT * FROM tbldelivery a inner join tblorder_request b on b.order_requestID = a.deliveryOrdReq inner join tblorders c on c.orderID = b.tblOrdersID inner join tblproduct d on d.productID = b.orderProductID  inner join tblcustomer e on e.customerID = c.custOrderID";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result))
                    {
                      echo('<td>'. $row['orderID'] .'</td>
                        <td>'.$row['customerLastName'].', '.$row['customerFirstName'].'</td>
                        <td>'.$row['productName'].'</td>
                        <td>'.$row['dateOfRelease'].'</td>
                        <td>'.$row['deliveryStatus'].'</td>
                        <td>'.$row['deliveryRemarks'].'</td></tr>
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
                      <h4 style="text-align:center"> You can no longer edit the delivery information once you issue a delivery receipt and the delivery will proceed with the information available.</h4>
                      <h4 style="text-align:center"> Do you wish to continue?</h4>
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