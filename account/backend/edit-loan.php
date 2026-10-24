<?php
include_once 'class.crud.php';
if(isset($_POST['btn-update']))
{
	$id = $_GET['edit_id'];
	$loanamt = $_POST['loanamt'];
	$inter = $_POST['inter'];
	$dura = $_POST['dura'];
	$monthlypay = $_POST['monthlypay'];
	$balance = $_POST['balance'];
	$status = $_POST['status'];
	
	if($crud->updateloan($id,$loanamt,$inter,$dura,$monthlypay,$balance,$status))
	{
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
					
						 <h3 style='color:green; font-weight:900;'>LOAN UPDATED!</h3>
							  
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
				<strong>SORRY!</strong> ERROR while updating Loan!
				</div>";
	}
}

if(isset($_GET['edit_id']))
{
	$id = $_GET['edit_id'];
	extract($crud->getIDloan($id));	
}

?>
 <?php include 'headeradmin.php'; ?>
 
 
   <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
     <!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card shadow" style="background-color: white; color:black;"  >
            <div class="card-header border-0">
              <h3 class="mb-0" style="color:#000;">Update Loan</h3>
            </div>
          
           <div class="card-body">
               
               <?php
if(isset($msg))
{
	echo $msg;
}
?>
               
              
<div class="container-fluid">
	<form method='post' class=''>
 
 
 <div class="row">
         <div class="form-group col-md-3">
            <label for="name">Requested Loan Amount</label>
			<input id="name" name="loanamt" class="form-control" type="text" value="<?php echo $loanamt;?>"  />
        </div>
		
        <div class="form-group col-md-3">
            <label for="name">Interest Rate (3.1 %)</label>
			<input id="name" name="inter" class="form-control" type="text" value="<?php echo $inter;?>"  />
        </div>
 
        <div class="form-group col-md-3">
			<label for="email">Duration </label>
			<input id="lname" name="dura" class="form-control" type="text" value="<?php echo $dura;?>" />
        </div>
 
        <div class="form-group col-md-3">
            <label for="website">Monthly Payment ($400.00) </label>
			<input id="website" name="monthlypay" class="form-control" type="text" value="<?php echo $monthlypay;?>" />
        </div>
         <div class="form-group col-md-3">
            <label for="website">Loan Status (e.g APPROVED, PENDING, ON-HOLD, CANCELED, REVERSED</label>
			<input id="website" name="status" class="form-control" type="text" value="<?php echo $status;?>" />
        </div>
         <div class="form-group col-md-3">
            <label for="website">Loan Balance ($200,000.00)</label>
			<input id="website" name="balance" class="form-control" type="text" value="<?php echo $balance;?>" />
        </div>
 </div>
 
	 
 
		<div class="clearfix"></div>
            <br />
        <table>
        <tr>
            <td colspan="2">
                <button type="submit" class="btn btn-sm btn-success" name="btn-update">
    			<span class="glyphicon glyphicon-edit"></span>  Update Loan
				</button>
                <a href="index.php" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-backward"></i> &nbsp; Cancel</a>
            </td>
        </tr>
        </table>
</form> 


</div>
               
               
               
          </div>
        </div>
      </div>
     </div>
 </div>
    
       <?php include 'foot.php'; ?>



