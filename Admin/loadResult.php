<?php
    include 'Connection.php';
    $sname = $_GET['sname'];
    $cname = $_GET['cname'];
    $examtype = $_GET['examtype'];

    $q = "select * from result where SemID = '$sname' and CID = '$cname' and ExamType = '$examtype' group by SID";
    $query = mysqli_query($conn, $q);
    $num = mysqli_num_rows($query);

    if($num > 0)
    {
        while($res = mysqli_fetch_array($query))
        {
            $studentQ = "select * from stud_details where SID ='".$res['SID']."'";
            $studentQuery = mysqli_query($conn,$studentQ);
            $studentRes = mysqli_fetch_array($studentQuery);
            echo '     
                <tr class="text-center">
                    <td class="text-sm font-weight-bold mb-0"> '.$studentRes['SID'].' </td>
                    <td class="text-sm font-weight-bold mb-0"> '. $studentRes['First_Name']."  ".$studentRes['Middle_Name']."  ". $studentRes['Last_Name'].' </td>
                    <td class="text-sm font-weight-bold mb-0"> '.$studentRes['Semester'].' </td>
                    <td class="text-sm font-weight-bold mb-0"> '.$res['ExamType'].' </td>
                    <td class="text-sm font-weight-bold mb-0"><a href="viewResult.php?ID='.$res['SID'].'&type='.$res['ExamType'].'&sem='.$sname.'&cname='.$cname.'"> <i class="fas fa-eye"></i> </a> &nbsp &nbsp <a href="deleteResult.php?ID='.$res['SID'].'&type='.$res['ExamType'].'"> <i class="fas fa-trash"></i> </a></td>
                </tr>
            ';
        }
    }
    else
    {
        echo '
        <tr>
            <td colspan="5" class="text-center">
                <p class="text-xs font-weight-bold mb-0"> NO RESULT FOUND </p>
            </td>
        </tr>
        ';
    }
?>