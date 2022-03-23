<?php

    include 'Connection.php';
    $SID = $_GET['SID'];

    
    $q = "delete from staff_details where SID = '$SID'";
    $query = mysqli_query($conn,$q);
    
    if($query)
    {
        echo "<script>";
        echo ("location.href = 'manageStaff.php'");
        echo "</script>";
    }
    else 
    {
        echo "ERROR" ;
    }

?>