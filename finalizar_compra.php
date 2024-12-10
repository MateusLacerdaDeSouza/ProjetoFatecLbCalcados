
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cart'])) {
    $cart = json_decode($_POST['cart'], true);

    if ($cart) {
        // mostras os produtos do carrinho
        foreach ($cart as $item) {
            echo "Cor: " . htmlspecialchars($item['color']) . "<br>";
            echo "Tamanho: " . htmlspecialchars($item['size']) . "<br>";
            echo "Quantidade: " . htmlspecialchars($item['quantity']) . "<br><br>";
        }
    } else {
        echo "Carrinho está vazio!";
    }
} else {
    echo "Nenhum dado recebido.";
}
?>

