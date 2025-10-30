
//live-search/search.php
 
<?php
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
echo "<tr><td colspan='1'>balls1</td></tr>";
if (isset($_POST['search'])) {
    $search = $conn->real_escape_string($_POST['search']);
    $sql = $search ?
        "SELECT Location_Name
        FROM Location1
        WHERE Location_Name LIKE '%$search%'" :

        "SELECT Location_Name
        FROM Location1";
    $result = $conn->query($sql);
 
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row['Location_Name'] . "</td></tr>";
        }
    } else {
        echo "<tr><td colspan='1'>No results found.</td></tr>";
    }
    echo "<tr><td colspan='1'>balls</td></tr>";
}
 $conn->close();
?>