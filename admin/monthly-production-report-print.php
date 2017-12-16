<?php
// set_include_path(get_include_path() . PATH_SEPARATOR . "/path/to/plugins/bower_components/dompdf-master");
// require_once "plugins/bower_components/dompdf/autoload.inc.php";
// use Dompdf\Dompdf;
// ob_start();

$month = $_GET['month'];
$year = $_GET['year'];

if($month == 1){
  $month = 'January';
}
if($month == 2){
  $month = 'February';
}
if($month == 3){
  $month = 'March';
}
if($month == 4){
  $month = 'April';
}
if($month == 5){
  $month = 'May';
}
if($month == 6){
  $month = 'June';
}
if($month == 7){
  $month = 'July';
}
if($month == 8){
  $month = 'August';
}
if($month == 9){
  $month = 'September';
}
if($month == 10){
  $month = 'October';
}
if($month == 11){
  $month = 'November';
}
if($month == 12){
  $month = 'December';
}

$monthYear = $month . " " . $year;

?>
<!DOCTYPE html>
<head>
  <title><?php echo $orderID = $monthYear?></title>
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

$month = $_GET['month'];
$year = $_GET['year'];

if($month == 1){
  $month = 'January';
}
if($month == 2){
  $month = 'February';
}
if($month == 3){
  $month = 'March';
}
if($month == 4){
  $month = 'April';
}
if($month == 5){
  $month = 'May';
}
if($month == 6){
  $month = 'June';
}
if($month == 7){
  $month = 'July';
}
if($month == 8){
  $month = 'August';
}
if($month == 9){
  $month = 'September';
}
if($month == 10){
  $month = 'October';
}
if($month == 11){
  $month = 'November';
}
if($month == 12){
  $month = 'December';
}

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
          <img height="55px" src="plugins/logo/<?php echo $row['comp_logo'];?>"/>
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
          <p style="text-align: center; font-family: inherit; font-weight: bolder; font-size: 20px;">- MONTHLY SALES REPORT -</p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div style="text-align: center;">
          <?php
          include "dbconnect.php";
          $sql = "SELECT * FROM tblcustomer a, tblorders b WHERE a.customerID = b.custOrderID and b.orderID = '$month'";
          $res = mysqli_query($conn,$sql);
          $custRow = mysqli_fetch_assoc($res);
          ?>
          <span style="text-align: center; font-family: inherit; font-weight: bolder; font-size: 20px;"><?php $orderID = $monthYear; echo $orderID;
          $productionReportID = "MonthlyProductionReport". $orderID;?></span>
        </div>
      </div>
    </div>

    <br>
    <?php
    $m = $_GET['month'];
  $y = $_GET['year'];
  $tempSQL = '';
  $tempID = "";
  $tQuan = 0;
  $tPrice = 0;
  $ctr = 0;

   $sql = "SELECT * FROM tblproduction_phase a, tblphases b WHERE month(prodDateEnd) = '$m' and year(prodDateEnd) = '$y' and prodStatus = 'Finished' and b.phaseID = a.prodPhase";
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
    echo '
  </tbody>
  </table>
  </div>
  <script>
  $(document).ready(function () {
  function redirectPrint(m,y){
    window.open("monthly-production-report-print.php?month="+m+"&year="+y, "_blank");
  }

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
  
 
    ?>

    <br>

    <div class="row">
      <div class="col-md-6">
        <p><?php 
        session_start();
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