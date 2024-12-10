<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LB Calçados</title>
    <link rel="stylesheet" href="css/reset.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');
    </style>
    <link rel="shortcut icon" type="imagex/png" href="img/logo-mini.png">
    <link rel="stylesheet" href="css/cadastro.css">
</head>
<body>
    <!-- Inclui header -->
    <?php include 'header-sec.html'; ?>

    <div class="cadastro-container">
        <div class="cadastro-left">
            <img src="img/sapato-banco.jpg" alt="">
        </div>
        <div class="cadastro-right" id="cadastroRight">
            <!-- Cadastro -->
            <h2 class="cadastro-title">Cadastro</h2>
            <label for="email">Digite seu e-mail</label>
            <input type="email" id="email" class="cadastro-input" placeholder="Digite seu e-mail" required>

            <label for="nome">Nome Completo</label>
            <input type="text" id="nome" name="nome" class="cadastro-input" placeholder="Digite seu nome completo" required>

            <label for="senha">Senha</label>
            <input type="password" id="senha" name="senha" class="cadastro-input" placeholder="Digite sua senha" maxlength="100" required>

            <label for="telefone">Telefone</label>
            <input type="tel" id="telefone" name="telefone" class="cadastro-input" maxlength="15" placeholder="Digite seu telefone" required>

            <label for="endereco">Endereço</label>
            <input type="text" id="endereco" name="endereco" class="cadastro-input" placeholder="Rua Fulano, 123" required>

            <label for="cep">CEP</label>
            <input type="text" id="cep" name="cep" class="cadastro-input" placeholder="Digite seu CEP" maxlength="9" required>

            <label for="cidade">Cidade</label>
            <input type="text" id="cidade" name="cidade" class="cadastro-input" placeholder="Digite sua cidade" required>

            <label for="estado">Estado</label>
            <input type="text" id="estado" name="estado" class="cadastro-input" placeholder="Digite seu estado" required>

            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" class="cadastro-input" maxlength="14" placeholder="Digite seu CPF" required>

            <button class="cadastro-button" onclick="registerUser()">Prosseguir</button>

            <p>Já tem uma conta? <a href="login.php" class="cadastro-link">Faça login</a></p>
        </div>
    </div>

    <script>
        function registerUser() {
            const formData = new FormData();
            formData.append('email', document.getElementById('email').value);
            formData.append('password', document.getElementById('senha').value);
            formData.append('nome', document.getElementById('nome').value);
            formData.append('telefone', document.getElementById('telefone').value);
            formData.append('endereco', document.getElementById('endereco').value);
            formData.append('cidade', document.getElementById('cidade').value);
            formData.append('cpf', document.getElementById('cpf').value);

            fetch('process_register.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    window.location.href = 'perfil.php';
                } else {
                    alert(data.message || 'Erro ao registrar.');
                }
            })
            .catch(error => console.error('Erro:', error));
        }
    </script>

    <?php include 'footer.html'; ?>
</body>
</html>
