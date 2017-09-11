
<?php
set_include_path(get_include_path() . PATH_SEPARATOR . "/path/to/dompdf-master");
require_once "dompdf/autoload.inc.php";
use Dompdf\Dompdf;
ob_start();
?>
<!DOCTYPE html>
<head>
  <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<?php 
$id = $_GET['id'];
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
          <p style="text-align: center; font-family: inherit; font-weight: bolder; font-size: 20px;">- B I L L -</p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div style="text-align: center;">
          <?php
          include "dbconnect.php";
          $sql = "SELECT * FROM tblcustomer a, tblorders b WHERE a.customerID = b.custOrderID and b.orderID = '$id'";
          $res = mysqli_query($conn,$sql);
          $custRow = mysqli_fetch_assoc($res);
          ?>
          <span style="text-align: center; font-family: inherit; font-weight: bolder; font-size: 20px;">INV#<?php $orderID = str_pad($id, 6, '0', STR_PAD_LEFT); echo $orderID;
          $orID = "OR". $orderID;?></span>
        </div>
      </div>
    </div>

    <br>
    <div class="row">
      <div class="col-xs-12">
       <span style="text-align: center; font-family: inherit; font-weight: 400; font-size: 15px;">CUSTOMER INFORMATION</span>
       <br>
       <div class="table-responsive">
        <table class="table color-bordered-table muted-bordered-table dataTable display nowrap">
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
          <tr>
            <td>Email Address</td>
            <td><?php echo $custRow['customerEmail'];?></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-xs-12">
      <span style="text-align: center; font-family: inherit; font-weight: 400; font-size: 15px;">PARTICULARS</span>
      <br>
      <div class="table-responsive">
        <table class="table color-bordered-table muted-bordered-table dataTable display nowrap">
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

            $sql1 = "SELECT * FROM tblorder_request a, tblorders b, tblproduct c WHERE c.productID = a.orderProductID and b.orderID = a.tblOrdersID and b.orderID = '$id'";
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
            <tr style="text-align:right;">
              <td></td>
              <td colspan="2" style="text-align:right;"><b>GRAND TOTAL:</b></td>
              <td id="totalQ"><?php echo $tQuan?></td>
              <td id="totalPrice"><?php echo "Php  ". number_format($tPrice,2)?></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div> 
  </div>
  <br>

  <div class="row">
    <div class="col-md-6">
      <span style="text-align: center; font-family: inherit; font-weight: 400; font-size: 15px;">PAYMENT HISTORY</span>
      <br>
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
          $sql = "SELECT * FROM tblinvoicedetails a, tblpayment_details b, tblorders c, tblmodeofpayment d WHERE c.orderID = a.invorderID and d.modeofpaymentID = b.mopID and a.invoiceID = b.invID and c.orderID = '$id'";
          $res = mysqli_query($conn,$sql);
          $tpay = 0;
          while($trow = mysqli_fetch_assoc($res)){
            $date = date_create($trow['dateCreated']);
            $date = date_format($date,"F d, Y");
            $tpay = $tpay + $trow['amountPaid'];
            echo '<tr><td>'.$date.'</td>
            <td>'.$trow['modeofpaymentDesc'].'</td>
            <td style="text-align:right;">Php '.number_format($trow['amountPaid'],2).'</td>
            </tr>';
          }
          $down = $tpay;
          $bal = $tPrice - $down;
          ?>
          <tr>
            <td colspan="2" style="text-align:right;"><i class="fa fa-caret-right text-info"></i><b> TOTAL AMOUNT PAID</b></td>
            <td style="text-align:right;"><mark><strong><span>Php <?php echo number_format($down,2)?></span></strong></mark></td>
          </tr>
        </tbody>
      </table>
    </div>
    </div>

    <?php
    $down = 0;
    $bal = 0;
    $sql = "SELECT * FROM tblinvoicedetails a, tblpayment_details b, tblorders c WHERE c.orderID = a.invorderID and a.invoiceID = b.invID and c.orderID = '$id'";
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
      <span style="text-align: center; font-family: inherit; font-weight: 400; font-size: 15px;">PAYMENT INFORMATION</span>
      <br>
      <div class="table-responsive">
        <table class="table color-bordered-table muted-bordered-table dataTable display nowrap">
          <tr>
            <td>Total Amount Due:</td>
            <td>Php <?php echo number_format($tPrice,2)?></td>
          </tr>
          <tr>
            <td>Amount Paid</td>
            <td>Php <?php echo number_format($down,2)?></td>
          </tr>
          <tr>
            <td>Remaining Balance:</td>
            <td style="color:red">Php <?php echo number_format($bal,2)?></td>
          </tr>
        </table>
      </div>
    </div>
  </div>

</body> 
</html>

<?php
$html = ob_get_clean();
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream($orID, array("Attachment" => 0));
?>