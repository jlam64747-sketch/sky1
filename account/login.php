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
    <title>Login | <?php echo $site_title; ?></title>
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
    <link href="public/dashboard/css/main4e61.css?version=4.4.0" rel="stylesheet">
  </head>
  <body class="auth-wrapper">
    <div class="all-wrapper menu-side with-pattern pt-5">
      <div class="auth-box-w">
        <div class="logo-w">
          <a href=""><img alt="" src="public/images/logo.png" width="200" height=""></a>
        </div>
        <?php
        if(isset($_GET['wrong'])) {
          ?><center> <h6 style="color:red;">You have Entered Wrong Credentials!</h6></center><?php
        }
        ?>  
        <?php
if (isset($_GET['status'])) {
    ?><center><h6 style="color:red;">Account Inactive. Contact support.</h6></center><?php
}
?>
        <h4 class="auth-header">
          Login Form
        </h4>
        <form action="authlog.php" method="post">
          <div class="form-group m-b-10"></div>
          <div class="form-group d-flex justify-content-between align-items-center">
            <label for="">Username</label>
          </div>
          <div class="form-group">
            <input class="form-control" placeholder="Enter your username or email" name="uname" type="text" required>
            <div class="pre-icon os-icon os-icon-user-male-circle"></div>
          </div>
          <div class="form-group d-flex justify-content-between align-items-center">
            <label for="">Password</label>
            <a href="forgot-password.php?step1">Forgot Password?</a>
          </div>
          <div class="form-group">
            <input class="form-control" placeholder="Enter your password" name="upas" type="password" required>
            <div class="pre-icon os-icon os-icon-fingerprint"></div>
          </div>
          <div class="buttons-w">
            <button class="btn btn-primary" type="submit">Login</button>
            <div class="form-check-inline">
              <a href="register.php">Register</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </body>

</html>
