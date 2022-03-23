<?php

    include 'Connection.php';
    $ID = $_GET['ID'];

    
    echo $q = "delete from ebook where BID = '$ID'";
    $query = mysqli_query($conn,$q);
    
    if($query)
    {
        echo "<script>";
        echo ("location.href = 'ebook.php'");
        echo "</script>";
    }
    else 
    {
        echo "ERROR" ;
    }

?>