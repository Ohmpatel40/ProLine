<?php

    include 'Connection.php';
    $ID = $_GET['ID'];

    
    $q = "delete from semesters where SID = '$ID'";
    $query = mysqli_query($conn,$q);
    
    if($query)
    {
        echo "<script>";
        echo ("location.href = 'semester.php'");
        echo "</script>";
    }
    else 
    {
        echo "ERROR" ;
    }

?>