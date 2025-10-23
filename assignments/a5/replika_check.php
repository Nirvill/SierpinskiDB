<?php
      $config = require __DIR__ . '/../project/bootstrap.php';
 
      $servername = $config['DB_HOST'];
      $username = $config['DB_USER']; 
      $password = $config['DB_PASSWORD'];
      $dbname = $config['DB_NAME'];
$conn = new mysqli($servername, $username, $password, $dbname);
?>