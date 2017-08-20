<?php
include "titleHeader.php";
include "menu.php";
include 'dbconnect.php';
//session_start();
/*if(isset($GET['id'])){
$jsID = $_GET['id']; 
}
$jsID=$_GET['id'];
$_SESSION['varname'] = $jsID;*/
if (isset($_GET['newSuccess']))
{
  echo  '<script>';
  echo '$(document).ready(function () {';
    echo 'document.getElementById("toastNewSuccess").click();';
    echo '});';
echo '</script>';
}
else if (isset($_GET['updateSuccess']))
{
  echo  '<script>';
  echo '$(document).ready(function () {';
    echo 'document.getElementById("toastUpdateSuccess").click();';
    echo '});';
echo '</script>';
}
else if (isset($_GET['deactivateSuccess']))
{
  echo  '<script>';
  echo '$(document).ready(function () {';
    echo 'document.getElementById("toastDeactivateSuccess").click();';
    echo '});';
echo '</script>';
}

?>
<!DOCTYPE html>  
<html lang="en">
<head>
</head>
<body>
  <button class="tst1" id="toastNewSuccess" style="display: none;"></button>
  <button class="tst2" id="toastUpdateSuccess" style="display: none;"></button>
  <button class="tst3" id="toastDeactivateSuccess" style="display: none;"></button>
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="panel panel-info">
            <h3>
              <ul class="nav customtab2 nav-tabs" role="tablist">
                <!--<button id="tempbtn" class="btn btn-lg btn-info pull-right" data-toggle="modal" href="prod-form.php" data-remote="prod-info-form.php #new" data-target="#myModal" aria-expanded="false" style="margin-right: 20px;"><span class="btn-label"><i class="ti-plus"></i></span>New</button>-->
                <li role="presentation" class="active">
                  <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="ti-info"></i>Collections</a>
                </li>
              </ul>
            </h3>
            <div class="tab-content">
              <!-- CATEGORY -->
              <div role="tabpanel" class="tab-pane fade active in" id="job">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <div class="row">
                      <div class="table-responsive">
                        <table class="table color-bordered-table muted-bordered-table dataTable display nowrap" id="tblCategories">
                          <thead>
                            <tr>
                              <th>Order ID</th>
                              <th>Customer Name</th>
                              <th style="text-align:right">Order Price</th>
                              <th style="text-align:right">Remaining Balance</th>
                              <th style="text-align:right">Payment Status</th>
                              <th class="removeSort" style="text-align:center">Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            include "dbconnect.php";
                            $sql = "SELECT * FROM tblorders WHERE orderStatus != 'Archived' order by orderID ;";

                            $result = mysqli_query($conn, $sql);
                            if($result){
                              while ($row = mysqli_fetch_assoc($result))
                              {
                                $orderID = str_pad($row['orderID'], 6, '0', STR_PAD_LEFT);
                                $count_prod = pCount($row['custOrderID']);
                                $get_date = getDates($row['orderID']);
                                $get_name = orderCon($row['orderID']);
                                $bal = getBal($row['orderID'], $row['orderPrice']);
                                $paymentStat = getStat($row['orderID'], $row['orderPrice']);
                                echo ('
                                  <tr>
                                  <td>'.$orderID.'</td>
                                  <td>'.$get_name.'</td>
                                  <td style="text-align:right">&#8369; '.number_format($row['orderPrice'],2).'</td>
                                  <td style="text-align:right">&#8369; '.number_format($bal,2).'</td>
                                  <td style="text-align:right">'.$paymentStat.'</td>
                                  <td style="text-align:center"><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#myModal" href="order-management-modals.php" data-remote="order-management-modals.php?id='. $row['orderID'].' #viewInfo"><span class="glyphicon glyphicon-eye-open"></span> View</button>  

                                   <a class="btn btn-info" style="color:white;" href="bill.php?id='. $row['orderID'].'"><span class="glyphicon glyphicon-list-alt"></span>  Bill </a>

                                   <a class="btn btn-success" style="color:white;" href="order-payment.php?id='. $row['orderID'].'">&#8369; Payment </a>
                                  </td>
                                  </tr>
                                  ');
                              }     
                            }
                            /*<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal" href="order-management-modals.php" data-remote="order-management-modals.php?id='. $row['orderID'].' #payment">&#8369; Payment</button>*/
                            function pCount($id){
                              include "dbconnect.php";
                              $cnt = 0;
                              $sql = "SELECT COUNT(*) AS NO FROM tblorder_request WHERE tblOrdersID ='$id'";
                              $result = mysqli_query($conn,$sql);
                              while($row = mysqli_fetch_assoc($result)){
                                $cnt = $row['NO'];
                              }
                              return $cnt;
                            }
                            function getDates($id){
                              include "dbconnect.php";

                              $sql = "SELECT * FROM tblorders WHERE orderID='$id'";
                              $result = mysqli_query($conn,$sql);
                              $row = mysqli_fetch_assoc($result);
                              $dates = $row['dateOfReceived'];
                              return $dates;
                            }
                            function orderCon($id){
                              include "dbconnect.php";
                              $sql = "SELECT * FROM tblorders WHERE orderID='$id'";
                              $result = mysqli_query($conn,$sql);
                              $row = mysqli_fetch_assoc($result);
                              $dates = $row['custOrderID'];
                              return getName($dates);
                            }

                            function getName($id){
                              include "dbconnect.php";

                              $sql = "SELECT * FROM tblcustomer WHERE customerID='$id'";
                              $result = mysqli_query($conn,$sql);
                              $row = mysqli_fetch_assoc($result);
                              $name = $row['customerLastName'].','.$row['customerFirstName'].'  '.$row['customerMiddleName'];
                              return $name;
                            }    
                            function getBal($id,$price){
                              include "dbconnect.php";
                              $down = 0;
                              $bal = 0;
                              $sql = "SELECT * FROM tblinvoicedetails a, tblpayment_details b, tblorders c WHERE c.orderID = a.invorderID and a.invoiceID = b.invID and c.orderID = '$id'";
                              $res = mysqli_query($conn,$sql);
                              $tpay = 0;
                              while($trow = mysqli_fetch_assoc($res)){
                                $tpay = $tpay + $trow['amountPaid'];
                              }
                              $down = $tpay;
                              $bal = $price - $down;
                            return $bal;
                            }    
                            function getStat($id,$price){
                              include "dbconnect.php";
                              $down = 0;
                              $bal = 0;
                              $sql = "SELECT * FROM tblinvoicedetails a, tblpayment_details b, tblorders c WHERE c.orderID = a.invorderID and a.invoiceID = b.invID and c.orderID = '$id'";
                              $res = mysqli_query($conn,$sql);
                              $tpay = 0;
                              while($trow = mysqli_fetch_assoc($res)){
                                $tpay = $tpay + $trow['amountPaid'];
                              }
                              $down = $tpay;
                              $bal = $price - $down;
                              if($bal==$price){
                                return "No downpayment";
                              }
                              else if($bal==0){
                                return "Paid";
                              }
                              else{
                                return "Not fully paid";
                              }
                            }
                            ?> 
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
<!-- New Framework Modal
  <!-- /.modal -->
</div>
</div>  
</div>
</div>
<!-- /.container-fluid -->
<!--footer class="footer text-center"> 2017 &copy; Filipiniana Furniture </footer-->
</div>
<!-- /#page-wrapper -->
</div>

<div id="myModal" class="modal fade" role="dialog " aria-hidden="true" style="display: none;" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <!-- Modal content-->
      <div class="modal-content clearable-content">
        <div class="modal-body">

        </div>
      </div>
    </div>
  </div>
</div>

<script>
$(document).on('hidden.bs.modal', function (e) {
  var target = $(e.target);
  target.removeData('bs.modal')
  .find(".clearable-content").html('');
});
</script>
</body> 
</html>