<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fornecedores - Stock Control</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/base.css">
</head>
<body>
    <h1>Fornecedores cadastrados</h1>
    <p><a href="<?= BASE_URL ?>/?rota=painel">Voltar ao painel</a> | <a href="<?= BASE_URL ?>/?rota=logout">Sair</a></p>

    <?php
    $mensagens = [
        'criado'         => 'Fornecedor cadastrado com sucesso!',
        'atualizado'     => 'Fornecedor atualizado com sucesso!',
        'excluido'       => 'Fornecedor excluído com sucesso!',
        'nao_encontrado' => 'Fornecedor não encontrado.',
    ];
    $msg = $_GET['msg'] ?? null;
    ?>

    <?php if ($msg && isset($mensagens[$msg])): ?>
        <?php $cor = ($msg === 'nao_encontrado') ? 'red' : 'green'; ?>
        <p style="color: <?= $cor ?>;"><?= htmlspecialchars($mensagens[$msg]) ?></p>
    <?php endif; ?>

    <p><a href="<?= BASE_URL ?>/?rota=fornecedores/novo">+ Novo fornecedor</a></p>

    <?php if (empty($fornecedores)): ?>
        <p>Nenhum fornecedor cadastrado ainda.</p>
    <?php else: ?>
        <table border="1" cellpadding="8">
            <tr>
                <th>ID</th>
                <th>Empresa</th>
                <th>CNPJ</th>
                <th>E-mail</th>
                <th>Telefone</th>
                <th>Ações</th>
            </tr>
            <?php foreach ($fornecedores as $fornecedor): ?>
                <tr>
                    <td><?= htmlspecialchars($fornecedor['id']) ?></td>
                    <td><?= htmlspecialchars($fornecedor['empresa']) ?></td>
                    <td><?= htmlspecialchars($fornecedor['cnpj']) ?></td>
                    <td><?= htmlspecialchars($fornecedor['email']) ?></td>
                    <td><?= htmlspecialchars($fornecedor['telefone']) ?></td>
                    <td>
                        <a href="<?= BASE_URL ?>/?rota=fornecedores/editar&id=<?= $fornecedor['id'] ?>">Editar</a>
                        |
                        <a href="<?= BASE_URL ?>/?rota=fornecedores/deletar&id=<?= $fornecedor['id'] ?>"
                           onclick="return confirm('Tem certeza que deseja excluir este fornecedor?');">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>