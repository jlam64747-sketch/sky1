<?php
include_once('df/header.php');
if (!isset($_SESSION['uname'])) {
    header("Location: login.php");
    exit();
}


$reg_user = new USER();

$stmt = $reg_user->runQuery("SELECT * FROM account WHERE uname=:uname");
$stmt->execute(array(":uname" => $_SESSION['uname']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);


$email = $row['email'];

$temp = $reg_user->runQuery("SELECT * FROM transfer WHERE email = '$email' ORDER BY id DESC LIMIT 3");
$temp->execute(array(":uname" => $_SESSION['uname']));
$rows = $temp->fetch(PDO::FETCH_ASSOC);

$stmtt = $reg_user->runQuery("SELECT * FROM bank_settings WHERE id = 1");
$stmtt->execute();
$bank_settings = $stmtt->fetch(PDO::FETCH_ASSOC);
$loan_status = $bank_settings['loan_status'];

if ($loan_status == 'on') {
    header("Location: dashboard.php");
    exit();
}

 

?>
  <?php
function welcome(){
 
   if(date("H") < 12){
 
     return "Good Morning";
 
   }elseif(date("H") > 11 && date("H") < 18){
 
     return "Good Afternoon";
 
   }elseif(date("H") > 17){
 
     return "Good Evening";
 
   }
 
}  
?>
 
  		
				
  <?php
if (isset($_GET['dormant'])) {
	?>
	<div class='alert alert-warning'>
		<button class='close' data-dismiss='alert'>&times;</button>
		<strong>Sorry, your account is currently DORMANT/INACTIVE, please contact customer care </a></strong> 
	</div>
	<?php
}
?>

<?php
if (isset($_GET['hold'])) {
	?>
	<div class='alert alert-warning'>
		<button class='close' data-dismiss='alert'>&times;</button>
		<strong>Sorry, your account Status is ON HOLD Please Contact Customer care</a></strong> 
	</div>
	<?php
}
?>	


<!DOCTYPE html>
<html><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title>Customer Dashboard | <?php echo $site_title; ?></title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="template language" name="keywords">
    <meta content="" name="author">
    <meta content="" name="description">
    <meta content="width=device-width, initial-scale=1" name="viewport"> 
    <link href="public/images/favicon.png" rel="shortcut icon">
    <link href="apple-touch-icon.png" rel="apple-touch-icon">
    <link href="public/dashboard/css/css.css" rel="stylesheet" type="text/css">
    <link href="public/dashboard/css/select2.min.css" rel="stylesheet">
    <link href="public/dashboard/css/dropzone.css" rel="stylesheet">
    <link href="public/dashboard/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="public/dashboard/css/perfect-scrollbar.min.css" rel="stylesheet">
    <link href="public/dashboard/css/slick.css" rel="stylesheet">
    <link href="public/dashboard/css/main.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
	
	
	<link href="spry/textfieldvalidation/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="spry/textfieldvalidation/SpryValidationTextField.js" type="text/javascript"></script> 
<link href="spry/textareavalidation/SpryValidationTextarea.css" rel="stylesheet" type="text/css" />
<script src="spry/textareavalidation/SpryValidationTextarea.js" type="text/javascript"></script> 
<link href="spry/selectvalidation/SpryValidationSelect.css" rel="stylesheet" type="text/css" />
<script src="spry/selectvalidation/SpryValidationSelect.js" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>




<style>
.alert {
  padding: 20px;
  background-color: #f44336;
  color: white;
  opacity: 1;
  transition: opacity 0.6s;
  margin-bottom: 15px;
}

.alert.success {background-color: #04AA6D;}
.alert.info {background-color: #2196F3;}
.alert.warning {background-color: #ff9800;}

.closebtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebtn:hover {
  color: black;
}
</style>

  <style type="text/css">/* Chart.js */
@-webkit-keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}@keyframes chartjs-render-animation{from{opacity:0.99}to{opacity:1}}.chartjs-render-monitor{-webkit-animation:chartjs-render-animation 0.001s;animation:chartjs-render-animation 0.001s;}</style><style>.cke{visibility:hidden;}</style>
  
  
  
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script type="text/javascript">
$(window).load(function () {
    $("#loader").fadeOut(1000);
});
</script>

<style>
 #loader
{
    position: fixed;
    z-index: 9999999;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    background: url('icons/loading.gif') 50% 50% no-repeat #f9f9f9;
}
</style>
  
  </head>

<body class="menu-position-side menu-side-left full-screen">
   <div id="loader"></div>
   <?php
    if (isset($_GET['error']) && $_GET['error'] == 'restricted') {
        echo '<script type="text/javascript">
                Swal.fire({
                    icon: "warning",
                    title: "Account Restricted",
                    text: "Please contact support."
                });
              </script>';
    }
    ?>
  <div class="all-wrapper solid-bg-all">
    <!--------------------
    START - Top Bar
    -------------------->
    <div class="top-bar color-scheme-bright">
      <div class="logo-w menu-size">
        <a class="logo" href="">
          <img src="public/images/logo-white.png" alt="">
          <div class="logo-label">
            
          </div>
        </a>
      </div>
      <div class="fancy-selector-w">
        <div class="fancy-selector-current">
          <div class="fs-img">
            <img alt="" src="public/images/card1.png">
          </div>
          <div class="fs-main-info">
            <div class="fs-name">
              <?php echo $site_title; ?>
            </div>
            <div class="fs-sub">
              <span>Available Balance:</span><strong><?php echo $row['currency']; ?><?php echo $english_format_number = number_format( $row['a_bal'] ); ?></strong>
            </div>
          </div>
         
           <div class="fs-selector-trigger">
             <i class="os-icon os-icon-arrow-down4"></i>
            </div>
        </div>
      </div>
      <!--------------------
      START - Top Menu Controls
      -------------------->
      <div class="top-menu-controls">
        <!--------------------
        START - User avatar and menu in secondary top menu
        -------------------->
        <div class="element-search autosuggest-search-activato">
          <input value="Welcome <?php echo $row['fname']; ?> <?php echo $row['lname']; ?>" type="text" disabled="disabled">
        </div>
        <div class="logged-user-w">
          <div class="logged-user-i">
            <div class="avatar-w">
              <img alt="" src="backend/pic/<?php echo $row['filename']; ?>">
            </div>
            <div class="logged-user-menu color-style-bright">
              <div class="logged-user-avatar-info">
                <div class="avatar-w">
                  <img alt="" src="backend/pic/<?php echo $row['filename']; ?>">
                </div>
                <div class="logged-user-info-w">
                  <div class="logged-user-name">
                    <?php echo $row['fname']; ?> <?php echo  $row['lname'] ; ?>
                  </div>
                  <div class="logged-user-role">
                   <?php echo $row['acc_no']; ?>
                  </div>
                </div>
              </div>
              <div class="bg-icon">
                <i class="os-icon os-icon-wallet-loaded"></i>
              </div>
              <ul>
                <li>
                  <a href="profile.php"><i class="os-icon os-icon-user-male-circle2"></i><span>Profile Details</span></a>
                </li>
                <li>
                  <a href="logout.php"><i class="os-icon os-icon-signs-11"></i><span>Logout</span></a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <!--------------------
        END - User avatar and menu in secondary top menu
        -------------------->
      </div>
      <!--------------------
      END - Top Menu Controls
      -------------------->
    </div>
    <!--------------------
    END - Top Bar
    -------------------->
     <div class="layout-w">
      <!--------------------
      START - Mobile Menu
      -------------------->
      <div class="menu-mobile menu-activated-on-click color-scheme-dark">
        <div class="mm-logo-buttons-w">
          <a class="mm-logo" href=""><img src="public/images/logo-white.png" style="width:80px !important;" width="80"><span></span></a>
          <div class="mm-buttons">
            <div class="content-panel-open">
              <div class="os-icon os-icon-grid-circles"></div>
            </div>
            <div class="mobile-menu-trigger">
              <div class="os-icon os-icon-hamburger-menu-1"></div>
            </div>
          </div>
        </div>
        <div class="menu-and-user">
          <div class="logged-user-w">
            <div class="avatar-w">
              <img alt="" src="backend/pic/<?php echo $row['filename']; ?>">
            </div>
            <div class="logged-user-info-w">
              <div class="logged-user-name">
                <?php echo $row['fname']; ?> <?php echo  $row['lname'] ; ?>
              </div>
              <div class="logged-user-role">
                <?php echo $row['acc_no']; ?>
              </div>
            </div>
          </div>
          <!--------------------
          START - Mobile Menu List
          -------------------->
          <ul class="main-menu">
            <li>
              <a href="dashboard.php">
                <div class="icon-w">
                  <div class="os-icon os-icon-home"></div>
                </div>
                <span>Home</span></a>
            </li>
            <li class="has-sub-menu">
              <a href="#">
                <div class="icon-w">
                  <div class="os-icon os-icon-layers"></div>
                </div>
                <span>Account History</span></a>
              <ul class="sub-menu">
                <li>
                  <a href="recent.php">Recent</a>
                </li>
                <li>
                  <a href="summary.php">Summary</a>
                </li>
              </ul>
            </li>
            <li class="has-sub-menu">
              <a href="#">
                <div class="icon-w">
                  <div class="os-icon os-icon-send"></div>
                </div>
                <span>Transfer</span></a>
                <ul class="sub-menu">
                  <li>
                    <a href="international.php">International Transfer</a>
                  </li>
                  <li>
                    <a href="local.php">Local Transfer </a>
                  </li>
                  
                </ul>
            </li>

            <li class="has-sub-menu">
              <a href="#">
                <div class="icon-w">
                  <div class="os-icon os-icon-send"></div>
                </div>
                <span>Loan</span></a>
                <ul class="sub-menu">
                  <li>
                    <a href="create-loan.php">Loan Request</a>
                  </li>
                  <li>
                    <a href="view-loan.php">View Loan</a>
                  </li>
                  <li>
                    <a href="deposit.php">Deposit</a>
                  </li>
                  
                </ul>
            </li>
            
            <li class="has-sub-menu">
              <a href="#">
                <div class="icon-w">
                  <div class="os-icon os-icon-users"></div>
                </div>
                <span>Beneficiary</span>
              </a>
              <ul class="sub-menu">
                <li>
                  <a href="create-beneficiary.php">Add beneficiary</a>
                </li>
                <li>
                  <a href="beneficiary.php">View Beneficiary</a>
                </li>
              </ul>
            </li>

            <li class="has-sub-menu">
              <a href="#">
                <div class="icon-w">
                  <div class="os-icon os-icon-user"></div>
                </div>
                <span>Profile</span></a>
                <ul class="sub-menu">
                  <li>
                    <a href="profile.php">View Profile </a>
                  </li>
                  </ul>
            </li>
            
             <li class="has-sub-menu">
              <a href="#">
                <div class="icon-w">
                  <div class="os-icon os-icon-user"></div>
                </div>
                <span>Deposit</span></a>
                <ul class="sub-menu">
                  <li>
                    <a href="deposit.php">Make Deposit </a>
                  </li>
                  <li>
                    <a href="cheque-deposit.php">Cheque Deposit </a>
                  </li>
                  </ul>
            </li>
            
            
             <li class="has-sub-menu">
              <a href="#">
                <div class="icon-w">
                  <div class="os-icon os-icon-user"></div>
                </div>
                <span>Support Ticket</span></a>
                <ul class="sub-menu">
                  <li>
                    <a href="ticket.php">Open Ticket </a>
                  </li>
                  </ul>
            </li>
            <li>
              <a href="logout.php">
                <div class="icon-w">
                  <div class="os-icon os-icon-signs-11"></div>
                </div>
                <span>Logout</span></a>
            </li>
          </ul>
          <!--------------------
          END - Mobile Menu List
          -------------------->
        </div>
      </div>
      <!--------------------
      END - Mobile Menu
      --------------------><!--------------------
      START - Main Menu
      -------------------->
      <div class="menu-w color-scheme-light color-style-transparent menu-position-side menu-side-left menu-layout-compact sub-menu-style-over sub-menu-color-bright selected-menu-color-light menu-activated-on-hover menu-has-selected-link">
        <div class="logged-user-w avatar-inline">
          <div class="logged-user-i">
            <div class="avatar-w">
              <img alt="" src="backend/pic/<?php echo $row['filename']; ?>">
            </div>
            <div class="logged-user-info-w">
              <div class="logged-user-name">
                <?php echo $row['fname']; ?> <?php echo  $row['lname'] ; ?>
              </div>
              <div class="logged-user-role">
                <?php echo $row['acc_no']; ?>
              </div>
            </div>
          </div>
        </div>
        <div class="menu-actions">
          Date:  <?php echo date("d M Y"); ?> <br>
          Time: <?php echo date("h:i A "); ?> UTC        </div>
        
        <ul class="main-menu">
          <li class="sub-header">
            <span>Account</span>
          </li>
          <li class="selected">
            <a href="dashboard.php">
              <div class="icon-w">
                <div class="os-icon os-icon-home"></div>
              </div>
              <span>Home</span></a>
          </li>
          <li class=" has-sub-menu">
            <a href="#">
              <div class="icon-w">
                <div class="os-icon os-icon-layers"></div>
              </div>
              <span>Account History</span></a>
            <div class="sub-menu-w">
              <div class="sub-menu-header">
                Account History
              </div>
              <div class="sub-menu-icon">
                <i class="os-icon os-icon-layers"></i>
              </div>
              <div class="sub-menu-i">
                <ul class="sub-menu">
                  <li>
                    <a href="recent.php">Recent</a>
                  </li>
                  <li>
                    <a href="summary.php">Summary</a>
                  </li>
                </ul>
              </div>
            </div>
          </li>
          <li class="sub-header">
            <span>Fund Transfer</span>
          </li>
          <li class="selecte">
            <a href="local.php">
              <div class="icon-w">
                <div class="os-icon os-icon-coins-4"></div>
              </div>
              <span>Local Transfer</span>
            </a>
          </li>
          <li class="selecte">
            <a href="international.php">
              <div class="icon-w">
                <div class="os-icon os-icon-send"></div>
              </div>
              <span>International Transfer</span>
            </a>
          </li>
          

          <li class="sub-header">
            <span>Loan</span>
          </li>
          <li class=" has-sub-menu">
            <a href="#">
              <div class="icon-w">
                <div class="os-icon os-icon-coins-4"></div>
              </div>
              <span>Loan</span></a>
            <div class="sub-menu-w">
              <div class="sub-menu-header">
                Loan
              </div>
              <div class="sub-menu-icon">
                <i class="os-icon os-icon-coins-4"></i>
              </div>
              <div class="sub-menu-i">
                <ul class="sub-menu">
                  <li>
                    <a href="create-loan.php">Request Loan</a>
                  </li>
                  <li>
                    <a href="view-loan.php">View Loan</a>
                  </li>
                </ul>
              </div>
            </div>
          </li>
          
          <li class="selecte">
            <a href="deposit.php">
              <div class="icon-w">
                <div class="os-icon os-icon-download"></div>
              </div>
              <span>Deposit</span>
            </a>
          </li>
           <li class="selecte">
            <a href="cheque-deposit.php">
              <div class="icon-w">
                <div class="os-icon os-icon-download"></div>
              </div>
              <span>Cheque Deposit</span>
            </a>
          </li>
          
          <li class="sub-header">
            <span>User</span>
          </li>
          <li class=" has-sub-menu">
            <a href="#">
              <div class="icon-w">
                <div class="os-icon os-icon-users"></div>
              </div>
              <span>Beneficiaries</span></a>
            <div class="sub-menu-w">
              <div class="sub-menu-header">
                Beneficiaries
              </div>
              <div class="sub-menu-icon">
                <i class="os-icon os-icon-users"></i>
              </div>
              <div class="sub-menu-i">
                <ul class="sub-menu">
                  <li>
                    <a href="create-beneficiary.php">Add beneficiary</a>
                  </li>
                  <li>
                    <a href="beneficiary.php">View Beneficiary</a>
                  </li>
                </ul>
              </div>
            </div>
          </li>
          <li class=" has-sub-menu">
            <a href="#">
              <div class="icon-w">
                <div class="os-icon os-icon-user-check"></div>
              </div>
              <span>Profile</span></a>
            <div class="sub-menu-w">
              <div class="sub-menu-header">
                Profile
              </div>
              <div class="sub-menu-icon">
                <i class="os-icon os-icon-user-check"></i>
              </div>
              <div class="sub-menu-i">
                <ul class="sub-menu">
                  <li>
                    <a href="profile.php">View Profile </a>
                  </li>
                </ul>
              </div>
            </div>
          </li>
          
           <li class=" has-sub-menu">
            <a href="#">
              <div class="icon-w">
                <div class="os-icon os-icon-user-check"></div>
              </div>
              <span>Support Ticket</span></a>
            <div class="sub-menu-w">
              <div class="sub-menu-header">
                Support Ticket
              </div>
              <div class="sub-menu-icon">
                <i class="os-icon os-icon-user-check"></i>
              </div>
              <div class="sub-menu-i">
                <ul class="sub-menu">
                  <li>
                    <a href="ticket.php">Open Ticket </a>
                  </li>
                </ul>
              </div>
            </div>
          </li>
          
          
          <li class="sub-header">
            <span>Authentication</span>
          </li>
          <li class="">
            <a href="logout.php">
              <div class="icon-w">
                <div class="os-icon os-icon-log-out"></div>
              </div>
              <span>Logout</span></a>
          </li>
          <li class="">
            <a href="logout.php">
              <div class="icon-w">
                <div class=""></div>
              </div>
              <span>&nbsp;</span></a>
          </li>
          <li class="">
            <a href="logout.php">
              <div class="icon-w">
                <div class=""></div>
              </div>
              <span>&nbsp;</span></a>
          </li>
          <li class="">
            <a href="logout.php">
              <div class="icon-w">
                <div class=""></div>
              </div>
              <span>&nbsp;</span></a>
          </li>
        </ul>
      </div>
      <!--------------------
      END - Main Menu
      -------------------->