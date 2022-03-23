<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php include 'links.php'; ?>
</head>
<?php include'navbar.php'; ?>
<body style="background-color:#f6f6f6; height:100%;">
      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">

<!-- Main Content -->
<div id="content">



    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
            <h2 class="text-uppercase font-weight-bolder mt-1 mb-3 mb-0 text-gray text-center">All Product</h2>


        <!-- Content Row -->
        <div class="row align-items-center justify-content-center">
        <div class="table-responsive p-0">
        <table class="table align-items-center mb-0 text-center">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Discription</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Category</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Price</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" colspan="2">Action</th>
                    </tr>
                  </thead>
                  <tbody>
            <?php
                include "conn.php";
                $q2 = "select * from items";
                $query = mysqli_query($con,$q2);

                while($res = mysqli_fetch_array($query))
                {
                    echo
                    '
                    <tr>
                    
                        <td>'.$res['pname'].'</td>
                        <td>'.$res['description'].'</td>
                        <td>'.$res['category'].'</td>
                        <td>₹ '.$res['price'].'</td>
                        <td>
                            <a href="edit_item.php?id='.$res['id'].'" class="btn btn" style="width: 4rem;"> <i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="delete_item.php?id='.$res['id'].'" class="btn btn-denger" style="width: 4rem;"> <i class="fa-solid fa-trash"></i> </a>
                        </td>
                        
                    </tr>
                    ';
                }
                ?>

            </tbody>
            </table>
        </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>
</body>
</html>