<?php
session_start();
if (!isset($_SESSION["role"])) {
    header("location: /login.php");
}

if ($_SESSION["role"] == "admin") {
    header("location: /index.php");
}
if ($_SESSION["role"] == "manager") {
    header("location:/managerpage.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAPOR! | User Page</title>
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Oxanium:wght@200..800&family=Space+Grotesk:wght@300..700&display=swap');
      * {
        font-family: "Oxanium", sans-serif;
      }
    </style>
    <link rel="shortcut icon" href="./assets/LAPOR_SMALL.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="container my-5">
        <div class="card">
            <div class="card-header">
                <h2>User Dashboard</h2>
            </div>

            <div class="card-body">
                <h3>Welcome <?php echo $_SESSION["username"]; ?></h3>
                <h5>Email: <?php echo $_SESSION["email"]; ?></h5>
                <h5>Role: <?php echo !empty($_SESSION["role"]) ? $_SESSION["role"] : "N/A"; ?> </h5>
                <a href="logout.php" class="btn btn-danger mr-2" role="button">Logout</a>
                <a href="reports_list.php" class="btn btn-warning mr-2" role="button">See my reports</a>
                <a href="report.php" class="btn btn-warning mr-2" role="button">Make a report</a>
            </div>
        </div>
        </div>
    </div>


    <div class="demo-preview">
        <div class="progress progress-lg progress-striped active">
            <div role="progressbar progress-striped" style="width: 100%;" class="progress-bar progress-bar-danger">
            </div>
        </div>
    </div>
</body>
</html>