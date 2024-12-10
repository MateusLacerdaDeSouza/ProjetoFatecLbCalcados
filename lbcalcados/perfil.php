<?php
session_start();
require_once 'config/connection.php';

// Verifique se o usuário está logado
if (!isset($_SESSION['cliente_email'])) {
    // Redirecione para a página de login se o usuário não estiver logado
    header('Location: login.php');
    exit();
}

// Obtenha os dados do usuário do banco de dados
$email = $_SESSION['cliente_email'];
$db = new Connection();
$conn = $db->conectar();

$query = "SELECT nome, email, endereco, cpf FROM clientes WHERE email = ?";
$stmt = $conn->prepare($query);

if ($stmt) {
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
    } else {
        // Se não encontrar o usuário, exiba uma mensagem de erro
        echo "Usuário não encontrado.";
        exit();
    }
} else {
    echo "Erro na consulta ao banco.";
    exit();
}
?>




<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LB Calçados</title>
    <link rel="shortcut icon" type="imagex/png" href="img/logo-mini.png">
    <link rel="stylesheet" href="css/reset.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <!-- Inclui header -->
    <?php include 'header-sec.html'; ?>

    <div class="container">
        <h1>Meu Perfil</h1>
        <form id="profileForm">
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($user['nome']); ?>" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <div class="form-group">
                <label for="endereco">Endereço</label>
                <input type="text" id="endereco" name="endereco" value="<?php echo htmlspecialchars($user['endereco']); ?>">
            </div>
            <div class="form-group">
                <label for="cpf">CPF</label>
                <input type="text" id="cpf" name="cpf" value="<?php echo htmlspecialchars($user['cpf']); ?>">
            </div>
            <button type="button" onclick="updateProfile()">Salvar Alterações</button>
        </form>
    </div>

    <script>
        function updateProfile() {
            const form = document.getElementById('profileForm');
            const formData = new FormData(form);

            fetch('process_profile.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Dados atualizados com sucesso!');
                } else {
                    alert(data.message || 'Erro ao atualizar os dados.');
                }
            })
            .catch(error => console.error('Erro:', error));
        }
    </script>

    <?php include 'footer.html'; ?>

</body>
</html>