<?php
require_once '../config/connection.php';;
require_once '../models/administrador.php';

$mensagem = ''; // Variável para mostrar a mensagem de sucesso ou erro

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $admin = new Administrador();
    $admin->setNome($_POST['nome']);
    $admin->setEmail($_POST['email']);
    $admin->setSenha($_POST['senha']);
    $mensagem = $admin->cadastrar(); // Processa o cadastro
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Funcionário</title>
</head>
<body>
    <h2>Cadastro de Funcionário</h2>
    <?php if (!empty($mensagem)) echo "<p>$mensagem</p>"; // Exibe a mensagem de sucesso ou erro ?>
    <form method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" required><br><br>

        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
