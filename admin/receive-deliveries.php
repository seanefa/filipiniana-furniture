<?php
$activePage = basename($_SERVER['PHP_SELF'],".php");
include "menu.php";
include "titleHeader.php";
//session_start();

if(isset($_GET['id'])){
  $jsID = $_GET['id']; 
}
//$_SESSION['varname'] = 3;
include 'dbconnect.php';
?>
<!DOCTYPE html>  
<html lang="en">
<head>
  <script>


  $(document).ready(function(){
    $('#mat').change(function(){
      var value = $("#mat").val();
      var drop = 3;
      $.ajax({
        type: 'post',
        url: 'load-drop-downs.php',
        data: {
          id: value, type : drop,
        },
        success: function (response) {
          $( '#var' ).html(response);
          $("#var").removeAttr('disabled');
        }
      });
    });
  });

  $(document).ready(function(){
    $('#supplier').change(function(){
      var value = $("#supplier").val();
      alert(value);
      var drop = 3;
      $.ajax({
        type: 'post',
        url: 'load-drop-downs.php',
        data: {
          id: value, type : drop,
        },
        success: function (response) {
          $( '#var' ).html(response);
          $("#var").removeAttr('disabled');
        }
      });
    });
  });


  $(document).ready(function(){
    $('#quan').on('keyup',function(){
      var mat = $("#quan").val();
      if(isNaN(mat)){
        var e = "Please input a valid number.";
        $("#error").html(e);
        $('#quan').css('border-color','red');
        $('#addBtn').prop('disabled',true);
      }
      else if(mat==""){
        var e = "";
        $("#error").html(e);
        $('#quan').css('border-color','grey');
        $('#addBtn').prop('disabled',true);
      }
      else{
        $('#quan').css('border-color','grey');
        $('#addBtn').prop('disabled',false);
      }
    });

    $('#addBtn').click(function() {
      var mat = $("#mat").val();
      var desc = $("#var").val();
      var quan = $("input[name='quan']").val();
      var unit = $("#unit").val();
      var error = 0;
      if(isNaN(quan)){
        var e = "Please input a valid number.";
        $("#error").html(e);
        $('#quan').css('border-color','red');
        $('#addBtn').prop('disabled',true);
        error = 1;
      }
      else if(quan==""){
        var e = "";
        $("#error").html(e);
        $('#quan').css('border-color','grey');
        $('#addBtn').prop('disabled',true);
        error = 1;
      }
      else{
        $('#quan').css('border-color','grey');
        $('#addBtn').prop('disabled',false);
        error = 0;
      }

      if(desc==""){
        var e = "Please select a material";
        $("#errorMat").html(e);
        $('#var').css('border-color','grey');
        $('#addBtn').prop('disabled',true);
        error = 1;
      }
      else{
        var e = "";
        $("#errorMat").html(e);
        $('#var').css('border-color','grey');
        $('#addBtn').prop('disabled',false);
        error = 0;
      }

      if(error==0){
        $("#hide").hide();
        $.ajax({
          type: 'post',
          url: 'prod-info-material.php',
          data: {
            mat: mat, desc : desc, quan : quan, un : unit,
          },
          success: function (response) {
            $( '#tblMat' ).append(response);
          }
        });
      }
    });
});


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

