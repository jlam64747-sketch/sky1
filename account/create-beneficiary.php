<?php include 'df1.php'; ?>

<div class="content-w">
    <ul class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="dashboard.php">Home</a>
        </li>
        <li class="breadcrumb-item">
            <a href="#">Beneficiary</a>
        </li>
        <li class="breadcrumb-item">
            <span>Create</span>
        </li>
    </ul>

    <div class="content-i">
        <div class="content-box">
            <div class="row">
                <div class="col-lg-8">
                    <div class="element-wrapper">
                        <h6 class="element-header">Beneficiary</h6>
                        <div class="element-box">

                            <?php if (isset($_GET['success'])) { ?>
                                <div class="alert success">
                                    <span class="closebtn">&times;</span>
                                    <strong>Hello!</strong> Beneficiary Save Successfully
                                </div>
                            <?php } ?>

                            <?php if (isset($_GET['failed'])) { ?>
                                <div class="alert">
                                    <span class="closebtn">&times;</span>
                                    <strong>Hello!</strong> Something Went Wrong
                                </div>
                            <?php } ?>

                            <?php if (isset($_GET['exist'])) { ?>
                                <div class="alert">
                                    <span class="closebtn">&times;</span>
                                    <strong>Hello!</strong> Beneficiary Already Exist
                                </div>
                            <?php } ?>

                            <form method="post" action="bene-code.php">
                                <h5 class="form-header">Add Beneficiary</h5>
                                <div class="form-desc">Save Beneficiary Details</div>
                                <div class="form-group m-t-30"></div>

                                <div class="form-group">
                                    <label for="">Account Name</label>
                                    <input class="form-control" placeholder="Beneficiary Account Name" required type="text" id="account_name" name="rname">
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Account Number</label>
                                            <input class="form-control" placeholder="Beneficiary Account Number" required type="text" id="account_number" name="racc">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Bank Name</label>
                                            <input class="form-control" placeholder="Beneficiary Bank Name" required type="text" name="rbank" id="bank_name">
                                        </div>
                                    </div>
                                </div>
                                <fieldset class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Email</label>
                                                <input class="form-control" placeholder="E-mail" name="remail" required id="email" type="text">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Phone</label>
                                                <input class="form-control" placeholder="Phone" name="rphone" required id="phone" type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="">Swift Code</label>
                                            <input class="form-control" placeholder="Swift Code" name="rswift" required id="dwift" type="text">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="">IBAN Number</label>
                                            <input class="form-control" placeholder="IBAN Number" name="iban" type="text">
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="">Bank Address</label>
                                            <input class="form-control" placeholder="Bank Address" name="badd" required type="text">
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <input type="hidden" name="rtype" value="Beneficiary">
                                    <input type="hidden" name="email" value="<?php echo $row['email']; ?>">
                                    <input type="hidden" name="bdate" value="<?php echo date("h:i A d M Y"); ?>">
                                </fieldset>
                                <div class="form-buttons-w">
                                    <button class="btn btn-primary" name="add_bene" type="submit"> Save Beneficiary </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'df2.php'; ?>
