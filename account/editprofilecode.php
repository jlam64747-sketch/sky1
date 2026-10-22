<?php
session_start();
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

  if(isset($_POST['edit-profile'])){
        
     $conn = mysqli_connect($host, $username, $password, $database);
    
    // Check connection
    
    if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
    }
     
     
    echo ""; 
    
    $db_select = mysqli_select_db($conn, $database);
    
    
    $fname =$_REQUEST['fname'];
    $lname =$_REQUEST['lname'];
    $addr =$_REQUEST['addr'];
    $sex =$_REQUEST['sex'];
    $dob =$_REQUEST['dob'];
    $phone =$_REQUEST['phone'];

    $uname = $_row['uname'];
     $uname = $_SESSION['uname'];
    
    
    $sql = "UPDATE `account` SET `fname` = '$fname', `lname` = '$lname', `addr` = '$addr', `sex` = '$sex', `dob` = '$dob', `phone` = '$phone' WHERE `account`.`uname` = '$uname';";
    
       $insert=mysqli_query($conn, $sql);
       
       if($insert){

	       
		  header("Location: profile.php?editsuccess");
			exit;
		   
	   }else{
	       
	      header("Location: profile.php?editfailed");
			exit;
	       
	       
	   }
   
    
    }
  
           
        	
			
    
		
      
		 
?>