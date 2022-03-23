<?php
    include 'Connection.php';
    
    $sq = " SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE `TABLE_SCHEMA`='proline' AND `TABLE_NAME`='staff_details'";
    $squery = mysqli_query($conn,$sq);

    while($sres = mysqli_fetch_array($squery))
    {
        echo '
        <div class="form-check me-4">
            <input class="form-check-input" type="checkbox" value="'.$sres['COLUMN_NAME'].'" name="'.$sres['COLUMN_NAME'].'" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
            '.$sres['COLUMN_NAME'].'
            </label>
        </div>  
        ';
    }
?>