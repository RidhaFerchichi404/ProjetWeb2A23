<?php

class config
{
    private static $pdo = null;

    public static function getConnexion()
    {
        if (!isset(self::$pdo)) {
            try {
                self::$pdo = new PDO(
                    'mysql:host=localhost;dbname=projetweb2a23',
                    'root',
                    '',
                    [
                       
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,


                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                    ]
                );
            } catch (Exception $e) {
                die('Erreur: ' . $e->getMessage());
            }
        }
        // add a comment for config.php

        return self::$pdo;
    }
}
