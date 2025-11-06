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
    <title>Replika Check</title>
    <link href="style.css" rel="stylesheet" type="text/css" media="all">
  </head>
  <body>
    <div class="form-check">
    <p>You have added: </p>
     <?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?> 
    <?php
     echo "<!-- POST data: " . print_r($_POST, true) . " -->";
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
          die("<p>Error: No form data submitted. Please use the form to add a Replika.</p>");
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
    
      $ReplikaArr = array("ARAR", "EULR", "KLBR", "LSTR", "MNHR", "STAR", "STCR", "SAPR", "KNCR", "ADLR", "FKLR");
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $model = $_POST['model'];
        $name = $ReplikaArr[$model - 1] . "S-23" . $_POST['code'];
        $arrival_date = $_POST['arrival_date'];
        $current_role = $_POST['current_role'];
        $clearance = $_POST['clearance'];
        $nickname = $_POST['nname'];
        }
        
      $stmt = $conn->prepare("INSERT INTO Replika (RID, Clearance, Legal_Name, Inhabits, Arrival_Date, Assigned, Reports_To, CurrentRole, M_ID, Nickname)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $rid = NULL;
      $inhabits = NULL;
      $assigned = NULL;
      $reports_to = NULL;

        $stmt->bind_param("iisisiisis", $rid, $clearance, $name, $inhabits, $arrival_date, $assigned, $reports_to, $current_role, $model, $nickname);
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