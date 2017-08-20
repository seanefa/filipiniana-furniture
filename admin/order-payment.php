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
        var mat = $("#aTendered").val();
        var bal = $("#balance").val();
        if(isNaN(mat)){
          var e = "Please input a valid number.";
          $("#error").html(e);
          $('#aTendered').css('border-color','red');
          $('#saveBtn').prop('disabled',true);
        }
        else if(mat<0){
          var e = "Numbers less than 0 are not allowed";
          $("#error").html(e);
          $('#aTendered').css('border-color','red');
          $('#saveBtn').prop('disabled',true);
        }
        else if(mat==""){
          var e = "";
          var change = 0.00;
          $("#dChange").val(change);
          $("#error").html(e);
          $('#aTendered').css('border-color','gray');
          $('#saveBtn').prop('disabled',true);
        }
        else{
            var e = "";
            var change = mat - bal;
            var change = change + ".00";
            $("#dChange").val(change);
            $("#error").html(e);
            $('#aTendered').css('border-color','gray');
            $('#saveBtn').prop('disabled',false);
          
        }

        /*
          if(mat>bal){ //if may malaki diba? hahaha
            var e = "";
            var e = "Please input a valid number.";
            $("#error").html(e);
            $('#aTendered').css('border-color','red');
            $('#saveBtn').prop('disabled',true);
          }*/

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
        <div class="col-sm-12">
          <h4 class="box-title">
            <h3>
              <ul class="nav customtab2 nav-tabs" role="tablist">
                <li role="presentation" class="active">
                  <a aria-controls="proorders" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs">Order Payment</span></a>
                </li>
              </ul>
            </h3>
          </h4>
          <div class="orderconfirm">
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                  <h4 class="panel-title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                      <h3>Payment</h3>
                    </a>
                  </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                  <form action="payments.php" method = "post">
                    <input type="hidden" name="orderID" id="orderID" value="<?php echo $jsID?>">
                    <div class="panel-body">
                      <div class="row">
                        <div class="descriptions">
                          <div class="col-md-12">
                            <div class="table-responsive" style="clear: both;">

                              <div class="row">
                                <div class="col-md-12">
                                  <div class="panel-wrapper collapse in" aria-expanded="true">
                                    <div class="panel-body">
                                      <div class="row">
                                        <div class="table-responsive">
                                    <h1 style="text-align:center"><label class="form-control" style="border:0px;">Orders</label></h1>
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
                                                <td style="text-align:right;">&#8369; '.number_format($row['productPrice'],2).'</td>
                                                <td style="text-align:right;">'.$row['orderQuantity'].'</td>';
                                                $tPrice = $row['orderQuantity'] * $row['productPrice'];
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

                              <div class="row">
                                <div class="col-md-6">
                                  <div style="padding-right: 15px;">
                                    <h1 style="text-align:center"><label class="form-control" style="border:0px;">Payment History</label></h1>
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
                                          <td colspan="2" style="text-align:right;"><b>Total Amount Paid:</b></td>
                                          <td style="text-align:right;">&#8369; <?php echo number_format($down,2)?></td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                                <div class="col-md-6"> 
                                  <div style="padding-left: 25px;">
                                    <div class="panel-wrapper collapse in" aria-expanded="true">
                                      <div class="panel-body" style="background-color:#8dcfe7">
                                    <h1><label class="form-control" style="border:0px;text-align:center">Payment</label></h1>
                                        <h4>Amount Due <span class="pull-right" id="sideAmountDue"> &#8369; <?php echo number_format($bal,2)?></span></h4>
                                        <hr>
                                        <b>Mode of Payment:</b>
                                        <select class="form-control" data-placeholder="Add Payment" tabindex="1" name="mop" id="mop">
                                         <?php
                                         $delsql = "SELECT * FROM tblmodeofpayment;";
                                         $delresult = mysqli_query($conn,$delsql);
                                         while($delrow = mysqli_fetch_assoc($delresult)){
                                          echo('<option value="'.$delrow['modeofpaymentID'].'">'.$delrow['modeofpaymentDesc'].'</option>');
                                        }
                                        ?>
                                      </select>
                                      <hr>
                                      <input type="hidden" id="balance" value="<?php echo $bal?>">
                                      <div id="cash">
                                      <div class="row">
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <label class="control-label">Amount Paid</label><span id="x" style="color:red"> *</span>
                                            <input type="text" style="text-align:right;" id="aTendered" class="form-control" name="aTendered"/>
                                              <p id="error"></p>
                                          </div>
                                          </div>
                                        </div>
                                        </div>

                                      <div id="check">
                                      <div class="row">
                                        <div class="col-md-12">
                                          <div class="form-group">
                                            <label class="control-label">Check Number</label><span id="x" style="color:red"> *</span>
                                            <input type="text" style="text-align:right;" id="cNum" class="form-control" name="cNumber"/>
                                              <p id="cNumError"></p>
                                          </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-md-12">
                                            <div class="form-group">
                                              <label class="control-label">Amount</label><span id="x" style="color:red"> *</span>
                                              <input type="text" id="cAmount" style="text-align:right;" class="form-control" name="cAmount"/> 
                                              <p id="cAmountError"></p>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="row">
                                          <div class="col-md-12">
                                            <div class="form-group">
                                              <label class="control-label">Remarks</label>
                                              <textarea style="text-align:right;" class="form-control" name="remarks"></textarea> 
                                              <p id="cAmountError"></p>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        </div>
                                      </div>
                                  </div>
                                </div>
                              </div>
                              <div class="row" style="margin:10px">
                              <button data-wizard="finish" type="submit" class="btn btn-success waves-effect pull-right" id="saveBtn" disabled><i class="fa fa-check"></i> Save</button>
                            </div>
                            </form>
                          </div>
                      </div>  
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </body> 

        <script type="text/javascript">
        (function(){
          $('#accordion').wizard({
            step: '[data-toggle="collapse"]',
            buttonsAppendTo: '.panel-collapse',
            templates: {
              buttons: function(){
                var options = this.options;
                return '<div class="panel-footer"><ul class="pager">' +
                '<button data-wizard="finish" type="submit" class="btn btn-success waves-effect pull-right" id="addFab"><i class="fa fa-check"></i> Save</button>' +
                '</div>';
              }
            },
            onFinish: function(){
              window.location.href = 'receipt.php?id='+id;
            }
          });
        })();
        </script>
        </html>