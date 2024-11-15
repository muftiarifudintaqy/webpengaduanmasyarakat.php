<?php 
include './helper_php/db_init.php';

session_start();
if (!isset($_SESSION["loggedin"])) {
    header("location: /index.php");
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $subject = mysqli_real_escape_string($conn, trim($_POST["subject"])) ?? "";
  $message = mysqli_real_escape_string($conn, trim($_POST["message"])) ?? "";
  $email = $_SESSION["email"] ?? "";
  $id = $_SESSION["id"] ?? "";
  $subjectErrorMassage = "";
  $messageErrorMassage = "";

  if (empty($subject)) {
    $subjectErrorMassage = "subject required";
  }
  if (empty($message)) {
    $messageErrorMassage = "message required";
  }

  if (empty($subjectErrorMassage) && empty($messageErrorMassage)) {
    $sql = "INSERT INTO reports (issuer_id, subject, message)
    VALUES ($id, '$subject', '$message')";

    echo "$sql";

    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
      header("location: /index.php");
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
  }
}
?>