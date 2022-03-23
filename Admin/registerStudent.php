<?php 

    $Write="<?php $" . "UIDresult=''; " . "echo $" . "UIDresult;" . " ?>";
    file_put_contents('UIDContainer.php',$Write);
    
    include 'Connection.php';
    $courses = "select * from courses";
    $c_query = mysqli_query($conn,$courses);

    $semesters = "select * from semesters";
    $s_query = mysqli_query($conn,$semesters);
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
  <?php include 'includes/script.php'?>
  <script>
			$(document).ready(function(){
				var data =  $("#getSID").load("UIDContainer.php");
                console.log(data);
				setInterval(function() {
					$("#getSID").load("UIDContainer.php");
				}, 500);
			});
    </script>
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

                    if(isset($_POST['Submit']))
                    {
                        $SID = $_POST['SID'];
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

                        if($_FILES['Photo']['type'] == "image/jpeg" or $_FILES['Photo']['type'] == "image/jpg" or $_FILES['Photo']['type'] == "image/png")
                        {
                            $q = 'insert into stud_details (SID,Photo,First_Name,Middle_Name,Last_Name,Phone_Number,Guardians_Number,Email,Aadhar_Number,Gender,DOB,Blood_Group,POB,Religion,Category,Current_Add,Country,State,City,PinCode,Course,Year,Semester)values("'.$SID.'","'.$photoname.'","'.$FirstName.'","'.$MiddleName.'","'.$LastName.'","'.$PhoneNumber.'","'.$GuardianNumber.'","'.$Email.'","'.$AadharNumber.'","'.$Gender.'","'.$DOB.'","'.$BloodGroup.'","'.$POB.'","'.$Religion.'","'.$Category.'","'.$CurrentAddress.'","'.$Country.'","'.$State.'","'.$City.'","'.$PinCode.'","'.$Course.'","'.$Year.'","'.$Semester.'")';
                            
                            $query = mysqli_query($conn,$q);
                            if($query)
                            {
                                
                                $extension = pathinfo($_FILES["Photo"]["name"], PATHINFO_EXTENSION);
                                move_uploaded_file($_FILES['Photo']['tmp_name'],"./Student_Photo/".$photoname);
                                echo '
                                <div class="alert alert-success col-12 text-center text-md mt-3" role="alert">
                                    <i class="fas fa-check-circle"></i> User Registered!!!
                                </div>
                                ';  
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
                ?>
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">New Student Registration</h6>
                </div>
                <div class="card-body pt-4 p-3">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="row border  py-3 mx-1 mb-3 rounded-3">
                        <h6 class="mb-3">Personal Information</h6>
                            <div class="form-floating mb-3 col-6">
                                <textarea class="form-control" placeholder="Please Tag your Card to display ID" id="getSID" name="SID" required readonly></textarea>
                                <label for="floatingTextarea">Please Tag your Card to display ID</label>
                            </div>
                            <div class="form-floating mb-3 col-6">
                                <input type="file" class="form-control " name = "Photo" id="floatingInput" required placeholder="Photo">
                                <label for="floatingInput">Photo</label>
                            </div>
                            <div class="form-floating mb-3 col-4">
                                <input type="text" class="form-control " name = "FirstName" id="floatingInput" required placeholder="First Name">
                                <label for="floatingInput">First Name</label>
                            </div>
                            <div class="form-floating mb-3 col-4">
                                <input type="text" class="form-control " name = "MiddleName" id="floatingInput" required placeholder="Middle Name">
                                <label for="floatingInput">Middle Name</label>
                            </div>
                            <div class="form-floating mb-3 col-4">
                                <input type="text" class="form-control " name = "LastName" id="floatingInput" required placeholder="Last Name">
                                <label for="floatingInput">Last Name</label>
                            </div>
                            <div class="form-floating mb-3 col-3">
                                <input type="text" class="form-control " name = "PhoneNumber" pattern="[0-9]{10}" id="floatingInput" required placeholder="Phone Number">
                                <label for="floatingInput">Phone Number</label>
                            </div>
                            <div class="form-floating mb-3 col-3">
                                <input type="text" class="form-control " name = "GuardianNumber" pattern="[0-9]{10}" id="floatingInput" required placeholder="Guardians Number">
                                <label for="floatingInput">Guardians Number</label>
                            </div>
                            <div class="form-floating mb-3 col-3">
                                <input type="text" class="form-control " name = "Email" id="floatingInput" required placeholder="Email Address">
                                <label for="floatingInput">Email Address</label>
                            </div>
                            <div class="form-floating mb-3 col-3">
                                <input type="text" class="form-control " name = "AadharNumber" pattern="[0-9]{12}" id="floatingInput" required placeholder="Aadhar Number">
                                <label for="floatingInput">Aadhar Number</label>
                            </div>
                            <div class="form-floating mb-3 col-4">
                                <select class="form-select" id="floatingSelectGrid" name = "Gender" aria-label="Floating label select example">
                                    <option value="Male" selected>Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                                <label for="floatingSelectGrid">Gender</label>
                            </div>
                            <div class="form-floating mb-3 col-4">
                                <input type="date" class="form-control " name = "DOB" id="floatingInput" required placeholder="Date of Birth">
                                <label for="floatingInput">Date Of Birth</label>
                            </div>
                            <div class="form-floating mb-3 col-4">
                                <input type="text" class="form-control " name = "BloodGroup" id="floatingInput" required placeholder="Blood Group">
                                <label for="floatingInput">Blood Group</label>
                            </div>
                            <div class="form-floating mb-3 col-4">
                                <input type="text" class="form-control " name = "POB" id="floatingInput" required placeholder="Place of Birth">
                                <label for="floatingInput">Place Of Birth</label>
                            </div>
                            <div class="form-floating mb-3 col-4">
                                <input type="text" class="form-control " name = "Religion" id="floatingInput" required placeholder="Religion">
                                <label for="floatingInput">Religion</label>
                            </div>
                            <div class="form-floating mb-3 col-4">
                                <select class="form-select" id="floatingSelectGrid" name = "Category" aria-label="Floating label select example">
                                    <option value="General" selected>General</option>
                                    <option value="ST">ST</option>
                                    <option value="SC">SC</option>
                                    <option value="OBC">OBC</option>
                                </select>
                                <label for="floatingSelectGrid">Category</label>
                            </div>
                        </div>
                        <div class="row border  py-3 mx-1 mb-3 rounded-3">
                            <h6 class="mb-3">Postal Details</h6>
                            <div class="form-floating mb-3 col-12">
                                    <textarea class="form-control" name="CurrentAddress" placeholder="Current Address" required></textarea>
                                    <label for="floatingTextarea">Current Address</label>
                            </div>
                            <div class="form-floating mb-3 col-3">
                                    <input type="text" class="form-control " name = "Country" id="floatingInput" required placeholder="Country" value="India">
                                    <label for="floatingInput">Country</label>
                            </div>
                            <div class="form-floating mb-3 col-3">
                                <input type="text" class="form-control " name = "State" id="floatingInput" required placeholder="State">
                                <label for="floatingInput">State</label>
                            </div>
                            <div class="form-floating mb-3 col-3">
                                <input type="text" class="form-control " name = "City" id="floatingInput" required placeholder="City">
                                <label for="floatingInput">City</label>
                            </div>
                            <div class="form-floating mb-3 col-3">
                                <input type="text" class="form-control " name = "PinCode" id="floatingInput" required placeholder="Pin Code">
                                <label for="floatingInput">Pin Code</label>
                            </div>
                        </div>
                        <div class="row border  py-3 mx-1 mb-3 rounded-3">
                            <h6 class="mb-3">Academic Details</h6>
                            <div class="form-floating mb-3 col-6">
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
                            <div class="form-floating mb-3 col-6">
                                <select class="form-select" id="floatingSelectGrid state" name = "Semester" aria-label="Floating label select example" required>
                                <option value="">Select</option>
                                <?php 
                                        while($s_res = mysqli_fetch_array($s_query))
                                        {
                                            
                                            echo '<option value="'.$s_res['S_Name'].'">'.$s_res['S_Name'].'</option>';
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
  <?php include 'includes/footer.php'?>
    <script>

    </script>
</body>
</html>