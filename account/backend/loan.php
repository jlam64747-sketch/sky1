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
              <h3 class="mb-0" style="color:#000;">All Customer Loans</h3>
            </div>
           
             
           <div class="card-body">
               
               
               
               
               
                                 <div class="col-md-5 align-self-center">
                        
                    </div>
                                <h3 class="card-subtitle" style="color:#000;">Click EDIT to Approve/Fund/Edit Loan/Facility</b> </h3>
                              <hr>
                                <div class="table-responsive m-t-40">
                                    <table id="example2" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                  
                                            <tr>
       
			 
			<th>Full Name/Email</th> 
			<th>Requested Amount</th>
			<th>Interest %</th>
			<th>Duration</th>
			<th>Monthly Payment</th>
			<th>Loan Balance</th>
			<th>Status</th>
			<th>Request Date</th>
			<th colspan="2" align="center">Actions</th>
                                            </tr>
                                      
                                            	<?php
                                            	
			$query  = "SELECT * FROM `quick_loan`";       
			$records_per_page=100;
			$newquery = $crud->paging($query,$records_per_page);
			$crud->dataviewloan($newquery);
		 ?> 
                                      
                                    </table>
                                </div>
                            </div><div class="card-body">TOTAL CUSTOMERS CARDS:  <?php $crud->paginglink($query,$records_per_page); ?></div>
             
 
        
          </div>
        </div>
      </div>
     
     </div>
     <script>
    $(document).ready(function() {
        $('#myTable').DataTable();
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                            last = group;
                        }
                    });
                }
            });
            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                    table.order([2, 'desc']).draw();
                } else {
                    table.order([2, 'asc']).draw();
                }
            });
        });
    });
    $('#example23').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
    </script>
    
    
       <?php include 'foot.php'; ?>