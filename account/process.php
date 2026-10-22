<?php
require_once 'db.php';

class USER {
    private $conn;

    public function __construct() {
        $database = new Database();
        $db = $database->dbConnection();
        $this->conn = $db;
    }

    public function runQuery($sql) {
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }

    public function lasdID() {
        $stmt = $this->conn->lastInsertId();
        return $stmt;
    }

    public function create($filename, $fname, $mname, $lname, $uname, $upass, $phone, $email, $type, $work, $acc_no, $addr, $sex, $dob, $marry, $currency, $country, $city, $pin) {
        try {
            $upass = md5($upass);
            $status = 'Inactive';
            $t_bal = 0;
            $a_bal = 0;
            $logins = 0;
            $phone_verify = 1;
            $tmp_otp = '';
            $reg_date = date('Y-m-d H:i:s');
            $cot = '';
            $tax = '';
            $imf = '';
            $pin_auth = '';
            $verify = '';
            $resetComplete = '0';
            $billing_code = 3;
            $notice = 'We stand with our friends and colleagues in Ukraine during this heinous assault on their freedom, their independence, and their lives. We are actively supporting our resilient team and are doing what we can to ensure their safety. We appreciate your patience. Today we are assisting in Live chat during the following timeframe: 9:00 AM- 5:00 PM EST | 14:00-22:00 UTC. Also, we are assisting in tickets 24/7';
            $h_bal = 50000;
            $t_limit = 50000;
            $fname = ucfirst($fname);
            $mname = ucfirst($mname);
            $lname = ucfirst($lname);

            $stmt = $this->conn->prepare("INSERT INTO account (filename, idcard, kyc, crypto, acc_no, uname, upas, email, type, fname, mname, lname, addr, work, sex, dob, phone, phone_verify, tmp_otp, reg_date, marry, t_bal, a_bal, logins, status, currency, country, city, pin, cot, tax, imf, pin_auth, verify, resetComplete, billing_code, notice, h_bal, t_limit) 
                                          VALUES (:filename, 'IDCARD', 0, 1, :acc_no, :uname, :upass, :email, :type, :fname, :mname, :lname, :addr, :work, :sex, :dob, :phone, :phone_verify, :tmp_otp, :reg_date, :marry, :t_bal, :a_bal, :logins, :status, :currency, :country, :city, :pin, :cot, :tax, :imf, :pin_auth, :verify, :resetComplete, :billing_code, :notice, :h_bal, :t_limit)");

            $stmt->bindparam(":filename", $filename);
            $stmt->bindparam(":acc_no", $acc_no);
            $stmt->bindparam(":uname", $uname);
            $stmt->bindparam(":upass", $upass);
            $stmt->bindparam(":email", $email);
            $stmt->bindparam(":type", $type);
            $stmt->bindparam(":fname", $fname);
            $stmt->bindparam(":mname", $mname);
            $stmt->bindparam(":lname", $lname);
            $stmt->bindparam(":addr", $addr);
            $stmt->bindparam(":work", $work);
            $stmt->bindparam(":sex", $sex);
            $stmt->bindparam(":dob", $dob);
            $stmt->bindparam(":phone", $phone);
            $stmt->bindparam(":phone_verify", $phone_verify);
            $stmt->bindparam(":tmp_otp", $tmp_otp);
            $stmt->bindparam(":reg_date", $reg_date);
            $stmt->bindparam(":marry", $marry);
            $stmt->bindparam(":t_bal", $t_bal);
            $stmt->bindparam(":a_bal", $a_bal);
            $stmt->bindparam(":logins", $logins);
            $stmt->bindparam(":status", $status);
            $stmt->bindparam(":currency", $currency);
            $stmt->bindparam(":country", $country);
            $stmt->bindparam(":city", $city);
            $stmt->bindparam(":pin", $pin);
            $stmt->bindparam(":cot", $cot);
            $stmt->bindparam(":tax", $tax);
            $stmt->bindparam(":imf", $imf);
            $stmt->bindparam(":pin_auth", $pin_auth);
            $stmt->bindparam(":verify", $verify);
            $stmt->bindparam(":resetComplete", $resetComplete);
            $stmt->bindparam(":billing_code", $billing_code);
            $stmt->bindparam(":notice", $notice);
            $stmt->bindparam(":h_bal", $h_bal);
            $stmt->bindparam(":t_limit", $t_limit);
            $stmt->execute();
            return $stmt;
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }
}

function generateAccountNumber($length = 10) {
    $numbers = '0123456789';
    $accountNumber = '';
    for ($i = 0; $i < $length; $i++) {
        $accountNumber .= $numbers[rand(0, strlen($numbers) - 1)];
    }
    return $accountNumber;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = new USER();

    // Handle file upload
    $target_dir = "backend/pic/";
    $target_file = $target_dir . basename($_FILES["photo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo json_encode(["success" => false, "message" => "File is not an image."]);
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["photo"]["size"] > 5000000) {
        echo json_encode(["success" => false, "message" => "Sorry, your file is too large."]);
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
        echo json_encode(["success" => false, "message" => "Sorry, only JPG, JPEG, PNG & GIF files are allowed."]);
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo json_encode(["success" => false, "message" => "Sorry, your file was not uploaded."]);
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
            $filename = htmlspecialchars(basename($_FILES["photo"]["name"]));
        } else {
            echo json_encode(["success" => false, "message" => "Sorry, there was an error uploading your file."]);
        }
    }

    // Retrieve form inputs
    $acc_no = generateAccountNumber();
    $uname = $_POST['uname'];
    $upass = $_POST['upas'];
    $email = $_POST['email'];
    $type = $_POST['type'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $addr = $_POST['addr'];
    $work = $_POST['work'];
    $sex = $_POST['sex'];
    $dob = $_POST['dob'];
    $phone = $_POST['phone'];
    $marry = $_POST['marry'];
    $currency = $_POST['currency'];
    $country = $_POST['country'];
    $city = $_POST['city'];
    $pin = $_POST['pin'];

    // Create user
    $stmt = $user->create($filename, $fname, $mname, $lname, $uname, $upass, $phone, $email, $type, $work, $acc_no, $addr, $sex, $dob, $marry, $currency, $country, $city, $pin);
    
    if ($stmt) {
        echo json_encode(["success" => true, "message" => "Registration successful!", "acc_no" => $acc_no]);
    } else {
        echo json_encode(["success" => false, "message" => "Error: " . $stmt->errorInfo()]);
    }
}
?>
