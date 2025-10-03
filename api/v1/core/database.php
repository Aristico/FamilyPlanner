<?php

class Database
{
    private static $instance = null;
    private $conn;

    private function __construct()
    {
        $config = require(__DIR__ . '/config.php');
        
        $db_host = $config['db']['host'];
        $db_name = $config['db']['name'];
        $db_user = $config['db']['user'];
        $db_pass = $config['db']['pass'];
        $db_port = $config['db']['port'];

        $dsn = "mysql:host=$db_host;port=$db_port;dbname=$db_name;charset=utf8mb4";

        try {
            $this->conn = new PDO($dsn, $db_user, $db_pass, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]);
        } catch (PDOException $e) {
            // For development, you might want to see the error.
            // In production, you should log this error and show a generic message.
            // For now, we'll just die and show the error.
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (self::$instance == null) {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }
}