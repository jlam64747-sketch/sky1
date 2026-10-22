<?php
session_start();
include_once ('df/session.php');
require_once 'df/controller.php';
if (!isset($_SESSION['uname'])) {
    header("Location: login.php");
    exit();
}


 
$reg_user = new USER();

$stmt = $reg_user->runQuery("SELECT * FROM account WHERE uname=:uname");
$stmt->execute(array(":uname" => $_SESSION['uname']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

 
$email = $_row['email'];

$temp = $reg_user->runQuery("SELECT * FROM temp_transfer WHERE email = '$email' ORDER BY id DESC LIMIT 1");
$temp->execute();
$rows = $temp->fetch(PDO::FETCH_ASSOC);
$tempa = $reg_user->runQuery("SELECT * FROM transfer WHERE email = '$email' ORDER BY id DESC LIMIT 1");
$tempa->execute();
$rowc = $tempa->fetch(PDO::FETCH_ASSOC);

$ego = $reg_user->runQuery("SELECT t_bal FROM account WHERE uname=:uname");
$stmt1 = $reg_user->runQuery("SELECT a_bal FROM account WHERE uname=:uname");
$ego->execute(array(":uname" => $_SESSION['uname']));
$stmt1->execute(array(":uname" => $_SESSION['uname']));
$owo = $ego->fetch(PDO::FETCH_ASSOC);
$row1 = $stmt1->fetch(PDO::FETCH_ASSOC);

$bal = $row['t_bal']; 
$baa = $row['a_bal'];
$amount = $rows['amount'];

$t_pin = $row['t_pin'];
$tmp_otp = $row['tmp_otp'];


if (isset($_POST['code'])) {
    $email = $row['email'];
    $amount = $_POST['amount'];
    $acc_no = $_POST['acc_no'];
    $acc_name = $_POST['acc_name'];
    $bank_name = $_POST['bank_name'];
    $swift = $_POST['swift'];
    $routing = $_POST['routing'];
    $type = $_POST['type'];
    $remarks = $_POST['remarks'];
    $bal = $row['t_bal'];
    $baa = $row['a_bal'];
    $cout = $_POST['cout'];
    $transtype = $_POST['transtype'];

    $t_code = $_POST['t_code'];


    if ($t_code != $tmp_otp) {
        header("Location: otp_verify.php?errorotp");
        exit();
    } elseif ($bal < $amount && $baa < $amount) {
        $bal = $row['t_bal'];
        $baa = $row['a_bal'];
        $amount = $rows['amount'];
        header("Location: otp_verify.php?insufficient");
        exit();
    } else {
        if ($reg_user->transfer($email, $amount, $acc_no, $acc_name, $bank_name, $swift, $routing, $type, $remarks, $cout, $transtype)) {
            $email = $row['email'];
            $fname = $row['fname'];
            $mname = $row['mname'];
            $lname = $row['lname'];
            $currency = $row['currency'];
            $amount = $_POST['amount'];
            $acc_no = $row['acc_no'];
            $phone = $row['phone'];
            $acc_name = $_POST['acc_name'];
            $bank_name = $_POST['bank_name'];
            $swift = $_POST['swift'];
            $routing = $_POST['routing'];
            $type = $_POST['type'];
            $date = $rowc['date'];
            $remarks = $_POST['remarks'];
            $cout = $_POST['cout'];
            $transtype = $_POST['transtype'];


            $bal = $row['t_bal'];
            $baa = $row['a_bal'];
            $total = $bal - $amount;
            $avail = $baa - $amount;

            $updatebal = $reg_user->runQuery("UPDATE account SET t_bal = '$total', a_bal = '$avail' WHERE email = '$email'");
            $updatebal->execute();


 
	
	$stmt = $reg_user->runQuery("SELECT * FROM bank_settings WHERE id = '1'");
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC); 
$bank_site_name  = $row["bank_site_name"];
$bank_site_phone  = $row["bank_site_phone"];
$bank_site_logo  = $row["bank_site_logo"];
$bank_site_email  = $row["bank_site_email"];
$bank_site_address  = $row["bank_site_address"];
$bank_site_domain  = $row["bank_site_domain"];
  
   $sender = "$bank_site_name"; /* sender id */

  $message = "
	
				
           <link href='https://fonts.googleapis.com/css?family=Kreon:400,700|Playfair+Display:400,400i,700,700i|Raleway:400,400i,700,700i|Roboto:400,400i,700,700i' rel='stylesheet' />
         
 

</div>   	 
    <!-- INTRODUCTION -->
<table width='100%' border='0' cellspacing='0' cellpadding='0' align='center'>
    <tr>
        <td bgcolor='#fbfdfd'>
            <table  width='670'  cellspacing='0' border-color='grey' cellpadding='9' align='center'  class='scale'>
                <tr>
                    <td bgcolor='#FFFFFF'>
                 
                        <table width='600' border='0' cellspacing='0' cellpadding='0' align='center' class='agile1 scale'>
                            
                           <tr ><td colspan='2' class='wls-5h' style='color:white; background-color:white; 
						   height: 200px; text-align:center; border-radius:7px; border-color:red; border-weight:2px;'>
						   <img src='$bank_site_logo' alt='LOGO' data-default='placeholder' data-max-width='120' width='170' height='40' >
						   </td></tr> 
                          
                            <tr>
                                <td class='agile-main' align='center' colspan='2' style='font-family:Bell Gothic Std; color: green; font-size: 22px;' class='scale-center-both'>
								
								<strong style='color:darkgreen; font-weight:900;'><u>TRANSACTION NOTIFICATION</u></strong></td>
                            
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
                            
                                The Following Transaction has occured on your Account, the details of the transaction is listed below:-
                                </td>
                            </tr>
                            <tr><td height='12' colspan='2' style='font-size: 1px;'><hr></td></tr>
                            
                                      
                         <tr><td height='12' align='left' style='font-size: 14px; line-height: 28px; font-weight:700; color:black;'>TRANSACTION TYPE:</td> <td style='font-size: 16px; font-weight:700; color:#2e7ca2;'>DEBIT/ E-CHANNEL</td></tr>
                         <tr><td height='12' align='left' style='font-size: 14px; line-height: 28px; font-weight:700; color:black;'>ACCOUNT NUMBER:</td> <td style='font-size: 16px; font-weight:700; color:#2e7ca2;'> $acc_no</td></tr>
                        <tr><td height='12'align='left' style='font-size: 14px; line-height: 28px; font-weight:700;color:black;'>AMOUNT TRANSFERED: </td>           <td style='font-size: 16px; font-weight:700; color:#2e7ca2;'>$currency $amount</td></tr>
                        <tr><td height='12' align='left' style='font-size: 14px; line-height: 28px; font-weight:700; color:black;'>DATE OF TRANSACTION:</td> <td style='font-size: 16px; font-weight:700; color:#2e7ca2;'> $routing</td></tr>
                        <tr><td height='12' align='left' style='font-size: 14px; line-height: 28px; font-weight:700; color:black;'>NARATION: </td>   <td style='font-size: 16px; font-weight:700; color:#2e7ca2;'> $remarks</td></tr>  
                        <tr><td height='12' align='left' style='font-size: 14px; line-height: 28px; font-weight:700; color:black;'>BALANCE:</td> <td style='font-size: 16px; font-weight:700; color:#2e7ca2;'> $currency $avail</td></tr>
                        <tr><td height='12' align='left' style='font-size: 14px; line-height: 28px; font-weight:700; color:black;'>STATUS</td>  <td style='font-size: 16px; font-weight:700; color:green;'>PENDING</td></tr>
                                 
                                      
             
        
    	        
                             <tr><td class='wls-5h' height='60' align='left'  colspan='2'  style='font-size: 18px; color:red;'>-</td><td>&nbsp;</td></tr> 
	                        
	                         <tr><td class='wls-5h' height='60'  align='left' colspan='2' style='font-size: 20px; color:#2e7ca2;'><strong>$bank_site_name</strong></td></tr>
    	             
    	             
							<tr>
                                <td style='color:black; background-color:#2e7ca2; padding:10px; border-radius:7px; text-align:center;' class='w3l-p2' colspan='2' style='font-family:  Candara, sans-serif; font-size: 14px; line-height: 18px; text-align:center;' class='scale-center-both'>
                                   An email really coming from $bank_site_name  will not ask you for sensitive information like your password, bank account or credit card details.
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


            $subject = "[Debit Transaction] - $bank_site_name.";

          
            $reg_user->send_mail($email, $message, $subject);

            $phonee = preg_replace('/[^0-9]/', '', $row['phone']);

            $acc_last_four = substr($row['acc_no'], -4);
            $amoun_sms = $currency . " " . $amount;
            $balance_sms = $currency . " " . $bal;
            $remark_sms = substr($remarks, 0, 15);

            $reg_user->send_mail($email, $message, $subject);
            $mobile_msg = "Transfer completed, Acct: **".$acc_last_four.",  Amt: " .$amoun_sms. ", Desc:".$remark_sms. ", Date:".$date.", Avail Bal:".$balance_sms;
            //$reg_user->otp($phonee, $mobile_msg);

            $_SESSION['otp_verify'] = true;
            // header("Location: trf_success.php");
            echo "<script>window.location.href = 'trf_success.php' </script>";
            exit();
        }
    }
}



 
?>
  
<?php include 'df1.php'; ?>

<?php echo $t_code ?>
  

<div class="content-w">
    <!--------------------
    START - Breadcrumbs
    -------------------->
    <ul class="breadcrumb text-center">
        <li class="breadcrumb-item">
            <a href="dashboard.php">Home</a>
        </li>
        <li class="breadcrumb-item">
            <a href="#">Transfer</a>
        </li>
        <li class="breadcrumb-item">
            <span>Verification</span>
        </li>
    </ul>
    <!--------------------
    END - Breadcrumbs
    -------------------->

    <div class="content-i">
        <div class="content-box">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="element-wrapper text-center"><div class="element-box">
                            <?php
                            if(isset($_GET['errorotp'])) {
                                echo "
                                <div class='alert'>
                                    <button class='close' data-dismiss='alert'>&times;</button>
                                    <strong>Incorrect OTP Code/Transaction Pin</strong> 
                                </div>
                                ";
                            }
                            if(isset($_GET['insufficient'])) {
                                echo "
                                <div class='alert'>
                                    <button class='close' data-dismiss='alert'>&times;</button>
                                    <strong>Sorry, the amount is too little, please transfer a higher amount.</strong> 
                                </div>
                                ";
                            }
                            ?>
                            <form action="#" method="post">
                                <h5 class="text-primary font-weight-bold">TRANSACTION VERIFICATION...</h5>
                                <div class="form-desc"></div>
                                <div class="form-group mt-3"></div>

                                <center>
                                    <strong style="color:black;">
                                        <h5>Enter 6 digit verification code sent to <br>
                                            <a href="mailto:<?php echo $row['email']; ?>" style="color:green;">
                                            <?php
                                            function partiallyHideEmail($email) {
                                                $em   = explode("@",$email);
                                                $name = implode(array_slice($em, 0, count($em)-1), '@');
                                                $len  = floor(strlen($name)/2);
                                                return substr($name,0, $len) . str_repeat('*', $len) . "@" . end($em);   
                                            }
                                            echo partiallyHideEmail($row['email']);
                                            ?>
                                            </a>
                                            <strong style="font-weight:700;">OR</strong> 
                                            <a href="tel:<?php echo $row['phone']; ?>" style="color:green;">
                                            <?php
                                            function mask_mobile_no($number) {
                                                return substr($number, 0, 2) . '******' . substr($number, -2);
                                            }
                                            echo mask_mobile_no($row['phone']);
                                            ?> 
                                            </a> 
                                        </h5>
                                    </strong>
                                </center>
                                <br>		
                                <input type="hidden" class="form-control" value="<?php echo $_SESSION['remarks']; ?>" name="remarks" required readonly>
                                <input type="hidden" class="form-control" value="<?php echo $_SESSION['amount']; ?>" name="amount" required readonly>
                                <input type="hidden" class="form-control" value="<?php echo $_SESSION['acc_name']; ?>" name="acc_name" required readonly>
                                <input type="hidden" class="form-control" value="<?php echo $_SESSION['racc_no']; ?>" name="acc_no" required readonly>
                                <input type="hidden" class="form-control" value="<?php echo $_SESSION['bank_name']; ?>" name="bank_name" required readonly>
                                <input type="hidden" class="form-control" value="<?php echo $_SESSION['swift']; ?>" name="swift" required readonly>
                                <input type="hidden" class="form-control" value="<?php echo date("h:i A d M Y"); ?>" name="routing" required readonly>
                                <input type="hidden" class="form-control" value="<?php echo $_SESSION['cout']; ?>" name="cout" required readonly>
                                <input type="hidden" class="form-control" name="uname" value="<?php echo $row['email']; ?>"/>
                                <input type="hidden" class="form-control" value="Wire Transfer" name="transtype" required>
                                <input type="hidden" name="type" value="2">
                                <input type="hidden" name="email" value="<?php echo $row['email']; ?>">  
                                
                                <div class="form-group">
                                    <label for="">Enter OTP</label>
                                    <input class="form-control" type="password" name="t_code" required id="smscode" placeholder="••••••" maxlength="6">
                                </div>
                                
                                <button type="submit" id="mybutton" name="code" class="btn btn-primary" style="background-color: #04327c; border-color: #04327c;">VERIFY OTP</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        background-color: #ffffff;
        font-family: Arial, sans-serif;
    }
    .content-w {
        padding: 20px;
    }
    .breadcrumb {
        background: none;
        padding: 0;
        margin-bottom: 20px;
    }
    .breadcrumb-item + .breadcrumb-item::before {
        content: ">";
    }
    .element-wrapper {
        background: #ffffff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .element-header {
        color: #04327c;
    }
    .element-box {
        margin-top: 20px;
    }
</style>

<?php include 'df2.php'; ?>
