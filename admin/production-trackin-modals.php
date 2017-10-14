<?php
session_start();
include "menu.php";
include 'dbconnect.php';
if(isset($_GET['id'])){
  $jsID = $_GET['id']; 
}
$jsID=$_GET['id'];

$_SESSION['varname'] = $jsID;
?>

<div class="modal fade" tabindex="-1" role="dialog" id="newCategoryModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" id="viewInfo">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title" id="modalProduct" style="text-align:center;">ORDER ID: <?php echo $orderID = str_pad($jsID, 6, '0', STR_PAD_LEFT);?></h3>
        </div>
        <div class="modal-body">
          <div class="descriptions">

            <div class="row">
              <div class="col-md-6">
                <h3 style="text-align:center;"><label class="control-label">Customer Information</label></h3>
                <?php
                $sql = "SELECT * FROM tblcustomer a, tblorders b WHERE a.customerID = b.custOrderID and b.orderID = '$jsID'";
                $result = mysqli_query($conn,$sql);
                $row = mysqli_fetch_assoc($result);
                $orderPrice = $row['orderPrice'];
                ?>
                <h5>
                  <table class="table table-bordered table-hover">
                    <tr>
                      <td><b>Name</b></td>
                      <td><?php echo $row['customerFirstName'].' '.$row['customerMiddleName'].'  '.$row['customerLastName'];?></td>
                    </tr>
                    <tr>
                      <td><b>Address</b></td>
                      <td><?php echo $row['customerAddress'];?></td>
                    </tr>
                    <tr>
                      <td><b>Contact Number</b></td>
                      <td><?php echo $row['customerContactNum'];?></td>
                    </tr>
                    <tr>
                      <td><b>Email Address</b></td>
                      <td><?php echo $row['customerEmail'];?></td>
                    </tr>
                  </table>
                </h5>
              </div>

              <div class="col-md-6">
                <h3 style="text-align:center;"> <label class="control-label">Payment History</label></h3>
                <table class="table table-bordered table-hover">
                  <thead>
                    <th style="text-align:left"><b>Date Paid</b></th>
                    <th style="text-align:left"><b>Mode of Payment</b></th>
                    <th style="text-align:right"><b>Amount Paid</b></th>
                  </thead>
                  <tbody>
                    <?php
                    $down = 0;
                    $bal = 0;
                    $sql = "SELECT * FROM tblinvoicedetails a, tblpayment_details b, tblorders c, tblmodeofpayment d WHERE c.orderID = a.invorderID and d.modeofpaymentID = b.mopID and a.invoiceID = b.invID and c.orderID = '$jsID'";
                    $res = mysqli_query($conn,$sql);
                    $tpay = 0;
                    while($trow = mysqli_fetch_assoc($res)){
                      $date = date_create($trow['dateCreated']);
                      $date = date_format($date,"F d, Y");
                      $tpay = $tpay + $trow['amountPaid'];
                      echo '<tr><td>'.$date.'</td>
                      <td>'.$trow['modeofpaymentDesc'].'</td>
                      <td style="text-align:right;">&#8369; '.number_format($trow['amountPaid'],2).'</td>
                      </tr>';
                    }
                    $down = $tpay;
                    $bal = $orderPrice - $down;
                    ?>
                    <tr>
                      <td colspan="2" style="text-align:right;"><i class="fa fa-caret-right text-info"></i><b> TOTAL AMOUNT PAID</b></td>
                      <td style="text-align:right;"><mark><strong><span>&#8369;&nbsp;<?php echo number_format($down,2)?></span></strong></mark></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <?php
              function getPayInfo(){
                echo '';
              }

              ?>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <div class="row">
                      <div class="table-responsive">
                        <h3 style="text-align:center;"><label class="control-label">Orders</label></h3>
                        <table class="table product-overview table-bordered table-hover" id="cartTbl">
                          <thead>
                            <th style="text-align:left">Furniture Name</th>
                            <th style="text-align:left">Furniture Description</th>
                            <th style="text-align:right;">Unit Price</th>
                            <th style="text-align:right;">Quantity</th>
                            <th style="text-align:right;">Total Price</th>
                          </thead>
                          <tbody>
                            <?php
                            include "dbconnect.php";
                            $tQuan = 0;
                            $tPrice = 0;
                            $sql1 = "SELECT * FROM tblorder_request a, tblorders b, tblproduct c WHERE c.productID = a.orderProductID and b.orderID = a.tblOrdersID and b.orderID = '$jsID'";
                            $res = mysqli_query($conn,$sql1);
                            while($row = mysqli_fetch_assoc($res)){
                              echo '<tr>
                              <td>'.$row['productName'].'</td>
                              <td>'.$row['productDescription'].'</td>
                              <td style="text-align:right;">&#8369; '.number_format($row['prodUnitPrice'],2).'</td>
                              <td style="text-align:right;">'.$row['orderQuantity'].'</td>';
                              $tPrice = $row['orderQuantity'] * $row['prodUnitPrice'];
                              $tPrice =  number_format($tPrice,2);
                              echo '<td style="text-align:right;">&#8369; '.$tPrice.'</td></tr>';
                              $tPrice = $row['orderPrice'];
                              $tQuan = $tQuan + $row['orderQuantity'];
                            }

                            // $sql1 = "SELECT * FROM tblorder_request a, tblorders b, tblpackages c WHERE c.packageID = a.orderPackageID and b.orderID = a.tblOrdersID and b.orderID = '$jsID'";
                            // $res = mysqli_query($conn,$sql1);
                            // while($row = mysqli_fetch_assoc($res)){
                            //   echo '<tr>
                            //   <td>'.$row['packageDescription'].'</td>
                            //   <td></td>
                            //   <td style="text-align:right;">&#8369; '.number_format($row['packagePrice'],2).'</td>
                            //   <td style="text-align:right;">'.$row['orderQuantity'].'</td>';
                            //   $tPrice = $row['orderQuantity'] * $row['packagePrice'];
                            //   $tPrice =  number_format($tPrice,2);
                            //   echo '<td style="text-align:right;">&#8369; '.$tPrice.'</td></tr>';
                            //   $tPrice = $row['orderPrice'];
                            //   $tQuan = $tQuan + $row['orderQuantity'];
                            // }

                            $sql1 = "SELECT * FROM tblorder_request a, tblorders b, tblpackages c WHERE c.packageID = a.orderPackageID and b.orderID = a.tblOrdersID and b.orderID = '$jsID'";
                            $res = mysqli_query($conn,$sql1);
                            while($row = mysqli_fetch_assoc($res)){
                              $orReqID = $row['order_requestID'];
                              echo '<tr>
                              <td>'.$row['packageDescription'].'</td>
                              <td>PACKAGE</td>
                              <td style="text-align:right;">Php  '.number_format($row['packagePrice'],2).'</td>
                              <td style="text-align:center">'.$row['orderQuantity'].'</td>';
                              $tPrice = $row['orderQuantity'] * $row['packagePrice'];
                              $tPrice =  number_format($tPrice,2);
                              echo '<td style="text-align:right;">Php  '.$tPrice.'</td></tr>';
                              $tPrice = $row['orderPrice'];
                              $orReqID = $row['order_requestID'];
                              $sql3 = "SELECT * FROM tblpackage_orderreq a, tblproduct b WHERE a.por_prID = b.productID and a.por_orReqID = '$orReqID'";
                              $res3 = mysqli_query($conn,$sql3);
                              while($row3 = mysqli_fetch_assoc($res3)){
                                echo '<tr>
                                <td style="text-align:right;"> - '.$row3['productName'].'</td>
                                <td>'.$row3['productDescription'].'</td>
                                <td style="text-align:right;"></td>';
                                $tQuan = $tQuan + $row['orderQuantity'] * 1;
                                echo '<td style="text-align:right">'.$row['orderQuantity'] * 1 .'</td>
                                <td style="text-align:right;"></td></tr>';

                              }
                            }

                            ?>
                          </tbody>
                          <tfoot style="text-align:right;">
                            <tr>
                              <td colspan="3" style="text-align:right;"><b> GRAND TOTAL</b></td>
                              <td id="totalQ" style="text-align:right;"><?php echo $tQuan?></td>
                              <td id="totalPrice" style="text-align:right;"><mark><strong><span>&#8369;&nbsp;<?php echo number_format($tPrice,2)?></span></strong></mark></td>
                            </tr>
                            <tr>
                              <td colspan="3" style="text-align:right;"><b> TOTAL AMOUNT PAID</b></td>
                              <td></td>
                              <td style="text-align:right;">&#8369;&nbsp;<?php echo number_format($down,2)?></td>
                            </tr>
                            <tr>
                              <td colspan="3" style="text-align:right;"><b> REMAINING BALANCE</b></td>
                              <td></td>
                              <td style="text-align:right; color:red;"><mark style="text-align:right; color:red;"><strong><span>&#8369;&nbsp;<?php echo number_format($bal,2)?></span></strong></mark></td>
                            </tr>
                          </tfoot>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
        <?php 
          if($down >= ($tPrice * .5)){
        echo '
        <div class="modal-footer">
          <a class="btn btn-success" href="production-start.php?id='.$jsID.'">Start Production</a><input type="hidden" id="idBtn" value="'.$row['orderID'].'"/>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        ';
        }else{
          echo '
        <div class="modal-footer">
          <span style="color: red; text-align: right;">This production cannot be started because it is not yet paid</span>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
        ';
        }
        ?>
      </div>
    </div>
  </div>