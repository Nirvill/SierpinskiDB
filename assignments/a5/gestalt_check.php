<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Insert Replika</title>
    <link href="style.css" rel="stylesheet" type="text/css" media="all">
  </head>
  <body>
    <div class="imprint">
    <p>You have added: </p>
      
    <?php
      require_once __DIR__ . '/bootstrap.php';

      // $servername = $_ENV['DB_HOST'];
      // $username = $_ENV['DB_USER'];
      // $password = $_ENV['DB_PASSWORD'];
      // $dbname = $_ENV['DB_NAME'];
        $servername = local;
      $username = $_ENV['DB_USER'];
      $password = $_ENV['DB_PASSWORD'];
      $dbname = $_ENV['DB_NAME'];

      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
    
      if (isset($_Post['submit'])) {
        $name = $_POST['fname'] . " " . $_POST['lname'];
        $gender = $_POST['gender'];
        $sentence_end = $_POST['sentence_end'];
        }
      $sql = "INSERT INTO Gestalt (GID, Legal_Name, Inhabits, End_Of_Sentence, Gender, Assigned, Reports_To)
        VALUES (, $name, NULL, $sentence_end, $gender, NULL, NULL, NULL)";

        if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
      ?>
    </div>
  </body>
</html>