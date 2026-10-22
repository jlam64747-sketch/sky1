<?php
include_once "df/header.php"; 

$reg_user = new USER();

$stmt = $reg_user->runQuery("SELECT * FROM account WHERE uname=:uname");
$stmt->execute(array(":uname" => $_SESSION['uname']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$t_pin = $row['t_pin'];

// JavaScript code to check $t_pin and show SweetAlert
echo "<script>
    document.addEventListener('DOMContentLoaded', function() {
        var t_pin = '" . $t_pin . "';
        if (t_pin === '' || t_pin === null) {
            Swal.fire({
                title: 'Transaction Pin Not Set',
                text: 'You need to set up your transaction pin.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Setup Now',
                cancelButtonText: 'Setup Later'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'edit-tpin.php'; // Redirect to setup pin page
                }
            });
        }
    });
</script>";
?>
<div id="google_translate_element"></div>

<script type="text/javascript">
function googleTranslateElementInit() { 
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>




<?php 
if (isset($_POST["fund_card"])) {
    // Database credentials
    $host = 'localhost';
    $db_username = 'gigobnco_skylajushjus';
    $db_password = '1HoZ,48uoN+8';
    $database = 'gigobnco_skylajushjus';

    // Database connection
    $conn = mysqli_connect($host, $db_username, $db_password, $database);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $acc_no = $_REQUEST["acc_no"];
    $card_bal = $_REQUEST["card_bal"];
    $amount = $_REQUEST["amount"];
    $a_bal = $_REQUEST["a_bal"];

    $ego = $reg_user->runQuery("SELECT a_bal FROM account WHERE uname=:uname");
    $ego->execute([":uname" => $_SESSION["uname"]]);
    $owo = $ego->fetch(PDO::FETCH_ASSOC);

    $c_id = $_SESSION["c_id"];
    $a_bal = $_REQUEST["a_bal"];
    $amount = "$amount";

    if ($a_bal < $amount) {
        header("Location: dashboard.php?fundbalance");
        exit();
    } else {
        $card_bal = $card_bal + $amount;
        $sql = "UPDATE `virtual_card` SET `card_bal` = '$card_bal' WHERE `virtual_card`.`id` = $c_id";

        $insert = mysqli_query($conn, $sql);

        if ($insert) {
            // Reconnect to update the account balance
            $conn = mysqli_connect($host, $db_username, $db_password, $database);

            $a_bal = $a_bal - $amount;

            $query = mysqli_query($conn, "UPDATE account SET a_bal = '$a_bal' WHERE acc_no = '$acc_no'");

            header("Location: dashboard.php?fundsuccess");
            exit();
        } else {
            header("Location: dashboard.php?funderrors");
            exit();
        }
    }
} 
?>
		


 <?php include "df1.php"; ?>
 <?php if (isset($_GET["fundcard"])) { ?> 




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
width: 100%;
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

<div class='popup' > <div class="modal-dialog modal-sm" >
							<div class="modal-content"  >
								<div class="modal-header" style="background-color:white;">
									<h5 class="modal-title">Card Funding</h5>
									<span class="close">&times;</span>
								</div>
								<div class="modal-body" style="background-color:white; ">  
							 
                                  
                                  
                                <form  action="dashboard.php" method="post" > 
                            
                                    	<div class="row">
                                            <div class="form-group">
                                                <label for="">Funding Amount(<?php echo $row[
                                                    "currency"
                                                ]; ?>)</label>
                                                  <input type="number"  id="exp" name="amount" class="form-control"   value="500" > 
	
                                            </div>
                                        </div>
                                  
                                  
										        	 <?php
                    $c_id = $_SESSION["c_id"];
                    $his = $reg_user->runQuery(
                        "SELECT * FROM virtual_card WHERE id = '$c_id' ORDER BY id DESC LIMIT 1"
                    );
                    $his->execute([":email" => $_SESSION["email"]]);
                    while ($rows = $his->fetch(PDO::FETCH_ASSOC)) { ?>
                            
							 <input   type="hidden"  style="border-color:black; color:black;"  name="card_bal" 
							 class="form-control" value="<?php echo $rows["card_bal"]; ?>">
                           	   
							   <?php }
                    ?>
                                  
                        <input  type="hidden" name="email" value="<?php echo $row[
                            "email"
                        ]; ?>">  
    					<input  type="hidden" name="acc_no" value="<?php echo $row[
             "acc_no"
         ]; ?>">          
                           <input  name="a_bal" value="<?php echo $row[
                               "a_bal"
                           ]; ?>" type="hidden" >       
                                  
                 
                                       
                                    <div class="form-buttons-w">
                                        <button class="btn btn-primary"  name="fund_card"  type="submit">FUND</button>
                                    </div>
                                </form>
                       
					
                                  
                                  
                                  
                                  
							</div>
				 
								
					
							</div></div>
						</div>

	<?php } ?>




