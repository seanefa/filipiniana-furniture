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

  $sql = "SELECT * FROM tblproduction_phase a, tblphases b WHERE prodDateEnd = '$date' and prodStatus = 'Finished' and b.phaseID = a.prodPhase";
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
  if($ctr==0){
    echo "<td colspan='8' style='text-align:center'><p style='text-align:center; font-family:inherit; font-size:25px;'>NOTHING TO SHOW</p></td>";
    echo "</tbody>";
  }
  else{
    echo '    
     <button type="button" class="btn btn-info" onclick="redirectPrint('.$d.','.$m.','.$y.')" style="text-align:center;color:white;"><span class=" ti-receipt"></span> PRINT REPORT </button>
     </tbody>
  </table>
  </div>
  <script>
  function redirectPrint(d,m,y){
    window.open("daily-production-report-print.php?day="+d+"&month="+m+"&year="+y, "_blank");
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

  //$sql = "SELECT *,SUM(b.orderQuantity) as quan FROM tblproduct a, tblorder_request b, tblorders c WHERE a.productID = b.orderProductID and c.orderID = b.tblOrdersID and month(c.dateOfReceived) = '$m' and year(c.dateOfReceived) = '$y' GROUP BY b.orderProductID order by quan DESC;";
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
  if($ctr==0){
    echo "<td colspan='8' style='text-align:center'><p style='text-align:center; font-family:inherit; font-size:25px;'>NOTHING TO SHOW</p></td>";
    echo "</tbody>";
  }
  else{
    echo '
     <button type="button" class="btn btn-info" onclick="redirectPrint('.$m.','.$y.')" style="text-align:center;color:white;"><span class=" ti-receipt"></span> PRINT REPORT </button>
  </tbody>
  </table>
  </div>
  <script>
  function redirectPrint(m,y){
    window.open("monthly-production-report-print.php?month="+m+"&year="+y, "_blank");
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

  $tpriceArray = array();
  $tpriceArray = getAllYeardata();

  //$sql = "SELECT *,SUM(b.orderQuantity) as quan FROM tblproduct a, tblorder_request b, tblorders c WHERE a.productID = b.orderProductID and c.orderID = b.tblOrdersID and year(c.dateOfReceived) = '$y' GROUP BY b.orderProductID";
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
     <button type="button" class="btn btn-info" onclick="redirectPrint('.$y.')" style="text-align:center;color:white;"><span class=" ti-receipt"></span> PRINT REPORT </button>
  </tbody>
  </table>
  </div>
  <script>
  function redirectPrint(year){
    window.open("annual-production-report-print.php?year="+year, "_blank");
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
   while($tpriceArraylength != 0){
    echo'<input type="hidden" value="'.$tpriceArray[$tpriceArraylength-1].'" id="'.$dateArray[$tpriceArraylength-1].'"/>';
    $tpriceArraylength--;
  }
}


function getAllYeardata(){

  include "dbconnect.php";

  $dateArray = array("01","02","03","04","05","06","07","08","09","10","11","12");
  $y = $_POST['y'];
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