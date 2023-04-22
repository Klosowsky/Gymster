<?php

require_once 'config.php';
class Database
{
    private $username;
    private $password;
    private $host;
    private $database;

    public function __construct()
    {
        $this->username = 'dbuser';
        $this->password = 'dbpwd';
        $this->host = 'db';
        $this->database = 'dbname';
    }

    public function connect()
    {
        try {
            //print('HERE1');
            $conn = new PDO(
                "pgsql:host=$this->host;port=5432;dbname=$this->database",
                $this->username,
                $this->password,
                ["sslmode"  => "prefer"]
            );
            //print('HERE');
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        }
        catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
}