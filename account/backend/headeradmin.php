

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="">
	<meta name="author" content="">
	<meta name="robots" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Dolab : Dolab Personal Banking Admin Bootstrap 5 Template">
	<meta property="og:title" content="Dolab : Dolab Personal Banking Admin Bootstrap 5 Template">
	<meta property="og:description" content="Dolab : Dolab Personal Banking Admin Bootstrap 5 Template">
	<meta property="og:image" content="social-image.png">
	<meta name="format-detection" content="telephone=no">
	
	<!-- PAGE TITLE HERE -->
	<title>Dashboard -<?php echo $site_title; ?> | Best Online Banking System</title>
	
	<!-- FAVICONS ICON -->
	    <link href="../public/images/favicon.png" rel="shortcut icon">
	<link href="vendor/jquery-nice-select/css/nice-select.css" rel="stylesheet">
	<link href="vendor/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/fontawesome.min.css"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
	
	<!-- Style css -->
	<link href="vendor/jquery-autocomplete/jquery-ui.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style>
        /* Add your custom styles here */
        .table-responsive {
            max-height: 500px;
            overflow-y: auto;
        }
        .table th, .table td {
            white-space: nowrap;
        }
    </style>
	
	  <link href="vendor/datatables/css/jquery.dataTables.min.css" rel="stylesheet">
	<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>




  

<script type="text/javascript" src="https://code.jquery.com/jquery-1.8.2.js"></script>
<style type="text/css">
#overlay {
position: fixed;
top: 0;
left: 0;
width: 100%;
height: 100%;
background-color: #000;
filter:alpha(opacity=70);
-moz-opacity:0.7;
-khtml-opacity: 0.7;
opacity: 0.7;
z-index: 100;
display: none;
}
 
.popup{
width: 75%;
margin: 0 auto;
display: none;
position: fixed;
z-index: 101;
}

</style>
<script type='text/javascript'>
$(function(){
var overlay = $('<div id="overlay"></div>');
overlay.show();
overlay.appendTo(document.body);
$('.popup').show();
$('.close').click(function(){
$('.popup').hide();
overlay.appendTo(document.body).remove();
return false;
});


 

$('.x').click(function(){
$('.popup').hide();
overlay.appendTo(document.body).remove();
return false;
});
});
</script> 




	
	
</head>
<body  style="background-color:#f7f7f7;">

    <!--*******************
        Preloader start
    ********************-->
	 <div id="preloader"  style="background-color:#0000FF;">
        <div class="inner">
            <span><img src="../public/images/logo-white.png" height="80px"></img></span>
            <div class="loading">  
            </div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper" style="background-color:#f7f7f7;">
		 
        <!--**********************************
            Nav header start
        ***********************************-->
		<div class="nav-header"  style="background-color:white;">
            <a href="myhome.php" class="brand-logo">
				<div class="logo">
					<img src="../public/images/logo.png" height="40px" width="200px" >
				</div>

            </a>
            <div class="nav-control" >
                <div class="hamburger" style="background-color:#0000FF;">
                    <span class="line"></span>
					<span class="line"></span>
					<span class="line"></span>
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path opacity="0.4" d="M16.7548 0.333313H20.7051C22.341 0.333313 23.6667 1.67014 23.6667 3.31994V7.30359C23.6667 8.95339 22.341 10.2902 20.7051 10.2902H16.7548C15.1188 10.2902 13.7932 8.95339 13.7932 7.30359V3.31994C13.7932 1.67014 15.1188 0.333313 16.7548 0.333313Z" fill="white"/>
						<path fill-rule="evenodd" clip-rule="evenodd" d="M3.29492 0.333313H7.24522C8.8812 0.333313 10.2068 1.67014 10.2068 3.31994V7.30359C10.2068 8.95339 8.8812 10.2902 7.24522 10.2902H3.29492C1.65894 10.2902 0.333313 8.95339 0.333313 7.30359V3.31994C0.333313 1.67014 1.65894 0.333313 3.29492 0.333313ZM3.29492 13.7097H7.24522C8.8812 13.7097 10.2068 15.0466 10.2068 16.6964V20.68C10.2068 22.3287 8.8812 23.6666 7.24522 23.6666H3.29492C1.65894 23.6666 0.333313 22.3287 0.333313 20.68V16.6964C0.333313 15.0466 1.65894 13.7097 3.29492 13.7097ZM20.705 13.7097H16.7547C15.1188 13.7097 13.7931 15.0466 13.7931 16.6964V20.68C13.7931 22.3287 15.1188 23.6666 16.7547 23.6666H20.705C22.341 23.6666 23.6666 22.3287 23.6666 20.68V16.6964C23.6666 15.0466 22.341 13.7097 20.705 13.7097Z" fill="white"/>
					</svg>
						
                </div>
            </div>
			
        </div>
	
        <!--**********************************
            Nav header end
        ***********************************-->
		
		 
		
		<!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand" >
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
							<div class="dashboard_bar">
                              <h4 style="color:#0000FF; font-weight:700;"> 
							  LOGIN IP: <?php echo $_SERVER['REMOTE_ADDR']; ?> &nbsp; Date: <?php echo date(" d M Y"); ?></h4>
                            </div>
                        </div>
                        <ul class="navbar-nav header-right">
							<li class="nav-item d-flex align-items-start">
								<div class="input-group search-area" style="background-color:white;">
									<input type="text" style="color:black;" class="form-control" id="search" placeholder="Recent Transaction">
									<span class="input-group-text"><a href="javascript:void(0)"><svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
										<path opacity="1" d="M16.6751 19.4916C16.2194 19.036 16.2194 18.2973 16.6751 17.8417C17.1307 17.3861 17.8694 17.3861 18.325 17.8417L22.9916 22.5084C23.4473 22.964 23.4473 23.7027 22.9916 24.1583C22.536 24.6139 21.7973 24.6139 21.3417 24.1583L16.6751 19.4916Z" fill="white"/>
										<path d="M12.8333 18.6667C16.055 18.6667 18.6667 16.055 18.6667 12.8334C18.6667 9.61169 16.055 7.00002 12.8333 7.00002C9.61166 7.00002 6.99999 9.61169 6.99999 12.8334C6.99999 16.055 9.61166 18.6667 12.8333 18.6667ZM12.8333 21C8.323 21 4.66666 17.3437 4.66666 12.8334C4.66666 8.32303 8.323 4.66669 12.8333 4.66669C17.3436 4.66669 21 8.32303 21 12.8334C21 17.3437 17.3436 21 12.8333 21Z" fill="white"/>
										</svg>
										</a>
									</span>
								</div>
							</li>
                        </ul>
						<div class="dropdown header-profile2">
							
							<a class="nav-link user-profile" href="javascript:void(0);" style="background-color:white;"  role="button" data-bs-toggle="dropdown">
								<div class="header-info2 d-flex align-items-center" style="background-color:white;">
									<img src="pic/admin.jpg" alt="">
									<div class="d-flex align-items-center sidebar-info">
										<div class="user-info">
											<span class="font-w500 d-block  fs-5 text-black">Digital Forest</span>
											<small class="text-end font-w400 text-black">Bank Manager</small>
										</div>
										<i class='fas fa-chevron-circle-right' style='font-size:18px;color:red'></i>
											
									</div>
									
								</div>
							</a>
							<div class="dropdown-menu profile dropdown-menu-end">
							<!--	<a href="update.php" class="dropdown-item ai-icon ">
									<svg  xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
									<span class="ms-2">EDIT CUSTOMER PROFILE </span>
								</a> -->
								<a href="reset-password.php" class="dropdown-item ai-icon">
									<svg  xmlns="http://www.w3.org/2000/svg" class="text-success" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
									<span class="ms-2">Reset Admin Password </span>
								</a>
							 
								<a href="logout.php" class="dropdown-item ai-icon">
									<svg  xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
									<span class="ms-2">Logout </span>
								</a>
							</div>
						
						</div>
                    </div>
				</nav>
			</div>
		</div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
		<div class="dlabnav" >
			<div class="dlabnav-scroll" >
				
				<ul class="metismenu" id="menu"  style="background-color:white;">
					
						  
						  
						   
						
						<ul > 
						 
						
						<li><a href="index.php"  style="background-color:brown; color:white; font-weight:600; height:40px; font-size:14px;"> 
							<i class='fas fa-landmark' style='font-size:18px;color:white'></i> &nbsp; Dashboard
						</a></li>
						
						
						
							<li><a style="color:#000; font-weight:600;" href="new_account.php"> <i class='fas fa-user-edit' style='font-size:22px;color:#000'></i> &nbsp; Register User</a></li>
