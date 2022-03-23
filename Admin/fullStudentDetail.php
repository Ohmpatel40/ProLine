<?php 
    $sid = $_GET['SID'];

    $Write="<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
    file_put_contents('UIDContainer.php',$Write);

    include 'Connection.php';
    $q = 'select * from stud_details where SID = "'.$sid.'"';
    $query = mysqli_query($conn,$q);
    $res = mysqli_fetch_array($query);
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
    <div class="container-fluid py-2">
      <div class="row">
          <div class="card mb-4 col-12">
            <div class="card-header pb-0 d-flex justify-content-between">
              <h2 > SID: <?php echo $res['SID'] ?></h2>
              <div>
                <a class="btn btn-primary" href = "editstudent.php?SID=<?php echo $res['SID'] ?>" ><i class="fas fa-user-edit"></i></a>
                <a class="btn btn-danger" href = "deletestudent.php?SID=<?php echo $res['SID'] ?>"><i class="fas fa-trash"></i></a>
              </div>
            </div>
            <hr>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="p-0">
                <table class=" table align-items-center mb-0 w-100 table-borderless">
                  <tbody>
                      <tr>
                          <td>
                            <h5 class="mb-0 mr-3 text-decoration-underline">Personal Details</h5>
                          </td>
                      </tr>
                      <tr>  
                          <td >
                            <p class="text-md font-weight-bolder mb-0">First Name:</p>
                          </td>
                          <td>
                            <p class="text-md mb-0"><?php echo $res['First_Name'] ?></p>
                          </td>
                          <td style="text-align:right;" rowspan="5" >
                              <div>
                                  <img src="./Student_Photo/<?php echo $res['Photo'] ?>" style="width:220px; height:220px" />
                              </div>
                          </td>
                      </tr>
                      <tr>  
                          <td >
                            <p class="text-md font-weight-bolder mb-0">Middle Name:</p>
                          </td>
                          <td>
                            <p class="text-md mb-0"><?php echo $res['Middle_Name'] ?></p>
                          </td>
                      </tr>
                      <tr>  
                          <td style="width:100px;">
                            <p class="text-md font-weight-bolder mb-0">Last Name:</p>
                          </td>
                          <td>
                            <p class="text-md mb-0"><?php echo $res['Last_Name'] ?></p>
                          </td>
                      </tr>
                      <tr>  
                          <td style="width:100px;">
                            <p class="text-md font-weight-bolder mb-0">Phone Number:</p>
                          </td>
                          <td>
                            <p class="text-md mb-0"><?php echo $res['Phone_Number'] ?></p>
                          </td>
                      </tr>
                      <tr>  
                          <td style="width:100px;">
                            <p class="text-md font-weight-bolder mb-0">Guardians Number:</p>
                          </td>
                          <td>
                            <p class="text-md mb-0"><?php echo $res['Guardians_Number'] ?></p>
                          </td>
                      </tr>
                    </tbody>
                </table>
                <table class=" table align-items-center mb-0 w-100 table-borderless">
                    <tbody>
                      <tr>  
                          <td>
                            <p class="text-md font-weight-bolder mb-0">Email:</p>
                          </td>
                          <td>
                            <p class="text-md mb-0"><?php echo $res['Email'] ?></p>
                          </td>
                          <td>
                            <p class="text-md font-weight-bolder mb-0">Aadhar Number:</p>
                          </td>
                          <td>
                            <p class="text-md mb-0"><?php echo $res['Aadhar_Number'] ?></p>
                          </td>
                          <td>
                            <p class="text-md font-weight-bolder mb-0">Gender:</p>
                          </td>
                          <td>
                            <p class="text-md mb-0"><?php echo $res['Gender'] ?></p>
                          </td>
                      </tr>
                      <tr>
                            <td>
                                <p class="text-md font-weight-bolder mb-0">DOB:</p>
                            </td>
                            <td>
                                <p class="text-md mb-0"><?php echo $res['DOB'] ?></p>
                            </td>
                            <td>
                                <p class="text-md font-weight-bolder mb-0">Blood Group:</p>
                            </td>
                            <td>
                                <p class="text-md mb-0"><?php echo $res['Blood_Group'] ?></p>
                            </td>
                            <td>
                                <p class="text-md font-weight-bolder mb-0">Religion:</p>
                            </td>
                            <td>
                                <p class="text-md mb-0"><?php echo $res['Religion'] ?></p>
                            </td>
                            <td>
                                <p class="text-md font-weight-bolder mb-0">Category:</p>
                            </td>
                            <td>
                                <p class="text-md mb-0"><?php echo $res['Category'] ?></p>
                            </td>
                      </tr>
                      </tbody>
                </table>
                <hr>
                <table class=" table align-items-center mb-0 w-100 table-borderless">
                    <tbody>
                      <tr>
                          <td>
                            <h5 class="mb-0 mr-3 text-decoration-underline">Postal Details</h5>
                          </td>
                      </tr>
                      <tr>
                            <td>
                                <p class="text-md font-weight-bolder mb-0">Current Address:</p>
                            </td>
                            <td>
                                <p class="text-md mb-0"><?php echo $res['Current_Add'] ?></p>
                            </td>
                            <td>
                                <p class="text-md font-weight-bolder mb-0">Country:</p>
                            </td>
                            <td>
                                <p class="text-md mb-0"><?php echo $res['Country'] ?></p>
                            </td>
                            <td>
                                <p class="text-md font-weight-bolder mb-0">State:</p>
                            </td>
                            <td>
                                <p class="text-md mb-0"><?php echo $res['State'] ?></p>
                            </td>
                            <td>
                                <p class="text-md font-weight-bolder mb-0">City:</p>
                            </td>
                            <td>
                                <p class="text-md mb-0"><?php echo $res['City'] ?></p>
                            </td>
                            <td>
                                <p class="text-md font-weight-bolder mb-0">PinCode:</p>
                            </td>
                            <td>
                                <p class="text-md mb-0"><?php echo $res['PinCode'] ?></p>
                            </td>
                      </tr>
                  </tbody>
                </table>
                <hr>
                <table class=" table align-items-center mb-0 w-100 table-borderless">
                    <tbody>
                      <tr>
                          <td>
                            <h5 class="mb-0 mr-3 text-decoration-underline">Academic Details</h5>
                          </td>
                      </tr>
                      <tr>
                            <td style="width:50px;">
                                <p class="text-md font-weight-bolder mb-0">Course:</p>
                            </td>
                            <td>
                                <p class="text-md mb-0"><?php echo $res['Course'] ?></p>
                            </td>
                            <td>
                                <p class="text-md font-weight-bolder mb-0">Semester:</p>
                            </td>
                            <td>
                                <p class="text-md mb-0"><?php echo $res['Semester'] ?></p>
                            </td>
                            <td>
                                <p class="text-md font-weight-bolder mb-0">Year:</p>
                            </td>
                            <td>
                                <p class="text-md mb-0"><?php echo $res['Year'] ?></p>
                            </td>
                      </tr>
              </div>
            </div>
          </div>
      </div>
    </div>
  </main>
  <?php include 'includes/script.php'?>
  <?php include 'includes/footer.php'?>
</body>
</html>