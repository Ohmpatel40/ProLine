<?php

    include 'Connection.php';
    $ID = $_GET['ID'];

    
    $q = "delete from subject where SubID = '$ID'";
    $query = mysqli_query($conn,$q);
    
    if($query)
    {
        echo "<script>";
            echo ("location.href = 'subject.php'");
        echo "</script>";
    }
    else 
    {
        echo "ERROR" ;
    }

?>