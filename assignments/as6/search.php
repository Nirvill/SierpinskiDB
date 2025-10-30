
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
if (isset($_POST['search'])) {
    $search = $conn->real_escape_string($_POST['search']);
    $sql = $search ?
        "SELECT Location_Name, LID
        FROM Location1
        WHERE Location_Name LIKE '%$search%'" :

        "SELECT Location_Name, LID
        FROM Location1";
    $result = $conn->query($sql);
 
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<input type=\"radio\" id=\"" . $row['LID'] . "\" name=\"location\" value=\"". $row['LID'] . "\">";
            echo "<label for=\"". $row['LID'] ."\">" . $row['Location_Name'] ."</label><br>"
        }
    } else {
        echo "<p>No results found.</p>";
    }
}
 $conn->close();
?>