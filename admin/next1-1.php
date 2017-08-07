<?php
$activePage = basename($_SERVER['PHP_SELF'],".php");
include "menu.php";
//session_start();
/*if(isset($GET['id'])){
   $jsID = $_GET['id']; 
 }
 $jsID=$_GET['id'];
 $_SESSION['varname'] = $jsID;*/
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
  <title>Order Management</title>
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
                  <a aria-controls="proorders" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs">Order Management</span></a>
                </li>
              </ul>
            </h3>
            <div class="tab-content">
              <!-- brochure -->
              <div role="tabpanel" class="tab-pane fade active in" id="allprod">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <div class="row">
                      <div class="descriptions">
                <?php
                          $custid = $_POST['customerid'];
                          $orid = $_POST['invid'];
                                          $sql = "SELECT * FROM tblcustomer where customerID = '$custid' ;";
                                          $result = mysqli_query($conn, $sql);
                                          while ($row = mysqli_fetch_assoc($result))
                                          {
                
              echo ('
                <h2><b>OFFICIAL RECEIPT</b><span class="pull-right">#'.$orid.'</span></h2>
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
                    <div class="col-md-12">
                        <div class="pull-right text-right">
                            </h4>
                            <p>DATE ISSUED: <?php echo date("Y/m/d"); ?></p></h4>
                        </div>
                        
                    </div>   
                    <div class="col-md-6"><h4>
                        TIN: 319-615-293-000</h4>
                    </div> 
                    <div class="col-md-6"><h4>
                        In <input type="radio" value="Full"> Full <input type="radio" value="Partial"> Partial payment.</h4>
                    </div> 
                    <div class="col-md-6"><h4>
                        Amound Paid: <?php $paid = $_POST['payment']; echo(''.$paid.''); ?></h4>
                    </div>  
                    <div class="col-md-6"><h4>
                        Received by: <select id="emp" style="height:40px;" class="form-control" data-placeholder="Choose Employee" tabindex="1" name="emp"> <option value="" ></option>
                                    
                                    <?php
                                    $delsql = "SELECT * FROM tblemp;";
                                    $delresult = mysqli_query($conn,$delsql);
                                        
                                        while($delrow = mysqli_fetch_assoc($delresult)){
                                            echo('<option value="'.$delrow['empID'].'">'.$delrow['empLastName'].','.$delrow['empFirstName'].','.$delrow['empMidName'].'</option>');
                                        }
                                    ?>
                        </select>
                        </h4>
                        <br><br>
                    </div> 
                          
                      <?php
                          $custid = $_POST['customerid'];
                          $orid = $_POST['invid'];
                                          $sql = "SELECT * FROM tblcustomer where customerID = '$custid' ;";
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
                        <div class="table-responsive m-t-40" style="clear: both;">
                        <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Product Name</th>
                            <th class="text-right">Price</th>
                            <th class="text-right">Quantity</th>
                            <th class="text-right">Total Price</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 

                  $selected = $_POST['cart'];
                  $selectedQuant = $_POST['quant'];
                  $selectedPrice = $_POST['price'];
                  $tempPrice = $_POST['totalPrice'];

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
                            <td><input id="cart" name="cart[]" value="'.$items.'" type="hidden"/>'.$row['productName'].'</td>
                            <td class="text-right">'.$row['prodSizeSpecs'].'</td>
                            <td class="text-right"><input id="quant" name="quant[]" value="'.$quantarray[$ctr-1].'" type="hidden"/>'.$quantarray[$ctr-1].'</td>
                            <td id="price" class="text-right">'.$pricearray[$pCtr-1].'</td>
                          </tr>
                                  ');
                                  }
                                  }
                              }
                            
                          ?>
                    </tbody>
                  </table>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="pull-right m-t-30 text-right"><h4>
                          <p>Total amount: <?php echo (''.$tempPrice.''); ?></p>
                          <p>Amount Paid : <?php $paid=$_POST['payment'];
                              echo (''.$paid.''); ?> </p>
                          <hr>
                          <b>Total Balance:</b> <?php $balance=$_POST['bal'];
                              echo (''.$balance.''); ?></h4>
                        
                        <b>Pay the following balance above</b>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                      <button class="fcbtn btn btn-default btn-outline btn-1e col-md-3 pull-right wave effect"><a href="officialreceiptandbill.php"><i class="fa fa-print"></i> Print</a></button>
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
