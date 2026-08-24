<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Stock Control</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/base.css">
</head>
<body>
    <h1>Criar Conta</h1>

    <?php if (isset($_GET['erro'])): ?>
        <p style="color:red;"><?= htmlspecialchars($_GET['erro']) ?></p>
    <?php endif; ?>

    <form action="<?= BASE_URL ?>/?rota=usuarios/criar" method="post">
        <label>Nome:</label><br>
        <input type="text" name="nome" required><br><br>

        <label>CPF (apenas números):</label><br>
        <input type="text" name="cpf" maxlength="11" placeholder="12345678900" required><br><br>

        <label>E-mail:</label><br>
        <input type="email" name="email" required><br><br>

        <label>Senha:</label><br>
        <input type="password" name="password" minlength="6" required><br><br>

        <button type="submit">Criar conta</button>
    </form>

    <p><a href="<?= BASE_URL ?>/?rota=login">Já tenho conta, voltar ao login</a></p>
</body>
</html>