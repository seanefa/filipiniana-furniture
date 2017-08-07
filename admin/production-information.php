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

  function deleteRow(row){
        var result = confirm("Remove Material?");
        if(result){
              var i=row.parentNode.parentNode.rowIndex;
              document.getElementById('selectedMaterials').deleteRow(i);
              }
   }

   function deleteExisting(row){
          var result = confirm("Remove Material?");
          if(result){
            $('#trowID'+row).hide();
            $('#exist'+row).attr('name','deleted[]');
          }
    }

$('body').on('change','.fileUpload',function(){
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
    $.post('prod-Ucheck.php',{username : user}, function(data){
     
      
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
          $('#updateBtn').prop('disabled',false);
        

      });
        $('body').on('keyup','#remText',function(){
        var tem = $(this).val();
        flag = false;
        if(!flag){
          $('#updateBtn').prop('disabled',false);
        }
      });

});

/*
$(document).ready(function(){
 $('#myModal').on('shown.bs.modal',function(){
  //var $tb = $("#tb_row"), $tb_copy = $tb.children('tr').first().clone();
  //alert(tb);
  $('#addBtn').click(function() {
      var val = $("#mat").val();
    });
});
});
*/

$(document).ready(function(){
 $('#myModal').on('shown.bs.modal',function(){
  $('#cat').change(function() {
    var value = $("#cat").val();
    alert(value);
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
       $("#type").removeAttr('disabled');
      }
      });
    });

    $('#type').change(function() {
    var value = $("#type").val();
    var drop = 2;
    $.ajax({
      type: 'post',
      url: 'load-drop-downs.php',
      data: {
        id: value, type : drop,
      },
      success: function (response) {
       // We get the element having id of display_info and put the response inside it
       $( '#products' ).html(response);
       $("#products").removeAttr('disabled');
      }
      });
    });

    $('#mat').change(function() {
    var value = $("#mat").val();
    var drop = 3;
    $.ajax({
      type: 'post',
      url: 'load-drop-downs.php',
      data: {
        id: value, type : drop,
      },
      success: function (response) {
       // We get the element having id of display_info and put the response inside it
       $( '#var' ).html(response);
       $("#var").removeAttr('disabled');
      }
      });
    });

    $('#products').change(function() {
    var value = $("#products").val();
    var drop = 4;
    $.ajax({
      type: 'post',
      url: 'load-drop-downs.php',
      data: {
        id: value, type : drop,
      },
      success: function (response) {
       // We get the element having id of display_info and put the response inside it
       $( '#phasetab' ).html(response);
       $("#var").removeAttr('disabled');
      }
      });
    });
});
});


$(document).ready(function(){
 $('#myModal').on('shown.bs.modal',function(){
  $('#addBtn').click(function() {
    var mat = $("#mat").val();
    var desc = $("#var").val();
    var quan = $("input[name='quan']").val();
    var unit = $("#unit").val();
    $("#hide").hide();
    $.ajax({
      type: 'post',
      url: 'prod-info-material.php',
      data: {
        mat: mat, desc : desc, quan : quan, un : unit,
      },
      success: function (response) {
       // We get the element having id of display_info and put the response inside it
       $( '#tblMat' ).append(response);
      }
      });
    });


});
});

$(document).ready(function(){
 $('#myModal').on('shown.bs.modal',function(){
    var value = $("#phase").val();
    var prod = $("input[name='prodID']").val();
    $.ajax({
      type: 'post',
      url: 'display-info-material.php',
      data: {
        id: value, pr : prod,
      },
      success: function (response) {
       // We get the element having id of display_info and put the response inside it
       $( '#tblMatView' ).append(response);
      }
      });

    $('#phase').change(function() {
    var value = $("#phase").val();
    var prod = $("input[name='prodID']").val();
    $.ajax({
      type: 'post',
      url: 'display-info-material.php',
      data: {
        id: value, pr : prod,
      },
      success: function (response) {
        $( '#tblMatView' ).empty();
       // We get the element having id of display_info and put the response inside it
       $( '#tblMatView' ).append(response);
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
                <button id="tempbtn" class="btn btn-lg btn-info pull-right" data-toggle="modal" href="prod-form.php" data-remote="prod-info-form.php #new" data-target="#myModal" aria-expanded="false" style="margin-right: 20px;"><span class="btn-label"><i class="ti-plus"></i></span>New</button>
                <li role="presentation" class="active">
                  <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="ti-info"></i>&nbsp;<?php echo $titlePage?></a>
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
                              <th style="text-align: left;">Furniture Name</th>
                              <th style="text-align: left;">Furniture Type</th>
                              <th style="text-align: left;">Materials</th>
                              <th style="text-align: left;">Action</th>
                            </tr>
                          </thead>
                          <tbody style="text-align: left;">
                            
                              <?php
                              include "dbconnect.php";
                              $sql = "SELECT * FROM tblprod_info a, tblproduct b, tblfurn_type c WHERE a.prodInfoProduct = b.productID and b.prodTypeID = c.typeID;";
                              $result = mysqli_query($conn, $sql);
                              while ($row = mysqli_fetch_assoc($result))
                              {
                                if($row['prodStat']!="Archived"){

                                  echo('<td>'. $row['productName'].'</td>
                                    <td>'.$row['typeName'] .'</td>
                                    ');?>
                                    <td><button type="button" class="btn btn-info" data-toggle="modal" href="prod-info-form.php" data-remote="prod-info-form.php?id=<?php echo $row['productID']?> #view1" data-target="#myModal">View Materials</button></td>
                                    <td>
                                      <!-- UPDATE -->
                                      <button type="button" class="btn btn-success" data-toggle="modal" href="prod-info-form.php" data-remote="prod-info-form.php?id=<?php echo $row['prodInfoID']?> #update" data-target="#myModal">Update</button>
                                      <!-- DELETE -->
                                      <button type="button" class="btn btn-danger" data-toggle="modal" href="prod-info-form.php" data-remote="prod-info-form.php?id=<?php echo $row['prodInfoID']?> #delete" data-target="#myModal">Deactivate</button>
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
<!-- New Framework Modal
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