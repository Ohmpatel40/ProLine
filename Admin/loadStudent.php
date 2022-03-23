<?php
    include 'Connection.php';
    $cid = $_GET['cname'];
    $sid = $_GET['sname'];
    
    $searchCourse = "select * from courses where CID = '$cid'";
    $courseQuery = mysqli_query($conn,$searchCourse);
    $courseRes = mysqli_fetch_array($courseQuery);
    $cname = $courseRes['C_Name'];

    $searchSemester = "select * from semesters where SID = '$sid'";
    $semesterQuery = mysqli_query($conn,$searchSemester);
    $semesterRes = mysqli_fetch_array($semesterQuery);
    $sname = $semesterRes['S_Name'];

    $q = "select * from stud_details where Course = '$cname' and Semester = '$sname'";
    $query = mysqli_query($conn,$q);

    while($res = mysqli_fetch_array($query))
    {
        echo "<option value = ".$res['SID']." > ". $res['First_Name']."  ".$res['Middle_Name']."  ". $res['Last_Name']." </option>";
    }
?>