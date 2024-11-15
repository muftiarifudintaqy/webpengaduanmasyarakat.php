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

    $deleteUserId = $_GET['id'];

    // Check if the user ID is set and valid
    if (!empty($deleteUserId)) {
        // Prepare the SQL statement to delete the user by ID
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $deleteUserId);

        if ($stmt->execute()) {
            // Redirect to the user management page on successful deletion
            header("Location: /user_management.php");
            exit;
        } else {
            echo "Error deleting user: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "User ID not found";
    }

}