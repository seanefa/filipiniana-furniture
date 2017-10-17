<?php
include "dbconnect.php";
$id = $_POST['id'];

if($id==1){
  $date = $_POST['d'];
  $newDate = new DateTime($date);
  $resultDate = $newDate->format('Y-m-d');
  $explodeDate = explode('-',$resultDate);

  $y = "";
  $m = "";
  $d = "";

  $y = $explodeDate[0];
  $m = $explodeDate[1];
  $d = $explodeDate[2];

  $tempSQL = '';
  $tempID = "";
  $tQuan = 0;
  $tPrice = 0;
  $ctr = 0;

  $sql = "SELECT * FROM tblorders WHERE orderStatus!='Archived' and dateOfReceived = '$date' order by orderID;";
  $result = mysqli_query($conn, $sql);
  echo "
  <div class='table-responsive'>
    <table class='table color-bordered-table muted-bordered-table reportsDataTable display' id='reportsOut'>
    <thead>
  <tr>
    <th style='text-align:right'>Order ID</th>
    <th style='text-align:right'>Date Received</th>
    <th style='text-align:right'>Customer Name</th>
    <th style='text-align:right'>Amount Due</th>
    <th style='text-align:right'>Quantity Ordered</th>
    <th style='text-align:right'>Remaining Balance</th>
  </tr>
  </thead>
  <tbody>";
   while ($row = mysqli_fetch_assoc($result)){
    $orderID = str_pad($row['orderID'], 6, '0', STR_PAD_LEFT);
    $count_prod = pCount($row['custOrderID']);
    $get_date = getDates($row['orderID']);
    $get_name = orderCon($row['orderID']);
    $bal = getBal($row['orderID'], $row['orderPrice']);
    $qnts = pCount($row['orderID']);
    $paymentStat = getStat($row['orderID'], $row['orderPrice']);
    $date = date_create($row['dateOfReceived']);
    $date = date_format($date,"F  d, Y");
    echo ('
      <tr>
      <td style="text-align:left">'.$orderID.'</td>
      <td style="text-align:left">'.$date.'</td>
      <td style="text-align:left">'.$get_name.'</td>
      <td style="text-align:right">&#8369; '.number_format($row['orderPrice'],2).'</td>
      <td style="text-align:right">'.$qnts.'</td>
      <td style="text-align:right">&#8369; '.number_format($bal,2).'</td>
      </tr>
      ');
  $ctr++;
  }
  if($ctr==0){
    echo "<td colspan='6' style='text-align:center'><p style='text-align:center; font-family:inherit; font-size:25px;'>NOTHING TO SHOW</p></td>";
    echo "</tbody>";
  }
  else{
    echo '
     <button type="button" class="btn btn-info" onclick="redirectPrint('.$d.','.$m.','.$y.')" style="text-align:center;color:white;"><span class=" ti-receipt"></span> PRINT REPORT </button>
     </tbody>
  <tfoot style="text-align:right;">
  </tfoot>
  </table>
  </div>
  <script>
  function redirectPrint(d,m,y){
    window.open("daily-order-report-print.php?day="+d+"&month="+m+"&year="+y, "_blank");
  }

  $(document).ready(function () {
    var table = $(".reportsDataTable").DataTable({
      "order": [],
      "pageLength": 5,
      "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
      "aoColumnDefs" : [
      {
       "bSortable" : false,
       "aTargets" : [ "removeSort" ]
     }]
   });
  });
  </script>';
  }
}
else if($id==2){
  $m = $_POST['m'];
  $y = $_POST['y'];
  $tempSQL = '';
  $tempID = "";
  $tQuan = 0;
  $tPrice = 0;
  $ctr = 0;
  $sql = "SELECT * FROM tblorders WHERE orderStatus!='Archived' and month(dateOfReceived) = '$m' and year(dateOfReceived) = '$y' order by orderID;";
  $result = mysqli_query($conn, $sql);
  echo "
  <div class='table-responsive'>
    <table class='table color-bordered-table muted-bordered-table reportsDataTable display' id='reportsOut'>
    <thead>
  <tr>
   
    <th style='text-align:right'>Order ID</th>
    <th style='text-align:right'>Date Received</th>
    <th style='text-align:right'>Customer Name</th>
    <th style='text-align:right'>Amount Due</th>
    <th style='text-align:right'>Quantity Ordered</th>
    <th style='text-align:right'>Remaining Balance</th>
  </tr>
  </thead>
  <tbody>";
   while ($row = mysqli_fetch_assoc($result)){
    $orderID = str_pad($row['orderID'], 6, '0', STR_PAD_LEFT);
    $count_prod = pCount($row['custOrderID']);
    $get_date = getDates($row['orderID']);
    $get_name = orderCon($row['orderID']);
    $bal = getBal($row['orderID'], $row['orderPrice']);
    $qnts = pCount($row['orderID']);
    $paymentStat = getStat($row['orderID'], $row['orderPrice']);
    $date = date_create($row['dateOfReceived']);
    $date = date_format($date,"F  d, Y");
    echo ('
      <tr>
      <td style="text-align:left">'.$orderID.'</td>
      <td style="text-align:left">'.$date.'</td>
      <td style="text-align:left">'.$get_name.'</td>
      <td style="text-align:right">&#8369; '.number_format($row['orderPrice'],2).'</td>
      <td style="text-align:right">'.$qnts.'</td>
      <td style="text-align:right">&#8369; '.number_format($bal,2).'</td>
      </tr>
      ');
  $ctr++;
  }
  if($ctr==0){
    echo "<td colspan='6' style='text-align:center'><p style='text-align:center; font-family:inherit; font-size:25px;'>NOTHING TO SHOW</p></td>";
    echo "</tbody>";
  }
  else{
    echo '
     <button type="button" class="btn btn-info" onclick="redirectPrint('.$m.','.$y.')" style="text-align:center;color:white;"><span class=" ti-receipt"></span> PRINT REPORT </button>
  </tbody>
  <tfoot style="text-align:right;">
  </tfoot>
  </table>
  </div>
  <script>
  function redirectPrint(month,year){
    window.open("monthly-order-report-print.php?month="+month+"&year="+year, "_blank");
  }

  $(document).ready(function () {
    var table = $(".reportsDataTable").DataTable({
      "order": [],
      "pageLength": 5,
      "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
      "aoColumnDefs" : [
      {
       "bSortable" : false,
       "aTargets" : [ "removeSort" ]
     }]
   });
  });
  </script>';
  }
}

else if($id==3){
  $y = $_POST['y'];
  $tempSQL = '';
  $tempID = "";
  $tQuan = 0;
  $tPrice = 0;
  $ctr = 0;
  $sql = "SELECT * FROM tblorders WHERE orderStatus!='Archived' and year(dateOfReceived) = '$y' order by orderID;";
  $result = mysqli_query($conn, $sql);
  echo "
  <div class='table-responsive'>
    <table class='table color-bordered-table muted-bordered-table reportsDataTable display' id='reportsOut'>
    <thead>
  <tr>
    <th style='text-align:right'>Order ID</th>
    <th style='text-align:right'>Date Received</th>
    <th style='text-align:right'>Customer Name</th>
    <th style='text-align:right'>Amount Due</th>
    <th style='text-align:right'>Quantity Ordered</th>
    <th style='text-align:right'>Remaining Balance</th>
  </tr>
  </thead>
  <tbody>";
   while ($row = mysqli_fetch_assoc($result)){
    $orderID = str_pad($row['orderID'], 6, '0', STR_PAD_LEFT);
    $count_prod = pCount($row['custOrderID']);
    $get_date = getDates($row['orderID']);
    $get_name = orderCon($row['orderID']);
    $bal = getBal($row['orderID'], $row['orderPrice']);
    $qnts = pCount($row['orderID']);
    $paymentStat = getStat($row['orderID'], $row['orderPrice']);
    $date = date_create($row['dateOfReceived']);
    $date = date_format($date,"F  d, Y");
    echo ('
      <tr>
      <td style="text-align:left">'.$orderID.'</td>
      <td style="text-align:left">'.$date.'</td>
      <td style="text-align:left">'.$get_name.'</td>
      <td style="text-align:right">&#8369; '.number_format($row['orderPrice'],2).'</td>
      <td style="text-align:right">'.$qnts.'</td>
      <td style="text-align:right">&#8369; '.number_format($bal,2).'</td>
      </tr>
      ');
  $ctr++;
  }
  if($ctr==0){
    echo "<td colspan='6' style='text-align:center'><p style='text-align:center; font-family:inherit; font-size:25px;'>NOTHING TO SHOW</p></td>";
    echo "</tbody>";
  }
  else{
    echo '
     <button type="button" class="btn btn-info" onclick="redirectPrint('.$y.')" style="text-align:center;color:white;"><span class=" ti-receipt"></span> PRINT REPORT </button>
  </tbody>
  <tfoot style="text-align:right;">
  </tfoot>
  </table>
  </div>
  <script>
  function redirectPrint(year){
    window.open("annual-order-report-print.php?year="+year, "_blank");
  }

  $(document).ready(function () {
    var table = $(".reportsDataTable").DataTable({
      "order": [],
      "pageLength": 5,
      "lengthMenu": [[5,10, 25, 50, -1], [5,10, 25, 50, "All"]],
      "aoColumnDefs" : [
      {
       "bSortable" : false,
       "aTargets" : [ "removeSort" ]
     }]
   });
  });
  </script>';
  }
}

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