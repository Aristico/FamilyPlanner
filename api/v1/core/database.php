<?php

class Database
{
    private static $instance = null;
    private $conn;

    private function __construct($db_config)
    {
        $db_host = $db_config['host'];
        $db_name = $db_config['name'];
        $db_user = $db_config['user'];
        $db_pass = $db_config['pass'];
        $db_port = $db_config['port'];

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
            throw new RuntimeException("Database connection failed: " . $e->getMessage(), 0, $e);
        }
    }

    public static function getInstance($config)
    {
        if (self::$instance == null) {
            self::$instance = new Database($config['db']);
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }
}