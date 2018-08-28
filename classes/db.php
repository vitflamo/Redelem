<?php

class db{

    private static function connect(){

        $pdo = new PDO(
            'mysql:host=mysql942.umbler.com;
            dbname=redelem;
            charset=utf-8', 
            'mari',
            'Nomoretears11'
        );

        $pdo->setAttribute(
            PDO::ATTR_ERRMODE, 
            PDO::ERRMODE_EXCEPTION
        );

        return $pdo;
    }

    public static function query($query, $params = array()){
        $statement = self::connect()->prepare($query);
        $statement->execute($params);
        //$data = $statement->fetchAll();
        //return $data;
    }
}


?>