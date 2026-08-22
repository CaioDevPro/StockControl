<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoria - Stock Control</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/base.css">
</head>
<body>
    <h1>Editar Categoria</h1>

    <?php if (isset($_GET['erro'])): ?>
        <p style="color:red;"><?= htmlspecialchars($_GET['erro']) ?></p>
    <?php endif; ?>

    <form action="<?= BASE_URL ?>/?rota=categorias/atualizar" method="post">
        <input type="hidden" name="id" value="<?= htmlspecialchars($categoria['id']) ?>">

        <label>Nome:</label><br>
        <input type="text" name="nome" value="<?= htmlspecialchars($categoria['nome']) ?>" required><br><br>

        <button type="submit">Salvar alterações</button>
    </form>

    <p><a href="<?= BASE_URL ?>/?rota=categorias">Cancelar e voltar</a></p>
</body>
</html>