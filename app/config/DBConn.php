<?php
class DB {
    private const HOST = 'localhost';
    private const USERNAME = 'root';
    private const PASSWORD = '';
    private const DATABASE = 'blogs';

    private const DSN = "mysql:host=".self::HOST.";dbname=".self::DATABASE;

    public $conn;

    public function __construct(){
        try {
            $this->conn = new PDO(self::DSN, self::USERNAME, self::PASSWORD);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
        } catch(PDOException $e) {
            echo "PDO CONNECTIN ERROR: " . $e->getMessage();
        }
    }

    // public function __destruct(){
    //     $this->conn = null;
    // }
}