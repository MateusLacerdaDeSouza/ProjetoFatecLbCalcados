
<?php

// Inclua o arquivo de conexão com o banco de dados
require_once __DIR__ . '/config/connection.php';

// Crie uma instância da classe de conexão
$dbConnection = new Connection();

// Obtenha a conexão
$mysqli = $dbConnection->conectar();

// Verifique se a conexão foi bem-sucedida
if ($mysqli->connect_error) {
    die("Erro de conexão: " . $mysqli->connect_error);
}




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['cart'])) {
        $cart = json_decode($_POST['cart'], true);

        if (!empty($cart)) {
            foreach ($cart as $item) {
              //  echo "Produto: " . htmlspecialchars($item['description']) . "<br>";
               // echo "Cor: " . htmlspecialchars($item['color']) . "<br>";
              //  echo "Tamanho: " . htmlspecialchars($item['size']) . "<br>";
               // echo "Quantidade: " . htmlspecialchars($item['quantity']) . "<br>";
              //  echo "<hr>";
            }
        } else {
            echo "Carrinho vazio ou inválido.";
        }
    } else {
        echo "Nenhum dado do carrinho recebido.";
    }
} else {
    echo "Método inválido.";
}

// Verifica se o carrinho não está vazio para buscar detalhes no banco de dados
if (!empty($cart)) {
    foreach ($cart as $item) {
        // Nome do produto no carrinho
        $productName = htmlspecialchars($item['description']);

        // Prepara a consulta no banco de dados para buscar detalhes do produto
        $query = "SELECT url_img, preco FROM produtos WHERE nome = ?";
        $stmt = $mysqli->prepare($query);

        if ($stmt) {
            $stmt->bind_param('s', $productName); // Passa o nome do produto como parâmetro
            $stmt->execute();
            $result = $stmt->get_result();
            $productDetails = $result->fetch_assoc();

            // Verifica se o produto foi encontrado no banco
            if ($productDetails) {
                //echo "<div class='car-product'>";
               // echo "<img src='administrador/" . htmlspecialchars($productDetails['url_img']) . "' alt='" . $productName . "' class='car-product-image'>";
               // echo "<div class='car-product-details'>";
               // echo "<h3>" . $productName . "</h3>";
               // echo "<span class='car-product-price'>R$ " . number_format($productDetails['preco'], 2, ',', '.') . "</span>";
               // echo "</div>";
               // echo "<div class='car-attributes'>";
               // echo "<p>Cor: " . htmlspecialchars($item['color']) . "</p>";
               // echo "<p>|</p>";
               // echo "<p>Tamanho: " . htmlspecialchars($item['size']) . "</p>";
               // echo "<p>|</p>";
                //echo "<p>Quantidade: " . htmlspecialchars($item['quantity']) . "</p>";
               // echo "</div>";
                //echo "</div>";
            } else {
                echo "<p class='error'>Produto não encontrado no banco de dados: " . $productName . "</p>";
            }
            $stmt->close();
        } else {
            echo "<p class='error'>Erro ao preparar a consulta para o produto: " . $productName . "</p>";
        }
    }
} else {
    echo "<p class='empty-cart'>Carrinho vazio ou inválido.</p>";
}
?>

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

