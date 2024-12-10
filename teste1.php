<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produto</title>
    <style>
        .size-btn.selected {
            background-color: #FFD700;
            color: #FFF;
            font-weight: bold;
        }
        .image-btn {
            border: none;
            background: none;
            cursor: pointer;
        }
        .image-btn img {
            max-width: 100px;
        }
    </style>
</head>
<body>
    <form id="cart-form" action="teste.php" method="POST">
        <!-- Cor -->
        <button class="image-btn" type="button" onclick="selectColor('Red')">
            <img src="path/to/red-image.jpg" alt="Red">
        </button>
        <button class="image-btn" type="button" onclick="selectColor('Blue')">
            <img src="path/to/blue-image.jpg" alt="Blue">
        </button>

        <!-- Tamanhos -->
        <div>
            <button class="size-btn" type="button" onclick="selectSize('35 BR')">35 BR</button>
            <button class="size-btn" type="button" onclick="selectSize('36 BR')">36 BR</button>
            <button class="size-btn" type="button" onclick="selectSize('37 BR')">37 BR</button>
            <button class="size-btn" type="button" onclick="selectSize('38 BR')">38 BR</button>
        </div>

        <!-- Quantidade -->
        <div>
            <button type="button" id="decrease">-</button>
            <input type="number" id="quantity" name="quantity" value="1" min="1" max="10" readonly>
            <button type="button" id="increase">+</button>
        </div>

        <!-- Botão Adicionar -->
        <button type="submit">Adicionar ao Carrinho</button>

        <!-- Campos ocultos para enviar dados -->
        <input type="hidden" id="selectedColor" name="color">
        <input type="hidden" id="selectedSize" name="size">
    </form>

    <script>
        let selectedColor = '';
        let selectedSize = '';

        // Selecionar cor
        function selectColor(color) {
            selectedColor = color;
            document.getElementById('selectedColor').value = color;
        }

        // Selecionar tamanho
        function selectSize(size) {
            selectedSize = size;

            // Atualizar valor no campo oculto
            document.getElementById('selectedSize').value = size;

            // Estilizar botão selecionado
            const buttons = document.querySelectorAll('.size-btn');
            buttons.forEach(button => button.classList.remove('selected'));
            const selectedButton = [...buttons].find(button => button.textContent.trim() === size);
            if (selectedButton) {
                selectedButton.classList.add('selected');
            }
        }

        // Aumentar e diminuir quantidade
        document.getElementById('increase').addEventListener('click', function() {
            const quantityInput = document.getElementById('quantity');
            let quantity = parseInt(quantityInput.value);
            if (quantity < 10) {
                quantityInput.value = quantity + 1;
            }
        });

        document.getElementById('decrease').addEventListener('click', function() {
            const quantityInput = document.getElementById('quantity');
            let quantity = parseInt(quantityInput.value);
            if (quantity > 1) {
                quantityInput.value = quantity - 1;
            }
        });

        // Garantir que os campos obrigatórios estão preenchidos antes de enviar
        document.getElementById('cart-form').addEventListener('submit', function(event) {
            if (!selectedColor || !selectedSize) {
                event.preventDefault();
                alert('Por favor, selecione uma cor e um tamanho antes de adicionar ao carrinho.');
            }
        });
    </script>
</body>
</html>
