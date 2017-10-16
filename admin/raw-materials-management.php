<?php
include "titleHeader.php";
include "menu.php";  
include 'dbconnect.php';
include 'toastr-buttons.php';

if (!empty($_SESSION['createSuccess'])) {
  echo  '<script>
  $(document).ready(function () {
    $("#toastNewSuccess").click();
  });
</script>';
unset($_SESSION['createSuccess']);
}
if (!empty($_SESSION['updateSuccess'])) {
  echo  '<script>
  $(document).ready(function () {
    $("#toastUpdateSuccess").click();
  });
</script>';
unset($_SESSION['updateSuccess']);
}
if (!empty($_SESSION['deactivateSuccess'])) {
  echo  '<script>
  $(document).ready(function () {
    $("#toastDeactivateSuccess").click();
  });
</script>';
unset($_SESSION['deactivateSuccess']);
}
if (!empty($_SESSION['reactivateSuccess'])) {
  echo  '<script>
  $(document).ready(function () {
    $("#toastReactivateSuccess").click();
  });
</script>';
unset($_SESSION['reactivateSuccess']);
}
if (!empty($_SESSION['actionFailed'])) {
  echo  '<script>
  $(document).ready(function () {
    $("#toastFailed").click();
  });
</script>';
unset($_SESSION['actionFailed']);
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
      var value = $("#reason").val();
        if(value==1){
          $("#tblorders").show();
          $("#warning").hide();
        }
        else if(value==2){
          $("#tblorders").hide();
          $("#warning").show();
        }
        else{
          $("#tblorders").hide();
          $("#warning").hide();
        }
      $('#reason').change(function() {
        var value = $("#reason").val();
        if(value==1){
          $("#tblorders").show();
          $("#warning").hide();
        }
        else if(value==2){
          $("#tblorders").hide();
          $("#warning").show();
        }
        else{
          $("#tblorders").hide();
          $("#warning").hide();
        }
      });

      $('#quan').on('keyup',function() {
        var origValue = $("#quanOrig").val();
        var  intValue = $("#quan").val();
        if(intValue<0){
          var e = "Please input a valid number.";
          $("#quanError").html(e);
          $('#quan').css('border-color','red');
          $('#saveBtn').prop('disabled',true);
        }
        if(intValue==""){
          var e = "Please input a valid number.";
          $("#quanError").html(e);
          $('#quan').css('border-color','red');
          $('#saveBtn').prop('disabled',true);
        }
        if(intValue>origValue){
          var e = "Input must not be greater than " + origValue + ".";
          $("#quanError").html(e);
          $('#quan').css('border-color','red');
          $('#saveBtn').prop('disabled',true);
        }
        else{
          var e = ""
          $("#quanError").html(e);
          $('#quan').css('border-color','grey');
          $('#saveBtn').prop('disabled',false);
        }

        // if(isNaN(intValue)){
        //   var e = "Please input a valid number.";
        //   $("#quanError").html(e);
        //   $('#quan').css('border-color','red');
        //   $('#saveBtn').prop('disabled',true);
        // }
        // else{
        //   var e = ""
        //   $("#quanError").html(e);
        //   $('#quan').css('border-color','grey');
        //   $('#saveBtn').prop('disabled',false);
        // }
        
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
<div id="page-wrapper">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
        <div class="panel panel-info">
          <h3>
              <ul class="nav customtab2 nav-tabs" role="tablist">
               <li role="presentation" class="active" >
                <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="ti-view-list-alt"></i>&nbsp;<span id="archiveTitle" style="display: none;">Pull-Outs</span><span id="titleee">&nbsp;<?php echo $titlePage?></span></a>
              </li>
            </ul>
          </h3>
          <div class="sttabs tabs-style-flip">
            <nav id="hideTabs">
              <ul>
                <li><a href="#receivedeliveries" class="sticon ti-package"><span>Receive Deliveries</span></a></li>
                <li><a href="#deductlogs" class="sticon ti-book"><span>Deduct Logs</span></a></li>
                <li><a href="#deliverylogs" class="sticon ti-map-alt"><span>Delivery Logs</span></a></li>
              </ul>
            </nav>
            <div class="content-wrap text-center">
              <section id="receivedeliveries">
                <a id="tempbtn" class="btn btn-lg btn-info pull-right" href="receive-deliveries.php" aria-expanded="false" style="margin-right: 25px; margin-top: -10px; color:white"><span class="btn-label"><i class="ti-plus"></i></span>Receive Deliveries</a>
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane fade active in" id="type">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <div class="row">
                      <div class="table-responsive">
                        <table class="table color-bordered-table muted-bordered-table dataTable display" id="myTable">
                          <thead>
                            <tr>
                              <th>Material</th>
                              <th>Variant Description</th>
                              <th>Quantity</th>
                                
                              <th class="removeSort">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $sql1 = "SELECT * FROM tblmat_inventory b, tblmat_var a, tblmaterials c WHERE b.matVariantID = a.mat_varID AND a.materialID = c.materialID";
                            $result1 = mysqli_query($conn, $sql1);
                            while ($row1 = mysqli_fetch_assoc($result1))
                            {
                              if($row1['mat_varStatus']=="Active"){
                                echo('<tr><td>'.$row1['materialName'].'</td><td>'.$row1['mat_varDescription'].'</td>  <td>'.$row1['matVarQuantity'].'</td>');
                              
                            ?>
                            <td><!-- <button type="button" class="btn btn-warning" data-toggle="modal" href="raw-materials-management-form.php" data-remote="raw-materials-management-form.php?id=<?php echo $row1['mat_varID']?> #restock" data-target="#myModal">Restock</button> -->

                              <button type="button" class="btn btn-danger" data-toggle="modal" href="raw-materials-management-form.php" data-remote="raw-materials-management-form.php?id=<?php echo $row1['mat_varID']?> #deduct" data-target="#myModal">Deduct</button>
                            </td>
                              <?php echo('</tr>'); }}
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

                    <section id="deductlogs">
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
                                        <th>Material</th>
                                        <th>Variant</th>
                                        <th>Pulled-Out</th>
                                        <th>Remarks</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      $sql = "SELECT * FROM tblmat_deductdetails a, tblmat_inventory b, tblmat_var c, tblmaterials d WHERE a.mat_inventoryID = b.mat_inventoryID and b.matVariantID = c.mat_varID and c.materialID = d.materialID";
                                      $result = mysqli_query($conn, $sql);
                                      while ($row = mysqli_fetch_assoc($result))
                                      {
                                          echo('<tr><td style="text-align: left;">'. $row['materialName'] .'</td>
                                            <td style="text-align: left;">'.$row['mat_varDescription'].'</td>
                                            <td style="text-align: left;">'.$row['mat_deductQuantity'].'</td>
                                            <td style="text-align: left;">'. $row['mat_deductRemarks'].'</td>
                                            ');
                                            ?>
                                            
                                            <?php echo('</tr>'); }
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

                          <section id="deliverylogs">
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
                                        <th>Supplier</th>
                                        <th>Date</th>
                                        <th>Total Quantity</th>
                                        <th>Remarks</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <?php
                                      $sql = "SELECT * FROM tblmat_deliveries a, tblsupplier b, tblmat_deliverydetails c WHERE a.supplierID = b.supplierID and a.mat_deliveriesID = c.del_matDelID";
                                      $result = mysqli_query($conn, $sql);
                                      while ($row = mysqli_fetch_assoc($result))
                                      {
                                          echo('<tr><td style="text-align: left;">'. $row['supCompName'] .'</td>
                                            <td style="text-align: left;">'.$row['dateSupplied'].'</td>
                                            <td style="text-align: left;">'.$row['del_quantity'].'</td>
                                            <td style="text-align: left;">'. $row['del_remarks'].'</td>
                                            ');
                                            ?>

                                            <?php echo('</tr>'); }
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