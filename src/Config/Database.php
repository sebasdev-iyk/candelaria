<?php

namespace Config;

use PDO;
use PDOException;

class Database {
    private $host = '127.0.0.1';
    private $port = '3306';
    private $user = 'mipuno_candelaria_user';
    private $password = 'mipuno_candelaria';

    public function connect($db_name) {
        $conn = null;

        try {
            $dsn = "mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $db_name . ";charset=utf8mb4";
            $conn = new PDO($dsn, $this->user, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Connection Error: " . $e->getMessage();
        }

        return $conn;
    }
}