<div class="content-w">
    <div class="content-i">
      <div class="content-box">
        <div class="element-wrapper compact pt-4">
          <div class="element-actions">
            <a class="btn btn-primary btn-sm" href="deposit.php"><i class="os-icon os-icon-ui-22"></i><span>Add Deposit</span></a><a class="btn btn-success btn-sm" href="international.php"><i class="os-icon os-icon-grid-10"></i><span>Make Transfer</span></a>
          </div>
          <h6 class="element-header">
            Financial Overview
          </h6>
          <div class="element-box-tp">
            <?php if (isset($_GET["cardsuccess"])) { ?>
             <div class="alert success">
  <span class="closebtn">&times;</span>  
  <strong>Hello!</strong> Virtual Visa Card Created Successfully
</div>
	<?php } ?>		
					<?php if (isset($_GET["cardfailed"])) { ?>
             <div class="alert">
  <span class="closebtn">&times;</span>  
  <strong>Hello!</strong> Something Went Wrong Try Again
</div>
	<?php } ?>
            <?php if (isset($_GET["carddeleted"])) { ?>
             <div class="alert">
  <span class="closebtn">&times;</span>  
  <strong>Hello!</strong> Your Visa Card Has been Deleted
</div>
	<?php } ?>
            
            
          <?php if (isset($_GET["fundbalance"])) { ?>
             <div class="alert">
  <span class="closebtn">&times;</span>  
  <strong>Hello!</strong> Your Balance is too Low
</div>
	<?php } ?>  
            
        <?php if (isset($_GET["funderrors"])) { ?>
             <div class="alert">
  <span class="closebtn">&times;</span>  
  <strong>Hello!</strong> Soemthing Went Wrong Try Again
</div>
	<?php } ?>    
        
            <?php if (isset($_GET["fundsuccess"])) { ?>
             <div class="alert success">
  <span class="closebtn">&times;</span>  
  <strong>Hello!</strong> Card Funded Successfully
</div>
	<?php } ?>	
            
            
            
            
            
            
            
            <div class="row">
              

              <!-- <h5 style="color:red;">Contact the Author Via Whatsapp: <a href="tel:2349055465822">+2349055465822</a></h5> -->
              <div class="col-lg-7 col-xxl-6">
                <!--START - BALANCES-->
                <div class="element-balances">
                  <div class="balance hidden-mobile">
                    <div class="balance-title">
                      Total Balance
                    </div>
                    <div class="balance-value">
                      <span><?php
                      echo $row["currency"];
                      echo $english_format_number = number_format(
                          $row["t_bal"]
                      );
                      ?>.00</span>
                    </div>
                    <div class="balance-link">
                      <a class="btn btn-link btn-underlined" href="recent.php"><span>View Statement</span><i class="os-icon os-icon-arrow-right4"></i></a>
                    </div>
                  </div>
                  <div class="balance">
                    <div class="balance-title">
                      Available Balance
                    </div>
                    <div class="balance-value">
                      <?php
                      echo $row["currency"];
                      echo $english_format_number = number_format(
                          $row["a_bal"]
                      );
                      ?>.00
                    </div>
                    <div class="balance-link">
                      <a class="btn btn-link btn-underlined" href="local.php"><span>Transfer Fund</span><i class="os-icon os-icon-arrow-right4"></i></a>
                    </div>
                  </div>
                </div>
                <!--END - BALANCES-->
                
                
                <style>
                 


