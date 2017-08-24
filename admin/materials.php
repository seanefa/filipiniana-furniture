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
else if (isset($_GET['reactivateSuccess']))
{
  echo  '<script>';
  echo '$(document).ready(function () {';
  echo 'document.getElementById("toastReactivateSuccess").click();';
  echo '});';
  echo '</script>';
}

?>
<!DOCTYPE html>  
<html lang="en">
<head>
  <script>

   $(document).ready(function(){
    // Material Name
    $('body').on('keyup','#materialName',function(){
      var user = $(this).val();
      var flag = true;
      $.post('material-check.php',{materialName : user}, function(data){ 
        $('#materialNameValidate').html(data);
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
          $('#materialName').css('border-color','red');
        }
        else if(!flag){
          $('#saveBtn').prop('disabled', false);
          $('#materialName').css('border-color','limegreen');
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
      $.post('frame-mat-Ucheck.php',{username : user}, function(data){


        if(data != "Already Exist!" && data !="unchanged"){
          flag = false;
          error =0;
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

$(function(){ // DOM ready

  // ::: TAGS BOX

  $("#tags input").on({
    focusout : function() {
      var txt = this.value.replace(/[^a-z0-9\+\-\.\#]/ig,''); // allowed characters
      if(txt) $("<span/>", {text:txt.toLowerCase(), insertBefore:this});
      this.value = "";
    },
    keyup : function(ev) {
      // if: comma|enter (delimit more keyCodes with | pipe)
      if(/(188|13)/.test(ev.which)) $(this).focusout(); 
    }
  });
  $('#tags').on('click', 'span', function() {
    if(confirm("Remove "+ $(this).text() +"?")) $(this).remove(); 
  });

});


$(document).ready(function(){
 $('#myModal').on('shown.bs.modal',function(){
   $("#tags input").on({
    focusout : function() {
      var txt = this.value.replace(/[^a-z0-9\+\-\.\#]/ig,''); // allowed characters
      if(txt) $("<span/>", {text:txt.toString(), insertBefore:this});
      this.value = "";
    },
    keyup : function(ev) {
      // if: comma|enter (delimit more keyCodes with | pipe)
      if(/(188|13)/.test(ev.which)) $(this).focusout(); 
    }
  });
   $('#tags').on('click', 'span', function() {
    if(confirm("Remove "+ $(this).text() +"?")) $(this).remove(); 
  });

   var tags = '';
   $('#tags > span').each(function() {
    tags = tags + $(this).html() + ',';
  });
   $('#intags').val(tags);

 });
});



$(document).ready(function(){
 $('#myModal').on('shown.bs.modal',function(){
  $("#addFab").mouseover(function(){
    var tags = '';
    $('#tags > span').each(function() {
      tags = tags + $(this).html() + ',';
    });
    $('#intags').val(tags);
    $("#hiddeninput").val(mysave);
  });
});
});

$(document).ready(function(){
 $('#myModal').on('shown.bs.modal',function(){
    $("#attribs").select2({
      tags: true
    });
});
});


$(document).ready(function(){
 $('#myModal').on('shown.bs.modal',function(){
  $('#type').ready(function() {
    var value = $("#type").val();
  var recID = "material";
    $.ajax({
      type: 'post',
      url: 'load-form-mat.php',
      data: {
        id: value, record: recID,
      },
      success: function (response) {
       // We get the element having id of display_info and put the response inside it
       $( '#form' ).html(response);
      }
      });
    });

    $('#type').change(function() {
    var value = this.value;
  var recID = "material";
    $.ajax({
      type: 'post',
      url: 'load-form-mat.php',
      data: {
        id: value,record: recID,
      },
      success: function (response) {
       // We get the element having id of display_info and put the response inside it
       $( '#form' ).html(response);
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

<style>
#tags{
  float:left;
  border: 1px solid #98A6AD;
  padding: 3px 5px;
}
#tags > span{
  cursor:pointer;
  display:block;
  float:left;
  color:#fff;
  background:#3383FF;
  padding:2px;
  padding-right:25px;
  margin:2px;
  font-size: 12pt;
}
#tags > span:hover{
  opacity:0.7;
}
#tags > span:after{
 position:absolute;
 content:"×";
 border-left:1px solid;
 padding:2px 2px;
 margin-left:5px;
 font-size:12pt;
}
#tags > input{
  background-color: #ffffff;
  border: 0px;
  border-radius: 0px;
  box-shadow: none;
  color: #565656;
  height: 38px;
  max-width: 100%;
  padding: 7px 12px;
  transition: all 300ms linear 0s;
  width:auto;
  font-size:12pt;
}
</style>
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
<button class="tst4" id="toastReactivateSuccess" style="display: none;"></button>
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="panel panel-info">
            <h3>
              <ul class="nav customtab2 nav-tabs" role="tablist">
                <button id="tempbtn" class="btn btn-lg btn-info pull-right" data-toggle="modal" href="material-form.php" data-remote="material-form.php #new" data-target="#myModal" aria-expanded="false" style="margin-right: 20px;"><span class="btn-label"><i class="ti-plus"></i></span>New</button>
                <li role="presentation" class="active" >
                <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="ti-hummer"></i>&nbsp;<span id="archiveTitle" style="display: none;">Archived</span>&nbsp;<?php echo $titlePage?></a>
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
                        <table class="table color-bordered-table muted-bordered-table dataTable display" id="tblFrameworkMaterial">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>Category</th>
                              <th class="removeSort">Actions</th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php
                             $sql = "SELECT * FROM tblmaterials a, tblmat_type b WHERE b.matTypeID = a.materialType";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result))
                            {
                              if($row['materialStatus']=="Listed"){
                                echo('<tr><td>'.$row['materialName'].'</td>
                                <td>'.$row['matTypeName'].'</td>'); ?>
                                <td>
                                  <!-- UPDATE -->
                                  <button type="button" class="btn btn-success" data-toggle="modal" href="material-form.php" data-remote="material-form.php?id=<?php echo $row['materialID']?> #update" data-target="#myModal"><i class='ti-pencil-alt'></i> Update</button>
                                  <!-- DELETE -->
                                  <button type="button" class="btn btn-danger" data-toggle="modal" href="material-form.php" data-remote="material-form.php?id=<?php echo $row['materialID']?> #delete" data-target="#myModal"><i class='ti-close'></i> Deactivate</button>
                                </td>
                                <?php echo('</tr>');} }
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
                              <th>Category</th>
                              <th class="removeSort">Actions</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                             $sql = "SELECT * FROM tblmaterials a, tblmat_type b WHERE b.matTypeID = a.materialType";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result))
                            {
                              if($row['materialStatus']=="Archived"){
                                echo('<tr><td>'.$row['materialName'].'</td>
                                <td>'.$row['matTypeName'].'</td>'); ?>
                                <td>
                                <button type="button" class="btn btn-danger" data-toggle="modal" href="reactivate-form.php" data-remote="reactivate-form.php?rName=Materials&amp;id=<?php echo $row['materialID']?> #reactivate" data-target="#myModal"><i class="ti-reload"></i> Reactivate</button> 
                                </td>
                                <?php echo('</tr>');} }
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
    <div id="myModal" class="modal fade" role="dialog " aria-hidden="true" style="display: none;">
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