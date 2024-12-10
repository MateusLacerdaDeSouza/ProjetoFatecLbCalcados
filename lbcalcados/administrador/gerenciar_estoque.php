<?php

require_once __DIR__ . '/../models/produto.php';

session_start();

// Verifica se o administrador está autenticado
if (!isset($_SESSION['admin_nome'])) {
    header('Location: adminlogin.php');  // Redireciona para o login se não estiver autenticado
    exit();
}

$produto = new Produto();

// Verifica se o formulário foi enviado para adicionar um novo produto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    // Cadastro de produto
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $cor = $_POST['cor'];
    $tamanho = $_POST['tamanho'];
    $marca = $_POST['marca'];
    $categoria = $_POST['categoria'];
    $estoque_qtd = $_POST['estoque_qtd'];
    $url_img = '';

    if (isset($_FILES['url_img']) && $_FILES['url_img']['error'] == 0) {
        $arquivo_tmp = $_FILES['url_img']['tmp_name'];
        $nome_arquivo = $_FILES['url_img']['name'];
        $diretorio = 'uploads/';
        if (!is_dir($diretorio)) {
            mkdir($diretorio, 0755, true);
        }
        $caminho_imagem = $diretorio . uniqid() . '-' . $nome_arquivo;
        if (move_uploaded_file($arquivo_tmp, $caminho_imagem)) {
            $url_img = $caminho_imagem;
        } else {
            die('Erro ao fazer upload da imagem.');
        }
    } else {
        die('Imagem não foi enviada.');
    }

    // Cadastra o produto no banco de dados
    $produto->cadastrarProduto($nome, $descricao, $preco, $cor, $tamanho, $marca, $url_img, $categoria, $estoque_qtd);
    header('Location: gerenciar_estoque.php');
    exit;
}

// Verifica se o ID do produto foi enviado para editar ou excluir
if (isset($_GET['id'])) {
    $produtoId = $_GET['id'];
    
    // Exclui o produto
    if (isset($_GET['action']) && $_GET['action'] === 'delete') {
        $produto->excluirProduto($produtoId);
        header('Location: gerenciar_estoque.php');
        exit;
    }

    // Edita o produto
    if (isset($_POST['action']) && $_POST['action'] === 'edit') {
        // Atualiza o produto no banco de dados
        $nome = $_POST['nome'];
        $descricao = $_POST['descricao'];
        $preco = $_POST['preco'];
        $cor = $_POST['cor'];
        $tamanho = $_POST['tamanho'];
        $marca = $_POST['marca'];
        $categoria = !empty($_POST['categoria']) ? $_POST['categoria'] : 'diversos';
        $estoque_qtd = isset($_POST['estoque_qtd']) ? (int)$_POST['estoque_qtd'] : 0;
          // Verificar se um novo arquivo foi enviado
        if (isset($_FILES['url_img']) && $_FILES['url_img']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['url_img']['tmp_name'];
            $fileName = $_FILES['url_img']['name'];
            $destPath = 'uploads/' . $fileName;

            // Mover o arquivo para a pasta de destino
            if (move_uploaded_file($fileTmpPath, $destPath)) {
                $url_img = $destPath;
            }
        } else {
            // Se não houver novo upload, manter a imagem existente
            $url_img = $_POST['current_img'];
        }

        $produto->atualizarProduto($produtoId, $nome, $descricao, $preco, $cor, $tamanho, $marca, $url_img, $categoria, $estoque_qtd);
        header('Location: gerenciar_estoque.php');
        exit;
    }

    // Buscar o produto para editar
    $produtoEdit = $produto->buscarProduto($produtoId);
}

$produtos = $produto->listarProdutos();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Estoque</title>
    <style>
        body {
            display: flex;
            justify-content: space-between;
            padding: 20px;
        }
        .form-container {
            width: 45%;
        }
        .list-container {
            width: 45%;
        }
        #img-preview {
            display: block;
            margin-top: 20px;
            max-width: 300px;
            max-height: 300px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        img {
            max-width: 100px;
            max-height: 100px;
        }
    </style>
</head>
<body>
    <!-- Formulário de Adição de Produtos -->
    <div class="form-container">
        <h1>Adicionar Produto</h1>
        <form action="gerenciar_estoque.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="add">
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
        <img id="img-preview" src="#" alt="Preview da imagem" style="display:none;"/>
        <script>
            function previewImage(event) {
                const input = event.target;
                const preview = document.getElementById('img-preview');
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
    </div>

    <!-- Lista de Produtos no Estoque -->
    <div class="list-container">
        <h1>Produtos no Estoque</h1>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Imagem</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th>Ações</th>
            </tr>
            <?php foreach ($produtos as $produto): ?>
            <tr>
                <td><?php echo $produto['idprodutos']; ?></td>
                <td><?php echo $produto['nome']; ?></td>
                <td><img src="<?php echo $produto['url_img']; ?>" alt="Imagem"></td>
                <td>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></td>
                <td><?php echo $produto['estoque_qtd']; ?></td>
                <td><a href="?id=<?php echo $produto['idprodutos']; ?>&action=edit">Editar</a></td>
                <td><a href="?id=<?php echo $produto['idprodutos']; ?>&action=delete" onclick="return confirm('Tem certeza que deseja excluir este produto?')">Excluir</a></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <?php if (isset($produtoEdit)): ?>
        <!-- Formulário de Edição de Produto -->
        <div class="form-container">
            <h1>Editar Produto</h1>
            <form action="gerenciar_estoque.php?id=<?php echo $produtoEdit['idprodutos']; ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="edit">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" value="<?php echo $produtoEdit['nome']; ?>" required><br><br>

                <label for="descricao">Descrição:</label>
                <textarea id="descricao" name="descricao" required><?php echo $produtoEdit['descricao']; ?></textarea><br><br>

                <label for="preco">Preço:</label>
                <input type="number" id="preco" name="preco" value="<?php echo $produtoEdit['preco']; ?>" step="0.01" required><br><br>

                <label for="cor">Cor:</label>
                <input type="text" id="cor" name="cor" value="<?php echo $produtoEdit['cor']; ?>" required><br><br>

                <label for="tamanho">Tamanho:</label>
                <input type="text" id="tamanho" name="tamanho" value="<?php echo $produtoEdit['tamanho']; ?>" required><br><br>

                <label for="marca">Marca:</label>
                <input type="text" id="marca" name="marca" value="<?php echo $produtoEdit['marca']; ?>" required><br><br>

                <label for="url_img">Imagem:</label>
                <input type="file" id="url_img" name="url_img" accept="image/*"><br><br>
                <!-- Campo oculto para a imagem atual -->
                <input type="hidden" name="current_img" value="<?php echo $produtoEdit['url_img']; ?>">

                <label for="categoria">Categoria:</label>
                <input type="text" id="categoria" name="categoria" value="<?php echo $produtoEdit['categoria']; ?>"><br><br>

                <label for="estoque_qtd">Quantidade no Estoque:</label>
                <input type="number" id="estoque_qtd" name="estoque_qtd" value="<?php echo $produtoEdit['estoque_qtd']; ?>" required><br><br>

                <input type="submit" value="Atualizar Produto">
            </form>
        </div>
    <?php endif; ?>

</body>
</html>
