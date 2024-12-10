<?php
require_once '../config/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = isset($_POST['nome']) ? trim($_POST['nome']) : null;
    $password = isset($_POST['password']) ? trim($_POST['password']) : null;

    // Verifica se os campos foram preenchidos
    if (empty($nome) || empty($password)) {
        echo "Por favor, preencha todos os campos!";
        exit();
    }

    $db = new Connection();
    $conn = $db->conectar();

    // Consulta para buscar o administrador pelo nome
    $query = "SELECT nome, senha FROM administradores WHERE nome = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("s", $nome);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $admin = $result->fetch_assoc();

            // Depuração: Exibir a senha do banco e a senha inserida antes da verificação
            echo "<pre>";
            echo "Senha no Banco: " . $admin['senha'] . "\n";
            echo "Senha Digitada: " . $password . "\n";
            echo "</pre>";

            // Verifica a senha usando password_verify
            if (password_verify($password, $admin['senha'])) {
                session_start();
                $_SESSION['admin_nome'] = $admin['nome'];
                header('Location: admin_dashboard.php');
                exit();
            } else {
                echo "Senha incorreta!";
            }
        } else {
            echo "Administrador não encontrado!";
        }
    } else {
        echo "Erro ao preparar a consulta: " . $conn->error;
    }
}
?>
