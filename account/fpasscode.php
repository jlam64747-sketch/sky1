<?php
 session_start();
include_once ('df/session.php');
require_once 'df/controller.php';

$reg_user = new USER();
		 	 
$stmt = $reg_user->runQuery("SELECT * FROM account WHERE uname=:uname");
$stmt->execute(array(":uname" => $_SESSION['uname']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);



if (isset($_POST['acc_no'])) { 
    $_SESSION['acc_no'] = $_POST['acc_no'];
}

if (isset($_POST['email'])) { 
    $_SESSION['email'] = $_POST['email'];
} 
 
 
if (isset($_POST['reset'])) { 

    $acc_no = $_POST['acc_no']; 
    $email = $_POST['email']; 

   $stmt = $reg_user->runQuery("SELECT * FROM account WHERE acc_no = '$acc_no'");
    $stmt1 = $reg_user->runQuery("SELECT * FROM account WHERE email = '$email'");
    $stmt->execute(array(":acc_no" => $acc_no));
     $stmt1->execute(array(":email" => $email));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $row = $stmt1->fetch(PDO::FETCH_ASSOC);
 
         $acc_no = $_SESSION['acc_no'];
         $email = $_SESSION['email'];
         
 
 if ($stmt->rowCount() > 0 || $stmt1->rowCount() > 0) {
       header("Location: forgot-password.php?step2");
				exit; 
    }
 

 else {
         header("Location: forgot-password.php?step1");
				exit; 
    }



}
	   
	
   





if(isset($_POST['change'])){
                                     
$conn = mysqli_connect($host, $username, $password, $database);
 
// Check connection
if($conn === false){
	die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt update query execution


$upas =$_POST['upas'];
$upas = md5($upas);  

$email = $_SESSION['email']; 
$acc_no = $_SESSION['acc_no'];  

$sql = "UPDATE `account` SET `upas` = '$upas' WHERE `account`.`acc_no` = '$acc_no'";

 
			 if(mysqli_query($conn, $sql)){
					
	

			 $to = "$email";
			 $subject = "$site_title New Account Password";
			 
			 $message = "<b>Congratulatons, You have successfully reset your Account Password, See below for your default Login details</b>";
			 $message .= "<h2>New Login</h2>";
			 
			 $message .= "<h4 style='color:green;'>Account Password:  your new password  </h4>"; 
			 
		
			$message .= "<h4 style='color:red;'>Contact us immediately if you did not initiate this change of password</h4>";
			
			 $message .= "<h3 style='color:green;'>$site_title</h3>";
			 
			 $header = "From:$site_email \r\n"; 
			 $header .= "MIME-Version: 1.0\r\n";
			 $header .= "Content-type: text/html\r\n";
			 
			 $retval = mail ($to,$subject,$message,$header);
			 
			 if( $retval == true ) {
				 
			 }else {
				 
			 }      
   
				  
				header("Location: forgot-password.php?success");
				exit; 
								
								
				} else {
					echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
				}
												 
// Close connection
mysqli_close($conn);
 } 
		
		
       
 
?>