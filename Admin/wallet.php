<?php
    require_once 'assets/twilio-php-main/src/Twilio/autoload.php'; 
    use Twilio\Rest\Client; 
    
    session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <title>
    ProLine Dashboard
  </title>
  <?php include 'includes/links.php'; ?>
</head>

<body class="g-sidenav-show   bg-gray-100">
    <?php include 'includes/side-navbar.php' ?>
  <main class="main-content position-relative border-radius-lg ">
    <?php include 'includes/top-navbar.php' ?>
    <div class="container-fluid py-1">
      <div class="row">
        <div class="col-12">
          <div class="card mb-2">
            <div class="card-header pb-0">
              <h6>Scan Card to View wallet details</h6>
            </div>
            <div class=" d-flex align-items-center justify-content-center row py-3 mx-1 mb-2">
            <?php
                
            ?>
                <button type="button" class="btn btn-primary w-25 fs-2" id = "wallet" data-bs-toggle="modal" data-bs-target="#exampleModal3" style=""> <i class="fas fa-qrcode" aria-hidden="true"></i> </button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid py-1">
        <div class="row">   
        <div class="col-12">
          <div class="card mb-2">
            <div class="card-header pb-0">
              <h6>Recharge Wallet</h6>
            </div>
            <?php
                if(isset($_POST['addamount']))
                {
                    include 'connection.php';

                    if(isset($_GET['SID']))
                    {
                        $sid = $_GET['SID'];
                        $amount = $_POST['amount'];
                        $q = "select * from stud_details where SID = '".$sid."'";
                        $query = mysqli_query($conn,$q);
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
                                                                "body" => "Your OTP to recharge wallet is *$otp*", 
                                                            ) 
                                                    ); 
                            echo "<script>";
                                echo ("location.href = 'verifyotp.php?SID=".$res['SID']."&a=".$amount."'");
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
                    }
                    else
                    {
                        echo '
                        <div class="text-white alert alert-danger col-12 text-center text-md mt-3" role="alert">
                            <i class="fas fa-times-circle "></i> Card Not Scaned!!
                        </div>
                        ';  
                    } 

                    
                }
            ?>
            <form method="POST">
                <div class=" d-flex align-items-center justify-content-center row py-3 mx-1 mb-2">
                    <div class="form-floating mb-3 col-4">
                        <input type="number" class="form-control " name = "amount" id="floatingInput" required placeholder="Enter Amount">
                        <label for="floatingInput">Enter Amount</label>
                    </div>
                    <div class="form-floating  col-1">
                        <button class="btn btn-primary p-3" type="submit" name="addamount"> <i class="fas fa-paper-plane"></i> </button>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid py-2">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Wallet Transactions</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0 table-hover ">
                  <thead>
                    <tr class="text-center">
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TID</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">SID</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Particular</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Amount</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" >Date & Time</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                        include 'connection.php';
                        if(isset($_GET['SID']))
                        {
                          $sid = $_GET['SID'];
                          $q = "select * from wallet_transaction where SID = '".$sid."'";
                          $query = mysqli_query($conn,$q);
                          $row = mysqli_num_rows($query);
                          if($row > 0)
                          {
                              while($res = mysqli_fetch_array($query))
                              {  
                                $Date = date("d-m-Y", strtotime($res['Date']));
                                if($res['Type'] == "Credit")
                                {
                                  $class = "text-success";
                                  $sign = "+";
                                }
                                else
                                {
                                  $class = "text-danger";
                                  $sign = "-";
                                }
                                  echo '     
                                      <tr class="text-center">
                                          <td class="text-sm font-weight-bold mb-0"> '.$res['TID'].' </td>
                                          <td class="text-sm font-weight-bold mb-0"> '.$res['SID'].' </td>
                                          <td class="text-sm font-weight-bold mb-0 '.$class.' "> '.$res['Particular'].' </td>
                                          <td class="text-sm font-weight-bold mb-0 '.$class.' ">'.$sign.''.$res['Amount'].' </td>
                                          <td class="text-sm font-weight-bold mb-0"> '.$Date.', '.$res['Time'].' </td>
                                      </tr>
                                  ';
                              }
                          }  
                          else
                          {
                              echo '
                              <tr>
                                  <td colspan="5" class="text-center">
                                      <p class="text-xs font-weight-bold mb-0"> NO TRANSACTION FOUND </p>
                                  </td>
                              </tr>
                              ';
                          } 
                      }
                      else
                      {
                        echo '
                              <tr>
                                  <td colspan="4" class="text-center">
                                      <p class="text-xs font-weight-bold mb-0"> SCAN CARD TO VIEW DETAILS </p>
                                  </td>
                              </tr>
                              ';
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
  </main>
  <?php include 'includes/script.php'?>
  <?php include 'includes/footer.php'?>
    <script>

    </script>
</body>
</html>
<!-- MODAL  -->
<script>
      $(document).ready(function(){
        $("#wallet").click(function(){
          console.log("CLICKED");
          var data =  $("#searchSIDWallet").load("UIDContainer.php");
				  setInterval(function() {
					  $("#searchSIDWallet").load("UIDContainer.php");
            var value = $("#searchSIDWallet     ").val();
            if(value.length > 0)
            {
              window.location.href = "wallet.php?SID=" + value;
            }
				  }, 500);
        });
        $("#redirect").click(function(){
          var sid = $("#manualSIDWallet").val();
          window.location.href = "wallet.php?SID=" + sid;
        })
			});
  </script>
<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel3">Search By Smart Card</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body d-flex justify-content-center align-items-center flex-column">
          <lottie-player src="https://assets7.lottiefiles.com/private_files/lf30_cdm7ig5v.json"  background="transparent"  speed="1.5"  style="width: 250px; height: 250px;"  loop  autoplay></lottie-player>
          <h6 class="font-weight-bolder mb-0">Tap card on scanner to view wallet!</h6>
          <form>
            <textarea class="form-control" id="searchSIDWallet" style="display:none;" required></textarea>
          </form>
      </div>
      <div class="modal-footer d-flex justify-content-center flex-column">
        <button  class="btn btn-primary"  data-bs-target="#exampleModalToggle4" data-bs-toggle="modal" data-bs-dismiss="modal" > Search Manually </button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleModalToggle4" aria-hidden="true" aria-labelledby="exampleModalToggleLabel4" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalToggleLabel4">Search Manually</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form>
            <input type="text" class="form-control"  id="manualSIDWallet"  placeholder="Enter SID" required>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" id="redirect" type="button" data-bs-target="#exampleModalToggle" data-bs-toggle="modal" data-bs-dismiss="modal">Search</button>
        </form>
      </div>
    </div>
  </div>
</div>