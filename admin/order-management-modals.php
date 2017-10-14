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
<!DOCTYPE>
<html>
<head>
</head>
<body>
  <div class="modal fade" tabindex="-1" role="dialog" id="newCategoryModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" id="orderReqview">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title" id="modalProduct" style="text-align:center;">ORDER ID: <?php echo $orderID = str_pad($jsID, 6, '0', STR_PAD_LEFT);?></h3>
        </div>
        <?php
        $sql = "SELECT * FROM tblcustomer a, tblorders b WHERE a.customerID = b.custOrderID and b.orderID = '$jsID'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        ?>
        <div class="modal-body">
          <div class="descriptions">

            <div class="row">
              <div class="col-md-12" style="text-align:left;">
                <h3><label class="control-label">Customer Information</label></h3>
                <h5><p><b>Name: </b><?php echo $row['customerLastName'].','.$row['customerFirstName'].'  '.$row['customerMiddleName']?></p>
                  <p><b>Address: </b><?php echo $row['customerAddress']?></p>
                  <p><b>Contact Number: </b><?php echo $row['customerContactNum']?></p>
                  <p><b>Email Address: </b><?php echo $row['customerEmail']?></p>
                  <p><b>Remarks: </b><?php echo $row['orderRemarks']?></p>
                </h5>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <div class="table-responsive">
                      <h3><label class="control-label" style="text-align:left;">Orders</label></h3>
                      <table class="table product-overview" id="cartTbl">
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
                          ?>
                        </tbody>
                        <tfoot style="text-align:right;">
                          <td></td>
                          <td colspan="2" style="text-align:right;"><b> GRAND TOTAL</b></td>
                          <td id="totalQ" style="text-align:right;"><?php echo $tQuan?></td>
                          <td id="totalPrice" style="text-align:right;"><?php echo "&#8369; ". number_format($tPrice,2)?></td>
                        </tfoot>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" tabindex="-1" role="dialog" id="newCategoryModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" id="orderReqaccept">

        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title" id="modalProduct" style="text-align:center;">Accept Order</h3>
        </div>

        <?php
        $sql = "SELECT * FROM tblcustomer a, tblorders b WHERE a.customerID = b.custOrderID and b.orderID = '$jsID'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);
        ?>

        <form action="accept-orderReq.php" method="post">
          <div class="modal-body">
            <div class="descriptions">
              <h3>ORDER ID: <?php echo $orderID = str_pad($jsID, 6, '0', STR_PAD_LEFT);?></h3>
              <input type="hidden" name="id" value="<?php echo $jsID;?>"/>

              <div class="row">
                <div class="col-md-12">
                  <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                      <div class="table-responsive">
                        <h3><label class="control-label" style="text-align:left;">Orders</label></h3>
                        <table class="table product-overview" id="cartTbl">
                          <thead>
                            <th style="text-align:center">Furniture Name</th>
                            <th style="text-align:center">Furniture Description</th>
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
                            ?>
                          </tbody>
                          <tfoot style="text-align:right;">
                            <td></td>
                            <td colspan="2" style="text-align:right;"><b> GRAND TOTAL</b></td>
                            <td id="totalQ" style="text-align:right;"><?php echo $tQuan?></td>
                            <td id="totalPrice" style="text-align:right;"><?php echo "&#8369; ". number_format($tPrice,2)?></td>
                          </tfoot>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">

                <div class="col-md-8">
                  <div class="form-group">
                    <label class="control-label">Order Remarks</label>
                    <textarea name="orderremarks" id="orderremarks" class="form-control"></textarea>
                  </div>
                </div>

                <div class="col-md-4">
                  <div class="form-group">
                    <label class="control-label">Pick up/Delivery Date</label>
                    <input type="date" id="pdate" class="form-control" name="pidate" required/> 
                  </div>
                </div>

              </div>

              <div class="row">
                <div class="col-md-12">
                  <p>Note: The customer will recieve an Email and a message on his account containing all his order information and billing for the said order as well as the bank account information on where he can pay his bills.</p>
                </div>
              </div>

            </div>
          </div>

          <div class="modal-footer">
            <button type="submit" role="button" class="btn btn-danger waves-effect text-left">Accept Order</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </form>
        </div>

      </div>
    </div>
  </div>

  <div class="modal fade" tabindex="-1" role="dialog" id="deleteFrameworkMaterialModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content" id="orderReqreject">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title">Reject Order Request</h3>
        </div>
        <form action="reject-orderReq.php" method="post">
          <input type="hidden" name="id" value="<?php echo $jsID?>">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <h4>Any reason?</h4>
                <textarea class="form-control" name="reason"></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <div class="row">
              <button type="submit" role="button" class="btn btn-danger waves-effect text-left">Reject</button>
              <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Cancel</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" tabindex="-1" role="dialog" id="updateCategoryModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" id="custReqAccept">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title" id="modalProduct">Accept Order</h3>
        </div>
        <form action="category-update.php" method="post">
          <h3><label style="text-align:left">ORDER ID: <?php echo $orderID = str_pad($jsID, 6, '0', STR_PAD_LEFT);?></label></h3>
          <div class="modal-body">
            <div class="descriptions">
              <?php
              $tsql = "SELECT * FROM tblfurn_category WHERE categoryID = $jsID";
              $tresult = mysqli_query($conn,$tsql);
              $trow = mysqli_fetch_assoc($tresult);
              ?>

              <div class="form-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label class="control-label">Name</label><span id="x" style="color:red"> *</span>
                      <input type="text" id="editname" class="form-control" placeholder="Name" name="name" value="<?php echo $trow['categoryName']; $_SESSION['tempname'] = $trow['categoryName'];?>" required><span id="message"></span>
                    </div>
                  </div>
                </div>

                <label class="box-title">Remarks</label>
                <div class="row">
                  <div class="col-md-12 ">
                    <div class="form-group">
                      <textarea class="form-control" rows="4" name="remarks"><?php echo $trow['categoryRemarks'];?></textarea>
                    </div>
                  </div>
                </div>

              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success waves-effect text-left" id="updateBtn" disabled=""><i class="fa fa-check"></i> Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
          </div>
        </div>

      </form>
    </div>
  </div>

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
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" tabindex="-1" role="dialog" id="deleteFrameworkMaterialModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content" id="orderUpdate">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title">Update Order</h3>
        </div>
        <form action="reject-orderReq.php" method="post">
          <input type="hidden" name="id" value="<?php echo $jsID?>">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-6">
                <p class="fcbtn btn-sm btn-outline btn-info btn-1d" style="text-align: center; font-family: inherit; font-weight: bolder; font-size: 20px;">
                  <a href="shop.php?id=<?php echo $jsID;?>" style="color: inherit;">ADD PRODUCTS TO ORDER?</a>
                </p>
              </div>
              <div class="col-md-6" style="border-left: 1px solid black;">
                <p class="fcbtn btn-sm btn-outline btn-info btn-1d" style="text-align: center; font-family: inherit; font-weight: bolder; font-size: 20px;">
                  <a href="update-order.php?id=<?php echo $jsID;?>" style="color: inherit;">UPDATE ORDER INFORMATION?</a>
                </p>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" tabindex="-1" role="dialog" id="newCategoryModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content" id="payment">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title" id="modalProduct">Payment</h3>
        </div>
        <form action="payments.php" method="post">
          <input type="hidden" name="orderID" value="<?php echo $jsID;?>"/>
          <div class="modal-body">
            <div class="descriptions">
              <div class="row">
                <div class="col-md-12">
                  <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                      <div class="row">
                        <div class="table-responsive">
                          <p style="text-align:center; font-family: inherit; font-weight: bolder; font-size: 20px;"><label class="control-label">Orders</label></p>
                          <table class="table product-overview" id="cartTbl">
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
                              ?>
                            </tbody>
                            <tfoot style="text-align:right;">
                              <td></td>
                              <td colspan="2" style="text-align:right;"><b> GRAND TOTAL</b></td>
                              <td id="totalQ" style="text-align:right;"><?php echo $tQuan?></td>
                              <td id="totalPrice" style="text-align:right;"><?php echo "&#8369; ". number_format($tPrice,2)?></td>
                            </tfoot>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <?php
              $down = 0;
              $bal = 0;
              $sql = "SELECT * FROM tblinvoicedetails a, tblpayment_details b, tblorders c WHERE c.orderID = a.invorderID and a.invoiceID = b.invID and c.orderID = '$jsID  '";
              $res = mysqli_query($conn,$sql);
              $tpay = 0;
              while($trow = mysqli_fetch_assoc($res)){
                $tpay = $tpay + $trow['amountPaid'];
              }
              $down = $tpay;
              $bal = $tPrice - $down;
              ?>

              
              <div class="row">
                <div class="col-md-6">
                  <div class="row">
                    <h3 style="text-align:center;"><label class="form-control" style="border:0px;">Payment Information</label></h3>
                    <div class="table" style="padding-right: 15px;">
                      <table class="table color-bordered-table">
                        <tr>
                          <td>Total Amount Due:</td>
                          <td>Php <?php echo number_format($tPrice,2)?></td>
                        </tr>
                        <tr>
                          <td>Initial Payment:</td>
                          <td>Php <?php echo number_format($down,2)?></td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div> 
                <div class="col-md-6">
                  <div class="row">
                    <h3 style="text-align:center;"><label class="form-control" style="border:0px;">Payment</label></h3>
                    <div class="table" style="padding-left: 15px;">
                      <table class="table color-bordered-table">
                        <tr>
                          <td>Remaining Balance:</td>
                          <td>Php <?php echo number_format($bal,2)?></td>
                        </tr>
                        <tr>
                          <td>Amount Paid</td>
                          <td>Php <input type="number" id="amount" name="amount" style="text-align:right"/></td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-success waves-effect text-left"><i class="fa fa-check"></i> Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>


  <div class="modal fade" tabindex="-1" role="dialog" id="deleteFrameworkMaterialModal" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content" id="cancelOrder">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h3 class="modal-title">Cancel Order</h3>
        </div>
        <form action="order-cancel.php" method="post">
          <?php
          include "dbconnect.php";
          $status = "";
          $sql = "SELECT * FROM tblorders WHERE orderID = $jsID";
          if($result = mysqli_query($conn,$sql)){
            while($row = mysqli_fetch_assoc($result)){
              $status = $row['orderStatus'];
            }
          }
          $overDue = isOverDue($jsID);
          if($overDue){
            $status = "";
          }
          ?>
          <input type="hidden" name="id" value="<?php echo $jsID?>">
          <input type="hidden" name="status" id="status" value="<?php echo $status?>">
          <div class="modal-body">
            <div class="row" id="penaltyForm">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label">Cancellation Fee </label><span id="x" style="color:red"> *</span>
                  <input type="number" class="form-control" name="penFee" value="0" style="text-align: right"/>
                </div>
                 <h5 style="color: red">
                  ** This order record is already undergoing production and cancelling an order requires a fee.
                </h5>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-12">
              <h4>Any reasons?</h4>
              <textarea class="form-control" name="reason"></textarea>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
             <h5 style="color: green">Note: The production of the ordered furniture will continue, however you can still stop the production on the Production Tracking Tab. The downpayment will be given back to the customer deducting the storage fee once the furniture is sold</h5></div>
           </div>
         </div>
         <div class="modal-footer">
          <button type="submit" role="button" class="btn btn-danger waves-effect text-left"><i class='ti-check'></i> Cancel Order</button>
          <button type="button" class="btn btn-default waves-effect text-left" data-dismiss="modal"><i class='ti-close'></i> Cancel</button>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="newCategoryModal" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="viewCustRequest">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title" id="modalProduct" style="text-align:center;"></h3>
      </div>

      <div class="modal-body">
        <div class="descriptions">

          <p>asdas</p>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="newCategoryModal" aria-hidden="true" style="display: none;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="acceptCustRequest">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 class="modal-title" id="modalProduct" style="text-align:center;"></h3>
      </div>

      <div class="modal-body">
        <div class="descriptions">

          <p>asdas</p>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php 

function isOverDue($id){
  include "dbconnect.php";
  $sql = "SELECT * FROM tblorders WHERE orderID = $id";
  $res = mysqli_query($conn,$sql);
  while($row = mysqli_fetch_assoc($res)){
    $dateRel = $row['dateOfRelease'];
    $over = date('Y-m-d',strtotime($dateRel."+ 40 days"));
    $date = new DateTime();
    $dateToday = date_format($date, "Y-m-d");
    if($dateToday > $over){
      $date = date_create($row['dateOfRelease']);
      $dates = date_format($date,"F d, Y");
      $endTimeStamp = strtotime($dateToday);
      $startTimeStamp = strtotime($dateRel);
      $timeDiff = abs($endTimeStamp - $startTimeStamp);
      $numberDays = $timeDiff/86400; 
      $numberDays = intval($numberDays);
        //echo '5';
      return true;
    }
    else{
        //echo '6';
      return false;
    }
  }
}
?>

</body>
</html>