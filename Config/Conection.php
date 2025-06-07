
<?php
class  Db
{
    private static $connection = NULL;
    private function __construct()
    {
    }

    public static function getConnect()
    {
        $dbHost = getenv('DB_HOST') ?: 'localhost';
        $dbName = getenv('DB_NAME') ?: 'mydatabase';
        $dbUser = getenv('DB_USER') ?: 'user';
        $dbPass = getenv('DB_PASS') ?: 'password';

        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        self::$connection = new PDO("mysql:host={$dbHost};dbname={$dbName}", $dbUser, $dbPass, $pdo_options);
        return self::$connection;
    }
}
?>