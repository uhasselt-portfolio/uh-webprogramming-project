<?php

class Database {

    private static $host = 'localhost';
    private static $db = 'michielswaanen';
    private static $user = 'michielswaanen';
    private static $pw = 'ShureiB4';

    private static function connect() {
        $pdo = new PDO('pgsql:host=' . self::$host . ';dbname=' . self::$db, self::$user, self::$pw);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        //$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        return $pdo;
    }

    public static function query($query, $params = array()) {
        $stmt = self::connect()->prepare($query);
        $stmt->execute($params);
        $data = $stmt->fetchAll();
        return $data;
    }

    public static function insert($query, $params = array()) {
        $connection = self::connect();
        $stmt = $connection->prepare($query);
        $stmt->execute($params);
        return $connection->lastInsertId();
    }
}

?>