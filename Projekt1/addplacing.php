<!DOCTYPE html>
<html lang="en">
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
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mystyle.css">
    <title>Document</title>
</head>
<body>

    <form action="index.php" method="POST">
        <label for="man">Výber športovca:</label>
        <br>
        
        <select name="man" id="man">
            <?php 
                    
                    
                    
                    $sql="SELECT person.name, person.surname, person.id FROM person ORDER BY person.surname ASC";
                    $stm = $conn->query($sql);
                    $rows = $stm->fetchAll(PDO::FETCH_NUM);
                    foreach($rows as $row){
                        echo "<option value='{$row[2]}'>{$row[0]} {$row[1]}</option>";
                        
                    }


                    
                ?>
        </select>
        <br><br>

        <select name="oh" id="oh">
            <?php 
                    
                    $sql="SELECT oh.type, oh.year, oh.city, oh.id FROM oh ORDER BY oh.type ASC";
                    $stm = $conn->query($sql);
                    $rows = $stm->fetchAll(PDO::FETCH_NUM);
                    foreach($rows as $row){
                        echo "<option value='{$row[3]}'>{$row[0]} {$row[1]} {$row[2]} </option>";
                        
                    }


                    
                ?>
        </select>
        <br><br>

        <label for="discipline">Disciplina:</label><br>
        <input type="text" id="discipline" name="discipline" required><br><br>
        <label for="placing">Umiestnenie:</label><br>
        <input type="number" id="placing" name="placing" required><br><br>
        <input type="submit" value="Submit">
    </form>
</body>
</html>