<?php
$activePage = basename($_SERVER['PHP_SELF'],".php");
include "menu.php";
include 'dbconnect.php';
$id = $_GET['id'];
//session_start();
/*
if(isset($_GET['customerId'])){
   $jsID = $_GET['customId']; 
 }*/
 //$_SESSION['varname'] = 3;
 ?>
 <!DOCTYPE html>  
 <html lang="en">
 <head>
  <script>
  $(document).ready(function(){
    $('#cat').change(function() {
      var value = $("#cat").val();
      var drop = 1;
      $.ajax({
        type: 'post',
        url: 'load-drop-downs.php',
        data: {
          id: value, type : drop,
        },
        success: function (response) {
       // We get the element having id of display_info and put the response inside it
       $( '#type' ).html(response);    
       $("#type").removeAttr('disabled');
     }
   });
    });

    $('#type').change(function() {
      var value = $("#type").val();
      var drop = 2;
      $.ajax({
        type: 'post',
        url: 'load-drop-downs.php',
        data: {
          id: value, type : drop,
        },
        success: function (response) {
       // We get the element having id of display_info and put the response inside it
       $( '#products' ).html(response);
       $("#products").removeAttr('disabled');
     }
   });
    });

    $('#mat').change(function() {
      var value = $("#mat").val();
      var drop = 3;
      $.ajax({
        type: 'post',
        url: 'load-drop-downs.php',
        data: {
          id: value, type : drop,
        },
        success: function (response) {
       // We get the element having id of display_info and put the response inside it
       $( '#var' ).html(response);
       $("#var").removeAttr('disabled');
     }
   });
    });

    $('#products').change(function() {
      var value = $("#products").val();
      var drop = 4;
      $.ajax({
        type: 'post',
        url: 'load-drop-downs.php',
        data: {
          id: value, type : drop,
        },
        success: function (response) {
       // We get the element having id of display_info and put the response inside it
       $( '#phasetab' ).html(response);
       $("#var").removeAttr('disabled');
     }
   });
    });
  });


