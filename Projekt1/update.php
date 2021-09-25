<?php
  include_once("../config.php");

  try {
  $conn = new PDO("mysql:host=$servername;dbname=zadanie2", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  //echo "Connected successfully";
  } catch(PDOException $e) {
  echo "Connection failed: " . $e->getMessage();
  }
  
  if(isset($_GET['id'])){
      $sql= "SELECT * FROM person WHERE id=?";
      $stm = $conn->prepare($sql);
      $stm->bindValue(1,$_GET['id']);
      $stm->execute();

      $person=$stm->fetch(PDO::FETCH_ASSOC);
      
      
      

  }
  else{
      header('Location: ', "../404.html");
  }
?>
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
<form action="index.php" method="POST">
  <input type="hidden" name="id" value="<?php if(isset($person["id"])){echo $person["id"];}else{echo null;} ?>">
  <label for="name">Meno:</label><br>
  <input type="text" id="name" name="name" value="<?php if(isset($person["name"])){echo $person["name"];}else{echo null;} ?>"><br>
  <label for="surname">Priezvisko:</label><br>
  <input type="text" id="surname" name="surname" value="<?php if(isset($person["surname"])){echo $person["surname"];}else{echo null;} ?>"><br>
  <label for="birth_day">Dátum narodenia:</label><br>
  <input type="text" id="birth_day" name="birth_day" value="<?php if(isset($person["birth_day"])){echo $person["birth_day"];}else{echo null;} ?>"><br>
  <label for="birth_place">Miesto narodenia:</label><br>
  <input type="text" id="birth_place" name="birth_place" value="<?php if(isset($person["birth_place"])){echo $person["birth_place"];}else{echo null;} ?>"><br>
  <label for="birth_country">Krajina narodenia:</label><br>
  <input type="text" id="birth_country" name="birth_country" value="<?php if(isset($person["birth_country"])){echo $person["birth_country"];}else{echo null;} ?>"><br>
  <label for="death_day">Dátum úmrtia:</label><br>
  <input type="text" id="death_day" name="death_day" value="<?php if(isset($person["death_day"])){echo $person["death_day"];}else{echo null;} ?>"><br>
  <label for="death_place">Miesto úmrtia:</label><br>
  <input type="text" id="death_place" name="death_place" value="<?php if(isset($person["death_place"])){echo $person["death_place"];}else{echo null;} ?>"><br>
  <label for="death_country">Krajina úmrtia:</label><br>
  <input type="text" id="death_country" name="death_country" value="<?php if(isset($person["death_country"])){echo $person["death_country"];}else{echo null;} ?>">
  <input type="submit" value="Submit">
</form>
</body>
</html>