<li><a style="color:#000; font-weight:600;" href="photo.php"> <i class='fas fa-user-edit' style='font-size:22px;color:#000'></i> &nbsp; Add Photo</a></li>
<li><a style="color:#000; font-weight:600;" href="update.php"><i class='fas fa-chart-line' style='font-size:22px;color:#000'></i> &nbsp;User List</a></li> 
<li><a style="color:#000; font-weight:600;" href="credit.php"><i class='fas fa-piggy-bank' style='font-size:22px;color:#000'></i> &nbsp;Credit User</a></li>
<li><a style="color:#000; font-weight:600;" href="debit.php"><i class='fas fa-piggy-bank' style='font-size:22px;color:#000'></i> &nbsp;Debit User</a></li>
<li><a style="color:#000; font-weight:600;" href="add-transfer.php"><i class='fas fa-donate' style='font-size:22px;color:#000'></i> &nbsp;Add Transfer</a></li>
<li><a style="color:#000; font-weight:600;" href="card.php"><i class='fas fa-credit-card' style='font-size:22px;color:#000'></i> &nbsp;Virtual Cards</a></li> 
<?php if ($loan_status == 'off'): ?>
            <li><a style="color:#000; font-weight:600;" href="loan.php"><i class='fas fa-comments-dollar' style='font-size:22px;color:#000'></i> &nbsp;Loans</a></li>
        <?php endif; ?>
<li><a style="color:#000; font-weight:600;" href="transfer_status.php"><i class='fas fa-user-lock' style='font-size:22px;color:#000'></i> &nbsp;Edit Transfer</a></li> 
<li><a style="color:#000; font-weight:600;" href="billing.php"><i class='fas fa-fingerprint' style='font-size:22px;color:#000'></i> &nbsp;Billing Codes</a></li>  
<li><a style="color:#000; font-weight:600;" href="setting.php"><i class='fas fa-cog' style='font-size:22px;color:#000'></i> &nbsp;Settings</a></li>
<li><a style="color:#000; font-weight:600;" href="logout.php"><i class='fas fa-power-off' style='font-size:22px;color:#000'></i> &nbsp;Logout</a></li>

						</ul>
					</li>
				</ul>
				
			 
			</div>
		</div>
		
        <!--**********************************
            Sidebar end
        ***********************************-->
		
		<!--**********************************
            Content body start
        ***********************************-->