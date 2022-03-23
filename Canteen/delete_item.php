<?php
include "conn.php";
$id=$_GET['id'];
$q="delete from items where id=$id";
$query=mysqli_query($con,$q);
if($query)
{
    echo "<script>";
    echo ("location.href='Display.php'");
    echo "</script>";
}
else
{
    echo "error";
}
?>