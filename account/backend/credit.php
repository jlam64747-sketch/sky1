<?php
session_start();
require_once('class.admin.php');
include_once('session.php');

$reg_user = new USER();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$stmt = $reg_user->runQuery("SELECT * FROM account");
$stmt->execute();

$credit = $reg_user->runQuery("SELECT * FROM account");
$credit->execute();

$mail = $_SESSION['email'];

$ad = $reg_user->runQuery("SELECT * FROM admin WHERE email = :email");
$ad->execute([':email' => $mail]);
$rom = $ad->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['credit'])) {
    $uname = htmlspecialchars(strip_tags(trim($_POST['uname'])));
    $amount = htmlspecialchars(strip_tags(trim($_POST['amount'])));
    $acc_num = htmlspecialchars(strip_tags(trim($_POST['acc_num'])));
    $sender_name = htmlspecialchars(strip_tags(trim($_POST['acc_name'])));
    $remarks = htmlspecialchars(strip_tags(trim($_POST['remarks'])));
    $bank_name = htmlspecialchars(strip_tags(trim($_POST['bank_name'])));
    $routing = htmlspecialchars(strip_tags(trim($_POST['routing'])));
    $cout = htmlspecialchars(strip_tags(trim($_POST['cout'])));

    // Ensure the amount is a valid number
    if (!is_numeric($amount) || $amount <= 0) {
        die('Invalid amount.');
    }

    // Format the date and time
    $formatted_date = date("h:i A d M Y", strtotime($routing));

    if ($reg_user->his($uname, $amount, $sender_name, 1, $remarks, $formatted_date, 'Wire Transfer', 'Processing...')) {
        $read = $reg_user->runQuery("SELECT * FROM account WHERE acc_no = :acc_no");
        $read->execute([':acc_no' => $uname]);
        $show = $read->fetch(PDO::FETCH_ASSOC);

        if ($show) {
            $currency = $show['currency'];
            $acc = $show['acc_no'];
            $fname = $show['fname'];
            $mname = $show['mname'];
            $lname = $show['lname'];
            $email = $show['email'];
            $phone = $show['phone'];
            $tbal = $show['t_bal'];
            $abal = $show['a_bal'];
            $diff = $amount + $tbal;
            $dif = $amount + $abal;

            $credited = $reg_user->runQuery("UPDATE account SET t_bal = :t_bal, a_bal = :a_bal WHERE acc_no = :acc_no");
            $credited->execute([
                ':t_bal' => $diff,
                ':a_bal' => $dif,
                ':acc_no' => $uname
            ]);

            $id = $reg_user->lasdID();

            // Insert a record into the transfer table
            $transfer = $reg_user->runQuery("INSERT INTO transfer (amount, bank_name, acc_name, transtype, acc_no, type, swift, routing, remarks, email, status, date, cout) VALUES (:amount, :bank_name, :acc_name, 'Wire Transfer', :acc_no, 1, '', :routing, :remarks, :email, 'Successful', :date, :cout)");
            $transfer->execute([
                ':amount' => $amount,
                ':bank_name' => $bank_name,
                ':acc_name' => $sender_name,
                ':acc_no' => $acc_num,
                ':routing' => $formatted_date,
                ':remarks' => $remarks,
                ':email' => $email,
                ':date' => $formatted_date,
                ':cout' => $cout
            ]);

            if ($transfer) {
                // Prepare notification email
                $stmt = $reg_user->runQuery("SELECT * FROM bank_settings WHERE id = 1");
                $stmt->execute();
                $row = $stmt->fetch(PDO::FETCH_ASSOC);

                $bank_site_name = $row["bank_site_name"];
                $bank_site_address = $row["bank_site_address"];
                $bank_site_domain = $row["bank_site_domain"];

                $messag = "
                    <link href='https://fonts.googleapis.com/css?family=Kreon:400,700|Playfair+Display:400,400i,700,700i|Raleway:400,400i,700,700i|Roboto:400,400i,700,700i' rel='stylesheet' />
                    <div>   	 
                    <!-- INTRODUCTION -->
                    <table width='100%' border='0' cellspacing='0' cellpadding='0' align='center'>
                        <tr>
                            <td bgcolor='#fbfdfd'>
                                <table width='620' border='0' cellspacing='0' cellpadding='0' align='center' class='scale'>
                                    <tr>
                                        <td bgcolor='#FFFFFF'>
                                            <table width='540' border='0' cellspacing='0' cellpadding='0' align='center' class='agile1 scale'>
                                                <tr><td colspan='2' class='wls-5h' style='color:white; background-color:white; text-align:center; border-radius:0px;'><h1><strong><img src='$bank_site_domain/public/Frontend/images/logo-blue.png' alt='' data-default='placeholder' data-max-width='120' width='200' height='70' ></strong></h1></td></tr> 
                                                <tr><td colspan='2' height='12' style='font-size: 1px;'>&nbsp;</td></tr>
                                                <tr>
                                                    <td class='agile-main' align='center' colspan='2' style='font-family:Bell Gothic Std; color: green; font-size: 22px;' class='scale-center-both'>
                                                        <strong style='color:#2e7ca2'><u>TRANSACTION NOTIFICATION</u></strong>
                                                    </td>
                                                </tr>
                                                <tr><td height='12' style='font-size: 1px;'>&nbsp;</td></tr>
                                                <tr>
                                                    <td class='w3l-p2' colspan='2' style='font-family: Candara, sans-serif; color:red; font-size: 20px; line-height: 18px;' class='scale-center-both'>
                                                        Dear $fname $lname,
                                                    </td>
                                                </tr>
                                                <tr><td height='12' style='font-size: 1px;'>&nbsp;</td></tr>
                                                <tr>
                                                    <td class='w3l-p2' colspan='2' style='font-family: Candara, sans-serif; color:black; font-size: 18px; line-height: 28px;' class='scale-center-both'>
                                                        The Following Transaction has occurred on your Account, the details of the (Cash/Transfer Deposit) transaction are listed below:-
                                                    </td>
                                                </tr>
                                                <tr><td height='12' colspan='2' style='font-size: 1px;'><hr></td></tr>
                                                <tr><td height='12' align='left' style='font-size: 14px; line-height: 28px; font-weight:700; color:black;'>TRANSACTION TYPE:</td> <td style='font-size: 16px; font-weight:700; color:#2e7ca2;'> CREDIT/E-CHANNEL</td></tr>
                                                <tr><td height='12' align='left' style='font-size: 14px; line-height: 28px; font-weight:700; color:black;'>ACCOUNT NUMBER:</td> <td style='font-size: 16px; font-weight:700; color:#2e7ca2;'> $acc</td></tr>
                                                <tr><td height='12'align='left' style='font-size: 14px; line-height: 28px; font-weight:700;color:black;'>AMOUNT TRANSFERRED: </td>           <td style='font-size: 16px; font-weight:700; color:#2e7ca2;'>$currency $amount</td></tr>
                                                <tr><td height='12' align='left' style='font-size: 14px; line-height: 28px; font-weight:700; color:black;'>DATE OF TRANSACTION:</td> <td style='font-size: 16px; font-weight:700; color:#2e7ca2;'> $formatted_date</td></tr>
                                                <tr><td height='12' align='left' style='font-size: 14px; line-height: 28px; font-weight:700; color:black;'>NARRATION: </td>   <td style='font-size: 16px; font-weight:700; color:#2e7ca2;'> $remarks</td></tr>  
                                                <tr><td height='12' align='left' style='font-size: 14px; line-height: 28px; font-weight:700; color:black;'>BALANCE:</td> <td style='font-size: 16px; font-weight:700; color:#2e7ca2;'> $currency $abal</td></tr>
                                                <tr><td height='12' align='left' style='font-size: 14px; line-height: 28px; font-weight:700; color:black;'>STATUS</td>  <td style='font-size: 16px; font-weight:700; color:green;'> SUCCESS</td></tr>
                                                <tr><td height='12' colspan='2' style='font-size: 1px;'><hr></td></tr>
                                                <tr><td height='12' style='font-size: 14px; font-weight:700; color:black;'><strong>AVAILABLE BALANCE:</td> <td style='font-size: 14px; font-weight:700; color:green;'>$currency $diff</strong></td></tr>
                                                <tr><td height='12' colspan='2' style='font-size: 1px;'><hr></td></tr>
                                                <tr><td class='wls-5h' height='60' align='left'  colspan='2'  style='font-size: 18px; color:red;'> Warm Regards,</td><td>&nbsp;</td></tr> 
                                                <tr><td class='wls-5h' height='60'  align='left' colspan='2' style='font-size: 20px; color:#2e7ca2;'><strong>$bank_site_name  </strong></td></tr>
                                                <tr>
                                                    <td class='w3l-p2' colspan='2' style='font-family: Candara, sans-serif; color:red; font-size: 14px; line-height: 18px; text-align:center;' class='scale-center-both'>
                                                        An email really coming from us will not ask you for sensitive information like your password, bank account, or credit card details.
                                                    </td>
                                                </tr>
                                            </table>    
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
                ";

                $subject = '[Credit Notification]';

                $reg_user->send_mail($email, $messag, $subject);

                $msg = "
               <div class='popup'>
                    <div class='modal-dialog modal-sm'>
                        <div style='background-color:grey; border: 1px solid; border-color:grey; border-radius:15px;'>
                            <div class='modal-content'>
                                <div class='modal-header' style='background-color:white;'>
                                    <h5 class='modal-title'></h5>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                                </div>
                                <div class='modal-body' style='background-color:white;'>  
                                    <center>
                                        <img src='../icons/success.gif' height='70px' width='70px' /><hr>
                                        <h3 style='color:green; font-weight:900;'>ACCOUNT FUNDED!</h3>
                                        <form action='index.php' method='POST'> 
                                            <button type='submit' style='font-weight:900;' class='btn btn-success'>CONTINUE</button>
                                        </form>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                ";
            } else {
                $msg = "Failed to record the transfer.";
            }
        } else {
            $msg = "Account not found.";
        }
    } else {
        $msg = "Failed to process the transaction.";
    }
}

