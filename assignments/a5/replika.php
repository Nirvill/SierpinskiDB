<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Insert Replika</title>
    <link href="style.css" rel="stylesheet" type="text/css" media="all">
  </head>
  <body>
    <div class="imprint">
    <h1>Insert a Replika<h1>
    <form action="/replika_check.php">
     
    <?php
      require_once __DIR__ . '../project/bootstrap.php';
 
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
    </div>
  </body>
</html>