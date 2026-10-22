<?php

session_start();
require('df/dbconnect.php');
require_once 'df/controller.php';

$reg_user = new USER();




//3. If the form is submitted or not.
//3.1 If the form is submitted
if (isset($_POST['uname']) and isset($_POST['upas'])) {
//3.1.1 Assigning posted values to variables.

    $uname = $_POST['uname'];
    $upas = $_POST['upas']; 
    $upas = md5($upas); 

//3.1.2 Checking the values are existing in the database or not
    $query = "SELECT * FROM account WHERE uname='$uname' and upas='$upas'";
    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
    $count = mysqli_num_rows($result);


    $stmt = $reg_user->runQuery("SELECT * FROM account WHERE uname = '$uname'");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $log = $reg_user->runQuery("UPDATE account SET logins = logins + 1 WHERE '$uname'");
   


    $status = $row['status'];
//3.1.2 If the posted values are equal to the database values, then session will be created for the user.
    if ($count == 0) {
        header("Location: login.php?wrong");
        exit;
    } else {
        if (in_array($status, ['Inactive', 'Locked', 'Dormant'])) {
            header("Location: login.php?status=$status");
            exit;
        }
      else { 
        $_SESSION['uname'] = $uname;
         $_SESSION['uname'] = $uname;
        
    }
}
}
//3.1.4 if the user is logged in Greets the user with message
if (isset($_SESSION['uname'])) {
    $code = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
    $sender = "$bank_site_name"; /* sender id */
    
  
$stmt = $reg_user->runQuery("SELECT * FROM bank_settings WHERE id = '1'");
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC); 
$bank_site_name  = $row["bank_site_name"];
$bank_site_phone  = $row["bank_site_phone"];
$bank_site_logo  = $row["bank_site_logo"];
$bank_site_uname  = $row["bank_site_uname"];
$bank_site_address  = $row["bank_site_address"];
$bank_site_domain  = $row["bank_site_domain"];
  
  

  $message = "
	
				
           <link href='https://fonts.googleapis.com/css?family=Kreon:400,700|Playfair+Display:400,400i,700,700i|Raleway:400,400i,700,700i|Roboto:400,400i,700,700i' rel='stylesheet' />
         
 

</div>   	 
    <!-- INTRODUCTION -->
<table width='100%' border='0' cellspacing='0' cellpadding='0' align='center'>
    <tr>
        <td bgcolor='#fbfdfd'>
            <table  width='550' border='1px' cellspacing='0' border-color='blue' cellpadding='9' align='center'  class='scale'>
                <tr>
                    <td bgcolor='#FFFFFF'>
                 
                        <table width='540' border='0' cellspacing='0' cellpadding='0' align='center' class='agile1 scale'>
                            
                           <tr ><td colspan='2' class='wls-5h' style='color:white; background-color:grey; 
						   height: 200px; text-align:center; border-radius:7px; border-color:red; border-weight:2px;'><h2><strong>
						   <img src='$bank_site_logo' alt='LOGO' data-default='placeholder' data-max-width='120' width='170' height='40' >
						  
                        <br>
                          $bank_site_name
                          
                          </strong>
                           
                           </h2>
						   
						   
						   
						   </td></tr> 
                            <tr ><td colspan='2' height='12' style='font-size: 1px;'>&nbsp;</td></tr>
                            <tr>
                                <td class='agile-main' align='center' colspan='2' style='font-family:Bell Gothic Std; color: green; font-size: 22px;' class='scale-center-both'>
								
								<strong style='color:#0000FF; font-weight:900;'><u>OTP VERIFICATION</u></strong></td>
                            </tr>
                            <tr><td height='12' style='font-size: 1px;'>&nbsp;</td></tr>
							
							   <tr>
                                <td class='w3l-p2' colspan='2' style='font-family: Candara, sans-serif; color:red; font-size: 20px; line-height: 18px;' class='scale-center-both'>
                                   Dear Customer,
                                </td>
                            </tr>
							<tr><td height='12' style='font-size: 1px;'>&nbsp;</td></tr>
							
                           <tr>
                                <td class='w3l-p2' colspan='2' style='font-family: Candara, sans-serif; color:blue; font-size: 18px; line-height: 28px;' class='scale-center-both'>
                               Please use the One Time Password OTP below  to complete your Login Process
                                </td>
                            </tr>
                            <tr><td height='12' colspan='2' style='font-size: 1px;'><hr></td></tr>
                            
                                      
                        <tr><td height='12' align='left' style='font-size: 18px; line-height: 28px; font-weight:700; color:black;'>2 FACTOR CODE:</td>
						<td style='font-size: 22px; font-weight:700; color:#2e7ca2;'>$code</td></tr> 
                                      
             
        
    	        
                             <tr><td class='wls-5h' height='60' align='left'  colspan='2'  style='font-size: 18px; color:red;'>-</td><td>&nbsp;</td></tr> 
	                        
	                         <tr><td class='wls-5h' height='60'  align='left' colspan='2' style='font-size: 20px; color:#2e7ca2;'><strong>$bank_site_name</strong></td></tr>
    	             
    	             
							<tr>
                                <td style='color:black; background-color:#2e7ca2; padding:10px; border-radius:7px; text-align:center;' class='w3l-p2' colspan='2' style='font-family:  Candara, sans-serif; font-size: 14px; line-height: 18px; text-align:center;' class='scale-center-both'>
                                   An uname really coming from $bank_site_name  will not ask you for sensitive information like your password, bank account or credit card details.
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
 
    $uname = $_SESSION['uname'];

    $queri = " UPDATE account SET tmp_otp = '$code' WHERE uname ='$uname'";
    $resulti = mysqli_query($connection, $queri) or die(mysqli_error($connection));

    $subject = "Login Verification";
    $stmt = $reg_user->runQuery("SELECT * FROM account WHERE uname = '$uname'");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (isset($_SESSION['uname']) && $row['phone_verify'] == 1) {
       header("Location: dashboard.php");
		exit;
    } 
    
    
    
    else {
        $reg_user->send_mail($row['uname'], $message, $subject);
        header('Location: 2fa.php');
    }
} else {
    
}
 
?>