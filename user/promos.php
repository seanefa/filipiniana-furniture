<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="image/favicon.ico" rel="icon" />
<title>Promos - Filipiniana Furniture Shop</title>
<meta name="description" content="Furniture shop">
<?php include"css.php";?>
</head>
<body>
<div class="wrapper-wide">
<?php include"header.php";?>
<div id="container">
    <div class="container">
      <!-- Breadcrumb Start-->
      <ul class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i></a></li>
        <li><a href="products.php">Promos</a></li>
      </ul>
      <!-- Breadcrumb End-->
      <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-12">
          <h1 class="title">Promos</h1>
          
          <div class="product-filter">
            <div class="row">
              <div class="col-md-4 col-sm-5">
                <div class="btn-group">
                  <button type="button" id="list-view" class="btn btn-default" data-toggle="tooltip" title="List"><i class="fa fa-th-list"></i></button>
                  <button type="button" id="grid-view" class="btn btn-default" data-toggle="tooltip" title="Grid"><i class="fa fa-th"></i></button>
                </div>
                <a href="compare.php" id="compare-total">Promo Compare (0)</a> </div>
              <div class="col-sm-2 text-right">
                <label class="control-label" for="input-sort">Sort By:</label>
              </div>
              <div class="col-md-3 col-sm-2 text-right">
                <select id="input-sort" class="form-control col-sm-3">
                  <option value="" selected="selected">Default</option>
                  <option value="">Name (A - Z)</option>
                  <option value="">Name (Z - A)</option>
                  <option value="">Price (Low &gt; High)</option>
                  <option value="">Price (High &gt; Low)</option>
                  <option value="">Rating (Highest)</option>
                  <option value="">Rating (Lowest)</option>
                  <option value="">Model (A - Z)</option>
                  <option value="">Model (Z - A)</option>
                </select>
              </div>
              <div class="col-sm-1 text-right">
                <label class="control-label" for="input-limit">Show:</label>
              </div>
              <div class="col-sm-2 text-right">
                <select id="input-limit" class="form-control">
                  <option value="" selected="selected">20</option>
                  <option value="">25</option>
                  <option value="">50</option>
                  <option value="">75</option>
                  <option value="">100</option>
                </select>
              </div>
            </div>
          </div>
          <br />
          <div class="row products-products">
            <div class="product-layout product-list col-xs-12">
              <div class="product-thumb">
                <div class="image"><a href="view-product.php"><img src="image/product/macbook_pro_1-270x405.jpg" alt=" Promo " title=" Promo " class="img-responsive" /></a></div>
                <div>
                  <div class="caption">
                    <h4><a href="view-product.php"> Promo </a></h4>
                    <p class="description">Promo 5</p>
                    <p class="price"> <span class="price-new">&#8369 1,400.00</span> <span class="price-old">&#8369 1,900.00</span> <span class="price-tax">Ex Tax: &#8369 1,400.00</span> </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>Add to Cart</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="Add to Wish List" onClick=""><i class="fa fa-heart"></i> <span>Add to Wish List</span></button>
                      <button type="button" data-toggle="tooltip" title="Compare this Promo" onClick=""><i class="fa fa-exchange"></i> <span>Compare this Promo</span></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="product-layout product-list col-xs-12">
              <div class="product-thumb">
                <div class="image"><a href="view-product.php"><img src="image/product/nikon_d300_1-270x405.jpg" alt="Promo" title="Promo" class="img-responsive" /></a></div>
                <div>
                  <div class="caption">
                    <h4><a href="view-product.php">Promo</a></h4>
                    <p class="description">Promo 7</p>
                    <p class="price"> <span class="price-new">&#8369 92.00</span> <span class="price-old">&#8369 98.00</span> <span class="price-tax">Ex Tax: &#8369 75.00</span> </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick="cart.add('31');"><span>Add to Cart</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="Add to Wish List" onClick=""><i class="fa fa-heart"></i> <span>Add to Wish List</span></button>
                      <button type="button" data-toggle="tooltip" title="Compare this Promo" onClick=""><i class="fa fa-exchange"></i> <span>Compare this Promo</span></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="product-layout product-list col-xs-12">
              <div class="product-thumb">
                <div class="image"><a href="view-product.php"><img src="image/product/FinePix-Long-Zoom-Camera-270x405.jpg" alt="Promo" title="Promo" class="img-responsive" /></a></div>
                <div>
                  <div class="caption">
                    <h4><a href="view-product.php">Promo</a></h4>
                    <p class="description">Promo 8
                      ..</p>
                    <p class="price"> &#8369 122.00 <span class="price-tax">Ex Tax: &#8369 100.00</span> </p>
                  </div>
                  <div class="button-group">
                    <button class="btn-primary" type="button" onClick=""><span>Add to Cart</span></button>
                    <div class="add-to-links">
                      <button type="button" data-toggle="tooltip" title="Add to Wish List" onClick=""><i class="fa fa-heart"></i> <span>Add to Wish List</span></button>
                      <button type="button" data-toggle="tooltip" title="Compare this Promo" onClick=""><i class="fa fa-exchange"></i> <span>Compare this Promo</span></button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6 text-left">
              <ul class="pagination">
                <li class="active"><span>1</span></li>
                <li><a href="#">2</a></li>
                <li><a href="#">&gt;</a></li>
                <li><a href="#">&gt;|</a></li>
              </ul>
            </div>
            <div class="col-sm-6 text-right">Showing 1 to 12 of 15 (2 Pages)</div>
          </div>
        </div>
        <!--Middle Part End -->
      </div>
    </div>
  </div>
<?php include"footer.php";?>
</div>
<?php include"scripts.php";?>
</body>
</html>