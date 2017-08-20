            <?php
            include "titleHeader.php";
            include "menu.php";
            //session_start();
            /*if(isset($GET['id'])){
            $jsID = $_GET['id']; 
            }
            $jsID=$_GET['id'];
            $_SESSION['varname'] = $jsID;*/
            include 'dbconnect.php';
            ?>
            <!DOCTYPE html>  
            <html lang="en">
            <head>
              <script>
              $(document).ready(function(){

            var value = $("#selectCat").val(); // on load

            $.ajax({
              type: 'post',
              url: 'display-furnitures.php',
              data: {
                id: value,
              },
              success: function (response) {
                $('#tblProd').html(response);
            //$("#selectType").attr('disabled','disabled');  
          }
        });

            $('#selectCat').on("change",function() {
              var value = $("#selectCat").val();
              if(isNaN(value)){
                $.ajax({
                  type: 'post',
                  url: 'display-furnitures.php',
                  data: {
                    id: value,
                  },
                  success: function (response) {
                    $('#tblProd').html(response);
                    $("#selectType").empty();  
                    $("#selectType").attr('disabled','disabled');  
                  }
                });
              }
              else{
                var drop = 1;
                $.ajax({
                  type: 'post',
                  url: 'display-furnitures.php',
                  data: {
                    id: value,
                  },
                  success: function (response) {
                    $('#tblProd').html(response);
                  }
                });

                $.ajax({
                  type: 'post',
                  url: 'load-drop-downs.php',
                  data: {
                    id: value, type : drop,
                  },
                  success: function (response) {
                    $('#selectType').html(response);
                    $("#selectType").removeAttr('disabled');
                  }
                });
              }
            });

            $('#selectType').on("change",function() {
              var value = $("#selectType").val();
              alert(value);
              $.ajax({
                type: 'post',
                url: 'display-furnitures.php',
                data: {
                  id: value,
                },
                success: function (response) {
                  $('#tblProd').html(response);
            //$("#selectType").attr('disabled','disabled');  
          }
        });
            });

          });
            
            </script>
          </head>
          <body class ="fix-header fix-sidebar">
            <!-- Preloader -->
            <!--script>
            $(document).ready(function(){
            $('.search').on('keyup',function(){
            var searchTerm = $(this).val().toLowerCase();
            $('#tblProd #formProduct').each(function(){
            var lineStr = $(this).text().toLowerCase();
            if(lineStr.indexOf(searchTerm) === -1){
            $(this).hide();
            }else{
            $(this).show();
            }
            });
            });
            });
          </script-->
          <div id="page-wrapper">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-12">
                  <div class="panel panel-info">
                    <!-- nav start -->
                    <h3>
                      <ul class="nav customtab2 nav-tabs" role="tablist">
            <!--li role="presentation" class="active">
            <a aria-controls="ordermanagement.php" role="tab" aria-expanded="false" href="ordermanagement.php"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"></span><i  class="ti-shopping-cart"></i> <?php echo $titlePage?></a>
            </li>
            <li role="presentation" class >
            <a aria-controls="order-request.php" role="tab" aria-expanded="false" href="order-request.php"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"></span><i  class="ti-shopping-cart"></i> Order Request</a>
            </li>
            <li role="presentation" class >
            <a aria-controls="customizationrequest.php" role="tab" aria-expanded="false" href="customization-request.php"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"></span><i  class="ti-shopping-cart"></i> Customization Request</a>
          </li-->
        </ul>
      </h3>
      <!-- nav end -->

      <div class="sttabs tabs-style-flip" style="margin-top: -40px;">
        <nav>
          <ul>
            <li><h3><a href="#orders" class="ti-shopping-cart"><span> List of Orders</span></a></h3></li>
            <li><h3><a href="#orderrequest" class="ti-write"><span> Order Request</span></a></h3></li>
            <li><h3><a href="#customizationrequest" class="ti-marker-alt"><span> Customization Request</span></a></h3></li>
          </ul>
        </nav>
        <div class="content-wrap text-center" style="margin-top: -10px;">

          <!-- ORDER MANAGEMENT TAB -->
          <section id="orders">
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane fade active in" id="type">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <div class="row">
                      <div class="table-responsive">
                        <table class="table color-bordered-table muted-bordered-table dataTable display nowrap" id="tblCategories">
                          <thead>
                            <tr>
                              <th style="text-align:left">Order ID</th>
                              <th style="text-align:left">Customer Name</th>
                              <th style="text-align:left">Release Date</th>
                              <th style="text-align:right">Total Price</th>
                              <th style="text-align:center">Production Status</th>
                              <th class="removeSort" style="text-align: center;">Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            include "dbconnect.php";
                            $sql = "SELECT * FROM tblorders WHERE orderStatus='Pending' order by orderID;";

                            $result = mysqli_query($conn, $sql);
                            if($result){
                              while ($row = mysqli_fetch_assoc($result))
                              {
            $orderID = str_pad($row['orderID'], 6, '0', STR_PAD_LEFT); //format ng display ID
            $get_name = getName($row['custOrderID']);
            $production_stat = getStatus($row['orderID']);
            $date = date_create($row['dateOfRelease']);
            $dates = date_format($date,"F d, Y");
            echo ('<tr>
              <td style="text-align:left">'.$orderID.'</td>
              <td style="text-align:left">'.$get_name.'</td>
              <td style="text-align:left">'.$dates.'</td>
              <td style="text-align:right">&#8369; '.number_format($row['orderPrice'],2).'</td>
              <td style="text-align:center">'.$production_stat.'</td>
              <td>
              <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#viewOrder" href="order-management-modals.php" data-remote="order-management-modals.php?id='. $row['orderID'].' #viewInfo"><i class="glyphicon glyphicon-eye-open"></i> View</button> 

              <a class="btn btn-info" style="color:white;" href="update-order.php?id='. $row['orderID'].'"><span class="glyphicon glyphicon-edit"></span> Update</a>

              <a class="btn btn-success" style="color:white;" href="bill.php?id='. $row['orderID'].'"><span class="glyphicon glyphicon-list-alt"></span> Bill</a>

              </td>
              </tr>
              ');
          }     
        }    
        //<button type="button" class="btn btn-info" data-toggle="modal" data-target="#viewOrder" href="order-management-modals.php" data-remote="order-management-modals.php?id='. $row['orderID'].' #orderUpdate"><span class="glyphicon glyphicon-edit"></span> Update</button>

        function getStatus($id){
          include "dbconnect.php";
          $sql = "SELECT * FROM tblproduction a, tblorder_request b, tblorders c WHERE b.tblOrdersID = c.orderID and b.order_requestID = a.productionOrderReq and c.orderID = '$id'";
          $result = mysqli_query($conn,$sql);
          $stat = "";
          while($row = mysqli_fetch_assoc($result)){
            $stat = $row['productionStatus'];
          }
          if($stat==""){
            return "Not set";
          }
          else{
            return $stat;
          }
        }         
        ?> 
      </tbody>
    </table>
  </div>
</div>
</div>
</div>
</div>
</div>

</section>

<!-- ORDER REQUEST TAB -->
<section id="orderrequest">
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane fade active in" id="type">
      <div class="panel-wrapper collapse in" aria-expanded="true">
        <div class="panel-body">
          <div class="row">
            <div class="table-responsive">
              <table class="table color-bordered-table muted-bordered-table dataTable display nowrap" id="tblCategories">
                <thead>
                  <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Request Date</th>
                    <th>Total Quantity</th>
                    <th>Price</th>
                    <th class="removeSort">Actions</th>
                  </tr>
                </thead>
                <tbody style="text-align:left;">
                  <?php
                  include "dbconnect.php";
                  $sql = "SELECT * FROM tblorders WHERE orderStatus='WFA' order by orderID;";

                  $result = mysqli_query($conn, $sql);
                  if($result){
                    while ($row = mysqli_fetch_assoc($result))
                    {
                                  $orderID = str_pad($row['orderID'], 6, '0', STR_PAD_LEFT); //format ng display ID
                                  $count_prod = pCount($row['orderID']);
                                  $get_date = getDates($row['orderID']);
                                  $get_name = getName($row['custOrderID']);
                                  echo ('
                                    <tr>
                                    <td>'.$orderID.'</td>
                                    <td>'.$get_name.'</td>
                                    <td>'.$get_date.'</td>
                                    <td style="text-align:center">'.$count_prod.'</td>
                                    <td>&#8369;'.number_format($row['orderPrice'],2).'</td>
                                    <td>
                                    <button type="button" class="btn btn-info" data-toggle="modal" data-target="#viewOrder" href="order-management-modals.php" data-remote="order-management-modals.php?id='. $row['orderID'].' #orderReqview"><i class="glyphicon glyphicon-eye-open"></i></button> 

                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#viewOrder" href="order-management-modals.php" data-remote="order-management-modals.php?id='. $row['orderID'].' #orderReqaccept"><i class="glyphicon glyphicon-ok"></i>Accept </button>

                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#viewOrder" href="order-management-modals.php" data-remote="order-management-modals.php?id='. $row['orderID'].' #orderReqreject"><i class="glyphicon glyphicon-cross"></i>Reject</button> 
                                    </td>
                                    </tr>
                                    ');
          }     
        }   


        function pCount($id){
          include "dbconnect.php";
          $cnt = 0;
          $sql = "SELECT * FROM tblorder_request WHERE tblOrdersID ='$id'";
          $result = mysqli_query($conn,$sql);
          while($row = mysqli_fetch_assoc($result)){
            $cnt = $cnt + $row['orderQuantity'];
          }
          return $cnt;
        }
        function getDates($id){
          include "dbconnect.php";

          $sql = "SELECT * FROM tblorders WHERE orderID='$id'";
          $result = mysqli_query($conn,$sql);
          $row = mysqli_fetch_assoc($result);
          $date = date_create($row['dateOfReceived']);
          $dates = date_format($date,"F d, Y");
          return $dates;
        }
        function getName($id){
          include "dbconnect.php";
          $sql = "SELECT * FROM tblcustomer WHERE customerID='$id'";
          $result = mysqli_query($conn,$sql);
          $row = mysqli_fetch_assoc($result);
          $name = $row['customerLastName'].','.$row['customerFirstName'].'  '.$row['customerMiddleName'];
          return $name;
        }               
        ?> 
      </tbody>
    </table>
  </div>
</div>
</div>
</div>
</div>
</div>

</section>

<!-- CUSTOMIZATION REQUEST TAB -->
<section id="customizationrequest">
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane fade active in" id="type">
      <div class="panel-wrapper collapse in" aria-expanded="true">
        <div class="panel-body">
          <div class="row">
            <div class="table-responsive">
              <table class="table color-bordered-table muted-bordered-table dataTable display nowrap" id="tblCategories">
                <thead>
                  <tr>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Request Date</th>
                    <th>Total Quantity</th>
                    <th>Total Price</th>
                    <th class="removeSort">Actions</th>
                  </tr>
                </thead>
                <tbody style="text-align:center;">
                  <tr>
                    <td>2</td>
                    <td>Dela Cruz, Celia</td>
                    <td>03-08-2017</td>
                    <td>3</td>
                    <td>&#8369; 33,000</td>
                    <td>
                      <button type="button" class="btn btn-info" data-toggle="modal" data-target="#custRequest" href="order-management-modals.php" data-remote="order-management-modals.php?id='. $row['orderID'].' #viewCustRequest"><i class="glyphicon glyphicon-eye-open"></i> View</button> 
                      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#custRequest" href="order-management-modals.php" data-remote="order-management-modals.php?id='. $row['orderID'].' #acceptCustRequest"><i class="glyphicon glyphicon-ok"></i> Accept</button></td>
                    </tr>
                    <tr>
                      <td>5</td>
                      <td>Garcia, Amanda</td>
                      <td>03-10-2017</td>
                      <td>1</td>
                      <td>&#8369; 25,000</td>
                      <td>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#custRequest" href="order-management-modals.php" data-remote="order-management-modals.php?id='. $row['orderID'].' #viewCustRequest"><i class="glyphicon glyphicon-eye-open"></i> View</button> 
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#custRequest" href="order-management-modals.php" data-remote="order-management-modals.php?id='. $row['orderID'].' #acceptCustRequest"><i class="glyphicon glyphicon-ok"></i> Accept</button></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


  </div><!-- /content -->
</div><!-- /tabs -->
</div> <!-- panel info -->

</div>
</div>
<!--footer class="footer text-center"> 2017 &copy; Filipiniana Furniture </footer-->
</div>
</div>



<div id="viewOrder" class="modal fade" role="dialog " aria-hidden="true" style="display: none;" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-content clearable-content">
        <div class="modal-body">

        </div>
      </div>
    </div>
  </div>
</div>

<div id="custRequest" class="modal fade" role="dialog " aria-hidden="true" style="display: none;" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
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


</body> 
</html>