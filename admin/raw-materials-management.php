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

    $('body').on('keyup','#username',function(){
      var user = $(this).val();
      var flag = true;
      $.post('furn-type-check.php',{username : user}, function(data){


        if(data != "Already Exist!"){
          flag = false;
          $('#message').html("");

        }
        else if(data == "Already Exist!"){
          $('#message').html(data);
          flag = true;
        }
        if(flag){
          $('#addFab').prop('disabled',true);

          $('#username').css('border-color','red');
        }
        else if(!flag){
          $('#addFab').prop('disabled', false);

          $('#username').css('border-color','limegreen');
        }
      });



    });


  });
  $(document).ready(function(){
    var temprem;
    var tempname;
    var error = 0;
    $('body').on('keyup','#editname',function(){
      var user = $(this).val();

      tempname = $('#editname').val();
      temprem = $('#rem').val();
      $.post('furn-type-Ucheck.php',{username : user}, function(data){


        if(data != "Already Exist!" && data !="unchanged"){
          flag = false;
          error = 0;
          $('#message').html("");
          $('#updateBtn').prop('disabled', false);
          $('#editname').css('border-color','limegreen');

        }
        if(data == "unchanged"){
          error = 0;
          $('#message').html("");
          $('#editname').css('border-color','black')
        }
        else if(data == "Already Exist!"){
          flag = true;
          error++;
          $('#message').html(data);
          $('#updateBtn').prop('disabled',true);

          $('#editname').css('border-color','red');
        }

      });



    });
    $('body').on('change','#rem',function(){
      if(error == 0){
        $('#updateBtn').prop('disabled',false);
      }

    });
    $('body').on('keyup','#remText',function(){
      var tem = $(this).val();
      if(error == 0){
        flag = false;
        if(!flag){
          $('#updateBtn').prop('disabled',false);
        }
      }
    });

  });

