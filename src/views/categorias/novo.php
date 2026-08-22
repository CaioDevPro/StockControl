<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Categoria - Stock Control</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/base.css">
</head>
<body>
    <h1>Nova Categoria</h1>

    <?php if (isset($_GET['erro'])): ?>
        <p style="color:red;"><?= htmlspecialchars($_GET['erro']) ?></p>
    <?php endif; ?>

    <form action="<?= BASE_URL ?>/?rota=categorias/criar" method="post">
        <label>Nome:</label><br>
        <input type="text" name="nome" required><br><br>

        <button type="submit">Salvar</button>
    </form>

    <p><a href="<?= BASE_URL ?>/?rota=categorias">Ver categorias cadastradas</a></p>
</body>
</html>