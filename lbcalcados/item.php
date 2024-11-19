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
    <!--inclui o Header-->
    <?php include 'header.php'; ?>

    <!-- primeira div principal -->
    <div class="product-card">
        <!-- Imagem com balão de desconto -->
        <div class="image-section">
            <div class="discount-tag">
                <p>50% OFF</p>
            </div>
            <img src="img/bota-alta.jpeg" alt="Produto">
        </div>

        <!-- Área de conteúdo textual e botões -->
        <div class="info-section">
            <h3 class="marca">PANDORA</h3>
            <p class="description">Bota Cano Alto Salto 12cm</p>
            
            <!-- Avaliação e nota -->
            <div class="rating">
                <span class="star">&#9733;</span> <!-- Ícone de estrela -->
                <span class="rating-number"> -/5</span>
            </div>
            
            <!-- Preços e parcelamento -->
            <div class="pricing">
                <span class="price">R$ 175,00</span>
                <span class="old-price">R$ 350,00</span>
            </div>
            <p class="parcelamento">2x de R$ 87,50</p>
            
            <!-- Barra fina e outras informações -->
            <div class="separator"></div>
            <div class="color">
                <p class="color-a">Cor:</p>
                <p>Preto</p> 
            </div>
            
            <!-- imagem menor (direita) -->
            <img src="img/bota-alta.jpeg" alt="Cor Preto" class="color-sample">
            
            <!-- Seleção de tamanho -->
            <div class="size-options">
                <p>Tamanho:</p>
                <div class="buttons">
                    <button class="size-btn">35 BR</button>
                    <button class="size-btn">36 BR</button>
                    <button class="size-btn">37 BR</button>
                    <button class="size-btn">38 BR</button>
                    <button class="size-btn">39 BR</button>
                    <button class="size-btn">40 BR</button>
                </div>
            </div>
            
            <!-- Botoes de quantidade e carrinho -->
            <div class="actions">
                <!-- Botao de quantidade -->
                <div class="quantity-container">
                    <button class="quantity-btn" id="decrease">-</button>
                    <input type="number" id="quantity" value="1" min="0" max="10" readonly>
                    <button class="quantity-btn" id="increase">+</button>
                </div>

                <button class="cart-btn">ADICIONAR AO CARRINHO</button>
            </div>

        </div>
    </div>

    <!-- segunda div principal -->
    <div class="second-container">
        <!-- Div Esquerda -->
        <div class="left-side">
            <!-- Botões expansíveis -->
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

        <!-- Div Direita -->
        <div class="right-side">
            <!-- Texto Frete -->
            <h3 class="frete-title">Frete</h3>
            
            <!-- Botão grande para consulta de entrega -->
            <div class="big-delivery-btn">
                <span class="delivery-text">Consulte o prazo de entrega</span>
                <span id="cep-text" onclick="showCepInput()">Adicionar CEP</span>
                <input type="text" id="cep-input" placeholder="Digite seu CEP" style="display: none;">
            </div>
            
            <!-- Texto Troca e Devolução com Setas Empilhadas -->
            <div class="exchange-info">
                <div class="arrows">
                    <span class="arrow">→</span>
                    <span class="arrow">←</span>
                </div>
                <span>Trocas e devoluções grátis em 30 dias</span>
            </div>

        </div>
    </div>

    <!-- Div Principal de Avaliações -->
    <div class="reviews-container">
        <!-- Parte Esquerda -->
        <div class="left-side">
            <h3>Avaliações do produto</h3>
            
            <!-- Card de Avaliação -->
            <div class="review-card">
                <div class="star-rating">
                    <span class="star-principal">★</span>
                    <span class="nota-principal">- / 5</span>
                </div>
                <p>0 avaliações</p>
                
                <!-- Avaliações por Estrelas -->
                <div class="rating-scale">
                    <div class="rating-item">
                        <span class="star-secundaria">★</span><span class="nota-aval">5</span><span class="line"></span><span class="nota-aval">0</span>
                    </div>
                    <div class="rating-item">
                        <span class="star-secundaria">★</span><span class="nota-aval">4</span><span class="line"></span><span class="nota-aval">0</span>
                    </div>
                    <div class="rating-item">
                        <span class="star-secundaria">★</span><span class="nota-aval">3</span><span class="line"></span><span class="nota-aval">0</span>
                    </div>
                    <div class="rating-item">
                        <span class="star-secundaria">★</span><span class="nota-aval">2</span><span class="line"></span><span class="nota-aval">0</span>
                    </div>
                    <div class="rating-item">
                        <span class="star-secundaria">★</span><span class="nota-aval">1</span><span class="line"></span><span class="nota-aval">0</span>
                    </div>
                </div>
                
                <!-- Botão de Avaliar -->
                <button class="rate-btn">Avaliar Produto</button>
            </div>
        </div>

        <!-- Parte Direita -->
        <div class="right-side">
            <p class="view-all-btn">Ver todas as avaliações <span class="arrow">→</span></p>
        </div>
    </div>

    <!-- Inclui o rodapé -->
    <?php include 'footer.html'; ?>

    <!-- Script JavaScript -->
    <script>
        // Função para aumentar a quantidade
        document.getElementById('increase').addEventListener('click', function() {
            let quantityInput = document.getElementById('quantity');
            let quantity = parseInt(quantityInput.value);
            if (quantity < 10) {
                quantityInput.value = quantity + 1;
            }
        });

        // Função para diminuir a quantidade
        document.getElementById('decrease').addEventListener('click', function() {
            let quantityInput = document.getElementById('quantity');
            let quantity = parseInt(quantityInput.value);
            if (quantity > 0) {
                quantityInput.value = quantity - 1;
            }
        });
    </script>

    <!-- script para a seguna div-->
    <script>
        // Função para alternar detalhes dos botões expansíveis
        function toggleDetails(id) {
            const details = document.getElementById(id);
            details.style.display = details.style.display === 'none' ? 'block' : 'none';
        }

        // Função para mostrar campo de entrada de CEP
        function showCepInput() {
            const cepText = document.getElementById("cep-text");
            const cepInput = document.getElementById("cep-input");
            cepText.style.display = "none";
            cepInput.style.display = "inline";
            cepInput.focus();
        }
    </script>

</body>
</html>