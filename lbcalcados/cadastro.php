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
            <!-- Primeira Etapa: Verificar e-mail -->
            <h2 class="cadastro-title">Cadastro</h2>
            <label for="email">Digite seu e-mail</label>
            <input type="email" id="email" class="cadastro-input" placeholder="Digite seu e-mail" required>
            <button class="cadastro-button" onclick="checkEmail()">Prosseguir</button>
            <p>Já tem uma conta? <a href="login.php" class="cadastro-link">Faça login</a></p>
        </div>
    </div>

    <script>
        function checkEmail() {
            const email = document.getElementById('email').value;

            if (!email) {
                alert('Por favor, insira seu e-mail.');
                return;
            }

            fetch('process_register.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `step=check_email&email=${encodeURIComponent(email)}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('cadastroRight').innerHTML = `
                        <h2 class="cadastro-title">Criar Senha</h2>
                        <p>${email}</p>
                        <label for="password">Digite sua senha</label>
                        <input type="password" id="password" class="cadastro-input" placeholder="Digite sua senha" required>
                        <button class="cadastro-button" onclick="createAccount('${email}')">Confirmar</button>
                        <p>Já tem uma conta? <a href="login.php" class="cadastro-link">Faça login</a></p>
                    `;
                } else {
                    alert(data.message || 'Erro ao verificar e-mail.');
                }
            })
            .catch(error => console.error('Erro:', error));
        }

        function createAccount(email) {
            const password = document.getElementById('password').value;

            if (!password) {
                alert('Por favor, insira sua senha.');
                return;
            }

            fetch('process_register.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `step=register_user&email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('cadastroRight').innerHTML = `
                        <h2 class="cadastro-title">Preferências</h2>
                        <p>Bem-vindo ao clube!</p>
                        <label>
                            <input type="checkbox" id="promoções">
                            Quero receber promoções por e-mail
                        </label>
                        <button class="cadastro-button" onclick="setPreferences()">Confirmar e Continuar</button>
                    `;
                } else {
                    alert(data.message || 'Erro ao criar conta.');
                }
            })
            .catch(error => console.error('Erro:', error));
        }

        function setPreferences() {
            const promoções = document.getElementById('promoções').checked;

            fetch('process_register.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `step=set_preferences&preferences=${promoções ? '1' : '0'}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = 'perfil.php';
                } else {
                    alert(data.message || 'Erro ao salvar preferências.');
                }
            })
            .catch(error => console.error('Erro:', error));
        }
    </script>

    <?php include 'footer.html'; ?>
</body>
</html>