</head>
<body>
    <!-- Inclui header -->
    <?php include 'header-sec.html'; ?>

    <!-- Barra de progresso -->
    <div class="progress-bar">
        <div class="step" data-step="1">
            <div class="step-circle">1</div>
            <div class="step-text">Carrinho</div>
        </div>

        <div class="step" data-step="2">
            <div class="step-circle">2</div>
            <div class="step-text">Identificação</div>
        </div>

        <div class="step" data-step="3">
            <div class="step-circle">3</div>
            <div class="step-text">Entrega</div>
        </div>

        <div class="step" data-step="4">
            <div class="step-circle">4</div>
            <div class="step-text">Pagamento</div>
        </div>
    </div>

    <!-- Seções de conteúdo -->
    <!--passo1-->
            <div class="content-section active" id="step-1">
    <!-- Botões de navegação -->
            <div class="nav-carrinho">
            <button onclick="nextStep(2)">Continuar para Identificação</button>
        </div>

                <div class="car-container">
                <!-- Div à esquerda: Detalhes do carrinho -->
                <div class="car-details">
                    <?php foreach ($cart as $item): ?>
                        <div class="car-product">
                            <img src="administrador/<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['description']); ?>" class="car-product-image">
                            <div class="car-product-details">
                                <h3>
                                    <?php echo htmlspecialchars($item['description']); ?>
                                    <span class="car-product-price">R$ <?php echo number_format($item['price'], 2, ',', '.'); ?></span>
                                </h3>
                                <div class="car-attributes">
                                    <p>Cor: <?php echo htmlspecialchars($item['color']); ?></p>
                                    <p>|</p>
                                    <p>Tamanho: <?php echo htmlspecialchars($item['size']); ?></p>
                                    <p>|</p>
                                    <p>Quantidade: <?php echo htmlspecialchars($item['quantity']); ?></p>
                                </div>
                                <!-- Formulário de remoção -->
                                 <!-- Botão de remoção -->
                                <button class="remove-item">Remover</button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            
    

            <!-- Div à direita: Cupons e valor total -->
        <div class="car-summary">
                <h3 class="titulo-cupom">Cupom de Desconto</h3>
                <div class="coupon-row">
                    <input type="text" id="coupon-input" placeholder="Insira o cupom" class="car-coupon-input">
                    <button class="car-coupon-button" onclick="applyCoupon()">Aplicar</button>
                </div>
                <p class="car-info-text">Vale-compra ou cartão presente:</p>
                <p class="car-info">Devem ser inseridos na etapa de pagamento.</p>
                <div class="items-summary">
                    <p class="align-left">Itens (2)</p>
                    <p class="align-right" id="items-total">R$ 349,80</p>
                </div>
                <hr class="car-divider">
                <div class="total-summary">
                    <p class="align-left-total">Total</p>
                    <p class="align-right-total" id="total-price">R$ 349,80</p>
                </div>
                <div class="exchange-info">
                    <div class="arrows">
                        <span class="arrow">→</span>
                        <span class="arrow">←</span>
                    </div>
                    <span>Troca facilitada para os nossos produtos</span>
                </div>


                <div class="bag-icon">
                    <img src="img/sacola.png" alt="Sacola" class="bag-image">
                    <span class="bag-text">Compre e retire grátis na loja no mesmo dia</span>
                </div>
            </div>
        </div>
    </div>


    <!--passo2-->
    <div class="content-section" id="step-2">
        <div class="button-group">
            <button onclick="prevStep(1)">Voltar para Carrinho</button>
            <button onclick="nextStep(3)">Continuar para Entrega</button>
        </div>

        <div class="ident-container">
            <h3 class="ident-title">Informações do Cliente</h3>
            <div class="ident-info-row">
                <label class="ident-label">CPF:</label>
                <span class="ident-value">123.456.789-00</span>
            </div>
            <div class="ident-info-row">
                <label class="ident-label">E-mail:</label>
                <span class="ident-value">cliente@email.com</span>
            </div>
            <div class="ident-info-row">
                <label class="ident-label">Telefone:</label>
                <span class="ident-value">(11) 91234-5678</span>
            </div>
        </div>

    </div>
    
    <!--passo3-->
    <div class="content-section" id="step-3">
        <div class="button-group">
            <button onclick="prevStep(2)">Voltar para Identificação</button>
            <button onclick="nextStep(4)">Continuar para Pagamento</button>
        </div>

        <div class="endereco-container">
            <h3 class="endereco-title">Dados da Entrega</h3>
            <div class="endereco-info-row">
                <label class="endereco-label">CPF:</label>
                <span class="endereco-value" id="cpf">123.456.789-00</span>
            </div>
            <div class="endereco-info-row">
                <label class="endereco-label">E-mail:</label>
                <span class="endereco-value" id="email">cliente@email.com</span>
            </div>
            <div class="endereco-info-row">
                <label class="endereco-label">Telefone:</label>
                <span class="endereco-value" id="telefone">(11) 91234-5678</span>
            </div>
            <div class="endereco-info-row">
                <label class="endereco-label">Endereço:</label>
                <span class="endereco-value" id="endereco">Rua Exemplo, 123, São Paulo - SP</span>
            </div>
            <div class="endereco-info-row endereco-edit-fields" style="display: none;">
                <label class="endereco-label">Novo Endereço:</label>
                <input type="text" id="edit-endereco" value="Rua Exemplo, 123, São Paulo - SP" class="endereco-input">
            </div>
            <button id="alterar-endereco" class="endereco-button">Alterar Endereço</button>
        </div>
    </div>

    <!--passo4-->
    <div class="content-section" id="step-4">
        <div class="button-group">
            <button onclick="prevStep(3)">Voltar para Entrega</button>
            <button onclick="finishOrder()">Finalizar Pedido</button>
        </div>

        <div class="pag-container">
            <h3 class="pag-title">Pagamento</h3>

            <!-- Métodos de pagamento -->
            <div class="pag-methods">
                <h4>Selecione o método de pagamento</h4>
                <label><input type="radio" name="payment" value="Cartão de crédito" checked> Cartão de Crédito</label>
                <label><input type="radio" name="payment" value="Cartão de Débito"> Cartão de Débito</label>
                <label><input type="radio" name="payment" value="Boleto"> Boleto</label>
                <label><input type="radio" name="payment" value="pix"> PIX</label>
            </div>

            <!-- Vale-compra ou cartão presente -->
            <div class="pag-voucher-container">
                <h4>Vale-compra ou Cartão Presente</h4>
                <input type="text" id="voucher-code" class="pag-input-text" placeholder="Insira o código">
                <button class="pag-button" onclick="applyVoucher()">Aplicar</button>
            </div>

            <!-- Total -->
            <div class="pag-total-container">
                <p>Valor Total: <span id="total-amount">R$ 350,00</span></p>
            </div>

            <!-- Botão de pagamento -->
            <button class="pag-button" onclick="verifyPayment()">Pagar</button>

            <!-- Mensagem de status -->
            <p id="status-message"></p>

            <!-- Botão de finalização -->
            <div id="finish-container" class="pag-finish-container" style="display: none;">
                <button class="pag-button" onclick="finishOrder()">Finalizar Pedido</button>
            </div>
        </div>

        <!--ponto de parada -->
    </div>

    <script>
        function nextStep(step) {
            updateStep(step);
        }

        function prevStep(step) {
            updateStep(step);
        }

        function updateStep(step) {
            // Atualiza barra de progresso
            document.querySelectorAll('.step').forEach((el) => {
                el.classList.remove('active');
                if (parseInt(el.dataset.step) === step) {
                    el.classList.add('active');
                }
            });

            // Atualiza seção de conteúdo
            document.querySelectorAll('.content-section').forEach((el) => {
                el.classList.remove('active');
            });
            document.getElementById(`step-${step}`).classList.add('active');
        }

        function finishOrder() {
            alert("Pedido Finalizado com Sucesso!");
            // Aqui você pode redirecionar para outra página
        }
    </script>

    <script>
        // Adiciona um event listener a todos os botões de remoção
        document.querySelectorAll('.remove-item').forEach(button => {
            button.addEventListener('click', function() {
                // Encontra o elemento pai (o item do carrinho) e o remove
                const item = this.closest('.car-product');
                if (item) {
                    item.remove();
                }
            });
        });
    </script>


    <script>
        // Total inicial dos itens
        let originalTotal = 349.80;

        function applyCoupon() {
            const couponInput = document.getElementById('coupon-input').value.trim();
            const totalElement = document.getElementById('total-price');

            if (couponInput === "LBCALCADOS") {
                const discountedTotal = originalTotal - 50.00;
                totalElement.textContent = `R$ ${discountedTotal.toFixed(2)}`;
            }
        }
    </script>

    <script>
        document.getElementById('alterar-endereco').addEventListener('click', function () {
            const alterarBotao = document.getElementById('alterar-endereco');
            const editFields = document.querySelector('.endereco-edit-fields');
            const enderecoSpan = document.getElementById('endereco');
            const inputEndereco = document.getElementById('edit-endereco');

            if (alterarBotao.textContent === 'Alterar Endereço') {
                // Exibir os campos de edição e mudar o texto do botão
                editFields.style.display = 'flex';
                enderecoSpan.style.display = 'none';
                alterarBotao.textContent = 'Confirmar Endereço';
            } else {
                // Atualizar os dados e voltar à visualização original
                const novoEndereco = inputEndereco.value;
                enderecoSpan.textContent = novoEndereco;
                enderecoSpan.style.display = 'inline';
                editFields.style.display = 'none';
                alterarBotao.textContent = 'Alterar Endereço';
            }
        });
    </script>

    <script>
        let totalAmount = 350.00; // Valor inicial antes de aplicar cupom ou voucher
        function applyVoucher() {
            const voucherCode = document.getElementById("voucher-code").value.trim();
            let discount = 0;

            if (voucherCode === "LBCALCADOS") {
                discount = 50.00;
            }

            if (discount > 0) {
                totalAmount -= discount;
                document.getElementById("total-amount").innerText = `R$ ${totalAmount.toFixed(2)}`;
                alert("Vale-compra aplicado com sucesso!");
            } else {
                alert("Código inválido ou sem desconto disponível.");
            }
        }

        function verifyPayment() {
            const isPaymentSuccessful = Math.random() < 0.7; // Simula 70% de chance de sucesso

            if (isPaymentSuccessful) {
                document.getElementById("status-message").innerText = "Pagamento realizado com sucesso!";
                document.getElementById("status-message").className = "pag-success";
                document.getElementById("finish-container").style.display = "block";
            } else {
                document.getElementById("status-message").innerText = "Falha no pagamento. Tente novamente.";
                document.getElementById("status-message").className = "pag-error";
            }
        }

        function finishOrder() {
            // Simula a criação de uma nota fiscal
            const invoice = `
                Nota Fiscal
                -------------------
                Valor Total: R$ ${totalAmount.toFixed(2)}
                Método de Pagamento: ${document.querySelector('input[name="payment"]:checked').value}
            `;

            // Envia a nota para outra página
            const form = document.createElement("form");
            form.method = "POST";
            form.action = "nota-fiscal.php";

            const input = document.createElement("input");
            input.type = "hidden";
            input.name = "invoice";
            input.value = invoice;

            form.appendChild(input);
            document.body.appendChild(form);
            form.submit();
        }
    </script>
    
    <!-- Inclui o rodapé -->
    <?php include 'footer.html'; ?>
</body>
</html>
