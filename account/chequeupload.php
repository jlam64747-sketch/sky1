<?php
include_once('df/header.php');
if(!isset($_SESSION['uname'])){
    header("Location: login.php");
    exit();
}

// If upload button is clicked ...
if (isset($_POST['upload'])) {

    $host = 'localhost';
    $db_username = 'silveroa_FREE12';
    $db_password = 'Vision2020@';
    $database = 'silveroa_FREE12';

    // Database connection
    $conn = mysqli_connect($host, $db_username, $db_password, $database);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $name = $_REQUEST['name']; 
    $email = $_REQUEST['email'];
    $amt = $_REQUEST['amt'];
    $status = $_REQUEST['status'];
    
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];  
    
    $filename2 = $_FILES["uploadfile2"]["name"];
    $tempname1 = $_FILES["uploadfile2"]["tmp_name"];  
    
    $folder = "backend/cheque/" . $filename; 
    $folder2 = "backend/cheque/" . $filename2;

    $sql = "INSERT INTO `cheque` (`qid`, `amt`, `email`, `name`, `date`, `filename`, `filename2`, `status`) 
            VALUES (NULL, '$amt', '$email', '$name', CURRENT_TIMESTAMP, '$filename', '$filename2', '$status')";

    // Execute query
    if (mysqli_query($conn, $sql)) {
        if (move_uploaded_file($tempname, $folder) && move_uploaded_file($tempname1, $folder2)) {
            header("Location: cheque-deposit.php?success");
            exit();
        } else {
            header("Location: cheque-deposit.php?failed");
            exit();
        }
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
