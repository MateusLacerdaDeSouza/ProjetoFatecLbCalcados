<?php


require_once __DIR__ . '/config/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = isset($_POST['email']) ? trim($_POST['email']) : null;
    $password = isset($_POST['password']) ? trim($_POST['password']) : null;

    // Verifica se os campos foram preenchidos
    if (empty($email) || empty($password)) {
        echo "Por favor, preencha todos os campos!";
        exit();
    }

    // Instancia a conexão com o banco de dados
    $db = new Connection();
    $conn = $db->conectar();

    // Consulta para buscar o cliente pelo email
    $query = "SELECT email, senha FROM clientes WHERE email = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $cliente = $result->fetch_assoc();

            // Depuração: Exibir a senha do banco e a senha inserida antes da verificação
            echo "<pre>";
            echo "Senha no Banco: " . $cliente['senha'] . "\n";
            echo "Senha Digitada: " . $password . "\n";
            echo "</pre>";

            // Verifica a senha usando password_verify
            if (password_verify($password, $cliente['senha'])) {
                session_start();
                $_SESSION['cliente_email'] = $cliente['email'];
                header('Location: cliente_dashboard.php');
                exit();
            } else {
                echo "Senha incorreta!";
            }
        } else {
            echo "Cliente não encontrado!";
        }
    } else {
        echo "Erro ao preparar a consulta: " . $conn->error;
    }
}
?>
