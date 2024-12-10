<?php
header('Content-Type: application/json');

// Substitua pela lógica real de consulta ao banco
$email = $_POST['email'];
$emailsExistentes = ['teste@teste.com', 'usuario@site.com']; // Simulação de e-mails cadastrados

echo json_encode(['exists' => in_array($email, $emailsExistentes)]);
?>