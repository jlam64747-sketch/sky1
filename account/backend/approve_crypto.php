<?php 
include_once 'class.crud.php';

?>
 <?php include 'headeradmin.php'; ?>
 
 

     <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
			
			
			
				 
		<?php
        if(isset($_GET['del']))
		{
			?>
             
							<div class='popup' > <div class="modal-dialog modal-sm" >
							<div style="background-color:green; border:solid;" ><div class="modal-content"  >
								<div class="modal-header" style="background-color:white;">
									<h5 class="modal-title"></h5>
									<button type="button" class="btn-close" data-bs-dismiss="modal">
									</button>
								</div>
								<div class="modal-body" style="background-color:white; ">  
							 <center>
							 <img src="../icons/cancel.png" height="80px"  width="80px" /><hr>
					
						 <h3 style="color:green; font-weight:900;">TRANSACTIONS DELETED</h3>
							  
							<form action="index.php" method="POST"> 
							<button type="submit" style="font-weight:900;"  class="btn btn-success">OKAY</button>  </form>


							  </center>
							</div>
				 
								
					
							</div></div>
						</div> </div>
	<?php
		}
		?>	
						
			
			
			
			
			
			
			
			
			
			
			
     <!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card shadow"  style="background-color: grey; color:white;">
            <div class="card-header border-0">
              <h3 class="mb-0"><a href=""   class="btn btn-danger">APPROVE CRYPTO TRANSACTIONS</a></h3>
            </div>
           
             
           <div class="card-body">
               
               
               
               
               
                                 <div class="col-md-5 align-self-center">
                        
                    </div>
                                <h3 class="card-subtitle">CLICK APPROVE OR DEL TO DELETE</b> </h3>
                              <hr>
                                <div class="table-responsive m-t-40">
                                    <table id="example2" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                    
              <tr>
       
			 
			<th>EMAIL</th> 
			<th>SENDER WALLET</th>
			<th>RECEIVER WALLET</th>
			<th>COIN TYPE</th>
			<th>AMOUNT</th>
			<th>REFERENCE NO</th>
			<th>DATE</th>
			<th>STATUS</th> 
			<th colspan="2" align="center">Actions</th>
                </tr>
                                
               
             <?php
                                    	
			$query  = "SELECT * FROM c_trans";       
			$records_per_page=510;
			$newquery = $crud->paging($query,$records_per_page);
			$crud->dataviewcrypto($newquery);
		 ?> 
	 
		 
		 
		 
                                   
                                    </table>
									
                                </div>
                            </div>
             
 
        
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