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
                <a href="#">Support Ticket</a>
            </li>
            <li class="breadcrumb-item">
                <span>OPen Ticket</span>
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
                                Support Ticket
                            </h6>
                            <div class="element-box">
							
							
					<?php
        if(isset($_GET['success']))
		{
			?>
             <div class="alert success">
  <span class="closebtn">&times;</span>  
  <strong>Hello! </strong> Your Message(s) has been Sent Successfully
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
  <strong>Hello!</strong> Message Failed
</div>
	<?php
		}
		?>
		
		
                                <form action="supportcode.php" method="POST">
                                    <h5 class="form-header">
                                       Support Ticket Form
                                    </h5>
                                    <div class="form-desc">
                                        
                                    </div>
                                    <div class="form-group m-t-30">
                                                                            </div>
                                  
                                    <div class="form-group">
                                        <label for="">Message Subject</label>
                                        <input class="form-control" placeholder="Message Subject" type="text" id="" name="subject"  required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="">Department</label>
                                        <select name="type" class="form-control" required>
                                       <option value="">Choose Section</option>          
                                          <option value="Wire Transfer Section">Wire Transfer Section</option>
                                          <option value="Local Transfer Section">Local Transfer Section</option>
                                          <option value="Same Transfer Section">Same Transfer Section</option>
                                          <option value="Credit Card Section">Credit Card Section</option>
                                          <option value="Loan/facility Section">Loan/Facility Section</option>

                                        </select>
                                    </div>
                                  
                                   <div class="form-group">
                                        <label for="">Message Body</label>
                                        <textarea name="msg" class="form-control" required></textarea>
                                    </div>
									
						 <input type="hidden" class="form-control"  name="sender_name" value="<?php echo $row['fname']; ?> <?php echo $row['lname']; ?> " />	
					
					
                                    <div class="form-buttons-w">
                                        <button class="btn btn-primary" name="ticket" type="submit"> Open Ticket </button>
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