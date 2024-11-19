<?php
// Aqui você pode colocar a lógica para buscar os produtos no banco de dados
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

    <form action="adicionar_produto.php" method="POST" enctype="multipart/form-data">
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

