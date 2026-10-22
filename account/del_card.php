<?php session_start();
include_once ('df/session.php');
require_once 'df/controller.php';
 


$con = mysqli_connect("$host","$username","$password","$database");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
 $db_select = mysqli_select_db($con, $database);
 
$id=$_REQUEST['id'];


$query = "DELETE FROM `virtual_card` WHERE `virtual_card`.`id` = '$id'";

$result = mysqli_query($con,$query) or die ( mysqli_error());

header("Location: dashboard.php?carddeleted");
exit;		
?>