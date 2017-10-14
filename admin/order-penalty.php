<?php
$activePage = basename($_SERVER['PHP_SELF'],".php");
include "menu.php";
//session_start();

if(isset($_GET['id'])){
  $jsID = $_GET['id']; 
}
//$_SESSION['varname'] = 3;
include 'dbconnect.php';
?>
<!DOCTYPE html>  
<html lang="en">
<head>
 <script>
 $(document).ready(function(){
  $("#check").hide();
  $("#mop").on('change',function(){
    var val = $("#mop").val();
    if(val==1){
      $("#check").hide();
      $("#cash").show();
      $("#cNum").val("");
      $("#cAmount").val("");
    }
    else if(val==2){
      $("#cash").hide();
      $("#check").show();
      $("#aTendered").val("");
        //$("#dChange").val("0");
      }
    });
});

 $(document).ready(function(){
  $('#aTendered').on('keyup',function(){
    var mat = parseInt($("#aTendered").val());
    var bal = parseInt($("#balance").val());
    var ctr = 0;
    if(isNaN(mat)){
      ctr = 1;
    }
    else if(mat<0){
      ctr = 1;
    }
    else if(mat>bal){
      ctr = 1;
    }
    else if(mat==""){
      ctr = 0;
    }
    else{
      ctr = 0;
    }

    if(ctr==0){
      var e = "";
      var change = mat - bal;
      var change = change + ".00";
      $("#dChange").val(change);
      $("#error").html(e);
      $('#aTendered').css('border-color','gray');
      $('#saveBtn').prop('disabled',false);
    }
    else{
      var e = "Invalid input";
      $("#dChange").val(change);
      $("#error").html(e);
      $('#aTendered').css('border-color','red');
      $('#saveBtn').prop('disabled',true);

    }

        });
});

$(document).ready(function(){
  $('#cNum').on('keyup',function(){
    var mat = $("#cNum").val();
    if(isNaN(mat)){
      var e = "Please input a valid number.";
      $("#cNumError").html(e);
      $('#cNum').css('border-color','red');
      $('#saveBtn').prop('disabled',true);
    }
    else if(mat<0){
      var e = "Numbers less than 0 are not allowed";
      $("#cNumError").html(e);
      $('#cNum').css('border-color','red');
      $('#saveBtn').prop('disabled',true);
    }
    else{
      var e = "";
      $("#cNumError").html(e);
      $('#cNum').css('border-color','gray');
      $('#saveBtn').prop('disabled',false);
    }

  });
});

$(document).ready(function(){
  $('#cAmount').on('keyup',function(){
    var mat = $("#cAmount").val();
    if(isNaN(mat)){
      var e = "Please input a valid number.";
      $("#cAmountError").html(e);
      $('#cAmount').css('border-color','red');
      $('#saveBtn').prop('disabled',true);
    }
    else if(mat<0){
      var e = "Numbers less than 0 are not allowed";
      $("#cAmountError").html(e);
      $('#cAmount').css('border-color','red');
      $('#saveBtn').prop('disabled',true);
    }
    else{
      var e = "";
      $("#cAmountError").html(e);
      $('#cAmount').css('border-color','gray');
      $('#saveBtn').prop('disabled',false);
    }

  });
});

