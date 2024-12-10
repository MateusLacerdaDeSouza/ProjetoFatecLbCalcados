<?php
header('Content-Type: application/json');

require_once __DIR__ . '/config/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : null;
    $password = isset($_POST['password']) ? trim($_POST['password']) : null;

    if (empty($email) || empty($password)) {
        echo json_encode(['success' => false, 'message' => 'Por favor, preencha todos os campos.']);
        exit();
    }

    $db = new Connection();
    $conn = $db->conectar();

    $query = "SELECT email, senha FROM clientes WHERE email = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $cliente = $result->fetch_assoc();

            // Verifica a senha usando password_verify
            if ($password === $cliente['senha'] || password_verify($password, $cliente['senha'])) {
                session_start();
                $_SESSION['cliente_email'] = $cliente['email'];

                echo json_encode(['success' => true, 'message' => 'Login realizado com sucesso.']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Senha incorreta.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'E-mail não encontrado.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro na consulta ao banco.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Método inválido.']);
}
?>
