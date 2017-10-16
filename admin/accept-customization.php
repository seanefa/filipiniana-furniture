<?php
$activePage = basename($_SERVER['PHP_SELF'],".php");
include "menu.php";
include 'dbconnect.php';
session_start();
$jsID = "";
if(isset($_GET['id'])){
  $jsID = $_GET['id']; 
}
?>
<!DOCTYPE html>  
<html lang="en">
<head>
  <title>Accept Customization</title>
  <link rel="icon" type="image/x-icon" sizes="16x16" href="plugins/images/favicon.ico">
  <script>

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
        $('#saveBtn').prop('disabled',true);$('#notif').html('Some Fields have Error');
        $('#message').html('Symbols not allowed');
        $('#username').css('border-color','red');
      }else{
        $.post('prod-check.php',{username : user}, function(data){

         if(data == 'Already Exist!'){

          $('#saveBtn').prop('disabled',true);$('#notif').html('Some Fields have Error');
          $('#message').html(data);
          $('#username').css('border-color','red');
        }
        else if(data == 'Symbols not allowed'){

          $('#saveBtn').prop('disabled',true);$('#notif').html('Some Fields have Error');
          $('#message').html(data);
          $('#username').css('border-color','red');
        }
        else if(data == 'No white Space'){


          $('#saveBtn').prop('disabled',true);$('#notif').html('Some Fields have Error');
          $('#message').html(data);
          $('#username').css('border-color','red');
        }
        else if(data == ''){
          error = 0;
          $('#message').html('');
          $('#saveBtn').prop('disabled',true);$('#notif').html('');
          $('#username').css('border-color','black');
        }


        else if(data == 'Good!'){
          error = 0;
          $('#message').html('');
          $('#saveBtn').prop('disabled',false);$('#notif').html('');
          $('#username').css('border-color','limegreen');
        }


      });

}

});

});

