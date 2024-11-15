<?php

session_start();

if (!isset($_SESSION["email"])) {
    header("location: /login.php");
} else if ($_SESSION["role"] == "user" || $_SESSION["role"] == "") {
    header("location: /user_page.php");
} else if ($_SESSION["role"] == "manager") {
    header("location: /managerpage.php");
}
include './helper_php/db_init.php';

if (isset($_GET['id'])) {
    // Assuming $conn is the MySQLi connection instance already in global scope

    $editUserId = $_GET['id'];
    $isFound = false;

    if (!empty($editUserId)) {
        // Fetch the user data for the given ID
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $editUserId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $isFound = true;
        } else {
            echo "User not found";
        }

        $stmt->close();
    }

    // If a POST request is detected, proceed with updating the role
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $isFound) {
        $selectedRole = trim($_POST["role"]);

        // Update the user role in the database
        $sql = "UPDATE users SET role = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $selectedRole, $editUserId);

        if ($stmt->execute()) {
            // Redirect to the user management page upon successful update
            header("Location: /user_management.php");
            exit;
        } else {
            echo "Error updating role: " . $stmt->error;
        }

        $stmt->close();
    }

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
<body style="background:#008080;">
    <div class="container d-flex flex-column align-items-center justify-content-center w-50" style="height:100vh">
    <h1 class="font-weight-bold mb-5 ">Update User Role</h1>
    <form action="" method="POST" class="w-100">

  <div class="form-group">
    <input type="text" disabled class="form-control" style="color:#B8B8B8;" value="<?php if (isset($user["username"])) {
    echo $user["username"];
}
?>">
</div>
<div class="form-group">
    <input type="text" disabled class="form-control" style="color:#B8B8B8;" value="<?php if (isset($user["email"])) {
    echo $user["email"];
}
?>">
</div>

<div class="form-group">
<select class="form-select"  name="role" >
      <option value="admin" >Admin</option>
      <option value="manager">Manager</option>
      <option value="user" selected >User</option>
    </select>
</div>


  <button type="submit" class="btn btn-primary my-2">Update User</button>
  <a href="user_management.php" class="btn btn-warning ml-2" role="button">back</a>

</form>

    </div>
</body>
</body>
</html>