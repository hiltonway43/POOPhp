
<?php
class  Db
{
    private static $connection = NULL;
    private function __construct()
    {
    }

    public static function getConnect()
    {
        $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
        self::$connection = new PDO('mysql:host=localhost;dbname=ffirocafuerte','root','',$pdo_options);
        return self::$connection;
    }
}
?>