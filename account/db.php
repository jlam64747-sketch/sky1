<?php
class Database
{
     
    private $host = "localhost";
    private $db_name = "gigobnco_sghagass";
    private $username = "gigobnco_sghagass";
    private $password = "kf1J%ZlytTCp";
    public $conn;
     
    public function dbConnection()
	{
     
	    $this->conn = null;
	    $DB_con = null;
        try
		{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);	
			
        }
		catch(PDOException $exception)
		{
            echo "Connection error: " . $exception->getMessage();
        }
         
        return $this->conn;
    }
}

$connection = mysqli_connect('localhost', 'gigobnco_sghagass', 'kf1J%ZlytTCp');
if (!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, 'gigobnco_sghagass');
if (!$select_db){
    die("Database Selection Failed" . mysqli_error($connection));
}

$site_title = 'SkyLark';
$domain = 'https://demo.theserviceportal.com';
$site_address = '';
$site_country = 'FINLAND';
$site_phone = '+';
$site_email = 'support@amatechic.com'; 


//THEME COLOR SETTINGS
$tab = '#5469b0'; 
$font = 'white';

$DB_host = "localhost";
$DB_user = "gigobnco_sghagass";
$DB_pass = "kf1J%ZlytTCp";
$DB_name = "gigobnco_sghagass";


     $host = "localhost";
    $database = "gigobnco_sghagass";
    $username = "gigobnco_sghagass";
    $password = "kf1J%ZlytTCp";

try
{
	$DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
	$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
	echo $e->getMessage();
}