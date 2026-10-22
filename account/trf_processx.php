<?php
session_start();
require('df/dbconnect.php');
require_once 'df/controller.php';
 if (!isset($_SESSION['uname'])) {
    header("Location: login.php");
    exit();
}

$reg_user = new USER();
		 	 
$stmt = $reg_user->runQuery("SELECT * FROM account WHERE uname=:uname");
$stmt->execute(array(":uname" => $_SESSION['uname']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
  


	

?>
<?php


if (isset($_POST['acc_name'])) { 
    $_SESSION['acc_name'] = $_POST['acc_name'];
}

if (isset($_POST['amount'])) { 
    $_SESSION['amount'] = $_POST['amount'];
}
if (isset($_POST['racc_no'])) { 
    $_SESSION['racc_no'] = $_POST['racc_no'];
}
 
if (isset($_POST['bank_name'])) { 
    $_SESSION['bank_name'] = $_POST['bank_name'];
}
if (isset($_POST['type'])) { 
    $_SESSION['type'] = $_POST['type'];
}
if (isset($_POST['swift'])) { 
    $_SESSION['swift'] = $_POST['swift'];
}
if (isset($_POST['cout'])) { 
    $_SESSION['cout'] = $_POST['cout'];
}

if (isset($_POST['remarks'])) { 
    $_SESSION['remarks'] = $_POST['remarks'];
}

?>
 
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
                <a href="#">Transfer</a>
            </li>
            <li class="breadcrumb-item">
                <span>Processing</span>
            </li>
        </ul>
        <!--------------------
        END - Breadcrumbs
        -------------------->

 
   <div class="content-i">
            <div class="content-box">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="element-wrapper">
                            <h6 class="element-header">
                                Processing Transfer
                            </h6>
                            <div class="element-box">
                                
                                    <h5 style="font-weight:900; color: #0000FF;">TRANSACTION PROCESSING</h5>
                                    <div class="form-desc">
                                        
                                    </div>
                                    <div class="form-group m-t-30">
                                                                            </div>
                                    
                                    
										 
						
						  
						 
						 
						 
						 <script>
					function move() {
        var elem = document.getElementById("myBar");
        var width = 0;
        var id = setInterval(frame,80);
        function frame() {
            if (width >= 100) {

                var confirmButton = document.getElementById("confirm");
                confirmButton.className = "btn btn-success";
                confirmButton.innerHTML = "<i class='fas fa-key'></i> Please Confirm";
                confirmButton.removeAttribute('disabled');
                confirmButton.setAttribute('href','process_trf.php');
                clearInterval(id);

            } else {
                width++;
                elem.style.width = width + '%';
                elem.innerHTML = width * 1  + '%';
            }
        }
    }
    window.onload = move;
	</script>
	
	<style>
	@-webkit-keyframes progress-bar-stripes {
  from {
    background-position: 1rem 0;
  }
  to {
    background-position: 0 0;
  }
}

@keyframes progress-bar-stripes {
  from {
    background-position: 1rem 0;
  }
  to {
    background-position: 0 0;
  }
}

.progress {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  height: 1rem;
  overflow: hidden;
  font-size: 0.675rem;
  background-color: #e9ecef;
  border-radius: 4px;
}

.progress-bar {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
      -ms-flex-direction: column;
          flex-direction: column;
  -webkit-box-pack: center;
      -ms-flex-pack: center;
          justify-content: center;
  color: #fff;
  text-align: center;
  background-color: #0297c6;
  -webkit-transition: width 0.6s ease;
  transition: width 0.6s ease;
}

.progress-bar-striped {
  background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
  background-size: 1rem 1rem;
}

.progress-bar-animated {
  -webkit-animation: progress-bar-stripes 1s linear infinite;
          animation: progress-bar-stripes 1s linear infinite;
}
</style>
			

<script>
    $(document).ready(function() {
      $('#mybutton').hide().delay(3000).fadeIn(2000);
});
    </script>	


 
  
   
			
			 <div aria-valuemax="100" style="font-weight: 700;" class="progress-bar progress-bar-striped progress-bar-animated bg-success" 
						 role="progressbar" id="myBar"></div>
			<br>
					<center><h5 style="color:green; font-weight:500;">You're Transferring <img src="icons/loading5.gif" height="20px"/> <a style="color:red;"><?php echo $row['currency']; ?><?php echo $_SESSION['amount']; ?>.00</a> 
						<br>TO<br><?php echo $_SESSION['acc_name']; ?> <img src="icons/loading-56.gif" height="20px"/> at 
						<a style="color:black;"><?php echo $_SESSION['bank_name']; ?></a> <br>
        <span style="color:blue;">
            (The amount will be converted to the selected currency during the transfer)
        </span></h5>
					<center>	
						
				<br>		
           
                     
					 
					 <input  value="<?php echo $_SESSION['remarks']; ?>" name="remarks" type="hidden" required>
                            	<input value="<?php echo $_SESSION['bank_name']; ?>" name="bank_name" type="hidden" required>
								<input   value="<?php echo $_SESSION['amount']; ?>" name="amount" type="hidden" required>
								<input  value="<?php echo date("h:i A d M Y"); ?>" name="routing" type="hidden" required>
   	                        <input  value="<?php echo $_SESSION['acc_name']; ?>" name="acc_name" type="hidden"  required>
								<input  value="<?php echo $_SESSION['racc_no']; ?>" name="acc_no" type="hidden" required>
							 <input  value="<?php echo $_SESSION['swift']; ?>" name="swift" type="hidden"  required>
							 <input  value="<?php echo $_SESSION['cout']; ?> " name="cout" type="hidden" required>
							  <input type="hidden" name="type" value="2"> 
						    <input type="hidden"  name="email" value="<?php echo $row['email']; ?> "/>
                            <input id="name" class="form-control" value="Wire Transfer" name="transtype" type="hidden" required>
					 
					 
					 
					 
					 
                    <button id="myBtn" class="btn btn-success">CONTINUE</button>
                
 
						 
						 
					 
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
  width: 40%;
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
      <h2 style="font-weight:900;">Account Suspended!</h2>
    <br>
    <h6>Ooops there was an error completing this transfer please contact support if problem persists</h6>
    <br>
      <strong style="font-size: 16px; color: darkgreen;">Contact support for assistance at <a href="mailto:support@skylarkcapitalbk.com">support@skylarkcapitalbk.com</a> </strong>
      
      <br><br>
      
      <a href="dashboard.php"  class="btn btn-success">OKAY</a>
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
  
  


	
				 