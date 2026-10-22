<?php
session_start();
require('df/dbconnect.php');
include_once('df/session.php');
include_once('df/controller.php');
if(!isset($_SESSION['uname'])){
header("Location: login.php");
exit(); 
}

$reg_user = new USER();
		 	 
$stmt = $reg_user->runQuery("SELECT * FROM account WHERE uname=:uname");
$stmt->execute(array(":uname" => $_SESSION['uname']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);


 
	   
	   
 
		
	 if(isset($_POST['add-deposit'])){
     
        $date =$_REQUEST['date'];
        $status =$_REQUEST['status'];
        $type =$_REQUEST['type'];
        $email =$_REQUEST['email'];
        $amt =$_REQUEST['amt'];            
                                            
     
        $sql = "INSERT INTO `deposit` (`did`, `amt`, `type`, `status`, `date`, `email`) VALUES (NULL, '$amt', '$type', '$status', '$date', '$email');";
                                                      
                                                                            
          
		   $insert=mysqli_query($connection, $sql);
		   
		   if($insert){
		       
		      header("Location: deposit.php?success"); 
				exit;

			   
		   }else{
		       
		      header("Location: deposit.php?failed"); 
				exit;


	   
        }
    }
		
		
       
 
?>