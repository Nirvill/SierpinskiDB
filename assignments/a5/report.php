<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Add a report</title>
    <link href="style.css" rel="stylesheet" type="text/css" media="all">
  </head>
  <body>
    <div class="form-check">
        <h1>Submit a report</h1>
        <form action="gestalt_check.php" method="post">
            <label for="fname">First name:</label><br>
            <input type="text" id="fname" name="fname"><br>
            <label for="lname">Last name:</label><br>
            <input type="text" id="lname" name="lname"><br>
            <p>Gender: </p>
            <input type="radio" id="female" name="gender" value="Female">
            <label for="female">Female</label><br>
            <input type="radio" id="male" name="gender" value="Male">
            <label for="male">Male</label><br><br>
            <label for="sentence_end">End of Sentence:</label>
            <input type="date" id="sentence_end" name="sentence_end">
            <input type="submit" value="Submit">
            <input type="reset" value="Reset">
        </form> 
    </div>
  </body>
</html>