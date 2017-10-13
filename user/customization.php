<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link href="image/favicon.ico" rel="icon" />
  <link rel="stylesheet" href="css/myStyle.css">
  <link rel="stylesheet" href="dist/dropzone.css">
  <script src="dist/dropzone.js"></script>
  <title>Customization - Filipiniana Furniture Shop</title>
  <meta name="description" content="Furniture shop">
  <?php include"css.php";?>
</head>
<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    if (isset($_POST['register'])) { //user registering
        
        require 'process-registration.php';
    }
}
?>
<body style="background: #ffffff;">
  <?php 
  include "header.php";
  if(!isset($_SESSION["userID"]))
  {
    echo "<script>
    window.location.href='login.php';
    alert('You have no access here. You must logged in first.');
    </script>";
  }
  ?>
  <div id="container">
    <div class="container">
      <ul class="breadcrumb">
        <li><a href="home.php"><i class="fa fa-home"></i></a></li>
        <li><a href="customization.php">Customization</a></li>
      </ul>
      <br>
      <div class="row">
        <?php include "accountmenu.php"; ?>
        <!--Middle Part Start-->
        <div class="col-sm-9" id="content">
          <h2>Customized Product Request</h2>
          <br>
          <div class="col-md-12">
          
            <div class="row">
              <div class="table-responsive">          
                <table class="table table-hover table-striped">
                  <thead>
                    <tr>
                      <th>Request #</th>
                      <th>Placed On</th>
                      <th>Status</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                  include "userconnect.php";
                    $id = $_SESSION["userID"];

                    $usql = "SELECT * FROM tbluser where userID = '$id';";
                    $uresult = mysqli_query($conn,$usql);
                    $urow = mysqli_fetch_assoc($uresult);

                    $uid = $urow['userID'];

                    $sqls = "SELECT * FROM tblcustomize_request where tblcustomerID = '$uid';";
                    $sresult = mysqli_query($conn,$sqls);
                    

                    while($srow = mysqli_fetch_assoc($sresult)){
                    $rid = str_pad($srow['customizedID'], 6, '0', STR_PAD_LEFT);

                    ?>

                    <tr>
                      <td style="color:#1A9CB7;"><?php echo $rid;?></td>
                      <td><?php echo $srow['dateRequest'];?></td>
                      <td><?php $stat = $srow['customStatus']; if($stat = 'WFA'){ $stat = "Waiting for Approval"; echo $stat; }else{ echo $stat; };?></td>
                      <?php if($srow['customStatus'] != 'WFA'){ ?>
                      <td><a href="" class="pull-right" style="color:#1A9CB7;">Cancel Order</a></td>
                    </tr>

                    <?php
                    }else{
                      echo '<td><a href="" class="pull-right" style="color:#1A9CB7;">Cancel Request</a></td>';
                    }
                    }

                    ?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div class="well">
                  <?php include "userconnect.php";
      $sql="SELECT * from tbluser a join tblcustomer b WHERE a.userCustID = b.customerID and  a.userID = " . $_SESSION["userID"] . "";
      $result = $conn->query($sql);
      if($result->num_rows>0){
        while($row=$result->fetch_assoc()){
          }
        }
      ?>
      <script type="text/javascript">
        var check = false;
        var arrays = [];
        $(document).ready(function(){

        $('#saveBtn').on('click',function(){
          var desc = $('#custdesc').val();
      if(desc != ''){
        check = true;
    }else{
      check = false;
      alert('Please Input Description.');
    }
  });
         });

        Dropzone.options.myAwesomeDropzone = {
  paramName: "file", // The name that will be used to transfer the file
  maxFilesize: 2, //mb
  maxFiles: 4, // number of files
  addRemoveLinks: true,
  accept: function(file, done) {

    
    $('#saveBtn').on('click',function(){
     
      if(check){
        arrays.push(file.name);
      done();
    }

   });
  },
   queuecomplete: function (file) {
    var desc = $('#custdesc').val();

    $.ajax({
        type: 'post',
        url: 'add-cust-req.php',
        data: {
          arr: JSON.stringify(arrays), descr: desc,
        },
        success: function (response) {
          
        }
      });
    $('#my-awesome-dropzone').hide('blind');
         $('#hidethistoo').hide('blind');
         $('#savedDiv').show('blind');
      }


};


      </script>

            <fieldset>
              <div class="form-group">
              <legend><h4>Customization</h4>&nbsp;<i><small class="text-danger" id="_lblAccountMsg"></small></i></legend>

        </div>
              <div class="form-group required">
        <div class="col-sm-12">
          <div id="savedDiv" style="display: none; text-align: center;">
            <h5>Request Saved</h5><br><h6>Wait for Approval of the admin</h6><br>
            <a class="btn btn-primary" href="account.php">Continue</a>
          </div>
          <div action="upload.php"
              class="dropzone"
              id="my-awesome-dropzone" method="post" style="border: 2px solid #ccc; background-color: #f8f8f8; height: 50%; width: 100%;">
        <h4>Description</h4>
              <textarea id="custdesc" class="form-control" style="width: 100%;
    height: 150px;
    padding: 12px 20px;
    box-sizing: border-box;
    border: 2px solid #ccc;
    border-radius: 4px;
    background-color: #f8f8f8;
    resize: none;" required></textarea>
              <br>
      </div>

    </div>

        </div>
        
            </fieldset><br>
            
              

              <div id="hidethistoo" style="text-align: center;">
                <a href="account.php" class="btn btn-info">CANCEL</a>
                <input type="submit" class="btn btn-success" value="SAVE" name="register" id="saveBtn">
              </div>
      
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--Middle Part End -->
      </div>
    </div>
    <?php include"footer.php";?>
  <!--img src="pics/userpictures/<?php echo "" . $row["customerDP"];?>" style="height:150px; width:150px;" alt="Product" class="img-responsive profilepic"/-->
  <?php include "scripts.php";?>
</body>
</html>