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
          <h3 class="modal-title" id="modalProduct">Update Delivery </h3>
        </div>
        <form action="save-del.php" method="post">
          <div class="modal-body">
            <div class="descriptions">
              <div class="form-body">
                <!--div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Orders</label>
                      <select class="form-control" data-placeholder="Choose a Fabric" tabindex="1" name="order" id="order">
                        <?php
                        include "dbconnect.php";
                        $sql = "SELECT * FROM tblcustomer a, tblorders b WHERE a.customerID = b.custOrderID and b.orderID";
                        $result = mysqli_query($conn,$sql);
                        while ($row = mysqli_fetch_assoc($result))
                        {
                          if($row['orderStatus']!='Archived'){
                            $orderID = str_pad($row['orderID'], 6, '0', STR_PAD_LEFT);
                            $orderID = "OR" . $orderID;
                            echo('<option value='.$row['orderID'].'>'.$orderID.'  -  '.$row['customerLastName'].' '.$row['customerFirstName'].' '.$row['customerMiddleName'].'</option>');
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                </div-->

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Delivery Man</label>
                      <select class="form-control" data-placeholder="Choose a Fabric" tabindex="1" name="emp">
                        <?php
                        include "dbconnect.php";
                        $sql = "SELECT * FROM tblemployee";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result))
                        {
                          if($row['empStatus']=='Active'){
                            echo('<option value='.$row['empID'].'>'.$row['empFirstName'].' '.$row['empMidName'].' '.$row['empLastName'].'</option>');
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
                      <label class="control-label">Status</label>
                      <select class="form-control" data-placeholder="Choose a Fabric" tabindex="1" name="stat">
                        <option value="--">-- Choose Status --</option>
                        <option value="Ongoing">Start Delivery</option>
                        <option value="Delivered">Delivered</option>
                        <option value="Cancelled">Cancelled</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <label class="box-title">Remarks</label>
                  <div class="col-md-12 ">
                    <div class="form-group">
                      <textarea class="form-control" rows="4" name="rem"></textarea>
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
  </body>
  </html>