$(document).ready(function(){
  $("#products").hide();
  $("#hideProd").hide();
  $("#addProd").click(function(){
    $("#products").show();
    $("#hideProd").show();
    $("#addProd").hide();
  })
  $("#hideProd").click(function(){
    $("#products").hide();
    $("#hideProd").hide();
    $("#addProd").show();
  })

  $('#addBtn').click(function() {
    var mat = $("#mat").val();
    var desc = $("#var").val();
    var quan = $("input[name='quan']").val();
    var unit = $("#unit").val();
    $("#hide").hide();
    $.ajax({
      type: 'post',
      url: 'prod-info-material.php',
      data: {
        mat: mat, desc : desc, quan : quan, un : unit,
      },
      success: function (response) {
       // We get the element having id of display_info and put the response inside it
       $( '#tblOrders' ).append(response);
     }
   });
  });

});
</script>
<title>Update Order</title>
<link rel="icon" type="image/x-icon" sizes="16x16" href="plugins/images/favicon.ico">
</head>
<body class ="fix-header fix-sidebar">
  <!-- Preloader -->
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="panel panel-info">
            <div class="panel-body">
              <div class="orderconfirm">
               <form action="add-customer.php" method = "post">
                <div class="row">
                  <div class="descriptions">
                    <div class="form-body">
                      <h2>Customer Information:</h2>
                      <div class="row">
                        <?php
                        $sql = "SELECT * FROM tblcustomer a, tblorders b WHERE a.customerID = b.custOrderID and b.orderID = '$id'";
                        $result = mysqli_query($conn,$sql);
                        $row = mysqli_fetch_assoc($result);
                        ?>
                        <div class="row">
                          <div class="col-md-12" style="text-align:left;">
                            <h5><p><b>Name: </b><?php echo $row['customerLastName'].','.$row['customerFirstName'].'  '.$row['customerMiddleName']?></p>
                              <p><b>Address: </b><?php echo $row['customerAddress']?></p>
                              <p><b>Contact Number: </b><?php echo $row['customerContactNum']?></p>
                              <p><b>Email Address: </b><?php echo $row['customerEmail']?></p>
                              <p><b>Remarks: </b><?php echo $row['orderRemarks']?></p>
                            </h5>
                          </div>
                        </div>
                      </div>
                      <br>
                    </div>
                  </div>
                </div>

                <button type="button" id="addProd" class="btn btn-lg btn-info" aria-expanded="false">Add</button>
                <button type="button" id="hideProd" class="btn btn-lg btn-info" aria-expanded="false">Hide</button>
                <br><br>
                <div id="products">
                 <div class="row">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="control-label">Category</label><span id="x" style="color:red"> *</span>
                      <select class="form-control" data-placeholder="Choose a Category" tabindex="1" name="cat" id="cat">
                        <option value="0">Choose Category</option>
                        <?php
                        $sql = "SELECT * FROM tblfurn_category;";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result))
                        {
                          if($row['categoryStatus']=='Listed'){
                            echo('<option value='.$row['categoryID'].'>'.$row['categoryName'].'</option>');
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label class="control-label">Type</label><span id="x" style="color:red"> *</span>
                      <select class="form-control" data-placeholder="Choose a Category" tabindex="1" name="_category" id="type" disabled>


                      </select>
                    </div>
                  </div>

               <!--<div class="row">
              <div class="col-md-12 ">
                <div class="form-group">
                  <div id="type">

                  </div>
                </div>
              </div>
            </div>-->

            <div class="col-md-3">
              <div class="form-group">
                <label class="control-label">Furniture Name</label><span id="x" style="color:red"> *</span>
                <select class="form-control" tabindex="1" name="prod" id="products" disabled>

                </select>
              </div>
            </div>
            <div class="col-md-2">
              <div class="form-group">
                <label class="control-label">Quantity</label><span id="x" style="color:red"> *</span>

                   <a class="mytooltip pull-right" href="javascript:void(0)"> <span class="tooltip-item"><i class="fa fa-info"></i></span>
                     <span class="tooltip-content5">
                       <span class="tooltip-text3">
                         <span class="tooltip-inner2">Product Name
                         <br><br> 
                         Product description here...
                         </span>
                       </span>
                     </span>
                   </a>

                <input type="text" class="form-control" name="quan" id="quan" placeholder="500" style="text-align: right" />
              </div>
            </div>
            <div class="col-md-1">
              <div class="form-group pull-right">
                <button id="addBtn" type="button" class="btn btn-success" style="margin-top: 27px;"><i class="ti-plus"></i></button>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="panel-wrapper collapse in" aria-expanded="true">
              <div class="panel-body">
                <div class="table-responsive">
                  <h3><label class="control-label" style="text-align:left;">Orders</label></h3>
                  <table class="table product-overview" id="tblOrders">
                    <thead>
                      <th style="text-align:center">Furniture Name</th>
                      <th style="text-align:right;">Unit Price</th>
                      <th style="text-align:right;">Quantity</th>
                      <th style="text-align:right;">Total Price</th>
                      <th style="text-align:center">Actions</th>
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
                        <td style="text-align:right;">&#8369; '.number_format($row['productPrice'],2).'</td>
                        <td style="text-align:right;"><input type="number" size="1" style="text-align:right" value="'.$row['orderQuantity'].'" /></td>';
                        $tPrice = $row['orderQuantity'] * $row['productPrice'];
                        $tPrice =  number_format($tPrice,2);
                        echo '<td style="text-align:right;">&#8369; '.$tPrice.'</td>';
                        $tPrice = $row['orderPrice'];
                        $tQuan = $tQuan + $row['orderQuantity'];
                        echo '<td style="text-align:center"><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#viewOrder" href="order-management-modals.php" data-remote="order-management-modals.php?id='. $row['orderID'].' #viewInfo">X</button></td>
                        </tr>';
                      }
                      ?>
                    </tbody>
                    <tfoot style="text-align:right;">
                      <td colspan="2" style="text-align:right;"><b> GRAND TOTAL</b></td>
                      <td id="totalQ" style="text-align:right;"><?php echo $tQuan?></td>
                      <td id="totalPrice" style="text-align:right;"><?php echo "&#8369; ". number_format($tPrice,2)?></td>
                      <td></td>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-1 pull-right">
            <button type="submit" class="btn btn-success waves-effect pull-right" id="addFab" aria-expanded="false"><i class="fa fa-check"></i> Save</button>
          </div>
          <div class="col-md-1">
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal" href="order-management-modals.php" data-remote="order-management-modals.php?id='<?php echo $id;?>' #cancelOrder" aria-expanded="false">Cancel Order</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
</div>
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
</body> 
</html>