</script>
<title>Receive Deliveries</title>
<link rel="icon" type="image/x-icon" sizes="16x16" href="plugins/images/favicon.ico">
</head>
<body class ="fix-header fix-sidebar">
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-12">
          <h4 class="box-title">
            <h3>
              <ul class="nav customtab2 nav-tabs" role="tablist">
                <li role="presentation" class="active">
                  <a aria-controls="proorders" role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs">Receive Deliveries</span></a>
                </li>
              </ul>
            </h3>
          </h4>
          <div class="orderconfirm">
            <div class="panel panel-default">
              <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <form action="" method = "post">
                  <input type="hidden" name="orderID" id="orderID" value="<?php echo $jsID?>">
                  <div class="panel-body">
                    <div class="row">
                      <div class="descriptions">

                        <div class="panel-body">
                          <div class="row">
                          <div class="col-md-12">
                            <div class="form-group">
                              <label class="control-label">Supplier</label><span id="x" style="color:red"> *</span>
                              <select class="form-control" data-placeholder="Choose a Fabric" tabindex="1" name="supplier" id="supplier">
                                <?php
                                include "dbconnect.php";
                                $sql = "SELECT * FROM tblsupplier ORDER BY supCompName;";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result))
                                {
                                  if($row['supStatus']=='Listed'){
                                    echo('<option value='.$row['supplierID'].'>'.$row['supCompName'].'</option>');
                                  }
                                }
                                ?>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-3">
                            <div class="form-group">
                              <label class="control-label">Type</label><span id="x" style="color:red"> *</span>
                              <select class="form-control" tabindex="1" name="material" id="mat">
                                <option value="">Choose Material Type</option>
                                <?php
                                include "dbconnect.php";
                                $sql = "SELECT * FROM tblmat_type order by matTypeName;";
                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_assoc($result))
                                {
                                  if($row['matTypeStatus']=='Listed'){
                                    echo('<option value='.$row['matTypeID'].' data-name="'.$row['matTypeName'].'">'.$row['matTypeName'].'</option>');
                                  }
                                }
                                ?>
                              </select>
                            </div>
                          </div>
                          
                          <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label">Material</label><span id="x" style="color:red"> *</span>
                              <select class="form-control" tabindex="1" name="var" id="var">
                                <option value="">-</option>
                              </select>
                              <p id="errorMat" style="color:red"></p>
                            </div>
                          </div>

                          <div class="col-md-2">
                            <div class="form-group">
                              <label class="control-label">Quantity (in pcs)</label><span id="x" style="color:red"> *</span>
                              <input type="text" class="form-control" name="quan" id="quan" placeholder="500" style="text-align: right" />
                              <p id="error" style="color:red"></p>
                            </div>
                          </div>

                          <div class="col-md-1">
                            <div class="form-group">
                              <button id="addBtn" type="button" class="btn btn-success" style="margin-top: 27px;" disabled><i class="ti-plus"></i></button>
                            </div>
                          </div>
                        </div>
                        </div>
                        <div class="col-md-12">
                          <div class="table-responsive" style="clear: both;">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="panel-wrapper collapse in" aria-expanded="true">
                                  <div class="panel-body">
                                      <div class="table-responsive">
                                        <h2>Delivered Materials</h2>
                                        <table class="table color-bordered-table muted-bordered-table display nowrap" id="selectedMaterials">
                                      <thead>
                                        <tr>
                                          <th style="text-align: left;">Type</th>
                                          <th style="text-align: left;">Material</th>
                                          <th style="text-align: left;">Quantity</th>
                                          <th style="text-align: left;">Unit</th>
                                          <th style="text-align: left;">Action</th>                          
                                        </thead>
                                          <tbody  id="tblMat" style="text-align: left;">
                                          <tr id="hide">
                                            <td colspan="5" style="text-align: center;">Nothing to show.</td>
                                          </tr>
                                        </tbody>
                                      </table>
                                           <p class="quanError pull-right" style="color:red"></p>
                                      </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="row" style="margin:10px">
                              <button data-wizard="finish" type="submit" class="btn btn-success waves-effect pull-right" id="saveBtn" ><i class="fa fa-check"></i> Save</button>
                            </div>
                          </form>
                        </div>
                      </div>  
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </body> 

        <script type="text/javascript">
        (function(){
          $('#accordion').wizard({
            step: '[data-toggle="collapse"]',
            buttonsAppendTo: '.panel-collapse',
            templates: {
              buttons: function(){
                var options = this.options;
                return '<div class="panel-footer"><ul class="pager">' +
                '<button data-wizard="finish" type="submit" class="btn btn-success waves-effect pull-right" id="addFab"><i class="fa fa-check"></i> Save</button>' +
                '</div>';
              }
            },
            onFinish: function(){
              window.location.href = 'receipt.php?id='+id;
            }
          });
        })();
        </script>
        </html>