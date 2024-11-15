<?php
session_start();
include './helper_php/db_init.php';

if (isset($_SESSION["email"])) {
    header("location: /index.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["email"]) && isset($_POST["password"])) {
        $email = trim($_POST["email"]) ?? "";
        $password = sha1(trim($_POST["password"])) ?? "";
        $emailErrorMassage = "";
        $passwordErrorMassage = "";
        $errorMassage = "";

        if (empty($email)) {
            $emailErrorMassage = "email required";
        }
        if (empty($password)) {
            $passwordErrorMassage = "password required";
        }

        // Assuming $conn is the MySQLi connection instance already in global scope.

        // Prepare the SQL statement to check for matching email and password
        $sql = "SELECT * FROM users WHERE email = ? AND pw_hash = ?";
        $stmt = $conn->prepare($sql);

        // Hash the password for comparison (if stored as SHA-1 in the database)

        $stmt->bind_param("ss", $email, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            $_SESSION["loggedin"] = true;
            $_SESSION["email"] = $user["email"];
            $_SESSION["role"] = $user["role"];
            $_SESSION["username"] = $user["username"];
            $_SESSION["id"] = $user["id"];

            // Redirect to the index page on successful login
            header("Location: /index.php");
            exit;
        } else {
            $_SESSION["loggedin"] = false;
            $emailErrorMassage = "";
            $passwordErrorMassage = "Email and password do not match";
        }

        // Clean up the statement
        $stmt->close();

    }
}