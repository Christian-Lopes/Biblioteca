<?php


class Periodo
{
    private static $conn;

    public static function getConnection(){
        if(empty(self::$conn)){
            $host = 'localhost' ;
            $name = 'biblioteca';
            $user = 'christian';
            $pass = '03195468107';
            self::$conn = new PDO("mysql:host={$host};dbname={$name}", "{$user}", "{$pass}");
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$conn;
    }
    public static function all(){
        $conn = self::getConnection();

        $result = $conn->query('SELECT * FROM periodo');

        $list = $result->fetchAll(PDO::FETCH_ASSOC);

        return $list;
    }

}