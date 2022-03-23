<?php

    include 'Connection.php';
    $semester = "select * from semesters";
    $s_query = mysqli_query($conn,$semester);

    $semester1 = "select * from semesters";
    $s_query1 = mysqli_query($conn,$semester1);

    $course = "select * from courses";
    $c_query = mysqli_query($conn,$course);

    $course1 = "select * from courses";
    $c_query1 = mysqli_query($conn,$course1);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/favicon.png">
  <title>
    ProLine Dashboard
  </title>
  <?php include 'includes/links.php'; ?>
</head>

<body class="g-sidenav-show   bg-gray-100">
    <?php include 'includes/side-navbar.php' ?>
  <main class="main-content position-relative border-radius-lg ">
    <?php include 'includes/top-navbar.php' ?>
    <div class="container-fluid py-1">
      <div class="row">
        <div class="col-12">
          <div class="card mb-2 mt-2">
            <div class="card-header pb-0">
              <h6>Create Result</h6>
            </div>
            <script>
                function loadStudent (sname)
                {
                  var cname = document.getElementById("course").value;

                  $.ajax({  
                      type: 'GET',  
                      url: 'loadStudent.php', 
                      data: { sname, cname },
                      success: function(response) {
                        
                        $("#student").html(response);
                        
                      }
                  });
                }
                
                function loadSubject (examtype)
                {
                  var sname = document.getElementById("semester").value;
                  var cname = document.getElementById("course").value;
                  var sid = document.getElementById("student").value;

                  $.ajax({
                    type: "GET",
                    url: 'loadContainer.php',
                    success: function(response) {
                      $("#result").html(response);
                    }
                  })

                  $.ajax({
                    type: "GET",
                    url: 'loadSubject.php',
                    data: {sname,cname,sid,examtype},
                    success: function(response) {
                      $("#subject").html(response);
                    }
                  })
                }
            </script>
            <form method="POST">
                <div class=" d-flex align-items-center justify-content-center row py-3 mx-1 mb-2">
                    <div class="form-floating mb-3 col-4">
                        <select class="form-select" id="course" name="Course" aria-label="Floating label select example">
                            <option value=""> Select a Course</option>
                                <?php 
                                        while($c_res = mysqli_fetch_array($c_query))
                                        {
                                            
                                            echo '<option value="'.$c_res['CID'].'">'.$c_res['C_Name'].'</option>';
                                        }
                                    ?>
                        </select>
                        <label for="floatingSelectGrid">Course</label>
                    </div>
                    <div class="form-floating mb-3 col-2">
                        <select class="form-select" id="semester" name="Semester" aria-label="Floating label select example" onclick="loadStudent(this.value);">
                            <option value=""> Select a Semester</option>
                                <?php 
                                        while($s_res = mysqli_fetch_array($s_query))
                                        {
                                            echo '<option value="'.$s_res['SID'].'">'.$s_res['S_Name'].'</option>';
                                        }
                                    ?>
                        </select>
                        <label for="floatingSelectGrid">Subject</label>
                    </div>
                    <div class="form-floating mb-3 col-3">
                        <select class="form-select" id="student" name ="Student" aria-label="Floating label select example">
                           <option value=""> Select a Student </option>
                        </select>
                        <label for="floatingSelectGrid">Student</label>
                    </div>
                    <div class="form-floating mb-3 col-3">
                        <select class="form-select" id="examtype" name ="ExamType" aria-label="Floating label select example" onclick="loadSubject(this.value);">
                           <option value=""> Select Exam Type </option>
                           <option value="Internal"> Internal </option>
                           <option value="External"> External </option>
                        </select>
                        <label for="floatingSelectGrid">Exam Type</label>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php
      if(isset($_POST['save']))
      {
          include 'connection.php';

          $cid = "2fr4";
          $semid = "D983";
          $sid = "D78A3224";
          $examtype = "External";

          $checkQ = "select * from result where SID = '$sid' and CID = '$cid' and SemID = '$semid' and Examtype = '$examtype'";
          $checkQuery = mysqli_query($conn,$checkQ);
          $checkNum = mysqli_num_rows($checkQuery);

          $q = "SELECT subject.Sub_Name,subject.SubID FROM subject_link join subject on subject.SubID=subject_link.SubID WHERE subject_link.SID='$semid' and subject_link.CID='$cid' order by subject.Sub_Code";
          $query = mysqli_query($conn,$q);

          if($checkNum > 0)
          {
            while($res = mysqli_fetch_array($query))
            {
              $rid = strtoupper(bin2hex(random_bytes(2)));
              $marks = $_POST[$res['SubID']];
              $result = "update result set Marks = ".$marks." where SID = '".$sid."' and CID = '".$cid."' and SemID = '".$semid."' and SubID = '".$res['SubID']."'";
              $resultQuery = mysqli_query($conn,$result);
            }
          }
        else
        {
          while($res = mysqli_fetch_array($query))
          {
            $rid = strtoupper(bin2hex(random_bytes(2)));
            $marks = $_POST[$res['SubID']];
            $result = "insert into result (RID,SID,CID,SemID,SubID,Marks,ExamType)values('".$rid."','".$sid."','".$cid."','".$semid."','".$res['SubID']."',".$marks.",'".$examtype."')";
            $resultQuery = mysqli_query($conn,$result);
          }
        }
      }
    ?>
    <div id="result"> </div>
  </main>
  <?php include 'includes/script.php'?>
  <?php include 'includes/footer.php'?>
</body>
</html>