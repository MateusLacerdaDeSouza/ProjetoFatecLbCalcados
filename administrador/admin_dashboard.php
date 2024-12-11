<?php
session_start();

// Verifique se o administrador está autenticado
if (!isset($_SESSION['admin_nome'])) {
    header('Location: adminlogin.php');  // Redireciona para o login se não estiver autenticado
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Administrador</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }
        .container {
            width: 80%;
            margin: auto;
            padding: 20px;
        }
        h1 {
            color: #007bff;
        }
        .box {
            background-color: white;
            padding: 15px;
            margin: 10px 0;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .box a {
            text-decoration: none;
            color: #007bff;
        }
        .box a:hover {
            text-decoration: underline;
        }
        .logout {
            margin-top: 20px;
            padding: 10px;
            background-color: #ff4d4d;
            color: white;
            text-align: center;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Bem-vindo, <?php echo $_SESSION['admin_nome']; ?>!</h1>
        <p>Aqui você pode gerenciar o sistema.</p>

        <div class="box">
            <h3><a href="gerenciar_usuarios.php">Gerenciar Usuários</a></h3>
            <p>Visualize, edite e exclua os usuários registrados no sistema.</p>
        </div>

        <div class="box">
            <h3><a href="gerenciar_estoque.php">Gerenciar Estoque</a></h3>
            <p>Adicione, edite ou remova produtos do estoque.</p>
        </div>

        <div class="box">
            <h3><a href="relatorios.php">Visualizar Relatórios</a></h3>
            <p>Veja relatórios de atividades e desempenho do sistema.</p>
        </div>

        <div class="logout" onclick="window.location.href='logout.php';">
            Sair
        </div>
    </div>
</body>
</html>
