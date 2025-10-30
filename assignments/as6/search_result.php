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
                    $LID = $_GET['LID'];
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
                $stmt->bind_param("ii", $LID, $LID);
                $stmt->execute();
                $stmt->store_result();
                while ($row = mysqli_fetch_array($stmt)) {
                    echo $row['Name'];
                }
                ?>
            </tbody>
        </table>


    </div>
</body>

</html>