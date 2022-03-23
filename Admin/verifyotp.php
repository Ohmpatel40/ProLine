<?php
    session_start();
    $sid = $_GET['SID'];
    $amount = $_GET['a'];
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <title>
    Verify OTP
  </title>
  <?php include 'includes/links.php'; ?>
</head>
<body class="bg-secondary">
    <div class="container col-6 mt-5">
        <div class="card text-center">
            <div class="card-header">
                <img src="assets/img/Logo.svg"  class="w-50"/>
            </div>
                <div class="card-body d-flex align-items-center justify-content-center">
                    <form method="POST">
                        <div class="row">
                            <h5> Verify OTP <h5>
                                <?php

                                    include 'Connection.php';

                                    if(isset($_POST['submit']))
                                    {
                                        $otp = $_POST['otp'];
                                        if($otp == $_SESSION['OTP'])
                                        {
                                            $tid = strtoupper(bin2hex(random_bytes(3)));
                                            $checkQ = "select * from wallet where SID = '".$sid."'";
                                            $checkQuery = mysqli_query($conn,$checkQ);
                                            $res = mysqli_fetch_array($checkQuery);
                                            $num = mysqli_num_rows($checkQuery);
                                            date_default_timezone_set("Asia/Calcutta");
                                            $Date = date("Y/m/d");
                                            $Time = date("h:i A");
                                            if($num > 0)
                                            {
                                                $Amount = $res['Amount'] + $amount;
                                                $q = "update wallet set Amount = ".$Amount." , Last_Update = '".$Date."' where SID = '".$sid."'";
                                                echo $tQ = "insert into wallet_transaction (TID,SID,Particular,Amount,Type,Date,Time) values ('".$tid."','".$sid."','Money added to Wallet',".$amount.",'Credit','".$Date."','".$Time."')";
                                                $query = mysqli_query($conn,$q);
                                                $tQuery = mysqli_query($conn,$tQ);

                                                if($query && $tQuery)
                                                {
                                                    echo "<script>";
                                                        echo ("location.href = 'wallet.php'");
                                                    echo "</script>";
                                                }
                                                else
                                                {
                                                    echo '
                                                    <div class="text-white alert alert-danger col-12 text-center text-md mt-3" role="alert">
                                                        <i class="fas fa-times-circle "></i> Wallet Not Updated!!
                                                    </div>
                                                    '; 
                                                }

                                            }
                                            else
                                            {
                                                $q = "insert into wallet (SID,Amount,Last_Update) values ('".$sid."',".$amount.",'".$Date."')";
                                                echo $tQ = "insert into wallet_transaction (TID,SID,Particular,Amount,Type,Date,Time) values ('".$tid."','".$sid."','Money added to Wallet',".$amount.",'Credit','".$Date."','".$Time."')";
                                                $query = mysqli_query($conn,$q);
                                                $tQuery = mysqli_query($conn,$tQ);

                                                if($query && $tQuery)
                                                {
                                                    echo "<script>";
                                                        echo ("location.href = 'wallet.php'");
                                                    echo "</script>";
                                                }
                                                else
                                                {
                                                    echo '
                                                    <div class="text-white alert alert-danger col-12 text-center text-md mt-3" role="alert">
                                                        <i class="fas fa-times-circle "></i> Wallet Not Updated!!
                                                    </div>
                                                    '; 
                                                }
                                            }
                                        }
                                        else
                                        {
                                            echo '
                                            <div class="text-white alert alert-danger col-12 text-center text-md mt-3" role="alert">
                                                <i class="fas fa-times-circle "></i> Invalid OTP!!
                                            </div>
                                            '; 
                                        }
                                    }
                                ?>
                            <div class="col">
                                <input type="number" name="otp" class="form-control" placeholder="Enter OTP" aria-label="First name" required autocomplete="off">
                            </div>
                            <div class="col mt-3">
                                <button type="submit" name="submit" class="btn btn-primary">Verify</button>
                            </div>
                        </div>
                    </form>
                </div>
        </div>
    </div>
</body>
</html>
