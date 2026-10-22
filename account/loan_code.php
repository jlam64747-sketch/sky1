<?php
session_start();

include_once ('df/session.php');
require_once 'df/controller.php';
if(!isset($_SESSION['uname'])){
header("Location: login.php");
exit(); 
}

$reg_user = new USER();
		 	 
$stmt = $reg_user->runQuery("SELECT * FROM account WHERE uname=:uname");
$stmt->execute(array(":uname" => $_SESSION['uname']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);


 
	   
	   
 
		
	 if(isset($_POST['add_loan'])){
						   
						                            $conn = mysqli_connect($host, $username, $password, $database);
                                                    
                                                    // Check connection
                                                    
                                                    if (!$conn) {
                                                          die("Connection failed: " . mysqli_connect_error());
                                                    }
                                                     
                                                    echo ""; 
                                                    
                                                    $db_select = mysqli_select_db($con, $database);
						   
						                         
                                                    $name =$_REQUEST['name'];
						                            $uname =$_REQUEST['uname'];
						                            $email =$_REQUEST['email'];
						                            $loanamt =$_REQUEST['loanamt'];
						                            $inter =$_REQUEST['inter'];
						                            $dura =$_REQUEST['dura'];
                                                    $monthlypay =$_REQUEST['monthlypay'];
                                                    $purpose =$_REQUEST['purpose'];
                                                    $balance =$_REQUEST['balance'];
                                                    $status =$_REQUEST['status'];
                                                    $date =$_REQUEST['date'];            
                                            
    $stmt = $reg_user->runQuery("SELECT * FROM quick_loan WHERE loanamt=:loanamt");
    $stmt1 = $reg_user->runQuery("SELECT * FROM quick_loan WHERE dura=:dura"); 
    $stmt->execute(array(":loanamt" => $loanamt));
    $stmt1->execute(array(":dura" => $dura)); 
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $row1 = $stmt1->fetch(PDO::FETCH_ASSOC); 


    if ($stmt->rowCount() > 0 || $stmt1->rowCount() > 0 ) {
        
		header("Location: quick_loan.php?pending"); 
	   exit;
 
    } else {        
        $sql = "INSERT INTO `quick_loan` (`id`, `name`, `uname`, `email`, `loanamt`, `inter`, `dura`, `monthlypay`, `purpose`, `balance`, `status`, `date`) 
        VALUES (NULL, '$name', '$uname', '$email', '$loanamt', '$inter', '$dura', '$monthlypay', '$purpose', '$balance', '$status', '$date')"; 
                                                      
                                                                            
          
                            						   $insert=mysqli_query($conn, $sql);
                            						   
                            						   if($insert){
                            						       
                            						      header("Location: create-loan.php?success"); 
															exit;
   
                            							   
                            						   }else{
                            						       
                            						      header("Location: create-loan.php?failed"); 
															exit;
 
                            						       
                            						       
                            						   }
                            					   
					                                }
					                                }
		
		
       
 
?>