.card1{
width: 320px;
height: 190px;
  -webkit-perspective: 600px;
  -moz-perspective: 600px;
  perspective:600px;
  
}

.card__part{
  box-shadow: 1px 1px #aaa3a3;
    top: 0;
  position: absolute;
z-index: 1000;
  left: 0;
  display: inline-block;
    width: 320px;
    height: 190px;
    background-color:#04327c; /*linear-gradient(to right bottom, #fd8369, #fc7870, #f96e78, #f56581, #ee5d8a)*/
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
    border-radius: 8px;
   
    -webkit-transition: all .5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    -moz-transition: all .5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    -ms-transition: all .5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    -o-transition: all .5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    transition: all .5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    -webkit-transform-style: preserve-3d;
    -moz-transform-style: preserve-3d;
    -webkit-backface-visibility: hidden;
    -moz-backface-visibility: hidden;
}

.card__front{
  padding: 18px;
-webkit-transform: rotateY(0);
-moz-transform: rotateY(0);
}

.card__back {
  padding: 18px 0;
-webkit-transform: rotateY(-180deg);
-moz-transform: rotateY(-180deg);
}

.card__black-line {
    margin-top: 5px;
    height: 38px;
    background-color: #303030;
}

.card__logo {
    height: 16px;
}

.card__front-logo{
      position: absolute;
    top: 18px;
    right: 18px;
}
.card__square {
    border-radius: 5px;
    height: 30px;
}

.card_numer {
    display: block;
    width: 100%;
    word-spacing: 4px;
    font-size: 20px;
    letter-spacing: 2px;
    color: #fff;
    text-align: center;
    margin-bottom: 20px;
    margin-top: 20px;
}

.card__space-75 {
    width: 75%;
    float: left;
}

.card__space-25 {
    width: 25%;
    float: left;
}

.card__label {
    font-size: 10px;
    text-transform: uppercase;
    color: rgba(255,255,255,0.8);
    letter-spacing: 1px;
}

.card__info {
    margin-bottom: 0;
    margin-top: 5px;
    font-size: 16px;
    line-height: 18px;
    color: #fff;
  letter-spacing: 1px;
  text-transform: uppercase;
}

.card__back-content {
    padding: 15px 15px 0;
}
.card__secret--last {
    color: #303030;
    text-align: right;
    margin: 0;
    font-size: 14px;
}

.card__secret {
    padding: 5px 12px;
    background-color: #fff;
    position:relative;
}

