<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="image/favicon.ico" rel="icon" />
<title>Check Out - Filipiniana Furniture Shop</title>
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
        <li><a href="checkout.php">Checkout</a></li>
      </ul>
      <!-- Breadcrumb End-->
      <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-12">
          <h1 class="title">Checkout</h1>
          <div class="row">
            <div class="col-sm-4">
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title"><i class="fa fa-sign-in"></i> Create an Account or Login</h4>
                </div>
                  <div class="panel-body">
                        <div class="radio">
                          <label>
                            <input type="radio" value="register" name="account">
                            Register Account</label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" checked="checked" value="guest" name="account">
                            Guest Checkout</label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" value="returning" name="account">
                            Returning Customer</label>
                        </div>
                  </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title"><i class="fa fa-user"></i> Your Personal Details</h4>
                </div>
                  <div class="panel-body">
                        <fieldset id="account">
                          <div class="form-group required">
                            <label for="input-payment-firstname" class="control-label">First Name</label>
                            <input type="text" class="form-control" id="input-payment-firstname" placeholder="First Name" value="" name="firstname">
                          </div>
                          <div class="form-group required">
                            <label for="input-payment-lastname" class="control-label">Last Name</label>
                            <input type="text" class="form-control" id="input-payment-lastname" placeholder="Last Name" value="" name="lastname">
                          </div>
                          <div class="form-group required">
                            <label for="input-payment-email" class="control-label">E-Mail</label>
                            <input type="text" class="form-control" id="input-payment-email" placeholder="E-Mail" value="" name="email">
                          </div>
                          <div class="form-group required">
                            <label for="input-payment-telephone" class="control-label">Telephone</label>
                            <input type="text" class="form-control" id="input-payment-telephone" placeholder="Telephone" value="" name="telephone">
                          </div>
                          <div class="form-group">
                            <label for="input-payment-fax" class="control-label">Fax</label>
                            <input type="text" class="form-control" id="input-payment-fax" placeholder="Fax" value="" name="fax">
                          </div>
                        </fieldset>
                      </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading">
                  <h4 class="panel-title"><i class="fa fa-book"></i> Your Address</h4>
                </div>
                  <div class="panel-body">
                        <fieldset id="address" class="required">
                          <div class="form-group">
                            <label for="input-payment-company" class="control-label">Company</label>
                            <input type="text" class="form-control" id="input-payment-company" placeholder="Company" value="" name="company">
                          </div>
                          <div class="form-group required">
                            <label for="input-payment-address-1" class="control-label">Address 1</label>
                            <input type="text" class="form-control" id="input-payment-address-1" placeholder="Address 1" value="" name="address_1">
                          </div>
                          <div class="form-group">
                            <label for="input-payment-address-2" class="control-label">Address 2</label>
                            <input type="text" class="form-control" id="input-payment-address-2" placeholder="Address 2" value="" name="address_2">
                          </div>
                          <div class="form-group required">
                            <label for="input-payment-city" class="control-label">City</label>
                            <input type="text" class="form-control" id="input-payment-city" placeholder="City" value="" name="city">
                          </div>
                          <div class="form-group required">
                            <label for="input-payment-postcode" class="control-label">Post Code</label>
                            <input type="text" class="form-control" id="input-payment-postcode" placeholder="Post Code" value="" name="postcode">
                          </div>
                          <div class="form-group required">
                            <label for="input-payment-country" class="control-label">Country</label>
                            <select class="form-control" id="input-payment-country" name="country_id">
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
                              <option selected="selected" value="222">United Kingdom</option>
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
                          <div class="form-group required">
                            <label for="input-payment-zone" class="control-label">Region / State</label>
                            <select class="form-control" id="input-payment-zone" name="zone_id">
                              <option value=""> --- Please Select --- </option>
                              <option value="3513">Aberdeen</option>
                              <option value="3514">Aberdeenshire</option>
                              <option value="3515">Anglesey</option>
                              <option value="3516">Angus</option>
                              <option value="3517">Argyll and Bute</option>
                              <option value="3518">Bedfordshire</option>
                              <option value="3519">Berkshire</option>
                              <option value="3520">Blaenau Gwent</option>
                              <option value="3521">Bridgend</option>
                              <option value="3522">Bristol</option>
                              <option value="3523">Buckinghamshire</option>
                              <option value="3524">Caerphilly</option>
                              <option value="3525">Cambridgeshire</option>
                              <option value="3526">Cardiff</option>
                              <option value="3527">Carmarthenshire</option>
                              <option value="3528">Ceredigion</option>
                              <option value="3529">Cheshire</option>
                              <option value="3530">Clackmannanshire</option>
                              <option value="3531">Conwy</option>
                              <option value="3532">Cornwall</option>
                              <option value="3949">County Antrim</option>
                              <option value="3950">County Armagh</option>
                              <option value="3951">County Down</option>
                              <option value="3952">County Fermanagh</option>
                              <option value="3953">County Londonderry</option>
                              <option value="3954">County Tyrone</option>
                              <option value="3955">Cumbria</option>
                              <option value="3533">Denbighshire</option>
                              <option value="3534">Derbyshire</option>
                              <option value="3535">Devon</option>
                              <option value="3536">Dorset</option>
                              <option value="3537">Dumfries and Galloway</option>
                              <option value="3538">Dundee</option>
                              <option value="3539">Durham</option>
                              <option value="3540">East Ayrshire</option>
                              <option value="3541">East Dunbartonshire</option>
                              <option value="3542">East Lothian</option>
                              <option value="3543">East Renfrewshire</option>
                              <option value="3544">East Riding of Yorkshire</option>
                              <option value="3545">East Sussex</option>
                              <option value="3546">Edinburgh</option>
                              <option value="3547">Essex</option>
                              <option value="3548">Falkirk</option>
                              <option value="3549">Fife</option>
                              <option value="3550">Flintshire</option>
                              <option value="3551">Glasgow</option>
                              <option value="3552">Gloucestershire</option>
                              <option value="3553">Greater London</option>
                              <option value="3554">Greater Manchester</option>
                              <option value="3555">Gwynedd</option>
                              <option value="3556">Hampshire</option>
                              <option value="3557">Herefordshire</option>
                              <option value="3558">Hertfordshire</option>
                              <option value="3559">Highlands</option>
                              <option value="3560">Inverclyde</option>
                              <option value="3561">Isle of Wight</option>
                              <option value="3562">Kent</option>
                              <option value="3563">Lancashire</option>
                              <option value="3564">Leicestershire</option>
                              <option value="3565">Lincolnshire</option>
                              <option value="3566">Merseyside</option>
                              <option value="3567">Merthyr Tydfil</option>
                              <option value="3568">Midlothian</option>
                              <option value="3569">Monmouthshire</option>
                              <option value="3570">Moray</option>
                              <option value="3571">Neath Port Talbot</option>
                              <option value="3572">Newport</option>
                              <option value="3573">Norfolk</option>
                              <option value="3574">North Ayrshire</option>
                              <option value="3575">North Lanarkshire</option>
                              <option value="3576">North Yorkshire</option>
                              <option value="3577">Northamptonshire</option>
                              <option value="3578">Northumberland</option>
                              <option value="3579">Nottinghamshire</option>
                              <option value="3580">Orkney Islands</option>
                              <option value="3581">Oxfordshire</option>
                              <option value="3582">Pembrokeshire</option>
                              <option value="3583">Perth and Kinross</option>
                              <option value="3584">Powys</option>
                              <option value="3585">Renfrewshire</option>
                              <option value="3586">Rhondda Cynon Taff</option>
                              <option value="3587">Rutland</option>
                              <option value="3588">Scottish Borders</option>
                              <option value="3589">Shetland Islands</option>
                              <option value="3590">Shropshire</option>
                              <option value="3591">Somerset</option>
                              <option value="3592">South Ayrshire</option>
                              <option value="3593">South Lanarkshire</option>
                              <option value="3594">South Yorkshire</option>
                              <option value="3595">Staffordshire</option>
                              <option value="3596">Stirling</option>
                              <option value="3597">Suffolk</option>
                              <option value="3598">Surrey</option>
                              <option value="3599">Swansea</option>
                              <option value="3600">Torfaen</option>
                              <option value="3601">Tyne and Wear</option>
                              <option value="3602">Vale of Glamorgan</option>
                              <option value="3603">Warwickshire</option>
                              <option value="3604">West Dunbartonshire</option>
                              <option value="3605">West Lothian</option>
                              <option value="3606">West Midlands</option>
                              <option value="3607">West Sussex</option>
                              <option value="3608">West Yorkshire</option>
                              <option value="3609">Western Isles</option>
                              <option value="3610">Wiltshire</option>
                              <option value="3611">Worcestershire</option>
                              <option value="3612">Wrexham</option>
                            </select>
                          </div>
                          <div class="checkbox">
                            <label>
                              <input type="checkbox" checked="checked" value="1" name="shipping_address">
                              My delivery and billing addresses are the same.</label>
                          </div>
                        </fieldset>
                      </div>
              </div>
            </div>
            <div class="col-sm-8">
              <div class="row">
                <div class="col-sm-6">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title"><i class="fa fa-truck"></i> Delivery Method</h4>
                    </div>
                      <div class="panel-body">
                        <p>Please select the preferred shipping method to use on this order.</p>
                        <div class="radio">
                          <label>
                            <input type="radio" checked="checked" name="Free Shipping">
                            Free Shipping - $0.00</label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="Flat Shipping Rate">
                            Flat Shipping Rate - $8.00</label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="Per Item Shipping Rate">
                            Per Item Shipping Rate - $150.00</label>
                        </div>
                      </div>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title"><i class="fa fa-credit-card"></i> Payment Method</h4>
                    </div>
                      <div class="panel-body">
                        <p>Please select the preferred payment method to use on this order.</p>
                        <div class="radio">
                          <label>
                            <input type="radio" checked="checked" name="Cash On Delivery">
                            Cash On Delivery</label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="Bank Transfer">
                            Bank Transfer</label>
                        </div>
                        <div class="radio">
                          <label>
                            <input type="radio" name="Paypal">
                            Paypal</label>
                        </div>
                      </div>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title"><i class="fa fa-ticket"></i> Use Coupon Code</h4>
                    </div>
                      <div class="panel-body">
                        <label for="input-coupon" class="col-sm-3 control-label">Enter coupon code</label>
                        <div class="input-group">
                          <input type="text" class="form-control" id="input-coupon" placeholder="Enter your coupon here" value="" name="coupon">
                          <span class="input-group-btn">
                          <input type="button" class="btn btn-primary" data-loading-text="Loading..." id="button-coupon" value="Apply Coupon">
                          </span></div>
                      </div>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title"><i class="fa fa-gift"></i> Use Gift Voucher</h4>
                    </div>
                      <div class="panel-body">
                        <label for="input-voucher" class="col-sm-3 control-label">Enter gift voucher code</label>
                        <div class="input-group">
                          <input type="text" class="form-control" id="input-voucher" placeholder="Enter your gift voucher code here" value="" name="voucher">
                          <span class="input-group-btn">
                          <input type="submit" class="btn btn-primary" data-loading-text="Loading..." id="button-voucher" value="Apply Voucher">
                          </span> </div>
                      </div>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title"><i class="fa fa-shopping-cart"></i> Shopping cart</h4>
                    </div>
                      <div class="panel-body">
                        <div class="table-responsive">
                          <table class="table table-bordered">
                            <thead>
                              <tr>
                                <td class="text-center">Image</td>
                                <td class="text-left">Product Name</td>
                                <td class="text-left">Quantity</td>
                                <td class="text-right">Unit Price</td>
                                <td class="text-right">Total</td>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td class="text-center"><a href="product.php"><img src="image/product/sony_vaio_1-50x75.jpg" alt="Xitefun Causal Wear Fancy Shoes" title="Xitefun Causal Wear Fancy Shoes" class="img-thumbnail"></a></td>
                                <td class="text-left"><a href="product.php">Xitefun Causal Wear Fancy Shoes</a></td>
                                <td class="text-left"><div class="input-group btn-block" style="max-width: 200px;">
                                    <input type="text" name="quantity" value="1" size="1" class="form-control">
                                    <span class="input-group-btn">
                                    <button type="submit" data-toggle="tooltip" title="Update" class="btn btn-primary"><i class="fa fa-refresh"></i></button>
                                    <button type="button" data-toggle="tooltip" title="Remove" class="btn btn-danger" onClick=""><i class="fa fa-times-circle"></i></button>
                                    </span></div></td>
                                <td class="text-right">$902.00</td>
                                <td class="text-right">$902.00</td>
                              </tr>
                            </tbody>
                            <tfoot>
                              <tr>
                                <td class="text-right" colspan="4"><strong>Sub-Total:</strong></td>
                                <td class="text-right">$750.00</td>
                              </tr>
                              <tr>
                                <td class="text-right" colspan="4"><strong>Flat Shipping Rate:</strong></td>
                                <td class="text-right">$5.00</td>
                              </tr>
                              <tr>
                                <td class="text-right" colspan="4"><strong>Eco Tax (-2.00):</strong></td>
                                <td class="text-right">$4.00</td>
                              </tr>
                              <tr>
                                <td class="text-right" colspan="4"><strong>VAT (20%):</strong></td>
                                <td class="text-right">$151.00</td>
                              </tr>
                              <tr>
                                <td class="text-right" colspan="4"><strong>Total:</strong></td>
                                <td class="text-right">$910.00</td>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
                      </div>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="panel panel-default">
                    <div class="panel-heading">
                      <h4 class="panel-title"><i class="fa fa-pencil"></i> Add Comments About Your Order</h4>
                    </div>
                      <div class="panel-body">
                        <textarea rows="4" class="form-control" id="confirm_comment" name="comments"></textarea>
                        <br>
                        <label class="control-label" for="confirm_agree">
                          <input type="checkbox" checked="checked" value="1" required="" class="validate required" id="confirm_agree" name="confirm agree">
                          <span>I have read and agree to the <a class="agree" href="#"><b>Terms &amp; Conditions</b></a></span> </label>
                        <div class="buttons">
                          <div class="pull-right">
                            <input type="button" class="btn btn-primary" id="button-confirm" value="Confirm Order">
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
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