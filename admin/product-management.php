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
                  <button id="tempbtn" class="btn btn-lg btn-info pull-right" data-toggle="modal" data-target="#myModal" href="product-management-form.php" data-remote="product-management-form.php #newOnHand" aria-expanded="false" style="margin-right: 20px;"><span class="btn-label"><i class="ti-plus"></i></span>New</button>
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
                                    <th>Furniture Type</th>
                                    <th>Furniture Name</th>
                                    <th>Quantity</th>
                                    <th>Actions</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                  $sql = "SELECT * FROM tblproduct a, tblfurn_type b WHERE a.prodTypeID = b.typeID;";
                                  $result = mysqli_query($conn, $sql);
                                  while ($row = mysqli_fetch_assoc($result))
                                  {
                                    if($row['prodQuantity']>0){
                                      echo('<tr><td  style="text-align: left;">'. $row['typeName'] .'</td>
                                        <td  style="text-align: left;">'.$row['productName'].'</td>
                                        <td  style="text-align: left;">'.$row['prodQuantity'].'</td>');
                                        ?>
                                        <td  style="text-align: left;"><button type="button" class="btn btn-success" data-toggle="modal" href="product-management-form.php" data-remote="product-management-form.php #addOnHand" data-target="#myModal">Add</button>

                                          <button type="button" class="btn btn-danger" data-toggle="modal" href="product-management-form.php" data-remote="product-management-form.php #deductOnHand" data-target="#myModal">Deduct</button>
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
                      <div role="tabpanel" class="tab-pane fade active in" id="type">
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
                                    $sql = "SELECT * from tblprodsonpromo a inner join tblproduct b on a.prodPromoID = b.productID inner join tblfurn_type c on b.prodTypeID = c.typeID inner join tblpackages d on a.packPromoID = d.packageID;";
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

    <script>
    $(document).on('hidden.bs.modal', function (e) {
      var target = $(e.target);
      target.removeData('bs.modal')
      .find(".clearable-content").html('');
    });
    </script>
  </body>
  </html>