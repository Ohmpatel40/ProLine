<?php
    session_start();
    require_once 'assets/twilio-php-main/src/Twilio/autoload.php';
    use Twilio\Rest\Client; 
    $sid = $_GET['SID'];
    include 'conn.php';
                        $q = "select * from stud_details where SID = '".$sid."'";
                        $query = mysqli_query($con,$q);
                        $row = mysqli_num_rows($query);
                        if($row > 0)
                        {
                            $res = mysqli_fetch_array($query);
                            $phoneNumber = "+91".$res['Phone_Number'];
                            $otp = rand(111111,999999);
                            $_SESSION['OTP'] = $otp;

                            $sid    = "AC50db4c983ee0a453d8804e8e9a19dfdf"; 
                            $token  = "c48a654ac86062fa8bc7b9cdda82c0ff"; 
                            $twilio = new Client($sid, $token); 
                            $message = $twilio->messages 
                                                    ->create("whatsapp:$phoneNumber", // to 
                                                            array( 
                                                                "from" => "whatsapp:+14155238886",       
                                                                "body" => "Your OTP to pay at canteen is *$otp*", 
                                                            ) 
                                                    ); 
                            echo "<script>";
                                echo ("location.href = 'verifyotp.php?SID=".$res['SID']."'");
                            echo "</script>";
                        }
                        else
                        {
                            echo '
                            <div class="text-white alert alert-danger col-12 text-center text-md mt-3" role="alert">
                                <i class="fas fa-times-circle "></i> Card Not Registered!!
                            </div>
                        '; 
                        }
    
?>