<?php
header('Content-Type: application/json');
require_once __DIR__ . '/config/connection.php';

$email = isset($_POST['email']) ? trim($_POST['email']) : null;

if (empty($email)) {
    echo json_encode(['exists' => false, 'message' => 'E-mail não fornecido.']);
    exit();
}

// Conecta ao banco de dados
$db = new Connection();
$conn = $db->conectar();

$query = "SELECT idcliente FROM clientes WHERE email = ?";
$stmt = $conn->prepare($query);

if ($stmt) {
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    echo json_encode(['exists' => $result->num_rows > 0]);
} else {
    echo json_encode(['exists' => false, 'message' => 'Erro na consulta ao banco.']);
}
?>
