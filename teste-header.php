<?php
session_start();

// Inicializar carrinho na sessão, se não existir
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Obter os itens do carrinho da sessão
$cartItems = $_SESSION['cart'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" href="css/header.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');
        /* Estilo do menu do carrinho */
        .cart-menu {
            position: fixed;
            top: 0;
            right: -400px;
            width: 400px;
            height: 100%;
            background-color: #f8f8f8;
            box-shadow: -4px 0 8px rgba(0, 0, 0, 0.2);
            overflow-y: auto;
            transition: right 0.3s;
            z-index: 1000;
        }

        .cart-menu.open {
            right: 0;
        }

        .cart-header {
            padding: 15px;
            background-color: #eee;
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        .cart-item {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cart-item img {
            max-width: 50px;
        }

        .cart-item-details {
            flex-grow: 1;
            margin-left: 10px;
        }

        .finalize-btn,
        .continue-btn {
            display: block;
            width: 80%;
            margin: 20px auto;
            padding: 10px;
            text-align: center;
            background-color: #333;
            color: #fff;
            border: none;
            cursor: pointer;
            text-transform: uppercase;
        }

        /* Overlay */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            display: none;
        }

        .overlay.active {
            display: block;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <a href="./index.php"><img src="img/B.png" alt="Logo da Marca" /></a>
        </div>
        <div class="search-container">
            <input type="text" placeholder="Procure seu sapato perfeito..." />
            <img src="img/busca.png" alt="Busca" class="icon-busca">
        </div>
        <div class="icons">
            <a href="https://www.instagram.com/weekshoes/"><img src="img/image.png" alt="Instagram da página" class="icon" /></a>
            <a href="#"><img src="img/perfil.png" alt="Perfil" class="icon"/></a>
            <img src="img/carrinho.png" alt="Carrinho" class="icon" id="cart-icon" />
        </div>
    </header>

    <!-- Overlay -->
    <div id="overlay" class="overlay"></div>

    <!-- Menu do Carrinho -->
    <div id="cart-menu" class="cart-menu">
        <div class="cart-header">Seu Carrinho</div>
        <div id="cart-items">
            <?php if (empty($cartItems)) : ?>
                <p style="text-align: center; margin: 20px;">Seu carrinho está vazio.</p>
            <?php else : ?>
                <?php foreach ($cartItems as $item) : ?>
                    <div class="cart-item">
                        <div class="cart-item-details">
                            <strong><?php echo htmlspecialchars($item['color']); ?></strong> - 
                            <?php echo htmlspecialchars($item['size']); ?> (x<?php echo htmlspecialchars($item['quantity']); ?>)
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <button class="finalize-btn">Finalizar Compra</button>
        <button class="continue-btn" id="continue-btn">Continuar Comprando</button>
    </div>

    <script>
        // Elementos do menu
        const cartIcon = document.getElementById('cart-icon');
        const cartMenu = document.getElementById('cart-menu');
        const overlay = document.getElementById('overlay');
        const continueBtn = document.getElementById('continue-btn');

        // Abrir menu do carrinho
        cartIcon.addEventListener('click', () => {
            cartMenu.classList.add('open');
            overlay.classList.add('active');
        });

        // Fechar menu ao clicar fora dele
        overlay.addEventListener('click', () => {
            cartMenu.classList.remove('open');
            overlay.classList.remove('active');
        });

        // Botão "Continuar Comprando"
        continueBtn.addEventListener('click', () => {
            cartMenu.classList.remove('open');
            overlay.classList.remove('active');
            window.location.href = 'teste1.php';
        });

        // Adicionar ao Carrinho (AJAX)
        async function addToCart(color, size, quantity) {
            const formData = new FormData();
            formData.append('color', color);
            formData.append('size', size);
            formData.append('quantity', quantity);

            const response = await fetch('teste.php', {
                method: 'POST',
                body: formData
            });

            if (response.ok) {
                console.log('Produto adicionado ao carrinho');
            } else {
                console.error('Erro ao adicionar produto');
            }
        }
    </script>
</body>
</html>
