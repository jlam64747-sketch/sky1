<?php 
include_once 'class.crud.php';

?>


 <?php include 'headeradmin.php'; ?>
 
 
      <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
     <!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card shadow"  style="background-color: white; color:black;">
            <div class="card-header border-0">
              <h3 class="mb-0" style="padding-bottom:20px;">All Customer Account</a></h3>
            </div>
          
           <div class="card-body">
               
               
              <div class="table-responsive">
	<table class="table ">
		<tr>
			<th>Entry Id</th>
			<th>Email <small>Sender Account Email</small></th>
			<th>Beneficiary Name</th>
			<th>Transfer Type</th>
			<th>Country</th>
			<th>Beneficiary Acc. Name</th>
			<th>Beneficiary Acc. No</th>
			<th>Amount</th>
			<th>Date</th>
			<th>Status</th>
			<th colspan="2" align="center">Actions</th>
		</tr>
		<?php
			$query = "SELECT * FROM transfer ORDER BY id DESC";       
			$records_per_page=10;
			$newquery = $crud->paging($query,$records_per_page);
			$crud->dataviewt($newquery);
		 ?> 
	</table>
	<div class="pagination-wrap">
		<?php $crud->paginglink($query,$records_per_page); ?>
	</div>
                
            </div> 
             
               
               
               
               
               
               
               
               
          </div>
        </div>
      </div>
     </div>
 </div>
    
       <?php include 'foot.php'; ?>