<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include 'links.php'; ?>
</head>
<body>
    <div class="container-fluid">
        <?php
                include "conn.php";
                $id=$_GET['id'];
                
                $q2 = "insert into orderdetails set 
                orderid='".$_REQUEST['id']."' 
                ";
                
                $query = mysqli_query($con,$q2);
                if($query)
                {
                    header('Location: iNdex.php');
                }
        ?>
    </div>
</body>
</html>