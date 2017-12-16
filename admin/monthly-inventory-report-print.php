<?php
// set_include_path(get_include_path() . PATH_SEPARATOR . "/path/to/plugins/bower_components/dompdf-master");
// require_once "plugins/bower_components/dompdf/autoload.inc.php";
// use Dompdf\Dompdf;
// ob_start();

session_start();
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

$monthYear = $month .' '. $year;

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
          $salesReportID = "MonthlySalesReport". $orderID;?></span>
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

 $sql = "SELECT *,SUM(b.pph_matQuan) as quan FROM tblmat_var d, tblmat_inventory a, tblprodphase_materials b, 
  tblproduction_phase c, tblmaterials e WHERE a.matVariantID = d.mat_varID and d.mat_varID = 
  b.pph_matDescID and b.pphID = c.prodHistID and month(c.prodDateStart) = '$m' and year(c.prodDateStart) = '$y' and e.materialID = d.materialID;";
  $result = mysqli_query($conn, $sql);
  echo "<div class='table-responsive'>
  <table class='table color-bordered-table muted-bordered-table reportsDataTable display' id='reportsOut'>
  <thead>
  <tr>
  <th>Material ID</th>
  <th>Material Description</th>
  <th style='text-align:right'>Starting Quantity</th>
  <th style='text-align:right'>Used Quantity</th>
  <th style='text-align:right;'>Available</th>
  </tr>
  </thead>
  <tbody>";
  while ($row = mysqli_fetch_assoc($result)){
    $mID = str_pad($row['mat_varID'], 6, '0', STR_PAD_LEFT);
    $start = $row['matVarQuantity'] + $row['quan'];
    $matName = $row['mat_varDescription'] . "/ " . $row['materialName'];
    echo ('<tr>
      <td style="text-align:left;">'.$mID.'</td>
      <td style="text-align:left;">'.$matName.'</td>
      <td style="text-align:right;">'.$start.'</td>
      <td style="text-align:right;">'.$row['quan'].'</td>
      <td style="text-align:right;">'.$row['matVarQuantity'].'</td>
      </tr>'); 
    $ctr++;
  }
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
  
  
 
    ?>

    <br>

    <?php
    $down = 0;
    $bal = 0;
    $sql = "SELECT * FROM tblinvoicedetails a, tblpayment_details b, tblorders c WHERE c.orderID = a.invorderID and a.invoiceID = b.invID and c.orderID = '$month'";
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
  // $dompdf->stream($salesReportID, array("Attachment" => 0));
  ?>