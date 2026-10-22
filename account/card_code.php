<?php
 session_start();

include_once ('df/session.php');
require_once 'df/controller.php';
if(!isset($_SESSION['uname'])){
header("Location: login.php");
exit(); 
}

$reg_user = new USER();
		 	 
$stmt = $reg_user->runQuery("SELECT * FROM account WHERE uname=:uname");
$stmt->execute(array(":uname" => $_SESSION['uname']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);



if(isset($_POST['add_card'])){

$conn = mysqli_connect($host, $username, $password, $database);

// Check connection

if (!$conn) {
	  die("Connection failed: " . mysqli_connect_error());
}
 
echo ""; 

$db_select = mysqli_select_db($con, $database);

$name =$_REQUEST['name'];
$uname =$_REQUEST['uname'];
$acc_no =$_REQUEST['acc_no'];
$email =$_REQUEST['email'];
$card_no =$_REQUEST['card_no'];
$exp =$_REQUEST['exp'];
$cvv =$_REQUEST['cvv'];
$card_type =$_REQUEST['card_type'];
$card_status =$_REQUEST['card_status'];
$card_bal =$_REQUEST['card_bal'];
$card_date =$_REQUEST['card_date'];


$stmt = $reg_user->runQuery("SELECT * FROM virtual_card WHERE card_no=:card_no");
$stmt1 = $reg_user->runQuery("SELECT * FROM virtual_card WHERE cvv=:cvv"); 
$stmt->execute(array(":card_no" => $card_no));
$stmt1->execute(array(":cvv" => $cvv)); 
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$row1 = $stmt1->fetch(PDO::FETCH_ASSOC);


if ($stmt->rowCount() > 0 || $stmt1->rowCount() > 0) {

header("Location: virtual_card.php?errors");
exit;		
 
} else {        

$sql = "INSERT INTO `virtual_card` (`id`, `name`, `uname`, `acc_no`, `email`, `card_no`, `exp`, `cvv`, `card_type`, `card_status`, `card_bal`, `card_date`) 
VALUES (NULL, '$name', '$uname', '$acc_no', '$email', '$card_no', '$exp', '$cvv', '$card_type', '$card_status', '$card_bal', '$card_date')";
  


   $insert=mysqli_query($conn, $sql);
   
   if($insert){
	   
	   header("Location: dashboard.php?cardsuccess"); 
	   exit;
   }else{
	   
	   header("Location: dashboard.php?cardfailed"); 
	   exit;
	   
   }

}
}
 
		
	 
		
		
       
 
?>