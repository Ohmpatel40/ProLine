<?php
    include 'connection.php';
    require("assets/fpdf/fpdf.php");

    $sid = $_GET['ID']; 
    $type = $_GET['type'];
    $sem = $_GET['sem'];
    $cname = $_GET['cname'];

    $infoQ = "select * from stud_details where SID = '$sid'";
    $infoQuery = mysqli_query($conn,$infoQ);
    $info = mysqli_fetch_array($infoQuery);
    $path = "Student_Photo/".$info['Photo'];
    $totalMarks = 0 ;
    $total = 0;
    $totalGP = 0;
    $backlog = 0;

    $checkQ = "select * from result where SID = '$sid' and SemID = '$sem' and Examtype = '$type'";
    $checkQuery = mysqli_query($conn,$checkQ);
    $checkNum = mysqli_num_rows($checkQuery);
 
        $pdf = new FPDF();
        $pdf-> AddPage('L');
        $pdf-> AddFont('Opan Sans','B','open-sans.bold.php');
        $pdf-> AddFont('Opan Sans','','open-sans.regular.php');
        $pdf-> SetFont("Opan Sans","BU",18);
        $pdf-> Image('assets/img/result_header.png',0,0,300,40);
        $pdf-> Cell(0,35,"",0,1,'L');
        $pdf-> Cell(0,10,"STATEMENT OF MARKS (".strtoupper($type).")",0,1,'C');
        $pdf-> Image($path,250,45,35,35);
        $pdf-> SetFont("Opan Sans","B",12);
        $pdf-> Cell(10,8,"SID:",0,0,'L');
        $pdf-> SetFont("Opan Sans","",12);
        $pdf-> Cell(0,8,$info['SID'],0,1,'L');
        $pdf-> SetFont("Opan Sans","B",12);
        $pdf-> Cell(38,8,"Student's Name:",0,0,'L');
        $pdf-> SetFont("Opan Sans","",12);
        $pdf-> Cell(0,8,$info['Last_Name']." ".$info['First_Name']." ".$info['Middle_Name'],0,1,'L');
        $pdf-> SetFont("Opan Sans","B",12);
        $pdf-> Cell(18,8,"Course:",0,0,'L');
        $pdf-> SetFont("Opan Sans","",12);
        $pdf-> Cell(75,8,$info['Course'],0,0,'L');
        $pdf-> SetFont("Opan Sans","B",12);
        $pdf-> Cell(23,8,"Semester:",0,0,'L');
        $pdf-> SetFont("Opan Sans","",12);
        $pdf-> Cell(23,8,$info['Semester'],0,0,'L');
        $pdf-> SetFont("Opan Sans","B",12);
        $pdf-> Cell(13,8,"Year:",0,0,'L');
        $pdf-> SetFont("Opan Sans","",12);
        $pdf-> Cell(0,8,$info['Year'],0,1,'L');
        $pdf-> SetFont("Opan Sans","B",12);
        $pdf-> Cell(0,10,"--------------------------------------------------------------------------------------------",0,1,'C');
        $pdf-> Cell(0,4,"",0,1,'L');
        $pdf-> SetFont("Opan Sans","B",12);
        $pdf-> Cell(40,8,"",0,0,'L');
        $pdf->SetFillColor(255,142,66);
        $pdf-> Cell(90,8,"Subject Name",1,0,'L',true);
        $pdf-> Cell(55,8,"Marks Obtained",1,0,'C',true);
        $pdf-> Cell(40,8,"Grade Points",1,1,'C',true);
        $pdf-> SetFont("Opan Sans","",12);
        $pdf->SetFillColor(245,245,245);

        if($checkNum > 0)
        {
            $q = "SELECT * FROM subject_link join  subject on  subject.SubID=subject_link.SubID WHERE subject_link.SID='$sem' and subject_link.CID='$cname' order by subject.Sub_Code";
            $query = mysqli_query($conn,$q);
            $num = mysqli_num_rows($query);
            while($res = mysqli_fetch_array($query))
            {
                $checkQ = "select * from result where SID ='".$sid."' and CID = '".$cname."' and SemID = '".$sem."' and SubID = '".$res['SubID']."' and Examtype = '$type'";
                $checkQuery = mysqli_query($conn,$checkQ);
                $checkRes = mysqli_fetch_array($checkQuery);
               
                $pdf-> Cell(40,8,"",0,0,'L');
                $pdf-> Cell(90,8,$res['Sub_Code']."  ".$res['Sub_Name'],1,0,'L',true);
                $pdf-> Cell(55,8,$checkRes['Marks']." / 70",1,0,'C',true);
                $totalMarks = $totalMarks + $checkRes['Marks'];
                $total = $total + 70;
                if($checkRes['Marks'] < 23)
                {
                    $backlog = $backlog + 1;
                }
                $gp = ($checkRes['Marks']/70)*10;
                $totalGP = $totalGP + $gp;
                $pdf-> Cell(40,8,round($gp,1),1,1,'C',true);
            }
        }
        $pdf-> SetFont("Opan Sans","B",12);
        $pdf-> Cell(40,10,"",0,0,'L');
        $pdf->SetFillColor(255,193,151);
        $pdf-> Cell(90,10,"Total",1,0,'R',true);
        $pdf-> Cell(55,10,$totalMarks." / ".$total,1,0,'C',true);
        $cgpa = ($totalMarks/$total)*10;
        $pdf-> Cell(40,10,round($totalGP,1),1,1,'C',true);
        $pdf-> Cell(40,10,"",0,0,'L');
        $pdf-> Cell(145,10,"SGPA",1,0,'R',true);
        $pdf-> Cell(40,10,round($cgpa,1),1,1,'C',true);

        $pdf-> Cell(90,8,"",0,1,'L');
        $pdf-> Cell(33,8,"Total Backlog:",0,0,'L');
        $pdf-> SetFont("Opan Sans","",12);
        $pdf-> Cell(33,8,$backlog,0,1,'L');
        $pdf-> SetFont("Opan Sans","B",12);
        $pdf-> Cell(18,8,"Result:",0,0,'L');
        $pdf-> SetFont("Opan Sans","",12);
        if($backlog > 2)
        {
            $pdf-> Cell(33,8,"Not Promoted to next Semester",0,1,'L');
        }
        else
        {
            $pdf-> Cell(33,8,"Promoted to next Semester",0,1,'L');
        }

        $pdf-> Image('assets/img/result_footer.png',0,192,300,16);

        $pdf->Output($sid."_".$info['First_Name']."_"."Result.pdf",'I');
?>