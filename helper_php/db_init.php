<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "idn_bss_xrpl_s1_reporting_website";

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  echo "Connected successfully";
?>