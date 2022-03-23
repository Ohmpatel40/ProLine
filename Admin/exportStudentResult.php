<?php

    include 'Connection.php';
    require 'vendor/autoload.php';
    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    $semester = "select * from semesters";
    $s_query = mysqli_query($conn,$semester);

    $course = "select * from courses";
    $c_query = mysqli_query($conn,$course);

?>

<head>
</head>
      <div class="row">
        <div class="col-12">
          <div class="card mb-2">
            <div class="card-header pb-0">
              <h6>Export Result</h6>
            </div>
            
            <?php
                if(isset($_POST['exportResult']))
                {
                    include 'connection.php';
                    $spreadsheet = new Spreadsheet();
                    $sheet = $spreadsheet->getActiveSheet();
                    
                        $course = $_POST['Rcourse'];
                        $sem = $_POST['Rsemester'];
                        $type = $_POST['Rtype'];

                        $checkQ = "select * from result where CID = '$course' and SemID = '$sem' and Examtype = '$type'";
                        $checkQuery = mysqli_query($conn,$checkQ);
                        $checkNum = mysqli_num_rows($checkQuery);

                        
                        if($checkNum > 0)
                        {
                            $q = "SELECT * FROM subject_link join  subject on  subject.SubID=subject_link.SubID WHERE subject_link.SID='$sem' and subject_link.CID='$course' order by subject.Sub_Code";
                            $query = mysqli_query($conn,$q);
                            $num = mysqli_num_rows($query);
                            $i = 67;
                            $sheet->setCellValue("A1" , "SID");
                            $sheet->setCellValue("B1" , "Name");
                            $columns = array("SID","First_Name");
                            while($res = mysqli_fetch_array($query))
                            {
                                $col = chr($i)."1";
                                $sheet->setCellValue($col , $res['Sub_Code']."-".$res['Sub_Name']);
                                array_push($columns,$res['Sub_Name']);
                                $i++;
                            }
                            
                            $i=65;
                            $row=2; 
                            $query1 = mysqli_query($conn,$q);
                            foreach($columns as $value)
                            {
                                echo $checkQ = "select * from result join  stud_details on result.SID=stud_details.SID where CID = '".$course."' and SemID = '".$sem."' and SubID = '".$value."' and Examtype = '$type'";
                                $checkQuery = mysqli_query($conn,$checkQ);
                                $checkRes = mysqli_fetch_array($checkQuery);
                                for( $j = 65; $j < 66 ; $j++) 
                                {
                                    echo $column = chr($i).$row;
                                    $sheet->setCellValue($column , $checkRes['SID']);
                                }
                                $row++;
                            }

                            $writer = new Xlsx($spreadsheet);
                            $filename = $course."-".$semester."-".date('d/m/Y');
                            $path = "C:/Users/Home/Documents/StudentResult.xlsx";
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
                // SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='proline' AND `TABLE_NAME`='stud_details';
            ?>
            <form method="POST">
                <div class=" d-flex align-items-center justify-content-center row my-2 mx-1 mb-4">
                  <div class="form-floating col-4">
                        <select class="form-select" id="floatingSelectGrid" name = "Rcourse" aria-label="Floating label select example" required>
                            <option value="">Select Course</option>
                                <?php 
                                        while($c_res = mysqli_fetch_array($c_query))
                                        {
                                            
                                            echo '<option value="'.$c_res['CID'].'">'.$c_res['C_Name'].'</option>';
                                        }
                                    ?>
                        </select>
                        <label for="floatingSelectGrid">Course</label>
                    </div>
                    <div class="form-floating col-3">
                        <select class="form-select" id="floatingSelectGrid" name = "Rsemester" aria-label="Floating label select example" required>
                        <option value="">Select Semester</option>
                                <?php 
                                        while($s_res = mysqli_fetch_array($s_query))
                                        {
                                            
                                            echo '<option value="'.$s_res['SID'].'">'.$s_res['S_Name'].'</option>';
                                        }
                                    ?>
                        </select>
                        <label for="floatingSelectGrid">Semester</label>
                    </div>
                    <div class="form-floating col-2">
                        <select class="form-select" id="floatingSelectGrid" name = "Rtype" aria-label="Floating label select example" required>
                            <option value="">Select Exam Type</option>
                            <option value="Internal">Internal</option>
                            <option value="External">External</option>
                        </select>
                        <label for="floatingSelectGrid">Exam Type</label>
                    </div>
                    <div class="form-floating col-3">
                        <button type="submit" name="exportResult" class="btn btn-success p-3"><i class="fas fa-download"></i> &nbsp; Export</button>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>