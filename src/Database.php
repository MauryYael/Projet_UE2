<?php
namespace App;

use PDO;
use PDOException;

class Database {
    private static ?Database $_instance = null;
    private ?PDO $pdo = null;
    private $host = "localhost";
    private $db_name = "roni4736_maury_yael_ue2";
    private $username = "roni4736_maury_yael";
    private $password = "]zImy?q@EnX^";

    private function __construct() {
        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->db_name . ";charset=utf8";
            
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ];

            $this->pdo = new PDO($dsn, $this->username, $this->password, $options);

        } catch (PDOException $e) {
            die("Erreur de connexion BDD : " . $e->getMessage());
        }
    }

    public static function getInstance(): self {
        if (self::$_instance === null) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function getConnection(): PDO {
        return $this->pdo;
    }
}