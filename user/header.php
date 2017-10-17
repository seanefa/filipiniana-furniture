
<div id="header" class="style2">
  <!-- Top Bar Start-->
  <nav id="top" class="htop">
    <div class="container">
      <div class="row"> <span class="drop-icon visible-sm visible-xs"><i class="fa fa-align-justify"></i></span>
        <div class="pull-left flip left-top">
          <div class="links">
            <?php
            include "userconnect.php";
            session_start();

            $sql="SELECT * from tblcompany_info";
            $result=$conn->query($sql);
            if($result->num_rows>0){
              while($row=$result->fetch_assoc()){
                ?>
                <ul>
                  <li class="mobile"><i class="fa fa-phone"></i><?php echo "" . $row["comp_num"];?></li>
                  <li class="email"><a href="mailto:<?php echo "" . $row["comp_email"];?>"><i class="fa fa-envelope"></i><?php echo "" . $row["comp_email"];?></a></li>
                </ul>
                <?php
              }
            }
            ?>
          </div>
        </div>
        <div id="top-links" class="nav pull-right flip">
          <ul>
            <?php
            // $user = ""; 
            // if(!isset($_SESSION["userName"])){
            //   $user = "";
            // }
            // else{
            //   $user = $_SESSION["userName"];
            // }


            // $sql = "SELECT * FROM tbluser where userID = '$user'";
            // $result = mysqli_query($conn, $sql);
            // $row = mysqli_fetch_assoc($result);
            if(isset($_SESSION['logged']) === true)
            { 
              echo '<li><h5 style="color:black; padding-left:5px; padding-right:5px; font-family:inherit; font-weight:600;">Welcome,&nbsp;<span style="text-transform: uppercase;">'; echo $_SESSION["userName"]; echo '!</span></h5></li>';
              echo '<li><a href="account.php">My Account</a></li>';
              echo '<li><a href="logout.php">Logout</a></li>';
              echo'<input type="hidden" id="logcheck" value="yes" />';
            }
            else
            {
              echo '<li><a href="login.php">Login</a></li>
              <li><a href="register.php">Register</a></li>';
              echo'<input type="hidden" id="logcheck" value="no" />';
            }
            ?>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <!-- Top Bar End-->
  <!-- Header Start-->
  <header class="header-row">
    <div class="container">
      <div class="table-container">
        <!-- Mini Cart Start-->
        <form id="myForm" method="post">
        <div class="col-table-cell col-lg-3 col-md-3 col-sm-12 col-xs-12 inner">
          <div id="cart">
                                <div class="row" id="allprod">
                                      <div id="thisIsCart">
                                      </div>

                                      <div class="row formScroll" id="tblProd">

                                      </div>
                                    </div>
            <!-- Trigger the modal with a button -->
            

            <!-- Modal -->
            <div id="myCart" class="modal fade" role="dialog " aria-hidden="true" style="display: none;" tabindex="-1">
                                      <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <div class="panel-heading"> My Cart </div>
                                          </div>
                                          <div class="orderconfirm">
                                            <div class="descriptions">
                                              <div class="form-body">
                                                <div class="row">
                                                  <div class="col-md-12">
                                                    <div class="panel-wrapper collapse in" aria-expanded="true">
                                                      <div class="panel-body">
                                                        <div class="table-responsive">
                                                          <table class="table product-overview" id="cartTbl">
                                                            <thead>
                                                              <tr>
                                                                <!--th>Image</th-->
                                                                <th style="text-align:left">Furniture</th>
                                                                <th style="text-align:left">Furniture Name</th>
                                                                <th style="text-align:left">Furniture Description</th>
                                                                <th style="text-align:right">Price</th>
                                                                <th style="text-align:right">Quantity</th>
                                                                <th style="text-align:right">Total Price</th>
                                                                <th style="text-align:center">Action</th>
                                                              </tr>
                                                            </thead>
                                                            <tbody>
                                                              <tr>
                                                                <!--td width="150"><img src="../plugins/images/chair.jpg" alt="No Image Available" width="80"></td-->
                                                              </tr>
                                                            </tbody>
                                                            <tfoot>
                                                              <td colspan="3" style="text-align:right"> GRAND TOTAL </td>
                                                              <td id="totalQ" style="text-align:right">0</td>
                                                              <td id="totalPrice" style="text-align:right">0</td>
                                                              <td></td>
                                                            </tfoot>
                                                          </table>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                      <button input="theCloseBtn" type="button" class="fcbtn btn btn-warning btn-outline btn-1b wave effect" data-dismiss="modal"><i class="fa fa-arrow-left"></i> Continue Shopping</button>
                                                      <button type="button" id="check-out" class="fcbtn btn btn-success btn-outline btn-1b wave effect" onclick="checkout()"><i class="fa fa fa-shopping-cart"></i> Proceed to Check-Out</button>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div style="display: none">
                                    <button type="button" id="checkcheckout" data-toggle="modal" href="#myModal2"></button>
                                  </div>
                                    <div id="myModal1" class="modal fade" role="dialog " aria-hidden="true" style="display: none;" tabindex="-1">
                                      <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                          <!-- Modal content -->
                                          <div class="modal-content">
                                            <div class="modal-body">
                                              <h2 style="text-align:center;"> Successfully added to cart!<br>
                                              </h2>
                                              <div class="orderconfirm">
                                                <div class="descriptions">
                                                </div>
                                              </div>
                                            </div>
                                            <div class="modal-footer">
                                              <button input="theCloseBtn" type="button" class="btn btn-default" data-dismiss="modal" onclick="location.reload();">Close</button>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>

                                    <div style="display: none"><button type="button" id="logthis"></button></div>
                                    


        </div>
      </div>
    </form>
      <!-- Mini Cart End-->
        <!-- Logo Start -->
        <div class="col-table-cell col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div id="logo"><a href="home.php"><img class="img-responsive" src="image/logo.png" title="Furniture Shop" alt="Furniture Shop" /></a></div>
        </div>
        
        <div class="col-table-cell col-lg-3 col-md-3 col-sm-12 col-xs-12 inner">
          <div id="search" class="input-group">
            <div class="ui search">
  <form>
  <input class="prompt" type="text" placeholder="Search.." />
  <div class="results"></div>
</div>
</form>
          </div>
        </div>
        <!-- Search End-->
      </div>
    </div>
  </header>
  <!-- Header End-->
  <?php include"menu.php";?>
</div>