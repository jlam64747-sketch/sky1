<?php
session_start();
require_once 'class.admin.php';
include_once ('session.php');
if (!isset($_SESSION['email'])) {

    header("Location: login.php");

    exit();
}
$reg_user = new USER();

if (isset($_POST['create'])) {


    $fname = trim($_POST['fname']);
    $fname = strip_tags($fname);
    $fname = htmlspecialchars($fname);

    $mname = trim($_POST['mname']);
    $mname = strip_tags($mname);
    $mname = htmlspecialchars($mname);

    $lname = trim($_POST['lname']);
    $lname = strip_tags($lname);
    $lname = htmlspecialchars($lname);

    $uname = trim($_POST['uname']);
    $uname = strip_tags($uname);
    $uname = htmlspecialchars($uname);

    $upas = $_POST['upas'];
	$upas = md5($upas);
	
    $phone = trim($_POST['phone']);
    $phone = strip_tags($phone);
    $phone = htmlspecialchars($phone);

    $email = trim($_POST['email']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $type = trim($_POST['type']);
    $type = strip_tags($type);
    $type = htmlspecialchars($type);

    $reg_date = trim($_POST['reg_date']);

    $work = trim($_POST['work']);
    $work = strip_tags($work);
    $work = htmlspecialchars($work);

    $acc_no = trim($_POST['acc_no']);
    $acc_no = strip_tags($acc_no);
    $acc_no = htmlspecialchars($acc_no);

    $addr = trim($_POST['addr']);
    $addr = strip_tags($addr);
    $addr = htmlspecialchars($addr);

    $sex = trim($_POST['sex']);
    $sex = strip_tags($sex);
    $sex = htmlspecialchars($sex);

    $dob = trim($_POST['dob']);
    $dob = strip_tags($dob);
    $dob = htmlspecialchars($dob);

    $marry = trim($_POST['marry']);
    $marry = strip_tags($marry);
    $marry = htmlspecialchars($marry);

    $t_bal = trim($_POST['t_bal']);
    $t_bal = strip_tags($t_bal);
    $t_bal = htmlspecialchars($t_bal);

    $a_bal = trim($_POST['a_bal']);
    $a_bal = strip_tags($a_bal);
    $a_bal = htmlspecialchars($a_bal);

    $currency = trim($_POST['currency']);
    $currency = strip_tags($currency);
    $currency = htmlspecialchars($currency);

    $cot = trim($_POST['cot']);
    $cot = strip_tags($cot);
    $cot = htmlspecialchars($cot);

    $tax = trim($_POST['tax']);
    $tax = strip_tags($tax);
    $tax = htmlspecialchars($tax);

    $imf = trim($_POST['imf']);
    $imf = strip_tags($imf);
    $imf = htmlspecialchars($imf);
    
    $pin_auth = trim($_POST['pin_auth']);
    $pin_auth = strip_tags($pin_auth);
    $pin_auth = htmlspecialchars($pin_auth);

    $pin = trim($_POST['pin']);
    $pin = strip_tags($pin);
    $pin = htmlspecialchars($pin);
    
    $verify = trim($_POST['verify']);
    $verify = strip_tags($verify);
    $verify = htmlspecialchars($verify);



    $stmt = $reg_user->runQuery("SELECT * FROM account WHERE email=:email");
    $stmt1 = $reg_user->runQuery("SELECT * FROM account WHERE uname=:uname");
    $stmt2 = $reg_user->runQuery("SELECT * FROM account WHERE acc_no=:acc_no");
    $stmt->execute(array(":email" => $email));
    $stmt1->execute(array(":uname" => $uname));
     $stmt2->execute(array(":acc_no" => $acc_no));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
     $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0 || $stmt1->rowCount() > 0 || $stmt2->rowCount() > 0) {
        $msg = "
		       <div class='popup' > <div class='modal-dialog modal-sm' >
							<div style='background-color:green; border:solid; border-color:brown; border-radius:10px;' ><div class='modal-content'  >
								<div class='modal-header' style='background-color:white;'>
									<h5 class='modal-title'></h5>
									<button type='button' class='btn-close' data-bs-dismiss='modal'>
									</button>
								</div>
								<div class='modal-body' style='background-color:white; '>  
							 <center>
							 <img src='../icons/check-circle.gif' height='70px'  width='70px' /><hr>
					
						 <h3 style='color:green; font-weight:900;'>USER EXIST!</h3>
							  
							<form action='index.php' method='POST'> 
							<button type='submit' style='font-weight:900;'  class='btn btn-success'>CONTINUE</button>  </form>


							  </center>
							</div> 
							</div></div>
						</div> </div>
			   
			  ";
    } else {
        if ($reg_user->create($fname, $mname, $lname, $uname, $upas, $phone, $email, $type, $reg_date, $work, $acc_no, $addr, $sex, $dob, $marry, $t_bal, $a_bal, $currency, $cot, $tax, $imf, $pin_auth, $pin, $verify)) {
            $id = $reg_user->lasdID();

 

            $subject = "Welcome $fname - Your Account Has Been Created!"; 

            $send_otp_mobile = preg_replace('/[^0-9]/', '', $_POST['phone']);
            $reg_user->send_mail($email, $messag, $subject);
            //$reg_user->otp($send_otp_mobile, $subject);

 
            $msg1 = "
					<div class='popup' > <div class='modal-dialog modal-sm' >
							<div style='background-color:green; border:solid; border-color:brown; border-radius:10px;' ><div class='modal-content'  >
								<div class='modal-header' style='background-color:white;'>
									<h5 class='modal-title'></h5>
									<button type='button' class='btn-close' data-bs-dismiss='modal'>
									</button>
								</div>
								<div class='modal-body' style='background-color:white; '>  
							 <center>
							 <img src='../icons/check-circle.gif' height='70px'  width='70px' /><hr>
					
						 <h3 style='color:green; font-weight:900;'>USER REGISTERED!</h3>
							  
							<form action='index.php' method='POST'> 
							<button type='submit' style='font-weight:900;'  class='btn btn-success'>CONTINUE</button>  </form>


							  </center>
							</div> 
							</div></div>
						</div> </div>
					";
        } else {
            echo "Sorry , Query could no execute...";
        }
    }
}
?>


 <?php include 'headeradmin.php'; ?>
 
 
     
     
  
    <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				<div class="row" >
	  
	  
	  
	  
        <div class="col" >
          <div class="card shadow"  style="background-color: white; color:black;">
            <div class="card-header border-0">
              <h3 class="mb-0" style="color:#000;">Register New User</h3>
            </div>
           
             
           <form role="form" style="width:98%; padding-left:15px; "  method="POST" enctype="multipart/form-data">
                    <?php if (isset($msg1)) echo $msg1; ?>
                      <?php if (isset($msg)) echo $msg; ?>
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label>First Name</label>
                            <input type="text" name="fname" required class="input-sm validate[required] form-control" placeholder="First Name">
                        </div>
                     
                       
                        
                        <div class="col-md-3 form-group">
                            <label>Last Name</label>
                            <input type="text" name="lname" required class="input-sm validate[required] form-control" placeholder="Last Name">
                        </div>
                     
					 
					  <div class="col-md-3 form-group" id="date-time">

                            <label>Date of Birth</label>
                            <div class="input-icon datetime-pick date-only">
                                <input data-format="dd/MM/yyyy" name="dob" required type="date" placeholder="Date of Birth" class="input-sm validate[required] form-control" />
                                <span class="add-on">
                                    <i class="sa-plus"></i>
                                </span>
                            </div>
                        </div>

                        <div class="col-md-3 form-group">
                            <label>Marital Status</label>
                            <select required name="marry" class="input-sm validate[required] form-control">
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Widowed">Widowed</option>
                                <option value="Divorced">Divorced</option>
                            </select>
                        </div>
					 
						    
				   
                    </div>
                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label>Password</label>
                            <input type="text" name="upas" required class="input-sm validate[required] form-control" placeholder="Password">
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Occupation</label>
                            <input type="text" name="work" required class="input-sm validate[required] form-control" placeholder="Occupation">
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Phone(Type without +)</label>
                            <input type="text" name="phone" required class="input-sm validate[required] form-control" placeholder="Eg 2341234567786">
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Email</label>
                            <input type="email" name="email" required class="input-sm validate[required] form-control" placeholder="Email">
                        </div>

                    </div>
                    <div class="row">
                        
                       
                        <div class="col-md-3 form-group">
                            <label>Gender</label>
                            <select  required name="sex" class="form-control input-sm validate[required]">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Address</label>
                            <textarea name="addr" class="input-sm validate[required] form-control" placeholder="House or Office Address" required></textarea>
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Account Type</label>
                            <select name="type" class="form-control input-sm validate[required]" required>
                                <option value="Savings">Savings</option>
                                <option value="Current">Current</option>
                                 <option value="Checking">Checking</option>
                                <option value="Fixed Deposit">Fixed Deposit</option>
                                 <option value="NON-Resident">NON-Resident</option>
                                <option value="Online Banking">Online Banking</option>
                                 <option value="Joint Account">Joint Account</option>
                                <option value="DOMICILIARY ACCOUNT">DOMICILIARY ACCOUNT</option>
                            </select>
                        </div>
						
						
						  <div class="col-md-3 form-group" id="date-time">

                            <label>Registration Date</label>
                            <div class="input-icon datetime-pick date-only">
                                <input data-format="dd/MM/yyyy" name="reg_date" type="date" placeholder="Select Reg Date" required class="form-control input-sm" />
                                <span class="add-on">
                                    <i class="sa-plus"></i>
                                </span>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        
                      
                          
                     
                        <div class="col-md-3 form-group">
                            <label>Available Balance</label>
                            <input type="number" name="a_bal" class="input-sm validate[required] form-control" required placeholder="Available Balance">
                        </div>
                        <div class="col-md-3 form-group">
                            <label>Select Account No</label>
                            <input type="text" name="acc_no" class="input-sm validate[required] form-control" value="<?php echo(rand(1111111111,9999999999)); ?>">
                        </div>
                        
						
						
						
						<div class="col-md-3 form-group">
                            <label>Account Currency</label>
                            <select class="input-sm validate[required] form-control" name="currency" required>
                               <option value="$">USD - United States Dollar ($)</option>
                <option value="€">EUR - Euro (€)</option>
                <option value="¥">JPY - Japanese Yen (¥)</option>
                <option value="£">GBP - British Pound (£)</option>
                <option value="A$">AUD - Australian Dollar (A$)</option>
                <option value="C$">CAD - Canadian Dollar (C$)</option>
                <option value="CHF">CHF - Swiss Franc (CHF)</option>
                <option value="¥">CNY - Chinese Yuan (¥)</option>
                <option value="kr">SEK - Swedish Krona (kr)</option>
                <option value="NZ$">NZD - New Zealand Dollar (NZ$)</option>
                <option value="$">MXN - Mexican Peso ($)</option>
                <option value="S$">SGD - Singapore Dollar (S$)</option>
                <option value="HK$">HKD - Hong Kong Dollar (HK$)</option>
                <option value="kr">NOK - Norwegian Krone (kr)</option>
                <option value="₩">KRW - South Korean Won (₩)</option>
                <option value="₺">TRY - Turkish Lira (₺)</option>
                <option value="₹">INR - Indian Rupee (₹)</option>
                <option value="₽">RUB - Russian Ruble (₽)</option>
                <option value="R$">BRL - Brazilian Real (R$)</option>
                <option value="R">ZAR - South African Rand (R)</option>
                <option value="kr">DKK - Danish Krone (kr)</option>
                <option value="zł">PLN - Polish Zloty (zł)</option>
                <option value="NT$">TWD - New Taiwan Dollar (NT$)</option>
                <option value="฿">THB - Thai Baht (฿)</option>
                <option value="RM">MYR - Malaysian Ringgit (RM)</option>
                <option value="Rp">IDR - Indonesian Rupiah (Rp)</option>
                <option value="Kč">CZK - Czech Koruna (Kč)</option>
                <option value="Ft">HUF - Hungarian Forint (Ft)</option>
                <option value="د.إ">AED - United Arab Emirates Dirham (د.إ)</option>
                <option value="₪">ILS - Israeli New Shekel (₪)</option>
                <option value="$">CLP - Chilean Peso ($)</option>
                <option value="₱">PHP - Philippine Peso (₱)</option>
                <option value="S/.">PEN - Peruvian Sol (S/.)</option>
                <option value="$">COP - Colombian Peso ($)</option>
                <option value="ر.س">SAR - Saudi Riyal (ر.س)</option>
                <option value="lei">RON - Romanian Leu (lei)</option>
                <option value="৳">BDT - Bangladeshi Taka (৳)</option>
                <option value="£">EGP - Egyptian Pound (£)</option>
                <option value="₨">PKR - Pakistani Rupee (₨)</option>
                <option value="₫">VND - Vietnamese Dong (₫)</option>
                <option value="₦">NGN - Nigerian Naira (₦)</option>
                <option value="KSh">KES - Kenyan Shilling (KSh)</option>
                <option value="₵">GHS - Ghanaian Cedi (₵)</option>
                <option value="د.ج">DZD - Algerian Dinar (د.ج)</option>
                <option value="د.م.">MAD - Moroccan Dirham (د.م.)</option>
                <option value="د.ت">TND - Tunisian Dinar (د.ت)</option>
                <option value="USh">UGX - Ugandan Shilling (USh)</option>
                <option value="ج.س.">SDG - Sudanese Pound (ج.س.)</option>
                <option value="₨">LKR - Sri Lankan Rupee (₨)</option>
                <option value="K">MMK - Burmese Kyat (K)</option>
                <option value=".د.ب">BHD - Bahraini Dinar (.د.ب)</option>
                <option value="ر.ع.">OMR - Omani Rial (ر.ع.)</option>
                <option value="ر.ق">QAR - Qatari Riyal (ر.ق)</option>
                <option value="د.ك">KWD - Kuwaiti Dinar (د.ك)</option>
                <option value="د.ا">JOD - Jordanian Dinar (د.ا)</option>
                <option value="ل.ل">LBP - Lebanese Pound (ل.ل)</option>
                <option value="B$">BND - Brunei Dollar (B$)</option>
                <option value="₨">MUR - Mauritian Rupee (₨)</option>
                <option value="₨">SCR - Seychellois Rupee (₨)</option>
                <option value="P">BWP - Botswana Pula (P)</option>
                <option value="N$">NAD - Namibian Dollar (N$)</option>
                <option value="MT">MZN - Mozambican Metical (MT)</option>
                <option value="ብር">ETB - Ethiopian Birr (ብር)</option>
                <option value="Kz">AOA - Angolan Kwanza (Kz)</option>
                <option value="ZK">ZMW - Zambian Kwacha (ZK)</option>
                <option value="KM">BAM - Bosnian Convertible Mark (KM)</option>
                <option value="₾">GEL - Georgian Lari (₾)</option>
                <option value="֏">AMD - Armenian Dram (֏)</option>
                <option value="₼">AZN - Azerbaijani Manat (₼)</option>
                <option value="₸">KZT - Kazakhstani Tenge (₸)</option>
                <option value="soʻm">UZS - Uzbekistani Som (soʻm)</option>
                <option value="Br">BYN - Belarusian Ruble (Br)</option>
                <option value="ЅМ">TJS - Tajikistani Somoni (ЅМ)</option>
                <option value="сом">KGS - Kyrgyzstani Som (сом)</option>
                <option value="؋">AFN - Afghan Afghani (؋)</option>
                <option value="₮">MNT - Mongolian Tugrik (₮)</option>
                <option value="﷼">IRR - Iranian Rial (﷼)</option>
                <option value="ع.د">IQD - Iraqi Dinar (ع.د)</option>
                <option value="ل.س">SYP - Syrian Pound (ل.س)</option>
                <option value="﷼">YER - Yemeni Rial (﷼)</option>
                <option value="Ar">MGA - Malagasy Ariary (Ar)</option>
                <option value="MOP$">MOP - Macanese Pataca (MOP$)</option>
                <option value="₩">KPW - North Korean Won (₩)</option>
                <option value="₭">LAK - Lao Kip (₭)</option>
                <option value="៛">KHR - Cambodian Riel (៛)</option>
                <option value="K">PGK - Papua New Guinean Kina (K)</option>
                <option value="SI$">SBD - Solomon Islands Dollar (SI$)</option>
                <option value="VT">VUV - Vanuatu Vatu (VT)</option>
                <option value="WS$">WST - Samoan Tala (WS$)</option>
                <option value="T$">TOP - Tongan Paʻanga (T$)</option>
                <option value="FJ$">FJD - Fijian Dollar (FJ$)</option>
                <option value="Bds$">BBD - Barbadian Dollar (Bds$)</option>
                <option value="BD$">BMD - Bermudian Dollar (BD$)</option>
                <option value="BZ$">BZD - Belize Dollar (BZ$)</option>
                <option value="G">HTG - Haitian Gourde (G)</option>
                <option value="J$">JMD - Jamaican Dollar (J$)</option>
                <option value="CI$">KYD - Cayman Islands Dollar (CI$)</option>
                <option value="TT$">TTD - Trinidad and Tobago Dollar (TT$)</option>
                            </select>
                        </div>
						
						
						
						
						
						
						
						
                    </div>
       

								 <input type="hidden" name="mname" required class="input-sm form-control" value="-">
                            	<input type="hidden" id="lname" name="uname" value="<?php

