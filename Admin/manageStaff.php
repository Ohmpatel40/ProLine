<?php
    include 'Connection.php';
    $courses = "select * from courses";
    $c_query = mysqli_query($conn,$courses);
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
              <h6>Filter</h6>
            </div>
            <form method="POST">
                <div class=" d-flex align-items-center justify-content-center row py-3 mx-1 mb-2">
                    <div class="form-floating mb-3 col-4">
                        <select class="form-select" id="floatingSelectGrid state" name = "Course" aria-label="Floating label select example" required>
                            <option value="">Select</option>
                              <?php 
                                  while($c_res = mysqli_fetch_array($c_query))
                                    {
                                      echo '<option value="'.$c_res['C_Name'].'">'.$c_res['C_Name'].'</option>';
                                    }
                              ?>
                          </select>
                        <label for="floatingSelectGrid">Course</label>
                    </div>
                    <div class="form-floating  col-1">
                        <button class="btn btn-primary p-3" type="submit" name="search"> <i class="fas fa-search"></i> </button>
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
              <h6>Teacher's Detail</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Course</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Contact</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    include 'connection.php';

                    if(isset($_POST['search']))
                    {
                        $course = $_POST['Course'];
                        $q = "select * from staff_details where Course = '".$course."'";
                        $query = mysqli_query($conn,$q);
                        $row = mysqli_num_rows($query);
                        if($row > 0)
                        {
                            while($res = mysqli_fetch_array($query))
                            {  
                                echo '     
                                    <tr>
                                        <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                            <img src="./Staff_Photo/'.$res['Photo'].'" class="avatar avatar-sm me-3" alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-sm">'.$res['First_Name'].' '.$res['Middle_Name']. ' '.$res['Last_Name'].'</h6>
                                            <p class="text-xs text-secondary mb-0">'.$res['SID'].'</p>
                                            </div>
                                        </div>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">'.$res['Course'].'</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">'.$res['Phone_Number'].'</p>
                                            <p class="text-xs text-secondary mb-0">'.$res['Email'].'</p>
                                        </td>
                                        <td class="align-middle">
                                            <a href="fullStaffDetail.php?SID='.$res['SID'].'" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                View Full Details
                                            </a>
                                        </td>
                                    </tr>
                                ';
                            }
                        }  
                        else
                        {
                            echo '
                            <tr>
                                <td colspan="4" class="text-center">
                                    <p class="text-xs font-weight-bold mb-0"> NO STAFF FOUND </p>
                                </td>
                            </tr>
                            ';
                        } 
                    }
                    else
                    {
                        $q = "select * from staff_details";
                        $query = mysqli_query($conn,$q);
                        while($res = mysqli_fetch_array($query))
                        {  
                            echo '     
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="./Staff_Photo/'.$res['Photo'].'" class="avatar avatar-sm me-3" alt="user1">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">'.$res['First_Name'].' '.$res['Middle_Name']. ' '.$res['Last_Name'].'</h6>
                                                <p class="text-xs text-secondary mb-0">'.$res['SID'].'</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">'.$res['Course'].'</p>
                                    </td>
                                    <td>
                                        <p class="text-xs font-weight-bold mb-0">'.$res['Phone_Number'].'</p>
                                        <p class="text-xs text-secondary mb-0">'.$res['Email'].'</p>
                                    </td>
                                    <td class="align-middle">
                                        <a href="fullStaffDetail.php?SID='.$res['SID'].'" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                            View Full Details
                                        </a>
                                    </td>
                                </tr>
                              ';
                        }
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