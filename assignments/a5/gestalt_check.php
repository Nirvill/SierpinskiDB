<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Gestalt Check</title>
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
        $name = $_POST['fname'] . " " . $_POST['lname'];
        $gender = $_POST['gender'];
        $sentence_end = $_POST['sentence_end'];
        }
        
      $stmt = $conn->prepare("INSERT INTO Gestalt (GID, Legal_Name, Inhabits, End_Of_Sentence, Gender, Assigned, Reports_To)
        VALUES (?, ?, ?, ?, ?, ?, ?)");
      $gid = NULL;
      $inhabits = NULL;
      $assigned = NULL;
      $reports_to = NULL;
      // Debug: Check what we're about to bind
echo "<!-- Debug: name='$name', gender='$gender', sentence_end='$sentence_end' -->";
echo "<!-- Debug: bind_param types: issssii (7 chars for 7 params) -->";
echo "<!-- Debug: gid=$gid, inhabits=$inhabits, assigned=$assigned, reports_to=$reports_to -->";

$stmt->bind_param("issssii", $gid, $name, $inhabits, $sentence_end, $gender, $assigned, $reports_to);
      $stmt->bind_param(issssii, $gid ,$name, $inhabits, $sentence_end, $gender, $assigned, $reports_to);
      // $sql = "INSERT INTO Gestalt (GID, Legal_Name, Inhabits, End_Of_Sentence, Gender, Assigned, Reports_To)
      //   VALUES (, $name, NULL, $sentence_end, $gender, NULL, NULL, NULL)";
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