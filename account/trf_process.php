<?php
session_start();
require('df/dbconnect.php');
require_once 'df/controller.php';
 if (!isset($_SESSION['uname'])) {
    header("Location: login.php");
    exit();
}

$reg_user = new USER();
		 	 
$stmt = $reg_user->runQuery("SELECT * FROM account WHERE uname=:uname");
$stmt->execute(array(":uname" => $_SESSION['uname']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
  

if(isset($_POST['transfer'])){
	$email = $row['email'];
	
	$amount = trim($_POST['amount']);
	$amount = strip_tags($amount);
	$amount = htmlspecialchars($amount);
	
	$acc_no = trim($_POST['acc_no']);
	$acc_no = strip_tags($acc_no);
	$acc_no = htmlspecialchars($acc_no);
	
	$acc_name = trim($_POST['acc_name']);
	$acc_name = strip_tags($acc_name);
	$acc_name = htmlspecialchars($acc_name);
	
	$bank_name = trim($_POST['bank_name']);
	$bank_name = strip_tags($bank_name);
	$bank_name = htmlspecialchars($bank_name);
	
	$swift = trim($_POST['swift']);
	$swift = strip_tags($swift);
	$swift = htmlspecialchars($swift);
	
	$routing = trim($_POST['routing']);
	$routing = strip_tags($routing);
	$routing = htmlspecialchars($routing);
		
	$type = trim($_POST['type']);
	$type = strip_tags($type);
	$type = htmlspecialchars($type);
	
	$remarks = trim($_POST['remarks']);
	$remarks = strip_tags($remarks);
	$remarks = htmlspecialchars($remarks);
	
	$cout = trim($_POST['cout']);
	$cout = strip_tags($cout);
	$cout = htmlspecialchars($cout);
	
	$transtype = trim($_POST['transtype']);
	$transtype = strip_tags($transtype);
	$transtype = htmlspecialchars($transtype);
	
	
		if($reg_user->temp($email,$amount,$acc_no,$acc_name,$bank_name,$swift,$routing,$type,$remarks,$cout,$transtype)){
if (isset($_SESSION['uname']))
	     $codeq = substr(number_format(time() * rand(), 0, '', ''), 0, 6);
 
    $uname = $_SESSION['uname'];

    $queri = " UPDATE account SET tmp_otp = '$codeq' WHERE uname ='$uname'";
    $resulti = mysqli_query($connection, $queri) or die(mysqli_error($connection));
 
 $stmt = $reg_user->runQuery("SELECT * FROM account WHERE uname = '$uname'");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

 
      $sender = "$bank_site_name"; /* sender id */
 
    
$stmt = $reg_user->runQuery("SELECT * FROM bank_settings WHERE id = '1'");
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC); 
$bank_site_name  = $row["bank_site_name"];
$bank_site_phone  = $row["bank_site_phone"];
$bank_site_logo  = $row["bank_site_logo"];
$bank_site_email  = $row["bank_site_email"];
$bank_site_address  = $row["bank_site_address"];
$bank_site_domain  = $row["bank_site_domain"];
  
 

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
								
								<strong style='color:darkgreen; font-weight:900;'><u>TRANSACTION VERIFICATION</u></strong></td>
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
                               Please use the One Time Password OTP below  to complete your transaction
                                </td>
                            </tr>
                            <tr><td height='12' colspan='2' style='font-size: 1px;'><hr></td></tr>
                            
                                      
                        <tr><td height='12' align='left' style='font-size: 18px; line-height: 28px; font-weight:700; color:black;'>OTP CODE:</td>
						<td style='font-size: 22px; font-weight:700; color:#2e7ca2;'>$codeq</td></tr> 
                                      
             
        
    	        
                             <tr><td class='wls-5h' height='60' align='left'  colspan='2'  style='font-size: 18px; color:red;'>-</td><td>&nbsp;</td></tr> 
	                        
	                         <tr><td class='wls-5h' height='60'  align='left' colspan='2' style='font-size: 20px; color:#2e7ca2;'><strong>$bank_site_name</strong></td></tr>
    	             
    	             
							<tr>
                                <td style='color:white; background-color:#2e7ca2; padding:10px;  text-align:center;' class='w3l-p2' colspan='2' style='font-family:  Candara, sans-serif; font-size: 14px; line-height: 18px; text-align:center;' class='scale-center-both'>
                                   OUR ADDRESS: $bank_site_address 
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
    

  
    


$subject = "APPROVE TRANSFER";
  $reg_user->send_mail($row['email'], $message, $subject);
      $uname = $_SESSION['uname'];
$stmt = $reg_user->runQuery("SELECT * FROM account WHERE uname = '$uname'");
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

	     $reg_user->send_mail($row['email'], $message, $subject);
        $phone = preg_replace('/[^0-9]/', '', $row['phone']);
        $mobile_msg = "Dear " . $row['fname'] . ", Please use the One Time Passcode (OTP): " . $codeq . " to complete your Transfer process";
        //$reg_user->otp($phone,$mobile_msg);
       
// 	header("Location: otp_verify.php");
	echo "<script>window.location.href = 'otp_verify.php' </script>";
	}
	
}
	

?>
<?php


if (isset($_POST['acc_name'])) { 
    $_SESSION['acc_name'] = $_POST['acc_name'];
}

if (isset($_POST['amount'])) { 
    $_SESSION['amount'] = $_POST['amount'];
}
if (isset($_POST['racc_no'])) { 
    $_SESSION['racc_no'] = $_POST['racc_no'];
}
 
if (isset($_POST['bank_name'])) { 
    $_SESSION['bank_name'] = $_POST['bank_name'];
}
if (isset($_POST['type'])) { 
    $_SESSION['type'] = $_POST['type'];
}
if (isset($_POST['swift'])) { 
    $_SESSION['swift'] = $_POST['swift'];
}
if (isset($_POST['cout'])) { 
    $_SESSION['cout'] = $_POST['cout'];
}

if (isset($_POST['remarks'])) { 
    $_SESSION['remarks'] = $_POST['remarks'];
}

?>
 
 <?php include 'df1.php'; ?>


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
            <span>Processing</span>
        </li>
    </ul>
    <!--------------------
    END - Breadcrumbs
    -------------------->

    <div class="content-i">
        <div class="content-box">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="element-wrapper text-center">
                        <div class="element-box">
                            <form action="trf_process.php" method="post">
                                <h5 class="text-primary font-weight-bold">TRANSACTION PROCESSING...</h5>
                                <div class="form-desc"></div>
                                <div class="form-group mt-3"></div>

                                <p class="text-success font-weight-bold" style="font-size: 18px;">
                                    You are transferring <span class="text-danger"><?php echo $row['currency']; ?><?php echo $_SESSION['amount']; ?>.00</span>
                                    <br>TO<br>
                                    <?php echo $_SESSION['acc_name']; ?> 
                                    at <span class="text-dark"><?php echo $_SESSION['bank_name']; ?></span>
                                    <br><span style="color:blue;">
                                        (The amount will be converted to the selected currency during the transfer)
                                    </span>
                                </p>

                                <input type="hidden" value="<?php echo $_SESSION['remarks']; ?>" name="remarks" required>
                                <input type="hidden" value="<?php echo $_SESSION['bank_name']; ?>" name="bank_name" required>
                                <input type="hidden" value="<?php echo $_SESSION['amount']; ?>" name="amount" required>
                                <input type="hidden" value="<?php echo date("h:i A d M Y"); ?>" name="routing" required>
                                <input type="hidden" value="<?php echo $_SESSION['acc_name']; ?>" name="acc_name" required>
                                <input type="hidden" value="<?php echo $_SESSION['racc_no']; ?>" name="acc_no" required>
                                <input type="hidden" value="<?php echo $_SESSION['swift']; ?>" name="swift" required>
                                <input type="hidden" value="<?php echo $_SESSION['cout']; ?>" name="cout" required>
                                <input type="hidden" name="type" value="2">
                                <input type="hidden" name="email" value="<?php echo $row['email']; ?>"/>
                                <input type="hidden" name="transtype" value="Wire Transfer" required>

                                <button type="submit" name="transfer" class="btn btn-primary" style="background-color: #04327c; border-color: #04327c;">CONTINUE</button>
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
