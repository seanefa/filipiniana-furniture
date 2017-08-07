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
      var change = 0;
      function deleteRow(row)
      {
        var res = confirm("Are you sure?");
        if(res){
              $('#trowID'+row).hide();
              $('#checkThis'+row).attr('name','pis[]');
              if($('#message').html() != 'Already Exist!'){
              $('#updateBtn').prop('disabled',false);
                }
                }
      }
      function insRow(rows)
      {
        
          $('#addrowID'+rows).hide(); 
          $('#checkThisAgain'+rows).attr('name','addis[]'); 
          if($('#message').html() != 'Already Exist!'){
              $('#updateBtn').prop('disabled',false);
             }          

      }

    $(document).ready(function(){
var temprem;
var tempname;
var error = 0;
var flag = true;
 



  $('body').on('keyup','#editname',function(){
    var user = $(this).val();
    
      tempname = $('#editname').val();
      temprem = $('#rem').val();
    $.post('pack-Ucheck.php',{username : user}, function(data){
     
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

      
    $(document).ready(function(){
      $('#temptitleback').hide();
    $('#tempbtn').click(function(){
      $('#tempbtn').hide();
      $('#temptitle').hide();
      $('#temptitleback').show();
      $('#showArch').hide();
    });
    
    $('#temptitleback').click(function(){
      $('#tempbtn').show();
      $('#temptitle').show();
      $('#temptitleback').hide();
       $('#showArch').show();
    });
    });

$(document).ready(function(){
   $('#myModal').on('shown.bs.modal',function(){

      $('#tblRemove').show();
      $('#tblAdd').hide();
      $('#showAdd').show();
      $('#backAdd').hide();
      
      $("#showAdd").click(function(){
        $("#tblRemove").hide();
        $("#tblAdd").show();
        $("#backAdd").show();
        $("#showAdd").hide();
        });
   
    $("#backAdd").click(function(){
      $("#tblRemove").show();
      $("#tblAdd").hide();
        $("#backAdd").hide();
        $("#showAdd").show();
    });
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
                <button id="tempbtn" class="btn btn-lg btn-info pull-right" data-toggle="tab" href="#newpackage" aria-expanded="false" style="margin-right: 20px;"><span class="btn-label"><i class="ti-plus"></i></span>New</button>
                <li role="presentation" class="active">
                  <a id="temptitle" href="#packages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i id="ti" class="ti-package"></i>&nbsp;<?php echo $titlePage?></a>
                </li>
                <li role="presentation" class="active">
                 <a id="temptitleback" href="#packages" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i id="ti" class="ti-arrow-left"></i>&nbsp;Go Back</a>
                 </li>
              </ul>
            </h3>
            <div class="tab-content">
              <!--PACKAGES-->
              <div role="tabpanel" class="tab-pane fade active in" id="packages">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <div class="row">
                      <div class="table-responsive">
                        <table class="table color-bordered-table muted-bordered-table dataTable display nowrap" id="tblPackages">
                          <thead>
                            <tr>
                              <th>Package Description</th>
                              <th>Package Price</th>
                              <th>No. of Products</th>
                              <th class="removeSort">Actions</th>
                            </tr>
                          </thead>
                          <tbody>
                          
                              <?php
                              include "dbconnect.php";
                              $sql = "SELECT * FROM tblpackages";
                              $result = mysqli_query($conn, $sql);
                              while ($row = mysqli_fetch_assoc($result))
                              {
                                $c = pCount($row['packageID']);

                                if($row['packageStatus']=="Listed"){
                                  echo ('<td>'.$row['packageDescription'].'</td>
                                    <td><small>&#8369;</small>'.$row['packagePrice'].'</td>
                                    <td>'.$c.'</td>
                                    ');?>
                                    <td>
                                      <!-- VIEW -->
                                      <button type="button" class="btn btn-warning" data-toggle="modal" href="packages-form.php" data-remote="packages-form.php?id=<?php echo $row['packageID']?> #view" data-target="#myModal"><span class='glyphicon glyphicon-eye-open'></span> View</button>
                                      <!-- UPDATE -->
                                      <button type="button" class="btn btn-success" data-toggle="modal" href="pacakages-form.php" data-remote="packages-form.php?id=<?php echo $row['packageID']?> #update" data-target="#myModal"><span class='glyphicon glyphicon-edit'></span> Update</button>
                                      <!-- DELETE -->
                                      <button type="button" class="btn btn-danger" data-toggle="modal" href="packages-form.php" data-remote="packages-form.php?id=<?php echo $row['packageID']?> #delete" data-target="#myModal"><span class='glyphicon glyphicon-trash'></span> Deactivate</button>
                                    </td>
                                    <?php echo ('</tr>');
                                  }
                                }

                                function pCount($id){
                                  include "dbconnect.php";
                                  $cnt = 0;
                                  $sql = "SELECT COUNT(*) AS NO FROM tblpackage_inclusions WHERE package_incID='$id' AND package_incStatus='Listed'";
                                  $result = mysqli_query($conn,$sql);
                                  while($row = mysqli_fetch_assoc($result)){
                                    $cnt = $row['NO'];
                                  }
                                  return $cnt;
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
                <!-- NEW PACKAGE -->
                <div role="tabpanel" class="tab-pane fade" id="newpackage">
                  <div class="panel-wrapper collapse in" aria-expanded="true">
                    <div class="panel-body">
                      <div class="row">
                      <script type="text/javascript">
                      $(document).ready(function(){
                        var selected = [];

                            $('.chBox').change(function() {
                                selected.push(this);
                            });

                             $('#savePackage').click(function(){

                                  
                                if(selected.length >= 2){
                                    $('#savePackage').attr('type','submit');
                                }
                                else if(selected.length == 0){
                                    alert('Please check products to be added');
                                }
                                else if(selected.length <= 1){
                                  alert('A Package must have atleast 2 (two) Products.');
                                }

                              });
                          });
                      </script>
                        <form action="packages-form.php" method="post">
                          <input type="hidden" name="id" value="1">
                          <div class="table-responsive">
                            <table class="table color-bordered-table muted-bordered-table dataTable" id="tblAddPackages">
                              <thead>
                                <tr>
                                  <th>-</th>
                                  <th>Furniture Type</th>
                                  <th>Furniture Name</th>
                                  <th>Price</th>
                                  <th>Furniture Description</th>
                                </tr>
                              </thead>
                              <tbody>
                                <div id="checkboxes">
                                <?php
                                include "dbconnect.php";
                                include "checkbox_value.php";

                                $prodArray = array();
                              $sql = "SELECT * FROM tblproduct a, tblfurn_type b WHERE a.prodTypeID = b.typeID;";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result))
                                {
                                  if($row['prodStat']!="Archived"){
                                    echo ('<tr><td><input class="chBox" type="checkbox" name="check[]" value='.$row['productID'].'/></td>
                                      <td>'. $row['typeName'] .'</td><td>'.$row['productName'].'</td>
                                      <td><small>&#8369;</small>'.$row['productPrice'].'</td>
                                      <td>'.$row['productDescription'].'</td></tr>
                                      ');
/*<td>
<!-- VIEW -->
<button type="button" class="btn btn-info" data-toggle="modal" href="packages-forms.php" data-remote="packages-forms.php?id=<?php echo $row['packageID']?> #view" data-target="#myModal">View</button>
<!-- UPDATE -->
<button type="button" class="btn btn-success" data-toggle="modal" href="pacakages-forms.php" data-remote="packages-forms.php?id=<?php echo $row['packageID']?> #update" data-target="#myModal">Update</button>
<!-- DELETE -->
<button type="button" class="btn btn-danger" data-toggle="modal" href="packages-forms.php" data-remote="packages-forms.php?id=<?php echo $row['packageID']?> #delete" data-target="#myModal">Delete</button>
</td>
<?php echo ('</tr>');*/
}
}
?>
</div>
</tbody>
</table>
<br/>
<button type="button" id="savePackage" name="submit" class="btn btn-success pull-right">Add to Package</button>
</div>
</form>
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