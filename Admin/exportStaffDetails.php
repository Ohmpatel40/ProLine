<?php

    include 'Connection.php';
    require 'vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    $course = "select * from courses";
    $c_query = mysqli_query($conn,$course);

    $staffQ = " SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='proline' AND `TABLE_NAME`='staff_details'";
    $staffQuery = mysqli_query($conn,$staffQ);
?>

    <script>
        function loadStaffCheckbox()
        {
            $.ajax({
                type: "GET",
                url: 'loadStaffCheckbox.php',
                success: function(response) {
                    $("#staffCheckbox").html(response);
                }
            })
        }
    </script>
</head>
      <div class="row">
        <div class="col-12">
          <div class="card mb-2">
            <div class="card-header pb-0">
              <h6>Export Staff Details </h6>
            </div>
            
            <?php
                if(isset($_POST['exportStaff']))
                {
                    include 'connection.php';
                    $staffColumns = array();
                    $staffSqlColumns ;
                    while($staffRes = mysqli_fetch_array($staffQuery))
                    {
                        if(isset($_POST[$staffRes['COLUMN_NAME']]))
                        {
                            array_push($staffColumns,$staffRes['COLUMN_NAME']);
                            $staffSqlColumns = implode(",",$staffColumns);
                        }
                    }
                    if(!empty($staffColumns))
                    {
                        $course = $_POST['coursestaff'];
                        if($course == "ALL")
                        {
                            $exportQ = "select ".$staffSqlColumns." from staff_details";
                        }
                        else
                        {
                            $exportQ = "select ".$staffSqlColumns." from stud_details where Course = '".$course."'";
                        }
                        $exportQuery = mysqli_query($conn,$exportQ);
                        $exportNums = mysqli_num_rows($exportQuery);
                        
                        if($exportNums > 0)
                        {
                            $spreadsheet = new Spreadsheet();
                            $sheet = $spreadsheet->getActiveSheet();
                            $lenght = 65 + count($staffColumns);
                            $count = 0;
                            for( $i = 65; $i < $lenght; $i++) 
                            {
                                $col = chr($i)."1";
                                $sheet->setCellValue($col , $staffColumns[$count]);
                                $count++;
                            }
                            $c = 2;
                            while($exportRes = mysqli_fetch_array($exportQuery))
                            {
                                $i = 65;
                                foreach($staffColumns as $value)
                                {
                                    $col = chr($i).$c;
                                    $sheet->setCellValue($col , $exportRes[$value]);
                                    $i++;
                                }
                                $c++;
                            }

                            $writer = new Xlsx($spreadsheet);
                            $filename = $course."-".$semester."-".date('d/m/Y');
                            $path = "C:/Users/Home/Documents/StaffDetails.xlsx";
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
                        $staffSqlColumns = "*";
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
                        <select class="form-select" id="floatingSelectGrid" name = "coursestaff" aria-label="Floating label select example" required>
                            <option value="">Select Course</option>
                            <option value="ALL">ALL</option>
                                <?php 
                                        while($c_res = mysqli_fetch_array($c_query))
                                        {
                                            
                                            echo '<option value="'.$c_res['C_Name'].'">'.$c_res['C_Name'].'</option>';
                                        }
                                    ?>
                        </select>
                        <label for="floatingSelectGrid">Course</label>
                    </div>
                </div>
                <div class=" d-flex align-items-center justify-content-center column flex-wrap py-3 mx-1 mb-2" id = "staffCheckbox">
                   
                </div>
                <div class="d-flex justify-content-center">
                    <button type="submit" name="exportStaff" class="btn btn-success"><i class="fas fa-download"></i> &nbsp; Export</button>
                </div>
            </form>
          </div>
        </div>
      </div>