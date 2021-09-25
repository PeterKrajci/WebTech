<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mystyle.css">
    <title>Document</title>
</head>
<body>
<h2>Pridaj osobu</h2>

<form action="index.php" method="POST">
  <label for="name">Meno:</label><br>
  <input type="text" id="name" name="name" required><br>
  <label for="surname">Priezvisko:</label><br>
  <input type="text" id="surname" name="surname" required><br><br>
  <label for="birthday">Dátum narodenia:</label><br>
  <input type="text" id="birthday" name="birthday" ><br>
  <label for="birthplace">Miesto narodenia:</label><br>
  <input type="text" id="birthplace" name="birthplace" ><br><br>
  <label for="birthcountry">Krajina narodenia:</label><br>
  <input type="text" id="birthcountry" name="birthcountry" ><br>
  <label for="deathday">Dátum úmrtia:</label><br>
  <input type="text" id="deathday" name="deathday" ><br><br>
  <label for="deathplace">Miesto úmrtia:</label><br>
  <input type="text" id="deathplace" name="deathplace" ><br>
  <label for="deathcountry">Krajina úmrtia:</label><br>
  <input type="text" id="deathcountry" name="deathcountry" ><br><br>
  <input type="submit" value="Submit">
</form> 
</body>
</html>