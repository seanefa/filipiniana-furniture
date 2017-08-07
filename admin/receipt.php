
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
<body style="margin:20px;" class="center">
  <div style="text-align:center">
    <header>
      <div class="pull-left">
        <img height="115pt" src="plugins/images/<?php echo $row['comp_logo'];?>"/>
      </div>
      <div class="pull-left">
        <h1 style="text-align:left"> <?php echo $row['comp_name'];?> </h1>
        <h5 style="text-align:left"><?php echo $row['comp_address'];?></h5>
        <h5 style="text-align:left"><?php echo $row['comp_num'];?></h5>
      </div>
      <div class="pull-right">
        <label>OR#<?php $orderID = str_pad($id, 6, '0', STR_PAD_LEFT); echo $orderID;
                    $orID = "OR". $orderID;?></label>
        <?php
        include "dbconnect.php";
        $sql = "SELECT * FROM tblcustomer a, tblorders b WHERE a.customerID = b.custOrderID and b.orderID = '$id'";
        $res = mysqli_query($conn,$sql);
        $custRow = mysqli_fetch_assoc($res);
        ?>
      </div>
    </header>
  </div>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <br>
  <div class="row col-md-6 center">
    <label class="form-control">Customer Information</label>
    <div class="table">
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
  <div class="row col-md-6 center">
    <label class="form-control">Order Information</label>
    <div class="table">
      <table class="table color-bordered-table muted-bordered-table dataTable display nowrap">
        <thead>
          <tr>
          <th style="text-align:center">Furniture Name</th>
          <th style="text-align:center">Furniture Description</th>
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
        </tbody>
        <tfoot style="text-align:right;">
          <td></td>
          <td colspan="2" style="text-align:right;"><b> GRAND TOTAL</b></td>
          <td id="totalQ" style="text-align:right;"><?php echo $tQuan?></td>
          <td id="totalPrice" style="text-align:right;"><?php echo "Php  ". number_format($tPrice,2)?></td>
        </tfoot>
      </table>
    </div>
    </div> <?php
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

    <div class="row col-md-6 center">
      <label class="form-control">Payment Information</label>
      <div class="table">
        <table class="table color-bordered-table muted-bordered-table dataTable display nowrap">
          <tr>
            <td>Total Amount Due:</td>
            <td>Php <?php echo number_format($tPrice,2)?></td>
          </tr>
          <tr>
            <td>Downpayment:</td>
            <td>Php <?php echo number_format($down,2)?></td>
          </tr>
          <tr>
            <td>Remaining Balance:</td>
            <td>Php <?php echo number_format($bal,2)?></td>
          </tr>
        </table>
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