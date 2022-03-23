<?php
    session_start();
    $sid = $_GET['SID'];
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
  <?php include 'links.php'; ?>
</head>
<body class="bg-secondary">
    <div class="container col-6 mt-5">
        <div class="card text-center">
            <div class="card-header">
                <img src="assets/Logo.svg"  class="w-50"/>
            </div>
                <div class="card-body d-flex align-items-center justify-content-center">
                    <form method="POST">
                        <div class="row">
                            <h5> Verify OTP <h5>
                                <?php

                                    include 'Conn.php';

                                    if(isset($_POST['submit']))
                                    {
                                        $otp = $_POST['otp'];
                                        if($otp == $_SESSION['OTP'])
                                        {
                                            $orderQ = "select items.pname, items.price, count(orderdetails.orderid) from orderdetails join items on orderdetails.orderid=items.id group by items.id;";
                                            $queryOrder = mysqli_query($con,$orderQ);
                                            $total = 0;
                                            $gtotal = 0;
                                            while($orderRes = mysqli_fetch_array($queryOrder))
                                            {
                                                $total = $orderRes['price'] * $orderRes['count(orderdetails.orderid)'];
                                                $gtotal = $gtotal + $total;
                                            }
                                            $tid = strtoupper(bin2hex(random_bytes(3)));
                                            $checkQ = "select * from wallet where SID = '".$sid."'";
                                            $checkQuery = mysqli_query($con,$checkQ);
                                            $res = mysqli_fetch_array($checkQuery);
                                            $num = mysqli_num_rows($checkQuery);
                                            date_default_timezone_set("Asia/Calcutta");
                                            $Date = date("Y/m/d");
                                            $Time = date("h:i A");
                                            if($num > 0 && $res['Amount'] >= $gtotal)
                                            {
                                                $Amount = $res['Amount'] - $gtotal;
                                                $q = "update wallet set Amount = ".$Amount." , Last_Update = '".$Date."' where SID = '".$sid."'";
                                                $tQ = "insert into wallet_transaction (TID,SID,Particular,Amount,Type,Date,Time) values ('".$tid."','".$sid."','Paid to Canteen',".$gtotal.",'Debit','".$Date."','".$Time."')";
                                                $query = mysqli_query($con,$q);
                                                $tQuery = mysqli_query($con,$tQ);

                                                if($query && $tQuery)
                                                {
                                                    $query = "delete from orderdetails";
                                                    $Qquery = mysqli_query($con,$query);
                                                    if($Qquery)
                                                    {
                                                        echo "<script>";
                                                            echo ("location.href = 'index.php'");
                                                        echo "</script>";
                                                    }
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
                                                echo '
                                                    <div class="text-white alert alert-danger col-12 text-center text-md mt-3" role="alert">
                                                        <i class="fas fa-times-circle "></i> Transaction Failed!!
                                                    </div>
                                                    '; 
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
