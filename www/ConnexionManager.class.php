<?php

abstract class ConnexionManager
{
    private static $connexion;

    private static function SetConnexionBdd()
    {
        self::$connexion = new PDO("mysql:host=$_ENV[MYSQL_HOST];dbname=$_ENV[MYSQL_DATABASE];chartset=utf8", $_ENV['MYSQL_USER'], $_ENV['MYSQL_PASSWORD']);
        self::$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }

    protected function getConnexionBdd()
    {
        if (self::$connexion === null) {
            self::SetConnexionBdd();
        }
        return self::$connexion;
    }
}
