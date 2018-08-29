<?php

class DatabaseMySQL 
{
    private $host              = '127.0.0.1';
    private $dbname            = 'parada2';
    private $username          = 'root';
    private $password          = 'secret';
    private static $connection = null;

    public static function getConnection()
    {
        if (self::$connection == null) {
            new self();
        }
        
        return self::$connection;
    }

    private function __construct()
    {
        try {
            $dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=utf8";
            self::$connection = new PDO($dsn, $this->username, $this->password);
            self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            echo "PDOException: " . $e->getMessage();
        }
    }

    private function __clone()
    {
        //
    }
}