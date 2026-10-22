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



$status = $row['status'];
$bill = $row['billing_code'];


$restrictedStatuses = ['Active', 'Transfer Restricted', 'Dormant', 'Locked', 'Inactive'];

if (in_array($status, $restrictedStatuses)) {
    header('Location: dashboard.php?error=under');
    exit();
}
?>

<?php include 'df1.php'; ?>

<div class="content-w">
    <!--------------------
    START - Breadcrumbs
    -------------------->
    <ul class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="dashboard.php">Home</a>
        </li>
        <li class="breadcrumb-item">
            <a href="#">Cheque Deposit</a>
        </li>
        <li class="breadcrumb-item">
            <span>Deposit</span>
        </li>
    </ul>
    <!--------------------
    END - Breadcrumbs
    -------------------->

    <div class="content-i">
        <div class="content-box">
            <div class="element-wrapper">
                <h6 class="element-header">
                    Cheque Deposit
                </h6>
                <div class="element-box">
                    <?php
        if(isset($_GET['success']))
		{
			?>
             <div class="alert success">
  <span class="closebtn">&times;</span>  
  <strong>Recieved!</strong> We will get back to you soon
</div>
	<?php
		}
		?>		
					<?php
        if(isset($_GET['failed']))
		{
			?>
             <div class="alert">
  <span class="closebtn">&times;</span>  
  <strong>Hello!</strong> Deposit Failed
</div>
	<?php
		}
		?>
                    <h5 class="form-header">
                        Recent Cheque Deposit Transactions
                        <a href="upload-cheque.php" class="btn btn-success btn-sm">
    <i class="os-icon os-icon-ui-22"></i><span>UPLOAD CHEQUE</span>
</a>
                    </h5>

                    <div class="table-responsive">
                        <table style="width: 100%;" class="table table-striped table-hover table-lightfont">
                            <thead>
                                <tr>
                                    <th>Reference ID</th>
                                    <th>Front Cheque</th>
                                    <th>Back Cheque</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $email = $row['email'];
                                $his = $reg_user->runQuery("SELECT * FROM cheque WHERE email = '$email' ORDER BY qid DESC LIMIT 10");
                                $his->execute(array(":uname" => $_SESSION['uname']));
                                while ($rows = $his->fetch(PDO::FETCH_ASSOC)) { ?>                    
                                <tr>
                                    <td>TX<?php echo(rand(11111, 99999)); ?><?php echo $rows['id']; ?></td>
                                    <td><?php echo $rows['filename']; ?></td>
                                    <td><?php echo $rows['filename2']; ?></td>
                                    <td class="bolder nowrap">
                                        <span class="text-danger"><?php echo $row['currency']; ?><?php echo $english_format_number = number_format($rows['amt']); ?> <i class="os-icon os-icon-arrow-down"></i></span>
                                    </td>
                                    <td><?php echo $rows['date']; ?></td>
                                    <td><?php echo $rows['status']; ?></td>
                                </tr>
                                <?php } ?>   
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'df2.php'; ?>
