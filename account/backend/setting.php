<?php
session_start();
require_once('class.admin.php');
include_once('session.php');

$reg_user = new USER();

if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$mail = $_SESSION['email'];

$ad = $reg_user->runQuery("SELECT * FROM admin WHERE email = :email");
$ad->execute([':email' => $mail]);
$rom = $ad->fetch(PDO::FETCH_ASSOC);

// Fetch bank settings
$stmt = $reg_user->runQuery("SELECT * FROM bank_settings WHERE id = 1");
$stmt->execute();
$bank_settings = $stmt->fetch(PDO::FETCH_ASSOC);

// Handle form submission
if (isset($_POST['update'])) {
    $bank_name = htmlspecialchars(strip_tags(trim($_POST['bank_site_name'])));
    $bank_email = htmlspecialchars(strip_tags(trim($_POST['bank_site_email'])));
    $bank_domain = htmlspecialchars(strip_tags(trim($_POST['bank_site_domain'])));
    $bank_phone = htmlspecialchars(strip_tags(trim($_POST['bank_site_phone'])));
    $bank_address = htmlspecialchars(strip_tags(trim($_POST['bank_site_address'])));
    $loan_status = htmlspecialchars(strip_tags(trim($_POST['loan_status'])));

    // Update bank settings
    $update_stmt = $reg_user->runQuery("UPDATE bank_settings SET bank_site_name = :bank_name, bank_site_email = :bank_email, bank_site_domain = :bank_domain, bank_site_phone = :bank_phone, bank_site_address = :bank_address, loan_status = :loan_status WHERE id = 1");
    $update_stmt->execute([
        ':bank_name' => $bank_name,
        ':bank_email' => $bank_email,
        ':bank_domain' => $bank_domain,
        ':bank_phone' => $bank_phone,
        ':bank_address' => $bank_address,
        ':loan_status' => $loan_status
    ]);

    if ($update_stmt) {
        $msg = "
            <div class='popup'>
                <div class='modal-dialog modal-sm'>
                    <div style='background-color:grey; border: 1px solid; border-color:grey; border-radius:15px;'>
                        <div class='modal-content'>
                            <div class='modal-header' style='background-color:white;'>
                                <h5 class='modal-title'></h5>
                                <button type='button' class='btn-close' data-bs-dismiss='modal'></button>
                            </div>
                            <div class='modal-body' style='background-color:white;'>
                                <center>
                                    <img src='../icons/success.gif' height='70px' width='70px' /><hr>
                                    <h3 style='color:green; font-weight:900;'>SETTINGS UPDATED!</h3>
                                    <form action='index.php' method='POST'>
                                        <button type='submit' style='font-weight:900;' class='btn btn-success'>CONTINUE</button>
                                    </form>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        ";
        $popup = true;
    } else {
        $msg = "Failed to update settings.";
        $popup = false;
    }
}
?>


 <?php include 'headeradmin.php'; ?>
 
 
  
      <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
     <!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card shadow" style="background-color: white; color:black;" >
            <div class="card-header border-0">
              <h3 class="mb-0" style="color:#000;">Settings</h3>
            </div>
          
           <div class="card-body">
               
              <?php if (isset($popup) && $popup): ?>
        <?php echo $msg; ?>
        <script>
            $(document).ready(function() {
                $('.popup').modal('show');
            });
        </script>
    <?php endif; ?>
               
<div class="container-fluid">
 


 <form method="POST">
        <div class="row">
            <div class="col-md-6 form-group">
                <label>Bank Name</label>
                <input type="text" name="bank_site_name" class="input-sm form-control" value="<?php echo htmlspecialchars($bank_settings['bank_site_name']); ?>" required />
            </div>
            <div class="col-md-6 form-group">
                <label>Bank Email</label>
                <input type="text" name="bank_site_email" class="input-sm form-control" value="<?php echo htmlspecialchars($bank_settings['bank_site_email']); ?>" required />
            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-md-6 form-group">
                <label>Bank Domain</label>
                <input type="text" name="bank_site_domain" class="input-sm form-control" value="<?php echo htmlspecialchars($bank_settings['bank_site_domain']); ?>" required />
            </div>
            <div class="col-md-6 form-group">
                <label>Bank Phone Number</label>
                <input type="text" name="bank_site_phone" class="input-sm form-control" value="<?php echo htmlspecialchars($bank_settings['bank_site_phone']); ?>" required />
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 form-group">
                <label>Bank Address</label>
                <input type="text" name="bank_site_address" class="input-sm form-control" value="<?php echo htmlspecialchars($bank_settings['bank_site_address']); ?>" required />
            </div>
            <div class="col-md-6 form-group">
                <label>Loan Status</label>
                <select name="loan_status" class="input-sm form-control" required>
                    <option value="on" <?php echo $bank_settings['loan_status'] == 'on' ? 'selected' : ''; ?>>On</option>
                    <option value="off" <?php echo $bank_settings['loan_status'] == 'off' ? 'selected' : ''; ?>>Off</option>
                </select>
            </div>
        </div>

        <br>
        <button type="submit" name="update" class="btn btn-success btn-sm">Save Settings</button>
    </form>

</div>
               
               
               
          </div>
        </div>
      </div>
     </div>
 </div>
    
       <?php include 'foot.php'; ?>