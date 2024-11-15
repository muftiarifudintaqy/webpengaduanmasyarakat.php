<?php
session_start();
if (!isset($_SESSION["role"])) {
    header("location: /login.php");
}
// if ($_SESSION["role"] == "user" || $_SESSION["role"] == "") {
//     header("location: /user_page.php");
// }
// if ($_SESSION["role"] == "admin") {
//     header("location: /index.php");
// }
// Assuming $conn is the MySQLi connection instance already in global scope.

$allUsers = array();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LAPOR! | Manager Dashboard</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Oxanium:wght@200..800&family=Space+Grotesk:wght@300..700&display=swap');

        * {
            font-family: "Oxanium", sans-serif;
        }
    </style>
    <link rel="shortcut icon" href="./assets/LAPOR_SMALL.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="container my-5">
        <div class="card">
            <div class="card-header">
                <h2>Manager Dashboard</h2>
                <p>
                    <?php
                    include './helper_php/db_init.php';
                    $sql = "SELECT * FROM users";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Fetch all rows as an associative array
                        $allUsers = $result->fetch_all(MYSQLI_ASSOC);
                    }
                    ?>
                </p>
            </div>

            <div class="card-body">
                <h3>Welcome <?php echo $_SESSION["username"]; ?></h3>
                <h5>Email: <?php echo $_SESSION["email"]; ?></h5>
                <h5>Role: <?php echo $_SESSION["role"]; ?></h5>
                <a href="logout.php" class="btn btn-warning mr-2" role="button">Logout</a>

            </div>
        </div>

        <div class="card mt-5">
            <div class="card-header">
                <h4>View all user</h4>
            </div>

            <div class="card-body mb-5">
                <table class="table table-bordered text-center">
                    <div class="d-flex align-items-center justify-content-between pb-3">
                        <h4>All Users</h4>
                    </div>

                    <thead>
                        <tr class="bg-info">
                            <th scope="col">ID</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Message</th>
                            <th scope="col">DoR</th>

                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        $id = $_SESSION["id"];
                        $sql = ($_SESSION["role"] == "admin") ?
                            "SELECT reports.*, users.username FROM reports JOIN users ON users.id = reports.issuer_id;" :
                            "SELECT reports.*, users.username FROM reports JOIN users ON users.id = reports.issuer_id WHERE reports.issuer_id = $id;";
                        $result = $conn->query($sql);

                        // function test_perms($var)
// {
//   return($var["role"] != $_SESSION["role"]);
// }
                        
                        while ($row = $result->fetch_assoc()) {

                            echo "<tr>";
                            echo "<td>{$row["username"]}</td>";
                            if (empty($row["subject"])): ?>
                                <td>N/A</td>
                            <?php else: ?>
                                <td><?php echo $row["subject"]; ?></td>
                            <?php endif;
                            if (empty($row["message"])): ?>
                                <td>N/A</td>
                            <?php else: ?>
                                <td><?php echo $row["message"]; ?></td>
                            <?php endif;
                            echo "<td>{$row["date_of_reporting"]}</td>";

                        }
                        ?>

                    </tbody>
                </table>
            </div>

        </div>
    </div>
</body>

</html>