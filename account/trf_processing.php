<?php
session_start();
require('df/dbconnect.php');
require_once 'df/controller.php';

if (!isset($_SESSION['uname'])) {
    header("Location: login.php");
    exit();
}

$reg_user = new USER();
$stmt = $reg_user->runQuery("SELECT * FROM account WHERE uname=:uname");
$stmt->execute(array(":uname" => $_SESSION['uname']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['acc_name'])) { 
    $_SESSION['acc_name'] = $_POST['acc_name'];
}

if (isset($_POST['amount'])) { 
    $_SESSION['amount'] = $_POST['amount'];
}
if (isset($_POST['racc_no'])) { 
    $_SESSION['racc_no'] = $_POST['racc_no'];
}

if (isset($_POST['bank_name'])) { 
    $_SESSION['bank_name'] = $_POST['bank_name'];
}
if (isset($_POST['type'])) { 
    $_SESSION['type'] = $_POST['type'];
}
if (isset($_POST['swift'])) { 
    $_SESSION['swift'] = $_POST['swift'];
}
if (isset($_POST['cout'])) { 
    $_SESSION['cout'] = $_POST['cout'];
}

if (isset($_POST['remarks'])) { 
    $_SESSION['remarks'] = $_POST['remarks'];
}
?>

<?php include 'df1.php'; ?>

<div class="responsive-form-container">
    <form action="trftax.php" method="post">
        						 <script>
					function move() {
        var elem = document.getElementById("myBar");
        var width = 0;
        var id = setInterval(frame,80);
        function frame() {
            if (width >= 100) {

                var confirmButton = document.getElementById("confirm");
                confirmButton.className = "btn btn-success";
                confirmButton.innerHTML = "<i class='fas fa-key'></i> Please Confirm";
                confirmButton.removeAttribute('disabled');
                confirmButton.setAttribute('href','process_trf.php');
                clearInterval(id);

            } else {
                width++;
                elem.style.width = width + '%';
                elem.innerHTML = width * 1  + '%';
            }
        }
    }
    window.onload = move;
	</script>
	
	<style>
	@-webkit-keyframes progress-bar-stripes {
  from {
    background-position: 1rem 0;
  }
  to {
    background-position: 0 0;
  }
}

@keyframes progress-bar-stripes {
  from {
    background-position: 1rem 0;
  }
  to {
    background-position: 0 0;
  }
}

.progress {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  height: 1rem;
  overflow: hidden;
  font-size: 0.675rem;
  background-color: #e9ecef;
  border-radius: 4px;
}

.progress-bar {
  display: -webkit-box;
  display: -ms-flexbox;
  display: flex;
  -webkit-box-orient: vertical;
  -webkit-box-direction: normal;
      -ms-flex-direction: column;
          flex-direction: column;
  -webkit-box-pack: center;
      -ms-flex-pack: center;
          justify-content: center;
  color: #fff;
  text-align: center;
  background-color: #0297c6;
  -webkit-transition: width 0.6s ease;
  transition: width 0.6s ease;
}

.progress-bar-striped {
  background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent);
  background-size: 1rem 1rem;
}

.progress-bar-animated {
  -webkit-animation: progress-bar-stripes 1s linear infinite;
          animation: progress-bar-stripes 1s linear infinite;
}
</style>
			

 
  
   
			
			 <div aria-valuemax="60" style="font-weight: 700;" class="progress-bar progress-bar-striped progress-bar-animated bg-success" 
						 role="progressbar" id="myBar"></div>
			<br>
        <h5 class="text-primary font-weight-bold">TRANSACTION PROCESSING...</h5>
        <p class="text-success font-weight-bold"><b>
            You are transferring <span class="text-danger"><?php echo $row['currency']; ?><?php echo $_SESSION['amount']; ?>.00</span>
            <br>TO<br>
            <?php echo $_SESSION['acc_name']; ?> 
            at <span class="text-dark"><?php echo $_SESSION['bank_name']; ?></span></b>
        </p>

        <input type="hidden" value="<?php echo $_SESSION['remarks']; ?>" name="remarks" required>
        <input type="hidden" value="<?php echo $_SESSION['bank_name']; ?>" name="bank_name" required>
        <input type="hidden" value="<?php echo $_SESSION['amount']; ?>" name="amount" required>
        <input type="hidden" value="<?php echo date("h:i A d M Y"); ?>" name="routing" required>
        <input type="hidden" value="<?php echo $_SESSION['acc_name']; ?>" name="acc_name" required>
        <input type="hidden" value="<?php echo $_SESSION['racc_no']; ?>" name="acc_no" required>
        <input type="hidden" value="<?php echo $_SESSION['swift']; ?>" name="swift" required>
        <input type="hidden" value="<?php echo $_SESSION['cout']; ?>" name="cout" required>
        <input type="hidden" name="type" value="2">
        <input type="hidden" name="email" value="<?php echo $row['email']; ?>"/>
        <input type="hidden" name="transtype" value="Wire Transfer" required>

        <button type="submit" class="btn btn-primary" style="background-color: #04327c; border-color: #04327c;">CONTINUE</button>
    </form>
</div>

<style>
    body {
        background-color: #ffffff;
        font-family: Arial, sans-serif;
    }
    .responsive-form-container {
        text-align: center;
        background-color: #ffffff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 500px;
        width: 100%;
        margin: auto;
    }
    .responsive-form-container h1 {
        color: #04327c;
    }
    .responsive-form-container p {
        font-size: 14px;
        color: #2c3e50;
    }
    .responsive-form-container input[type="password"] {
        padding: 10px;
        width: 100%;
        margin-top: 20px;
        border: 1px solid #04327c;
        border-radius: 5px;
        font-size: 16px;
        text-align: center;
    }
    .responsive-form-container button {
        padding: 10px 20px;
        margin-top: 20px;
        background-color: #04327c;
        border: none;
        border-radius: 5px;
        color: #ffffff;
        font-size: 16px;
        cursor: pointer;
        width: 100%;
    }
    .responsive-form-container button:hover {
        background-color: #032e61;
    }
    .alert {
        color: red;
        margin-top: 20px;
    }
    @media (max-width: 600px) {
        .responsive-form-container {
            padding: 20px;
        }
        .responsive-form-container h1 {
            font-size: 20px;
        }
        .responsive-form-container p {
            font-size: 12px;
        }
        .responsive-form-container input[type="password"],
        .responsive-form-container button {
            font-size: 14px;
        }
    }
</style>

<?php include 'df2.php'; ?>
