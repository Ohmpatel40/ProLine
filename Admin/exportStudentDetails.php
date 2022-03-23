<?php

    include 'Connection.php';
    require 'vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    $semester = "select * from semesters";
    $s_query = mysqli_query($conn,$semester);

    $course = "select * from courses";
    $c_query = mysqli_query($conn,$course);
    
    $q = " SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='proline' AND `TABLE_NAME`='stud_details'";
    $query = mysqli_query($conn,$q);
?>

<head>
    <script>
        function loadStudentCheckbox()
        {
            $.ajax({
                type: "GET",
                url: 'loadStudentCheckbox.php',
                success: function(response) {
                    $("#studentCheckbox").html(response);
                }
            })
        }
    </script>
</head>
      <div class="row">
        <div class="col-12">
          <div class="card mb-2">
            <div class="card-header pb-0">
              <h6>Export Student Details </h6>
            </div>
            
            <?php
                if(isset($_POST['exportStudent']))
                {
                    include 'connection.php';
                    $columns = array();
                    $sqlColumns ;
                    while($res = mysqli_fetch_array($query))
                    {
                        if(isset($_POST[$res['COLUMN_NAME']]))
                        {
                            array_push($columns,$res['COLUMN_NAME']);
                            $sqlColumns = implode(",",$columns);
                        }
                    }

                    if(!empty($columns))
                    {
                        $course = $_POST['course'];
                        $semester = $_POST['semester'];

                        $exportQ = "select ".$sqlColumns." from stud_details where Course = '".$course."' and Semester = '".$semester."'";
                        $exportQuery = mysqli_query($conn,$exportQ);
                        $exportNums = mysqli_num_rows($exportQuery);
                        
                        if($exportNums > 0)
                        {
                            $spreadsheet = new Spreadsheet();
                            $sheet = $spreadsheet->getActiveSheet();
                            $lenght = 65 + count($columns);
                            $count = 0;
                            for( $i = 65; $i < $lenght; $i++) 
                            {
                                $col = chr($i)."1";
                                $sheet->setCellValue($col , $columns[$count]);
                                $count++;
                            }
                            $c = 2;
                            while($exportRes = mysqli_fetch_array($exportQuery))
                            {
                                $i = 65;
                                foreach($columns as $value)
                                {
                                    $col = chr($i).$c;
                                    $sheet->setCellValue($col , $exportRes[$value]);
                                    $i++;
                                }
                                $c++;
                            }

                            $writer = new Xlsx($spreadsheet);
                            $filename = $course."-".$semester."-".date('d/m/Y');
                            $path = "C:/Users/Home/Documents/StudentDetails.xlsx";
                            $writer->save($path);

                            echo '
                                <div class="text-white alert alert-success col-12 text-center text-md mt-3" role="alert">
                                    <i class="fas fa-check-circle "></i> File saved in Documents!!
                                </div>
                                ';  
                        }
                        else
                        {
                            echo '
                            <div class="text-white alert alert-danger col-12 text-center text-md mt-3" role="alert">
                                <i class="fas fa-times-circle "></i> No Data Found!!
                            </div>
                            ';  
                        }
                    }
                    else
                    {
                        $sqlColumns = "*";
                        echo '
                        <div class="text-white alert alert-danger col-12 text-center text-md mt-3" role="alert">
                            <i class="fas fa-times-circle "></i> Select Columns!!
                        </div>
                        ';  
                    }
                    

                }
                // SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='proline' AND `TABLE_NAME`='stud_details';
            ?>
            <form method="POST">
            <div class=" d-flex align-items-center justify-content-center row my-2 mx-1">
                  <div class="form-floating col-4">
                        <select class="form-select" id="floatingSelectGrid" name = "course" aria-label="Floating label select example" required>
                            <option value="">Select Course</option>
                                <?php 
                                        while($c_res = mysqli_fetch_array($c_query))
                                        {
                                            
                                            echo '<option value="'.$c_res['C_Name'].'">'.$c_res['C_Name'].'</option>';
                                        }
                                    ?>
                        </select>
                        <label for="floatingSelectGrid">Course</label>
                    </div>
                    <div class="form-floating col-3">
                        <select class="form-select" id="floatingSelectGrid" name = "semester" aria-label="Floating label select example" required>
                        <option value="">Select Semester</option>
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
                <div class=" d-flex align-items-center justify-content-center column flex-wrap py-3 mx-1 mb-2" id = "studentCheckbox">
                   
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" name="exportStudent" class="btn btn-success"><i class="fas fa-download"></i> &nbsp; Export</button>
                </div>
            </form>
          </div>
        </div>
      </div>