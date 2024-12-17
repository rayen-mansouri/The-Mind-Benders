<?php

class database
{
    private static $pdo = null;

    public static function getConnexion() //non creation dobjet
    {
        if (!isset(self::$pdo)) {
            try {
                self::$pdo = new PDO(
                    'mysql:host=localhost;dbname=new_user',
                    'root',
                    '',
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //active le gestion de erur
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC //mod de recuption
                    ]
                );
              
            } catch (Exception $e) {
                die('Erreur: ' . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
