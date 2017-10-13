<?php
set_include_path(get_include_path() . PATH_SEPARATOR . "/path/to/dompdf-master");
require_once "dompdf/autoload.inc.php";
use Dompdf\Dompdf;
ob_start();
$year = $_GET['year'];
?>
<!DOCTYPE html>
<head>
  <title><?php echo $orderID = $year?></title>
  <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
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
          <img height="55px" src="plugins/images/<?php echo $row['comp_logo'];?>"/>
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
          <p style="text-align: center; font-family: inherit; font-weight: bolder; font-size: 20px;">- ANNUAL SALES REPORT -</p>
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
          $salesReportID = "AnnualSalesReport". $orderID;?></span>
        </div>
      </div>
    </div>

    <br>
    <?php
    $y = $_GET['year'];
    $tempSQL = '';
    $tempID = "";
    $tQuan = 0;
    $tPrice = 0;
    $ctr = 0;

    $tpriceArray = array();
    $tpriceArray = getAllYeardata();

    $sql = "SELECT *,SUM(b.orderQuantity) as quan FROM tblproduct a, tblorder_request b, tblorders c WHERE a.productID = b.orderProductID and c.orderID = b.tblOrdersID and year(c.dateOfReceived) = '$y' GROUP BY b.orderProductID";
    $result = mysqli_query($conn, $sql);
    echo "<div class='table-responsive'>
    <table class='table color-bordered-table muted-bordered-table reportsDataTable display' id='reportsOut'>
    <thead>
    <tr>
    <th>Product ID</th>
    <th>Date Sold</th>
    <th>Product Name</th>
    <th style='text-align:right'>Product Price</th>
    <th style='text-align:right'>Quantity Ordered</th>
    <th style='text-align:right'>Total</th>
    </tr>
    </thead>
    <tbody>";
    while ($row = mysqli_fetch_assoc($result)){
      $date = date_create($row['dateOfReceived']);
      $date = date_format($date,"F d,Y");
      $prodID = str_pad($row['productID'], 6, '0', STR_PAD_LEFT);
      $total = $row['quan'] * $row['productPrice'];
      $tQuan += $row['quan'];
      $tPrice += $total;
      echo ('<tr><td>'.$prodID.'</td>
        <td>'.$date.'</td>
        <td>'.$row['productName'].'</td>
        <td style="text-align:right">Php '.number_format($row['productPrice'],2).'</td>
        <td style="text-align:right">'.$row['quan'].' pcs</td>
        <td style="text-align:right">Php '.number_format($total,2).'</td>
        </tr>'); 
      $ctr++;
    }

    $tpriceArraylength = count($tpriceArray);
    $dateArray = array("01","02","03","04","05","06","07","08","09","10","11","12");

    echo '
    </tbody>
    <tfoot style="padding-top:10px;">
    <td colspan="4" style="text-align:right;"><b>GRAND TOTAL:</b></td>
    <td id="totalQ" style="text-align:right;"><b>'.$tQuan.' pcs</b></td>
    <td id="totalPrice" style="text-align:right;"><b>'."Php ".number_format($tPrice,2).'</b></td>
    <input type="hidden" value="'.$tPrice.'" id="totalPrice"/>
    </tfoot>
    </table>
    </div>';

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
  $html = ob_get_clean();
  $dompdf = new DOMPDF();
  $dompdf->load_html($html);
  $dompdf->render();
  $dompdf->stream($salesReportID, array("Attachment" => 0));
  ?>