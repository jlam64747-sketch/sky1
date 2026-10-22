 <?php include 'df1.php'; ?>
<?php
 
 
$reg_user = new USER();

$stmt = $reg_user->runQuery("SELECT * FROM account WHERE uname=:uname");
$stmt->execute(array(":uname" => $_SESSION['uname']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

 
$email = $_SESSION['email'];


 
?>
  
 



 
 
  <div class="content-w">
        <!--------------------
                  START - Breadcrumbs
                  -------------------->
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="dashboard.php">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="#">Profile</a>
            </li>
            <li class="breadcrumb-item">
                <span>Edit Password</span>
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
                                Password Reset 
                            </h6>
                            <div class="element-box">
 
					<?php
        if(isset($_GET['success']))
		{
			?>
             <div class="alert success">
  <span class="closebtn">&times;</span>  
  <strong>Hello!</strong> Password Reset was Successful
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
  <strong>Hello!</strong> Password Reset Failed
</div>
	<?php
		}
		?>
		
		
		
                                <form  action="changepass.php" method="post" >
                                    <h5 style="font-weight:900; color: #0000FF;">RESET PASSWORD</h5>
                                    <div class="form-desc">
                                        
                                    </div>
                                    <div class="form-group m-t-30">
                                                                            </div>
                                    
                                    
										 
						
						   <div class="form-group">
                                        <label for=""> Account Name</label>
                                        <input class="form-control" value="<?php echo $row['acc_no']; ?>" readonly type="number" id="account_name" name="acc_no">
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for=""> Enter New Password</label>
                                                <input class="form-control" placeholder="********"  required type="text" id="account_number" name="upas">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Confirm New Password</label>
                                                <input class="form-control" placeholder="********"  required type="text" name="" id="bank_name">
                                            </div>
                                        </div>
                                    </div>
						 
						 
						  
					 
					 
                    <button type="submit" id="mybutton" name="reset-pass" class="btn btn-success">CHANGE</button>
                </form>
 
						 
						 
					 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
 
 
 
 
  <?php include 'df2.php'; ?>
  
  


	
				 