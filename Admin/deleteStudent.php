<?php

    include 'Connection.php';
    $SID = $_GET['SID'];

    
    $q = "delete from stud_details where SID = '$SID'";
    $query = mysqli_query($conn,$q);
    
    if($query)
    {
        echo "<script>";
        echo ("location.href = 'manageStudent.php'");
        echo "</script>";
    }
    else 
    {
        echo "ERROR" ;
    }

?>