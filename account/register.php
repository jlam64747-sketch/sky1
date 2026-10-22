<?php
require_once 'df/dbconnect.php';
?>
<!DOCTYPE html>
<html>
<div id="google_translate_element"></div>

<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <title>Register | <?php echo $site_title; ?></title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="template language" name="keywords">
    <meta content="" name="author">
    <meta content="" name="description">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <link href="public/images/favicon.png" rel="shortcut icon">
    <link href="apple-touch-icon.html" rel="apple-touch-icon">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet" type="text/css">
    <link href="bower_components/perfect-scrollbar/css/perfect-scrollbar.min.html" rel="stylesheet">
    <link href="public/dashboard/bower_components/slick-carousel/slick/slick.css" rel="stylesheet">
    <link href="public/dashboard/css/main4e62.css?version=4.4.0" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <script src="public/dashboard/js/countries.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .loading-overlay {
            display: none;
            position: fixed;
            z-index: 9999;
            background: rgba(0,0,0,0.6);
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            text-align: center;
            color: #fff;
        }
        .loading-overlay div {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
</head>
<body class="auth-wrapper">
    <div class="loading-overlay">
        <div>
            <h2>Loading...</h2>
            <p>Please wait while we process your request.</p>
        </div>
    </div>
    <div class="all-wrapper menu-side with-pattern pt-5">
        <div class="auth-box-w">
            <div class="logo-w">
                <a href="../"><img alt="" src="public/images/logo.png" width="200" height=""></a>
            </div>
            <h4 class="auth-header">
                Registration Form
            </h4>
            <form id="registration-form" action="process.php" method="post" enctype="multipart/form-data">
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="uname">Username</label>
                        <input class="form-control" placeholder="Enter your username" name="uname" type="text" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="upas">Password</label>
                        <input class="form-control" placeholder="Enter your password" name="upas" type="password" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="email">Email</label>
                        <input class="form-control" placeholder="Enter your email" name="email" type="email" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="fname">First Name</label>
                        <input class="form-control" placeholder="Enter your first name" name="fname" type="text" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="mname">Middle Name</label>
                        <input class="form-control" placeholder="Enter your middle name" name="mname" type="text">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lname">Last Name</label>
                        <input class="form-control" placeholder="Enter your last name" name="lname" type="text" required>
                    </div>
                </div>
                 <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="country">Country</label>
                        <select name="country" class="form-control" id="country" required>
                            <option value="">Select</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="city">City</label>
                        <select name="city" class="form-control" id="state" required>
                            <option value="">Select Country First</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="addr">Address</label>
                        <input class="form-control" placeholder="Enter your address" name="addr" type="text" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="work">Occupation</label>
                        <input class="form-control" placeholder="Enter your Occupation" name="work" type="text" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="sex">Sex</label>
                        <select class="form-control" name="sex" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="dob">Date of Birth</label>
                        <input class="form-control" placeholder="Enter your date of birth" name="dob" type="date" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="phone">Phone</label>
                        <input class="form-control" placeholder="Enter your phone number" name="phone" type="text" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="marry">Marital Status</label>
                        <select class="form-control" name="marry" id="marry" required>
                            <option value="">Select your Marital Status</option>
                            <option value="Single">Single</option>
                            <option value="Married">Married</option>
                            <option value="Divorced">Divorced</option>
                            <option value="Widowed">Widowed</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="currency">Account Currency</label>
                            <?php include 'currency.php'; ?>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="type">Account Type</label>
                        <select class="form-control" name="type" id="type" required>
                            <option value="Savings">Savings Account</option>
                            <option value="Checking">Checking Account</option>
                            <option value="Dormiciliary">Dormiciliary Account</option>
                            <option value="Offshore">Offshore Account</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-md-6 mb-3">
                        <label for="pin">PIN</label>
                        <input class="form-control" placeholder="Enter your PIN" name="pin" type="password" required maxlength="4">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="photo">Upload Photo</label>
                        <input class="form-control" type="file" name="photo" required>
                    </div>
                </div>
                <div class="buttons-w">
                    <button class="btn btn-primary" style="background-color:#04327c;border-color:#04327c;" type="submit">Register</button>
                    <div class="form-check-inline">
                       <b><a style="color:#04327c;" href="login.php">Already have an account? Login</a></b>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script language="javascript">
        populateCountries("country", "state");

        document.getElementById('registration-form').addEventListener('submit', function(e) {
            e.preventDefault();
            document.querySelector('.loading-overlay').style.display = 'block';

            setTimeout(() => {
                const formData = new FormData(this);

                fetch('process.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    document.querySelector('.loading-overlay').style.display = 'none';

                    if (data.success) {
                        Swal.fire({
                            title: 'Registration Successful!',
                            text: `Account request is successful and pending verification. You will be able to access your account dashboard as soon as verification is successful. Your account number is ${data.acc_no}.`,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = 'login.php';
                            }
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: data.message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => {
                    document.querySelector('.loading-overlay').style.display = 'none';
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred while processing your request. Please try again later.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                });
            }, 5000); // Simulate 5 seconds loading time
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>

</html>
