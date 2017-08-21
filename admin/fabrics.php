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

$(document).on('focus','.modal',function(){

  $(document).ready(function(){
    // Fabric
    /*
    $('body').on('keyup','#fabricName',function(){
      var user = $(this).val();
      var flag = true;
      $.post('fabric-check.php',{fabricName : user}, function(data){ 
        $('#fabricNameValidate').html(data);
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
          $('#fabricName').css('border-color','red');
        }
        else if(!flag){
          $('#saveBtn').prop('disabled', false);
          $('#fabricName').css('border-color','limegreen');
        }
      });
    });

  });
  */


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
});
  
  $(document).ready(function(){
    var colorCtr=0;
    $('body').on('change','.this-color',function(){
      alert('');
      $('#updateBtn').prop('disabled',false);
    });
    $('body').on('click','#addPicker',function(){

      colorCtr++;
      $('#addHere').append("<input type='color' id='thisColor"+colorCtr+"' class='form-control' name='color[]' required/>");
      if(colorCtr >= 1){
        $('#updateBtn').prop('disabled', false);
      $('#delPicker').attr('type','button');
      }
      else if(colorCtr == 0){
        $('#updateBtn').prop('disabled', false);

      $('#delPicker').attr('type','hidden');
      }
    });
    $('body').on('click','#delPicker',function(){
      $('#thisColor'+colorCtr).remove();
      colorCtr--;
      if(colorCtr >= 1){
        $('#updateBtn').prop('disabled', false);
      $('#delPicker').attr('type','button');
      }
      else if(colorCtr == 0){
        $('#updateBtn').prop('disabled', false);

      $('#delPicker').attr('type','hidden');
      }
    });
  });

    function add() {
    for(var i = 0; i < 1; i++) {
        var input = document.createElement('INPUT');
        var att = document.createAttribute('type');
        att.value = "button";
        input.setAttributeNode(att);
        var picker = new jscolor(input);
        picker.fromHSV(360 / 100 * i, 100, 100);
        alert(jscolor);
        $('#container').append(input);
        }
    }

    $(document).ready(function(){
     $('body').on('keyup','#username',function(){
    var user = $(this).val();
    var flag = true;
    $.post('fabric-check.php',{username : user}, function(data){
     
     if(data == 'Already Exist!'){
       
          $('#addBtn').prop('disabled',true);
      $('#message').html(data);
      $('#username').css('border-color','red');
     }
     else if(data == 'Symbols not allowed'){
       
          $('#addBtn').prop('disabled',true);
      $('#message').html(data);
      $('#username').css('border-color','red');
     }
     else if(data == 'No white Space'){
  

          $('#addBtn').prop('disabled',true);
      $('#message').html(data);
      $('#username').css('border-color','red');
     }
     else if(data == ''){
      error = 0;
          $('#message').html('');
          $('#addBtn').prop('disabled',true);
      $('#username').css('border-color','black');
     }

     
     else if(data == 'Good!'){
      error = 0;
       $('#message').html('');
     $('#addBtn').prop('disabled',false);
      $('#username').css('border-color','limegreen');
     }
      
    
    });

    

  });

});
    $(document).ready(function(){
var temprem;
var tempname;
var error = 0;
var flag = true;
 



  $('body').on('keyup','#editname',function(){
    var user = $(this).val();
    
      tempname = $('#editname').val();
      temprem = $('#rem').val();
    $.post('furn-type-Ucheck.php',{username : user}, function(data){
     
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
        $("#tblFabrics").hide();
        $("#archiveTable").show();
        $("#temptitle").text("");
        $("#temptitle").text("Archived");
        $("#tempbtn").hide();
        $("#showArch").hide();
        $("#backArch").show();
    });
    $("#backArch").click(function(){
      $("#tblFabrics").show();
        $("#archiveTable").hide();
        $("#temptitle").text("");
        $("#temptitle").text("Fabrics");
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
                <button id="tempbtn" class="btn btn-lg btn-info pull-right" data-toggle="modal" href="fabric-forms.php" data-remote="fabric-forms.php #addFab" data-target="#myModal" role="tab" aria-expanded="false" style="margin-right: 20px;"><span class="btn-label"><i class="ti-plus"></i></span>New</button>
                <li role="presentation" class="active">
                  <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="icon-layers"></i>&nbsp;<?php echo $titlePage?></a>
                </li>
              </ul>
            </h3>

            <div class="tab-content">
              <!-- FABRIC -->
              <div role="tabpanel" class="tab-pane fade active in" id="fabrics">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">                   
                    <div class="row">
                      <div class="table-responsive">
                        <table class="table color-bordered-table muted-bordered-table dataTable display" id="tblFabrics">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>Type</th>
                              <th>Pattern</th>
                              <th>Color</th>
                              <th>Description</th>
                              <th class="removeSort">Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            
                              <?php
                              $sql = "SELECT * FROM tblfabrics;";
                              $result = mysqli_query($conn, $sql);
                              while ($row = mysqli_fetch_assoc($result))
                              {
                                $colorDb = $row['fabricColor'];
                                $colorArray = explode(',',$colorDb);
                                $colorCtr = count($colorArray);
                                $id = $row['fabricID'];
                                if($row['fabricStatus']=="Listed"){
                                  echo '<tr><td>'.$row['fabricName'].'</td>';
                                  $type = ftype($row['fabricTypeID']) ;
                                  $pattern = fpattern($row['fabricPatternID']) ;
                                  echo '<td>'. $type .'</td>';
                                  echo '<td>'. $pattern .'</td>';
                                  echo ('<td>'.$colorDb.'</td>');
                                  echo '<td>'. $row['fabricRemarks'] .'</td>';
                                  ; ?>
                                  <td>
                                    <button type="button" class="btn btn-warning" href="fabric-forms.php" data-remote="fabric-forms.php?id=<?php echo $row['fabricID'];?> #viewFab" data-toggle="modal" data-target="#myModal"><i class='fa fa-info-circle'></i> View</button>
                                    <br>
                                    <!-- UPDATE -->
                                    <button type="button" class="btn btn-success" data-toggle="modal" href='fabric-forms.php' data-remote="fabric-forms.php?id=<?php echo $row['fabricID'];?> #updateFab" data-target="#myModal"><i class='ti-pencil-alt'></i> Update</button>
                                    <br>
                                    <!-- DELETE -->
                                    <button type="button" class="btn btn-danger" href="fabric-forms.php" data-remote="fabric-forms.php?id=<?php echo $row['fabricID'];?> #delFab" data-target="#myModal" data-toggle="modal"><i class='ti-close'></i> Deactivate</button>
                                  </td>
                                  <?php echo ('</tr>'); }}
                                  function ftype($id){
                                    include "dbconnect.php";
                                    $type = "";
                                    $sql = "SELECT * from tblfabric_type WHERE f_typeID = '$id'";
                                    $result = mysqli_query($conn,$sql);
                                    while($row = mysqli_fetch_assoc($result)){
                                      $type = "" . $row['f_typeName'];
                                    }
                                    return $type;
                                  }
                                  function fpattern($id){
                                    include "dbconnect.php";
                                    $pattern = "";
                                    $sql = "SELECT f_patternName from tblfabric_pattern WHERE f_patternID = '$id'";
                                    $result = mysqli_query($conn,$sql);
                                    while($row = mysqli_fetch_assoc($result)){
                                      $pattern = "" . $row['f_patternName'];
                                    }
                                    return $pattern;
                                  }
                                  ?>
                                
                              </tbody>
                            </table>
                          </div>
                        </div>
                      </div>
                    </div>
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