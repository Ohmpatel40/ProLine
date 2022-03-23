<?php

    include 'Connection.php';
    $semester = "select * from semesters";
    $s_query = mysqli_query($conn,$semester);

    $subject = "select * from subject order by Sub_Code asc";
    $sub_query = mysqli_query($conn,$subject);

    $course = "select * from courses";
    $c_query = mysqli_query($conn,$course);
    
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
          <div class="card mb-2">
            <div class="card-header pb-0">
              <h6>Add Subject</h6>
            </div>
            <?php
                if(isset($_POST['add']))
                {
                    include 'connection.php';

                    $subid = strtoupper(bin2hex(random_bytes(2)));
                    $subjectname = $_POST['subjectname'];
                    $subjectcode = $_POST['subjectcode'];

                    $addQ = "insert into subject (SubID, Sub_Code , Sub_Name) values ('".$subid."','".$subjectcode."','".$subjectname."')";
                    $addquery = mysqli_query($conn,$addQ);

                    if($addquery)
                    {
                        echo '
                        <div class="text-white alert alert-success col-12 text-center text-md mt-3" role="alert">
                            <i class=" text-white fas fa-times-circle "></i> Subject Added!!
                        </div>
                        ';  
                    }
                    else
                    {
                        echo '
                        <div class="text-white alert alert-danger col-12 text-center text-md mt-3" role="alert">
                            <i class=" text-white fas fa-times-circle "></i> Subject Not Added!!
                        </div>
                        ';  
                    }
                }
            ?>
            <form method="POST">
                <div class=" d-flex align-items-center justify-content-center row py-3 mx-1 mb-2">
                <div class="form-floating mb-3 col-4">
                        <input type="text" class="form-control " name = "subjectcode" id="floatingInput" required placeholder="Enter Subject Code">
                        <label for="floatingInput">Enter Subject Code</label>
                    </div>
                    <div class="form-floating mb-3 col-4">
                        <input type="text" class="form-control " name = "subjectname" id="floatingInput" required placeholder="Enter Subject Name">
                        <label for="floatingInput">Enter Subject Name</label>
                    </div>
                    <div class="form-floating  col-1">
                        <button class="btn btn-primary p-3" type="submit" name="add"> <i class="fas fa-add"></i> </button>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card mb-2 mt-2">
            <div class="card-header pb-0">
              <h6>Link Subject to Semester</h6>
            </div>
            <?php
                if(isset($_POST['link']))
                {
                    include 'connection.php';

                    $lid = strtoupper(bin2hex(random_bytes(2)));
                    $subid = $_POST['Subject'];
                    $sid = $_POST['Semester'];
                    $cid = $_POST['Course'];

                    $checkQ = "select * from subject_link where SubID = '".$subid."'";
                    $checkQuery = mysqli_query($conn,$checkQ);
                    $rows = mysqli_num_rows($checkQuery);

                    if($rows > 0)
                    {
                        echo '
                        <div class="text-white alert alert-danger col-12 text-center text-md mt-3" role="alert">
                            <i class="text-white fas fa-times-circle "></i> Subject Already Liniked!!
                        </div>
                        ';  
                    }
                    else
                    {
                        $addQ = "insert into subject_Link (LID, SID, CID, SubID) values ('".$lid."','".$sid."','".$cid."','".$subid."')";
                        $addquery = mysqli_query($conn,$addQ);

                        if($addquery)
                        {
                            echo '
                            <div class="text-white alert alert-success col-12 text-center text-md mt-3" role="alert">
                                <i class="text-white fas fa-check-circle "></i> Subject Liniked!!
                            </div>
                            ';  
                        }
                        else
                        {
                            echo '
                            <div class="text-white alert alert-danger col-12 text-center text-md mt-3" role="alert">
                                <i class=" fas fa-times-circle "></i> Subject Not Liniked!!
                            </div>
                            ';  
                        }
                    }
                }
            ?>
            <form method="POST">
                <div class=" d-flex align-items-center justify-content-center row py-3 mx-1 mb-2">
                  <div class="form-floating mb-3 col-4">
                        <select class="form-select" id="floatingSelectGrid state" name = "Course" aria-label="Floating label select example" required >
                                <?php 
                                        while($c_res = mysqli_fetch_array($c_query))
                                        {
                                            
                                            echo '<option value="'.$c_res['CID'].'">'.$c_res['C_Name'].'</option>';
                                        }
                                    ?>
                        </select>
                        <label for="floatingSelectGrid">Course</label>
                    </div>
                    <div class="form-floating mb-3 col-3">
                        <select class="form-select" id="floatingSelectGrid state" name = "Subject" aria-label="Floating label select example" required >
                                <?php 
                                        while($sub_res = mysqli_fetch_array($sub_query))
                                        {
                                            
                                            echo '<option value="'.$sub_res['SubID'].'"> '.$sub_res['Sub_Code'].' '.$sub_res['Sub_Name'].'</option>';
                                        }
                                    ?>
                        </select>
                        <label for="floatingSelectGrid">Subject</label>
                    </div>
                    <div class="form-floating mb-3 col-3">
                        <select class="form-select" id="floatingSelectGrid state" name = "Semester" aria-label="Floating label select example" required >
                                <?php 
                                        while($s_res = mysqli_fetch_array($s_query))
                                        {
                                            
                                            echo '<option value="'.$s_res['SID'].'">'.$s_res['S_Name'].'</option>';
                                        }
                                    ?>
                        </select>
                        <label for="floatingSelectGrid">Semester</label>
                    </div>
                    <div class="form-floating  col-1">
                        <button class="btn btn-primary p-3" type="submit" name="link"> <i class="fas fa-link"></i> </button>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="container-fluid py-2">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Manage Subject</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0 table-hover ">
                  <thead>
                    <tr class="text-center">
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">SubID</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Subject Code</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Subject Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" >Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                        include 'connection.php';
                        $q = "select * from subject order by Sub_Code asc";
                        $query = mysqli_query($conn,$q);
                        $row = mysqli_num_rows($query);
                        if($row > 0)
                        {
                            while($res = mysqli_fetch_array($query))
                            {  
                                echo '     
                                    <tr class="text-center">
                                        <td class="text-sm font-weight-bold mb-0"> '.$res['SubID'].' </td>
                                        <td class="text-sm font-weight-bold mb-0"> '.$res['Sub_Code'].' </td>
                                        <td class="text-sm font-weight-bold mb-0"> '.$res['Sub_Name'].' </td>
                                        <td class="text-sm font-weight-bold mb-0"> <a href="deleteSubject.php?ID='.$res['SubID'].'"> <i class="fas fa-trash"></i> </a> </td>
                                    </tr>
                                ';
                            }
                        }  
                        else
                        {
                            echo '
                            <tr>
                                <td colspan="4" class="text-center">
                                    <p class="text-xs font-weight-bold mb-0"> NO SEMESTER FOUND </p>
                                </td>
                            </tr>
                            ';
                        } 
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <?php include 'includes/script.php'?>
  <?php include 'includes/footer.php'?>
    <script>

    </script>
</body>
</html>