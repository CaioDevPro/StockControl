<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel - Stock Control</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/base.css">
</head>
<body>
    <h1>Painel Administrativo</h1>
    <p>Olá, <?= htmlspecialchars($_SESSION['User']['nome']) ?>!</p>
    <p><a href="<?= BASE_URL ?>/?rota=logout">Sair</a></p>

    <hr>

    <ul>
        <li><a href="<?= BASE_URL ?>/?rota=produtos">Produtos</a></li>
        <li><a href="<?= BASE_URL ?>/?rota=categorias">Categorias</a></li>
        <li><a href="<?= BASE_URL ?>/?rota=fornecedores">Fornecedores</a></li>
                <li><a href="<?= BASE_URL ?>/?rota=produtos/estoque-baixo">Estoque Baixo</a></li>
    </ul>
</body>
</html>