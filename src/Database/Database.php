<?php namespace App\Database;

require_once __DIR__ . "/../../config/config.php";
use \PDO;

class Database {
    private static ?PDO $pdo = null;
    private static array $config = [];

    public static function getConnection(string $env = 'dev'): ?PDO {
        if( !in_array("config", self::$config) ){
            self::$config = getDatabaseConfig();
        }
        
        if( self::$pdo === null) {
            $db = self::$config['config'][$env]['db'];
            $dbhost = self::$config['config'][$env]['dbhost'];
            $dbname = self::$config['config'][$env]['dbname'];
            $dbuser = self::$config['config'][$env]['dbuser'];
            $dbpass = self::$config['config'][$env]['dbpass'];
            self::$pdo = new PDO("$db:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
        }

        return self::$pdo;
    }
}