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
                <a href="#">Deposit</a>
            </li>
            <li class="breadcrumb-item">
                <span>Request</span>
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
                                Deposit
                            </h6>
                            <div class="element-box">
							
							
					<?php
        if(isset($_GET['success']))
		{
			?>
             <div class="alert success">
  <span class="closebtn">&times;</span>  
  <strong>Recieved!</strong> We will get back to you soon
</div>
	<?php
		}
		?>		
					<?php
        if(isset($_GET['failed']))
		{
			?>
             <div class="alert">
  <span class="closebtn">&times;</span>  
  <strong>Hello!</strong> Deposit Failed
</div>
	<?php
		}
		?>
		
		
                                <form action="deposit-code.php" method="POST">
                                    <h5 class="form-header">
                                        Deposit form
                                    </h5>
                                    <div class="form-desc">
                                        
                                    </div>
                                    <div class="form-group m-t-30">
                                                                            </div>
                                  
                                    <div class="form-group">
                                        <label for="">Deposit Amount</label>
                                        <input class="form-control" placeholder="Amount" type="text" id="" name="amt" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="">Prefer Deposit Method</label>
                                        <select name="type" class="form-control" required>
                                            <option value="Wire transfer">Wire Transfer</option>
                                            <option value="Paypal">Paypal</option>
                                            <option value="Moneygram">Moneygram</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
									
									<input c  type="hidden" name="email" value="<?php echo $row['email']; ?>"> 
											<input  type="hidden" name="status" value="PENDING">  
					<input   type="hidden" name="date" value="<?php echo date("h:i A d M Y"); ?>"> 	
					
					
                                    <div class="form-buttons-w">
                                        <button class="btn btn-primary" name="add-deposit" type="submit"> Continue </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
 
  <?php include 'df2.php'; ?>