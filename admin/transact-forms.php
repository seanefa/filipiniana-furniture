<?php

  include "menu.php";
  include "dbconnect.php";
                              session_start();
                              if(isset($GET['id'])){
                               $jsID = $_GET['id']; 
                             }
                             $jsID=$_GET['id'];

 $_SESSION['varname'] = $jsID;
  $conn = mysqli_connect($servername, $username, $password, $dbname);

  // Check connection
  if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
  }

?>
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
                          <button type="button" class="btn btn-default btn-prev"> <i class="fa fa-check"></i> Prev</button>
                          <button type="button" type="submit" class="btn btn-default btn-next"> <i class="fa fa-check"></i> Next</button>
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
                            <th class="text-right">Width</th>
                            <th class="text-right">Height</th>
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
                            <td class="text-right"> $48 </td>
                          </tr>
                          <tr>
                            <td class="text-center">2</td>
                            <td>Air Conditioner</td>
                            <td class="text-right"> 3 </td>
                            <td class="text-right"> $500 </td>
                            <td class="text-right"> $1500 </td>
                            <td class="text-right"> $1500 </td>
                          </tr>
                          <tr>
                            <td class="text-center">3</td>
                            <td>RC Cars</td>
                            <td class="text-right"> 20 </td>
                            <td class="text-right"> %600 </td>
                            <td class="text-right"> $12000 </td>
                            <td class="text-right"> $12000 </td>
                          </tr>
                          <tr>
                            <td class="text-center">4</td>
                            <td>Down Coat</td>
                            <td class="text-right"> 60 </td>
                            <td class="text-right">$5 </td>
                            <td class="text-right">$5 </td>
                            <td class="text-right"> $300 </td>
                          </tr>
                    </tbody>
                  </table>
                </div>
                    <div class="row">
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="control-label">Order Remarks</label>
                            <input type="datetime" id="orderremarks" class="form-control" name="orderremarks" required/> 
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="control-label">Order Status</label>
                            <input type="text" id="stats" class="form-control" name="stats" required/> 
                          </div>
                        </div>
                        <div class="col-md-4">
                          <div class="form-group">
                            <label class="control-label">Pick up/Delivery Date</label>
                            <input type="datetime" id="dppate" class="form-control" name="pddate" required/> 
                          </div>
                        </div>
                    </div>
                    </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-default btn-prev"> <i class="fa fa-check"></i> Prev</button>
                          <button type="submit" class="btn btn-success waves effect text-left" value="Save"> <i class="fa fa-check"></i></button>
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
                $("div[id^='checkout']").each(function(){

              var currentModal = $(this);

              //click next
              currentModal.find('.btn-next').click(function(){
                currentModal.modal('hide');
                currentModal.closest("div[id^='checkout']").nextAll("div[id^='checkout']").first().modal('show'); 
              });

              //click prev
              currentModal.find('.btn-prev').click(function(){
                currentModal.modal('hide');
                currentModal.closest("div[id^='checkout']").prevAll("div[id^='checkout']").first().modal('show'); 
              });

            });
        </script>
                            
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
                  <button type="submit" class="btn btn-success waves-effect text-left" data-dismiss="modal"><i class="fa fa-check"></i> Ok</button>
                  <button id="print" class="btn btn-default btn-outline" type="button"> <span><i class="fa fa-print"></i> Print</span> </button>
                  <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
                </div>
              </div>
            </div>
          </div>
          <!-- /.modal -->
            <!-- New Delivery Details Modal -->
            <div class="modal fade" tabindex="-1" role="dialog" id="newdeliverydetails" aria-hidden="true" style="display: none;">
              <div class="modal-dialog modal-lg">
                <div class="modal-content" id="newDeliveryDetails">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 class="modal-title" id="modalProduct">New Delivery Details</h3>
                  </div>
                  <div class="modal-body">
                    <div class="descriptions">
                      <form action="" method = "post">
                        <div class="form-body">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Order ID</label>
                                <input type="text" id="firstName" class="form-control" name="fn" required/> </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="control-label">Delivery Address</label>
                                  <input type="text" id="mn" class="form-control" name="mn"/> 
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group">
                                  <label class="control-label">Date</label>
                                  <input type="date" id="ln" class="form-control" name="ln" required/> </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label class="control-label">Delivery Man</label>
                                    <input type="text" id="job" class="form-control" name="job" required/> 
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label class="control-label">Delivery Status</label>
                                    <input type="text" id="remarks" class="form-control" name="remarks" /> </div>
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
                            <h3 class="modal-title" id="modalProduct">Update Employee</h3>
                          </div>
                          <div class="modal-body">
                            <div class="descriptions">
                              <form action="" method = "post">
                                <div class="form-body">
                                  <div class="row">
                                    <div class="col-md-6">
                                      <div class="form-group">
                                        <label class="control-label">Order ID</label>
                                        <input type="text" id="firstName" class="form-control" name="fn" required/> </div>
                                      </div>
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label class="control-label">Delivery Address</label>
                                          <input type="text" id="mn" class="form-control" name="mn"/> 
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-6">
                                        <div class="form-group">
                                          <label class="control-label">Date</label>
                                          <input type="date" id="ln" class="form-control" name="ln" required/> </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <label class="control-label">Delivery Man</label>
                                            <input type="text" id="job" class="form-control" name="job" required/> 
                                          </div>
                                        </div>
                                      </div>
                                      <div class="row">
                                        <div class="col-md-6">
                                          <div class="form-group">
                                            <label class="control-label">Delivery Status</label>
                                            <input type="text" id="remarks" class="form-control" name="remarks" /> </div>
                                          </div>
                                        </div>


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
                    <!-- /.modal -->
        
        
    </body>
</html>