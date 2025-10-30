<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Task Check</title>
    <link href="style.css" rel="stylesheet" type="text/css" media="all">
  </head>
  <body>
    <div class="form-check">
    <p>You have added: </p>
      
    <?php
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
          die("<p>Error: No form data submitted. Please use the form to add a Gestalt.</p>");
      }
      $config = require __DIR__ . '/../project/bootstrap.php';
 
      $servername = $config['DB_HOST'];
      $username = $config['DB_USER']; 
      $password = $config['DB_PASSWORD'];
      $dbname = $config['DB_NAME'];

      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
    
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $clearance = $_POST['clearance'];
        $urgency = $_POST['urgency'];
        $request_date = $_POST['request_date'];
        $status = $_POST['status'];
        }
      echo '<tr>balls</tr>';
      $stmt = $conn->prepare("INSERT INTO TASK1 (TID, LID, Clearance, Request_Date, Urgency, TASK1_Status, Requested_By)
        VALUES (?, ?, ?, ?, ?, ?, ?)");
      $tid = NULL;
      $lid = NULL;
      $requested_by = NULL;

$stmt->bind_param("iiisisi", $tid, $lid, $clearance, $request_date, $urgency, $status, $requested_by);
      //nuh-uh, no sql injections
        if ($stmt->execute() === TRUE) {
        echo "New record created successfully";
        } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
      ?>
    </div>
  </body>
</html>