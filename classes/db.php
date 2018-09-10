<?php

class db{

    private static function connect(){

    $servername = "mysql942.umbler.com"; 
    $username = "mari";
    $password = "Nomoretears11";
    $dbname = "redelem";

    try {
        $pdo= new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }catch(PDOException $e){
        echo "<br>Conexão com BD Falha<br>";
    }

        return $pdo;
    }

    
    public static function query($query, $params = array()){
        $statement = self::connect()->prepare($query);
        $statement->execute($params);
        
        if (explode(' ', $query)[0] == 'SELECT'){
            $data = $statement->fetchAll();
            return $data;
        }
        
        
     
    }
}

?>