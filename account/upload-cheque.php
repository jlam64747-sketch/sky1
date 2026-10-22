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
                    Cheque Deposit Upload
                </h6>
                <div class="element-box">
                    <form action="chequeupload.php" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="amt">Deposit Amount</label>
                            <input class="form-control" placeholder="Deposit Amount" type="text" id="acc_name" name="amt" required>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="uploadfile">Cheque Front</label>
                                    <input type="file" id="exp" name="uploadfile" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="uploadfile2">Cheque Back</label>
                                    <input type="file" class="form-control" name="uploadfile2" required>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="status" value="Pending">
                        <input type="hidden" name="email" value="<?php echo $row['email']; ?>">
                        <input type="hidden" name="name" value="<?php echo $row['fname']; ?> <?php echo $row['lname']; ?>">
                        <div class="form-buttons-w">
                            <button class="btn btn-primary" name="upload" type="submit">Upload Cheque</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'df2.php'; ?>
