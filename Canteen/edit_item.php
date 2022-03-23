<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include 'links.php' ?>
</head>

<body style="background-color:#f6f6f6; height:100%;">
<?php include'navbar.php'; ?>
<?php

    include 'conn.php';
       
    $id=$_GET['id'];
    $q1="select * from items where id=$id";
    $query1=mysqli_query($con,$q1);
    $res=mysqli_fetch_array($query1);
?>
<?php
 if(isset($_POST['submit']))
    {
        $q="update items set
        pname='".$_REQUEST['pname']."',
        description='".$_REQUEST['description']."',
        price='".$_REQUEST['price']."',
        category='".$_REQUEST['category']."'
        where id=$id
        ";
        $resp = mysqli_query($con,$q);
        if($resp)
                            {
                                
                                echo "<script>";
                                    echo ("location.href='setting.php'");
                                echo "</script>";
                            }
                            else
                            {
                                echo "ERROR ERROR";
                            }   
    }
?>
<div class="container-sm">

<div class="card o-hidden border-0 shadow-lg my-5" >
    <div class="card-body p-0">
        <div class="row">
         <div class="col-lg-5 d-none d-lg-block bg-register-image"><img src="photo1.jpg" class="article-bg" height="100%" width="110%" ></div>
            <div class="col-lg-7">
                <div class="p-5">
                    <div class="text-center">
                        <h1 class="h4 text-gray-900 mb-4">Edit Item</h1>
                    </div>
                    
                    <form method="POST" class="user" >
                        <div class="form-floating mb-3 col-12">
                                <input type="text" class="form-control form-control-user" value="<?php echo $res['pname'] ?>" name="pname" id="productname"
                                    placeholder="Product name" name="productname" autocomplete="off" required>
                                    <label for="floatingInput">Product Name</label>
                        </div>
                        <div class="form-floating mb-3 col-12">
                            <input type="text" class="form-control form-control-user" id="description" name="description" value="<?php echo $res['description'] ?>"
                                placeholder="Description" name="description" autocomplete="off" required>
                                <label for="floatingInput">Description</label>
                        </div>
                        <div class="form-floating mb-3 col-12">
                            <input type="number" class="form-control form-control-user" value="<?php echo $res['price'] ?>"
                                id="price" placeholder="Price" name="price" autocomplete="off" required>
                            <label for="floatingInput">Price</label>
                        </div>
                            <div class="form-floating mb-3 col-12">
                                <select name="category" class="form-control  " >
                                <option value="Main Course" <?php if($res['category'] == 'Main Course') echo 'selected'?> >Main Course</option>
                                <option value="Appetizer" <?php if($res['category'] == 'Appetizer') echo 'selected'?> >Appetizer</option>
                                <option value="Beverages" <?php if($res['category'] == 'Beverages') echo 'selected'?> >Beverages</option>
                                <option value="Snack" <?php if($res['category'] == 'Snack') echo 'selected'?> >Snack</option>
                                </select>
                                <label for="floatingInput">Category</label>
                            </div>
                        </div>
                        <div class="col-12">
                            <input type="submit" value="save" class="btn btn-primary w-100" name="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>
</div>

</div>

</body>
</html>