<?php

session_start();
if (isset($_SESSION["email"])) {
    header("location: /index.php");
}
include './helper_php/db_init.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = trim($_POST["username"]) ?? "";
    $email = trim($_POST["email"]) ?? "";
    $password = sha1(trim($_POST["password"])) ?? "";
    $emailErrorMassage = "";
    $passwordErrorMassage = "";
    $usernameErrorMassage = "";
    $errorMassage = "";

    if (empty($email)) {
        $emailErrorMassage = "email required";
    }
    if (empty($password)) {
        $passwordErrorMassage = "password required";
    }
    if (strlen($password) < 6) {
        $passwordErrorMassage = "password should be minimum of 6 character";
    }

    if (empty($username)) {
        $usernameErrorMassage = "username required";
    }

    // Check if email already exists in the database
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $isDuplicate = true;
        $emailErrorMassage = "Email already exists";
    } else {
        $isDuplicate = false;
    }

    $stmt->close();

    // Proceed with registration if no errors
    if (empty($emailErrorMassage) && empty($passwordErrorMassage) && empty($usernameErrorMassage) && strlen($password) >= 6 && !$isDuplicate) {
        $sql = "INSERT INTO users (username, email, pw_hash, role) VALUES (?, ?, ?, '')";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $username, $email, $password);

        if ($stmt->execute()) {
            // Redirect on success
            header("Location: /index.php");
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $emailErrorMassage = "Email already exists";
    }


}