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
    <script> 
        function load()
        {
            loadStudentCheckbox();
            loadStaffCheckbox();
        }
    </script>
</head>

<body class="g-sidenav-show   bg-gray-100" onload="load()">
    <?php include 'includes/side-navbar.php' ?>
  <main class="main-content position-relative border-radius-lg ">
    <?php include 'includes/top-navbar.php' ?>
    <div class="container-fluid py-1">
      <?php include 'exportStudentDetails.php'; ?>
    </div>
    <div class="container-fluid py-1">
      <?php include 'exportStaffDetails.php'; ?>
    </div>
    <!-- <div class="container-fluid py-1">
      <?php include 'exportStudentResult.php'; ?>
    </div> -->
  </main>
  <?php include 'includes/script.php'?>
  <?php include 'includes/footer.php'?>
    <script>

    </script>
</body>
</html>