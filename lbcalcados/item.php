<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LB Calçados</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/item.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');
    </style>
    <link rel="shortcut icon" type="imagex/png" href="img/logo-mini.png">
</head>
<body>
    <!-- Inclui o Header -->
    <?php include 'header.php'; ?>

    <?php 
    require_once __DIR__ . '/models/produto.php';

    if (isset($_GET['id'])) {
        $id_produto = intval($_GET['id']);
        $produtoObj = new Produto();
        $produto = $produtoObj->buscarProduto($id_produto);
    }

    if (!$produto) {
        echo "<p>Produto não encontrado!</p>";
        exit;
    }

    // Busca produtos relacionados (mesmo modelo/tamanhos diferentes)
    //$produtosRelacionados = $produtoObj->buscarProdutosAgrupados($produto['nome']);
    //$tamanhosDisponiveis = $produtoObj->buscarTamanhosPorProduto($nomeProduto);
    // Busca os tamanhos disponíveis no banco de dados
    $tamanhosDisponiveis = $produtoObj->buscarTamanhosPorProduto($produto['nome']);

    ?>

    <!-- Primeira div principal -->
    <div class="product-card">
        <!-- Imagem com balão de desconto -->
        <div class="image-section">
            <div class="discount-tag">
                <p>50% OFF</p>
            </div>
            <img src="<?php echo 'administrador/' . $produto['url_img']; ?>" alt="<?php echo $produto['nome']; ?>">
        </div>

        <!-- Área de conteúdo textual e botões -->
        <div class="info-section">
            <h3 class="marca"><?php echo $produto['marca']; ?></h3>
            <p class="description"><?php echo $produto['nome']; ?></p>
            
            <!-- Avaliação e nota -->
            <div class="rating">
                <span class="star">&#9733;</span>
                <span class="rating-number">4/5</span>
            </div>
            
            <!-- Preços e parcelamento -->
            <div class="pricing">
                <span class="price">R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></span>
                <span class="old-price">R$ 350,00</span>
            </div>
            <p class="parcelamento">2x de R$ <?php echo number_format($produto['preco'] / 2, 2, ',', '.'); ?></p>
            
            <!-- Barra fina e outras informações -->
            <div class="separator"></div>
            <div class="color">
                <p class="color-a">Cor:</p>
                <p><?php echo $produto['cor']; ?></p> 
            </div>
            
            <!-- Imagem menor (direita) -->
            <img src="<?php echo 'administrador/' . $produto['url_img']; ?>" alt="<?php echo $produto['nome']; ?>" class="color-sample">
            
            <!-- Seleção de tamanho -->
            <!-- Seleção de tamanho -->
            <div class="size-options">
                <p>Tamanho:</p>
                <div class="buttons">
                    <?php 
                    $tamanhosFixos = range(35, 40); // Tamanhos padrão
                    foreach ($tamanhosFixos as $tamanho):
                        $disponivel = in_array($tamanho, $tamanhosDisponiveis); // Verifica se está disponível
                    ?>
                        <button 
                            class="size-btn <?php echo $disponivel ? '' : 'disabled'; ?>" 
                            <?php if ($disponivel): ?> 
                                onclick="selecionarTamanho(this)"
                                 data-size="<?php echo $tamanho; ?>"
                            <?php else: ?> 
                                disabled 
                            <?php endif; ?>>
                            <?php echo $tamanho; ?> BR
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>


            
            <!-- Botões de quantidade e carrinho -->
            <div class="actions">
                <div class="quantity-container">
                    <button class="quantity-btn" id="decrease">-</button>
                    <input type="number" id="quantity" value="1" min="1" max="10" readonly>
                    <button class="quantity-btn" id="increase">+</button>
                </div>
                <button id="addToCartBtn" class="cart-btn">ADICIONAR AO CARRINHO</button>
            </div>
        </div>
    </div>

    <!-- Segunda div principal -->
    <div class="second-container">
        <div class="left-side">
            <button class="expandable-btn" onclick="toggleDetails('details1')">
                Informações técnicas
                <span class="plus-icon">+</span>
            </button>
            <div id="details1" class="details" style="display: none;">
                <p>Bota preta, made in China........</p>
            </div>
            
            <button class="expandable-btn" onclick="toggleDetails('details2')">
                Características
                <span class="plus-icon">+</span>
            </button>
            <div id="details2" class="details" style="display: none;">
                <p>Bota preta, made in China......</p>
            </div>
        </div>

        <div class="right-side">
            <h3 class="frete-title">Frete</h3>
            <div class="big-delivery-btn">
                <span class="delivery-text">Consulte o prazo de entrega</span>
                <span id="cep-text" onclick="showCepInput()">Adicionar CEP</span>
                <input type="text" id="cep-input" placeholder="Digite seu CEP" style="display: none;">
            </div>
            <div class="exchange-info">
                <div class="arrows">
                    <span class="arrow">→</span>
                    <span class="arrow">←</span>
                </div>
                <span>Trocas e devoluções grátis em 30 dias</span>
            </div>
        </div>
    </div>

    <!-- Inclui o rodapé -->
    <?php include 'footer.html'; ?>

    <script>
    function selecionarTamanho(button, tamanho) {
        // Remove a classe "selected" de todos os botões
        document.querySelectorAll('.size-btn').forEach(btn => btn.classList.remove('selected'));
        
        // Adiciona a classe "selected" ao botão clicado
        button.classList.add('selected');
        
        // Aqui você pode armazenar o tamanho selecionado para enviar ao backend
        console.log("Tamanho selecionado: " + tamanho);
    }
    </script>


    <!-- Script JavaScript -->
    <script>
        // Função para alterar quantidade
        document.getElementById('increase').addEventListener('click', function() {
            let quantityInput = document.getElementById('quantity');
            let quantity = parseInt(quantityInput.value);
            if (quantity < 10) quantityInput.value = quantity + 1;
        });

        document.getElementById('decrease').addEventListener('click', function() {
            let quantityInput = document.getElementById('quantity');
            let quantity = parseInt(quantityInput.value);
            if (quantity > 1) quantityInput.value = quantity - 1;
        });

        // Função para detalhes expansíveis
        function toggleDetails(id) {
            const details = document.getElementById(id);
            details.style.display = details.style.display === 'none' ? 'block' : 'none';
        }

        // Função para mostrar campo de CEP
        function showCepInput() {
            const cepText = document.getElementById("cep-text");
            const cepInput = document.getElementById("cep-input");
            cepText.style.display = "none";
            cepInput.style.display = "inline";
            cepInput.focus();
        }

        const colorSamples = document.querySelectorAll('.color-sample');
        colorSamples.forEach(color => {
            color.addEventListener('click', () => {
                colorSamples.forEach(c => c.style.border = 'none');
                color.style.border = '2px solid red';
            });
        });

        const sizeBtns = document.querySelectorAll('.size-btn');
        sizeBtns.forEach(btn => {
            btn.addEventListener('click', () => {
                sizeBtns.forEach(b => b.style.border = 'none');
                btn.style.border = '2px solid red';
            });
        });

        document.getElementById('addToCartBtn').addEventListener('click', function () {
            const selectedSize = document.querySelector('.size-btn.selected');
            const quantity = parseInt(document.getElementById('quantity').value);
            const description = document.querySelector('.description').textContent.trim();
            const colorElement = document.querySelector('.color p:nth-child(2)');
            const color = colorElement ? colorElement.textContent.trim() : null;
           
            const priceElement = document.querySelector('.price'); // Certifique-se de ter uma classe ou id para o preço na sua página
            const price = priceElement ? parseFloat(priceElement.textContent.trim().replace('R$', '').replace(',', '.')) : null;
            const productImage = '<?php echo addslashes($produto['url_img']); ?>';

            if (!selectedSize) {
                alert('Selecione o tamanho antes de adicionar ao carrinho.');
                return;
            }

            if (!color) {
                alert('Erro ao identificar a cor. Verifique o HTML.');
                return;
            }

            const item = {
                description: description,
                color: color,
                size: selectedSize.getAttribute('data-size'),
                quantity: quantity,
                price: price, // Inclua o preço
                image: productImage // Inclua a URL da imagem 
            };

            let cart = JSON.parse(localStorage.getItem('cart')) || [];

            const existingItemIndex = cart.findIndex(i => i.description === item.description && i.color === item.color && i.size === item.size);

            if (existingItemIndex >= 0) {
                cart[existingItemIndex].quantity += item.quantity;
            } else {
                cart.push(item);
            }

            localStorage.setItem('cart', JSON.stringify(cart));

            // Produto foi adicionado ao carrinho
            alert('Produto adicionado ao carrinho!');
        });
    </script>





</body>
</html>
