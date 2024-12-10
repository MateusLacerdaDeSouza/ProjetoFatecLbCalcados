<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LB Calçados</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/finalizar_compra.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');
    </style>
    <link rel="shortcut icon" type="imagex/png" href="img/logo-mini.png">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        /* Primeira Div */
        .progress-bar {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 30px;
            gap: 100px;
            margin-top: 50px;
        }

        .step {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .step-circle {
            width: 40px;
            height: 40px;
            background-color: #FFD2D2;
            color: #000;
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 50%;
            font-weight: bold;
        }

        .step-text {
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }

        /* Segunda Div */
        .cart-summary {
            display: flex;
            gap: 20px;
            margin-top: 20px;
        }

        .product-list {
            flex: 3;
        }

        .product-item {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 20px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }

        .product-image {
            width: 80px;
            height: 80px;
            object-fit: cover;
        }

        .product-details {
            display: flex;
            flex-direction: column;
        }

        .product-name {
            font-size: 16px;
            font-weight: bold;
        }

        .product-meta {
            font-size: 14px;
            color: #555;
        }

        .product-price {
            font-size: 18px;
            color: #007BFF;
            margin-top: 5px;
        }

        /* Terceira Div */
        .discount-section {
            flex: 1;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }

        .discount-section h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .discount-section input {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }

        .discount-section button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .discount-section button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <!-- Inclui header -->
    <?php include 'header-sec.html'; ?>

    <!-- Primeira Div -->
    <div class="progress-bar">
        <div class="step">
            <div class="step-circle">1</div>
            <div class="step-text">Carrinho</div>
        </div>
        <div class="step">
            <div class="step-circle">2</div>
            <div class="step-text">Identificação</div>
        </div>
        <div class="step">
            <div class="step-circle">3</div>
            <div class="step-text">Entrega</div>
        </div>
        <div class="step">
            <div class="step-circle">4</div>
            <div class="step-text">Pagamento</div>
        </div>
    </div>

    <!-- Segunda e Terceira Div -->
    <div class="cart-summary">
        <!-- Segunda Div -->
        <div class="product-list">
            <div class="product-item">
                <img src="img/product1.jpg" alt="Produto 1" class="product-image">
                <div class="product-details">
                    <div class="product-name">Tênis Esportivo</div>
                    <div class="product-meta">Cor: Azul | Tamanho: 42</div>
                    <div class="product-price">R$ 299,90</div>
                </div>
            </div>
            <div class="product-item">
                <img src="img/product2.jpg" alt="Produto 2" class="product-image">
                <div class="product-details">
                    <div class="product-name">Chinelo de Praia</div>
                    <div class="product-meta">Cor: Preto | Tamanho: 40</div>
                    <div class="product-price">R$ 49,90</div>
                </div>
            </div>
        </div>

        <!-- Terceira Div -->
        <div class="discount-section">
            <h3>Cupom de Desconto</h3>
            <input type="text" placeholder="Insira o cupom">
            <button>Continuar para Identificação</button>
        </div>
    </div>













    <!--trata dos dados do carrinho-->
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

    <br><br><br><br><br>

    <!-- Inclui o rodapé -->
    <?php include 'footer.html'; ?>
    
</body>
</html>