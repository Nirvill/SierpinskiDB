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
    <title>Search Results</title>
    <link href="style.css" rel="stylesheet" type="text/css" media="all">
</head>

<body>
    <div class="form-check">
        <h1>Search Result:</h1>
        <table id="result">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Clearance</th>
                </tr>
            </thead>
            <tbody>
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

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $clearance = isset($_POST['clearance']) ? intval($_POST['clearance']) : 0;
                }

                $stmt = $conn->prepare("SELECT Legal_Name, RID, Clearance, Assigned
        FROM Replika
        WHERE Clearance = ? AND Assigned IS NULL;"
                );
                $stmt->bind_param("i", $clearance);
                $stmt->execute();
                $stmt->bind_result($name, $rid, $gclearance, $ass);
                $hasrows = false;
                while ($stmt->fetch()) {
                    $hasrows = true;
                    echo "<tr>
                        <td>" . htmlspecialchars($name) . "</td>
                        <td>" . htmlspecialchars($gclearance) . "</td>
                      </tr>";
                }
                if (!$hasrows) {
                    echo "<tr><td colspan='3'>No results found.</td></tr>";
                }
                ?>
            </tbody>
        </table>


    </div>
</body>

</html>