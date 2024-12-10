<?php
session_start();

// Verifica se a sessão está ativa e se os dados do cliente estão presentes
if (!isset($_SESSION['cliente_email'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $invoice = htmlspecialchars($_POST["invoice"]);
    echo "<h2>Nota Fiscal Gerada:</h2>";
    echo "<pre>" . nl2br($invoice) . "</pre>";
} else {
    echo "<p>Erro: Dados da nota fiscal não encontrados.</p>";
}
?>
