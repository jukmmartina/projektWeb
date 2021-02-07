<?php
    $host="localhost";
    $db_name="prijava";
    $username="root";
    $password="password";
    $connection=null;
try{
    $connection= new PDO("mysql:host=" . $host . ";dbname=" . $db_name, $username, $password);
    $connection->exec("set names utf8");
} catch(PDOException $exception){
    echo "Connection error: " . $exception->getMessage();
}

function saveData($name, $surname, $class, $club){
    global $connection;
    $query="insert into dolatnici values(:name, :surname, :class, :club)";
    $callToDb= $connection->prepare($query);
    $name=htmlspecialchars(strip_tags($name));
    $surname=htmlspecialchars(strip_tags($surname));
    $class=htmlspecialchars(strip_tags($class));
    $club=htmlspecialchars(strip_tags($club));
    $callToDb->bindParam(":name", $name);
    $callToDb->bindParam(":surname", $surname);
    $callToDb->bindParam(":class", $class);
    $callToDb->bindParam(":club", $club);

    if($callToDb->execute()){
        return '<h3 style="text-align:center;">Uspješno izvršena prijava!</h3>';
    }
}
    if(isset($_POST['prijavi'])){
        $name=htmlentities($_POST['name']);
        $surname=htmlentities($_POST['surname']);
        $class=htmlentities($_POST['class']);
        $club=htmlentities($_POST['club']);
        $result=saveData($name, $surname, $class, $club);
        echo $result;
    }
    else{
        echo '<h3 style="text-align:center;">Error.</h3>';
    }

?>