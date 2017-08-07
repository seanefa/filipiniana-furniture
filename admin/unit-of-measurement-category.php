<?php
include "titleHeader.php";
include "menu.php";  
//session_start();
/* if(isset($GET['id'])){
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
    
    /*
$(document).ready(function(){

  $('body').on('keyup','#username',function(){
    var user = $(this).val();
    var flag = true;
    $.post('furn-cat-check.php',{username : user}, function(data){
     
      
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
    $.post('furn-cat-Ucheck.php',{username : user}, function(data){
     
      
      if(data != "Already Exist!" && data != "unchanged" && data != "Symbols not allowed" && data != "No white Space"){
       
       if(data =="Symbols not allowed" && data == "No white Space"){
        error++;
        flag = true;
        
         
      }else{
          flag = false;
          error = 0;
      
}
      }
     else if(data == "Already Exist!" && data != "unchanged" && data =="Symbols not allowed" && data == "No white Space"){
    flag = true;
     if(data =="Symbols not allowed" && data == "No white Space"){
        error++;
        flag = true;
        
         
      }
      }

      if(data == "unchanged" && data != "Already Exist!" && data != "Symbols not allowed" && data != "No white Space"){
        error = 0;
      $('#editname').css('border-color','black')
      }

      if(flag){
        $('#message').html(data);
        $('#updateBtn').prop('disabled',true);

      $('#editname').css('border-color','red');
      flag = true;
    }
    else if(!flag){
    $('#message').html(data);
        $('#updateBtn').prop('disabled', false);
      $('#editname').css('border-color','limegreen');
      flag = false;
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
/*$(document).ready(function(){
      $("#archiveTable").hide();
      $("#backArch").hide();
    $("#showArch").click(function(){
        $("#tblCategories").hide();
        $("#archiveTable").show();
        $("#temptitle").text("");
        $("#temptitle").text("Archived");
        $("#tempbtn").hide();
        $("#showArch").hide();
        $("#backArch").show();
    });
    $("#backArch").click(function(){
      $("#tblCategories").show();
        $("#archiveTable").hide();
        $("#temptitle").text("");
        $("#temptitle").text("Categories");
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
                <button id="tempbtn" class="btn btn-lg btn-info pull-right" data-toggle="modal" href="category-form.php" data-remote="uncategory-form.php #new" data-target="#myModal" aria-expanded="false" style="margin-right: 20px;"><span class="btn-label"><i class="ti-plus"></i></span>New</button>
                <li role="presentation" class="active">
                  <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="ti-menu-alt"></i>&nbsp;<?php echo $titlePage?></a>
                </li>
              </ul>
            </h3>
            <div class="tab-content">
              <!-- CATEGORY -->
              <div role="tabpanel" class="tab-pane fade active in" id="category">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <div class="row">
                      <div class="table-responsive">
                        <table class="table color-bordered-table muted-bordered-table dataTable display nowrap" id="tblCategories">
                          <thead>
                            <tr>
                              <th>Name</th>
                              <th>Remarks</th>
                              <th>Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                            
                              <?php
                              include "dbconnect.php";
                              $sql = "SELECT * FROM tblunitofmeasurement_category;";
                              $result = mysqli_query($conn, $sql);
                              while ($row = mysqli_fetch_assoc($result))
                              {
                                if($row['uncategoryStatus']=="Active"){
                                  echo('<td>'.$row['uncategoryName'].'</td>
                                    <td>'.$row['uncategoryDescription'].'</td>
                                    ');?>
                                    <td>
                                      <!-- UPDATE -->
                                      <button type="button" class="btn btn-success" data-toggle="modal" href="uncategory-form.php" data-remote="uncategory-form.php?id=<?php echo $row['uncategoryID']?> #update" data-target="#myModal"><span class='glyphicon glyphicon-edit'></span> Update</button>
                                      <!-- DELETE -->
                                      <button type="button" class="btn btn-danger" data-toggle="modal" href="uncategory-form.php" data-remote="uncategory-form.php?id=<?php echo $row['uncategoryID']?> #delete" data-target="#myModal"><span class='glyphicon glyphicon-trash'></span> Deactivate</button>
                                    </td>
                                    <?php echo ('</tr>');
                                  }
                                }
                                function typeName($id){
                                  include "dbconnect.php";
                                  $sql = "SELECT * from tblfurntype WHERE furn_typeID = '$id'";
                                  $result = mysqli_query($conn,$sql);
                                  $type = "";
                                  while($row = mysqli_fetch_assoc($result)){
                                    $type = $row['furn_typeName'];
                                  }
                                  return $type;
                                }
                                ?>
                              
                              <script type="text/javascript">
                                function confirmDelete(id) {
                                  window.location.href="delete-category.php?id="+id+"";
                                }
                                function edit(id){
                                  window.location.href="update-category.php?id="+id+"";
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