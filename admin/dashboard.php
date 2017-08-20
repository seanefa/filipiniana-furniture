<?php
include "menu.php";
include "titleHeader.php";
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
    $.post('fab-txt-check.php',{username : user}, function(data){
     
      
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
var error=0;
  $('body').on('keyup','#editname',function(){

      var user = $(this).val();
    
      tempname = $('#editname').val();
      temprem = $('#rem').val();

    $.post('fab-text-Ucheck.php',{username : user}, function(data){
   
      
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
        $('#updateBtn').prop('disabled', true);
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
          if(error==0){
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

   /* $(document).ready(function(){
      $("#archiveTable").hide();
      $("#backArch").hide();
    $("#showArch").click(function(){
        $("#tblFabricTexture").hide();
        $("#archiveTable").show();
        $("#temptitle").text("");
        $("#temptitle").text("Archived");
        $("#tempbtn").hide();
        $("#showArch").hide();
        $("#backArch").show();
    });
    $("#backArch").click(function(){
      $("#tblFabricTexture").show();
        $("#archiveTable").hide();
        $("#temptitle").text("");
        $("#temptitle").text("Fabric Texture");
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
  </div==>
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
                <!--button id="tempbtn" class="btn btn-lg btn-info pull-right" data-toggle="modal" href="fab-text-form.php" data-remote="fab-text-form.php #new" data-target="#myModal" aria-expanded="false" style="margin-right: 20px;"><span class="btn-label"><i class="ti-plus"></i></span>New</button-->
                <li role="presentation" class="active" >
                  <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="fa fa-bell"></i>&nbsp;Notifications</a>
                </li>
              </ul>
            </h3>

            <div class="tab-content">
              <!-- FABRIC TYPE -->
              <div role="tabpanel" class="tab-pane fade active in" id="fabrics">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">      
                    <div class="row">
                      <div class="table-responsive"> 
                        <table class="table color-bordered-table muted-bordered-table dataTable display nowrap" id="tblFabricTexture">
                          <thead>
                            <tr>
                              <th>New Registrations</th>
                              <th>Payments</th>
                              <th>Inquiries</th>
                              <th>Messages</th>
                              <th>Orders</th>
                            </tr>
                          </thead>
                          <tbody>
                          
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- /.modal -->
                  </div>
                </div>  
              </div>
            </div>

            <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="panel panel-info">
            <h3>
              <ul class="nav customtab2 nav-tabs" role="tablist">
                <!--button id="tempbtn" class="btn btn-lg btn-info pull-right" data-toggle="modal" href="fab-text-form.php" data-remote="fab-text-form.php #new" data-target="#myModal" aria-expanded="false" style="margin-right: 20px;"><span class="btn-label"><i class="ti-plus"></i></span>New</button-->
                <li role="presentation" class="active" >
                  <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="fa fa-clock-o"></i>&nbsp;Order History</a>
                </li>
              </ul>
            </h3>

            <div class="tab-content">
              <!-- FABRIC TYPE -->
              <div role="tabpanel" class="tab-pane fade active in" id="fabrics">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                <!-- brochure -->
                          <ul class="nav customtab2">
                              <li class style="border-top:1px solid darkgray;">
                                  <p class="text-success">
                                      <span class="badge" style="background-color:forestgreen;">4</span> Mr. Publico, Doc ordered 2 pieces of Yellow Seat. Mar. 11, 2017
                                      <br>
                                  </p>
                              </li>
                              <li class style="border-top:1px solid darkgray;">
                                  <p class="text-warning">
                                      <span class="badge" style="background-color:red;">3</span> Mr. Dela Cruz, John cancelled his order request. Mar. 6, 2017
                                      <br>
                                  </p>
                              </li>
                              <li class style="border-top:1px solid darkgray;">
                                  <p class="text-success">
                                      <span class="badge" style="background-color:forestgreen;">2</span> Ms. Garcia, Jocelyn ordered 3 Brown Couch. Feb. 25, 2017
                                      <br>
                                  </p>
                              </li>
                              <li class style="border-top:1px solid darkgray;">
                                  <p class="text-muted">
                                      <span class="badge" style="background-color:darkgray;">1</span> Mr. Cruz, Juan order is still pending. Feb. 23, 2017
                                      <br>
                                  </p>
                              </li>
                          </ul>

                        </div>
                      </div>
                    </div>
                    <!-- /.modal -->
                  </div>
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
      </body>
      </html>