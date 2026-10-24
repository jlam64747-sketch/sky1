<?php
session_start();
require_once 'class.admin.php';
include_once ('session.php');
if(!isset($_SESSION['email'])){
	
header("Location: login.php");

exit(); 
}
$user_home = new USER();



$stmt = $user_home->runQuery("SELECT * FROM account ORDER BY id DESC LIMIT 200");
$stmt->execute();


?>


 <?php include 'headeradmin.php'; ?>
 
 
      <script type="text/javascript" src="paginator.js"></script>
        <script type="text/javascript" src="table.js"></script>
     
     
  
   
    <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
				 
        <div class="col">
          <div class="card shadow" style="background-color: grey; color:white;">
            <div class="card-header border-0">
              <h3 class="mb-0"><a href=""   class="btn btn-danger">ALL CUSTOMER ACCOUNT</a></h3>
            </div>
          
           <div class="card-body">
               
               
              
            
               
                <div class="table-responsive ">
                        <table class=" table-headertable table-bordered table-hover tile" id="table" style="font-size:16px;">
                            <thead>
                                <tr class=" fixed_header">
                                    <th>PHOTO</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Account</th> 
                                    <th>Email</th>
                                    <th>Sex</th>
                                    <th>Acc Type</th>
                                    <th>Balance</th>
                                    <th>COT</th>
                                    <th>TAX</th>
                                    <th>IMF</th>  
                                    <th>Status</th>
                                    <th>Reg Date</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
	<?php while($row = $stmt->fetch(PDO::FETCH_ASSOC)){?>	
                                <tr id="list">
                                   
                                      <td><img src="pic/<?php echo $row['filename']; ?>" height="60px" width="60px" style="border-radius: 30px; "alt=""></td>
									
									<td><?php echo $row['fname']; ?> <?php echo $row['lname']; ?><br></td>
                                    <td><?php echo $row['uname']; ?></td> 
                                    <td><?php echo $row['acc_no']; ?></td>  
                                    <td><?php echo $row['email']; ?></td>
                                    <td><?php echo $row['sex']; ?></td>
                                    <td><?php echo $row['type']; ?></td>
                                    <td><?php echo $row['currency']; ?><?php echo $row['a_bal']; ?></td>
                                    <td><?php echo $row['cot']; ?></td>
                                    <td><?php echo $row['tax']; ?></td>
                                    <td><?php echo $row['imf']; ?></td> 
                                    
                                    <td><?php echo $row['status']; ?></td>
                                    <td><?php echo $row['reg_date']; ?></td>
                                    
                                </tr>
                                
                                <tr colspan="17"> <div id="list_index" style="color:green;" class="box"></div></tr>
           
                                <br/>

            <script type="text/javascript">
window.addEventListener("load", function () {
    paginator({
        get_rows: function () {
            return document.getElementById("list").getElementsByTagName("td");
        },
        box: document.getElementById("list_index"),
        active_class: "color_page"
    });
}, false);
            </script>
    <?php }?>                     
    
     
                            </tbody>
                        </table>
                    </div>
               
               
               
               
               
               
               
               
          </div>
        </div>
      </div>
     </div>
 
    
       <?php include 'foot.php'; ?>