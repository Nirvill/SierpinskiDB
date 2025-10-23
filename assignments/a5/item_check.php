<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Insert Replika</title>
    <link href="style.css" rel="stylesheet" type="text/css" media="all">
  </head>
  <body>
    <div class="form-check">
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
        $iname = $_POST['iname'];
        $idesc = $_POST['idesc'];
        }
      $sql = "INSERT INTO Item (IID, Name, Item_Description, LID)
        VALUES (, $iname, $idesc, NULL)";

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