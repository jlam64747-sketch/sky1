<?php
session_start();
include_once ('df/session.php');
require_once 'df/controller.php';
if(!isset($_SESSION['uname'])){
header("Location: login.php");
exit(); 
}

$reg_user = new USER();

$stmt = $reg_user->runQuery("SELECT * FROM account WHERE uname=:uname");
$stmt->execute(array(":uname" => $_SESSION['uname']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);



$status = $row['status'];
$bill = $row['billing_code'];


if ($status == 'Transfer Restricted') {
    header('Location: dashboard.php?error=restricted');
    exit();
}



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
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="dashboard.php">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="#">Transfer</a>
            </li>
            <li class="breadcrumb-item">
                <span>Local</span>
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
                                Transfer
                            </h6>
                            <div class="element-box">
                                <form  action="trf_local.php" method="post" >
                                    <h5 class="form-header">
                                        Local Transfer
                                    </h5>
                                  <div class="form-desc">
                                        Funds will reflect in the Beneficiary Account within 24hours. <a  class="btn btn-danger" href="beneficiary.php">Tranfer to Beneficiary</a>
                                    </div>
                                    <div class="form-group m-t-30">
                                                                            </div>
                                   
                                    
										<?php 
							if(isset($_GET['error']))
								{
									?>
									<div class='alert'>
										<button class='close' data-dismiss='alert'>&times;</button>
										<strong>Unable to Authenticate. Transfer Failed.</strong> 
									</div>
									<?php
								}
						?>
						<?php 
							if(isset($_GET['errorcot']))
								{
									?>
									<div class='alert'>
										<button class='close' data-dismiss='alert'>&times;</button>
										<strong>Invalid COT Code! Transfer Failed.</strong> 
									</div>
									<?php
								}
						?>
						<?php 
							if(isset($_GET['errortax']))
								{
									?>
									<div class='alert'>
										<button class='close' data-dismiss='alert'>&times;</button>
										<strong>Invalid Tax Code! Transfer Failed.</strong> 
									</div>
									<?php
								}
						?>
						<?php 
							if(isset($_GET['errorotp']))
								{
									?>
									<div class='alert'>
										<button class='close' data-dismiss='alert'>&times;</button>
										<strong>Invalid TRANSFER OTP Code! Transfer Failed.</strong> 
									</div>
									<?php
								}
						?>
						<?php 
							if(isset($_GET['insufficient']))
								{
									?>
									<div class='alert'>
										<button class='close' data-dismiss='alert'>&times;</button>
										<strong>Sorry, your balance is insufficient to make the transfer, please transfer a lower amount.</strong> 
									</div>
									<?php
								}
						?>
						<?php 
							if(isset($_GET['amounterror']))
								{
									?>
									<div class='alert'>
										<button class='close' data-dismiss='alert'>&times;</button>
										<strong>Sorry, the amount is too little, please transfer a higher amount.</strong> 
									</div>
									<?php
								}
						?> 
						
						 
                                    <div class="form-group">
                                        <label for=""> Account Name</label>
											 <span id="sprytf_acc_name">
                                        <input class="form-control" placeholder="Beneficiary Account Name" type="text" id="acc_name" name="acc_name">
									    <span class="textfieldRequiredMsg">Account Name is required.</span>
										<span class="textfieldMinCharsMsg">min of 8 characters.</span> 
											</span>
						
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for=""> Account Number</label>
												 <span id="sprytf_acc_no">
                                                <input class="form-control" placeholder="Beneficiary Account Number" type="text" id="acc_no" name="racc_no">
														<span class="textfieldRequiredMsg">Account Number is required.</span>
            			<span class="textfieldMinCharsMsg">min of at least 10 characters.</span>
            			<span class="textfieldMaxCharsMsg">max 15 characters.</span>
            			<span class="textfieldInvalidFormatMsg">Account Number must be Integer.</span>
							</span>
                                              
                         
                                              
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Bank Name</label>
												<span id="sprytf_bank_name">
                                                <input class="form-control" placeholder="Beneficiary Bank Name" type="text" name="bank_name" id="bank_name">
												 <span class="textfieldRequiredMsg">Bank Name is required.</span>
            			<span class="textfieldMinCharsMsg">min of 6 characters.</span> 
							</span>
                                            </div>
                                        </div>
                                    </div>
                                  
                                 
                                              <div class="form-group">
                                                    <label for="">Transfer Type</label>
													         <select class="form-control" id="country">
                                                               <option value="Online Banking">Online Banking</option>
                                                                 <option value="Joint Account">Joint Account</option>
                                                                 <option value="Checking">Checking</option>
                                                                 <option value="Savings Account">Savings Account</option>
                                                </select>
                                                    
                                                </div>
                                       
                                    <fieldset class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="">Amount</label>
													 <span id="sprytf_amount">
                                                    <input class="form-control" placeholder="Amount" name="amount" id="amount" type="number">
															 <span class="textfieldRequiredMsg">Sending Amount is required.</span>
                    			<span class="textfieldMinCharsMsg">minimum of $10.</span> 
                    		</span>
                                                    
                                                </div>
                                            </div>
                                        </div>
										
							<input name="cout" value="<?php echo $site_address; ?>"  type="hidden" >
							<input name="swift" value="<?php echo $site_swift; ?>"  type="hidden" >
							<input type="hidden"  name="uname" value="<?php echo $row['email']; ?> "/>
							<input name="routing" type="hidden" value="<?php echo date("h:i A d M Y"); ?>" >  
							<input name="transtype" type="hidden" value="Local Transfer" >
							<input name="type" type="hidden" value="2" >
										
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="">Description</label>
												<span id="sprytf_remarks">
                                                <textarea class="form-control" rows="5" id="remarks" name="remarks"></textarea>
												<span class="textfieldRequiredMsg">Purpose of Transfer is required.</span>
            			<span class="textfieldMinCharsMsg">min of 15 characters.</span> 
							</span>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="form-buttons-w">
                                        <button class="btn btn-primary" type="submit"> Transfer </button>
										
										
		 
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