/*  $(document).ready(function(){
  $("#archiveTable").hide();
  $("#backArch").hide();
$("#showArch").click(function(){
    $("#tblFurnitureType").hide();
    $("#archiveTable").show();
    $("#temptitle").text("");
    $("#temptitle").text("Archived");
    $("#tempbtn").hide();
    $("#showArch").hide();
    $("#backArch").show();
});
$("#backArch").click(function(){
  $("#tblFurnitureType").show();
    $("#archiveTable").hide();
    $("#temptitle").text("");
    $("#temptitle").text("Furniture Type");
    $("#tempbtn").show();
    $("#showArch").show();
    $("#backArch").hide();
});
}); */
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
                  <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="ti-dropbox"></i>&nbsp;<?php echo $titlePage?></a>
                </li>
              </ul>
            </h3>

            <div class="sttabs tabs-style-flip">
              <nav>
                <ul>
                  <li><a href="#home" class="sticon ti-home"><span>Home</span></a></li>
                  <li><a href="#purchaseorder" class="sticon ti-reload"><span>Purchase Order</span></a></li>
                  <li><a href="#acceptdelivery" class="sticon ti-time"><span>Accept Delivery</span></a></li>
                </ul>
              </nav>
              <div class="content-wrap text-center">

                <section id="home">
                  <div class="tab-content">
                    <!-- CATEGORY -->
                    <div role="tabpanel" class="tab-pane fade active in" id="type">
                      <div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="panel-body">
                          <div class="row">
                            <div class="table-responsive">
                              <table class="table color-bordered-table muted-bordered-table dataTable display nowrap" id="myTable">
                                <thead>
                                  <tr>
                                    <th>Material</th>
                                    <th>Variant Description</th>
                                    <th>Quantity</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td><button type="button" class="btn btn-danger" data-toggle="modal" href="raw-materials-management-form.php" data-remote="raw-materials-management-form.php?id=<?php echo $row['variantID']?> #deduct" data-target="#myModal">Deduct</button></td>
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

                <section id="purchaseorder">
                  <div class="tab-content">
                    <!-- CATEGORY -->
                    <div role="tabpanel" class="tab-pane fade active in" id="type">
                      <div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="panel-body">
                          <div class="row">
                            <div class="col-md-6">
                            <label class="control-label pull-left">Supplier: </label>
                              <div class="col-md-10 pull-right">
                                <select>
                                  <option>A Supplier</option>
                                </select>
                              </div>
                            </div>

                          <div class="col-md-6 pull-right">
                            <button type="button" class="btn btn-warning" id="ViewPOButton" data-href="view-purchase-orders.php" style="position:relative; display:inline-block; margin-top:-110px; margin-right:-90px;"><span class='glyphicon glyphicon-eye-open'></span> View P.O's</button>
                          </div>
                          </div>
                          <br>
                          <div class="row">
                            <div class="col-md-6">
                            <label class="control-label pull-left">Material: </label>
                              <div class="col-md-10 pull-right">
                                <select>
                                  <option>Material</option>
                                </select>
                              </div>
                            </div> 
                            <div class="col-md-6">
                            <label class="control-label pull-left">Variant: </label>
                              <div class="col-md-10 pull-right">
                                <select>
                                  <option>Variant</option>
                                </select>
                              </div>
                            </div> 
                          </div>
                          <br>
                          <div class="row">
                            <div class="table-responsive">
                              <table class="table color-bordered-table muted-bordered-table display nowrap" id="myTable">
                                <thead>
                                  <tr>
                                    <th>Quantity</th>
                                    <th>Unit</th>
                                    <th>Item Description</th>
                                    <th>Item Cost</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                    </tbody>
                                    </table>
                                  </div>
                                </div>
                                <br>
                          
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                     <label class="control-label pull-left">Remarks</label>
                     <div class="row">
                      <div class="col-md-12">
                     <textarea rows="4" cols="70" class="pull-left"></textarea>
                   </div>
                   </div>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                     <label class="control-label">GRAND TOTAL:</label>
                     <div class="row">
                      <div class="col-md-12">
                     <input type="text" disabled>
                   </div>
                   </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                  <button type="submit" class="btn btn-success waves-effect text-left" id="addFab" disabled=""><i class="fa fa-check"></i> Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
          </div>
                </div>
                </div>



                              </div>
                            </div>
                          </div>
                  <!-- New Framework Mo
                  <!-- /.modal -->
                </div>
              </section>

              <section id="acceptorder">
                  <div class="tab-content">
                    <!-- CATEGORY -->
                    <div role="tabpanel" class="tab-pane fade active in" id="type">
                      <div class="panel-wrapper collapse in" aria-expanded="true">
                        <div class="panel-body">
                          <div class="row">
                            <div class="col-md-6">
                            <label class="control-label pull-left">Supplier: </label>
                              <div class="col-md-8 pull-right">
                                <select>
                                  <option>FNC Ent</option>
                                </select>
                              </div>
                            </div> 
                          </div>
                          <br>
                          <div class="row">
                            <div class="col-md-6">
                            <label class="control-label pull-left">P.O. ID: </label>
                              <div class="col-md-8 pull-right">
                                <select>
                                  <option>1</option>
                                </select>
                              </div>
                            </div> 
                            <!--<div class="col-md-6">
                            <label class="control-label pull-left">Date: </label>
                              <div class="col-md-10 pull-right">
                                <input type="date">
                              </div>
                            </div> -->
                          </div>
                          <br>
                          <div class="row">
                            <div class="table-responsive">
                              <table class="table color-bordered-table muted-bordered-table display nowrap" id="myTable">
                                <thead>
                                  <tr>
                                    <th>#</th>
                                    <th>Item Description</th>
                                    <th>Quantity</th>
                                    <th>Item Cost</th>
                                    <th>Remarks</th>
                                    <th>Actions</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                    </tbody>
                                    </table>
                                  </div>
                                </div>
                                <br>
                          
                <div class="row">
                    <div class="col-md-12 pull-right">
                  <button type="submit" class="btn btn-success waves-effect text-left" id="addFab" disabled=""><i class="fa fa-check"></i>Accept</button>
            <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
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
  <div class="modal-dialog">
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

<script type="text/javascript">
            $('#ViewPOButton').click(function(e) {
                e.preventDefault(); e.stopPropagation();
                window.location.href = $(e.currentTarget).data().href;
            });
        </script>

</script>
</body>
</html>