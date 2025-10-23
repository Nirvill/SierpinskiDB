<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Inserted Report</title>
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
        $rid = $_POST['rid'];
        $tid = $_POST['tid'];
        $report = $_POST['report'];
        }
        
      $stmt = $conn->prepare("INSERT INTO Report (RID, TID, Report_Contents, Report_Date)
        VALUES (?, ?, ?, ?)");
      $rdate = date('Y-m-d H:i:s', time());


$stmt->bind_param("iiss", $rid, $tid, $report, $rdate);
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