</script>
<title>Order Payment</title>
<link rel="icon" type="image/x-icon" sizes="16x16" href="plugins/images/favicon.ico">
</head>
<body class ="fix-header fix-sidebar">
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="panel panel-info">
            <h3>
              <ul class="nav customtab2 nav-tabs" role="tablist">
                <li role="presentation" class="active">
                  <a aria-controls="proorders" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"><i class="ti-receipt"></i> Order Payment</span></a>
                </li>
              </ul>
            </h3>
            <div class="tab-content">
              <!-- CATEGORY -->
              <div role="tabpanel" class="tab-pane fade active in">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <form action="save-order-penalty.php" method = "post">
                      <input type="hidden" name="orderID" id="orderID" value="<?php echo $jsID?>">

                      <div class="row" style="margin-top: -30px;">
                        <div class="col-md-8">
                          <h2 style="font-family: inherit; font-weight: bolder;">ORDERS</h2>
                          <div class="table-responsive">
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

                                $sql1 = "SELECT * FROM tblorder_request a, tblorders b, tblproduct c, tblinvoicedetails d WHERE c.productID = a.orderProductID and b.orderID = a.tblOrdersID and b.orderID = '$jsID' and d.invorderID = b.orderID";
                                $res = mysqli_query($conn,$sql1);
                                $delFee = 0;
                                $penFee = 0;
                                $status = "";
                                while($row = mysqli_fetch_assoc($res)){
                                  echo '<tr>
                                  <td>'.$row['productName'].'</td>
                                  <td>'.$row['productDescription'].'</td>
                                  <td style="text-align:right;">&#8369; '.number_format($row['productPrice'],2).'</td>
                                  <td style="text-align:right;">'.$row['orderQuantity'].'</td>';
                                  $tPrice = $row['orderQuantity'] * $row['productPrice'];
                                  $tPrice =  number_format($tPrice,2);
                                  echo '<td style="text-align:right;">&#8369; '.$tPrice.'</td></tr>';
                                  $tPrice = $row['orderPrice'];
                                  $tQuan = $tQuan + $row['orderQuantity'];
                                  $balance = $row['balance'];
                                  $delFee = $row['invDelrateID'];
                                  $penFee = $row['invPenID'];
                                  $status = $row['orderStatus'];
                                }
                                $grandTotal = $balance + $delFee + $penFee;
                                ?>
                              </tbody>
                              <tfoot style="text-align:right;">
                              <tr>
                                <td style="text-align:left">ORDER STATUS</td>
                                <td style="text-align:left"><mark><?php echo $status?></mark></td>
                                <td style="text-align:right;"><i class="fa fa-caret-right text-info"></i><b> TOTAL ORDER PRICE</b></td>
                                <td style="text-align:right;"><mark><strong><span><?php echo $tQuan?></span></bold></mark></td>
                                <td id="totalPrice" style="text-align:right;"><strong><span>&#8369;&nbsp;<?php echo number_format($tPrice,2)?></span></strong></td>
                              </tr>
                              <tr>
                                <td></td>
                                <td colspan="2" style="text-align:right;"><i class="fa fa-caret-right text-info"></i><b> DELIVERY FEE</b></td>
                                <td style="text-align:right;"></td>
                                <td id="totalPrice" style="text-align:right;"><strong><span>&#8369;&nbsp;<?php echo number_format($delFee,2)?></span></strong></td>
                              </tr>
                              <tr>
                                <?php
                                include "dbconnect.php";
                                $sqlP = "SELECT * FROM tblpenalty where penaltyID = '1'";
                                $resP = mysqli_query($conn,$sqlP);
                                $rowP = mysqli_fetch_assoc($resP);
                                $penName = $rowP['penaltyName'];
                                ?>
                                <td style="text-align:left">PENALTY</td>
                                <td style="text-align:left"><?php echo $penName;?></td>
                                <td style="text-align:right;"><i class="fa fa-caret-right text-info"></i><b> PENALTY FEE</b></td>
                                <td style="text-align:right;"></td>
                                <td id="totalPrice" style="text-align:right;"><strong><span>&#8369;&nbsp;<?php echo number_format($penFee,2)?></span></strong></td>
                              </tr>
                                <tr>
                                <td></td>
                                <td colspan="2" style="text-align:right;"><i class="fa fa-caret-right text-info"></i><b> GRAND TOTAL</b></td>
                                <td id="totalQ" style="text-align:right;"></td>
                                <td id="totalPrice" style="text-align:right;"><mark><strong><span>&#8369;&nbsp;<?php echo number_format($grandTotal,2)?></span></strong></mark></td>
                              </tr>
                              </tfoot>
                            </table>
                          </div>

    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="panel panel-info">
          <div class="panel-heading"><a href="#" data-perform="panel-collapse">VIEW PAYMENT HISTORY</a>
            <div class="pull-right"><a href="#" data-perform="panel-collapse"><i class="ti-minus"></i></a></div>
          </div>
          <div class="panel-wrapper collapse" aria-expanded="true">
            <div class="panel-body">
             
              <div class="row">
                <table class="table color-bordered-table">
                  <thead>
                    <th style="text-align:left">Date Paid</th>
                    <th style="text-align:left">Mode of Payment</th>
                    <th style="text-align:right">Amount Paid</th>
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
                    $bal = $tPrice - $down;
                    ?>
                    <tr>
                      <td colspan="2" style="text-align:right;"><i class="fa fa-caret-right text-info"></i><b> TOTAL AMOUNT PAID</b></td>
                      <td style="text-align:right;"><mark><strong><span>&#8369;&nbsp;<?php echo number_format($down,2)?></span></strong></mark></td>
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
                        <div class="col-md-4"> 
                          <div class="panel-wrapper collapse in" aria-expanded="true">
                            <div class="panel-body blue-gradient">
                              <h2 style="text-align:center; font-family: inherit; font-weight: bolder;">PAYMENT</h2>
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
                                $price = $trow['balance'];
                                $delFee = $trow['invDelrateID'];
                                $penFee = $trow['invPenID'];
                              }

                              $p = $price + $delFee + $penFee;
                              // $down = $tpay;
                              // $bal = $p - $down;

                              $down = $tpay;
                              $bal = $p - $down;
                              ?>
                              <h4 style="font-weight: bolder;">Amount Due <span class="pull-right" id="sideAmountDue" style="color: #e50000"> &#8369; <?php echo number_format($bal,2)?></span></h4>
                              <p style="color:red; background:">Payment for this order is overdue.</p>
                              <hr>
                            <input type="hidden" id="balance" value="<?php echo $bal?>">
                            <div id="cash">
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label class="control-label" style="font-weight: bolder;">Penalty Fee</label><span id="x" style="color:red"> *</span>
                                    <input type="text" style="text-align:right;" id="aTendered" class="form-control" name="aTendered"/>
                                    <p id="error" style="color:red"></p>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="row" style="margin:10px">
                              <button data-wizard="finish" type="submit" class="btn btn-success waves-effect pull-right" id="saveBtn" disabled><i class="ti-check"></i> Save</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>  
      </div>
    </div>
    <!-- /.container-fluid -->
    <!--footer class="footer text-center"> 2017 &copy; Filipiniana Furniture </footer-->
  </div>
  <!-- /#page-wrapper -->
</div>
</body> 
</html>