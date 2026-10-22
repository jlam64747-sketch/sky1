<?php
session_start();
include_once ('df/session.php');
require_once 'df/controller.php';
if(!isset($_SESSION['uname'])){
header("Location: login.php");
exit(); 
}

$reg_user = new USER();


$stmtr = $reg_user->runQuery("SELECT * FROM account WHERE uname=:uname");
$stmtr->execute(array(":uname" => $_SESSION['uname']));
$row = $stmtr->fetch(PDO::FETCH_ASSOC);



$status = $row['status'];
$bill = $row['billing_code'];


if ($status == 'Transfer Restricted') {
    header('Location: dashboard.php?error=restricted');
    exit();
}

$stmt = $reg_user->runQuery("SELECT * FROM account WHERE acc_no=:acc_no");
$stmt->execute(array(":acc_no"=>$_SESSION['acc_no']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);






if (isset($_POST['rname'])) { 
    $_SESSION['rname'] = $_POST['rname'];
}
if (isset($_POST['rbank'])) { 
    $_SESSION['rbank'] = $_POST['rbank'];
}
if (isset($_POST['racc'])) { 
    $_SESSION['racc'] = $_POST['racc'];
}
if (isset($_POST['remail'])) { 
    $_SESSION['remail'] = $_POST['remail'];
}
if (isset($_POST['rswift'])) { 
    $_SESSION['rswift'] = $_POST['rswift'];
}


if (isset($_POST['badd'])) { 
    $_SESSION['badd'] = $_POST['badd'];
}
if (isset($_POST['iban'])) { 
    $_SESSION['iban'] = $_POST['iban'];
}
 
?> 

 <?php include 'df1.php'; ?>
  <div class="content-w">
        <!--------------------
                  START - Breadcrumbs
                  -------------------->
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="dashboard.php">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="#">Transfer</a>
            </li>
            <li class="breadcrumb-item">
                <span>International</span>
            </li>
        </ul>
        <!--------------------
        END - Breadcrumbs
        -------------------->
  <div class="content-i">
            <div class="content-box">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="element-wrapper">
                            <h6 class="element-header">
                                Transfer
                            </h6>
                            <div class="element-box">
                                <form  action="trf_processing.php" method="post" >
                                    <h5 class="form-header">
                                        International Transfer
                                    </h5>
                                    <div class="form-desc">
                                        Funds will reflect in the Beneficiary Account within 72hours. <a  class="btn btn-danger" href="beneficiary.php">Tranfer to Beneficiary</a>
                                    </div>
                                    <div class="form-group m-t-30">
                                                                            </div>
                           
                                    
                                    
										<?php 
							if(isset($_GET['error']))
								{
									?>
									<div class='alert'>
										<button class='close' data-dismiss='alert'>&times;</button>
										<strong>Unable to Authenticate. Transfer Failed.</strong> 
									</div>
									<?php
								}
						?>
						<?php 
							if(isset($_GET['errorcot']))
								{
									?>
									<div class='alert'>
										<button class='close' data-dismiss='alert'>&times;</button>
										<strong>Invalid COT Code! Transfer Failed.</strong> 
									</div>
									<?php
								}
						?>
						<?php 
							if(isset($_GET['errortax']))
								{
									?>
									<div class='alert'>
										<button class='close' data-dismiss='alert'>&times;</button>
										<strong>Invalid Tax Code! Transfer Failed.</strong> 
									</div>
									<?php
								}
						?>
						<?php 
							if(isset($_GET['errorotp']))
								{
									?>
									<div class='alert'>
										<button class='close' data-dismiss='alert'>&times;</button>
										<strong>Invalid TRANSFER OTP Code! Transfer Failed.</strong> 
									</div>
									<?php
								}
						?>
						<?php 
							if(isset($_GET['insufficient']))
								{
									?>
									<div class='alert'>
										<button class='close' data-dismiss='alert'>&times;</button>
										<strong>Sorry, your balance is insufficient to make the transfer, please transfer a lower amount.</strong> 
									</div>
									<?php
								}
						?>
						<?php 
							if(isset($_GET['amounterror']))
								{
									?>
									<div class='alert'>
										<button class='close' data-dismiss='alert'>&times;</button>
										<strong>Sorry, the amount is too little, please transfer a higher amount.</strong> 
									</div>
									<?php
								}
						?> 
						
						
						<div class="row">
                                        <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for=""> Account Name</label>
											 <span id="sprytf_acc_name">
                                        <input class="form-control" placeholder="Beneficiary Account Name" value="<?php echo $_SESSION['rname']; ?>" type="text" id="acc_name" name="acc_name">
									    <span class="textfieldRequiredMsg">Account Name is required.</span>
										<span class="textfieldMinCharsMsg">min of 8 characters.</span> 
											</span>
						
                                    </div>
                                    </div>
                                    <div class="col-sm-6">
                                    <div class="form-group">
                                                <label for=""> Account Number</label>
												 <span id="sprytf_acc_no">
                                                <input class="form-control" placeholder="Beneficiary Account Number" value="<?php echo $_SESSION['racc']; ?>" type="text" id="racc_no" name="racc_no">
														<span class="textfieldRequiredMsg">Account Number is required.</span>
            			<span class="textfieldMinCharsMsg">min of at least 10 characters.</span>
            			<span class="textfieldMaxCharsMsg">max 15 characters.</span>
            			<span class="textfieldInvalidFormatMsg">Account Number must be Integer.</span>
							</span>
                                            </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Bank Name</label>
												<span id="sprytf_bank_name">
                                                <input class="form-control" placeholder="Beneficiary Bank Name" value="<?php echo $_SESSION['rbank']; ?>" type="text" name="bank_name" id="bank_name">
												 <span class="textfieldRequiredMsg">Bank Name is required.</span>
            			<span class="textfieldMinCharsMsg">min of 6 characters.</span> 
							</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                    <label for="">Bank Address</label>
                                                    <input class="form-control" placeholder="Beneficiary Bank Address" value="<?php echo $_SESSION['badd']; ?>" name="cout" id="cout" type="text">
                                                </div>
                                        </div>
                                    </div>
                                    <fieldset>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="country">Country</label>
                                                    <select class="form-control" id="country" onchange="updateCurrency()">
                                                                                                                   <option value="Afghanistan" data-currency="AFN">Afghanistan</option>
<option value="Albania" data-currency="ALL">Albania</option>
<option value="Algeria" data-currency="DZD">Algeria</option>
<option value="American Samoa" data-currency="USD">American Samoa</option>
<option value="Andorra" data-currency="EUR">Andorra</option>
<option value="Angola" data-currency="AOA">Angola</option>
<option value="Anguilla" data-currency="XCD">Anguilla</option>
<option value="Antarctica" data-currency="USD">Antarctica</option>
<option value="Antigua and Barbuda" data-currency="XCD">Antigua and Barbuda</option>
<option value="Argentina" data-currency="ARS">Argentina</option>
<option value="Armenia" data-currency="AMD">Armenia</option>
<option value="Aruba" data-currency="AWG">Aruba</option>
<option value="Australia" data-currency="AUD">Australia</option>
<option value="Austria" data-currency="EUR">Austria</option>
<option value="Azerbaijan" data-currency="AZN">Azerbaijan</option>
<option value="Bahamas" data-currency="BSD">Bahamas</option>
<option value="Bahrain" data-currency="BHD">Bahrain</option>
<option value="Bangladesh" data-currency="BDT">Bangladesh</option>
<option value="Barbados" data-currency="BBD">Barbados</option>
<option value="Belarus" data-currency="BYN">Belarus</option>
<option value="Belgium" data-currency="EUR">Belgium</option>
<option value="Belize" data-currency="BZD">Belize</option>
<option value="Benin" data-currency="XOF">Benin</option>
<option value="Bermuda" data-currency="BMD">Bermuda</option>
<option value="Bhutan" data-currency="BTN">Bhutan</option>
<option value="Bolivia" data-currency="BOB">Bolivia</option>
<option value="Bosnia and Herzegovina" data-currency="BAM">Bosnia and Herzegovina</option>
<option value="Botswana" data-currency="BWP">Botswana</option>
<option value="Bouvet Island" data-currency="NOK">Bouvet Island</option>
<option value="Brazil" data-currency="BRL">Brazil</option>
<option value="British Indian Ocean Territory" data-currency="USD">British Indian Ocean Territory</option>
<option value="Brunei Darussalam" data-currency="BND">Brunei Darussalam</option>
<option value="Bulgaria" data-currency="BGN">Bulgaria</option>
<option value="Burkina Faso" data-currency="XOF">Burkina Faso</option>
<option value="Burundi" data-currency="BIF">Burundi</option>
<option value="Cambodia" data-currency="KHR">Cambodia</option>
<option value="Cameroon" data-currency="XAF">Cameroon</option>
<option value="Canada" data-currency="CAD">Canada</option>
<option value="Cape Verde" data-currency="CVE">Cape Verde</option>
<option value="Cayman Islands" data-currency="KYD">Cayman Islands</option>
<option value="Central African Republic" data-currency="XAF">Central African Republic</option>
<option value="Chad" data-currency="XAF">Chad</option>
<option value="Chile" data-currency="CLP">Chile</option>
<option value="China" data-currency="CNY">China</option>
<option value="Christmas Island" data-currency="AUD">Christmas Island</option>
<option value="Cocos (Keeling) Islands" data-currency="AUD">Cocos (Keeling) Islands</option>
<option value="Colombia" data-currency="COP">Colombia</option>
<option value="Comoros" data-currency="KMF">Comoros</option>
<option value="Congo" data-currency="CDF">Congo</option>
<option value="Cook Islands" data-currency="NZD">Cook Islands</option>
<option value="Costa Rica" data-currency="CRC">Costa Rica</option>
<option value="Croatia (Hrvatska)" data-currency="HRK">Croatia (Hrvatska)</option>
<option value="Cuba" data-currency="CUP">Cuba</option>
<option value="Cyprus" data-currency="EUR">Cyprus</option>
<option value="Czech Republic" data-currency="CZK">Czech Republic</option>
<option value="Denmark" data-currency="DKK">Denmark</option>
<option value="Djibouti" data-currency="DJF">Djibouti</option>
<option value="Dominica" data-currency="XCD">Dominica</option>
<option value="Dominican Republic" data-currency="DOP">Dominican Republic</option>
<option value="East Timor" data-currency="USD">East Timor</option>
<option value="Ecuador" data-currency="USD">Ecuador</option>
<option value="Egypt" data-currency="EGP">Egypt</option>
<option value="El Salvador" data-currency="USD">El Salvador</option>
<option value="Equatorial Guinea" data-currency="XAF">Equatorial Guinea</option>
<option value="Eritrea" data-currency="ERN">Eritrea</option>
<option value="Estonia" data-currency="EUR">Estonia</option>
<option value="Ethiopia" data-currency="ETB">Ethiopia</option>
<option value="Falkland Islands (Malvinas)" data-currency="FKP">Falkland Islands (Malvinas)</option>
<option value="Faroe Islands" data-currency="DKK">Faroe Islands</option>
<option value="Fiji" data-currency="FJD">Fiji</option>
<option value="Finland" data-currency="EUR">Finland</option>
<option value="France" data-currency="EUR">France</option>
<option value="France, Metropolitan" data-currency="EUR">France, Metropolitan</option>
<option value="French Guiana" data-currency="EUR">French Guiana</option>
<option value="French Polynesia" data-currency="XPF">French Polynesia</option>
<option value="French Southern Territories" data-currency="EUR">French Southern Territories</option>
<option value="Gabon" data-currency="XAF">Gabon</option>
<option value="Gambia" data-currency="GMD">Gambia</option>
<option value="Georgia" data-currency="GEL">Georgia</option>
<option value="Germany" data-currency="EUR">Germany</option>
<option value="Ghana" data-currency="GHS">Ghana</option>
<option value="Gibraltar" data-currency="GIP">Gibraltar</option>
<option value="Guernsey" data-currency="GBP">Guernsey</option>
<option value="Greece" data-currency="EUR">Greece</option>
<option value="Greenland" data-currency="DKK">Greenland</option>
<option value="Grenada" data-currency="XCD">Grenada</option>
<option value="Guadeloupe" data-currency="EUR">Guadeloupe</option>
<option value="Guam" data-currency="USD">Guam</option>
<option value="Guatemala" data-currency="GTQ">Guatemala</option>
<option value="Guinea" data-currency="GNF">Guinea</option>
<option value="Guinea-Bissau" data-currency="XOF">Guinea-Bissau</option>
<option value="Guyana" data-currency="GYD">Guyana</option>
<option value="Haiti" data-currency="HTG">Haiti</option>
<option value="Heard and Mc Donald Islands" data-currency="AUD">Heard and Mc Donald Islands</option>
<option value="Honduras" data-currency="HNL">Honduras</option>
<option value="Hong Kong" data-currency="HKD">Hong Kong</option>
<option value="Hungary" data-currency="HUF">Hungary</option>
<option value="Iceland" data-currency="ISK">Iceland</option>
<option value="India" data-currency="INR">India</option>
<option value="Isle of Man" data-currency="GBP">Isle of Man</option>
<option value="Indonesia" data-currency="IDR">Indonesia</option>
<option value="Iran (Islamic Republic of)" data-currency="IRR">Iran (Islamic Republic of)</option>
<option value="Iraq" data-currency="IQD">Iraq</option>
<option value="Ireland" data-currency="EUR">Ireland</option>
<option value="Israel" data-currency="ILS">Israel</option>
<option value="Italy" data-currency="EUR">Italy</option>
<option value="Ivory Coast" data-currency="XOF">Ivory Coast</option>
<option value="Jersey" data-currency="GBP">Jersey</option>
<option value="Jamaica" data-currency="JMD">Jamaica</option>
<option value="Japan" data-currency="JPY">Japan</option>
<option value="Jordan" data-currency="JOD">Jordan</option>
<option value="Kazakhstan" data-currency="KZT">Kazakhstan</option>
<option value="Kenya" data-currency="KES">Kenya</option>
<option value="Kiribati" data-currency="AUD">Kiribati</option>
<option value="Korea, Democratic People's Republic of" data-currency="KPW">Korea, Democratic People's Republic of</option>
<option value="Korea, Republic of" data-currency="KRW">Korea, Republic of</option>
<option value="Kosovo" data-currency="EUR">Kosovo</option>
<option value="Kuwait" data-currency="KWD">Kuwait</option>
<option value="Kyrgyzstan" data-currency="KGS">Kyrgyzstan</option>
<option value="Lao People's Democratic Republic" data-currency="LAK">Lao People's Democratic Republic</option>
<option value="Latvia" data-currency="EUR">Latvia</option>
<option value="Lebanon" data-currency="LBP">Lebanon</option>
<option value="Lesotho" data-currency="LSL">Lesotho</option>
<option value="Liberia" data-currency="LRD">Liberia</option>
<option value="Libyan Arab Jamahiriya" data-currency="LYD">Libyan Arab Jamahiriya</option>
<option value="Liechtenstein" data-currency="CHF">Liechtenstein</option>
<option value="Lithuania" data-currency="EUR">Lithuania</option>
<option value="Luxembourg" data-currency="EUR">Luxembourg</option>
<option value="Macau" data-currency="MOP">Macau</option>
<option value="Macedonia" data-currency="MKD">Macedonia</option>
<option value="Madagascar" data-currency="MGA">Madagascar</option>
<option value="Malawi" data-currency="MWK">Malawi</option>
<option value="Malaysia" data-currency="MYR">Malaysia</option>
<option value="Maldives" data-currency="MVR">Maldives</option>
<option value="Mali" data-currency="XOF">Mali</option>
<option value="Malta" data-currency="EUR">Malta</option>
<option value="Marshall Islands" data-currency="USD">Marshall Islands</option>
<option value="Martinique" data-currency="EUR">Martinique</option>
<option value="Mauritania" data-currency="MRU">Mauritania</option>
<option value="Mauritius" data-currency="MUR">Mauritius</option>
<option value="Mayotte" data-currency="EUR">Mayotte</option>
<option value="Mexico" data-currency="MXN">Mexico</option>
<option value="Micronesia, Federated States of" data-currency="USD">Micronesia, Federated States of</option>
<option value="Moldova, Republic of" data-currency="MDL">Moldova, Republic of</option>
<option value="Monaco" data-currency="EUR">Monaco</option>
<option value="Mongolia" data-currency="MNT">Mongolia</option>
<option value="Montenegro" data-currency="EUR">Montenegro</option>
<option value="Montserrat" data-currency="XCD">Montserrat</option>
<option value="Morocco" data-currency="MAD">Morocco</option>
<option value="Mozambique" data-currency="MZN">Mozambique</option>
<option value="Myanmar" data-currency="MMK">Myanmar</option>
<option value="Namibia" data-currency="NAD">Namibia</option>
<option value="Nauru" data-currency="AUD">Nauru</option>
<option value="Nepal" data-currency="NPR">Nepal</option>
<option value="Netherlands" data-currency="EUR">Netherlands</option>
<option value="Netherlands Antilles" data-currency="ANG">Netherlands Antilles</option>
<option value="New Caledonia" data-currency="XPF">New Caledonia</option>
<option value="New Zealand" data-currency="NZD">New Zealand</option>
<option value="Nicaragua" data-currency="NIO">Nicaragua</option>
<option value="Niger" data-currency="XOF">Niger</option>
<option value="Nigeria" data-currency="NGN">Nigeria</option>
<option value="Niue" data-currency="NZD">Niue</option>
<option value="Norfolk Island" data-currency="AUD">Norfolk Island</option>
<option value="Northern Mariana Islands" data-currency="USD">Northern Mariana Islands</option>
<option value="Norway" data-currency="NOK">Norway</option>
<option value="Oman" data-currency="OMR">Oman</option>
<option value="Pakistan" data-currency="PKR">Pakistan</option>
<option value="Palau" data-currency="USD">Palau</option>
<option value="Palestine" data-currency="ILS">Palestine</option>
<option value="Panama" data-currency="PAB">Panama</option>
<option value="Papua New Guinea" data-currency="PGK">Papua New Guinea</option>
<option value="Paraguay" data-currency="PYG">Paraguay</option>
<option value="Peru" data-currency="PEN">Peru</option>
<option value="Philippines" data-currency="PHP">Philippines</option>
<option value="Pitcairn" data-currency="NZD">Pitcairn</option>
<option value="Poland" data-currency="PLN">Poland</option>
<option value="Portugal" data-currency="EUR">Portugal</option>
<option value="Puerto Rico" data-currency="USD">Puerto Rico</option>
<option value="Qatar" data-currency="QAR">Qatar</option>
<option value="Reunion" data-currency="EUR">Reunion</option>
<option value="Romania" data-currency="RON">Romania</option>
<option value="Russian Federation" data-currency="RUB">Russian Federation</option>
<option value="Rwanda" data-currency="RWF">Rwanda</option>
<option value="Saint Kitts and Nevis" data-currency="XCD">Saint Kitts and Nevis</option>
<option value="Saint Lucia" data-currency="XCD">Saint Lucia</option>
<option value="Saint Vincent and the Grenadines" data-currency="XCD">Saint Vincent and the Grenadines</option>
<option value="Samoa" data-currency="WST">Samoa</option>
<option value="San Marino" data-currency="EUR">San Marino</option>
<option value="Sao Tome and Principe" data-currency="STN">Sao Tome and Principe</option>
<option value="Saudi Arabia" data-currency="SAR">Saudi Arabia</option>
<option value="Senegal" data-currency="XOF">Senegal</option>
<option value="Serbia" data-currency="RSD">Serbia</option>
<option value="Seychelles" data-currency="SCR">Seychelles</option>
<option value="Sierra Leone" data-currency="SLL">Sierra Leone</option>
<option value="Singapore" data-currency="SGD">Singapore</option>
<option value="Slovakia" data-currency="EUR">Slovakia</option>
<option value="Slovenia" data-currency="EUR">Slovenia</option>
<option value="Solomon Islands" data-currency="SBD">Solomon Islands</option>
<option value="Somalia" data-currency="SOS">Somalia</option>
<option value="South Africa" data-currency="ZAR">South Africa</option>
<option value="South Georgia South Sandwich Islands" data-currency="GBP">South Georgia South Sandwich Islands</option>
<option value="South Sudan" data-currency="SSP">South Sudan</option>
<option value="Spain" data-currency="EUR">Spain</option>
<option value="Sri Lanka" data-currency="LKR">Sri Lanka</option>
<option value="St. Helena" data-currency="SHP">St. Helena</option>
<option value="St. Pierre and Miquelon" data-currency="EUR">St. Pierre and Miquelon</option>
<option value="Sudan" data-currency="SDG">Sudan</option>
<option value="Suriname" data-currency="SRD">Suriname</option>
<option value="Svalbard and Jan Mayen Islands" data-currency="NOK">Svalbard and Jan Mayen Islands</option>
<option value="Swaziland" data-currency="SZL">Swaziland</option>
<option value="Sweden" data-currency="SEK">Sweden</option>
<option value="Switzerland" data-currency="CHF">Switzerland</option>
<option value="Syrian Arab Republic" data-currency="SYP">Syrian Arab Republic</option>
<option value="Taiwan" data-currency="TWD">Taiwan</option>
<option value="Tajikistan" data-currency="TJS">Tajikistan</option>
<option value="Tanzania, United Republic of" data-currency="TZS">Tanzania, United Republic of</option>
<option value="Thailand" data-currency="THB">Thailand</option>
<option value="Togo" data-currency="XOF">Togo</option>
<option value="Tokelau" data-currency="NZD">Tokelau</option>
<option value="Tonga" data-currency="TOP">Tonga</option>
<option value="Trinidad and Tobago" data-currency="TTD">Trinidad and Tobago</option>
<option value="Tunisia" data-currency="TND">Tunisia</option>
<option value="Turkey" data-currency="TRY">Turkey</option>
<option value="Turkmenistan" data-currency="TMT">Turkmenistan</option>
<option value="Turks and Caicos Islands" data-currency="USD">Turks and Caicos Islands</option>
<option value="Tuvalu" data-currency="AUD">Tuvalu</option>
<option value="Uganda" data-currency="UGX">Uganda</option>
<option value="Ukraine" data-currency="UAH">Ukraine</option>
<option value="United Arab Emirates" data-currency="AED">United Arab Emirates</option>
<option value="United Kingdom" data-currency="GBP">United Kingdom</option>
<option value="United States" data-currency="USD">United States</option>
<option value="United States minor outlying islands" data-currency="USD">United States minor outlying islands</option>
<option value="Uruguay" data-currency="UYU">Uruguay</option>
<option value="Uzbekistan" data-currency="UZS">Uzbekistan</option>
<option value="Vanuatu" data-currency="VUV">Vanuatu</option>
<option value="Vatican City State" data-currency="EUR">Vatican City State</option>
<option value="Venezuela" data-currency="VES">Venezuela</option>
<option value="Vietnam" data-currency="VND">Vietnam</option>
<option value="Virgin Islands (British)" data-currency="USD">Virgin Islands (British)</option>
<option value="Virgin Islands (U.S.)" data-currency="USD">Virgin Islands (U.S.)</option>
<option value="Wallis and Futuna Islands" data-currency="XPF">Wallis and Futuna Islands</option>
<option value="Western Sahara" data-currency="MAD">Western Sahara</option>
<option value="Yemen" data-currency="YER">Yemen</option>
<option value="Zaire" data-currency="CDF">Zaire</option>
<option value="Zambia" data-currency="ZMW">Zambia</option>
<option value="Zimbabwe" data-currency="ZWL">Zimbabwe</option>

                                                                                                            </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="currency">Currency</label>
                                                <select class="form-control" id="currency">
                                                     </select>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset class="form-group">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for=""> Swift Code</label>
														<span id="sprytf_swift">
                                                    <input class="form-control" placeholder="Swift Code" value="<?php echo $_SESSION['rswift']; ?>" name="swift" id="swift" type="text">
															    <span class="textfieldRequiredMsg">Swift Code is required.</span>
										<span class="textfieldMinCharsMsg">min of 8 characters.</span> 
											</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="">IBAN Number</label>
														<span id="sprytf_swift">
                                                    <input class="form-control" placeholder="IBAN Number"  value="<?php echo $_SESSION['iban']; ?>" name="" id="swift" type="text">
															    <span class="textfieldRequiredMsg">IBAN Number is required.</span>
										<span class="textfieldMinCharsMsg">min of 10 characters.</span> 
											</span>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                              <div class="form-group">
                                                    <label for="">Amount</label>
													 <span id="sprytf_amount">
                                                    <input class="form-control" placeholder="Amount" name="amount" id="amount" type="number">
															 <span class="textfieldRequiredMsg">Sending Amount is required.</span>
                    			<span class="textfieldMinCharsMsg">minimum of $10.</span> 
                    		</span>
                                                    
                                                </div>
                                            </div>
                                          
                                           <div class="col-sm-6">
                                              <div class="form-group">
                                                    <label for="">Transfer Type</label>
													         <select class="form-control" id="country">
                                                               <option value="Online Banking">Online Banking</option>
                                                                 <option value="Joint Account">Joint Account</option>
                                                                 <option value="Checking">Checking</option>
                                                                 <option value="Savings Account">Savings Account</option>
                                                </select>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="">Description</label>
                                                <textarea class="form-control" rows="5" id="remarks" name="remarks"></textarea>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="form-buttons-w">
                                        <button class="btn btn-primary" type="submit"> Transfer </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <script>
    const currencyMap = {
    "Afghanistan": { code: "AFN", symbol: "؋" },
    "Albania": { code: "ALL", symbol: "L" },
    "Algeria": { code: "DZD", symbol: "دج" },
    "American Samoa": { code: "USD", symbol: "$" },
    "Andorra": { code: "EUR", symbol: "€" },
    "Angola": { code: "AOA", symbol: "Kz" },
    "Anguilla": { code: "XCD", symbol: "$" },
    "Antarctica": { code: "USD", symbol: "$" },
    "Antigua and Barbuda": { code: "XCD", symbol: "$" },
    "Argentina": { code: "ARS", symbol: "$" },
    "Armenia": { code: "AMD", symbol: "֏" },
    "Aruba": { code: "AWG", symbol: "ƒ" },
    "Australia": { code: "AUD", symbol: "$" },
    "Austria": { code: "EUR", symbol: "€" },
    "Azerbaijan": { code: "AZN", symbol: "₼" },
    "Bahamas": { code: "BSD", symbol: "$" },
    "Bahrain": { code: "BHD", symbol: ".د.ب" },
    "Bangladesh": { code: "BDT", symbol: "৳" },
    "Barbados": { code: "BBD", symbol: "$" },
    "Belarus": { code: "BYN", symbol: "Br" },
    "Belgium": { code: "EUR", symbol: "€" },
    "Belize": { code: "BZD", symbol: "$" },
    "Benin": { code: "XOF", symbol: "CFA" },
    "Bermuda": { code: "BMD", symbol: "$" },
    "Bhutan": { code: "BTN", symbol: "Nu." },
    "Bolivia": { code: "BOB", symbol: "Bs." },
    "Bosnia and Herzegovina": { code: "BAM", symbol: "KM" },
    "Botswana": { code: "BWP", symbol: "P" },
    "Bouvet Island": { code: "NOK", symbol: "kr" },
    "Brazil": { code: "BRL", symbol: "R$" },
    "British Indian Ocean Territory": { code: "USD", symbol: "$" },
    "Brunei Darussalam": { code: "BND", symbol: "$" },
    "Bulgaria": { code: "BGN", symbol: "лв" },
    "Burkina Faso": { code: "XOF", symbol: "CFA" },
    "Burundi": { code: "BIF", symbol: "FBu" },
    "Cambodia": { code: "KHR", symbol: "៛" },
    "Cameroon": { code: "XAF", symbol: "FCFA" },
    "Canada": { code: "CAD", symbol: "$" },
    "Cape Verde": { code: "CVE", symbol: "$" },
    "Cayman Islands": { code: "KYD", symbol: "$" },
    "Central African Republic": { code: "XAF", symbol: "FCFA" },
    "Chad": { code: "XAF", symbol: "FCFA" },
    "Chile": { code: "CLP", symbol: "$" },
    "China": { code: "CNY", symbol: "¥" },
    "Christmas Island": { code: "AUD", symbol: "$" },
    "Cocos (Keeling) Islands": { code: "AUD", symbol: "$" },
    "Colombia": { code: "COP", symbol: "$" },
    "Comoros": { code: "KMF", symbol: "CF" },
    "Congo": { code: "CDF", symbol: "FC" },
    "Cook Islands": { code: "NZD", symbol: "$" },
    "Costa Rica": { code: "CRC", symbol: "₡" },
    "Croatia (Hrvatska)": { code: "HRK", symbol: "kn" },
    "Cuba": { code: "CUP", symbol: "₱" },
    "Cyprus": { code: "EUR", symbol: "€" },
    "Czech Republic": { code: "CZK", symbol: "Kč" },
    "Denmark": { code: "DKK", symbol: "kr" },
    "Djibouti": { code: "DJF", symbol: "Fdj" },
    "Dominica": { code: "XCD", symbol: "$" },
    "Dominican Republic": { code: "DOP", symbol: "RD$" },
    "East Timor": { code: "USD", symbol: "$" },
    "Ecuador": { code: "USD", symbol: "$" },
    "Egypt": { code: "EGP", symbol: "£" },
    "El Salvador": { code: "USD", symbol: "$" },
    "Equatorial Guinea": { code: "XAF", symbol: "FCFA" },
    "Eritrea": { code: "ERN", symbol: "Nkf" },
    "Estonia": { code: "EUR", symbol: "€" },
    "Ethiopia": { code: "ETB", symbol: "Br" },
    "Falkland Islands (Malvinas)": { code: "FKP", symbol: "£" },
    "Faroe Islands": { code: "DKK", symbol: "kr" },
    "Fiji": { code: "FJD", symbol: "$" },
    "Finland": { code: "EUR", symbol: "€" },
    "France": { code: "EUR", symbol: "€" },
    "France, Metropolitan": { code: "EUR", symbol: "€" },
    "French Guiana": { code: "EUR", symbol: "€" },
    "French Polynesia": { code: "XPF", symbol: "₣" },
    "French Southern Territories": { code: "EUR", symbol: "€" },
    "Gabon": { code: "XAF", symbol: "FCFA" },
    "Gambia": { code: "GMD", symbol: "D" },
    "Georgia": { code: "GEL", symbol: "ლ" },
    "Germany": { code: "EUR", symbol: "€" },
    "Ghana": { code: "GHS", symbol: "GH₵" },
    "Gibraltar": { code: "GIP", symbol: "£" },
    "Guernsey": { code: "GBP", symbol: "£" },
    "Greece": { code: "EUR", symbol: "€" },
    "Greenland": { code: "DKK", symbol: "kr" },
    "Grenada": { code: "XCD", symbol: "$" },
    "Guadeloupe": { code: "EUR", symbol: "€" },
    "Guam": { code: "USD", symbol: "$" },
    "Guatemala": { code: "GTQ", symbol: "Q" },
    "Guinea": { code: "GNF", symbol: "FG" },
    "Guinea-Bissau": { code: "XOF", symbol: "CFA" },
    "Guyana": { code: "GYD", symbol: "$" },
    "Haiti": { code: "HTG", symbol: "G" },
    "Heard and Mc Donald Islands": { code: "AUD", symbol: "$" },
    "Honduras": { code: "HNL", symbol: "L" },
    "Hong Kong": { code: "HKD", symbol: "$" },
    "Hungary": { code: "HUF", symbol: "Ft" },
    "Iceland": { code: "ISK", symbol: "kr" },
    "India": { code: "INR", symbol: "₹" },
    "Isle of Man": { code: "GBP", symbol: "£" },
    "Indonesia": { code: "IDR", symbol: "Rp" },
    "Iran (Islamic Republic of)": { code: "IRR", symbol: "﷼" },
    "Iraq": { code: "IQD", symbol: "ع.د" },
    "Ireland": { code: "EUR", symbol: "€" },
    "Israel": { code: "ILS", symbol: "₪" },
    "Italy": { code: "EUR", symbol: "€" },
    "Ivory Coast": { code: "XOF", symbol: "CFA" },
    "Jersey": { code: "GBP", symbol: "£" },
    "Jamaica": { code: "JMD", symbol: "J$" },
    "Japan": { code: "JPY", symbol: "¥" },
    "Jordan": { code: "JOD", symbol: "د.ا" },
    "Kazakhstan": { code: "KZT", symbol: "₸" },
    "Kenya": { code: "KES", symbol: "KSh" },
    "Kiribati": { code: "AUD", symbol: "$" },
    "Korea, Democratic People's Republic of": { code: "KPW", symbol: "₩" },
    "Korea, Republic of": { code: "KRW", symbol: "₩" },
    "Kosovo": { code: "EUR", symbol: "€" },
    "Kuwait": { code: "KWD", symbol: "د.ك" },
    "Kyrgyzstan": { code: "KGS", symbol: "лв" },
    "Lao People's Democratic Republic": { code: "LAK", symbol: "₭" },
    "Latvia": { code: "EUR", symbol: "€" },
    "Lebanon": { code: "LBP", symbol: "ل.ل" },
    "Lesotho": { code: "LSL", symbol: "L" },
    "Liberia": { code: "LRD", symbol: "$" },
    "Libyan Arab Jamahiriya": { code: "LYD", symbol: "ل.د" },
    "Liechtenstein": { code: "CHF", symbol: "CHF" },
    "Lithuania": { code: "EUR", symbol: "€" },
    "Luxembourg": { code: "EUR", symbol: "€" },
    "Macau": { code: "MOP", symbol: "P" },
    "Macedonia": { code: "MKD", symbol: "ден" },
    "Madagascar": { code: "MGA", symbol: "Ar" },
    "Malawi": { code: "MWK", symbol: "MK" },
    "Malaysia": { code: "MYR", symbol: "RM" },
    "Maldives": { code: "MVR", symbol: "Rf" },
    "Mali": { code: "XOF", symbol: "CFA" },
    "Malta": { code: "EUR", symbol: "€" },
    "Marshall Islands": { code: "USD", symbol: "$" },
    "Martinique": { code: "EUR", symbol: "€" },
    "Mauritania": { code: "MRU", symbol: "UM" },
    "Mauritius": { code: "MUR", symbol: "₨" },
    "Mayotte": { code: "EUR", symbol: "€" },
    "Mexico": { code: "MXN", symbol: "$" },
    "Micronesia, Federated States of": { code: "USD", symbol: "$" },
    "Moldova, Republic of": { code: "MDL", symbol: "L" },
    "Monaco": { code: "EUR", symbol: "€" },
    "Mongolia": { code: "MNT", symbol: "₮" },
    "Montenegro": { code: "EUR", symbol: "€" },
    "Montserrat": { code: "XCD", symbol: "$" },
    "Morocco": { code: "MAD", symbol: "د.م." },
    "Mozambique": { code: "MZN", symbol: "MT" },
    "Myanmar": { code: "MMK", symbol: "K" },
    "Namibia": { code: "NAD", symbol: "$" },
    "Nauru": { code: "AUD", symbol: "$" },
    "Nepal": { code: "NPR", symbol: "₨" },
    "Netherlands": { code: "EUR", symbol: "€" },
    "Netherlands Antilles": { code: "ANG", symbol: "ƒ" },
    "New Caledonia": { code: "XPF", symbol: "₣" },
    "New Zealand": { code: "NZD", symbol: "$" },
    "Nicaragua": { code: "NIO", symbol: "C$" },
    "Niger": { code: "XOF", symbol: "CFA" },
    "Nigeria": { code: "NGN", symbol: "₦" },
    "Niue": { code: "NZD", symbol: "$" },
    "Norfolk Island": { code: "AUD", symbol: "$" },
    "Northern Mariana Islands": { code: "USD", symbol: "$" },
    "Norway": { code: "NOK", symbol: "kr" },
    "Oman": { code: "OMR", symbol: "ر.ع." },
    "Pakistan": { code: "PKR", symbol: "₨" },
    "Palau": { code: "USD", symbol: "$" },
    "Palestine": { code: "ILS", symbol: "₪" },
    "Panama": { code: "PAB", symbol: "B/." },
    "Papua New Guinea": { code: "PGK", symbol: "K" },
    "Paraguay": { code: "PYG", symbol: "₲" },
    "Peru": { code: "PEN", symbol: "S/." },
    "Philippines": { code: "PHP", symbol: "₱" },
    "Pitcairn": { code: "NZD", symbol: "$" },
    "Poland": { code: "PLN", symbol: "zł" },
    "Portugal": { code: "EUR", symbol: "€" },
    "Puerto Rico": { code: "USD", symbol: "$" },
    "Qatar": { code: "QAR", symbol: "ر.ق" },
    "Reunion": { code: "EUR", symbol: "€" },
    "Romania": { code: "RON", symbol: "lei" },
    "Russian Federation": { code: "RUB", symbol: "₽" },
    "Rwanda": { code: "RWF", symbol: "FRw" },
    "Saint Kitts and Nevis": { code: "XCD", symbol: "$" },
    "Saint Lucia": { code: "XCD", symbol: "$" },
    "Saint Vincent and the Grenadines": { code: "XCD", symbol: "$" },
    "Samoa": { code: "WST", symbol: "T" },
    "San Marino": { code: "EUR", symbol: "€" },
    "Sao Tome and Principe": { code: "STN", symbol: "Db" },
    "Saudi Arabia": { code: "SAR", symbol: "ر.س" },
    "Senegal": { code: "XOF", symbol: "CFA" },
    "Serbia": { code: "RSD", symbol: "din" },
    "Seychelles": { code: "SCR", symbol: "₨" },
    "Sierra Leone": { code: "SLL", symbol: "Le" },
    "Singapore": { code: "SGD", symbol: "$" },
    "Slovakia": { code: "EUR", symbol: "€" },
    "Slovenia": { code: "EUR", symbol: "€" },
    "Solomon Islands": { code: "SBD", symbol: "$" },
    "Somalia": { code: "SOS", symbol: "Sh.So." },
    "South Africa": { code: "ZAR", symbol: "R" },
    "South Georgia South Sandwich Islands": { code: "GBP", symbol: "£" },
    "South Sudan": { code: "SSP", symbol: "£" },
    "Spain": { code: "EUR", symbol: "€" },
    "Sri Lanka": { code: "LKR", symbol: "Rs" },
    "St. Helena": { code: "SHP", symbol: "£" },
    "St. Pierre and Miquelon": { code: "EUR", symbol: "€" },
    "Sudan": { code: "SDG", symbol: "£" },
    "Suriname": { code: "SRD", symbol: "$" },
    "Svalbard and Jan Mayen Islands": { code: "NOK", symbol: "kr" },
    "Swaziland": { code: "SZL", symbol: "E" },
    "Sweden": { code: "SEK", symbol: "kr" },
    "Switzerland": { code: "CHF", symbol: "CHF" },
    "Syrian Arab Republic": { code: "SYP", symbol: "£" },
    "Taiwan": { code: "TWD", symbol: "NT$" },
    "Tajikistan": { code: "TJS", symbol: "SM" },
    "Tanzania, United Republic of": { code: "TZS", symbol: "TSh" },
    "Thailand": { code: "THB", symbol: "฿" },
    "Togo": { code: "XOF", symbol: "CFA" },
    "Tokelau": { code: "NZD", symbol: "$" },
    "Tonga": { code: "TOP", symbol: "T$" },
    "Trinidad and Tobago": { code: "TTD", symbol: "$" },
    "Tunisia": { code: "TND", symbol: "د.ت" },
    "Turkey": { code: "TRY", symbol: "₺" },
    "Turkmenistan": { code: "TMT", symbol: "m" },
    "Turks and Caicos Islands": { code: "USD", symbol: "$" },
    "Tuvalu": { code: "AUD", symbol: "$" },
    "Uganda": { code: "UGX", symbol: "USh" },
    "Ukraine": { code: "UAH", symbol: "₴" },
    "United Arab Emirates": { code: "AED", symbol: "د.إ" },
    "United Kingdom": { code: "GBP", symbol: "£" },
    "United States": { code: "USD", symbol: "$" },
    "United States minor outlying islands": { code: "USD", symbol: "$" },
    "Uruguay": { code: "UYU", symbol: "$" },
    "Uzbekistan": { code: "UZS", symbol: "лв" },
    "Vanuatu": { code: "VUV", symbol: "VT" },
    "Vatican City State": { code: "EUR", symbol: "€" },
    "Venezuela": { code: "VES", symbol: "Bs.S" },
    "Vietnam": { code: "VND", symbol: "₫" },
    "Virgin Islands (British)": { code: "USD", symbol: "$" },
    "Virgin Islands (U.S.)": { code: "USD", symbol: "$" },
    "Wallis and Futuna Islands": { code: "XPF", symbol: "₣" },
    "Western Sahara": { code: "MAD", symbol: "د.م." },
    "Yemen": { code: "YER", symbol: "﷼" },
    "Zaire": { code: "CDF", symbol: "FC" },
    "Zambia": { code: "ZMW", symbol: "ZK" },
    "Zimbabwe": { code: "ZWL", symbol: "$" }
};


    function updateCurrency() {
        const selectedCountry = $('#country option:selected').text();
        const currency = currencyMap[selectedCountry];
        $('#currency').empty().append(new Option(`${currency.symbol} - ${currency.code}`, currency.symbol));
    }

    // Initialize currency based on the default selected country
    $(document).ready(function() {
        updateCurrency();
    });
</script>
 
 
 
 
  <?php include 'df2.php'; ?>