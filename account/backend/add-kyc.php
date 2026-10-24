<?php
session_start();
require_once 'class.admin.php';
include_once ('session.php');
if(!isset($_SESSION['email'])){
	
header("Location: login.php");

exit(); 
}
   if(isset($_FILES['image'])){
      $errors= array();
      $file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['image']['name'])));
      
      $expensions= array("jpeg","jpg");
      
      if(in_array($file_ext,$expensions)=== false){
        $errors = "
					<div class='alert alert-warning'>
						<button class='close' data-dismiss='alert'>&times;</button>
						  You have not selected any image, please select a JPG image
                   
			  		</div>
					";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true){
         move_uploaded_file($file_tmp,"pic/".$file_name);
         $msg = "
					<div class='alert alert-success'>
						<button class='close' data-dismiss='alert'>&times;</button>
						 KYC Image Successfully Uploaded! Please SET Customer to Login Verification to 1 (APPROVED)  <a href='approve-kyc.php'>CLICK HERE</a> to user Login
                   
			  		</div>
					";
      }else{
         print_r($errors);
      }
   }
?>


 <?php include 'headeradmin.php'; ?>
 

 <!---begin of Mobile View Here   only from Digital Forest Team-->
 
       <?php include 'menu.php'; ?>
  
  <!---End of Mobile View Here   only from Digital Forest Team-->
  
 
     <br><br><br><br><br><br><br>
     
     
  
    <div class="container-fluid mt--7">
     <!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card shadow" >
            <div class="card-header border-0">
              <h3 class="mb-0"><a href=""   class="btn btn-danger">UPLOAD CUSTOMER KYC ID</a></h3>
            </div>
          
           <div class="card-body">
               <div class="col-md-5 align-self-center">
                   <strong style="color:red;">Download the Customer KYC ID Card from the Main Menu Dashboard and Rename with customer Account Number before Uploading</strong>
                <div class="block-area" id="required">  <?php if(isset($msg)) echo $msg;  ?> <?php if(isset($msger)) echo $msger;  ?> 
                  
                    
				  <fieldset>
					<form action="" method="POST" enctype="multipart/form-data">
                        
						<div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-preview thumbnail form-control"></div>
                        
							<div>
								<span class="btn btn-file btn-alt btn-sm">
									<span class="btn btn-info d-none d-lg-block m-l-15"><b style="color: #000">Uplaod KYC ID</b></span>
									<span class="fileupload-exists">Browse to Select KYC ID</span>
									<input type="file" accept="image/jpeg" name="image"/>
								</span>
								<a href="#" class="btn fileupload-exists btn-sm" data-dismiss="fileupload">Remove</a>
							</div>
						</div>
                       <hr>
							<input class="btn btn-success" type="submit" value="Upload KYC ID">
                        
                    </form>
					</fieldset>
                        
                </div>
               </div>
          </div>
        </div>
      </div>
     </div>
 
    
       <?php include 'foot.php'; ?>