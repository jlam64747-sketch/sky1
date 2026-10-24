<?php
include_once 'class.crud.php';
if(isset($_POST['btn-update']))
{
	$id = $_GET['edit_id'];
	$btc_w = $_POST['btc_w'];
	$btc_bal = $_POST['btc_bal'];
	$ethe_w = $_POST['ethe_w'];
	$ethe_bal = $_POST['ethe_bal'];
	$usdt_w = $_POST['usdt_w'];
	$usdt_bal = $_POST['usdt_bal'];
	$litecoin_w = $_POST['litecoin_w'];
	$litecoin_bal = $_POST['litecoin_bal'];
	
	if($crud->updatewallet($id,$btc_w,$btc_bal,$ethe_w,$ethe_bal,$usdt_w,$usdt_bal,$litecoin_w,$litecoin_bal))
	{
		$msg = "<div class='alert alert-info'>
				Customer Wallet Account Updated Successfully <a href='index.php'>HOME</a>!
				</div>";
	}
	else
	{
		$msg = "<div class='alert alert-warning'>
				<strong>SORRY!</strong> ERROR while updating Wallet Account!
				</div>";
	}
}

if(isset($_GET['edit_id']))
{
	$id = $_GET['edit_id'];
	extract($crud->getIDwallet($id));	
}

?>
 <?php include 'headeradmin.php'; ?>
 

 <!---begin of Mobile View Here   only from Digital Forest Team-->
 
       <?php include 'menu.php'; ?>
  
  <!---End of Mobile View Here   only from Digital Forest Team-->
  
 
      <script type="text/javascript" src="paginator.js"></script>
        <script type="text/javascript" src="table.js"></script>
     
     <br><br><br><br><br><br><br>
  
    <div class="container-fluid mt--7">
     <!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card shadow" >
            <div class="card-header border-0">
              <h3 class="mb-0"><a href=""   class="btn btn-danger">UPDATE WALLET/FUNDS</a></h3>
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
            <label for="name">BTC WALLET</label>
			<input id="name" name="btc_w" class="form-control" type="text" value="<?php echo $btc_w;?>"  />
        </div>
		
        <div class="form-group col-md-3">
            <label for="name">BTC BALANCE</label>
			<input id="name" name="btc_bal" class="form-control" type="text" value="<?php echo $btc_bal;?>"  />
        </div>
 
        <div class="form-group col-md-3">
			<label for="email">ETH WALLET </label>
			<input id="lname" name="ethe_w" class="form-control" type="text" value="<?php echo $ethe_w;?>" />
        </div>
        <div class="form-group col-md-3">
			<label for="email">ETH BALANCE </label>
			<input id="lname" name="ethe_bal" class="form-control" type="text" value="<?php echo $ethe_bal;?>" />
        </div>
 
        <div class="form-group col-md-3">
            <label for="website">USDT WALLET </label>
			<input id="website" name="usdt_w" class="form-control" type="text" value="<?php echo $usdt_w;?>" />
        </div>
         <div class="form-group col-md-3">
            <label for="website">USDT BALANCE</label>
			<input id="website" name="usdt_bal" class="form-control" type="text" value="<?php echo $usdt_bal;?>" />
        </div>
         <div class="form-group col-md-3">
            <label for="website">LITECOIN WALLET</label>
			<input id="website" name="litecoin_w" class="form-control" type="text" value="<?php echo $litecoin_w;?>" />
        </div>
        <div class="form-group col-md-3">
            <label for="website">LITECOIN BALANCE</label>
			<input id="website" name="litecoin_bal" class="form-control" type="text" value="<?php echo $litecoin_bal;?>" />
        </div>
 </div>
 
	 
 
		<div class="clearfix"></div>
            <br />
        <table>
        <tr>
            <td colspan="2">
                <button type="submit" class="btn btn-success" name="btn-update">
    			<span class="glyphicon glyphicon-edit"></span>  Update Wallet
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
 
    
       <?php include 'foot.php'; ?>



