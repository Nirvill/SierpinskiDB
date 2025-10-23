<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Insert Item</title>
    <link href="style.css" rel="stylesheet" type="text/css" media="all">
  </head>
  <body>
    <div class="form-check">
    <h1>Insert an Item<h1>
    <form action="item_check.php" method="post">
        <label for="iname">Item name:</label><br>
        <input type="text" id="iname" name="iname"><br>
        <label for="idesc">Last name:</label><br>
        <input type="text" id="idesc" name="idesc"><br>
        <input type="submit" value="Submit">
        <input type="reset" value="Reset">
    </form> 
    </div>
  </body>
</html>