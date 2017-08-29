<?php
$activePage = basename($_SERVER['PHP_SELF'],".php");
include "menu.php";
include "titleHeader.php";
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
      $('.quan').on('keyup',function(){
        var mat = $(".quan").val();
        if(isNaN(mat)){
          var e = "Please input a valid number.";
          $(".quanError").html(e);
          $('.quan').css('border-color','red');
          $('#saveBtn').prop('disabled',true);
        }
        else if(mat<0){
          var e = "Numbers less than 0 are not allowed";
          $(".quanError").html(e);
          $('.quan').css('border-color','red');
          $('#saveBtn').prop('disabled',true);
        }
        else{
          var e = "";
          $(".quanError").html(e);
          $('.quan').css('border-color','gray');
          $('#saveBtn').prop('disabled',false);
        }

      });
  });

</script>
<title>Return Order</title>
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
                  <a aria-controls="proorders" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs">Return Order</span></a>
                </li>
              </ul>
            </h3>
          </h4>
          <div class="orderconfirm">
            <div class="panel panel-default">
              <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <form action="" method = "post">
                  <input type="hidden" name="orderID" id="orderID" value="<?php echo $jsID?>">
                  <div class="panel-body">
                    <div class="row">
                      <div class="descriptions">

                        <div class="panel-body">
                          <div class="row">
                            <h2>Customer Information</h2>
                            <div class="row">
                              <?php
                              $sql = "SELECT * FROM tblcustomer a, tblorders b WHERE a.customerID = b.custOrderID and b.orderID = '$jsID'";
                              $result = mysqli_query($conn,$sql);
                              $row = mysqli_fetch_assoc($result);
                              ?>
                              <div class="row">
                                <div class="col-md-12" style="text-align:left;">
                                  <h5>
                                    <table class="table">
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
                              </div>
                            </div>
                            <br>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="table-responsive" style="clear: both;">

                            <div class="row">
                              <div class="col-md-12">
                                <div class="panel-wrapper collapse in" aria-expanded="true">
                                  <div class="panel-body">
                                    <div class="row">
                                      <div class="table-responsive">

                                        <h2>Orders</h2>
                                        <table class="table product-overview" id="cartTbl">
                                          <thead>
                                            <th style="text-align:left">Furniture Name</th>
                                            <th style="text-align:right;">Unit Price</th>
                                            <th style="text-align:right;">Quantity</th>
                                            <th style="text-align:right;">Total Price</th>
                                            <th style="text-align:center;">Reason</th>
                                            <th style="text-align:right;">Quantity Affected</th>
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
                                              <td style="text-align:left">'.$row['productName'].'</td>
                                              <td style="text-align:right;">&#8369; '.number_format($row['productPrice'],2).'</td>
                                              <td style="text-align:right;">'.$row['orderQuantity'].'</td>';
                                              $tPrice = $row['orderQuantity'] * $row['productPrice'];
                                              $tPrice =  number_format($tPrice,2);
                                              echo '<td style="text-align:right;">&#8369; '.$tPrice.'</td>';
                                              $tPrice = $row['orderPrice'];
                                              $tQuan = $tQuan + $row['orderQuantity'];
                                              ?>
                                              <td style="text-align:center; background-color:#8dcfe7;">
                                                <label class="radio-inline"><input type="radio" name="design<?php echo $row['order_requestID']?>" value="None" checked>None</label>
                                                <label class="radio-inline"><input type="radio" name="design<?php echo $row['order_requestID']?>" value="Replacement">Replacement</label>
                                                <label class="radio-inline"><input type="radio" name="design<?php echo $row['order_requestID']?>" value="Repair">Repair</label>
                                              </td>
                                              <td style="text-align:center; background-color:#8dcfe7;">
                                                <input type="text" size="1" style="text-align:right;" class="quan form-control" name="quan[]" value="0"/>
                                              </td>
                                              <?php
                                              echo "</tr>";
                                            }
                                            ?>
                                          </tbody>
                                          <tfoot style="text-align:right;">
                                            <td colspan="2" style="text-align:right;"><b> GRAND TOTAL</b></td>
                                            <td id="totalQ" style="text-align:right;"><?php echo $tQuan?></td>
                                            <td id="totalPrice" style="text-align:right;"><?php echo "&#8369; ". number_format($tPrice,2)?></td>
                                          </tfoot>
                                        </table>
                                           <p class="quanError pull-right" style="color:red"></p>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="row" style="margin:10px">
                              <button data-wizard="finish" type="submit" class="btn btn-success waves-effect pull-right" id="saveBtn" ><i class="fa fa-check"></i> Save</button>
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