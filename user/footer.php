<?php
    include "userconnect.php";
    $sql="SELECT * from tblcompany_info";
    $result=$conn->query($sql);
    if($result->num_rows>0)
    {
      while($row=$result->fetch_assoc())
      {
    ?>
<!--Footer Start-->
  <footer id="footer">
    <div class="fpart-first">
      <div class="container">
        <div class="row">
          <div class="contact col-lg-4 col-md-4 col-sm-12 col-xs-12">
            <h5 class="subtitle">About Us</h5>
            <!-- <img alt="" src="image/logo-small.png" style="display:block;margin:auto;"><br> -->
            <h1 style="margin:auto; color:white"><?php echo "" . $row['comp_name'];?></h1>
            <p><i class="fa fa-map-pin"></i>&nbsp;&nbsp;Address : <?php echo "" . $row['comp_address'];?></p>
            <p><i class="fa fa-phone"></i>&nbsp;&nbsp;Phone : <?php echo "" . $row['comp_num'];?></p>
            <p><i class="fa fa-envelope"></i>&nbsp;&nbsp;E-mail : <?php echo "" . $row['comp_email'];?></p>
          </div>
          <div class="column col-lg-2 col-md-2 col-sm-3 col-xs-12">
            <h5 class="subtitle">Information</h5>
            <ul>
              <li><a href="about-us.php">About Us</a></li>
              <li><a href="delivery-information.php">Delivery Rates</a></li>
              <li><a href="privacy-policy.php">Privacy Policy</a></li>
              <li><a href="terms-condition.php">Terms &amp; Conditions</a></li>
            </ul>
          </div>
          <div class="column col-lg-2 col-md-2 col-sm-3 col-xs-12">
            <h5 class="subtitle">Customer Care</h5>
            <ul>
              <li><a href="contact-us.php">Contact Us</a></li>
              <li><a href="returns.php">Returns</a></li>
              <li><a href="sitemap.php">Site Map</a></li>
              <li><a href="faq.php">Frequently Asked Questions</a></li>
            </ul>
          </div>
          <div class="column col-lg-2 col-md-2 col-sm-3 col-xs-12">
            <h5 class="subtitle">Extras</h5>
            <ul>
              <li><a href="customization.php">Customized Solutions</a></li>
              <?php 
              if(isset($_SESSION['logged']) === false)
                { 
                 echo '<li><a href="/admin/login.php">Login as Admin</a></li>';
                }
              ?>
            </ul>
          </div>
          <div class="column col-lg-2 col-md-2 col-sm-3 col-xs-12">
            <h5 class="subtitle">My Account</h5>
            <ul>
              <li><a href="account.php">Dashboard</a></li>
              <li><a href="orders.php">Orders</a></li>
            </ul>
          </div>
        </div>

        <div class="social pull-right flip"><a href="https://www.facebook.com/BaraquielsFilipinianaFurniture/" target="_blank"> <img data-toggle="tooltip" src="image/socialicons/facebook.png" alt="Facebook" title="Facebook"></a> <a href="http://www.google.com/filipinianafurniture" target="_blank"> <img data-toggle="tooltip" src="image/socialicons/google_plus.png" alt="Google+" title="Google+"> </a> <a href="#" target="_blank"> <img data-toggle="tooltip" src="image/socialicons/rss.png" alt="RSS" title="RSS"> </a> </div>
      </div>

      <!--div id="facebook" class="fb-left sort-order-1" style="left: -241px;">
          <div class="facebook_icon"><i class="fa fa-facebook"></i></div>
          <div class="fb-page" data-href="https://www.facebook.com/BaraquielsFilipinianaFurniture/?rf=394433167420532" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/BaraquielsFilipinianaFurniture/?rf=394433167420532" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/BaraquielsFilipinianaFurniture/?rf=394433167420532">Filipiniana Furniture</a></blockquote></div>
          <div id="fb-root"></div>
          <script id="twitter-wjs" src="https://platform.twitter.com/widgets.js"></script><script id="facebook-jssdk" src="//connect.facebook.net/en_US/sdk.js#xfbml=1&amp;version=v2.4"></script><script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>
        </div>

        <div id="twitter_footer" class="twit-left sort-order-2">
          <div class="twitter_icon"><i class="fa fa-twitter"></i></div>
        <a href="https://twitter.com/intent/tweet?button_hashtag=FilipinianaFurniture" class="twitter-hashtag-button" data-show-count="false">Tweet #FilipinianaFurniture</a><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
          <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
        </div-->

    </div>
    <!--div class="fpart-second">
      <div class="container">
        <div id="powered" class="clearfix">
          <div class="social pull-right flip">
            <h5 style="color: white;">Get in Touch</h5><a href="https://www.facebook.com/BaraquielsFilipinianaFurniture/" target="_blank"> <img data-toggle="tooltip" src="image/socialicons/facebook.png" alt="Facebook" title="Facebook"></a> <a href="http://www.google.com/filipinianafurniture" target="_blank"> <img data-toggle="tooltip" src="image/socialicons/google_plus.png" alt="Google+" title="Google+"> </a> <a href="#" target="_blank"> <img data-toggle="tooltip" src="image/socialicons/rss.png" alt="RSS" title="RSS"> </a> </div>
        <div id="facebook" class="fb-left sort-order-1" style="left: -241px;">
          <div class="facebook_icon"><i class="fa fa-facebook"></i></div>
          <div class="fb-page" data-href="https://www.facebook.com/BaraquielsFilipinianaFurniture/?rf=394433167420532" data-tabs="timeline" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/BaraquielsFilipinianaFurniture/?rf=394433167420532" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/BaraquielsFilipinianaFurniture/?rf=394433167420532">Filipiniana Furniture</a></blockquote></div>
          <div id="fb-root"></div>
          <script id="twitter-wjs" src="https://platform.twitter.com/widgets.js"></script><script id="facebook-jssdk" src="//connect.facebook.net/en_US/sdk.js#xfbml=1&amp;version=v2.4"></script><script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));</script>
        </div>

        <div id="twitter_footer" class="twit-left sort-order-2">
          <div class="twitter_icon"><i class="fa fa-twitter"></i></div>
        <a href="https://twitter.com/intent/tweet?button_hashtag=FilipinianaFurniture" class="twitter-hashtag-button" data-show-count="false">Tweet #FilipinianaFurniture</a><script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>
          <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
        </div>
      </div>
    </div>
    </div-->
    <div id="back-top"><a data-toggle="tooltip" title="Back to Top" href="javascript:void(0)" class="backtotop"><i class="fa fa-chevron-up"></i></a></div>
  </footer>
  <!--Footer End-->
<?php
    }
  }
  $conn->close();
?>