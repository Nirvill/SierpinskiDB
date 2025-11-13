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
    <title>Add Task</title>
    <link href="style.css" rel="stylesheet" type="text/css" media="all">
  </head>
  <body>
    <div class="form-check">
    <h1>Insert a Task</h1>
    <form action="task_check.php" method="post">
        <label for="clearance">Clearance: </label><br>
        <input type="range" id="clearance" name="clearance" min="0" max="3"><br>
        <label for="urgency">Urgency: </label><br>
        <input type="range" id="urgency" name="urgency" min="0" max="3"><br>
        <label for="request_date">Date of Request:</label>
        <input type="date" id="request_date" name="request_date">
        <p>Status: </p>
            <input type="radio" id="unassigned" name="status" value="Unassigned">
            <label for="unassigned">Unassigned</label><br>
            <input type="radio" id="closed" name="status" value="Closed">
            <label for="closed">Closed</label><br>
            <input type="radio" id="resolved" name="status" value="Resolved">
            <label for="resolved">Resolved</label><br>
            <input type="radio" id="declined" name="status" value="Declined">
            <label for="declined">Declined</label><br>
            <input type="radio" id="pending" name="status" value="Pending">
            <label for="pending">Pending</label><br><br>
        <input type="submit" value="Submit">
        <input type="reset" value="Reset">
    </form> 
    </div>
  </body>
</html>