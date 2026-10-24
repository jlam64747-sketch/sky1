<?php //Start the Session

session_start();

require "connectdb.php";
require_once "class.admin.php";
//3. If the form is submitted or not.
//3.1 If the form is submitted
if (isset($_POST["email"]) and isset($_POST["upass"])) {
    //3.1.1 Assigning posted values to variables.
    $email = $_POST["email"];
    $upass = $_POST["upass"];

    //3.1.2 Checking the values are existing in the database or not
    $query = "SELECT * FROM admin WHERE email='$email' and upass='$upass'";

    ($result = mysqli_query($connection, $query)) or
        die(mysqli_error($connection));
    $count = mysqli_num_rows($result);
    //3.1.2 If the posted values are equal to the database values, then session will be created for the user.
    if ($count == 1) {
        $_SESSION["email"] = $email;
    } else {
        //3.1.3 If the login credentials doesn't match, he will be shown with an error message.
        $msg = "<div class='alert alert-danger'>
						<button class='close' data-dismiss='alert'>&times;</button>
						  Invalid Email or Password!
                   
			  </div>";
    }
}
//3.1.4 if the user is logged in Greets the user with message
if (isset($_SESSION["email"])) {
    $email = $_SESSION["email"];
    header("Location: index.php");
} else {
}

//3.2 When the user visits the page first time, simple login form will be displayed.
?>

  
<!DOCTYPE html>
<html lang="en" class="h-100">


<head>
     <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<meta name="robots" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Dolab : Dolab Personal Banking Admin Bootstrap 5 Template">
	<meta property="og:title" content="Dolab : Dolab Personal Banking Admin Bootstrap 5 Template">
	<meta property="og:description" content="Dolab : Dolab Personal Banking Admin Bootstrap 5 Template">
	<meta property="og:image" content="social-image.png">
	<meta name="format-detection" content="telephone=no">
	
	<!-- PAGE TITLE HERE -->
	<title><?php echo $site_title; ?> | personal savings account</title>
	
	<!-- FAVICONS ICON -->
	   <link href="../public/images/favicon.png" rel="shortcut icon">
	<link href="vendor/jquery-nice-select/css/nice-select.css" rel="stylesheet">
	<link href="vendor/jquery-autocomplete/jquery-ui.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	
	
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
	

<script type="text/javascript" src="https://code.jquery.com/jquery-1.8.2.js"></script>
<style type="text/css">
#overlay {
position: fixed;
top: 0;
left: 0;
width: 100%;
height: 100%;
background-color: #000;
filter:alpha(opacity=70);
-moz-opacity:0.7;
-khtml-opacity: 0.7;
opacity: 0.7;
z-index: 100;
display: none;
}
 
.popup{
width: 75%;
margin: 0 auto;
display: none;
position: fixed;
z-index: 101;
}
 
</style>
<script type='text/javascript'>
$(function(){
var overlay = $('<div id="overlay"></div>');
overlay.show();
overlay.appendTo(document.body);
$('.popup').show();
$('.close').click(function(){
$('.popup').hide();
overlay.appendTo(document.body).remove();
return false;
});


 

$('.x').click(function(){
$('.popup').hide();
overlay.appendTo(document.body).remove();
return false;
});
});
</script> 

</head>

<body class="body  h-100" style="background-color:#f7f7f7;">
 <!--*******************
        Preloader start
    ********************-->
	 <div id="preloader"  style="background-color:#0000FF;">
        <div class="inner">
            <span><img src="../public/images/logo-white.png" height="70px" ></img></span>
            <div class="loading">  
            </div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->
	
	<div class="container h-100" >
		<div class="row h-100 align-items-center justify-contain-center">
			<div class="col-xl-12">
				<div class="card">
					<div class="card-body " style="background-color:white; border-radius:10px">
						<div class="row m-0">
							<div class="col-xl-6 col-md-6">
								
								
									<div class="sign-in-your">
								
							 
							 
										<center>	<img src="../public/images/logo.png"  height="50px" width="150px"></img> </center>
										 <hr>
								
									<h3 style="color:black;"><i class=' 	fas fa-landmark' style='font-size:28px;color:black'></i> ADMINISTRATOR ONLY</h3>
									<span class="text-black">Welcome back! Admin</span>
									
									<br><br>
			 
		  <?php if (isset($msg)) {
        echo $msg;
    } ?>
									
			<form action="" method="POST">
				<div class="mb-3">
					<label class="mb-1" style="color:black;"><strong><i class='fas fa-user-alt' style='font-size:18px;color:black'></i>  &nbsp; Admin Email</strong></label>
					<input type="text" style="border-color:black; color:black;" name="email" class="form-control" placeholder="hello@example.com" required>
				</div>
				<div class="mb-3">
					<label style="color:black;" class="mb-1"><strong><i class='fas fa-user-shield' style='font-size:18px;color:black'></i>  &nbsp;Admin Password</strong></label>
					<input type="password" style="border-color:black; color:black;"  name="upass" class="form-control" placeholder="Password" required>
				</div>
				 
										
										 
										
										
										<div class="text-center">
											<button type="submit" name="code" class="btn btn-success btn-block"> <i class='fas fa-user-lock' style='font-size:18px;color:white'></i> &nbsp;SUBMIT</button>
										</div>
									</form>
								</div>
								
								
							</div>
							
							
							
							
							<div class="col-xl-6 col-md-6  sign text-center">
							
							<div class="header-profile20">
									
									<img src="images/img8.jpg" class="education-img"></img>
								</div>	
								
							
							
							
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="vendor/global/global.min.js"></script>
	<script src="vendor/jquery-autocomplete/jquery-ui.js"></script> 
    <script src="js/custom.min.js"></script>
    <script src="js/dlabnav-init.js"></script> 
	
</body>
 
</html>  
                    
                        
                     
             