<?php
session_start();
 
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // User is NOT logged in → redirect to login page
    header("Location: home.php");
    exit;
}
?>
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
if (isset($_POST['clearance'])) {
    $clearanceLevel = $conn->real_escape_string($_POST['clearance']);
    $sql = $clearanceLevel ?
        "SELECT Legal_Name, RID, Clearance, Assigned
        FROM Replika
        WHERE Clearance = $clearanceLevel AND Assigned = NULL":

        "SELECT Legal_Name, RID, Clearance
        FROM Replika
        WHERE Assigned = NULL";
    $result = $conn->query($sql);
 
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td><a href=\"search_result.php?RID=" . urlencode($row['RID']) . "\">" . $row['Legal_Name'] . "</a></td></tr>";
        }
    } else {
        echo "<tr><td colspan='1'>No results found.</td></tr>";
    }
}
 $conn->close();
?>