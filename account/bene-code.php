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

if (isset($_POST['add_bene'])) {
     $conn = mysqli_connect($host, $username, $password, $database);
    
    // Check connection
    
    if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
    }
     

    // Get form inputs
    $uname = $_SESSION['uname'];
    $bdate = $_REQUEST['bdate'];
    $rphone = $_REQUEST['rphone'];
    $email = $_REQUEST['email'];
    $racc = $_REQUEST['racc'];
    $rbank = $_REQUEST['rbank'];
    $rname = $_REQUEST['rname'];
    $remail = $_REQUEST['remail'];
    $rswift = $_REQUEST['rswift'];
    $baddress = $_REQUEST['badd'];
    $iban = $_REQUEST['iban'];
    $rtype = $_REQUEST['rtype'];

    // Check for existing beneficiaries
    $stmt = $reg_user->runQuery("SELECT * FROM beneficiary WHERE rswift=:rswift");
    $stmt1 = $reg_user->runQuery("SELECT * FROM beneficiary WHERE racc=:racc");
    $stmt->execute(array(":rswift" => $rswift));
    $stmt1->execute(array(":racc" => $racc));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);

    if ($stmt->rowCount() > 0 || $stmt1->rowCount() > 0) {
        header("Location: create-beneficiary.php?exist");
        exit();
    } else {
        // Insert new beneficiary
        $sql = "INSERT INTO `beneficiary` (`id`, `uname`, `email`, `racc`, `rbank`, `rname`, `remail`, `rswift`, `iban`, `baddress`, `bdate`, `rtype`) 
                VALUES (NULL, '$uname', '$email', '$racc', '$rbank', '$rname', '$remail', '$rswift', '$iban', '$baddress', '$bdate', '$rtype')";

        $insert = mysqli_query($conn, $sql);

        if ($insert) {
            header("Location: create-beneficiary.php?success");
            exit();
        } else {
            header("Location: create-beneficiary.php?failed");
            exit();
        }
    }
}
?>
