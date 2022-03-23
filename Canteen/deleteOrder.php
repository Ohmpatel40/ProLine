<?php
    $id = $_GET['id'];
    include 'conn.php';
    $q = "delete from orderdetails where orderid = $id";
    $query = mysqli_query($con,$q);
    if($query)
    {
        echo "<script>";
         echo ("location.href='index.php'");
        echo "</script>";
    }
?>