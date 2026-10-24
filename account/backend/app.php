<?php
session_start();
include_once ('session.php');
require_once 'class.admin.php';
if(!isset($_SESSION['email'])){
	
header("Location: login.php");

exit(); 
}

$reg_user = new USER();

if(isset($_GET['id'])){
	
$id=$_GET['id'];
$stmt = $reg_user->runQuery("SELECT * FROM account WHERE id='$id'");
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
}

if(isset($_POST['update']))
{	$fname = trim($_POST['fname']);
		
		
		$mname = trim($_POST['mname']);
		
		
		$lname = trim($_POST['lname']);
		
		
		$uname = trim($_POST['uname']);
		
		
		$upass = $_POST['upass'];
		
		$phone = trim($_POST['phone']);
		
		$email = trim($_POST['email']);
		
		$type = trim($_POST['type']);
		
		
		$work = trim($_POST['work']);
		
		
		$acc_no = trim($_POST['acc_no']);
		
		
		$addr = trim($_POST['addr']);

		
		$sex = trim($_POST['sex']);
		
		
		$dob = trim($_POST['dob']);
		
		
		$marry = trim($_POST['marry']);
		
		
		$t_bal = trim($_POST['t_bal']);
		
		
		$a_bal = trim($_POST['a_bal']);
		
	if($reg_user->update($fname,$mname,$lname,$uname,$upass,$phone,$email,$type,$work,$acc_no,$addr,$sex,$dob,$marry,$t_bal,$a_bal,$tax.$cot,$pin_auth))
	{
		$fname = trim($_POST['fname']);
		
		
		$mname = trim($_POST['mname']);
		
		
		$lname = trim($_POST['lname']);
		
		
		$uname = trim($_POST['uname']);
		
		
		$upass = $_POST['upass'];
		$upass = ($upass);
		
		$phone = trim($_POST['phone']);
		
		$email = trim($_POST['email']);
		
		$type = trim($_POST['type']);
		
		
		$work = trim($_POST['work']);
		
		
		$acc_no = trim($_POST['acc_no']);
		
		
		$addr = trim($_POST['addr']);

		
		$sex = trim($_POST['sex']);
		
		
		$dob = trim($_POST['dob']);
		
		
		$marry = trim($_POST['marry']);
		
		
		$t_bal = trim($_POST['t_bal']);
		
		
		$a_bal = trim($_POST['a_bal']);
		
		$cot = trim($_POST['cot']);
		
		
		$tax = trim($_POST['tax']);
		
		
		$imf = trim($_POST['imf']);
		
		$currency = trim($_POST['currency']);
		
		$pin_auth = $_POST['pin_auth'];
		
	    $pin = $_POST['pin'];
	    
	    $status = $_POST['status'];
		
	    $verify = $_POST['verify'];
	    
		
		
	
	$editaccount = $reg_user->runQuery("UPDATE account SET fname = '$fname', mname = '$mname', lname = '$lname', uname = '$uname', upass = '$upass', phone = '$phone', email = '$email', type = '$type', work = '$work', acc_no = '$acc_no', addr = '$addr', sex = '$sex', dob = '$dob', marry = '$marry', t_bal = '$t_bal', a_bal = '$a_bal', cot = '$cot', tax = '$tax', imf = '$imf', currency = '$currency', pin_auth = '$pin_auth', pin = '$pin', status = '$status', verify = '$verify'  WHERE id ='$id'");
	$editaccount->execute();
	
	
	
	    
$stmt = $reg_user->runQuery("SELECT * FROM bank_settings WHERE id = '1'");
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC); 
$bank_site_name  = $row["bank_site_name"];
$bank_site_address  = $row["bank_site_address"];
$bank_site_domain  = $row["bank_site_domain"];

            $messag = "	
			

			
				 <link href='https://fonts.googleapis.com/css?family=Kreon:400,700|Playfair+Display:400,400i,700,700i|Raleway:400,400i,700,700i|Roboto:400,400i,700,700i' rel='stylesheet' />
         
 

</div>   	 
    <!-- INTRODUCTION -->
<table width='100%' border='0' cellspacing='0' cellpadding='0' align='center'>
    <tr>
        <td bgcolor='#fbfdfd'>
            <table width='620' border='0' cellspacing='0' cellpadding='0' align='center' class='scale'>
                <tr>
                    <td bgcolor='#FFFFFF'>
                 
                        <table width='540' border='0' cellspacing='0' cellpadding='0' align='center' class='agile1 scale'>
                            
                           <tr ><td colspan='2' class='wls-5h' style='color:white; background-color:white; text-align:center; border-radius:0px;'><h1><strong><img src='$bank_site_domain/assets/images/bank_cool_logo.png' alt='' data-default='placeholder' data-max-width='120' width='200' height='70' ></strong></h1></td></tr> 
                            <tr ><td colspan='2' height='12' style='font-size: 1px;'>&nbsp;</td></tr>
                            <tr>
                                <td class='agile-main' align='center' colspan='2' style='font-family:Bell Gothic Std; color: green; font-size: 22px;' class='scale-center-both'>
								
								<strong style='color:#2e7ca2'><u>ACCOUNT APPROVAL</u></strong></td>
                            </tr>
                            <tr><td height='12' style='font-size: 1px;'>&nbsp;</td></tr>
							
							   <tr>
                                <td class='w3l-p2' colspan='2' style='font-family: Candara, sans-serif; color:red; font-size: 20px; line-height: 18px;' class='scale-center-both'>
                                   Dear Customer,
                                </td>
                            </tr>
							<tr><td height='12' style='font-size: 1px;'>&nbsp;</td></tr>
							
                           <tr>
                                <td class='w3l-p2' colspan='2' style='font-family: Candara, sans-serif; color:black; font-size: 18px; line-height: 28px;' class='scale-center-both'>
                               Congratulations,Your Account have been approved Successfully, Please, note that your Internet Banking is automatically activated and you will need a 
									  combination of your account number and password to access your online banking 
                                </td>
                            </tr>
                            <tr><td height='12' colspan='2' style='font-size: 1px;'><hr></td></tr>
                            
                                      
                        <tr><td height='12' align='left' style='font-size: 14px; line-height: 28px; font-weight:700; color:black;'>ACCOUNT NUMBER:</td> <td style='font-size: 16px; font-weight:700; color:#2e7ca2;'> $acc_no</td></tr>
                          <tr><td height='12' align='left' style='font-size: 14px; line-height: 28px; font-weight:700; color:black;'>PASSWORD:</td> <td style='font-size: 16px; font-weight:700; color:#2e7ca2;'> $upass</td></tr>
                        <tr><td height='12'align='left' style='font-size: 14px; line-height: 28px; font-weight:700;color:black;'>OPENING BALANCE: </td>           <td style='font-size: 16px; font-weight:700; color:#2e7ca2;'>$currency $t_bal</td></tr>
                        <tr><td height='12' align='left' style='font-size: 14px; line-height: 28px; font-weight:700; color:black;'>PENDING BALANCE:</td> <td style='font-size: 16px; font-weight:700; color:#2e7ca2;'>$currency 0.00</td></tr> 
                        <tr><td height='12' align='left' style='font-size: 14px; line-height: 28px; font-weight:700; color:black;'>STATUS</td>  <td style='font-size: 16px; font-weight:700; color:green;'> ACTIVE</td></tr>
                                      
             
             
             
             <tr><td height='12' colspan='2' style='font-size: 1px;'><hr></td></tr>
                    <tr><td height='12' style='font-size: 14px; font-weight:700; color:black;'><strong>AVALIABLE BALANCE:</td> <td style='font-size: 14px; font-weight:700; color:green;'>$currency $a_bal</strong></td></tr>
                    <tr><td height='12' colspan='2' style='font-size: 1px;'><hr></td></tr>
           
    	        
                             <tr><td class='wls-5h' height='60' align='left'  colspan='2'  style='font-size: 18px; color:red;'> Warm Regards,</td><td>&nbsp;</td></tr> 
	                        
	                         <tr><td class='wls-5h' height='60'  align='left' colspan='2' style='font-size: 20px; color:#2e7ca2;'><strong>$bank_site_name  </strong></td></tr>
    	             
    	             
								<tr>
                                <td class='w3l-p2' colspan='2' style='font-family: Candara, sans-serif; color:red; font-size: 14px; line-height: 18px; text-align:center;' class='scale-center-both'>
                                   An email really coming from us  will not ask you for sensitive information like your password, bank account or credit card details.
                                </td>
                            </tr>
    	             
                        </table>    
            
                    </td>
                </tr>
            </table>
            
        </td>
    </tr>
</table>


";



            $subject = "Welcome $fname - Your Account Application Has Been Approved!"; 
            $send_otp_mobile = preg_replace('/[^0-9]/', '', $_POST['phone']);
            $reg_user->send_mail($email, $messag, $subject);
            //$reg_user->otp($send_otp_mobile, $subject);





            $msg1 = "
					<div class='alert alert-info'>
						<button class='close' data-dismiss='alert'>&times;</button>
						<strong>Success!</strong> Account Has Been Successfully Approved!
                   
			  		</div>
					";
        } else  {
            echo "Sorry , Query could no execute...";
        }
    }
