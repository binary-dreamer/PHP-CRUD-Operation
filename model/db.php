<?php
class db {
    private $host = "localhost";
    private $user = "root";
    private $password = "";
    private $db_name = "new";
    public $conn;

    public function connect() {
        $this->conn = new mysqli($this->host, $this->user, $this->password, $this->db_name);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        return $this->conn;
    }
}

?>