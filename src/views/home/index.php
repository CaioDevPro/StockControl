<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StockControl</title>
    <!-- Agora usando os CSS que vieram da pasta view/css/ -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/base.css">
</head>
<body>
    <div class="container">
        <h1>🏢 StockControl</h1>
        <p>Sistema de Controle de Estoque</p>
        
        <div class="menu">
        <a href="<?= BASE_URL ?>/?rota=home">Início</a>
        <a href="<?= BASE_URL ?>/?rota=sobre">Sobre</a>
        </div> 
        
        <hr>
        
        <h2>Bem-vindo!</h2>
        <p>Estrutura MVC funcionando!</p>
        
        <div class="footer">
            <p>StockControl - Projeto Web 2</p>
            <p>Equipe: Caio e Edrey</p>
        </div>
    </div>
</body>
</html>