<?php
include_once 'class.crud.php';

if(isset($_POST['btn-del']))
{
	$id = $_GET['delete_id'];
	$crud->delete($id);
	header("Location: delete-customer.php?deleted");	
}

?>


 <?php include 'headeradmin.php'; ?>
 
 
       <div class="content-body">
            <!-- row -->
			<div class="container-fluid">
     <!-- Table -->
      <div class="row">
        <div class="col">
          <div class="card shadow" style="background-color: white; color:black;" >
            <div class="card-header border-0">
              <h3 class="mb-0"><a href=""   class="btn btn-danger">DELETE  ACCOUNT</a></h3>
            </div>
          
           <div class="card-body">
               
      	<?php
	if(isset($_GET['deleted']))
	{
		?>
        <div class="alert alert-success">
    	<strong>Success!</strong> User Account was deleted... 
		</div>
        <?php
	}
	else
	{
		?>
        <div class="alert alert-danger">
    	<strong>Sure !</strong> to remove the following User record ? 
		</div>
        <?php
	}
	?>	  
               
<div class="container-fluid">
 


 						<form method="POST">
                           
                          <?php
	 if(isset($_GET['delete_id']))
	 {
		 ?>
         <table class='table table-bordered'>
         <tr>
			<th>Entry Id</th>
			<th>Acc.No</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Login Pin</th>
			<th>Transfer Pin</th>
			<th>Username</th>
         </tr>
         <?php
         $stmt = $DB_con->prepare("SELECT * FROM account WHERE id=:id");
         $stmt->execute(array(":id"=>$_GET['delete_id']));
         while($row=$stmt->fetch(PDO::FETCH_BOTH))
         {
             ?>
             <tr>
				<td><?php print($row['id']); ?></td>
				<td><?php print($row['acc_no']); ?></td>
                <td><?php print($row['fname']); ?></td>
                <td><?php print($row['lname']); ?></td>
                <td><?php print($row['email']); ?></td>
                <td><?php print($row['pin_auth']); ?></td>
				<td><?php print($row['pin']); ?></td>
				<td><?php print($row['uname']); ?></td>
             </tr>
             <?php
         }
         ?>
         </table>
         <?php
	 }
	 ?>        
                             
               
            <?php
if(isset($_GET['delete_id']))
{
	?>
  	<form method="post">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>" />
    <button class="btn btn-sm btn-danger" type="submit" name="btn-del"><i class="glyphicon glyphicon-trash"></i> &nbsp; YES</button>
    <a href="index.php" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; NO</a>
    </form>  
	<?php
}
else
{
	?>
    <a href="index.php" class="btn btn-large btn-success"><i class="glyphicon glyphicon-backward"></i> &nbsp; Back to index</a>
    <?php
}
?>              
                          
                          
                        </form>

 

</div>
               
               
               
          </div>
        </div>
      </div>
     </div>
 </div>










                                
 

   <?php include 'foot.php'; ?>