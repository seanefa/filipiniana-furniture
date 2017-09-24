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
<script src="//cdnjs.cloudflare.com/ajax/libs/react/0.14.7/react-with-addons.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/react/0.14.7/react-dom.js"></script>

    <!-- Literally Canvas -->
    <script src="js/literallycanvas.js"></script>
  <script type="text/javascript"></script>
  <link href="css/literallycanvas.css" rel="stylesheet">
  <script>
  $(document).ready(function(){
    // Unit Name
    var userkey = '';
    $('body').on('keyup','#frameName',function(){
      var user = $(this).val();
      var flag = true;

      userkey = $(this).val();
      userkey = userkey.slice(userkey.length -1 , userkey.length);
      if(user == '\\'){
         $('#frameNameValidate').html('Symbols not allowed');
        $('#saveBtn').prop('disabled',true);
          $('#frameName').css('border-color','red');

      }else{
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
    }
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
 var userkey = '';



  $('body').on('keyup','#editname',function(){
    var user = $(this).val();
    
      tempname = $('#editname').val();
      temprem = $('#rem').val();

      userkey = $('#editname').val();
      userkey = userkey.slice(userkey.length -1 , userkey.length);

      if(userkey == '\\'){
        $('#updateBtn').prop('disabled',true);
      $('#message').html('Symbols not allowed');
      $('#editname').css('border-color','red');
      }else{
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


                    var lc,d;
                    $('body').on('focus','.modal',function(){
                      lc = LC.init(
                              document.getElementsByClassName('literCanvas')[0],
                              {
                                imageURLPrefix: 'img',
                               tools: [LC.tools.Line,LC.tools.Eraser,
                              LC.tools.Rectangle, LC.tools.Ellipse, LC.tools.Eyedropper, LC.tools.Polygon, LC.tools.Pan],
                              toolbarPosition : 'bottom'
                              }
                          );
                      $('#saveDesign').on('click',function(){
                        
                        d =lc.getImage().toDataURL();
                        
                        $('.literCanvas').hide();
                        $('#saveDesign').hide();

                        $('#newDesign').show();

                        $('#savedImage').show();
                        $('#savedImage').prop('src',d);

                        $('#anotherDesign').show();
                        $('#productDesc').show();
                        $('#closeCanvas').hide();
                      });
                      $('#newDesign').on('click', function(){
                        $('.literCanvas').show();
                        $('#closeCanvas').show()
                        $('#savedImage').hide();
                        $('#newDesign').hide();
                        $('#saveDesign').show();

                        $('#anotherDesign').hide();
                        $('#productDesc').hide();
                        lc.clear();
                      });

                      //open and close
                      $('#openCanvas').on('click',function(){
                        $('#toUpload').hide();
                        $('#toCustomize').show();
                      });
                      $('#closeCanvas').on('click',function(){
                        $('#toUpload').show();
                        $('#toCustomize').hide();
                      });
                      //

                    });



$(document).ready(function(){
  $("#archiveTable").hide();
  $('#archiveSwitch').change(function(){
    if($(this).prop("checked")) {
      $('#archiveTable').show();
      $('#archiveTitle').css({'display' : ''});
      $("#tempbtn").hide();
      $('#mainTable').hide();
    } else {
      $('#archiveTable').hide();
      $('#archiveTitle').css({'display' : 'none'});
      $('#mainTable').show();
      $("#tempbtn").show();
    }
  });

  // Tooltip only Text
  $('.masterTooltip').hover(function(){
          // Hover over code
          var title = $(this).attr('title');
          $(this).data('tipText', title).removeAttr('title');
          $('<p class="tooltipsy"></p>')
          .text(title)
          .appendTo('body')
          .fadeIn('slow');
  }, function() {
          // Hover out code
          $(this).attr('title', $(this).data('tipText'));
          $('.tooltipsy').remove();
  }).mousemove(function(e) {
          var mousex = e.pageX + -100; //Get X coordinates
          var mousey = e.pageY + -15; //Get Y coordinates
          $('.tooltipsy')
          .css({ top: mousey, left: mousex })
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
                <button id="tempbtn" class="btn btn-lg btn-info pull-right" data-toggle="modal" href="framework-form.php" data-remote="framework-form.php #new" data-target="#myModal" aria-expanded="false" style="margin-right: 20px;"><span class="btn-label"><i class="ti-plus"></i></span>New</button>
                <li role="presentation" class="active" >
                <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="ti-ink-pen"></i>&nbsp;<span id="archiveTitle" style="display: none;">Archived</span>&nbsp;<?php echo $titlePage?></a>
              </li>
            </ul>
          </h3>
          <div class="pull-right" style="margin-right: 20px; margin-top: -10px;">
            <a href="javascript:void(0)" title="Archives" class="masterTooltip"><input type="checkbox" class="js-switch" id="archiveSwitch" data-color="#f96262" style="display: none;" data-switchery="true"></a>
          </div>
            <div class="tab-content">
              <!-- FRAMEWORKS -->
              <div role="tabpanel" class="tab-pane fade active in" id=frameworks>
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">                
                    <div class="row">
                      <div class="table-responsive" id="mainTable">

                        <table class="table color-bordered-table muted-bordered-table dataTable display" id="tblframeworks">
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
                                    <button type="button" class="btn btn-warning" data-toggle="modal" href="framework-form.php" data-remote="framework-form.php?id=<?php echo $row['frameworkID']?> #view" data-target="#myModal"><i class='fa fa-info-circle'></i> View</button>
                                    <!-- UPDATE -->
                                    <button type="button" class="btn btn-success" data-toggle="modal" href="framework-form.php" data-remote="framework-form.php?id=<?php echo $row['frameworkID']?> #update" data-target="#myModal"><i class='ti-pencil-alt'></i> Update</button>
                                    <!-- DELETE -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" href="framework-form.php" data-remote="framework-form.php?id=<?php echo $row['frameworkID']?> #delete" data-target="#myModal"><i class='ti-close'></i> Deactivate</button>
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

                        <div id="archiveTable">
                          <div class="table-responsive"> 
                            <table class="table color-bordered-table muted-bordered-table dataTable display">
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
                                if($row['frameworkStatus']=="Archived"){
                                  echo('<tr><td>'.$row['frameworkName'].'</td>');
                                  $design = dName($row['framedesignID']);
                                  $material = mName($row['materialUsedID']);
                                  echo '<td>'.$material.'</td><td>'.$design.'</td><td>'.$row['frameworkRemarks'].'</td>'; ?>
                                  <td>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" href="reactivate-form.php" data-remote="reactivate-form.php?rName=Frameworks&amp;id=<?php echo $row['frameworkID']?> #reactivate" data-target="#myModal"><i class="ti-reload"></i> Reactivate</button> 
                                  </td>
                                  <?php echo('</tr>');}}?>
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