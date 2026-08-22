<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Fornecedor - Stock Control</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/base.css">
</head>
<body>
    <h1>Editar Fornecedor</h1>

    <?php if (isset($_GET['erro'])): ?>
        <p style="color:red;"><?= htmlspecialchars($_GET['erro']) ?></p>
    <?php endif; ?>

    <form action="<?= BASE_URL ?>/?rota=fornecedores/atualizar" method="post">
        <input type="hidden" name="id" value="<?= htmlspecialchars($fornecedor['id']) ?>">

        <label>Empresa:</label><br>
        <input type="text" name="empresa" value="<?= htmlspecialchars($fornecedor['empresa']) ?>" required><br><br>

        <label>CNPJ (apenas números):</label><br>
        <input type="text" name="cnpj" maxlength="14" value="<?= htmlspecialchars($fornecedor['cnpj']) ?>" required><br><br>

        <label>E-mail:</label><br>
        <input type="email" name="email" value="<?= htmlspecialchars($fornecedor['email']) ?>"><br><br>

        <label>Telefone:</label><br>
        <input type="text" name="telefone" maxlength="14" value="<?= htmlspecialchars($fornecedor['telefone']) ?>"><br><br>

        <label>Endereço:</label><br>
        <input type="text" name="endereco" value="<?= htmlspecialchars($fornecedor['endereco']) ?>"><br><br>

        <button type="submit">Salvar alterações</button>
    </form>

    <p><a href="<?= BASE_URL ?>/?rota=fornecedores">Cancelar e voltar</a></p>
</body>
</html>