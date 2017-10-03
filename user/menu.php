<?php
  include 'scripts.php';
  include 'css.php';
  include 'userconnect.php';

  

?>
 <!-- Main Menu Start-->
    <nav id="menu" class="navbar">
      <div class="navbar-header"> <span class="visible-xs visible-sm"> Menu <b></b></span></div>
      <div class="container">
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav">
            <li><a class="home_link" title="Home" href="home.php">Home</a></li>
            <li class="mega-menu dropdown"><a href="products.php">Products</a>
              <div class="dropdown-menu">
                <?php
                       $sql = "SELECT * from tblfurn_category;";
                      $result = mysqli_query($conn,$sql);

                      if($result){
                  while($row = mysqli_fetch_assoc($result)){
                    
                    if($row['categoryStatus'] == 'Listed'){

                      $id = $row['categoryID'];

                      $xsql = "SELECT * from tblfurn_type where typeCategoryID = '$id';";
                      $xresult = mysqli_query($conn,$xsql);

                    echo''?>
                    <div class="column col-lg-2 col-md-3"><a href="category.php?id=<?php echo 'C'.$row['categoryID']?>"><?php echo $row['categoryName']?></a>
                  <div>
                    <ul>
                      <?php
                      while($xrow = mysqli_fetch_assoc($xresult)){
                        if($xrow['typeStatus'] == 'Listed'){
                        ?> 
                        <li><a href="category.php?id=<?php echo 'T'.$xrow['typeID']?>""><?php echo $xrow['typeName']; ?></a></li>
                        <?php 
                        }
                      }
                      ?>
                    </ul>
                  </div>
              </div>
                    <?php echo '';
                    
                    }
                  }
} 
                ?>
                
            </li>
            <li class="mega-menu dropdown"><a href="packages.php">Packages</a>
<!--
              <div class="dropdown-menu">
                <div class="column col-lg-6 col-md-6"><a href="category.php">Sub Category</a>
                  <div>
                    <ul>
                      <li><a href="category.php">New Sub Category</a></li>
                      <li><a href="category.php">New Sub Category</a></li>
                      <li><a href="category.php">New Sub Category</a></li>
                      <li><a href="category.php">New Sub Category</a></li>
                    </ul>
                  </div>
                </div>
                <div class="column col-lg-6 col-md-6"><a href="category.php">Sub Category</a>
                  <div>
                    <ul>
                      <li><a href="category.php">New Sub Category</a></li>
                      <li><a href="category.php">New Sub Category</a></li>
                      <li><a href="category.php">New Sub Category</a></li>
                      <li><a href="category.php">New Sub Category</a></li>
                      <li><a href="category.php">New Sub Category</a></li>
                    </ul>
                  </div>
                </div>
              </div>
-->
            </li>
            <li class="mega-menu dropdown"> <a href="promos.php">Promos</a></li>
            <?php 
            if(isset($_SESSION['logged']) === true)
              { 
               echo '<li class="mega-menu dropdown"> <a href="production.php">Production</a></li>
                     <li class="mega-menu dropdown"> <a href="customization.php">Customization</a></li>';
              }
            ?>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Main Menu End-->

  <script type="text/javascript">
    var nav = $('#menu');
    $(window).scroll(function () {
      if ($(this).scrollTop() > 160) {
        nav.addClass("f-nav");
      } else {
        nav.removeClass("f-nav");
      }
    });
  </script>