<?php
session_start();
require_once ('class.admin.php');
include_once ('session.php');

$reg_user = new USER();

if (!isset($_SESSION['email'])) {

    header("Location: login.php");

    exit();
}
$mail = $_SESSION['email'];

$ad = $reg_user->runQuery("SELECT * FROM admin WHERE email = '$mail'");
$ad->execute();
$rom = $ad->fetch(PDO::FETCH_ASSOC);


if (isset($_POST['edit'])) {
    $upass = $_POST['upass']; 
    $email = $_POST['email'];

    $stmt = $reg_user->runQuery("SELECT * FROM admin WHERE email=:email");
    $stmt1 = $reg_user->runQuery("SELECT * FROM admin WHERE upass=:upass");
    $stmt->execute(array(":email" => $email));
    $stmt1->execute(array(":upass" => $upass));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);


    if ($stmt->rowCount() > 0 || $stmt1->rowCount() > 0) {
        $msg = "
		      <div class='alert alert-danger'>
				<button class='close' data-dismiss='alert'>&times;</button>
					<strong>Sorry!</strong>Email and Password Already Exist, Choose Another
			  </div>
			  ";
    } else {
        
     
        
        $ed = $reg_user->runQuery("UPDATE `admin` SET `upass` = '$upass', `email` = '$email' WHERE `admin`.`id` = 1");
        $ed->execute(array(":upass" => $password, ":email" => $_SESSION['email']));
        
        
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
					
						 <h3 style='color:green; font-weight:900;'>ADMIN UPDATED!</h3>
							  
							<form action='logout.php' method='POST'> 
							<button type='submit' style='font-weight:900;'  class='btn btn-success'>CONTINUE</button>  </form>


							  </center>
							</div> 
							</div></div>
						</div> </div>
		
		
		
		";
    }
}

?>						
 
 <?php include 'headeradmin.php'; ?>
 
   
    <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
     <!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card shadow" style="background-color: grey; color:white;"  >
            <div class="card-header border-0">
              <h3 class="mb-0"><a href=""   class="btn btn-danger">CHANGE ADMIN EMAIL & PASSWORD </a></h3>
            </div>
          
           <div class="card-body">
               
              <?php if (isset($msg)) echo $msg; ?>   
                  
               
<div class="container-fluid">
 


 						<form method="POST">
                           
                                <div class="row">
                                	
                                    
                                    <div class="col-md-6 form-group">
                                        <label>Enter New Email</label>
                                        <input type="text" name="email"  value="" class="input-sm form-control " required/>
                                    </div>
                                    
                                    
                                    
                                	<div class="col-md-6 form-group">
                                        <label>New Password</label>
                                        <input type="text" name="upass"  class="input-sm form-control " required/>
                                    </div>
                                    
                                    
                                </div>
                                
                        <br>
                            
                                    <div class="btn-group">
                                
                                        <button type="submit" name="edit" class="btn btn-success btn-lg">Change Password</button>

                                    </div>
                          
                          
                        </form>







</div>
               
               
               
          </div>
        </div>
      </div>
     </div>
 </div>
    
       <?php include 'foot.php'; ?>



