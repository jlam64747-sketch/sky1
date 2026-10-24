<?php 
include_once 'connectdb.php';
if(isset($_POST['btn-save']))
{

 
	
	 $conn = mysqli_connect($host, $username, $password, $database);
                                                    
                                                    // Check connection
                                                    
                                                    if (!$conn) {
                                                          die("Connection failed: " . mysqli_connect_error());
                                                    }
                                                     
                                                    echo ""; 
                                                    
                                                    $db_select = mysqli_select_db($con, $database);
						   
						                            
						                           	$email = $_REQUEST['email'];
                                                	$bank_name = $_REQUEST['bank_name'];
                                                	$acc_no = $_REQUEST['acc_no'];
                                                	$acc_name = $_REQUEST['acc_name'];
                                                	$amount = $_REQUEST['amount'];
                                                	$date = $_REQUEST['date'];
                                                	$status = $_REQUEST['status'];
                                                	$swift = $_REQUEST['swift'];
                                                	$type = $_REQUEST['type'];
  													$transtype = $_REQUEST['transtype'];
                                                	$remarks = $_REQUEST['remarks'];
                                                	$routing = $_REQUEST['routing'];
                                           
                                           
                                                        
          $sql = "INSERT INTO `transfer` (`id`, `acc_no`, `email`, `bank_name`, `acc_name`, `amount`, `date`, `swift`, `status`, `type`,  `transtype`, `remarks`, `routing`) 
          VALUES (NULL, '$acc_no', '$email', '$bank_name', '$acc_name', '$amount', '$date', '$swift', '$status', '$type', '$transtype', '$remarks', '$routing')";                                              
                                                    
         
     
                                           
                                                    
                            						 
                            						   $insert=mysqli_query($conn, $sql);
                            						   
                            						   if($insert){
                            						       
                            						     	header("Location: add_transfer.php?inserted");
                            							   
                            						   }else{
                            						       
                            						       	header("Location: add_transfer.php?failure");
                            						       
                            						       
                            						   }
                            					   }
					                             
	
	 
	
	
 
?>































 <?php include 'headeradmin.php'; ?>
 
 
       <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
			
			
			
			
				<?php
        if(isset($_GET['inserted']))
		{
			?>
             
							<div class='popup' > <div class="modal-dialog modal-sm" >
							<div style="background-color:green; border:solid;" ><div class="modal-content"  >
								<div class="modal-header" style="background-color:white;">
									<h5 class="modal-title"></h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal">
									</button>
								</div>
								<div class="modal-body" style="background-color:white; ">  
							 <center>
							 <img src="../icons/check-circle.gif" height="80px"  width="80px" /><hr>
					
						 <h3 style="color:green; font-weight:900;">TRANSACTIONS ADDED</h3>
							  
							<form action="index.php" method="POST"> 
							<button type="submit" style="font-weight:900;"  class="btn btn-success">OKAY</button>  </form>


							  </center>
							</div>
				 
								
					
							</div></div>
						</div> </div>
	<?php
		}
		?>	
			
			
			
			
			
			
			
			
			
			
			
			
			
			
     <!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card shadow"  style="background-color: white; color:black;" >
            <div class="card-header border-0">
              <h3 class="mb-0" style="color:#000;">Add Transaction For Customer</a></h3>
            </div>
          
           <div class="card-body">
               
               
               
        
               <?php
if(isset($_GET['inserted']))
{
	?>
    <div class="container-fluid">
	<div class="alert alert-info">
    Transfer Records added . <a href="index.php">HOME</a>!
	</div>
	</div>
    <?php
}
else if(isset($_GET['failure']))
{
	?>
    <div class="container-fluid">
	<div class="alert alert-danger" role="alert">Error</div>
	</div>
    <?php
}
?>


	<form method='post'>
 
        <div class="form-group" style="padding-bottom:20px;">
            <label for="name">Email (Customer Email)</label>
			<input id="name" name="email" class="form-control" type="text" required />
		 
        </div>
		
		<div class="form-group" style="padding-bottom:20px;">
            <label for="name">Reciever/Sender Bank</label>
			<input id="name" name="bank_name"  value="WellsFargo/Standford Union" class="form-control" type="text" required />
		
        </div>
		  
		<div class="form-group" style="padding-bottom:20px;">
            <label for="name">Reciever/Sender Acc. No</label>
			<input id="name" name="acc_no" value="1234567890/1234567890"  class="form-control" type="text" required />
        </div>
        
        	<div class="form-group" style="padding-bottom:20px;">
            <label for="name">Sender/Reciver Acc. Name</label>
			<input id="name" name="acc_name" value="FROM: XXXXX CR: XXXXXX"   class="form-control" type="text" required />
        </div>
 
        <div class="form-group" style="padding-bottom:20px;">
			<label for="acc_no">Amount</label>
			<input id="email" name="amount" class="form-control" type="number" required />
        </div>
 
        
			<input id="website" name="date" class="form-control" type="hidden" required />
      
 
        <div class="form-group" style="padding-bottom:20px;">
			<label for="contact">Transfer Status <small>(Successful,Pending,Failed)</small></label>
			<input id="contact" name="status" class="form-control" type="text" required />
        </div>
        
        <div class="form-group" style="padding-bottom:20px;">
			<label for="job">SWIFT CODE</label>
			<input id="job" name="swift" class="form-control" type="text"  />
        </div>
		
		<div class="form-group" style="padding-bottom:20px;">
			<label for="job">Transfer Type</label>
			<input id="job" name="type" class="form-control" type="text"  placeholder="Credit  or Debit"  required />
        </div>
		<input id="job" name="transtype" class="form-control" type="hidden"  value="CASH/TRANSFER"  required />
		<div class="form-group" style="padding-bottom:20px;">
			<label for="company">Purpose of Transfer</label>
			<input id="company" name="remarks" class="form-control" type="text" required />
        </div>
		
		 <div class="form-group" style="padding-bottom:20px;">
            <label for="name">Transaction Date</label>
			<input id="name" name="routing" class="form-control" type="text" value="<?php echo date("h:i A d M Y"); ?>" required />
        </div>
 
         <br>
 
        <table>
            <td colspan="2">
            <button type="submit" class="btn btn-sm btn-danger" name="btn-save">
    		<span class="glyphicon glyphicon-plus"></span> Save Transaction
			</button>  
             
            </td>
        </table>
</form>

               
               
               
               
               
               
               
          </div>
        </div>
      </div>
     </div>
 
    </div>
       <?php include 'foot.php'; ?>