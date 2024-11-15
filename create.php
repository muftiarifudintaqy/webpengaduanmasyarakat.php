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

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Assuming $conn is the MySQLi connection instance already in global scope

    // Retrieve and sanitize input
    $username = trim($_POST["username"]) ?? "";
    $email = trim($_POST["email"]) ?? "";
    $password = trim($_POST["password"]) ?? "";
    $role = trim($_POST["role"]) ?? "";

    $emailErrorMassage = "";
    $passwordErrorMassage = "";
    $usernameErrorMassage = "";

    // Input validation
    if (empty($email)) {
        $emailErrorMassage = "Email required";
    }
    if (empty($password)) {
        $passwordErrorMassage = "Password required";
    } elseif (strlen($password) < 6) {
        $passwordErrorMassage = "Password should be a minimum of 6 characters";
    }
    if (empty($username)) {
        $usernameErrorMassage = "Username required";
    }

    // Check for duplicate email in the database
    $isDuplicate = false;
    if (empty($emailErrorMassage) && empty($passwordErrorMassage) && empty($usernameErrorMassage)) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $isDuplicate = true;
            $emailErrorMassage = "Email already exists";
        }

        $stmt->close();
    }

    // Proceed with registration if no errors
    if (!$isDuplicate && empty($emailErrorMassage) && empty($passwordErrorMassage) && empty($usernameErrorMassage)) {
        $hashedPassword = sha1($password); // Ideally, use password_hash() for stronger security

        $sql = "INSERT INTO users (username, email, pw_hash, role) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $username, $email, $hashedPassword, $role);

        if ($stmt->execute()) {
            // Redirect to the user management page on success
            header("Location: /user_management.php");
            exit;
        } else {
            echo "Error: " . $stmt->error;
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
    <title>Create User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body style="background:#008080;">
    <div class="container d-flex flex-column align-items-center justify-content-center w-50" style="height:100vh">
    <h1 class="font-weight-bold mb-5 ">Create User By Admin </h1>
    <form action="" method="POST" class="w-100">

  <div class="form-group">
    <input type="text" class="form-control" name="username" placeholder="Enter username">
    <p style="color:#ffe847; font-weight:600;text-shadow:none">
    <?php if (!empty($usernameErrorMassage)) {
    echo $usernameErrorMassage;}?>
  </p>
</div>
  <div class="form-group">
    <input type="email" class="form-control" name="email" placeholder="Enter email">
    <p style="color:#ffe847;font-weight:600;text-shadow:none">
    <?php if (!empty($emailErrorMassage)) {
    echo $emailErrorMassage;}?>
  </p>
    </div>
  <div class="form-group">
    <input type="password" class="form-control" name="password" placeholder="Password">
    <p style="color:#ffe847;font-weight:600;text-shadow:none">
    <?php if (!empty($passwordErrorMassage)) {
    echo $passwordErrorMassage;}?>
  </p>
  </div>

  <div class="form-group">
<select class="form-select"  name="role" >
      <option value="admin" >Admin</option>
      <option value="manager">Manager</option>
      <option value="user" selected >User</option>
    </select>
</div>

  <button type="submit" class="btn btn-primary my-2">Create User</button>
  <a href="user_management.php" class="btn btn-warning ml-2" role="button">back</a>
</form>

    </div>


<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>