$permitted_chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

function generate_string($input, $strength = 16) {

    $input_length = strlen($input);

    $random_string = '';

    for($i = 0; $i < $strength; $i++) {

        $random_character = $input[mt_rand(0, $input_length - 1)];

        $random_string .= $random_character;

    }

    return $random_string;

}

 
echo generate_string($permitted_chars, 8);
 

?>" required>
							  <input type="hidden" name="t_bal" required value="0.00">
                      
                            <input type="hidden" name="cot"  value="<?php echo(rand(1111,9999)); ?>" > 
                            <input type="hidden" name="tax" value="<?php echo(rand(1111,9999)); ?>" > 
                            <input type="hidden" name="imf" value="<?php echo(rand(1111,9999)); ?>" > 
                            <input type="hidden" name="pin_auth" value="<?php echo(rand(1111,9999)); ?>" >
							   <input type="hidden" name="pin" value="<?php echo(rand(1111,9999)); ?>"  > 
                            <input type="hidden" name="verify"  value="Y" >
          
		  <br><br>
             
            <input class="btn btn-danger" type="reset" value="Reset">
            <input class="btn btn-success" type="submit" name="create" value="Register">
            
            	  <br><br>
            </div>


  
            

            </form>
             
 
        
          </div>
		  
		  
        </div>
      </div>
	  </div>
     
       <?php include 'foot.php'; ?>