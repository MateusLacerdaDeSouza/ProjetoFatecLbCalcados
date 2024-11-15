<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calçados</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/pesquisa-item.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');
    </style>
    <link rel="shortcut icon" type="imagex/png" href="img/logo-mini.png">
</head>
<body>
    <!-- Inclui o Header-->
    <?php include 'header.php'; ?>

    <h1 class="titulo-principal">Botas</h1>

    <div class="sidebar">
        <div class="product-count">
            <p>12</p>
            <p>Produtos</p>
        </div>
        <div class="sort-options">
            <button class="sort-button">
                Mais populares ↓
            </button>
            <div class="dropdown">
                <p class="sort-option">Preço: menor - maior</p>
                <p class="sort-option">Preço: maior - menor</p>
                <p class="sort-option">Mais recentes</p>
                <p class="sort-option">Mais populares</p>
            </div>
        </div>
    </div>

    <div class="page-container">
        <!-- Coluna de Filtros -->
        <aside class="filter-column">
            <h3>Filtros</h3>
            <div class="filter-section">
                <h4>Marcas</h4>
                <label><input type="checkbox"> Pandora</label><br>
                <label><input type="checkbox"> Dakota</label><br>
                <label><input type="checkbox"> Adidas</label><br>
            </div>
            <div class="filter-section">
                <h4>Tamanhos</h4>
                <label><input type="checkbox"> P</label><br>
                <label><input type="checkbox"> M</label><br>
                <label><input type="checkbox"> G</label><br>
            </div>
            <div class="filter-section">
                <h4>Cores</h4>
                <label><input type="checkbox"> Vermelho</label><br>
                <label><input type="checkbox"> Azul</label><br>
                <label><input type="checkbox"> Preto</label><br>
            </div>
        </aside>

        <!-- Seção de Produtos -->
        <main class="product-grid">
            <!-- Produto 1 -->
            <div class="product-card">
                <div class="discount-badge">50% Off</div>
                <img src="img/bota-alta.jpeg" alt="Produto 1">
                <p class="product-name">Produto 1</p>
                <p class="product-description">Descrição breve do produto 1.</p>
                <p class="product-price"><span class="old-price">R$100,00</span> R$50,00</p>
            </div>
            
            <!-- Produto 2 -->
            <div class="product-card">
                <img src="img/bota-alta.jpeg" alt="Produto 2">
                <p class="product-name">Produto 2</p>
                <p class="product-description">Descrição breve do produto 2.</p>
                <p class="product-price">R$120,00</p>
            </div>
            
            <!-- Produto 2 -->
            <div class="product-card">
                <img src="img/bota-alta.jpeg" alt="Produto 2">
                <p class="product-name">Produto 2</p>
                <p class="product-description">Descrição breve do produto 2.</p>
                <p class="product-price">R$120,00</p>
            </div>

            <!-- Produto 2 -->
            <div class="product-card">
                <img src="https://via.placeholder.com/150" alt="Produto 2">
                <p class="product-name">Produto 2</p>
                <p class="product-description">Descrição breve do produto 2.</p>
                <p class="product-price">R$120,00</p>
            </div>

            <!-- Produto 2 -->
            <div class="product-card">
                <img src="https://via.placeholder.com/150" alt="Produto 2">
                <p class="product-name">Produto 2</p>
                <p class="product-description">Descrição breve do produto 2.</p>
                <p class="product-price">R$120,00</p>
            </div>
            
            <!-- Produtos adicionais podem ser duplicados com HTML estático ou renderizados dinamicamente -->
        </main>
    </div>




























    <!-- Inclui o rodapé -->
    <?php include 'footer.html'; ?>



    <script>

        // Alterna o menu dropdown
        document.querySelector('.sort-button').onclick = function() {
            document.querySelector('.sort-options').classList.toggle('active');
        };

        // Seleciona todas as opções do dropdown
        document.querySelectorAll('.sort-option').forEach(option => {
            option.onclick = function() {
                // Atualiza o texto do botão para a opção escolhida
                document.querySelector('.sort-button').textContent = option.textContent + ' ↓';
                
                // Fecha o dropdown
                document.querySelector('.sort-options').classList.remove('active');
            };
        });



    </script>
    
</body>
</html>