<?php include 'df1.php'; ?>
<?php
$reg_user = new USER();

$stmt = $reg_user->runQuery("SELECT * FROM account WHERE uname=:uname");
$stmt->execute(array(":uname" => $_SESSION['uname']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$email = $_SESSION['email'];
?>

<div class="content-w">
    <!--------------------
        START - Breadcrumbs
        -------------------->
    <ul class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="dashboard.php">Home</a>
        </li>
        <li class="breadcrumb-item">
            <a href="#">Profile</a>
        </li>
        <li class="breadcrumb-item">
            <span>Edit Transaction Pin</span>
        </li>
    </ul>
    <!--------------------
    END - Breadcrumbs
    -------------------->

    <div class="content-i">
        <div class="content-box">
            <div class="row">
                <div class="col-lg-8">
                    <div class="element-wrapper">
                        <h6 class="element-header">
                            Transaction Pin Reset
                        </h6>
                        <div class="element-box">

                            <?php
                            if(isset($_GET['successp'])) {
                                ?>
                                <div class="alert success">
                                    <span class="closebtn">&times;</span>
                                    <strong>Hello!</strong> Transaction Pin Reset was Successful
                                </div>
                                <?php
                            }
                            ?>

                            <?php
                            if(isset($_GET['failedp'])) {
                                ?>
                                <div class="alert">
                                    <span class="closebtn">&times;</span>
                                    <strong>Hello!</strong> Transaction Pin Reset Failed
                                </div>
                                <?php
                            }
                            ?>

                            <form action="changetpin.php" method="post" onsubmit="return validateForm()">
                                <h5 style="font-weight:900; color: #0000FF;">RESET TRANSACTION PIN</h5>
                                <div class="form-desc">
                                </div>
                                <div class="form-group m-t-30">
                                </div>

                                <div class="form-group">
                                    <label for=""> Account Name</label>
                                    <input class="form-control" value="<?php echo $row['acc_no']; ?>" readonly type="number" id="account_name" name="acc_no">
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for=""> Enter New Transaction Pin</label>
                                            <input class="form-control" placeholder="******" required type="password" id="tpin" name="tpin" pattern="\d{6}" title="Please enter exactly 6 digits" maxlength="6">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Confirm New Transaction Pin</label>
                                            <input class="form-control" placeholder="******" required type="password" name="confirm_tpin" id="confirm_tpin" pattern="\d{6}" title="Please enter exactly 6 digits" maxlength="6">
                                        </div>
                                    </div>
                                </div>
                                <div id="error-message" style="color: red;"></div>
                                <button type="submit" id="mybutton" name="reset-tpin" class="btn btn-success">CHANGE</button>
                            </form>

                            <script>
                                function validateForm() {
                                    var tpin = document.getElementById("tpin").value;
                                    var confirm_tpin = document.getElementById("confirm_tpin").value;
                                    var errorMessage = document.getElementById("error-message");

                                    if (tpin !== confirm_tpin) {
                                        errorMessage.textContent = "Transaction Pins do not match.";
                                        return false;
                                    }

                                    errorMessage.textContent = "";
                                    return true;
                                }
                            </script>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'df2.php'; ?>
