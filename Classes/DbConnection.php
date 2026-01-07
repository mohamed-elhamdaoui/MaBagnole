<?php

class DbConnection
{
    private static $pdo = null;

    public static function getConnection()
    {
        if (self::$pdo === null) {
            try {

                $host = "localhost";
                $db = "mabagnole_db";
                $root = "momo";
                $pass = "momo1";
                $port = 3307;

                self::$pdo = new PDO("mysql:host=$host;port=$port;dbname=$db;charset=utf8", username: $root, password: $pass);
                // echo "Connection succes";
            } catch (PDOException $e) {
                die("Connection failed" . $e->getMessage());
            }


            
        }
        return self::$pdo;
    }
}
