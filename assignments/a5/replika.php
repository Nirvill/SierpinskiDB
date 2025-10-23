<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Insert Replika</title>
    <link href="style.css" rel="stylesheet" type="text/css" media="all">
  </head>
  <body>
    <h1>Insert a Replika<h1>
    <form action="/replika_check.php">
      
    <?php
      require_once __DIR__ . '/bootstrap.php';

      $servername = $_ENV['DB_HOST'];
      $username = $_ENV['DB_USER'];
      $password = $_ENV['DB_PASSWORD'];
      $dbname = $_ENV['DB_NAME'];

      // Create connection
      $conn = new mysqli($servername, $username, $password, $dbname);
      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
    
      $sql = "SELECT Model_Code FROM Models";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
              echo "<input type=\"radio\" id=\"". $row["Model_Code"]."\" name=\"Model\" value=\"".$row["Model_Code"]."\">";
              echo "<label for=\"". $row["Model_Code"]. "\">". $row["Model_Code"]."</label><br>";
          }
      } else {
          echo "0 results";
      }

      $conn->close();
      ?>
  </body>
</html>