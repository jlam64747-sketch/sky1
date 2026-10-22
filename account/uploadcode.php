<?php
session_start();
include_once ('df/session.php');
require_once 'df/controller.php';
if(!isset($_SESSION['uname'])){
header("Location: login.php");
exit(); 
}


$reg_user = new USER();

$uname = $_SESSION['uname'];
$stmt = $reg_user->runQuery("SELECT * FROM account WHERE uname = '$uname'");
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);


// If upload button is clicked ...
  if (isset($_POST['upload'])) {
 
	$conn = mysqli_connect("$host", "$username", "$password", "$database");
  
    // Check connection
    
    if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
    }
     
    echo ""; 
    
    $db_select = mysqli_select_db($conn, $database);
	
  
    
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];   
        $folder = "backend/pic/".$filename;
		
  $uname = $_SESSION['uname'];
   $sql = "UPDATE account SET filename = '$filename', kyc = '1' WHERE uname = '$uname'";
  
 
 
     
        // Execute query
        mysqli_query($conn, $sql);
     if (move_uploaded_file($tempname, $folder))  {
            			 
         	header("Location: profile.php?success"); 
	   exit;
     }
        
        else{
            	header("Location: profile.php?failed"); 
	   exit;
      }
  
  $result = mysqli_query($conn, "SELECT * FROM image");


} 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
 
?>