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
  <title>Transactions</title>
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
                  <a href="#proorders" aria-controls="proorders" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs">Order Management</span></a>
                </li>
              </ul>
            </h3>
            <div class="tab-content">
              <!-- orders -->
              <div role="tabpanel" class="tab-pane fade active in" id="proorders">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <div class="row">
                      <div class="col-md-8">
                        <form class="navbar-form navbar-right" role="search">
                          <div class="input-group" style="margin-top:-40px;">
                            <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term" size="40">
                            <div class="input-group-btn">
                              <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div> 
                    <div class="row">
                      <button class="fcbtn btn btn-default btn-outline btn-1e col-md-2 pull-right wave effect" data-toggle="modal" href="#chout1" style="margin-right: 35px;">Check-out</button>
                    </div>
                    <div class="row">
                      <?php
                      include "dbconnect.php";
                      $chair = array("chair","chair3","chair5");
                                // Create connection
                      $conn = mysqli_connect($servername, $username, $password, $dbname);
                                // Check connection
                      if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                      }
                      $tempID = "";
                      $sql = "SELECT * FROM tblproduct order by productID desc;";
                      $result = mysqli_query($conn, $sql);
                      if($result){
                        while ($row = mysqli_fetch_assoc($result))
                        {
                          $random = rand(0,2);
                          if($row['productDescription']==""){$row['productDescription']="________________";}
                          if($row['prodStat'] == "On-Hand"){
                           echo ('
                            <form method="get" id="formProduct">
                              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="white-box">
                                  <div class="product-img">
                                    <img height="150px" src="plugins/images/'.$row['prodMainPic'].'"/>') ?>
                                    <div class="pro-img-overlay">
                                      <!-- VIEW -->
                                      <button type="button" class="btn btn-info" data-toggle="modal" href="prod-forms.php" data-remote="prod-forms.php?id=<?php echo $row['productID'];?> #view" data-target="#myModal" value=" <?php echo $row['productID'] ?> ">View</button><br><br>
                                      <button type="button" class="btn btn-info" data-toggle="modal" value=" <?php echo $row['productID'] ?> ">Add to Cart</button>
                                    </div>
                                  </div>
                                 <?php echo('
                                   <div class="product-text">
                                    <span class="pro-price bg-danger">&#8369;'.$row['productPrice'].'</span>
                                    <h3 class="box-title m-b-0">'.substr($row['productName'], 0,20).'</h3>
                                    <label>Quantity</label><input type="number" class="form-control" step="1" id="orderqua" name="quantity" style="text-align: right; width:65px;" required/><small class="text-muted db">'.substr($row['productDescription'],0,35).'</small>
                                  </div>
                                </div>
                              </div>
                            </form>
                            ');          
                                }
                              }
                            }            ?> 
                      </div>
                    </div>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>

        </div>
      </div>
                  
        <!-- Checkout1 -->
        <div class="modal fade" tabindex="-1" role="dialog" id="chout1" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
        <div class="modal-content" id="checkout1">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 class="modal-title" id="modalProduct">Confirm Order</h3>
          </div>
          <div class="modal-body">
            <div class="descriptions">
              <form action="add-customer.php" method = "post">
                <div class="form-body">
                    <h4>Customer Information:</h4>
                    <div class="row">
                        <div class="col-md-4">
                         Existing Customer Information? <select style="height:40px;" class="form-control" data-placeholder="Choose Customer Name" tabindex="1" name="customer">
                                          <?php
                                          $sql = "SELECT * FROM tblcustomer;";
                                          $result = mysqli_query($conn, $sql);
                                          while ($row = mysqli_fetch_assoc($result))
                                          {
                                              echo('<option value='.$row['customerID'].'>'.$row['customerLastName'].', '.$row['customerFirstName'].', '.$row['customerMiddleName'].'</option>');
                                          }
                                          ?>
                                        </select>
                        </div>
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4">
                        </div>
                    </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label">Last Name:</label>
                        <input type="text" id="ln" class="form-control" name="ln" required/> </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">First Name:</label>
                          <input type="text" id="fn" class="form-control" name="fn"/> 
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Middle Name:</label>
                          <input type="text" id="mn" class="form-control" name="mn"/> 
                        </div>
                      </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="control-label">Address</label>
                            <input type="text" id="custadd" class="form-control" name="custadd" /> </div>
                          </div>
                        </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label">Contact number</label>
                          <input type="number" id="custcont" class="form-control" name="custcont" required/> </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label">Email</label>
                            <input type="email" id="custemail" class="form-control" name="custemail" required/> 
                          </div>
                        </div>
                      </div>
                        <div class="modal-footer">
                          <button type="button" type="submit" class="btn btn-default btn-next"> Next</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                      </div> 
                  </div>
                </div>
              </div>
            </div>
        </div>
        <!-- checkout2 -->
        <div class="modal fade" tabindex="-1" role="dialog" id="chout2" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
        <div class="modal-content" id="checkout2">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 class="modal-title" id="modalProduct">Confirm Order</h3>
          </div>
          <div class="modal-body">
            <div class="descriptions">
                <div class="form-body">
                    <h4>Order Information:</h4>
                    <div class="row">
                        <div class="col-md-12">
                        <div class="table-responsive m-t-40" style="clear: both;">
                        <table class="table table-hover">
                        <thead>
                          <tr>
                            <th class="text-center">#</th>
                            <th>Product Name</th>
                            <th class="text-right">Price</th>
                            <th class="text-right">Quantity</th>
                            <th class="text-right">Size</th>
                            <th class="text-right">Total Price</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="text-center">1</td>
                            <td>Yellow Seat</td>
                            <td class="text-right"> ₱5000 </td>
                            <td class="text-right"> 2 </td>
                            <td class="text-right"> 34,24,34 </td>
                            <td class="text-right"> ₱10000 </td>
                          </tr>
                          <tfoot>
                              <td> TOTAL </td>
                              <td></td>
                              <td></td>
                          </tfoot>
                    </tbody>
                  </table>
                </div>
                    <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="control-label">Order Remarks</label>
                            <input type="datetime" id="orderremarks" class="form-control" name="orderremarks"/> 
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="control-label">Order Status</label>
                            <input type="text" id="stats" class="form-control" name="stats"/> 
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="control-label">Pick up/Delivery Date</label>
                            <input type="datetime" id="dppate" class="form-control" name="pddate"/> 
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Delivery Address</label>
                                <input type="text" id="deladd" class="form-control" name="deladd"/>
                            </div>
                        </div>
                    </div>
                    </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default btn-prev"> Prev</button>
                          <button type="submit" class="btn btn-success waves effect text-left" value="Save"> <i class="fa fa-check"></i> Save</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                      </div> 
                    </form>
                  </div>
                </div>
              </div>
            </div>
            </div>
            </div>
            <script>
                $("div[id^='chout']").each(function(){

              var currentModal = $(this);

              //click next
              currentModal.find('.btn-next').click(function(){
                currentModal.modal('hide');
                currentModal.closest("div[id^='chout']").nextAll("div[id^='chout']").first().modal('show'); 
              });

              //click prev
              currentModal.find('.btn-prev').click(function(){
                currentModal.modal('hide');
                currentModal.closest("div[id^='chout']").prevAll("div[id^='chout']").first().modal('show'); 
              });

            });
        </script>
        
        <!-- production tracking -->
        <div class="modal fade" tabindex="-1" role="dialog" id="ptrack" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
        <div class="modal-content" id="prodtrack">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 class="modal-title" id="modalProduct">Production Tracking</h3>
          </div>
          <div class="modal-body">
            <div class="descriptions">
                <div class="form-body">
                    <h4>Product Information Status:</h4>
                    <div class="row">
                        <div class="col-md-12">
                        <div class="table-responsive m-t-40" style="clear: both;">
                        <table class="table table-hover">
                        <thead>
                          <tr>
                            <th class="text-center">#</th>
                            <th>Product Name</th>
                            <th class="text-right">Production Phase</th>
                            <th class="text-right">Worker Assigned</th>
                            <th class="text-right">Quantity</th>
                            <th class="text-right">Order Status</th>
                            <th class="text-right">Completion Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="text-center">1</td>
                            <td>Manillenia Chair</td>
                            <td class="text-right"> Carpentry </td>
                            <td class="text-right"> Joe Santos </td>
                            <td class="text-right"> 5 </td>
                            <td class="text-right"> Paid </td>
                            <td class="text-right"> <progress value="50" max="100"></progress> </td>
                          </tr>
                          <tr>
                            <td class="text-center">2</td>
                            <td>Yellow Seat</td>
                            <td class="text-right"> Carving </td>
                            <td class="text-right"> Mike Cruz </td>
                            <td class="text-right"> 2 </td>
                            <td class="text-right"> Paid </td>
                            <td class="text-right"> <progress value="20" max="100"></progress> </td>
                          </tr>
                         <tr>
                            <td class="text-center">3</td>
                            <td>Snow Couch</td>
                            <td class="text-right"> Upholstery </td>
                            <td class="text-right"> Carlos Cruz </td>
                            <td class="text-right"> 1 </td>
                            <td class="text-right"> Paid </td>
                            <td class="text-right"> <progress value="75" max="100"></progress> </td>
                          </tr>
                    </tbody>
                  </table>
                </div>
                 <button class="btn btn-default waves effect" data-toggle="modal" data-dismiss="modal" href="#update"> <i class="fa fa-check"></i> Update Production Progress </button>
                    </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                      </div> 
                    </form>
                  </div>
                </div>
              </div>
            </div>
            </div>
            </div>
      <!--update progress-->
        <div class="modal fade" tabindex="-1" role="dialog" id="update" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
        <div class="modal-content" id="uprog">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 class="modal-title" id="modalProduct">Update Production</h3>
          </div>
          <div class="modal-body">
            <div class="descriptions">
              <form action="add-customer.php" method = "post">
                <div class="form-body">
                    <h4>Product Information:</h4>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label">Name:</label>
                         <select class="form-control" tabindex="1" name="_category">
                                          <?php
                                          $sql = "SELECT * FROM tblproduct;";
                                          $result = mysqli_query($conn, $sql);
                                          while ($row = mysqli_fetch_assoc($result))
                                          {
                                              echo('<option value='.$row['productID'].'>'.$row['productName'].'</option>');
                                          }
                                          ?>
                                        </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Phase:</label>
                          <select class="form-control" tabindex="1">
                            <option value="carving">Carving</option>
                            <option value="carpentry">Carpentry</option>
                            <option value="upholstery">Upholstery</option>
                            <option value="varnishing">Varnishing</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Assign Worker:</label>
                            <select class="form-control" tabindex="1" >
                                          <?php
                                          $sql = "SELECT * FROM tblemployee;";
                                          $result = mysqli_query($conn, $sql);
                                          while ($row = mysqli_fetch_assoc($result))
                                          {
                                              echo('<option value='.$row['empID'].'>'.$row['empLastName'].','.$row['empFirstName'].'</option>');
                                          }
                                          ?>
                                        </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label">Order Status:</label>
                          <select class="form-control" tabindex="1" name="stats">
                              <option value="paid">Paid</option>
                              <option value="balance">Existing Payment Balance</option>
                          </select>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label">Completion Status:</label>
                            <input type="num" id="custemail" class="form-control" name="custemail" required/> 
                          </div>
                        </div>
                      </div>
                        <div class="modal-footer">
                          <button type="submit" class="btn btn-success waves effect text-left" value="Save"><i class="fa fa-check"></i> Save</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                      </div> 
                  </div>
                </div>
              </div>
            </div>
        </div>
        <!-- Receipt -->
        <div class="modal fade" tabindex="-1" role="dialog" id="savereceipt" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
          <div class="modal-content" id="saveReceipt">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h3 class="modal-title" id="modalProduct"></h3>
            </div>
            <div class="modal-body">
              <div class="descriptions">
                <?php
                //$rsql = "SELECT * FROM tblfabrics WHERE fabricID = $jsID";
                //$rresult = mysqli_query($conn,$rsql);
                //$rrow = mysqli_fetch_assoc($rresult);
                ?>

                <h3><b>RECEIPT</b><span class="pull-right">#5669626</span></h3>
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
                          <h4 class="font-bold"> Publico, Doc </h4>
                          <p class="text-muted m-l-30">
                            123 Sesame st. <br>
                            Sim city <br>
                          </address>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="table-responsive m-t-40" style="clear: both;">&gt;
                        <table class="table table-hover">
                        <thead>
                          <tr>
                            <th class="text-center">#</th>
                            <th>Product Name</th>
                            <th class="text-right">Price</th>
                            <th class="text-right">Quantity</th>
                            <th class="text-right">Size</th>
                            <th class="text-right">Total Price</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td class="text-center">1</td>
                            <td>Yellow Seat</td>
                            <td class="text-right"> ₱5000 </td>
                            <td class="text-right"> 2 </td>
                            <td class="text-right"> 34,24,34 </td>
                            <td class="text-right"> ₱10000 </td>
                          </tr>
                    </tbody>
                  </table>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="pull-right m-t-30 text-right">
                          <p>Sub - Total amount: ₱10,000</p>
                          <p>vat (10%) : ₱1000 </p>
                          <hr>
                          <h3><b>Total :</b> $11,000</h3>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-success waves-effect text-left" data-dismiss="modal"><i class="fa fa-check"></i> Ok</button>
                  <button id="print" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
                </div>
              </div>
            </div>
          </div>
          <!-- /.modal -->
                  <!-- /.modal -->
            
                  <!-- View Delivery Details Modal -->
                  <div class="modal fade" tabindex="-1" role="dialog" id="viewdeliverydetails" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content" id="viewDeliveryDetails">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                          <h3 class="modal-title" id="modalProduct">Order Information</h3>
                        </div>
                        <div class="modal-body">
                          <div class="descriptions">
                           <?php
            //$rsql = "SELECT * FROM tblfabrics WHERE fabricID = $jsID";
            //$rresult = mysqli_query($conn,$rsql);
            //$rrow = mysqli_fetch_assoc($rresult);
                           ?>

                           <div class="row">
                            <div class="col-md-12">
                              <div class="pull-left">
                                <address>
                                  <h3> &nbsp;<b class="text-danger">Filipiniana Furniture</b></h3>
                                  <p class="text-muted m-l-5">E 104, Dharti-2, <br>
                                    Nr' Viswakarma Temple, <br>
                                    Talaja Road, <br>
                                    Bhavnagar - 364002</p>
                                  </address>
                                </div>
                                <div class="pull-right text-right">
                                  <address>
                                    <h3>To,</h3>
                                    <h4 class="font-bold">Gaala &amp; Sons,</h4>
                                    <p class="text-muted m-l-30">E 104, Dharti-2, <br>
                                      Nr' Viswakarma Temple, <br>
                                      Talaja Road, <br>
                                      Bhavnagar - 364002</p>
                                    </address>
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="table-responsive m-t-40" style="clear: both;">&gt;
                                    <table class="table table-hover">
                                      <thead>
                                        <tr>
                                          <th class="text-center">#</th>
                                          <th>Description</th>
                                          <th class="text-right">Quantity</th>
                                          <th class="text-right">Unit Cost</th>
                                          <th class="text-right">Total</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <td class="text-center">1</td>
                                          <td>Milk Powder</td>
                                          <td class="text-right">2 </td>
                                          <td class="text-right"> $24 </td>
                                          <td class="text-right"> $48 </td>
                                        </tr>
                                        <tr>
                                          <td class="text-center">2</td>
                                          <td>Air Conditioner</td>
                                          <td class="text-right"> 3 </td>
                                          <td class="text-right"> $500 </td>
                                          <td class="text-right"> $1500 </td>
                                        </tr>
                                        <tr>
                                          <td class="text-center">3</td>
                                          <td>RC Cars</td>
                                          <td class="text-right"> 20 </td>
                                          <td class="text-right"> %600 </td>
                                          <td class="text-right"> $12000 </td>
                                        </tr>
                                        <tr>
                                          <td class="text-center">4</td>
                                          <td>Down Coat</td>
                                          <td class="text-right"> 60 </td>
                                          <td class="text-right">$5 </td>
                                          <td class="text-right"> $300 </td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="pull-right m-t-30 text-right">
                                    <p>Sub - Total amount: $13,848</p>
                                    <p>vat (10%) : $138 </p>
                                    <hr>
                                    <h3><b>Total :</b> $13,986</h3>
                                  </div>
                                  <div class="clearfix"></div>
                                  <hr>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.modal -->
            
                    <!-- Update Delivery Details Modal -->
                    <div class="modal fade" tabindex="-1" role="dialog" id="updatedeliverydetails" aria-hidden="true" style="display: none;">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content" id="updateDeliveryDetails">
                          <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 class="modal-title" id="modalProduct">Update Delivery Details</h3>
                          </div>
                          <div class="modal-body">
                            <div class="descriptions">
                              <form action="" method = "post">
                                <div class="form-body">
                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label class="control-label">Customer Name</label>
                                        <select style="height:40px;" class="form-control" data-placeholder="Choose Customer Name" tabindex="1" name="customer">
                                          <?php
                                          $sql = "SELECT * FROM tblcustomer;";
                                          $result = mysqli_query($conn, $sql);
                                          while ($row = mysqli_fetch_assoc($result))
                                          {
                                              echo('<option value='.$row['customerID'].'>'.$row['customerLastName'].', '.$row['customerFirstName'].', '.$row['customerMiddleName'].'</option>');
                                          }
                                          ?>
                                        </select> </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label class="control-label">Product Name</label>
                                          <input type="text" id="mn" class="form-control" name="mn"/> 
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                               <label class="control-label">Delivery Address</label>
                                               <input type="text" id="mn" class="form-control" name="mn"/> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-4">
                                        <div class="form-group">
                                          <label class="control-label">Delivery Date</label>
                                          <input type="date" id="ln" class="form-control" name="ln" required/> </div>
                                        </div>
                                        <div class="col-md-4">
                                          <div class="form-group">
                                            <label class="control-label">Delivery Man</label>
                                            <select style="height:40px;" class="form-control" data-placeholder="Choose Customer Name" tabindex="1" name="customer">
                                          <?php
                                          $sql = "SELECT * FROM tblemployee;";
                                          $result = mysqli_query($conn, $sql);
                                          while ($row = mysqli_fetch_assoc($result))
                                          {
                                              if($row['empJobID']='1')
                                              echo('<option value='.$row['empID'].'>'.$row['empLastName'].', '.$row['empFirstName'].', '.$row['empMidName'].'</option>');
                                          }
                                          ?>
                                        </select>
                                          </div>
                                        </div>
                                        <div class="col-md-4">
                                        <div class="form-group">
                                          <label class="control-label">Delivery Status</label>
                                          <select style="height:40px;" class="form-control" data-placeholder="Choose Customer Name" tabindex="1" name="customer">
                                            <option></option>
                                            <option>Pending</option>
                                            <option>On-Hold</option>
                                            <option>Cancelled</option>
                                            <option>Shipped</option>
                                            <option>Delivered</option>
                                          </select> </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                    <!-- /.modal -->
            <!-- Payment process -->
        <div class="modal fade" tabindex="-1" role="dialog"  id="pprocess"  style="display: none; width:inherit;">
        <div class="modal-dialog modal-lg">
        <div class="modal-content" id="payment">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 class="modal-title" id="modalProduct">Payment Process</h3>
          </div>
          <div class="modal-body">
            <br>
            <div class="modalcontainer">
            <div class="row">
                      <div class="col-md-8">
                        <form class="navbar-form navbar-right" role="search">
                          <div class="input-group" style="margin-top:-40px;">
                            <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term" size="40">
                            <div class="input-group-btn">
                              <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                    <form name = "" action = "<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method = "POST">
                      <div class="row">
                        <button class="fcbtn btn btn-success btn-outline btn-1e col-md-2 pull-right" data-toggle="modal" data-target="#addpayment" data-dismiss="modal" style="margin-right: 35px;">New</button>
                      </div>
                      <div class="row">
                        <fieldset>
                          <legend><h4>Payment Information</h4></legend>
                          <table id="mainTable" class="table editable-table table-bordered table-striped m-b-0">
                            <thead>
                              <tr>
                                <th style="text-align: center;">Customer Name</th>
                                <th style="text-align: center;">Ordered Product</th>
                                <th style="text-align: center;">Price</th>
                                <th style="text-align: center;">Quantity</th>
                                <th style="text-align: center;">Payment Status</th>
                                <th style="text-align: center;">Amount Paid</th>
                                <th style="text-align: center;">Date</th>
                                <th style="text-align: center;">Storage Penalty</th>
                                <th style="text-align: center;">Total Balance</th>
                                <th style="text-align: center;">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>Publico, Doc, Ngetpa</td>
                                <td>Yellow Seat</td>
                                <td>5000</td>
                                <td>2</td>
                                <td>Existing Payment Balance</td>
                                <td>5000</td>
                                <td><input type="date"></td>
                                <td>0</td>
                                <td>5000</td>
                                <td><button class="btn btn-success" data-toggle="modal" data-dismiss="modal" href="#savereceipt" > <i class="fa fa-check"></i> Save Receipt</button></td>
                              </tr>
                            </tbody>
                            <tfoot>
                              <tr>
                              </tr>
                            </tfoot>
                          </table>
                        </fieldset>
                      </div>
                      <hr>
                      <div class="form-actions pull-right">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      </div>
                    <br><br>
                    </form>
              
                <!-- body -->
              </div>
                </div>
              </div>
            </div>
        </div>
        <!-- add payment -->
        <div class="modal fade" tabindex="-1" role="dialog" id="addpayment" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
        <div class="modal-content" id="apayment">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 class="modal-title" id="modalProduct">New Payment Details</h3>
          </div>
          <div class="modal-body">
            <div class="descriptions">
              <form action="" method = "post">
                <div class="form-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label">Customer Name</label>
                        <select style="height:40px;" class="form-control" data-placeholder="Choose Customer Name" tabindex="1" name="customer">
                                          <?php
                                          $sql = "SELECT * FROM tblcustomer;";
                                          $result = mysqli_query($conn, $sql);
                                          while ($row = mysqli_fetch_assoc($result))
                                          {
                                              echo('<option value='.$row['customerID'].'>'.$row['customerLastName'].', '.$row['customerFirstName'].', '.$row['customerMiddleName'].'</option>');
                                          }
                                          ?>
                                        </select> </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label">Order ID</label>
                          <input type="text" id="mn" class="form-control" name="mn"/> 
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label class="control-label">Price</label>
                          <input type="text" id="job" class="form-control" name="job" required/> 
                        </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="control-label">Quantity</label>
                            <input type="text" id="job" class="form-control" name="job" required/> 
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="control-label">Storage Penalty</label>
                            <input type="text" id="remarks" class="form-control" name="remarks" /> </div>
                          </div>
                        </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="control-label">Amount Paid</label>
                          <input type="text" id="job" class="form-control" name="job" required/>
                           </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label">Payment Balance</label>
                            <input type="text" id="job" class="form-control" name="job" required/> 
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label">Payment Status</label>
                            <input type="text" id="remarks" class="form-control" name="remarks" /> </div>
                          </div><div class="col-md-6">
                          <div class="form-group">
                            <label class="control-label">Date of Payment</label>
                            <input type="date" id="ln" class="form-control" name="ln" required/> </div>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-success"> <i class="fa fa-check"></i> Save</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                      </div> 
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <!-- del tracking -->
        <div class="modal fade" tabindex="-1" role="dialog" id="dtrack" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
        <div class="modal-content" id="delivery">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 class="modal-title" id="modalProduct">Delivery Tracking</h3>
          </div>
          <div class="modal-body">
            <div class="panel-wrapper collapse in" aria-expanded="true">
              <div class="panel-body">
                <table class="table color-bordered-table muted-bordered-table" id="tblEmployees">
                  <thead>
                    <tr>
                      <th style="text-align: center;">Customer Name</th>
                      <th style="text-align: center;">Product Name</th>
                      <th style="text-align: center;">Delivery Address</th>
                      <th style="text-align: center;">Delivery Date</th>
                      <th style="text-align: center;">Delivery Man</th>
                      <th style="text-align: center;">Delivery Status</th>
                      <th style="text-align: center;">Actions</th>
                    </tr>
                  </thead>
                  <tbody style="text-align: center;">
                    <tr>
                            <td>Publico, Doc</td>
                            <td>Yellow Seat</td>
                            <td>123 Sesame st. Sim city</td>
                            <td>March 25, 2017</td>
                            <td>Cortez, Jonas</td>
                            <td>Pending</td>
                            <td>
                              <!-- UPDATE -->
                              <button data-dismiss="modal" class="btn btn-primary" data-toggle="modal" href="#updatedeliverydetails" >Update</button>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                <!-- body -->
                </div>
              </div>
            </div>
        </div>
        
        
        <div id="myModal" class="modal fade" role="dialog " aria-hidden="true" style="display: none;" tabindex="-1">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <!-- Modal content -->
            <div class="modal-content clearable-content">
            <div class="modal-body">

            </div>
            </div>
          </div>
          </div>
        </div>
        <script>
          $(document).on('hidden.bs.modal', function (e) {
            var target = $(e.target);
            target.removeData('bs.modal')
            .find(".clearable-content").html('');
          });
          </script>
                     <script>
                      $(document).on('hidden.bs.modal', function (e) {
                        var target = $(e.target);
                        target.removeData('bs.modal')
                        .find(".clearable-content").html('');
                      });
                      </script>
                          <!-- Editable -->
                          <script src="../plugins/bower_components/jquery-datatables-editable/jquery.dataTables.js"></script>
                          <script src="../plugins/bower_components/datatables/dataTables.bootstrap.js"></script>
                          <script src="../plugins/bower_components/tiny-editable/mindmup-editabletable.js"></script>
                          <script src="../plugins/bower_components/tiny-editable/numeric-input-example.js"></script>
                          <script>
                            $('#mainTable').editableTableWidget().numericInputExample().find('td:first').focus();
                            $('#editable-datatable').editableTableWidget().numericInputExample().find('td:first').focus();
                            $(document).ready(function(){
                              $('#editable-datatable').DataTable();
                            });
                          </script>
      </div>
    </div>
    </body> 
</html>