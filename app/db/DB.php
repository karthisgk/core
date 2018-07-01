<?php
class DB {
    public function connect() {
        require_once 'config.php';
        $this->conn = new mysqli(host, username, password, database);
        return $this->conn;
    }
}

?>