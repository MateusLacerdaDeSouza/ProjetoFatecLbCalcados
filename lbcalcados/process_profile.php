<?php
session_start();
require_once 'config/connection.php';

// Verifique se o usuário está logado
if (!isset($_SESSION['cliente_email'])) {
    echo json_encode(['success' => false, 'message' => 'Usuário não autorizado.']);
    exit();
}

// Obtenha os dados do formulário
$email = $_SESSION['cliente_email'];
$nome = $_POST['nome'] ?? '';
$endereco = $_POST['endereco'] ?? '';
$cpf = $_POST['cpf'] ?? '';

// Validação simples para garantir que os campos não estejam vazios
if (empty($nome) || empty($email)) {
    echo json_encode(['success' => false, 'message' => 'Nome e e-mail são obrigatórios.']);
    exit();
}

// Conecte ao banco de dados
$db = new Connection();
$conn = $db->conectar();

// Prepare a query de atualização
$query = "UPDATE clientes SET nome = ?, endereco = ?, cpf = ? WHERE email = ?";
$stmt = $conn->prepare($query);

if ($stmt) {
    // Bind os parâmetros
    $stmt->bind_param("ssss", $nome, $endereco, $cpf, $email);
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Dados atualizados com sucesso.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao atualizar os dados.']);
    }
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Erro na preparação da consulta.']);
}

// Feche a conexão
$conn->close();
?>
