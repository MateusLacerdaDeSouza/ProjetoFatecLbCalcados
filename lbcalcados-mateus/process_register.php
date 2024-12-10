<?php

require_once __DIR__ . '/config/connection.php';

$dbConnection = new Connection();
$mysqli = $dbConnection->conectar();

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Método não permitido']);
    exit;
}

// Captura dos dados do formulário
$email = isset($_POST['email']) ? $_POST['email'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;
$nome = isset($_POST['nome']) ? $_POST['nome'] : null;
$telefone = isset($_POST['telefone']) ? $_POST['telefone'] : null;
$end = isset($_POST['endereco']) ? $_POST['endereco'] : null;
$cidade = isset($_POST['cidade']) ? $_POST['cidade'] : null;
$cpf = isset($_POST['cpf']) ? $_POST['cpf'] : null;

if (!$email || !$password || !$nome || !$telefone || !$end || !$cidade || !$cpf) {
    echo json_encode(['success' => false, 'message' => 'Todos os campos são obrigatórios.']);
    exit;
}

try {
    // Verifica se o e-mail já está cadastrado
    $stmt = $mysqli->prepare("SELECT idcliente FROM clientes WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'E-mail já cadastrado.']);
        $stmt->close();
        exit;
    }
    $stmt->close();

    // Criação de hash para senha
    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    // Inserção dos dados na tabela
    $stmt = $mysqli->prepare("INSERT INTO clientes (nome, email, senha, telefone, endereco, cidade, cpf) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $nome, $email, $passwordHash, $telefone, $end, $cidade, $cpf);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Usuário registrado com sucesso!']);
    } else {
        throw new Exception('Erro ao registrar usuário: ' . $stmt->error);
    }
    $stmt->close();
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
} finally {
    $mysqli->close();
}
