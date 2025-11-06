<!DOCTYPE html>
<html>
  <head>
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
        $login = $_POST['login'];
        $pass = $_POST['pass'];
        }
 
        $stmt = $conn->prepare("SELECT Pass, Clearance FROM User WHERE LOGIN = ?");
        $stmt->bind_param("s", $login);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $dbPasswordHash = $row['Pass'];
            $clearance = $row['Clearance'];
            if (password_verify($password, $dbPasswordHash)) {
            session_start();
            $_SESSION['user_clearance'] = $clearance;
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $login;
            header("Location: maintenance.php");
            }
            else {
              $passFailed = true;
            }
        }
    ?>
    <meta charset="UTF-8">
    <title>Home</title>
    <link href="style.css" rel="stylesheet" type="text/css" media="all">
  </head>
  <body>
    <img src="aeon.png" style="width: 15vh; top: 1vh; left: 3vh; position: absolute;">
    <div class="log-in">
        <img src="sierpinski.png" style="width: 40vh;">
        <h1>S-23 Sierpinski Worker Database</h1>
          <form method="post" action="home.php">
            Username: <input type="text" name="name"><br><br>
            Password: <input type="text" name="name"><input type="submit" value=">> LOG IN  ">
          </form>
          <?php if($passFailed) {
            echo "<p>Log in failed. Try again</p>"
          }?>
    <p>For testing purposes click on any of the links to view their respective page</p>
    <list>
        <ul><a href="clearance1.html">clearance1 - the default user page</a></ul>
        <ul><a href="clearance2.html">clearance2 - has access to some admin regarding tasks they are assigned to</a></ul>
        <ul><a href="clearance3.html">clearance3 - admin user</a></ul>
    </list>
    <a href="imprint.html" id="DISCLAIMER">DISCLAIMER</a>
    </div>
  </body>
</html>