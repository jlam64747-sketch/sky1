<?php
session_start();
require_once 'class.admin.php';
include_once ('session.php');

$reg_user = new USER();

if(!isset($_SESSION['email'])){
	
header("Location: login.php");

exit(); 
}

$stmt = $reg_user->runQuery("SELECT * FROM account");
$stmt->execute();
  




// If upload button is clicked ...
  if (isset($_POST['upload'])) {
 
     
      $acc_no =$_POST['acc_no'];
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];   
        $folder = "pic/".$filename;
	
 
	$conn = mysqli_connect("$host", "$username", "$password", "$database");

 
 $sql = "UPDATE account SET filename = '$filename' WHERE acc_no = '$acc_no'";
     
        // Execute query
        mysqli_query($conn, $sql);
     if (move_uploaded_file($tempname, $folder))  {
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
					
						 <h3 style='color:green; font-weight:900;'>PHOTO UPLOADED!</h3>
							  
							<form action='index.php' method='POST'> 
							<button type='submit' style='font-weight:900;'  class='btn btn-success'>CONTINUE</button>  </form>


							  </center>
							</div> 
							</div></div>
						</div> </div>
					";
         
         
     }
        
        else{
            $msg = "
            <div class='alert alert-success'>
					<center>	<strong style='color:black;'>Customer Verification Failed, Try Again Later
                           </strong></center>
			  		</div> ";
      }
  
  $result = mysqli_query($conn, "SELECT * FROM image");


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
              <h3 class="mb-0" style="color:#000">Upload Customer Profile Photo</h3>
            </div>
          
           <div class="card-body">
               <div class="col-md-5 align-self-center">
                <div class="block-area" id="required">  <?php if(isset($msg)) echo $msg;  ?> <?php if(isset($msger)) echo $msger;  ?> 
                    <h4 class="">Please upload any image format and size 150 x 150 preferable</h4>
                    
				  <fieldset>
					<form action="" method="POST" enctype="multipart/form-data">
                        
			 
                      
								<label>Select Client</label>
						<select name="acc_no" class="form-control input-sm validate[required]">
						<?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)){?>
							<option value="<?php echo $row['acc_no']; ?>"><?php echo $row['fname']; ?> <?php echo $row['lname']; ?></option>
						<?php } ?>
					   </select>
					  
					  <br><br>
                        
							<div> 
						<input class="form control"  class="un " name="uploadfile" type="file" autofocus required />
							 
							</div>
					 
                       <hr>
							<input class="btn btn-success" type="submit" name="upload"   value="Upload Image">
                        
                    </form>
					</fieldset>
                        
                </div>
               </div>
          </div>
        </div>
      </div>
     </div>
 </div>
    
       <?php include 'foot.php'; ?>