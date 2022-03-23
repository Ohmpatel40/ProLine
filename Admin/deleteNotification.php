<?php

    include 'Connection.php';
    $ID = $_GET['ID'];

    
    echo $q = "delete from announcement where AID = '$ID'";
    $query = mysqli_query($conn,$q);
    
    if($query)
    {
        echo "<script>";
        echo ("location.href = 'notifications.php'");
        echo "</script>";
    }
    else 
    {
        echo "ERROR" ;
    }

?>