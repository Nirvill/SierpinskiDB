
//live-search/search.php
 
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
 
if (isset($_POST['search'])) {
    $search = $conn->real_escape_string($_POST['search']);
    $sql = $search ?
        "SELECT R.Legal_Name AS Name, 'Replika' AS Type, L.Location_Name AS Location
        FROM Replika R
        INNER JOIN Location1 L ON R.Inhabits = L.LID
        WHERE L.Location_Name LIKE '%$search%' -- searchstring instead
 
        UNION ALL
 
        SELECT G.Legal_Name AS Name, 'Gestalt' AS Type, L.Location_Name As Location
        FROM Gestalt G
        INNER JOIN Location1 L ON G.Inhabits = L.LID
        WHERE L.Location_Name LIKE ''%$search%' -- searchstring instead
        ORDER BY Name" :
        "SELECT R.Legal_Name AS Name, 'Replika' AS Type, L.Location_Name AS Location
        FROM Replika R
        INNER JOIN Location1 L ON R.Inhabits = L.LID
        WHERE L.Location_Name -- searchstring instead
 
        UNION ALL
 
        SELECT G.Legal_Name AS Name, 'Gestalt' AS Type, L.Location_Name As Location
        FROM Gestalt G
        INNER JOIN Location1 L ON G.Inhabits = L.LID
        WHERE L.Location_Name -- searchstring instead
        ORDER BY Name";
    $result = $conn->query($sql);
 
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row['Name'] . "</td></tr>";
        }
    } else {
        echo "<tr><td colspan='1'>No results found.</td></tr>";
    }
}
 