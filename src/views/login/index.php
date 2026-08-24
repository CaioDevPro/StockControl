<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Stock Control</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/base.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/index_style.css">
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/animation.css">
</head>
<body>
    <header>
        <h1>Stock Control</h1>
        <h2>Controle de Estoque</h2>
    </header>
        <div class="login">
        <?php if (isset($_GET['erro'])): ?>
            <p style="color:red;">E-mail ou senha incorretos.</p>
        <?php endif; ?>

        <form action="<?= BASE_URL ?>/?rota=login" method="post" class="login-form">
            <div class="div-email">
                <input type="email" name="email" id="email-input" placeholder="email@email.com" required>
            </div>
            <div class="div-password">
                <input type="password" name="password" id="password-input" placeholder="password" required>
            </div>
            <button id="send-button">ENTRAR</button>
        </form>
        <p>Não tem uma conta? <a href="<?= BASE_URL ?>/?rota=usuarios/novo">Cadastre-se</a></p>
    </div>
</body>
</html>