$(document).ready(function(){
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


$(document).ready(function(){
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

</script>
</head>
<body class ="fix-header fix-sidebar">
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="panel panel-info">
            <h3>
              <ul class="nav customtab2 nav-tabs" role="tablist">
                <li role="presentation" class="active">
                  <a aria-controls="proorders" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs">Accept Customization</span></a>
                </li>
              </ul>
            </h3>
            <div class="tab-content">
              <!-- CATEGORY -->
              <div role="tabpanel" class="tab-pane fade active in">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <form action="save-customization-order.php" method = "post">
                      <input type="hidden" name="custReq" id="custRes" value="<?php echo $jsID?>">
                      <div class="row" style="margin-top: -30px;">
                        <div class="col-md-5">
                          <div class="row" style="border:2px solid grey;padding:20px;">
                            <h2 style="font-family: inherit; font-weight: bolder;">CUSTOMIZATION REQUEST DETAILS</h2>
                            <?php
                            $sql = "SELECT * FROM tblcustomize_request a, tblcust_req_images b WHERE a.customizedID = b.cust_req_ID AND a.customizedID = '$jsID'";
                            $res = mysqli_query($conn,$sql);
                            $row = mysqli_fetch_assoc($res);
                            echo '<div class="row">
                            <div class="col-md-12">
                            <div class="form-group">
                            <label class="control-label">Description</label>
                            <textarea class="form-control" readonly>'.$row['customizedDescription'].'</textarea>
                            </div>
                            </div>
                            </div>';
                            $custDesc = $row['customizedDescription'];
                            $custID = $row['tblcustomerID'];
                            $sql = "SELECT * FROM tblcustomize_request a, tblcust_req_images b WHERE a.customizedID = b.cust_req_ID AND a.customizedID = '$jsID'";
                            $res = mysqli_query($conn,$sql);
                            while($row1 = mysqli_fetch_assoc($res)){
                              echo '<div class="row">
                              <div class="col-md-12">
                              <img src="../user/upl/'.$row1['cust_req_images'].'" alt="Unavailable" class="img-responsive" width="100%" length="300px"> 
                              </div>
                              </div>
                              <br>';
                            }
                            ?>

                          </div>
                        </div>
                      <input type="hidden" name="custID" id="custID" value="<?php echo $custID?>">
                        <div class="col-md-7"> 
                          <div class="panel-wrapper collapse in" aria-expanded="true">
                            <div class="panel-body blue-gradient">
                              <h2 style="text-align:center; font-family: inherit; font-weight: bolder;">Furniture Details</h2>
                              <hr>
                              <div class="form-body">
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="control-label">Category</label><span id="x" style="color:red"> *</span>
                                      <select class="form-control" data-placeholder="Choose a Category" tabindex="1" id="category" name="_category">
                                        <option value="">Select category</option>
                                        <?php
                                        $sql = "SELECT * FROM tblfurn_category order by categoryName;";
                                        $result = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_assoc($result))
                                        {
                                          if($row['categoryStatus']=='Listed'){
                                            echo('<option value='.$row['categoryID'].'>'.$row['categoryName'].'</option>');
                                          }
                                        }
                                        ?>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label class="control-label">Type</label><span id="x" style="color:red"> *</span>
                                      <select class="form-control" data-placeholder="Choose a Category" tabindex="1" id="type" name="_type" id="type">
                                        <option value="">Nothing to show</option>
                                      </select>
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <label class="control-label">Name</label><span id="x" style="color:red"> *</span>
                                      <input type="text" id="username" class="form-control" placeholder="Elizabeth" name="_prodName" required/><span id="message"></span>
                                    </div>
                                  </div>
                                </div>


                                <div class="row">
                                  <div class="col-md-5">
                                    <div class="form-group">
                                      <label class="control-label">Design</label><span id="x" style="color:red"> *</span>
                                      <div class="row">
                                        <div class="col-md-12">
                                          <h5>
                                            <?php
                                            include "dbconnect.php";
                                            $sql = "SELECT * FROM tblfurn_design;";
                                            $result = mysqli_query($conn, $sql);
                                            while ($row = mysqli_fetch_assoc($result))
                                            {
                                              if($row['designStatus']!='Archived'){
                                                echo '<label class="radio-inline"><input type="radio" name="design" value="'.$row['designID'].'" checked>'.$row['designName'].'</label>';
                                              }
                                            }
                                            ?>
                                          </h5>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label class="control-label">Fabric</label>
                                      <select class="form-control" data-placeholder="Choose a Fabric" tabindex="1" name="_fabric" id="_fabric" disabled>
                                        <option value="0">Choose a Fabric</option>
                                        <?php
                                        include "dbconnect.php";
                                        $sql = "SELECT * FROM tblfabrics order by fabricName;";
                                        $result = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_assoc($result))
                                        {
                                          if($row['fabricStatus']=='Listed'){
                                            echo('<option value='.$row['fabricID'].'>'.$row['fabricName'].'</option>');
                                          }
                                        }
                                        ?>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label class="control-label">Framework</label><span id="x" style="color:red"> *</span>
                                      <select class="form-control" data-placeholder="Choose a Framework" tabindex="1" name="_framework" id="framework">
                                        <?php
                                            // $sql = "SELECT * FROM tblframeworks order by frameworkName;";
                                            // $result = mysqli_query($conn, $sql);
                                            // while ($row = mysqli_fetch_assoc($result))
                                            // {
                                            //   if($row['frameworkStatus']=='Listed'){
                                            //     echo('<option value='.$row['frameworkID'].'>'.$row['frameworkName'].'</option>');
                                            //   }
                                            // }
                                        ?>
                                      </select>
                                    </div>
                                  </div>
                                </div>
                                <input type="hidden" id="firstName" name ="capacity" class="form-control" placeholder="4" style="text-align:right" />

                                <div class="row">
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label class="control-label">Dimension Specification</label><span id="x" style="color:red"> *</span>
                                      <textarea type="text" name ="dimensions" rows="4" class="form-control" style="text-align:right" required></textarea>
                                    </div>
                                  </div>
                                  <div class="col-md-8">
                                    <div class="form-group">
                                      <label class="control-label">Description</label>
                                      <textarea class="form-control" rows="4" name="_prodDesc"><?php echo $custDesc?></textarea>
                                    </div>
                                  </div>
                                </div>
                                <!--/span-->
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="form-group">
                                      <label>Quantity Ordered</label><span id="x" style="color:red">*</span>
                                      <div class="input-group">
                                        <input type="number" class="form-control" name="quan" style="text-align: right;" required/> 
                                      </div>
                                      </div>
                                    </div>
                                  <div class="col-md-6 pull-right">
                                    <div class="form-group">
                                      <label>Price</label><span id="x" style="color:red">*</span>
                                      <div class="input-group">
                                        <div class="input-group-addon"><small>&#8369;</small></div>
                                        <input class="form-control" id="thisPrice" name="_price" placeholder="0.00" style="text-align: right;" required/> </div>
                                      </div>
                                    </div>
                                  </div>

                                  <div class="row">
                                    <div class="col-md-8">
                                      <div class="form-group">
                                        <label class="control-label">Order Remarks</label>
                                        <textarea name="orderremarks" id="orderremarks" class="form-control">An order.</textarea>
                                      </div>
                                    </div>
                                    <?php
                                    $date = new DateTime();
                                    $dateToday = date_format($date, "Y-m-d");

                                    $estDate = date('Y-m-d', strtotime("+25 days"));
                                    ?>
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label class="control-label">Pick up/Delivery Date</label><span id="x" style="color:red"> *</span>
                                        <input type="date" id="pdate" class="form-control" name="pidate" value="<?php echo $estDate?>" required/> 
                                        <p id="dateError"></p>
                                      </div>
                                    </div>
                                  </div>


                                  <div class="row" style="margin:10px">
                                    <button data-wizard="finish" type="submit" class="btn btn-success waves-effect pull-right" id="saveBtn" disabled><i class="ti-check"></i> Save</button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal" href="order-management-modals.php" data-remote="order-management-modals.php?id=<?php echo $jsID?> #orderCustreject"><i class="ti-close"></i> Reject</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>

                      </div>
                    </div>
                  </div>
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
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <!-- Modal content-->
      <div class="modal-content clearable-content">
        <div class="modal-body">

        </div>
      </div>
    </div>
  </div>
</div>

    </body> 
    </html>