<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LB Calçados</title>
</head>
<body>
    <!-- Inclui header -->
    <?php include 'header-sec.html'; ?>



    <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["invoice"])) {
            $invoice = htmlspecialchars($_POST["invoice"]);
            echo nl2br($invoice);
        } else {
            echo "Nenhuma nota fiscal gerada.";
        }
    ?>
    


    
    <br><br><br><br><br><br><br><br><br><br>

    <!-- Inclui o rodapé -->
    <?php include 'footer.html'; ?>
</body>
</html>