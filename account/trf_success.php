<?php
session_start();
require('df/dbconnect.php');
require_once 'df/controller.php';

if (!isset($_SESSION['uname'])) {
    header("Location: login.php");
    exit();
}

// Check if OTP verification was completed
if (!isset($_SESSION['otp_verify']) || $_SESSION['otp_verify'] !== true) {
    header("Location: otp_verify.php?errorotp");
    exit();
}

$reg_user = new USER();

$stmt = $reg_user->runQuery("SELECT * FROM account WHERE uname=:uname");
$stmt->execute(array(":uname" => $_SESSION['uname']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$email = $row['email'];

$temp = $reg_user->runQuery("SELECT * FROM transfer WHERE email = '$email' ORDER BY id DESC LIMIT 1");
$temp->execute(array(":uname" => $_SESSION['uname']));
$rows = $temp->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <title>Transfer Successful | <?php echo $site_title; ?></title>
    <meta charset="utf-8">
    <meta content="ie=edge" http-equiv="x-ua-compatible">
    <meta content="template language" name="keywords">
    <meta content="" name="author">
    <meta content="" name="description">
    <meta content="width=device-width, initial-scale=1" name="viewport"> 
    <link href="public/images/favicon.png" rel="shortcut icon">
    <link href="apple-touch-icon.png" rel="apple-touch-icon">
    <link href="public/css/src/bootstrap/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="public/css/src/splide/splide.min.css" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600&display=swap" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="public/css/all.min.css" rel="stylesheet" type="text/css" />
    <link href="public/js/plugins/datatable/datatables.min.css"
        rel="stylesheet" type="text/css" />
    <link href="public/css/others.css" rel="stylesheet" type="text/css" />
    <link href="public/css/style.css" rel="stylesheet" type="text/css" />
    <!-- ========= Custom JS Files =========  -->
    <script src="https://firstalliancefinance.com/assets/javascript/jquery.min.js"></script>
    <script src="https://firstalliancefinance.com/assets/javascript/clipboard.min.js"></script>
    <script src="https://firstalliancefinance.com/assets/javascript/countries.js"></script>

    <style>
        th {
            font-size: 16px;
        }
    </style>
    <style>
        .progress {
            width: 150px;
            height: 150px !important;
            text-align: center;
            line-height: 150px;
            background: none;
            margin: 20px;
            box-shadow: none;
            position: relative;
        }

        .progress:after {
            content: "";
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 12px solid #fff;
            position: absolute;
            top: 0;
            left: 0;
        }

        .progress>span {
            width: 50%;
            height: 100%;
            overflow: hidden;
            position: absolute;
            top: 0;
            z-index: 1;
        }

        .progress .progress-bar {
            width: 100%;
            height: 100%;
            background: none;
            border-width: 12px;
            border-style: solid;
            position: absolute;
            top: 0;
        }

        .progress .progress-right {
            right: 0;
        }

        .progress .progress-right .progress-bar {
            left: -100%;
            border-top-left-radius: 80px;
            border-bottom-left-radius: 80px;
            border-right: 0;
            -webkit-transform-origin: center right;
            transform-origin: center right;
            animation: loading-1 1.8s linear forwards;
        }

        .progress .progress-value {
            width: 90%;
            height: 90%;
            border-radius: 50%;
            background: #000;
            font-size: 10px;
            color: #fff;
            line-height: 135px;
            text-align: center;
            position: absolute;
            top: 5%;
            left: 5%;
        }

        .progress.blue .progress-bar {
            border-color: #049dff;
        }
    </style>
</head>

<body>
    <div id="appCapsule">
        <!-- Transactions -->
        <div class="section mt-4">
            <div class="row">
                <div class="col-lg-12">
                     <style>
                        .progress-value1 {
                            animation: load 5s normal forwards;
                            box-shadow: 0 10px 40px -10px #fff;
                            border-radius: 10px;
                            background: rgb(44, 245, 99);
                            background: linear-gradient(261deg, rgba(44, 245, 99, 1) 57%, rgba(154, 255, 12, 1) 98%);
                            height: 30px;
                            width: 0;
                        }

                        .progress-value1 {
                            color: #fff;
                            font-size: 14px;
                            text-align: center;
                            margin-top:
                        }

                        @keyframes load {
                            0% {
                                width: 75%;
                            }
                        }
                    </style>
                    <div class="card">
                        <div class="card-header">
                            <div class="progress-value1" style="width: 100%"><span>100%</span></div>
    &nbsp;&nbsp;<a href="../account/dashboard.php" class="btn btn-outline-primary">Home</a>&nbsp;&nbsp;
                            <button id="download-page-as-image"
                                class="btn btn-sm btn-outline-primary float-right">DOWNLOAD&nbsp;<i
                                    class="fa fa-download"></i></button>

                        </div>
                        <div class="card-body">
                            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=VT323">
                            <style>
                                #invoice-POS,
                                #content {
                                    padding: 2mm;
                                    margin: 0 auto;
                                    width: 500px;
                                    background-color: #fff;
                                    font-family: "VT323", regular;

                                }

                                @media only screen and (max-width: 600px) {

                                    #invoice-POS,
                                    #content {
                                        padding: 2mm;
                                        margin: 0 auto;
                                        width: 100%;
                                        background-color: #fff;
                                        font-family: "VT323", regular;
                                    }
                                }

                                #invoice-POS::selection {
                                    color: #fff;
                                }

                                #invoice-POS::moz-selection {
                                    background: #000000;
                                    color: #fff;
                                }

                                #invoice-POS h1 {
                                    font-size: 20px;
                                    color: #222;
                                }

                                #invoice-POS h2 {
                                    font-size: 20px;
                                }

                                #invoice-POS h3 {
                                    font-size: 25px;
                                    font-weight: 300;
                                    line-height: 2em;
                                }

                                #invoice-POS p {
                                    font-size: 16px;
                                    color: #666;
                                    line-height: 1.2em;
                                }

                                #invoice-POS #top,
                                #invoice-POS #mid,
                                #invoice-POS #bot {
                                    /* Targets all id with 'col-' */
                                    border-bottom: 1px solid #eee;
                                }

                                #invoice-POS #top {
                                    height: auto;
                                    padding: 20px;
                                }

                                #invoice-POS #mid {
                                    height: auto;
                                    padding: 10px 0;
                                }

                                #invoice-POS #bot {
                                    min-height: 50px;
                                }

                                #invoice-POS #top .logo {
                                    height: 60px;
                                    width: 100px;
                                    background: url("uploads/1714883299_22c13cfd163bfac9f396.png") no-repeat;
                                    background-size: 80px 40px;
                                }

                                #invoice-POS .info {
                                    display: block;
                                    margin-left: 0;
                                    text-align: center;
                                }

                                #invoice-POS .title {
                                    float: right;
                                }

                                #invoice-POS .title p {
                                    text-align: right;
                                }

                                #invoice-POS table {
                                    width: 100%;
                                    border-collapse: collapse;
                                }

                                #invoice-POS .tabletitle {
                                    font-size: 18px;
                                    background: #eee;
                                }

                                #invoice-POS .tabletitle td {
                                    padding: 5px 0px 0px 10px;
                                }

                                #invoice-POS .service td {
                                    padding: 5px 0px 0px 10px;
                                }

                                #invoice-POS .service td {
                                    border-bottom: 1px solid #eee;
                                }

                                #invoice-POS .item {
                                    width: 24mm;
                                }

                                #invoice-POS .itemtext {
                                    font-size: 16px;
                                }

                                #invoice-POS #legalcopy {
                                    margin-top: 5mm;
                                }

                                #invoice-POS .legal {
                                    text-align: center;
                                }

                                #invoice-POS .botlogo {
                                    display: block;
                                    margin-left: auto;
                                    margin-right: auto;
                                    width: 30%;
                                }

                                #invoice-POS .mainlogo {
                                    display: block;
                                    margin-left: auto;
                                    margin-right: auto;
                                    width: 30%;
                                }

                                #invoice-POS button {
                                    background-color: #2f3a5f;
                                    color: white;
                                    text-align: center;
                                    display: inline-block;
                                    font-size: 14px;
                                    padding: 10px;
                                    cursor: pointer;
                                    outline: none;
                                    border: none;
                                    width: 100%;
                                }

                                #invoice-POS button:hover,
                                #invoice-POS button:active {
                                    background-color: #ffffff;
                                    color: #2f3a5f;
                                    border: 2px solid #2f3a5f;
                                    font-weight: 600;
                                }

                                .myBg {
                                    position: relative;
                                    z-index: 1;
                                }

                                .myBg .bg {
                                    position: absolute;
                                    z-index: -1;
                                    top: 0;
                                    bottom: 0;
                                    left: 0;
                                    right: 0;
                                    background-repeat: repeat;
                                    background-size: auto;
                                    background: url(uploads/1714883332_f3ba75df235db4d98ee2.png) center center;
                                    opacity: .1;
                                    -webkit-filter: grayscale(100%);
                                    /* Safari 6.0 - 9.0 */
                                    filter: grayscale(100%);
                                }
                            </style>

                            <div id="content">
                                <div id="invoice-POS" class="myBg" style="padding: 5px 5px;">
                                    <div class="bg"></div>

                                    <div id="top">
                                      <center><img src="public/images/logo.png"
                                           width="250px"  height="90px"> </center>
                                        <div class="info" style="text-align: center; color: #2f3a5f;">
                                            <h2>Transaction Receipt</h2>
                                        </div>
                                        <!--End Info-->
                                    </div>
                                    <!--End InvoiceTop-->

                                    <div id="mid">
                                        <div class="info">
                                            <p>
                                                Transaction Receipt
                                            </p>
                                        </div>
                                    </div>
                                    <!--End Invoice Mid-->

                                    <div id="bot">
                                        <div id="table">
                                            <!--SENDER DETAILS -->
                                            <table>
                                                <tr class="tabletitle">
                                                    <td class="item" colspan="2">
                                                        <h3 class="font-weight-bold">SENDER</h3>
                                                    </td>
                                                </tr>

                                                <tr class="service">
                                                    <td class="tableitem">
                                                        <p class="itemtext text-uppercase">Name
                                                        </p>
                                                    </td>
                                                    <td class="tableitem">
                                                        <p class="itemtext text-capitalize">
                                                            <?php echo $row['fname']; ?> <?php echo $row['lname']; ?> </p>
                                                    </td>
                                                </tr>
                                                <tr class="service">
                                                    <td class="tableitem">
                                                        <p class="itemtext text-uppercase">Account Number
                                                        </p>
                                                    </td>
                                                    <td class="tableitem">
                                                        <p class="itemtext"><?php echo $row['acc_no']; ?></p>
                                                    </td>
                                                </tr>
                                                <tr class="service">
                                                    <td class="tableitem">
                                                        <p class="itemtext text-uppercase">Account Type
                                                        </p>
                                                    </td>
                                                    <td class="tableitem">
                                                        <p class="itemtext">
                                                            <?php echo $row['type']; ?> </p>
                                                    </td>
                                                </tr>

                                            </table>
                                            <!--SENDER DETAILS -->

                                            <table>
                                                <tr class="tabletitle">
                                                    <td class="item" colspan="2">
                                                        <h3 class="font-weight-bold">RECEIVER</h3>
                                                    </td>
                                                </tr>
                                                <tr class="service">
                                                    <td class="tableitem">
                                                        <p class="itemtext text-uppercase">Bank
                                                        </p>
                                                    </td>
                                                    <td class="tableitem">
                                                        <p class="itemtext">
                                                            <?php echo $rows['bank_name']; ?></p>
                                                    </td>
                                                </tr>

                                                <tr class="service">
                                                    <td class="tableitem">
                                                        <p class="itemtext text-uppercase">Name
                                                        </p>
                                                    </td>
                                                    <td class="tableitem">
                                                        <p class="itemtext text-capitalize">
                                                            <?php echo $rows['acc_name']?> </p>
                                                    </td>
                                                </tr>
                                                <tr class="service">
                                                    <td class="tableitem">
                                                        <p class="itemtext text-uppercase">Account Number
                                                        </p>
                                                    </td>
                                                    <td class="tableitem">
                                                        <p class="itemtext"><?php echo $rows['acc_no']?></p>
                                                    </td>
                                                </tr>
                                                <tr class="service">
                                                    <td class="tableitem">
                                                        <p class="itemtext text-uppercase">Amount
                                                        </p>
                                                    </td>
                                                    <td class="tableitem">
                                                        <p class="itemtext">
                                                           <?php echo $row['currency']?><?php echo $rows['amount']?>.00</p>
                                                    </td>
                                                </tr>

                                            </table>


                                            <!-- <table>
                                                <tr class="tabletitle">
                                                    <td class="item" colspan="2">
                                                        <h3 class="font-weight-bold">RECEIVER BANK DETAILS</h3>
                                                    </td>
                                                </tr>

                                                <tr class="service">
                                                    <td class="tableitem">
                                                        <p class="itemtext text-uppercase">Bank
                                                        </p>
                                                    </td>
                                                    <td class="tableitem">
                                                        <p class="itemtext">
                                                            First Alliance Finance Bank </p>
                                                    </td>
                                                </tr>
                                                <tr class="service">
                                                    <td class="tableitem">
                                                        <p class="itemtext text-uppercase">Address
                                                        </p>
                                                    </td>
                                                    <td class="tableitem">
                                                        <p class="itemtext">
                                                             </p>
                                                    </td>
                                                </tr>

                                            </table> -->

                                            <table>
                                                <tr class="tabletitle">
                                                    <td class="item" colspan="2">
                                                        <h3 class="font-weight-bold">TRANSACTION DETAILS</h3>
                                                    </td>
                                                </tr>

                                                <tr class="service">
                                                    <td class="tableitem">
                                                        <p class="itemtext">REMARKS
                                                        </p>
                                                    </td>
                                                    <td class="tableitem">
                                                        <p class="itemtext">
                                                            <?php echo $rows['remarks']; ?></p>
                                                    </td>
                                                </tr>
                                                <tr class="service">
                                                    <td class="tableitem">
                                                        <p class="itemtext">REFERENCE
                                                        </p>
                                                    </td>
                                                    <td class="tableitem">
                                                        <p class="itemtext">
                                                            <?php echo(rand()); ?>830<?php echo(rand()); ?> </p>
                                                    </td>
                                                </tr>
                                                <tr class="service">
                                                    <td class="tableitem">
                                                        <p class="itemtext">DATE
                                                        </p>
                                                    </td>
                                                    <td class="tableitem">
                                                        <p class="itemtext">
                                                           <?php echo date("h:i A d M Y"); ?></p>
                                                    </td>
                                                </tr>

                                            </table>
                                        </div>
                                        <!--End Table-->

                                        <div id="legalcopy">
                                            <img src="uploads/nsua.jpg"
                                                class="botlogo">
                                        </div>
                                        <br>
                                        <div align="center"><small><?php echo date("h:i A d M Y"); ?></small>
                                        </div>
                                        <br><br>
                                    </div>

                                </div>
                            </div>
                            <!--End InvoiceBot-->
                        </div>
                        <div class="card-footer">
                            <div class="card-footer-content text-muted text-center">
                                &nbsp;
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- * Transac -->
        </div>
        <script>
            setUpDownloadPageAsImage();

            function setUpDownloadPageAsImage() {
                document.getElementById("download-page-as-image").addEventListener("click", function () {
                    html2canvas(document.getElementById("content")).then(function (canvas) {
                        console.log(canvas);
                        simulateDownloadImageClick(canvas.toDataURL(), '<?php echo date("h:i A d M Y"); ?>_Receipt.png');
                    });
                });
            }

            function simulateDownloadImageClick(uri, filename) {
                var link = document.createElement('a');
                if (typeof link.download !== 'string') {
                    window.open(uri);
                } else {
                    link.href = uri;
                    link.download = filename;
                    accountForFirefox(clickLink, link);
                }
            }

            function clickLink(link) {
                link.click();
            }

            function accountForFirefox(click) { // wrapper function
                let link = arguments[1];
                document.body.appendChild(link);
                click(link);
                document.body.removeChild(link);
            }
        </script>
        <!-- Bootstrap -->
      <script src="public/css/src/bootstrap/bootstrap.min.js"
            type="text/javascript"></script>
        <script src="public/js/lib/bootstrap.bundle.min.js"
            type="text/javascript"></script>
        <script src="public/js/plugins/splide/splide.min.js"
            type="text/javascript"></script>
        <script src="public/js/main.js" type="text/javascript"></script>
        <script src="public/js/plugins/datatable/datatables.min.js"
            type="text/javascript"></script>
        <script src="public/js/fontawesome.min.js"
            type="text/javascript"></script>
        <script src="public/js/all.min.js"
            type="text/javascript"></script>
        <script src="public/js/html2canvas.js"" type="
            text/javascript"></script><!-- ========= JS Files =========  -->
</body>

</html>