.card__secret:before{
  content:'';
  position: absolute;
top: -3px;
left: -3px;
height: calc(100% + 6px);
width: calc(100% - 42px);
border-radius: 4px;
  background: repeating-linear-gradient(45deg, #ededed, #ededed 5px, #f9f9f9 5px, #f9f9f9 10px);
}

.card__back-logo {
    position: absolute;
    bottom: 15px;
    right: 15px;
}

.card__back-square {
    position: absolute;
    bottom: 15px;
    left: 15px;
}

.card1:hover .card__front {
    -webkit-transform: rotateY(180deg);
    -moz-transform: rotateY(180deg);

}

.card1:hover .card__back {
    -webkit-transform: rotateY(0deg);
    -moz-transform: rotateY(0deg);
}
                </style>
                
                
                
                
                
<?php
$email = $row["email"];
$his = $reg_user->runQuery(
    "SELECT * FROM `virtual_card` WHERE email = :email ORDER BY id DESC LIMIT 1"
);
$his->execute([":email" => $email]);
while ($rows = $his->fetch(PDO::FETCH_ASSOC)) { 
    $isInactive = ($rows["card_status"] == 'inactive');
    ?>
    
    <div class="card1">
        <div class="card__front card__part">
            <img class="card__front-square card__square" src="public/images/logo-white.png" alt="ICON">
            <?php if (!$isInactive) { ?>
                <strong class="card__front-logo card__logo" style="color:white; font-weight: 500; font-size: 18px;">
                    <?php
                    echo $row["currency"];
                    echo number_format($rows["card_bal"]);
                    ?>
                </strong>
            <?php } ?>
            <p class="card_numer" style="color:<?php echo $isInactive ? 'red' : 'white'; ?>">
                <?php echo $isInactive ? 'INACTIVE' : $rows["card_no"]; ?>
            </p>
            <div class="card__space-75">
                <span class="card__label">Card holder</span>
                <p class="card__info"><?php echo $isInactive ? 'XXX' : $rows["name"]; ?></p>
            </div>
            <div class="card__space-25">
                <span class="card__label">Expires</span>
                <p class="card__info"><?php echo $isInactive ? 'XXX' : $rows["exp"]; ?></p>
            </div>
        </div>
        
        <div class="card__back card__part">
            <div class="card__black-line"></div>
            <div class="card__back-content">
                <div class="card__secret">
                    <p class="card__secret--last"><?php echo $isInactive ? 'XXX' : $rows["cvv"]; ?></p>
                </div>
                <img class="card__back-square card__square" src="public/images/logo-white.png">
                <strong class="card__back-logo card__logo" style="color:white; font-weight: 500; font-size: 20px;">VISA</strong>
            </div>
        </div>
    </div>

<?php }
?>


                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                <?php
                $email = $row["email"];
                $his = $reg_user->runQuery(
                    "SELECT * FROM `virtual_card` WHERE email ='$email' ORDER BY id DESC LIMIT 1 "
                );
                $his->execute([":email" => $_SESSION["email"]]);
                if ($rows = $his->fetch(PDO::FETCH_ASSOC)) {
                } else {
                    echo '
										 
										<div class="card1">
						  <div class="card__front card__part">
							<img class="card__front-square card__square" src="public/images/logo-white.png" alt="ICON">
							<strong class="card__front-logo card__logo" style="color:white; font-weight: 500; font-size: 18px;"><?php echo $row["currency"]; ?>0.00</strong>
							<p class="card_numer">0000 0000 0000 0000</p>
							<div class="card__space-75">
							  <span class="card__label">Card holder</span>
							  <p class="card__info">NO NAME</p>
							</div>
							<div class="card__space-25">
							  <span class="card__label">Expires</span>
									<p class="card__info">00/00</p>
							</div>
						  </div>
						  
						  <div class="card__back card__part">
							<div class="card__black-line"></div>
							<div class="card__back-content">
							  <div class="card__secret">
								<p class="card__secret--last">000</p>
							  </div>
							  <img class="card__back-square card__square" src="public/images/logo-white.png">
							  <strong class="card__back-logo card__logo" style="color:white; font-weight: 500; font-size: 20px;">VISA</strong>
							
							  
							</div>
						  </div>
						  
						</div>
										 
										 
										 ';
                }
                ?>
                
                
                
                
                
                
                
                
                
                
                
                
                
              </div>
              
              <div class="col-lg-5 col-md-5">
                <div class="card">
                    <div class="card-block">
                        <h4 class="card-title">Account Details</h4>
                        <div class="row">
                            <table class="table tabel-condensed table-striped">
            
                                <tbody><tr>
                                    <td>Account Name : </td>
                                    <td><?php echo $row[
                                        "fname"
                                    ]; ?> <?php echo $row["lname"]; ?></td>
                                </tr>
                                <tr>
                                    <td>Balance :</td>
                                    <td><?php
                                    echo $row["currency"];
                                    echo $english_format_number = number_format(
                                        $row["a_bal"]
                                    );
                                    ?>.00</td>
                                </tr>
                                <tr>
                                    <td>Account Type : </td>
                                    <td><?php echo $row["type"]; ?></td>
                                </tr>
                                <tr>
                                    <td>Account Number : </td>
                                    <td></span><?php
                                    function mask_mobile_no($number)
                                    {
                                        return substr($number, 0, 5) .
                                            "*****" .
                                            substr($number, -2);
                                    }
                                    $number = $row["acc_no"];
                                    echo mask_mobile_no($number);
                                    ?></td>
                                </tr>
                                
                                <tr>
                                    <td>Swift Code : </td>
                                    <td><?php echo $site_swift; ?></td>
                                </tr>
                      
                      			
                         <?php
                         $email = $row["email"];
                         $his = $reg_user->runQuery(
                             "SELECT * FROM `virtual_card` WHERE email ='$email' ORDER BY id DESC LIMIT 1 "
                         );
                         $his->execute([":email" => $_SESSION["email"]]);
                         if ($rows = $his->fetch(PDO::FETCH_ASSOC)) {
                         } else {
                             echo '
										<tr>
                                  <td>BANK CARD ?</td>
                                  <td><a class="btn btn-danger btn-sm" id="myBtn" href="#" ><i class="os-icon os-icon-ui-22"></i><span>APPLY NOW</span></a></td>
                                 </tr>
										 
										 
										 ';
                         }
                         ?>
                      
                      
                      			
                      
                      
                      
                      
                      
                      
                      
                      
                     <?php
$email = $row["email"];
$his = $reg_user->runQuery(
    "SELECT * FROM `virtual_card` WHERE email = :email ORDER BY id DESC LIMIT 1"
);
$his->execute([":email" => $email]);
while ($rows = $his->fetch(PDO::FETCH_ASSOC)) { 
    $isInactive = ($rows["card_status"] == 'inactive');
    ?>

    <tr>
        <td>
            <?php if (!$isInactive) { ?>
            <a class="btn btn-danger btn-sm" href="del_card.php?id=<?php echo $rows["id"]; ?>">
                <i class="os-icon os-icon-ui-22"></i><span>DELETE CARD</span>
            </a>
            <?php } ?>
        </td>
        <td>
            <?php if (!$isInactive) { ?>
                <form action="dashboard.php?fundcard" method="POST">
                    <input type="hidden" name="c_id" value="<?php echo $rows["id"]; ?>"/>
                    <input type="submit" class="btn btn-success btn-sm" value="FUND CARD"/>
                </form>
            <?php } ?>
        </td>
    </tr>

<?php } ?>

                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                            </tbody></table>
                        </div>
                    </div>
                </div>
            </div>

            </div>
          </div>
        </div>
      <!--START - Transactions Table-->
      <style>
    .small-icon {
        font-size: 10px; /* Adjust the size as needed */
    }
</style>
<div class="element-wrapper">
    <h6 class="element-header">
        Recent Transactions
    </h6>
    <div class="element-box-tp">
        <div class="table-responsive">
            <table id="dataTable" class="table table-padded">
                <thead>
                    <tr>
                        <th>Reference Id</th>
                        <th>Sender/Beneficiary</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Description</th>
                        <th class="text-center">Status</th>
                        <th class="text-right">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $uname = $_SESSION["uname"];
                    $email = $row["email"];
                    $his = $reg_user->runQuery("SELECT * FROM transfer WHERE email = '$email' ORDER BY id DESC LIMIT 10");
                    $his->execute([":uname" => $_SESSION["uname"]]);
                    while ($rows = $his->fetch(PDO::FETCH_ASSOC)) { 
                    ?>                  
                    <tr>
                        <td>
                            <?php echo rand(11111, 99999) . $rows["id"]; ?>**
                        </td>
                        <td><?php echo $rows["acc_name"]; ?></td>
                        <td style="font-weight:700; <?php echo $rows['type'] == '1' ? 'color:green;' : 'color:red;'; ?>"> 
                            <?php echo $rows['type'] == '1' ? 'CREDIT' : 'DEBIT'; ?>
                        </td>
                        <td class="bolder nowrap">
                            <span class="<?php echo $rows['type'] == '1' ? 'text-success' : 'text-danger'; ?>">
                                <?php
                                echo $row["currency"];
                                echo number_format($rows["amount"]);
                                ?> 
                                <i class="fa <?php echo $rows['type'] == '1' ? 'fa-plus' : 'fa-minus'; ?> small-icon" aria-hidden="true"></i>
                            </span>
                        </td>
                        <td><?php echo $rows["remarks"]; ?></td>
                        <td class="text-center">
                            <label class="badge <?php
                                switch ($rows['status']) {
                                    case 'Processing...':
                                        echo 'badge-warning';
                                        break;
                                    case 'Successful':
                                        echo 'badge-success';
                                        break;
                                    case 'Pending':
                                        echo 'badge-secondary';
                                        break;
                                    case 'On-hold':
                                    case 'Cancelled':
                                    case 'Failed':
                                        echo 'badge-danger';
                                        break;
                                    default:
                                        echo 'badge-secondary';
                                }
                                ?>">
                                <?php echo $rows["status"]; ?>
                            </label>
                        </td>
                        <td class="text-right"><?php echo $rows["routing"]; ?></td>
                    </tr>
                    <?php 
                    }
                    ?>                                         
                </tbody>
            </table>
        </div>
    </div>
</div>
<!--END - Transactions Table-->




      </div>
    </div>
</div>




<style>

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>


<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close">&times;</span>
    
     <div class="element-box">
                                <form  action="card_code.php" method="post" >
                                    <h5 class="form-header">
                                        VISA Card Applciation
                                    </h5>
                                  <div class="form-desc">
                                        Generate Your Visa Card Below <a  class="btn btn-danger" href="beneficiary.php">Tranfer to Beneficiary</a>
                                    </div>
                   
                                   
                                    
						 
                                    <div class="form-group">
                                        <label for=""> Card Number</label>
										
                                        <input readonly class="form-control"value="4316 <?php echo rand(
                                            1231,
                                            7879
                                        ); ?> 5411 <?php echo rand(
     1231,
     7879
 ); ?>" type="text" id="acc_name" name="card_no">
							
						
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for=""> Expiry Date</label>
                                                  <input type="text"  id="exp" name="exp" class="form-control"  readonly value="<?php echo " " .
                                                      date("m/2025"); ?>" > 
	
                                              
                         
                                              
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">CVV/Security Code</label>
                                                <input type="text" class="form-control"  name="cvv" readonly value="<?php echo rand(
                                                    123,
                                                    787
                                                ); ?>" > 
				
                                            </div>
                                        </div>
                                    </div>
                                  
                                
                            <input class="custom-date form-control"  type="hidden" name="card_type" value="VIRTUAL"> 
                             <input class="custom-date form-control"  type="hidden" name="card_status" value="active"> 
                            <input class="custom-date form-control"  type="hidden" name="card_bal" value="0.00"> 
                             <input class="custom-date form-control"  type="hidden" name="card_date" value="<?php echo date(
                                 "h:i A d M Y"
                             ); ?>">
    						 <input class="custom-date form-control"  type="hidden" name="email" value="<?php echo $row[
               "email"
           ]; ?>"> 
    						<input class="custom-date form-control"  type="hidden" name="name" value="<?php echo $row[
              "fname"
          ]; ?> <?php echo $row["lname"]; ?>"> 
    					    <input class="custom-date form-control"  type="hidden" name="uname" value="<?php echo $row[
                 "uname"
             ]; ?>">    
    					    <input class="custom-date form-control"  type="hidden" name="acc_no" value="<?php echo $row[
                 "acc_no"
             ]; ?>"> 
                                    
                                    <div class="form-buttons-w">
                                        <button class="btn btn-primary"  name="add_card"  type="submit"> Generate </button>
										
										
		 
                                    </div>
                                </form>
                       
					   </div>
    
  </div>

</div>

<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

	<?php include "df2.php"; ?>
