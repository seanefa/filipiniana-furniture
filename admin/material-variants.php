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
    // Material Attribute
    $('body').on('keyup','#attribb',function(){
      var user = $(this).val();
      var flag = true;
      $.post('variants-check.php',{attribb : user}, function(data){ 
        $('#attribbValidate').html(data);
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
      else if(data == "" && data == "White Space not allowed" && data == "Symbols not allowed"){
        flag = true;
      }

        if(flag){
          $('#saveBtn').prop('disabled',true);
         // $('#attribb').css('border-color','red');
        }
        else if(!flag){
          $('#saveBtn').prop('disabled', false);
         // $('#attribb').css('border-color','limegreen');
        }
      });
    });

  });

$(document).ready(function(){
 $('#myModal').on('shown.bs.modal',function(){

   $('#purpose').on('change', function() {
    if ( this.value == '1')
    //.....................^.......
  {
    $("#business").show();
  }
  else
  {
    $("#business").hide();
  }
});

 });
});

/*
$(document).ready(function(){
 $('#myModal').on('shown.bs.modal',function(){

  $('#material').on('change', function() {
    var value = this.value;
    alert(value);
    $.ajax({
      type: 'post',
      url: 'load-form.php',
      data: {
        id: value,
      },
      success: function (response) {
       // We get the element having id of display_info and put the response inside it
       $( '#form' ).html(response);
      }
      });
    });
});
});*/

$(document).ready(function(){
 $('#myModal').on('shown.bs.modal',function(){
  $('#material').ready(function() {
    var value = $("#material").val();
  var recID = $("#recID").val();
    $.ajax({
      type: 'post',
      url: 'load-form.php',
      data: {
        id: value, record: recID,
      },
      success: function (response) {
       // We get the element having id of display_info and put the response inside it
       $( '#form' ).html(response);
      }
      });
    });

    $('#material').change(function() {
    var value = this.value;
  var recID = $("#recID").val();
    $.ajax({
      type: 'post',
      url: 'load-form.php',
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
                <button id="tempbtn" class="btn btn-lg btn-info pull-right" data-toggle="modal" href="variants-form.php" data-remote="variants-form.php #new" data-target="#myModal" aria-expanded="false" style="margin-right: 20px;"><span class="btn-label"><i class="ti-plus"></i></span>New</button>
                <li role="presentation" class="active">
                  <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="fa fa-thumb-tack"></i>&nbsp;Material Variants</a>
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
                        <table class="table color-bordered-table muted-bordered-table dataTable display nowrap" id="tblFrameworkMaterial">
                          <thead>
                            <tr>
                              <th>Variants</th>
                              <th>Remarks</th>
                              <th class="removeSort">Action</th>
                            </tr>
                          </thead>
                          <tbody>

                            <?php
                            $sql = "SELECT * FROM tblmat_var a, tblmaterials b, tblmat_type c WHERE c.matTypeID = b.materialType and a.mat_varID = b.materialID";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result))
                            {
                              $desc = desc($row['variantID']);
                              $desc =  $desc. '-' . $row['materialName']. '-' . $row['matTypeName'];
                              if($row['variantStatus']=="Listed"){
                                echo('<tr><td>'.$desc.'</td><td>'.$row['variantRemarks'].'</td>'); ?>
                                <td>
                                  <!-- UPDATE -->
                                  <button type="button" class="btn btn-success" data-toggle="modal" href="variants-form.php" data-remote="variants-form.php?id=<?php echo $row['variantID']?> #update" data-target="#myModal"><span class='glyphicon glyphicon-edit'></span> Update</button>
                                  <!-- DELETE -->
                                  <button type="button" class="btn btn-danger" data-toggle="modal" href="variants-form.php" data-remote="variants-form.php?id=<?php echo $row['variantID']?> #delete" data-target="#myModal"><span class='glyphicon glyphicon-trash'></span> Deactivate</button>
                                </td>
                                <?php echo('</tr>');} }
                                function desc($id){
                                  include "dbconnect.php";
                                    $sql = "SELECT * FROM tblvariant_desc a, tblmat_var b WHERE b.variantID = a.varMatvarID AND a.varMatvarID = '$id'";
                                    $result = mysqli_query($conn,$sql);
                                    $desc = "";
                                    while($row = mysqli_fetch_assoc($result)){
                                      $desc = $desc . $row['varVariantDesc'] . "-";
                                    }
                                    $temp = substr(trim($desc), 0, -1);
                                    return $temp;
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