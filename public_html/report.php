<?php
session_start();
 
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // User is NOT logged in → redirect to login page
    header("Location: home.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Add a report</title>
    <link href="style.css" rel="stylesheet" type="text/css" media="all">
  </head>
  <body>
    <div class="form-check">
        <h1>Submit a report</h1>
        <form action="report_check.php" method="post">
            <label for="rid">Replika ID</label><br>
            <input type="text" id="rid" name="rid"><br>
            <label for="tid">Task ID</label><br>
            <input type="text" id="tid" name="tid"><br>
            <p>Contents: </p>
            <textarea id="textarea" name="report" rows="4" cols="50">Enter your report here</textarea><br>
            <input type="submit" value="Submit">
            <input type="reset" value="Reset">
        </form> 
    </div>
  </body>
</html>