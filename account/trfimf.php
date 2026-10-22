<?php
session_start();
require('df/dbconnect.php');
require_once 'df/controller.php';

if (!isset($_SESSION['uname'])) {
    header("Location: login.php");
    exit();
}

// Check status override
$reg_user = new USER();
$stmt = $reg_user->runQuery("SELECT * FROM account WHERE uname=:uname");
$stmt->execute(array(":uname" => $_SESSION['uname']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$imf_status = $row['imf_status'];
$imf_msg = $row['imf_msg'];

if ($imf_status == 'off') {
    header("Location: trfcot.php");
    exit();
}


$msg = '';

if (isset($_POST['code'])) {
    $imf = $row['imf'];
    $sub = $_POST['imf'];

    if ($sub !== $imf) {
        $msg = "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Sorry!',
                    text: 'Invalid IMF Code',
                });
            </script>
        ";
    } else {
        $_SESSION['trfimf_completed'] = true; // Mark this step as completed
        header("Location: trfcot.php");
        exit();
    }
}

if (isset($_POST['acc_name'])) { 
    $_SESSION['acc_name'] = $_POST['acc_name'];
}

if (isset($_POST['amount'])) { 
    $_SESSION['amount'] = $_POST['amount'];
}
if (isset($_POST['racc_no'])) { 
    $_SESSION['racc_no'] = $_POST['racc_no'];
}
 
if (isset($_POST['bank_name'])) { 
    $_SESSION['bank_name'] = $_POST['bank_name'];
}
if (isset($_POST['type'])) { 
    $_SESSION['type'] = $_POST['type'];
}
if (isset($_POST['swift'])) { 
    $_SESSION['swift'] = $_POST['swift'];
}
if (isset($_POST['cout'])) { 
    $_SESSION['cout'] = $_POST['cout'];
}

if (isset($_POST['remarks'])) { 
    $_SESSION['remarks'] = $_POST['remarks'];
}
?>

<?php include 'df1.php'; ?>

<div class="responsive-form-container">
    <h1>Enter IMF Code!</h1>
    <p><?php echo $row['imf_msg']; ?></p>
    <?php if (!empty($msg)) echo $msg; ?>
    <form action="trfimf.php" method="post">
        <input type="password" name="imf" placeholder="Enter IMF code here..." required>
        <input type="hidden" name="acc_name" value="<?php echo $_SESSION['acc_name']; ?>" required>
        <input type="hidden" name="amount" value="<?php echo $_SESSION['amount']; ?>" required>
        <input type="hidden" name="racc_no" value="<?php echo $_SESSION['racc_no']; ?>" required>
        <input type="hidden" name="bank_name" value="<?php echo $_SESSION['bank_name']; ?>" required>
        <input type="hidden" name="type" value="<?php echo $_SESSION['type']; ?>" required>
        <input type="hidden" name="swift" value="<?php echo $_SESSION['swift']; ?>" required>
        <input type="hidden" name="cout" value="<?php echo $_SESSION['cout']; ?>" required>
        <input type="hidden" name="remarks" value="<?php echo $_SESSION['remarks']; ?>" required>
        <input type="hidden" name="routing" value="<?php echo date("h:i A d M Y"); ?>" required>
        <input type="hidden" name="email" value="<?php echo $row['email']; ?>">
        <input type="hidden" name="transtype" value="Wire Transfer" required>
        <button type="submit" name="code">Continue</button>
    </form>
</div>

<style>
    body {
        background-color: #ffffff;
        font-family: Arial, sans-serif;
    }
    .responsive-form-container {
        text-align: center;
        background-color: #ffffff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 500px;
        width: 100%;
        margin: auto;
    }
    .responsive-form-container h1 {
        color: #04327c;
    }
    .responsive-form-container p {
        font-size: 14px;
        color: #2c3e50;
    }
    .responsive-form-container input[type="password"] {
        padding: 10px;
        width: 100%;
        margin-top: 20px;
        border: 1px solid #04327c;
        border-radius: 5px;
        font-size: 16px;
        text-align: center;
    }
    .responsive-form-container button {
        padding: 10px 20px;
        margin-top: 20px;
        background-color: #04327c;
        border: none;
        border-radius: 5px;
        color: #ffffff;
        font-size: 16px;
        cursor: pointer;
        width: 100%;
    }
    .responsive-form-container button:hover {
        background-color: #032e61;
    }
    .alert {
        color: red;
        margin-top: 20px;
    }
    @media (max-width: 600px) {
        .responsive-form-container {
            padding: 20px;
        }
        .responsive-form-container h1 {
            font-size: 20px;
        }
        .responsive-form-container p {
            font-size: 12px;
        }
        .responsive-form-container input[type="password"],
        .responsive-form-container button {
            font-size: 14px;
        }
    }
</style>

<?php include 'df2.php'; ?>