?>




 <?php include 'headeradmin.php'; ?>
 

 <!---begin of Mobile View Here   only from Digital Forest Team-->
 
       <?php include 'menu.php'; ?>
  
  <!---End of Mobile View Here   only from Digital Forest Team-->
  
 
     
     
      <br><br><br><br><br><br><br>
  
    <div class="container-fluid mt--7">
     <!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card shadow" >
            <div class="card-header border-0">
              <h3 class="mb-0"><a href=""   class="btn btn-danger">APPROVE CUSTOMER ACCOUNT</a></h3>
            </div>
          
           <div class="card-body">
               
               
               <?php if(isset($msg)) echo $msg;  ?>
					<?php if(isset($msg1)) echo $msg1;  ?> 
					
                    <form role="form" class="form-validation-1" method="POST" enctype="multipart/form-data">
                        
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label>first Name</label>
                                <input type="text" name="fname" class="input-sm validate[required] form-control" value="<?php echo $row['fname']; ?>">
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Middle Name (Optional)</label>
                                <input type="text" name="mname" class="input-sm form-control" value="<?php echo $row['mname']; ?>">
                            </div>
							<div class="col-md-3 form-group">
                                <label>Last Name</label>
                                <input type="text" name="lname" class="input-sm validate[required] form-control" value="<?php echo $row['lname']; ?>">
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Username</label>
                                <input type="text" name="uname" class="input-sm validate[required] form-control" value="<?php echo $row['uname']; ?>">
                            </div>
                        </div>
						<div class="row">
                            <div class="col-md-4 form-group">
                                <label>Password</label>
                                <input type="text" name="upass" class="input-sm validate[required] form-control" value="<?php echo $row['upass']; ?>">
                            </div>
                            
							<div class="col-md-4 form-group">
                                <label>Phone</label>
                                <input type="text" name="phone" class="input-sm validate[required] form-control" value="<?php echo $row['phone']; ?>">
                            </div>
							<div class="col-md-4 form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="input-sm validate[required] form-control" value="<?php echo $row['email']; ?>">
                            </div>
                            
                        </div>
						<div class="row">
                            <div class="col-md-3 form-group">
                                <label>Occupation</label>
                                <input type="text" name="work" class="input-sm validate[required] form-control" value="<?php echo $row['work']; ?>">
                            </div>
                            <div class="col-md-2 form-group" id="date-time">
							
                            <label>Date of Birth</label>
                            <div class="input-icon datetime-pick date-only">
                                <input data-format="dd/MM/yyyy" name="dob" type="text" value="<?php echo $row['dob']; ?>" class="form-control input-sm" />
                                <span class="add-on">
                                    <i class="sa-plus"></i>
                                </span>
                            </div>
							</div>
							
							<div class="col-md-2 form-group">
                                <label>Marital Status</label>
                                <select name="marry" class="form-control input-sm validate[required]">
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Widowed">Widowed</option>
                                    <option value="Divorced">Divorced</option>
                                </select>
                            </div>
							<div class="col-md-2 form-group">
                                <label>Gender</label>
                                <select  name="sex" class="form-control input-sm validate[required]">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
							<div class="form-group col-md-3">
								<label>Address</label>
								<textarea name="addr" class="input-sm validate[required] form-control" value="<?php echo $row['addr']; ?>" placeholder="<?php echo $row['addr']; ?>"></textarea>
							</div>
                        </div>
						<div class="row">
                            <div class="col-md-3 form-group">
                                <label>Account Type</label>
                                <select name="type" class="form-control input-sm validate[required]">
                                    <option value="Savings">Savings</option>
                                    <option value="Current">Current</option>
                                 </select>
                            </div>
							<div class="col-md-3 form-group" id="date-time">
							
                            <label>Registration Date</label>
                            <div class="input-icon datetime-pick date-only">
                                <input data-format="dd/MM/yyyy" type="text" value="<?php echo $row['reg_date']; ?>" class="form-control input-sm" />
                                <span class="add-on">
                                    <i class="sa-plus"></i>
                                </span>
                            </div>
							</div>
                            <div class="col-md-3 form-group">
                                <label>Total Balance</label>
                                <input type="number" name="t_bal" class="input-sm validate[required] form-control" value="<?php echo $row['t_bal']; ?>">
                            </div>
							<div class="col-md-3 form-group">
                                <label>Available Balance</label>
                                <input type="number" name="a_bal" class="input-sm validate[required] form-control" value="<?php echo $row['a_bal']; ?>">
                            </div>
						</div>
						<div class="row">
						<div class="col-md-3 form-group">
							<label>Account Number</label>
							 <input type="number" name="acc_no" class="input-sm validate[required] form-control" value="<?php echo $row['acc_no']; ?>">
                        </div>
						<div class="col-md-2 form-group">
							<label>COT</label>
							 <input type="text" name="cot" class="input-sm validate[required] form-control" value="<?php echo $row['cot']; ?>">
                        </div>
						<div class="col-md-2 form-group">
							<label>IMF</label>
							 <input type="text" name="tax" class="input-sm validate[required] form-control" value="<?php echo $row['tax']; ?>">
                        </div>
					
						
							 <input type="text" name="imf" class="input-sm validate[required] form-control" value="<?php echo $row['imf']; ?>"hidden>
                       
						<div class="col-md-3 form-group">
							<label>Currency</label>
							 <input type="text" name="currency" class="input-sm validate[required] form-control" value="<?php echo $row['currency']; ?>">
                        </div>
						
						
							<div class="col-md-2 form-group">
							<label>pin auth</label>
							 <input type="text" name="pin_auth" class="input-sm validate[required] form-control" value="<?php echo $row['pin_auth']; ?>">
                        </div>
						
							
							 <input type="text" name="pin" class="input-sm validate[required] form-control" value="<?php echo $row['pin']; ?>" hidden>
                        
						<div class="col-md-2 form-group">
						
							 <input type="text" name="status" class="input-sm validate[required] form-control" value="Active" hidden>
</div>
						
							 <input type="text" name="verify" class="input-sm validate[required] form-control" value="Y" Hidden>
							 
                        	
					
						</div>
                            
                        </div>
                        
                        
                       
                        <input class="btn btn-info " type="submit" name="update" value="Approve Account">
                        
                    </form>
              
               
               
               
               
               
               
               
          </div>
        </div>
      </div>
     </div>
 
    
       <?php include 'foot.php'; ?>