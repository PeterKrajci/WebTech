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
<table class="myTable">
    <thead>
            <tr class="header">
                <th>
                    Meno
                </th>
                <th>

                    Priezvisko
                    
                </th>
                <th>
                    Dátum narodenia
                </th>
                <th>
                    Miesto narodenia
                </th>
                <th>
                    Krajina narodenia
                </th>
                <th>
                    Dátum úmrtia
                </th>
                <th>
                    Miesto úmrtia
                </th>
                <th>
                    Krajina úmrtia
                </th>
            </tr>
        </thead>
        <tbody>
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

                $person=$stm->fetchAll(PDO::FETCH_ASSOC);
                foreach($person as $row){
                    echo "<tr><td>{$row['name']}</td><td>{$row['surname']}</td><td>{$row['birth_day']}</td><td>{$row['birth_place']}</td><td>{$row['birth_country']}</td><td>{$row['death_day']}</td><td>{$row['death_place']}</td><td>{$row['death_country']}</td></tr>";
                }

                
                
                
                

            }
            else{
                header('Location: ', "../404.html");
            }
        ?>
        </tbody>
    </table>
    <table class="myTable">
        <thead>
                <tr class="header">
                    <th>
                        Umiestnenie
                    </th>
                    <th>

                        Rok
                        
                    </th>
                    <th>
                        Disciplína
                    </th>
                    <th>
                        Mesto
                    </th>
                
                    <th>
                        Typ
                    </th>
                </tr>
            </thead>
            <tbody>
                    <?php 
                        if(isset($_GET['id'])){
            
                            
                            $sql= "SELECT placing.placing, oh.year,placing.discipline, oh.city, oh.type FROM person,placing,oh WHERE person.id=? AND person.id=placing.person_id AND placing.oh_id=oh.id ORDER BY oh.year DESC";
                            $stm = $conn->prepare($sql);
                        
                            $stm->bindValue(1,$_GET['id']);
                            
                            $stm->execute();
                            
            
                            $placings=$stm->fetchAll(PDO::FETCH_ASSOC);
                            //var_dump($placings);
                            foreach($placings as $row){
                                echo "<tr><td>{$row['placing']}</td><td>{$row['year']}</td><td>{$row['discipline']}</td><td>{$row['city']}</td><td>{$row['type']}</td></tr>";
                            }
                            
                            
            
                        }
                        else{
                            header('Location: ', "../404.html");
                        }


                        
                    ?>
            </tbody>
        </table>
        <a href="index.php" class="button">Naspäť</a>
    
</body>
</html>






