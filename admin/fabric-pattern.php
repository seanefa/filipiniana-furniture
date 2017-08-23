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
    // Unit Name
    $('body').on('keyup','#fabricPatternName',function(){
      var user = $(this).val();
      var flag = true;


      if(user == '\\'){
        user.replace('\\', "");
        $('#fabricPatternName').val('');
      }else{
      $.post('fab-pat-check.php',{fabricPatternName : user}, function(data){ 
        $('#fabricPatternNameValidate').html(data);
        if(data != "Data Already Exist!"){
          if(data == "Symbols not allowed"){
        flag = true;
      }
      else{
        if(data == "White Space not allowed"){
          flag = true;
        }
        else{
          flag = false;
        }
      }
      }
      else if(data == "Data Already Exist!" && data == "" && data == "White Space not allowed" && data == "Symbols not allowed"){
        flag = true;
      }

        if(flag){
          $('#saveBtn').prop('disabled',true);
          $('#fabricPatternName').css('border-color','red');
        }
        else if(!flag){
          $('#saveBtn').prop('disabled', false);
          $('#fabricPatternName').css('border-color','limegreen');
        }
      });
    }
    });

  });

    $(document).ready(function(){
var temprem;
var tempname;
var error = 0;
var flag = true;
var userkey= '';



  $('body').on('keyup','#editname',function(){
    var user = $(this).val();
    
      tempname = $('#editname').val();
      temprem = $('#rem').val();

      userkey = $('#editname').val();
      userkey = userkey.slice(userkey.length -1 , userkey.length);

      if(userkey == '\\'){
        $('#editname').val(
        user.slice(0, user.length - 1));
      }else{
    $.post('fab-pat-Ucheck.php',{username : user}, function(data){
     
     if(data == 'unchanged'){
      error = 0;
       $('#message').html('');
          $('#updateBtn').prop('disabled',false);
      $('#editname').css('border-color','black');
     }
     else if(data == 'Already Exist!'){
       error++;
          $('#updateBtn').prop('disabled',true);
      $('#message').html(data);
      $('#editname').css('border-color','red');
     }
     else if(data == 'Symbols not allowed'){
       error++;
          $('#updateBtn').prop('disabled',true);
      $('#message').html(data);
      $('#editname').css('border-color','red');
     }
     else if(data == 'No white Space'){
       error++;

          $('#updateBtn').prop('disabled',true);
      $('#message').html(data);
      $('#editname').css('border-color','red');
     }
     else if(data == ''){
      error = 0;
          $('#message').html('');
          $('#updateBtn').prop('disabled',true);
      $('#editname').css('border-color','black');
     }

     
     else if(data == 'Good!'){
      error = 0;
       $('#message').html('');
     $('#updateBtn').prop('disabled',false);
      $('#editname').css('border-color','limegreen');
     }


    });

    }

  });
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
  /*  $(document).ready(function(){
      $("#archiveTable").hide();
      $("#backArch").hide();
    $("#showArch").click(function(){
        $("#tblFabricPattern").hide();
        $("#archiveTable").show();
        $("#temptitle").text("");
        $("#temptitle").text("Archived");
        $("#tempbtn").hide();
        $("#showArch").hide();
        $("#backArch").show();
    });
    $("#backArch").click(function(){
      $("#tblFabricPattern").show();
        $("#archiveTable").hide();
        $("#temptitle").text("");
        $("#temptitle").text("Fabric Pattern");
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
                <button id="tempbtn" class="btn btn-lg btn-info pull-right" data-toggle="modal" href="fab-pattern-forms.php" data-remote="fab-pattern-forms.php #new" data-target="#myModal" role="tab" aria-expanded="false" style="margin-right: 20px;"><span class="btn-label"><i class="ti-plus"></i></span>New</button>
                <li role="presentation" class="active">
                  <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="ti-widgetized"></i>&nbsp;<?php echo $titlePage?></a>
                </li>
              </ul>
            </h3>
            <div class="tab-content">
              <!-- FABRIC PATTERN -->
              <div role="tabpanel" class="tab-pane fade active in" id=fabrics>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">                  
                    <div class="row">
                      <div class="table-responsive">
                        <table class="table color-bordered-table muted-bordered-table dataTable display" id="tblFabricPattern">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>Remarks</th>
                              <th class="removeSort">Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            
                              <?php
                              $sql = "SELECT * FROM tblfabric_pattern;";
                              $result = mysqli_query($conn, $sql);
                              while ($row = mysqli_fetch_assoc($result))
                              {
                                if($row['f_patternStatus']=="Listed"){
                                  echo('<tr>
                                    <td>'.$row['f_patternName'].'</td>
                                    <td>'.$row['f_patternRemarks'].'</td>
                                    '); ?>
                                    <td>
                                      <!-- UPDATE -->
                                      <button type="button" class="btn btn-success" data-toggle="modal" href="fab-pattern-forms.php" data-remote="fab-pattern-forms.php?id=<?php echo $row['f_patternID'];?> #update" data-target="#myModal"><i class='ti-pencil-alt'></i> Update</button>
                                      <!-- DELETE -->
                                      <button type="button" class="btn btn-danger" data-toggle="modal" href="fab-pattern-forms.php" data-remote="fab-pattern-forms.php?id=<?php echo $row['f_patternID'];?> #delete" data-target="#myModal"><i class='ti-close'></i> Deactivate</button>
                                    </td>
                                    <?php echo ('</tr>'); }}?>
                                  
                                  <script type="text/javascript">
                                    function confirmDelete(id) {
                                      if (confirm("Are you sure you want to delete")) {
                                        window.location.href="delete-fabric.php?id="+id+"";
                                      }
                                    }
                                    function edit(id) {
                                      window.location.href="update-fabric.php?id="+id+"";
                                    }
                                  </script>
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

        <!--<a data-toggle="modal" href="form.php" data-remote="form.php #form1" data-target="#myModal">Page 1 Modal Content</a>-->

        <script>
          $(document).on('hidden.bs.modal', function (e) {
            var target = $(e.target);
            target.removeData('bs.modal')
            .find(".clearable-content").html('');
          });
        </script>
      </body>
      </html>