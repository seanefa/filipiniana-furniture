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
     $('body').on('keyup','#username',function(){
    var user = $(this).val();
    var flag = true;
    $.post('prod-check.php',{username : user}, function(data){
     
     if(data == 'Already Exist!'){
       
          $('#addFab').prop('disabled',true);
      $('#message').html(data);
      $('#username').css('border-color','red');
     }
     else if(data == 'Symbols not allowed'){
       
          $('#addFab').prop('disabled',true);
      $('#message').html(data);
      $('#username').css('border-color','red');
     }
     else if(data == 'No white Space'){
  

          $('#addFab').prop('disabled',true);
      $('#message').html(data);
      $('#username').css('border-color','red');
     }
     else if(data == ''){
      error = 0;
          $('#message').html('');
          $('#addFab').prop('disabled',true);
      $('#username').css('border-color','black');
     }

     
     else if(data == 'Good!'){
      error = 0;
       $('#message').html('');
     $('#addFab').prop('disabled',false);
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
    $.post('prod-Ucheck.php',{username : user}, function(data){
     
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
  
  $("input[name='design']").on('change',function(){
    var val = $("input[name='design']:checked").val();
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


$(document).ready(function(){
 $('#myModal').on('shown.bs.modal',function(){
  $("#category").select2();
  $("#type").select2();
  $("#_fabric").select2();
  $("#framework").select2();
});
});

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
       // We get the element having id of display_info and put the response inside it
       $( '#type' ).html(response);
      }
      });
    });
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
                <button id="tempbtn" class="btn btn-lg btn-info pull-right" data-toggle="modal" href="prod-form.php" data-remote="prod-forms.php #new" data-target="#myModal" aria-expanded="false" style="margin-right: 20px;"><span class="btn-label"><i class="ti-plus"></i></span>New</button>
                <li role="presentation" class="active">
                  <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="ti-gift"></i>&nbsp;<?php echo $titlePage?></a>
                </li>
              </ul>
            </h3>
            <div class="tab-content">
              <!-- CATEGORY -->
              <div role="tabpanel" class="tab-pane fade active in" id="job">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <div class="row">
                      <div class="table-responsive">
                        <table class="table color-bordered-table muted-bordered-table dataTable display nowrap" id="tblProducts">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>Category</th>
                              <th>Type</th>
                              <th>Price</th>
                              <th>Action</th>
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
                                  <td><small>&#8369; </small>'.number_format($row['productPrice'],2).'</td>
                                  ');?>
                                  <td>
                                    <!-- VIEW -->
                                    <button type="button" class="btn btn-warning" data-toggle="modal" href="prod-forms.php" data-remote="prod-forms.php?id=<?php echo $row['productID']?> #view" data-target="#myModal"><span class='glyphicon glyphicon-eye-open'></span> View</button>
                                    <!-- UPDATE -->
                                    <button type="button" class="btn btn-success" data-toggle="modal" href="prod-forms.php" data-remote="prod-forms.php?id=<?php echo $row['productID']?> #update" data-target="#myModal"><span class='glyphicon glyphicon-edit'></span> Update</button>
                                    <!-- DELETE -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" href="prod-forms.php" data-remote="prod-forms.php?id=<?php echo $row['productID']?> #delete" data-target="#myModal"><span class='glyphicon glyphicon-trash'></span> Deactivate</button>
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
<footer class="footer text-center"> 2017 &copy; Filipiniana Furniture </footer>
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