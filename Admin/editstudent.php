<?php
    $SID = $_GET['SID'];

    include 'Connection.php';
    $q = "select * from stud_details where SID = '$SID'";
    $query = mysqli_query($conn,$q);
    $res = mysqli_fetch_array($query);

    $courses = "select * from courses";
    $c_query = mysqli_query($conn,$courses);

    $semesters = "select * from semesters";
    $s_query = mysqli_query($conn,$semesters);

    $male="";$female="";$other="";$general="";$st="";$sc="";$obc="";

    if($res['Gender']=='Male')
    {
        $male="selected";
    }
    elseif($res['Gender']=='Female')
    {
        $female="selected";
    }
    else
    {
        $other = "selected";
    }

    if($res['Category']=="General")
    {
        $general="selected";
    }
    elseif($res['Category']=="ST")
    {
        $st="selected";
    }
    elseif($res['Category']=="SC")
    {
        $sc="selected";
    }
    else
    {
        $obc="selected";
    }

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
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-12 mt-4">
            <div class="card h-100 mb-4">
                
                <?php
                    include 'Connection.php';

                    if(isset($_POST['Submit']))
                    {
                        $FirstName = $_POST['FirstName'];
                        $MiddleName = $_POST['MiddleName'];
                        $LastName = $_POST['LastName'];
                        $PhoneNumber = $_POST['PhoneNumber'];
                        $GuardianNumber = $_POST['GuardianNumber'];
                        $Email = $_POST['Email'];
                        $AadharNumber = $_POST['AadharNumber'];
                        $Gender = $_POST['Gender'];
                        $DOB = $_POST['DOB'];
                        $BloodGroup = $_POST['BloodGroup'];
                        $POB = $_POST['POB'];
                        $Religion = $_POST['Religion'];
                        $Category = $_POST['Category'];
                        $CurrentAddress = $_POST['CurrentAddress'];
                        $Country = $_POST['Country'];
                        $State = $_POST['State'];
                        $City = $_POST['City'];
                        $PinCode = $_POST['PinCode'];
                        $Course = $_POST['Course'];
                        $Semester = $_POST['Semester'];
                        $extension = pathinfo($_FILES["Photo"]["name"], PATHINFO_EXTENSION);
                        $photoname = $SID.".".$extension;

                        if($Semester == "First" || $Semester == "Second")
                        {
                            $Year = "First Year";
                        }
                        elseif($Semester == "Third" || $Semester == "Fourth")
                        {
                            $Year = "Second Year";
                        }
                        else
                        {
                            $Year = "Third Year";
                        }

                        if($_FILES['Photo'])
                        {

                            if($_FILES['Photo']['type'] == "image/jpeg" or $_FILES['Photo']['type'] == "image/jpg" or $_FILES['Photo']['type'] == "image/png")
                            {
                                $q = 'update stud_details set Photo = "'.$photoname.'" ,First_Name = "'.$FirstName.'",Middle_Name = "'.$MiddleName.'",Last_Name = "'.$LastName.'",Phone_Number = "'.$PhoneNumber.'",Guardians_Number = "'.$GuardianNumber.'",Email = "'.$Email.'",Aadhar_Number = "'.$AadharNumber.'",Gender = "'.$Gender.'" ,DOB = "'.$DOB.'" ,Blood_Group = "'.$BloodGroup.'",POB = "'.$POB.'" ,Religion = "'.$Religion.'",Category = "'.$Category.'",Current_Add = "'.$CurrentAddress.'" ,Country = "'.$Country.'",State = "'.$State.'",City = "'.$City.'",PinCode = "'.$PinCode.'" ,Course = "'.$Course.'" ,Year = "'.$Year.'",Semester = "'.$Semester.'" where SID = "'.$SID.'" ';
                                
                                $query = mysqli_query($conn,$q);
                                if($query)
                                {
                                    
                                    $extension = pathinfo($_FILES["Photo"]["name"], PATHINFO_EXTENSION);
                                    move_uploaded_file($_FILES['Photo']['tmp_name'],"./Student_Photo/".$photoname);
                                    echo "<script>";
                                        echo ("location.href='manageStudent.php'");
                                    echo "</script>"; 
                                }
                                else
                                {
                                    echo '
                                    <div class="alert alert-danger col-12 text-center text-md mt-3" role="alert">
                                        <i class="fas fa-times-circle "></i> User Not Registered!!!
                                    </div>
                                    ';  
                                }
                            }
                            else
                            {
                                echo '
                                        <div class="alert alert-danger col-12 text-center text-md mt-3" role="alert">
                                            <i class="fas fa-times-circle "></i> Select .jpeg , .jpg , .png files only!!!
                                        </div>
                                    ';   
                            }
                        }
                        else
                        {
                            $q = 'update stud_details set First_Name = "'.$FirstName.'",Middle_Name = "'.$MiddleName.'",Last_Name = "'.$LastName.'",Phone_Number = "'.$PhoneNumber.'",Guardians_Number = "'.$GuardianNumber.'",Email = "'.$Email.'",Aadhar_Number = "'.$AadharNumber.'",Gender = "'.$Gender.'" ,DOB = "'.$DOB.'" ,Blood_Group = "'.$BloodGroup.'",POB = "'.$POB.'" ,Religion = "'.$Religion.'",Category = "'.$Category.'",Current_Add = "'.$CurrentAddress.'" ,Country = "'.$Country.'",State = "'.$State.'",City = "'.$City.'",PinCode = "'.$PinCode.'" ,Course = "'.$Course.'" ,Year = "'.$Year.'",Semester = "'.$Semester.'" where SID = "'.$SID.'" ';
                                
                            $query = mysqli_query($conn,$q);
                            if($query)
                            {
                                echo "<script>";
                                    echo ("location.href='manageStudent.php'");
                                echo "</script>"; 
                            }
                            else
                            {
                                echo '
                                <div class="alert alert-danger col-12 text-center text-md mt-3" role="alert">
                                    <i class="fas fa-times-circle "></i> User Not Registered!!!
                                </div>
                                ';  
                            } 
                        }
                        
                    }
                ?>
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">Edit Student Details</h6>
                </div>
                <div class="card-body pt-4 p-3">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="row border  py-3 mx-1 mb-3 rounded-3">
                        <h6 class="mb-3">Personal Information</h6>
                            <div class="form-floating mb-3 col-6">
                                <textarea class="form-control" placeholder="Please Tag your Card to display ID" id="getSID" name="SID" required readonly> <?php echo $res['SID'] ?> </textarea>
                                <label for="floatingTextarea">Please Tag your Card to display ID</label>
                            </div>
                            <div class="form-floating mb-3 col-6">
                                <input type="file" class="form-control " name = "Photo" id="floatingInput" placeholder="Photo">
                                <label for="floatingInput">Photo</label>
                            </div>
                            <div class="form-floating mb-3 col-4">
                                <input type="text" class="form-control " value = "<?php echo $res['First_Name'] ?>" name = "FirstName" id="floatingInput" required placeholder="First Name">
                                <label for="floatingInput">First Name</label>
                            </div>
                            <div class="form-floating mb-3 col-4">
                                <input type="text" class="form-control " value = "<?php echo $res['Middle_Name'] ?>" name = "MiddleName" id="floatingInput" required placeholder="Middle Name">
                                <label for="floatingInput">Middle Name</label>
                            </div>
                            <div class="form-floating mb-3 col-4">
                                <input type="text" class="form-control " value = "<?php echo $res['Last_Name'] ?>" name = "LastName" id="floatingInput" required placeholder="Last Name">
                                <label for="floatingInput">Last Name</label>
                            </div>
                            <div class="form-floating mb-3 col-3">
                                <input type="text" class="form-control " value = "<?php echo $res['Phone_Number'] ?>" name = "PhoneNumber" pattern="[0-9]{10}" id="floatingInput" required placeholder="Phone Number">
                                <label for="floatingInput">Phone Number</label>
                            </div>
                            <div class="form-floating mb-3 col-3">
                                <input type="text" class="form-control " value = "<?php echo $res['Guardians_Number'] ?>" name = "GuardianNumber" pattern="[0-9]{10}" id="floatingInput" required placeholder="Guardians Number">
                                <label for="floatingInput">Guardians Number</label>
                            </div>
                            <div class="form-floating mb-3 col-3">
                                <input type="text" class="form-control " value = "<?php echo $res['Email'] ?>" name = "Email" id="floatingInput" required placeholder="Email Address">
                                <label for="floatingInput">Email Address</label>
                            </div>
                            <div class="form-floating mb-3 col-3">
                                <input type="text" class="form-control " value = "<?php echo $res['Aadhar_Number'] ?>" name = "AadharNumber" pattern="[0-9]{12}" id="floatingInput" required placeholder="Aadhar Number">
                                <label for="floatingInput">Aadhar Number</label>
                            </div>
                            <div class="form-floating mb-3 col-4">
                                <select class="form-select" id="floatingSelectGrid" name = "Gender" aria-label="Floating label select example">
                                    <option value="Male" <?php echo $male ?> >Male</option>
                                    <option value="Female" <?php echo $female ?> >Female</option>
                                    <option value="Other" <?php echo $other ?> >Other</option>
                                </select>
                                <label for="floatingSelectGrid">Gender</label>
                            </div>
                            <div class="form-floating mb-3 col-4">
                                <input type="date" class="form-control " value = "<?php echo $res['DOB'] ?>" name = "DOB" id="floatingInput" required placeholder="Date of Birth">
                                <label for="floatingInput">Date Of Birth</label>
                            </div>
                            <div class="form-floating mb-3 col-4">
                                <input type="text" class="form-control " value = "<?php echo $res['Blood_Group'] ?>" name = "BloodGroup" id="floatingInput" required placeholder="Blood Group">
                                <label for="floatingInput">Blood Group</label>
                            </div>
                            <div class="form-floating mb-3 col-4">
                                <input type="text" class="form-control " value = "<?php echo $res['POB'] ?>" name = "POB" id="floatingInput" required placeholder="Place of Birth">
                                <label for="floatingInput">Place Of Birth</label>
                            </div>
                            <div class="form-floating mb-3 col-4">
                                <input type="text" class="form-control " value = "<?php echo $res['Religion'] ?>" name = "Religion" id="floatingInput" required placeholder="Religion">
                                <label for="floatingInput">Religion</label>
                            </div>
                            <div class="form-floating mb-3 col-4">
                                <select class="form-select" id="floatingSelectGrid" name = "Category" aria-label="Floating label select example">
                                    <option value="General" <?php echo $general ?> >General</option>
                                    <option value="ST" <?php echo $st ?> >ST</option>
                                    <option value="SC" <?php echo $sc ?> >SC</option>
                                    <option value="OBC" <?php echo $obc ?> >OBC</option>
                                </select>
                                <label for="floatingSelectGrid">Category</label>
                            </div>
                        </div>
                        <div class="row border  py-3 mx-1 mb-3 rounded-3">
                            <h6 class="mb-3">Postal Details</h6>
                            <div class="form-floating mb-3 col-12">
                                    <textarea class="form-control" name="CurrentAddress" placeholder="Current Address" required> <?php echo $res['Current_Add'] ?></textarea>
                                    <label for="floatingTextarea">Current Address</label>
                            </div>
                            <div class="form-floating mb-3 col-3">
                                    <input type="text" class="form-control " value = "<?php echo $res['Country'] ?>" name = "Country" id="floatingInput" required placeholder="Country" value="India">
                                    <label for="floatingInput">Country</label>
                            </div>
                            <div class="form-floating mb-3 col-3">
                                <input type="text" class="form-control " value = "<?php echo $res['State'] ?>" name = "State" id="floatingInput" required placeholder="State">
                                <label for="floatingInput">State</label>
                            </div>
                            <div class="form-floating mb-3 col-3">
                                <input type="text" class="form-control " value = "<?php echo $res['City'] ?>" name = "City" id="floatingInput" required placeholder="City">
                                <label for="floatingInput">City</label>
                            </div>
                            <div class="form-floating mb-3 col-3">
                                <input type="text" class="form-control " value = "<?php echo $res['PinCode'] ?>" name = "PinCode" id="floatingInput" required placeholder="Pin Code">
                                <label for="floatingInput">Pin Code</label>
                            </div>
                        </div>
                        <div class="row border  py-3 mx-1 mb-3 rounded-3">
                            <h6 class="mb-3">Academic Details</h6>
                            <div class="form-floating mb-3 col-6">
                                <select class="form-select" id="floatingSelectGrid state" name = "Course" aria-label="Floating label select example" >
                                    <?php 
                                        while($c_res = mysqli_fetch_array($c_query))
                                        {
                                            $selected_course = $res['Course'];
                                            $default_course = $c_res['C_Name'];
                                            if($default_course == $selected_course)
                                            {
                                                echo '<option value="'.$c_res['C_Name'].'" selected>'.$c_res['C_Name'].'</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="'.$c_res['C_Name'].'">'.$c_res['C_Name'].'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                                <label for="floatingSelectGrid">Course</label>
                            </div>
                            <div class="form-floating mb-3 col-6">
                                <select class="form-select" id="floatingSelectGrid state" name = "Semester" aria-label="Floating label select example">
                                <?php 
                                        while($s_res = mysqli_fetch_array($s_query))
                                        {
                                            $selected_semester = $res['Semester'];
                                            $default_semester = $s_res['S_Name'];
                                            if($default_semester == $selected_semester)
                                            {
                                                echo '<option value="'.$s_res['S_Name'].'" selected>'.$s_res['S_Name'].'</option>';
                                            }
                                            else
                                            {
                                                echo '<option value="'.$s_res['S_Name'].'">'.$s_res['S_Name'].'</option>';
                                            }
                                        }
                                    ?>
                                </select>
                                <label for="floatingSelectGrid">Semester</label>
                            </div>
                        </div>
                        <div class="row py-3 mx-1 d-flex justify-content-around">
                            <button type="submit" class="btn btn-success col-4" name="Submit" > Submit </button>
                            <button type="reset" class="btn btn-secondary col-4" > Reset </button>
                        </div>
                    </form>
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