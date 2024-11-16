<?php

require_once '../models/produto.php';

session_start();

// Verifica se o administrador está autenticado
if (!isset($_SESSION['admin_nome'])) {
    header('Location: adminlogin.php');  // Redireciona para o login se não estiver autenticado
    exit();
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recebe os dados do formulário
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $cor = $_POST['cor'];
    $tamanho = $_POST['tamanho'];
    $marca = $_POST['marca'];
    $categoria = $_POST['categoria'];
    $estoque_qtd = $_POST['estoque_qtd'];

    $url_img = '';

    // Tratamento do upload da imagem
    if (isset($_FILES['url_img']) && $_FILES['url_img']['error'] == 0) {
        $arquivo_tmp = $_FILES['url_img']['tmp_name'];
        $nome_arquivo = $_FILES['url_img']['name'];

        // Define o diretório onde a imagem será salva
        $diretorio = 'uploads/';
        
        // Cria o diretório, se não existir
        if (!is_dir($diretorio)) {
            mkdir($diretorio, 0755, true);
        }
        
        // Cria o caminho da imagem
        $caminho_imagem = $diretorio . uniqid() . '-' . $nome_arquivo;
        
        // Move o arquivo para o diretório desejado
        if (move_uploaded_file($arquivo_tmp, $caminho_imagem)) {
            // Imagem foi salva com sucesso
            $url_img = $caminho_imagem;
        } else {
            die('Erro ao fazer upload da imagem.');
        }
    } else {
        // Se não foi enviado uma imagem, exibe um erro
        die('Imagem não foi enviada.');
    }

    // Cria uma instância de Produto
    $produto = new Produto();

    // Chama o método para cadastrar o produto com a URL da imagem salva
    if ($produto->cadastrarProduto($nome, $descricao, $preco, $cor, $tamanho, $marca, $url_img, $categoria, $estoque_qtd)) {
        echo "Produto adicionado com sucesso!";
        header('Location: gerenciar_estoque.php');
        exit;
    } else {
        echo "Erro ao adicionar produto.";
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Produto</title>
    <style>
        #img-preview {
            display: block;
            margin-top: 20px;
            max-width: 600px;
            max-height: 600px;
        }
    </style>
</head>
<body>
    <h1>Adicionar Produto</h1>

    <form action="gerenciar_estoque.php" method="POST" enctype="multipart/form-data">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" required></textarea><br><br>

        <label for="preco">Preço:</label>
        <input type="number" id="preco" name="preco" step="0.01" required><br><br>

        <label for="cor">Cor:</label>
        <input type="text" id="cor" name="cor" required><br><br>

        <label for="tamanho">Tamanho:</label>
        <input type="text" id="tamanho" name="tamanho" required><br><br>

        <label for="marca">Marca:</label>
        <input type="text" id="marca" name="marca" required><br><br>

        <label for="url_img">Imagem:</label>
        <input type="file" id="url_img" name="url_img" accept="image/*" onchange="previewImage(event)" required><br><br>

        <label for="categoria">Categoria:</label>
        <input type="text" id="categoria" name="categoria"><br><br>

        <label for="estoque_qtd">Quantidade no Estoque:</label>
        <input type="number" id="estoque_qtd" name="estoque_qtd" required><br><br>

        <input type="submit" value="Adicionar Produto">
    </form>

    <!-- Preview da imagem -->
    <img id="img-preview" src="#" alt="Preview da imagem" style="display:none;"/><br><br>

    <!-- Script para preview da imagem -->
    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('img-preview');
            
            // Verifica se um arquivo foi selecionado
            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>
