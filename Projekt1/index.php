
<!DOCTYPE html>
<html lang="sk">

<?php 
    include_once("../config.php");
   /* require_once 'protect.php';
    Protect\with('form.php', '9WpRUObiB$#vDo');*/
    

    try {
    $conn = new PDO("mysql:host=$servername;dbname=zadanie2", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
    } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    }
    $link_to_asc = "index.php?sort=ASC"; 
    $link_to_desc = "index.php?sort=DESC"; 
    $link_to_year_asc = "index.php?sort=YEAR-ASC"; 
    $link_to_year_desc = "index.php?sort=YEAR-DESC"; 
    $link_to_type_asc = "index.php?sort=TYPE-ASC"; 
    $link_to_type_desc = "index.php?sort=TYPE-DESC"; 
    if(isset($_GET['delete_id'])){
        var_dump("asfdsf");
        $sql="DELETE FROM person WHERE id=?";
        $stm = $conn->prepare($sql);
        $stm->bindValue(1,$_GET['delete_id']);
        $stm->execute();
        echo '<script>alert("Osoba uspešne odstranená!")</script>';
    }
    
    
    
    if(isset($_POST['placing']) && !empty($_POST['placing'])){
        $idman=$_POST['man'];
        $idoh=$_POST['oh'];
        $placing=$_POST['placing'];
        $discipline=$_POST['discipline'];
        $sql = "INSERT INTO placing (person_id,oh_id,placing,discipline) VALUES ('$idman','$idoh','$placing','$discipline')";
        $stmt= $conn->prepare($sql);
        //$stmt->execute([$_POST['man'],$_POST['oh'],$_POST['placing'],$_POST['discipline']]);
        $stmt->execute();
        echo '<script>alert("Umiestnenie uspesne pridane!")</script>';
        
        

    }
    
    
    
    if(isset($_POST['name']) && !empty($_POST['name'])){
    
        
        if(empty($_POST['id'])){

            $sql="SELECT person.name, person.surname FROM person";
            $stm = $conn->query($sql);
            $rows = $stm->fetchAll(PDO::FETCH_NUM);
            
            $guard=0;
            if($_POST['name']){
                foreach($rows as $row){
                    if(($row[0]==$_POST['name']) && ($row[1]==$_POST['surname'])){
                        $guard=1;
                        echo '<script>alert("Osoba uz existuje!!")</script>'; 
                    }
                }
                if($guard==0){
                    $sql = "INSERT INTO person (name,surname,birth_day,birth_place,birth_country,death_day,death_place,death_country) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt= $conn->prepare($sql);
                    $stmt->execute([$_POST['name'],$_POST['surname'],$_POST['birthday'],$_POST['birthplace'],$_POST['birthcountry'],$_POST['deathday'],$_POST['death_place'],$_POST['death_country']]);
                    echo '<script>alert("Osoba uspesne pridana!")</script>';
                }
            }
        }
                        
    
        else{
            
            $sql="UPDATE person SET name=?, surname=?, birth_day=?, birth_place=?, birth_country=?, death_day=?, death_place=?, death_country=? WHERE id=?";
            $stmt = $conn->prepare($sql);
            //$stmt->execute([$_POST['name'],$_POST['surname'],$_POST['id']]);
            $stmt->execute([$_POST['name'],$_POST['surname'],$_POST['birth_day'],$_POST['birth_place'],$_POST['birth_country'],$_POST['death_day'],$_POST['death_place'],$_POST['death_country'],$_POST['id']]);

            
            echo '<script>alert("Rozjebem ti piču, keď sa mi budeš hrať s databázou!!")</script>'; 
        }
        
    }     
