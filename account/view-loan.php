 <?php include 'loan-d.php'; ?>
 
  <div class="content-w">
        <!--------------------
                  START - Breadcrumbs
                  -------------------->
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="dashboard.php">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="#">Loan</a>
            </li>
            <li class="breadcrumb-item">
                <span>View Loan</span>
            </li>
        </ul>
        <!--------------------
        END - Breadcrumbs
        -------------------->
 
    <div class="content-i">
            <div class="content-box">
                <div class="element-wrapper">
                    <h6 class="element-header">
                        Loan
                    </h6>
                    <div class="element-box">
					
					<?php
        if(isset($_GET['deleted']))
		{
			?>
             <div class="alert">
  <span class="closebtn">&times;</span>  
  <strong>Hello!</strong> Loan Deleted Successfully
</div>
	<?php
		}
		?>
                        <h5 class="form-header">
                            Loan Request
                        </h5>
                        <div class="table-responsive">
                            <table  style="width: 100%;" class="table table-striped table-hover table-lightfont">
                                <thead>
                                <tr>
                                    <th>Amount</th>
                                    <th>To Pay Balance</th>
                                    <th>Purpose</th>
                                    <th>Monthly Repay</th>
                                    <th>Duration</th>
                                    <th>Status</th>
                                    <th>Date Applied</th>
                                    <th>Action</th>
                                    
                                </tr>
                                </thead>
                                <tfoot>
                               
											<?php 
				$email = $row['email']; 
				$his = $reg_user->runQuery("SELECT * FROM `quick_loan` WHERE email ='$email' ORDER BY id DESC LIMIT 5 ");
				$his->execute(array(":email"=>$_SESSION['email']));
				while($rows = $his->fetch(PDO::FETCH_ASSOC)){?>
							   <tr>
                                   
   <td class="bolder nowrap"> <span class="text-danger"><?php echo $row['currency']; ?><?php echo $english_format_number = number_format( $rows['loanamt']); ?><i class="os-icon os-icon-arrow-down"></i></span> </td>
                                   
						 
                                    <td><?php echo $row['currency']; ?><?php echo $english_format_number = number_format( $rows['balance'] ); ?></td>
                                    <td><?php echo $rows['purpose']; ?></td>
                                    <td><?php echo $row['currency']; ?><?php echo $rows['monthlypay']; ?></td>
                                    <td><?php echo $rows['dura']; ?>Months</td>
									<td class="text-center"> <label class="badge badge-success"><?php echo $rows['status']; ?></label> </td>
								   <td><?php echo $rows['date']; ?></td>
								   <td><a   class="btn btn-danger" href="del_loan.php?id=<?php echo $rows['id']; ?>">DELETE</a></td>
                                
                                    
                                </tr>
												
							<?php } ?>
								
								
								
                                </tfoot>
                                <tbody>
                                                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
 
 
  <?php include 'df2.php'; ?>