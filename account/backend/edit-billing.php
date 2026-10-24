<?php
include_once "class.crud.php";
if (isset($_POST["btn-update"])) {
    $id = $_GET["edit_id"];
    $uname = $_POST["uname"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $cot = $_POST["cot"];
    $tax = $_POST["tax"];
    $imf = $_POST["imf"];
    $cot_status = $_POST["cot_status"];
    $tax_status = $_POST["tax_status"];
    $imf_status = $_POST["imf_status"];
    $cot_msg = $_POST["cot_msg"];
    $tax_msg = $_POST["tax_msg"];
    $imf_msg = $_POST["imf_msg"];

    if (
        $crud->updateb(
            $id,
            $uname,
            $fname,
            $lname,
            $cot,
            $tax,
            $imf,
            $cot_status,
            $tax_status,
            $imf_status,
            $cot_msg,
            $tax_msg,
            $imf_msg
            
        )
    ) {
        $msg = "
        <div class='popup'>
            <div class='modal-dialog modal-sm'>
                <div style='background-color:white; border:1px solid; border-color:grey; border-radius:5px;'>
                    <div class='modal-content'>
                        <div class='modal-header' style='background-color:white;'>
                            <h5 class='modal-title'></h5>
                            <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                        </div>
                        <div class='modal-body' style='background-color:white;'>  
                            <center>
                                <img src='../icons/success.gif' height='70px' width='70px' /><hr>
                                <h3 style='color:green; font-weight:900;'>BILLING UPDATED!</h3>
                                <button type='button' style='font-weight:900;' class='btn btn-sm btn-success' id='continueButton'>Continue</button>
                            </center>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    ";
    } else {
        $msg = "<div class='alert alert-warning'>
				<strong>SORRY!</strong> ERROR while updating record !
				</div>";
    }
}

if (isset($_GET["edit_id"])) {
    $id = $_GET["edit_id"];
    extract($crud->getID($id));
}
?>
 <?php include "headeradmin.php"; ?>
 
 
     <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
     <!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card shadow"  style="background-color: white; color:black;" >
            <div class="card-header border-0">
              <h3 class="mb-0" style="color:#000;">Edit User Information</h3>
            </div>
          
           <div class="card-body">
               
               <?php if (isset($msg)) {
                   echo $msg;
               } ?>
               
              
<div class="container-fluid">
	<form method='post' class=''>
 
 
 <div class="row">
         <div class="form-group col-md-4">
            <label for="name">Username</label>
			<input id="name" name="uname" class="form-control" type="text" value="<?php echo $uname; ?>"  />
        </div>
		
        <div class="form-group col-md-4">
            <label for="name">First Name</label>
			<input id="name" name="fname" class="form-control" type="text" value="<?php echo $fname; ?>"  />
        </div>
 
        <div class="form-group col-md-4">
			<label for="email">Last Name</label>
			<input id="lname" name="lname" class="form-control" type="text" value="<?php echo $lname; ?>" />
        </div>
 </div>
 <div class="row" style="padding-top:20px">
     <div class="form-group col-md-4">
			<label for="email">TAX Code</label>
			<input id="lname" name="tax" class="form-control" type="text" value="<?php echo $tax; ?>" />
        </div>
         <div class="form-group col-md-4">
            <label for="name">IMF Code</label>
			<input id="name" name="imf" class="form-control" type="text" value="<?php echo $imf; ?>"  />
        </div>
		
        <div class="form-group col-md-4">
            <label for="name">TAC Code</label>
			<input id="name" name="cot" class="form-control" type="text" value="<?php echo $cot; ?>"  />
        </div>
 </div>
 <div class="row" style="padding-top:20px">
     <div class="form-group col-md-4">
        <label for="tax_status">TAX Status</label>
        <select id="tax_status" name="tax_status" class="form-control">
            <option value="on" <?php echo ($tax_status == 'on') ? 'selected' : ''; ?>>On</option>
            <option value="off" <?php echo ($tax_status == 'off') ? 'selected' : ''; ?>>Off</option>
        </select>
    </div>
    <div class="form-group col-md-4">
        <label for="imf_status">IMF Status</label>
        <select id="imf_status" name="imf_status" class="form-control">
            <option value="on" <?php echo ($imf_status == 'on') ? 'selected' : ''; ?>>On</option>
            <option value="off" <?php echo ($imf_status == 'off') ? 'selected' : ''; ?>>Off</option>
        </select>
    </div>
    
    <div class="form-group col-md-4">
        <label for="cot_status">TAC Status</label>
        <select id="cot_status" name="cot_status" class="form-control">
            <option value="on" <?php echo ($cot_status == 'on') ? 'selected' : ''; ?>>On</option>
            <option value="off" <?php echo ($cot_status == 'off') ? 'selected' : ''; ?>>Off</option>
        </select>
    </div>
</div>

 <div class="row" style="padding-top:20px">
     <div class="form-group col-md-4">
        <label for="tax_msg">TAX Message</label>
        <textarea id="tax_msg" name="tax_msg" class="form-control" rows="3"><?php echo htmlspecialchars($tax_msg); ?></textarea>
    </div>
    <div class="form-group col-md-4">
        <label for="imf_msg">IMF Message</label>
        <textarea id="imf_msg" name="imf_msg" class="form-control" rows="3"><?php echo htmlspecialchars($imf_msg); ?></textarea>
    </div>
    
    <div class="form-group col-md-4">
        <label for="cot_msg">TAC Message</label>
        <textarea id="cot_msg" name="cot_msg" class="form-control" rows="3"><?php echo htmlspecialchars($cot_msg); ?></textarea>
    </div>
</div>
		<div class="clearfix"></div>
            <br />
        <table>
        <tr>
            <td colspan="2">
                <button type="submit" class="btn btn-sm btn-success" name="btn-update">
    			<span class="glyphicon glyphicon-edit"></span>  Update Customer
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
<script>
    $(document).ready(function() {
        $('#continueButton').on('click', function() {
            $('.popup').hide();
        });
    });
</script>
       <?php include "foot.php"; ?>
