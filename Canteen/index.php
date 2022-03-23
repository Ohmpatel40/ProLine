<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include 'links.php';?>    
</head>

<body style="background-color:#f6f6f6; height:100vh; width:100vw">
<div class="container-fluid" >
    <div class="row"> 
        <div class="col-8 p-0">
        <?php include 'navbar.php'; ?>
            <div class="row"> 
                <div class="col-xl-3 d-flex align-items-center justify-content-center" style="height: 85vh;">
                    <div class=""  style="padding-left: 25px;">
                        <form method="POST">
                        <button type="submit" class="btn btn-primary mb-3" value="Main Course" name="btnsearch1" style="width:150px; border-radius: 50px;"><i class="fa-solid fa-utensils"></i>&nbsp Main Course</button>
                        <button type="submit" class="btn btn-primary mb-3" value='Appetizer' name="btnsearch2" style="width:150px; border-radius: 50px;"><i class="fa-solid fa-bowl-food"></i>&nbsp Appetizer</button>
                        <button type="submit" class="btn btn-primary mb-3" value='Beverages' name="btnsearch3" style="width:150px; border-radius: 50px;"><i class="fa-solid fa-martini-glass"></i>&nbsp Beverages</button>
                        <button type="submit" class="btn btn-primary mb-3" value='Snacks' name="btnsearch4" style="width:150px; border-radius: 50px;"><i class="fa-solid fa-pizza-slice"></i>&nbsp Snacks</button>
                        </form>
                    </div>
                </div>
                
                <!-- -->
                <div class="col-lg-9 d-flex justify-content-start flex-wrap">
                    <?php
                        include 'conn.php';
                        
                        $q3="select * from items";
                        if(isset($_REQUEST['btnsearch1']))
                        {
                            $q3="select * from items where
                            category like '%Main Course%' ";
                        }
                        if(isset($_REQUEST['btnsearch2']))
                        {
                            $q3="select * from items where
                            category like '%Appetizer%' ";
                        }
                        if(isset($_REQUEST['btnsearch3']))
                        {
                            $q3="select * from items where
                            category like '%Beverages%' ";
                        }
                        if(isset($_REQUEST['btnsearch4']))
                        {
                            $q3="select * from items where
                            category like '%Snack%' ";
                        }
                            $query1=mysqli_query($con,$q3);

                            while($res1=mysqli_fetch_assoc($query1))
                            {
                                echo '  
                                <div class="btn col-sm-3 mb-3 mx-3" style="z-index:99;">      
                                    <a class = "text-decoration-none " href="order.php?id='.$res1['id'].'">
                                            <div class="card bg-light shadow mt-4 mb-4 position-relative" style="height:150px; width:170px; ">
                                                <div class="card-body p-5 ">
                                                <img src="assets/'.$res1['category'].'.svg" class="position-absolute top-50 start-50 translate-middle " style="height:110px; opacity: 0.1;"/>
                                                    <h5 class="card-title font-weight-bolder">'.strtoupper($res1['pname']).'</h5>
                                                    <p class="card-text">₹'.$res1['price'].'</p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                ';}
                    ?>
                </div>
                
            </div> 
            
        
        </div> 
        <!--Bill -->
        <div class="col-lg-4" style="background-color:#393941; height:100vh;">
            <h5 class="text-white text-center pt-3">Order Summary</h5>
            <hr class="text-light">
            <div class="row d-flex flex-column justify-content-between" style="height:88%;">
                <div class="">
                    <div class="px-3">
                        <table width="100%">
                            <?php
                                $orderQ = "select items.pname, items.price, orderdetails.orderid, count(orderdetails.orderid) from orderdetails join items on orderdetails.orderid=items.id group by items.id;";
                                $queryOrder = mysqli_query($con,$orderQ);
                                $total = 0;
                                $gtotal = 0;
                                while($orderRes = mysqli_fetch_array($queryOrder))
                                {
                                    echo '
                                        <tr>
                                            <td class="text-white text-xxs font-weight-bolder"  style="padding:8px;">'.strtoupper($orderRes['pname']).'</td>
                                            <td class="text-white text-xxs font-weight-bolder text-center">'.$orderRes['count(orderdetails.orderid)'].'x</td>
                                            <td class="text-white text-xxs font-weight-bolder text-end">₹ '.$orderRes['price'].'</td>
                                            <td class="text-xxs font-weight-bolder text-end"><a href=deleteOrder.php?id='.$orderRes['orderid'].'><i class="fa-solid fa-trash"></i></td>
                                        </tr>
                                    ';
                                    $total = $orderRes['price'] * $orderRes['count(orderdetails.orderid)'];
                                    $gtotal = $gtotal + $total;
                                }
                            ?>
                        </table>
                    </div>
                </div>
                <div class="">
                    <table width="100%" class="mb-2">
                        <tr>
                            <td class="text-white font-weight-bolder fs-4">Total</td>
                            <td class="text-white font-weight-bolder text-end fs-4">₹ <?php echo $gtotal?></td>
                        </tr>
                    </table>
                    <button type="button" class="btn btn-primary w-100 mb-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    CHECKOUT
                    </button>
                </div>
                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Payment Method</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-check d-flex justify-content-around align-items-center">
                                        <button type="button" class="btn btn-primary mb-2" style="width:150px" data-bs-toggle="modal" data-bs-target="#scan" id="card"><i class="fa-solid fa-id-card-clip"></i> &nbsp Smart Card</button>
                                        <button type="button" class="btn btn-primary mb-2" style="width:150px" data-bs-dismiss="modal" data-bs-target="#staticBackdrop"><i class="fa-solid fa-coins"></i>&nbsp Cash</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- SCAN -->
                    <script>
                        $(document).ready(function(){
                            $("#card").click(function(){
                            console.log("CLICKED");
                            var data =  $("#cardTap").load("UIDContainer.php");
                                    setInterval(function() {
                                        $("#cardTap").load("UIDContainer.php");
                                            var value = $("#cardTap").val();
                                            if(value.length > 0)
                                            {
                                                window.location.href = "verify.php?SID=" + value;
                                            }
                                    }, 2000);
                            });
                        });
                    </script>
                    <div class="modal fade" id="scan" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="staticBackdropLabel">Scan Card</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                <div class="modal-body d-flex justify-content-center align-items-center flex-column">
                                    <lottie-player src="https://assets7.lottiefiles.com/private_files/lf30_cdm7ig5v.json"  background="transparent"  speed="1.5"  style="width: 250px; height: 250px;"  loop  autoplay></lottie-player>
                                    <h6 class="font-weight-bolder mb-0">Tap card on scanner to view wallet!</h6>
                                    <form>
                                        <textarea class="form-control" id="cardTap" style="display:none;" required></textarea>
                                    </form>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
    </div> 
</div>
<form>
</body> 
</html>