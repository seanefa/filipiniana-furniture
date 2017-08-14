<?php
include "titleHeader.php";
include "menu.php";
include 'dbconnect.php';
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());

  session_start();
  if(isset($GET['id'])){
    $jsID = $_GET['id'];
  }
  $jsID=$_GET['id'];
  $_SESSION['varname'] = $jsID;
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

  /*  $(document).ready(function(){
      $("#archiveTable").hide();
      $("#backArch").hide();
    $("#showArch").click(function(){
        $("#tblEmployees").hide();
        $("#archiveTable").show();
        $("#temptitle").text("");
        $("#temptitle").text("Archived");
        $("#tempbtn").hide();
        $("#showArch").hide();
        $("#backArch").show();
    $("#backArch").click(function(){
      $("#tblEmployees").show();
        $("#archiveTable").hide();
        $("#temptitle").text("");
        $("#temptitle").text("Employees");
        $("#tempbtn").show();
        $("#showArch").show();
        $("#backArch").hide();
    });
});

    });
    $(document).ready(function(){
     $('body').on('keyup','#username',function(){
    var user = $(this).val();
    var flag = true;
    $.post('employee-check.php',{username : user}, function(data){

      $('#message').html(data);
      if(data != "Already Exist!"){

        //checking of white space
        //pag yung data na sinend is "no white space" meaning may white space.flag true meaning may error.
        //sa required fields lng siguro to kailangan. basta yung may validation lagyan rin nito.
        //dito narin yung symbols lol.
      if(data == "Symbols not allowed"){
        flag = true;
      }
      else{
        if(data == "No white Space"){
          flag = true;
        }
        else{
          flag = false;
        }
      }
      }
      else if(data == "Already Exist!" && data == "" && data == "No white Space" && data == "Symbols not allowed"){
        flag = true;
      }
      //

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
    */

    var tempname;
var error = 0;

    function validateInput(id){

      var user = $('#'+id).val();
      var flag = true;
    $.post('employee-check.php',{username : user}, function(data){

     if(data == 'Already Exist!'){

          $('#addFab').prop('disabled',true);
      $('#message'+id).html(data);
      $('#'+id).css('border-color','red');
     }
     else if(data == 'Symbols not allowed'){

          $('#addFab').prop('disabled',true);
      $('#message'+id).html(data);
      $('#'+id).css('border-color','red');
     }
     else if(data == 'No white Space'){


          $('#addFab').prop('disabled',true);
      $('#message'+id).html(data);
      $('#'+id).css('border-color','red');
     }
     else if(data == ''){
      error = 0;
          $('#message'+id).html('');
          $('#addFab').prop('disabled',true);
      $('#'+id).css('border-color','black');
     }


     else if(data == 'Good!'){
      error = 0;
       $('#message'+id).html('');
     $('#addFab').prop('disabled',false);
      $('#'+id).css('border-color','limegreen');
     }


    });
    }

      function validateUpdate(id){
        var user = $('#edit'+id).val();

      tempname = $('#edit'+id).val();
      temprem = $('#rem').val();
    $.post('employee-Ucheck.php',{username : user}, function(data){

     if(data == 'unchanged'){
      error = 0;
       $('#message'+id).html('');
          $('#updateBtn').prop('disabled',false);
      $('#edit'+id).css('border-color','black');
     }
     else if(data == 'Symbols not allowed'){
       error++;
          $('#updateBtn').prop('disabled',true);
      $('#message'+id).html(data);
      $('#edit'+id).css('border-color','red');
     }
     else if(data == 'No white Space'){
       error++;

          $('#updateBtn').prop('disabled',true);
      $('#message'+id).html(data);
      $('#edit'+id).css('border-color','red');
     }
     else if(data == ''){
      error = 0;
          $('#message'+id).html('');
          $('#updateBtn').prop('disabled',true);
      $('#edit'+id).css('border-color','black');
     }


     else if(data == 'Good!'){
      error = 0;
       $('#message'+id).html('');
     $('#updateBtn').prop('disabled',false);
      $('#edit'+id).css('border-color','limegreen');
     }


    });



      }



 $(document).ready(function(){

         $('body').on('change','#select',function(){
          if($(this).val() == '--'){


          $('#updateBtn').prop('disabled',true);

            }
            else{
          if(error == 0){
          $('#updateBtn').prop('disabled',false);
        }
        else{
          $('#updateBtn').prop('disabled',true);
        }
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
                <button id="tempbtn" class="btn btn-lg btn-info pull-right" data-toggle="modal" data-target="#myModal" href="employee-form.php" data-remote="employee-form.php #new" aria-expanded="false" style="margin-right: 20px;"><span class="btn-label"><i class="ti-plus"></i></span>New</button>
                <li role="presentation" class="active">
                  <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="fa fa-users"></i>&nbsp;<?php echo $titlePage?></a>
                </li>
              </ul>
            </h3>
            <div class="tab-content">
              <!-- PACKAGES -->
              <div role="tabpanel" class="tab-pane fade active in" id=frameworks>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <div class="row">
                      <div class="table-responsive">
                        <table class="table color-bordered-table muted-bordered-table dataTable display nowrap" id="tblEmployees">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>Job</th>
                              <th>Remarks</th>
                              <th class="removeSort">Actions</th>
                            </tr>
                          </thead>
                          <tbody>

                              <?php
                              $sql = "SELECT * FROM tblemployee";
                              $result = mysqli_query($conn, $sql);
                              while ($row = mysqli_fetch_assoc($result))
                              {
                                if($row['empStatus']=="Active"){
                                  echo('<tr><td>'.$row['empLastName'].', '.$row['empFirstName'].' '.$row['empMidName'].'</td>');
                                  $job = jName($row['empJobID']);
                                  echo ('<td>'.$job.'</td>
                                  <td>'.$row['empRemarks'].'</td>'); ?>
                                  <td>
                                    <!-- UPDATE -->
                                    <button type="button" class="btn btn-success" data-toggle="modal" href="employee-form.php" data-remote="employee-form.php?id=<?php echo $row['empID'];?> #update" data-target="#myModal" ><span class='glyphicon glyphicon-edit'></span> Update</button>
                                    <!-- DELETE -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" href="employee-form.php" data-remote="employee-form.php?id=<?php echo $row['empID'];?> #delete" data-target="#myModal" ><span class='glyphicon glyphicon-trash'></span> Deactivate</button>
                                  </td>
                                  <?php echo('</tr>');} }
                                  function jName($id){
                                    include "dbconnect.php";
                                    $sql = "SELECT * from tbljobs WHERE jobID = '$id'";
                                    $result = mysqli_query($conn,$sql);
                                    $cat = "";
                                    while($row = mysqli_fetch_assoc($result)){
                                      $cat = $row['jobName'];
                                    }
                                    return $cat;
                                  }
                                  ?>

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
        </div>
        <!--footer class="footer text-center"> 2017 &copy; Filipiniana Furniture </footer-->
      </div>
    </div>

    <div id="myModal" class="modal fade" role="dialog " aria-hidden="true" style="display: none;" tabindex="-1">
      <div class="modal-dialog">
        <div class="modal-content clearable-content">
          <div class="modal-body">

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
