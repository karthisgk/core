<?php

class DB {
    private $conn;

    // Connecting to database
    public function connect() {
        require_once 'config.php';
        
        // Connecting to mysql database
        $this->conn = new mysqli(host, username, password, database);
        
        // return database handler
        return $this->conn;
    }
}

?>