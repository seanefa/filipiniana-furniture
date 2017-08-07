<?php
include "titleHeader.php";
include "menu.php";  
//session_start();
/* if(isset($GET['id'])){
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

if (isset($_GET['newSuccess']))
{
  echo  '<script>';
  echo '$(document).ready(function () {';
    echo 'document.getElementById("toastNewSuccess").click();';
    echo '});';
echo '</script>';
}
else if (isset($_GET['updateSuccess']))
{
  echo  '<script>';
  echo '$(document).ready(function () {';
    echo 'document.getElementById("toastUpdateSuccess").click();';
    echo '});';
echo '</script>';
}
else if (isset($_GET['deactivateSuccess']))
{
  echo  '<script>';
  echo '$(document).ready(function () {';
    echo 'document.getElementById("toastDeactivateSuccess").click();';
    echo '});';
echo '</script>';
}

?>
<!DOCTYPE html>  
<html lang="en">
<head>
  <script>

$(document).ready(function(){
 $('#myModal').on('shown.bs.modal',function(){
    $("#promo").on('change',function(){
      var val = $("#promo").val();
      if($(this).prop("checked")){
        $("#selection").hide();
      }
      else{
        $("#selection").show();
      }
    });
  });
});

$(document).ready(function(){
 $('#myModal').on('shown.bs.modal',function(){
    $("#selection").hide();
    $("#allProd").on('change',function(){
      if($(this).prop("checked")){
        $("#selection").hide();
      }
      else{
        $("#selection").show();
      }
    });
  });
});

$(document).ready(function(){
 $('#myModal').on('shown.bs.modal',function(){
    $("#onPromoProd").select2({
      tags: true
    });
});
});


$(document).ready(function(){
 $('#myModal1').on('shown.bs.modal',function(){
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
});


$(document).ready(function(){
 $('#myModal').on('shown.bs.modal',function(){
  $('#promo').change(function() {
    var value = $("#promo").val();
    $.ajax({
      type: 'post',
      url: 'prod-promo-form.php',
      data: {
        id: value, 
      },
      success: function (response) {
       // We get the element having id of display_info and put the response inside it
       $( '#promoForm' ).html(response);
      }
      });
    });
});
});
</script>
</head>
<body>
  <!-- Preloader -->
  <!--div class="preloader">
    <div class="cssload-speeding-wheel"></div>
  </div-->
  <!-- Toast Notification -->
  <button class="tst1" id="toastNewSuccess" style="display: none;"></button>
  <button class="tst2" id="toastUpdateSuccess" style="display: none;"></button>
  <button class="tst3" id="toastDeactivateSuccess" style="display: none;"></button>
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="panel panel-info">
            <h3>
              <ul class="nav customtab2 nav-tabs" role="tablist">
                <!--button id="tempbtn" class="btn btn-lg btn-info pull-right" data-toggle="modal" href="furn-type-form.php" data-remote="furn-type-form.php #new" data-target="#myModal" aria-expanded="false" style="margin-right: 20px;"><span class="btn-label"><i class="ti-plus"></i></span>New</button-->
                <li role="presentation" class="active">
                  <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="ti-view-list-alt"></i>&nbsp;<?php echo $titlePage?></a>
                </li>
              </ul>
            </h3>
            <div class="sttabs tabs-style-flip">
              <nav>
                <ul>
                  <li><a href="#onhand" class="sticon ti-thumb-up"><span>On-Hand</span></a></li>
                  <li><a href="#onpromo" class="sticon ti-cut"><span>On-Promo</span></a></li>
                </ul>
              </nav>
              <div class="content-wrap text-center">
                <section id="onhand">
                  <button id="tempbtn" class="btn btn-lg btn-info pull-right" data-toggle="modal" data-target="#myModal1" href="product-management-form.php" data-remote="product-management-form.php #newOnHand" aria-expanded="false" style="margin-right: 20px;"><span class="btn-label"><i class="ti-plus"></i></span>New</button>
                  <div class="tab-content">
                    <!-- CATEGORY -->
                    <div role="tabpanel" class="tab-pane fade active in">
                      <div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="panel-body">
                          <div class="row">
                            <div class="table-responsive">
                              <table class="table color-bordered-table muted-bordered-table dataTable display nowrap" id="myTable">
                                <thead>
                                  <tr>
                                    <th>Furniture Type</th>
                                    <th>Furniture Name</th>
                                    <th>Furniture Description</th>
                                    <th style="text-align:center">Quantity</th>
                                    <th>Actions</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $sql = "SELECT * FROM tblproduct a, tblfurn_type b WHERE a.prodTypeID = b.typeID and a.prodQuantity > 0;";
                                  $result = mysqli_query($conn, $sql);
                                  while ($row = mysqli_fetch_assoc($result))
                                  {
                                    if($row['prodQuantity']>0){
                                      echo('<tr><td  style="text-align: left;">'. $row['typeName'] .'</td>
                                        <td  style="text-align: left;">'.$row['productName'].'</td>
                                        <td  style="text-align: left;">'.$row['productDescription'].'</td>
                                        <td  style="text-align: center;">'.$row['prodQuantity'].'</td>');
                                        ?>
                                        <td  style="text-align: left;"><button type="button" class="btn btn-success" data-toggle="modal" href="product-management-form.php" data-remote="product-management-form.php?id=<?php echo $row['productID']?> #addOnHand" data-target="#myModal1">Add</button>

                                          <button type="button" class="btn btn-danger" data-toggle="modal" href="product-management-form.php" data-remote="product-management-form.php?id=<?php echo $row['productID']?> #deductOnHand" data-target="#myModal1">Deduct</button>
                                        </td>

                                        <?php echo('</tr>');} }
                                        ?>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                      <!-- New Framework Mo
                      <!-- /.modal -->
                    </div>
                  </section>

                  <section id="onpromo">
                    <button id="tempbtn" class="btn btn-lg btn-info pull-right" data-toggle="modal" data-target="#myModal" href="product-management-form.php" data-remote="product-management-form.php #newOnPromo" aria-expanded="false" style="margin-right: 20px;"><span class="btn-label"><i class="ti-plus"></i></span>New</button>
                    <div class="tab-content">
                      <!-- CATEGORY -->
                      <div role="tabpanel" class="tab-pane fade active in">
                        <div class="panel-wrapper collapse in" aria-expanded="true">
                          <div class="panel-body">
                            <div class="row">
                              <div class="table-responsive">
                                <table class="table color-bordered-table muted-bordered-table dataTable display nowrap" id="myTable">
                                  <thead>
                                    <tr>
                                      <th>Furniture Type</th>
                                      <th>Furniture Name</th>
                                      <th>Promo</th>
                                      <th>Actions</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                    $sql = "SELECT * from tblprodsonpromo";
                                    $result = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_assoc($result))
                                    {
                                      if($row['saleStatus']=="Active"){
                                        echo('<tr><td>'. $type .'</td>
                                          <td>'.$name.'</td>
                                          <td>'.$row['prodQuantity'].'</td>');
                                          ?>
                                          <td><button type="button" class="btn btn-success" data-toggle="modal" href="product-management-form.php" data-remote="product-management-form.php #addOnPromo" data-target="#myModal">Add</button>

                                            <button type="button" class="btn btn-danger" data-toggle="modal" href="product-management-form.php" data-remote="product-management-form.php #deductOnPromo" data-target="#myModal">Deduct</button>
                                          </td>

                                          <?php echo('</tr>');} }
                                          ?>
                                        </tbody>
                                      </table>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                      <!-- New Framework Mo
                      <!-- /.modal -->
                    </div>
                  </section>
                </div><!-- /content -->
              </div><!-- /tabs -->
            </div>  
          </div>
        </div>
        <!-- /.container-fluid -->
        <!--footer class="footer text-center"> 2017 &copy; Filipiniana Furniture </footer-->
      </div>
      <!-- /#page-wrapper -->
    </div>

    <div id="myModal" class="modal fade" role="dialog " aria-hidden="true" style="display: none;" tabindex="-1">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <!-- Modal content-->
          <div class="modal-content clearable-content">
            <div class="modal-body">

            </div>
          </div>
        </div>
      </div>
    </div>

    <div id="myModal1" class="modal fade" role="dialog " aria-hidden="true" style="display: none;" tabindex="-1">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
          <!-- Modal content-->
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