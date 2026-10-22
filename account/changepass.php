<?php
session_start();
include_once('df/session.php');
include_once('df/controller.php');
if(!isset($_SESSION['uname'])){
header("Location: login.php");
exit(); 
}

$reg_user = new USER();

  if(isset($_POST['reset-pass'])){
        

    
    $conn = mysqli_connect($host, $username, $password, $database);
    
    // Check connection
    
    if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
    }
     
    echo ""; 
    
    $db_select = mysqli_select_db($conn, $database);
    
    
    $upas =$_REQUEST['upas'];
    $upas = md5($upas); 
    $acc_no = $_REQUEST['acc_no'];
    
    
    $sql = "UPDATE `account` SET `upas` = '$upas' WHERE `account`.`acc_no` = $acc_no";
       $insert=mysqli_query($conn, $sql);
       
       if($insert){

	       
		  header("Location: edit-pass.php?success");
			exit;
		   
	   }else{
	       
	      header("Location: edit-pass.php?failed");
			exit;
	       
	       
	   }
   
    
    }
  
           
        	
			
    
		
      
		 
?>