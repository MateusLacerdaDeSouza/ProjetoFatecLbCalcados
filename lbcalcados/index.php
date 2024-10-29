<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LB Calçados</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>
    <!-- Inclui o Header do site -->
    <?php include 'header.php'; ?>

    <!-- Barra de navegação -->
    <nav class="top-bar">
        <ul>
            <li>Botas</li>
            <li>Scarpin</li>
            <li>Sapatilha</li>
            <li>Salto Alto</li>
            <li>Mocassim</li>
            <li>Diversos</li>
        </ul>
    </nav>

    <img src="img/sapatos.jpeg" alt="Promoção" class="promocao">

    <h2 class="titulo-promo">AMAMOS PROMO</h2>

    <!-- Seção com as imagens -->
    <div class="product-container">
        <div class="product">
            <img src="img/bota-alta.jpeg" alt="Produto 1">
            <div class="product-info">
                <h3>Nome do Produto 1</h3>
                <div class="price-container">
                    <span class="price">R$ 99,90</span>
                    <span class="old-price">R$ 129,90</span>
                </div>
            </div>
        </div>
        <div class="product">
            <img src="img/bota-alta.jpeg" alt="Produto 2">
            <div class="product-info">
                <h3>Nome do Produto 2</h3>
                <div class="price-container">
                    <span class="price">R$ 89,90</span>
                    <span class="old-price">R$ 119,90</span>
                </div>
            </div>
        </div>
        <div class="product">
            <img src="img/bota-alta.jpeg" alt="Produto 3">
            <div class="product-info">
                <h3>Nome do Produto 3</h3>
                <div class="price-container">
                    <span class="price">R$ 79,90</span>
                    <span class="old-price">R$ 109,90</span>
                </div>
            </div>
        </div>
        <div class="product">
            <img src="img/bota-alta.jpeg" alt="Produto 4">
            <div class="product-info">
                <h3>Nome do Produto 4</h3>
                <div class="price-container">
                    <span class="price">R$ 69,90</span>
                    <span class="old-price">R$ 99,90</span>
                </div>
            </div>
        </div>
    </div>

    <br><br><br><br><br>

    <!-- Inclui o rodapé -->
    <?php include 'footer.html'; ?>


    
</body>
</html>