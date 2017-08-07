<?php
$activePage = basename($_SERVER['PHP_SELF'],".php");
include "menu.php";
session_start();
/*if(isset($GET['id'])){
$jsID = $_GET['id']; 
}
*/
$jsID=$_GET['id'];
$payment = $_SESSION['payment'];
//$jsID = $_SESSION['varname'];
include 'dbconnect.php';
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>  
<html lang="en">
<head>
  <title>Point of Sale</title>
  <link rel="icon" type="image/x-icon" sizes="16x16" href="plugins/images/favicon.ico">
</head>
<body class ="fix-header fix-sidebar">
  <!-- Preloader -->
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="panel panel-info">
            <h3>
              <ul class="nav customtab2 nav-tabs" role="tablist">
                <li role="presentation" class="active">
                  <a aria-controls="proorders" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs">Point of Sale</span></a>
                </li>
              </ul>
            </h3>
            <div id="printReceipt">
              <div class="tab-content">
                <!-- brochure -->
                <div role="tabpanel" class="tab-pane fade active in" id="allprod">
                  <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                        <div class="descriptions">
                          <?php
                          $custid = $jsID;
                          $ssql = "SELECT orderID FROM tblorders where custOrderID = '$custid'";
                          $rresult = mysqli_query($conn,$ssql);
                          $xrow = mysqli_fetch_assoc($rresult);
                          $ordId = $xrow['orderID'];
                          $sql = "SELECT * FROM tblcustomer where customerID = '$custid' ;";
                          $result = mysqli_query($conn, $sql);
                          while ($row = mysqli_fetch_assoc($result))
                          {
                            echo ('
                              <h2 style="margin-top:-50px;"><b>OFFICIAL RECEIPT</b><span class="pull-right">#'.$ordId.'</span></h2>
                              <hr>
                              <div class="row">
                                <div class="col-md-12">
                                  <div class="pull-left">
                                    <address>
                                      <h3> &nbsp;<b class="text-danger">Filipiniana Furniture</b></h3>
                                      <p class="text-muted m-l-5">
                                        Aguinaldo Highway, <br>
                                        Talaba II, <br>
                                        Bacoor Cavite</p>
                                      </address>
                                    </div>
                                    <div class="pull-right text-right">
                                      <address>
                                        <h3>To,</h3>
                                        <h4 class="font-bold">'.$row['customerLastName'].','.$row['customerFirstName'].' '.substr($row['customerMiddleName'], 0).' </h4>
                                        <p class="text-muted m-l-30">
                                          '.$row['customerAddress'].'<br>
                                          <br>
                                        </address>
                                      </div>
                                    </div>');
                          }
                          ?>
                          <br><br><br><br><br><br><br><br>
                          <div class="col-md-12">
                            <div class="pull-right text-right">
                              <h4><p>DATE ISSUED: <?php echo date("Y/m/d"); ?></p></h4>
                            </div>
                          </div>
                          <div class="col-md-12">
                            <div class="pull-right text-right">
                              <h4><p>Recieved By:</p></h4>
                              <?php 
                                $emp = $_SESSION['emp'];
                                $sqli = "SELECT * FROM tblemployee;";
                                $sresult = mysqli_query($conn,$sqli);
                                $empRow = mysqli_fetch_assoc($sresult);
                              ?>
                              <h4><p><?php  echo $empRow['empLastName'].', '.$empRow['empFirstName'].' '.substr($empRow['empMidName'], 0, 1).'.'.'';?></p></h4>
                            </div>
                          </div>
                          <div class="col-md-6"><h4>
                            TIN: 319-615-293-000</h4>
                          </div> 
                          <div class="col-md-12"><h4>
                            In <input type="radio" value="Full"> Full <input type="radio" value="Partial"> Partial payment.</h4>
                          </div> 
                          <div class="col-md-6"><h4>
                            Amound Paid: <?php echo $payment /*echo(''.$paid.''); */?></h4>
                          </div>  
                      <?php
//$custid = $_POST['customerid'];
                      $orid = "101010101";
                      $sql = "SELECT * FROM tblcustomer where customerID = '18' ;";
                      $result = mysqli_query($conn, $sql);
                      while ($row = mysqli_fetch_assoc($result))
                      {
                        echo ('
                          <br><br><br>
                          <hr>
                          <br><br>
                          <div>
                            <br><br><br>
                            <h2><b>BILLING</b><span class="pull-right">#'.$orid.'</span></h2>
                            <hr>
                            <div class="row">
                              <div class="col-md-12">
                                <div class="pull-left">
                                  <address>
                                    <h3> &nbsp;<b class="text-danger">Filipiniana Furniture</b></h3>
                                    <p class="text-muted m-l-5">
                                      Aguinaldo Highway, <br>
                                      Talaba II, <br>
                                      Bacoor Cavite</p>
                                    </address>
                                  </div>
                                  <div class="pull-right text-right">
                                    <address>
                                      <h3>To,</h3>
                                      <h4 class="font-bold">'.$row['customerLastName'].','.$row['customerFirstName'].' '.substr($row['customerMiddleName'], 0).' </h4>
                                      <p class="text-muted m-l-30">
                                        '.$row['customerAddress'].'<br>
                                        <br>
                                      </address>
                                    </div>
                                  </div></div>');
                      }
                      ?> 
                      <div class="col-md-12">
                        <div class="table-responsive m-t-40">
                          <table class="table table-hover" style="clear: both; margin-top: -15px;">
                            <thead>
                              <tr>
                                <th>Product Name</th>
                                <th class="text-right">Quantity</th>
                                <th class="text-right">Price</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php 
                              $totalPrice = $_SESSION['PtotalPrice'];
                              $selected = $_SESSION['Pcart'];
                              $selectedQuant = $_SESSION['Pquant'];
                              $selectedPrice = $_SESSION['Pprice'];
                              $tempPrice = 0;
                              $tempQuant = 0;
                              $ctr = 0;
                              $pCtr = 0;
                              $quantarray = array();
                              $pricearray = array();
                              foreach ($selectedQuant as $itemQuant) {
                                array_push($quantarray,$itemQuant);
                              } 
                              foreach ($selectedPrice as $itemPrice) {
                                array_push($pricearray,$itemPrice);
                              }
                              foreach ($selected as $items) {
                                $sql = "SELECT * FROM tblproduct where productID = '$items';";
                                $result = mysqli_query($conn, $sql);
                                if($result){
                                  while ($row = mysqli_fetch_assoc($result))
                                  {
                                    $ctr++; 
                                    $pCtr++;                            
                                    echo ('
                                      <tr>
                                        <td><input id="cart'.$ctr.'" name="cart[]" value="'.$items.'" type="hidden"/>'.$row['productName'].'</td>
                                        <td class="text-right">'.$quantarray[$ctr-1].'</td>
                                        <td id="price'.$ctr.'"  class="text-right">'.$pricearray[$pCtr-1].'</td>
                                      </tr>
                                      ');?>
                                    <?php
                                  }
                                }
                              }
                              ?>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <div class="col-md-12" style="margin-top: -30px;">
                        <div class="pull-right m-t-30 text-right"><h4>
                          <p>Total Amount: <?php echo $totalPrice; ?></p>
                          <p>Amount Paid: <?php echo $payment; ?></p>
                          <hr>
                          <b>Total Balance: </b><?php echo $totalPrice - $payment; ?></h4>
                          <b>Pay the following balance above</b>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                      </div>
                      <div class="row">
                        <button class="fcbtn btn btn-default btn-outline btn-1e col-md-3 pull-right wave effect print-link no-print"><a href="#"><i class="fa fa-print"></i> Print</a></button>
                      </div>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>
</body> 
</html>