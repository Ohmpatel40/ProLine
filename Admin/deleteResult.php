<?php

    include 'Connection.php';
    $ID = $_GET['ID'];
    $examtype = $_GET['type'];
    
    $q = "delete from result where SID = '$ID' and ExamType = '$examtype'";
    $query = mysqli_query($conn,$q);
    
    if($query)
    {
        echo "<script>";
        echo ("location.href = 'result.php'");
        echo "</script>";
    }
    else 
    {
        echo "ERROR" ;
    }

?>