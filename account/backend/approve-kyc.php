<?php
session_start();
require_once ('class.admin.php');
include_once ('session.php');

$reg_user = new USER();

if(!isset($_SESSION['email'])){
	
header("Location: login.php");

exit(); 
}

$email = "digitalforestict@gmail.com"; 


$stmt = $reg_user->runQuery("SELECT * FROM account");
$stmt->execute();

$stmt2 = $reg_user->runQuery("SELECT * FROM account");
$stmt2->execute();

$stmt3 = $reg_user->runQuery("SELECT * FROM account");
$stmt3->execute();

if(isset($_POST['set']))
{
	
	$uname = trim($_POST['uname']);
	$uname = strip_tags($uname);
	$uname = htmlspecialchars($uname);
	
	$kyc = trim($_POST['kyc']);
	$kyc = strip_tags($kyc);
	$kyc = htmlspecialchars($kyc);
	
	$phone_verify = trim($_POST['phone_verify']);
	$phone_verify = strip_tags($phone_verify);
	$phone_verify = htmlspecialchars($phone_verify);
	
			$set= $reg_user->runQuery("UPDATE account SET uname = '$uname', kyc = '$kyc', phone_verify = '$phone_verify' WHERE uname = '$uname'");
			$set->execute();
			
			$id = $reg_user->lasdID();		
			
			
			
			$msg= "<div class='alert alert-info'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Settings Saved Successfully to <b>$kyc</b> and $phone_verify!</strong> 
			  </div>";
			  
			  
			  
			     
      
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
								
								<strong style='color:#2e7ca2'><u>KYC DOCUMENT APPROVAL</u></strong></td>
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
                           Congratulations, Your KYC Verification Document/ID 
	 have been approved successfully!
                                </td>
                            </tr>
                 
             
                            <tr><td height='12' colspan='2' style='font-size: 1px;'><hr></td></tr>
                               <tr>
                                <td class='w3l-p2' colspan='2' style='font-family: Candara, sans-serif; color:black; font-size: 18px; line-height: 28px;' class='scale-center-both'>
                      Your can now access your online banking dashboard and get started with your transaction activities
                                </td>
                            </tr>
                                      
                 
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
 

            $subject = "Hello customer - Your KYC Verification Document have been Approved!"; 
            $send_otp_mobile = preg_replace('/[^0-9]/', '', $_POST['phone']);
            $reg_user->send_mail($email, $messag, $subject);
            //$reg_user->otp($send_otp_mobile, $subject);
         

}

?>

 <?php include 'headeradmin.php'; ?>
 

 <!---begin of Mobile View Here   only from Digital Forest Team-->
 
       <?php include 'menu.php'; ?>
  
  <!---End of Mobile View Here   only from Digital Forest Team-->
  
 
      <script type="text/javascript" src="paginator.js"></script>
        <script type="text/javascript" src="table.js"></script>
     
      <br><br><br><br><br><br><br>
  
    <div class="container-fluid mt--7">
     <!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card shadow" >
            <div class="card-header border-0">
              <h3 class="mb-0"><a href=""   class="btn btn-danger">UPLOAD USER ACCOUNT FOR KYC APPROVAL</a></h3>
            </div>
          
           <div class="card-body">
               
               <?php if(isset($msg)) echo $msg;  ?> 
              
            
              <form method="POST">
               
                 <div class="col-lg-6">
                      <div class="form-group">
				 
						<label>Select User</label>
						<select name="uname" class="form-control input-sm validate[required]">
						<?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)){?>
							<option value="<?php echo $row['uname']; ?>"><?php echo $row['fname']; ?> <?php echo $row['mname']; ?> <?php echo $row['lname']; ?></option>
						<?php } ?>
					   </select>
				 
			 </div></div>
			
			  <div class="col-lg-6">
                      <div class="form-group">
						<label>Select Owner Account No </label>
							<select name="kyc" class="form-control input-sm validate[required]">
						<?php while($row = $stmt2->fetch(PDO::FETCH_ASSOC)){?>
							<option value="<?php echo $row['acc_no']; ?>"><?php echo $row['fname']; ?> || <?php echo $row['acc_no']; ?></option>
						<?php } ?>
					   </select>
					 
					 <br>
					 		<label>Select Action <span style="color:red;">APPROVE MEANS USER CAN LOGIN</span></label>
						<select  name="phone_verify" class="form-control input-sm validate[required]">
							<option value="1">APPROVE KYC ID</option>
							<option value="2">REJECT/REQUEST KYC ID</option>  
						</select>
				 
				 <br>
				 	<label>Select Owner Email </label>
							<select name="email" class="form-control input-sm validate[required]">
						<?php while($row = $stmt3->fetch(PDO::FETCH_ASSOC)){?>
							<option value="<?php echo $row['email']; ?>"><?php echo $row['fname']; ?> || <?php echo $row['email']; ?></option>
						<?php } ?>
					   </select>
					   
					   
                </div></div>
                <br/>
					<button type="submit" name="set" class="btn btn-success ">Update KYC Acc/No</button>
				</form>
               
               <hr>
               	<article>
	 
				</article>
               
               
               
               
          </div>
        </div>
      </div>
     </div>
 
    
       <?php include 'foot.php'; ?>