<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include 'links.php'; ?>
</head>

<body style="background-color:#f6f6f6;">
<?php include 'navbar.php'; ?>
        <div class="row w-100 d-flex justify-content-center align-items-center" style="height:90vh;">
            <div class=" w-auto">
                    <a class="btn" href="display.php" >
                        <button class="btn btn-secondary d-flex- justify-content-center align-items-center flex-column" style="height:150px; width:170px"><i class="fa-solid fa-list fs-1 mt-4"></i> <h6 class="mt-2"> View Item </h6></button>
                    </a>
            </div>
            <div class=" w-auto">       
                    <a class="btn"  data-bs-toggle="modal" data-bs-target="#itemaddmodal">
                        <button class="btn btn-secondary d-flex- justify-content-center align-items-center flex-column" style="height:150px; width:170px"><i class="fa-solid fa-circle-plus fs-1 mt-4"></i> <h6 class="mt-2"> Add Item </h6></button>
                    </a>
            </div>
        </div>
    <!-- Button trigger modal -->
        
    <?php
        if(isset($_POST['insertdata']))
        {
            $q="insert into items set
            pname='".$_REQUEST['pname']."',
            description='".$_REQUEST['description']."',
            price='".$_REQUEST['price']."',
            category='".$_REQUEST['category']."'
            ";
            $resp = mysqli_query($con,$q);
            if($resp)
            {
                header('Location: index.php');
            }
        }
    ?>

        <!-- Modal -->
        <div class="modal fade" id="itemaddmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="qUerys.php" method="post">
                <div class="modal-body">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="itemname" name="pname" placeholder="Item Name" required>
                            <label for="floatingInput">Item Name</label>
                        </div>
                        <div class="form-floating mb-3">
                            
                            <input type="text" class="form-control" id="itemdesc" name="description" placeholder="Item Description" required>
                            <label for="floatingInput">Item Description</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="number" class="form-control" id="price" name="price" placeholder="Price" required >
                            <label for="floatingInput">Price</label>
                        </div>
                        <div class="form-floating mb-3">
                            <select name="category" class="form-control " required> 
                                <option value="" selected >Select Category</option>
                                <option value="Main Course">Main Course</option>
                                <option value="Appetizer">Appetizer</option>
                                <option value="Beverages">Beverages</option>
                                <option value="Snack">Snack</option>
                            </select>
                            <label for="floatingInput">Category</label>
                        </div> 
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="insertdata" class="btn btn-primary">Add</button>
                </div>
            </form>
            </div>
        </div>
        </div>
</body>
</html>