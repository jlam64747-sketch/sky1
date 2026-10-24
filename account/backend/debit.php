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


$debit = $reg_user->runQuery("SELECT * FROM account");
$debit->execute();

$ad = $reg_user->runQuery("SELECT * FROM admin WHERE email = :email");
$ad->execute([':email' => $mail]);
$rom = $ad->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['debit'])) {
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

    if ($reg_user->his($uname, $amount, $sender_name, 2, $remarks, $formatted_date, 'Wire Transfer', 'Processing...')) {
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
            $diff = $tbal - $amount;
            $dif = $abal - $amount;

            $debited = $reg_user->runQuery("UPDATE account SET t_bal = :t_bal, a_bal = :a_bal WHERE acc_no = :acc_no");
            $debited->execute([
                ':t_bal' => $diff,
                ':a_bal' => $dif,
                ':acc_no' => $uname
            ]);

            $id = $reg_user->lasdID();

            // Insert a record into the transfer table
            $transfer = $reg_user->runQuery("INSERT INTO transfer (amount, bank_name, acc_name, transtype, acc_no, type, swift, routing, remarks, email, status, date, cout) VALUES (:amount, :bank_name, :acc_name, 'Wire Transfer', :acc_no, 2, '', :routing, :remarks, :email, 'Successful', :date, :cout)");
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
                                        <h3 style='color:green; font-weight:900;'>USER DEBITED!</h3>
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
          <div class="card shadow" style="background-color: white; color:black;">
            <div class="card-header border-0">
              <h3 class="mb-0" style="color:#000;">Debit Customer</a></h3>
            </div>
          
           <div class="card-body">
               
              <?php if (isset($msg)) echo $msg; ?>   
                 <?php if (isset($msg1)) echo $msg1; ?>   
               
<div class="container-fluid">
 
 <form method="POST">
 <div class="row">
                                    <div class="col-md-6 form-group">
                                        <label>Select Account To Debit</label>
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
                                        <label>Reciever</label>
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
                                        <button type="submit" name="debit" class="btn btn-success btn-sm">Debit User</button>

                                    </div>
                             
                          
                        </form>







</div>
               
               
               
          </div>
        </div>
      </div>
     </div>
 </div>
    
       <?php include 'foot.php'; ?>