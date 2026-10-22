<?php
session_start();
include_once('df/session.php');
include_once('df/controller.php');
if(!isset($_SESSION['uname'])){
header("Location: login.php");
exit(); 
}


// Database connection
$con = mysqli_connect($host, $username, $password, $database);

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

$id = $_REQUEST['id'];

$query = "DELETE FROM `beneficiary` WHERE `beneficiary`.`id` = '$id'";

$result = mysqli_query($con, $query) or die(mysqli_error($con));

header("Location: beneficiary.php?deleted");
exit();
?>
