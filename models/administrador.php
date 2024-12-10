<?php
require_once '../config/connection.php'; // Incluindo o arquivo da classe Connection

class Administrador {
    private $nome;
    private $email;
    private $senha;
    private $conn;

    public function __construct() {
        $db = new Connection();  // Criando um objeto da classe Connection
        $this->conn = $db->conectar();  // Usando o método conectar para obter a conexão
    }

    public function setNome($nome) { $this->nome = $nome; }
    public function setEmail($email) { $this->email = $email; }
    public function setSenha($senha) { 
        $this->senha = password_hash($senha, PASSWORD_DEFAULT); 
    }

    public function cadastrar() {
    try {
        $senhaCriptografada = password_hash($this->senha, PASSWORD_DEFAULT);
        $query = "INSERT INTO administradores (nome, email, senha) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
    
        if (!$stmt) {
            return "Erro ao preparar a consulta: " . $this->conn->error;
        }
    
        // Usa bind_param ao invés de bindParam (para mysqli)
        $stmt->bind_param("sss", $this->nome, $this->email, $this->senha);
    
        // Executa a consulta
        if ($stmt->execute()) {
            // Redireciona antes de qualquer outro código
            header('Location: adminlogin.php');
            exit(); // Garante que o script pare aqui, não permitindo que mais nada seja executado
        } else {
            return "Erro ao cadastrar: " . $stmt->error;
        }
    
    } catch (Exception $e) {
        return "Erro: " . $e->getMessage();
    }
}

    
}
?>