?> 
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="mystyle.css">
</head>
<body>
    <h2 class="nadpis">Olympijskí víťazi</h2>
    <table id="first" class="myTable">
        <thead>
            <tr class="header">
                <th>
                    Meno
                </th>
                <th>

                    <a href="<?php if($_GET['sort']=="ASC" or !(isset($_GET['sort']))){echo $link_to_desc;} elseif ($_GET['sort']=="DESC"){echo $link_to_asc;}else{echo $link_to_asc;} ?>" class="button">Priezvisko</a>
                    
                </th>
                <th>
                    <a href="<?php if($_GET['sort']=="YEAR-ASC" or !(isset($_GET['sort']))){echo $link_to_year_desc;} elseif ($_GET['sort']=="YEAR-DESC"){echo $link_to_year_asc;}else{echo $link_to_year_asc;} ?>" class="button">Rok</a>
                </th>
                <th>
                    Miesto
                </th>
                <th>
                    <a href="<?php if($_GET['sort']=="TYPE-ASC" or !(isset($_GET['sort']))){echo $link_to_type_desc;} elseif ($_GET['sort']=="TYPE-DESC"){echo $link_to_type_asc;}else{echo $link_to_type_asc;} ?>" class="button">Typ</a>
                </th>
                <th>
                    Disciplína
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
                

                
                if(!(isset($_GET['sort']))){
                    $sql="SELECT person.name, person.surname, oh.year, oh.city, oh.type, placing.discipline FROM person,placing,oh WHERE person.id=placing.person_id AND placing.oh_id=oh.id AND placing.placing=1";

                    
                }
                else{
                    
                    if($_GET['sort']=="ASC"){
                        $sql="SELECT person.name, person.surname, oh.year, oh.city, oh.type, placing.discipline FROM person,placing,oh WHERE person.id=placing.person_id AND placing.oh_id=oh.id AND placing.placing=1 ORDER BY person.surname ASC";
                    }
                    elseif($_GET['sort']=="DESC"){
                        $sql="SELECT person.name, person.surname, oh.year, oh.city, oh.type, placing.discipline FROM person,placing,oh WHERE person.id=placing.person_id AND placing.oh_id=oh.id AND placing.placing=1 ORDER BY person.surname DESC";
                    }
                    elseif($_GET['sort']=="YEAR-DESC"){
                        $sql="SELECT person.name, person.surname, oh.year, oh.city, oh.type, placing.discipline FROM person,placing,oh WHERE person.id=placing.person_id AND placing.oh_id=oh.id AND placing.placing=1 ORDER BY oh.year ASC";
                    }
                    elseif($_GET['sort']=="YEAR-ASC"){
                        $sql="SELECT person.name, person.surname, oh.year, oh.city, oh.type, placing.discipline FROM person,placing,oh WHERE person.id=placing.person_id AND placing.oh_id=oh.id AND placing.placing=1 ORDER BY oh.year DESC";
                    }
                    elseif($_GET['sort']=="TYPE-DESC"){
                        $sql="SELECT person.name, person.surname, oh.year, oh.city, oh.type, placing.discipline FROM person,placing,oh WHERE person.id=placing.person_id AND placing.oh_id=oh.id AND placing.placing=1 ORDER BY oh.type ASC, oh.year ASC";
                    }
                    elseif($_GET['sort']=="TYPE-ASC"){
                        $sql="SELECT person.name, person.surname, oh.year, oh.city, oh.type, placing.discipline FROM person,placing,oh WHERE person.id=placing.person_id AND placing.oh_id=oh.id AND placing.placing=1 ORDER BY oh.type DESC, oh.year DESC";
                    }
                }
                
                

                $stm = $conn->query($sql);
                $rows = $stm->fetchAll(PDO::FETCH_NUM);


                foreach($rows as $row){
                    echo "<tr><td>{$row[0]}</td><td>{$row[1]}</td><td>{$row[2]}</td><td>{$row[3]}</td><td>{$row[4]}</td><td>{$row[5]}</td></tr>";
                }
            ?>
        </tbody>
    </table>

    <h2 class="nadpis">10 najlepších</h2>
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
                    Počet zlatých medailí
                </th>
                <th>
                   
                </th>
            
            </tr>
        </thead>
        <tbody>
                <?php 
                    
                    $sql="SELECT person.name, person.surname, COUNT(person.id), person.id FROM person,placing,oh WHERE person.id=placing.person_id AND placing.oh_id=oh.id AND placing.placing=1 GROUP BY person.id ORDER BY COUNT(person.id) DESC LIMIT 10";
                    $stm = $conn->query($sql);
                    $rows = $stm->fetchAll(PDO::FETCH_NUM);
                    foreach($rows as $row){
                        echo "<tr><td>{$row[0]}</td><td><a href='view.php?id={$row[3]}'>{$row[1]}</a></td><td>{$row[2]}</td><td><a href='update.php?id={$row[3]}' class='button'>Upraviť</a><a href='index.php?delete_id={$row[3]}' class='button'>Vymazať</a></td></tr>";
                        
                    }


                    
                ?>
        </tbody>
    </table>
   <a href="addperson.php" class="button">Pridaj osobu</a>
    <a href="addplacing.php" class="button">Pridaj umiestnenie</a>
</body>
</html>


