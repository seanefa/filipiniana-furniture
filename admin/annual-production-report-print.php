<?php
session_start();
// set_include_path(get_include_path() . PATH_SEPARATOR . "/path/to/plugins/bower_components/dompdf-master");
// require_once "plugins/bower_components/dompdf/autoload.inc.php";
// use Dompdf\Dompdf;
// ob_start();
$year = $_GET['year'];
?>
<!DOCTYPE html>
<head>
  <title><?php echo $orderID = $year?></title>
  <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
  <script>
  $(document).ready(function () {
    window.print();
    setTimeout(window.close, 0);
  });
  </script>
</head>
<?php 
$year = $_GET['year'];
include "dbconnect.php";
$sql = "SELECT * FROM tblcompany_info";
$res = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($res);
?>
<body>
  <div>
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div style="text-align: center;">
          <img height="55px" src="plugins/ilogo/<?php echo $row['comp_logo'];?>"/>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div style="text-align: center;">
          <p style='font-family:inherit; font-size:28px;'><?php echo $row['comp_name'];?></p>
          <h5><?php echo $row['comp_address'];?></h5>
          <h5>Phone: <?php echo $row['comp_num'];?></h5>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div style="text-align: center;">
          <p style="text-align: center; font-family: inherit; font-weight: bolder; font-size: 20px;">- ANNUAL PRODUCTION REPORT -</p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div style="text-align: center;">
          <?php
          include "dbconnect.php";
          $sql = "SELECT * FROM tblcustomer a, tblorders b WHERE a.customerID = b.custOrderID and b.orderID = '$year'";
          $res = mysqli_query($conn,$sql);
          $custRow = mysqli_fetch_assoc($res);
          ?>
          <span style="text-align: center; font-family: inherit; font-weight: bolder; font-size: 20px;"><?php $orderID = $year; echo $orderID;
          $productionReportID = "AnnualProductionReport". $orderID;?></span>
        </div>
      </div>
    </div>

    <br>
    <?php
    $y = $orderID;
  $tempSQL = '';
  $tempID = "";
  $tQuan = 0;
  $tPrice = 0;
  $ctr = 0;

  $tpriceArray = array();
  $tpriceArray = getAllYeardata();

 $sql = "SELECT * FROM tblproduction_phase a, tblphases b WHERE year(prodDateEnd) = '$y' and prodStatus = 'Finished' and b.phaseID = a.prodPhase";
  $result = mysqli_query($conn, $sql);
  echo "<div class='table-responsive'>
    <table class='table color-bordered-table muted-bordered-table reportsDataTable display' id='reportsOut'>
    <thead>
  <tr>
  <th style='text-align:left'>Production Phase ID</th>
  <th style='text-align:left'>Phase Name</th>
  <th style='text-align:left'>Date Start</th>
  <th style='text-align:left'>Estimated Finish</th>
  <th style='text-align:left'>Date End</th>
  <th style='text-align:right'>No. of Days Delayed</th>
  <th style='text-align:right'>No. of Days Advanced</th>
  </tr>
  </thead>
  <tbody>";
  while ($row = mysqli_fetch_assoc($result)){
    $prodID = str_pad($row['prodHistID'], 7, '0', STR_PAD_LEFT);

    $dS = date_create($row['prodDateStart']);
    $dS = date_format($dS,"F d,Y");

    $dE = date_create($row['prodEstDate']);
    $dE = date_format($dE,"F d,Y");

    $dEn = date_create($row['prodDateEnd']);
    $dEn = date_format($dEn,"F d,Y");

    $endTimeStamp = strtotime($dEn);
    $startTimeStamp = strtotime($dE);

    $numberDays = 0;
    $adb = 0;
    if($endTimeStamp>$startTimeStamp){

    $timeDiff = abs($endTimeStamp - $startTimeStamp);

    $numberDays = $timeDiff/86400;  // 86400 seconds in one day

    $numberDays = intval($numberDays);

    }
    else if($endTimeStamp==$startTimeStamp){
      $numberDays = 0;
      $adb = 0;
    }
    else{
    $timeDiff = abs($startTimeStamp - $endTimeStamp);

    $numberDays = $timeDiff/86400;  // 86400 seconds in one day

    $adb = intval($numberDays);
    $numberDays = 0;
    }

    echo ('<tr>
      <td style="text-align:left">'.$prodID.'</td>
      <td style="text-align:left">'.$row['phaseName'].'</td>
      <td style="text-align:left">'.$dS.'</td>
      <td style="text-align:left">'.$dE.'</td>
      <td style="text-align:left">'.$dEn.'</td>
      <td style="text-align:right">'.$numberDays.'</td>
      <td style="text-align:right">'.$adb.'</td>
      </tr>'); 
  $ctr++;
  }

  $tpriceArraylength = count($tpriceArray);
  $dateArray = array("01","02","03","04","05","06","07","08","09","10","11","12");

  if($ctr==0){
    echo "<td colspan='8' style='text-align:center'><p style='text-align:center; font-family:inherit; font-size:25px;'>NOTHING TO SHOW</p></td>";
    echo "</tbody>";
  }
  else{
    echo '
  </tbody>
  </table>
  </div>
  <script>
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
   while($tpriceArraylength != 0){
    echo'<input type="hidden" value="'.$tpriceArray[$tpriceArraylength-1].'" id="'.$dateArray[$tpriceArraylength-1].'"/>';
    $tpriceArraylength--;
  }


function getAllYeardata(){

  include "dbconnect.php";

  $year = $_GET['year'];
  $orderID = $year;
  $dateArray = array("01","02","03","04","05","06","07","08","09","10","11","12");
  $y = $orderID;
  $priceArray = array();

  $ctrDate = 0;
  
  while($ctrDate != 12){
    $tQuan = 0;
    $temp = 0;
    $tPrice = 0;
    $ctr = 0;

  $sql = "SELECT *,SUM(b.orderQuantity) as quan FROM tblproduct a, tblorder_request b, tblorders c WHERE a.productID = b.orderProductID and c.orderID = b.tblOrdersID and month(c.dateOfReceived) = '$dateArray[$ctrDate]' and year(c.dateOfReceived) = '$y' GROUP BY b.orderProductID order by quan DESC;";
  $result = mysqli_query($conn, $sql);

if($result){
  while ($row = mysqli_fetch_assoc($result)){
    $prodID = str_pad($row['productID'], 6, '0', STR_PAD_LEFT);
    $total = $row['quan'] * $row['productPrice'];
    $tQuan += $row['quan'];
    $tPrice += $total; 
    $ctr++;
  }
  array_push($priceArray, $tPrice);
}
else{
  $tPrice = 0;
  array_push($priceArray, $tPrice);
}

$ctrDate++;
$ctr = 0;
  }
  return $priceArray;
  
}
    ?>

    <br>

    <?php
    $down = 0;
    $bal = 0;
    $sql = "SELECT * FROM tblinvoicedetails a, tblpayment_details b, tblorders c WHERE c.orderID = a.invorderID and a.invoiceID = b.invID and c.orderID = '$year'";
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
        <p><?php 
        include "dbconnect.php"; 
        $datepr = date("Y-m-d");
        $sql5 = "SELECT * FROM tblemployee a inner join tbluser b where a.empID = b.userEmpID and userID='" . $_SESSION["userID"] . "'";
        $result5 = mysqli_query($conn, $sql5);
        while ($row5 = mysqli_fetch_assoc($result5))
        { 
          if($row5['userStatus']=="Active" && $row5['userType']=="admin")
          {
            echo('Printed By: '.$row5['empFirstName'].' '.$row5['empMidName'].' '.$row5['empLastName'].'     ['.$datepr.']');
          }
        }  ?></p>
      </div>
    </div>

  </body> 
  </html>

  <?php
  // $html = ob_get_clean();
  // $dompdf = new DOMPDF();
  // $dompdf->load_html($html);
  // $dompdf->render();
  // $dompdf->stream($productionReportID, array("Attachment" => 0));
  ?>