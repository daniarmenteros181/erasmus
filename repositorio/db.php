<?php
class db {
    private static $conexion = null;

    public static function entrar() {
        if (self::$conexion == null) {
            self::$conexion = new PDO('mysql:host=localhost;dbname=erasmus', 'daniel', 'root');
        }
        return self::$conexion;
    }
}


?>