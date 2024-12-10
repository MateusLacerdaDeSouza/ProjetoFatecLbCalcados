


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Header</title>
    <link rel="stylesheet" href="css/header.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');
        body {
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease; /* Transição suave */
        }

        /* Classe para desabilitar a rolagem da página */
        .no-scroll {
            overflow: hidden;
        }

        /* Estilo para o menu deslizante */
        .cart-menu {
            position: fixed;
            top: 0;
            right: -300px;
            width: 300px;
            height: 100%;
            background-color: #fff;
            box-shadow: -2px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            transition: right 0.3s ease-in-out;
            z-index: 1000;
        }
        .cart-menu.active {
            right: 0;
        }
        .cart-menu .close-btn {
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
            color: #333;
            border: none;
            background: none;
            margin-bottom: 20px;
        }
        .cart-items {
            overflow-y: auto;
            max-height: 60%;
        }
        .cart-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ddd;
        }
        .cart-item span {
            font-size: 14px;
        }
        .cart-item .remove-btn {
            font-size: 16px;
            color: red;
            cursor: pointer;
        }
        .buttons-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .buttons-container button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
        }

        .h3-car {
            padding-bottom: 20px;
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
            <a href="login.php"><img src="img/perfil.png" alt="Perfil" class="icon"/></a>
            <img src="img/carrinho.png" alt="Carrinho" class="icon" id="cartIcon"/>
        </div>
    </header>

    <!-- Menu Deslizante do Carrinho -->
    <div class="cart-menu" id="cartMenu">
        <button class="close-btn" id="closeCartBtn">X</button>
        <h3 class="h3-car">MEU CARRINHO</h3>
        <div class="cart-items" id="cartItems">
            <!-- Itens do carrinho serão carregados aqui -->
        </div>
        <div class="buttons-container">
            <button id="checkoutBtn">Finalizar Compra ></button>
            <button id="continueShoppingBtn">Continuar Comprando</button>
        </div>
    </div>

    <!-- Barra de navegação -->
    <nav class="top-bar">
        <ul>
            <li><a href="./pesquisa-item.php">Botas</a></li>
            <li><a href="./pesquisa-item.php">Scarpin</a></li>
            <li><a href="./pesquisa-item.php">Sapatilha</a></li>
            <li><a href="./pesquisa-item.php">Sandália</a></li>
            <li><a href="./pesquisa-item.php">Diversos</a></li>
        </ul>
    </nav>

    <script>
        // Selecionando os elementos
        const cartIcon = document.getElementById('cartIcon');
        const cartMenu = document.getElementById('cartMenu');
        const closeCartBtn = document.getElementById('closeCartBtn');
        const continueShoppingBtn = document.getElementById('continueShoppingBtn');
        const checkoutBtn = document.getElementById('checkoutBtn');
        const cartItemsContainer = document.getElementById('cartItems');

        // Função para abrir o menu do carrinho
        cartIcon.addEventListener('click', function() {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];
            if (cart.length > 0) {
                // Exibe os itens no menu
                cartItemsContainer.innerHTML = '';
                cart.forEach((item, index) => {
                    const itemElement = document.createElement('div');
                    itemElement.classList.add('cart-item');
                    itemElement.innerHTML = `
                        <span>Cor: ${item.color}, Tamanho: ${item.size}</span>
                        <span>Qtd: ${item.quantity}</span>
                        <span class="remove-btn" data-index="${index}">X</span>
                    `;
                    itemElement.setAttribute('data-price', item.price);
                    cartItemsContainer.appendChild(itemElement);
                });
                cartMenu.classList.add('active');
                document.body.classList.add('no-scroll'); // Desabilita a rolagem da página
            } else {
                cartItemsContainer.innerHTML = '<p>Seu carrinho está vazio.</p>';
            }
        });

        // Função para fechar o menu do carrinho
        closeCartBtn.addEventListener('click', function() {
            cartMenu.classList.remove('active');
            document.body.classList.remove('no-scroll'); // Habilita a rolagem novamente
        });

        // Função para continuar comprando
        continueShoppingBtn.addEventListener('click', function() {
            cartMenu.classList.remove('active');
            document.body.classList.remove('no-scroll'); // Habilita a rolagem novamente
        });

        // Função para finalizar a compra
        checkoutBtn.addEventListener('click', function() {
            alert('Finalizando a compra...');
            // Aqui você pode redirecionar para a página de checkout, por exemplo.
            window.location.href = 'finalizar_compra.php';

        });

        /*checkoutBtn.addEventListener('click', function () {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];

            if (cart.length === 0) {
                alert('Seu carrinho está vazio!');
                return;
            }

            // Redireciona para a página de checkout
            window.location.href = 'finalizar_compra.php';
        });
        */





        // Função para remover itens do carrinho
        cartItemsContainer.addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-btn')) {
                const index = event.target.getAttribute('data-index');
                const cart = JSON.parse(localStorage.getItem('cart')) || [];
                cart.splice(index, 1); // Remove o item pelo índice
                localStorage.setItem('cart', JSON.stringify(cart));
                event.target.parentElement.remove(); // Remove o item do carrinho na tela
            }
        });

        // Fechar o menu se clicar fora dele
        window.addEventListener('click', function(event) {
            if (!cartMenu.contains(event.target) && event.target !== cartIcon) {
                cartMenu.classList.remove('active');
                document.body.classList.remove('no-scroll'); // Habilita a rolagem novamente
            }
        });

        //enviando o carrinho pra finalizar a compra
        checkoutBtn.addEventListener('click', function () {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];


            console.log(cart);


            if (cart.length === 0) {
                alert('Seu carrinho está vazio!');
                return;
            }

            // Criar um formulário dinâmico
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = 'finalizar_compra.php';

            // Adicionar os dados do carrinho como campos ocultos
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'cart';
            input.value = JSON.stringify(cart);
            form.appendChild(input);

            // Adicionar o formulário ao documento e enviá-lo
            document.body.appendChild(form);
            form.submit();
        });




    </script>

    <!--ponto de parada-->

</body>
</html>