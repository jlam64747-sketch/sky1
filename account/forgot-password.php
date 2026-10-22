<?php
require_once 'df/dbconnect.php';
?>

<?php

 session_start();
 
if (isset($_POST['acc_no'])) { 
    $_SESSION['acc_no'] = $_POST['acc_no'];
}

if (isset($_POST['email'])) { 
    $_SESSION['email'] = $_POST['email'];
} 

?>
<!DOCTYPE html>
<html>
  
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <title>Forget Password | <?php echo $site_title; ?></title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="template language" name="keywords">
    <meta content="" name="author">
    <meta content="" name="description">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="public/images/favicon.png" rel="shortcut icon">
    <link href="apple-touch-icon.html" rel="apple-touch-icon">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet" type="text/css">
    <link href="bower_components/perfect-scrollbar/css/perfect-scrollbar.min.html" rel="stylesheet">
    <link href="public/dashboard/bower_components/slick-carousel/slick/slick.css" rel="stylesheet">
    <link href="public/dashboard/css/main4e61.css?version=4.4.0" rel="stylesheet">
  
  


<style>
.alert {
  padding: 20px;
  background-color: #f44336;
  color: white;
  opacity: 1;
  transition: opacity 0.6s;
  margin-bottom: 15px;
}

.alert.success {background-color: #04AA6D;}
.alert.info {background-color: #2196F3;}
.alert.warning {background-color: #ff9800;}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}
</style>
  </head>
  <body class="auth-wrapper">
    <div class="all-wrapper menu-side with-pattern pt-5">
      <div class="auth-box-w">
          
        <div class="logo-w">
           <?php
        if(isset($_GET['success']))
		{
			?>
             <div class="alert success">
  <span class="closebtn">&times;</span>  
  <strong>Hello!</strong> Password Change Successfully
               <br>
               <a href="login.php" class="btn btn-danger">CLICK HERE</a>
</div>
	<?php
		}
		?>
          <a href=""><img alt="" src="public/images/logo.png" width="200" height=""></a>
        </div>
		
        
								
   <?php
        if(isset($_GET['step1']))
		{
			?>    
        <h4 class="auth-header">
          Password Reset Step One
        </h4>
        <form action="fpasscode.php" method="post">
            <div class="form-group m-b-10">
                            </div>
          <div class="form-group">
            <label for="">Email Address</label><input class="form-control" placeholder="Enter your email" name="email" type="text" required>
            <div class="pre-icon os-icon os-icon-user-male-circle"></div>
          </div>
          <div class="form-group">
            <label for="">Account Number</label><input class="form-control" placeholder="Enter your account number" name="acc_no" type="number" required>
            <div class="pre-icon os-icon os-icon-user-male-circle"></div>
          </div>
 
          <div class="buttons-w">
             <button class="btn btn-primary" name="reset" type="submit">Check</button>
           
          </div>
        </form>
        
        	<?php
		}
		?>
        
        
        <?php
        if(isset($_GET['step2']))
		{
			?>    
        <h4 class="auth-header">
          Password Reset Step Two
        </h4>
        <form action="fpasscode.php" method="post">
            <div class="form-group m-b-10">
                            </div>
          <div class="form-group">
            <label for="">Enter New Password</label><input class="form-control" placeholder="*******" name="upas" type="password" required>
            <div class="pre-icon os-icon os-icon-user-male-circle"></div>
          </div>
          <div class="form-group">
            <label for="">Confirm New Password</label><input class="form-control" placeholder="******" name="" type="password" required>
            <div class="pre-icon os-icon os-icon-user-male-circle"></div>
          </div>
 			
           <input type="hidden"  name="acc_no" readonly value="<?php echo $_SESSION['acc_no']; ?>" >
           <input type="hidden" name="email"  value="<?php echo $_SESSION['email']; ?>" > 
           <input type="hidden"  name="site_email" readonly value="<?php echo $site_email; ?>" >
          
          
          <div class="buttons-w">
             <button class="btn btn-primary" name="change" type="submit">Change Now</button>
           
          </div>
        </form>
        
        	<?php
		}
		?>
        
      </div>
    </div>
  </body>

</html>
