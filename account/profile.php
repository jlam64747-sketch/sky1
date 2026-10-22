<?php include 'df1.php'; ?>
 
  <div class="content-w">
        <!--------------------
                  START - Breadcrumbs
                  -------------------->
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="dashboard.php">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="#">Profile</a>
            </li>
            <li class="breadcrumb-item">
                <span>View</span>
            </li>
        </ul>
        <!--------------------
        END - Breadcrumbs
        -------------------->
 
      <div class="content-i">
            <div class="content-box"><div class="row">
              
                    <div class="col-sm-5">
                      <?php
        if(isset($_GET['success']))
		{
			?>
             <div class="alert success">
  <span class="closebtn">&times;</span>  
  <strong>Hello!</strong> Profile Photo updated Successfully
</div>
	<?php
		}
		?>
                      
                       <?php
        if(isset($_GET['editsuccess']))
		{
			?>
             <div class="alert success">
  <span class="closebtn">&times;</span>  
  <strong>Hello!</strong> Profile Information Updated Successfully
</div>
	<?php
		}
		?>
                       <?php
        if(isset($_GET['editfailed']))
		{
			?>
             <div class="alert danger">
  <span class="closebtn">&times;</span>  
  <strong>Hello!</strong> Something Went Wrong
</div>
	<?php
		}
		?>
                        <div class="user-profile compact">
                            <div class="up-head-w"  style="background-image:url(backend/pic/<?php echo $row['filename']; ?>)"  >
                                <div class="up-main-info">
								
								<img src="backend/pic/<?php echo $row['filename']; ?>" style="height: 100px; width: 100px;
								
								border-radius:40px;
								border: solid 5px;
								border-color: white;
								
								" alt="">
								
								
                                    <h2 class="up-header">
                                        <?php echo $row['fname']; ?> <?php echo $row['lname']; ?>
                                    </h2>
                         
                                </div>
                                <svg class="decor" width="842px" height="219px" viewBox="0 0 842 219" preserveAspectRatio="xMaxYMax meet" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><g transform="translate(-381.000000, -362.000000)" fill="#FFFFFF"><path class="decor-path" d="M1223,362 L1223,581 L381,581 C868.912802,575.666667 1149.57947,502.666667 1223,362 Z"></path></g></svg>
                            </div>
                            <div class="up-controls">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="value-pair">
                                            <div class="label">
                                                Status:
                                            </div>
                                            <div class="value badge badge-pill <?php echo ($row['status'] == 'Active') ? 'badge-success' : 'badge-danger'; ?>">
    <?php echo $row['status']; ?>
