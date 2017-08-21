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
    $('body').on('keyup','#unitName',function(){
      var user = $(this).val();
      var flag = true;
      $.post('umeasure-check.php',{unitName : user}, function(data){ 
        $('#unitNameValidate').html(data);
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
          $('#unitName').css('border-color','red');
        }
        else if(!flag){
          $('#saveBtn').prop('disabled', false);
          $('#unitName').css('border-color','limegreen');
        }
      });
    });


    // Unit Measure
    $('body').on('keyup','#unitMeasure',function(){
      var user = $(this).val();
      var flag = true;
      $.post('umeasure-check.php',{unitMeasure : user}, function(data){ 
        $('#unitMeasureValidate').html(data);
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
          $('#unitMeasure').css('border-color','red');
        }
        else if(!flag){
          $('#saveBtn').prop('disabled', false);
          $('#unitMeasure').css('border-color','limegreen');
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
    $.post('umeasure-form-Ucheck.php',{username : user}, function(data){
     
      
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
                <button id="tempbtn" class="btn btn-lg btn-info pull-right" data-toggle="modal" href="umeasure-form.php" data-remote="umeasure-form.php #new" data-target="#myModal" aria-expanded="false" style="margin-right: 20px;"><span class="btn-label"><i class="ti-plus"></i></span>New</button>
                <li role="presentation" class="active" >
                  <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="ti-ruler-alt-2"></i>&nbsp;<?php echo $titlePage?></a>
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
                        <table class="table color-bordered-table muted-bordered-table dataTable display" id="tblFabricTexture">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>Unit</th>
                              <th class="removeSort">Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                          
                              <?php
                              $sql = "SELECT * FROM tblunitofmeasure;";
                              $result = mysqli_query($conn, $sql);
                              while ($row = mysqli_fetch_assoc($result))
                              {
                                if($row['unStatus'] !="Archived"){
                                  echo('<tr>
                                    <td>'.$row['unType'].'</td>
                                    <td>'.$row['unUnit'].'</td>
                                    '); ?>
                                    <td>
                                      <!-- UPDATE -->
                                      <button type="button" class="btn btn-success" data-toggle="modal" href="umeasure-form.php" data-remote="umeasure-form.php?id=<?php echo $row['unID'];?> #update" data-target="#myModal"><i class='ti-pencil-alt'></i> Update</button>
                                      <!-- DELETE -->
                                      <button type="button" class="btn btn-danger" data-toggle="modal" href="umeasure-form.php" data-remote="umeasure-form.php?id=<?php echo $row['unID'];?> #delete" data-target="#myModal"><i class='ti-close'></i>  Deactivate</button>
                                    </td>
                                    <?php echo ('</tr>'); }}?>

                                  <script type="text/javascript">
                                    function confirmDelete(id) {
                                      if (confirm("Are you sure you want to delete")) {
                                        window.location.href="delete-unit-of-measurement.php?id="+id+"";
                                      }
                                    }
                                    function edit(id) {
                                      window.location.href="update-unit-of-measurement.php?id="+id+"";
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

        <script>
          $(document).on('hidden.bs.modal', function (e) {
            var target = $(e.target);
            target.removeData('bs.modal')
            .find(".clearable-content").html('');
          });
        </script>
      </body>
      </html>