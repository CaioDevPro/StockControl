<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos - Stock Control</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/base.css">
</head>
<body>
    <h1>Produtos cadastrados</h1>
    <p><a href="<?= BASE_URL ?>/?rota=logout">Sair</a></p>

    <?php
    $mensagens = [
        'criado'         => 'Produto cadastrado com sucesso!',
        'atualizado'     => 'Produto atualizado com sucesso!',
        'excluido'       => 'Produto excluído com sucesso!',
        'nao_encontrado' => 'Produto não encontrado.',
    ];
    $msg = $_GET['msg'] ?? null;
    ?>

    <?php if ($msg && isset($mensagens[$msg])): ?>
        <?php $cor = ($msg === 'nao_encontrado') ? 'red' : 'green'; ?>
        <p style="color: <?= $cor ?>;"><?= htmlspecialchars($mensagens[$msg]) ?></p>
    <?php endif; ?>

    <p><a href="<?= BASE_URL ?>/?rota=produtos/novo">+ Novo produto</a></p>

    <?php if (empty($produtos)): ?>
        <p>Nenhum produto cadastrado ainda.</p>
    <?php else: ?>
        <table border="1" cellpadding="8">
            <tr>
                <th>ID</th>
                <th>Descrição</th>
                <th>Qtd</th>
                <th>Estoque mín.</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
            <?php foreach ($produtos as $produto): ?>
                <tr>
                    <td><?= htmlspecialchars($produto['id']) ?></td>
                    <td><?= htmlspecialchars($produto['descricao']) ?></td>
                    <td><?= htmlspecialchars($produto['qtd']) ?></td>
                    <td><?= htmlspecialchars($produto['estoque_minimo']) ?></td>
                    <td>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
                    <td>
                        <a href="<?= BASE_URL ?>/?rota=produtos/editar&id=<?= $produto['id'] ?>">Editar</a>
                        |
                        <a href="<?= BASE_URL ?>/?rota=produtos/deletar&id=<?= $produto['id'] ?>"
                           onclick="return confirm('Tem certeza que deseja excluir este produto?');">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>