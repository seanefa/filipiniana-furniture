<?php
include "titleHeader.php";
include "menu.php";
include "dbconnect.php";
//session_start();
/*if(isset($GET['id'])){
$jsID = $_GET['id']; 
}
$jsID=$_GET['id'];
$_SESSION['varname'] = $jsID;*/
include 'dbconnect.php';
$conn = mysqli_connect($servername, $username, $password, $dbname);
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
    $('body').on('keyup','#frameName',function(){
      var user = $(this).val();
      var flag = true;
      $.post('framework-check.php',{frameName : user}, function(data){ 
        $('#frameNameValidate').html(data);
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
          $('#frameName').css('border-color','red');
        }
        else if(!flag){
          $('#saveBtn').prop('disabled', false);
          $('#frameName').css('border-color','limegreen');
        }
      });
    });

  });

  $(document).on('focus','.modal',function(){
            // Basic
            $('.dropify').dropify();
            // Translated
            $('.dropify-fr').dropify({
                messages: {
                    default: 'Glissez-déposez un fichier ici ou cliquez'
                    , replace: 'Glissez-déposez un fichier ou cliquez pour remplacer'
                    , remove: 'Supprimer'
                    , error: 'Désolé, le fichier trop volumineux'
                }
            });
            // Used events
            var drEvent = $('#input-file-events').dropify();
            drEvent.on('dropify.beforeClear', function (event, element) {
                return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
            });
            drEvent.on('dropify.afterClear', function (event, element) {
                alert('File deleted');
            });
            drEvent.on('dropify.errors', function (event, element) {
                console.log('Has Errors');
            });
            var drDestroy = $('#input-file-to-destroy').dropify();
            drDestroy = drDestroy.data('dropify')
            $('#toggleDropify').on('click', function (e) {
                e.preventDefault();
                if (drDestroy.isDropified()) {
                    drDestroy.destroy();
                }
                else {
                    drDestroy.init();
                }
            })
        });

/*$('body').on('change','.fileUpload',function(){
        filePreview(this);
    });

  function filePreview(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#uploadForm + img').remove();
            $('#uploadForm').after('<img src="'+e.target.result+'" width="450" height="300"/>');
            //$('#uploadForm + embed').remove();
            //$('#uploadForm').after('<embed src="'+e.target.result+'" width="450" height="300">');
        }
        reader.readAsDataURL(input.files[0]);
        }
    }
*/

    $(document).ready(function(){
var temprem;
var tempname;
var error = 0;
var flag = true;
 



  $('body').on('keyup','#editname',function(){
    var user = $(this).val();
    
      tempname = $('#editname').val();
      temprem = $('#rem').val();
    $.post('framework-Ucheck.php',{username : user}, function(data){
     
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
        $("#tblframeworks").hide();
        $("#archiveTable").show();
        $("#temptitle").text("");
        $("#temptitle").text("Archived");
        $("#tempbtn").hide();
        $("#showArch").hide();
        $("#backArch").show();
    });
    $("#backArch").click(function(){
      $("#tblframeworks").show();
        $("#archiveTable").hide();
        $("#temptitle").text("");
        $("#temptitle").text("Frameworks");
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
                <button id="tempbtn" class="btn btn-lg btn-info pull-right" data-toggle="modal" href="framework-form.php" data-remote="framework-form.php #new" data-target="#myModal" aria-expanded="false" style="margin-right: 20px;"><span class="btn-label"><i class="ti-plus"></i></span>New</button>
                <li role="presentation" class="active">
                  <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"></span><i class="ti-ink-pen"></i>&nbsp;<?php echo $titlePage?></a>
                </li>
              </ul>
            </h3>
            <div class="tab-content">
              <!-- FRAMEWORKS -->
              <div role="tabpanel" class="tab-pane fade active in" id=frameworks>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">                
                    <div class="row">
                      <div class="table-responsive">
                        <table class="table color-bordered-table muted-bordered-table dataTable display nowrap" id="tblframeworks">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>Material</th>
                              <th>Design</th>
                              <th>Remarks</th>
                              <th class="removeSort">Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            
                              <?php
                              $sql = "SELECT * FROM tblframeworks;";
                              $result = mysqli_query($conn, $sql);
                              while ($row = mysqli_fetch_assoc($result))
                              {
                                if($row['frameworkStatus']=="Listed"){
                                  echo('<tr><td>'.$row['frameworkName'].'</td>');
                                  $design = dName($row['framedesignID']);
                                  $material = mName($row['materialUsedID']);
                                  echo '<td>'.$material.'</td><td>'.$design.'</td><td>'.$row['frameworkRemarks'].'</td>'; ?>
                                  <td>
                                    <button type="button" class="btn btn-warning" data-toggle="modal" href="framework-form.php" data-remote="framework-form.php?id=<?php echo $row['frameworkID']?> #view" data-target="#myModal"><span class='glyphicon glyphicon-eye-open'></span> View</button>
                                    <!-- UPDATE -->
                                    <button type="button" class="btn btn-success" data-toggle="modal" href="framework-form.php" data-remote="framework-form.php?id=<?php echo $row['frameworkID']?> #update" data-target="#myModal"><span class='glyphicon glyphicon-edit'></span> Update</button>
                                    <!-- DELETE -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" href="framework-form.php" data-remote="framework-form.php?id=<?php echo $row['frameworkID']?> #delete" data-target="#myModal"><span class='glyphicon glyphicon-trash'></span> Deactivate</button>
                                  </td>
                                  <?php echo('</tr>');} }

                                  function dName($id){
                                    $name = "";
                                    include "dbconnect.php";
                                    $sql = "SELECT designName from tblframe_design WHERE designID = '$id'";
                                    $result = mysqli_query($conn,$sql);
                                    while($row = mysqli_fetch_assoc($result)){
                                      $name = $row['designName'];
                                    }
                                    return $name;
                                  }
                              
                              function mName($id){
                                    $name = "";
                                    include "dbconnect.php";
                                    $sql = "SELECT materialName from tblframe_material WHERE materialID = '$id'";
                                    $result = mysqli_query($conn,$sql);
                                    while($row = mysqli_fetch_assoc($result)){
                                      $name = $row['materialName'];
                                    }
                                    return $name;
                                  }

                                  ?>
                                
                                <script>
                                  function confirmDelete(id) {
                                    window.location.href="delete-frame.php?id="+id+"";
                                  }
                                  function edit(id) {
                                    window.location.href="update-framework.php?id="+id+"";
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
        </div>
        <!--footer class="footer text-center"> 2017 &copy; Filipiniana Furniture </footer-->
      </div>
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