<?php
    include 'Connection.php';
    
    $q = " SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='proline' AND `TABLE_NAME`='stud_details'";
    $query = mysqli_query($conn,$q);

    while($res = mysqli_fetch_array($query))
    {
        echo '
        <div class="form-check me-4">
            <input class="form-check-input" type="checkbox" value="'.$res['COLUMN_NAME'].'" name="'.$res['COLUMN_NAME'].'" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
            '.$res['COLUMN_NAME'].'
            </label>
        </div>  
        ';
    }
?>