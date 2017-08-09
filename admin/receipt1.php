
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
  <header>
      <div class="pull-left">
        <img height="115pt" src="plugins/images/<?php echo $row['comp_logo'];?>"/>
      </div>
      <div class="pull-left">
        <h1 style="text-align:left"><?php echo $row['comp_name'];?> </h1>
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
    <br><br><br><br>
    <div class="jumbtron-fluid">
      <div class="row">
        <hr>
        <h3 class="text-center"><b>RECEIPT</b></h3>
        <hr>
      </div>
    </div>
    <br>
    <?php
    include "dbconnect.php";
    $sql="SELECT * from tblcompany_info";
    $result=$conn->query($sql);
    if($result->num_rows>0)
    {
      while($row=$result->fetch_assoc())
      {
    ?>
    <div class="container">
      <div class="row justify-content-center">
        <div class="bond-paper border-web">
          <div class="row">
            <div class="col-md-5 col-lg-5 col-xl-5">
              <table class="table table-bordered table-reflow">
                <thead>
                  <tr>
                    <th class="text-center" colspan="3">Payment of the following:</th>
                  </tr>
                  <tr>
                    <th>PARTICULARS</th>
                    <th colspan="2">Amount</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <th>Amount Due</th>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <th>Less: SC/PWD Discount</th>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <th>TOTAL AMOUNT DUE</th>
                    <td colspan="2"></td>
                  </tr>
                  <tr>
                    <th colspan="3" class="text-center">Payment in the form of</th>
                  </tr>
                  <tr>
                    <td>Cash</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr>
                    <td colspan="3">CHECK No.</td>
                  </tr>
                  <tr>
                    <td colspan="3">Bank</td>
                  </tr>
                  <tr>
                    <th colspan="3">TOTAL AMOUNT DUE</th>
                  </tr>
                </tbody>
              </table>
            </div>
            <div class="col-md-7 col-lg-7 col-xl-7">
            <?php
            include "dbconnect.php";
            $sql="SELECT * from tblcompany_info";
            $date=date("Y/m/d");
            $result=$conn->query($sql);
            if($result->num_rows>0)
            {
              while($row=$result->fetch_assoc())
              {
            ?>
              <h1 class="text-center"><?php echo "" . $row["comp_name"];?></h1>
              <p class="text-center"><?php echo "" . $row["comp_address"];?></p>
              <hr>
              <h3 class="text-center"><u><b>OFFICIAL RECEIPT</b></u></h3><br>
              <p class="text-right">Date:&nbsp;<b><?php echo "" . $date;?></b></p>
              <h4>RECEIVED FROM:</h4>
              <p>Address:</p>
              <b>TIN</b><br><br>
              <p>engaged in the Business style of<b></b></p>
              <b>The sum of (Php)</b><br><br>
              <p>in <b>full[&nbsp;&nbsp;&nbsp;] partial[&nbsp;&nbsp;&nbsp;]</b> payment of:</p>
              <br>
              <hr>
              <br>
              <div class="row">
                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                  <b>Sr Citizen TIN: .....................................</b><br>
                  <b>OSCA/PWD ID No.: ............................</b><br><br>
                  <b>Signature: ..................................</b>
                </div>
                <div class="col-6 col-sm-6 col-md-6 col-lg-6 col-xl-6">
                  <b><i>Issued By:</i></b><br><br>
                  <span class="text-center">_____________________________________</span><br>
                  <h4 class="text-center"><b>Authorized Signature</b></h4>
                </div>
              </div>
              <br><br><br><br><br>
              <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                  <p class="text-center">"This Document is not Valid for Claiming Input Taxes"<br>This Official Receipt shall be valid for five(5) years from the dateof ATP.</p>
                </div>
              </div>
            <?php
              }
            }
            ?>
            </div>
          </div>
        </div>  
      </div>
    </div>
    <?php
      }
    }
    $conn->close();
    ?>
    <br>
  </body>
</html>
<?php
$html = ob_get_clean();
$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->render();
$dompdf->stream("resibo.php", array("Attachment" => 0));
?>