<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="image/favicon.ico" rel="icon" />
<title>Cart - Filipiniana Furniture Shop</title>
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
        <li><a href="cart.php">Shopping Cart</a></li>
      </ul>
      <!-- Breadcrumb End-->
      <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-12">
          <h1 class="title">Shopping Cart</h1>
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <td class="text-center">Image</td>
                    <td class="text-left">Product Name</td>
                    <td class="text-left">Model</td>
                    <td class="text-left">Quantity</td>
                    <td class="text-right">Unit Price</td>
                    <td class="text-right">Total</td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="text-center"><a href="product.php"><img src="image/product/samsung_tab_1-50x75.jpg" alt="Aspire Ultrabook Laptop" title="Aspire Ultrabook Laptop" class="img-thumbnail" /></a></td>
                    <td class="text-left"><a href="product.php">Aspire Ultrabook Laptop</a><br />
                      <small>Reward Points: 1000</small></td>
                    <td class="text-left">SAM1</td>
                    <td class="text-left"><div class="input-group btn-block quantity">
                        <input type="text" name="quantity" value="1" size="1" class="form-control" />
                        <span class="input-group-btn">
                        <button type="submit" data-toggle="tooltip" title="Update" class="btn btn-primary"><i class="fa fa-refresh"></i></button>
                        <button type="button" data-toggle="tooltip" title="Remove" class="btn btn-danger" onClick=""><i class="fa fa-times-circle"></i></button>
                        </span></div></td>
                    <td class="text-right">$230.00</td>
                    <td class="text-right">$230.00</td>
                  </tr>
                  <tr>
                    <td class="text-center"><a href="product.php"><img src="image/product/sony_vaio_1-50x75.jpg" alt="Xitefun Causal Wear Fancy Shoes" title="Xitefun Causal Wear Fancy Shoes" class="img-thumbnail" /></a></td>
                    <td class="text-left"><a href="product.php">Xitefun Causal Wear Fancy Shoes</a></td>
                    <td class="text-left">Product 114</td>
                    <td class="text-left"><div class="input-group btn-block quantity">
                        <input type="text" name="quantity" value="1" size="1" class="form-control" />
                        <span class="input-group-btn">
                        <button type="submit" data-toggle="tooltip" title="Update" class="btn btn-primary"><i class="fa fa-refresh"></i></button>
                        <button type="button" data-toggle="tooltip" title="Remove" class="btn btn-danger" onClick=""><i class="fa fa-times-circle"></i></button>
                        </span></div></td>
                    <td class="text-right">$902.00</td>
                    <td class="text-right">$902.00</td>
                  </tr>
                </tbody>
              </table>
            </div>
          <h2 class="subtitle">What would you like to do next?</h2>
          <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
          <div class="row">
            <div class="col-sm-6">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">Use Coupon Code</h4>
                </div>
                <div id="collapse-coupon" class="panel-collapse collapse in">
                  <div class="panel-body">
                    <label class="col-sm-4 control-label" for="input-coupon">Enter your coupon here</label>
                    <div class="input-group">
                      <input type="text" name="coupon" value="" placeholder="Enter your coupon here" id="input-coupon" class="form-control" />
                      <span class="input-group-btn">
                      <input type="button" value="Apply Coupon" id="button-coupon" data-loading-text="Loading..."  class="btn btn-primary" />
                      </span></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title">Use Gift Voucher</h4>
                </div>
                <div id="collapse-voucher" class="panel-collapse collapse in">
                  <div class="panel-body">
                    <label class="col-sm-4 control-label" for="input-voucher">Enter gift voucher code here</label>
                    <div class="input-group">
                      <input type="text" name="voucher" value="" placeholder="Enter gift voucher code here" id="input-voucher" class="form-control" />
                      <span class="input-group-btn">
                      <input type="submit" value="Apply Voucher" id="button-voucher" data-loading-text="Loading..."  class="btn btn-primary" />
                      </span> </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4 class="panel-title">Estimate Shipping &amp; Taxes</h4>
            </div>
            <div id="collapse-shipping" class="panel-collapse collapse in">
              <div class="panel-body">
                <p>Enter your destination to get a shipping estimate.</p>
                <form class="form-horizontal">
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-country">Country</label>
                    <div class="col-sm-10">
                      <select name="country_id" id="input-country" class="form-control">
                        <option value=""> --- Please Select --- </option>
                        <option value="244">Aaland Islands</option>
                        <option value="1">Afghanistan</option>
                        <option value="2">Albania</option>
                        <option value="3">Algeria</option>
                        <option value="4">American Samoa</option>
                        <option value="5">Andorra</option>
                        <option value="6">Angola</option>
                        <option value="7">Anguilla</option>
                        <option value="8">Antarctica</option>
                        <option value="9">Antigua and Barbuda</option>
                        <option value="10">Argentina</option>
                        <option value="11">Armenia</option>
                        <option value="12">Aruba</option>
                        <option value="252">Ascension Island (British)</option>
                        <option value="13">Australia</option>
                        <option value="14">Austria</option>
                        <option value="15">Azerbaijan</option>
                        <option value="16">Bahamas</option>
                        <option value="17">Bahrain</option>
                        <option value="18">Bangladesh</option>
                        <option value="19">Barbados</option>
                        <option value="20">Belarus</option>
                        <option value="21">Belgium</option>
                        <option value="22">Belize</option>
                        <option value="23">Benin</option>
                        <option value="24">Bermuda</option>
                        <option value="25">Bhutan</option>
                        <option value="26">Bolivia</option>
                        <option value="245">Bonaire, Sint Eustatius and Saba</option>
                        <option value="27">Bosnia and Herzegovina</option>
                        <option value="28">Botswana</option>
                        <option value="29">Bouvet Island</option>
                        <option value="30">Brazil</option>
                        <option value="31">British Indian Ocean Territory</option>
                        <option value="32">Brunei Darussalam</option>
                        <option value="33">Bulgaria</option>
                        <option value="34">Burkina Faso</option>
                        <option value="35">Burundi</option>
                        <option value="36">Cambodia</option>
                        <option value="37">Cameroon</option>
                        <option value="38">Canada</option>
                        <option value="251">Canary Islands</option>
                        <option value="39">Cape Verde</option>
                        <option value="40">Cayman Islands</option>
                        <option value="41">Central African Republic</option>
                        <option value="42">Chad</option>
                        <option value="43">Chile</option>
                        <option value="44">China</option>
                        <option value="45">Christmas Island</option>
                        <option value="46">Cocos (Keeling) Islands</option>
                        <option value="47">Colombia</option>
                        <option value="48">Comoros</option>
                        <option value="49">Congo</option>
                        <option value="50">Cook Islands</option>
                        <option value="51">Costa Rica</option>
                        <option value="52">Cote D'Ivoire</option>
                        <option value="53">Croatia</option>
                        <option value="54">Cuba</option>
                        <option value="246">Curacao</option>
                        <option value="55">Cyprus</option>
                        <option value="56">Czech Republic</option>
                        <option value="237">Democratic Republic of Congo</option>
                        <option value="57">Denmark</option>
                        <option value="58">Djibouti</option>
                        <option value="59">Dominica</option>
                        <option value="60">Dominican Republic</option>
                        <option value="61">East Timor</option>
                        <option value="62">Ecuador</option>
                        <option value="63">Egypt</option>
                        <option value="64">El Salvador</option>
                        <option value="65">Equatorial Guinea</option>
                        <option value="66">Eritrea</option>
                        <option value="67">Estonia</option>
                        <option value="68">Ethiopia</option>
                        <option value="69">Falkland Islands (Malvinas)</option>
                        <option value="70">Faroe Islands</option>
                        <option value="71">Fiji</option>
                        <option value="72">Finland</option>
                        <option value="74">France, Metropolitan</option>
                        <option value="75">French Guiana</option>
                        <option value="76">French Polynesia</option>
                        <option value="77">French Southern Territories</option>
                        <option value="126">FYROM</option>
                        <option value="78">Gabon</option>
                        <option value="79">Gambia</option>
                        <option value="80">Georgia</option>
                        <option value="81">Germany</option>
                        <option value="82">Ghana</option>
                        <option value="83">Gibraltar</option>
                        <option value="84">Greece</option>
                        <option value="85">Greenland</option>
                        <option value="86">Grenada</option>
                        <option value="87">Guadeloupe</option>
                        <option value="88">Guam</option>
                        <option value="89">Guatemala</option>
                        <option value="256">Guernsey</option>
                        <option value="90">Guinea</option>
                        <option value="91">Guinea-Bissau</option>
                        <option value="92">Guyana</option>
                        <option value="93">Haiti</option>
                        <option value="94">Heard and Mc Donald Islands</option>
                        <option value="95">Honduras</option>
                        <option value="96">Hong Kong</option>
                        <option value="97">Hungary</option>
                        <option value="98">Iceland</option>
                        <option value="99">India</option>
                        <option value="100">Indonesia</option>
                        <option value="101">Iran (Islamic Republic of)</option>
                        <option value="102">Iraq</option>
                        <option value="103">Ireland</option>
                        <option value="254">Isle of Man</option>
                        <option value="104">Israel</option>
                        <option value="105">Italy</option>
                        <option value="106">Jamaica</option>
                        <option value="107">Japan</option>
                        <option value="257">Jersey</option>
                        <option value="108">Jordan</option>
                        <option value="109">Kazakhstan</option>
                        <option value="110">Kenya</option>
                        <option value="111">Kiribati</option>
                        <option value="113">Korea, Republic of</option>
                        <option value="253">Kosovo, Republic of</option>
                        <option value="114">Kuwait</option>
                        <option value="115">Kyrgyzstan</option>
                        <option value="116">Lao People's Democratic Republic</option>
                        <option value="117">Latvia</option>
                        <option value="118">Lebanon</option>
                        <option value="119">Lesotho</option>
                        <option value="120">Liberia</option>
                        <option value="121">Libyan Arab Jamahiriya</option>
                        <option value="122">Liechtenstein</option>
                        <option value="123">Lithuania</option>
                        <option value="124">Luxembourg</option>
                        <option value="125">Macau</option>
                        <option value="127">Madagascar</option>
                        <option value="128">Malawi</option>
                        <option value="129">Malaysia</option>
                        <option value="130">Maldives</option>
                        <option value="131">Mali</option>
                        <option value="132">Malta</option>
                        <option value="133">Marshall Islands</option>
                        <option value="134">Martinique</option>
                        <option value="135">Mauritania</option>
                        <option value="136">Mauritius</option>
                        <option value="137">Mayotte</option>
                        <option value="138">Mexico</option>
                        <option value="139">Micronesia, Federated States of</option>
                        <option value="140">Moldova, Republic of</option>
                        <option value="141">Monaco</option>
                        <option value="142">Mongolia</option>
                        <option value="242">Montenegro</option>
                        <option value="143">Montserrat</option>
                        <option value="144">Morocco</option>
                        <option value="145">Mozambique</option>
                        <option value="146">Myanmar</option>
                        <option value="147">Namibia</option>
                        <option value="148">Nauru</option>
                        <option value="149">Nepal</option>
                        <option value="150">Netherlands</option>
                        <option value="151">Netherlands Antilles</option>
                        <option value="152">New Caledonia</option>
                        <option value="153">New Zealand</option>
                        <option value="154">Nicaragua</option>
                        <option value="155">Niger</option>
                        <option value="156">Nigeria</option>
                        <option value="157">Niue</option>
                        <option value="158">Norfolk Island</option>
                        <option value="112">North Korea</option>
                        <option value="159">Northern Mariana Islands</option>
                        <option value="160">Norway</option>
                        <option value="161">Oman</option>
                        <option value="162">Pakistan</option>
                        <option value="163">Palau</option>
                        <option value="247">Palestinian Territory, Occupied</option>
                        <option value="164">Panama</option>
                        <option value="165">Papua New Guinea</option>
                        <option value="166">Paraguay</option>
                        <option value="167">Peru</option>
                        <option value="168">Philippines</option>
                        <option value="169">Pitcairn</option>
                        <option value="170">Poland</option>
                        <option value="171">Portugal</option>
                        <option value="172">Puerto Rico</option>
                        <option value="173">Qatar</option>
                        <option value="174">Reunion</option>
                        <option value="175">Romania</option>
                        <option value="176">Russian Federation</option>
                        <option value="177">Rwanda</option>
                        <option value="178">Saint Kitts and Nevis</option>
                        <option value="179">Saint Lucia</option>
                        <option value="180">Saint Vincent and the Grenadines</option>
                        <option value="181">Samoa</option>
                        <option value="182">San Marino</option>
                        <option value="183">Sao Tome and Principe</option>
                        <option value="184">Saudi Arabia</option>
                        <option value="185">Senegal</option>
                        <option value="243">Serbia</option>
                        <option value="186">Seychelles</option>
                        <option value="187">Sierra Leone</option>
                        <option value="188">Singapore</option>
                        <option value="189">Slovak Republic</option>
                        <option value="190">Slovenia</option>
                        <option value="191">Solomon Islands</option>
                        <option value="192">Somalia</option>
                        <option value="193">South Africa</option>
                        <option value="194">South Georgia &amp; South Sandwich Islands</option>
                        <option value="248">South Sudan</option>
                        <option value="195">Spain</option>
                        <option value="196">Sri Lanka</option>
                        <option value="249">St. Barthelemy</option>
                        <option value="197">St. Helena</option>
                        <option value="250">St. Martin (French part)</option>
                        <option value="198">St. Pierre and Miquelon</option>
                        <option value="199">Sudan</option>
                        <option value="200">Suriname</option>
                        <option value="201">Svalbard and Jan Mayen Islands</option>
                        <option value="202">Swaziland</option>
                        <option value="203">Sweden</option>
                        <option value="204">Switzerland</option>
                        <option value="205">Syrian Arab Republic</option>
                        <option value="206">Taiwan</option>
                        <option value="207">Tajikistan</option>
                        <option value="208">Tanzania, United Republic of</option>
                        <option value="209">Thailand</option>
                        <option value="210">Togo</option>
                        <option value="211">Tokelau</option>
                        <option value="212">Tonga</option>
                        <option value="213">Trinidad and Tobago</option>
                        <option value="255">Tristan da Cunha</option>
                        <option value="214">Tunisia</option>
                        <option value="215">Turkey</option>
                        <option value="216">Turkmenistan</option>
                        <option value="217">Turks and Caicos Islands</option>
                        <option value="218">Tuvalu</option>
                        <option value="219">Uganda</option>
                        <option value="220">Ukraine</option>
                        <option value="221">United Arab Emirates</option>
                        <option value="222" selected="selected">United Kingdom</option>
                        <option value="223">United States</option>
                        <option value="224">United States Minor Outlying Islands</option>
                        <option value="225">Uruguay</option>
                        <option value="226">Uzbekistan</option>
                        <option value="227">Vanuatu</option>
                        <option value="228">Vatican City State (Holy See)</option>
                        <option value="229">Venezuela</option>
                        <option value="230">Viet Nam</option>
                        <option value="231">Virgin Islands (British)</option>
                        <option value="232">Virgin Islands (U.S.)</option>
                        <option value="233">Wallis and Futuna Islands</option>
                        <option value="234">Western Sahara</option>
                        <option value="235">Yemen</option>
                        <option value="238">Zambia</option>
                        <option value="239">Zimbabwe</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-zone">Region / State</label>
                    <div class="col-sm-10">
                      <select class="form-control" id="input-zone" name="zone_id">
                        <option value=""> --- Please Select --- </option>
                        <option value="13">Aberdeen</option>
                        <option value="14">Aberdeenshire</option>
                        <option value="15">Anglesey</option>
                        <option value="16">Angus</option>
                        <option value="17">Argyll and Bute</option>
                        <option value="18">Bedfordshire</option>
                        <option value="19">Berkshire</option>
                        <option value="20">Blaenau Gwent</option>
                        <option value="21">Bridgend</option>
                        <option value="22">Bristol</option>
                        <option value="23">Buckinghamshire</option>
                        <option value="24">Caerphilly</option>
                        <option value="25">Cambridgeshire</option>
                        <option value="26">Cardiff</option>
                        <option value="27">Carmarthenshire</option>
                        <option value="28">Ceredigion</option>
                        <option value="29">Cheshire</option>
                        <option value="30">Clackmannanshire</option>
                        <option value="31">Conwy</option>
                        <option value="32">Cornwall</option>
                        <option value="3949">County Antrim</option>
                        <option value="3950">County Armagh</option>
                        <option value="3951">County Down</option>
                        <option value="3952">County Fermanagh</option>
                        <option value="3953">County Londonderry</option>
                        <option value="3954">County Tyrone</option>
                        <option value="3955">Cumbria</option>
                        <option value="33">Denbighshire</option>
                        <option value="34">Derbyshire</option>
                        <option value="">Devon</option>
                        <option value="36">Dorset</option>
                        <option value="37">Dumfries and Galloway</option>
                        <option value="38">Dundee</option>
                        <option value="39">Durham</option>
                        <option value="40">East Ayrshire</option>
                        <option value="41">East Dunbartonshire</option>
                        <option value="42">East Lothian</option>
                        <option value="43">East Renfrewshire</option>
                        <option value="44">East Riding of Yorkshire</option>
                        <option value="45">East Sussex</option>
                        <option value="46">Edinburgh</option>
                        <option value="47">Essex</option>
                        <option value="48">Falkirk</option>
                        <option value="49">Fife</option>
                        <option value="50">Flintshire</option>
                        <option value="51">Glasgow</option>
                        <option value="52">Gloucestershire</option>
                        <option value="53">Greater London</option>
                        <option value="54">Greater Manchester</option>
                        <option value="55">Gwynedd</option>
                        <option value="56">Hampshire</option>
                        <option value="57">Herefordshire</option>
                        <option value="58">Hertfordshire</option>
                        <option value="59">Highlands</option>
                        <option value="60">Inverclyde</option>
                        <option value="61">Isle of Wight</option>
                        <option value="62">Kent</option>
                        <option value="63">Lancashire</option>
                        <option value="64">Leicestershire</option>
                        <option value="65">Lincolnshire</option>
                        <option value="66">Merseyside</option>
                        <option value="67">Merthyr Tydfil</option>
                        <option value="68">Midlothian</option>
                        <option value="69">Monmouthshire</option>
                        <option value="70">Moray</option>
                        <option value="71">Neath Port Talbot</option>
                        <option value="72">Newport</option>
                        <option value="73">Norfolk</option>
                        <option value="74">North Ayrshire</option>
                        <option value="75">North Lanarkshire</option>
                        <option value="76">North Yorkshire</option>
                        <option value="77">Northamptonshire</option>
                        <option value="78">Northumberland</option>
                        <option value="79">Nottinghamshire</option>
                        <option value="80">Orkney Islands</option>
                        <option value="81">Oxfordshire</option>
                        <option value="82">Pembrokeshire</option>
                        <option value="83">Perth and Kinross</option>
                        <option value="84">Powys</option>
                        <option value="85">Renfrewshire</option>
                        <option value="86">Rhondda Cynon Taff</option>
                        <option value="87">Rutland</option>
                        <option value="88">Scottish Borders</option>
                        <option value="89">Shetland Islands</option>
                        <option value="90">Shropshire</option>
                        <option value="91">Somerset</option>
                        <option value="92">South Ayrshire</option>
                        <option value="93">South Lanarkshire</option>
                        <option value="94">South Yorkshire</option>
                        <option value="95">Staffordshire</option>
                        <option value="96">Stirling</option>
                        <option value="97">Suffolk</option>
                        <option value="98">Surrey</option>
                        <option value="99">Swansea</option>
                        <option value="00">Torfaen</option>
                        <option value="01">Tyne and Wear</option>
                        <option value="02">Vale of Glamorgan</option>
                        <option value="03">Warwickshire</option>
                        <option value="04">West Dunbartonshire</option>
                        <option value="05">West Lothian</option>
                        <option value="06">West Midlands</option>
                        <option value="07">West Sussex</option>
                        <option value="08">West Yorkshire</option>
                        <option value="09">Western Isles</option>
                        <option value="10">Wiltshire</option>
                        <option value="11">Worcestershire</option>
                        <option value="12">Wrexham</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group required">
                    <label class="col-sm-2 control-label" for="input-postcode">Post Code</label>
                    <div class="col-sm-10">
                      <input type="text" name="postcode" value="" placeholder="Post Code" id="input-postcode" class="form-control" />
                    </div>
                  </div>
                  <input type="button" value="Get Quotes" id="button-quote" data-loading-text="Loading..." class="btn btn-primary" />
                </form>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-4 col-sm-offset-8">
              <table class="table table-bordered">
                <tr>
                  <td class="text-right"><strong>Sub-Total:</strong></td>
                  <td class="text-right">$940.00</td>
                </tr>
                <tr>
                  <td class="text-right"><strong>Eco Tax (-2.00):</strong></td>
                  <td class="text-right">$4.00</td>
                </tr>
                <tr>
                  <td class="text-right"><strong>VAT (20%):</strong></td>
                  <td class="text-right">$188.00</td>
                </tr>
                <tr>
                  <td class="text-right"><strong>Total:</strong></td>
                  <td class="text-right">$1,132.00</td>
                </tr>
              </table>
            </div>
          </div>
          <div class="buttons">
            <div class="pull-left"><a href="index.php" class="btn btn-default">Continue Shopping</a></div>
            <div class="pull-right"><a href="checkout.php" class="btn btn-primary">Checkout</a></div>
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