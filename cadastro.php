<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LB Calçados - Cadastro</title>
    <link rel="stylesheet" href="css/reset.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');
    </style>
    <link rel="shortcut icon" type="imagex/png" href="img/logo-mini.png">
    <link rel="stylesheet" href="css/cadastro.css">
</head>
<body>
    <?php include 'header-sec.html'; ?>

    <div class="cadastro-container">
        <div class="cadastro-left">
            <img src="img/sapato-banco.jpg" alt="">
        </div>
        <div class="cadastro-right">
            <h2 class="cadastro-title">Cadastro</h2>
            <form id="cadastroForm" onsubmit="submitForm(event)">
                <label for="nome">Nome Completo</label>
                <input type="text" id="nome" name="nome" class="cadastro-input" placeholder="Digite seu nome completo" required>

                <label for="email">E-mail</label>
                <input type="email" id="email" name="email" class="cadastro-input" placeholder="Digite seu e-mail" required>

                <label for="senha">Senha</label>
                <input type="password" id="senha" name="senha" class="cadastro-input" placeholder="Digite sua senha" maxlength="100" required>

                <label for="telefone">Telefone</label>
                <input type="tel" id="telefone" name="telefone" class="cadastro-input" maxlength="15" placeholder="Digite seu telefone" maxlength="15" required>

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

                <button type="submit" class="cadastro-button">Cadastrar</button>
            </form>
            <p>Já tem uma conta? <a href="login.php" class="cadastro-link">Faça login</a></p>
        </div>
    </div>

    <script>
        function submitForm(event) {
            event.preventDefault();

            const form = document.getElementById('cadastroForm');
            const formData = new FormData(form);

            fetch('process_register.php', {
                method: 'POST',
                body: new URLSearchParams(formData)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Cadastro realizado com sucesso!');
                    window.location.href = 'perfil.php';
                } else {
                    alert(data.message || 'Erro ao realizar cadastro.');
                }
            })
            .catch(error => console.error('Erro:', error));
        }

        document.getElementById('cpf').addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, ''); // Remove tudo que não é número
            value = value.replace(/(\d{3})(\d)/, '$1.$2'); // Adiciona o primeiro ponto
            value = value.replace(/(\d{3})(\d)/, '$1.$2'); // Adiciona o segundo ponto
            value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2'); // Adiciona o traço
            e.target.value = value;
        });

        document.getElementById('telefone').addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, ''); // Remove tudo que não é número

            // Aplica a máscara: (XX) XXXXX-XXXX
            if (value.length > 10) {
                value = value.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
            } else if (value.length > 6) {
                value = value.replace(/(\d{2})(\d{4})(\d{0,4})/, '($1) $2-$3');
            } else if (value.length > 2) {
                value = value.replace(/(\d{2})(\d{0,4})/, '($1) $2');
            } else {
                value = value.replace(/(\d*)/, '($1');
            }

            e.target.value = value;
        });

        document.getElementById('cep').addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, ''); // Remove tudo que não é número

            // Aplica a máscara: 00000-000
            if (value.length > 5) {
                value = value.replace(/(\d{5})(\d{0,3})/, '$1-$2');
            }

            e.target.value = value;
        });


    </script>

    <?php include 'footer.html'; ?>
</body>
</html>