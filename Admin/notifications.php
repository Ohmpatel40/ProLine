<?php

    include 'Connection.php';

    $semester = "select * from semesters";
    $s_query = mysqli_query($conn,$semester);
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
              <h6>Add Notification</h6>
            </div>
            <?php
                if(isset($_POST['addCourse']))
                {
                    include 'connection.php';

                    $aid = strtoupper(bin2hex(random_bytes(2)));
                    $notifications = $_POST['notifications'];
                    $semester = $_POST['Semester'];
                    date_default_timezone_set("Asia/Calcutta");
                    $Date = date("Y/m/d");

                    $addQ = "insert into announcement (AID, Semester, Content, Date) values ('".$aid."','".$semester."','".$notifications."','".$Date."')";
                    $addquery = mysqli_query($conn,$addQ);

                    if($addquery)
                    {
                        echo '
                        <div class="text-white alert alert-success col-12 text-center text-md mt-3" role="alert">
                            <i class="fas fa-check-circle "></i> Notification Added!!
                        </div>
                        ';  
                    }
                    else
                    {
                        echo '
                        <div class="text-white alert alert-danger col-12 text-center text-md mt-3" role="alert">
                            <i class="fas fa-times-circle "></i> Notification Not Added!!
                        </div>
                        ';  
                    }
                }
            ?>
            <form method="POST">
                <div class=" d-flex align-items-center justify-content-center row py-3 mx-1 mb-2">
                    <div class="form-floating mb-3 col-4">
                        <input type="text" class="form-control " name = "notifications" id="floatingInput" required placeholder="Write Notifications here...">
                        <label for="floatingInput">Write Notifications here...</label>
                    </div>
                    <div class="form-floating mb-3 col-3">
                        <select class="form-select" id="floatingSelectGrid state" name = "Semester" aria-label="Floating label select example" >
                            <option value="ALL"> ALL </option>
                                <?php 
                                        while($s_res = mysqli_fetch_array($s_query))
                                        {
                                            
                                            echo '<option value="'.$s_res['S_Name'].'">'.$s_res['S_Name'].'</option>';
                                        }
                                    ?>
                        </select>
                        <label for="floatingSelectGrid">Semester</label>
                    </div>
                    <div class="form-floating  col-1">
                        <button class="btn btn-primary p-3" type="submit" name="addCourse"> <i class="fas fa-add"></i> </button>
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
              <h6>Manage Notification's</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0 table-hover ">
                  <thead>
                    <tr class="text-center">
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">AID</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Content</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Semester</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Issue Date</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2" >Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                        include 'connection.php';
                        $q = "select * from announcement";
                        $query = mysqli_query($conn,$q);
                        $row = mysqli_num_rows($query);
                        if($row > 0)
                        {
                            while($res = mysqli_fetch_array($query))
                            {  
                                $Date = date("d-m-Y", strtotime($res['Date']));
                                echo '     
                                    <tr class="text-center">
                                        <td class="text-sm font-weight-bold mb-0"> '.$res['AID'].' </td>
                                        <td class="text-sm font-weight-bold mb-0"> '.$res['Content'].' </td>
                                        <td class="text-sm font-weight-bold mb-0"> '.$res['Semester'].' </td>
                                        <td class="text-sm font-weight-bold mb-0"> '.$Date.' </td>
                                        <td class="text-sm font-weight-bold mb-0"> <a href="deleteNotification.php?ID='.$res['AID'].'"> <i class="fas fa-trash"></i> </a> </td>
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