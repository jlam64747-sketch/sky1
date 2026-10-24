<?php 
include_once 'class.crud.php';
if(isset($_POST['btn-updatet']))
{
	$id = $_GET['edit_id'];
	$email = $_POST['email'];
	$bank_name = $_POST['bank_name'];
	$acc_name = $_POST['acc_name'];
	$acc_no = $_POST['acc_no'];
	$amount = $_POST['amount'];
	$date = $_POST['date'];
	$status = $_POST['status'];
	$swift = $_POST['swift'];
	$type = $_POST['type'];
	$remarks = $_POST['remarks'];
	
	
		$statement = $DB_con->prepare("SELECT  A.email, A.t_bal, B.currency from A FULL JOIN B ON A.email = B.email");
		
		$row = $statement->fetch(PDO::FETCH_ASSOC);

	if($crud->updatet($id,$email,$bank_name,$acc_name,$acc_no,$amount,$date,$status,$swift,$type,$remarks))
	
  
		$msg = "
		
		<div class='popup' > <div class='modal-dialog modal-sm' >
							<div style='background-color:green; border:solid; border-color:brown; border-radius:10px;' ><div class='modal-content'  >
								<div class='modal-header' style='background-color:white;'>
									<h5 class='modal-title'></h5>
									<button type='button' class='btn-close' data-bs-dismiss='modal'>
									</button>
								</div>
								<div class='modal-body' style='background-color:white; '>  
							 <center>
							 <img src='../icons/check-circle.gif' height='70px'  width='70px' /><hr>
					
						 <h3 style='color:green; font-weight:900;'>TRANSFER UPDATED!</h3>
							  
							<form action='index.php' method='POST'> 
							<button type='submit' style='font-weight:900;'  class='btn btn-success'>CONTINUE</button>  </form>


							  </center>
							</div> 
							</div></div>
						</div> </div>
		
		";
	}
	else
	{
		$msg = "<div class='alert alert-warning'>
				<strong>SORRY!</strong> ERROR while updating record !
				</div>";
	}

if(isset($_GET['edit_id']))
{
	$id = $_GET['edit_id'];
	extract($crud->getIDt($id));	
}

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
              <h3 class="mb-0" style="color:#000;">Edit Transfer</a></h3>
            </div>
          
           <div class="card-body">
               
               <?php
if(isset($msg))
{
	echo $msg;
}
?>
               
                
	<form method='post' class=''>
 
         <div class="row">
         <div class="form-group col-md-3">
            <label for="name">EMAIL</label>
			<input id="name" name="email" class="form-control" type="text" value="<?php echo $email;?>"  />
        </div>
		
        <div class="form-group col-md-3">
            <label for="name">BENEFICIARY BANK NAME</label>
			<input id="name" name="bank_name" class="form-control" type="text" value="<?php echo $bank_name;?>"  />
        </div>
  
        <div class="form-group col-md-3">
			<label for="acc_no">BENEFICIARY ACCOUNT NAME</label>
			<input id="acc_name" name="acc_name" class="form-control" type="text" value="<?php echo $acc_name;?>" />
        </div>
 
   </div>
 
  <div class="row">
        <div class="form-group col-md-3">
            <label for="website">BENEFICIARY ACCOUNT NO.</label>
			<input id="website" name="acc_no" class="form-control" type="text" value="<?php echo $acc_no;?>" />
        </div>
 
        <div class="form-group col-md-3">
			<label for="contact">AMOUNT </label>
			<input id="contact" name="amount" class="form-control" type="text" value="<?php echo $amount;?>" required />
        </div>
		
		<div class="form-group col-md-3">
			<label for="job">DATE</label>  <small>Input like this (YYYY-MM-DD HH:MM:SS)</small>
			<input id="job" name="date" class="form-control" type="text" value="<?php echo $date;?>" required />
        </div>
	</div>
	
	 <div class="row">
		<div class="form-group col-md-3">
		    <label>Transfer Status</label><small> <b>Current= <?php echo $status;?></b></small>
                            <select name="status" class="form-control input-sm validate[required]">
                                <option value="Pending">Pending</option>
                                <option value="Successful">Successful</option>
                                <option value="Failed">Failed</option>
                                <option value="Cancelled">Cancelled</option>
                                 <option value="On-hold">On-hold</option>
                            </select>
			
        </div>
		
		
         <div class="form-group col-md-3">
            <label for="name">SWIFT</label>
			<input id="name" name="swift" class="form-control" type="text" value="<?php echo $swift;?>"  />
        </div>
		
        <div class="form-group col-md-3">
            <label for="name">ACC. TYPE</label>
		  <select name="type" class="form-control input-sm validate[required]">
                                    <option value="Savings">Savings</option>
                                    <option value="Current">Current</option>
                                 </select>
        </div>
 </div>
        <div class="form-group col-md-3">
			<label for="acc_no">TRANSFER DESC.</label>
			<input id="acc_name" name="remarks" class="form-control" type="text" value="<?php echo $remarks;?>" />
        </div>
 
      
		<div class="clearfix"></div>
            <br />
        <table>
        <tr>
            <td colspan="2">
                <button type="submit" class="btn btn-sm btn-success" name="btn-updatet">
    			<span class="glyphicon glyphicon-edit"></span>  UPDATE TRANSACTION
				</button>
                <a href="index.php" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-backward"></i> &nbsp; CANCEL</a>
            </td>
        </tr>
        </table>
</form> 
 

               
               
               
               
               
               
               
               
          </div>
        </div>
      </div>
     </div>
 </div>
    
       <?php include 'foot.php'; ?>