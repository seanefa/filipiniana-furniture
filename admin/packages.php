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
  var change = 0;
  function deleteRow(row,catName,prodName,prodPrice){
    var catName,prodName,prodPrice;
    var res = confirm("Are you sure?");
    if(res){
      $('#trowID'+row).hide();
      $('#checkThis'+row).attr('name','pis[]');

      $('#insertTable').append('<tr id="addrowID'+row+'"> <input id="checkThisAgain'+row+'" type="checkbox" name="" value='+row+' checked="" style="opacity:0; position:absolute; left:9999px;"/><td>'+catName+'</td><td id="incName">'+prodName+'</td><td id="incPrice">&#8369; '+prodPrice+'</td><td style="text-align: center;"><input onclick="insRow('+"'"+row+"'"+','+"'"+catName+"'"+','+"'"+prodName+"'"+','+"'"+prodPrice+"'"+')" type="button" class="btn btn-success waves-effect text-left" value="Add"></input></td></tr>');
     
      if($('#message').html() != 'Already Exist!'){
        $('#updateBtn').prop('disabled',false);
      }
    }
  }
  function insRow(rows,catName,prodName,prodPrice){
    alert(rows+','+catName+','+prodName+','+prodPrice);
    $('#addrowID'+rows).hide(); 
    $('#checkThisAgain'+rows).attr('name','addis[]'); 

    $('#deleteTable').append('<tr id="addrowID'+rows+'"> <input id="checkThisAgain'+rows+'" type="checkbox" name="" value='+rows+' checked="" style="opacity:0; position:absolute; left:9999px;"/><td>'+catName+'</td><td id="incName">'+prodName+'</td><td id="incPrice">&#8369; '+prodPrice+'</td><td style="text-align: center;"><input onclick="deleteRow('+"'"+rows+"'"+','+"'"+catName+"'"+','+"'"+prodName+"'"+','+"'"+prodPrice+"'"+')" type="button" class="btn btn-danger waves-effect text-left" value="Remove"></input></td></tr>');

    if($('#message').html() != 'Already Exist!'){
      $('#updateBtn').prop('disabled',false);
    }          

  }

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


$(document).ready(function(){
  $('#temptitleback').hide();
  $('#tempbtn').click(function(){
    $('#tempbtn').hide();
    $('#archivebtn').hide();
    $('#temptitleback').show();
  });

  $('#temptitleback').click(function(){
    $('#tempbtn').show();
    $('#archivebtn').show();
    $('#temptitleback').hide();
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
              <button id="tempbtn" class="btn btn-lg btn-info pull-right" data-toggle="tab" href="#newpackage" aria-expanded="false" style="margin-right: 20px;"><span class="btn-label"><i class="ti-plus"></i></span>New</button>
              <button id="temptitleback" class="btn btn-lg btn-info pull-right" data-toggle="tab" href="#packages" aria-expanded="false" style="margin-right: 20px; display: none;"><span class="btn-label"><i id="ti" class="ti-arrow-left"></i></span>Go Back</button>
              <li role="presentation" class="active" >
                <a id="temptitle" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"></span><span class="hidden-xs"></span><i class="ti-package"></i>&nbsp;<span id="archiveTitle" style="display: none;">Archived</span>&nbsp;<?php echo $titlePage?></a>
              </li>
            </ul>
          </h3>
          <div class="pull-right" id="archivebtn" style="margin-right: 20px; margin-top: -10px;">
            <a href="javascript:void(0)" title="Archives" class="masterTooltip"><input type="checkbox" class="js-switch" id="archiveSwitch" data-color="#f96262" style="display: none;" data-switchery="true"></a>
          </div>
          <div class="tab-content">
            <!--PACKAGES-->
            <div role="tabpanel" class="tab-pane fade active in" id="packages">
              <div class="panel-wrapper collapse in" aria-expanded="true">
                <div class="panel-body">
                  <div class="row">
                    <div class="table-responsive" id="mainTable">
                      <table class="table color-bordered-table muted-bordered-table dataTable display" id="tblPackages">
                        <thead>
                          <tr>
                            <th>Package Description</th>
                            <th style="text-align:center">No. of Products Included</th>
                            <th style="text-align:right">Package Price</th>
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
                                <td style="text-align:center">'.$c.' pcs</td>
                                <td style="text-align:right">&#8369; '.number_format($row['packagePrice'],2).'</td>
                                ');?>
                                <td>
                                  <!-- VIEW -->
                                  <button type="button" class="btn btn-warning" data-toggle="modal" href="packages-form.php" data-remote="packages-form.php?id=<?php echo $row['packageID']?> #view" data-target="#myModal"><i class='fa fa-info-circle'></i> View</button>
                                  <!-- UPDATE -->
                                  <button type="button" class="btn btn-success" data-toggle="modal" href="pacakages-form.php" data-remote="packages-form.php?id=<?php echo $row['packageID']?> #update" data-target="#myModal"><i class='ti-pencil-alt'></i> Update</button>
                                  <!-- DELETE -->
                                  <button type="button" class="btn btn-danger" data-toggle="modal" href="packages-form.php" data-remote="packages-form.php?id=<?php echo $row['packageID']?> #delete" data-target="#myModal"><i class='ti-close'></i> Deactivate</button>
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

                        <div id="archiveTable">
                          <div class="table-responsive"> 
                            <table class="table color-bordered-table muted-bordered-table dataTable display">
                              <thead>
                                <tr>
                            <th>Package Description</th>
                            <th style="text-align:center">No. of Products Included</th>
                            <th style="text-align:right">Package Price</th>
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

                            if($row['packageStatus']=="Archived"){
                              echo ('<td>'.$row['packageDescription'].'</td>
                                <td style="text-align:center">'.$c.' pcs</td>
                                <td style="text-align:right">&#8369; '.number_format($row['packagePrice'],2).'</td>
                                ');?>
                                <td>
                                  <button type="button" class="btn btn-danger" data-toggle="modal" href="reactivate-form.php" data-remote="reactivate-form.php?rName=Packages&amp;id=<?php echo $row['packageID']?> #reactivate" data-target="#myModal"><i class="ti-reload"></i> Reactivate</button> 
                                </td>
                                <?php echo ('</tr>');
                              }
                            }?>
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
                    <h4><label class="control-label">&nbsp;&nbsp;List of Products</label></h4>
                      <form action="packages-form.php" method="post">
                        <input type="hidden" name="id" value="1">
                        <div class="table-responsive">
                          <table class="table color-bordered-table muted-bordered-table dataTable" id="tblAddPackages">
                            <thead>
                              <tr>
                                <th style="text-align:center" class="removeSort">-</th>
                                <th>Category</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Price</th>
                              </tr>
                            </thead>
                            <tbody>
                              <div id="checkboxes">
                                <?php
                                include "dbconnect.php";
                                include "checkbox_value.php";

                                $prodArray = array();
                                $sql = "SELECT * FROM tblproduct a, tblfurn_category b WHERE a.prodCatID = b.categoryID;";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result))
                                {
                                  if($row['prodStat']!="Archived"){
                                    echo ('<tr><td style="text-align:center"><input class="chBox" type="checkbox" name="check[]" value='.$row['productID'].'/></td>
                                      <td>'. $row['categoryName'] .'</td>
                                      <td>'.$row['productName'].'</td>
                                      <td>'.$row['productDescription'].'</td>
                                      <td>&#8369; '.number_format($row['productPrice'],2).'</td>
                                      </tr>
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