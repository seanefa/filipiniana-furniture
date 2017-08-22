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
    if(isNaN(value)){
      var res = '<h3 style="text-align:center">[Select a Promo]</h3>';
      $( '#promoDesc' ).html(res);
    }
    else{
      $.ajax({
        type: 'post',
        url: 'promo-display.php',
        data: {
          id: value, 
        },
        success: function (response) {
       // We get the element having id of display_info and put the response inside it
       $( '#promoDesc' ).html(response);
     }
   });
    }
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
                  <li><a href="#onhand" class="sticon ti-hand-stop"><span>On-Hand</span></a></li>
                  <li><a href="#onpromo" class="sticon ti-tag"><span>On-Promo</span></a></li>
                </ul>
              </nav>
              <div class="content-wrap text-center">
                <section id="onhand">
                  <button id="tempbtn" class="btn btn-lg btn-info pull-right" data-toggle="modal" data-target="#myModal1" href="product-management-form.php" data-remote="product-management-form.php #newOnHand" aria-expanded="false" style="margin-right: 20px; margin-top: -15px;"><span class="btn-label"><i class="ti-plus"></i></span>New</button>
                  <div class="tab-content">
                    <!-- CATEGORY -->
                    <div role="tabpanel" class="tab-pane fade active in">
                      <div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="panel-body">
                          <div class="row">
                            <div class="table-responsive">
                              <table class="table color-bordered-table muted-bordered-table dataTable display" id="myTable">
                                <thead>
                                  <tr>
                                    <th>Furniture Type</th>
                                    <th>Furniture Name</th>
                                    <th>Furniture Description</th>
                                    <th>Quantity</th>
                                    <th class="removeSort">Actions</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $sql = "SELECT * FROM tblproduct a, tblfurn_type b, tblonhand c WHERE a.productID = c.ohProdID and  a.prodTypeID = b.typeID and c.ohQuantity > 0;";
                                  $result = mysqli_query($conn, $sql);
                                  while ($row = mysqli_fetch_assoc($result))
                                  {
                                    if($row['prodStat']!="Archived"){
                                      echo('<tr><td style="text-align: left;">'. $row['typeName'] .'</td>
                                        <td style="text-align: left;">'.$row['productName'].'</td>
                                        <td style="text-align: left;">'.$row['productDescription'].'</td>
                                        <td style="text-align: left;">'.$row['ohQuantity'].'</td>');
                                        ?>
                                        <td  style="text-align: left;"><button type="button" class="btn btn-success" data-toggle="modal" href="product-management-form.php" data-remote="product-management-form.php?id=<?php echo $row['productID']?> #addOnHand" data-target="#myModal1"><i class="ti-plus"></i> Add</button>

                                          <button type="button" class="btn btn-danger" data-toggle="modal" href="product-management-form.php" data-remote="product-management-form.php?id=<?php echo $row['productID']?> #deductOnHand" data-target="#myModal1"><i class="ti-close"></i> Deduct</button>
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
                      <!-- New Framework Modal -->
                      <!-- /.modal -->
                    </div>
                  </section>

                  <section id="onpromo">
                    <button id="tempbtn" class="btn btn-lg btn-info pull-right" data-toggle="modal" data-target="#myModal" href="product-management-form.php" data-remote="product-management-form.php #newOnPromo" aria-expanded="false" style="margin-right: 20px; margin-top: -15px;"><span class="btn-label"><i class="ti-plus"></i></span>New</button>
                    <div class="tab-content">
                      <!-- CATEGORY -->
                      <div role="tabpanel" class="tab-pane fade active in">
                        <div class="panel-wrapper collapse in" aria-expanded="true">
                          <div class="panel-body">
                            <div class="row">
                              <div class="table-responsive">
                                <table class="table color-bordered-table muted-bordered-table dataTable display" id="myTable">
                                  <thead>
                                    <tr>
                                      <th>Promo Name</th>
                                      <th>Description</th>
                                      <th>Start Date</th>
                                      <th>End</th>
                                      <th style="text-align: center;">No. of Products</th>
                                      <th class="removeSort">Actions</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    <?php
                                    $sql = "SELECT *, COUNT(b.promoID) as bilang from tblprodsonpromo a, tblpromos b, tblproduct c WHERE a.promoDescID = b.promoID and a.prodPromoID = c.productID";
                                    $result = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_assoc($result))
                                    {
                                      $date = date_create($row['promoStartDate']);
                                      $date = date_format($date,"F/d/Y");
                                      if($row['onPromoStatus']=="Active"){
                                        echo('<tr><td style="text-align: left;">'. $row['promoName'] .'</td>
                                          <td style="text-align: left;">'.$row['promoDescription'].'</td>
                                          <td style="text-align: left;">'. $date.'</td>
                                          <td style="text-align: left;">'. $row['promoEnd'].'</td>
                                          <td style="text-align: center;">'. $row['bilang'].'</td>
                                          ');
                                          ?>
                                          <td><button type="button" class="btn btn-success" data-toggle="modal" href="product-management-form.php" data-remote="product-management-form.php #updatePromo" data-target="#myModal"><i class="ti-pencil-alt"></i> Update</button>

                                            <!--<button type="button" class="btn btn-danger" data-toggle="modal" href="product-management-form.php" data-remote="product-management-form.php #deductOnPromo" data-target="#myModal">Deduct</button>-->
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
                      <!-- New Framework Modal -->
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