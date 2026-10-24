<?php session_start();

require_once ('connectdb.php');
 


$con = mysqli_connect("$host","$username","$password","$database");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
 $db_select = mysqli_select_db($con, $database);
 
$ctid=$_REQUEST['ctid'];


$query = "DELETE FROM `c_trans` WHERE `c_trans`.`ctid` = '$ctid'";

$result = mysqli_query($con,$query) or die ( mysqli_error());

 header("Location: approve_crypto.php?del");
			exit;
?>