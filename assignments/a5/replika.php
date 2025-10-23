<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Insert Replika</title>
    <link href="style.css" rel="stylesheet" type="text/css" media="all">
  </head>
  <body>
    <div class="form-check">
    <h1>Insert a Replika</h1>
    <form action="replika_check.php" method="post">
      <p>Model Code: </p>
        <input type="radio" id="ARAR" name="model" value="1">
        <label for="ARAR">ARAR</label><br>
        <input type="radio" id="EULR" name="model" value="2">
        <label for="EULR">EULR</label><br>
        <input type="radio" id="KLBR" name="model" value="3">
        <label for="KLBR">KLBR</label><br>
        <input type="radio" id="LSTR" name="model" value="4">
        <label for="LSTR">LSTR</label><br>
        <input type="radio" id="MNHR" name="model" value="5">
        <label for="MNHR">MNHR</label><br>
        <input type="radio" id="STAR" name="model" value="6">
        <label for="STAR">STAR</label><br>
        <input type="radio" id="STCR" name="model" value="7">
        <label for="STCR">STCR</label><br>
        <input type="radio" id="SAPR" name="model" value="8">
        <label for="SAPR">SAPR</label><br>
        <input type="radio" id="KNCR" name="model" value="9">
        <label for="KNCR">KNCR</label><br>
        <input type="radio" id="ADLR" name="model" value="10">
        <label for="ADLR">ADLR</label><br>
        <input type="radio" id="FKLR" name="model" value="11">
        <label for="FKLR">FKLR</label><br><br>
      <label for="code">Replika Code (must be a number)</label>
      <input type="number" step="1" name="code" id="code" min="0" max="99"><br>
      <label for="arrival_date">Date of Arrival:</label>
      <input type="date" id="arrival_date" name="arrival_date"><br>
      <label for="current_role">Current Role:</label><br>
      <input type="text" id="current_role" name="current_role"><br>
      <label for="clearance">Clearance: </label><br>
      <input type="range" id="clearance" name="clearance" min="0" max="3"><br>
      <label for="nname">Nickname:</label><br>
      <input type="text" id="nname" name="nname"><br>
      <input type="submit" value="submit">
      <input type="reset" value="reset">
    </form> 
    </div>
  </body>
</html>