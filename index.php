<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LB Calçados</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/index.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');
    </style>
    <link rel="shortcut icon" type="imagex/png" href="img/logo-mini.png">
</head>
<body>
    <!-- Inclui o Header-->
    <?php require_once 'header.php'; 
        
    ?>

 
<?php
require_once __DIR__ . '/models/produto.php';

if (!class_exists('Produto')) {
    die("A classe Produto não foi carregada corretamente.");
}

$produtoObj = new Produto();
$produtos = $produtoObj->buscarIndex(4);

if ($produtos === null) {
    die("Erro: O método buscarIndex() retornou null.");
}

?>

<h2 class="titulo-promo">AMAMOS PROMO</h2>

<div class="product-container">
<?php foreach ($produtos as $produto): ?>
    <div class="product" class="click" onclick="window.location.href='item.php?id=<?php echo $produto['idprodutos']; ?>'">
        <div class="discount-tag">
            <p>50% OFF</p> 
        </div>
        <img src="<?php echo 'administrador/' . $produto['url_img']; ?>" alt="<?php echo $produto['nome']; ?>">
        <div class="product-info">
            <h3><?php echo $produto['nome']; ?></h3>
            <div class="price-container">
                <span class="price">R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></span>
                <span class="old-price">R$ <?php echo number_format(10, 2, ',', '.'); ?></span>
            </div>
        </div>
    </div>
<?php endforeach; ?>
</div>

<br><br><br><br><br>

<!-- Inclui o rodapé -->
<?php include 'footer.html'; ?>


    
</body>
</html>