<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Search Results</title>
    <link href="style.css" rel="stylesheet" type="text/css" media="all">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
</head>

<body>
    <div class="form-check">
        <h1>Search Result:</h1>
        <table id="result">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Location</th>
                </tr>
            </thead>
            <tbody>
                <?php
                 echo '<tr>balls</tr>';
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

                if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo "<tr><td colspan='3'>DEBUG: \$_GET = " . htmlspecialchars(json_encode($_GET)) . "</td></tr>";
    $LID = isset($_GET['LID']) ? intval($_GET['LID']) : 0;
    echo "<tr><td colspan='3'>DEBUG: LID = " . htmlspecialchars($LID) . "</td></tr>";
}

                $stmt = $conn->prepare("SELECT R.Legal_Name AS Name, 'Replika' AS Type, L.Location_Name AS Location
    FROM Replika R
    INNER JOIN Location1 L ON R.Inhabits = L.LID
        WHERE L.LID = ?

UNION ALL

SELECT G.Legal_Name AS Name, 'Gestalt' AS Type, L.Location_Name As Location
    FROM Gestalt G 
    INNER JOIN Location1 L ON G.Inhabits = L.LID
        WHERE L.LID = ?
ORDER BY Name;"
                );
                 echo '<tr>balls</tr>';
                $stmt->bind_param("ii", $LID, $LID);
                $stmt->execute();
                $stmt->bind_result($name,$type, $location);
                $hasrows= false;
                while ($stmt->fetch()) {
                    $hasrows = true;
                    echo "<tr>
                        <td>" . htmlspecialchars($name) . "</td>
                        <td>" . htmlspecialchars($type) . "</td>
                        <td>" . htmlspecialchars($location) . "</td>
                      </tr>";
                } if (!$hasrows) {
                echo "<tr><td colspan='3'>No results found.</td></tr>";
                }
                ?>
            </tbody>
        </table>


    </div>
</body>

</html>