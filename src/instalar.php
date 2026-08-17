<?php
/**
 * StockControl - Instalador do banco de dados
 *
 * Coloque este arquivo na pasta public/ do projeto e acesse pelo Apache:
 * http://localhost/StockControl/public/instalar.php
 *
 * Requisitos:
 * - Apache ligado no XAMPP
 * - MySQL ligado no XAMPP
 * - usuário root sem senha (configuração padrão do XAMPP)
 */

declare(strict_types=1);

$host = 'localhost';
$usuario = 'root';
$senha = '';
$nomeBanco = 'stockcontrol';

$mensagens = [];
$erro = null;

try {
    // 1. Conecta ao MySQL sem selecionar um banco específico.
    $pdo = new PDO(
        "mysql:host={$host};charset=utf8mb4",
        $usuario,
        $senha,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );

    // 2. Cria o banco caso ele ainda não exista.
    $pdo->exec(
        "CREATE DATABASE IF NOT EXISTS `{$nomeBanco}`
         CHARACTER SET utf8mb4
         COLLATE utf8mb4_unicode_ci"
    );

    $mensagens[] = "Banco '{$nomeBanco}' verificado/criado com sucesso.";

    // 3. Seleciona o banco.
    $pdo->exec("USE `{$nomeBanco}`");

    // 4. Cria a tabela usada atualmente pelo ProductModel.php.
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS `produtos` (
            `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
            `descricao` VARCHAR(255) NOT NULL,
            `qtd` INT NOT NULL DEFAULT 0,
            `estoque_minimo` INT NOT NULL DEFAULT 0,
            `preco` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
            `id_categoria` INT UNSIGNED NULL,
            `id_fornecedor` INT UNSIGNED NULL,
            PRIMARY KEY (`id`),
            INDEX `idx_produtos_categoria` (`id_categoria`),
            INDEX `idx_produtos_fornecedor` (`id_fornecedor`)
        ) ENGINE=InnoDB
          DEFAULT CHARSET=utf8mb4
          COLLATE=utf8mb4_unicode_ci
    ");

    $mensagens[] = "Tabela 'produtos' verificada/criada com sucesso.";

    // 5. Mostra a estrutura encontrada.
    $colunas = $pdo->query("DESCRIBE `produtos`")->fetchAll();

} catch (PDOException $e) {
    $erro = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instalação - StockControl</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 900px;
            margin: 40px auto;
            padding: 20px;
            line-height: 1.5;
        }
        .ok {
            padding: 12px;
            margin: 8px 0;
            background: #e8f7e8;
            border: 1px solid #8ac78a;
            border-radius: 5px;
        }
        .erro {
            padding: 12px;
            margin: 8px 0;
            background: #fde8e8;
            border: 1px solid #d88;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        th {
            background: #f2f2f2;
        }
        code {
            background: #f1f1f1;
            padding: 2px 5px;
        }
    </style>
</head>
<body>

<h1>StockControl — Instalação do banco</h1>

<?php if ($erro !== null): ?>

    <div class="erro">
        <strong>Erro ao instalar:</strong><br>
        <?= htmlspecialchars($erro) ?>
    </div>

    <h2>Verifique</h2>
    <ul>
        <li>Se o MySQL está iniciado no XAMPP.</li>
        <li>Se o usuário é <code>root</code>.</li>
        <li>Se o root do seu XAMPP possui senha. Se possuir, altere a variável <code>$senha</code> neste arquivo.</li>
        <li>Se a extensão PDO MySQL está habilitada no PHP.</li>
    </ul>

<?php else: ?>

    <?php foreach ($mensagens as $mensagem): ?>
        <div class="ok"><?= htmlspecialchars($mensagem) ?></div>
    <?php endforeach; ?>

    <h2>Estrutura da tabela produtos</h2>

    <table>
        <thead>
            <tr>
                <th>Coluna</th>
                <th>Tipo</th>
                <th>Nulo?</th>
                <th>Chave</th>
                <th>Padrão</th>
                <th>Extra</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($colunas as $coluna): ?>
                <tr>
                    <td><?= htmlspecialchars($coluna['Field']) ?></td>
                    <td><?= htmlspecialchars($coluna['Type']) ?></td>
                    <td><?= htmlspecialchars($coluna['Null']) ?></td>
                    <td><?= htmlspecialchars($coluna['Key']) ?></td>
                    <td><?= htmlspecialchars((string)($coluna['Default'] ?? 'NULL')) ?></td>
                    <td><?= htmlspecialchars($coluna['Extra']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <p>
        <strong>Instalação concluída.</strong>
        Agora você pode acessar a aplicação do StockControl.
    </p>

    <p>
        <strong>Importante:</strong> depois de confirmar que tudo funcionou,
        apague ou renomeie este arquivo <code>instalar.php</code> para impedir
        que qualquer pessoa execute o instalador novamente.
    </p>

<?php endif; ?>

</body>
</html>
