<?php
session_start();
require_once 'class.admin.php';
include_once ('session.php');
if(!isset($_SESSION['email'])){
	
header("Location: login.php");

exit(); 
}

$reg_user = new USER();

if(isset($_GET['id'])){
	
$id=$_GET['id'];
$stmt = $reg_user->runQuery("SELECT * FROM ticket WHERE id='$id'");
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
}
if(isset($_POST['delete']))
{

	if($reg_user->delt($id))
			{			
			$id=$_GET['id'];
			$deleteuser = $reg_user->runQuery("DELETE FROM ticket WHERE id = '$id'");
			$deleteuser->execute();
			
			
					 header("Location: ticket.php?success");
			}
			else {
				
					  header("Location: ticket.php?error");
			}
		
	}
    
      
   
?>

  <?php include 'headeradmin.php'; ?>
 

 <!---begin of Mobile View Here   only from Digital Forest Team-->
 
       <?php include 'menu.php'; ?>
  
  <!---End of Mobile View Here   only from Digital Forest Team-->
  
 
      <script type="text/javascript" src="paginator.js"></script>
        <script type="text/javascript" src="table.js"></script>
     
        <br><br><br><br><br><br><br>
  
    <div class="container-fluid mt--7">
     <!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card shadow" >
            <div class="card-header border-0">
              <h3 class="mb-0"><a href=""   class="btn btn-danger">ALL TICKETS</a></h3>
            </div>
          
           <div class="card-body">
               
				  <?php if(isset($msg)) echo $msg;  ?>
                  
                                    
                                    <form class="form-horizontal" method="POST">
										<div class="row">
                                            <label class="col-md-3 label-on-left">Ticket No</label>
                                            <div class="col-md-9">
                                                <div class="form-group label-floating is-empty">
                                                    <label class="control-label"></label>
                                                    <a><?php echo $row['tc']; ?></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label class="col-md-3 label-on-left">Sender</label>
                                            <div class="col-md-9">
                                                <div class="form-group label-floating is-empty">
                                                    <label class="control-label"></label>
													
                                                    <a><?php echo $row['sender_name']; ?></a><br />
													
                                                </div>
                                            </div>
                                        </div>
									
										<div class="clearfix"></div>
										<br />
									   
										<input class="btn btn-md" type="submit" name="delete" value="Delete TICKET">
                                    </form>
                               
               </div>
             
             
               </div>
        </div>
      </div>
     </div>
 
    
       <?php include 'foot.php'; ?>           
				
				
                        
                  