mysqli_close($connection);
?>
 <?php include 'headeradmin.php'; ?>
 
 
  
      <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
     <!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card shadow" style="background-color: white; color:black;" >
            <div class="card-header border-0">
              <h3 class="mb-0" style="color:#000;">Fund Customer Account</h3>
            </div>
          
           <div class="card-body">
               
              <?php if (isset($msg)) echo $msg; ?>   
                 <?php if (isset($msg1)) echo $msg1; ?>   
               
<div class="container-fluid">
 


 <form method="POST">
                           
                                <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label>Select Account To Credit</label>
                                        <select name="uname" class="form-control input-sm validate[required]">
<?php while ($rows = $credit->fetch(PDO::FETCH_ASSOC)) { ?>
                                                <option value="<?php echo $rows['acc_no']; ?>"><?php echo $rows['fname']; ?> <?php echo $rows['mname']; ?> <?php echo $rows['lname']; ?></option>
<?php } ?>
                                        </select>
                                    </div>
                                     <div class="col-md-6 form-group" >
                                        <label>Amount</label>
                                        <input type="number" name="amount" class="input-sm form-control [required] mask-money" placeholder="3500" required />
                                    </div>
                                </div>
                                
                       
								<br>
                                
                                <div class="row">
                                    <div class="col-md-6 form-group" >
                                        <label>Sender</label>
                                        <input type="text" name="acc_name" class="input-sm form-control" placeholder="Account Name" required />
                                    </div>
                                                                <div class="col-md-6 form-group" >
                                        <label>Account No.</label>
                                        <input type="number" name="acc_num" class="input-sm form-control" placeholder="Account Number" required />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 form-group" style="padding-top:20px;" >
                                        <label>Bank Name</label>
                                        <input type="text" name="bank_name" class="input-sm form-control" required />
                                    </div>
                                    <div class="col-md-6 form-group" style="padding-top:20px;" >
                                        <label>Date</label>
                                        <input type="datetime-local" name="routing" class="input-sm form-control" required />
                                    </div>
                                </div>
                                <div class="row" style="padding-top:20px;" >
    <div class="col-md-6 form-group">
        <label>Bank Address</label>
        <textarea name="cout" class="form-control input-sm" placeholder="Bank Address" rows="4" cols="50" required></textarea>
    </div>
    <div class="col-md-6 form-group">
        <label>Remarks</label>
        <textarea name="remarks" class="form-control inpu" placeholder="Remarks" rows="4" cols="50" required></textarea>
    </div>
</div>
                          
                                <br>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                                        <button type="reset" class="btn btn-warning btn-sm">Reset</button>
                                        <button type="submit" name="credit" class="btn btn-success btn-sm">Credit User</button>

                                    </div>
                             
                          
                        </form>
</div>
               
               
               
          </div>
        </div>
      </div>
     </div>
 </div>
    
       <?php include 'foot.php'; ?>