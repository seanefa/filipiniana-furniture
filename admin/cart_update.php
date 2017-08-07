<?php
include "menu.php";
session_start();
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
?>
<!DOCTYPE html>  
<html lang="en">
<head>
  <title>Maintenance | Products</title>
</head>
<body class ="fix-header fix-sidebar">
  <!-- Preloader -->
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
          <div class="panel panel-info">
            <h3>
              <ul class="nav customtab2 nav-tabs" role="tablist">
                <li role="presentation" class="active">
                  <a role="tab" data-toggle="tab" aria-expanded="false"><span class="visible-xs"><i class="ti-home"></i></span><span class="hidden-xs"></span><i class="ti-gift"></i>&nbsp;Transactions</a>
                </li>
                </li>
              </ul>
            </h3>
            <div class="tab-content">
              <!-- PRODUCTS -->
              <div role="tabpanel" class="tab-pane fade active in" id="product">
                <div class="panel-wrapper collapse in" aria-expanded="true">
                  <div class="panel-body">
                    <div class="row">
                      <div class="col-md-12">
                        <form class="navbar-form navbar-right" role="search">
                          <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search" name="srch-term" id="livesearch" onkeyup="showResult(this.value)" size="40" style="margin-top: -50px;">
                            <div class="input-group-btn">
                              <button class="btn btn-default" type="submit" style="margin-top: -63px;"><i class="glyphicon glyphicon-search"></i></button>
                              <script>
                                function showResult(str) {
                                  if (str.length==0) { 
                                    document.getElementById("livesearch").innerHTML="";
                                    document.getElementById("livesearch").style.border="0px";
                                    return;
                                  }
                                  if (window.XMLHttpRequest) {
                                    // code for IE7+, Firefox, Chrome, Opera, Safari
                                    xmlhttp=new XMLHttpRequest();
                                  } else {  // code for IE6, IE5
                                    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
                                  }
                                  xmlhttp.onreadystatechange=function() {
                                    if (this.readyState==4 && this.status==200) {
                                      document.getElementById("livesearch").innerHTML=this.responseText;
                                      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
                                    }
                                  }
                                  xmlhttp.open("GET","livesearch.php?q="+str,true);
                                  xmlhttp.send();
                                }
                              </script>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>     
                      
                    <?php 
                        session_start();
                        include_once ("config.php");
                        if(isset($_POST["type"]) && $_POST["type"]=='add'){
                            foreach($_POST as $key => $value){ //add all post vars to new_product array
		                      $new_product[$key] = filter_var($value, FILTER_SANITIZE_STRING);
                            }
                            unset($new_product['type']);
	                        unset($new_product['return_url']); 
                        }
                    ?>
                    <div class="row">
                      <?php
                      include "dbconnect.php";
                      $chair = array("chair","chair3","chair5");
                                // Create connection
                      $conn = mysqli_connect($servername, $username, $password, $dbname);
                                // Check connection
                      if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                      }
                      $tempID = "";
                      $sql = "SELECT * FROM tblproduct order by productID desc;";
                      $result = mysqli_query($conn, $sql);
                      if($result){
                        while ($row = mysqli_fetch_assoc($result))
                        {
                          $random = rand(0,2);
                          if($row['productDescription']==""){$row['productDescription']="________________";}
                          if($row['prodStat'] == "Listed"){
                           echo ('
                            <form method="get" action="cart_update.php">
                              <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <div class="white-box">
                                  <div class="product-img">
                                    <img height="150px" src="../plugins/images/'.$row['prodMainPic'].'"/>') ?>
                                    <div class="pro-img-overlay">
                                      <!-- VIEW -->
                                      <button type="button" class="btn btn-info" data-toggle="modal" href="prod-forms.php" data-remote="prod-forms.php?id=<?php echo $row['productID'];?> #view" data-target="#myModal" value=" <?php echo $row['productID'] ?> ">View</button><br><br>
                                        <input type="hidden" name="product_code" value="<?php echo $row['productID'] ?>" />
                                        <button type="submit" class="btn addtocartbutton" >Add to Cart</button>
                                    </div>
                                  </div>
                                  <?php echo('
                                   <div class="product-text">
                                    <span class="pro-price bg-danger">&#8369;'.$row['productPrice'].'</span>
                                    <h3 class="box-title m-b-0">'.substr($row['productName'], 0,20).'</h3>
                                    <small class="text-muted db">'.substr($row['productDescription'],0,35).'</small>
                                  </div>
                                </div>
                              </div>
                            </form>
                            ');          
                                }
                              }
                            }            ?>
                            
                         </div>
                       </div>
                     </div>
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