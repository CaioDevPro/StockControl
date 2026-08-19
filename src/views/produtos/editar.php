<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto - Stock Control</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/base.css">
</head>
<body>
    <h1>Editar Produto</h1>
    <p><a href="<?= BASE_URL ?>/?rota=logout">Sair</a></p>

    <?php if (isset($_GET['erro'])): ?>
        <p style="color:red;"><?= htmlspecialchars($_GET['erro']) ?></p>
    <?php endif; ?>

    <form action="<?= BASE_URL ?>/?rota=produtos/atualizar" method="post">
        <input type="hidden" name="id" value="<?= htmlspecialchars($produto['id']) ?>">

        <label>Descrição:</label><br>
        <input type="text" name="descricao" value="<?= htmlspecialchars($produto['descricao']) ?>" required><br><br>

        <label>Quantidade:</label><br>
        <input type="number" name="qtd" value="<?= htmlspecialchars($produto['qtd']) ?>"><br><br>

        <label>Estoque mínimo:</label><br>
        <input type="number" name="estoque_minimo" value="<?= htmlspecialchars($produto['estoque_minimo']) ?>"><br><br>

        <label>Preço:</label><br>
        <input type="number" step="0.01" name="preco" value="<?= htmlspecialchars($produto['preco']) ?>"><br><br>

        <button type="submit">Salvar alterações</button>
    </form>

    <p><a href="<?= BASE_URL ?>/?rota=produtos">Cancelar e voltar</a></p>
</body>
</html>