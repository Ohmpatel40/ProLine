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
              <h6>Manage Result</h6>
            </div>
            <script>
              
              function loadResults (examtype)
                {
                  var sname = document.getElementById("semester1").value;
                  var cname = document.getElementById("course1").value;

                  $.ajax({
                    type: "GET",
                    url: 'loadResultContainer.php',
                    success: function(response) {
                      $("#manageResults").html(response);
                    }
                  })

                  $.ajax({
                    type: "GET",
                    url: 'loadResult.php',
                    data: {sname,cname,examtype},
                    success: function(response) {
                      $("#resultTable").html(response);
                    }
                  })
                }
            </script>
            <form method="POST">
                <div class=" d-flex align-items-center justify-content-center row py-3 mx-1 mb-2">
                    <div class="form-floating mb-3 col-4">
                        <select class="form-select" id="course1" name="Course" aria-label="Floating label select example">
                            <option value=""> Select a Course</option>
                                <?php 
                                        while($c_res1 = mysqli_fetch_array($c_query1))
                                        {
                                            echo '<option value="'.$c_res1['CID'].'">'.$c_res1['C_Name'].'</option>';
                                        }
                                    ?>
                        </select>
                        <label for="floatingSelectGrid">Course</label>
                    </div>
                    <div class="form-floating mb-3 col-3">
                        <select class="form-select" id="semester1" name="Semester" aria-label="Floating label select example">
                            <option value=""> Select a Semester</option>
                                <?php 
                                        while($s_res1 = mysqli_fetch_array($s_query1))
                                        {
                                            echo '<option value="'.$s_res1['SID'].'">'.$s_res1['S_Name'].'</option>';
                                        }
                                    ?>
                        </select>
                        <label for="floatingSelectGrid">Subject</label>
                    </div>
                    <div class="form-floating mb-3 col-3">
                        <select class="form-select" id="examtype" name ="ExamType" aria-label="Floating label select example" onclick="loadResults(this.value);">
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
    <div id="manageResults" > </div>
  </main>
  <?php include 'includes/script.php'?>
  <?php include 'includes/footer.php'?>
</body>
</html>