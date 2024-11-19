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
    <?php include 'header.php'; ?>

    <img src="img/50off.png" alt="Promoção" class="promocao">

    <h2 class="titulo-promo">AMAMOS PROMO</h2>

    <!-- Seção com as imagens -->
    <div class="product-container">
        <div class="product" class="click" onclick="window.location.href='item.php'">
            <div class="discount-tag">
                <p>50% OFF</p> 
            </div>
            <img src="img/bota-alta.jpeg" alt="Produto 1">
            <div class="product-info">
                <h3>BOTA CANO ALTO SALTO 12 CM </h3>
                <div class="price-container">
                    <span class="price">R$ 175,00</span>
                    <span class="old-price">R$ 350,00</span>
                </div>
            </div>
        </div>
        <div class="product">
            <div class="discount-tag">
                <p>50% OFF</p> 
            </div>
            <img src="img/sapatilha-vermelha.jpeg" alt="Produto 2">
            <div class="product-info">
                <h3>SAPATILHA MARY JANE VERMELHO</h3>
                <div class="price-container">
                    <span class="price">R$ 90,00</span>
                    <span class="old-price">R$ 180,00</span>
                </div>
            </div>
        </div>
        <div class="product">
            <div class="discount-tag">
                <p>50% OFF</p> 
            </div>
            <img src="img/salto-alto-vermelho.jpeg" alt="Produto 3">
            <div class="product-info">
                <h3>SALTO ALTO SCARPIN VERMELHO</h3>
                <div class="price-container">
                    <span class="price">R$ 75,00</span>
                    <span class="old-price">R$ 150,00</span>
                </div>
            </div>
        </div>
        <div class="product">
            <div class="discount-tag">
                <p>50% OFF</p> 
            </div>
            <img src="img/sapato-colorido.jpeg" alt="Produto 4">
            <div class="product-info">
                <h3>SANDALIA SALTO ALTO COLORIDO</h3>
                <div class="price-container">
                    <span class="price">R$ 100,00</span>
                    <span class="old-price">R$ 200,00</span>
                </div>
            </div>
        </div>
    </div>

    <br><br><br><br><br>

    <!-- Inclui o rodapé -->
    <?php include 'footer.html'; ?>


    
</body>
</html>