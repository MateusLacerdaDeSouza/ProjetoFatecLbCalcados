
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LB Calçados</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/login.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');
    </style>
    <link rel="shortcut icon" type="imagex/png" href="img/logo-mini.png">
</head>
<body>
    <!-- Inclui header -->
    <?php include 'header-sec.html'; ?>

    <div class="login-container">
        <div class="login-left">
            <img src="img/sapato-banco.jpg" alt="">
        </div>
        <div class="login-right" id="loginRight">
            <h2 class="login-title">Login</h2>
            <label for="email">Digite seu e-mail</label>
            <input type="email" id="email" class="login-input" placeholder="E-mail" required>
            <button class="login-button" onclick="checkEmail()">Prosseguir</button>
            <p>Não tem uma conta? <a href="cadastro.php" class="login-link">Crie uma!</a></p>
        </div>
    </div>

    <script>
        function checkEmail() {
            const email = document.getElementById('email').value;

            if (!email) {
                alert('Por favor, insira seu e-mail.');
                return;
            }

            fetch('check_email.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `email=${encodeURIComponent(email)}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.exists) {
                    document.getElementById('loginRight').innerHTML = `
                        <h2 class="login-title">Senha</h2>
                        <p>${email}</p>
                        <label for="password">Digite sua senha</label>
                        <input type="password" id="password" class="login-input" placeholder="Digite sua senha" required>
                        <button class="login-button" onclick="submitLogin('${email}')">Confirmar</button>
                        <p>Não tem uma conta? <a href="cadastro.php" class="login-link">Crie uma!</a></p>
                    `;
                } else {
                    alert('E-mail não encontrado. Por favor, crie uma conta.');
                }
            })
            .catch(error => console.error('Erro:', error));
        }

        function submitLogin(email) {
            const password = document.getElementById('password').value;

            if (!password) {
                alert('Por favor, insira sua senha.');
                return;
            }

            fetch('process_login.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `email=${encodeURIComponent(email)}&password=${encodeURIComponent(password)}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = 'perfil.php';
                } else {
                    alert(data.message || 'Erro ao fazer login.');
                }
            })
            .catch(error => console.error('Erro:', error));
        }
    </script>

    <?php include 'footer.html'; ?>
</body>
</html>
