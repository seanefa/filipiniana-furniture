<?php
include "userconnect.php";
$sql = "SELECT * FROM tblcompany_info";
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
?><!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="image/favicon.ico" rel="icon" />
<title>FAQ - <?php echo $row['comp_name']?></title>
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
        <li><a href="faq.php">FAQ</a></li>
      </ul>
      <!-- Breadcrumb End-->
      <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-12">
          <h1 class="title">Help &amp; FAQ</h1>
          <hr>
          <div class="row">
            <div class="col-sm-3">
              <h3>My Account &amp; My Orders</h3>
            </div>
            <div class="col-sm-9">
              <div class="faq">
                <div> <a href="#faq1" data-parent="#accordion" data-toggle="collapse" class="panel-title">What is 'My Account'? How do I update my information ? <i class="fa fa-caret-down"></i></a>
                  <div id="faq1" class="panel-collapse collapse">
                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu.</div>
                  </div>
                </div>
                <div> <a href="#faq2" data-parent="#accordion" data-toggle="collapse" class="panel-title">How do I merge my accounts linked to different email ids? <i class="fa fa-caret-down"></i></a>
                  <div id="faq2" class="panel-collapse collapse">
                    <div class="panel-body">
                      <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Nullam ac nisi non eros gravida venenatis.</p>
                      <ul>
                        <li>Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu.</li>
                        <li>Consectetuer adipiscing elit. Donec eros tellus.</li>
                        <li>Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est.</li>
                        <li>Morbi id tellus. Nullam ac nisi non eros gravida venenatis.</li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div> <a href="#faq3" data-parent="#accordion" data-toggle="collapse" class="panel-title"> How do I know my order has been confirmed? <i class="fa fa-caret-down"></i></a>
                  <div id="faq3" class="panel-collapse collapse">
                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu.</div>
                  </div>
                </div>
                <div> <a href="#faq4" data-parent="#accordion" data-toggle="collapse" class="panel-title">Can I order a product that is 'Out of Stock'? <i class="fa fa-caret-down"></i></a>
                  <div id="faq4" class="panel-collapse collapse">
                    <div class="panel-body">
                      <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Nullam ac nisi non eros gravida venenatis.</p>
                      <ul>
                        <li>Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu.</li>
                        <li>Consectetuer adipiscing elit. Donec eros tellus.</li>
                        <li>Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est.</li>
                        <li>Morbi id tellus. Nullam ac nisi non eros gravida venenatis.</li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-3">
              <h3>Shopping</h3>
            </div>
            <div class="col-sm-9">
              <div class="faq">
                <div> <a href="#faq5" data-parent="#accordion" data-toggle="collapse" class="panel-title">I see different prices with the same title. Why? <i class="fa fa-caret-down"></i></a>
                  <div id="faq5" class="panel-collapse collapse">
                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu.</div>
                  </div>
                </div>
                <div> <a href="#faq6" data-parent="#accordion" data-toggle="collapse" class="panel-title">Why do I see different prices for the same product? <i class="fa fa-caret-down"></i></a>
                  <div id="faq6" class="panel-collapse collapse">
                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu.</div>
                  </div>
                </div>
                <div> <a href="#faq7" data-parent="#accordion" data-toggle="collapse" class="panel-title">Is it necessary to have an account to shop on Marketshop? <i class="fa fa-caret-down"></i></a>
                  <div id="faq7" class="panel-collapse collapse">
                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu.</div>
                  </div>
                </div>
                <div> <a href="#faq8" data-parent="#accordion" data-toggle="collapse" class="panel-title">What do I need to know before getting an order gift wrapped? <i class="fa fa-caret-down"></i></a>
                  <div id="faq8" class="panel-collapse collapse">
                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu.</div>
                  </div>
                </div>
                <div> <a href="#faq9" data-parent="#accordion" data-toggle="collapse" class="panel-title">What is Advantage? <i class="fa fa-caret-down"></i></a>
                  <div id="faq9" class="panel-collapse collapse">
                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu.</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-3">
              <h3>Payments</h3>
            </div>
            <div class="col-sm-9">
              <div class="faq">
                <div> <a href="#faq10" data-parent="#accordion" data-toggle="collapse" class="panel-title">How do I pay for a purchase? <i class="fa fa-caret-down"></i></a>
                  <div id="faq10" class="panel-collapse collapse">
                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu.</div>
                  </div>
                </div>
                <div> <a href="#faq11" data-parent="#accordion" data-toggle="collapse" class="panel-title">Are there any hidden charges (Octroi or Sales Tax) when I make a purchase? <i class="fa fa-caret-down"></i></a>
                  <div id="faq11" class="panel-collapse collapse">
                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu.</div>
                  </div>
                </div>
                <div> <a href="#faq12" data-parent="#accordion" data-toggle="collapse" class="panel-title">What is Cash on Delivery? <i class="fa fa-caret-down"></i></a>
                  <div id="faq12" class="panel-collapse collapse">
                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu.</div>
                  </div>
                </div>
                <div> <a href="#faq13" data-parent="#accordion" data-toggle="collapse" class="panel-title">How do I pay using a credit/debit card? <i class="fa fa-caret-down"></i></a>
                  <div id="faq13" class="panel-collapse collapse">
                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu.</div>
                  </div>
                </div>
                <div> <a href="#faq14" data-parent="#accordion" data-toggle="collapse" class="panel-title">Is it safe to use my credit/debit card on this store? <i class="fa fa-caret-down"></i></a>
                  <div id="faq14" class="panel-collapse collapse">
                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu.</div>
                  </div>
                </div>
                <div> <a href="#faq15" data-parent="#accordion" data-toggle="collapse" class="panel-title">What is a 3D Secure password? <i class="fa fa-caret-down"></i></a>
                  <div id="faq15" class="panel-collapse collapse">
                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu.</div>
                  </div>
                </div>
                <div> <a href="#faq16" data-parent="#accordion" data-toggle="collapse" class="panel-title">How can I get the 3D Secure password for my credit/debit card? <i class="fa fa-caret-down"></i></a>
                  <div id="faq16" class="panel-collapse collapse">
                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu.</div>
                  </div>
                </div>
                <div> <a href="#faq17" data-parent="#accordion" data-toggle="collapse" class="panel-title">Can I use my bank's Internet Banking feature to make a payment? <i class="fa fa-caret-down"></i></a>
                  <div id="faq17" class="panel-collapse collapse">
                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu.</div>
                  </div>
                </div>
                <div> <a href="#faq18" data-parent="#accordion" data-toggle="collapse" class="panel-title">Can I make a credit/debit card or Internet Banking payment through my mobile? <i class="fa fa-caret-down"></i></a>
                  <div id="faq18" class="panel-collapse collapse">
                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu.</div>
                  </div>
                </div>
                <div> <a href="#faq19" data-parent="#accordion" data-toggle="collapse" class="panel-title">How does 'Instant Cashback' work? <i class="fa fa-caret-down"></i></a>
                  <div id="faq19" class="panel-collapse collapse">
                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu.</div>
                  </div>
                </div>
                <div> <a href="#faq20" data-parent="#accordion" data-toggle="collapse" class="panel-title">How do I place a Cash on Delivery (COD) order? <i class="fa fa-caret-down"></i></a>
                  <div id="faq20" class="panel-collapse collapse">
                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu.</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-3">
              <h3>Gift Voucher</h3>
            </div>
            <div class="col-sm-9">
              <div class="faq">
                <div> <a href="#faq21" data-parent="#accordion" data-toggle="collapse" class="panel-title">How do I buy/gift an e-Gift Voucher? <i class="fa fa-caret-down"></i></a>
                  <div id="faq21" class="panel-collapse collapse">
                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu.</div>
                  </div>
                </div>
                <div> <a href="#faq22" data-parent="#accordion" data-toggle="collapse" class="panel-title">How do I make a purchase with an e-Gift Voucher? <i class="fa fa-caret-down"></i></a>
                  <div id="faq22" class="panel-collapse collapse">
                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu.</div>
                  </div>
                </div>
                <div> <a href="#faq23" data-parent="#accordion" data-toggle="collapse" class="panel-title">Does an e-Gift Voucher expire? <i class="fa fa-caret-down"></i></a>
                  <div id="faq23" class="panel-collapse collapse">
                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu.</div>
                  </div>
                </div>
                <div> <a href="#faq24" data-parent="#accordion" data-toggle="collapse" class="panel-title">Can I use promotional codes with e-Gift Vouchers? <i class="fa fa-caret-down"></i></a>
                  <div id="faq24" class="panel-collapse collapse">
                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu.</div>
                  </div>
                </div>
                <div> <a href="#faq25" data-parent="#accordion" data-toggle="collapse" class="panel-title">Is there a limit on how many e-Gift vouchers I can use on a single order? <i class="fa fa-caret-down"></i></a>
                  <div id="faq25" class="panel-collapse collapse">
                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu.</div>
                  </div>
                </div>
                <div> <a href="#faq26" data-parent="#accordion" data-toggle="collapse" class="panel-title">What Terms & Conditions apply to e-Gift Vouchers? <i class="fa fa-caret-down"></i></a>
                  <div id="faq26" class="panel-collapse collapse">
                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu.</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-3">
              <h3>Order Status</h3>
            </div>
            <div class="col-sm-9">
              <div class="faq">
                <div> <a href="#faq27" data-parent="#accordion" data-toggle="collapse" class="panel-title">How do I check the current status of my orders? <i class="fa fa-caret-down"></i></a>
                  <div id="faq27" class="panel-collapse collapse">
                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu.</div>
                  </div>
                </div>
                <div> <a href="#faq28" data-parent="#accordion" data-toggle="collapse" class="panel-title">What do the different order status mean? <i class="fa fa-caret-down"></i></a>
                  <div id="faq28" class="panel-collapse collapse">
                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu.</div>
                  </div>
                </div>
                <div> <a href="#faq29" data-parent="#accordion" data-toggle="collapse" class="panel-title">When and how can I cancel an order? <i class="fa fa-caret-down"></i></a>
                  <div id="faq29" class="panel-collapse collapse">
                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu.</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-sm-3">
              <h3>Shipping</h3>
            </div>
            <div class="col-sm-9">
              <div class="faq">
                <div> <a href="#faq30" data-parent="#accordion" data-toggle="collapse" class="panel-title">What are the delivery charges? <i class="fa fa-caret-down"></i></a>
                  <div id="faq30" class="panel-collapse collapse">
                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu.</div>
                  </div>
                </div>
                <div> <a href="#faq31" data-parent="#accordion" data-toggle="collapse" class="panel-title">Are there any hidden costs (sales tax, octroi etc) on items sold by sellers? <i class="fa fa-caret-down"></i></a>
                  <div id="faq31" class="panel-collapse collapse">
                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu.</div>
                  </div>
                </div>
                <div> <a href="#faq32" data-parent="#accordion" data-toggle="collapse" class="panel-title">What is the estimated delivery time? <i class="fa fa-caret-down"></i></a>
                  <div id="faq32" class="panel-collapse collapse">
                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu.</div>
                  </div>
                </div>
                <div> <a href="#faq33" data-parent="#accordion" data-toggle="collapse" class="panel-title">Why does the estimated delivery time vary from seller to seller? <i class="fa fa-caret-down"></i></a>
                  <div id="faq33" class="panel-collapse collapse">
                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu.</div>
                  </div>
                </div>
                <div> <a href="#faq34" data-parent="#accordion" data-toggle="collapse" class="panel-title">Why does the delivery date not correspond to the delivery timeline mentioned? <i class="fa fa-caret-down"></i></a>
                  <div id="faq34" class="panel-collapse collapse">
                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu.</div>
                  </div>
                </div>
                <div> <a href="#faq35" data-parent="#accordion" data-toggle="collapse" class="panel-title">Seller does not/cannot ship to my area. Why? <i class="fa fa-caret-down"></i></a>
                  <div id="faq35" class="panel-collapse collapse">
                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu.</div>
                  </div>
                </div>
                <div> <a href="#faq36" data-parent="#accordion" data-toggle="collapse" class="panel-title">I need to return an item, how do I arrange for a pick-up? <i class="fa fa-caret-down"></i></a>
                  <div id="faq36" class="panel-collapse collapse">
                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu.</div>
                  </div>
                </div>
                <div> <a href="#faq37" data-parent="#accordion" data-toggle="collapse" class="panel-title">Does deliver internationally? <i class="fa fa-caret-down"></i></a>
                  <div id="faq37" class="panel-collapse collapse">
                    <div class="panel-body">Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec eros tellus, scelerisque nec, rhoncus eget, sollicitudin eu, vehicula venenatis, tempor vitae, est. Praesent vitae dui. Morbi id tellus. Nullam ac nisi non eros gravida venenatis. Ut euismod, turpis sollicitudin lobortis pellentesque, libero massa dapibus dui, eu.</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <hr>
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