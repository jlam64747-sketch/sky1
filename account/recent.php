<?php include 'df1.php'; ?>
 
 
 
  <div class="content-w">
        <!--------------------
                  START - Breadcrumbs
                  -------------------->
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="dashboard.php">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="#">History</a>
            </li>
            <li class="breadcrumb-item">
                <span>Recent</span>
            </li>
        </ul>
        <!--------------------
        END - Breadcrumbs
        -------------------->
 
 
 
  <div class="content-i">
            <div class="content-box">
                <div class="element-wrapper">
                    <h6 class="element-header">
                        Recent
                    </h6>
                    <div class="element-box">
                        <h5 class="form-header">
                            Recent Transactions
                        </h5>
                        <div class="form-desc">
                            My last 10 transactions
                        </div>
                        <div class="table-responsive">
                            <table  style="width: 100%;" class="table table-striped table-hover table-lightfont">
                                <thead>
                                <tr>
                                    <th>Reference ID</th>
                                    <th>Beneficiary</th>
                                    <th>Amount</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>Reference ID</th>
                                    <th>Beneficiary</th>
                                    <th>Amount</th>
                                    <th>Description</th>
                                    <th>Date</th>
                                </tr>
                                </tfoot>
                                <tbody>
                                                                                                                                    	<?php 
						$uname = $_SESSION['uname'];
						$email = $row['email'];
						$his = $reg_user->runQuery("SELECT * FROM transfer WHERE email = '$email' ORDER BY id DESC LIMIT 10");
						$his->execute(array(":uname"=>$_SESSION['uname']));
						while($rows = $his->fetch(PDO::FETCH_ASSOC)){?>					
																  
																  <tr>
                    <td>
                        <?php echo(rand(11111,99999)); ?><?php echo $rows['id']; ?>**
                    </td>
                    <td><?php echo $rows['acc_name']; ?></td>
                    <td class="bolder nowrap"> <span class="text-danger"><?php echo $row['currency']; ?><?php echo $english_format_number = number_format( $rows['amount']); ?> <i class="os-icon os-icon-arrow-down"></i></span>  </td>
                    <td><?php echo $rows['remarks']; ?></td>
                     
                    <td class="text-right"><?php echo $rows['routing']; ?></td>
                </tr>
 
                      <?php } ?>   
                      
                              </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
 
 
 
 
 
 
 
 <?php include 'df2.php'; ?>