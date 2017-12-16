
<?php
$id = $_GET['id'];
$or = str_pad($id, 6, '0', STR_PAD_LEFT);
$orID = "DR". $or;

set_include_path(get_include_path() . PATH_SEPARATOR . "/path/to/plugins/bower_components/dompdf-master");
require_once "plugins/bower_components/dompdf/autoload.inc.php";
use Dompdf\Dompdf;
ob_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo $orID?></title>
  <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<?php 
$id = $_GET['id'];
include "dbconnect.php";
$sql = "SELECT * FROM tblcompany_info";
$res = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($res);
$relID = "SELECT * FROM tbldelivery a, tblrelease b WHERE a.deliveryReleaseID = b.releaseID and a.deliveryID = '$id'";
$orRes = mysqli_query($conn,$relID);
$orRoq = mysqli_fetch_assoc($orRes);
$relID = $orRoq['releaseID'];
$delRate = $orRoq['deliveryRate'];

$orderID = "SELECT * FROM tbldelivery d, tblrelease_details c , tblorders a, tblorder_request b WHERE c.rel_orderReqID = b.order_requestID and b.tblOrdersID = a.orderID and d.deliveryID = c.rel_detailsID and d.deliveryID = '$id'";
$orRes = mysqli_query($conn,$orderID);
$orRoq = mysqli_fetch_assoc($orRes);
$orderID = $orRoq['orderID'];
?>
<body>
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
        <p style="text-align: center; font-family: inherit; font-weight: bolder; font-size: 20px;">- DELIVERY RECEIPT -</p>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-6">
      <?php
      include "dbconnect.php";
      $sql = "SELECT * FROM tblcustomer a, tblorders b WHERE a.customerID = b.custOrderID and b.orderID = '$orderID'";
      $res = mysqli_query($conn,$sql);
      $custRow = mysqli_fetch_assoc($res);
      $date  = date("F d, Y");
      ?>
      <p style="text-align: center; font-family: inherit; font-weight: bolder; font-size: 20px;">Date Issued:&nbsp;<b>
        <?php echo "" . $date;
        ?>
      </b></p>
    </div>
    <div class="col-xs-6">
      <span style="text-align: center; font-family: inherit; font-weight: bolder; font-size: 20px;">DR # 
        <?php 
        $or = str_pad($id, 6, '0', STR_PAD_LEFT); 
        echo $or;
        $orID = "DR". $or;?></span>
      </div>
    </div>
    <br>
    <div class="row">
      <div class="col-xs-12">
       <span style="text-align: center; font-family: inherit; font-weight: 400; font-size: 15px;">CUSTOMER INFORMATION</span>
       <br>
       <div class="table-responsive">
        <table class="table color-bordered-table muted-bordered-table">
          <tr>
            <td>Name</td>
            <td><?php echo $custRow['customerFirstName'].' '.$custRow['customerMiddleName'].'  '.$custRow['customerLastName'];?></td>
          </tr>
          <tr>
            <td>Address</td>
            <td><?php echo $custRow['customerAddress'];?></td>
          </tr>
          <tr>
            <td>Contact Number</td>
            <td><?php echo $custRow['customerContactNum'];?></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  <br>
  <div class="row">
    <div class="col-xs-12">
      <span style="text-align: center; font-family: inherit; font-weight: 400; font-size: 15px;">PARTICULARS</span>
      <br>
      <div class="table-responsive">
        <table class="table color-bordered-table muted-bordered-table">
          <thead>
            <tr>
              <th>Furniture Name</th>
              <th>Furniture Description</th>
              <th style="text-align:right;">Unit Price</th>
              <th style="text-align:right;">Quantity</th>
              <th style="text-align:right;">Total Price</th>
            </tr>
          </thead>
          <tbody>
            <?php
            include "dbconnect.php";
            $tQuan = 0;
            $tPrice = 0;
            $sql1 = "SELECT * FROM tbldelivery d, tblrelease_details c , tblorders a, tblorder_request b , tblpackages e WHERE c.rel_orderReqID = b.order_requestID and b.tblOrdersID = a.orderID and d.deliveryID = c.rel_detailsID and e.packageID = b.orderPackageID and d.deliveryID = '$id'";
            $res = mysqli_query($conn,$sql1);
            while($row = mysqli_fetch_assoc($res)){
              echo '<tr>
              <td>'.$row['packageDescription'].'</td>
              <td>PACKAGE</td>
              <td style="text-align:right;">Php  '.number_format($row['packagePrice'],2).'</td>
              <td style="text-align:right;">'.$row['orderQuantity'].'</td>';
              $tPrice = $row['orderQuantity'] * $row['packagePrice'];
              $tPrice =  number_format($tPrice,2);
              echo '<td style="text-align:right;">Php  '.$tPrice.'</td></tr>';
              $tPrice = $row['orderPrice'];
              $tQuan = $tQuan + $row['orderQuantity'];
            }

            $sql1 = "SELECT * FROM tbldelivery d, tblrelease_details c , tblorders a, tblorder_request b , tblproduct e WHERE c.rel_orderReqID = b.order_requestID and b.tblOrdersID = a.orderID and d.deliveryID = c.rel_detailsID and e.productID = b.orderProductID and d.deliveryID = '$id'";
            $res = mysqli_query($conn,$sql1);
            while($row = mysqli_fetch_assoc($res)){
              echo '<tr>
              <td>'.$row['productName'].'</td>
              <td>'.$row['productDescription'].'</td>
              <td style="text-align:right;">Php  '.number_format($row['productPrice'],2).'</td>
              <td style="text-align:right;">'.$row['orderQuantity'].'</td>';
              $tPrice = $row['orderQuantity'] * $row['productPrice'];
              $tPrice =  number_format($tPrice,2);
              echo '<td style="text-align:right;">Php  '.$tPrice.'</td></tr>';
              $tPrice = $row['orderPrice'];
              $tQuan = $tQuan + $row['orderQuantity'];
            }
            ?>
            <?php
          $down = 0;
          $bal = 0;
          $sql = "SELECT * FROM tblinvoicedetails a, tblpayment_details b, tblorders c WHERE c.orderID = a.invorderID and a.invoiceID = b.invID and c.orderID = '$orderID'";
          $res = mysqli_query($conn,$sql);
          $tpay = 0;
          while($trow = mysqli_fetch_assoc($res)){
            $tpay = $tpay + $trow['amountPaid'];
          }
          $down = $tpay;
          $bal = $tPrice - $down;

          ?>
            <tr style="text-align:right;">
              <td></td>
              <td colspan="2" style="text-align:right;"><b>TOTAL:</b></td>
              <td id="totalQ"><?php echo $tQuan?></td>
              <td id="totalPrice"><?php echo "Php  ". number_format($tPrice,2)?></td>
            </tr>
            <tr style="text-align:right;">
              <td></td>
              <td colspan="2" style="text-align:right;"><b>DELIVERY RATE:</b></td>
              <td></td>
              <td><?php echo "Php  ". number_format($delRate,2)?></td>
            </tr>
            <tr style="text-align:right;">
              <td></td>
              <td colspan="2" style="text-align:right;"><b>REMAINING BALANCE:</b></td>
              <td></td>
              <td style="color:red"><?php echo "Php  ". number_format($bal,2)?></td>
            </tr>
            <tr style="text-align:right;">
              <td></td>
              <td colspan="2" style="text-align:right;"><b>GRAND TOTAL (TO PAY):</b></td>
              <td></td>
              <td><?php $gt = $bal + $delRate; echo "Php  ". number_format($gt,2)?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div> 
  </div>
  <br>
  <div class="col-md-6 pull-right">
    <b><i>Issued By:</i></b>
    <br>
    <br>
    <span >_____________________________________</span>
    <br>
    <h4><b>Authorized Signature</b></h4>
  </div>
  <br><br>
  <div class="row">
    <div class="col-md-12">
      <p>"This Document is not Valid for Claiming Input Taxes"<br>This Official Receipt shall be valid for five(5) years from the dateof ATP.</p>
        
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
<script src="bootstrap/dist/js/bootstrap.min.js"></script> 
</html>
<?php
$html = ob_get_clean();
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream($orID, array("Attachment" => 0));
?>