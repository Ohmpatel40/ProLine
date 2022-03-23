<?php
    include 'Connection.php';
    $sname = $_GET['sname'];
    $cname = $_GET['cname'];
    $sid = $_GET['sid'];
    $examtype = $_GET['examtype'];

    if($sid != "")
    {
        $checkQ = "select * from result where SID = '$sid' and CID = '$cname' and SemID = '$sname' and Examtype = '$examtype'";
        $checkQuery = mysqli_query($conn,$checkQ);
        $checkNum = mysqli_num_rows($checkQuery);

        if($checkNum > 0)
        {
            $q = "SELECT subject.Sub_Name,subject.SubID FROM subject_link join  subject on  subject.SubID=subject_link.SubID WHERE subject_link.SID='$sname' and subject_link.CID='$cname' order by subject.Sub_Code";
            $query = mysqli_query($conn,$q);
            $num = mysqli_num_rows($query);

            if($num > 0)
            {
                while($res = mysqli_fetch_array($query))
                {
                    $checkQ = "select * from result where SID ='".$sid."' and CID = '".$cname."' and SemID = '".$sname."' and SubID = '".$res['SubID']."' and Examtype = '$examtype'";
                    $checkQuery = mysqli_query($conn,$checkQ);
                    $checkRes = mysqli_fetch_array($checkQuery);
                    echo '
                        <div class="form-floating mb-3 col-3">
                            <input type="number" max="70" class="form-control " value = "'. $checkRes['Marks'].'" name = "'. $res['SubID'].'" id="floatingInput" required placeholder="'. $res['Sub_Name'].'">
                            <label for="floatingInput">'. $res['Sub_Name'].'</label>
                        </div>
                    ';
                }
                echo '
                    <div class="row d-flex justify-content-center">
                        <button class="btn btn-success w-25" name="save" type="submit">Save</button>
                    </div>
                ';
            }
            else
            {
                echo '<h6> NO SUBJECTS FOUND </h6>';
            }
        }
        else
        {
            $q = "SELECT subject.Sub_Name,subject.SubID FROM subject_link join  subject on  subject.SubID=subject_link.SubID WHERE subject_link.SID='$sname' and subject_link.CID='$cname' order by subject.Sub_Code";
            $query = mysqli_query($conn,$q);
            $num = mysqli_num_rows($query);

            if($num > 0)
            {
                while($res = mysqli_fetch_array($query))
                {
                    echo '
                        <div class="form-floating mb-3 col-3">
                            <input type="number" max="70" class="form-control " name = "'. $res['SubID'].'" id="floatingInput" required placeholder="'. $res['Sub_Name'].'">
                            <label for="floatingInput">'. $res['Sub_Name'].'</label>
                        </div>
                    ';
                }
                echo '
                <div class="row d-flex justify-content-center">
                    <button class="btn btn-success w-25" name="save" type="submit">Save</button>
                </div>
            ';
            }
            else
            {
                echo '<h6 class="text-center"> NO SUBJECTS FOUND </h6>';
            }
        }
    }
    else
    {
        echo '<h6 class="text-center"> SELECT STUDENT </h6>';
    }
?>