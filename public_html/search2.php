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
    <title>Search Form</title>
    <link href="style.css" rel="stylesheet" type="text/css" media="all">
  </head>
  <body>
    
    <div class="form-check">
        <h1>Query 2: Find all unassigned workers with a certain clearance level</h1>
        <form action="search_result2.php" method="post">
            <input type="range" name="clearance" min="1" max="3" value="1">
            <input type="submit" value="submit">
        </form>
    </div>
  </body>
</html>