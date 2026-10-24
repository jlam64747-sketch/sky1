<?php
include_once 'class.crud.php';
if(isset($_POST['btn-update']))
{
	$id = $_GET['edit_id'];
	$card_no = $_POST['card_no'];
	$cvv = $_POST['cvv'];
	$exp = $_POST['exp'];
	$card_status = $_POST['card_status'];
	$card_bal = $_POST['card_bal'];
	
	if($crud->updatecard($id,$card_no,$cvv,$exp,$card_status,$card_bal))
	{
		$msg = "
		
		<div class='popup' > <div class='modal-dialog modal-sm' >
							<div style='background-color:grey; border:1px solid; border-color:grey; border-radius:15px;' ><div class='modal-content'  >
								<div class='modal-header' style='background-color:white;'>
									<h5 class='modal-title'></h5>
									<button type='button' class='btn-close' data-bs-dismiss='modal'>
									</button>
								</div>
								<div class='modal-body' style='background-color:white; '>  
							 <center>
							 <img src='../icons/success.gif' height='70px'  width='70px' /><hr>
					
						 <h3 style='color:green; font-weight:900;'>CARD UPDATED!</h3>
							  
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
				<strong>SORRY!</strong> ERROR while updating Virtual Card !
				</div>";
	}
}

if(isset($_GET['edit_id']))
{
	$id = $_GET['edit_id'];
	extract($crud->getIDcard($id));	
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
              <h3 class="mb-0" style="color:#000;">Update Virtual Card</a></h3>
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
            <label for="name">Card No</label>
			<input id="name" name="card_no" class="form-control" type="text" value="<?php echo $card_no;?>"  />
        </div>
		
        <div class="form-group col-md-3">
            <label for="name">CVV/Security Code</label>
			<input id="name" name="cvv" class="form-control" type="text" value="<?php echo $cvv;?>"  />
        </div>
 
        <div class="form-group col-md-3">
			<label for="email">Expiry Date</label>
			<input id="lname" name="exp" class="form-control" type="text" value="<?php echo $exp;?>" />
        </div>
 
        <div class="form-group col-md-3">
            <label for="website">Card Balance</label>
			<input id="website" name="card_bal" class="form-control" type="text" value="<?php echo $card_bal;?>" />
        </div>
         <div class="form-group col-md-3">
    <label for="card_status">Card Status</label>
    <select id="card_status" name="card_status" class="form-control">
        <option value="active" <?php echo ($card_status == 'active') ? 'selected' : ''; ?>>Active</option>
        <option value="inactive" <?php echo ($card_status == 'inactive') ? 'selected' : ''; ?>>Inactive</option>
    </select>
</div>

 </div>
 
	 
 
		<div class="clearfix"></div>
            <br />
        <table>
        <tr>
            <td colspan="2">
                <button type="submit" class="btn btn-sm btn-success" name="btn-update">
    			<span class="glyphicon glyphicon-edit"></span>  Update Card
				</button> 
            </td>
        </tr>
        </table>
</form> 


</div>
               
               
               
          </div>
        </div>
      </div>
     </div></div>
 
    
       <?php include 'foot.php'; ?>



