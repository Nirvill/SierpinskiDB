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
    <title>Inhabits relation</title>
    <link href="style.css" rel="stylesheet" type="text/css" media="all">
  </head>
  <body>
    <div class="form-check">
        <h1>Assign a person to a living space</h1>
        <form action="gestalt_check.php" method="post">
            <input id="search" type="text" placeholder="Search here"></input>
            <input id="submit" type="submit" value="Search">
        </form> 
    </div>
  </body>
</html>