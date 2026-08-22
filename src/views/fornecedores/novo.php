<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Fornecedor - Stock Control</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/base.css">
</head>
<body>
    <h1>Novo Fornecedor</h1>

    <?php if (isset($_GET['erro'])): ?>
        <p style="color:red;"><?= htmlspecialchars($_GET['erro']) ?></p>
    <?php endif; ?>

    <form action="<?= BASE_URL ?>/?rota=fornecedores/criar" method="post">
        <label>Empresa:</label><br>
        <input type="text" name="empresa" required><br><br>

        <label>CNPJ (apenas números):</label><br>
        <input type="text" name="cnpj" maxlength="14" placeholder="12345678000199" required><br><br>

        <label>E-mail:</label><br>
        <input type="email" name="email"><br><br>

        <label>Telefone:</label><br>
        <input type="text" name="telefone" maxlength="14"><br><br>

        <label>Endereço:</label><br>
        <input type="text" name="endereco"><br><br>

        <button type="submit">Salvar</button>
    </form>

    <p><a href="<?= BASE_URL ?>/?rota=fornecedores">Ver fornecedores cadastrados</a></p>
</body>
</html>