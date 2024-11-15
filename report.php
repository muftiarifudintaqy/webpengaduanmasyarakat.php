<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
      @import url('https://fonts.googleapis.com/css2?family=Oxanium:wght@200..800&family=Space+Grotesk:wght@300..700&display=swap');
      * {
        font-family: "Oxanium", sans-serif;
      }
    </style>
    <link rel="shortcut icon" href="./assets/LAPOR_SMALL.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
  <title>LAPOR! | Make a Report!</title>
</head>
<body>
<div class="container d-flex flex-column align-items-center w-50" style="height:100vh;  margin-top: 10rem;">
    <h1 class="font-weight-bold mb-5 ">Make a Report</h1>
    <p><?php
require_once "./helper_php/report_post.php";
?></p>
    <form action="" method="POST" class="w-100">
  <div class="form-group">
    <label  class="font-weight-bold">Subject</label>
    <input type="text" class="form-control" name="subject" placeholder="Enter report subject">
    <p style="color:#ffe847;font-weight:600;text-shadow:none">
    <?php if (!empty($subjectErrorMassage)) {
    echo $subjectErrorMassage;}?>
    </p>
    <label class="font-weight-bold mt-1">Message</label>
    <textarea class="form-control" name="message" placeholder="Enter report message">
    </textarea>
    <p style="color:#ffe847;font-weight:600;text-shadow:none">
    <?php if (!empty($messageErrorMassage)) {
    echo $messageErrorMassage;}?>
    </p>

      <button type="submit" class="btn btn-primary my-2">Submit</button>
  </div>
  </div>
  </div>
  <div class="demo-preview">
        <div class="progress progress-lg progress-striped active">
            <div role="progressbar progress-striped" style="width: 100%;" class="progress-bar progress-bar-danger">
            </div>
        </div>
    </div>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>