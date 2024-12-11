<?php

require_once __DIR__ . '/config/connection.php';

$dbConnection = new Connection();
$mysqli = $dbConnection->conectar();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Método não permitido']);
    exit;
}

$step = isset($_POST['step']) ? $_POST['step'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;
$nome = isset($_POST['nome']) ? $_POST['nome'] : null;
$telefone = isset($_POST['telefone']) ? $_POST['telefone'] : null;
$end = isset($_POST['endereco']) ? $_POST['endereco'] : null;
$cidade = isset($_POST['cidade']) ? $_POST['cidade'] : null;
$cpf = isset($_POST['cpf']) ? $_POST['cpf'] : null;
$preferences = isset($_POST['preferences']) ? $_POST['preferences'] : null;

if (!$step) {
    echo json_encode(['success' => false, 'message' => 'Etapa não especificada']);
    exit;
}

try {
    switch ($step) {
        case 'check_email':
            if (!$email) {
                throw new Exception('E-mail não fornecido');
            }

            $stmt = $mysqli->prepare("SELECT idcliente FROM clientes WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                echo json_encode(['success' => false, 'message' => 'E-mail já cadastrado']);
            } else {
                echo json_encode(['success' => true]);
            }
            $stmt->close();
            break;

        case 'register_user':
            if (!$email || !$password || !$nome || !$telefone || !$end || !$cidade || !$cpf) {
                throw new Exception('Dados insuficientes');
            }

            $passwordHash = password_hash($password, PASSWORD_BCRYPT);

            $stmt = $mysqli->prepare("INSERT INTO clientes (nome, email, senha, telefone, endereco, cidade, cpf) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $nome, $email, $passwordHash, $telefone, $end, $cidade, $cpf);

            if ($stmt->execute()) {
                echo json_encode(['success' => true]);
            } else {
                throw new Exception('Erro ao registrar usuário: ' . $stmt->error);
            }
            $stmt->close();
            break;

        case 'set_preferences':
            if (!$preferences) {
                throw new Exception('Preferências não fornecidas');
            }
            // Adicione a lógica para salvar preferências se necessário
            echo json_encode(['success' => true]);
            break;

        default:
            echo json_encode(['success' => false, 'message' => 'Etapa inválida']);
            break;
    }
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
} finally {
    $mysqli->close();
}
