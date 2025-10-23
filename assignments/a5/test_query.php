<!DOCTYPE html>
<html>
<head>
    <title>Test Form</title>
</head>
<body>
    <h1>Test Form Submission</h1>
    <form action="replika_check.php" method="post">
        <input type="text" name="test_field" value="test_value" required>
        <input type="submit" value="Test Submit">
    </form>
    
    <p>Current directory: <?php echo __DIR__; ?></p>
    <p>replika_check.php exists: <?php echo file_exists('replika_check.php') ? 'YES' : 'NO'; ?></p>
</body>
</html>