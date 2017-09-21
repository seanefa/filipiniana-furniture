 <!-- Main Menu Start-->
    <nav id="menu" class="navbar">
      <div class="navbar-header"> <span class="visible-xs visible-sm"> Menu <b></b></span></div>
      <div class="container">
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav">
            <li><a class="home_link" title="Home" href="home.php">Home</a></li>
            <li class="mega-menu dropdown"><a href="products.php">Products</a>
              <div class="dropdown-menu">
                <div class="column col-lg-2 col-md-3"><a href="category.php">Sub Category</a>
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
                <div class="column col-lg-2 col-md-3"><a href="category.php">Sub Category</a>
                  <div>
                    <ul>
                      <li><a href="category.php">New Sub Category</a></li>
                      <li><a href="category.php">New Sub Category</a></li>
                      <li><a href="category.php">New Sub Category</a></li>
                      <li><a href="category.php">New Sub Category</a></li>
                    </ul>
                  </div>
                </div>
                <div class="column col-lg-2 col-md-3"><a href="category.php">Sub Category</a>
                  <div>
                    <ul>
                      <li><a href="category.php">New Sub Category</a></li>
                      <li><a href="category.php">New Sub Category</a></li>
                      <li><a href="category.php">New Sub Category</a></li>
                    </ul>
                  </div>
                </div>
                <div class="column col-lg-2 col-md-3"><a href="category.php">Sub Category</a>
                  <div>
                    <ul>
                      <li><a href="category.php">New Sub Category</a></li>
                      <li><a href="category.php">New Sub Category</a></li>
                      <li><a href="category.php">New Sub Category</a></li>
                      <li><a href="category.php">New Sub Category</a></li>
                    </ul>
                  </div>
                </div>
                <div class="column col-lg-2 col-md-3"><a href="category.php">Sub Category</a>
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
                <div class="column col-lg-2 col-md-3"><a href="category.php">Sub Category</a>
                  <div>
                    <ul>
                      <li><a href="category.php">New Sub Category</a></li>
                      <li><a href="category.php">New Sub Category</a></li>
                    </ul>
                  </div>
                </div>
              </div>
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
               echo '<li class="mega-menu dropdown"> <a href="production.php">Production</a></li>';
              }
            ?>
          </ul>
        </div>
      </div>
    </nav>
    <!-- Main Menu End-->