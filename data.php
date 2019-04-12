<?php
$servername = 'localhost';
$usrname = 'root';
$dbname = 'login';
$password = '';

class DB
{

    private static $instance = NULL;

    private function __construct()
    {

        try {
            self:$instance = new PDO("mysql:host = localhost;dbname = login", 'root', '');
        } catch (PDOException $e) {
            echo "Connection Failed" . $e->getMessage();
        }
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
                        self::$instance = new DB();
        }
        return self::$instance;
        
    }
}

$conn = DB::getInstance();

$stmt = $conn->prepare("SELECT * FROM user");

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    var_dump($row);
}
