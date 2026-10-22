<?php include 'df1.php'; ?>
 
<?php 

if (isset($_POST['rname'])) { 
    $_SESSION['rname'] = $_POST['rname'];
}
if (isset($_POST['rbank'])) { 
    $_SESSION['rbank'] = $_POST['rbank'];
}
if (isset($_POST['racc'])) { 
    $_SESSION['racc'] = $_POST['racc'];
}
if (isset($_POST['remail'])) { 
    $_SESSION['remail'] = $_POST['remail'];
}
if (isset($_POST['rswift'])) { 
    $_SESSION['rswift'] = $_POST['rswift'];
}

if (isset($_POST['badd'])) { 
    $_SESSION['badd'] = $_POST['badd'];
}
if (isset($_POST['iban'])) { 
    $_SESSION['iban'] = $_POST['iban'];
}
?>
  <div class="content-w">
        <!--------------------
                  START - Breadcrumbs
                  -------------------->
        <ul class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="dashboard.php">Home</a>
            </li>
            <li class="breadcrumb-item">
                <a href="#">Beneficiary</a>
            </li>
            <li class="breadcrumb-item">
                <span>View</span>
            </li>
        </ul>
        <!--------------------
        END - Breadcrumbs
        -------------------->
 
       <div class="content-i">
            <div class="content-box">
                <div class="element-wrapper">
                    <h6 class="element-header">
                        Beneficiaries
                    </h6>
                    <div class="element-box">
					
					<?php
        if(isset($_GET['deleted']))
		{
			?>
             <div class="alert">
  <span class="closebtn">&times;</span>  
  <strong>Hello!</strong> Beneficiary Deleted Successfully
</div>
	<?php
		}
		?>
		
		
                        <h5 class="form-header">
                            My Beneficiaries
                        </h5>
                        <div class="table-responsive">
                            <table  style="width: 100%;" class="table table-striped table-hover table-lightfont">
                                <thead>
                                <tr>
                                    <th>Account Name</th>
                                    <th>Bank</th>
                                    <th>Swift Code</th>
                                    <th>E-mail</th>
                                    <th>Phone</th>
                                    <th>Delete</th>
                                    <th>Transfer</th>
                                </tr>
                                </thead>
                               

							   <tbody>
                              
                                    
									<?php 
// Database credentials
    $host = 'localhost';
    $db_username = 'gigobnco_skylajushjus';
    $db_password = '1HoZ,48uoN+8';
    $database = 'gigobnco_skylajushjus';

// Database connection
$conn = mysqli_connect($host, $db_username, $db_password, $database);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$email = $row['email']; 
$query = mysqli_query($conn, "SELECT * FROM `beneficiary` WHERE email = '$email' ORDER BY id DESC LIMIT 20");

while ($active = mysqli_fetch_array($query)) {
    echo '<tr>
            <td>' . $active['rname'] . '</td>
            <td>' . $active['rbank'] . '</td>
            <td>' . $active['rswift'] . '</td>
            <td>' . $active['remail'] . '</td>
            <td>' . $active['rphone'] . '</td>
            <td><a class="btn btn-danger" href="delete_bene.php?id=' . $active['id'] . '" title="Delete Beneficiary">DELETE</a></td>
            <td>
                <form method="POST" action="internationaltrf.php">
                    <input type="hidden" name="rname" value="' . $active['rname'] . '" />
                    <input type="hidden" name="remail" value="' . $active['remail'] . '" />
                    <input type="hidden" name="racc" value="' . $active['racc'] . '" />
                    <input type="hidden" name="rbank" value="' . $active['rbank'] . '" />
                    <input type="hidden" name="rswift" value="' . $active['rswift'] . '" />
                    <input type="hidden" name="badd" value="' . $active['baddress'] . '" />
                    <input type="hidden" name="iban" value="' . $active['iban'] . '" />
                    <button type="submit" class="btn btn-success">SEND MONEY</button>
                </form>
            </td>
        </tr>';
}
?>

                               
                              
                         </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 
 
 <?php include 'df2.php'; ?>