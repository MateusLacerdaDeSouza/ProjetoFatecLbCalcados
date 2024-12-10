<?php
class Connection {
    private $servername = "127.0.0.1";
    private $username = "root";
    private $password = "";
    private $dbname = "lbcalcados";
    private $conn;

    public function __construct() {
        // Criar a conexão
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        // Verificar a conexão
        if ($this->conn->connect_error) {
            die("Falha na conexão: " . $this->conn->connect_error);
        }
    }

    public function conectar() {
        return $this->conn;
    }
}
?>
