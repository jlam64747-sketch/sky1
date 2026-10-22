 <?php include 'loan-d.php'; ?>
 
 <?php
if (isset($_POST['c_id'])) { 
    $_SESSION['c_id'] = $_POST['c_id'];
}
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
                <a href="#">Loan</a>
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
                                Loan
                            </h6>
                            <div class="element-box">
							
							
							
							
							
								<?php
        if(isset($_GET['deleted']))
		{
			?>
             <div class="alert">
  <span class="closebtn">&times;</span>  
  <strong>Hello!</strong> Loan Deleted Successfully
</div>
	<?php
		}
		?>
		
<?php
        if(isset($_GET['success']))
		{
			?>
             <div class="alert success">
  <span class="closebtn">&times;</span>  
  <strong>Hello!</strong> Loan Application Was Successfully Submited
</div>
	<?php
		}
		?>
		
		<?php
        if(isset($_GET['failed']))
		{
			?>
      <div class="alert info">
  <span class="closebtn">&times;</span>  
  <strong>Hey!</strong> Something Went Wrong
</div>
	<?php
		}
		?>
		
		<?php
        if(isset($_GET['pending']))
		{
			?>
             <div class="alert warning">
  <span class="closebtn">&times;</span>  
  <strong>Hey!</strong> You have a pending Loan
</div>
	<?php
		}
		?>
		
		
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
                              <form action="loan_code.php"  method="POST">
												 
												 
												 
					  <div id="loancal">	
                                    <h5 class="form-header">
                                        Loan Request
                                    </h5>
                                    <div class="form-desc">
                                        
                                    </div>
                                    <div class="form-group m-t-30">
                                                                            </div>
                              
                                    <div class="form-group">
                                        <label for="">Loan Amount (<?php echo $row['currency']; ?>)</label>
                                        <input class="form-control" placeholder="Amount" type="text" id="amount" min="1" max="5000000" onchange="computeLoan()" name="amount" required>
                                    </div>
									
									
								<input   name="inter" hidden id="interest_rate" min="0" max="100" value="15.7" step=".1" onchange="computeLoan()" >
			  
									
									
						 <div class="form-group">
							<label for="">Duration (Months)</label>
							<input class="form-control" name="dura" id="months" type="number"
				   min="1" max="300" value="1" step="1" onchange="computeLoan()" required>
						</div>
									
							 <div class="form-group">
							<label for="">Monthly Repayment (<?php echo $row['currency']; ?>)</label>
							   <textarea class="form-control" name="monthlypay" readonly style="text-align:left;" id="payment"> </textarea>
					 
						</div>		
									
                                    <div class="form-group">
                                        <label for="">Purpose of Loan</label>
                                        <textarea class="form-control" rows="5"  name="purpose"  required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Monthly Net Income</label>
                                        <select name="income" class="form-control" required>
                                            <option value="2,000-5,000">2,000-5,000</option>
                                            <option value="6,000-10,000">6,000-10,000</option>
                                            <option value="11,000-20,000">11,000-20,000</option>
                                            <option value="21,000-50,000">21,000-50,000</option>
                                            <option value="100,000 and above">100,000 and above</option>
                                        </select>
                                    </div>
									
									
									
									  <script type="text/javascript">
    function computeLoan(){
        const amount = document.querySelector('#amount').value;
        const interest_rate = document.querySelector('#interest_rate').value;
        const months = document.querySelector('#months').value;
        const interest = (amount * (interest_rate * 0.01)) / months;
        let payment = ((amount / months) + interest).toFixed(2); //calculate monthly payment

        //regedit to add a comma after every three digits
        payment = payment.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","); //\B looks for a word boundary, ? says what to look for, \d looks for 3 digits in a row
        document.querySelector('#payment').innerHTML = `${payment}`

    }
    </script> 

												 
			<input class="custom-date form-control"  type="hidden" name="email" value="<?php echo $row['email']; ?>"> 
					  <input class="custom-date form-control"  type="hidden" name="name" value="<?php echo $row['fname']; ?> <?php echo $row['lname']; ?>"> 
					 <input class="custom-date form-control"  type="hidden" name="uname" value="<?php echo $row['uname']; ?>"> 
					 
					 
					<input class="custom-date form-control"  type="hidden" name="status" value="ACTIVE"> 
					<input class="custom-date form-control"  type="hidden" name="balance" value="0.00">  
					<input class="custom-date form-control"  type="hidden" name="date" value="<?php echo date("h:i A d M Y"); ?>"> 					 
							
							
							
							
							
                                    <div class="form-buttons-w">
                                        <button class="btn btn-primary" name="add_loan" type="submit"> Send Request </button>
                                    </div>
                                </form> </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
 
 
 
 
  <?php include 'df2.php'; ?>