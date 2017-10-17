<?php
session_start();
// set_include_path(get_include_path() . PATH_SEPARATOR . "/path/to/dompdf-master");
// require_once "dompdf/autoload.inc.php";
// use Dompdf\Dompdf;
// ob_start();
$id = $_GET['id'];
?>
<!DOCTYPE html>
<head>
  <title>INV<?php echo $orderID = str_pad($id, 6, '0', STR_PAD_LEFT)?></title>
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
        <table class="table color-bordered-table muted-bordered-table">
          <tr>
            <td><b>Name</b></td>
            <td style="text-align:right;"><?php echo $custRow['customerFirstName'].' '.$custRow['customerMiddleName'].'  '.$custRow['customerLastName'];?></td>
            <td></td>
            <td><b>Contact Number</b></td>
            <td style="text-align:right;"><?php echo $custRow['customerContactNum'];?></td>
          </tr>
          <tr>
            <td><b>Address</b></td>
            <td style="text-align:right;"><?php echo $custRow['customerAddress'];?></td>
            <td></td>
            <td><b>Email Address</b></td>
            <td style="text-align:right;"><?php echo $custRow['customerEmail'];?></td>
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

            $sql1 = "SELECT * FROM tblorder_request a, tblorders b, tblpackages c WHERE c.packageID = a.orderPackageID and b.orderID = a.tblOrdersID and b.orderID = '$id'";
            $res = mysqli_query($conn,$sql1);
            while($row = mysqli_fetch_assoc($res)){
              $orReqID = $row['order_requestID'];
              echo '<tr>
              <td>'.$row['packageDescription'].'</td>
              <td>PACKAGE</td>
              <td style="text-align:right;">Php  '.number_format($row['packagePrice'],2).'</td>
              <td style="text-align:center">'.$row['orderQuantity'].'</td>';
              $tPrice = $row['orderQuantity'] * $row['packagePrice'];
              $tPrice =  number_format($tPrice,2);
              echo '<td style="text-align:right;">Php  '.$tPrice.'</td></tr>';
              $tPrice = $row['orderPrice'];
              $orReqID = $row['order_requestID'];
              $sql3 = "SELECT * FROM tblpackage_orderreq a, tblproduct b WHERE a.por_prID = b.productID and a.por_orReqID = '$orReqID'";
              $res3 = mysqli_query($conn,$sql3);
              while($row3 = mysqli_fetch_assoc($res3)){
                echo '<tr>
                <td style="text-align:right;"> - '.$row3['productName'].'</td>
                <td>'.$row3['productDescription'].'</td>
                <td style="text-align:right;"></td>';
                $tQuan = $tQuan + $row['orderQuantity'] * 1;
                echo '<td style="text-align:right">'.$row['orderQuantity'] * 1 .'</td>
                <td style="text-align:right;"></td></tr>';

              }
            }

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

    <?php
    $down = 0;
    $bal = 0;
    $sql = "SELECT * FROM tblinvoicedetails a, tblpayment_details b, tblorders c WHERE c.orderID = a.invorderID and a.invoiceID = b.invID and c.orderID = '$orderID'";
    $res = mysqli_query($conn,$sql);
    $tpay = 0;
    $delFee = 0;
    $penFee = 0;
    $price = 0;
    $discount = "";
    while($trow = mysqli_fetch_assoc($res)){
      $tpay = $tpay + $trow['amountPaid'];
      $price = $tPrice;
      $delFee = $trow['invDelrateID'];
      $penFee = $trow['invPenID'];
      $discount = $trow['invDiscount'];
    }
    if($discount!=""){
      $disc = $discount;
      $disc = $discount / 100;
      $minus = $price * $disc;
      $price = $price - $minus;
    }
    else{
      $discount = 0;
    }
    $down = $tpay;
    $tPrice1 = $price + $delFee + $penFee;
    $bal = $tPrice1 - $down;
    ?>
    <div class="col-xs-6">
      <span style="text-align: center; font-family: inherit; font-weight: 400; font-size: 15px;">PAYMENT INFORMATION</span>
      <br>
      <div class="table-responsive">
        <table class="table color-bordered-table muted-bordered-table dataTable display nowrap">
          <tr>
            <td>Order Price</td>
            <td style="text-align:right">Php <?php echo number_format($tPrice,2);?></td>
          </tr>
          <tr>
            <td>Discount</td>
            <td style="text-align:right"><?php echo $discount;?> %</td>
          </tr>
          <tr>
            <td>Price</td>
            <td style="text-align:right">Php <?php echo number_format($price,2);?></td>
          </tr>
          <tr>
            <td>Delivery Rate</td>
            <td style="text-align:right">Php <?php echo number_format($delFee,2)?></td>
          </tr>
          <tr>
            <td>Penalty Fee:</td>
            <td style="text-align:right">Php <?php echo number_format($penFee,2)?></td>
          </tr>
          <tr>
            <td>Grand Total</td>
            <td style="text-align:right">Php <?php echo number_format($tPrice1,2)?></td>
          </tr>
        </table>
      </div>
    </div>
    <div class="col-xs-6">
      <span style="text-align: center; font-family: inherit; font-weight: 400; font-size: 15px;">PAYMENT HISTORY</span>
      <br>
      <div class="table-responsive">
        <table class="table color-bordered-table">
          <thead>
            <tr>
              <th style="text-align:left">Date Paid</th>
              <th style="text-align:right">Amount Paid</th>
            </tr>
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
              echo '<tr>
              <td>'.$date.'</td>
              <td style="text-align:right;">Php '.number_format($trow['amountPaid'],2).'</td>
              </tr>';
            }
            $down = $tpay;
            $bal = $tPrice1 - $down;
            ?>
          </tbody>
          <tfoot>
            <tr>
              <td style="text-align:left;"><b> TOTAL AMOUNT PAID</b></td>
              <td style="text-align:right;"><mark><strong><span>Php <?php echo number_format($down,2)?></span></strong></mark></td>
            </tr>
            <tr>
              <td style="text-align:left;"><b> REMAINING BALANCE</b></td>
              <td style="text-align:right; color:red;"><mark><strong><span>Php <?php echo number_format($bal,2)?></span></strong></mark></td>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
</body> 

  <p>
    <?php 
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
    }  
    ?>
  </p>
</html>
<?php
// $html = ob_get_clean();
// $dompdf = new DOMPDF();
// $dompdf->load_html($html);
// $dompdf->render();
// $dompdf->stream($orID, array("Attachment" => 0));
?>