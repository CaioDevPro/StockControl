<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Produto - Stock Control</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/base.css">
</head>
<body>
    <h1>Novo Produto</h1>
    <p><a href="<?= BASE_URL ?>/?rota=logout">Sair</a></p>

    <?php if (isset($_GET['erro'])): ?>
        <p style="color:red;"><?= htmlspecialchars($_GET['erro']) ?></p>
    <?php endif; ?>

    <form action="<?= BASE_URL ?>/?rota=produtos/criar" method="post">
        <label>Descrição:</label><br>
        <input type="text" name="descricao" required><br><br>

        <label>Quantidade:</label><br>
        <input type="number" name="qtd" value="0"><br><br>

                <label>Estoque mínimo:</label><br>
        <input type="number" name="estoque_minimo" value="0"><br><br>

        <label>Preço:</label><br>
        <input type="number" step="0.01" name="preco" value="0"><br><br>

        <label>Categoria:</label><br>
        <select name="id_categoria">
            <option value="">-- Nenhuma --</option>
            <?php foreach ($categorias as $categoria): ?>
                <option value="<?= $categoria['id'] ?>"><?= htmlspecialchars($categoria['nome']) ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label>Fornecedor:</label><br>
        <select name="id_fornecedor">
            <option value="">-- Nenhum --</option>
            <?php foreach ($fornecedores as $fornecedor): ?>
                <option value="<?= $fornecedor['id'] ?>"><?= htmlspecialchars($fornecedor['empresa']) ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <button type="submit">Salvar</button>
    </form>

    <p><a href="<?= BASE_URL ?>/?rota=produtos">Ver produtos cadastrados</a></p>
</body>
</html>