</div>

                                        </div>
                                    </div>
                                    <div class="col-sm-6 text-right">
                                       <span style="font-size: 12px">Account no:</span>  <a class="btn btn-primary btn-sm" href=""><i class="os-icon os-icon-link-3"></i><span> <?php echo $row['acc_no']; ?></span></a>
                                    </div>
                                </div>
                            </div>
                            <div class="padded">
                                <div class="os-progress-bar primary">
                                  <div class="bar-labels">
                                    <div class="bar-label-left">
                                      <span>Profile Completion</span><span class="positive">+10</span>
                                    </div>
                                    <div class="bar-label-right">
                                      <span class="info">100/100</span>
                                    </div>
                                  </div>
                                  <div class="bar-level-1" style="width: 100%">
                                    <div class="bar-level-2" style="width: 100%">
                                      <div class="bar-level-3" style="width: 90%"></div>
                                    </div>
                                  </div>
                                </div>
                                <div class="os-progress-bar primary">
                                  <div class="bar-labels">
                                    <div class="bar-label-left">
                                      <span>Account Security</span><span class="positive">+5</span>
                                    </div>
                                    <div class="bar-label-right">
                                      <span class="info">100/100</span>
                                    </div>
                                  </div>
                                  <div class="bar-level-1" style="width: 100%">
                                    <div class="bar-level-2" style="width: 100%">
                                      <div class="bar-level-3" style="width: 95%"></div>
                                    </div>
                                  </div>
                                </div>
                                <div class="os-progress-bar primary">
                                  <div class="bar-labels">
                                    <div class="bar-label-left">
                                      <span>Verification</span><span class="negative"></span>
                                    </div>
                                    <div class="bar-label-right">
                                      <span class="info">90/100</span>
                                    </div>
                                  </div>
                                  <div class="bar-level-1" style="width: 100%">
                                    <div class="bar-level-2" style="width: 90%">
                                      <div class="bar-level-3" style="width: 90%"></div>
                                    </div>
                                  </div>
                                  <div style="margin: 25px 0 20px">
                                    <a class="btn btn-primary btn-sm" href="edit-pass.php"><i class="os-icon os-icon-lock"></i><span>Change Password</span></a>
                                    <a class="btn btn-primary btn-sm" href="edit-tpin.php"><i class="os-icon os-icon-lock"></i><span>Change Pin</span></a>
                                    
                                    <button id="myBtn" class="btn btn-primary btn-sm"><i class="os-icon os-icon-user"></i><span>Update Photo</span></button>
                        
                                </div>
                                </div>
                              </div>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="element-wrapper">
                            <div class="element-box">
                                <form action="editprofilecode.php"  method="POST"> 
                                    <div class="element-info">
                                        <div class="element-info-with-icon">
                                          	
                                          
                                            <div class="element-info-icon">
                                                <div class="os-icon os-icon-wallet-loaded"></div>
                                            </div>
                                          				
                                            <div class="element-info-text">
                                                <h5 class="element-inner-header">
                                                    Profile Information
                                                </h5>
                                                
                                                    
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for=""> Email address</label><input class="form-control" data-error="Your email address is invalid" value=" <?php echo $row['email']; ?>" disabled required="required" type="email">
                                        <div class="help-block form-text with-errors form-control-feedback"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for=""> Username</label><input class="form-control" data-error="Your email address is invalid" value=" <?php echo $row['uname']; ?>" disabled required="required" type="email">
                                        <div class="help-block form-text with-errors form-control-feedback"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for=""> First Name</label><input class="form-control"  value=" <?php echo $row['fname']; ?>" name="fname" required="required" type="text">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Last Name</label><input class="form-control" data-match-error="Passwords don&#39;t match" value=" <?php echo $row['lname']; ?>" name="lname" required="required" type="text">
                                                <div class="help-block form-text with-errors form-control-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <fieldset class="form-group">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for=""> Address</label>
                                                    <textarea class="form-control"  id="" cols="" rows="" name="addr" required="required"><?php echo $row['addr']; ?></textarea>
                                                    <div class="help-block form-text with-errors form-control-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for=""> Date of Birth</label><input class="form-control" data-error="Please input your First Name"  value="‪<?php echo $row['dob']; ?>" name="dob" required="required" type="text">
                                                    <div class="help-block form-text with-errors form-control-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for=""> Phone</label><input class="form-control" data-minlength="6" value="‪<?php echo $row['phone']; ?>‬" name="phone" required="required" type="text">
                                                    <div class="help-block form-text text-muted form-control-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="">Gender</label><input class="form-control" data-match-error="Passwords don&#39;t match" value="<?php echo $row['sex']; ?>" name="sex" required="required" type="text">
                                                    <div class="help-block form-text with-errors form-control-feedback"></div>
                                                </div>
                                            </div>
                                          
                                           <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                  <input type="submit" name="edit-profile" value="EDIT PROFILE" class="btn btn-danger btn-sm" />
                                                </div>
                                            </div>
                                        </div>
                                        
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
 <style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>



<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
   
    
    <center>
      <img src="icons/error.png" style="height:80px; width: 80px;"/>
      
      <br><br>
      <h2 style="font-weight:900;">Update Profile Photo</h2>
    <br>

      									<form method="POST" action="uploadcode.php"  enctype="multipart/form-data" >
									
										
									
									
										<div class="mb-3"> 
											<label class="mb-1" style="color:black;"><strong><i class='fas fa-user-alt' style='font-size:18px;color:black'></i>  &nbsp; Upload Your Photo</strong></label>
											<input type="file" class="btn btn-danger btn-block"  name="uploadfile" class="form-control" required>
										</div>
										
									 
									    <input type="hidden" name="email" value="<?php echo $row['email']; ?>">
										 
										
										
										
										<div class="text-center">
											<button type="submit" name="upload" class="btn btn-success btn-block">  &nbsp;SAVE NOW</button>
										</div>
									
                                          
                                          
									</form>
      
      
       
      </center>
  </div>

</div>

<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

  <?php include 'df2.php'; ?>