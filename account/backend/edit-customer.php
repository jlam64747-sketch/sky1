<?php
include_once "class.crud.php";
if (isset($_POST["btn-update"])) {
    $id = $_GET["edit_id"];
    $acc_no = $_POST["acc_no"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $pin_auth = $_POST["pin_auth"];
    $pin = $_POST["pin"];
    $uname = $_POST["uname"];
    $phone = $_POST["phone"];
    $type = $_POST["type"];
    $reg_date = $_POST["reg_date"];
    $work = $_POST["work"];
    $addr = $_POST["addr"];
    $sex = $_POST["sex"];
    $dob = $_POST["dob"];
    $marry = $_POST["marry"];
    $t_bal = $_POST["t_bal"];
    $a_bal = $_POST["a_bal"];
    $currency = $_POST["currency"];
    $cot = $_POST["cot"];
    $tax = $_POST["tax"];
    $imf = $_POST["imf"];
    $status = $_POST["status"];
    $phone_verify = $_POST["phone_verify"];

    if (
        $crud->update(
            $id,
            $acc_no,
            $fname,
            $lname,
            $email,
            $pin_auth,
            $pin,
            $uname,
            $phone,
            $type,
            $reg_date,
            $work,
            $addr,
            $sex,
            $dob,
            $marry,
            $t_bal,
            $a_bal,
            $currency,
            $cot,
            $tax,
            $imf,
            $status,
            $phone_verify
        )
    ) {
        $msg = "
        <div class='popup'>
            <div class='modal-dialog modal-sm'>
                <div style='background-color:white; border:1px solid; border-color:grey; border-radius:5px;'>
                    <div class='modal-content'>
                        <div class='modal-header' style='background-color:white;'>
                            <h5 class='modal-title'></h5>
                            <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                        </div>
                        <div class='modal-body' style='background-color:white;'>  
                            <center>
                                <img src='../icons/success.gif' height='70px' width='70px' /><hr>
                                <h3 style='color:green; font-weight:900;'>ACCOUNT UPDATED!</h3>
                                <button type='button' style='font-weight:900;' class='btn btn-sm btn-success' id='continueButton'>Continue</button>
                            </center>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    ";
    } else {
        $msg = "<div class='alert alert-warning'>
				<strong>SORRY!</strong> ERROR while updating record !
				</div>";
    }
}

if (isset($_GET["edit_id"])) {
    $id = $_GET["edit_id"];
    extract($crud->getID($id));
}
?>
 <?php include "headeradmin.php"; ?>
 
 
     <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
     <!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card shadow"  style="background-color: white; color:black;" >
            <div class="card-header border-0">
              <h3 class="mb-0" style="color:#000;">Edit User Information</h3>
            </div>
          
           <div class="card-body">
               
               <?php if (isset($msg)) {
                   echo $msg;
               } ?>
               
              
<div class="container-fluid">
	<form method='post' class=''>
 
 
 <div class="row">
         <div class="form-group col-md-3">
            <label for="name">Account No</label>
			<input id="name" name="acc_no" class="form-control" type="text" value="<?php echo $acc_no; ?>"  />
        </div>
		
        <div class="form-group col-md-3">
            <label for="name">First Name</label>
			<input id="name" name="fname" class="form-control" type="text" value="<?php echo $fname; ?>"  />
        </div>
 
        <div class="form-group col-md-3">
			<label for="email">Last Name</label>
			<input id="lname" name="lname" class="form-control" type="text" value="<?php echo $lname; ?>" />
        </div>
 
        <div class="form-group col-md-3">
            <label for="website">Email</label>
			<input id="website" name="email" class="form-control" type="text" value="<?php echo $email; ?>" />
        </div>
 </div>
  <div class="row">
        <div class="form-group col-md-3">
			<label for="contact">Login Pin </label>
			<input id="contact" name="pin_auth" class="form-control" type="text" value="<?php echo $pin_auth; ?>" required />
        </div>
		
		<div class="form-group col-md-3">
			<label for="job">Transfer Pin</label>
			<input id="job" name="pin" class="form-control" type="text" value="<?php echo $pin; ?>" required />
        </div>
		
		<div class="form-group col-md-3">
			<label for="company">User Name</label>
			<input id="company" name="uname" class="form-control" type="text" value="<?php echo $uname; ?>" required />
        </div>
		
		
         <div class="form-group col-md-3">
            <label for="name">Phone</label>
			<input id="name" name="phone" class="form-control" type="text" value="<?php echo $phone; ?>"  />
        </div>
	</div>
	 <div class="row">
        <div class="form-group col-md-3">
            <label for="name">Acc. Type</label>
		  <select name="type" class="form-control input-sm validate[required]">
    <option value="Savings"<?php if ($type == "Savings") {
        echo " selected";
    } ?>>Savings</option>
    <option value="Current"<?php if ($type == "Current") {
        echo " selected";
    } ?>>Current</option>
    <option value="Checking"<?php if ($type == "Checking") {
        echo " selected";
    } ?>>Checking</option>
    <option value="Fixed Deposit"<?php if ($type == "Fixed Deposit") {
        echo " selected";
    } ?>>Fixed Deposit</option>
    <option value="Offshore"<?php if ($type == "Offshore") {
        echo " selected";
    } ?>>Offshore</option>
    <option value="Joint Account"<?php if ($type == "Joint Account") {
        echo " selected";
    } ?>>Joint Account</option>
    <option value="Domiciliary Account"<?php if (
        $type == "Domiciliary Account"
    ) {
        echo " selected";
    } ?>>Domiciliary Account</option>
</select>

        </div>
 
        <div class="form-group col-md-3">
    <label for="reg_date">Reg. Date</label>
    <?php $formatted_date = date(
        "Y-m-d",
        strtotime(str_replace("/", "-", $reg_date))
    ); ?>
    <input id="reg_date" name="reg_date" class="form-control" type="date" value="<?php echo $formatted_date; ?>" />
</div>



 
        <div class="form-group col-md-3">
            <label for="website">Occupation</label>
			<input id="website" name="work" class="form-control" type="text" value="<?php echo $work; ?>" />
        </div>
 
        <div class="form-group col-md-3">
			<label for="contact">Address </label>
			<input id="contact" name="addr" class="form-control" type="text" value="<?php echo $addr; ?>" required />
        </div>
	</div>
	 <div class="row">
		<div class="form-group col-md-3">
			<label for="job">Gender</label>
			<select name="sex" class="form-control input-sm validate[required]">
    <option value="Male"<?php if ($sex == "Male") {
        echo " selected";
    } ?>>Male</option>
    <option value="Female"<?php if ($sex == "Female") {
        echo " selected";
    } ?>>Female</option>
    <option value="Other"<?php if ($sex == "Other") {
        echo " selected";
    } ?>>Other</option>
</select>

        </div>
		
		<div class="form-group col-md-3">
    <label for="dob">Date Of Birth<small> (dd/MM/yyyy)</small></label>
    <?php $formatted_dob = date(
        "Y-m-d",
        strtotime(str_replace("/", "-", $dob))
    ); ?>
    <input id="dob" name="dob" class="form-control" type="date" value="<?php echo $formatted_dob; ?>" required />
    </div>

		
		
         <div class="form-group col-md-3">
            <label for="name">Marital Status</label>
	<select name="marry" class="form-control input-sm validate[required]">
    <option value="Single"<?php if ($marry == "Single") {
        echo " selected";
    } ?>>Single</option>
    <option value="Married"<?php if ($marry == "Married") {
        echo " selected";
    } ?>>Married</option>
    <option value="Widowed"<?php if ($marry == "Widowed") {
        echo " selected";
    } ?>>Widowed</option>
    <option value="Divorced"<?php if ($marry == "Divorced") {
        echo " selected";
    } ?>>Divorced</option>
</select>

        </div>
		
        <div class="form-group col-md-3">
            <label for="name">Total Balance</label>
			<input id="name" name="t_bal" class="form-control" type="number" value="<?php echo $t_bal; ?>" />
		 </div>
 </div>
  <div class="row">
        <div class="form-group col-md-3">
			<label for="email">Available Balance</label>
			<input id="lname" name="a_bal" class="form-control" type="number" value="<?php echo $a_bal; ?>" />
        </div>
 
        <div class="form-group col-md-3">
    <label for="currency">Currency</label>
    <select class="input-sm validate[required] form-control" name="currency" required>
        <option value="$"<?php if ($currency == '$') {
            echo " selected";
        } ?>>USD - United States Dollar ($)</option>
        <option value="€"<?php if ($currency == "€") {
            echo " selected";
        } ?>>EUR - Euro (€)</option>
        <option value="¥"<?php if ($currency == "¥") {
            echo " selected";
        } ?>>JPY - Japanese Yen (¥)</option>
        <option value="£"<?php if ($currency == "£") {
            echo " selected";
        } ?>>GBP - British Pound (£)</option>
        <option value="A$"<?php if ($currency == 'A$') {
            echo " selected";
        } ?>>AUD - Australian Dollar (A$)</option>
        <option value="C$"<?php if ($currency == 'C$') {
            echo " selected";
        } ?>>CAD - Canadian Dollar (C$)</option>
        <option value="CHF"<?php if ($currency == "CHF") {
            echo " selected";
        } ?>>CHF - Swiss Franc (CHF)</option>
        <option value="¥"<?php if ($currency == "¥") {
            echo " selected";
        } ?>>CNY - Chinese Yuan (¥)</option>
        <option value="kr"<?php if ($currency == "kr") {
            echo " selected";
        } ?>>SEK - Swedish Krona (kr)</option>
        <option value="NZ$"<?php if ($currency == 'NZ$') {
            echo " selected";
        } ?>>NZD - New Zealand Dollar (NZ$)</option>
        <option value="S$"<?php if ($currency == 'S$') {
            echo " selected";
        } ?>>SGD - Singapore Dollar (S$)</option>
        <option value="HK$"<?php if ($currency == 'HK$') {
            echo " selected";
        } ?>>HKD - Hong Kong Dollar (HK$)</option>
        <option value="kr"<?php if ($currency == "kr") {
            echo " selected";
        } ?>>NOK - Norwegian Krone (kr)</option>
        <option value="₩"<?php if ($currency == "₩") {
            echo " selected";
        } ?>>KRW - South Korean Won (₩)</option>
        <option value="₺"<?php if ($currency == "₺") {
            echo " selected";
        } ?>>TRY - Turkish Lira (₺)</option>
        <option value="₹"<?php if ($currency == "₹") {
            echo " selected";
        } ?>>INR - Indian Rupee (₹)</option>
        <option value="₽"<?php if ($currency == "₽") {
            echo " selected";
        } ?>>RUB - Russian Ruble (₽)</option>
        <option value="R$"<?php if ($currency == 'R$') {
            echo " selected";
        } ?>>BRL - Brazilian Real (R$)</option>
        <option value="R"<?php if ($currency == "R") {
            echo " selected";
        } ?>>ZAR - South African Rand (R)</option>
        <option value="kr"<?php if ($currency == "kr") {
            echo " selected";
        } ?>>DKK - Danish Krone (kr)</option>
        <option value="zł"<?php if ($currency == "zł") {
            echo " selected";
        } ?>>PLN - Polish Zloty (zł)</option>
        <option value="NT$"<?php if ($currency == 'NT$') {
            echo " selected";
        } ?>>TWD - New Taiwan Dollar (NT$)</option>
        <option value="฿"<?php if ($currency == "฿") {
            echo " selected";
        } ?>>THB - Thai Baht (฿)</option>
        <option value="RM"<?php if ($currency == "RM") {
            echo " selected";
        } ?>>MYR - Malaysian Ringgit (RM)</option>
        <option value="Rp"<?php if ($currency == "Rp") {
            echo " selected";
        } ?>>IDR - Indonesian Rupiah (Rp)</option>
        <option value="Kč"<?php if ($currency == "Kč") {
            echo " selected";
        } ?>>CZK - Czech Koruna (Kč)</option>
        <option value="Ft"<?php if ($currency == "Ft") {
            echo " selected";
        } ?>>HUF - Hungarian Forint (Ft)</option>
        <option value="د.إ"<?php if ($currency == "د.إ") {
            echo " selected";
        } ?>>AED - United Arab Emirates Dirham (د.إ)</option>
        <option value="₪"<?php if ($currency == "₪") {
            echo " selected";
        } ?>>ILS - Israeli New Shekel (₪)</option>
        <option value="₱"<?php if ($currency == "₱") {
            echo " selected";
        } ?>>PHP - Philippine Peso (₱)</option>
        <option value="S/."<?php if ($currency == "S/.") {
            echo " selected";
        } ?>>PEN - Peruvian Sol (S/.)</option>
        <option value="ر.س"<?php if ($currency == "ر.س") {
            echo " selected";
        } ?>>SAR - Saudi Riyal (ر.س)</option>
        <option value="lei"<?php if ($currency == "lei") {
            echo " selected";
        } ?>>RON - Romanian Leu (lei)</option>
        <option value="৳"<?php if ($currency == "৳") {
            echo " selected";
        } ?>>BDT - Bangladeshi Taka (৳)</option>
        <option value="£"<?php if ($currency == "£") {
            echo " selected";
        } ?>>EGP - Egyptian Pound (£)</option>
        <option value="₨"<?php if ($currency == "₨") {
            echo " selected";
        } ?>>PKR - Pakistani Rupee (₨)</option>
        <option value="₫"<?php if ($currency == "₫") {
            echo " selected";
        } ?>>VND - Vietnamese Dong (₫)</option>
        <option value="₦"<?php if ($currency == "₦") {
            echo " selected";
        } ?>>NGN - Nigerian Naira (₦)</option>
        <option value="KSh"<?php if ($currency == "KSh") {
            echo " selected";
        } ?>>KES - Kenyan Shilling (KSh)</option>
        <option value="₵"<?php if ($currency == "₵") {
            echo " selected";
        } ?>>GHS - Ghanaian Cedi (₵)</option>
        <option value="د.ج"<?php if ($currency == "د.ج") {
            echo " selected";
        } ?>>DZD - Algerian Dinar (د.ج)</option>
        <option value="د.م."<?php if ($currency == "د.م.") {
            echo " selected";
        } ?>>MAD - Moroccan Dirham (د.م.)</option>
        <option value="د.ت"<?php if ($currency == "د.ت") {
            echo " selected";
        } ?>>TND - Tunisian Dinar (د.ت)</option>
        <option value="USh"<?php if ($currency == "USh") {
            echo " selected";
        } ?>>UGX - Ugandan Shilling (USh)</option>
        <option value="ج.س."<?php if ($currency == "ج.س.") {
            echo " selected";
        } ?>>SDG - Sudanese Pound (ج.س.)</option>
        <option value="₨"<?php if ($currency == "₨") {
            echo " selected";
        } ?>>LKR - Sri Lankan Rupee (₨)</option>
        <option value="K"<?php if ($currency == "K") {
            echo " selected";
        } ?>>MMK - Burmese Kyat (K)</option>
        <option value=".د.ب"<?php if ($currency == ".د.ب") {
            echo " selected";
        } ?>>BHD - Bahraini Dinar (.د.ب)</option>
        <option value="ر.ع."<?php if ($currency == "ر.ع.") {
            echo " selected";
        } ?>>OMR - Omani Rial (ر.ع.)</option>
        <option value="ر.ق"<?php if ($currency == "ر.ق") {
            echo " selected";
        } ?>>QAR - Qatari Riyal (ر.ق)</option>
        <option value="د.ك"<?php if ($currency == "د.ك") {
            echo " selected";
        } ?>>KWD - Kuwaiti Dinar (د.ك)</option>
        <option value="د.ا"<?php if ($currency == "د.ا") {
            echo " selected";
        } ?>>JOD - Jordanian Dinar (د.ا)</option>
        <option value="ل.ل"<?php if ($currency == "ل.ل") {
            echo " selected";
        } ?>>LBP - Lebanese Pound (ل.ل)</option>
        <option value="B$"<?php if ($currency == 'B$') {
            echo " selected";
        } ?>>BND - Brunei Dollar (B$)</option>
        <option value="₨"<?php if ($currency == "₨") {
            echo " selected";
        } ?>>MUR - Mauritian Rupee (₨)</option>
        <option value="₨"<?php if ($currency == "₨") {
            echo " selected";
        } ?>>SCR - Seychellois Rupee (₨)</option>
        <option value="P"<?php if ($currency == "P") {
            echo " selected";
        } ?>>BWP - Botswana Pula (P)</option>
        <option value="N$"<?php if ($currency == 'N$') {
            echo " selected";
        } ?>>NAD - Namibian Dollar (N$)</option>
        <option value="MT"<?php if ($currency == "MT") {
            echo " selected";
        } ?>>MZN - Mozambican Metical (MT)</option>
        <option value="ብር"<?php if ($currency == "ብር") {
            echo " selected";
        } ?>>ETB - Ethiopian Birr (ብር)</option>
        <option value="Kz"<?php if ($currency == "Kz") {
            echo " selected";
        } ?>>AOA - Angolan Kwanza (Kz)</option>
        <option value="ZK"<?php if ($currency == "ZK") {
            echo " selected";
        } ?>>ZMW - Zambian Kwacha (ZK)</option>
        <option value="KM"<?php if ($currency == "KM") {
            echo " selected";
        } ?>>BAM - Bosnian Convertible Mark (KM)</option>
        <option value="₾"<?php if ($currency == "₾") {
            echo " selected";
        } ?>>GEL - Georgian Lari (₾)</option>
        <option value="֏"<?php if ($currency == "֏") {
            echo " selected";
        } ?>>AMD - Armenian Dram (֏)</option>
        <option value="₼"<?php if ($currency == "₼") {
            echo " selected";
        } ?>>AZN - Azerbaijani Manat (₼)</option>
        <option value="₸"<?php if ($currency == "₸") {
            echo " selected";
        } ?>>KZT - Kazakhstani Tenge (₸)</option>
        <option value="soʻm"<?php if ($currency == "soʻm") {
            echo " selected";
        } ?>>UZS - Uzbekistani Som (soʻm)</option>
        <option value="Br"<?php if ($currency == "Br") {
            echo " selected";
        } ?>>BYN - Belarusian Ruble (Br)</option>
        <option value="ЅМ"<?php if ($currency == "ЅМ") {
            echo " selected";
        } ?>>TJS - Tajikistani Somoni (ЅМ)</option>
        <option value="сом"<?php if ($currency == "сом") {
            echo " selected";
        } ?>>KGS - Kyrgyzstani Som (сом)</option>
        <option value="؋"<?php if ($currency == "؋") {
            echo " selected";
        } ?>>AFN - Afghan Afghani (؋)</option>
        <option value="₮"<?php if ($currency == "₮") {
            echo " selected";
        } ?>>MNT - Mongolian Tugrik (₮)</option>
        <option value="﷼"<?php if ($currency == "﷼") {
            echo " selected";
        } ?>>IRR - Iranian Rial (﷼)</option>
        <option value="ع.د"<?php if ($currency == "ع.د") {
            echo " selected";
        } ?>>IQD - Iraqi Dinar (ع.د)</option>
        <option value="ل.س"<?php if ($currency == "ل.س") {
            echo " selected";
        } ?>>SYP - Syrian Pound (ل.س)</option>
        <option value="﷼"<?php if ($currency == "﷼") {
            echo " selected";
        } ?>>YER - Yemeni Rial (﷼)</option>
        <option value="Ar"<?php if ($currency == "Ar") {
            echo " selected";
        } ?>>MGA - Malagasy Ariary (Ar)</option>
        <option value="MOP$"<?php if ($currency == 'MOP$') {
            echo " selected";
        } ?>>MOP - Macanese Pataca (MOP$)</option>
        <option value="₩"<?php if ($currency == "₩") {
            echo " selected";
        } ?>>KPW - North Korean Won (₩)</option>
        <option value="₭"<?php if ($currency == "₭") {
            echo " selected";
        } ?>>LAK - Lao Kip (₭)</option>
        <option value="៛"<?php if ($currency == "៛") {
            echo " selected";
        } ?>>KHR - Cambodian Riel (៛)</option>
        <option value="K"<?php if ($currency == "K") {
            echo " selected";
        } ?>>PGK - Papua New Guinean Kina (K)</option>
        <option value="SI$"<?php if ($currency == 'SI$') {
            echo " selected";
        } ?>>SBD - Solomon Islands Dollar (SI$)</option>
        <option value="VT"<?php if ($currency == "VT") {
            echo " selected";
        } ?>>VUV - Vanuatu Vatu (VT)</option>
        <option value="WS$"<?php if ($currency == 'WS$') {
            echo " selected";
        } ?>>WST - Samoan Tala (WS$)</option>
        <option value="T$"<?php if ($currency == 'T$') {
            echo " selected";
        } ?>>TOP - Tongan Paʻanga (T$)</option>
        <option value="FJ$"<?php if ($currency == 'FJ$') {
            echo " selected";
        } ?>>FJD - Fijian Dollar (FJ$)</option>
        <option value="Bds$"<?php if ($currency == 'Bds$') {
            echo " selected";
        } ?>>BBD - Barbadian Dollar (Bds$)</option>
        <option value="BD$"<?php if ($currency == 'BD$') {
            echo " selected";
        } ?>>BMD - Bermudian Dollar (BD$)</option>
        <option value="BZ$"<?php if ($currency == 'BZ$') {
            echo " selected";
        } ?>>BZD - Belize Dollar (BZ$)</option>
        <option value="G"<?php if ($currency == "G") {
            echo " selected";
        } ?>>HTG - Haitian Gourde (G)</option>
        <option value="J$"<?php if ($currency == 'J$') {
            echo " selected";
        } ?>>JMD - Jamaican Dollar (J$)</option>
        <option value="CI$"<?php if ($currency == 'CI$') {
            echo " selected";
        } ?>>KYD - Cayman Islands Dollar (CI$)</option>
        <option value="TT$"<?php if ($currency == 'TT$') {
            echo " selected";
        } ?>>TTD - Trinidad and Tobago Dollar (TT$)</option>
    </select>
</div>

 
        <div class="form-group col-md-3">
			<label for="contact">TAC </label>
			<input id="contact" name="cot" class="form-control" type="text" value="<?php echo $cot; ?>" required />
        </div>
		
		<div class="form-group col-md-3">
			<label for="job">TAX</label>
			<input id="job" name="tax" class="form-control" type="text" value="<?php echo $tax; ?>" required />
        </div>
</div>
 <div class="row">
	<div class="form-group col-md-3">
			<label for="job">IMF</label>
			<input id="company" name="imf" class="form-control" type="text" value="<?php echo $imf; ?>"  />
       </div>
		
		
         <div class="form-group col-md-3">
    <label for="status">Account Status</label>
    <select name="status" class="form-control input-sm validate[required]">
        <option value="Active"<?php if ($status == "Active") {
            echo " selected";
        } ?>>Active</option>
        <option value="Inactive"<?php if ($status == "Inactive") {
            echo " selected";
        } ?>>Inactive</option>
        <option value="Locked"<?php if ($status == "Locked") {
            echo " selected";
        } ?>>Locked</option>
        <option value="Dormant"<?php if ($status == "Dormant") {
            echo " selected";
        } ?>>Dormant</option>
        <option value="Transfer Restricted"<?php if (
            $status == "Transfer Restricted"
        ) {
            echo " selected";
        } ?>>Transfer Restricted</option>
    </select>
</div>

		
		
        
        	<div class="form-group col-md-3">
			<label for="company">Login Verification</label>
			<input id="company" name="phone_verify" class="form-control" type="text" value="<?php echo $phone_verify; ?>" required />
			<p style="color:red;">1=APPROVED  &nbsp;&nbsp;&nbsp; 2="SUBMIT ID CARD" &nbsp;&nbsp;&nbsp;0=DEACTIVATE LOGIN</p>
        </div>
        
        </div>
		<div class="clearfix"></div>
            <br />
        <table>
        <tr>
            <td colspan="2">
                <button type="submit" class="btn btn-sm btn-success" name="btn-update">
    			<span class="glyphicon glyphicon-edit"></span>  Update Customer
				</button>
                <a href="index.php" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-backward"></i> &nbsp; Cancel</a>
            </td>
        </tr>
        </table>
</form> 


</div>
               
               
               
          </div>
        </div>
      </div>
     </div>
 </div>
<script>
    $(document).ready(function() {
        $('#continueButton').on('click', function() {
            $('.popup').hide();
        });
    });
</script>
       <?php include "foot.php"; ?>
