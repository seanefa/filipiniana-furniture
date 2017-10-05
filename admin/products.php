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
    
    $('body').on('keyup','#thisPrice',function(event) {

  // skip for arrow keys
  if(event.which >= 37 && event.which <= 40) return;

  // format number
  $(this).val(function(index, value) {
    return value
    .replace(/\D/g, "")
    .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    ;
  });
});
    $('body').on('keyup','#remText',function(event) {

  // skip for arrow keys
  if(event.which >= 37 && event.which <= 40) return;

  // format number
  $(this).val(function(index, value) {
    return value
    .replace(/\D/g, "")
    .replace(/\B(?=(\d{3})+(?!\d))/g, ",")
    ;
  });
});

    $(document).ready(function(){
      var userkey = '';
     $('body').on('keyup','#username',function(){
    var user = $(this).val();
    var flag = true;

    userkey = $(this).val();
      userkey = userkey.slice(userkey.length -1 , userkey.length);
    if(userkey == '\\'){
        $('#addFab').prop('disabled',true);$('#notif').html('Some Fields have Error');
      $('#message').html('Symbols not allowed');
      $('#username').css('border-color','red');
      }else{
    $.post('prod-check.php',{username : user}, function(data){
     
     if(data == 'Already Exist!'){
       
          $('#addFab').prop('disabled',true);$('#notif').html('Some Fields have Error');
      $('#message').html(data);
      $('#username').css('border-color','red');
     }
     else if(data == 'Symbols not allowed'){
       
          $('#addFab').prop('disabled',true);$('#notif').html('Some Fields have Error');
      $('#message').html(data);
      $('#username').css('border-color','red');
     }
     else if(data == 'No white Space'){
  

          $('#addFab').prop('disabled',true);$('#notif').html('Some Fields have Error');
      $('#message').html(data);
      $('#username').css('border-color','red');
     }
     else if(data == ''){
      error = 0;
          $('#message').html('');
          $('#addFab').prop('disabled',true);$('#notif').html('');
      $('#username').css('border-color','black');
     }

     
     else if(data == 'Good!'){
      error = 0;
       $('#message').html('');
     $('#addFab').prop('disabled',false);$('#notif').html('');
      $('#username').css('border-color','limegreen');
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
 var userkey = '';



  $('body').on('keyup','#editname',function(){
    var user = $(this).val();
    
      tempname = $('#editname').val();
      temprem = $('#rem').val();

      userkey = $('#editname').val();
      userkey = userkey.slice(userkey.length -1 , userkey.length);

      if(userkey == '\\'){
        $('#updateBtn').prop('disabled',true);$('#notif').html('Some Fields have Error');
      $('#message').html('Symbols not allowed');
      $('#editname').css('border-color','red');
      }else{
    $.post('prod-Ucheck.php',{username : user}, function(data){
     
     if(data == 'unchanged'){
      error = 0;
       $('#message').html('');
          $('#updateBtn').prop('disabled',false);$('#notif').html('');
      $('#editname').css('border-color','black');
     }
     else if(data == 'Already Exist!'){
       error++;
          $('#updateBtn').prop('disabled',true);$('#notif').html('Some Fields have Error');
      $('#message').html(data);
      $('#editname').css('border-color','red');
     }
     else if(data == 'Symbols not allowed'){
       error++;
          $('#updateBtn').prop('disabled',true);$('#notif').html('Some Fields have Error');
      $('#message').html(data);
      $('#editname').css('border-color','red');
     }
     else if(data == 'No white Space'){
       error++;

          $('#updateBtn').prop('disabled',true);$('#notif').html('Some Fields have Error');
      $('#message').html(data);
      $('#editname').css('border-color','red');
     }
     else if(data == ''){
      error = 0;
          $('#message').html('');
          $('#updateBtn').prop('disabled',true);$('#notif').html('');
      $('#editname').css('border-color','black');
     }

     
     else if(data == 'Good!'){
      error = 0;
       $('#message').html('');
     $('#updateBtn').prop('disabled',false);$('#notif').html('');
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
        $('body').on('change','#_fabric',function(){
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

//category
$('body').on('change','#category',function(){
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

//type
$('body').on('change','#type',function(){
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

//frameworks
$('body').on('change','#framework',function(){
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

function checkText(){
  var checker = 0;
  if($('#height').val() == ''){

    $('#height').css('border-color','red');
    alert('Input height');
    checker =+ 1;
  }
  else{
    $('#height').css('border-color','black');
  }

  if($('#width').val() == ''){
    $('#width').css('border-color','red');
    alert('Input width');
    checker =+ 2;
  }else{
    $('#width').css('border-color','black');
    
  }

  if($('#Length').val() == ''){
    $('#Length').css('border-color','red');
    alert('Input Length');
    checker =+ 3;
  }else{
    $('#Length').css('border-color','black');
    
  }
  return checker;
}

              //create dimension
              $(document).ready(function(){
                var swtch = 0;
                
                $('body').on('click','#dime',function(event) {
                  if(swtch == 0){
                    $('#dime').attr('readonly',true);
                    $('#height').attr('type','number');
                    $('#width').attr('type','number');
                    $('#Length').attr('type','number');
                    $('#saveDime').attr('type','button');
                    swtch = 1;
                  }
                  else if(swtch == 1){
                    $('#dime').attr('readonly',true);
                    $('#height').attr('type','hidden');
                    $('#width').attr('type','hidden');
                    $('#Length').attr('type','hidden');
                    $('#saveDime').attr('type','hidden');
                    swtch = 0;
                  }


                });
                
                $('body').on('click','#saveDime',function(){
                  
                  if(checkText() == 0)
                  {
                    $('#dime').attr('readonly',true);

                    $('#height').attr('type','hidden');
                    $('#width').attr('type','hidden');
                    $('#Length').attr('type','hidden');
                    $('#saveDime').attr('type','hidden');
                    $('#dime').val($('#height').val()+','+$('#width').val()+','+$('#Length').val());
                    swtch = 0;
                  }

                });

              });


                //update dimension
                function upcheckText(){
                  var checker = 0;
                  if($('#upheight').val() == ''){

                    $('#upheight').css('border-color','red');
                    alert('Input height');
                    checker =+ 1;
                  }
                  else{
                    $('#upheight').css('border-color','black');
                  }

                  if($('#upwidth').val() == ''){
                    $('#upwidth').css('border-color','red');
                    alert('Input width');
                    checker =+ 2;
                  }else{
                    $('#upwidth').css('border-color','black');
                    
                  }

                  if($('#upLength').val() == ''){
                    $('#upLength').css('border-color','red');
                    alert('Input Length');
                    checker =+ 3;
                  }else{
                    $('#upLength').css('border-color','black');
                    
                  }
                  return checker;
                }
                $(document).ready(function(){
                  var swtch = 0;
                  
                  $('body').on('click','#updime',function(event) {
                    if(swtch == 0){
                      $('#updime').attr('readonly',true);
                      $('#upheight').attr('type','number');
                      $('#upwidth').attr('type','number');
                      $('#upLength').attr('type','number');
                      $('#upsaveDime').attr('type','button');
                      swtch = 1;
                    }
                    else if(swtch == 1){
                      $('#updime').attr('readonly',true);
                      $('#upheight').attr('type','hidden');
                      $('#upwidth').attr('type','hidden');
                      $('#upLength').attr('type','hidden');
                      $('#upsaveDime').attr('type','hidden');
                      swtch = 0;
                    }


                  });
                  
                  $('body').on('click','#upsaveDime',function(){
                    
                    if(upcheckText() == 0)
                    {
                      $('#updime').attr('readonly',true);

                      $('#upheight').attr('type','hidden');
                      $('#upwidth').attr('type','hidden');
                      $('#upLength').attr('type','hidden');
                      $('#upsaveDime').attr('type','hidden');
                      $('#updime').val($('#upheight').val()+','+$('#upwidth').val()+','+$('#upLength').val());
                      swtch = 0;
                      if($('#checkDime').val() != $('#updime').val()){
                        $('#updateBtn').prop('disabled',false);
                      }
                      else{
                        $('#updateBtn').prop('disabled',true);
                      }
                    }

                  });

                });



$(document).ready(function(){
 $('#myModal').on('shown.bs.modal',function(){
  var val = $("input[name='design']:checked").val();
  if(val=="3"){
    $("#_fabric").removeAttr('disabled');
    var al = $("#_fabric").val();
  }
  else{
    $("#_fabric").attr('disabled','disabled');  
  }
  
  $("input[name='_design']").on('change',function(){
    var val = $("input[name='_design']:checked").val();
    if(val=="3"){
      $("#_fabric").removeAttr('disabled');
      var al = $("#_fabric").val();
    }
    else{
      $("#_fabric").attr('disabled','disabled');  
    }
  });


});
});

/*
$(document).ready(function(){
 $('#myModal').on('shown.bs.modal',function(){
  $("#category").select2();
  $("#type").select2();
  $("#_fabric").select2();
  $("#framework").select2();
});
});*/

$(document).ready(function(){
 $('#myModal').on('shown.bs.modal',function(){
  $('#category').change(function() {
    var value = $("#category").val();
    var drop = 1;
    $.ajax({
      type: 'post',
      url: 'load-drop-downs.php',
      data: {
        id: value, type : drop,
      },
      success: function (response) {
       $( '#type' ).html(response);
      }
      });
    });

  $('#type').change(function() {
    var value = $("#type").val();
    var drop = 7;
    $.ajax({
      type: 'post',
      url: 'load-drop-downs.php',
      data: {
        id: value, type : drop,
      },
      success: function (response) {
       $( '#framework' ).html(response);
      }
      });
    });

});
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
                <button id="tempbtn" class="btn btn-lg btn-info pull-right" data-toggle="modal" href="prod-form.php" data-remote="prod-forms.php #new" data-target="#myModal" aria-expanded="false" style="margin-right: 20px;"><span class="btn-label"><i class="ti-plus"></i></span>New</button>
                <li role="presentation" class="active" >
                <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="ti-gift"></i>&nbsp;<span id="archiveTitle" style="display: none;">Archived</span>&nbsp;<?php echo $titlePage?></a>
              </li>
            </ul>
          </h3>
          <div class="pull-right" style="margin-right: 20px; margin-top: -10px;">
            <a href="javascript:void(0)" title="Archives" class="masterTooltip"><input type="checkbox" class="js-switch" id="archiveSwitch" data-color="#f96262" style="display: none;" data-switchery="true"></a>
          </div>
            <div class="tab-content">
              <!-- CATEGORY -->
              <div role="tabpanel" class="tab-pane fade active in" id="job">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <div class="row">
                      <div class="table-responsive" id="mainTable">
                        <table class="table color-bordered-table muted-bordered-table dataTable display" id="tblProducts">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>Category</th>
                              <th>Type</th>
                              <th style="text-align: right;">Price</th>
                              <th class="removeSort">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            
                            <?php
                            include "dbconnect.php";
                            $sql = "SELECT * FROM tblproduct a, tblfurn_type b, tblfurn_category c WHERE a.prodTypeID = b.typeID AND c.categoryID = b.typeCategoryID and a.prodCatID = c.categoryID;";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result))
                            {
                              if($row['prodStat']!="Archived"){

                                echo('<td>'.$row['productName'].'</td>
                                  <td>'. $row['categoryName'] .'</td>
                                  <td>'. $row['typeName'].'</td>
                                  <td style="text-align: right;"><small>&#8369; </small>'.number_format($row['productPrice'],2).'</td>
                                  ');?>
                                  <td>
                                    <!-- VIEW -->
                                    <button type="button" class="btn btn-warning" data-toggle="modal" href="prod-forms.php" data-remote="prod-forms.php?id=<?php echo $row['productID']?> #view" data-target="#myModal"><i class='fa fa-info-circle'></i> View</button>
                                    <!-- UPDATE -->
                                    <button type="button" class="btn btn-success" data-toggle="modal" href="prod-forms.php" data-remote="prod-forms.php?id=<?php echo $row['productID']?> #update" data-target="#myModal"><i class='ti-pencil-alt'></i> Update</button>
                                    <!-- DELETE -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" href="prod-forms.php" data-remote="prod-forms.php?id=<?php echo $row['productID']?> #delete" data-target="#myModal"><i class='ti-close'></i> Deactivate</button>
                                  </td>
                                  <?php echo ('</tr>');
                                }
                              }
                              ?>
                              
                              <script type="text/javascript">
                              function confirmDelete(id) {
                                window.location.href="delete-job.php?id="+id+"";
                              }
                              function edit(id){
                                window.location.href="update-job.php?id="+id+"";
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
                              <th>Category</th>
                              <th>Type</th>
                              <th style="text-align: right;">Price</th>
                              <th class="removeSort">Action</th>
                                </tr>
                              </thead>
                              <tbody>
                               <?php
                            include "dbconnect.php";
                            $sql = "SELECT * FROM tblproduct a, tblfurn_type b, tblfurn_category c WHERE a.prodTypeID = b.typeID AND c.categoryID = b.typeCategoryID and a.prodCatID = c.categoryID;";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result))
                            {
                              if($row['prodStat']=="Archived"){

                                echo('<td>'.$row['productName'].'</td>
                                  <td>'. $row['categoryName'] .'</td>
                                  <td>'. $row['typeName'].'</td>
                                  <td style="text-align: right;"><small>&#8369; </small>'.number_format($row['productPrice'],2).'</td>
                                  ');?>
                                  <td>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" href="reactivate-form.php" data-remote="reactivate-form.php?rName=Products&amp;id=<?php echo $row['productID']?> #reactivate" data-target="#myModal"><i class="ti-reload"></i> Reactivate</button> 
                                  </td>
                                  <?php echo ('</tr>');
                                }
                              }
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
</div>  
</div>
</div>
<!-- /.container-fluid -->
<!--footer class="footer text-center"> 2017 &copy; Filipiniana Furniture </footer-->
</div>
<!-- /#page-wrapper -->
</div>

<div id="myModal" class="modal fade" role="dialog " aria-hidden="true" style="display: none;">
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