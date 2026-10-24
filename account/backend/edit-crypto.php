<?php
include_once 'class.crud.php';
if(isset($_POST['btn-update']))
{
	$ctid = $_GET['edit_ctid']; 
	$status = $_POST['status'];
	
	if($crud->updatecrypto($ctid,$status))
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
					
						 <h3 style='color:green; font-weight:900;'>CRYPTO UPDATED!</h3>
							  
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
				<strong>SORRY!</strong> ERROR while updating crypto!
				</div>";
	}
}

if(isset($_GET['edit_id']))
{
	$ctid = $_GET['edit_id'];
	extract($crud->getIDcrypto($ctid));	
}

?>
 <?php include 'headeradmin.php'; ?>
 
 
     <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
     <!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card shadow"  style="background-color: grey; color:white;" >
            <div class="card-header border-0">
              <h3 class="mb-0"><a href=""   class="btn btn-danger">Update Crypto Transaction</a></h3>
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
            <label for="website">Loan Status (e.g APPROVED, PENDING, ON-HOLD, CANCELED, REVERSED</label>
			<input id="website" name="status" class="form-control" type="text" value="" />
        </div>
  
 </div>
 
	 
 
		<div class="clearfix"></div>
            <br />
        <table>
        <tr>
            <td colspan="2">
                <button type="submit" class="btn btn-success" name="btn-update">
    			<span class="glyphicon glyphicon-edit"></span>  Update Crypto
				</button>
                <a href="index.php" class="btn btn-large btn-danger"><i class="glyphicon glyphicon-backward"></i> &nbsp; CANCEL</a>
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



